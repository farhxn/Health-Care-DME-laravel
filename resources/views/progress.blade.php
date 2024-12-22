@section('title', 'User & Department Progress')
@include('layout.Head')

<div class="dashboard-wrapper">
    <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="page-header">
                        <h2 class="pageheader-title ml-auto">User & Deparment Progress </h2>
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

@php
    $cardColors = ['#f28b82', '#fbbc04', '#fff475', '#ccff90', '#a7ffeb', '#cbf0f8', '#aecbfa', '#d7aefb', '#fdcfe8', '#e6c9a8', '#e8eaed'];
    $listItemColors = ['#f9c2c0', '#fcd586', '#fff899', '#e0fcb8', '#c3fff2', '#e3f7fa', '#c2d6f8', '#e7d7fa', '#fedaf1', '#f3e2c3', '#f1f3f4'];
    $colorIndex = 0;
@endphp

<style>
    .custom-list-group-item {
padding-top: 0.25rem; /* Reduce top padding */
    padding-bottom: 0.25rem; /* Reduce bottom padding */
    font-size: 12px; /* Keep your font size adjustment if needed */
}

</style>

<div class="row">
@foreach ($dp as $dps)
    @php
        $filteredByDept = $pat->where('Dept', $dps->id);
        $currentColor = $cardColors[$colorIndex % count($cardColors)];
        $currentListItemColor = $listItemColors[$colorIndex % count($listItemColors)];
        $colorIndex++; // Increment colorIndex for the next iteration
    @endphp
    <div class="col-sm-6 col-md-4 col-lg-3">
        <div class="card">
            <div class="card-header text-center">
                <a style="color: $currentColor;">
                    {{ $dps->Department }} ({{$filteredByDept->count()}})
                </a>
            </div>
            <ul class="list-group list-group-flush">
                @foreach ($st as $status)
                    @php
                        $statusCount = $filteredByDept->where('Order_Status', $status->id)->count();
                    @endphp

                    <li class="list-group-item custom-list-group-item" style="background-color: {{ $currentListItemColor }};">
                        <a  style="color: black;">
                            {{ $status->Status }} ({{$statusCount}})
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endforeach

</div>

                <br><br>
                                <div class="row">
                                    <div class="col">
                                        <a href="{{url('filterdeptprogress/01')}}" class="btn btn-block btn-sm p-2" style="background-color: #427ed1; color: white;">Today</a>
                                    </div>

                                    <div class="col">
                                        <a href="{{url('filterdeptprogress/02')}}" class="btn btn-block btn-sm p-2" style="background-color: #427ed1; color: white;">Yesterday</a>
                                    </div>

                                    <div class="col">
                                        <a href="{{url('filterdeptprogress/03')}}"  class="btn btn-block btn-sm p-2" style="background-color: #427ed1; color: white;">This Week</a>
                                    </div>

                                    <div class="col">
                                        <a href="{{url('filterdeptprogress/04')}}" class="btn btn-block btn-sm p-2" style="background-color: #427ed1; color: white;">Last Week</a>
                                    </div>

                                    <div class="col">
                                        <a  href="{{url('filterdeptprogress/05')}}" class="btn btn-block btn-sm p-2" style="background-color: #427ed1; color: white;">This Month</a>
                                    </div>

                                    <div class="col">
                                        <a href="{{url('filterdeptprogress/06')}}" class="btn btn-block btn-sm p-2" style="background-color: #427ed1; color: white;">Last Month</a>
                                    </div>

                                </div>
<br/>

                <div class="row">
                    <div class="col">
                        <div class="card">
                            <h5></h5>
                            <div class="container card-header">
                                <form class="form-inline mr-auto" action="{{ url('/FilterProgressPatient') }}" method="get">
                                    <div class="row">
                                        <div class="form-group mb-2">
                                            <label>&nbsp;<strong>FILTERS </strong>&nbsp;</label>
                                            <div class="form-group">
                                                <select class="form-control" name="date">
                                                    <option selected disabled>Dates</option>
                                                    <option value="4">Today</option>
                                                    <option value="1">Yesterday</option>
                                                    <option value="2">Week</option>
                                                    <option value="3">Month</option>
                                                </select>
                                            </div>
                                        </div>
                                        <br>
                                        <span><small class="text-danger font-weight-light font-italic">
                                                @error('date')
                                                {{ $message }}
                                                @enderror
                                            </small></span>

                                        &nbsp;&nbsp;&nbsp;
                                        <div class="form-group mb-2">
                                            <label>&nbsp;<strong> Categories</strong> &nbsp;</label>
                                            <div class="form-group">
                                                <select class="form-control " name="status">
                                                    <option selected disabled>Status</option>
                                                    @foreach ($st as $sts)
                                                    <option value="{{ $sts->id }}">{{ $sts->Status }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <span><small class="text-danger font-weight-light font-italic">
                                                    @error('status')
                                                    {{ $message }}
                                                    @enderror
                                                </small></span>
                                        </div>&nbsp;&nbsp;&nbsp;

                                        <div class="form-group mb-2">
                                            <label>&nbsp;<strong> Department</strong> &nbsp;</label>
                                            <div class="form-group">
                                                <select class="form-control " name="dept">
                                                    <option selected disabled>Status</option>
                                                    @foreach ($dp as $sts)
                                                    <option value="{{ $sts->id }}">{{ $sts->Department }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <span><small class="text-danger font-weight-light font-italic">
                                                    @error('dept')
                                                    {{ $message }}
                                                    @enderror
                                                </small></span>
                                        </div>&nbsp;&nbsp;&nbsp;

                                        <div class="col p-2">
                                            <button type="submit" class="btn btn-block btn-sm p-2" style="background-color: #427ed1; color: white;">Apply Filter</button>
                                        </div>
                                </form>
                                                                &nbsp;
                                                            <div class="col p-2">
                                    <a href="{{ url('Reminders') }}" class="btn btn-block btn-sm p-2" style="background-color: #427ed1; color: white;">Reminders</a>
                                </div>
                            </div>
                            <br>
                        </div>
                        <br>
                                            <div class="card-body p-0">
                            <div class="table-responsive">
<table class="table display" id="myTable">
    <thead class="bg-light">
        <tr class="border-0">
            <th class="border-0">No.</th>
            <th class="border-0">Assigned&nbsp;Users</th>
            <th class="border-0">Department&nbsp;Name</th>
            @foreach ($st as $status)
                <th class="border-0">{{ $status->Status }}</th>
            @endforeach
                        <th class="border-0">Total&nbsp;Assigned</th>
        </tr>
    </thead>
<tbody>
    @php $sno = 1; @endphp
    @foreach ($users as $user)
@php
$userTotal = 0;
    $departmentNames = collect(json_decode($user->Dept))
        ->map(function($id) use ($dp) {
            return $dp->firstWhere('id', $id)->Department ?? 'Manager';
        })
        ->each(function($name, $index) {
            return ($index + 1) . '. ' . $name; // Prepend the index number to each department name
        })
        ->implode(', ');
@endphp

                                        <tr onclick="window.location='/userDetail/{{ $user->id }}';" style="cursor: pointer;" data-toggle="tooltip" data-placement="top" title="" data-original-title="Show {{ $user->name }}'s Details">
            <td>{{ $sno++ }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $departmentNames }}</td>
            @foreach ($st as $status)
                @php
                    $total = 0;
                    foreach ($pat as $pt) {
                        if($pt->User == $user->id && $pt->Order_Status == $status->id) {
                            $total++;
                            $userTotal++;
                        }
                    }
                @endphp
                <td>{{ $total }}</td>
            @endforeach
            <td>{{$userTotal}}</td>
        </tr>
    @endforeach
</tbody>

</table>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>



@include('layout.footer')



<div class="modal fade" id="dateRangeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Select Date Range</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="dateRangeForm" action="{{ url('MainReport') }}" method="GET" target="_blank">
                    <div class="form-group">
                        <label for="startDate">Start Date:</label>
                        <input type="date" class="form-control" id="startDate" name="startDate" required>
                    </div>
                    <div class="form-group">
                        <label for="endDate">End Date:</label>
                        <input type="date" class="form-control" id="endDate" name="endDate" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Generate Report</button>
                </form>
            </div>
        </div>
    </div>
</div>




<script>
    $(document).ready(function() {
        logAction("User & Department Progress Page Loaded");
                sendUpdateReminder();
                sendReminders();
    });
 </script>
