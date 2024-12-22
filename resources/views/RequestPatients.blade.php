@section('title', 'Patient List')
@include('layout.Head')

<div class="dashboard-wrapper">
    <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="page-header">
                        <h2 class="pageheader-title ml-auto">Waiting For {{$headname}} Patient List</h2>
                        <div class="page-breadcrumb">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <!-- <li class="breadcrumb-item">
                        <a href="#" class="breadcrumb-link">Dashboard</a>user
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
    // Decode JSON and ensure the result is an array, default to an empty array if not
    $deptJson = json_decode($users->Dept, true);
    $deptIds = $currentUserRole < 1 && $deptJson && is_array($deptJson) ? array_map('intval', $deptJson) : [];

    $userView = Session::get('LoginViewCheck');
    $userViewDept = Session::get('LoginViewDept');
    // Decode JSON and ensure the result is an array, default to an empty array if not
    $viewDeptJson = json_decode($userViewDept, true);
    $viewdeptIds = $currentUserRole < 1 && $viewDeptJson && is_array($viewDeptJson) ? array_map('intval', $viewDeptJson) : [];

    $patientCounts = $pat->reduce(function ($counts, $patient) {
        $counts[$patient->Dept] = ($counts[$patient->Dept] ?? 0) + 1;
        return $counts;
    }, []);

    $viewPatientCounts = $allpt->reduce(function ($counts, $patient) {
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
                                            <th class="border-0">Account</th>
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
                                                <input type="text" class="column-search search-input" data-column="5" placeholder="Account" id="searchInput" onclick="event.stopPropagation();" oninput="toggleClearIcon(this)">
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
                                    <tbody>
                                        <?php
                                        $sno = 1;
                                                                                    $userR = Session::get('LoginRole');
                                        ?>
                                        @foreach ($pta as $pt)
                                        @php
                                        $userName = \App\Models\Users::find($pt->User);
                                        $deptName = \App\Models\Departments::find($pt->Dept);
                                        $statusName = \App\Models\Status::find($pt?->Order_Status);
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
                                            <td> <span class="badge-dot badge-success mr-1"></span>Open</td>
                                            <td>{{ $pt->created_at->format('m/d/Y h:i:s A') }}</td>
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
            logAction("Filtered wise patient List Page Loaded");
        });
    </script>
