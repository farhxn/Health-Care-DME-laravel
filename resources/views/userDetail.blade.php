@section('title', 'Users Detail')
@include('layout.Head')

<div class="dashboard-wrapper">
    <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="page-header">
                        <h2 class="pageheader-title ml-auto">{{ $user->name }}'s Detail</h2>
                        <div class="page-breadcrumb">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <!-- Breadcrumbs can be added here -->
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <div class="ecommerce-widget">
                <div class="row">
                    <div class="offset col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="row">
                            <div class="col pl-lg-0 pl-md-0 border-left m-b-30">
                                <div class="product-details">
                                    <div class="border-bottom pb-3 mb-3">
                                        <h2 class="mb-3">User Details</h2>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="row">
                                                <div class="col d-flex align-items-center">
                                                    <h4 class="mb-0">NAME</h4>
                                                    <p class="mb-0 ml-2">: {{ $user->name }}</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col d-flex align-items-center">
                                                    <h4 class="mb-0">E-Mail</h4>
                                                    <p class="mb-0 ml-2">: {{ $user->email }}</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col d-flex align-items-center">
                                                    <h4 class="mb-0">Role</h4>
                                                    <p class="mb-0 ml-2">:
                                                        @if ($user->role == '2')
                                                            Admin
                                                        @elseif($user->role == '1')
                                                            Manager
                                                        @else
                                                            User
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col d-flex align-items-center">
                                                    <h4 class="mb-0">Status</h4>
                                                    <p class="mb-0 ml-2">: @if ($user->status == '1')
                                                            <span class="badge-dot badge-danger mr-1"></span>Close
                                                        @else
                                                            <span class="badge-dot badge-success mr-1"></span>Open
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="container">
                                <div class="row">
                                    <!-- Status List Column -->
                                    <div class="col-8">
                                        <div class="row">
                                            @php
                                                $colors = ['#427ed1', '#32a852', '#a83232', '#a88232', '#3284a8']; // Add more colors as needed
                                                $colorIndex = 0;
                                                $total = 0; // Initialize total counter
                                            @endphp

                                            @foreach ($st as $sts)
                                                @php
                                                    $counter = 0; // Initialize counter for each status
                                                @endphp
                                                @foreach ($dr as $pt)
                                                    @if($pt->Order_Status == $sts->id)
                                                        @php 
                                                            $counter++;
                                                            $total++; 
                                                        @endphp
                                                    @endif
                                                @endforeach
                                                
                                                <!-- Display the status and the count with dynamic background color -->
                                                <div class="col p-2">
                                                    <a href ="{{ url('/FilteredUserPatient/'.$user->id.'/'.$sts->id) }}" class="btn btn-block btn-sm p-2" style="background-color: {{ $colors[$colorIndex % count($colors)] }}; color: white;">
                                                        {{$sts->Status}} <span>( {{$counter}} )</span>
                                                    </a>
                                                </div>
                                                
                                                @php
                                                    $colorIndex++; // Move to the next color for the next iteration
                                                @endphp
                                            @endforeach
                                        </div>
                                    </div>
                                    
                                    <!-- Total Column -->
                                    <div class="col d-flex align-items-center justify-content-center">
                                        <div class="w-100">
                                            <a href ="{{ url('/userDetail',$user->id) }}" class="btn btn-block btn-sm p-3 bg-success" style="color: white;"> <!-- Increased padding from p-2 to p-3 -->
                                                Total Assigned Patients <span>( {{$total+$hc}} )</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 m-b-60">
                                <div class="simple-card">
                                    <ul class="nav nav-tabs" id="myTab5" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active border-left-0" id="product-tab-1" data-toggle="tab" role="tab" href="#tab-1" aria-controls="product-tab-1" aria-selected="true">All Orders</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link border-left-0" id="product-tab-2" data-toggle="tab" href="#tab-2" role="tab" aria-controls="product-tab-2">Work &nbsp;History</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="myTabContent5">
                                        <div class="tab-pane fade show active" id="tab-1" role="tabpanel" aria-labelledby="product-tab-1">
                                            <br>
                                            <div class="table-responsive">
                                                <table class="table display" id="myTable">
                                                    <thead class="bg-light">
                                                        <tr class="border-0">
                                                            <th class="border-0">No.</th>
                                                            <th class="border-0">PT&nbsp;First&nbsp;Name</th>
                                                            <th class="border-0">PT&nbsp;Last&nbsp;Name</th>
                                                            <th class="border-0">Item</th>
                                                            <th class="border-0">DOB</th>
                                                            <th class="border-0">Account</th>
                                                            <th class="border-0">Listed&nbsp;By</th>
                                                            <th class="border-0">Department</th>
                                                            <th class="border-0">User</th>
                                                            <th class="border-0">Status</th>
                                                            <th class="border-0">Order&nbsp;Date</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $sno = 1; ?>
                                                        @foreach ($pat as $pt)
                                                            @php
                                                                $userName = \App\Models\Users::find($pt->User);
                                                                $deptName = \App\Models\Departments::find($pt->Dept);
                                                                $statusName = \App\Models\Status::find($pt->Order_Status);
                                                            @endphp
                                                            <tr onclick="window.location='/PatientDetail/{{ $pt->id }}';" style="cursor: pointer;" data-toggle="tooltip" data-placement="top" title="" data-original-title="Show {{ $pt->name }}'s Details">
                                                                <td>{{ $sno++ }}</td>
                                                                <td>{{ $pt->name }}</td>
                                                                <td>{{ $pt->last_Name }}</td>
                                                                <td>{{ $pt->Item }}</td>
                                                                <td>{{ $pt->Dob }}</td>
                                                                <td>{{ $pt->AccNumber }}</td>
                                                                <td>{{ $pt->listed }}</td>
                                                                <td>{{ $deptName?->Department }}</td>
                                                                <td>{{ $userName?->name }}</td>
                                                                <td>{{ $statusName?->Status }}</td>
                                                                <td>{{ $pt->created_at->format('m/d/Y h:i:s A') }}</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        
                                        <div class="tab-pane fade" id="tab-2" role="tabpanel" aria-labelledby="product-tab-2">
                                            <h5>Filter by Date</h5>
                                            <form id="filterForm">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <input type="date" id="startDate" class="form-control" placeholder="From Date">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <input type="date" id="endDate" class="form-control" placeholder="To Date">
                                                    </div>
                                                    <div class="col-md-2">
                                                        <button type="button" class="btn btn-primary" onclick="filterByDate()">Filter</button>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <button type="button" class="btn btn-secondary" onclick="clearFilters()">Clear</button>
                                                    </div>
                                                </div>
                                            </form>
                                            <br>
                                            <div class="table-responsive">
                                                <table class="table display" id="myTable2">
                                                    <thead class="bg-light text-center">
                                                        <tr class="border-0 text-center">
                                                            <th class="border-0 text-center">No.</th>
                                                            <th class="border-0">PT&nbsp;First&nbsp;Name</th>
                                                            <th class="border-0">PT&nbsp;Last&nbsp;Name</th>
                                                            <th class="border-0 text-center">DOB</th>
                                                            <th class="border-0 text-center">Order&nbsp;Number</th>
                                                            <th class="border-0 text-center">Account&nbsp;Number</th>
                                                            <th class="border-0 text-center">Department</th>
                                                            <th class="border-0 text-center">User</th>
                                                            <th class="border-0 text-center">Status</th>
                                                            <th class="border-0 text-center">PT&nbsp;MOVE&nbsp;DATE</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $sno = 1; ?>
                                                        @foreach ($his as $user)
                                                            @php
                                                                $userName = \App\Models\Users::find($user->user);
                                                                $deptName = \App\Models\Departments::find($user->Dept);
                                                                $statusName = \App\Models\Status::find($user->status);
                                                            @endphp
                                                            <tr>
                                                                <td class="text-center">{{ $sno++ }}</td>
                                                                <td class="text-center">{{ $user->PtName }}</td>
                                                                <td class="text-center">{{ $user?->last_Name }}</td>
                                                                <td class="text-center">{{ $user->DOB }}</td>
                                                                <td class="text-center">{{ $user->order_num }}</td>
                                                                <td class="text-center">{{ $user->Acc_num }}</td>
                                                                <td class="text-center">{{ $deptName?->Department }}</td>
                                                                <td class="text-center">{{ $userName?->name }}</td>
                                                                <td class="text-center">{{ $statusName?->Status }}</td>
                                                                <td>{{ $user->created_at->format('m/d/Y h:i:s A') }}</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @include('layout.footer')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    logAction("User Detail Page Loaded");

    var table1 = $('#myTable').DataTable();
    var table2 = $('#myTable2').DataTable();

    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
        var target = $(e.target).attr("href");

        if (target === '#tab-1') {
            $('#myTable').parent().show();
            $('#myTable2').parent().hide();
            table1.columns.adjust().draw();
        } else if (target === '#tab-2') {
            $('#myTable2').parent().show();
            $('#myTable').parent().hide();
            table2.columns.adjust().draw();
        }
    });

    window.filterByDate = function() {
        var startDate = $('#startDate').val();
        var endDate = $('#endDate').val();

        // Convert input dates to Date objects
        var startDateObj = startDate ? new Date(startDate) : null;
        var endDateObj = endDate ? new Date(endDate) : null;

        // Adjust endDateObj to include the entire end day
        if (endDateObj) {
            endDateObj.setHours(23, 59, 59, 999);
        }

        $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
            // Convert the date from the DataTable to a Date object
            var dateStr = data[9]; // Adjust if necessary
            var date = new Date(dateStr);

            // Skip rows with invalid dates
            if (isNaN(date.getTime())) {
                return false;
            }

            // Check if the date falls within the selected range
            if (
                (!startDateObj || date >= startDateObj) &&
                (!endDateObj || date <= endDateObj)
            ) {
                return true;
            }
            return false;
        });

        table2.draw();
        $.fn.dataTable.ext.search.pop();
    };

    window.clearFilters = function() {
        $('#startDate').val('');
        $('#endDate').val('');
        table2.draw();
    };
});
</script>
