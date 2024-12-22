@section('title', 'Doctor List')
@include('layout.Head')
<div class="dashboard-wrapper">
    <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="page-header">
                        <h2 class="pageheader-title ml-auto">Doctors List</h2>
                        <div class="page-breadcrumb">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">

                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <div class="ecommerce-widget">

                <div class="row">
                    <div class="col">
                        <div class="card">
                            <h5></h5>
                            <div class="container card-header">

                            </div>
                            <br>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table display" id="myTable">
                                        <thead class="bg-light">
                                            <tr class="border-0">
                                                <th class="border-0">No.</th>
                                                <th class="border-0">Dr. Office Name</th>
                                                <th class="border-0">Dr. Office Phone No</th>
                                                <th class="border-0">Dr. Office Fax No</th>
                                                <th class="border-0">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sno = 1;
                                                                                                                                $userR = Session::get('LoginRole');
                                            $editPer = Session::get('LoginEdit');
                                            $deletePer = Session::get('LoginDelete');
                                            ?>
                                            @foreach ($doctor as $user)
                                                <tr >
                                                    <td>{{ $sno++ }}</td>
                                                    <td>{{ $user->Office_Name }}</td>
                                                    <td>{{ $user->Phone_Num }}</td>
                                                    <td>{{ $user->Fax }}</td>
                                                    <td>
                                                                                                            @if($userR =="2" || $editPer == "on" || $userR == "1" || $deletePer =="on")
                                                        <a href="{{ url('EditDoctor', $user->id) }}"
                                                            class="btn btn-sm btn-warning" data-toggle="tooltip"
                                                            data-placement="top" title=""
                                                            data-original-title="Edit {{ $user->Office_Name }}'s details"><i
                                                                class="fa fa-pen-to-square"></i></a>
                                                                @endif
                                                                                                                    @if($userR =="2" || $deletePer =="on" || $userR == "1")
                                                        <button data-url="{{ url('DeleteDoctor', $user->id) }}"
                                                            class="btn btn-sm btn-danger delete-btn"
                                                            data-toggle="tooltip" data-placement="top" title=""
                                                            data-original-title="Delete {{ $user->Office_Name }}'s account"><i
                                                                class="fa fa-trash"></i></button>
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
            logAction("Doctor List Page Loaded");
        });
    </script>
