<?php
$title =  isset($price) ? 'Update Price Code' : 'Add Price Code';
?>
@section('title', $title)
@include('layout.Head')
<style>
    .tickmark-list {
        list-style: none;
        padding-left: 0;
    }

    .tickmark-list li {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
    }

    .tickmark-list .tickmark-icon {
        margin-right: 10px;
        color: green;
    }
</style>

<div class="dashboard-wrapper">
    <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-center">
                        <!-- Heading aligned to the left -->
                        <h2 class="pageheader-title">{{ isset($price) ? 'Update Price Code' : 'Add Price Code' }}</h2>
                    </div>
                </div>
            </div>
            <br>

            <div class="ecommerce-widget">
                <div class="row">
                    <div class="col">
                        <form method="post" action="{{ url('AddEditPriceCode',isset($price) ? $price->id : 0) }}">
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
                                            <h2 class="pageheader-title"> </h2>
                                            <a href="#" class="btn btn-primary disabled">ID # {{ isset($price) ? $price->id : $Pid }}
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col">
                                            <label class="col-form-label">Item</label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="fa-solid fa-square-poll-vertical"></i>
                                                    </span>
                                                </span>
                                                <select id="item-select" class="form-control form-control-sm" required name="Item">
                                                    <option {{ old('Item', isset($price) ? $price->Item : '') == '' ? 'selected' : '' }} disabled>Item</option>
                                                    @foreach ($inventoryItem as $drs)
                                                    <option value="{{ $drs->id }}" {{ old('Item', isset($price) ? $price->Item : '') == $drs->Item_Name ? 'selected' : '' }}>{{ $drs->Item_Name }}</option>
                                                    @endforeach
                                                </select>

                                            </div>
                                            <span>
                                                <small class="text-danger font-weight-light font-italic">
                                                    @error('Item')
                                                    {{ $message }}
                                                    @enderror
                                                </small>
                                            </span>
                                        </div>

                                        <div class="form-group col">
                                            <label class="col-form-label">Insurance</label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="fa-solid fa-square-poll-vertical"></i>
                                                    </span>
                                                </span>
                                                <select class="form-control form-control form-control-sm" required name="Insurance">
                                                    <option {{ old('Insurance', isset($price) ? $price->Insurance : '') == '' ? 'selected' : '' }} disabled>Insurance</option>
                                                    @foreach ($insurance as $drs)
                                                    <option value="{{ $drs->Name }}" {{ old('Insurance', isset($price) ? $price->Insurance : '') == $drs->Name ? 'selected' : '' }}>{{ $drs->Name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <span>
                                                <small class="text-danger font-weight-light font-italic">
                                                    @error('Insurance')
                                                    {{ $message }}
                                                    @enderror
                                                </small>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col">
                                            <label class="col-form-label">Default Order Type</label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="fa-solid fa-square-poll-vertical"></i>
                                                    </span>
                                                </span>
                                                <select class="form-control form-control form-control-sm" id="status-dropdown" required name="OrderType">
                                                    <option {{ old('OrderType', isset($price) ? $price->OrderType : '') == '' ? 'selected' : '' }} disabled>Default Order Type</option>
                                                    <option value="Sale" {{ old('OrderType', isset($price) ? $price->OrderType : '') == "Sale" ? 'selected' : '' }}>Sale</option>
                                                    <option value="Rental" {{ old('OrderType', isset($price) ? $price->OrderType : '') == "Rental" ? 'selected' : '' }}>Rental</option>
                                                </select>
                                            </div>
                                            <span>
                                                <small class="text-danger font-weight-light font-italic">
                                                    @error('OrderType')
                                                    {{ $message }}
                                                    @enderror
                                                </small>
                                            </span>
                                        </div>

                                        <div class="form-group col">
                                            <label class="col-form-label">Predefined Text</label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="fa-solid fa-square-poll-vertical"></i>
                                                    </span>
                                                </span>
                                                <select class="form-control form-control form-control-sm" id="status-dropdown" required name="PredefinedText">
                                                    <option {{ old('PredefinedText', isset($price) ? $price->PredefinedText : '') == '' ? 'selected' : '' }} disabled>Predefined Text</option>
                                                    @foreach ($preNotes as $drs)
                                                    <option value="{{ $drs->Text }}" {{ old('PredefinedText', isset($price) ? $price->PredefinedText : '') == $drs->Text ? 'selected' : '' }}>{{ $drs->Text }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <span>
                                                <small class="text-danger font-weight-light font-italic">
                                                    @error('PredefinedText')
                                                    {{ $message }}
                                                    @enderror
                                                </small>
                                            </span>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-3">
                                            <div class="card" style=" border: 1px solid black;">
                                                <div class="card-body">
                                                    <h5 class="card-title text-center">Sale Information</h5>

                                                    <div class="form-group">
                                                        <label class="col-form-label">Billable Price</label>
                                                        <div class="input-group mb-3">
                                                            <input type="text" required placeholder="Billable Price" name="Billable_Price" class="form-control form-control form-control-sm"
                                                                value="{{ isset($price) ? $price->Billable_Price : old('Billable_Price') }}">

                                                        </div>
                                                        <span><small class="text-danger font-weight-light font-italic">
                                                                @error('Billable_Price')
                                                                {{ $message }}
                                                                @enderror
                                                            </small></span>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-form-label">Allowable Price</label>
                                                        <div class="input-group mb-3">
                                                            <input type="text" required placeholder="Allowable Price" name="AllowablePrice" class="form-control form-control form-control-sm"
                                                                value="{{ isset($price) ? $price->AllowablePrice : old('AllowablePrice') }}">

                                                        </div>
                                                        <span><small class="text-danger font-weight-light font-italic">
                                                                @error('AllowablePrice')
                                                                {{ $message }}
                                                                @enderror
                                                            </small></span>
                                                    </div>

                                                    <div class="col">
                                                        <label class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" required checked name="ReoccuringSale">
                                                            <span class="custom-control-label">Reoccuring&nbsp;Sale</span>
                                                        </label>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="card" style=" border: 1px solid black;">
                                                <div class="card-body">
                                                    <h5 class="card-title text-center">Rental&nbsp;Information </h5>

                                                    <div class="form-group">
                                                        <label class="col-form-label">Billable Price</label>
                                                        <div class="input-group mb-3">
                                                            <input type="text" required placeholder="Billable Price" name="Rental_Billable_Price" class="form-control form-control form-control-sm"
                                                                value="{{ isset($price) ? $price->Rental_Billable_Price : old('Rental_Billable_Price') }}">

                                                        </div>
                                                        <span><small class="text-danger font-weight-light font-italic">
                                                                @error('Rental_Billable_Price')
                                                                {{ $message }}
                                                                @enderror
                                                            </small></span>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-form-label">Allowable Price</label>
                                                        <div class="input-group mb-3">
                                                            <input type="text" required placeholder="Allowable Price" name="RentalAllowablePrice" class="form-control form-control form-control-sm"
                                                                value="{{ isset($price) ? $price->RentalAllowablePrice : old('RentalAllowablePrice') }}">

                                                        </div>
                                                        <span><small class="text-danger font-weight-light font-italic">
                                                                @error('RentalAllowablePrice')
                                                                {{ $message }}
                                                                @enderror
                                                            </small></span>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-form-label">Rental Type </label>
                                                        <div class="input-group mb-3">
                                                            <select class="form-control form-control form-control-sm" id="status-dropdown" required name="RentalType">
                                                                <option {{ old('RentalType', isset($price) ? $price->RentalType : '') == '' ? 'selected' : '' }} disabled>Rental Type</option>
                                                                <option value="Medicare Oxygen" {{ old('RentalType', isset($price) ? $price->RentalType : '') == 'Medicare Oxygen' ? 'selected' : '' }}>Medicare Oxygen</option>
                                                                <option value="One Time Rental" {{ old('RentalType', isset($price) ? $price->RentalType : '') == 'One Time Rental' ? 'selected' : '' }}>One Time Rental</option>
                                                                <option value="Capped Rental" {{ old('RentalType', isset($price) ? $price->RentalType : '') == 'Capped Rental' ? 'selected' : '' }}>Capped Rental</option>
                                                                <option value="Parental Rental" {{ old('RentalType', isset($price) ? $price->RentalType : '') == 'Parental Rental' ? 'selected' : '' }}>Parental Rental</option>
                                                                <option value="Rent to Purchase" {{ old('RentalType', isset($price) ? $price->RentalType : '') == 'Rent to Purchase' ? 'selected' : '' }}>Rent to Purchase</option>
                                                            </select>
                                                        </div>
                                                        <span>
                                                            <small class="text-danger font-weight-light font-italic">
                                                                @error('RentalType')
                                                                {{ $message }}
                                                                @enderror
                                                            </small>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="card" style=" border: 1px solid black;">
                                                <div class="card-body">
                                                    <h5 class="card-title text-center">Billing Code
                                                    </h5>

                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label class="col-form-label">Billable Code</label>
                                                                <div class="input-group mb-3">
                                                                    <input type="text" required placeholder="Billable Code" name="Bill_Billable_Code" class="form-control form-control form-control-sm"
                                                                        value="{{ isset($price) ? $price->Bill_Billable_Code : old('Bill_Billable_Code') }}">

                                                                </div>
                                                                <span><small class="text-danger font-weight-light font-italic">
                                                                        @error('Bill_Billable_Code')
                                                                        {{ $message }}
                                                                        @enderror
                                                                    </small></span>
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label class="col-form-label">Default DMN/RX </label>
                                                                <div class="input-group mb-3">

                                                                    <select class="form-control form-control-sm" required name="DMNRX">
                                                                        <option {{ old('DMNRX', isset($price) ? $price->DMNRX : '') == '' ? 'selected' : '' }} disabled>Default DMN/RX</option>

                                                                        <option value="(04.04B) PNEUMATIC COMPRESSION DEVICES" {{ old('DMNRX', isset($price) ? $price->DMNRX : '') == '(04.04B) PNEUMATIC COMPRESSION DEVICES' ? 'selected' : '' }}>(04.04B) PNEUMATIC COMPRESSION DEVICES</option>
                                                                        <option value="(04.04C) OSTEOGENESIS STIMULATORS" {{ old('DMNRX', isset($price) ? $price->DMNRX : '') == '(04.04C) OSTEOGENESIS STIMULATORS' ? 'selected' : '' }}>(04.04C) OSTEOGENESIS STIMULATORS</option>
                                                                        <option value="(06.03B) TRANSCUTANEOUS ELECTRICAL NERVE STIMULATOR (TENS)" {{ old('DMNRX', isset($price) ? $price->DMNRX : '') == '(06.03B) TRANSCUTANEOUS ELECTRICAL NERVE STIMULATOR (TENS)' ? 'selected' : '' }}>(06.03B) TRANSCUTANEOUS ELECTRICAL NERVE STIMULATOR (TENS)</option>
                                                                        <option value="(07.02B) POWER OPERATED VEHICLE (POV)" {{ old('DMNRX', isset($price) ? $price->DMNRX : '') == '(07.02B) POWER OPERATED VEHICLE (POV)' ? 'selected' : '' }}>(07.02B) POWER OPERATED VEHICLE (POV)</option>
                                                                        <option value="(07.03A) SEAT LIFT MECHANISMS" {{ old('DMNRX', isset($price) ? $price->DMNRX : '') == '(07.03A) SEAT LIFT MECHANISMS' ? 'selected' : '' }}>(07.03A) SEAT LIFT MECHANISMS</option>
                                                                        <option value="(08.02) SUPPORT SURFACES" {{ old('DMNRX', isset($price) ? $price->DMNRX : '') == '(08.02) SUPPORT SURFACES' ? 'selected' : '' }}>(08.02) SUPPORT SURFACES</option>
                                                                        <option value="(09.03) EXTERNAL INFUSION PUMPS" {{ old('DMNRX', isset($price) ? $price->DMNRX : '') == '(09.03) EXTERNAL INFUSION PUMPS' ? 'selected' : '' }}>(09.03) EXTERNAL INFUSION PUMPS</option>
                                                                        <option value="(10.03) ENTERAL AND PARENTERAL NUTRITION" {{ old('DMNRX', isset($price) ? $price->DMNRX : '') == '(10.03) ENTERAL AND PARENTERAL NUTRITION' ? 'selected' : '' }}>(10.03) ENTERAL AND PARENTERAL NUTRITION</option>
                                                                        <option value="(484.03) OXYGEN" {{ old('DMNRX', isset($price) ? $price->DMNRX : '') == '(484.03) OXYGEN' ? 'selected' : '' }}>(484.03) OXYGEN</option>
                                                                        <option value="(DRORDER) PHYSICIAN'S ORDER" {{ old('DMNRX', isset($price) ? $price->DMNRX : '') == '(DRORDER) PHYSICIAN\'S ORDER' ? 'selected' : '' }}>(DRORDER) PHYSICIAN'S ORDER</option>
                                                                        <option value="(URO) UROLOGICAL CERTIFICATION" {{ old('DMNRX', isset($price) ? $price->DMNRX : '') == '(URO) UROLOGICAL CERTIFICATION' ? 'selected' : '' }}>(URO) UROLOGICAL CERTIFICATION</option>
                                                                        <option value="(01.02A) HOSPITAL BEDS - eliminated" {{ old('DMNRX', isset($price) ? $price->DMNRX : '') == '(01.02A) HOSPITAL BEDS - eliminated' ? 'selected' : '' }}>(01.02A) HOSPITAL BEDS - eliminated</option>
                                                                        <option value="(01.02B) SUPPORT SURFACES - eliminated" {{ old('DMNRX', isset($price) ? $price->DMNRX : '') == '(01.02B) SUPPORT SURFACES - eliminated' ? 'selected' : '' }}>(01.02B) SUPPORT SURFACES - eliminated</option>
                                                                        <option value="(02.03A) MOTORIZED WHEELCHAIRS - obsolete" {{ old('DMNRX', isset($price) ? $price->DMNRX : '') == '(02.03A) MOTORIZED WHEELCHAIRS - obsolete' ? 'selected' : '' }}>(02.03A) MOTORIZED WHEELCHAIRS - obsolete</option>
                                                                        <option value="(02.03B) MANUAL WHEELCHAIRS - obsolete" {{ old('DMNRX', isset($price) ? $price->DMNRX : '') == '(02.03B) MANUAL WHEELCHAIRS - obsolete' ? 'selected' : '' }}>(02.03B) MANUAL WHEELCHAIRS - obsolete</option>
                                                                        <option value="(03.02) CONTINUOUS POSITIVE AIRWAY PRESSURE (CPAP) - obsolete" {{ old('DMNRX', isset($price) ? $price->DMNRX : '') == '(03.02) CONTINUOUS POSITIVE AIRWAY PRESSURE (CPAP) - obsolete' ? 'selected' : '' }}>(03.02) CONTINUOUS POSITIVE AIRWAY PRESSURE (CPAP) - obsolete</option>
                                                                        <option value="(04.03B) LYMPHEDEMA PUMPS - obsolete" {{ old('DMNRX', isset($price) ? $price->DMNRX : '') == '(04.03B) LYMPHEDEMA PUMPS - obsolete' ? 'selected' : '' }}>(04.03B) LYMPHEDEMA PUMPS - obsolete</option>
                                                                        <option value="(04.03C) OSTEOGENESIS STIMULATORS - obsolete" {{ old('DMNRX', isset($price) ? $price->DMNRX : '') == '(04.03C) OSTEOGENESIS STIMULATORS - obsolete' ? 'selected' : '' }}>(04.03C) OSTEOGENESIS STIMULATORS - obsolete</option>
                                                                        <option value="(06.02B) TRANSCUTANEOUS ELECTRICAL NERVE STIMULATOR (TENS) - obsolete" {{ old('DMNRX', isset($price) ? $price->DMNRX : '') == '(06.02B) TRANSCUTANEOUS ELECTRICAL NERVE STIMULATOR (TENS) - obsolete' ? 'selected' : '' }}>(06.02B) TRANSCUTANEOUS ELECTRICAL NERVE STIMULATOR (TENS) - obsolete</option>
                                                                        <option value="(07.02A) SEAT LIFT MECHANISM - obsolete" {{ old('DMNRX', isset($price) ? $price->DMNRX : '') == '(07.02A) SEAT LIFT MECHANISM - obsolete' ? 'selected' : '' }}>(07.02A) SEAT LIFT MECHANISM - obsolete</option>
                                                                        <option value="(09.02) EXTERNAL INFUSION PUMP - obsolete" {{ old('DMNRX', isset($price) ? $price->DMNRX : '') == '(09.02) EXTERNAL INFUSION PUMP - obsolete' ? 'selected' : '' }}>(09.02) EXTERNAL INFUSION PUMP - obsolete</option>
                                                                        <option value="(10.02A) PARENTERAL NUTRITION - obsolete" {{ old('DMNRX', isset($price) ? $price->DMNRX : '') == '(10.02A) PARENTERAL NUTRITION - obsolete' ? 'selected' : '' }}>(10.02A) PARENTERAL NUTRITION - obsolete</option>
                                                                        <option value="(10.02B) ENTERAL NUTRITION - obsolete" {{ old('DMNRX', isset($price) ? $price->DMNRX : '') == '(10.02B) ENTERAL NUTRITION - obsolete' ? 'selected' : '' }}>(10.02B) ENTERAL NUTRITION - obsolete</option>
                                                                        <option value="(484.2) OXYGEN - obsolete" {{ old('DMNRX', isset($price) ? $price->DMNRX : '') == '(484.2) OXYGEN - obsolete' ? 'selected' : '' }}>(484.2) OXYGEN - obsolete</option>
                                                                    </select>

                                                                </div>
                                                                <span>
                                                                    <small class="text-danger font-weight-light font-italic">
                                                                        @error('DMNRX')
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
                                                                <label class="col-form-label">Modifiers</label>
                                                                <div class="input-group mb-3">
                                                                    <input type="text" name="modifier1" maxlength="2" class="form-control form-control form-control-sm" style="width: 40px;" value="{{ isset($price) ? $price->modifier1 : old('modifier1') }}" required>
                                                                    <input type="text" name="modifier2" maxlength="2" class="form-control form-control form-control-sm" style="width: 40px;" value="{{ isset($price) ? $price->modifier2 : old('modifier2') }}" required>
                                                                    <input type="text" name="modifier3" maxlength="2" class="form-control form-control form-control-sm" style="width: 40px;" value="{{ isset($price) ? $price->modifier3 : old('modifier3') }}" required>
                                                                    <input type="text" name="modifier4" maxlength="2" class="form-control form-control form-control-sm" style="width: 40px;" value="{{ isset($price) ? $price->modifier4 : old('modifier4') }}" required>
                                                                </div>
                                                                <span><small class="text-danger font-weight-light font-italic">
                                                                        @error('modifier1') {{ $message }} @enderror
                                                                        @error('modifier2') {{ $message }} @enderror
                                                                        @error('modifier3') {{ $message }} @enderror
                                                                        @error('modifier4') {{ $message }} @enderror
                                                                    </small></span>
                                                            </div>
                                                        </div>

                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label class="col-form-label">Default Prior Auth </label>
                                                                <div class="input-group mb-3">

                                                                    <select class="form-control form-control form-control-sm" id="status-dropdown" required name="PriorAuth">
                                                                        <option {{ old('PriorAuth', isset($price) ? $price->PriorAuth : '') == '' ? 'selected' : '' }} disabled>Default Prior Auth</option>
                                                                        <option value="P.O. Number" {{ old('PriorAuth', isset($price) ? $price->PriorAuth : '') == "P.O. Number"? 'selected' : '' }}>P.O. Number </option>
                                                                        <option value="Prior Auth" {{ old('PriorAuth', isset($price) ? $price->PriorAuth : '') == "Prior Auth"? 'selected' : '' }}>Prior Auth </option>

                                                                    </select>
                                                                </div>
                                                                <span>
                                                                    <small class="text-danger font-weight-light font-italic">
                                                                        @error('PriorAuth')
                                                                        {{ $message }}
                                                                        @enderror
                                                                    </small>
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col">
                                                                <label class="custom-control custom-checkbox">
                                                                    <input type="checkbox" class="custom-control-input" required checked name="AcceptAssignment">
                                                                    <span class="custom-control-label">Accept&nbsp;Assignment</span>
                                                                </label>
                                                            </div>

                                                            <div class="col">
                                                                <label class="custom-control custom-checkbox">
                                                                    <input type="checkbox" class="custom-control-input" required checked name="SpanDates">
                                                                    <span class="custom-control-label">Show&nbsp;Span&nbsp;Dates</span>
                                                                </label>
                                                            </div>

                                                            <div class="col">
                                                                <label class="custom-control custom-checkbox">
                                                                    <input type="checkbox" class="custom-control-input" required checked name="BillTOInsurance">
                                                                    <span class="custom-control-label">Bill&nbsp;To&nbsp;Insurance</span>
                                                                </label>
                                                            </div>

                                                            <div class="col">
                                                                <label class="custom-control custom-checkbox">
                                                                    <input type="checkbox" class="custom-control-input" required checked name="Taxable">
                                                                    <span class="custom-control-label">Taxable</span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>


                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">

                                        <div class="col">
                                            <div class="card" style=" border: 1px solid black;">
                                                <div class="card-body">
                                                    <h5 class="card-title text-center">Frequency&nbsp;Defaults</h5>
                                                    <div class="row">
                                                        <div class="d-flex">
                                                            <div class="form-group mt-4">
                                                                <label class="col-form-label ">Ordered</label>
                                                            </div>
                                                            <div class="form-group ml-3 ">
                                                                <div class="d-flex">
                                                                    <div class="text-center mr-2">
                                                                        <label for="modifier1">Quantity </label>
                                                                        <input type="text" id="modifier1" name="Quantity" value="{{ isset($price) ? $price->Quantity : old('Quantity') }}" class="form-control form-control form-control-sm" style="width: 50px;" required>
                                                                    </div>
                                                                    <div class="text-center mr-2">
                                                                        <label for="modifier2">Units</label>
                                                                        <input type="text" id="modifier2" name="Units" value="{{ isset($price) ? $price->Units : old('Units') }}" class="form-control form-control form-control-sm" style="width: 50px;" required>
                                                                    </div>
                                                                    <div class="text-center mr-2">
                                                                        <label for="modifier2">When</label>
                                                                        <input type="text" id="modifier2" name="When" value="{{ isset($price) ? $price->When : old('When') }}" class="form-control form-control form-control-sm" style="width: 50px;" required>
                                                                    </div>
                                                                    <div class="text-center mr-2">
                                                                        <label for="modifier3">Converter</label>
                                                                        <input type="text" id="modifier3" name="Converter" value="{{ isset($price) ? $price->Converter : old('Converter') }}" maxlength="2" class="form-control form-control form-control-sm" style="width: 50px;" required>
                                                                    </div>
                                                                </div>
                                                                <span><small class="text-danger font-weight-light font-italic">
                                                                        @error('Quantity ') {{ $message }} @enderror
                                                                        @error('Units') {{ $message }} @enderror
                                                                        @error('When') {{ $message }} @enderror
                                                                        @error('Converter') {{ $message }} @enderror
                                                                    </small></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="d-flex">
                                                            <div class="form-group">
                                                                <label class="col-form-label">Billed&nbsp;&nbsp;</label>
                                                            </div>
                                                            <div class="form-group ml-4 ">
                                                                <div class="d-flex">
                                                                    <div class="text-center mr-2">
                                                                        <input type="text" id="modifier1" name="BQuantity" value="{{ isset($price) ? $price->BQuantity : old('BQuantity') }}" class="form-control form-control form-control-sm" style="width: 50px;" required>
                                                                    </div>
                                                                    <div class="text-center mr-2">
                                                                        <input type="text" id="modifier2" name="BUnits" value="{{ isset($price) ? $price->BUnits : old('BUnits') }}" class="form-control form-control form-control-sm" style="width: 50px;" required>
                                                                    </div>
                                                                    <div class="text-center mr-2">
                                                                        <input type="text" id="modifier2" name="BWhen" value="{{ isset($price) ? $price->BWhen : old('BWhen') }}" class="form-control form-control form-control-sm" style="width: 50px;" required>
                                                                    </div>
                                                                    <div class="text-center mr-2">
                                                                        <input type="text" id="modifier3" name="BConverter" value="{{ isset($price) ? $price->BConverter : old('BConverter') }}" maxlength="2" class="form-control form-control form-control-sm" style="width: 50px;" required>
                                                                    </div>
                                                                </div>
                                                                <span><small class="text-danger font-weight-light font-italic">
                                                                        @error('BQuantity ') {{ $message }} @enderror
                                                                        @error('BUnits') {{ $message }} @enderror
                                                                        @error('BWhen') {{ $message }} @enderror
                                                                        @error('BConverter') {{ $message }} @enderror
                                                                    </small></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="d-flex">
                                                            <div class="form-group">
                                                                <label class="col-form-label">Delivery</label>
                                                            </div>
                                                            <div class="form-group ml-3">
                                                                <div class="d-flex">
                                                                    <div class="text-center mr-2">
                                                                        <input type="text" id="modifier1" name="DQuantity" value="{{ isset($price) ? $price->DQuantity : old('DQuantity') }}" class="form-control form-control form-control-sm" style="width: 50px;" required>
                                                                    </div>
                                                                    <div class="text-center mr-2">
                                                                        <input type="text" id="modifier2" name="DUnits" value="{{ isset($price) ? $price->DUnits : old('DUnits') }}" class="form-control form-control form-control-sm" style="width: 50px;" required>
                                                                    </div>
                                                                    <div class="text-center mr-2">
                                                                        <input type="text" id="modifier2" name="DWhen" value="{{ isset($price) ? $price->DWhen : old('DWhen') }}" class="form-control form-control form-control-sm" style="width: 50px;" required>
                                                                    </div>
                                                                    <div class="text-center mr-2">
                                                                        <input type="text" id="modifier3" name="DConverter" value="{{ isset($price) ? $price->DConverter : old('DConverter') }}" maxlength="2" class="form-control form-control form-control-sm" style="width: 50px;" required>
                                                                    </div>
                                                                </div>
                                                                <span><small class="text-danger font-weight-light font-italic">
                                                                        @error('DQuantity ') {{ $message }} @enderror
                                                                        @error('DUnits') {{ $message }} @enderror
                                                                        @error('DWhen') {{ $message }} @enderror
                                                                        @error('DConverter') {{ $message }} @enderror
                                                                    </small></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col">
                                            <div class="card" style=" border: 1px solid black;">
                                                <div class="card-body">
                                                    <h5 class="card-title text-center">Bill Item On: </h5>
                                                    <div class="row">
                                                        <div class="col">
                                                            <label class="custom-control custom-checkbox">
                                                                <input type="checkbox" required class="custom-control-input" checked name="DayDelivery">
                                                                <span class="custom-control-label">Day&nbsp;of&nbsp;Delivery </span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="row">

                                                        <div class="col">
                                                            <label class="custom-control custom-checkbox">
                                                                <input type="checkbox" required class="custom-control-input" checked name="LastPeriod">
                                                                <span class="custom-control-label">Last&nbsp;day&nbsp;of&nbsp;the&nbsp;Period </span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col">
                                                            <label class="custom-control custom-checkbox">
                                                                <input type="checkbox" required class="custom-control-input" checked name="BillPickUp">
                                                                <span class="custom-control-label">Bill&nbsp;at&nbsp;Pick-Up </span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col">
                                                            <label class="custom-control custom-checkbox">
                                                                <input type="checkbox" required class="custom-control-input" checked name="LastMonth">
                                                                <span class="custom-control-label">Last&nbsp;day&nbsp;of&nbsp;the&nbsp;month</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        @if (isset($price) && !empty($warehouseList))
                                        <div class="col">
                                            <div class="card" style="width: 30rem; border: 1px solid black;">
                                                <div class="card-body">
                                                    <h5 class="card-title text-center">Valid Warehouses
                                                    </h5>
                                                    <div style="background-color: #f1f1f2;">
                                                        <div class="row p-1">
                                                            <div class="col-6">
                                                                <ul class="tickmark-list">
                                                                @foreach($warehouseList as $warehouse)
                                                                    <li>
                                                                        <i class="tickmark-icon fas fa-check-circle"></i>
                                                                        <span class="tickmark-text text-sm">{{ $warehouse }}</span>
                                                                    </li>
                                                                    @endforeach
                                                                 </ul>
                                                            </div>
                                                            <div class="col-6 d-flex justify-content-center align-items-center">
                                                                <span class="text-center text-danger">Fetch&nbsp;from&nbsp;inventory&nbsp;warehouse&nbsp;list</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
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
            logAction("Add Price Code Page Loaded");
            $('#item-select').select2({
                placeholder: "Select an item",
                allowClear: true
            });

        });
    </script>