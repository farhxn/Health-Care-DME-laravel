@section('title', 'Edit Doctor')
@include('layout.Head')
<div class="nav-left-sidebar sidebar  ">
    <div class="menu-list">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="d-xl-none d-lg-none" href="#">Dashboard</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav flex-column">
                    <li class="nav-divider">Status</li>

                    <ul class="nav flex-column">
                        <a class="nav-link active" href="{{ url('/') }}">
                            <li class="nav-item">All &nbsp; <span class="badge badge-light">( {{$pt}} )</span></li>
                        </a>
                        @foreach ($st as $sts)
                        @php
                        $cou = 0;
                        @endphp

                        @foreach ($drs as $pt)
                        @if ($sts->id == $pt->Order_Status)
                        @php $cou++; @endphp
                        @endif
                        @endforeach

                        @if (str_contains(strtolower($sts->Status), 'pending'))
                        <li class="nav-item dropdown" style="display: block;">
                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                <a class="nav-link bg-light" href="{{ url('StatusPatient',$sts->id) }}" style="flex-grow: 1; display: block; text-decoration: none;">
                                    {{ $sts->Status }} &nbsp;
                                    <span class="badge badge-light">({{ $cou }})</span>
                                </a>
                                <a href="#" class="dropdown-toggle" data-toggle="collapse" aria-expanded="false" data-target="#submenu-245" style="padding: 0 10px; font-size:20px;"></a>
                            </div>
                            <div id="submenu-245" class="collapse submenu" style="background-color: white; width: 100%;">
                                <ul class="nav flex-column">
                                    @foreach ($st as $subSts)
                                    @if (str_contains(strtolower($subSts->Status), 'waiting for auth') ||str_contains(strtolower($subSts->Status), 'ready for dispense') || str_contains(strtolower($subSts->Status), 'scheduled'))
                                    @php
                                    $subCou = 0;
                                    foreach ($drs as $pt) {
                                    if ($subSts->id == $pt->Order_Status) {
                                    $subCou++;
                                    }
                                    }
                                    @endphp
                                    <li class="nav-item">
                                        <a class="nav-link bg-light" href="{{ url('StatusPatient', $subSts->id) }}">
                                            {{ $subSts->Status }} &nbsp; <span class="badge badge-light">({{ $subCou }})</span>
                                        </a>
                                    </li>
                                    @endif
                                    @endforeach
                                </ul>
                            </div>
                        </li>

                        @elseif (str_contains(strtolower($sts->Status), 'completed'))
                        <li class="nav-item dropdown" style="display: block;">
                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                <a class="nav-link bg-light" href="{{ url('StatusPatient',$sts->id) }}" style="flex-grow: 1; display: block; text-decoration: none;">
                                    {{ $sts->Status }} &nbsp;
                                    <span class="badge badge-light">({{ $cou }})</span>
                                </a>
                                <a href="#" class="dropdown-toggle" data-toggle="collapse" aria-expanded="false" data-target="#submenu-247" style="padding: 0 10px; font-size:20px;"></a>
                            </div>
                            <div id="submenu-247" class="collapse submenu" style="background-color: white; width: 100%;">
                                <ul class="nav flex-column">
                                    @foreach ($st as $subSts)
                                    @if (str_contains(strtolower($subSts->Status), 'canceled')  || str_contains(strtolower($subSts->Status), 'sent for billing'))
                                    @php
                                    $subCou = 0;
                                    foreach ($drs as $pt) {
                                    if ($subSts->id == $pt->Order_Status) {
                                    $subCou++;
                                    }
                                    }
                                    @endphp
                                    <li class="nav-item">
                                        <a class="nav-link bg-light" href="{{ url('StatusPatient', $subSts->id) }}">
                                            {{ $subSts->Status }} &nbsp; <span class="badge badge-light">({{ $subCou }})</span>
                                        </a>
                                    </li>
                                    @endif
                                    @endforeach
                                </ul>
                            </div>
                        </li>

                        @elseif (!str_contains(strtolower($sts->Status), 'waiting for auth') &&
                        !str_contains(strtolower($sts->Status), 'ready for dispense') &&
                        !str_contains(strtolower($sts->Status), 'scheduled') &&
                        !str_contains(strtolower($sts->Status), 'canceled') &&
                        !str_contains(strtolower($sts->Status), 'sent for billing'))
                        <li class="nav-item">
                            <a class="nav-link bg-light" href="{{ url('StatusPatient',$sts->id) }}">
                                {{ $sts->Status }} &nbsp; <span class="badge badge-light">({{ $cou }})</span>
                            </a>
                        </li>
                        @endif
                        @endforeach


                        @php
                        $user = Session::get('LoginRole');
                        @endphp
                        @if($user =="2")
                        <li class="nav-item ">
                            <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-1" aria-controls="submenu-1"><i class="fa fa-fw fa-user-circle"></i>Manage User</a>
                            <div id="submenu-1" class="collapse submenu" style="background-color: white;">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ url('UserAdd') }}">Add User</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ url('UserList') }}">User's List</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        @endif
                        @if($user =="1" || $user =="2")
                        <li class="nav-item ">
                            <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-4" aria-controls="submenu-1"><i class="fa fa-bed"></i>Manage
                                Patients</a>
                            <div id="submenu-4" class="collapse submenu" style="background-color: white;">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ url('PatientAdd') }}">Add Patient</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ url('PatientList') }}">Patient's List</a>
                                    </li>
                                </ul>
                            </div>
                        </li>

<li class="nav-item ">
                            <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-9" aria-controls="submenu-1"><i class="fa-solid fa-building-user"></i>Manage
                            Sub Department</a>
                            <div id="submenu-9" class="collapse submenu" style="background-color: white;">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ url('addSubDept') }}">Add Sub Department</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ url('SubDepartList') }}">Sub Department's List</a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="nav-item ">
                            <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-9" aria-controls="submenu-1"><i class="fa-solid fa-cart-flatbed"></i>Manage
                                Orders</a>
                            <div id="submenu-9" class="collapse submenu" style="background-color: white;">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ url('Orders') }}">Order's List</a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="nav-item ">
                            <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-2" aria-controls="submenu-1"><i class="fa fa-building"></i>Manage
                                Departments</a>
                            <div id="submenu-2" class="collapse submenu" style="background-color: white;">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ url('DepartmentAdd') }}">Add Department</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ url('DepartmentList') }}">Department's List</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-3" aria-controls="submenu-1"><i class="fa fa-hourglass-start"></i>Manage Status</a>
                            <div id="submenu-3" class="collapse submenu" style="background-color: white;">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ url('StatusAdd') }}">Add Status</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ url('StatusList') }}">Status List</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-5" aria-controls="submenu-1"><i class="fa fa-stethoscope"></i>Manage Doctor</a>
                            <div id="submenu-5" class="collapse submenu" style="background-color: white;">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ url('DoctorAdd') }}">Add Doctor</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ url('DoctorList') }}">Doctor's List</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        @endif
                        @if($user =="2")
                        <a class="nav-link" href="{{ url('LogsList') }}">
                            <li class="nav-item"><i class="fa-brands fa-slack"></i>Logs</span></li>
                        </a>
                        <a class="nav-link" href="{{ url('backup&restore') }}">
                            <li class="nav-item"><i class="fa fa-database"></i>Backup Database</span></li>
                        </a>
                        @endif
                        @if($user =="0")
                        <a class="nav-link" href="{{ url('HistoryList') }}">
                            <li class="nav-item"><i class="fa-solid fa-book-medical"></i>Work&nbsp;History</span></li>
                        </a>
                        @endif
                        <a class="nav-link" href="{{ url('logout') }}">
                            <li class="nav-item"><i class="fa-solid fa-right-from-bracket"></i>Logout</span></li>
                        </a>
                        <br> <br> <br> <br> <br>
                    </ul>
                </ul>
            </div>
        </nav>
    </div>
</div>

<div class="dashboard-wrapper">
    <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content">
            <div class="row">

                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="page-header">
                        <h2 class="pageheader-title ml-auto">Edit {{$dc->Office_Name}}'s Detail</h2>
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
                        <form method="post" action="{{ url('EditDoctorDetail',$dc->id) }}">
                            @csrf
                            <div class="card">
                                <h5 class="card-header">Edit {{$dc->Office_Name}}'s Details</h5>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label class="col-form-label">Dr. Office Name</label>
                                        <div class="input-group mb-3"><span class="input-group-prepend"><span
                                                    class="input-group-text"><i class="fa-solid fa-building"></i></span></span>
                                            <input type="text" required placeholder="User Name" name="name"
                                                class="form-control" value="{{$dc->Office_Name}}">
                                        </div>
                                        <span><small class="text-danger font-weight-light font-italic">
                                                @error('name')
                                                    {{ $message }}
                                                @enderror
                                            </small></span>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-form-label">Dr. Office Phone No</label>
                                        <div class="input-group mb-3"><span class="input-group-prepend"><span
                                                    class="input-group-text"><i class="fa-solid fa-square-phone"></i></span></span>
                                            <input type="number" min="1" required placeholder="Dr. Office Phone No" name="number"
                                                class="form-control" value="{{$dc->Phone_Num}}">
                                        </div>
                                        <span><small class="text-danger font-weight-light font-italic">
                                                @error('number')
                                                    {{ $message }}
                                                @enderror
                                            </small></span>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-form-label">Dr. Office Fax No</label>
                                        <div class="input-group mb-3"><span class="input-group-prepend"><span
                                                    class="input-group-text"><i class="fa-solid fa-fax"></i></span></span>
                                            <input type="text" required placeholder="Dr. Office Fax No"
                                                name="fax" class="form-control" value="{{$dc->Fax}}">
                                        </div>
                                        <span><small class="text-danger font-weight-light font-italic">
                                                @error('fax')
                                                    {{ $message }}
                                                @enderror
                                            </small></span>
                                    </div>

                                </div>

                                <div class="card-body border-top">
                                    <div class="form-group">
                                        <div class="input-group mb-3">
                                            <div class="input-group">
                                                <button type="submit" class="btn btn-block"
                                                    style="background-color: #427ed1; color: white;">Submit</button>
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
            logAction("Edit Doctor Page Loaded");
        });
    </script>
