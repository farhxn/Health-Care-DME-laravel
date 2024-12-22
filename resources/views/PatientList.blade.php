@section('title', 'Patient List')
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
                        <h2 class="pageheader-title ml-auto">Patient List</h2>
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
                    $currentUserRole = $users->role;
                    $deptJson = json_decode($users->Dept, true);
                    $deptIds = $currentUserRole < 1 && $deptJson && is_array($deptJson) ? array_map('intval', $deptJson) : []; $userView=Session::get('LoginViewCheck'); $userViewDept=Session::get('LoginViewDept'); $viewDeptJson=json_decode($userViewDept, true); $viewdeptIds=$currentUserRole < 1 && $viewDeptJson && is_array($viewDeptJson) ? array_map('intval', $viewDeptJson) : []; $patientCounts=$drs->reduce(function ($counts, $patient) {
                        $counts[$patient->Dept] = ($counts[$patient->Dept] ?? 0) + 1;
                        return $counts;
                        }, []);

                        $viewPatientCounts = $pat->reduce(function ($counts, $patient) {
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
                                                <th class="border-0">Action</th>
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


                                                <td></td>
                                            </tr>
                                        </thead>

                                        <tbody id="patient-table-body">
                                            @php
                                            $sno = 1;
                                            $userR = Session::get('LoginRole');
                                            $editPer = Session::get('LoginEdit');
                                            $deletePer = Session::get('LoginDelete');

                                            $doctorIds = $pat->pluck('Off_Name')->filter()->unique();
                                            $doctorIds = $pat->pluck('Off_Name')->filter()->unique();
                                            $userIds = $pat->pluck('User')->filter()->unique();
                                            $deptIds = $pat->pluck('Dept')->filter()->unique();
                                            $statusIds = $pat->pluck('Order_Status')->filter()->unique();

                                            $doctors = \App\Models\Doctors::whereIn('id', $doctorIds)->pluck('Office_Name', 'id');
                                            $users = \App\Models\Users::whereIn('id', $userIds)->pluck('name', 'id');
                                            $departments = \App\Models\Departments::whereIn('id', $deptIds)->pluck('Department', 'id');
                                            $statuses = \App\Models\Status::whereIn('id', $statusIds)->pluck('Status', 'id');


                                            @endphp
                                            @foreach ($pat as $pt)
                                            @php
                                            $drName = $doctors->get($pt?->Off_Name);
                                            $userName = $users->get($pt?->User);
                                            $deptName = $departments->get($pt?->Dept);
                                            $statusName = $statuses->get($pt?->Order_Status);

                                            $listedText = $pt->Item;
                                            $wordArray = explode(' ', $listedText);
                                            $trimmedText = count($wordArray) > 8 ? implode(' ', array_slice($wordArray, 0, 10)) . '...' : (strlen($listedText) > 10 && !str_contains($listedText, ' ') ? substr($listedText, 0, 5) . '...' : $listedText);
                                            @endphp
                                            <tr onclick="rowClickHandler(event, '/PatientDetail/{{ $pt->id }}');" style="cursor: pointer;" data-toggle="tooltip" data-placement="top" title="" data-original-title="Show {{ $pt->name }}'s Details">
                                                <td>{{ $pt->id }}</td>
                                                <td>{{ $pt->name }}</td>
                                                <td>{{ $pt->last_Name }}</td>
                                                <td>
                                                    {{ $trimmedText }}
                                                </td>
                                                <td>{{ $pt->Dob }}</td>
                                                <td>{{ $drName }}</td>
                                                <td>{{ $pt->listed }}</td>
                                                <td>{{ $deptName }}</td>
                                                <td>{{ $userName }}</td>

                                                <td>{{ $statusName }}
                                                </td>

                                                <td>{{ $pt->created_at->format('m/d/Y h:i:s A') }}</td>
                                                <td class="text-center">
                                                    @if($userR =="2" || $editPer == "on" || $userR == "1" || $deletePer =="on")
                                                    <a href="{{ url('EditPatient', $pt->id) }}" class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit {{ $pt->name }}'s Details"><i class="fa fa-pen-to-square"></i></a>
                                                    @endif
                                                    @if($userR =="2" || $deletePer =="on" )
                                                    <button data-url="{{ url('DeletePatient', $pt->id) }}" class="btn btn-sm btn-danger delete-btn" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete {{ $pt->name }} "><i class="fa fa-trash"></i></button>
                                                    @endif
                                                </td>
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

    <script>
        $(document).ready(function() {
            logAction("Patient List Page Loaded");
            var table = $('#myTable').DataTable();

            function appendPatients(data) {
                console.log(data);
                var newRows = $(data);
                $('#patient-table-body').append(newRows);

                // Initialize tooltips for the newly added elements
                $('[data-toggle="tooltip"]').tooltip();

                var extractedData = extractTableData(newRows);
                // Add the row data to the DataTable
                table.rows.add(extractedData).draw();

                $('[data-toggle="tooltip"]').tooltip();
                $('#patient-table-body').on('click', 'tr', function() {
                    var id = $(this).find('td:first').text(); // Assuming the first column contains the ID
                    window.location.href = '/PatientDetail/' + id;
                });
            }

            // Load additional patients after initial load
            $.ajax({
                url: '/AllPatientList',
                type: 'GET',
                beforeSend: function() {
                    // Optionally, you can add a loader here
                },
                success: function(data) {
                    appendPatients(data);
                },
                error: function() {
                    alert('Something went wrong! Reload the Page to load all pages.');
                }
            });

            // Initialize tooltips and click events for static rows
            $('#patient-table-body').on('click', 'tr', function() {
                var id = $(this).find('td:first').text(); // Assuming the first column contains the ID
                window.location.href = '/PatientDetail/' + id;
            });


            $('#patient-table-body').on('click', '.delete-btn', function(event) {
                event.stopPropagation();
                var deleteUrl = $(this).data('url'); // Get the URL from the data attribute
                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: deleteUrl,
                            type: 'POST', // Match the method expected by your Laravel route
                            data: {
                                _token: "{{ csrf_token() }}", // CSRF token for Laravel
                            },
                            success: function(response) {
                                Swal.fire({
                                    title: "Deleted!",
                                    text: "Deleted Successfully.",
                                    icon: "success"
                                }).then(() => {
                                    window.location.reload(); // Reload the page or redirect
                                });
                            },
                            error: function(xhr, status, error) {
                                // Handle error
                                console.error(error);
                            }
                        });
                    } else {
                        Swal.fire({
                            title: "Cancelled",
                            text: "It is safe :)",
                            icon: "error"
                        });
                    }
                });
            });


            $('#patient-table-body').on('click', '.edit-btn', function(event) {
                event.stopPropagation();
                var url = $(this).attr('href');
                window.location.href = url;
            });
        });

        function extractTableData(rows) {
            var data = [];
            rows.each(function() {
                var row = [];
                $(this).find('td').each(function() {
                    row.push($(this).html().trim()); // Trim whitespace from cell content
                });
                if (row.length > 0) { // Check if row is not empty
                    data.push(row);
                }
            });
            return data;
        }
    </script>