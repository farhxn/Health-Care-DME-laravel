<?php

use App\Http\Controllers\MainController;
use App\Http\Controllers\SecondPhaseController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/





//Second Phase Requests Start


Route::get('/checkClaimStatusRawX12', [SecondPhaseController::class, 'checkClaimStatusRawX12'])->middleware('isloggedin');
Route::get('/checkEligibilityRawX12', [SecondPhaseController::class, 'checkEligibilityRawX12'])->middleware('isloggedin');
Route::get('/checkClaimStatus', [SecondPhaseController::class, 'checkClaimStatus'])->middleware('isloggedin');
Route::get('/checkEligibility', [SecondPhaseController::class, 'checkEligibility'])->middleware('isloggedin');
Route::get('/get-token', [SecondPhaseController::class, 'getBearerToken'])->middleware('isloggedin');

Route::get('/orderProcessing', [SecondPhaseController::class, 'orderProcessing'])->middleware('isloggedin');
Route::get('/MissingInformation', [SecondPhaseController::class, 'MissingInformation'])->middleware('isloggedin');
Route::get('/InsuranceClaimRPT', [SecondPhaseController::class, 'InsuranceClaimRPT'])->middleware('isloggedin');
Route::get('/orderPDF/{id}', [SecondPhaseController::class, 'orderPDF'])->middleware('isloggedin');
Route::get('/pickupTicketPDF', [SecondPhaseController::class, 'pickupTicketPDF'])->middleware('isloggedin');
Route::get('/invoicePDF/{id}', [SecondPhaseController::class, 'invoicePDF'])->middleware('isloggedin');
Route::get('/rentalAgreementPDF/{id}', [SecondPhaseController::class, 'rentalAgreementPDF'])->middleware('isloggedin');
Route::get('/UserDailyWorkRPT', [SecondPhaseController::class, 'UserDailyWorkRPT'])->middleware('isloggedin');
Route::get('/InventoryRPT', [SecondPhaseController::class, 'InventoryRPT'])->middleware('isloggedin');
Route::get('/InsuranceRPT', [SecondPhaseController::class, 'InsuranceRPT'])->middleware('isloggedin');
Route::get('/RXRPT', [SecondPhaseController::class, 'RXRPT'])->middleware('isloggedin');
Route::get('/orderRPT', [SecondPhaseController::class, 'orderRPT'])->middleware('isloggedin');
Route::get('/invoiceRPT', [SecondPhaseController::class, 'invoiceRPT'])->middleware('isloggedin');
Route::get('/missingDocumentsRPT', [SecondPhaseController::class, 'missingDocumentsRPT'])->middleware('isloggedin');
Route::get('/AccountsRPT', [SecondPhaseController::class, 'AccountsRPT'])->middleware('isloggedin');
Route::get('/InsuranceClaimsDenialRPT', [SecondPhaseController::class, 'InsuranceClaimsDenialRPT'])->middleware('isloggedin');
Route::get('/InsuranceClaimsSuccessfullyReceivedRPT', [SecondPhaseController::class, 'InsuranceClaimsSuccessfullyReceivedRPT'])->middleware('isloggedin');



Route::get('/purchaseOrderList',[SecondPhaseController::class,'purchase_order_list'])->middleware('isloggedin');
Route::get('/purchaseOrderAdd/{id}',[SecondPhaseController::class,'add_purchase_order'])->middleware('isloggedin');
Route::post('/purchaseOrderAddEdit/{id}',[SecondPhaseController::class,'AddEditPurchaseOrder'])->middleware('isloggedin');
Route::post('/purchaseOrderDelete/{id}',[SecondPhaseController::class,'DeletePurchaseOrder'])->middleware('isloggedin');
Route::post('/save-item',[SecondPhaseController::class,'saveTemporaryItem'])->middleware('isloggedin');
Route::post('/delete-item/{id}',[SecondPhaseController::class,'deleteTemporaryItem'])->middleware('isloggedin');

Route::get('/InventoryItemList',[SecondPhaseController::class,'inventoryItemList'])->middleware('isloggedin');
Route::get('/inventoryItemAdd/{id}',[SecondPhaseController::class,'inventoryItemAdd'])->middleware('isloggedin');
Route::post('/AddEditInventoryItem/{id}',[SecondPhaseController::class,'AddEditInventoryItem'])->middleware('isloggedin');
Route::post('/DeleteInventoryItem/{id}',[SecondPhaseController::class,'DeleteInventoryItem'])->middleware('isloggedin');
Route::post('/addProductType',[SecondPhaseController::class,'addProductType'])->middleware('isloggedin');

Route::get('/PriceCodeList',[SecondPhaseController::class,'PriceCodeList'])->middleware('isloggedin');
Route::get('/AddPriceCode/{id}',[SecondPhaseController::class,'AddPriceCode'])->middleware('isloggedin');
Route::post('/DeletePriceCode/{id}',[SecondPhaseController::class,'DeletePriceCode'])->middleware('isloggedin');
Route::post('/AddEditPriceCode/{id}',[SecondPhaseController::class,'AddEditPriceCode'])->middleware('isloggedin');
Route::post('/updatePriceCode/{id}',[SecondPhaseController::class,'updatePriceCode'])->middleware('isloggedin');

Route::get('/ManufacturerList',[SecondPhaseController::class,'ManufacturerList'])->middleware('isloggedin');
Route::get('/AddManufacturer/{id}',[SecondPhaseController::class,'AddManufacturer'])->middleware('isloggedin');
Route::post('/AddEditManufacturer/{id}',[SecondPhaseController::class,'AddEditManufacturer'])->middleware('isloggedin');
Route::post('/DeleteManufacturer/{id}',[SecondPhaseController::class,'DeleteManufacturer'])->middleware('isloggedin');

Route::get('/WarehouseList',[SecondPhaseController::class,'WarehouseList'])->middleware('isloggedin');
Route::get('/AddWarehouse/{id}',[SecondPhaseController::class,'AddWarehouse'])->middleware('isloggedin');
Route::post('/AddEditWarehouse/{id}',[SecondPhaseController::class,'AddEditWarehouse'])->middleware('isloggedin');
Route::post('/DeleteWarehouseData/{id}',[SecondPhaseController::class,'DeleteWarehouseData'])->middleware('isloggedin');

Route::get('/VendorList',[SecondPhaseController::class,'VendorList'])->middleware('isloggedin');
Route::get('/AddVendor/{id}',[SecondPhaseController::class,'AddVendor'])->middleware('isloggedin');
Route::post('/AddEditVendor/{id}',[SecondPhaseController::class,'AddEditVendor'])->middleware('isloggedin');
Route::post('/DeleteVendor/{id}',[SecondPhaseController::class,'DeleteVendor'])->middleware('isloggedin');

Route::get('/serialNumberList',[SecondPhaseController::class,'serialNumberList'])->middleware('isloggedin');
Route::get('/AddSerialNumber/{id}',[SecondPhaseController::class,'AddSerialNumber'])->middleware('isloggedin');
Route::post('/AddEditSerialNumber/{id}',[SecondPhaseController::class,'AddEditSerialNumber'])->middleware('isloggedin');
Route::post('/DeleteSerialNumber/{id}',[SecondPhaseController::class,'DeleteSerialNumber'])->middleware('isloggedin');

Route::get('/TaxList',[SecondPhaseController::class,'TaxList'])->middleware('isloggedin');
Route::get('/AddTax/{id}',[SecondPhaseController::class,'AddTax'])->middleware('isloggedin');
Route::post('/AddEditTax/{id}',[SecondPhaseController::class,'AddEditTax'])->middleware('isloggedin');
Route::post('/DeleteTax/{id}',[SecondPhaseController::class,'DeleteTax'])->middleware('isloggedin');

Route::get('/AddPatientInsurance/{PID}/{id}',[SecondPhaseController::class,'AddPatientInsurance'])->middleware('isloggedin');
Route::post('/AddEditPatientInsurance/{id}',[SecondPhaseController::class,'AddEditPatientInsurance'])->middleware('isloggedin');
Route::post('/DeletePatientInsurance/{id}',[SecondPhaseController::class,'DeletePatientInsurance'])->middleware('isloggedin');

Route::get('/OrdersList',[SecondPhaseController::class,'OrdersList'])->middleware('isloggedin');
Route::get('/getOrderItemDetails/{id}',[SecondPhaseController::class,'getOrderItemDetails'])->middleware('isloggedin');
Route::get('/AddOrders/{PatientID}/{id}',[SecondPhaseController::class,'AddOrders'])->middleware('isloggedin');
Route::get('/AddBatch/{id}/{pid}',[SecondPhaseController::class,'AddBatch'])->middleware('isloggedin');
Route::post('/updatePatientAmount/{id}',[SecondPhaseController::class,'updatePatientAmount'])->middleware('isloggedin');
Route::post('/AddEditOrders/{id}',[SecondPhaseController::class,'AddEditOrders'])->middleware('isloggedin');
Route::post('/UpdateOrder/{id}',[SecondPhaseController::class,'UpdateOrder'])->middleware('isloggedin');
Route::post('/updateOrderItem/{id}',[SecondPhaseController::class,'updateOrderItem'])->middleware('isloggedin');
Route::post('/saveOrderItem',[SecondPhaseController::class,'saveOrderItem'])->middleware('isloggedin');
Route::post('/AddDiagnosis',[SecondPhaseController::class,'AddDiagnosis'])->middleware('isloggedin');
Route::post('/DeleteOrders/{id}',[SecondPhaseController::class,'DeleteOrders'])->middleware('isloggedin');
Route::post('/deleteOrderItem/{id}',[SecondPhaseController::class,'deleteOrderItem'])->middleware('isloggedin');

Route::get('/get-customers',[SecondPhaseController::class,'getCustomers'])->middleware('isloggedin');
Route::get('/get-customer-details/{id}',[SecondPhaseController::class,'getCustomerDetails'])->middleware('isloggedin');
Route::get('/RetailSale',[SecondPhaseController::class,'RetailSale'])->middleware('isloggedin');
Route::get('/add-item',[SecondPhaseController::class,'addRetailItem'])->middleware('isloggedin');
Route::post('/AddRetailSale',[SecondPhaseController::class,'AddRetailSale'])->middleware('isloggedin');

Route::get('/NewDoctorList',[SecondPhaseController::class,'NewDoctorList'])->middleware('isloggedin');
Route::get('/AddNewDoctor/{id}',[SecondPhaseController::class,'AddNewDoctor'])->middleware('isloggedin');
Route::post('/add-doctor-type',[SecondPhaseController::class,'addDoctorType'])->middleware('isloggedin');
Route::post('/DeleteDoctorData/{id}',[SecondPhaseController::class,'DeleteDoctorData'])->middleware('isloggedin');
Route::post('/AddEditNewDoctor/{id}',[SecondPhaseController::class,'AddEditNewDoctor'])->middleware('isloggedin');
Route::post('/check-npi-status', [SecondPhaseController::class, 'checkNpiStatus']);

Route::get('/InsurancePriceCodeList',[SecondPhaseController::class,'InsurancePriceCode'])->middleware('isloggedin');

Route::get('/Reports',[SecondPhaseController::class,'Reports'])->middleware('isloggedin');

Route::get('/LocationList',[SecondPhaseController::class,'LocationList'])->middleware('isloggedin');
Route::get('/AddLocation/{id}',[SecondPhaseController::class,'AddLocation'])->middleware('isloggedin');
Route::post('/AddEditLocation/{id}',[SecondPhaseController::class,'AddEditLocation'])->middleware('isloggedin');
Route::post('/DeleteLocation/{id}',[SecondPhaseController::class,'DeleteLocation'])->middleware('isloggedin');

Route::get('/PreferredNotesList',[SecondPhaseController::class,'PreferredNotesList'])->middleware('isloggedin');
Route::get('/AddEditNotesPage/{id}',[SecondPhaseController::class,'AddEditNotesPage'])->middleware('isloggedin');
Route::post('/AddEditNotes/{id}',[SecondPhaseController::class,'AddEditNotes'])->middleware('isloggedin');
Route::post('/DeletePreferredNotes/{id}',[SecondPhaseController::class,'DeletePreferredNotes'])->middleware('isloggedin');

Route::get('/InvoicesList',[SecondPhaseController::class,'InvoicesList'])->middleware('isloggedin');
Route::get('/PendingInvoicesList',[SecondPhaseController::class,'PendingInvoicesList'])->middleware('isloggedin');
Route::get('/InvoiceDetail/{id}',[SecondPhaseController::class,'InvoiceDetail'])->middleware('isloggedin');
Route::post('/updateInvoiceDetail/{id}',[SecondPhaseController::class,'updateInvoiceDetail'])->middleware('isloggedin');
Route::get('/NewPayment/{id}/{type}',[SecondPhaseController::class,'NewPayment'])->middleware('isloggedin');
Route::get('/InvoiceTransaction/{id}/{status}/{for}',[SecondPhaseController::class,'InvoiceTransaction'])->middleware('isloggedin');
Route::post('/StoreTransaction/{id}',[SecondPhaseController::class,'StoreTransaction'])->middleware('isloggedin');

Route::get('/InsuranceCompanyList',[SecondPhaseController::class,'InsuranceCompanyList'])->middleware('isloggedin');
Route::get('/AddInsuranceCompany/{id}',[SecondPhaseController::class,'AddInsuranceCompany'])->middleware('isloggedin');
Route::post('/AddEditInsuranceCompany/{id}',[SecondPhaseController::class,'AddEditInsuranceCompany'])->middleware('isloggedin');
Route::post('/DeleteInsuranceCompany/{id}',[SecondPhaseController::class,'DeleteInsuranceCompany'])->middleware('isloggedin');

Route::get('/InsuranceGroupList',[SecondPhaseController::class,'InsuranceGroupList'])->middleware('isloggedin');
Route::get('/AddInsuranceGroup/{id}',[SecondPhaseController::class,'AddInsuranceGroup'])->middleware('isloggedin');
Route::post('/AddEditInsuranceGroup/{id}',[SecondPhaseController::class,'AddEditInsuranceGroup'])->middleware('isloggedin');
Route::post('/DeleteInsuranceGroup/{id}',[SecondPhaseController::class,'DeleteInsuranceGroup'])->middleware('isloggedin');

Route::get('/InvoiceFormList',[SecondPhaseController::class,'InvoiceFormList'])->middleware('isloggedin');
Route::get('/AddInvoiceForm/{id}',[SecondPhaseController::class,'AddInvoiceForm'])->middleware('isloggedin');
Route::post('/AddEditInvoiceForm/{id}',[SecondPhaseController::class,'AddEditInvoiceForm'])->middleware('isloggedin');
Route::post('/DeleteInvoiceForm/{id}',[SecondPhaseController::class,'DeleteInvoiceForm'])->middleware('isloggedin');

Route::get('/AbilityPayerList',[SecondPhaseController::class,'AbilityPayerList'])->middleware('isloggedin');
Route::get('/AddAbilityPayer/{id}',[SecondPhaseController::class,'AddAbilityPayer'])->middleware('isloggedin');
Route::post('/AddEditAbilityPayer/{id}',[SecondPhaseController::class,'AddEditAbilityPayer'])->middleware('isloggedin');
Route::post('/DeleteAbilityPayer/{id}',[SecondPhaseController::class,'DeleteAbilityPayer'])->middleware('isloggedin');

Route::get('/InsuranceTypeList',[SecondPhaseController::class,'InsuranceTypeList'])->middleware('isloggedin');
Route::get('/AddInsuranceType/{id}',[SecondPhaseController::class,'AddInsuranceType'])->middleware('isloggedin');
Route::post('/AddEditInsuranceType/{id}',[SecondPhaseController::class,'AddEditInsuranceType'])->middleware('isloggedin');
Route::post('/DeleteInsuranceType/{id}',[SecondPhaseController::class,'DeleteInsuranceType'])->middleware('isloggedin');

Route::get('/FormPOSTypeList',[SecondPhaseController::class,'FormPOSTypeList'])->middleware('isloggedin');
Route::get('/AddFormPOSType/{id}',[SecondPhaseController::class,'AddFormPOSType'])->middleware('isloggedin');
Route::post('/AddEditFormPOSType/{id}',[SecondPhaseController::class,'AddEditFormPOSType'])->middleware('isloggedin');
Route::post('/DeleteFormPOSType/{id}',[SecondPhaseController::class,'DeleteFormPOSType'])->middleware('isloggedin');

Route::get('/ICDNineList',[SecondPhaseController::class,'ICDNineList'])->middleware('isloggedin');
Route::get('/AddICDNine/{id}',[SecondPhaseController::class,'AddICDNine'])->middleware('isloggedin');
Route::post('/AddEditICDNine/{id}',[SecondPhaseController::class,'AddEditICDNine'])->middleware('isloggedin');
Route::post('/DeleteICDNine/{id}',[SecondPhaseController::class,'DeleteICDNine'])->middleware('isloggedin');

Route::get('/ICDTenList',[SecondPhaseController::class,'ICDTenList'])->middleware('isloggedin');
Route::get('/AddICDTen/{id}',[SecondPhaseController::class,'AddICDTen'])->middleware('isloggedin');
Route::post('/AddEditICDTen/{id}',[SecondPhaseController::class,'AddEditICDTen'])->middleware('isloggedin');
Route::post('/DeleteICDTen/{id}',[SecondPhaseController::class,'DeleteICDTen'])->middleware('isloggedin');

Route::post('/handle-payment', [SecondPhaseController::class, 'handlePayment'])->name('handle.payment'); //Stripe payment

Route::get('/generateClaimForm/{id}', [SecondPhaseController::class, 'generateClaimForm'])->middleware('isloggedin'); //claim form

Route::post('/import-users', [SecondPhaseController::class, 'import'])->middleware('isloggedin'); //import data
Route::get('/importFile', [SecondPhaseController::class, 'importFile'])->middleware('isloggedin'); //import data


//Second Phase Requests End


//Ajax request
Route::get('/GetPatientsUser/{id}',[MainController::class,'GetPatientsUser'])->middleware('isloggedin');
Route::get('/GetUserDepart/{id}',[MainController::class,'GetUserDepart'])->middleware('isloggedin');
Route::get('/PatientMainList',[MainController::class,'patientPendingList'])->middleware('isloggedin');
Route::get('/PatientStatusList/{id}',[MainController::class,'patientStatusPendingList'])->middleware('isloggedin');
Route::get('/PatientDepartmentList/{id}',[MainController::class,'patientDeptPendingList'])->middleware('isloggedin');
Route::get('/AllPatientList',[MainController::class,'AllPatientList'])->middleware('isloggedin');
//Ajax End

Route::get('/notifications',[MainController::class,'notifications']);
Route::get('/viewUser/{id}',[MainController::class,'viewUser']);
Route::get('/BackToLogin/{id}',[MainController::class,'BackToLogin']);
Route::get('/CheckUserLogin',[MainController::class,'CheckUserLogin'])->middleware('isloggedin');
Route::post('/mailToResupplyUser ',[MainController::class,'sendResupplyReminder'])->middleware('isloggedin');
Route::post('/send-reminder',[MainController::class,'sendReminders'])->middleware('isloggedin');
Route::post('/assignToResupplyUser',[MainController::class,'assignToResupplyUser'])->middleware('isloggedin');
Route::post('/BulkPatientChange',[MainController::class,'BulkPatientChange'])->middleware('isloggedin');

Route::get('/',[MainController::class,'index'])->middleware('isloggedin');
Route::post('/log', [MainController::class, 'store']);
Route::post('/AddDocument', [MainController::class, 'AddDocument']);
Route::get('/CancelRequest/{id}', [MainController::class, 'CancelRequest']);
Route::get('/CloseRequest/{id}', [MainController::class, 'CloseRequest']);
Route::get('/HoldRequest/{id}', [MainController::class, 'HoldRequest']);
Route::get('/ApproveRequest/{id}', [MainController::class, 'ApproveRequest']);
Route::get('/RejectRequest/{id}', [MainController::class, 'RejectRequest']);
Route::get('/RequestPatients/{id}', [MainController::class, 'RequestPatients']);
Route::post('/database_restore', [MainController::class, 'restore']);

Route::get('/FilteredUserPatient/{id}/{stid}',[MainController::class,'FilteredUserPatient']);
Route::get('/download-backup', 'App\Http\Controllers\MainController@createAndDownloadBackup');
Route::get('/backup&restore',[MainController::class,'backup_restore']);
Route::get('/changedPasswordFirst',[MainController::class,'OneTimePassword']);
Route::get('/FilterPatient',[MainController::class,'FilterPatient'])->middleware('isloggedin');
Route::get('/progress',[MainController::class,'Progress'])->middleware('isloggedin');
Route::get('/filterdeptprogress/{id}',[MainController::class,'filterDeptProgress'])->middleware('isloggedin');
Route::get('/FilterProgressPatient',[MainController::class,'FilterProgressPatient'])->middleware('isloggedin');
Route::get('/Reminders',[MainController::class,'Reminders'])->middleware('isloggedin');
Route::post('/AddReminders',[MainController::class,'AddReminders'])->middleware('isloggedin');

//Documents
Route::get('/get-patient-details/{id}',[MainController::class,'getDetails'])->middleware('isloggedin');
Route::get('/documentList',[MainController::class,'documentList'])->middleware('isloggedin');
Route::get('/getDocumentDetails/{id}',[MainController::class,'getDocumentDetails'])->middleware('isloggedin');
Route::post('/DeleteDocument/{id}',[MainController::class,'DeleteDocument'])->middleware('isloggedin');
Route::post('/EditDocument/{id}',[MainController::class,'EditDocument'])->middleware('isloggedin');
Route::get('/docs/{identifier}', [MainController::class, 'serveDocument'])->middleware('isloggedin');


Route::get('/DepartPatient/{id}',[MainController::class,'DepartPatient'])->middleware('isloggedin');
Route::get('/StatusPatient/{id}',[MainController::class,'StatusPatient'])->middleware('isloggedin');
Route::get('/ResupplyPatient/{id}',[MainController::class,'ResupplyPatient'])->middleware('isloggedin');
Route::get('/followUpPatient/{id}',[MainController::class,'followUpPatient'])->middleware('isloggedin');
Route::get('/subDept/{id}',[MainController::class,'subDept'])->middleware('isloggedin');
Route::get('/PatientReport',[MainController::class,'PatientReport']);
Route::get('/MainReport',[MainController::class,'MainPatientReport']);
Route::get('/LogsList',[MainController::class,'LogsList']);
Route::get('/HistoryList',[MainController::class,'HistoryList']);
Route::get('/Orders',[MainController::class,'OrderList']);
Route::get('/terms',[MainController::class,'terms']);
Route::post('/send-update-reminder', [MainController::class, 'sendUpdateReminder'])->name('sendUpdateReminder');


//sub Dept
Route::get('/addSubDept',[MainController::class,'addSubDept'])->middleware('isloggedin');
Route::get('/editSubDepart/{id}',[MainController::class,'editSubDepart'])->middleware('isloggedin');
Route::post('/EditSubDepartDetail/{id}',[MainController::class,'EditSubDepartDetail'])->middleware('isloggedin');
Route::get('/SubDepartList',[MainController::class,'SubDepartList'])->middleware('isloggedin');
Route::post('/RegisterSubDepart',[MainController::class,'RegisterSubDepart'])->middleware('isloggedin');
Route::post('/DeleteSubDepartment/{id}',[MainController::class,'DeleteSubDepartment'])->middleware('isloggedin');


//Patient Route
Route::get('/PatientAdd',[MainController::class,'AddPatient'])->middleware('isloggedin');
Route::get('/DepartmentUser/{id}',[MainController::class,'DepartmentUser'])->middleware('isloggedin');
Route::get('/PatientList',[MainController::class,'PatientList'])->middleware('isloggedin');
Route::get('/EditPatient/{id}',[MainController::class,'editPatient'])->middleware('isloggedin');
Route::get('/PatientDetail/{id}',[MainController::class,'PatientDetail'])->middleware('isloggedin');
Route::post('/EditPatientDetail/{id}',[MainController::class,'EditPatientDetail'])->middleware('isloggedin');
Route::post('/UpdatePatient/{id}',[MainController::class,'UpdatePatient'])->middleware('isloggedin');
Route::post('/DeletePatient/{id}',[MainController::class,'DeletePatient'])->middleware('isloggedin');
Route::post('/RegisterPatient',[MainController::class,'RegisterPatient'])->middleware('isloggedin');
Route::post('/AddNote/{id}',[MainController::class,'AddNote'])->middleware('isloggedin');
Route::post('/AddCoPayment',[SecondPhaseController::class,'AddCoPayment'])->middleware('isloggedin');


//Department Route
Route::get('/DepartmentAdd',[MainController::class,'AddDepart'])->middleware('isloggedin');
Route::get('/DepartmentList',[MainController::class,'DepartList'])->middleware('isloggedin');
Route::get('/EditDepartment/{id}',[MainController::class,'editDepart'])->middleware('isloggedin');
Route::post('/EditDepartmentDetail/{id}',[MainController::class,'EditDepartDetail'])->middleware('isloggedin');
Route::post('/DeleteDepartment/{id}',[MainController::class,'DeleteDepart'])->middleware('isloggedin');
Route::post('/RegisterDepartment',[MainController::class,'RegisterDepart'])->middleware('isloggedin');


//Status Route
Route::get('/StatusAdd',[MainController::class,'AddStatus'])->middleware('isloggedin');
Route::get('/StatusList',[MainController::class,'StatusList'])->middleware('isloggedin');
Route::get('/EditStatus/{id}',[MainController::class,'editStatus'])->middleware('isloggedin');
Route::post('/EditStatusDetail/{id}',[MainController::class,'EditStatusDetail'])->middleware('isloggedin');
Route::post('/DeleteStatus/{id}',[MainController::class,'DeleteStatus'])->middleware('isloggedin');
Route::post('/RegisterStatus',[MainController::class,'RegisterStatus'])->middleware('isloggedin');

//Doctor Route
Route::get('/DoctorAdd',[MainController::class,'AddDoctor'])->middleware('isloggedin');
Route::get('/DoctorList',[MainController::class,'DoctorList'])->middleware('isloggedin');
Route::get('/EditDoctor/{id}',[MainController::class,'EditDoctor'])->middleware('isloggedin');
Route::post('/EditDoctorDetail/{id}',[MainController::class,'EditDoctorDetail'])->middleware('isloggedin');
Route::post('/DeleteDoctor/{id}',[MainController::class,'DeleteDoctor'])->middleware('isloggedin');
Route::post('/RegisterDoctor',[MainController::class,'RegisterDoctor'])->middleware('isloggedin');

//Login Route
Route::post('/LoginUser',[MainController::class,'LoginUser'])->middleware('Alreadyloggedin');
Route::post('/UpdatePassword',[MainController::class,'UpdatePassword']);
Route::post('/UpdateChangePassword',[MainController::class,'UpdateChangePassword']);
Route::post('/VerifyOTP',[MainController::class,'VerifyOTP'])->middleware('Alreadyloggedin');;
Route::get('/AuthMail',[MainController::class,'AuthenticationMail'])->middleware('Alreadyloggedin');;
Route::get('/Login',[MainController::class,'login'])->middleware('Alreadyloggedin');
Route::get('/OTPVerify',[MainController::class,'OTPVerify'])->middleware('Alreadyloggedin');
Route::get('/forgetPassword',[MainController::class,'forgetPassword']);
Route::get('/ChangePassword',[MainController::class,'ChangePassword']);
Route::get('/logout',[MainController::class,'logout']);


//User Route
Route::post('/RegisterUser',[MainController::class,'RegisterUser'])->middleware('isloggedin');
Route::post('/EditUser/{id}',[MainController::class,'EditUserDetail'])->middleware('isloggedin');
Route::post('/DeleteUser/{id}',[MainController::class,'DeleteUser'])->middleware('isloggedin');
Route::post('/BanUser/{id}',[MainController::class,'BanUser'])->middleware('isloggedin');
Route::get('/UserAdd',[MainController::class,'AddUser'])->middleware('isloggedin');
Route::get('/UserList',[MainController::class,'UserList'])->middleware('isloggedin');
Route::get('/Useredit/{id}',[MainController::class,'EditUser'])->middleware('isloggedin');
Route::get('/userDetail/{id}',[MainController::class,'userDetail'])->middleware('isloggedin');
