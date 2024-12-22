@section('title', 'Status Patient List')
@include('layout.Head')
@php
$userR = Session::get('LoginRole');
@endphp

<div class="dashboard-wrapper">
    <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="page-header">
                        <h2 class="pageheader-title ml-auto">{{$stName}} Status Patient List</h2>
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
                    @php
                    $allpt = $ViewPatients;
                    $currentUserRole = Session::get('LoginRole');
                    $deptJson = json_decode($users, true);
                    $deptIds = $currentUserRole < 1 && $deptJson && is_array($deptJson) ? array_map('intval', $deptJson) : [];
                        $userView=Session::get('LoginViewCheck');
                        $userViewDept=Session::get('LoginViewDept');
                        $viewDeptJson=json_decode($userViewDept, true);

                        $viewdeptIds=$currentUserRole < 1 && $viewDeptJson && is_array($viewDeptJson) ? array_map('intval', $viewDeptJson) : [];

                        $patientCounts=$drs->filter(function ($patient) {
                        return $patient->Order_Status != 17;
                        })->reduce(function ($counts, $patient) {
                        $counts[$patient->Dept] = ($counts[$patient->Dept] ?? 0) + 1;
                        return $counts;
                        }, []);

                        $viewPatientCounts = $allpt->filter(function ($patient) {
                        return $patient->Order_Status != 17;
                        })->reduce(function ($counts, $patient) {
                        $counts[$patient->Dept] = ($counts[$patient->Dept] ?? 0) + 1;
                        return $counts;
                        }, []);

                        @endphp


                        @foreach ($dp as $dps)
                        @php
                        $useViewCount = $userView == 'on' && in_array($dps->id, $viewdeptIds);
                        $deptCount = $useViewCount ? ($viewPatientCounts[$dps->id] ?? 0) : ($patientCounts[$dps->id] ?? 0);
                        @endphp

                        {{-- Consolidated Condition --}}
                        @if (($currentUserRole == 0 && in_array($dps->id, $deptIds)) || $currentUserRole >= 1 || $useViewCount)
                        <div class="col p-2">
                            <a href="{{ url('DepartPatient', $dps->id) }}" class="btn btn-block" style="background-color: #427ed1; color: white;">
                                {{ $dps->Department }} ({{ $deptCount }})
                            </a>
                        </div>
                        @endif
                        @endforeach
                </div>



                <br><br>


                <div class="row">
                    <div class="col">
                        <div class="card">
                            <h5></h5>
                            <div class="container card-header">
                                <div class="row">


                                <div class="col p-2">
                                        @php
                                        use Carbon\Carbon;

                                        $twentyFourHoursAgo = Carbon::now()->subHours(24);
                                        $rspcount = 0;
                                        $flpcount = 0;
                                        $completedCount = 0;

                                        // Preload all necessary statuses in one query
                                        $statusIds = $drs->pluck('Order_Status')->unique();
                                        $statuses = \App\Models\Status::whereIn('id', $statusIds)->pluck('Status', 'id');

                                        // Iterate over the data and count
                                        foreach ($drs as $pti) {
                                        $statusName = $statuses[$pti->Order_Status] ?? 'Unknown Status';

                                        // Resupply count logic
                                        if (str_contains(strtolower($statusName), 'resupply') && $pti->resupplyDate) {
                                        $resupplyDate = Carbon::parse($pti->resupplyDate);
                                        if ($resupplyDate->isTomorrow() || $resupplyDate->lessThanOrEqualTo(now())) {
                                        $rspcount++;
                                        }
                                        }

                                        // Follow-up count logic
                                        if ($pti->updated_at->lessThanOrEqualTo($twentyFourHoursAgo) && !in_array($pti->Order_Status, [17, 18, 16, 5, 28])) {
                                        $flpcount++;
                                        }

                                        // Completed count logic
                                        if (str_contains(strtolower($statusName), 'completed') && $pti->updated_at->lessThanOrEqualTo($twentyFourHoursAgo)) {
                                        $completedCount++;
                                        }
                                        }
                                        @endphp



                                        <a href="{{ url('ResupplyPatient',0) }}" class="btn btn-block btn-sm p-2" style="background-color: #427ed1; color: white;">Resupply&nbsp;<span class="badge badge-light">( {{ $rspcount }} )</span> </a>
                                    </div>
                                    &nbsp;
                                    <div class="col p-2">
                                        <a href="{{ url('followUpPatient',0) }}" class="btn btn-block btn-sm p-2" style="background-color: #427ed1; color: white;">FollowUp&nbsp;<span class="badge badge-light">( {{ $flpcount }} )</span> </a>
                                    </div>
                                    &nbsp;
                                    @if($userR =="2")
                                    <div class="col p-2">
                                        <button type="button" data-toggle="modal" data-target="#PatientReport" class="btn btn-primary btn-block p-2" style="background-color: #427ed1; color: white;">Export Patients Report</button>
                                    </div>
                                    &nbsp;
                                    <div class="col p-2">
                                        <button type="button" data-toggle="modal" data-target="#dateRangeModal" class="btn btn-primary btn-block p-2" style="background-color: #427ed1; color: white;">Export Report</button>
                                    </div>
                                    @endif
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
                                                <th class="border-0">PT&nbsp;First&nbsp;Name</th>
                                                <th class="border-0">PT&nbsp;Last&nbsp;Name</th>
                                                <th class="border-0">Item</th>
                                                <th class="border-0">DOB</th>
                                                <th class="border-0">Dr.&nbsp;Off. </th>
                                                <th class="border-0">Listed&nbsp;By</th>
                                                <th class="border-0">Department</th>
                                                <th class="border-0">User</th>
                                                <th class="border-0">Status</th>
                                                <th class="border-0">Order&nbsp;Date</th>
                                            </tr>
                                            <tr>
                                                <th></th>
                                                <td>
                                                    <div class="search-box">
                                                        <input type="text" class="column-search search-input" data-column="1" placeholder="First name" id="searchInput" onclick="event.stopPropagation();" oninput="toggleClearIcon(this)">
                                                        <i class="fas fa-search search-icon"></i>
                                                        <i class="fas fa-times clear-icon" onclick="clearInput()"></i>
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="search-box">
                                                        <input type="text" class="column-search search-input" data-column="2" placeholder="Last name" id="searchInput" onclick="event.stopPropagation();" oninput="toggleClearIcon(this)">
                                                        <i class="fas fa-search search-icon"></i>
                                                        <i class="fas fa-times clear-icon" onclick="clearInput()"></i>
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="search-box">
                                                        <input type="text" class="column-search search-input" data-column="3" placeholder="Item" id="searchInput" onclick="event.stopPropagation();" oninput="toggleClearIcon(this)">
                                                        <i class="fas fa-search search-icon"></i>
                                                        <i class="fas fa-times clear-icon" onclick="clearInput()"></i>
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="search-box">
                                                        <input type="text" class="column-search search-input" data-column="4" placeholder="DOB" id="searchInput" onclick="event.stopPropagation();" oninput="toggleClearIcon(this)">
                                                        <i class="fas fa-search search-icon"></i>
                                                        <i class="fas fa-times clear-icon" onclick="clearInput()"></i>
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="search-box">
                                                        <input type="text" class="column-search search-input" data-column="5" placeholder="Dr. Off" id="searchInput" onclick="event.stopPropagation();" oninput="toggleClearIcon(this)">
                                                        <i class="fas fa-search search-icon"></i>
                                                        <i class="fas fa-times clear-icon" onclick="clearInput()"></i>
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="search-box">
                                                        <input type="text" class="column-search search-input" data-column="6" placeholder="Listed By" id="searchInput" onclick="event.stopPropagation();" oninput="toggleClearIcon(this)">
                                                        <i class="fas fa-search search-icon"></i>
                                                        <i class="fas fa-times clear-icon" onclick="clearInput()"></i>
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="search-box">
                                                        <input type="text" class="column-search search-input" data-column="7" placeholder="Department" id="searchInput" onclick="event.stopPropagation();" oninput="toggleClearIcon(this)">
                                                        <i class="fas fa-search search-icon"></i>
                                                        <i class="fas fa-times clear-icon" onclick="clearInput()"></i>
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="search-box">
                                                        <input type="text" class="column-search search-input" data-column="8" placeholder="User" id="searchInput" onclick="event.stopPropagation();" oninput="toggleClearIcon(this)">
                                                        <i class="fas fa-search search-icon"></i>
                                                        <i class="fas fa-times clear-icon" onclick="clearInput()"></i>
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="search-box">
                                                        <input type="text" class="column-search search-input" data-column="9" placeholder="Status" id="searchInput" onclick="event.stopPropagation();" oninput="toggleClearIcon(this)">
                                                        <i class="fas fa-search search-icon"></i>
                                                        <i class="fas fa-times clear-icon" onclick="clearInput()"></i>
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="search-box">
                                                        <input type="text" class="column-search search-input" data-column="10" placeholder="Order Date" id="searchInput" onclick="event.stopPropagation();" oninput="toggleClearIcon(this)">
                                                        <i class="fas fa-search search-icon"></i>
                                                        <i class="fas fa-times clear-icon" onclick="clearInput()"></i>
                                                    </div>
                                                </td>
                                            </tr>
                                        </thead>
                                        <tbody id="patients-container">
                                            @include('partials.patients_partial', ['additionalPat' => $pat])
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
    <script>
        $(document).ready(function() {
            logAction("Status wise patient List Page Loaded");

            var statusId = $('.statusName').first().val(); // Ensures we get the value of the first hidden input with class 'statusName'
            console.log("Status Id: " + statusId);

            var table = $('#myTable').DataTable();

            $('#myTable').on('mouseenter', 'tbody tr', function() {
                $('#myTable tbody tr').css('cursor', 'pointer');
                var $row = $(this);
                if (!$row.data('tooltip')) {
                    $row.tooltip({
                        title: function() {
                            var name = $row.find('td:nth-child(2)').text(); // Assuming the name is in the second column
                            return 'Show ' + name + "'s Details";
                        },
                        placement: 'top',
                        trigger: 'hover'
                    }).tooltip('show');
                }
            });

            $.ajax({
                url: '/PatientStatusList/' + statusId,
                type: 'GET',
                success: function(data) {
             console.log(statusId);
                    $('#myTable tbody').append(data);
                    var dat = extractTableData($(data));
                    table.rows.add(dat).draw();

                    $('#myTable tbody tr').css('cursor', 'pointer').tooltip({
                        title: function() {
                            var name = $(this).find('td:nth-child(2)').text(); // Assuming the name is in the second column
                            return 'Show ' + name + "'s Details";
                        },
                        placement: 'top'
                    });

                    $('#myTable tbody').on('click', 'tr', function() {
                        var id = $(this).find('td:first').text(); // Assuming the first column contains the ID
                        window.location.href = '/PatientDetail/' + id;
                    });

                },
                error: function() {
                    alert('Something went wrong! Reload the Page to load all pages.');
                }
            });

        });


        function extractTableData(rows) {
            var data = [];
            rows.each(function() {
                var row = [];
                $(this).find('td').each(function() {
                    row.push($(this).text().trim()); // Trim whitespace from cell content
                });
                if (row.length > 0) { // Check if row is not empty
                    data.push(row);
                }
            });
            return data;
        }
    </script>