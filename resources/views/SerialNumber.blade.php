@section('title', 'Inventory Item Serial Numbers')
@include('layout.Head')

<div class="dashboard-wrapper">
    <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-center m-3">
                        <!-- Heading aligned to the left -->
                        <h2 class="pageheader-title">Serial Number.</h2>
                        <a href="{{url('AddSerialNumber',0)}}" class="btn btn-primary">Add Serial Number</a>
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
                                                <th class="border-0 text-center">Item</th>
                                                <th class="border-0 text-center">Item Name</th>
                                                <th class="border-0 text-center">Manufacturer </th>
                                                <th class="border-0 text-center">Inv Code </th>
                                                <th class="border-0 text-center">Model Number </th>
                                                <th class="border-0 text-center">Vendor </th>
                                                <th class="border-0 text-center">Serial Number </th>
                                                <th class="border-0 text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sno = 1;
                                            ?>
                                            @foreach ($serial as $user)
                                            <tr>
                                                <td class="text-center">{{ $sno++ }}</td>
                                                <td class="text-center">{{ $user->InventoryCode }}</td>
                                                <td class="text-center">{{ $user->InventoryCode }}</td>
                                                <td class="text-center">{{ $user->Manufacturer }}</td>
                                                <td class="text-center">{{ $user->InventoryCode }}</td>
                                                <td class="text-center">{{ $user->Model }}</td>
                                                <td class="text-center">{{ $user->Vendor }}</td>
                                                <td class="text-center">{{ $user->SerialNumber }}</td>
                                                <td class="text-center">
                                                    <a href="{{ url('AddSerialNumber', $user->id) }}"
                                                        class="btn btn-sm btn-warning" data-toggle="tooltip"
                                                        data-placement="top" title=""
                                                        data-original-title="Edit {{ $user->InventoryCode }}"><i
                                                            class="fa fa-pen-to-square"></i></a>
                                                    <button data-url="{{ url('DeleteSerialNumber', $user->id) }}"
                                                        class="btn btn-sm btn-danger delete-btn"
                                                        data-toggle="tooltip" data-placement="top" title=""
                                                        data-original-title="Delete {{ $user->InventoryCode }}"><i
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
            logAction("Status wise patient List Page Loaded");
        });
    </script>
