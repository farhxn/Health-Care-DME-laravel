@section('title', 'Orders List')
@include('layout.Head')

<div class="dashboard-wrapper">
    <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="page-header">
                        <h2 class="pageheader-title ml-auto">Orders </h2>
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

                            <br>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                <table class="table display" id="myTable">
                                        <thead class="bg-light">
                                            <tr class="border-0">
                                                <th class="border-0">No.</th>
                                                <th class="border-0">Order#</th>
                                                <th class="border-0">Patient&nbsp;Name</th>
                                                <th class="border-0">Item</th>
                                                <th class="border-0">DOB</th>
                                                <th class="border-0">Account</th>
                                                <th class="border-0">Order&nbsp;Date</th>
                                                <th class="border-0">Created&nbsp;By</th>
                                                <th class="border-0">Department</th>
                                                <th class="border-0">Status</th>
                                                <th class="border-0">Action</th>
                                            </tr>

                                        </thead>
                                        <tbody id="patient-table-body">
                                            <?php
                                            $sno = 1;
                                            $statusIds = $order->pluck('OrderStatus')->filter()->unique();
                                            $itemsIds = $order->pluck('Items')->filter()->unique();
                                            $deptIds = $order->pluck('Department')->filter()->unique();

                                            $departments = \App\Models\Departments::whereIn('id', $deptIds)->pluck('Department', 'id');
                                            $status = \App\Models\Status::whereIn('id', $statusIds)->pluck('Status', 'id');

                                            $items = \App\Models\OrderItems::whereIn('uniqueOrderId', $itemsIds)->get()->groupBy('uniqueOrderId')
                                                ->map(function ($group) {
                                                    return $group->pluck('item');
                                                });

                                            ?>

                                            @foreach ($order as $pt)
                                            <?php
                                            $orderItems = $items->get($pt?->Items) ?? [];
                                            $statusName = $status->get($pt?->OrderStatus);
                                            $deptName = $departments->get($pt?->Department);
                                            ?>

                                            <tr onclick="window.location.href='/AddOrders/{{ $pt->id }}/1';"
                                                style="cursor: pointer;"
                                                data-toggle="tooltip"
                                                data-placement="top"
                                                title="Show {{ $pt->Patient_Name }}'s order details">

                                                <td>{{ $sno++ }}</td>
                                                <td>{{ $pt->id }}</td>
                                                <td>{{ $pt->Patient_Name.' '. $pt->Patient_Last_Name }}</td>
                                                <td>
                                                    @foreach ($orderItems as $itemName)
                                                    <li>{{ $itemName }}</li>
                                                    @endforeach
                                                </td>
                                                <td>{{ $pt->Patient_DOB }}</td>
                                                <td>{{ $pt->Account }}</td>
                                                <td>{{ $pt->created_at->format('m/d/Y') }}</td>
                                                <td>{{ $pt->CreatedBy }}</td>
                                                <td>{{ $deptName }}</td>
                                                <td>{{ $statusName }}</td>
                                                <td class="text-center">
                                                    <div style="display: flex; justify-content: center; align-items: center;">
                                                        <a href="/AddOrders/{{ $pt->Patient_ID }}/{{ $pt->id }}" class="btn btn-sm btn-warning" style="padding: 0.25rem 0.5rem; font-size: 0.875rem; line-height: 1.5;" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit {{ $pt->Patient_Name.' '. $pt->Patient_Last_Name }}'s order Details"><i class="fa fa-pen-to-square"></i></a>
                                                        <a href="/AddOrders/{{ $pt->id }}/1" class="btn btn-sm btn-success" style="padding: 0.25rem 0.5rem; font-size: 0.875rem; line-height: 1.5;" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit {{ $pt->Patient_Name.' '. $pt->Patient_Last_Name }}'s order Details"><i class="fa fa-eye"></i></a>
                                                        <button data-url="{{ url('DeleteOrders', $pt->id) }}" style="padding: 0.25rem 0.5rem; font-size: 0.875rem; line-height: 1.5;" class="btn btn-danger delete-btn" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete {{ $pt->Patient_Name.' '. $pt->Patient_Last_Name }}'s Order">
                                                            <i class="fa fa-trash"></i>
                                                        </button>

                                                    </div>
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

            function rowClickHandler(url) {
                console.log(url);
                window.location.href = url;
            }

            logAction("Patient List Page Loaded");
        });
    </script>
    <script>
        $(document).ready(function() {
            $(".column-search").on("keyup", function() {
                var columnNumber = $(this).data("column");
                var searchTerm = $(this).val().toLowerCase();

                $("#myTable tbody tr").filter(function() {
                    $(this).toggle($(this).children("td").eq(columnNumber).text().toLowerCase().indexOf(searchTerm) > -1)
                });
            });
        });
    </script>
