@section('title', 'Add Patient')
@include('layout.Head')

<div class="dashboard-wrapper">
    <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content">
            <div class="row">

                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="page-header">
                        <h2 class="pageheader-title ml-auto">Add Patient</h2>
                        <div class="page-breadcrumb">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <!-- <li class="breadcrumb-item">
                        <a href="#" class="breadcrumb-link">Dashboard</a>
                      </li>
                      <li class="breadcrumb-item active" aria-current="page">
                        Home
                      </li> -->
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <div class="ecommerce-widget">

                <div class="row">


                    <div class="col">

                        <form method="post" action="{{ url('RegisterPatient') }}" enctype="multipart/form-data" id="updatePatientForm">
                            @csrf
                            <div class="card">
                                <h5 class="card-header">Add Patient Details</h5>
                                <div class="card-body">
                                    @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                            <li class="text-danger">{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    @endif
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label class="col-form-label">Patient First Name</label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fa fa-bed"></i></span>
                                                    </span>
                                                    <input type="text" required placeholder="Patient Name" name="name" class="form-control" value="{{ old('name') }}">
                                                </div>
                                                <span>
                                                    <small class="text-danger font-weight-light font-italic">
                                                        @error('name')
                                                        {{ $message }}
                                                        @enderror
                                                    </small>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label class="col-form-label">Patient Middle Name</label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fa fa-bed"></i></span>
                                                    </span>
                                                    <input type="text" required placeholder="Patient Middle Name" name="middleName" class="form-control" value="{{ old('middleName') }}">
                                                </div>
                                                <span>
                                                    <small class="text-danger font-weight-light font-italic">
                                                        @error('middleName')
                                                        {{ $message }}
                                                        @enderror
                                                    </small>
                                                </span>
                                            </div>
                                        </div>

                                        <!-- Patient Last Name -->
                                        <div class="col">
                                            <div class="form-group">
                                                <label class="col-form-label">Patient Last Name</label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fa fa-user"></i></span>
                                                    </span>
                                                    <input type="text" required placeholder="Last Name" name="lastname" class="form-control" value="{{ old('lastname') }}">
                                                </div>
                                                <span>
                                                    <small class="text-danger font-weight-light font-italic">
                                                        @error('lastname')
                                                        {{ $message }}
                                                        @enderror
                                                    </small>
                                                </span>
                                            </div>
                                        </div>

                                        <!-- Gender Selection -->
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Gender</label>
                                                <div class="d-block">
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" id="genderMale" name="gender" class="custom-control-input" value="Male" checked>
                                                        <label class="custom-control-label" for="genderMale">Male</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" id="genderFemale" name="gender" class="custom-control-input" value="Female">
                                                        <label class="custom-control-label" for="genderFemale">Female</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">


                                        <div class="col">
                                            <div class="form-group">
                                                <label class="col-form-label">Patient Address</label>
                                                <div class="input-group mb-3"><span class="input-group-prepend"><span class="input-group-text"><i class="fa fa-map"></i></span></span>
                                                    <input type="text" required placeholder="Patient Address" id="patientAddress" name="address" class="form-control" value="{{ old('address') }}">
                                                </div>
                                                <span><small class="text-danger font-weight-light font-italic">
                                                        @error('address')
                                                        {{ $message }}
                                                        @enderror
                                                    </small></span>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label class="col-form-label">Patient height (Inches)</label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fa-solid fa-ruler-vertical"></i></span>
                                                    </span>
                                                    <input placeholder="Patient Height (in Inches)" name="height" class="form-control" value="{{ old('height') }}">
                                                </div>
                                                <span>
                                                    <small class="text-danger font-weight-light font-italic">
                                                        @error('height')
                                                        {{ $message }}
                                                        @enderror
                                                    </small>
                                                </span>
                                            </div>
                                        </div>


                                        <div class="col-3">
                                            <div class="form-group">
                                                <label class="col-form-label">Patient Weight ( LB )</label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fa-solid fa-weight-scale"></i></span>
                                                    </span>
                                                    <input type="text" placeholder="Patient Weight (in LB)" name="weight" class="form-control" value="{{ old('weight') }}">
                                                </div>
                                                <span>
                                                    <small class="text-danger font-weight-light font-italic">
                                                        @error('weight')
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
                                                <label class="col-form-label">Patient Email</label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fa-solid fa-at"></i></span>
                                                    </span>
                                                    <input type="mail" placeholder="Patient E-Mail" name="mail" class="form-control" value="{{ old('name') }}">
                                                </div>
                                                <span>
                                                    <small class="text-danger font-weight-light font-italic">
                                                        @error('mail')
                                                        {{ $message }}
                                                        @enderror
                                                    </small>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="col">
                                            <div class="form-group">
                                                <label class="col-form-label">Patient Date Of Birth</label>
                                                <div class="input-group mb-3"><span class="input-group-prepend"><span class="input-group-text"><i class="fa fa-calculator"></i></span></span>
                                                    <input type="date" required placeholder="Patient Date Of Birth" name="DOB" class="form-control" value="{{ old('DOB') }}">
                                                </div>
                                                <span><small class="text-danger font-weight-light font-italic">
                                                        @error('DOB')
                                                        {{ $message }}
                                                        @enderror
                                                    </small></span>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label class="col-form-label">Patient Insurance</label>
                                                <div class="input-group mb-3"><span class="input-group-prepend"><span class="input-group-text"><i class="fa fa-info-circle"></i></span></span>
                                                    <input type="text" required placeholder="Patient Insurance" name="insurance" class="form-control" value="{{ old('insurance') }}">
                                                </div>
                                                <span><small class="text-danger font-weight-light font-italic">
                                                        @error('insurance')
                                                        {{ $message }}
                                                        @enderror
                                                    </small></span>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label class="col-form-label">Item</label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-prepend"><span class="input-group-text"><i class="fa fa-flask"></i></span></span>
                                                    <input type="text" required placeholder="Item" value="{{ old('item') }}" class="form-control" name="item">
                                                </div>
                                                <span><small class="text-danger font-weight-light font-italic">
                                                        @error('item')
                                                        {{ $message }}
                                                        @enderror
                                                    </small></span>
                                            </div>
                                        </div>

                                        <div class="col">
                                            <div class="form-group">
                                                <label class="col-form-label">Account No #</label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-prepend"><span class="input-group-text"><i class="fa-solid fa-hashtag"></i></span></span>
                                                    <input type="text" required placeholder="Account No#" name="AccNumber" class="form-control" value="{{ old('AccNumber') }}">
                                                </div>
                                                <span><small class="text-danger font-weight-light font-italic">
                                                        @error('AccNumber')
                                                        {{ $message }}
                                                        @enderror
                                                    </small></span>
                                            </div>
                                        </div>

                                        <div class="col">
                                            <div class="form-group">
                                                <label class="col-form-label">Order No #</label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-prepend"><span class="input-group-text"><i class="fa-solid fa-tag"></i></span></span>
                                                    <input type="text" required placeholder="Order No#" name="orderNumber" class="form-control" value="{{ old('orderNumber') }}">
                                                </div>
                                                <span><small class="text-danger font-weight-light font-italic">
                                                        @error('orderNumber')
                                                        {{ $message }}
                                                        @enderror
                                                    </small></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group" id="phoneNumbers">
                                        <label for="phone">Phone Number(s)</label>
                                        <div class="input-group mb-2">
                                            <input type="number" name="phone[]" class="form-control" placeholder="Enter phone number">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary" type="button" id="addPhoneNumber"><i class="fa fa-plus"></i> Add Phone Number</button>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label class="col-form-label">Dr. Office Name</label>
                                        <div class="input-group mb-3"><span class="input-group-prepend"><span class="input-group-text"><i class="fa fa-stethoscope"></i></span></span>
                                            <select class="form-control select2" required name="office_name">
                                                <option selected disabled>Dr. Office Name</option>
                                                @foreach ($dr as $drs)
                                                <option value="{{ $drs->id }}">{{ $drs->Office_Name }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <span><small class="text-danger font-weight-light font-italic">
                                                @error('office_name')
                                                {{ $message }}
                                                @enderror
                                            </small></span>
                                    </div>


                                    <div class="form-group">
                                        <label class="col-form-label">Order Status</label>
                                        <div class="input-group mb-3"><span class="input-group-prepend"><span class="input-group-text"><i class="fa-solid fa-square-poll-vertical"></i></span></span>
                                            <select class="form-control" id="status-dropdown" required name="order_status">
                                                <option selected disabled>Order Status</option>
                                                @foreach ($st as $drs)
                                                <option value="{{ $drs->id }}">{{ $drs->Status }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <span><small class="text-danger font-weight-light font-italic">
                                                @error('order_status')
                                                {{ $message }}
                                                @enderror
                                            </small></span>
                                    </div>



                                    <div class="form-group" style="display: none;" id="resupplyDate-container">
                                        <label for="inputEmail3" class="col-sm-4 col-form-label">Initial Resupply Date</label>
                                        <div class="input-group mb-3"><span class="input-group-prepend"><span class="input-group-text"><i class="fa fa-calendar"></i></span></span>
                                            <input type="date" name="redate" class="form-control">
                                        </div>
                                        <span><small class="text-danger font-weight-light font-italic">
                                                @error('redate')
                                                {{ $message }}
                                                @enderror
                                            </small></span>
                                    </div>


                                    <div class="row mb-3" id="newresupplyDate-container" style="display: none;">
                                        <label for="inputEmail3" class="col-sm-4 col-form-label">Next Resupply Date</label>
                                        <div class="col-sm-8">
                                            <div class="form-group">
                                                <div class="input-group mb-3"><span class="input-group-prepend"><span class="input-group-text"><i class="fa fa-calendar"></i></span></span>
                                                    <input type="date" name="newredate" class="form-control">

                                                </div>
                                                <span><small class="text-danger font-weight-light font-italic">
                                                        @error('newredate')
                                                        {{ $message }}
                                                        @enderror
                                                    </small></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3" id="newfrequency-container" style="display: none;">
                                        <label for="inputPassword3" class="col-sm-4 col-form-label">Frequency</label>
                                        <div class="col-sm-8">
                                            <div class="form-group">
                                                <select class="form-control form-control-sm" name="newfrequency">
                                                    <option selected disabled> Select Frequency</option>
                                                    <option value="30">30 Days</option>
                                                    <option value="60">60 Days</option>
                                                    <option value="90">90 Days</option>
                                                    <option value="180">180 Days</option>
                                                    <option value="365">365 Days</option>
                                                </select>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-3" id="newDept1-container" style="display: none;">
                                        <label for="inputPassword3" class="col-sm-4 col-form-label">Resupply Process Dept</label>
                                        <div class="col-sm-8">
                                            <div class="form-group">
                                                <select class="form-control form-control-sm" name="newdpt">
                                                    @foreach ($dp as $sts)
                                                    <option value="{{ $sts->id }}">{{ $sts->Department }}</option>
                                                    @endforeach

                                                </select>
                                            </div>
                                        </div>
                                    </div>




                                    <div class="form-group">
                                        <label class="col-form-label">Assign Department</label>
                                        <div class="input-group mb-3"><span class="input-group-prepend"><span class="input-group-text"><i class="fa-solid fa-square-poll-vertical"></i></span></span>
                                            <select class="form-control" required name="department" id="dept-dropdown">
                                                <option selected disabled>Assign Department</option>
                                                @foreach ($dp as $dpItem)
                                                <option value="{{ $dpItem->id }}">{{ $dpItem->Department }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <span><small class="text-danger font-weight-light font-italic">
                                                @error('department')
                                                {{ $message }}
                                                @enderror
                                            </small></span>
                                    </div>

                                    <div class="form-group" id="subdept-container" style="display: none;">
                                        <label class="col-form-label">Assign Sub Department</label>
                                        <div class="input-group mb-3"><span class="input-group-prepend"><span class="input-group-text"><i class="fa-solid fa-square-poll-vertical"></i></span></span>
                                            <select class="form-control form-control-sm" name="subdpt">
                                                @foreach($subDept as $sub)
                                                <option value="{{$sub->SubDept}}">{{$sub->SubDept}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <span><small class="text-danger font-weight-light font-italic">
                                                @error('subdpt')
                                                {{ $message }}
                                                @enderror
                                            </small></span>
                                    </div>




                                    <div class="form-group" id="user-container" style="display: none;">
                                        <label class="col-form-label">Assign User</label>
                                        <div class="input-group mb-3"><span class="input-group-prepend"><span class="input-group-text"><i class="fa-solid fa-user"></i></span></span>
                                            <select class="form-control" required name="user" id="user-dropdown">
                                                <option selected disabled>Assign User</option>
                                                @foreach ($dp as $dpItem)
                                                <option value="{{ $dpItem->id }}">{{ $dpItem->Department }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <span><small class="text-danger font-weight-light font-italic">
                                                @error('user')
                                                {{ $message }}
                                                @enderror
                                            </small></span>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <label class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="CheckDocUpload" id="CheckDocUpload">
                                                <span class="custom-control-label">Do You Want to upload Document?</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div id="DocumentFormAdd" style="display: none;">
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="documnet" class="col-form-label text-sm small-label">Document Type:</label>
                                                    <select name="docs" id="documnet" class="form-control form-control-sm">
                                                        <option value="Prescription (RX)">Prescription (RX)</option>
                                                        <option value="CMN">CMN</option>
                                                        <option value="Authorization">Authorization</option>
                                                        <option value="Sleep Study">Sleep Study</option>
                                                        <option value="Office Notes/Medical Records">Office Notes/Medical Records</option>
                                                        <option value="Demographics">Demographics</option>
                                                        <option value="Manufacturer Order Form">Manufacturer Order Form</option>
                                                        <option value="Consignment Documents">Consignment Documents</option>
                                                        <option value="Home Assessment">Home Assessment</option>
                                                        <option value="7 Element Form">7 Element Form</option>
                                                        <option value="Proof of Delivery">Proof of Delivery</option>
                                                        <option value="Pickup Ticket">Pickup Ticket</option>
                                                        <option value="Exchange Form">Exchange Form</option>
                                                        <option value="Claims">Claims</option>
                                                        <option value="Other">Other</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="title" class="col-form-label small-label">Document Title:</label>
                                                    <input type="text" placeholder="Enter Title" class="form-control form-control-sm" id="title" name="title" />
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="type" class="col-form-label small-label">Document Type:</label>
                                                    <input type="text" placeholder="Enter Type" class="form-control form-control-sm" id="type" name="type" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col" id="docType" style="display: none;">
                                                <div class="inputSmall">
                                                    <select name="subDoc" id="SubDoc" class="form-control form-control-sm">
                                                        <option value="EOB">EOB</option>
                                                        <option value="Denial letter">Denial letter</option>
                                                        <option value="Appeals level 1">Appeals level 1</option>
                                                        <option value="Appeals level 2">Appeals level 2</option>
                                                        <option value="Approval letter">Approval letter</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="description" class="col-form-label small-label">Description:</label>
                                                    <textarea placeholder="Enter Description" class="form-control form-control-sm" id="description" rows="2" cols="2" name="desc"></textarea>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="fileUpload" class="form-label small-label">Upload File:</label>
                                                    <input type="file" name="img" class="form-control form-control-sm" id="fileUpload" accept=".pdf, .heic, .jpeg, .jpg, .png, .tiff, .tif" />
                                                </div>
                                                <div class="form-group">
                                                    <img id="previewImage" src="path/to/your/image/pdf.png" alt="Image Preview" style="display: none; max-width: 100%; height: auto;" />
                                                    <p id="fileMessage" style="display: none;"></p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group" id="PFDAdd" style="display: none;">
                                                    <label for="PFDate" class="col-form-label small-label">Date of Service:</label>
                                                    <input type="date" class="form-control form-control-sm" id="PFDate" name="PFDate" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group" id="DOSAdd" style="display: none;">
                                                    <label for="DOS" class="col-form-label small-label">Date of Service:</label>
                                                    <input type="date" class="form-control form-control-sm" id="DOS" name="DOS" />
                                                </div>
                                            </div>
                                        </div>
                                        <div id="RX">

                                            <div class="row">
                                                <div class="col">

                                                    <h4 class="small-label"><span id="DataeType">Prescription (RX) </span> Date:</h4>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="FDate" class="col-form-label small-label">From:</label>
                                                        <input type="date" class="form-control form-control-sm" id="FDate" name="FDate" />
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="TDate" class="col-form-label small-label">To:</label>
                                                        <input type="date" class="form-control form-control-sm" id="TDate" name="TDate" />
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="duration" class="col-form-label small-label">Duration:</label>
                                                        <select name="duration" id="durationAdd" class="form-control form-control-sm">
                                                            <option value="12">1 Year</option>
                                                            <option value="6">6 Month</option>
                                                            <option value="3">3 Month</option>
                                                            <option value="1">1 Month</option>
                                                        </select>
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
                                                <button type="submit" id="submitButton" class="btn btn-block" style="background-color: #427ed1; color: white;">Submit</button>
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
            document.getElementById('CheckDocUpload').addEventListener('change', function() {
                var documentFormAdd = document.getElementById('DocumentFormAdd');
                if (this.checked) {
                    documentFormAdd.style.display = 'block';
                } else {
                    documentFormAdd.style.display = 'none';
                }
            });

            $('.select2').select2({
                placeholder: "Select Dr. Office Name", // Optional placeholder text
                allowClear: true // Allows user to clear selected value
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            logAction("Add Paatient Page Loaded");
        });
    </script>
    @if (Session::has('fail'))

    <script>
        Swal.fire({
            title: "Error",
            text: "Unable To Find User\nensure there is user in that department",
            icon: "error"
        });
    </script>
    @endif
    @if (Session::has('error'))
    <script>
        Swal.fire({
            title: "Error",
            text: "{{ session('error') }}", // Make sure to enclose the PHP expression in quotes
            icon: "error"
        });
    </script>
    @endif
    <script>
        $(document).ready(function() {
            document.addEventListener('DOMContentLoaded', function() {
                const form = document.getElementById('DocumentForm');
                const documentTypeSelect = document.getElementById('documnet');
                const subDocDiv = document.getElementById('docType');
                const subDocSelect = document.getElementById('SubDoc');
                const rxDateFrom = document.getElementById('FDate');
                const rxDateTo = document.getElementById('TDate');
                const PFDate = document.getElementById('PFDAdd');
                const PFDateIn = document.getElementById('PFDate');
                const ConsDocAdd = document.getElementById('DOSAdd');
                const DOS = document.getElementById('DOS');

                // Function to check and apply required attributes based on selected document type
                function updateRequiredFields() {
                    const docType = documentTypeSelect.value;
                    // Reset initial states
                    rxDateFrom.required = false;
                    rxDateTo.required = false;
                    subDocSelect.required = false;
                    subDocDiv.style.display = 'none';
                    ConsDocAdd.style.display = 'none';
                    PFDateIn.required = false;
                    PFDate.style.display = 'none';

                    if (docType === 'Prescription (RX)' || docType === 'CMN' || docType === 'Authorization') {
                        rxDateFrom.required = true;
                        rxDateTo.required = true;
                    } else if (docType === 'Claims') {
                        subDocDiv.style.display = 'block';
                        subDocSelect.required = true;
                    } else if (docType === "Proof of Delivery") {
                        PFDate.style.display = 'block';
                        PFDateIn.required = true;
                    } else if (docType === "Consignment Documents") {
                        ConsDocAdd.style.display = 'block';
                        DOS.required = true;
                        rxDateFrom.required = true;
                        rxDateTo.required = true;
                    }
                }

                // Initial check on page load
                updateRequiredFields();

                // Event listener for change on document type select
                documentTypeSelect.addEventListener('change', updateRequiredFields);
            });



            $('select[name="duration"], input[name="FDate"]').on('change input', function() {
                // Get the selected duration in months or years
                var duration = parseInt($('select[name="duration"]').val());
                var isYear = (duration === 12); // Check if the duration is in years

                // Get the current start date from the FDate input
                var startDate = $('input[name="FDate"]').val();

                if (!isNaN(duration) && startDate) {
                    var nextResupplyDate = new Date(startDate);

                    if (isYear) {
                        // Add one year to the start date
                        nextResupplyDate.setFullYear(nextResupplyDate.getFullYear() + 1);
                    } else {
                        // Add the number of months to the start date
                        nextResupplyDate.setMonth(nextResupplyDate.getMonth() + duration);
                    }

                    // Format the date as YYYY-MM-DD
                    var nextResupplyDateFormatted = nextResupplyDate.toISOString().split('T')[0];
                    $('input[name="TDate"]').val(nextResupplyDateFormatted);
                }
            });

            document.getElementById('fileUpload').addEventListener('change', function(event) {
                const file = event.target.files[0];
                const imgElement = document.getElementById('previewImage');
                const fileMessage = document.getElementById('fileMessage');

                if (file) {
                    const fileType = file.type;
                    const validImageTypes = ['image/jpeg', 'image/png', 'image/tiff', 'image/heic'];
                    if (validImageTypes.includes(fileType)) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            imgElement.src = e.target.result;
                            imgElement.style.display = 'block';
                            fileMessage.style.display = 'none';
                        };
                        reader.readAsDataURL(file);
                    } else {
                        var documentsBaseUrl = "{{ asset('documents') }}/";
                        var renderImg = documentsBaseUrl + 'pdf.png';
                        imgElement.src = renderImg;
                        imgElement.style.display = 'block'; // Hide the image element if not an image file
                        fileMessage.textContent = 'No preview available for PDFs.';
                        fileMessage.style.display = 'block'; // Show the message for non-image files
                    }
                }
            });


            $('select[name="newfrequency"], input[name="redate"]').on('change input', function() {
                // Get the selected frequency in days
                var frequency = parseInt($('select[name="newfrequency"]').val());

                // Get the current resupply date
                var resupplyDate = $('input[name="redate"]').val();

                // Check if both the frequency and the resupply date are selected/entered
                if (!isNaN(frequency) && resupplyDate) {
                    // Calculate the next resupply date
                    var nextResupplyDate = new Date(resupplyDate);
                    nextResupplyDate.setDate(nextResupplyDate.getDate() + frequency);

                    // Format the next resupply date in YYYY-MM-DD format
                    var nextResupplyDateFormatted = nextResupplyDate.toISOString().split('T')[0];

                    // Set the calculated next resupply date as the value of the next resupply date input field
                    $('input[name="newredate"]').val(nextResupplyDateFormatted);
                }
            });

            var form = document.getElementById("updatePatientForm");
            var submitButton = document.getElementById("submitButton");

            form.addEventListener("submit", function(event) {

                //   event.preventDefault(); // Prevent the form from submitting
                submitButton.disabled = true; // Disable the submit button
            });

            $('#updatePatientForm').submit(function(e) {
                // Check if the selected status requires validation of the resupply fields
                if ($('#status-dropdown').val() == '5') {
                    // Assume all fields are filled initially
                    let allFilled = true;

                    // Check if the resupply date is filled
                    if (!$('input[name="redate"]').val()) {
                        allFilled = false;
                        Swal.fire({
                            title: "Error",
                            text: "Please Select the resupply date before submitting",
                            icon: "error"
                        });
                    }


                    // Check if the frequency is selected
                    if (!$('select[name="newfrequency"]').val()) {
                        allFilled = false;
                        Swal.fire({
                            title: "Error",
                            text: "Please Select the resupply date frequency before submitting",
                            icon: "error"
                        });
                    }

                    // If not all required fields are filled, prevent form submission
                    if (!allFilled) {
                        e.preventDefault(); // Prevent form submission
                    }
                }
            });


            $('#documnet').change(function() {
                var selectedDeptText1 = $("#documnet option:selected").text().toLowerCase(); // Get the text and convert to lowercase
                const Message = document.getElementById('DataeType');
                Message.textContent = 'Prescription (RX)';
                if (selectedDeptText1.includes("claims")) { // Check if the text includes 'resupply'
                    $('#docType').show();
                } else {
                    $('#docType').hide();
                }

                if (selectedDeptText1.includes("proof of delivery")) { // Check if the text includes 'resupply'
                    $('#PFDAdd').show();
                } else {
                    $('#PFDAdd').hide();
                }


                if (selectedDeptText1.includes("prescription (rx)") || selectedDeptText1.includes("cmn") || selectedDeptText1.includes("authorization")) { // Check if the text includes 'resupply'
                    $('#RX').show();
                    if (selectedDeptText1.includes("authorization")) {
                        Message.textContent = 'Authorization';
                    }
                } else {
                    $('#RX').hide();

                }
                if (selectedDeptText1.includes("consignment documents")) { // Check if the text includes 'resupply'
                    $('#DOSAdd').show();
                    $('#RX').show();
                } else {
                    // $('#RX').hide();
                    $('#DOSAdd').hide();
                }

            });

            document.addEventListener('DOMContentLoaded', function() {
                const form = document.getElementById('DocumentForm');
                const documentTypeSelect = document.getElementById('documnet');
                const subDocDiv = document.getElementById('docType');
                const subDocSelect = document.getElementById('SubDoc');
                const rxDateFrom = document.getElementById('FDate');
                const rxDateTo = document.getElementById('TDate');
                const PFDate = document.getElementById('PFDAdd');
                const PFDateIn = document.getElementById('PFDate');
                const ConsDocAdd = document.getElementById('DOSAdd');
                const DOS = document.getElementById('DOS');

                // Function to check and apply required attributes based on selected document type
                function updateRequiredFields() {
                    const docType = documentTypeSelect.value;
                    // Reset initial states
                    rxDateFrom.required = false;
                    rxDateTo.required = false;
                    subDocSelect.required = false;
                    subDocDiv.style.display = 'none';
                    ConsDocAdd.style.display = 'none';
                    PFDateIn.required = false;
                    PFDate.style.display = 'none';

                    if (docType === 'Prescription (RX)' || docType === 'CMN' || docType === 'Authorization') {
                        rxDateFrom.required = true;
                        rxDateTo.required = true;
                    } else if (docType === 'Claims') {
                        subDocDiv.style.display = 'block';
                        subDocSelect.required = true;
                    } else if (docType === "Proof of Delivery") { // Check if the text includes 'resupply'
                        PFDate.style.display = 'block';
                        PFDateIn.required = true;
                    } else if (docType === "Consignment Documents") { // Check if the text includes 'resupply'
                        ConsDocAdd.style.display = 'block';
                        DOS.required = true;
                        rxDateFrom.required = true;
                        rxDateTo.required = true;
                    }
                }

                // Initial check on page load
                updateRequiredFields();

                // Event listener for change on document type select
                documentTypeSelect.addEventListener('change', updateRequiredFields);

            });

            $('#addPhoneNumber').click(function() {
                $('#phoneNumbers').append('<div class="input-group mb-2">' +
                    '<input type="text" name="phone[]" class="form-control" placeholder="Enter phone number">' +
                    '<div class="input-group-append">' +
                    '<button class="btn btn-danger removePhoneNumber" type="button"><i class="fa fa-minus"></i></button>' +
                    '</div>' +
                    '</div>');
            });
            // Remove phone number field
            $('#phoneNumbers').on('click', '.removePhoneNumber', function() {
                $(this).closest('.input-group').remove();
            });


        });
    </script>
