@section('title', 'Edit Patient')
@include('layout.Head')

<div class="dashboard-wrapper">
    <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content">
            <div class="row">

                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="page-header">
                        <h2 class="pageheader-title ml-auto">Edit Patient</h2>
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
                        <form method="post" action="{{ url('EditPatientDetail',$patients->id) }}" id="updatePatientForm">
                            @csrf
                            <div class="card">
                                <h5 class="card-header">Add Patient Details</h5>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label class="col-form-label">Patient First Name</label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fa fa-bed"></i></span>
                                                    </span>
                                                    <input type="text" required placeholder="Patient Name" name="name" class="form-control" value="{{$patients->name }}">
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

                                        <!-- Patient Last Name -->
                                        <div class="col">
                                            <div class="form-group">
                                                <label class="col-form-label">Patient Last Name</label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fa fa-user"></i></span>
                                                    </span>
                                                    <input type="text" required placeholder="Last Name" name="lastname" class="form-control" value="{{ $patients->last_Name }}">
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
                                                        <input type="radio" id="genderMale" name="gender" class="custom-control-input" value="Male" @if($patients->gender == "Male") checked @endif>
                                                        <label class="custom-control-label" for="genderMale">Male</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" id="genderFemale" name="gender" class="custom-control-input" @if($patients->gender == "Female") checked @endif value="Female">
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
                                                    <input type="text" required placeholder="Patient Address" id="patientAddress" name="address" class="form-control" value="{{ $patients->Location }}">
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
                                                    <input  placeholder="Patient Height (in Inches)" name="height" class="form-control" value="{{ $patients->height }}">
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
                                                <label class="col-form-label">Patient Weight(LB)</label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fa-solid fa-weight-scale"></i></span>
                                                    </span>
                                                    <input type="text" placeholder="Patient Weight (in LB)" name="weight" class="form-control" value="{{ $patients->weight }}">
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
                                                    <input type="mail" placeholder="Patient E-Mail" name="mail" class="form-control" value="{{ $patients->p_mail }}">
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
                                                    <input type="date" required placeholder="Patient Date Of Birth" name="DOB" class="form-control" value="{{ \Carbon\Carbon::parse($patients->Dob)->format('Y-m-d') }}">
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
                                                    <input type="text" required placeholder="Patient Insurance" name="insurance" class="form-control" value="{{ $patients->Insurance }}">
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
                                                    <input type="text" required placeholder="Item" value="{{ $patients->Item }}" class="form-control" name="item">
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
                                                    <input type="text" required placeholder="Account No#" name="AccNumber" class="form-control" value="{{ $patients->AccNumber }}">
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
                                                    <input type="text" required placeholder="Order No#" name="orderNumber" class="form-control" value="{{ $patients->Order_No }}">
                                                </div>
                                                <span><small class="text-danger font-weight-light font-italic">
                                                        @error('orderNumber')
                                                        {{ $message }}
                                                        @enderror
                                                    </small></span>
                                            </div>
                                        </div>
                                    </div>
                                    @php
$phoneNumbers = json_decode($patients->p_phone, true);
@endphp


<div class="form-group" id="phoneNumbers">
    <label for="phone">Phone Number(s)</label>
    <!-- Container for the phone number inputs -->
    <div id="phoneNumberContainer">
        @if (is_array($phoneNumbers) && count($phoneNumbers) > 0)
            @foreach ($phoneNumbers as $index => $phoneNumber)
                <div class="input-group mb-2 phone-number-group">
                    <input type="number" name="phone[]" class="form-control" placeholder="Enter phone number" value="{{ $phoneNumber }}">
                    <div class="input-group-append">
                        @if ($index > 0)
                            <button class="btn btn-danger removePhoneNumber" type="button"><i class="fa fa-minus"></i></button>
                        @endif
                    </div>
                </div>
            @endforeach
        @else
            <div class="input-group mb-2 phone-number-group">
                <input type="number" name="phone[]" class="form-control" placeholder="Enter phone number">
            </div>
        @endif
    </div>
    <!-- Button outside the container to stay at the bottom -->
    <div class="input-group-append">
        <button class="btn btn-primary" type="button" id="addPhoneNumber"><i class="fa fa-plus"></i> Add Phone Number</button>
    </div>
</div>



                                    <div class="form-group">
                                        <label class="col-form-label">Dr. Office Name</label>
                                        <div class="input-group mb-3"><span class="input-group-prepend"><span class="input-group-text"><i class="fa fa-stethoscope"></i></span></span>
                                            <select class="form-control select2" required name="office_name">
                                                <option selected disabled>Dr. Office Name</option>
                                                @foreach ($dr as $drs)
                                                <option value="{{ $drs->id }}" @if ($patients->Off_Name == $drs->id) selected @endif>
                                                    {{ $drs->Office_Name }}
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
                                            <select class="form-control" required name="order_status" id="status-dropdown">
                                                <option selected disabled>Order Status</option>
                                                @foreach ($st as $drs)
                                                <option value="{{ $drs->id }}" @if ($patients->Order_Status == $drs?->id) selected @endif>
                                                    {{ $drs?->Status }}
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

                                    @php
                                    $statusName = \App\Models\Status::find($patients->Order_Status);
                                    $dptName = \App\Models\Departments::find($patients->Dept);
                                    @endphp
                                    <div class="form-group" @if (!str_contains(strtolower($statusName?->Status), 'resupply')) style="display: none;" @endif id="resupplyDate-container">
                                        <label for="inputEmail3" class="col-sm-4 col-form-label">Initial Resupply Date</label>
                                        <div class="input-group mb-3"><span class="input-group-prepend"><span class="input-group-text"><i class="fa fa-calendar"></i></span></span>
                                        <input type="date" name="redate" value="{{ $patients->resupplyDate ? \Carbon\Carbon::parse($patients->resupplyDate)->format('Y-m-d') : '' }}" class="form-control">
                                        </div>
                                        <span><small class="text-danger font-weight-light font-italic">
                                                @error('redate')
                                                {{ $message }}
                                                @enderror
                                            </small></span>
                                    </div>
                                                <div class="row mb-3" id="newresupplyDate-container" @if($statusName && !str_contains(strtolower($statusName?->Status), 'resupply')) style="display: none;" @endif>
                                                    <label for="inputEmail3" class="col-sm-4 col-form-label">Next Resupply Date</label>
                                                    <div class="col-sm-8">
                                                        <div class="form-group">
                                                            <div class="input-group mb-3"><span class="input-group-prepend"><span class="input-group-text"><i class="fa fa-calendar"></i></span></span>
                                                                <input type="date" name="newredate" class="form-control" @if($statusName && str_contains(strtolower($statusName?->Status), 'resupply')) value="{{ $patients->new_date ? \Carbon\Carbon::parse($patients->new_date)->format('Y-m-d') : '' }}" @endif >

                                                            </div>
                                                            <span><small class="text-danger font-weight-light font-italic">
                                                                    @error('redate')
                                                                    {{ $message }}
                                                                    @enderror
                                                                </small></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mb-3" id="newfrequency-container" @if($statusName && !str_contains(strtolower($statusName?->Status), 'resupply')) style="display: none;" @endif>
                                                    <label for="inputPassword3" class="col-sm-4 col-form-label">Frequency</label>
                                                    <div class="col-sm-8">
                                                        <div class="form-group">
                                                            <select class="form-control form-control-sm"  name="newfrequency">
                                                                <option selected disabled> Select Frequency</option>
                                                            <option @if ( $patients->new_frequency == "30")
                                                                    selected
                                                                    @endif value="30">30 Days</option>
                                                                    
                                                            <option @if ( $patients->new_frequency == "60")
                                                                    selected
                                                                    @endif value="60">60 Days</option>
                                                            
                                                            <option @if ( $patients->new_frequency == "90")
                                                                    selected
                                                                    @endif value="90">90 Days</option>
                                                            
                                                            <option @if ( $patients->new_frequency == "180")
                                                                    selected
                                                                    @endif value="180">180 Days</option>
                                                            <option @if ( $patients->new_frequency == "365")
                                                                    selected
                                                                    @endif value="365">365 Days</option>
                                                            </select>
                                                            
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row mb-3" id="newDept1-container" @if($statusName && !str_contains(strtolower($statusName?->Status), 'resupply')) style="display: none;" @endif>
                                                    <label for="inputPassword3" class="col-sm-4 col-form-label">Resupply Process Dept</label>
                                                    <div class="col-sm-8">
                                                        <div class="form-group">
                                                            <select class="form-control form-control-sm"  name="newdpt">
                                                                @foreach ($dp as $sts)
                                                                <option @if ( $sts->id == $patients->newdept)
                                                                    selected
                                                                    @endif value="{{ $sts->id }}">{{ $sts->Department }}</option>
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
                                                <option value="{{ $dpItem->id }}" @if ($patients->Dept == $dpItem->id) selected @endif>
                                                    {{ $dpItem->Department }}
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


                                    <div class="form-group" id="subdept-container" @if (!str_contains(strtolower($dptName->Department), 'resupply')) style="display: none;" @endif>
                                        <label class="col-form-label">Assign Sub Department</label>
                                        <div class="input-group mb-3"><span class="input-group-prepend"><span class="input-group-text"><i class="fa-solid fa-square-poll-vertical"></i></span></span>
                                            <select class="form-control form-control-sm" name="subdpt">
                                                @foreach ($subDept as $sub)
                                                <option value="{{$sub->SubDept}}" @if ($patients->resupplyCat == $sub->SubDept) selected @endif>{{$sub->SubDept}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <span><small class="text-danger font-weight-light font-italic">
                                                @error('subdpt')
                                                {{ $message }}
                                                @enderror
                                            </small></span>
                                    </div>

                                    <div class="form-group" id="user-container">
                                        <label class="col-form-label">Assign User</label>
                                        <div class="input-group mb-3"><span class="input-group-prepend"><span class="input-group-text"><i class="fa-solid fa-user"></i></span></span>
                                            <select class="form-control" required name="user" id="user-dropdown">
                                                <option selected disabled>Assign User</option>
                                                @foreach ($us as $dpItem)
                                                @if($dpItem->Dept)
                                                @php
                                                $deptIds = json_decode($dpItem->Dept, true);
                                                @endphp
                                                @if(is_array($deptIds) && !empty($deptIds))
                                                @foreach (json_decode($dpItem->Dept, true) as $deptId)
                                                @if ($patients->Dept == $deptId)
                                                <option value="{{ $dpItem->id }}" @if ($patients->User == $dpItem->id) selected @endif>{{ $dpItem->name }}
                                                </option>
                                                @endif
                                                @endforeach
                                                @endif
                                                @endif



                                                @endforeach
                                            </select>
                                        </div>
                                        <span><small class="text-danger font-weight-light font-italic">
                                                @error('user')
                                                {{ $message }}
                                                @enderror
                                            </small></span>
                                    </div>

                                </div>
                                <div class="card-body border-top">
                                    <div class="form-group">
                                        <div class="input-group mb-3">
                                            <div class="input-group">
                                                <button type="submit" class="btn btn-block" style="background-color: #427ed1; color: white;">Submit</button>
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
            $('.select2').select2({
                placeholder: "Select Dr. Office Name", // Optional placeholder text
                allowClear: true // Allows user to clear selected value
            });
        });
    </script>
<script>
        $(document).ready(function() {
            logAction("Edit Patient Page Loaded");
        });
        
        
        
$(document).ready(function() {
    
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
    
    
    
    const phoneNumbersDiv = $('#phoneNumbers');
    const addPhoneNumberBtn = $('#addPhoneNumber');

    addPhoneNumberBtn.click(function() {
        // Append a new input group to the phoneNumbersDiv
        phoneNumbersDiv.append('<div class="input-group mb-2">' +
            '<input type="text" name="phone[]" class="form-control" placeholder="Enter phone number">' +
            '<div class="input-group-append">' +
            '<button class="btn btn-danger removePhoneNumber" type="button"><i class="fa fa-minus"></i></button>' +
            '</div>' +
            '</div>');
    });

    // Use event delegation to attach event listener for dynamically added elements
    phoneNumbersDiv.on('click', '.removePhoneNumber', function() {
        $(this).closest('.input-group').remove();
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

    
});


        
    </script>
