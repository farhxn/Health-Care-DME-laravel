@section('title', 'Vendors List')
@include('layout.Head')

<div class="dashboard-wrapper">
    <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2 class="pageheader-title">Vendors</h2>
                        <a href="{{ url('AddVendor',0) }}" class="btn btn-primary">Add New Vendor Company</a>
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
                                            @foreach ($vendor as $user)
                                            <tr>
                                                <td class="text-center">{{ $sno++ }}</td>
                                                <td class="text-center">{{ $user->Vendor_Name }}</td>
                                                <td class="text-center">{{ $user->Address }}</td>
                                                <td class="text-center">{{ $user->City }}</td>
                                                <td class="text-center">{{ $user->State }}</td>
                                                <td class="text-center">{{ $user->Zip }}</td>
                                                <td class="text-center">{{ $user->Contact }}</td>
                                                <td class="text-center">
                                                    <a href="{{ url('AddVendor', $user->id) }}"
                                                        class="btn btn-sm btn-warning" data-toggle="tooltip"
                                                        data-placement="top" title=""
                                                        data-original-title="Edit {{ $user->Vendor_Name }}"><i
                                                            class="fa fa-pen-to-square"></i></a>
                                                    <button data-url="{{ url('DeleteVendor', $user->id) }}"
                                                        class="btn btn-sm btn-danger delete-btn"
                                                        data-toggle="tooltip" data-placement="top" title=""
                                                        data-original-title="Delete {{ $user->Vendor_Name }}'s "><i
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
            logAction("Vendors List Page Loaded");
        });
    </script>
