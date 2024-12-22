@section('title', 'Inventory Item List')
@include('layout.Head')

<div class="dashboard-wrapper">
    <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2 class="pageheader-title">Inventory Item List</h2>
                        <a href="{{ url('inventoryItemAdd',0) }}" class="btn btn-primary">Add New Inventory</a>
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
                                                <th class="border-0 text-center">Item #</th>
                                                <th class="border-0 text-center">Item&nbsp;Name</th>
                                                <th class="border-0 text-center">Manufacturer</th>
                                                <th class="border-0 text-center">Inv&nbsp;Code</th>
                                                <th class="border-0 text-center">Model&nbsp;Number</th>
                                                <th class="border-0 text-center">Vendor</th>
                                                <th class="border-0 text-center">In-Stock</th>
                                                <th class="border-0 text-center">Sold</th>
                                                <th class="border-0 text-center">On-Rental</th>
                                                <th class="border-0 text-center">On&nbsp;Backorder</th>
                                                <th class="border-0 text-center">Warehouse</th>
                                                <th class="border-0 text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $vendorIds = $inventory->pluck('Vendor')->filter()->unique();
                                            $vendors = \App\Models\Vendor::whereIn('id', $vendorIds)->pluck('Vendor_Name', 'id');
                                            $sno = 1;
                                            ?>
                                            @foreach ($inventory as $user)
                                            <?php
                                            $vendorName = $vendors->get($user?->Vendor);
                                            ?>
                                            <tr>
                                                <td class="text-center">{{ $sno++ }}</td>
                                                <td class="text-center">{{ $user->id }}</td>
                                                <td class="text-center">{{ $user->Item_Name }}</td>
                                                <td class="text-center">{{ $user->Manufacturer }}</td>
                                                <td class="text-center">{{ $user->Inv_Code }}</td>
                                                <td class="text-center">{{ $user->Model }}</td>
                                                <td class="text-center">{{ $vendorName }}</td>
                                                <td class="text-center">{{ $user->InStockQty }}</td>
                                                <td class="text-center">{{ $user->Sold }}</td>
                                                <td class="text-center">{{ $user->Rental}}</td>
                                                <td class="text-center">{{ $user->Backorder }}</td>
                                                <td class="text-center">
                                                    @if($user->warehouse)
                                                    @php
                                                    $warehouse = json_decode($user->warehouse, true);
                                                    @endphp
                                                    @if(is_array($warehouse) && !empty($warehouse))
                                                    <ol>
                                                        @foreach ($warehouse as $ware)
                                                        <li>{{ $ware }}</li>
                                                        @endforeach
                                                    </ol>
                                                    @endif
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    <a href="{{ url('inventoryItemAdd', $user->id) }}"
                                                        class="btn btn-sm btn-warning" data-toggle="tooltip"
                                                        data-placement="top" title=""
                                                        data-original-title="Edit {{ $user->Item_Name }}"><i
                                                            class="fa fa-pen-to-square"></i></a>
                                                    <button data-url="{{ url('DeleteInventoryItem', $user->id) }}"
                                                        class="btn btn-sm btn-danger delete-btn"
                                                        data-toggle="tooltip" data-placement="top" title=""
                                                        data-original-title="Delete {{ $user->Item_Name }}"><i
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
            logAction("Inventory List Page Loaded");
        });
    </script>