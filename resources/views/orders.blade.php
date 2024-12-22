@section('title', 'Orders List')
@include('layout.Head')

<div class="dashboard-wrapper">
    <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="page-header">
                        <h2 class="pageheader-title ml-auto">Orders List</h2>
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
                    $currentUserRole = Session::get('LoginRole'); // This should be set based on your authentication system
                    $deptIds = $currentUserRole < 1 && $users->Dept ? json_decode($users->Dept, true) : [];
                        @endphp

                        @foreach ($dp as $dps)
                        @if($currentUserRole == 0 && in_array($dps->id, $deptIds))
                        <div class="col p-2">
                            <a href="{{ url('DepartPatient', $dps->id) }}" class="btn btn-block" style="background-color: #427ed1; color: white;">
                                {{ $dps->Department }}
                            </a>
                        </div>
                        @endif
                        @if($currentUserRole == 1 || $currentUserRole == 2)
                        @php
                        $deptCount = 0;
                        @endphp
                        @foreach ($drs as $pti)
                        @if ($dps->id == $pti->Dept)
                        @php
                        $deptCount++;
                        @endphp
                        @endif
                        @endforeach
                        <div class="col p-2">
                            <a href="{{ url('DepartPatient', $dps->id) }}" class="btn btn-block" style="background-color: #427ed1; color: white;">
                                {{ $dps->Department }} ( {{$deptCount}} )
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

                                                <td>{{ $pt?->created_at->format('m/d/Y h:i:s A') }}</td>
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
        });
    </script>
    <script>
        $(document).ready(function() {
            $(".column-search").on("keyup", function() {
                var columnNumber = $(this).data("column");
                var searchTerm = $(this).val().toLowerCase();

                $("#myTable tbody tr").filter(function() {
                    $(this).toggle($(this).children("td").eq(columnNumber).text().toLowerCase().indexOf(searchTerm) > -1)
                });
            });
        });
    </script>