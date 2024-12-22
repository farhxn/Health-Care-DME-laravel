@section('title', 'Insurance Company List')
@include('layout.Head')

<div class="dashboard-wrapper">
    <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2 class="pageheader-title">Insurance Company</h2>
                        <a class="btn btn-primary" href="{{url('AddInsuranceCompany',0)}}">
                            Add New Insurance Company</a>
                    </div>
                </div>
            </div>
            <br>

            <div class="ecommerce-widget">
                <div class="row">
                    <div class="col">
                        <div class="card">
                            <br>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table display" id="myTable">
                                        <thead class="bg-light text-center">
                                            <tr class="border-0 text-center">
                                                <th class="border-0 text-center">No.</th>
                                                <th class="border-0 text-center">Name</th>
                                                <th class="border-0 text-center">Address</th>
                                                <th class="border-0 text-center">City</th>
                                                <th class="border-0 text-center">State</th>
                                                <th class="border-0 text-center">ZIP</th>
                                                <th class="border-0 text-center">Contact</th>
                                                <th class="border-0 text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sno = 1;
                                            ?>
                                            @foreach ($insurance as $user)
                                            <tr>
                                                <td class="text-center">{{ $sno++ }}</td>
                                                <td class="text-center">{{ $user->Name }}</td>
                                                <td class="text-center">{{ $user->address }}</td>
                                                <td class="text-center">{{ $user->Name }}</td>
                                                <td class="text-center">{{ $user->Name }}</td>
                                                <td class="text-center">{{ $user->Name }}</td>
                                                <td class="text-center">{{ $user->ContactName }}</td>
                                                <td class="text-center">
                                                    <a href="{{ url('AddInsuranceCompany', $user->id) }}"
                                                        class="btn btn-sm btn-warning" data-toggle="tooltip"
                                                        data-placement="top" title=""
                                                        data-original-title="Edit {{ $user->Name }}"><i
                                                            class="fa fa-pen-to-square"></i></a>
                                                    <button data-url="{{ url('DeleteInsuranceCompany', $user->id) }}"
                                                        class="btn btn-sm btn-danger delete-btn"
                                                        data-toggle="tooltip" data-placement="top" title=""
                                                        data-original-title="Delete {{ $user->Name }}'s "><i
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
            logAction("Insurance Company List Page Loaded");
        });
    </script>
