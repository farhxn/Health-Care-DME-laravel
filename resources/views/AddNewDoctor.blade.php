<?php
$title =  isset($doctor) ? 'Update Dr. ' . $doctor->FirstName . ' ' . $doctor->LastName : 'Add Doctor';
?>
@section('title', $title)
@include('layout.Head')

<div class="dashboard-wrapper">
    <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content">
            <div class="row">

                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="page-header">
                        <h2 class="pageheader-title ml-auto">{{ isset($doctor) ? 'Update Doctor' : 'Add Doctor' }} </h2>
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
                        <form method="post" action="{{ url('AddEditNewDoctor',isset($doctor) ? $doctor->id : 0) }}" id="myForm">
                            @csrf
                            <div class="card">
                                <h5 class="card-header">
                                    {{ isset($doctor) ? 'Update Dr. ' . $doctor->FirstName . ' '.$doctor->LastName : 'Add Doctor' }} Details
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
                                                <label class="col-form-label form-control-sm text-sm">First Name</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" placeholder="First Name" name="FirstName"
                                                        class="form-control form-control-sm" value="{{ isset($doctor) ? $doctor->FirstName : old('FirstName') }}">
                                                </div>
                                                <span><small class="text-danger font-weight-light font-italic">
                                                        @error('FirstName')
                                                        {{ $message }}
                                                        @enderror
                                                    </small></span>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label class="col-form-label form-control-sm text-sm">Last Name</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" required placeholder="Last Name" name="LastName"
                                                        class="form-control form-control-sm" value="{{ isset($doctor) ? $doctor->LastName : old('LastName') }}">
                                                </div>
                                                <span><small class="text-danger font-weight-light font-italic">
                                                        @error('LastName')
                                                        {{ $message }}
                                                        @enderror
                                                    </small></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label class="col-form-label form-control-sm text-sm">MI</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" required placeholder="MI" name="MI"
                                                        class="form-control form-control-sm" value="{{ isset($doctor) ? $doctor->MI : old('MI') }}">

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
                                                <label class="col-form-label form-control-sm text-sm">Suffix</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" required placeholder="Suffix" name="Suffix"
                                                        class="form-control form-control-sm" value="{{ isset($doctor) ? $doctor->Suffix : old('Suffix') }}">
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
                                                <label class="col-form-label form-control-sm">Courtesy</label>
                                                <div class="input-group">
                                                    <select class="form-control form-control-sm" id="status-dropdown" required name="Courtesy">
                                                        <option disabled {{ old('Courtesy', isset($doctor) ? $doctor->Courtesy : '') == '' ? 'selected' : '' }}>Courtesy</option>
                                                        <option value="Dr." {{ old('Courtesy', isset($doctor) ? $doctor->Courtesy : '') == 'Dr.' ? 'selected' : '' }}>Dr.</option>
                                                        <option value="Miss." {{ old('Courtesy', isset($doctor) ? $doctor->Courtesy : '') == 'Miss.' ? 'selected' : '' }}>Miss.</option>
                                                        <option value="Mr." {{ old('Courtesy', isset($doctor) ? $doctor->Courtesy : '') == 'Mr.' ? 'selected' : '' }}>Mr.</option>
                                                        <option value="Mrs." {{ old('Courtesy', isset($doctor) ? $doctor->Courtesy : '') == 'Mrs.' ? 'selected' : '' }}>Mrs.</option>
                                                        <option value="Rev." {{ old('Courtesy', isset($doctor) ? $doctor->Courtesy : '') == 'Rev.' ? 'selected' : '' }}>Rev.</option>
                                                    </select>
                                                </div>
                                                <span><small class="text-danger font-weight-light font-italic">
                                                        @error('Courtesy')
                                                        {{ $message }}
                                                        @enderror
                                                    </small></span>
                                            </div>
                                        </div>

                                    </div>


                                    <div class="col-12 m-b-60 mt-3">
                                        <div class="simple-card">
                                            <ul class="nav nav-tabs" id="myTab5" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link active" id="product-tab-1" data-toggle="tab" href="#tab-6" role="tab" aria-controls="product-tab-1" aria-selected="false">Address</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link " id="product-tab-1" data-toggle="tab" href="#tab-1" role="tab" aria-controls="product-tab-1" aria-selected="false">Numbers</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link border-left-0" id="product-tab-2" data-toggle="tab" href="#tab-2" role="tab" aria-controls="product-tab-2" aria-selected="true">Marketing Information</a>
                                                </li>
                                            </ul>

                                            <div class="tab-content" id="myTabContent5">

                                                <div class="tab-pane fade show active " id="tab-6" role="tabpanel" aria-labelledby="product-tab-4">
                                                    <div class="form-group">
                                                        <label class="col-form-label form-control-sm text-sm">Address</label>
                                                        <div class="input-group mb-3">
                                                            <input type="text" required placeholder="Address" id="patientAddress" name="Address"
                                                                class="form-control form-control-sm" value="{{ isset($doctor) ? $doctor->Address : old('Address') }}">
                                                        </div>
                                                        <span><small class="text-danger font-weight-light font-italic">
                                                                @error('Address')
                                                                {{ $message }}
                                                                @enderror
                                                            </small></span>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label class="col-form-label form-control-sm text-sm">City</label>
                                                                <div class="input-group mb-3">
                                                                    <input type="text" required placeholder="City" name="City"
                                                                        class="form-control form-control-sm" value="{{ isset($doctor) ? $doctor->City : old('City') }}">
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
                                                                <label class="col-form-label form-control-sm text-sm">State</label>
                                                                <div class="input-group mb-3">
                                                                    <input type="text" required placeholder="State" name="State"
                                                                        class="form-control form-control-sm" value="{{ isset($doctor) ? $doctor->State : old('State') }}">
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
                                                                <label class="col-form-label form-control-sm text-sm">Zip</label>
                                                                <div class="input-group mb-3">
                                                                    <input type="text" required placeholder="Zip" name="Zip"
                                                                        class="form-control form-control-sm" value="{{ isset($doctor) ? $doctor->Zip : old('Zip') }}">
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
                                                                <label class="col-form-label form-control-sm text-sm">Phone</label>
                                                                <div class="input-group mb-3">
                                                                    <input type="text" required placeholder="Phone" name="Phone"
                                                                        class="form-control form-control-sm" value="{{ isset($doctor) ? $doctor->Phone : old('Phone') }}">
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
                                                                <label class="col-form-label form-control-sm text-sm">Phone 2</label>
                                                                <div class="input-group mb-3">
                                                                    <input type="text" required placeholder="Phone 2" name="Phone2"
                                                                        class="form-control form-control-sm" value="{{ isset($doctor) ? $doctor->Phone2 : old('Phone2') }}">
                                                                </div>
                                                                <span><small class="text-danger font-weight-light font-italic">
                                                                        @error('Phone2')
                                                                        {{ $message }}
                                                                        @enderror
                                                                    </small></span>
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label class="col-form-label form-control-sm text-sm">Fax</label>
                                                                <div class="input-group mb-3">
                                                                    <input type="text" required placeholder="Fax" name="Fax"
                                                                        class="form-control form-control-sm" value="{{ isset($doctor) ? $doctor->Fax : old('Fax') }}">
                                                                </div>
                                                                <span><small class="text-danger font-weight-light font-italic">
                                                                        @error('Fax')
                                                                        {{ $message }}
                                                                        @enderror
                                                                    </small></span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="tab-pane fade " id="tab-1" role="tabpanel" aria-labelledby="product-tab-4">

                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label class="col-form-label form-control-sm text-sm">UPIN</label>
                                                                <div class="input-group mb-3">
                                                                    <input type="text" required placeholder="UPIN" name="UPIN"
                                                                        class="form-control form-control-sm" value="{{ isset($doctor) ? $doctor->UPIN : old('UPIN') }}">
                                                                </div>
                                                                <span><small class="text-danger font-weight-light font-italic">
                                                                        @error('UPIN')
                                                                        {{ $message }}
                                                                        @enderror
                                                                    </small></span>
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label class="col-form-label form-control-sm text-sm">Medicaid #</label>
                                                                <div class="input-group mb-3">
                                                                    <input type="text" required placeholder="Medicaid" name="Medicaid"
                                                                        class="form-control form-control-sm" value="{{ isset($doctor) ? $doctor->Medicaid : old('Medicaid') }}">
                                                                </div>
                                                                <span><small class="text-danger font-weight-light font-italic">
                                                                        @error('Medicaid')
                                                                        {{ $message }}
                                                                        @enderror
                                                                    </small></span>
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label class="col-form-label form-control-sm text-sm">NPI</label>
                                                                <div class="input-group mb-3">
                                                                    <input type="number" id="npiNumber" required placeholder="NPI" name="NPI"
                                                                        class="form-control form-control-sm" value="{{ isset($doctor) ? $doctor->NPI : old('NPI') }}">
                                                                </div>
                                                                <span><small class="text-danger font-weight-light font-italic">
                                                                        @error('NPI')
                                                                        {{ $message }}
                                                                        @enderror
                                                                    </small></span>
                                                            </div>


                                                        </div>

                                                    </div>

                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label class="col-form-label form-control-sm text-sm">License</label>
                                                                <div class="input-group mb-3">
                                                                    <input type="text" required placeholder="License" name="License"
                                                                        class="form-control form-control-sm" value="{{ isset($doctor) ? $doctor->License : old('License') }}">
                                                                </div>
                                                                <span><small class="text-danger font-weight-light font-italic">
                                                                        @error('License')
                                                                        {{ $message }}
                                                                        @enderror
                                                                    </small></span>
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label class="col-form-label form-control-sm text-sm">License Expired</label>
                                                                <div class="input-group mb-3">
                                                                    <input type="date" required placeholder="License" name="Expiry"
                                                                        class="form-control form-control-sm" value="{{ isset($doctor) ? $doctor->Expiry : old('Expiry') }}">
                                                                </div>
                                                                <span><small class="text-danger font-weight-light font-italic">
                                                                        @error('Expired')
                                                                        {{ $message }}
                                                                        @enderror
                                                                    </small></span>
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label class="col-form-label form-control-sm text-sm">Other ID</label>
                                                                <div class="input-group mb-3">
                                                                    <input type="text" required placeholder="Other" name="Other"
                                                                        class="form-control form-control-sm" value="{{ isset($doctor) ? $doctor->Other : old('Other') }}">
                                                                </div>
                                                                <span><small class="text-danger font-weight-light font-italic">
                                                                        @error('Other')
                                                                        {{ $message }}
                                                                        @enderror
                                                                    </small></span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label class="col-form-label form-control-sm text-sm">Federal Tax ID</label>
                                                                <div class="input-group mb-3">
                                                                    <input type="text" required placeholder="Federal" name="Federal"
                                                                        class="form-control form-control-sm" value="{{ isset($doctor) ? $doctor->Federal : old('Federal') }}">
                                                                </div>
                                                                <span><small class="text-danger font-weight-light font-italic">
                                                                        @error('Federal')
                                                                        {{ $message }}
                                                                        @enderror
                                                                    </small></span>
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label class="col-form-label form-control-sm text-sm">DES Number</label>
                                                                <div class="input-group mb-3">
                                                                    <input type="number" required placeholder="DES" name="DES"
                                                                        class="form-control form-control-sm" value="{{ isset($doctor) ? $doctor->DES : old('DES') }}">
                                                                </div>
                                                                <span><small class="text-danger font-weight-light font-italic">
                                                                        @error('DES')
                                                                        {{ $message }}
                                                                        @enderror
                                                                    </small></span>
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label class="col-form-label form-control-sm text-sm">NPI Check Date</label>
                                                                <div class="input-group mb-3">
                                                                    <input type="date" id="LastCheck" readonly placeholder="Last Check" name="LastCheck"
                                                                        class="form-control form-control-sm" value="{{ isset($doctor) ? $doctor->LastCheck : old('LastCheck') }}">
                                                                </div>
                                                                <span><small class="text-danger font-weight-light font-italic">
                                                                        @error('LastCheck')
                                                                        {{ $message }}
                                                                        @enderror
                                                                    </small></span>
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label class="col-form-label form-control-sm text-sm">NPI&nbsp;User&nbsp;Check</label>
                                                                <div class="input-group mb-3">
                                                                    <input type="text" id="LastCheckUser" readonly placeholder="Last Check" name="LastCheckUser"
                                                                        class="form-control form-control-sm" value="{{ isset($doctor) ? $doctor->LastCheckUser : old('LastCheckUser') }}">
                                                                </div>
                                                                <span><small class="text-danger font-weight-light font-italic">
                                                                        @error('LastCheckUser')
                                                                        {{ $message }}
                                                                        @enderror
                                                                    </small></span>
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="form-group form-check">
                                                                <input type="checkbox" class="form-check-input" id="exampleCheck1"
                                                                    name="PECOS"
                                                                    {{ isset($doctor) && $doctor->PECOS ? 'checked' : '' }}
                                                                    {{ old('PECOS') ? 'checked' : '' }}>
                                                                <label class="form-check-label" for="exampleCheck1">PECOS enrolled</label>
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                        <button class="btn btn-sm btn-primary" id="checkNpiButton">Check</button>
                                                        </div>
                                                        <div class="col">
                                                            <div id="npiStatus"></div>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="tab-pane fade " id="tab-2" role="tabpanel" aria-labelledby="product-tab-4">
                                                    <div class="form-group">
                                                        <label class="col-form-label form-control-sm">Doctor Type</label>
                                                        <div class="input-group">
                                                            <select class="form-control form-control-sm" id="Doctor-dropdown" required name="DoctorType">
                                                                <option disabled {{ old('DoctorType', isset($doctor) ? $doctor->DoctorType : '') == '' ? 'selected' : '' }}>Doctor</option>
                                                                @foreach ($DoctorType as $dt)
                                                                <option value="{{ $dt->name }}" {{ old('DoctorType', isset($doctor) ? $doctor->DoctorType : '') == $dt->name ? 'selected' : '' }}>
                                                                    {{ $dt->name }}
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
                                                                @error('DoctorType')
                                                                {{ $message }}
                                                                @enderror
                                                            </small></span>
                                                    </div>



                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label class="col-form-label form-control-sm text-sm">Contact</label>
                                                                <div class="input-group mb-3">
                                                                    <input type="text" required placeholder="Contact" name="Contact"
                                                                        class="form-control form-control-sm" value="{{ isset($doctor) ? $doctor->Contact : old('Contact') }}">
                                                                </div>
                                                                <span><small class="text-danger font-weight-light font-italic">
                                                                        @error('Contact')
                                                                        {{ $message }}
                                                                        @enderror
                                                                    </small></span>
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label class="col-form-label form-control-sm text-sm">Title</label>
                                                                <div class="input-group mb-3">
                                                                    <input type="text" required placeholder="Title" name="Title"
                                                                        class="form-control form-control-sm" value="{{ isset($doctor) ? $doctor->Title : old('Title') }}">
                                                                </div>
                                                                <span><small class="text-danger font-weight-light font-italic">
                                                                        @error('Title')
                                                                        {{ $message }}
                                                                        @enderror
                                                                    </small></span>
                                                            </div>
                                                        </div>
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
                                                    style="background-color: #427ed1; color: white;"> {{ isset($doctor) ? 'Update Doctor' : 'Add Doctor' }}
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
                    <h5 class="modal-title" id="addDoctorTypeModalLabel">Add Doctor Type</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body modal-blur-content">
                    <form id="addDoctorTypeForm">
                        <div class="form-group">
                            <label for="doctorTypeName">Doctor Type Name</label>
                            <input type="text" class="form-control" id="doctorTypeName" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
                <!-- Loader -->
                <div id="modalLoader" class="modal-loader-overlay" style="display:none;">
                    <span class="dashboard-spinner spinner-warning spinner-sm"></span>
                </div>
            </div>
        </div>
    </div>




    <script>
        $(document).ready(function() {
            logAction("Add Doctor Page Loaded");

            $('#addDoctorTypeForm').on('submit', function(e) {
                e.preventDefault();
                var doctorTypeName = $('#doctorTypeName').val();
                $('.modal-blur-content').addClass('modal-blur');
                $('#modalLoader').show();

                $.ajax({
                    url: '/add-doctor-type', // Your route for adding the doctor type
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}', // Include CSRF token
                        name: doctorTypeName
                    },
                    success: function(response) {
                        $('#Doctor-dropdown').append(`<option value="${response.name}">${response.name}</option>`);
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



            document.getElementById('myForm').addEventListener('submit', function(event) {
                var form = this;
                var isValid = true;
                var firstInvalidField = null;

                form.querySelectorAll('input[required]').forEach(function(input) {
                    if (!input.value.trim()) {
                        isValid = false;

                        if (!firstInvalidField) {
                            firstInvalidField = input;
                        }
                    }
                });

                if (!isValid) {
                    event.preventDefault();

                    var invalidTabPane = firstInvalidField.closest('.tab-pane');
                    var tabId = invalidTabPane.getAttribute('id');

                    var tabTrigger = document.querySelector(`[href="#${tabId}"]`);
                    var tab = new bootstrap.Tab(tabTrigger);
                    tab.show();
                    firstInvalidField.focus();

                    firstInvalidField.scrollIntoView({
                        behavior: 'smooth',
                        block: 'center'
                    });
                }
            });



            document.getElementById('checkNpiButton').addEventListener('click', function() {
                event.preventDefault();
                var npiNumber = document.getElementById('npiNumber').value;

                if (!npiNumber) {
                    alert('Please enter an NPI number');
                    return;
                }
                var npiStatusDiv = document.getElementById('npiStatus');
                npiStatusDiv.innerHTML = '<span class="dashboard-spinner spinner-secondary spinner-xs"></span>';

                fetch('/check-npi-status', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            npi: npiNumber
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status) {
                            npiStatusDiv.innerHTML = `<span class="${data.statusClass}">${data.status}</span>`;
                            if (data.statusClass == "text-success") {
                                var currentDate = new Date().toISOString().split('T')[0]; // Format YYYY-MM-DD
                                document.getElementById('LastCheck').value = currentDate;
                                document.getElementById('LastCheckUser').value = data.userName;
                            } else {
                                document.getElementById('LastCheck').value = null;
                            }
                        } else {
                            npiStatusDiv.innerHTML = `<span class="text-danger">Invalid NPI number</span>`;
                        }
                    })
                    .catch(error => {
                        npiStatusDiv.innerHTML = `<span class="text-danger">Error: ${error.message}</span>`;
                    });
            });
        });
    </script>
