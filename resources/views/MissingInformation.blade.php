@section('title', 'Missing Information')
@include('layout.Head')

<div class="dashboard-wrapper">
    <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2 class="pageheader-title">Missing Information</h2>
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
                                                <th class="border-0 text-center">Patient&nbsp;Name</th>
                                                <th class="border-0 text-center">Order&nbsp;#</th>
                                                <th class="border-0 text-center">Line&nbsp;Item#</th>
                                                <th class="border-0 text-center">Sale/Rent&nbsp;Type</th>
                                                <th class="border-0 text-center">Billing&nbsp;Code</th>
                                                <th class="border-0 text-center">Inventory&nbsp;Item</th>
                                                <th class="border-0 text-center">Price&nbsp;Code</th>
                                                <th class="border-0 text-center">Payers</th>
                                                <th class="border-0 text-center">Status</th>
                                                <th class="border-0 text-center">Summary</th>
                                                {{-- <th class="border-0 text-center">Missing Details</th> --}}
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sno = 1;
                                            $patientIds = $missingDetails->pluck('PatientID')->filter()->unique();
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
                                            ?>
                                            @foreach ($missingDetails as $detail)
                                            <?php
                                            $insuranceType = 'Patient';
                                            $insuranceCompany = 'N/A';
                                            if ($detail['ins1']) {
                                                $insuranceType = 'ins1';
                                                $insuranceCompany = $insuranceCompanies->get($detail['PatientID'])['ins1'] ?? 'N/A';
                                            } elseif ($detail['ins2']) {
                                                $insuranceType = 'ins2';
                                                $insuranceCompany = $insuranceCompanies->get($detail['PatientID'])['ins2'] ?? 'N/A';
                                            } elseif ($detail['ins3']) {
                                                $insuranceType = 'ins3';
                                                $insuranceCompany = $insuranceCompanies->get($detail['PatientID'])['ins3'] ?? 'N/A';
                                            } elseif ($detail['ins4']) {
                                                $insuranceType = 'ins4';
                                                $insuranceCompany = $insuranceCompanies->get($detail['PatientID'])['ins4'] ?? 'N/A';
                                            }

                                            ?>
                                            <tr>
                                                <td class="text-center">{{$detail['patient_name']}}</td>
                                                <td class="text-center">{{$detail['order_id']}}</td>
                                                <td class="text-center">{{$detail['order_id']}}</td>
                                                <td class="text-center">{{$detail['RentalType']}}</td>
                                                <td class="text-center">{{$detail['billing_code']}}</td>
                                                <td class="text-center">{{$detail['item']}}</td>
                                                <td class="text-center">{{$detail['priceCode']}}</td>
                                                <td class="text-center">{{$insuranceType}}</td>
                                                <td class="text-center">{{$detail['status']}}</td>
                                                <td class="text-center">{{$detail['summary']}}</td>
                                                {{-- <td class="text-center">{{$detail['summary']}}</td> --}}
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
            logAction("Missing Information Page Loaded");
        });
    </script>