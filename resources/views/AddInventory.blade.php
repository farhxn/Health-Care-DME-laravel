<?php
if (isset($inventory)) {
    $inventory->DiagnoseCode = isset($inventory->DiagnoseCode) ? json_decode($inventory->DiagnoseCode, true) : [];
    $inventory->itemQuantity = isset($inventory->itemQuantity) ? json_decode($inventory->itemQuantity, true) : [];
}
$selectedWarehouses = isset($inventory) ? json_decode($inventory->warehouse, true) : [];
?>

<style>
    .quantity-heading {
        display: block;
        font-size: 1.2rem;
        font-weight: bold;
        color: #ffffff;
        background-color: #007bff;
        padding: 10px 15px;
        margin-bottom: 5px;
        border-radius: 8px;
        text-align: center;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    }
</style>
<?php
$title =  isset($inventory) ? 'Update Inventory Item' : 'Add Inventory Item';
?>
@section('title', $title)
@include('layout.Head')

<div class="dashboard-wrapper">
    <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2 class="pageheader-title">{{ isset($inventory) ? 'Update Inventory Item' : 'Add Inventory Item'}}</h2>
                    </div>
                </div>
            </div>
            <br>

            <div class="ecommerce-widget">
                <div class="row">
                    <div class="col">
                        <form method="post" action="{{ url('AddEditInventoryItem',isset($inventory) ? $inventory->id : 0) }}">
                            @csrf
                            <div class="card">
                                <br>
                                @if ($errors->any())
                                <div class="row">
                                    <div class="col">
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                <div class="row">
                                    <div class="col-12">
                                        <div class="d-flex justify-content-between align-items-center m-3">
                                            <!-- Heading aligned to the left -->
                                            <h2 class="pageheader-title"> </h2>
                                            <a href="#" class="btn btn-primary disabled">Inventory # {{ isset($inventory) ? $inventory->id : $Iid }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label class="col-form-label">Item Name:</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" required placeholder="Item Name" name="Item_Name" class="form-control form-control-sm"
                                                        value="{{ isset($inventory) ? $inventory->Item_Name : old('Item_Name') }}">

                                                </div>
                                                <span><small class="text-danger font-weight-light font-italic">
                                                        @error('Item_Name')
                                                        {{ $message }}
                                                        @enderror
                                                    </small></span>
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div class="form-group">
                                                <label class="col-form-label">Diagnose Code:</label>
                                                <div class="input-group mb-3">
                                                    <select class="select2 form-control form-control-sm" id="Diagnosis" multiple="multiple" required name="DiagnoseCode[]">
                                                        @foreach ($icd10 as $icd)
                                                        <option value="{{ $icd->Code }}"
                                                            {{ in_array($icd->Code, old('DiagnoseCode', $inventory->DiagnoseCode ?? [])) ? 'selected' : '' }}>
                                                            {{ $icd->Code }}
                                                        </option>

                                                        @endforeach
                                                    </select>
                                                </div>
                                                <span>
                                                    <small class="text-danger font-weight-light font-italic">
                                                        @error('DiagnoseCode')
                                                        {{ $message }}
                                                        @enderror
                                                    </small>
                                                </span>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <label id="PlaceholderForQuantity" class="quantity-heading">It's a place to enter the quantity of items in a warehouse <br> <br> <sup><u>Select Warehouse First!!!! </u></sup> <br> </label>
                                            <div id="quantityInputsContainer" data-existing-quantities="{{ json_encode($inventory->itemQuantity ?? []) }}">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label class="col-form-label">Warehouse:</label>
                                                <div class="input-group mb-3">

                                                    <select class="select2 form-control form-control-sm" id="Warehouse" required name="warehouse[]" multiple>
                                                        @foreach ($warehouse as $wh)
                                                        <option value="{{ $wh->Warehouse_Name }}"
                                                            {{ in_array($wh->Warehouse_Name, $selectedWarehouses) ? 'selected' : '' }}>
                                                            {{ $wh->Warehouse_Name }}
                                                        </option>
                                                        @endforeach
                                                    </select>

                                                </div>
                                                <span>
                                                    <small class="text-danger font-weight-light font-italic">
                                                        @error('warehouse')
                                                        {{ $message }}
                                                        @enderror
                                                    </small>
                                                </span>
                                            </div>

                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label class="col-form-label">Inventory Code</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" required placeholder="Inventory Code" name="Inventory_Code" class="form-control form-control-sm"
                                                        value="{{ isset($inventory) ? $inventory->Inventory_Code : old('Inventory_Code') }}">

                                                </div>
                                                <span><small class="text-danger font-weight-light font-italic">
                                                        @error('Inventory_Code')
                                                        {{ $message }}
                                                        @enderror
                                                    </small></span>
                                            </div>


                                            <div class="form-group">
                                                <label class="col-form-label">Manufacturer</label>
                                                <div class="input-group mb-3">
                                                    <select class="form-control form-control-sm" id="status-dropdown" required name="Manufacturer">
                                                        <option {{ old('Manufacturer', isset($inventory) ? $inventory->Manufacture_Name : '') == '' ? 'selected' : '' }} disabled>Manufacturer</option>
                                                        @foreach ($manufacture as $manu)
                                                        <option value="{{ $manu->Manufacture_Name }}" {{ old('Manufacturer', isset($inventory) ? $inventory->Manufacturer : '') == $manu->Manufacture_Name ? 'selected' : '' }}>{{ $manu->Manufacture_Name }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <span><small class="text-danger font-weight-light font-italic">
                                                        @error('Manufacturer')
                                                        {{ $message }}
                                                        @enderror
                                                    </small></span>
                                            </div>


                                            <div class="form-group">
                                                <label class="col-form-label">Barcode Type:</label>
                                                <div class="input-group mb-3">
                                                    <input type="number" required placeholder="Barcode Type:" name="Barcode_Type"
                                                        class="form-control form-control-sm" value="{{ isset($inventory) ? $inventory->Barcode_Type : old('Barcode_Type') }}">
                                                </div>
                                                <span><small class="text-danger font-weight-light font-italic">
                                                        @error('Barcode_Type')
                                                        {{ $message }}
                                                        @enderror
                                                    </small></span>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-form-label">Predefined Text</label>
                                                <div class="input-group mb-3">
                                                    <select class="form-control form-control-sm" id="status-dropdown" required name="Predefined_Text">
                                                        <option {{ old('Predefined_Text', isset($inventory) ? $inventory->Predefined_Text : '') == '' ? 'selected' : '' }} disabled>Predefined Text</option>
                                                        @foreach ($PreNotes as $notes)
                                                        <option value="{{ $notes->Name }}" {{ old('Predefined_Text', isset($inventory) ? $inventory->Predefined_Text : '') == $notes->Name ? 'selected' : '' }}>{{ $notes->Name }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <span><small class="text-danger font-weight-light font-italic">
                                                        @error('Predefined_Text')
                                                        {{ $message }}
                                                        @enderror
                                                    </small></span>
                                            </div>
                                        </div>

                                        <div class="col-6">


                                            <div class="form-group">
                                                <label class="col-form-label">Model #</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" required placeholder="Model" name="Model"
                                                        class="form-control form-control-sm" value="{{ isset($inventory) ? $inventory->Model : old('Model') }}">
                                                </div>
                                                <span><small class="text-danger font-weight-light font-italic">
                                                        @error('Model')
                                                        {{ $message }}
                                                        @enderror
                                                    </small></span>
                                            </div>



                                            <div class="form-group">
                                                <label class="col-form-label col-form-label-sm">Product Type</label>
                                                <div class="input-group">
                                                    <select class="form-control form-control-sm" id="Product-dropdown" required name="Product_Type">
                                                        <option {{ old('Product_Type', isset($inventory) ? $inventory->Product_Type : '') == '' ? 'selected' : '' }} disabled>Product Type</option>
                                                        @foreach ($ProductType as $pt)
                                                        <option value="{{ $pt->Product_Type }}" {{ old('Product_Type', isset($inventory) ? $inventory->Product_Type : '') == $pt->Product_Type ? 'selected' : '' }}>{{ $pt->Product_Type }}
                                                        </option>
                                                        @endforeach
                                                    </select>


                                                    <div class="input-group-append">
                                                        <button type="button" class="btn  btn-primary" data-toggle="modal" data-target="#addDoctorTypeModal">
                                                            <i class="fa fa-plus"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <span><small class="text-danger font-weight-light font-italic">
                                                        @error('Product_Type')
                                                        {{ $message }}
                                                        @enderror
                                                    </small></span>
                                            </div>







                                            <div class="form-group">
                                                <label class="col-form-label">Barcode</label>
                                                <div class="input-group mb-3">
                                                    <input type="number" required placeholder="Barcode" name="Barcode"
                                                        class="form-control form-control-sm" value="{{ isset($inventory) ? $inventory->Barcode : old('Barcode') }}">
                                                </div>
                                                <span><small class="text-danger font-weight-light font-italic">
                                                        @error('Barcode')
                                                        {{ $message }}
                                                        @enderror
                                                    </small></span>
                                            </div>


                                            <div class="form-group">
                                                <label class="col-form-label">Vendor</label>
                                                <div class="input-group mb-3">
                                                    <select class="form-control form-control-sm" required name="Vendor">
                                                        <option {{ old('Vendor', isset($inventory) ? $inventory->Vendor : '') == '' ? 'selected' : '' }} disabled>Vendor</option>
                                                        @foreach ($vendor as $ven)
                                                        <option value="{{ $ven->id }}" {{ old('Vendor', isset($inventory) ? $inventory->Vendor : '') == $ven->id ? 'selected' : '' }}>{{ $ven->Vendor_Name }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <span><small class="text-danger font-weight-light font-italic">
                                                        @error('Vendor')
                                                        {{ $message }}
                                                        @enderror
                                                    </small></span>
                                            </div>
                                        </div>

                                        <div class="container">
                                            <div class="row justify-content-center">
                                                <div class="col-auto">
                                                    <div class="form-group form-check">
                                                        <input type="checkbox" class="form-check-input" id="exampleCheck1" checked name="O2Tank">
                                                        <span class="form-check-label">O2&nbsp;Tank </span>
                                                    </div>
                                                </div>

                                                <div class="col-auto">
                                                    <div class="form-group form-check">
                                                        <input type="checkbox" class="form-check-input" id="exampleCheck1" checked name="Service">
                                                        <span class="form-check-label">Service </span>
                                                    </div>
                                                </div>

                                                <div class="col-auto">
                                                    <div class="form-group form-check">
                                                        <input type="checkbox" class="form-check-input" id="exampleCheck1" checked name="Serialized">
                                                        <span class="form-check-label">Serialized </span>
                                                    </div>
                                                </div>

                                                <div class="col-auto">
                                                    <div class="form-group form-check">
                                                        <input type="checkbox" class="form-check-input" id="exampleCheck1" checked name="Inactive">
                                                        <span class="form-check-label">Inactive </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="container">
                                            <div class="row justify-content-center">
                                                <div class="col-md-4 mb-3">
                                                    <div class="form-group">
                                                        <label class="col-form-label">Purchase Price</label>
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                            </div>
                                                            <input type="text" class="form-control form-control-sm" placeholder="Purchase Price" name="Purchase_Price" required value="{{ isset($inventory) ? $inventory->Purchase_Price : old('Purchase_Price') }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <div class="form-group">
                                                        <label class="col-form-label">MAP Price</label>
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                            </div>
                                                            <input type="text" class="form-control form-control-sm" placeholder="MAP Price" name="MAP_Price" required value="{{ isset($inventory) ? $inventory->MAP_Price : old('MAP_Price') }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <div class="form-group">
                                                        <label class="col-form-label">MSRP Price</label>
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                            </div>
                                                            <input type="text" class="form-control form-control-sm" placeholder="MSRP Price" name="MSRPPrice" required value="{{ isset($inventory) ? $inventory->MSRPPrice : old('MSRPPrice') }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row justify-content-center">
                                                <div class="col-md-4 mb-3">
                                                    <div class="form-group">
                                                        <label class="col-form-label">Total Sell Items</label>
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                            </div>
                                                            <input type="text" class="form-control form-control-sm" placeholder="Total Sell Items" name="TotalSellItems" required value="{{ isset($inventory) ? $inventory->TotalSellItems : old('TotalSellItems') }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <div class="form-group">
                                                        <label class="col-form-label">In-Stock Qty</label>
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                            </div>
                                                            <input type="text" class="form-control form-control-sm" placeholder="In-Stock Qty" name="InStockQty" required value="{{ isset($inventory) ? $inventory->InStockQty : old('InStockQty') }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <div class="form-group">
                                                        <label class="col-form-label">Inv Code</label>
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                            </div>
                                                            <input type="text" class="form-control form-control-sm" placeholder="Inv Code" name="Inv_Code" required value="{{ isset($inventory) ? $inventory->Inv_Code : old('Inv_Code') }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>


                                        <div class="container">
                                            <div class="row justify-content-center">
                                                <div class="col-md-4 mb-3">

                                                    <div class="form-group">
                                                        <label class="col-form-label">Basis</label>
                                                        <div class="input-group mb-3">
                                                            <select class="form-control form-control-sm" id="status-dropdown" required name="Basis">
                                                                <option {{ old('Basis', isset($inventory) ? $inventory->Basis : '') == '' ? 'selected' : '' }} disabled>Basis</option>
                                                                <option value="Bill" {{ old('Basis', isset($inventory) ? $inventory->Basis : '') == 'Bill' ? 'selected' : '' }}>Bill</option>
                                                                <option value="Allowed" {{ old('Basis', isset($inventory) ? $inventory->Basis : '') == 'Allowed' ? 'selected' : '' }}>Allowed </option>
                                                            </select>
                                                        </div>
                                                        <span><small class="text-danger font-weight-light font-italic">
                                                                @error('Basis')
                                                                {{ $message }}
                                                                @enderror
                                                            </small></span>
                                                    </div>

                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <div class="form-group">
                                                        <label class="col-form-label">Paid At</label>
                                                        <div class="input-group mb-3">
                                                            <select class="form-control form-control-sm" id="status-dropdown" required name="PaidAt">
                                                                <option {{ old('PaidAt', isset($inventory) ? $inventory->PaidAt : '') == '' ? 'selected' : '' }} disabled>Paid At</option>
                                                                <option value="Billing" {{ old('PaidAt', isset($inventory) ? $inventory->PaidAt : '') == 'Billing' ? 'selected' : '' }}>Billing </option>
                                                                <option value="Payment" {{ old('PaidAt', isset($inventory) ? $inventory->PaidAt : '') == 'Payment' ? 'selected' : '' }}>Payment </option>
                                                                <option value="Never" {{ old('PaidAt', isset($inventory) ? $inventory->PaidAt : '') == 'Never' ? 'selected' : '' }}>Never </option>
                                                            </select>
                                                        </div>
                                                        <span><small class="text-danger font-weight-light font-italic">
                                                                @error('PaidAt')
                                                                {{ $message }}
                                                                @enderror
                                                            </small></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <div class="form-group">
                                                        <label class="col-form-label">Frequency</label>
                                                        <div class="input-group mb-3">
                                                            <select class="form-control form-control-sm" id="status-dropdown" required name="Frequency">
                                                                <option {{ old('Frequency', isset($inventory) ? $inventory->Frequency : '') == '' ? 'selected' : '' }} disabled>Frequency</option>
                                                                <option value="One Time" {{ old('Frequency', isset($inventory) ? $inventory->Frequency : '') == 'One Time' ? 'selected' : '' }}>One Time </option>
                                                                <option value="Monthly" {{ old('Frequency', isset($inventory) ? $inventory->Frequency : '') == 'Monthly' ? 'selected' : '' }}>Monthly </option>
                                                                <option value="Weekly" {{ old('Frequency', isset($inventory) ? $inventory->Frequency : '') == 'Weekly' ? 'selected' : '' }}>Weekly </option>
                                                                <option value="Never" {{ old('Frequency', isset($inventory) ? $inventory->Frequency : '') == 'Never' ? 'selected' : '' }}>Never </option>
                                                            </select>
                                                        </div>
                                                        <span><small class="text-danger font-weight-light font-italic">
                                                                @error('Frequency')
                                                                {{ $message }}
                                                                @enderror
                                                            </small></span>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                    <div class="card-body border-top">
                                        <div class="form-group">
                                            <div class="input-group mb-3">
                                                <div class="input-group">
                                                    <button type="submit" class="btn btn-block"
                                                        style="background-color: #427ed1; color: white;">Submit</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>



    @include('layout.footer')

    <style>
        .modal-blur {
            filter: blur(5px);
            /* Blur only the modal background */
            pointer-events: none;
            /* Prevent interactions with blurred content */
        }

        .modal-loader-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.7);
            /* Semi-transparent overlay */
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1050;
            /* Ensure it's on top of the modal content */
        }
    </style>

    <!-- Modal -->
    <div class="modal fade" id="addDoctorTypeModal" tabindex="-1" role="dialog" aria-labelledby="addDoctorTypeModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addDoctorTypeModalLabel">Add Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body modal-blur-content">
                    <form id="addDoctorTypeForm">
                        <div class="form-group">
                            <label>Product Type</label>
                            <input type="text" class="form-control" id="doctorTypeName" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
                <div id="modalLoader" class="modal-loader-overlay" style="display:none;">
                    <span class="dashboard-spinner spinner-warning spinner-sm"></span>
                </div>
            </div>
        </div>
    </div>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css">
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>

    <script>
        $(document).ready(function() {
            logAction("Add Inventory Item Page Loaded");

            $('#Warehouse').select2({
                placeholder: "Select Warehouse",
                allowClear: true
            });

            $('#Diagnosis').select2({
                placeholder: "Select Diagnosis",
                allowClear: true
            });

            const existingQuantities = JSON.parse(document.getElementById('quantityInputsContainer').getAttribute('data-existing-quantities') || '{}');
            const selectedWarehouses = Object.keys(existingQuantities);

            $('#Warehouse').val(selectedWarehouses).trigger('change');

            populateQuantityInputs();

            $('#Warehouse').on('change', populateQuantityInputs);

            function populateQuantityInputs() {
                const selectedWarehouses = $('#Warehouse').val() || [];
                const container = document.getElementById('quantityInputsContainer');
                container.innerHTML = ''; // Clear existing fields
                if (selectedWarehouses && selectedWarehouses.length != 0) {
                    $('#PlaceholderForQuantity').hide();
                    console.log(true);
                    console.log(selectedWarehouses);
                } else {
                    console.log(false);
                    $('#PlaceholderForQuantity').show();
                }

                selectedWarehouses.forEach(warehouse => {
                    const trimmedWarehouse = warehouse.trim();
                    const quantityValue = existingQuantities[trimmedWarehouse] || '';

                    const div = document.createElement('div');
                    div.classList.add('form-group', 'mb-3');

                    div.innerHTML = `
                <label class="col-form-label">Item Quantity for ${trimmedWarehouse}:</label>
                <input type="number" required placeholder="Item Quantity" min="1" 
                       name="itemQuantity[${trimmedWarehouse}]" 
                       class="form-control form-control-sm" 
                       value="${quantityValue}" />
        
            `;
                    container.appendChild(div);
                });
            }

            function getExistingQuantities() {
                const quantities = {};
                $('#quantityInputsContainer input[name^="itemQuantity"]').each(function() {
                    const warehouse = $(this).attr('name').match(/\[([^\]]+)\]/)[1];
                    quantities[warehouse] = $(this).val();
                });
                return quantities;
            }
        });



        $('#addDoctorTypeForm').on('submit', function(e) {
            e.preventDefault();
            var doctorTypeName = $('#doctorTypeName').val();
            $('.modal-blur-content').addClass('modal-blur');
            $('#modalLoader').show();

            $.ajax({
                url: '/addProductType',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    name: doctorTypeName
                },
                success: function(response) {
                    $('#Product-dropdown').append(`<option value="${response.name}">${response.name}</option>`);
                    $('#addDoctorTypeModal').modal('hide');
                    $('#addDoctorTypeForm')[0].reset();
                },
                error: function(xhr, status, error) {
                    alert('Something went wrong, please try again.');
                },
                complete: function() {
                    $('.modal-blur-content').removeClass('modal-blur');
                    $('#modalLoader').hide();
                }
            });
        });
    </script>