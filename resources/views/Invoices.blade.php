@section('title', 'Invoices List')
@include('layout.Head')

<div class="dashboard-wrapper">
    <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2 class="pageheader-title">Invoices</h2>
                        <!-- <a href="{{ url('#') }}" class="btn btn-primary">Add New Manufacturers</a> -->
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
                                                <th class="border-0 text-center">Invoice&nbsp;#</th>
                                                <th class="border-0 text-center">Patient&nbsp;Name</th>
                                                <th class="border-0 text-center">Item</th>
                                                <th class="border-0 text-center">DOB</th>
                                                <th class="border-0 text-center">Account</th>
                                                <th class="border-0 text-center">Order&nbsp;Date</th>
                                                <th class="border-0 text-center">Invoice&nbsp;Date</th>
                                                <th class="border-0 text-center">Payer</th>
                                                <th class="border-0 text-center">Ins&nbsp;Co</th>
                                                <th class="border-0 text-center">Created&nbsp;By</th>
                                                <th class="border-0 text-center">Invoice&nbsp;Status</th>
                                                <!-- <th class="border-0 text-center">Action</th> -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sno = 1;
                                            $OrderIds = $invoice->pluck('OrderID')->filter()->unique();

                                            $orders = \App\Models\Orders::whereIn('id', $OrderIds)
                                                ->get(['id', 'Patient_Name', 'Patient_Last_Name', 'Patient_DOB', 'Account', 'created_at', 'Items'])->keyBy('id');

                                            $itemsIds = $orders->pluck('Items')->filter()->unique();
                                            $orderItems = \App\Models\OrderItems::whereIn('uniqueOrderId', $itemsIds)
                                                ->get()
                                                ->groupBy('uniqueOrderId')
                                                ->map(function ($group) {
                                                    return $group->pluck('item');
                                                });

                                            $patientIds = $invoice->pluck('PatientID')->filter()->unique();
                                            $insuranceCompanies = \App\Models\PatientInsurance::whereIn('PatientID', $patientIds)
                                                ->orderBy('created_at', 'desc')
                                                ->get()
                                                ->groupBy('PatientID')
                                                ->map(function ($insurances) {
                                                    return [
                                                        'ins1' => $insurances->get(0)->Company ?? null,
                                                        'ins2' => $insurances->get(1)->Company ?? null,
                                                        'ins3' => $insurances->get(2)->Company ?? null,
                                                        'ins4' => $insurances->get(3)->Company ?? null,
                                                    ];
                                                });

                                            $items = $invoice->pluck('Item')->filter()->unique();
                                            $Item_Name = \App\Models\Inventory::whereIn('id', $items)->pluck('Item_Name', 'id');
                                            ?>

                                            @foreach ($invoice as $user)

                                            <?php
                                            $order = $orders->get($user->OrderID);
                                            $orderitem  = $order ? $orderItems->get($order->Items, collect()) : collect();
                                            $insuranceType = 'Patient';
                                            $insuranceCompany = 'N/A';
                                            $itemName = $Item_Name->get($user?->Item);


                                            if ($user->ins1) {
                                                $insuranceType = 'ins1';
                                                $insuranceCompany = $insuranceCompanies->get($user->PatientID)['ins1'] ?? 'N/A';
                                            } elseif ($user->ins2) {
                                                $insuranceType = 'ins2';
                                                $insuranceCompany = $insuranceCompanies->get($user->PatientID)['ins2'] ?? 'N/A';
                                            } elseif ($user->ins3) {
                                                $insuranceType = 'ins3';
                                                $insuranceCompany = $insuranceCompanies->get($user->PatientID)['ins3'] ?? 'N/A';
                                            } elseif ($user->ins4) {
                                                $insuranceType = 'ins4';
                                                $insuranceCompany = $insuranceCompanies->get($user->PatientID)['ins4'] ?? 'N/A';
                                            }
                                            ?>

                                            <tr onclick="window.location.href='/InvoiceDetail/{{ $user->id }}';" style="cursor: pointer;"
                                                data-toggle="tooltip"
                                                data-placement="top"
                                                title="Show {{ $order?->Patient_Name. ' '.$order?->Patient_Last_Name ?? 'N/A' }}'s invoice details">
                                                <td class="text-center">{{ $sno++ }}</td>
                                                <td class="text-center">{{ $user?->id ?? 'N/A' }}</td>
                                                <td class="text-center">{{ $order?->Patient_Name. ' '.$order?->Patient_Last_Name ?? 'N/A' }}</td>
                                                <td class="text-center">
                                                    {{ $itemName }}
                                                </td>
                                                <td class="text-center">{{ $order?->Patient_DOB }}</td>
                                                <td class="text-center">{{ $order?->Account ?? 'N/A' }}</td>
                                                <td class="text-center">{{ $order?->created_at->format('m/d/Y') }}</td>
                                                <td class="text-center">{{ $user->created_at->format('m/d/Y') }}</td>
                                                <td class="text-center">
                                                    {{ $insuranceType }}
                                                </td>
                                                <td class="text-center">{{ $insuranceCompany }}</td>
                                                <td class="text-center">{{ $user->Created }}</td>
                                                <td class="text-center">{{ $user->Status }}</td>
                                                <!-- <td class="text-center">
                                                    <a href="{{ url('EditStatus', $user->id) }}" class="btn btn-sm btn-warning" data-toggle="tooltip"
                                                        data-placement="top" title="Edit {{ $user->Status }}">
                                                        <i class="fa fa-pen-to-square"></i>
                                                    </a>
                                                    <button data-url="{{ url('DeleteStatus', $user->id) }}" class="btn btn-sm btn-danger delete-btn"
                                                        data-toggle="tooltip" data-placement="top" title="Delete {{ $user->Status }}'s Status">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </td> -->
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
            logAction("Invoices List Page Loaded");
        });
    </script>
