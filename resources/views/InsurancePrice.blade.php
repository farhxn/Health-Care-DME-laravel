@section('title', 'Insurance Price Code List')
@include('layout.Head')

<div class="dashboard-wrapper">
    <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2 class="pageheader-title">Insurance Price Code</h2>
                        <a href="{{ url('inventoryItemAdd') }}" class="btn btn-primary">Add New Price Code</a>
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
                                                <th class="border-0 text-center">ID</th>
                                                <th class="border-0 text-center">Inventory&nbsp;Item</th>
                                                <th class="border-0 text-center">Insurance&nbsp;Name</th>
                                                <th class="border-0 text-center">Insurance Price</th>
                                                <th class="border-0 text-center">Billing&nbsp;Code</th>
                                                <th class="border-0 text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sno = 1;
                                            ?>
                                            @foreach ($st as $user)
                                            <tr>
                                                <td class="text-center">{{ $sno++ }}</td>
                                                <td class="text-center">{{ $user->Status }}</td>
                                                <td class="text-center">{{ $user->Status }}</td>
                                                <td class="text-center">{{ $user->Status }}</td>
                                                <td class="text-center">{{ $user->Status }}</td>
                                                <td class="text-center">{{ $user->Status }}</td>
                                                <td class="text-center">
                                                    <a href="{{ url('EditStatus', $user->id) }}"
                                                        class="btn btn-sm btn-warning" data-toggle="tooltip"
                                                        data-placement="top" title=""
                                                        data-original-title="Edit {{ $user->Status }}"><i
                                                            class="fa fa-pen-to-square"></i></a>
                                                    <button data-url="{{ url('DeleteStatus', $user->id) }}"
                                                        class="btn btn-sm btn-danger delete-btn"
                                                        data-toggle="tooltip" data-placement="top" title=""
                                                        data-original-title="Delete {{ $user->Status }}'s Status"><i
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
            logAction("Insurance Price Code List Page Loaded");
        });
    </script>
