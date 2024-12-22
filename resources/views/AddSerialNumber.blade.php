<?php
$title =  isset($serial) ? 'Update Serial Number' : 'Add Serial Number';
?>
@section('title', $title)
@include('layout.Head')

<div class="dashboard-wrapper">
    <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-center">
                        <!-- Heading aligned to the left -->
                        <h2 class="pageheader-title">{{ isset($serial) ? 'Update Serial Number' : 'Serial Number'}}</h2>

                    </div>
                </div>
            </div>
            <br>

            <div class="ecommerce-widget">

                <div class="row">


                    <div class="col">
                        <form method="post" action="{{ url('AddEditSerialNumber',isset($serial) ? $serial->id : 0) }}">
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
                                            <h2 class="pageheader-title">{{ isset($serial) ? 'Edit Serial Number' : 'Create Serial Number' }}</h2>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">

                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label class="col-form-label">Serial Number</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" required placeholder="Serial Number" name="SerialNumber"
                                                        class="form-control form-control-sm" value="{{ isset($serial) ? $serial->SerialNumber : old('SerialNumber') }}">
                                                </div>
                                                <span><small class="text-danger font-weight-light font-italic">
                                                        @error('SerialNumber')
                                                        {{ $message }}
                                                        @enderror
                                                    </small></span>
                                            </div>

                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label class="col-form-label">Inventory Code</label>
                                                <div class="input-group mb-3">
                                                    <select class="form-control form-control-sm" id="status-dropdown" required name="InventoryCode">
                                                        <option {{ old('InventoryCode', isset($serial) ? $serial->InventoryCode : '') == '' ? 'selected' : '' }} disabled>Inventory Code</option>
                                                        @foreach ($inventory as $drs)
                                                        <option value="{{ $drs->Item_Name }}" {{ old('InventoryCode', isset($serial) ? $serial->InventoryCode : '') == $drs->Item_Name ? 'selected' : '' }}>{{ $drs->Item_Name }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <span><small class="text-danger font-weight-light font-italic">
                                                        @error('InventoryCode')
                                                        {{ $message }}
                                                        @enderror
                                                    </small></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label class="col-form-label">Status</label>
                                                <div class="input-group mb-3">
                                                    <select class="form-control form-control-sm" id="status-dropdown" required name="Status">
                                                        <option {{ old('Status', isset($serial) ? $serial->Status : '') == '' ? 'selected' : '' }} disabled>Status</option>
                                                        @foreach ($st as $drs)
                                                        <option value="{{ $drs->id }}" {{ old('Status', isset($serial) ? $serial->Status : '') == $drs->id ? 'selected' : '' }}>{{ $drs->Status }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <span><small class="text-danger font-weight-light font-italic">
                                                        @error('Status')
                                                        {{ $message }}
                                                        @enderror
                                                    </small></span>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-6">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label class="col-form-label">Length Of Warranty</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" required placeholder="Length of Warranty" name="WarrantyLength"
                                                            class="form-control form-control-sm" value="{{ isset($serial) ? $serial->WarrantyLength : old('WarrantyLength') }}">
                                                    </div>
                                                    <span><small class="text-danger font-weight-light font-italic">
                                                            @error('WarrantyLength')
                                                            {{ $message }}
                                                            @enderror
                                                        </small></span>
                                                </div>
                                            </div>

                                            <div class="col">
                                                <div class="form-group">
                                                    <label class="col-form-label">Warranty</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" required placeholder="Warranty" name="Warranty"
                                                            class="form-control form-control-sm" value="{{ isset($serial) ? $serial->Warranty : old('Warranty') }}">
                                                    </div>
                                                    <span><small class="text-danger font-weight-light font-italic">
                                                            @error('Warranty')
                                                            {{ $message }}
                                                            @enderror
                                                        </small></span>
                                                </div>

                                            </div>

                                            <div class="col">
                                                <div class="form-group">
                                                    <label class="col-form-label">Manufacturer</label>
                                                    <div class="input-group mb-3">
                                                        <select class="form-control form-control-sm" id="status-dropdown" required name="Manufacturer">
                                                            <option {{ old('Manufacturer', isset($serial) ? $serial->Manufacturer : '') == '' ? 'selected' : '' }} disabled>Manufacturer</option>
                                                            @foreach ($manufacture as $drs)
                                                            <option value="{{ $drs->Manufacture_Name }}" {{ old('Manufacturer', isset($serial) ? $serial->Manufacturer : '') == $drs->Manufacture_Name ? 'selected' : '' }}>{{ $drs->Manufacture_Name }}
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
                                            </div>

                                            <div class="col">
                                                <div class="form-group">
                                                    <label class="col-form-label"> Manufacturer Serial Number</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" required placeholder="Manufacturer Serial Number" name="ManufacturerSerialNumber"
                                                            class="form-control form-control-sm" value="{{ isset($serial) ? $serial->ManufacturerSerialNumber : old('ManufacturerSerialNumber') }}">
                                                    </div>
                                                    <span><small class="text-danger font-weight-light font-italic">
                                                            @error('ManufacturerSerialNumber')
                                                            {{ $message }}
                                                            @enderror
                                                        </small></span>
                                                </div>

                                            </div>

                                            <div class="col">
                                                <div class="form-group">
                                                    <label class="col-form-label">Model</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" required placeholder="Model" name="Model"
                                                            class="form-control form-control-sm" value="{{ isset($serial) ? $serial->Model : old('Model') }}">
                                                    </div>
                                                    <span><small class="text-danger font-weight-light font-italic">
                                                            @error('Model')
                                                            {{ $message }}
                                                            @enderror
                                                        </small></span>
                                                </div>

                                            </div>

                                            <div class="col">
                                                <div class="form-group">
                                                    <label class="col-form-label">Warehouse</label>
                                                    <div class="input-group mb-3">
                                                        <select class="form-control form-control-sm" id="status-dropdown" required name="Warehouse">
                                                            <option {{ old('Warehouse', isset($serial) ? $serial->Warehouse : '') == '' ? 'selected' : '' }} disabled>Warehouse</option>
                                                            @foreach ($warehouse as $drs)
                                                            <option value="{{ $drs->Warehouse_Name }}" {{ old('Warehouse', isset($serial) ? $serial->Warehouse : '') == $drs->Warehouse_Name ? 'selected' : '' }}>{{ $drs->Warehouse_Name }}
                                                            </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <span><small class="text-danger font-weight-light font-italic">
                                                            @error('Warehouse')
                                                            {{ $message }}
                                                            @enderror
                                                        </small></span>
                                                </div>
                                            </div>


                                            <div class="col">
                                                <div class="form-group">
                                                    <label class="col-form-label">Purchase Amount</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" required placeholder="Purchase Amount" name="PurchaseAmount"
                                                            class="form-control form-control-sm" value="{{ isset($serial) ? $serial->PurchaseAmount : old('PurchaseAmount') }}">
                                                    </div>
                                                    <span><small class="text-danger font-weight-light font-italic">
                                                            @error('PurchaseAmount')
                                                            {{ $message }}
                                                            @enderror
                                                        </small></span>
                                                </div>

                                            </div>

                                            <div class="col">
                                                <div class="form-group">
                                                    <label class="col-form-label">Purchase Date</label>
                                                    <div class="input-group mb-3">
                                                        <input type="date" required placeholder="Purchase Date" name="PurchaseDate"
                                                            class="form-control form-control-sm" value="{{ isset($serial) ? $serial->PurchaseDate : old('PurchaseDate') }}">
                                                    </div>
                                                    <span><small class="text-danger font-weight-light font-italic">
                                                            @error('PurchaseDate')
                                                            {{ $message }}
                                                            @enderror
                                                        </small></span>
                                                </div>
                                            </div>

                                            <div class="col">
                                                <div class="form-group">
                                                    <label class="col-form-label">Sold Date</label>
                                                    <div class="input-group mb-3">
                                                        <input type="date" required placeholder="Sold Date" name="SoldDate"
                                                            class="form-control form-control-sm" value="{{ isset($serial) ? $serial->SoldDate : old('SoldDate') }}">
                                                    </div>
                                                    <span><small class="text-danger font-weight-light font-italic">
                                                            @error('SoldDate')
                                                            {{ $message }}
                                                            @enderror
                                                        </small></span>
                                                </div>

                                            </div>

                                            <div class="col">
                                                <div class="form-group">
                                                    <label class="col-form-label">Next Maintenance Date</label>
                                                    <div class="input-group mb-3">
                                                        <input type="date" required placeholder="Next Maintenance Date" name="NextMaintenanceDate"
                                                            class="form-control form-control-sm" value="{{ isset($serial) ? $serial->NextMaintenanceDate : old('NextMaintenanceDate') }}">
                                                    </div>
                                                    <span><small class="text-danger font-weight-light font-italic">
                                                            @error('NextMaintenanceDate')
                                                            {{ $message }}
                                                            @enderror
                                                        </small></span>
                                                </div>

                                            </div>


                                        </div>
                                        <div class="col-6">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label class="col-form-label">Months Rented</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" required placeholder="Months Rented" name="MonthsRented"
                                                            class="form-control form-control-sm" value="{{ isset($serial) ? $serial->MonthsRented : old('MonthsRented') }}">
                                                    </div>
                                                    <span><small class="text-danger font-weight-light font-italic">
                                                            @error('MonthsRented')
                                                            {{ $message }}
                                                            @enderror
                                                        </small></span>
                                                </div>

                                            </div>

                                            <div class="col">

                                                <div class="form-group">
                                                    <label class="col-form-label">Current Customer</label>
                                                    <select id="customer-select" class="form-control form-control-sm" name="CurrentCustomer" required></select>
                                                    <span><small class="text-danger font-weight-light font-italic">
                                                            @error('Customer')
                                                            {{ $message }}
                                                            @enderror
                                                        </small></span>
                                                </div>
                                                <input type="hidden" id="current-customer-id" value="{{ old('CurrentCustomer', isset($serial) ? $serial->CurrentCustomer : '') }}">

                                            </div>

                                            <div class="col">

                                                <div class="form-group">
                                                    <label class="col-form-label">Last Customer</label>
                                                    <select id="customer-select-2" class="form-control form-control-sm" name="LastCustomer" required></select>
                                                    <span><small class="text-danger font-weight-light font-italic">
                                                            @error('Customer')
                                                            {{ $message }}
                                                            @enderror
                                                        </small></span>
                                                </div>
                                                <input type="hidden" id="Last-customer-id" value="{{ old('LastCustomer', isset($serial) ? $serial->LastCustomer : '') }}">

                                            </div>

                                            <div class="col">
                                                <div class="form-group">
                                                    <label class="col-form-label">Vendor</label>
                                                    <div class="input-group mb-3">
                                                        <select class="form-control form-control-sm" id="status-dropdown" required name="Vendor">
                                                            <option {{ old('Vendor', isset($serial) ? $serial->Vendor : '') == '' ? 'selected' : '' }} disabled>Vendor</option>
                                                            @foreach ($vendor as $drs)
                                                            <option value="{{ $drs->Vendor_Name }}" {{ old('Vendor', isset($serial) ? $serial->Vendor : '') == $drs->Vendor_Name ? 'selected' : '' }}>{{ $drs->Vendor_Name }}
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

                                            <div class="col">
                                                <div class="form-group">
                                                    <label class="col-form-label">Lot Number</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" required placeholder="Lot Number" name="LotNumber"
                                                            class="form-control form-control-sm" value="{{ isset($serial) ? $serial->LotNumber : old('LotNumber') }}">
                                                    </div>
                                                    <span><small class="text-danger font-weight-light font-italic">
                                                            @error('LotNumber')
                                                            {{ $message }}
                                                            @enderror
                                                        </small></span>
                                                </div>

                                            </div>

                                            <div class="col">
                                                <div class="form-group">
                                                    <label class="col-form-label">First Rented</label>
                                                    <div class="input-group mb-3">
                                                        <input type="date" required placeholder="FirstRented" name="FirstRented"
                                                            class="form-control form-control-sm" value="{{ isset($serial) ? $serial->FirstRented : old('FirstRented') }}">
                                                    </div>
                                                    <span><small class="text-danger font-weight-light font-italic">
                                                            @error('FirstRented')
                                                            {{ $message }}
                                                            @enderror
                                                        </small></span>
                                                </div>
                                            </div>

                                            <div class="col">
                                                <div class="form-group">
                                                    <label class="col-form-label">Own/Rent</label>
                                                    <div class="input-group mb-3">
                                                        <select class="form-control form-control-sm" id="status-dropdown" required name="OwnRent">
                                                            <option {{ old('OwnRent', isset($serial) ? $serial->OwnRent : '') == '' ? 'selected' : '' }} disabled>Own/Rent</option>
                                                            <option value="Own" {{ old('OwnRent', isset($serial) ? $serial->OwnRent : '') == "Own" ? 'selected' : '' }}>Own </option>
                                                            <option value="Rent" {{ old('OwnRent', isset($serial) ? $serial->OwnRent : '') == "Rent" ? 'selected' : '' }}>Rent  </option>
                                                        </select>
                                                    </div>
                                                    <span><small class="text-danger font-weight-light font-italic">
                                                            @error('OwnRent')
                                                            {{ $message }}
                                                            @enderror
                                                        </small></span>
                                                </div>
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
<script>
    $(document).ready(function() {
        logAction("Add Serial Number Page Loaded");
    });
    var selectedCustomerId = $('#current-customer-id').val();

    $('#customer-select').select2({
        tags: true,
        placeholder: 'Select or type customer',
        ajax: {
            url: '/get-customers',
            dataType: 'json',
            delay: 250,
            data: function(params) {
                return {
                    q: params.term
                };
            },
            processResults: function(data) {
                return {
                    results: data.items
                };
            },
            cache: true
        }
    });
    if (selectedCustomerId) {
        $.ajax({
            url: '/get-customer-details/' + selectedCustomerId,
            type: 'GET',
            success: function(data) {
                console.log(data);
                var option = new Option(data.name, data.id, true, true);
                $('#customer-select').append(option).trigger('change');
            }
        });
    }

    var selectedLastCustomerId = $('#Last-customer-id').val();

    $('#customer-select-2').select2({
        tags: true,
        placeholder: 'Select or type customer',
        ajax: {
            url: '/get-customers',
            dataType: 'json',
            delay: 250,
            data: function(params) {
                return {
                    q: params.term
                };
            },
            processResults: function(data) {
                return {
                    results: data.items
                };
            },
            cache: true
        }
    });
    if (selectedLastCustomerId) {
        $.ajax({
            url: '/get-customer-details/' + selectedLastCustomerId,
            type: 'GET',
            success: function(data) {
                console.log(data);
                var option = new Option(data.name, data.id, true, true);
                $('#customer-select-2').append(option).trigger('change');
            }
        });
    }
</script>
