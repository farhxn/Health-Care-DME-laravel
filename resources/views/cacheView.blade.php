<!--@section('title', 'User & Department Progress')-->
<!--@include('layout.Head')-->

<!--<div class="dashboard-wrapper">-->
<!--    <div class="dashboard-ecommerce">-->
<!--        <div class="container-fluid dashboard-content">-->
<!--            <div class="row">-->
<!--                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">-->
<!--                    <div class="page-header">-->
<!--                        <h2 class="pageheader-title ml-auto">User & Deparment Progress </h2>-->
<!--                        <div class="page-breadcrumb">-->
<!--                            <nav aria-label="breadcrumb">-->
<!--                                <ol class="breadcrumb">-->
                                    <!-- <li class="breadcrumb-item">
<!--                        <a href="#" class="breadcrumb-link">Dashboard</a>-->
<!--                      </li>-->
<!--                      <li class="breadcrumb-item active" aria-current="page">-->
<!--                        Home-->
<!--                      </li> -->-->
<!--                                </ol>-->
<!--                            </nav>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->

<!--            <div class="ecommerce-widget">-->

<!--@php-->
<!--    $cardColors = ['#f28b82', '#fbbc04', '#fff475', '#ccff90', '#a7ffeb', '#cbf0f8', '#aecbfa', '#d7aefb', '#fdcfe8', '#e6c9a8', '#e8eaed'];-->
<!--    $listItemColors = ['#f9c2c0', '#fcd586', '#fff899', '#e0fcb8', '#c3fff2', '#e3f7fa', '#c2d6f8', '#e7d7fa', '#fedaf1', '#f3e2c3', '#f1f3f4'];-->
<!--    $colorIndex = 0;-->
<!--@endphp-->

<!--<style>-->
<!--    .custom-list-group-item {-->
padding-top: 0.25rem; /* Reduce top padding */
    padding-bottom: 0.25rem; /* Reduce bottom padding */
    font-size: 12px; /* Keep your font size adjustment if needed */
<!--}-->

<!--</style>-->

<!--<div class="row">-->
<!--@foreach ($dp as $dps)-->
<!--    @php-->
<!--        $filteredByDept = $deppat->where('Dept', $dps->id);-->
<!--        $currentColor = $cardColors[$colorIndex % count($cardColors)];-->
<!--        $currentListItemColor = $listItemColors[$colorIndex % count($listItemColors)];-->
<!--        $colorIndex++; // Increment colorIndex for the next iteration-->
<!--    @endphp-->
<!--    <div class="col-sm-6 col-md-4 col-lg-3"> -->
<!--        <div class="card">-->
<!--            <div class="card-header text-center">-->
<!--                <a style="color: $currentColor;">-->
<!--                    {{ $dps->Department }} ({{$filteredByDept->count()}})-->
<!--                </a>-->
<!--            </div>-->
<!--            <ul class="list-group list-group-flush">-->
<!--                @foreach ($st as $status)-->
<!--                    @php-->
<!--                        $statusCount = $filteredByDept->where('Order_Status', $status->id)->count();-->
<!--                    @endphp-->

<!--                    <li class="list-group-item custom-list-group-item" style="background-color: {{ $currentListItemColor }};">-->
<!--                        <a  style="color: black;">-->
<!--                            {{ $status->Status }} ({{$statusCount}})-->
<!--                        </a>-->
<!--                    </li>-->
<!--                @endforeach-->
<!--            </ul>-->
<!--        </div>-->
<!--    </div>-->
<!--@endforeach-->

<!--</div>-->

<!--                <br><br>-->
<!--                                <div class="row">-->
<!--                                    <div class="col">-->
<!--                                        <a href="{{url('filterdeptprogress/01')}}" class="btn btn-block btn-sm p-2" style="background-color: #427ed1; color: white;">Today</a>-->
<!--                                    </div>-->

<!--                                    <div class="col">-->
<!--                                        <a href="{{url('filterdeptprogress/02')}}" class="btn btn-block btn-sm p-2" style="background-color: #427ed1; color: white;">Yesterday</a>-->
<!--                                    </div>-->

<!--                                    <div class="col">-->
<!--                                        <a href="{{url('filterdeptprogress/03')}}"  class="btn btn-block btn-sm p-2" style="background-color: #427ed1; color: white;">This Week</a>-->
<!--                                    </div>-->

<!--                                    <div class="col">-->
<!--                                        <a href="{{url('filterdeptprogress/04')}}" class="btn btn-block btn-sm p-2" style="background-color: #427ed1; color: white;">Last Week</a>-->
<!--                                    </div>-->

<!--                                    <div class="col">-->
<!--                                        <a  href="{{url('filterdeptprogress/05')}}" class="btn btn-block btn-sm p-2" style="background-color: #427ed1; color: white;">This Month</a>-->
<!--                                    </div>-->

<!--                                    <div class="col">-->
<!--                                        <a href="{{url('filterdeptprogress/06')}}" class="btn btn-block btn-sm p-2" style="background-color: #427ed1; color: white;">Last Month</a>-->
<!--                                    </div>-->

<!--                                </div>-->
<!--<br/>-->

<!--                <div class="row">-->
<!--                    <div class="col">-->
<!--                        <div class="card">-->
<!--                            <h5></h5>-->
<!--                            <div class="container card-header">-->
<!--                                <form class="form-inline mr-auto" action="{{ url('/FilterProgressPatient') }}" method="get">-->
<!--                                    <div class="row">-->
<!--                                        <div class="form-group mb-2">-->
<!--                                            <label>&nbsp;<strong>FILTERS </strong>&nbsp;</label>-->
<!--                                            <div class="form-group">-->
<!--                                                <select class="form-control" name="date">-->
<!--                                                    <option selected disabled>Dates</option>-->
<!--                                                    <option value="4">Today</option>-->
<!--                                                    <option value="1">Yesterday</option>-->
<!--                                                    <option value="2">Week</option>-->
<!--                                                    <option value="3">Month</option>-->
<!--                                                </select>-->
<!--                                            </div>-->
<!--                                        </div>-->
<!--                                        <br>-->
<!--                                        <span><small class="text-danger font-weight-light font-italic">-->
<!--                                                @error('date')-->
<!--                                                {{ $message }}-->
<!--                                                @enderror-->
<!--                                            </small></span>-->

<!--                                        &nbsp;&nbsp;&nbsp;-->
<!--                                        <div class="form-group mb-2">-->
<!--                                            <label>&nbsp;<strong> Categories</strong> &nbsp;</label>-->
<!--                                            <div class="form-group">-->
<!--                                                <select class="form-control " name="status">-->
<!--                                                    <option selected disabled>Status</option>-->
<!--                                                    @foreach ($st as $sts)-->
<!--                                                    <option value="{{ $sts->id }}">{{ $sts->Status }}-->
<!--                                                    </option>-->
<!--                                                    @endforeach-->
<!--                                                </select>-->
<!--                                            </div>-->
<!--                                            <span><small class="text-danger font-weight-light font-italic">-->
<!--                                                    @error('status')-->
<!--                                                    {{ $message }}-->
<!--                                                    @enderror-->
<!--                                                </small></span>-->
<!--                                        </div>&nbsp;&nbsp;&nbsp;-->

<!--                                        <div class="form-group mb-2">-->
<!--                                            <label>&nbsp;<strong> Department</strong> &nbsp;</label>-->
<!--                                            <div class="form-group">-->
<!--                                                <select class="form-control " name="dept">-->
<!--                                                    <option selected disabled>Status</option>-->
<!--                                                    @foreach ($dp as $sts)-->
<!--                                                    <option value="{{ $sts->id }}">{{ $sts->Department }}-->
<!--                                                    </option>-->
<!--                                                    @endforeach-->
<!--                                                </select>-->
<!--                                            </div>-->
<!--                                            <span><small class="text-danger font-weight-light font-italic">-->
<!--                                                    @error('dept')-->
<!--                                                    {{ $message }}-->
<!--                                                    @enderror-->
<!--                                                </small></span>-->
<!--                                        </div>&nbsp;&nbsp;&nbsp;-->

<!--                                        <div class="col p-2">-->
<!--                                            <button type="submit" class="btn btn-block btn-sm p-2" style="background-color: #427ed1; color: white;">Apply Filter</button>-->
<!--                                        </div>-->
<!--                                </form>-->
<!--                                                                &nbsp;-->
<!--                                                            <div class="col p-2">-->
<!--                                    <a href="{{ url('Reminders') }}" class="btn btn-block btn-sm p-2" style="background-color: #427ed1; color: white;">Reminders</a>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <br>-->
<!--                        </div>-->
<!--                        <br>-->
<!--                                            <div class="card-body p-0">-->
<!--                            <div class="table-responsive">-->
<!--<table class="table display" id="myTable">-->
<!--    <thead class="bg-light">-->
<!--        <tr class="border-0">-->
<!--            <th class="border-0">No.</th>-->
<!--            <th class="border-0">Assigned&nbsp;Users</th>-->
<!--            <th class="border-0">Department&nbsp;Name</th>-->
<!--            @foreach ($st as $status)-->
<!--                <th class="border-0">{{ $status->Status }}</th>-->
<!--            @endforeach-->
<!--                        <th class="border-0">Total&nbsp;Assigned</th>-->
<!--        </tr>-->
<!--    </thead>-->
<!--<tbody>-->
<!--    @php $sno = 1; @endphp-->
<!--    @foreach ($users as $user)-->
<!--@php-->
<!--$userTotal = 0;-->
<!--    $departmentNames = collect(json_decode($user->Dept))-->
<!--        ->map(function($id) use ($dp) {-->
<!--            return $dp->firstWhere('id', $id)->Department ?? 'Manager';-->
<!--        })-->
<!--        ->each(function($name, $index) {-->
<!--            return ($index + 1) . '. ' . $name; // Prepend the index number to each department name-->
<!--        })-->
<!--        ->implode(', ');-->
<!--@endphp-->

<!--                                        <tr onclick="window.location='/userDetail/{{ $user->id }}';" style="cursor: pointer;" data-toggle="tooltip" data-placement="top" title="" data-original-title="Show {{ $user->name }}'s Details">-->
<!--            <td>{{ $sno++ }}</td>-->
<!--            <td>{{ $user->name }}</td>-->
<!--            <td>{{ $departmentNames }}</td>-->
<!--            @foreach ($st as $status)-->
<!--                @php-->
<!--                    $total = 0;-->
<!--                    foreach ($pat as $pt) {-->
<!--                        if($pt->User == $user->id && $pt->Order_Status == $status->id) {-->
<!--                            $total++;-->
<!--                            $userTotal++;-->
<!--                        }-->
<!--                    }-->
<!--                @endphp-->
<!--                <td>{{ $total }}</td>-->
<!--            @endforeach-->
<!--            <td>{{$userTotal}}</td>-->
<!--        </tr>-->
<!--    @endforeach-->
<!--</tbody>-->

<!--</table>-->

<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->

<!--        </div>-->
<!--    </div>-->
<!--</div>-->



<!--@include('layout.footer')-->



<!--<div class="modal fade" id="dateRangeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">-->
<!--    <div class="modal-dialog" role="document">-->
<!--        <div class="modal-content">-->
<!--            <div class="modal-header">-->
<!--                <h5 class="modal-title" id="exampleModalLabel">Select Date Range</h5>-->
<!--                <button type="button" class="close" data-dismiss="modal" aria-label="Close">-->
<!--                    <span aria-hidden="true">&times;</span>-->
<!--                </button>-->
<!--            </div>-->
<!--            <div class="modal-body">-->
<!--                <form id="dateRangeForm" action="{{ url('MainReport') }}" method="GET" target="_blank">-->
<!--                    <div class="form-group">-->
<!--                        <label for="startDate">Start Date:</label>-->
<!--                        <input type="date" class="form-control" id="startDate" name="startDate" required>-->
<!--                    </div>-->
<!--                    <div class="form-group">-->
<!--                        <label for="endDate">End Date:</label>-->
<!--                        <input type="date" class="form-control" id="endDate" name="endDate" required>-->
<!--                    </div>-->
<!--                    <button type="submit" class="btn btn-primary">Generate Report</button>-->
<!--                </form>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->




<!--<script>-->
<!--    $(document).ready(function() {-->
<!--        logAction("User & Department Progress Page Loaded");-->
<!--                sendUpdateReminder();-->
<!--                sendReminders();-->
<!--    });-->
<!--</script>-->




<div class="modal fade" id="AddOrder" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-xl" role="document"> <!-- Added modal-xl class -->
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="row w-100"> <!-- Ensure the row spans full width -->
                            <div class="col">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h2 class="pageheader-title">New Order</h2>
                                    <div class="ml-auto"> <!-- Move this div to the right -->
                                        <a href="#" class="btn btn-primary disabled btn-sm m-1">Created By: Kamran</a>
                                        <a href="#" class="btn btn-primary disabled btn-sm m-1">Order # 111005</a>
                                        <a href="#" class="btn btn-primary disabled btn-sm m-1">Order Date: {{ \Carbon\Carbon::now()->format('m/d/Y') }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true ">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="{{ url('AddNote', $tp->id) }}">
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label class="col-form-label form-control-sm">Patient Name</label>
                                        <div class="input-group mb-3">
                                            <input type="text" required placeholder="Patient Name" name="Patient_Name" class="form-control" value="{{ old('Patient_Name',$tp->name .' '.$tp->last_Name) }}">
                                        </div>
                                        <span><small class="text-danger font-weight-light font-italic">
                                                @error('Patient_Name')
                                                {{ $message }}
                                                @enderror
                                            </small></span>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-group">
                                        <label class="col-form-label form-control-sm">Address</label>
                                        <div class="input-group mb-3">
                                            <input type="text" required placeholder="Address" name="Address" class="form-control"
                                                value="{{ old('Address',$tp->Location) }}">

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
                                        <label class="col-form-label">City</label>
                                        <div class="input-group mb-3">
                                            <input type="text" required placeholder="City" name="City" class="form-control form-control-sm"
                                                value="{{ old('City',$tp->Location) }}">

                                        </div>
                                        <span><small class="text-danger font-weight-light font-italic">
                                                @error('City')
                                                {{ $message }}
                                                @enderror
                                            </small></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label class="col-form-label">Patient DOB</label>
                                        <div class="input-group mb-3">
                                            <input type="text" required placeholder="Patient DOB" name="Patient_DOB" class="form-control form-control-sm" value="{{ old('Patient_DOB',$tp->Dob ) }}">
                                        </div>
                                        <span><small class="text-danger font-weight-light font-italic">
                                                @error('Patient_DOB')
                                                {{ $message }}
                                                @enderror
                                            </small></span>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label class="col-form-label">State</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" required placeholder="State" name="State" class="form-control form-control-sm"
                                                        value="{{ old('State') }}">

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
                                                <label class="col-form-label">ZIP</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" required placeholder="ZIP" name="ZIP" class="form-control form-control-sm"
                                                        value="{{ old('ZIP') }}">

                                                </div>
                                                <span><small class="text-danger font-weight-light font-italic">
                                                        @error('ZIP')
                                                        {{ $message }}
                                                        @enderror
                                                    </small></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @php
                                $phoneData = $tp->p_phone !== 'N/A' ? $tp->p_phone : null;
                                $phoneNumbers = $phoneData ? json_decode($phoneData, true) : null;

                                // Remove all null values from the array
                                $filteredPhoneNumbers = $phoneNumbers ? array_filter($phoneNumbers, function($value) {
                                return $value !== null;
                                }) : null;


                                if (empty($filteredPhoneNumbers)) {
                                $phoneNumbers = null;
                                }

                                $phone1 = "N/A";
                                $phone2 = "N/A";

                                if ($phoneNumbers) {
                                $formattedNumbers = array_map(function ($phoneNumber) {
                                $formatted = preg_replace('/[^0-9]/', '', $phoneNumber);
                                return strlen($formatted) == 10 ? '(' . substr($formatted, 0, 3) . ') ' . substr($formatted, 3, 3) . '-' . substr($formatted, 6) : null;
                                }, array_filter($phoneNumbers));

                                $phone1 = $formattedNumbers[0] ?? $phone1;
                                $phone2 = $formattedNumbers[1] ?? $phone2;
                                }
                                @endphp


                                <div class="col">
                                    <div class="form-group">
                                        <label class="col-form-label">Phone&nbsp;1</label>
                                        <div class="input-group mb-3">
                                            <input type="text" required placeholder="Phone" name="Phone" class="form-control form-control-sm"
                                                value="{{ old('Phone',$phone1) }}">

                                        </div>
                                        <span><small class="text-danger font-weight-light font-italic">
                                                @error('Phone')
                                                {{ $message }}
                                                @enderror
                                            </small></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label class="col-form-label">Phone 2</label>
                                        <div class="input-group mb-3">
                                            <input type="text" required placeholder="Phone 2" name="Phone2" class="form-control form-control-sm" value="{{ old('Phone2',$phone2 ) }}">
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
                                        <label class="col-form-label">Email</label>
                                        <div class="input-group mb-3">
                                            <input type="text" required placeholder="Email" name="Email" class="form-control form-control-sm"
                                                value="{{ old('Email',$tp->p_mail) }}">

                                        </div>
                                        <span><small class="text-danger font-weight-light font-italic">
                                                @error('Email')
                                                {{ $message }}
                                                @enderror
                                            </small></span>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-group">
                                        <label class="col-form-label">Account&nbsp;#</label>
                                        <div class="input-group mb-3">
                                            <input type="text" required placeholder="Account #" name="Account" class="form-control form-control-sm"
                                                value="{{ old('Account',$tp->AccNumber) }}">

                                        </div>
                                        <span><small class="text-danger font-weight-light font-italic">
                                                @error('Account')
                                                {{ $message }}
                                                @enderror
                                            </small></span>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label class="col-form-label">Order Status                                        </label>
                                        <div class="input-group mb-3">
                                            <select class="form-control form-control-sm" id="status-dropdown" required name="OrderStatus">
                                                <option selected disabled>Order Status</option>
                                                @foreach ($st as $drs)
                                                <option value="{{ $drs->id }}">{{ $drs->Status }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <span>
                                            <small class="text-danger font-weight-light font-italic">
                                                @error('OrderStatus')
                                                {{ $message }}
                                                @enderror
                                            </small>
                                        </span>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label class="col-form-label">Department</label>
                                        <div class="input-group mb-3">
                                            <select class="form-control form-control-sm" id="status-dropdown" required name="Department">
                                                <option selected disabled>Department </option>
                                                @foreach ($st as $drs)
                                                <option value="{{ $drs->id }}">{{ $drs->Status }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <span>
                                            <small class="text-danger font-weight-light font-italic">
                                                @error('Department')
                                                {{ $message }}
                                                @enderror
                                            </small>
                                        </span>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label class="col-form-label">Assign User</label>
                                        <div class="input-group mb-3">
                                            <select class="form-control form-control-sm" id="status-dropdown" required name="AssignUser">
                                                <option selected disabled>Assign User</option>
                                                @foreach ($st as $drs)
                                                <option value="{{ $drs->id }}">{{ $drs->Status }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <span>
                                            <small class="text-danger font-weight-light font-italic">
                                                @error('AssignUser')
                                                {{ $message }}
                                                @enderror
                                            </small>
                                        </span>
                                    </div>
                                </div>
                            </div>


                            <hr>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label class="col-form-label">Dr Office</label>
                                        <div class="input-group mb-3">
                                            <input type="text" required placeholder="Dr Office" name="DrOffice" class="form-control form-control-sm" value="{{ old('DrOffice', $offName->Office_Name) }}">
                                        </div>
                                        <span><small class="text-danger font-weight-light font-italic">
                                                @error('DrOffice')
                                                {{ $message }}
                                                @enderror
                                            </small></span>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-group">
                                        <label class="col-form-label">Dr Office Phone</label>
                                        <div class="input-group mb-3">
                                            <input type="text" required placeholder="Dr Office Phone" name="DrPhone" class="form-control form-control-sm"
                                                value="{{ old('DrPhone', '(' . substr($offName->Phone_Num, 0, 3) . ') ' . substr($offName->Phone_Num, 3, 3) . '-' . substr($offName->Phone_Num, 6)) }}">

                                        </div>
                                        <span><small class="text-danger font-weight-light font-italic">
                                                @error('DrPhone')
                                                {{ $message }}
                                                @enderror
                                            </small></span>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label class="col-form-label">Dr Office Fax</label>
                                        <div class="input-group mb-3">
                                            <input type="text" required placeholder="Dr Office Fax" name="DrFax" class="form-control form-control-sm"
                                                value="{{ old('DrFax', '(' . substr($offName->Fax, 0, 3) . ') ' . substr($offName->Fax, 3, 3) . '-' . substr($offName->Fax, 6)) }}">

                                        </div>
                                        <span><small class="text-danger font-weight-light font-italic">
                                                @error('DrFax')
                                                {{ $message }}
                                                @enderror
                                            </small></span>
                                    </div>
                                </div>
                            </div>
                            <hr>

                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label class="col-form-label">Inventory Item </label>
                                        <div class="input-group mb-3">
                                            <select class="form-control form-control-sm" id="status-dropdown" required name="InventoryItem">
                                                <option selected disabled>Inventory Item</option>
                                                @foreach ($st as $drs)
                                                <option value="{{ $drs->id }}">{{ $drs->Status }}</option>
                                                @endforeach
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
                                <div class="col">
                                    <div class="form-group">
                                        <label class="col-form-label">Sell Type </label>
                                        <div class="input-group mb-3">
                                            <select class="form-control form-control-sm" id="status-dropdown" required name="SellType">
                                                <option selected disabled>Sell Type</option>
                                                @foreach ($st as $drs)
                                                <option value="{{ $drs->id }}">{{ $drs->Status }}</option>
                                                @endforeach
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
                                <div class="col">
                                    <div class="form-group">
                                        <label class="col-form-label">DX Pointer 10</label>
                                        <div class="input-group mb-3">
                                            <input type="text" required placeholder="DX Pointer 10" name="DXPointer10" class="form-control form-control-sm" value="{{ old('DXPointer10') }}">
                                        </div>
                                        <span><small class="text-danger font-weight-light font-italic">
                                                @error('DXPointer10')
                                                {{ $message }}
                                                @enderror
                                            </small></span>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label class="col-form-label">Price Code </label>
                                        <div class="input-group mb-3">
                                            <select class="form-control form-control-sm" id="status-dropdown" required name="PriceCode">
                                                <option selected disabled>Price Code</option>
                                                @foreach ($st as $drs)
                                                <option value="{{ $drs->id }}">{{ $drs->Status }}</option>
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
                                <div class="col">
                                    <div class="form-group">
                                        <label class="col-form-label">Serial #</label>
                                        <div class="input-group mb-3">
                                            <select class="form-control form-control-sm" id="status-dropdown" required name="Serial">
                                                <option selected disabled>Serial #</option>
                                                @foreach ($st as $drs)
                                                <option value="{{ $drs->id }}">{{ $drs->Status }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <span>
                                            <small class="text-danger font-weight-light font-italic">
                                                @error('Serial')
                                                {{ $message }}
                                                @enderror
                                            </small>
                                        </span>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label class="col-form-label">Prior Auth Type</label>
                                        <div class="input-group mb-3">
                                            <select class="form-control form-control-sm" id="status-dropdown" required name="PriorAuthType">
                                                <option selected disabled>Prior Auth Type</option>
                                                @foreach ($st as $drs)
                                                <option value="{{ $drs->id }}">{{ $drs->Status }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <span>
                                            <small class="text-danger font-weight-light font-italic">
                                                @error('PriorAuthType')
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
                                        <label class="col-form-label">Billing Code</label>
                                        <div class="input-group mb-3">
                                            <input type="text" required placeholder="Billing Code" name="Billing Code" class="form-control form-control-sm" value="{{ old('BillingCode') }}">
                                        </div>
                                        <span><small class="text-danger font-weight-light font-italic">
                                                @error('BillingCode')
                                                {{ $message }}
                                                @enderror
                                            </small></span>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label class="col-form-label">Warehouse </label>
                                        <div class="input-group mb-3">
                                            <select class="form-control form-control-sm" id="status-dropdown" required name="Warehouse">
                                                <option selected disabled>Warehouse</option>
                                                @foreach ($st as $drs)
                                                <option value="{{ $drs->id }}">{{ $drs->Status }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <span>
                                            <small class="text-danger font-weight-light font-italic">
                                                @error('Warehouse')
                                                {{ $message }}
                                                @enderror
                                            </small>
                                        </span>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label class="col-form-label">Prior Auth #</label>
                                        <div class="input-group mb-3">
                                            <input type="text" required placeholder="Prior Auth #" name="PriorAuth" class="form-control form-control-sm" value="{{ old('PriorAuth') }}">
                                        </div>
                                        <span><small class="text-danger font-weight-light font-italic">
                                                @error('PriorAuth')
                                                {{ $message }}
                                                @enderror
                                            </small></span>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label class="col-form-label">Modifiers</label>
                                        <div class="input-group mb-3">
                                            <input type="text" name="modifier1" maxlength="2" class="form-control form-control-sm" style="width: 50px;" required>
                                            <input type="text" name="modifier2" maxlength="2" class="form-control form-control-sm" style="width: 50px;" required>
                                            <input type="text" name="modifier3" maxlength="2" class="form-control form-control-sm" style="width: 50px;" required>
                                            <input type="text" name="modifier4" maxlength="2" class="form-control form-control-sm" style="width: 50px;" required>
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
                                        <label class="col-form-label">Billable</label>
                                        <div class="input-group mb-3">
                                            <input type="text" required placeholder="Billable" name="Billable" class="form-control form-control-sm" value="{{ old('Billable') }}">
                                        </div>
                                        <span><small class="text-danger font-weight-light font-italic">
                                                @error('Billable')
                                                {{ $message }}
                                                @enderror
                                            </small></span>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label class="col-form-label">Prior Auth Exp.</label>
                                        <div class="input-group mb-3">
                                            <input type="text" required placeholder="Prior Auth Exp" name="PriorAuthExp" class="form-control form-control-sm" value="{{ old('PriorAuthExp') }}">
                                        </div>
                                        <span><small class="text-danger font-weight-light font-italic">
                                                @error('PriorAuthExp')
                                                {{ $message }}
                                                @enderror
                                            </small></span>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label class="col-form-label">HAO</label>
                                        <div class="input-group mb-3">
                                            <textarea rows="2" required placeholder="HAO" name="HAO" class="form-control form-control-sm" value="{{ old('HAO') }}"></textarea>
                                        </div>
                                        <span><small class="text-danger font-weight-light font-italic">
                                                @error('HAO')
                                                {{ $message }}
                                                @enderror
                                            </small></span>
                                    </div>

                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label class="col-form-label">Allowable</label>
                                        <div class="input-group mb-3">
                                            <input type="text" required placeholder="Allowable" name="Allowable" class="form-control form-control-sm" value="{{ old('Allowable') }}">
                                        </div>
                                        <span><small class="text-danger font-weight-light font-italic">
                                                @error('Allowable')
                                                {{ $message }}
                                                @enderror
                                            </small></span>
                                    </div>
                                    <label class="custom-control custom-checkbox">
                                        <span class="custom-control-label">Taxable </span>
                                        <input type="checkbox" checked class="custom-control-input" name="Taxable">
                                    </label>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label class="col-form-label">RX Exp.</label>
                                        <div class="input-group mb-3">
                                            <input type="text" required placeholder="RX Exp" name="RXExp" class="form-control form-control-sm" value="{{ old('RXExp') }}">
                                        </div>
                                        <span><small class="text-danger font-weight-light font-italic">
                                                @error('RXExp')
                                                {{ $message }}
                                                @enderror
                                            </small></span>
                                    </div>
                                </div>
                            </div>

                            <div class="row m-3">
                                <label>Billing</label>
                                <div class="col">
                                    <label class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" checked name="Ins1">
                                        <span class="custom-control-label">Ins 1</span>
                                    </label>
                                </div>

                                <div class="col">
                                    <label class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" checked name="Ins2">
                                        <span class="custom-control-label">Ins 2</span>
                                    </label>
                                </div>

                                <div class="col">
                                    <label class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" checked name="Ins3">
                                        <span class="custom-control-label">Bill&nbsp;To&nbsp;Ins 3</span>
                                    </label>
                                </div>

                                <div class="col">
                                    <label class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" checked name="Ins4">
                                        <span class="custom-control-label">Ins 4</span>
                                    </label>
                                </div>

                                <div class="col">
                                    <label class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" name="NoPayIns1">
                                        <span class="custom-control-label">No Pay Ins 1</span>
                                    </label>
                                </div>
                            </div>

                            <hr>
                            <div class="row">
                                <div class="col">
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label class="col-form-label">Quantity</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" name="Quantity" class="form-control form-control-sm" style="width: 20px;" required>
                                                </div>
                                                <span><small class="text-danger font-weight-light font-italic">
                                                        @error('Quantity') {{ $message }} @enderror
                                                    </small></span>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label class="col-form-label">Units</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" name="Units" class="form-control form-control-sm" style="width: 20px;" required>
                                                </div>
                                                <span><small class="text-danger font-weight-light font-italic">
                                                        @error('Units') {{ $message }} @enderror
                                                    </small></span>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label class="col-form-label">Order Type </label>
                                                <div class="input-group mb-3">
                                                    <select class="form-control form-control-sm" id="status-dropdown" required name="OrderType">
                                                        <option selected disabled>Order Type</option>
                                                        @foreach ($st as $drs)
                                                        <option value="{{ $drs->id }}">{{ $drs->Status }}</option>
                                                        @endforeach
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
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label class="col-form-label">Billed</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" name="Billed" class="form-control form-control-sm" style="width: 20px;" required>
                                                </div>
                                                <span><small class="text-danger font-weight-light font-italic">
                                                        @error('Billed') {{ $message }} @enderror
                                                    </small></span>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label class="col-form-label">Units</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" name="Units" class="form-control form-control-sm" style="width: 20px;" required>
                                                </div>
                                                <span><small class="text-danger font-weight-light font-italic">
                                                        @error('Units') {{ $message }} @enderror
                                                    </small></span>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label class="col-form-label">Order Type </label>
                                                <div class="input-group mb-3">
                                                    <select class="form-control form-control-sm" id="status-dropdown" required name="OrderType">
                                                        <option selected disabled>Order Type</option>
                                                        @foreach ($st as $drs)
                                                        <option value="{{ $drs->id }}">{{ $drs->Status }}</option>
                                                        @endforeach
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
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label class="col-form-label">Delivery</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" name="Delivery" class="form-control form-control-sm" style="width: 20px;" required>
                                                </div>
                                                <span><small class="text-danger font-weight-light font-italic">
                                                        @error('Delivery') {{ $message }} @enderror
                                                    </small></span>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label class="col-form-label">Units</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" name="Units" class="form-control form-control-sm" style="width: 20px;" required>
                                                </div>
                                                <span><small class="text-danger font-weight-light font-italic">
                                                        @error('Units') {{ $message }} @enderror
                                                    </small></span>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="card" style="border: 1px solid black;">
                                        <div class="card-body">
                                            <h5 class="card-title txt-center">Date Of Service</h5>
                                            <div class="form-group">
                                                <label class="col-form-label">From</label>
                                                <div class="input-group mb-3">
                                                    <input type="date" required placeholder="From" name="From" class="form-control form-control-sm" value="{{ old('From') }}">
                                                </div>
                                                <span><small class="text-danger font-weight-light font-italic">
                                                        @error('From')
                                                        {{ $message }}
                                                        @enderror
                                                    </small></span>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-form-label">To</label>
                                                <div class="input-group mb-3">
                                                    <input type="date" required placeholder="To" name="To" class="form-control form-control-sm" value="{{ old('To') }}">
                                                </div>
                                                <span><small class="text-danger font-weight-light font-italic">
                                                        @error('To')
                                                        {{ $message }}
                                                        @enderror
                                                    </small></span>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-form-label">Billing Month</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" required placeholder="Billing Month" name="BillingMonth" class="form-control form-control-sm" value="{{ old('BillingMonth') }}">
                                                </div>
                                                <span><small class="text-danger font-weight-light font-italic">
                                                        @error('BillingMonth')
                                                        {{ $message }}
                                                        @enderror
                                                    </small></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card" style="border: 1px solid black;">
                                        <div class="card-body">
                                            <h5 class="card-title txt-center">Bill Item On:</h5>
                                            <label class="custom-control custom-radio">
                                                <input type="radio" name="radio-stacked" class="custom-control-input"><span class="custom-control-label">Day&nbsp;of&nbsp;Delivery</span>
                                            </label>
                                            <label class="custom-control custom-radio">
                                                <input type="radio" name="radio-stacked" class="custom-control-input"><span class="custom-control-label">Last&nbsp;day&nbsp;of&nbsp;the&nbsp;Period</span>
                                            </label> <label class="custom-control custom-radio">
                                                <input type="radio" name="radio-stacked" class="custom-control-input"><span class="custom-control-label">Bill&nbsp;at&nbsp;Pick-Up</span>
                                            </label> <label class="custom-control custom-radio">
                                                <input type="radio" name="radio-stacked" class="custom-control-input"><span class="custom-control-label">Last&nbsp;day&nbsp;of&nbsp;the&nbsp;month</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <label>CMN/RX</label>
                                    <label class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" checked name="Ins1">
                                        <span class="custom-control-label">Send&nbsp;CMN/RX&nbsp;with&nbsp;this&nbsp;invoice</span>
                                    </label>
                                    <label class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" checked disabled>
                                        <span class="custom-control-label">Accept&nbsp;Assignment</span>
                                    </label>
                                </div>
                            </div>
                            <hr>

                            <div class="row w-100"> <!-- Ensure the row spans full width -->
                                <div class="col">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h2 class="pageheader-title">Billing</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label class="col-form-label">Signature on File</label>
                                        <div class="input-group mb-3">
                                            <input type="text" required placeholder="Signature on File" name="SignatureFile" class="form-control form-control-sm" value="{{ old('SignatureFile') }}">
                                        </div>
                                        <span><small class="text-danger font-weight-light font-italic">
                                                @error('SignatureFile')
                                                {{ $message }}
                                                @enderror
                                            </small></span>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label class="col-form-label">Months Valid 99</label>
                                        <div class="input-group mb-3">
                                            <input type="text" required placeholder="Months Valid 99" name="MonthsValid" class="form-control form-control-sm" value="{{ old('MonthsValid') }}">
                                        </div>
                                        <span><small class="text-danger font-weight-light font-italic">
                                                @error('MonthsValid')
                                                {{ $message }}
                                                @enderror
                                            </small></span>
                                    </div>
                                </div>
                                <div class="col m-3">
                                    <label class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" checked name="Ins1">
                                        <span class="custom-control-label">Block 12 on HCFA</span>
                                    </label>
                                </div>
                                <div class="col m-3">
                                    <label class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" checked name="Ins1">
                                        <span class="custom-control-label">Block 13 on HCFA</span>
                                    </label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label class="col-form-label">Insurance Eligibility</label>
                                        <div class="input-group mb-3">
                                            <input type="text" required placeholder="Insurance Eligibility" name="InsuranceEligibility" class="form-control form-control-sm" value="{{ old('InsuranceEligibility') }}">
                                        </div>
                                        <span><small class="text-danger font-weight-light font-italic">
                                                @error('InsuranceEligibility')
                                                {{ $message }}
                                                @enderror
                                            </small></span>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label class="col-form-label">Tax Rate </label>
                                        <div class="input-group mb-3">
                                            <select class="form-control form-control-sm" id="status-dropdown" required name="TaxRate">
                                                <option selected disabled>Tax Rate</option>
                                                @foreach ($st as $drs)
                                                <option value="{{ $drs->id }}">{{ $drs->Status }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <span>
                                            <small class="text-danger font-weight-light font-italic">
                                                @error('TaxRate')
                                                {{ $message }}
                                                @enderror
                                            </small>
                                        </span>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label class="col-form-label">Out of Pocket</label>
                                        <div class="input-group mb-3">
                                            <input type="text" required placeholder="Out of Pocket" name="OutPocket" class="form-control form-control-sm" value="{{ old('OutPocket') }}">
                                        </div>
                                        <span><small class="text-danger font-weight-light font-italic">
                                                @error('OutPocket')
                                                {{ $message }}
                                                @enderror
                                            </small></span>
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label class="col-form-label">Basis </label>
                                        <div class="input-group mb-3">
                                            <select class="form-control" id="status-dropdown" required name="Basis">
                                                <option selected disabled>Basis</option>
                                                @foreach ($st as $drs)
                                                <option value="{{ $drs->id }}">{{ $drs->Status }}</option>
                                                @endforeach
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
                                <div class="col m-3">
                                    <label class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" checked name="SupplierStandards">
                                        <span class="custom-control-label">Supplier Standards</span>
                                    </label>
                                </div>
                                <div class="col m-3">
                                    <label class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" checked name="HIPPANote">
                                        <span class="custom-control-label">HIPPA Note</span>
                                    </label>
                                </div>
                            </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary">Print Order</button>
                        <button type="button" class="btn btn-primary">Print Delivery Paper</button>
                        <button type="button" class="btn btn-primary">Create Invoice</button>
                        <button type="submit" class="btn btn-primary">Create Order</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>











<!-- ///This is new  -->









