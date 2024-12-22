<?php
$title =  isset($insurance) ? 'Update Insurance Company'  : 'Add New Insurance Company';
?>
@section('title', $title)
@include('layout.Head')

<div class="dashboard-wrapper">
    <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content">
            <div class="row">

                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="page-header">
                        <h2 class="pageheader-title ml-auto">{{ isset($insurance) ? 'Update Insurance Company' : 'Add New Insurance Company                            ' }} </h2>
                        <div class="page-breadcrumb">
                            <nav aria-label="breadcrumb">
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <div class="ecommerce-widget">

                <div class="row">


                    <div class="col">
                        <form method="post" action="{{ url('AddEditInsuranceCompany',isset($insurance) ? $insurance->id : 0) }}" id="myForm">
                            @csrf
                            <div class="card">
                                <h5 class="card-header">
                                    {{ isset($insurance) ? 'Update Insurance Company' : 'Add Insurance Company' }} Details
                                </h5>

                                <div class="card-body">

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
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="recipient-name" class="col-form-label">Name:</label>
                                                <input required type="text" class="form-control" id="recipient-name" placeholder="Name" name="Name" value="{{ isset($insurance) ? $insurance->Name : old('Name') }}">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="recipient-name" class="col-form-label">Address:</label>
                                                <input required type="text" class="form-control" id="patientAddress" placeholder="Address" name="address" value="{{ isset($insurance) ? $insurance->address : old('address') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="recipient-name" class="col-form-label">Phone:</label>
                                                <input required type="text" class="form-control" id="recipient-name" placeholder="Phone" name="Phone" value="{{ isset($insurance) ? $insurance->Phone : old('Phone') }}">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="recipient-name" class="col-form-label">Phone 2:</label>
                                                <input required type="text" class="form-control" id="recipient-name" placeholder="Phone 2" name="Phone2" value="{{ isset($insurance) ? $insurance->Phone2 : old('Phone2') }}">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="recipient-name" class="col-form-label">Fax:</label>
                                                <input required type="text" class="form-control" id="recipient-name" placeholder="Fax" name="Fax" value="{{ isset($insurance) ? $insurance->Fax : old('Fax') }}">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="recipient-name" class="col-form-label">Contact Name:</label>
                                                <input required type="text" class="form-control" id="patientAddress" placeholder="Contact Name" name="ContactName" value="{{ isset($insurance) ? $insurance->ContactName : old('ContactName') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row m-1">
                                        <div class="col-4" style="border-right: 1px solid black;">
                                            <div class="row">
                                                <label><strong>Billing</strong></label>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label class="col-form-label">Price Code: </label>
                                                        <div class="input-group mb-3">

                                                            <select class="form-control" id="status-dropdown" required name="PriceCode">
                                                                <option disabled {{ old('PriceCode', isset($insurance) ? $insurance->PriceCode : '') == '' ? 'selected' : '' }}>Price Code</option>
                                                                @foreach ($priceCode as $drs)
                                                                <option value="{{ $drs->Item }}" {{ old('PriceCode', isset($insurance) ? $insurance->PriceCode : '') == $drs->Item ? 'selected' : '' }}>{{ $drs->Item }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <span>
                                                            <small class="text-danger font-weight-light font-italic">
                                                                @error('PriceCode')
                                                                {{ $message }}
                                                                @enderror
                                                            </small>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <label class="col-form-label">Expected % </label> <br>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <input required type="text" class="form-control form-control-sm" id="recipient-name" placeholder="100" name="Expected" value="{{ isset($insurance) ? $insurance->Expected : old('Expected',100) }}">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="input-group mb-3">
                                                        <select class="form-control form-control-sm" id="status-dropdown" required name="Bill">
                                                            <option value="Bill" {{ old('Bill', isset($insurance) ? $insurance->Bill : '') == "Bill" ? 'selected' : '' }}>Bill</option>
                                                            <option value="Allowed" {{ old('Bill', isset($insurance) ? $insurance->Allowed : '') == "Bill" ? 'selected' : '' }}>Allowed</option>
                                                        </select>
                                                    </div>
                                                    <span>
                                                        <small class="text-danger font-weight-light font-italic">
                                                            @error('Bill')
                                                            {{ $message }}
                                                            @enderror
                                                        </small>
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group form-check">
                                                    <input type="checkbox" class="form-check-input" id="exampleCheck1" checked name="InventoryInvoice">
                                                    <span class="form-check-label">Print Inventory Description on Invoice </span>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group form-check">
                                                    <input type="checkbox" class="form-check-input" id="exampleCheck1" checked name="HAOCodeInvoice">
                                                    <span class="form-check-label">Print HAOCode Record on Invoice </span>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label class="col-form-label">Type </label>
                                                        <div class="input-group mb-3">
                                                            <select class="form-control" id="status-dropdown" required name="Type">
                                                                <option disabled {{ old('Type', isset($insurance) ? $insurance->Type : '') == '' ? 'selected' : '' }}>Type</option>
                                                                <option value="BCBS" {{ old('Type', isset($insurance) ? $insurance->Type : '') == "BCBS" ? 'selected' : '' }}>BCBS</option>
                                                                <option value="CENTRAL CERTIFICATION" {{ old('Type', isset($insurance) ? $insurance->Type : '') == "CENTRAL CERTIFICATION" ? 'selected' : '' }}>CENTRAL CERTIFICATION</option>
                                                                <option value="CHAMPUS" {{ old('Type', isset($insurance) ? $insurance->Type : '') == "CHAMPUS" ? 'selected' : '' }}>CHAMPUS</option>
                                                                <option value="CHAMPVA" {{ old('Type', isset($insurance) ? $insurance->Type : '') == "CHAMPVA" ? 'selected' : '' }}>CHAMPVA</option>
                                                                <option value="COMMERCIAL" {{ old('Type', isset($insurance) ? $insurance->Type : '') == "COMMERCIAL" ? 'selected' : '' }}>COMMERCIAL</option>
                                                                <option value="FECA BLACK LUNG" {{ old('Type', isset($insurance) ? $insurance->Type : '') == "FECA BLACK LUNG" ? 'selected' : '' }}>FECA BLACK LUNG</option>
                                                                <option value="FEDERAL EMPLOYEE (FEP)" {{ old('Type', isset($insurance) ? $insurance->Type : '') == "FEDERAL EMPLOYEE (FEP)" ? 'selected' : '' }}>FEDERAL EMPLOYEE (FEP)</option>
                                                                <option value="MEDICAID" {{ old('Type', isset($insurance) ? $insurance->Type : '') == "MEDICAID" ? 'selected' : '' }}>MEDICAID</option>
                                                                <option value="MEDICARE" {{ old('Type', isset($insurance) ? $insurance->Type : '') == "MEDICARE" ? 'selected' : '' }}>MEDICARE</option>
                                                                <option value="TEXAS WORKERS COMP" {{ old('Type', isset($insurance) ? $insurance->Type : '') == "TEXAS WORKERS COMP" ? 'selected' : '' }}>TEXAS WORKERS COMP</option>

                                                            </select>
                                                        </div>
                                                        <span>
                                                            <small class="text-danger font-weight-light font-italic">
                                                                @error('Type')
                                                                {{ $message }}
                                                                @enderror
                                                            </small>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label class="col-form-label">Group </label>
                                                        <div class="input-group mb-3">

                                                            <select class="form-control" id="status-dropdown" required name="Group">
                                                                <option selected disabled {{ old('Group', isset($insurance) ? $insurance->Group : '') == '' ? 'selected' : '' }}>Group</option>
                                                                @foreach ($insuranceGroup as $drs)
                                                                <option value="{{ $drs->name }}" {{ old('Group', isset($insurance) ? $insurance->Group : '') == $drs->name ? 'selected' : '' }}>{{ $drs->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <span>
                                                            <small class="text-danger font-weight-light font-italic">
                                                                @error('Group')
                                                                {{ $message }}
                                                                @enderror
                                                            </small>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label class="col-form-label">Invoice Form </label>
                                                        <div class="input-group mb-3">

                                                            <select class="form-control" id="status-dropdown" required name="Invoice">
                                                                <option disabled {{ old('Invoice', isset($insurance) ? $insurance->Invoice : '') == '' ? 'selected' : '' }}>Invoice Form</option>
                                                                @foreach ($InvoiceForm as $drs)
                                                                <option value="{{ $drs->name }}" {{ old('Invoice', isset($insurance) ? $insurance->Invoice : '') == $drs->name ? 'selected' : '' }}>{{ $drs->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <span>
                                                            <small class="text-danger font-weight-light font-italic">
                                                                @error('Invoice')
                                                                {{ $message }}
                                                                @enderror
                                                            </small>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="col-4" style="border-right: 1px solid black;">
                                            <div class="row">
                                                <label><strong>&nbsp; Edi</strong></label>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label class="col-form-label">ECS Format </label>
                                                        <div class="input-group mb-3">

                                                            <select class="form-control" id="status-dropdown" required name="ECSFormat">
                                                                <option disabled {{ old('ECSFormat', isset($insurance) ? $insurance->ECSFormat : '') == '' ? 'selected' : '' }}>ECS Format</option>
                                                                <option value="Region A" {{ old('ECSFormat', isset($insurance) ? $insurance->ECSFormat : '') == "Region A" ? 'selected' : '' }}>Region A</option>
                                                                <option value="Region B" {{ old('ECSFormat', isset($insurance) ? $insurance->ECSFormat : '') == "Region B" ? 'selected' : '' }}>Region B</option>
                                                                <option value="Region C" {{ old('ECSFormat', isset($insurance) ? $insurance->ECSFormat : '') == "Region C" ? 'selected' : '' }}>Region C</option>
                                                                <option value="Region D" {{ old('ECSFormat', isset($insurance) ? $insurance->ECSFormat : '') == "Region D" ? 'selected' : '' }}>Region D</option>
                                                                <option value="Zirmed" {{ old('ECSFormat', isset($insurance) ? $insurance->ECSFormat : '') == "Zirmed" ? 'selected' : '' }}>Zirmed</option>
                                                                <option value="Medi-Cal" {{ old('ECSFormat', isset($insurance) ? $insurance->ECSFormat : '') == "Medi-Cal" ? 'selected' : '' }}>Medi-Cal </option>
                                                                <option value="Availity" {{ old('ECSFormat', isset($insurance) ? $insurance->ECSFormat : '') == "Availity" ? 'selected' : '' }}>Availity </option>
                                                                <option value="Office Ally" {{ old('ECSFormat', isset($insurance) ? $insurance->ECSFormat : '') == "Office Ally" ? 'selected' : '' }}>Office Ally </option>
                                                                <option value="Ability" {{ old('ECSFormat', isset($insurance) ? $insurance->ECSFormat : '') == "Ability" ? 'selected' : '' }}>Ability</option>
                                                            </select>
                                                        </div>
                                                        <span>
                                                            <small class="text-danger font-weight-light font-italic">
                                                                @error('ECSFormat')
                                                                {{ $message }}
                                                                @enderror
                                                            </small>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="recipient-name" class="col-form-label">Ability:</label>
                                                        <input required type="text" class="form-control" id="recipient-name" placeholder="Ability" name="Ability" value="{{ isset($insurance) ? $insurance->Ability : old('Ability') }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="recipient-name" class="col-form-label">Availability:</label>
                                                        <input required type="text" class="form-control" id="recipient-name" placeholder="Availability" name="Availability" value="{{ isset($insurance) ? $insurance->Availability : old('Availability') }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="recipient-name" class="col-form-label">Claim.MD:</label>
                                                        <input required type="text" class="form-control" id="recipient-name" placeholder="Claim.MD" name="ClaimMD" value="{{ isset($insurance) ? $insurance->ClaimMD : old('ClaimMD') }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="recipient-name" class="col-form-label">Medicaid:</label>
                                                        <input required type="text" class="form-control" id="recipient-name" placeholder="Medicaid" name="Medicaid" value="{{ isset($insurance) ? $insurance->Medicaid : old('Medicaid') }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="recipient-name" class="col-form-label">Medicare:</label>
                                                        <input required type="text" class="form-control" id="recipient-name" placeholder="Medicare" name="Medicare" value="{{ isset($insurance) ? $insurance->Medicare : old('Medicare') }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="recipient-name" class="col-form-label">Office Ally:</label>
                                                        <input required type="text" class="form-control" id="recipient-name" placeholder="Office Ally" name="OfficeAlly" value="{{ isset($insurance) ? $insurance->OfficeAlly : old('OfficeAlly') }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="recipient-name" class="col-form-label">Zirmed:</label>
                                                        <input required type="text" class="form-control" id="recipient-name" placeholder="Zirmed" name="Zirmed" value="{{ isset($insurance) ? $insurance->Zirmed : old('Zirmed') }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-4">
                                            <div class="row">
                                                <label><strong>&nbsp;837</strong></label>
                                            </div>

                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group form-check">
                                                        <input type="checkbox" class="form-check-input" id="exampleCheck1" checked name="ParticipatingProvider">
                                                        <span class="form-check-label">Participating Provider </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group form-check">
                                                        <input type="checkbox" class="form-check-input" id="exampleCheck1" checked name="OrderingPhysician">
                                                        <span class="form-check-label">Extract Ordering Physician </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group form-check">
                                                        <input type="checkbox" class="form-check-input" id="exampleCheck1" checked name="ReferingPhysician">
                                                        <span class="form-check-label">Extract Refering Physician </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group form-check">
                                                        <input type="checkbox" class="form-check-input" id="exampleCheck1" checked name="RenderingPhysician">
                                                        <span class="form-check-label">Extract Rendering Physician</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group form-check">
                                                        <input type="checkbox" class="form-check-input" id="exampleCheck1" checked name="TaxonomyCode">
                                                        <span class="form-check-label">Append prefix to Taxonomy Code</span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="recipient-name" class="col-form-label">Prefix:</label>
                                                        <input required type="text" class="form-control" id="recipient-name" placeholder="Prefix" name="Prefix" value="{{ isset($insurance) ? $insurance->Prefix : old('Prefix') }}">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mt-2">
                                                <label><strong>&nbsp;Eligibility</strong></label>
                                            </div>

                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label class="col-form-label">Ability Payer </label>
                                                        <div class="input-group mb-3">

                                                            <select class="form-control" id="status-dropdown" required name="AbilityPayer">
                                                                <option disabled {{ old('AbilityPayer', isset($insurance) ? $insurance->AbilityPayer : '') == '' ? 'selected' : '' }}>Ability Payer</option>
                                                                @foreach ($AbilityPayer as $drs)
                                                                <option value="{{ $drs->Code }}" {{ old('AbilityPayer', isset($insurance) ? $insurance->AbilityPayer : '') == $drs->Code ? 'selected' : '' }}>{{ $drs->Code }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <span>
                                                            <small class="text-danger font-weight-light font-italic">
                                                                @error('AbilityPayer')
                                                                {{ $message }}
                                                                @enderror
                                                            </small>
                                                        </span>
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
                                                    style="background-color: #427ed1; color: white;"> {{ isset($insurance) ? 'Update Insurance Company' : 'Add Insurance Company' }}
                                                </button>
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
            logAction("Add New Insurance Company Page Loaded");
        });
    </script>
