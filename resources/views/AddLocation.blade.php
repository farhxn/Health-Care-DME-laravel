<?php
$title =  isset($Location) ? 'Update Location'  : 'Add Location';
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
                        <h2 class="pageheader-title">{{ isset($Location) ? 'Update Location' : 'Add Location' }}</h2>
                    </div>
                </div>
            </div>
            <br>

            <div class="ecommerce-widget">
                <div class="row">
                    <div class="col">
                        <form method="post" action="{{ url('AddEditLocation',isset($Location) ? $Location->id : 0) }}">
                            @csrf
                            <div class="card">
                                <br>

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
                                                <input required type="text" class="form-control form-control-sm" value="{{ isset($Location) ? $Location->Name : old('Name') }}" placeholder="Name" name="Name">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="recipient-name" class="col-form-label">Address:</label>
                                                <input required type="text" class="form-control form-control-sm" id="patientAddress" value="{{ isset($Location) ? $Location->address : old('address') }}" placeholder="Address" name="address">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="recipient-name" class="col-form-label">Contact:</label>
                                                <input required type="text" class="form-control form-control-sm"  value="{{ isset($Location) ? $Location->Contact : old('Contact') }}" placeholder="Contact" name="Contact">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="recipient-name" class="col-form-label">City:</label>
                                                <input required type="text" class="form-control form-control-sm" value="{{ isset($Location) ? $Location->City : old('City') }}" placeholder="City" name="City">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="recipient-name" class="col-form-label">State:</label>
                                                <input required type="text" class="form-control form-control-sm" value="{{ isset($Location) ? $Location->State : old('State') }}" placeholder="State" name="State">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="recipient-name" class="col-form-label">Zip:</label>
                                                <input required type="text" class="form-control form-control-sm" placeholder="Zip" name="Zip" value="{{ isset($Location) ? $Location->Zip : old('Zip') }}" >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="recipient-name" class="col-form-label">Phone:</label>
                                                <input required type="text" class="form-control form-control-sm" value="{{ isset($Location) ? $Location->Phone : old('Phone') }}" placeholder="Phone" name="Phone">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="recipient-name" class="col-form-label">Phone 2:</label>
                                                <input required type="text" class="form-control form-control-sm" value="{{ isset($Location) ? $Location->Phone2 : old('Phone2') }}" placeholder="Phone 2" name="Phone2">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="recipient-name" class="col-form-label">Fax:</label>
                                                <input required type="text" class="form-control form-control-sm" value="{{ isset($Location) ? $Location->Fax : old('Fax') }}" placeholder="Fax" name="Fax">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="recipient-name" class="col-form-label">Email:</label>
                                                <input required type="mail" class="form-control form-control-sm" placeholder="Email" name="mail" value="{{ isset($Location) ? $Location->mail : old('mail') }}" >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-auto">
                                            <label>Misc</label>
                                        </div>
                                        <div class="col">
                                            <hr>
                                        </div>
                                    </div>

                                    <div class="row">

                                        <div class="col">
                                            <div class="form-group">
                                                <label for="recipient-name" class="col-form-label">Code:</label>
                                                <input required type="text" class="form-control form-control-sm" value="{{ isset($Location) ? $Location->Code : old('Code') }}" placeholder="Code" name="Code">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="recipient-name" class="col-form-label">NPI:</label>
                                                <input required type="text" class="form-control form-control-sm" value="{{ isset($Location) ? $Location->NPI : old('NPI') }}" placeholder="NPI" name="NPI">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="recipient-name" class="col-form-label">Federal Tax ID:</label>
                                                <input required type="text" class="form-control form-control-sm" placeholder="Federal Tax ID" name="FederalTaxID" value="{{ isset($Location) ? $Location->FederalTaxID : old('FederalTaxID') }}">
                                            </div>
                                        </div>


                                        <div class="col">
                                            <div class="form-group">
                                                <label class="col-form-label">Tax ID Type</label>
                                                <div class="input-group mb-3">
                                                    <select class="form-control form-control-sm" id="status-dropdown" required name="TaxIDType" >
                                                        <option  disabled disabled {{ old('TaxIDType', isset($Location) ? $Location->TaxIDType : '') == '' ? '' : '' }}>Tax ID Type</option>
                                                        @foreach ($st as $drs) 
                                                        <option value="{{ $drs->id }}" {{ old('TaxIDType', isset($Location) ? $Location->TaxIDType : '') == $drs->id ? 'selected' : '' }}>{{ $drs->Status }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <span><small class="text-danger font-weight-light font-italic">
                                                        @error('TaxIDType')
                                                        {{ $message }}
                                                        @enderror
                                                    </small></span>
                                            </div>
                                        </div>

                                        <div class="col">
                                            <div class="form-group">
                                                <label class="col-form-label">POS Type</label>
                                                <div class="input-group mb-3">
                                                    <select class="form-control form-control-sm" id="status-dropdown" required name="POSType">
                                                        <option  disabled {{ old('POSType', isset($Location) ? $Location->POSType : '') == "" ? 'selected' : '' }}>POS Type</option>
                                                        @foreach ($st as $drs)
                                                        <option value="{{ $drs->id }}" {{ old('POSType', isset($Location) ? $Location->POSType : '') == $drs->id ? 'selected' : '' }}>{{ $drs->Status }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <span><small class="text-danger font-weight-light font-italic">
                                                        @error('POSType')
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
                                                        <option  disabled {{ old('Warehouse', isset($Location) ? $Location->Warehouse : '') == $drs->id ? 'selected' : '' }}>Warehouse</option>
                                                        @foreach ($st as $drs)
                                                        <option value="{{ $drs->id }}" {{ old('Warehouse', isset($Location) ? $Location->Warehouse : '') == $drs->id ? 'selected' : '' }}>
                                                        {{ $drs->Status }}
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
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label class="col-form-label">Tax Rate</label>
                                                <div class="input-group mb-3">
                                                    <select class="form-control form-control-sm" id="status-dropdown" required name="TaxRate">
                                                        <option  disabled {{ old('TaxRate', isset($Location) ? $Location->TaxRate : '') == $drs->id ? 'selected' : '' }}>Tax Rate</option>
                                                        @foreach ($st as $drs)
                                                        <option value="{{ $drs->id }}" {{ old('TaxRate', isset($Location) ? $Location->TaxRate : '') == $drs->id ? 'selected' : '' }}>{{ $drs->Status }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <span><small class="text-danger font-weight-light font-italic">
                                                        @error('TaxRate')
                                                        {{ $message }}
                                                        @enderror
                                                    </small></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-auto">
                                            <label>Print</label>
                                        </div>
                                        <div class="col">
                                            <hr>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group form-check">
                                                <input type="checkbox" name="Tickets" checked required class="form-check-input" id="exampleCheck1">
                                                <label class="form-check-label" for="exampleCheck1">Delivery / Pickup Tickets</label>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group form-check">
                                                <input type="checkbox" class="form-check-input" checked required id="exampleCheck1" name="Statement">
                                                <label class="form-check-label" for="exampleCheck1">Invoice / Account Statement</label>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group form-check">
                                                <input type="checkbox" class="form-check-input" checked required id="exampleCheck1" name="Provider">
                                                <label class="form-check-label" for="exampleCheck1">Participating Provider</label>
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
            logAction("Add Location Page Loaded");
        });
    </script>
