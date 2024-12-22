@section('title', 'Purchase Order List')
@include('layout.Head')

<div class="dashboard-wrapper">
    <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2 class="pageheader-title">Purchase Order List</h2>
                        <a href="{{ url('purchaseOrderAdd',0) }}" class="btn btn-primary">Create New P.O.</a>
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
                                                <th class="border-0 text-center">PO.#</th>
                                                <th class="border-0 text-center">Vendor</th>
                                                <th class="border-0 text-center">Order Date</th>
                                                <th class="border-0 text-center">Shipping Address</th>
                                                <th class="border-0 text-center">Created By</th>
                                                <th class="border-0 text-center">P.O. Status</th>
                                                <th class="border-0 text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sno = 1;
                                            ?>
                                            @foreach ($PO as $user)
                                            <tr>
                                                <td class="text-center">{{ $sno++ }}</td>
                                                <td class="text-center">{{ $user->id }}</td>
                                                <td class="text-center">{{ $user->Vendor }}</td>
                                                <td class="text-center">{{ $user->date }}</td>
                                                <td class="text-center">{{ $user->Shipping_Address }}</td>
                                                <td class="text-center">{{ $user->Created_By }}</td>
                                                <td class="text-center">{{ $user->status }}</td>
                                                <td class="text-center">
                                                    <a href="{{ url('purchaseOrderAdd', $user->id) }}"
                                                        class="btn btn-sm btn-warning" data-toggle="tooltip"
                                                        data-placement="top" title=""
                                                        data-original-title="Edit {{ $user->Vendor }}"><i
                                                            class="fa fa-pen-to-square"></i></a>
                                                    <button data-url="{{ url('purchaseOrderDelete', $user->id) }}"
                                                        class="btn btn-sm btn-danger delete-btn"
                                                        data-toggle="tooltip" data-placement="top" title=""
                                                        data-original-title="Delete {{ $user->Vendor }}"><i
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
            logAction("Purchase Order List Page Loaded");
        });
    </script>
