<?php

namespace App\Http\Controllers;

use App\Imports\PriceCodeImport;
use App\Imports\WarehouseImport;
use App\Models\AbilityPayer;
use App\Models\Activity;
use App\Models\Batches;
use App\Models\Copayment;
use App\Models\Departments;
use App\Models\Diagnosis;
use App\Models\Doctors;
use App\Models\DoctorsData;
use App\Models\documents;
use App\Models\Notes;
use App\Models\Patients;
use App\Models\DoctorType;
use App\Models\FormPOSType;
use App\Models\History;
use App\Models\ICDNine;
use App\Models\ICDTen;
use App\Models\InsuranceCompany;
use App\Models\InsuranceGroup;
use App\Models\InsuranceType;
use App\Models\Inventory;
use App\Models\InvoiceForm;
use App\Models\Location;
use App\Models\Manufacture;
use App\Models\OrderItems;
use App\Models\Orders;
use App\Models\PatientInsurance;
use App\Models\PereferedNotes;
use App\Models\PreferredNotes;
use App\Models\PriceCode;
use App\Models\ProductType;
use App\Models\PurchaseOrderItems;
use App\Models\PurchaseOrders;
use App\Models\RetailSale;
use App\Models\SerialNumber;
use App\Models\Status;
use App\Models\Taxes;
use App\Models\Transaction;
use App\Models\Users;
use App\Models\Vendor;
use App\Models\Warehouse;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session as FacadesSession;
use Stripe\Charge;
use Stripe\Stripe;
use Maatwebsite\Excel\Facades\Excel;
use setasign\Fpdi\Fpdi;
use setasign\Fpdi\PdfReader;
use Stripe\Climate\Order;
use TCPDF;
use Illuminate\Support\Str;

use function PHPUnit\Framework\isEmpty;

class SecondPhaseController extends Controller
{

    //Purchase Order Start

    public function purchase_order_list()
    {
        $userId = FacadesSession::get('LoginId');
        $userView = FacadesSession::get('LoginViewCheck');
        extract(Patients::fetchPatients($userId, $userView));
        $PO = PurchaseOrders::select('id', 'Vendor', 'date', 'Shipping_Address', 'Created_By', 'status')->orderBy('created_at', 'desc')
            ->get();

        return view('PurchaseOrderList', compact('drs', 'st', 'noti', 'pt', 'PO'));
    }

    public function add_purchase_order($id)
    {
        $userId = FacadesSession::get('LoginId');
        $userView = FacadesSession::get('LoginViewCheck');
        extract(Patients::fetchPatients($userId, $userView));
        $PO = $id != 0 ? PurchaseOrders::find($id) : null;

        $POI = $id != 0 ? PurchaseOrderItems::where('uniqueId', $PO->Items)->get() : [];
        $code = $id != 0 ? $PO->Items : mt_rand(10000, 99999);

        $Pid = $id != 0 ? null : PurchaseOrders::select('id')->orderBy('created_at', 'desc')->first();
        $Pid = $Pid ? $Pid->id + 1 : 1000;

        $vendor = Vendor::select('Vendor_Name', 'id', 'Account')->orderBy('created_at', 'desc')->get();
        $Location = Location::select('address')->orderBy('created_at', 'desc')->get();
        $Warehouse =  Warehouse::select('Warehouse_Name', 'Address')->orderBy('created_at', 'desc')->get();
        $patients = Patients::select('name', 'last_Name', 'Dob', 'Location')->orderBy('created_at', 'desc')->get();
        $inventory = Inventory::select('id', 'Item_Name')
            ->orderBy('created_at', 'desc')
            ->get();
        return view('AddPurchaseOrder', compact('drs', 'st', 'noti', 'pt', 'inventory', 'PO', 'Pid', 'code', 'POI', 'vendor', 'Location', 'Warehouse', 'patients'));
    }

    public function AddEditPurchaseOrder(Request $request, $id)
    {
        $validatedData = $request->validate([
            'date' => 'required',
            'Cost' => 'required',
            'Freight' => 'required',
            'Vendor' => 'required',
            'Vendor_Account' => 'required',
            'Confirm' => 'required',
            'Tax' => 'required',
            'Total_Due' => 'required',
            'Billing_Address' => 'required',
            'Shipping_Address' => 'required',
            // 'Order_Patient' => 'required',
            'Items' => 'required',
            // 'dropShip' => 'required',
            'status' => 'required',
        ], [
            'required' => ':attribute is required',
        ]);

        $SN = $id == 0 ? new PurchaseOrders() : PurchaseOrders::find($id);
        $SN->fill($validatedData);
        if ($id != 0) {
            $SN->updated_at = now();
        } else {
            $SN->Created_By = FacadesSession::get('LoginName');
        }
        $SN->save();
        PurchaseOrderItems::where('uniqueId', $request->Items)->update(['status' => 'permanent']);
        return redirect('purchaseOrderList')->with('success', 'Saved Successfully');
    }

    public function DeletePurchaseOrder($id)
    {
        $loc = PurchaseOrders::find($id);
        $loc->delete();
        return back();
    }

    public function saveTemporaryItem(Request $request)
    {
        $validatedData = $request->validate([
            'customer' => 'required',
            'uniqueId' => 'required|string',
            'item' => 'required|string',
            'price' => 'required|numeric',
            'orderedQty' => 'required|integer',
            'receivedQty' => 'required|integer',
            'backOrder' => 'required|integer',
            'dateReceived' => 'required|date',
            'warehouse' => 'required|string',
            'status' => 'required|string'
        ]);
        $customer = Patients::find($request->customer);
        if (!$customer) {
            $validatedData['customer'] = "Not Found";
        } else {
            $validatedData['customer'] = $customer->name . ' ' . $customer->last_Name;
        }

        $POI = new PurchaseOrderItems();
        $POI->fill($validatedData);
        $POI->save();
        return response()->json(['item' => $POI, 'message' => 'Item saved successfully!']);
    }

    public function deleteTemporaryItem($id)
    {
        $item = PurchaseOrderItems::find($id);
        if ($item) {
            $item->delete();
            return response()->json(['success' => true, 'message' => 'Item deleted successfully!']);
        }
        return response()->json(['success' => false, 'message' => 'Item not found!']);
    }


    //Purchase Order End


    //Inventory Start

    public function inventoryItemList()
    {
        $userId = FacadesSession::get('LoginId');
        $userView = FacadesSession::get('LoginViewCheck');
        extract(Patients::fetchPatients($userId, $userView));
        $inventory = Inventory::select('id', 'Item_Name', 'Manufacturer', 'Inv_Code', 'Model', 'Vendor', 'InStockQty', 'Backorder', 'Rental', 'Sold', 'warehouse', 'itemQuantity')->orderBy('created_at', 'desc')->get();
        return view('InventoryList', compact('drs', 'st', 'noti', 'pt', 'inventory'));
    }


    public function inventoryItemAdd($id)
    {
        $userId = FacadesSession::get('LoginId');
        $userView = FacadesSession::get('LoginViewCheck');
        extract(Patients::fetchPatients($userId, $userView));
        $inventory = $id != 0 ? Inventory::find($id) : null;
        $Iid = $id != 0 ? null : Inventory::select('id')->orderBy('created_at', 'desc')->first();
        $Iid = $Iid ? $Iid->id + 1 : 1000;
        $manufacture = Manufacture::select('Manufacture_Name')->orderBy('created_at', 'desc')->get();
        $PreNotes = PreferredNotes::select('Name')->where('Type', 'Document Text')->orderBy('created_at', 'desc')->get();
        $vendor = Vendor::select('Vendor_Name', 'id')->orderBy('created_at', 'desc')->get();
        $ProductType = ProductType::select('Product_Type')->orderBy('created_at', 'desc')->get();
        $icd10 = ICDTen::all();
        $warehouse = Warehouse::select('Warehouse_Name')->get();

        return view('AddInventory', compact('drs', 'st', 'noti', 'pt', 'inventory', 'Iid', 'manufacture', 'PreNotes', 'vendor', 'ProductType', 'icd10', 'warehouse'));
    }

    public function AddEditInventoryItem(Request $request, $id)
    {
        $validatedData = $request->validate([
            'Manufacturer' => 'required',
            'Barcode_Type' => 'required',
            'Predefined_Text' => 'required',
            'Model' => 'required',
            'Product_Type' => 'required',
            'Barcode' => 'required',
            'Vendor' => 'required',
            'Purchase_Price' => 'required',
            'MAP_Price' => 'required',
            'MSRPPrice' => 'required',
            'TotalSellItems' => 'required',
            'InStockQty' => 'required',
            'Inv_Code' => 'required',
            'Basis' => 'required',
            'Frequency' => 'required',
            'PaidAt' => 'required',
            'Item_Name' => 'required',
            'Inventory_Code' => 'required',
            'O2Tank' => 'required',
            'Service' => 'required',
            'Serialized' => 'required',
            'Inactive' => 'required',
            'DiagnoseCode' => 'required',
            'warehouse' => 'required',
            'itemQuantity' => 'required',
        ], [
            'required' => ':attribute is required',
        ]);

        $diagnoseCodes = $request->input('DiagnoseCode');

        $SN = $id == 0 ? new Inventory() : Inventory::find($id);
        if ($id != 0) {
            $SN->updated_at = now();
        }
        $SN->fill($validatedData);
        $SN->warehouse = json_encode($request->input('warehouse'));
        $SN->itemQuantity = json_encode($request->input('itemQuantity'));
        $SN->DiagnoseCode = json_encode($diagnoseCodes);

        $SN->save();

        if ($id == 0) {
            $inStockQty = $validatedData['InStockQty'];
            for ($i = 0; $i < $inStockQty; $i++) {

                $SN = new SerialNumber();
                $SN->InventoryCode = $validatedData['Item_Name'];
                $SN->Manufacturer = $validatedData['Manufacturer'];
                $SN->Model = $validatedData['Model'];
                $SN->Warehouse = json_encode($request->input('warehouse'));
                $SN->PurchaseAmount = $request->input('Purchase_Price');
                $SN->PurchaseAmount = $request->input('Purchase_Price');
                $SN->save();
            }
        }

        return redirect('InventoryItemList')->with('success', 'Saved Successfully');
    }

    public function DeleteInventoryItem($id)
    {
        $loc = Inventory::find($id);
        $loc->delete();
        return back();
    }


    public function addProductType(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $ProductType = new ProductType();
        $ProductType->Product_Type = $request->name;
        $ProductType->save();

        return response()->json([
            'id' => $ProductType->id,
            'name' => $ProductType->Product_Type
        ]);
    }


    //Inventory End


    //serial start

    public function serialNumberList()
    {
        $userId = FacadesSession::get('LoginId');
        $userView = FacadesSession::get('LoginViewCheck');
        extract(Patients::fetchPatients($userId, $userView));
        $serial = SerialNumber::select('id', 'SerialNumber', 'InventoryCode', 'Manufacturer', 'Model', 'Vendor')->orderBy('created_at', 'desc')->get();
        return view('SerialNumber', compact('drs', 'st', 'noti', 'pt', 'serial'));
    }

    public function AddSerialNumber($id)
    {
        $userId = FacadesSession::get('LoginId');
        $userView = FacadesSession::get('LoginViewCheck');
        extract(Patients::fetchPatients($userId, $userView));
        $serial = $id != 0 ? SerialNumber::find($id) : null;
        $inventory = Inventory::select('id', 'Item_Name')
            ->orderBy('created_at', 'desc')
            ->get();
        $manufacture = Manufacture::select('Manufacture_Name')
            ->orderBy('created_at', 'desc')
            ->get();
        $warehouse = Warehouse::select('Warehouse_Name')
            ->orderBy('created_at', 'desc')
            ->get();
        $vendor = Vendor::select('Vendor_Name')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('AddSerialNumber', compact('drs', 'st', 'noti', 'pt', 'serial', 'inventory', 'manufacture', 'warehouse', 'vendor'));
    }

    public function AddEditSerialNumber(Request $request, $id)
    {
        $validatedData = $request->validate([
            'SerialNumber' => 'required',
            'InventoryCode' => 'required',
            'Status' => 'required',
            'Warranty' => 'required',
            'WarrantyLength' => 'required',
            'Manufacturer' => 'required',
            'ManufacturerSerialNumber' => 'required',
            'Model' => 'required',
            'Warehouse' => 'required',
            'PurchaseAmount' => 'required',
            'PurchaseDate' => 'required',
            'SoldDate' => 'required',
            'NextMaintenanceDate' => 'required',
            'MonthsRented' => 'required',
            'CurrentCustomer' => 'required',
            'LastCustomer' => 'required',
            'LotNumber' => 'required',
            'FirstRented' => 'required',
            'OwnRent' => 'required',
            'Vendor' => 'required',
        ], [
            'required' => ':attribute is required',
        ]);

        $SN = $id == 0 ? new SerialNumber() : SerialNumber::find($id);
        if ($id != 0) {
            $SN->updated_at = now();
        }
        $SN->fill($validatedData);
        $SN->save();
        return redirect('serialNumberList')->with('success', 'Saved Successfully');
    }

    public function DeleteSerialNumber($id)
    {
        $loc = SerialNumber::find($id);
        $loc->delete();
        return back();
    }

    //serial end


    //Tax start

    public function TaxList()
    {
        $userId = FacadesSession::get('LoginId');
        $userView = FacadesSession::get('LoginViewCheck');
        extract(Patients::fetchPatients($userId, $userView));
        $tax = Taxes::select('id', 'TotalTax', 'OtherTax', 'CityTax', 'CountyTax', 'StatesTax', 'Name')->orderBy('created_at', 'desc')->get();
        return view('TaxList', compact('drs', 'st', 'noti', 'pt', 'tax'));
    }

    public function AddTax($id)
    {
        $userId = FacadesSession::get('LoginId');
        $userView = FacadesSession::get('LoginViewCheck');
        extract(Patients::fetchPatients($userId, $userView));
        $tax = $id != 0 ? Taxes::find($id) : null;
        return view('AddTax', compact('drs', 'st', 'noti', 'pt', 'tax'));
    }

    public function AddEditTax(Request $request, $id)
    {
        $validatedData = $request->validate([
            'Name' => 'required',
            'StatesTax' => 'required',
            'CountyTax' => 'required',
            'CityTax' => 'required',
            'OtherTax' => 'required',
            'TotalTax' => 'required',
        ], [
            'required' => ':attribute is required',
        ]);

        $SN = $id == 0 ? new Taxes() : Taxes::find($id);
        if ($id != 0) {
            $SN->updated_at = now();
        }
        $SN->fill($validatedData);
        $SN->save();
        return redirect('TaxList')->with('success', 'Saved Successfully');
    }

    public function DeleteTax($id)
    {
        $loc = Taxes::find($id);
        $loc->delete();
        return back();
    }

    //Tax end


    //Location start

    public function LocationList()
    {
        $userId = FacadesSession::get('LoginId');
        $userView = FacadesSession::get('LoginViewCheck');
        extract(Patients::fetchPatients($userId, $userView));
        $Location = Location::select('id', 'Name', 'address', 'City', 'State')->orderBy('created_at', 'desc')->get();
        return view('Location', compact('drs', 'st', 'noti', 'pt', 'Location'));
    }

    public function AddLocation($id)
    {
        $userId = FacadesSession::get('LoginId');
        $userView = FacadesSession::get('LoginViewCheck');
        extract(Patients::fetchPatients($userId, $userView));
        $Location = $id != 0 ? Location::find($id) : null;
        return view('AddLocation', compact('drs', 'st', 'noti', 'pt', 'Location'));
    }

    public function AddEditLocation(Request $request, $id)
    {
        $validatedData = $request->validate([
            'Name' => 'required',
            'address' => 'required',
            'City' => 'required',
            'State' => 'required',
            'Code' => 'required',
            'NPI' => 'required',
            'FederalTaxID' => 'required',
            'TaxIDType' => 'required',
            'Phone' => 'required',
            'Phone2' => 'required',
            'Fax' => 'required',
            'mail' => 'required',
            'POSType' => 'required',
            'Warehouse' => 'required',
            'TaxRate' => 'required',
            'Tickets' => 'required',
            'Statement' => 'required',
            'Provider' => 'required',
            'Zip' => 'required',
            'Contact' => 'required',
        ], [
            'required' => ':attribute is required',
        ]);

        $locat = $id == 0 ? new Location() : Location::find($id);
        if ($id != 0) {
            $locat->updated_at = now();
        }
        $locat->fill($validatedData);
        $locat->save();
        return redirect('LocationList')->with('success', 'Saved Successfully');
    }

    public function DeleteLocation($id)
    {
        $loc = Location::find($id);
        $loc->delete();
        return back();
    }

    //Location end


    //price code start

    public function  PriceCodeList()
    {
        $userId = FacadesSession::get('LoginId');
        $userView = FacadesSession::get('LoginViewCheck');
        extract(Patients::fetchPatients($userId, $userView));
        $priceCode = PriceCode::select('id', 'Item', 'Insurance', 'AllowablePrice', 'Billable_Price', 'RentalAllowablePrice', 'Rental_Billable_Price')->orderBy('created_at', 'desc')->get();
        return view('PriceCodeList', compact('drs', 'st', 'noti', 'pt', 'priceCode'));
    }

    public function AddEditPriceCode(Request $request, $id)
    {
        $validatedData = $request->validate([
            "Item" => 'required',
            "Insurance" => 'required',
            "OrderType" => 'required',
            "PredefinedText" => 'required',
            "Billable_Price" => 'required',
            "AllowablePrice" => 'required',
            "Rental_Billable_Price" => 'required',
            "RentalAllowablePrice" => 'required',
            "RentalType" => 'required',
            "Bill_Billable_Code" => 'required',
            "DMNRX" => 'required',
            "modifier1" => 'required',
            "modifier2" => 'required',
            "modifier3" => 'required',
            "modifier4" => 'required',
            "PriorAuth" => 'required',
            "Quantity" => 'required',
            "Units" => 'required',
            "When" => 'required',
            "Converter" => 'required',
            "BQuantity" => 'required',
            "BUnits" => 'required',
            "BWhen" => 'required',
            "BConverter" => 'required',
            "DQuantity" => 'required',
            "DUnits" => 'required',
            "DWhen" => 'required',
            "DConverter" => 'required',
            "ReoccuringSale" => 'required',
            "AcceptAssignment" => 'required',
            "SpanDates" => 'required',
            "BillTOInsurance" => 'required',
            "Taxable" => 'required',
            "DayDelivery" => 'required',
            "LastPeriod" => 'required',
            "BillPickUp" => 'required',
            "LastMonth" => 'required',
        ], [
            'required' => ':attribute is required',
        ]);

        $locat = $id == 0 ? new PriceCode() : PriceCode::find($id);
        if ($id != 0) {
            $locat->updated_at = now();
        }
        $locat->fill($validatedData);
        $locat->save();
        return redirect('PriceCodeList')->with('success', 'Saved Successfully');
    }

    public function DeletePriceCode($id)
    {
        $loc = PriceCode::find($id);
        $loc->delete();
        return back();
    }

    public function  AddPriceCode($id)
    {
        $userId = FacadesSession::get('LoginId');
        $userView = FacadesSession::get('LoginViewCheck');
        extract(Patients::fetchPatients($userId, $userView));
        $price = $id != 0 ? PriceCode::find($id) : null;
        $Pid = $id != 0 ? null : PriceCode::select('id')->orderBy('created_at', 'desc')->first();
        $Pid = $Pid ? $Pid->id + 1 : 1000;
        $priceCodeItem = $price != null ? $price->Item : null;
        $warehouseList = [];
        if ($priceCodeItem) {
            $warehouseData = Inventory::find($priceCodeItem)->warehouse;
            $warehouseList = json_decode($warehouseData, true) ?: [];
        }

        $insurance = InsuranceCompany::select('Name')->orderBy('created_at', 'desc')->get();
        $inventoryItem = Inventory::select('Item_Name', 'id')->orderBy('created_at', 'desc')->get();
        $preNotes = PreferredNotes::select('Text')->where('Type', 'Document Text')->orderBy('created_at', 'desc')->get();

        return view('AddPriceCode', compact('drs', 'st', 'noti', 'pt', 'price', 'Pid', 'insurance', 'preNotes', 'inventoryItem', 'warehouseList'));
    }

    public function updatePriceCode(Request $request, $id)
    {
        $priceCode = PriceCode::find($id);
        if ($priceCode) {
            $priceCode->fill($request->all());
            $priceCode->save();
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false]);
    }


    //price code end

    // Insurance Price Code Start

    public function  InsurancePriceCode()
    {
        $userId = FacadesSession::get('LoginId');
        $userView = FacadesSession::get('LoginViewCheck');
        extract(Patients::fetchPatients($userId, $userView));
        return view('InsurancePrice', compact('drs', 'st', 'noti', 'pt'));
    }

    // Insurance Price Code end

    // Order Start

    public function AddCoPayment(Request $request)
    {
        $copayment = Copayment::firstOrNew(['PatientID' => $request->PatientID]);

        $isNew = !$copayment->exists;
        $request->merge([
            'Block12' => $request->has('Block12') ? 'on' : 'off',
            'Block13' => $request->has('Block13') ? 'on' : 'off',
            'HIPPANote' => $request->has('HIPPANote') ? 'on' : 'off',
            'SupplierStandards' => $request->has('SupplierStandards') ? 'on' : 'off',
            'Hardship' => $request->has('Hardship') ? 'on' : 'off',
        ]);

        $copayment->fill($request->all());
        if (!$isNew) {
            $copayment->updated_at = now();
        }
        $copayment->save();
        $previousUrl = $request->input('previous_url');
        if (Str::contains($previousUrl, '/PatientDetail')) {
            return redirect()->to($previousUrl)->with('success', 'Patient updated successfully.');
        } else {
            return redirect()->to('/')->with('success', 'Patient updated successfully.');
        }
    }


    public function OrdersList()
    {
        $userId = FacadesSession::get('LoginId');
        $userView = FacadesSession::get('LoginViewCheck');
        extract(Patients::fetchPatients($userId, $userView));
        $order = Orders::select('id', 'Patient_Name', 'Patient_Last_Name', 'Items', 'Patient_DOB', 'Account', 'Department', 'created_at', 'CreatedBy', 'OrderStatus', 'Patient_ID')->orderBy('created_at', 'desc')->get();
        return view('OrdersList', compact('drs', 'st', 'noti', 'pt', 'order'));
    }

    public function AddOrders($PID, $id)
    {
        $userId = FacadesSession::get('LoginId');
        $userView = FacadesSession::get('LoginViewCheck');
        extract(Patients::fetchPatients($userId, $userView));

        $mode = $id == 0 ? 'add' : ($id == 1 ? 'view' : 'edit');
        if ($id != 1) {
            $order = $id != 0 ? Orders::find($id) : null;
            $tp = Patients::find($PID);
            $user = Users::select('id', 'name')->where('status', '0')->orderBy('created_at', 'desc')->get();
        } else {
            $order = Orders::find($PID);
            $tp = Patients::find($order->Patient_ID);
            $user = Users::whereJsonContains('Dept', $tp->Dept)->select('name', 'id')->where('status', '0')->get();
        }

        $code = $id == 0 ? mt_rand(10000, 99999) : $order->Items;
        $OrderItems = $id == 0 ? [] : OrderItems::where('uniqueOrderId', $order->Items)->get();
        $act = $id == 0 ? [] : Activity::where([['PtId', $tp->id], ['OrderID', $order->id]])->select('message', 'name', 'created_at', 'OrderID')->orderBy('created_at', 'desc')->get();
        $da = $id == 0 ? [] : documents::where([['ptName', $tp->id], ['OrderID', $order->id]])->orderBy('created_at', 'desc')->get();
        $not = $id == 0 ? [] : Notes::where([['PtId', $tp->id], ['OrderID', $order->id]])->select('note', 'name', 'created_at')->orderBy('created_at', 'desc')->get();
        $diagnosis = $id == 0 ? null : Diagnosis::where('OrderID', $order->id)->first();
        $comparingDiagnose =  Diagnosis::where('PatientID', $tp->id)->first();
        $PatInsurance =   PatientInsurance::where('PatientID', $tp->id)->select('Company')->get();


        $pati =  Patients::select('id', 'name', 'last_Name')->get();
        $doctor =  Doctors::select('Office_Name', 'id')->get();
        $icd9 = ICDNine::select('Code')->orderBy('created_at', 'desc')->get();
        $icd10 = ICDTen::select('Code')->orderBy('created_at', 'desc')->get();
        $predefinedNotes = PreferredNotes::all();
        $department = Departments::orderBy('created_at', 'desc')->get();
        $inventory = Inventory::select('id', 'Item_Name', 'DiagnoseCode')->orderBy('created_at', 'desc')->get();
        $priceCode = PriceCode::select('Insurance', 'id')->orderBy('created_at', 'desc')->get();
        $taxes = Taxes::select('TotalTax','Name')->orderBy('created_at', 'desc')->get();
        $invoiceForm = InvoiceForm::select('name')->orderBy('created_at', 'desc')->get();
        $DoctorsData = DoctorsData::select('FirstName', 'LastName', 'Phone', 'NPI')->orderBy('created_at', 'desc')->get();
        $warehouse = Warehouse::select('Warehouse_Name')->orderBy('created_at', 'desc')->get();

        return view('AddOrder', compact('drs', 'st', 'noti', 'pt', 'tp', 'act', 'not', 'da', 'pati', 'doctor', 'icd9', 'icd10', 'mode', 'order', 'predefinedNotes', 'department', 'user', 'inventory', 'priceCode', 'taxes', 'invoiceForm', 'OrderItems', 'code', 'diagnosis', 'DoctorsData', 'PatInsurance', 'warehouse', 'comparingDiagnose'));
    }


    public function AddEditOrders(Request $request, $id)
    {

        $validatedData = $request->validate([
            'Patient_ID' => 'required',
            'Patient_Name' => 'required',
            'Patient_Last_Name' => 'required',
            'Address' => 'required',
            'City' => 'required',
            'Account' => 'required',
            'Phone' => 'required',
            'State' => 'required',
            'ZIP' => 'required',
            'Patient_DOB' => 'required',
            'Email' => 'required',
            'OrderStatus' => 'required',
            'Department' => 'required',
            'AssignUser' => 'required',
            'Phone2' => 'required',
            'DrOffice' => 'required',
            'DrPhone' => 'required',
            'DrFax' => 'required',
            'DrNPI' => 'required',
            'OrderType' => 'required',
            'Items' => 'required',
            'SignatureFile' => 'required',
            'MonthsValid' => 'required',
            'block12' => 'required',
            'block13' => 'required',
            'InsuranceEligibility' => 'required',
            'TaxRate' => 'required',
            'OutPocket' => 'required',
            'Basis' => 'required',
            'InvoiceForm' => 'required',
            'SupplierStandards' => 'required',
            'HIPPANote' => 'required',
            'POS' => 'required',
        ], [
            'required' => ':attribute is required',
        ]);
        $wh = $id == 0 ? new Orders() : Orders::find($id);
        if ($id != 0) {
            $wh->updated_at = now();
        } else {
            $wh->CreatedBy = FacadesSession::get('LoginName');
        }
        $wh->fill($validatedData);
        $wh->DrPhone1 = $request->DrPhone1;
        $wh->DrName = $request->DrName;
        $wh->CheckedDate = $request->CheckedDate;
        $wh->LastCheckUser = $request->LastCheckUser;
        $wh->Policy1 = $request->Policy1;
        $wh->Policy2 = $request->Policy2;
        $wh->Policy3 = $request->Policy3;
        $wh->Policy4 = $request->Policy4;
        $wh->eligibilityDetails = $request->eligibilityDetails;

        if ($request->OrderStatus === '13') {
            $wh->Checklist = json_encode($request->options);
        } elseif ($request->OrderStatus === '5') {
            $wh->newFrequency = $request->newFrequency;
            $wh->resupplyDate = $request->resupplyDate;
            $wh->newDept = $request->newDept;
            $wh->newResupplyDate = $request->newResupplyDate;
        }
        $wh->save();





        if (!empty($request->diagnosis_codes)) {
            $diagnosisCodes = explode(',', $request->diagnosis_codes);
            $diagnosisCount = min(count($diagnosisCodes), 12);

            $diagnosis = Diagnosis::firstOrNew([
                'PatientID' => $request->Patient_ID,
                'OrderID' => $wh->id,
            ]);

            foreach (range(1, $diagnosisCount) as $index) {
                $diagnosisField = 'ICD10' . $index;
                $diagnosis->{$diagnosisField} = $diagnosisCodes[$index - 1];
            }

            $diagnosis->save();

            foreach ($diagnosisCodes as $position => $code) {
                OrderItems::where('uniqueOrderId', $request->Items)
                    ->where('uniqueOrderId', $request->Items)
                    ->update(['DXPointer10' => "#" . ($position + 1)]);
            }
        }


        $totalPrice = 0;
        $Orders = Orders::where('Patient_ID', $request->Patient_ID)->select('Items')->orderBy('created_at', 'desc')->get();
        foreach ($Orders as $order) {
            $orderItems = OrderItems::where('uniqueOrderId', $order->Items)->pluck('itemId');
            $prices = PriceCode::whereIn('Item', $orderItems)->pluck('AllowablePrice');
            $totalPrice += $prices->sum();
        }

        $insurancePayment = 0;
        $PatInsurance =  PatientInsurance::where('PatientID', $request->Patient_ID)->select('Company')->orderBy('created_at', 'desc')->get();
        foreach ($PatInsurance as $value) {
            $insuranceCompany = InsuranceCompany::where('Name', $value->Company)->value('Expected');

            if ($insuranceCompany !== null) {
                $insurancePayment += ($totalPrice * $insuranceCompany) / 100;
            }
        }

        $patientBalance = $totalPrice - $insurancePayment;

        // $pat = Patients::find($request->Patient_ID);
        // $pat->TotalBalance = $totalPrice;
        // $pat->PatientBalance = $patientBalance;
        // $pat->InsBalance = $insurancePayment;
        // $pat->save();

        // $this->addEligibilityNote($request,$wh);

        $soldItems = OrderItems::where('uniqueOrderId', $request->Items)->get(['itemId', 'item', 'id']);
        $this->updateInventory($soldItems, $request->OrderType);

        $previousUrl = $request->input('previous_url');
        if (Str::contains($previousUrl, '/PatientDetail')) {
            return redirect()->to($previousUrl)->with('success', 'Patient updated successfully.');
        } else {
            return redirect()->to('/')->with('success', 'Patient updated successfully.');
        }
    }

    public function addEligibilityNote($request, $wh)
    {
        $no = new Notes();
        $no->name = FacadesSession::get('LoginName');
        $no->PtId = $request->Patient_ID;

        $eligibilityDetails = $request->input('eligibilityDetails');

        $no->note = $eligibilityDetails;
        $no->OrderID = $wh->id;
        $no->save();
    }

    public function updatePatientAmount(Request $request, $id)
    {
        $tp = Patients::find($id);
        $tp->TotalBalance = $request->Balance;
        $tp->PatientBalance = $request->Customer;
        $tp->InsBalance = $request->InsBalance;
        $tp->Total = $request->Total;
        $tp->save();
        return back()->with('success', 'Saved');
    }

    protected function updateInventory($orderItems, $orderType)
    {
        $itemNames = $orderItems->pluck('item');
        $inventoryUpdates = Inventory::whereIn('Item_Name', $itemNames)->get();
        $inventoryMap = $inventoryUpdates->keyBy('Item_Name');

        $now = Carbon::now()->toDateTimeString();

        foreach ($orderItems as $orderItem) {
            $soldItems = OrderItems::find($orderItem->id);
            if ($soldItems->inventory_updated == "true") {
                continue;
            }

            $inventoryUpdate = $inventoryMap[$orderItem->item] ?? null;

            if ($inventoryUpdate) {
                $inventoryUpdate->updated_at = $now;

                if (strpos(strtolower($orderType), 'rental') !== false) {
                    $inventoryUpdate->Rental = $inventoryUpdate->Rental ? $inventoryUpdate->Rental + 1 : 1;
                } else {
                    $inventoryUpdate->Sold = $inventoryUpdate->Sold ? $inventoryUpdate->Sold + 1 : 1;
                }

                $inventoryUpdate->InStockQty = max(0, $inventoryUpdate->InStockQty - 1);
            }
            $soldItems->inventory_updated = "true";
            $soldItems->save();
        }

        $upsertData = $inventoryUpdates->map(function ($item) {
            return [
                'id' => $item->id,
                'Sold' => $item->Sold,
                'Rental' => $item->Rental,
                'InStockQty' => $item->InStockQty,
                'TotalSellItems' => $item->sold,
                'updated_at' => $item->updated_at,
            ];
        })->values()->toArray();

        Inventory::upsert(
            $upsertData,
            ['id'],
            ['Sold', 'Rental', 'InStockQty', 'updated_at']
        );
    }

    public function AddBatch($oid, $pid)
    {
        $already = Batches::where('OrderID', $oid)->where('BatchStatus', 'Temporary')->exists();

        if (!$already) {
            $order = Orders::find($oid)->Items;
            $orderItem = OrderItems::where('uniqueOrderId', $order)->first();

            $batchNumber = Batches::where('BatchStatus', 'Temporary')->pluck('BatchNumber')->first();
            $batch = new Batches();
            $batch->OrderID = $oid;
            $batch->PatientID = $pid;
            $batch->BatchNumber = $batchNumber ?  $batchNumber : mt_rand(10000, 99999);
            $batch->Status = "Temporary";
            $batch->Created = FacadesSession::get('LoginName');
            $batch->BatchStatus = "Temporary";
            $batch->Item = $orderItem->itemId;
            $batch->Balance = $orderItem->AllowablePrice;
            $batch->InvoiceDate = now();
            $batch->HAO = $orderItem->HAO;
            $batch->BillingCode = $orderItem->Bill_Billable_Code;
            $batch->PriorAuth = $orderItem->PriorAuthNo;
            $batch->PriorAuthType = $orderItem->PriorAuthType;
            $batch->Modifier1 = $orderItem->modifier1;
            $batch->Modifier2 = $orderItem->modifier2;
            $batch->Modifier3 = $orderItem->modifier3;
            $batch->Modifier4 = $orderItem->modifier4;
            $batch->From = $orderItem->DOSFrom;
            $batch->To = $orderItem->DOSTo;
            $batch->BillingMonth = $orderItem->DOSBillingMonth;
            $batch->BillableAmount = $orderItem->Billable_Price;
            $batch->AllowedAmount = $orderItem->AllowablePrice;
            $batch->Quantity = $orderItem->Quantity;
            $batch->Taxes = $orderItem->Taxable;
            $batch->Ins1 = $orderItem->Ins1;
            $batch->Ins2 = $orderItem->Ins2;
            $batch->Ins3 = $orderItem->Ins3;
            $batch->Ins4 = $orderItem->Ins4;
            $batch->NoPay = $orderItem->noIns1;
            $batch->Dx10 = $orderItem->DXPointer10;
            $batch->CMNRX = $orderItem->CMN;
            $batch->save();

            $transaction =  new Transaction();
            $transaction->Company = "Patient";
            $transaction->InvoiceNumber = $batch->id;
            $transaction->Tran = "Pending Submission";
            $transaction->Transaction = now();
            $transaction->Amount = $orderItem->AllowablePrice;
            $transaction->Quantity = $orderItem->Quantity;
            $transaction->Taxes = $orderItem->Taxable;
            $transaction->Billable         = $orderItem->Billable_Price;
            $transaction->Allowable         = $orderItem->AllowablePrice;
            $transaction->Balance        = $orderItem->Billable_Price;
            $transaction->Actual         = $orderItem->Billable_Price;
            $transaction->save();

            return back()->with('success', 'Saved');
        }
        return back()->with('success', 'Saved');
    }



    public function saveOrderItem(Request $request, $id = null)
    {
        // Validate incoming request
        $validatedData = $request->validate([
            'item' => 'required',
            'itemId' => 'required',
            'uniqueOrderId' => 'required',
            'patientID' => 'required',
            'warehouse' => 'required',
            'priceCode' => 'required',
            'Type' => 'required',
            'DXPointer10' => 'required',
        ], [
            'required' => ':attribute is required',
        ]);

        if ($id) {
            $POI = OrderItems::find($id);
            if (!$POI) {
                return response()->json(['error' => 'Order item not found'], 404);
            }
        } else {
            $POI = new OrderItems();
        }

        $priceCodeItem = PriceCode::findOrFail($validatedData["priceCode"]);
        $POI = new OrderItems();
        $validatedData["priceCode"] = $priceCodeItem->Insurance;

        $POI->fill($validatedData);

        $POI->fill([
            'Bill_Billable_Code' => $priceCodeItem->Bill_Billable_Code,
            'price_Code' => $priceCodeItem->price_Code,
            'modifier1' => $priceCodeItem->modifier1,
            'modifier2' => $priceCodeItem->modifier2,
            'modifier3' => $priceCodeItem->modifier3,
            'modifier4' => $priceCodeItem->modifier4,
            'RentalType' => $priceCodeItem->RentalType,
            'Billable_Price' => $priceCodeItem->Billable_Price,
            'AllowablePrice' => $priceCodeItem->AllowablePrice,
            'Taxable' => $request->Taxable,
            'Quantity' => $priceCodeItem->Quantity,
            'Units' => $priceCodeItem->Units,
            'BQuantity' => $priceCodeItem->BQuantity,
            'BUnits' => $priceCodeItem->BUnits,
            'DQuantity' => $priceCodeItem->DQuantity,
            'DUnits' =>  $priceCodeItem->DUnits,
            'PriorAuth' => $priceCodeItem->PriorAuth,
            'AcceptAssignment' => $priceCodeItem->AcceptAssignment,
            'BillItem' => $request->input('BillItem'),
            'ins1' => $request->input('ins1'),
            'ins2' => $request->input('ins2'),
            'ins3' => $request->input('ins3'),
            'ins4' => $request->input('ins4'),
            'noIns1' => $request->input('noIns1'),
            'HAO' => $request->input('HAO'),
            'Serial' => $request->input('Serial'),
            'invoice' => $request->input('invoice'),
        ]);


        $POI->save();

        return response()->json(['item' => $POI, 'message' => 'Item saved successfully!']);
    }

    public function updateOrderItem(Request $request, $id)
    {
        $item = OrderItems::find($id);

        if (!$item) {
            return response()->json(['message' => 'Item not found'], 404);
        }

        $item->update([
            'item' => $request->input('InvItem'),
            'warehouse' => $request->input('Warehouse'),
            'priceCode' => $request->input('priceCode'),
            'Bill_Billable_Code' => $request->input('BillingCode'),
            'Type' => $request->input('SellType'),
            'modifier1' => $request->input('modifier1'),
            'modifier2' => $request->input('modifier2'),
            'modifier3' => $request->input('modifier3'),
            'modifier4' => $request->input('modifier4'),
            'RentalType' => $request->input('SellType'),
            'Billable_Price' => $request->input('Billable'),
            'AllowablePrice' => $request->input('Allowable'),
            'Taxable' => $request->input('Taxable'),
            'Quantity' => $request->input('Quantity'),
            'Units' => $request->input('QuantityUnits'),
            'PriorAuth' => $request->input('PriorAuth'),
            'PriorAuthExpiry' => $request->input('PriorAuthExp'),
            'RXExp' => $request->input('RXExp'),
            'DOSFrom' => $request->input('DOSFrom'),
            'DOSTo' => $request->input('DOSTo'),
            'DOSBillingMonth' => $request->input('BillingMonth'),
            'ins1' => $request->input('Ins1'),
            'ins2' => $request->input('Ins2'),
            'ins3' => $request->input('Ins3'),
            'ins4' => $request->input('Ins4'),
            'noIns1' => $request->input('NoPayIns1'),
            'HAO' => $request->input('HAO'),
            'Serial' => $request->input('Serial'),
            'BillItem' => $request->input('BillItem'),
            'PriorAuth' => $request->input('PriorAuth'),
            'PriorAuthType' => $request->input('PriorAuthType'),
            'invoice' => $request->input('invoice'),
            'DXPointer10' => $request->input('DXPointer10'),
            'BOrderType' => $request->input('BOrderType'),
            'QuantityOrderType' => $request->input('QuantityOrderType'),
            'RentalType' => $request->input('SellType'),

        ]);

        $item->save();

        return response()->json(['message' => 'Item updated successfully', 'item' => $request], 200);
    }

    public function getOrderItemDetails($id)
    {
        $orderItem = OrderItems::find($id);
        $serialNumbers = SerialNumber::where('InventoryCode', $orderItem->item)->pluck('SerialNumber');

        return response()->json([
            'orderItem' => $orderItem,
            'serialNumbers' => $serialNumbers
        ]);
    }

    public function UpdateOrder(Request $request, $id)
    {

        $validatedData = $request->validate([
            'OrderStatus' => 'required',
            'Department' => 'required',
            'AssignUser' => 'required',
        ], [
            'required' => ':attribute is required',
        ]);

        $message = "";
        $ord = Orders::find($id);
        if ($ord->Department != $request->Department) {
            $previousDept = Departments::findOrFail($ord->Department);
            $newDept = Departments::findOrFail($request->input('Department'));
            $message .= "Changed Department from {$previousDept->Department} to {$newDept->Department}. ";
        }

        if ($ord->OrderStatus != $request->OrderStatus) {
            $previousStatusName = Status::where('id', $ord->OrderStatus)->pluck('Status')->first();
            $newStatusName = Status::where('id', $request->input('OrderStatus'))->pluck('Status')->first();
            $message .= "Changed Order Status from {$previousStatusName} to {$newStatusName}. ";
        }

        if ($ord->AssignUser != $request->AssignUser) {
            $previousUser = Users::find($ord->AssignUser);
            $newUser = Users::findOrFail($request->input('AssignUser'));
            $message .= "Changed Assigned User from {$previousUser->name} to {$newUser->name}. ";
        }

        if (!empty($message)) {
            $this->orderHistory($ord->Patient_ID, trim($message), $ord->id);
        }


        if ($request->OrderStatus === '13') {
            $ord->Checklist = json_encode($request->options);
        } elseif ($request->OrderStatus === '5') {
            $ord->newFrequency = $request->newFrequency;
            $ord->resupplyDate = $request->resupplyDate;
            $ord->newDept = $request->newDept;
            $ord->newResupplyDate = $request->newResupplyDate;
        }
        $ord->fill($validatedData);

        $ord->updated_at = now();
        $ord->save();

        $previousUrl = $request->input('previous_url');
        if (Str::contains($previousUrl, '/AddOrders') || Str::contains($previousUrl, '/PatientDetail')) {
            return redirect()->to($previousUrl)->with('success', 'Order updated successfully.');
        } else {
            return redirect()->to('/')->with('success', 'Order updated successfully.');
        }
    }

    public function AddDiagnosis(Request $request)
    {
        $ord = Diagnosis::firstOrNew(['PatientID' => $request->Patient_ID], ['OrderID' => $request->OrderID]);
        $isNew = !$ord->exists;

        $ord->fill($request->all());
        $ord->PatientID = $request->Patient_ID;
        $ord->updated_at = now();
        $ord->save();

        // $order = Orders::where('OrderID', $request->OrderID)->get();
        $message = $isNew ? "Diagnosis Added" : "Diagnosis Updated";

        $this->orderHistory($request->Patient_ID, trim($message), $request->OrderID);

        $previousUrl = $request->input('previous_url');
        if (Str::contains($previousUrl, '/AddOrders') || Str::contains($previousUrl, '/PatientDetail')) {
            return redirect()->to($previousUrl)->with('success', 'Order updated successfully.');
        } else {
            return redirect()->to('/')->with('success', 'Order updated successfully.');
        }
    }
    public function orderHistory($id, $message, $OID)
    {
        $activity = new Activity();
        $activity->PtId = $id;
        $activity->OrderID = $OID;
        $activity->name = FacadesSession::get('LoginName');
        $activity->message = $message;
        $activity->save();
    }

    public function deleteOrderItem($id)
    {
        $item = OrderItems::find($id);
        if ($item) {
            $item->delete();
            return response()->json(['success' => true, 'message' => 'Item deleted successfully!']);
        }
        return response()->json(['success' => false, 'message' => 'Item not found!']);
    }

    public function DeleteOrders($id)
    {
        $wh = Orders::findOrNew($id);
        $wh->delete();
        return back();
    }

    // Orders end

    // PatientInsurance Start

    public function AddPatientInsurance($PID, $id)
    {
        $userId = FacadesSession::get('LoginId');
        $userView = FacadesSession::get('LoginViewCheck');
        extract(Patients::fetchPatients($userId, $userView));
        $PatInsurance = $id != 0 ? PatientInsurance::find($id) : null;
        $insurance = InsuranceCompany::select('Name')->orderBy('created_at', 'desc')->get();
        $InsuranceType = InsuranceType::select('Code')->orderBy('created_at', 'desc')->get();
        return view('AddEditPatientInsurance', compact('drs', 'st', 'noti', 'pt', 'PatInsurance', 'PID', 'insurance', 'InsuranceType'));
    }

    public function DeletePatientInsurance($id)
    {
        $wh = PatientInsurance::find($id);
        $wh->delete();
        return back();
    }

    public function AddEditPatientInsurance(Request $request, $id)
    {
        $commonRules = [
            'Policy' => 'required',
            'PatientID' => 'required',
            'Group' => 'required',
            'Company' => 'required',
            'Type' => 'required',
            'Insured' => 'required',
            'Payment' => 'required',
            'Eligibility' => 'required',
            'Basis' => 'required',
            'Inactive' => 'required',
            'EligibilityRequested' => 'required',
        ];

        if ($request->Insured != 'Self') {
            $extraRules = [
                'First' => 'required',
                'Last' => 'required',
                'DOB' => 'required',
                'City' => 'required',
                'State' => 'required',
                'ZIP' => 'required',
                'MI' => 'required',
                'Suffix' => 'required',
                'Gender' => 'required',
                'Address' => 'required',
                'Phone' => 'required',
                'Mobile' => 'required',
            ];
            $commonRules = array_merge($commonRules, $extraRules);
        }

        $validatedData = $request->validate($commonRules, [
            'required' => ':attribute is required',
        ]);

        $wh = $id == 0 ? new PatientInsurance() : PatientInsurance::findOrFail($id);

        $wh->fill($validatedData);
        $wh->updated_at = now();
        $wh->save();

        $previousUrl = $request->input('previous_url');

        if (Str::contains($previousUrl, '/PatientDetail')) {
            return redirect()->to($previousUrl)->with('success', 'Patient updated successfully.');
        } else {
            return redirect()->to('/')->with('success', 'Patient updated successfully.');
        }
    }

    // PatientInsurance end


    // Vendor Start
    public function VendorList()
    {
        $userId = FacadesSession::get('LoginId');
        $userView = FacadesSession::get('LoginViewCheck');
        extract(Patients::fetchPatients($userId, $userView));
        $vendor = Vendor::select('id', 'Account', 'Vendor_Name', 'Address', 'City', 'State', 'Zip', 'Contact')->orderBy('created_at', 'desc')->get();
        return view('Vendors', compact('drs', 'st', 'noti', 'pt', 'vendor'));
    }

    public function AddVendor($id)
    {
        $userId = FacadesSession::get('LoginId');
        $userView = FacadesSession::get('LoginViewCheck');
        extract(Patients::fetchPatients($userId, $userView));
        $vendor = $id != 0 ? Vendor::find($id) : null;
        return view('AddVendor', compact('drs', 'st', 'noti', 'pt', 'vendor'));
    }

    public function DeleteVendor($id)
    {
        $wh = Vendor::findOrNew($id);
        $wh->delete();
        return back();
    }

    public function AddEditVendor(Request $request, $id)
    {
        $validatedData = $request->validate([
            'Fax' => 'required',
            'Phone2' => 'required',
            'Phone' => 'required',
            'Zip' => 'required',
            'State' => 'required',
            'City' => 'required',
            'Address' => 'required',
            'Account' => 'required',
            'Contact' => 'required',
            'Vendor_Name' => 'required',
        ], [
            'required' => ':attribute is required',
        ]);
        $wh = $id == 0 ? new Vendor() : Vendor::find($id);
        if ($id != 0) {
            $wh->updated_at = now();
        }
        $wh->fill($validatedData);
        $wh->save();
        return redirect('VendorList')->with('success', 'Saved Successfully');
    }

    // Vendor end

    // Warehouse Start

    public function WarehouseList()
    {
        $userId = FacadesSession::get('LoginId');
        $userView = FacadesSession::get('LoginViewCheck');
        extract(Patients::fetchPatients($userId, $userView));
        $warehouse = Warehouse::orderBy('created_at', 'desc')->get();
        return view('Warehouse', compact('drs', 'st', 'noti', 'pt', 'warehouse'));
    }

    public function AddWarehouse($id)
    {
        $userId = FacadesSession::get('LoginId');
        $userView = FacadesSession::get('LoginViewCheck');
        extract(Patients::fetchPatients($userId, $userView));
        $warehouse = $id != 0 ?  Warehouse::findOrFail($id) : null;
        return view('AddWarehouse', compact('drs', 'st', 'noti', 'pt', 'warehouse'));
    }

    public function DeleteWarehouseData($id)
    {
        $wh = Warehouse::findOrNew($id);
        $wh->delete();
        return back();
    }

    public function AddEditWarehouse(Request $request, $id)
    {
        $validatedData = $request->validate([
            'Fax' => 'required',
            'Phone2' => 'required',
            'Phone' => 'required',
            'Zip' => 'required',
            'State' => 'required',
            'City' => 'required',
            'Contact' => 'required',
            'State' => 'required',
            'Warehouse_Name' => 'required',
            'Address' => 'required',
        ], [
            'required' => ':attribute is required',
        ]);
        $wh = $id == 0 ? new Warehouse() : Warehouse::find($id);
        if ($id != 0) {
            $wh->updated_at = now();
        }
        $wh->fill($validatedData);
        $wh->save();
        return redirect('WarehouseList')->with('success', 'Saved Successfully');
    }

    // Warehouse end

    // ICD Ten Start

    public function ICDTenList()
    {
        $userId = FacadesSession::get('LoginId');
        $userView = FacadesSession::get('LoginViewCheck');
        extract(Patients::fetchPatients($userId, $userView));
        $insurance = ICDTen::select('id', 'Description', 'Code')->orderBy('created_at', 'desc')->get();
        return view('ICDTenList', compact('drs', 'st', 'noti', 'pt', 'insurance'));
    }

    public function DeleteICDTen($id)
    {
        $ins = ICDTen::find($id);
        $ins->delete();
        return back();
    }

    public function AddICDTen($id)
    {
        $userId = FacadesSession::get('LoginId');
        $userView = FacadesSession::get('LoginViewCheck');
        extract(Patients::fetchPatients($userId, $userView));
        $insurance = $id != 0 ? ICDTen::find($id) : null;
        return view('AddICDTen', compact('drs', 'st', 'noti', 'pt', 'insurance'));
    }

    public function AddEditICDTen(Request $request, $id)
    {
        $validatedData = $request->validate([
            'Code' => 'required',
            'Description' => 'required',
        ], [
            'required' => ':attribute is required',
        ]);

        $ins = $id == 0 ? new ICDTen() : ICDTen::find($id);

        if ($id != 0) {
            $ins->updated_at = now();
        }

        $ins->fill($validatedData);
        $ins->save();

        return redirect('ICDTenList')->with('success', 'Saved Successfully');
    }
    // ICD Ten end

    // ICD Nine Start

    public function ICDNineList()
    {
        $userId = FacadesSession::get('LoginId');
        $userView = FacadesSession::get('LoginViewCheck');
        extract(Patients::fetchPatients($userId, $userView));
        $insurance = ICDNine::select('id', 'Description', 'Code')->orderBy('created_at', 'desc')->get();
        return view('ICDNine', compact('drs', 'st', 'noti', 'pt', 'insurance'));
    }

    public function DeleteICDNine($id)
    {
        $ins = ICDNine::find($id);
        $ins->delete();
        return back();
    }

    public function AddICDNine($id)
    {
        $userId = FacadesSession::get('LoginId');
        $userView = FacadesSession::get('LoginViewCheck');
        extract(Patients::fetchPatients($userId, $userView));
        $insurance = $id != 0 ? ICDNine::find($id) : null;
        return view('AddICDNine', compact('drs', 'st', 'noti', 'pt', 'insurance'));
    }

    public function AddEditICDNine(Request $request, $id)
    {
        $validatedData = $request->validate([
            'Code' => 'required',
            'Description' => 'required',
        ], [
            'required' => ':attribute is required',
        ]);

        $ins = $id == 0 ? new ICDNine() : ICDNine::find($id);

        if ($id != 0) {
            $ins->updated_at = now();
        }

        $ins->fill($validatedData);
        $ins->save();

        return redirect('ICDNineList')->with('success', 'Saved Successfully');
    }
    // ICD 9 end

    // Insurance Company Start

    public function InsuranceCompanyList()
    {
        $userId = FacadesSession::get('LoginId');
        $userView = FacadesSession::get('LoginViewCheck');
        extract(Patients::fetchPatients($userId, $userView));
        $insurance = InsuranceCompany::select('id', 'address', 'Name', 'ContactName')->orderBy('created_at', 'desc')->get();
        return view('InsuranceCompany', compact('drs', 'st', 'noti', 'pt', 'insurance'));
    }

    public function DeleteInsuranceCompany($id)
    {
        $ins = InsuranceCompany::find($id);
        $ins->delete();
        return back();
    }

    public function AddInsuranceCompany($id)
    {
        $userId = FacadesSession::get('LoginId');
        $userView = FacadesSession::get('LoginViewCheck');
        extract(Patients::fetchPatients($userId, $userView));
        $insurance = $id != 0 ? InsuranceCompany::find($id) : null;

        $priceCode = PriceCode::select('Item')->orderBy('created_at', 'desc')->get();
        $insuranceGroup = InsuranceGroup::select('name')->orderBy('created_at', 'desc')->get();
        $InvoiceForm = InvoiceForm::select('name')->orderBy('created_at', 'desc')->get();
        $AbilityPayer = AbilityPayer::select('Code')->orderBy('created_at', 'desc')->get();

        return view('AddInsurance', compact('drs', 'st', 'noti', 'pt', 'insurance', 'priceCode', 'insuranceGroup', 'InvoiceForm', 'AbilityPayer'));
    }

    public function AddEditInsuranceCompany(Request $request, $id)
    {
        $validatedData = $request->validate([
            'AbilityPayer' => 'required',
            'Prefix' => 'required',
            'TaxonomyCode' => 'required',
            'RenderingPhysician' => 'required',
            'ReferingPhysician' => 'required',
            'OrderingPhysician' => 'required',
            'ParticipatingProvider' => 'required',
            'Zirmed' => 'required',
            'OfficeAlly' => 'required',
            'Medicare' => 'required',
            'Medicaid' => 'required',
            'ClaimMD' => 'required',
            'Availability' => 'required',
            'Ability' => 'required',
            'ECSFormat' => 'required',
            'Invoice' => 'required',
            'Group' => 'required',
            'Type' => 'required',
            'HAOCodeInvoice' => 'required',
            'InventoryInvoice' => 'required',
            'Bill' => 'required',
            'Expected' => 'required',
            'PriceCode' => 'required',
            'ContactName' => 'required',
            'Phone2' => 'required',
            'Phone' => 'required',
            'address' => 'required',
            'Name' => 'required',
            'Fax' => 'required'
        ], [
            'required' => ':attribute is required',
        ]);

        $ins = $id == 0 ? new InsuranceCompany() : InsuranceCompany::find($id);

        if ($id != 0) {
            $ins->updated_at = now();
        }

        $ins->fill($validatedData);
        $ins->save();

        return redirect('InsuranceCompanyList')->with('success', 'Saved Successfully');
    }
    // Insurance Company end

    // Insurance Type Start

    public function InsuranceTypeList()
    {
        $userId = FacadesSession::get('LoginId');
        $userView = FacadesSession::get('LoginViewCheck');
        extract(Patients::fetchPatients($userId, $userView));
        $insurance = InsuranceType::select('id', 'Description', 'Code')->orderBy('created_at', 'desc')->get();
        return view('InsuranceTypeList', compact('drs', 'st', 'noti', 'pt', 'insurance'));
    }

    public function DeleteInsuranceType($id)
    {
        $ins = InsuranceType::find($id);
        $ins->delete();
        return back();
    }

    public function AddInsuranceType($id)
    {
        $userId = FacadesSession::get('LoginId');
        $userView = FacadesSession::get('LoginViewCheck');
        extract(Patients::fetchPatients($userId, $userView));
        $insurance = $id != 0 ? InsuranceType::find($id) : null;
        return view('AddInsuranceType', compact('drs', 'st', 'noti', 'pt', 'insurance'));
    }

    public function AddEditInsuranceType(Request $request, $id)
    {
        $validatedData = $request->validate([
            'Code' => 'required',
            'Description' => 'required',
        ], [
            'required' => ':attribute is required',
        ]);

        $ins = $id == 0 ? new InsuranceType() : InsuranceType::find($id);

        if ($id != 0) {
            $ins->updated_at = now();
        }

        $ins->fill($validatedData);
        $ins->save();

        return redirect('InsuranceTypeList')->with('success', 'Saved Successfully');
    }

    // Insurance Type end

    // Form POS Type Start

    public function FormPOSTypeList()
    {
        $userId = FacadesSession::get('LoginId');
        $userView = FacadesSession::get('LoginViewCheck');
        extract(Patients::fetchPatients($userId, $userView));
        $insurance = FormPOSType::select('id', 'Description', 'Code')->orderBy('created_at', 'desc')->get();
        return view('FormPOSTypeList', compact('drs', 'st', 'noti', 'pt', 'insurance'));
    }

    public function DeleteFormPOSType($id)
    {
        $ins = FormPOSType::find($id);
        $ins->delete();
        return back();
    }

    public function AddFormPOSType($id)
    {
        $userId = FacadesSession::get('LoginId');
        $userView = FacadesSession::get('LoginViewCheck');
        extract(Patients::fetchPatients($userId, $userView));
        $insurance = $id != 0 ? FormPOSType::find($id) : null;
        return view('AddFormPOSType', compact('drs', 'st', 'noti', 'pt', 'insurance'));
    }

    public function AddEditFormPOSType(Request $request, $id)
    {
        $validatedData = $request->validate([
            'Code' => 'required',
            'Description' => 'required',
        ], [
            'required' => ':attribute is required',
        ]);

        $ins = $id == 0 ? new FormPOSType() : FormPOSType::find($id);

        if ($id != 0) {
            $ins->updated_at = now();
        }

        $ins->fill($validatedData);
        $ins->save();

        return redirect('FormPOSTypeList')->with('success', 'Saved Successfully');
    }

    // Form POS Type Payer end

    // Insurance Ability Payer Start

    public function AbilityPayerList()
    {
        $userId = FacadesSession::get('LoginId');
        $userView = FacadesSession::get('LoginViewCheck');
        extract(Patients::fetchPatients($userId, $userView));
        $insurance = AbilityPayer::select('id', 'name', 'Comment', 'Code')->orderBy('created_at', 'desc')->get();
        return view('AbilityPayerList', compact('drs', 'st', 'noti', 'pt', 'insurance'));
    }

    public function DeleteAbilityPayer($id)
    {
        $ins = InvoiceForm::find($id);
        $ins->delete();
        return back();
    }

    public function AddAbilityPayer($id)
    {
        $userId = FacadesSession::get('LoginId');
        $userView = FacadesSession::get('LoginViewCheck');
        extract(Patients::fetchPatients($userId, $userView));
        $insurance = $id != 0 ? AbilityPayer::find($id) : null;
        return view('AddAbilityPayer', compact('drs', 'st', 'noti', 'pt', 'insurance'));
    }

    public function AddEditAbilityPayer(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'Code' => 'required',
            'Comment' => 'required',
        ], [
            'required' => ':attribute is required',
        ]);

        $ins = $id == 0 ? new AbilityPayer() : AbilityPayer::find($id);

        if ($id != 0) {
            $ins->updated_at = now();
        }

        $ins->fill($validatedData);
        $ins->save();

        return redirect('AbilityPayerList')->with('success', 'Saved Successfully');
    }
    // Insurance Ability Payer end

    // Insurance Invoice Form Start

    public function InvoiceFormList()
    {
        $userId = FacadesSession::get('LoginId');
        $userView = FacadesSession::get('LoginViewCheck');
        extract(Patients::fetchPatients($userId, $userView));
        $insurance = InvoiceForm::select('id', 'name', 'CR_File_Name')->orderBy('created_at', 'desc')->get();
        return view('InvoiceFormList', compact('drs', 'st', 'noti', 'pt', 'insurance'));
    }

    public function DeleteInvoiceForm($id)
    {
        $ins = InvoiceForm::find($id);
        $ins->delete();
        return back();
    }

    public function AddInvoiceForm($id)
    {
        $userId = FacadesSession::get('LoginId');
        $userView = FacadesSession::get('LoginViewCheck');
        extract(Patients::fetchPatients($userId, $userView));
        $insurance = $id != 0 ? InvoiceForm::find($id) : null;
        return view('AddInvoiceForm', compact('drs', 'st', 'noti', 'pt', 'insurance'));
    }

    public function AddEditInvoiceForm(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'CR_File_Name' => 'required',
            'Special_Coding' => 'required',
            'Right' => 'required',
            'Left' => 'required',
            'Bottom' => 'required',
            'Top' => 'required',
        ], [
            'required' => ':attribute is required',
        ]);

        $ins = $id == 0 ? new InvoiceForm() : InvoiceForm::find($id);

        if ($id != 0) {
            $ins->updated_at = now();
        }

        $ins->fill($validatedData);
        $ins->save();

        return redirect('InvoiceFormList')->with('success', 'Saved Successfully');
    }
    // Invoice Form end

    // Insurance Company  Group Start

    public function InsuranceGroupList()
    {
        $userId = FacadesSession::get('LoginId');
        $userView = FacadesSession::get('LoginViewCheck');
        extract(Patients::fetchPatients($userId, $userView));
        $insurance = InsuranceGroup::select('id', 'name')->orderBy('created_at', 'desc')->get();
        return view('InsuranceGroupList', compact('drs', 'st', 'noti', 'pt', 'insurance'));
    }

    public function DeleteInsuranceGroup($id)
    {
        $ins = InsuranceGroup::find($id);
        $ins->delete();
        return back();
    }

    public function AddInsuranceGroup($id)
    {
        $userId = FacadesSession::get('LoginId');
        $userView = FacadesSession::get('LoginViewCheck');
        extract(Patients::fetchPatients($userId, $userView));
        $insurance = $id != 0 ? InsuranceGroup::find($id) : null;

        return view('AddInsuranceGroup', compact('drs', 'st', 'noti', 'pt', 'insurance'));
    }

    public function AddEditInsuranceGroup(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required',
        ], [
            'required' => ':attribute is required',
        ]);

        $ins = $id == 0 ? new InsuranceGroup() : InsuranceGroup::find($id);

        if ($id != 0) {
            $ins->updated_at = now();
        }

        $ins->fill($validatedData);
        $ins->save();

        return redirect('InsuranceGroupList')->with('success', 'Saved Successfully');
    }
    // Insurance Group end

    // Manufacturer Start

    public function ManufacturerList()
    {
        $userId = FacadesSession::get('LoginId');
        $userView = FacadesSession::get('LoginViewCheck');
        extract(Patients::fetchPatients($userId, $userView));
        $manufacture = Manufacture::select('id', 'Account', 'Manufacture_Name', 'Address', 'City', 'State')->orderBy('created_at', 'desc')->get();
        return view('Manufacturers', compact('drs', 'st', 'noti', 'pt', 'manufacture'));
    }

    public function AddManufacturer($id)
    {
        $userId = FacadesSession::get('LoginId');
        $userView = FacadesSession::get('LoginViewCheck');
        extract(Patients::fetchPatients($userId, $userView));
        $manufacture = $id != 0 ? Manufacture::find($id) : null;
        return view('AddManufacturer', compact('drs', 'st', 'noti', 'pt', 'manufacture'));
    }

    public function AddEditManufacturer(Request $request, $id)
    {
        $validatedData = $request->validate([
            'Phone2' => 'required',
            'Phone' => 'required',
            'Zip' => 'required',
            'State' => 'required',
            'City' => 'required',
            'Address' => 'required',
            'Account' => 'required',
            'Contact' => 'required',
            'Manufacture_Name' => 'required',
            'Fax' => 'required'
        ], [
            'required' => ':attribute is required',
        ]);

        $manu = $id == 0 ? new Manufacture() : Manufacture::find($id);

        if ($id != 0) {
            $manu->updated_at = now();
        }

        $manu->fill($validatedData);
        $manu->save();

        return redirect('ManufacturerList')->with('success', 'Saved Successfully');
    }

    public function DeleteManufacturer($id)
    {
        $manu = Manufacture::find($id);
        $manu->delete();
        return back();
    }

    // Insurance Company end

    // InvoicesList Start

    public function InvoicesList()
    {
        $userId = FacadesSession::get('LoginId');
        $userView = FacadesSession::get('LoginViewCheck');
        extract(Patients::fetchPatients($userId, $userView));
        $invoice = Batches::select('id', 'OrderID', 'created_at', 'Status', 'Created', 'ins1', 'ins2', 'ins3', 'ins4', 'PatientID', 'Item')->orderBy('created_at', 'desc')->get();
        return view('Invoices', compact('drs', 'st', 'noti', 'pt', 'invoice'));
    }

    public function PendingInvoicesList()
    {
        $userId = FacadesSession::get('LoginId');
        $userView = FacadesSession::get('LoginViewCheck');
        extract(Patients::fetchPatients($userId, $userView));
        $invoice = Batches::select('id', 'OrderID', 'created_at', 'Status', 'Created', 'ins1', 'ins2', 'ins3', 'ins4', 'PatientID', 'Item')->orderBy('created_at', 'desc')->get();
        return view('Invoices', compact('drs', 'st', 'noti', 'pt', 'invoice'));
    }

    public function InvoiceDetail($id)
    {
        $userId = FacadesSession::get('LoginId');
        $userView = FacadesSession::get('LoginViewCheck');
        extract(Patients::fetchPatients($userId, $userView));
        $invoiceDetail = Batches::find($id);
        $itemName = Inventory::find($invoiceDetail->Item)?->Item_Name ?? null;
        $transactions = Transaction::where('InvoiceNumber', $id)->get();
        return view('InvoiceDetail', compact('drs', 'st', 'noti', 'pt', 'invoiceDetail', 'itemName', 'transactions'));
    }

    public function updateInvoiceDetail(Request $request, $id)
    {
        $invoiceDetail = Batches::find($id);
        $invoiceDetail->fill($request->all());
        $invoiceDetail->save();
        return Redirect::to('InvoicesList')->with('success', 'Saved Successfully');
    }

    public function NewPayment($id, $status)
    {
        $userId = FacadesSession::get('LoginId');
        $userView = FacadesSession::get('LoginViewCheck');
        extract(Patients::fetchPatients($userId, $userView));
        $transaction = $status == 0 ? null : Transaction::find($status);
        $invNumber = $id;
        $batch = Batches::find($id)->PatientID;
        $patInsurance = PatientInsurance::where('PatientID',$batch)->select('Company')->orderBy('created_at', 'desc')->get();
        $amounts  = Transaction::where('InvoiceNumber',$invNumber)->select('Billable','Allowable','Balance','Expected','Actual')->orderBy('created_at', 'desc')->first(); 
       
        return view('NewPayment', compact('drs', 'st', 'noti', 'pt', 'transaction', 'invNumber','amounts','patInsurance'));
    }

    public function InvoiceTransaction($id, $status, $for)
    {
        $userId = FacadesSession::get('LoginId');
        $userView = FacadesSession::get('LoginViewCheck');
        extract(Patients::fetchPatients($userId, $userView));
        $invNumber = $id;
        return view('InvoiceTransaction', compact('drs', 'st', 'noti', 'pt', 'for', 'invNumber'));
    }

    public function StoreTransaction(Request $request, $id)
    {
        $amounts  = Transaction::where('InvoiceNumber',$request->InvoiceNumber)->select('Billable','Allowable','Balance','Expected','Actual')->orderBy('created_at', 'desc')->first(); 
        
        $transaction = $id == 0 ? new Transaction() : Transaction::find($id);
        $transaction->Tran = $request->has('Tran') ? $request->Tran : 'Payment';
        $transaction->Company = $request->has('Company') ? $request->Company : $request->Payer;
        $transaction->Amount = $request->has('Amount') ? $request->Amount : $request->Actual;
        $transaction->Billable = $request->has('Billable') ? $request->Billable : $amounts->Billable;
        $transaction->Allowable = $request->has('Allowable') ? $request->Allowable : $amounts->Allowable;
        $transaction->Balance = $request->has('Balance') ? $request->Balance : $amounts->Balance;
        $transaction->Expected = $request->has('Expected') ? $request->Expected : $amounts->Expected;
        $transaction->Actual = $request->has('Actual') ? $request->Actual : $amounts->Actual;
        
        $transaction->fill($request->all());
        $transaction->save();
        return Redirect::to('InvoicesList')->with('success', 'saved');
    }

    // InvoicesList end

    // Reports Start

    public function  Reports()
    {
        $userId = FacadesSession::get('LoginId');
        $userView = FacadesSession::get('LoginViewCheck');
        extract(Patients::fetchPatients($userId, $userView));
        $Order = Orders::orderBy('created_at', 'desc')->get();
        return view('Reports', compact('drs', 'st', 'noti', 'pt', 'Order'));
    }

    // Reports end

    // Retail Sale Start

    public function  RetailSale()
    {
        $userId = FacadesSession::get('LoginId');
        $userView = FacadesSession::get('LoginViewCheck');
        extract(Patients::fetchPatients($userId, $userView));
        $inventory = Inventory::select('id', 'Item_Name')
            ->orderBy('created_at', 'desc')
            ->get();
        return view('RetailSale', compact('drs', 'st', 'noti', 'pt', 'inventory'));
    }


    public function AddRetailSale(Request $request)
    {
        $validatedData = $request->validate([
            'Date' => 'required',
            'SoldBy' => 'required',
            'Discount' => 'required',
            'Customer' => 'required',
            'Address' => 'required',
            'City' => 'required',
            'State' => 'required',
            'ZIP' => 'required',
            'Phone' => 'required',
            'TaxRate' => 'required',
            'per' => 'required',
            'Items' => 'required',
            'Sub_total' => 'required',
            'DiscountPer' => 'required',
            'Total' => 'required',
            'Tax' => 'required',
        ], [
            'required' => ':attribute is required',
        ]);

        $pre = new RetailSale();
        $pre->fill($validatedData);
        $pre->Items = json_encode($validatedData['Items']); // Store only the extracted IDs as a JSON string
        $pre->save();
        return redirect('RetailSale')->with('success', 'Saved Successfully');
    }

    public function addRetailItem(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $doctorType = Inventory::find($request->name);

        return response()->json([
            'id' => $doctorType->id,
            'name' => $doctorType->Item_Name,
            'warehouse' => json_decode($doctorType->warehouse)[0] ?? null,
            'type' => $doctorType->Item_Name,
        ]);
    }

    public function getCustomers(Request $request)
    {
        $search = $request->get('q');
        $customers = Patients::where('name', 'LIKE', "%$search%")
            ->orWhere('last_name', 'LIKE', "%$search%")
            ->get([
                'id',
                DB::raw("CONCAT(name, ' ', last_name) AS text")
            ]);

        return response()->json(['items' => $customers]);
    }

    public function getCustomerDetails($id)
    {
        $customer = Patients::find($id);

        if ($customer) {
            $phoneNumbers = json_decode($customer->p_phone, true);
            $firstPhone = $phoneNumbers[0] ?? '';
            return response()->json([
                'phone' => $firstPhone,
                'address' => $customer->Location,
                'id' => $customer->id,
                'name' => $customer->name . ' ' . $customer->last_Name,
            ]);
        }

        return response()->json(['error' => 'Customer not found'], 404);
    }

    // Retail Sale end


    // Preferred Notes Start

    public function  PreferredNotesList()
    {
        $userId = FacadesSession::get('LoginId');
        $userView = FacadesSession::get('LoginViewCheck');
        extract(Patients::fetchPatients($userId, $userView));
        $preNotes = PreferredNotes::select('id', 'Name', 'Text', 'Type',)->orderBy('created_at', 'desc')->get();
        return view('PreferNotes', compact('drs', 'st', 'noti', 'pt', 'preNotes'));
    }

    public function AddEditNotesPage($id)
    {
        $userId = FacadesSession::get('LoginId');
        $userView = FacadesSession::get('LoginViewCheck');
        extract(Patients::fetchPatients($userId, $userView));
        $preNotes = $id != 0 ?  PreferredNotes::findOrFail($id) : null;
        return view('AddEditNotesPage', compact('drs', 'st', 'noti', 'pt', 'preNotes'));
    }

    public function DeletePreferredNotes($id)
    {
        $pre = PreferredNotes::find($id);
        $pre->delete();
        return back();
    }

    public function AddEditNotes(Request $request, $id)
    {
        $validatedData = $request->validate([
            'Name' => 'required',
            'Text' => 'required',
            'Type' => 'required',
        ], [
            'required' => ':attribute is required',
        ]);
        $pre = $id == 0 ? new PreferredNotes() : PreferredNotes::find($id);
        if ($id != 0) {
            $pre->updated_at = now();
        }
        $pre->fill($validatedData);
        $pre->save();
        return redirect('PreferredNotesList')->with('success', 'Saved Successfully');
    }

    //Preferred Notes


    // Doctor Start

    public function  NewDoctorList()
    {
        $userId = FacadesSession::get('LoginId');
        $userView = FacadesSession::get('LoginViewCheck');
        extract(Patients::fetchPatients($userId, $userView));
        $doctor = DoctorsData::select('id', 'FirstName', 'LastName', 'NPI', 'License', 'Expiry', 'LastCheck')->orderBy('created_at', 'desc')->get();
        return view('DocotorsList', compact('drs', 'st', 'noti', 'pt', 'doctor'));
    }

    public function AddNewDoctor($id)
    {
        $userId = FacadesSession::get('LoginId');
        $userView = FacadesSession::get('LoginViewCheck');
        extract(Patients::fetchPatients($userId, $userView));
        $DoctorType = DoctorType::select('name')->orderBy('created_at', 'desc')->get();
        $doctor = $id != 0 ?  DoctorsData::findOrFail($id) : null;
        return view('AddNewDoctor', compact('drs', 'st', 'noti', 'pt', 'DoctorType', 'doctor'));
    }

    public function DeleteDoctorData($id)
    {
        $doc = DoctorsData::findOrNew($id);
        $doc->delete();
        return back();
    }

    public function AddEditNewDoctor(Request $request, $id)
    {
        $validatedData = $request->validate([
            'FirstName' => 'required',
            'LastName' => 'required',
            'MI' => 'required',
            'Suffix' => 'required',
            'Address' => 'required',
            'Courtesy' => 'required',
            'City' => 'required',
            'State' => 'required',
            'Zip' => 'required',
            'Phone' => 'required',
            'Phone2' => 'required',
            'Fax' => 'required',
            'UPIN' => 'required',
            'Medicaid' => 'required',
            'NPI' => 'required',
            'License' => 'required',
            'Expiry' => 'required',
            'Federal' => 'required',
            'Other' => 'required',
            'DES' => 'required',
            'PECOS' => 'required',
            'DoctorType' => 'required',
            'Contact' => 'required',
            'Title' => 'required',
        ], [
            'required' => ':attribute is required',
        ]);

        $doc = $id == 0 ? new DoctorsData() : DoctorsData::find($id);

        if ($id != 0) {
            $doc->updated_at = now();
        }

        $doc->fill($validatedData);
        $doc->save();

        return redirect('NewDoctorList')->with('success', 'Saved Successfully');
    }

    public function addDoctorType(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $doctorType = new DoctorType(); // Assuming you have a DoctorType model
        $doctorType->name = $request->name; // Storing the name in the 'Status' field
        $doctorType->save();

        return response()->json([
            'id' => $doctorType->id,
            'name' => $doctorType->name
        ]);
    }

    public function checkNpiStatus(Request $request)
    {

        $dr = $request->has('doctorId') ? DoctorsData::find($request->doctorId) : null;
        $npiNumber =  $dr ? $dr->NPI : $request->input('npi');

        $response = Http::get('https://npiregistry.cms.hhs.gov/api/', [
            'number' => $npiNumber,
            'version' => '2.1'
        ]);

        if ($response->successful() && !empty($response['results'])) {

            $npiData = $response['results'][0];


            $firstName = $npiData['basic']['first_name'] ?? 'N/A';
            $lastName = $npiData['basic']['last_name'] ?? 'N/A';
            $fullName = "$firstName $lastName";

            $phoneNumber = $npiData['addresses'][0]['telephone_number'] ?? 'N/A';


            if ($request->has('doctorId')) {
                $dr->LastCheck = now()->format('m/d/Y');
                $dr->save();
            }

            $status = 'NPI Status is valid';
            $statusClass = 'text-success';
            $userName = FacadesSession::get('LoginName');
        } else {
            $statusClass = 'text-danger';
            $status = 'NPI Status is not valid';
            $userName = "";
        }

        return response()->json([
            'status' => $status,
            'statusClass' => $statusClass,
            'userName' => $userName,
            'name' => $fullName,
            'phone' => $phoneNumber,
        ]);
    }

    // Doctor end


    //Stripe Payment Gateway Start

    public function handlePayment(Request $request)
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        try {
            $charge = Charge::create([
                'amount' => $request->amount * 100,
                'currency' => 'usd',
                'source' => $request->stripeToken,
                'description' => 'Test Payment',
            ]);

            if ($charge->status == 'succeeded') {
                return back()->with('payment', 'Payment successful!');
            } else {
                return back()->with('error', 'Error Occurred!');
            }
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    //Stripe Payment Gateway End

    //Missing Information Start

    public function MissingInformation()
    {
        $userId = FacadesSession::get('LoginId');
        $userView = FacadesSession::get('LoginViewCheck');
        extract(Patients::fetchPatients($userId, $userView));

        // Fetch orders
        $orders = Orders::select('id', 'Patient_Name', 'DrNPI', 'Patient_Last_Name', 'Patient_DOB', 'LastCheckUser', 'Address', 'Items')->get();

        // Get unique order IDs
        $uniqueOrderIds = $orders->pluck('Items')->unique()->filter();

        // Fetch all related order items, grouped by uniqueOrderId
        $orderItems = OrderItems::whereIn('uniqueOrderId', $uniqueOrderIds)
            ->select(
                'uniqueOrderId',
                'DXPointer10',
                'RXExp',
                'RentalType',
                'Bill_Billable_Code',
                'item',
                'priceCode',
                'ins1',
                'ins2',
                'ins3',
                'ins4',
                'PriorAuthNo',
                'PriorAuthExpiry'
            )
            ->get()
            ->groupBy('uniqueOrderId');

        $missingDetails = $orders->map(function ($order) use ($orderItems) {
            $summary = [];
            $highlightedFields = [];
            $status = 'Complete';
            $latestItem = null;

            // General Order Checks
            $this->checkAndAddMissing($order->Patient_DOB, 'Missing Patient DOB', 'Patient DOB', $summary, $highlightedFields);
            $this->checkAndAddMissing($order->Address, 'Missing Address', 'Address', $summary, $highlightedFields);
            $this->checkAndAddMissing($order->DrNPI, 'Invalid Doctor NPI', 'DrNPI', $summary, $highlightedFields);
            $this->checkAndAddMissing($order->LastCheckUser, 'Missing LastCheckUser', 'Last Check User', $summary, $highlightedFields);

            // Check related items
            $items = $orderItems->get($order->Items) ?? collect();
            foreach ($items as $item) {
                $latestItem = $item;

                $this->checkAndAddMissing($item->DXPointer10, 'Missing ICD 10', 'DXPointer10', $summary, $highlightedFields);
                $this->checkAndAddMissing($item->PriorAuthNo, 'Missing Authorization Number', 'Authorization Number', $summary, $highlightedFields);

                // Handle Expiry Dates
                $this->checkExpiryDate($item->RXExp, 'RX expired', 'RX Expiry', 'RX expires soon', $summary, $highlightedFields);
                $this->checkExpiryDate($item->PriorAuthExpiry, 'Authorization expired', 'Authorization Expiry', 'Authorization expires soon', $summary, $highlightedFields);
            }

            // Update status based on collected summary
            if (!empty($summary)) {
                $status = in_array('Expires soon', $summary) ? 'Expiring Soon' : 'Missing Info';
            }

            // Prepare final row data
            return [
                'patient_name' => $order->Patient_Name . ' ' . $order->Patient_Last_Name,
                'PatientID' => $order->PatientID ?? null,
                'order_id' => $order->id,
                'ins1' => $latestItem ? $latestItem->ins1 : null,
                'ins2' => $latestItem ? $latestItem->ins2 : null,
                'ins3' => $latestItem ? $latestItem->ins3 : null,
                'ins4' => $latestItem ? $latestItem->ins4 : null,
                'RentalType' => $latestItem ? $latestItem->RentalType : null,
                'item' => $latestItem ? $latestItem->item : null,
                'billing_code' => $latestItem ? $latestItem->Bill_Billable_Code : null,
                'priceCode' => $latestItem ? $latestItem->priceCode : 'Unknown',
                'status' => $status,
                'summary' => implode(', ', $summary),
                'highlights' => $highlightedFields,
            ];
        })->filter(function ($data) {
            return in_array($data['status'], ['Missing Info', 'Expiring Soon']); // Include rows with issues
        });

        return view('MissingInformation', compact('drs', 'st', 'noti', 'pt', 'missingDetails'));
    }

    /**
     * Helper function to check missing field and append messages.
     */
    private function checkAndAddMissing($field, $message, $highlight, &$summary, &$fields)
    {
        if (empty($field)) {
            $summary[] = $message;
            $fields[] = $highlight;
        }
    }

    /**
     * Helper function to handle expiry dates for "Expired" and "Expiring Soon" statuses.
     */
    private function checkExpiryDate($date, $expiredMsg, $expiredField, $expiringMsg, &$summary, &$fields)
    {
        if (empty($date)) {
            $summary[] = "Missing $expiredField";
            $fields[] = $expiredField;
        } else {
            $daysToExpire = now()->diffInDays($date, false);
            if ($daysToExpire <= 0) {
                $summary[] = $expiredMsg;
                $fields[] = $expiredField;
            } elseif ($daysToExpire <= 15) {
                $summary[] = $expiringMsg;
                $fields[] = $expiredField;
            }
        }
    }


    public function MissingInformation11()
    {
        $userId = FacadesSession::get('LoginId');
        $userView = FacadesSession::get('LoginViewCheck');
        extract(Patients::fetchPatients($userId, $userView));

        $orders = Orders::select('id', 'Patient_Name', 'Patient_Last_Name', 'Patient_DOB', 'LastCheckUser', 'Address', 'Items')->get();


        $uniqueOrderIds = $orders->pluck('Items')->unique()->filter();

        $orderItems = OrderItems::whereIn('uniqueOrderId', $uniqueOrderIds)
            ->select('uniqueOrderId', 'DXPointer10', 'RXExp', 'RentalType', 'Bill_Billable_Code', 'item', 'priceCode', 'ins1', 'ins2', 'ins3', 'ins4')
            ->get()
            ->keyBy('uniqueOrderId');

        // $rxExpValues = $orderItems->pluck('RXExp');
        // dd($rxExpValues);

        $missingDetails = $orders->map(function ($order) use ($orderItems) {
            $summary = [];
            $highlightedFields = [];
            $status = 'Complete';

            if (empty($order->Patient_DOB)) {
                $summary[] = 'Missing Patient DOB';
                $highlightedFields[] = 'Patient DOB';
            }

            if (empty($order->Address)) {
                $summary[] = 'Missing Address';
                $highlightedFields[] = 'Address';
            }

            if (empty($order->LastCheckUser)) {
                $summary[] = 'Missing LastCheckUser';
                $highlightedFields[] = 'Last Check User';
            }

            $item = $orderItems->get($order->Items);
            if ($item) {
                if (empty($item->DXPointer10)) {
                    $summary[] = 'Missing DXPointer10';
                    $highlightedFields[] = 'DXPointer10';
                }
                if (empty($item->RXExp)) {
                    $summary[] = 'Missing Authorization';
                    $highlightedFields[] = 'Authorization';
                }

                if (!empty($item->RXExp)) {
                    $daysToExpire = now()->diffInDays($item->RXExp, false);

                    if ($daysToExpire < 0) {
                        $summary[] = 'Authorization already expired';
                        $highlightedFields[] = 'RX Expiry';
                    } elseif ($daysToExpire <= 15) {
                        $summary[] = 'Authorization expires in ' . $daysToExpire . ' days';
                        $highlightedFields[] = 'RX Expiry';
                    }
                }
            }

            if (!empty($summary)) {
                $status = 'Missing Info';
            }

            return [
                'patient_name' => $order->Patient_Name . ' ' . $order->Patient_Last_Name,
                'PatientID' => $order->PatientID,
                'order_id' => $order->id,
                'ins1' => $item ? $item->ins1 : null,
                'ins2' => $item ? $item->ins2 : null,
                'ins3' => $item ? $item->ins3 : null,
                'ins4' => $item ? $item->ins4 : null,
                'RentalType' => $item ? $item->RentalType : null,
                'item' => $item ? $item->item : null,
                'billing_code' => $item ? $item->Bill_Billable_Code : null,
                'priceCode' => $item ? $item->priceCode : null,
                'status' => $status,
                'summary' => implode(', ', $summary),
                'highlights' => $highlightedFields, // Fields to highlight
            ];
        })->filter(function ($data) {
            return $data['status'] === 'Missing Info';
        });

        return view('MissingInformation', compact('drs', 'st', 'noti', 'pt', 'missingDetails'));
    }



    //Missing Information End



    //Claim Form 1500 start

    public function generateClaimForm($claimId, $isPreview = false)
    {
        $claim = Patients::find($claimId);
        $addressParts = $this->extractAddressParts($claim->Location);


        $phoneArray = json_decode($claim->p_phone, true);

        //   $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, 'LETTER', true, 'UTF-8', false);
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, 'A4', true, 'UTF-8', false);
        $pdf->SetMargins(0, 0, 0);
        $pdf->SetAutoPageBreak(false, 0);
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->AddPage('P', 'A4');
        $pdf->SetTitle($claim->name . ' ' . $claim->last_Name . ' Claim Form');


        if ($isPreview) {
            $templatePath = public_path('form.jpg');

            if (!file_exists($templatePath)) {
                throw new \Exception('Background image not found: ' . $templatePath);
            }
            $pdf->Image($templatePath, 0, 0, 210, 0, '', '', '', false, 300, '', false, false, 0, false, false, false);
        }

        $pdf->SetFont('helvetica', '', 5.5);

        // Add patient's full name
        $pdf->SetXY(9, 41.5);
        $pdf->Cell(0, 10, $claim->name . ' ' . $claim->last_Name, 0, 1);

        // Add Address
        $pdf->SetXY(9, 49.4);
        $pdf->Cell(0, 10, $claim->Location, 0, 1);

        // Add City
        $pdf->SetXY(9, 57.8);
        $pdf->Cell(0, 10,  $addressParts['city'], 0, 1);

        // Add State
        $pdf->SetXY(70.2, 57.8);
        $pdf->Cell(0, 10, $addressParts['state'], 0, 1);

        // Add Zip Code
        $pdf->SetXY(9, 65.8);
        $pdf->Cell(0, 10, $addressParts['zipCode'], 0, 1);

        // Add other insurance
        $pdf->SetXY(9, 75);
        $pdf->Cell(0, 10, 'N.A.', 0, 1);

        // Insurance Name on above the banner
        $pdf->SetXY(95, 7);
        $pdf->Cell(0, 10, $claim->name . ' ' . $claim->last_Name, 0, 1, '', 0);
        $pdf->SetXY(95, 13.7);
        $pdf->MultiCell(40, 10, $claim->Location, 0, 'L', 0, 1, '', '', true);

        // Top banner
        $pdf->SetXY(81.3, 34);
        $pdf->Cell(0, 10, 'XX', 0, 1, '', 0);

        // Insurance ID
        $pdf->SetXY(129, 33.5);
        $pdf->Cell(0, 10, '11371177', 0, 1, '', 0);

        // DOB
        $pdf->SetXY(83, 42.8);
        $pdf->Cell(0, 10, '02', 0, 1, '', 0);
        $pdf->SetXY(90.5, 42.8);
        $pdf->Cell(0, 10, '20', 0, 1, '', 0);
        $pdf->SetXY(98, 42.8);
        $pdf->Cell(0, 10, '2024', 0, 1, '', 0);

        // Gender
        $pdf->SetXY(108.5, 42.2);
        $pdf->Cell(0, 10, 'XX', 0, 1, '', 0);

        // Add patient Insured name
        $pdf->SetXY(130, 42);
        $pdf->Cell(0, 10, $claim->name . ' ' . $claim->last_Name, 0, 1);

        // Relationship
        $pdf->SetXY(86.2, 50.5);
        $pdf->Cell(0, 10, 'XX', 0, 1, '', 0);

        // Employment condition
        $pdf->SetXY(106, 84.5);
        $pdf->Cell(0, 10, 'XX', 0, 1, '', 0);

        // Accident condition
        $pdf->SetXY(106, 92.5);
        $pdf->Cell(0, 10, 'XX', 0, 1, '', 0);

        // Accident condition
        $pdf->SetXY(106, 101.5);
        $pdf->Cell(0, 10, 'XX', 0, 1, '', 0);

        // insurance plan name
        $pdf->SetXY(130, 100.5);
        $pdf->Cell(0, 10, 'NONE', 0, 1, '', 0);

        // Health Benefit plan
        $pdf->SetXY(146, 109);
        $pdf->Cell(0, 10, 'XX', 0, 1, '', 0);

        // Signature
        $pdf->SetXY(20, 125.5);
        $pdf->Cell(0, 10, 'SIGNATURE ON FILE', 0, 1, '', 0);

        // Date
        $pdf->SetXY(93, 125.5);
        $pdf->Cell(0, 10, Carbon::now()->format('m/d/Y'), 0, 1, '', 0);

        // Insured person Signature
        $pdf->SetXY(141.8, 125.5);
        $pdf->Cell(0, 10, 'SIGNATURE ON FILE', 0, 1, '', 0);

        // Referring doctor name
        $pdf->SetXY(9, 142.5);
        $pdf->Cell(0, 10, 'DR Kamran Arain', 0, 1, '', 0);

        // Referring Doctor NPI
        $pdf->SetXY(85, 142.5);
        $pdf->Cell(0, 10, '123243222342', 0, 1, '', 0);

        // ICD
        $pdf->SetXY(108, 155.8);
        $pdf->Cell(0, 10, '0', 0, 1, '', 0);

        // Diagnosis
        $pdf->SetXY(13, 159.3); //A
        $pdf->Cell(0, 10, 'G47.33', 0, 1, '', 0);
        $pdf->SetXY(13, 163.3); //E
        $pdf->Cell(0, 10, 'G47.33', 0, 1, '', 0);
        $pdf->SetXY(13, 167.3); //I
        $pdf->Cell(0, 10, 'G47.33', 0, 1, '', 0);
        $pdf->SetXY(45, 167.3); //J
        $pdf->Cell(0, 10, 'G47.33', 0, 1, '', 0);
        $pdf->SetXY(45, 163.3); //F
        $pdf->Cell(0, 10, 'G47.33', 0, 1, '', 0);
        $pdf->SetXY(45, 159.3); //B
        $pdf->Cell(0, 10, 'G47.33', 0, 1, '', 0);
        $pdf->SetXY(78, 159.3); //C
        $pdf->Cell(0, 10, 'G47.33', 0, 1, '', 0);
        $pdf->SetXY(78, 163.3); //D
        $pdf->Cell(0, 10, 'G47.33', 0, 1, '', 0);
        $pdf->SetXY(78, 167.3); //K
        $pdf->Cell(0, 10, 'G47.33', 0, 1, '', 0);
        $pdf->SetXY(110, 159.3); //C
        $pdf->Cell(0, 10, 'G47.33', 0, 1, '', 0);
        $pdf->SetXY(110, 163.3); //D
        $pdf->Cell(0, 10, 'G47.33', 0, 1, '', 0);
        $pdf->SetXY(110, 167.3); //K
        $pdf->Cell(0, 10, 'G47.33', 0, 1, '', 0);

        //Items
        $pdf->SetXY(9, 180.3);
        $pdf->Cell(0, 10, 'React Health linga G3 Auto CPAP Machine', 0, 1, '', 0);
        //from
        $pdf->SetXY(9, 183.8);
        $pdf->Cell(0, 10, '03', 0, 1, '', 0);
        $pdf->SetXY(15, 183.8);
        $pdf->Cell(0, 10, '03', 0, 1, '', 0);
        $pdf->SetXY(22, 183.8);
        $pdf->Cell(0, 10, '2003', 0, 1, '', 0);
        //to
        $pdf->SetXY(30, 183.8);
        $pdf->Cell(0, 10, '03', 0, 1, '', 0);
        $pdf->SetXY(37, 183.8);
        $pdf->Cell(0, 10, '03', 0, 1, '', 0);
        $pdf->SetXY(44, 183.8);
        $pdf->Cell(0, 10, '2003', 0, 1, '', 0);
        // place of service
        $pdf->SetXY(52.5, 183.8);
        $pdf->Cell(0, 10, '20', 0, 1, '', 0);

        // CPT/HCPS
        $pdf->SetXY(68.5, 183.8);
        $pdf->Cell(0, 10, 'E0601', 0, 1, '', 0);

        // Modifiers
        $pdf->SetXY(87, 183.8);
        $pdf->Cell(0, 10, 'RR', 0, 1, '', 0);
        $pdf->SetXY(94, 183.8);
        $pdf->Cell(0, 10, 'AB', 0, 1, '', 0);
        $pdf->SetXY(102, 183.8);
        $pdf->Cell(0, 10, 'AB', 0, 1, '', 0);
        $pdf->SetXY(109, 183.8);
        $pdf->Cell(0, 10, 'AB', 0, 1, '', 0);

        //pointers
        $pdf->SetXY(116, 187.8);
        $pdf->MultiCell(11, 10, 'A,B,C,D,E,F,G,H,I,H', 0, 'L', 0, 1, '', '', true);

        //charges
        $pdf->SetXY(138, 183.8);
        $pdf->Cell(30, 10, '12365.00', 0, 1, 'L', 0);

        //Days Unit
        $pdf->SetXY(153, 183.8);
        $pdf->Cell(30, 10, '1', 0, 1, 'L', 0);

        //Provider ID
        $pdf->SetXY(173, 183.8);
        $pdf->Cell(30, 10, '12345678988912313', 0, 1, 'L', 0);

        //Federal ID
        $pdf->SetXY(10, 234.8);
        $pdf->Cell(30, 10, '12345678988912313', 0, 1, 'L', 0);

        //ENN
        $pdf->SetXY(51.5, 234.8);
        $pdf->Cell(30, 10, 'XX', 0, 1, 'L', 0);

        //Account No
        $pdf->SetXY(62.5, 234.8);
        $pdf->Cell(30, 10, $claim->AccNumber, 0, 1, 'L', 0);

        //EIN
        $pdf->SetXY(98.5, 234.8);
        $pdf->Cell(30, 10, 'XX', 0, 1, 'L', 0);


        //Total charges
        $pdf->SetXY(140, 234.8);
        $pdf->Cell(100, 10, '12365.00', 0, 1, 'L', 0);

        //RSVD
        $pdf->SetXY(185, 234.8);
        $pdf->Cell(100, 10, '12365.00', 0, 1, 'L', 0);

        // Physician Signature  Date
        $pdf->SetXY(49.8, 255.5);
        $pdf->Cell(0, 10, Carbon::now()->format('m/d/Y'), 0, 1, '', 0);

        //faculty location
        $pdf->SetXY(63.5, 246.5);
        $pdf->MultiCell(40, 10, $claim->Location, 0, 'L', 0, 1, '', '', true);

        //Billing location
        $pdf->SetXY(130.5, 246.5);
        $pdf->MultiCell(40, 10, $claim->Location, 0, 'L', 0, 1, '', '', true);

        // Faculty NPI
        $pdf->SetXY(63.5, 255.5);
        $pdf->Cell(0, 10, '12233232212332', 0, 1, '', 0);

        // Billing NPI
        $pdf->SetXY(130.5, 255.5);
        $pdf->Cell(0, 10, '12233232212332', 0, 1, '', 0);



        if (is_array($phoneArray) && !empty($phoneArray)) {
            $phoneNumber = $phoneArray[0];
            $firstThree = substr($phoneNumber, 0, 3);
            $remaining = substr($phoneNumber, 3);
            $formattedPhoneNumber = $firstThree . '      ' . $remaining;
            $pdf->SetXY(45, 68.5);
            $pdf->Cell(0, 10, $formattedPhoneNumber, 0, 1);

            $pdf->SetXY(171, 239.5);
            $pdf->Cell(0, 10, $formattedPhoneNumber, 0, 1);
        }

        if ($isPreview) {
            $pdf->Output('claim_form_preview.pdf', 'I'); // Inline preview in the browser
        } else {
            $pdf->Output('claim_form.pdf', 'I'); // Force download
            // $pdf->Output('claim_form.pdf', 'D'); // Force download
        }
    }


    //Start Reports

    public function orderPDF($id)
    {
        ini_set('max_execution_time', 3600);
        ini_set('memory_limit', '2048M');

        $order = Orders::findOrFail($id);
        $orderItems = OrderItems::where('uniqueOrderId', $order->Items)->get();

        $pdf = Pdf::loadView('pdf.order', compact('order', 'orderItems'));

        $pdf->setPaper('a4', 'portrait');

        $pdf->getDomPDF()->set_option('enable_html5_parser', true);
        $pdf->getDomPDF()->set_option('enable_css_float', true);
        $pdf->getDomPDF()->set_option('enable_remote', true);
        $pdf->getDomPDF()->set_option('font_height_ratio', 1);
        $pdf->getDomPDF()->set_option('font_height_ratio', 1);
        $pdf->getDomPDF()->set_option('dpi', 150);

        $pdfTitle = $order->Patient_Name . ' ' . $order->Patient_Last_Name . ' Order';

        return $pdf->stream($pdfTitle . '.pdf');
        // return view('pdf.order', compact('order'));
    }


    public function pickupTicketPDF()
    {
        ini_set('max_execution_time', 3600);
        ini_set('memory_limit', '2048M');

        $pdf = Pdf::loadView('pdf.pickupTicket');
        $pdf->setPaper('a4', 'portrait');

        $pdf->getDomPDF()->set_option('enable_html5_parser', true);
        $pdf->getDomPDF()->set_option('enable_css_float', true);
        $pdf->getDomPDF()->set_option('enable_remote', true);
        $pdf->getDomPDF()->set_option('font_height_ratio', 1);
        $pdf->getDomPDF()->set_option('dpi', 150);

        return $pdf->stream('Pickup Ticket.pdf');
    }

    public function invoicePDF($id)
    {
        ini_set('max_execution_time', 3600);
        ini_set('memory_limit', '2048M');

        $order = Orders::findOrFail($id);
        $orderItems = OrderItems::where('uniqueOrderId', $order->Items)->get();
        $order->Invoice = now();
        $order->lastInvoiceGeneratedOn = now();
        $order->save();

        $pdf = Pdf::loadView('pdf.invoice', compact('order', 'orderItems'));
        $pdf->setPaper('a4', 'portrait');

        $pdf->getDomPDF()->set_option('enable_html5_parser', true);
        $pdf->getDomPDF()->set_option('enable_css_float', true);
        $pdf->getDomPDF()->set_option('enable_remote', true);
        $pdf->getDomPDF()->set_option('font_height_ratio', 1);
        $pdf->getDomPDF()->set_option('dpi', 150);

        return $pdf->stream('Invoice.pdf');
        // return view('pdf.invoice');
    }

    public function rentalAgreementPDF($id)
    {
        ini_set('max_execution_time', 3600);
        ini_set('memory_limit', '2048M');

        $order = Orders::findOrFail($id);
        $patient = Patients::findOrFail($order->Patient_ID);
        // $orderItems = OrderItems::where('uniqueOrderId',$order->Items)->get();

        $pdf = Pdf::loadView('pdf.rental', compact('order', 'patient'));
        $pdf->setPaper('a4', 'portrait');

        $pdf->getDomPDF()->set_option('enable_html5_parser', true);
        $pdf->getDomPDF()->set_option('enable_css_float', true);
        $pdf->getDomPDF()->set_option('enable_remote', true);
        $pdf->getDomPDF()->set_option('font_height_ratio', 1);
        $pdf->getDomPDF()->set_option('dpi', 150);

        return $pdf->stream('rental.pdf');
    }

    public function UserDailyWorkRPT()
    {
        ini_set('max_execution_time', 3600);
        ini_set('memory_limit', '2048M');

        $pdf = Pdf::loadView('pdf.UserDailyWorkRPT');
        $pdf->setPaper('a4', 'portrait');

        $pdf->getDomPDF()->set_option('enable_html5_parser', true);
        $pdf->getDomPDF()->set_option('enable_css_float', true);
        $pdf->getDomPDF()->set_option('enable_remote', true);
        $pdf->getDomPDF()->set_option('font_height_ratio', 1);
        $pdf->getDomPDF()->set_option('dpi', 150);

        return $pdf->stream('UserDailyWorkRPT.pdf');
    }

    public function InventoryRPT()
    {
        ini_set('max_execution_time', 3600);
        ini_set('memory_limit', '2048M');

        $inventory = Inventory::orderBy('created_at', 'desc')->get();
        $totalSoldItem = $inventory->sum('Sold');

        $pdf = Pdf::loadView('pdf.InventoryRPT', [
            'inventory' => $inventory,
            'totalSoldItem' => $totalSoldItem
        ]);

        $pdf->setPaper('a4', 'portrait');


        $pdf->getDomPDF()->set_option('enable_html5_parser', true);
        $pdf->getDomPDF()->set_option('enable_css_float', true);
        $pdf->getDomPDF()->set_option('enable_remote', true);
        $pdf->getDomPDF()->set_option('font_height_ratio', 1);
        $pdf->getDomPDF()->set_option('dpi', 150);

        return $pdf->stream('InventoryRPT.pdf');
    }

    public function InsuranceRPT()
    {
        ini_set('max_execution_time', 3600);
        ini_set('memory_limit', '2048M');

        $pdf = Pdf::loadView('pdf.InsuranceRPT');
        $pdf->setPaper('a4', 'portrait');

        $pdf->getDomPDF()->set_option('enable_html5_parser', true);
        $pdf->getDomPDF()->set_option('enable_css_float', true);
        $pdf->getDomPDF()->set_option('enable_remote', true);
        $pdf->getDomPDF()->set_option('font_height_ratio', 1);
        $pdf->getDomPDF()->set_option('dpi', 150);

        return $pdf->stream('InsuranceRPT.pdf');
    }

    public function RXRPT()
    {
        ini_set('max_execution_time', 3600);
        ini_set('memory_limit', '2048M');
        $currentDate = Carbon::now()->toDateString();

        $doc = documents::where('docType', 'Prescription (RX)')->get();
        $expiredCount = documents::where('docType', 'Prescription (RX)')->whereDate('toDate', '<', $currentDate)->count();
        $validCount = documents::where('docType', 'Prescription (RX)')->whereDate('toDate', '>', $currentDate)->count();

        $pdf = Pdf::loadView('pdf.RXRPT', compact('doc', 'expiredCount', 'validCount'));
        $pdf->setPaper('a4', 'portrait');

        $pdf->getDomPDF()->set_option('enable_html5_parser', true);
        $pdf->getDomPDF()->set_option('enable_css_float', true);
        $pdf->getDomPDF()->set_option('enable_remote', true);
        $pdf->getDomPDF()->set_option('font_height_ratio', 1);
        $pdf->getDomPDF()->set_option('dpi', 150);

        return $pdf->stream('RXRPT.pdf');
    }

    public function orderRPT()
    {
        ini_set('max_execution_time', 3600);
        ini_set('memory_limit', '2048M');

        $order = Orders::orderBy('created_at', 'desc')->get();
        $insCount = $order->where('OrderType', 'Insurance')->count();
        $rentalCount = $order->where('OrderType', ['Retail Rental', 'Insurance Rental'])
            ->count();
        $billCount = $order->where('OrderStatus', '12')->count();
        $copayCount = $order->where('OrderStatus', '26')->count();
        $cancelCount = $order->where('OrderStatus', '17')->count();
        $retailCount = $order->where('OrderType', ['Retail Rental', 'Retail Sale'])
            ->count();

        $pdf = Pdf::loadView('pdf.orderRPT', compact('order', 'rentalCount', 'insCount', 'billCount', 'copayCount', 'cancelCount', 'retailCount'));
        $pdf->setPaper('a4', 'portrait');

        $pdf->getDomPDF()->set_option('enable_html5_parser', true);
        $pdf->getDomPDF()->set_option('enable_css_float', true);
        $pdf->getDomPDF()->set_option('enable_remote', true);
        $pdf->getDomPDF()->set_option('font_height_ratio', 1);
        $pdf->getDomPDF()->set_option('dpi', 150);

        return $pdf->stream('orderRPT.pdf');
    }

    public function invoiceRPT()
    {
        ini_set('max_execution_time', 3600);
        ini_set('memory_limit', '2048M');

        $order = Orders::select('Patient_Name', 'id', 'Patient_Last_Name', 'Invoice')->orderBy('created_at', 'desc')->get();
        $generatedCount = $order->where('Invoice', '!=', null)->count();
        $notGeneratedCount = $order->where('Invoice', null)->count();

        $pdf = Pdf::loadView('pdf.invoiceRPT', compact('order', 'generatedCount', 'notGeneratedCount'));
        $pdf->setPaper('a4', 'portrait');

        $pdf->getDomPDF()->set_option('enable_html5_parser', true);
        $pdf->getDomPDF()->set_option('enable_css_float', true);
        $pdf->getDomPDF()->set_option('enable_remote', true);
        $pdf->getDomPDF()->set_option('font_height_ratio', 1);
        $pdf->getDomPDF()->set_option('dpi', 150);

        return $pdf->stream('invoiceRPT.pdf');
    }

    public function missingDocumentsRPT()
    {
        ini_set('max_execution_time', 3600);
        ini_set('memory_limit', '2048M');

        $pdf = Pdf::loadView('pdf.missingDocumentsRPT');
        $pdf->setPaper('a4', 'portrait');

        $pdf->getDomPDF()->set_option('enable_html5_parser', true);
        $pdf->getDomPDF()->set_option('enable_css_float', true);
        $pdf->getDomPDF()->set_option('enable_remote', true);
        $pdf->getDomPDF()->set_option('font_height_ratio', 1);
        $pdf->getDomPDF()->set_option('dpi', 150);

        return $pdf->stream('missingDocumentsRPT.pdf');
    }

    public function AccountsRPT()
    {
        ini_set('max_execution_time', 3600);
        ini_set('memory_limit', '2048M');

        $pdf = Pdf::loadView('pdf.AccountsRPT');
        $pdf->setPaper('a4', 'portrait');

        $pdf->getDomPDF()->set_option('enable_html5_parser', true);
        $pdf->getDomPDF()->set_option('enable_css_float', true);
        $pdf->getDomPDF()->set_option('enable_remote', true);
        $pdf->getDomPDF()->set_option('font_height_ratio', 1);
        $pdf->getDomPDF()->set_option('dpi', 150);

        return $pdf->stream('AccountsRPT.pdf');
    }

    public function InsuranceClaimsDenialRPT()
    {
        ini_set('max_execution_time', 3600);
        ini_set('memory_limit', '2048M');

        $pdf = Pdf::loadView('pdf.InsuranceClaimsDenialRPT');
        $pdf->setPaper('a4', 'portrait');

        $pdf->getDomPDF()->set_option('enable_html5_parser', true);
        $pdf->getDomPDF()->set_option('enable_css_float', true);
        $pdf->getDomPDF()->set_option('enable_remote', true);
        $pdf->getDomPDF()->set_option('font_height_ratio', 1);
        $pdf->getDomPDF()->set_option('dpi', 150);

        return $pdf->stream('InsuranceClaimsDenialRPT.pdf');
    }

    public function InsuranceClaimsSuccessfullyReceivedRPT()
    {
        ini_set('max_execution_time', 3600);
        ini_set('memory_limit', '2048M');

        $pdf = Pdf::loadView('pdf.InsuranceClaimsSuccessfullyReceivedRPT');
        $pdf->setPaper('a4', 'portrait');

        $pdf->getDomPDF()->set_option('enable_html5_parser', true);
        $pdf->getDomPDF()->set_option('enable_css_float', true);
        $pdf->getDomPDF()->set_option('enable_remote', true);
        $pdf->getDomPDF()->set_option('font_height_ratio', 1);
        $pdf->getDomPDF()->set_option('dpi', 150);

        return $pdf->stream('InsuranceClaimsSuccessfullyReceivedRPT.pdf');
    }

    public function InsuranceClaimRPT()
    {
        ini_set('max_execution_time', 3600);
        ini_set('memory_limit', '2048M');

        $claims = [
            [
                'patient_name' => 'Washington',
                'account' => 'H70S',
                'insurance_company' => 'HUMANA',
                'procedures' => [
                    ['from' => '2024C', 'to' => '1', 'qty' => 'E0570', 'proc' => 'RR KJ KX', 'modifiers' => '15.00', 'submitted' => 'Y', 'date' => '20240329', 'npi' => '1215']
                ]
            ],
            [
                'patient_name' => 'Young',
                'account' => '14756',
                'insurance_company' => 'BCBS OF',
                'procedures' => [
                    ['from' => '2023', 'to' => '30', 'qty' => 'A99', 'proc' => 'NU', 'modifiers' => '750.00', 'submitted' => 'Y', 'date' => '20231109', 'npi' => '1306'],
                    ['from' => '2023', 'to' => '1', 'qty' => 'A99', 'proc' => 'NU', 'modifiers' => '20.00', 'submitted' => 'Y', 'date' => '20231109', 'npi' => '1306']
                ]
            ],
        ];

        $pdf = Pdf::loadView('pdf.InsuranceClaimRPT', compact('claims'));
        $pdf->setPaper('a4', 'portrait');

        $pdf->getDomPDF()->set_option('enable_html5_parser', true);
        $pdf->getDomPDF()->set_option('enable_css_float', true);
        $pdf->getDomPDF()->set_option('enable_remote', true);
        $pdf->getDomPDF()->set_option('font_height_ratio', 1);
        $pdf->getDomPDF()->set_option('dpi', 150);

        return $pdf->stream('InsuranceClaimRPT.pdf');
    }


    //end reports

    //eligibility

    public function getBearerToken()
    {
        try {
            $response = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/x-www-form-urlencoded',
                'User-Agent' => 'PostmanRuntime/7.32.3',
                'Cache-Control' => 'no-cache',
                'Origin' => 'https://sandbox.apigw.changehealthcare.com',
                'Referer' => 'https://sandbox.apigw.changehealthcare.com/',
                'X-Requested-With' => 'XMLHttpRequest'
            ])
                ->withOptions([
                    'verify' => false,
                    'allow_redirects' => true,
                    'http_errors' => false,
                    'connect_timeout' => 30,
                ])
                ->asForm()
                ->retry(3, 100) // Retry up to 3 times with 100ms delay
                ->post('https://sandbox.apigw.changehealthcare.com/apip/auth/v2/token', [
                    'client_id' => 'S8YwVgz6It2oi0gBz8svOUy1AQFJYGAZ',
                    'client_secret' => 'Cc4WcM3NVFOvrmHG',
                    'grant_type' => 'client_credentials'
                ]);

            // Log the response for debugging
            Log::info('API Token Response', [
                'status' => $response->status(),
                'body' => $response->body(),
                'headers' => $response->headers()
            ]);

            if ($response->successful()) {
                return $response['access_token'] ?? null;
            }

            Log::error('Failed to retrieve Bearer token', [
                'status' => $response->status(),
                'message' => $response->json() ?? $response->body(),
            ]);
            return null;
        } catch (\Exception $e) {
            Log::error('API Exception', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return null;
        }
    }

    public function checkEligibility()
    {

        $accessToken = $this->getBearerToken();
        if (!$accessToken) {
            return response()->json([
                'error' => 'Unable to retrieve access token',
            ], 500);
        }

        try {
            $response = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $accessToken,
                'User-Agent' => 'PostmanRuntime/7.32.3'
            ])
                ->withOptions([
                    'verify' => false,
                    'http_errors' => false,
                    'connect_timeout' => 30,
                ])
                ->post('https://sandbox.apigw.changehealthcare.com/medicalnetwork/eligibility/v3', [
                    "controlNumber" => "123456789",
                    "tradingPartnerServiceId" => "CMSMED",
                    "provider" => [
                        "organizationName" => "provider_name",
                        "npi" => "0123456789",
                        "serviceProviderNumber" => "54321",
                        "providerCode" => "AD",
                        "referenceIdentification" => "54321g"
                    ],
                    "subscriber" => [
                        "memberId" => "0000000000",
                        "firstName" => "johnOne",
                        "lastName" => "doeOne",
                        "gender" => "M",
                        "dateOfBirth" => "18800102",
                        "ssn" => "555443333",
                        "idCard" => "card123"
                    ],
                    "dependents" => [
                        [
                            "firstName" => "janeOne",
                            "lastName" => "doeone",
                            "gender" => "F",
                            "dateOfBirth" => "18160421",
                            "groupNumber" => "1111111111"
                        ]
                    ],
                    "encounter" => [
                        "beginningDateOfService" => "20100101",
                        "endDateOfService" => "20100102",
                        "serviceTypeCodes" => ["98"]
                    ]
                ]);

            Log::info('Eligibility API Response', [
                'status' => $response->status(),
                'body' => $response->body(),
                'headers' => $response->headers(),
            ]);

            if ($response->successful()) {
                return response()->json([
                    'success' => true,
                    'data' => $response->json()
                ]);
            }

            return response()->json([
                'error' => 'Failed to check eligibility',
                'status' => $response->status(),
                'message' => $response->json() ?? $response->body(),
                'headers' => $response->headers()
            ], $response->status());
        } catch (\Exception $e) {
            Log::error('Eligibility API Exception', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'error' => 'Failed to check eligibility',
                'message' => $e->getMessage()
            ], 500);
        }
    }


    public function checkClaimStatus(Request $request)
    {
        $accessToken = $this->getBearerToken();

        if (!$accessToken) {
            return response()->json([
                'error' => 'Unable to retrieve access token',
            ], 500);
        }

        $order = Orders::find(5);
        $patient = Patients::find($order->Patient_ID);
        $dateOfBirth = Carbon::createFromFormat('m/d/Y', $patient->Dob)->format('Ymd');
        $genderCode = isset($patient->gender) && in_array(strtolower($patient->gender), ['male', 'female'])
            ? strtoupper(substr($patient->gender, 0, 1))
            : 'U';

        // Define default (hardcoded) values
        $defaultData = [
            'controlNumber' => mt_rand(100000000, 999999999),
            'tradingPartnerServiceId' => 'CMSMED',
            'providers' => [
                [
                    'organizationName' => 'provider_name',
                    'taxId' => '0123456789',
                    'providerType' => 'BillingProvider'
                ],
                [
                    'organizationName' => 'happy doctors group',
                    'npi' => '1760854442',
                    'providerType' => 'ServiceProvider'
                ]
            ],
            'subscriber' => [
                'memberId' => '0000000000',
                'firstName' => 'janeone',
                'lastName' => 'doeone',
                'gender' => 'M',
                'dateOfBirth' => '18800101',
                'groupNumber' => '0000000000'
            ],
            'dependent' => [
                'firstName' => 'janeone',
                'lastName' => 'doeone',
                'gender' => 'F',
                'dateOfBirth' => '18800101',
                'groupNumber' => '0000000000'
            ],
            'encounter' => [
                'beginningDateOfService' => '20100101',
                'endDateOfService' => '20100102',
                'trackingNumber' => 'ABCD'
            ]
        ];

        // Use request parameters if provided; otherwise, use default values
        $data = [
            'controlNumber' => $request->input('controlNumber', $defaultData['controlNumber']),
            'tradingPartnerServiceId' => $request->input('tradingPartnerServiceId', $defaultData['tradingPartnerServiceId']),
            'providers' => $request->input('providers', $defaultData['providers']),
            'subscriber' => $request->input('subscriber', $defaultData['subscriber']),
            'dependent' => $request->input('dependent', $defaultData['dependent']),
            'encounter' => $request->input('encounter', $defaultData['encounter']),
        ];

        try {
            $response = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $accessToken,
                'User-Agent' => 'PostmanRuntime/7.32.3'
            ])
                ->withOptions([
                    'verify' => false,
                    'http_errors' => false,
                    'connect_timeout' => 30,
                ])
                ->post('https://sandbox.apigw.changehealthcare.com/medicalnetwork/claimstatus/v2', $data);

            Log::info('Claim Status API Response', [
                'status' => $response->status(),
                'body' => $response->body(),
                'headers' => $response->headers(),
            ]);

            if ($response->successful()) {
                return response()->json([
                    'success' => true,
                    'data' => $response->json()
                ]);
            }

            return response()->json([
                'error' => 'Failed to check claim status',
                'status' => $response->status(),
                'message' => $response->json() ?? $response->body(),
                'headers' => $response->headers()
            ], $response->status());
        } catch (\Exception $e) {
            Log::error('Claim Status API Exception', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'error' => 'Failed to check claim status',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function checkClaimStatusRawX12(Request $request)
    {
        // Retrieve access token
        $accessToken = $this->getBearerToken();

        if (!$accessToken) {
            return response()->json([
                'error' => 'Unable to retrieve access token',
            ], 500);
        }

        // Define default X12 body
        $defaultX12 = "ISA*00*          *01*password  *ZZ*something      *ZZ*EMDEON         *200729*0835*^*00501*000000001*0*P*:~GS*HR*LCX1210000*MTEXE*20200729*0835*000000001*X*005010X212~ST*276*000000001*005010X212~BHT*0010*13*000000001*20200729*0835~HL*1**20*1~NM1*PR*2*Unknown*****PI*serviceId~HL*2*1*21*1~NM1*41*2*TestProvider*****46*0123456789~HL*3*2*19*1~NM1*1P*2*happy doctors group*****XX*1760854442~HL*4*3*22*1~DMG*D8*18800102*M~NM1*IL*1*doeone*johnone****MI*0000000000~HL*5*3*23*0~DMG*D8*18800101*F~NM1*QC*1*doeone*janeone~TRN*1*ABCD~REF*6P*0000000000~DTP*472*RD8*20100101-20100102~SE*18*000000001~GE*1*000000001~IEA*1*000000001~";

        $x12 = $request->input('x12', $defaultX12);

        try {
            $response = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $accessToken,
                'User-Agent' => 'PostmanRuntime/7.32.3'
            ])
                ->withOptions([
                    'verify' => false,
                    'http_errors' => false,
                    'connect_timeout' => 30,
                ])
                ->post('https://sandbox.apigw.changehealthcare.com/medicalnetwork/claimstatus/v2/raw-x12', [
                    'x12' => $x12
                ]);

            Log::info('Claim Status (Raw X12) API Response', [
                'status' => $response->status(),
                'body' => $response->body(),
                'headers' => $response->headers(),
            ]);

            if ($response->successful()) {
                return response()->json([
                    'success' => true,
                    'data' => $response->json()
                ]);
            }

            return response()->json([
                'error' => 'Failed to check claim status (Raw X12)',
                'status' => $response->status(),
                'message' => $response->json() ?? $response->body(),
                'headers' => $response->headers()
            ], $response->status());
        } catch (\Exception $e) {
            Log::error('Claim Status (Raw X12) API Exception', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'error' => 'Failed to check claim status (Raw X12)',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function checkEligibilityRawX12()
    {
        $x12Body = "ISA*00*          *01*password  *ZZ*something      *ZZ*EMDEON         *200708*0603*^*00501*123456789*0*P*:~GS*HS*LLX1210001*UHC*20200708*0603*123456789*X*005010X279A1~ST*270*123456789*005010X279A1~BHT*0022*13*123456789*20200708*0603~HL*1**20*1~NM1*PR*2*Unknown*****PI*serviceId~HL*2*1*21*1~NM1*1P*2*provider_name*****XX*0123456789~PRV*AD*PXC*54321g~HL*3*2*22*1~TRN*1*123456789*9EMDEON999~NM1*IL*1*doeOne*johnOne****MI*0000000000~REF*SY*555443333~REF*HJ*card123~DMG*D8*18800102*M~HL*4*3*23*0~TRN*1*123456789*9EMDEON999~NM1*03*1*doeone*janeOne~REF*6P*1111111111~DMG*D8*18160421*F~DTP*291*RD8*20100101-20100102~EQ*98~SE*21*123456789~GE*1*123456789~IEA*1*123456789~";


        $accessToken = $this->getBearerToken();


        if (!$accessToken) {
            return response()->json([
                'error' => 'Unable to retrieve access token',
            ], 500);
        }

        // Step 3: Use the access token in the eligibility check request
        try {
            $response = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $accessToken,
                'User-Agent' => 'PostmanRuntime/7.32.3'
            ])
                ->withOptions([
                    'verify' => false,
                    'http_errors' => false,
                    'connect_timeout' => 30,
                ])
                ->post('https://sandbox.apigw.changehealthcare.com/medicalnetwork/eligibility/v3/raw-x12', [
                    "x12" => $x12Body
                ]);

            // Log the eligibility check response for debugging
            Log::info('Eligibility Raw X12 API Response', [
                'status' => $response->status(),
                'body' => $response->body(),
                'headers' => $response->headers(),
            ]);

            if ($response->successful()) {
                return response()->json([
                    'success' => true,
                    'data' => $response->json()
                ]);
            }

            return response()->json([
                'error' => 'Failed to check eligibility',
                'status' => $response->status(),
                'message' => $response->json() ?? $response->body(),
                'headers' => $response->headers()
            ], $response->status());
        } catch (\Exception $e) {
            Log::error('Eligibility API Exception', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'error' => 'Failed to check eligibility',
                'message' => $e->getMessage()
            ], 500);
        }
    }



    //ends



    public function importFile()
    {
        return view('importing');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xls,xlsx',
        ]);
        // Excel::import(new WarehouseImport, $request->file('file'));
        Excel::import(new PriceCodeImport, $request->file('file'));
        // return redirect('WarehouseList')->with('success', 'Data imported successfully!');
        return redirect('PriceCodeList')->with('success', 'Data imported successfully!');
    }

    public function extractAddressParts($address)
    {
        $city = 'N/A';
        $state = 'N/A';
        $zipCode = 'N/A';
        $pattern = '/\b([A-Z]{2})\s+(\d{5})\b/';
        if (preg_match($pattern, $address, $matches)) {
            $state = $matches[1];
            $zipCode = $matches[2];
            $addressWithoutStateZip = preg_replace($pattern, '', $address);
            $addressParts = explode(' ', trim($addressWithoutStateZip));
            $city = end($addressParts);
        }

        return [
            'city' => $city,
            'state' => $state,
            'zipCode' => $zipCode,
        ];
    }

    public function orderProcessing()
    {
        $orderItems = OrderItems::whereIn('RentalType', [
            'Medicare Oxygen Rental',
            'Monthly Rental',
            'Capped Rental',
            'Rent to Purchase',
            'Re-occurring Sale'
        ])->get();

        foreach ($orderItems as $item) {
            $order = Orders::where('Items', $item->uniqueOrderId)->first();

            if (!$order || empty($order->Invoice) || (isset($order->lastInvoiceGeneratedOn) && $this->isGeneratedThisMonth($order->lastInvoiceGeneratedOn))) {
                // dd($this->isGeneratedThisMonth($order->lastInvoiceGeneratedOn));
                continue;
            }


            $invoiceDate = Carbon::parse($order->Invoice);

            switch ($item->RentalType) {
                case 'Medicare Oxygen Rental':
                    if ($this->isWithinPeriod($invoiceDate, 36)) {
                        $this->createInvoice($item, 'RR-KX', $order->id);
                    }
                    break;

                case 'Monthly Rental':
                    if ($order->OrderStatus == 17 || $order->OrderStatus == 28)
                        break;
                    $this->createInvoice($item, 'RR-KX', $order->id);
                    break;

                case 'Capped Rental':
                    $monthsPassed = now()->diffInMonths($invoiceDate);
                    $modifier = $this->getCappedRentalModifier($monthsPassed);
                    if ($monthsPassed <= 13) {
                        $this->createInvoice($item, $modifier, $order->id);
                    }
                    break;

                case 'Rent to Purchase':
                    $monthsPassed = now()->diffInMonths($invoiceDate);
                    if ($monthsPassed < 3) {
                        $this->createInvoice($item, 'RR-KX', $order->id);
                    } elseif ($monthsPassed === 3) {
                        $this->createInvoice($item, 'NU-KX', $order->id);
                    }
                    break;

                case 'Re-occurring Sale':
                    $this->createInvoice($item, 'RECURRING', $order->id);
                    break;
            }
        }

        return back()->with('success', 'Invoice Saved Successfully');
    }

    private function isGeneratedThisMonth($date)
    {

        return Carbon::parse($date)->isSameMonth(Carbon::now());
    }

    private function isWithinPeriod($invoiceDate, $months)
    {
        $threshold = now()->subMonths($months);
        return $invoiceDate->greaterThan($threshold);
    }

    private function getCappedRentalModifier($monthsPassed)
    {
        if ($monthsPassed == 0) {
            return 'RR-KH-KX'; // 1st month
        } elseif (in_array($monthsPassed, [1, 2])) {
            return 'RR-KI-KX'; // Months 2-3
        } elseif ($monthsPassed >= 3 && $monthsPassed <= 12) {
            return 'RR-KJ-KX';
        }
        return 'RR-KJ-KX';
    }

    private function createInvoice($item, $modifier, $oid)
    {
        $order = Orders::find($oid, ['Patient_ID', 'Items', 'lastInvoiceGeneratedOn']);
        $orderItem = OrderItems::where('uniqueOrderId', $order->Items)->first(['*']);
        $batchNumber = Batches::where('BatchStatus', 'Temporary')->value('BatchNumber') ?? mt_rand(10000, 99999);

        if (!$order || !$orderItem) {
            return back()->with('error', 'Order or Order Item not found.');
        }

        $batch = new Batches();

        $modifierParts = explode('-', $modifier);
        $modifier1 = $modifierParts[0] ?? $orderItem?->modifier1;
        $modifier2 = $modifierParts[1] ?? $orderItem?->modifier2;
        $modifier3 = $modifierParts[2] ?? $orderItem?->modifier3;

        $batchData = [
            'OrderID'       => $oid,
            'PatientID'     => $order->Patient_ID,
            'BatchNumber'   => $batchNumber,
            'Status'        => 'Temporary',
            'BatchStatus'   => 'Temporary',
            'Created'       => 'Auto Generated',
            'Item'          => $orderItem->itemId,
            'Balance'       => $orderItem->AllowablePrice,
            'InvoiceDate'   => now(),
            'HAO'           => $orderItem->HAO,
            'BillingCode'   => $orderItem->Bill_Billable_Code,
            'PriorAuth'     => $orderItem->PriorAuthNo,
            'PriorAuthType' => $orderItem->PriorAuthType,
            'Modifier1' => $modifier1,
            'Modifier2' => $modifier2,
            'Modifier3' => $modifier3,
            'Modifier4'     => $orderItem->modifier4,
            'From'          => $orderItem->DOSFrom,
            'To'            => $orderItem->DOSTo,
            'BillingMonth'  => $orderItem->DOSBillingMonth,
            'BillableAmount' => $orderItem->Billable_Price,
            'AllowedAmount' => $orderItem->AllowablePrice,
            'Quantity'      => $orderItem->Quantity,
            'Taxes'         => $orderItem->Taxable,
            'Ins1'          => $orderItem->Ins1,
            'Ins2'          => $orderItem->Ins2,
            'Ins3'          => $orderItem->Ins3,
            'Ins4'          => $orderItem->Ins4,
            'NoPay'         => $orderItem->noIns1,
            'Dx10'          => $orderItem->DXPointer10,
            'CMNRX'         => $orderItem->CMN,
        ];

        $batch->fill($batchData)->save();

        // Prepare transaction data
        Transaction::create([
            'Company'       => 'Patient',
            'InvoiceNumber' => $batch->id,
            'Tran'          => 'Pending Submission',
            'Transaction'   => now(),
            'Amount'        => $orderItem->AllowablePrice,
            'Quantity'      => $orderItem->Quantity,
            'Taxes'         => $orderItem->Taxable,
            'Billable'         => $orderItem->Billable_Price,
            'Allowable'         => $orderItem->AllowablePrice,
            'Balance'         => $orderItem->Balance,
            'Actual'         => $orderItem->Balance,
        ]);
        $order = Orders::find($oid);
        $order->lastInvoiceGeneratedOn = now();
        $order->save();
        Log::info("Invoice created for item {$item->uniqueOrderId} with modifier {$modifier}");
        return back()->with('success', 'Invoice Saved Successfully');
    }
}
