@section('title', 'Department List')
@include('layout.Head')

<div class="dashboard-wrapper">
    <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="page-header">
                        <h2 class="pageheader-title ml-auto">Department List</h2>
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
                                        <thead class="bg-light text-center">
                                            <tr class="border-0 text-center">
                                                <th class="border-0 text-center">No.</th>
                                                <th class="border-0 text-center">Department</th>
                                                <th class="border-0 text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sno = 1;
                                            ?>
                                            @foreach ($dept as $user)
                                                <tr >
                                                    <td class="text-center">{{ $sno++ }}</td>
                                                    <td class="text-center">{{ $user->Department }}</td>
                                                    <td class="text-center">
                                                        <a href="{{ url('EditDepartment', $user->id) }}"
                                                            class="btn btn-sm btn-warning" data-toggle="tooltip"
                                                            data-placement="top" title=""
                                                            data-original-title="Edit {{ $user->Department }}"><i
                                                                class="fa fa-pen-to-square"></i></a>
                                                        <button data-url="{{ url('DeleteDepartment', $user->id) }}"
                                                            class="btn btn-sm btn-danger delete-btn"
                                                            data-toggle="tooltip" data-placement="top" title=""
                                                            data-original-title="Delete {{ $user->Department }}'s Status"><i
                                                                class="fa fa-trash"></i></button>
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
            logAction("Department List Page Loaded");
        });
    </script>

