<?php
$title =  isset($PatInsurance) ? 'Update Patient Insurance'  : 'Add Patient Insurance';
?>
@section('title', $title)
@include('layout.Head')

<div class="dashboard-wrapper">
    <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2 class="pageheader-title"> {{ isset($PatInsurance) ? 'Update Patient Insurance' : 'Add Patient Insurance' }} </h2>
                    </div>
                </div>
            </div>
            <br>

            <div class="ecommerce-widget">
                <div class="row">
                    <div class="col">
                        <form method="post" action="{{ url('AddEditPatientInsurance',isset($PatInsurance) ? $PatInsurance->id : 0) }}">
                            @csrf
                            <div class="card">
                                <br>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label class="col-form-label form-control-sm">Policy</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" required placeholder="Policy" name="Policy" class="form-control form-control form-control-sm"
                                                        value="{{ isset($PatInsurance) ? $PatInsurance->Policy : old('Policy') }}">
                                                </div>
                                                <span><small class="text-danger font-weight-light font-italic">
                                                        @error('Policy')
                                                        {{ $message }}
                                                        @enderror
                                                    </small></span>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label class="col-form-label form-control-sm">Group</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" required placeholder="Group" name="Group" class="form-control form-control form-control-sm"
                                                        value="{{ isset($PatInsurance) ? $PatInsurance->Group : old('Group') }}">
                                                </div>
                                                <span><small class="text-danger font-weight-light font-italic">
                                                        @error('Group')
                                                        {{ $message }}
                                                        @enderror
                                                    </small></span>
                                            </div>
                                        </div>
                                    </div>

                                    <input type="hidden" name="previous_url" value="{{ url()->previous() }}">

                                    <div class="row">
                                        <div class="form-group col ">
                                            <label>Ins Company</label>
                                            <div class="input-group">
                                                <select class="form-control form-control form-control-sm" id="status-dropdown" required name="Company">
                                                    <option disabled {{ old('Company', isset($PatInsurance) ? $PatInsurance->Company : '') == '' ? 'selected' : '' }}>Ins Company</option>
                                                    @foreach ($insurance as $drs)
                                                    <option value="{{ $drs->Name }}" {{ old('Company', isset($PatInsurance) ? $PatInsurance->Company : '') == $drs->Name ? 'selected' : '' }}>{{ $drs->Name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <span>
                                                <small class="text-danger font-weight-light font-italic">
                                                    @error('Company')
                                                    {{ $message }}
                                                    @enderror
                                                </small>
                                            </span>
                                        </div>

                                        <div class="form-group col ">
                                            <label>Ins Type</label>
                                            <div class="input-group">
                                                <select class="form-control form-control form-control-sm" required name="Type">
                                                    <option disabled {{ old('Type', isset($PatInsurance) ? $PatInsurance->Type : '') == '' ? 'selected' : '' }}>Ins Type</option>
                                                    @foreach ($InsuranceType as $drs)
                                                    <option value="{{ $drs->Code }}" {{ old('Type', isset($PatInsurance) ? $PatInsurance->Type : '') == $drs->Code ? 'selected' : '' }}>{{ $drs->Code }}</option>
                                                    @endforeach
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
                                    <input type="hidden" name="PatientID" value="{{ $PID }}" />

                                    <div class="row">
                                        <div class="form-group col ">
                                            <label>Relationship to the Insured</label>
                                            <div class="input-group">
                                                <select class="form-control form-control form-control-sm" id="Relationship-dropdown" required name="Insured">
                                                    <option value="Self" {{ old('Insured', isset($PatInsurance) ? $PatInsurance->Insured : '') == 'Self' ? 'selected' : '' }}>Self</option>

                                                    <option value="Significant other" {{ old('Insured', isset($PatInsurance) ? $PatInsurance->Insured : '') == 'Significant other' ? 'selected' : '' }}>Significant other</option>

                                                    <option value="Sponsored Depended" {{ old('Insured', isset($PatInsurance) ? $PatInsurance->Insured : '') == 'Sponsored Depended' ? 'selected' : '' }}>Sponsored Depended</option>

                                                    <option value="Spouse" {{ old('Insured', isset($PatInsurance) ? $PatInsurance->Insured : '') == 'Spouse' ? 'selected' : '' }}>Spouse</option>

                                                    <option value="Stepson or stepdaughter" {{ old('Insured', isset($PatInsurance) ? $PatInsurance->Insured : '') == 'Stepson or stepdaughter' ? 'selected' : '' }}>Stepson or stepdaughter</option>

                                                    <option value="Unknown" {{ old('Insured', isset($PatInsurance) ? $PatInsurance->Insured : '') == 'Unknown' ? 'selected' : '' }}>Unknown</option>

                                                    <option value="Ward" {{ old('Insured', isset($PatInsurance) ? $PatInsurance->Insured : '') == 'Ward' ? 'selected' : '' }}>Ward</option>
                                                </select>
                                            </div>
                                            <span>
                                                <small class="text-danger font-weight-light font-italic">
                                                    @error('Insured')
                                                    {{ $message }}
                                                    @enderror
                                                </small>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label class="col-form-label form-control-sm">First</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" required placeholder="First" id="first-name" name="First" class="form-control form-control form-control-sm"
                                                        value="{{ isset($PatInsurance) ? $PatInsurance->First : old('First') }}">
                                                </div>
                                                <span><small class="text-danger font-weight-light font-italic">
                                                        @error('First')
                                                        {{ $message }}
                                                        @enderror
                                                    </small></span>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label class="col-form-label form-control-sm">Last</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" required placeholder="Last" name="Last" id="last-name" class="form-control form-control form-control-sm"
                                                        value="{{ isset($PatInsurance) ? $PatInsurance->Last : old('Last') }}">
                                                </div>
                                                <span><small class="text-danger font-weight-light font-italic">
                                                        @error('Last')
                                                        {{ $message }}
                                                        @enderror
                                                    </small></span>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label class="col-form-label form-control-sm">DOB</label>
                                                <div class="input-group mb-3">
                                                    <input type="date" required placeholder="DOB" id="dob" name="DOB" class="form-control form-control form-control-sm"
                                                        value="{{ isset($PatInsurance) ? $PatInsurance->DOB : old('DOB') }}">
                                                </div>
                                                <span><small class="text-danger font-weight-light font-italic">
                                                        @error('DOB')
                                                        {{ $message }}
                                                        @enderror
                                                    </small></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label class="col-form-label form-control-sm">City</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" required placeholder="City" name="City" id="City" class="form-control form-control form-control-sm"
                                                        value="{{ isset($PatInsurance) ? $PatInsurance->City : old('City') }}">
                                                </div>
                                                <span><small class="text-danger font-weight-light font-italic">
                                                        @error('City')
                                                        {{ $message }}
                                                        @enderror
                                                    </small></span>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label class="col-form-label form-control-sm">State</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" required placeholder="State" name="State" id="State" class="form-control form-control form-control-sm"
                                                        value="{{ isset($PatInsurance) ? $PatInsurance->State : old('State') }}">
                                                </div>
                                                <span><small class="text-danger font-weight-light font-italic">
                                                        @error('State')
                                                        {{ $message }}
                                                        @enderror
                                                    </small></span>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label class="col-form-label form-control-sm">Zip</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" required placeholder="Zip" id="ZIP" name="ZIP" class="form-control form-control form-control-sm"
                                                        value="{{ isset($PatInsurance) ? $PatInsurance->ZIP : old('ZIP') }}">
                                                </div>
                                                <span><small class="text-danger font-weight-light font-italic">
                                                        @error('Zip')
                                                        {{ $message }}
                                                        @enderror
                                                    </small></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label class="col-form-label form-control-sm">MI</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" required placeholder="MI" name="MI" id="MI" class="form-control form-control form-control-sm"
                                                        value="{{ isset($PatInsurance) ? $PatInsurance->MI : old('MI') }}">
                                                </div>
                                                <span><small class="text-danger font-weight-light font-italic">
                                                        @error('MI')
                                                        {{ $message }}
                                                        @enderror
                                                    </small></span>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label class="col-form-label form-control-sm">Suffix</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" required placeholder="Suffix" name="Suffix" id="Suffix" class="form-control form-control form-control-sm"
                                                        value="{{ isset($PatInsurance) ? $PatInsurance->Suffix : old('Suffix') }}">
                                                </div>
                                                <span><small class="text-danger font-weight-light font-italic">
                                                        @error('Suffix')
                                                        {{ $message }}
                                                        @enderror
                                                    </small></span>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label class="col-form-label form-control-sm">Gender</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" required placeholder="Gender" name="Gender" id="Gender" class="form-control form-control form-control-sm"
                                                        value="{{ isset($PatInsurance) ? $PatInsurance->Gender : old('Gender') }}">
                                                </div>
                                                <span><small class="text-danger font-weight-light font-italic">
                                                        @error('Gender')
                                                        {{ $message }}
                                                        @enderror
                                                    </small></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label class="col-form-label form-control-sm">Address</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" required placeholder="Address" id="Address" name="Address" class="form-control form-control form-control-sm"
                                                        value="{{ isset($PatInsurance) ? $PatInsurance->Address : old('Address') }}">
                                                </div>
                                                <span><small class="text-danger font-weight-light font-italic">
                                                        @error('Address')
                                                        {{ $message }}
                                                        @enderror
                                                    </small></span>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label class="col-form-label form-control-sm">Phone</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" required placeholder="Phone" name="Phone" id="Phone" class="form-control form-control form-control-sm"
                                                        value="{{ isset($PatInsurance) ? $PatInsurance->Phone : old('Phone') }}">
                                                </div>
                                                <span><small class="text-danger font-weight-light font-italic">
                                                        @error('Phone')
                                                        {{ $message }}
                                                        @enderror
                                                    </small></span>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label class="col-form-label form-control-sm">Mobile</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" required placeholder="Mobile" id="Mobile" name="Mobile" class="form-control form-control form-control-sm"
                                                        value="{{ isset($PatInsurance) ? $PatInsurance->Mobile : old('Mobile') }}">
                                                </div>
                                                <span><small class="text-danger font-weight-light font-italic">
                                                        @error('Mobile')
                                                        {{ $message }}
                                                        @enderror
                                                    </small></span>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label class="col-form-label form-control-sm">Payment %</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" required placeholder="Payment %" name="Payment" class="form-control form-control form-control-sm"
                                                        value="{{ isset($PatInsurance) ? $PatInsurance->Payment : old('Payment') }}">
                                                </div>
                                                <span><small class="text-danger font-weight-light font-italic">
                                                        @error('Payment')
                                                        {{ $message }}
                                                        @enderror
                                                    </small></span>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group form-check">
                                                <input type="checkbox" class="form-check-input" id="exampleCheck1" checked required name="Eligibility">
                                                <label class="form-check-label" for="exampleCheck1">Request&nbsp;Eligibility&nbsp;Information</label>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="form-group col ">
                                            <label>Basis</label>
                                            <div class="input-group">
                                                <select class="form-control form-control form-control-sm" id="status-dropdown" required name="Basis">
                                                    <option disabled {{ old('Basis', isset($PatInsurance) ? $PatInsurance->Basis : '') == '' ? 'selected' : '' }}>Basis</option>
                                                    <option value="Bill" {{ old('Basis', isset($PatInsurance) ? $PatInsurance->Basis : '') == "Bill" ? 'selected' : '' }}>Bill</option>
                                                    <option value="Allowed" {{ old('Basis', isset($PatInsurance) ? $PatInsurance->Basis : '') == "Allowed" ? 'selected' : '' }}>Allowed</option>
                                                </select>
                                            </div>
                                            <span>
                                                <small class="text-danger font-weight-light font-italic">
                                                    @error('Basis')
                                                    {{ $message }}
                                                    @enderror
                                                </small>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label class="col-form-label form-control-sm">Inactive Date</label>
                                                <div class="input-group mb-3">
                                                    <input type="date" required placeholder="Inactive Date" name="Inactive" class="form-control form-control form-control-sm"
                                                        value="{{ isset($PatInsurance) ? $PatInsurance->Inactive : old('Inactive') }}">
                                                </div>
                                                <span><small class="text-danger font-weight-light font-italic">
                                                        @error('Inactive')
                                                        {{ $message }}
                                                        @enderror
                                                    </small></span>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label class="col-form-label form-control-sm">Eligibility Requested On</label>
                                                <div class="input-group mb-3">
                                                    <input type="date" required placeholder="Eligibility" name="EligibilityRequested" class="form-control form-control form-control-sm"
                                                        value="{{ isset($PatInsurance) ? $PatInsurance->EligibilityRequested : old('EligibilityRequested') }}">
                                                </div>
                                                <span><small class="text-danger font-weight-light font-italic">
                                                        @error('EligibilityRequested')
                                                        {{ $message }}
                                                        @enderror
                                                    </small></span>
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
            logAction("Add Patient Insurance Page Loaded");


            function toggleFields() {
                var selectedValue = $('#Relationship-dropdown').val();
                if (selectedValue === 'Self') {
                    $('#first-name, #last-name, #dob,#Mobile,#Phone,#Address,#Gender,#Suffix,#MI,#ZIP,#State,#City').prop('readonly', true);
                    $('#first-name, #last-name, #dob,#Mobile,#Phone,#Address,#Gender,#Suffix,#MI,#ZIP,#State,#City').prop('disabled', true);

                } else {
                    $('#first-name, #last-name, #dob,#Mobile,#Phone,#Address,#Gender,#Suffix,#MI,#ZIP,#State,#City').prop('disabled', false);
                    $('#first-name, #last-name, #dob,#Mobile,#Phone,#Address,#Gender,#Suffix,#MI,#ZIP,#State,#City').prop('readonly', false);
                }
            }

            toggleFields();

            $('#Relationship-dropdown').change(function() {
                toggleFields();
            });


        });
    </script>
