@section('title', 'Sub Department Patient List')
@include('layout.Head')

<div class="dashboard-wrapper">
    <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="page-header">
                        <h2 class="pageheader-title ml-auto">Resupply Department / {{$subDeptName}}</h2>
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
                    $currentUserRole = $users->role; // This should be set based on your authentication system
                    $deptIds = $currentUserRole < 1 && $users->Dept ? json_decode($users->Dept, true) : [];
                        @endphp

                        @foreach ($dp as $dps)
                        @php
                        $deptCount = 0;
                        @endphp
                        @foreach ($apt as $pt)
                        @if ($dps->id == $pt->Dept)
                        @php
                        $deptCount++;
                        @endphp
                        @endif
                        @endforeach
                        @if($currentUserRole == 0 && in_array($dps->id, $deptIds))
                        <div class="col p-2">
                            <a href="{{ url('DepartPatient', $dps->id) }}" class="btn btn-block" style="background-color: #427ed1; color: white;">
                    {{ $dps->Department }} ( {{$deptCount}} )
                            </a>
                        </div>
                        @endif
                        @if($currentUserRole == 1 || $currentUserRole == 2)
                    
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
                            <div class="container card-header">
                                <div class="row">
                                    <div class="col">
                                        <a href="{{url('subDept','Incontinence')}}" class="btn btn-block btn-sm p-2" style="background-color: #427ed1; color: white;">Incontinence</a>
                                    </div>
                                    <div class="col">
                                        <a href="{{url('subDept','Wound Care')}}"class="btn btn-block btn-sm p-2" style="background-color: #427ed1; color: white;">Wound Care</a>
                                    </div>
                                    <div class="col">
                                        <a href="{{url('subDept','Diabetic')}}"class="btn btn-block btn-sm p-2" style="background-color: #427ed1; color: white;">Diabetic</a>
                                    </div>
                                    <div class="col">
                                        <a href="{{url('subDept','CGM')}}"class="btn btn-block btn-sm p-2" style="background-color: #427ed1; color: white;">CGM</a>
                                    </div>
                                </div>

                                <br>
                                <form class="form-inline mr-auto" action="{{ url('/FilterPatient') }}" method="get">
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
                                        <div class="col p-2">
                                            @foreach ($drs as $pt)
                                            <input type="hidden" name="dept" value="{{ $pt->Dept }}">
                                            @endforeach
                                            <button type="submit" class="btn btn-block btn-sm p-2" style="background-color: #427ed1; color: white;">Apply Filter</button>
                                        </div>
                                </form>
                                &nbsp; <div class="col p-2">
                                    @php
                                    $rspcount = 0;
                                    $flpcount = 0;
                                    use Carbon\Carbon;
                                    @endphp
                                    @foreach ($drs as $pti)
                                    @php
                                    $statusName = \App\Models\Status::find($pti->Order_Status);
                                    //Counting Resupply Items
                                    @endphp
                                    @if (str_contains(strtolower($statusName->Status), 'resupply') && Carbon::parse($pti->resupplyDate)->isTomorrow())
                                    @php
                                    $rspcount++;
                                    @endphp
                                    @endif
                                    @if (!str_contains(strtolower($statusName->Status), 'completed') && $pti->updated_at->diffInHours(\Carbon\Carbon::now()) >= 24)
                                    @php
                                    //Counting FollowUps
                                    $flpcount++;
                                    @endphp
                                    @endif
                                    @endforeach
                                    <a href="{{ url('ResupplyPatient',$subDeptName) }}" class="btn btn-block btn-sm p-2" style="background-color: #427ed1; color: white;">Resupply&nbsp;<span class="badge badge-light">( {{ $rspcount }} )</span> </a>
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
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sno = 1;
                                                                                    $userR = Session::get('LoginRole');
                                        ?>
                                        @foreach ($subpat as $pt)
                                        @php
                                                                                    $drName = \App\Models\Doctors::find($pt?->Off_Name);
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
                                                <td>{{ $drName->Office_Name }}</td>
                                            <td>{{ $pt->listed }}</td>
                                            <td>{{ $deptName?->Department }}</td>
                                            <td>{{ $userName?->name }}</td>
                                            <td>{{ $statusName->Status }}
                                            </td>
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
            logAction("Resupplies Sub Department patient List Page Loaded");
        });
    </script>
