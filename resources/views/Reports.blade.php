@section('title', 'Reports Page')
@include('layout.Head')

<div class="dashboard-wrapper">
    <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-center m-3">

                        <h2 class="pageheader-title">Reports </h2>
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
                                                <th class="border-0 text-center">NAME</th>
                                                <th class="border-0 text-center">Generate</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <tr>
                                                <td class="text-center">1</td>
                                                <td class="text-center">Invoice</td>
                                                <td class="text-center">
                                                    <!-- <button type="button" class="btn btn-primary" id="generateReportBtn">Generate Report</button> -->
                                                    <a href="{{url('invoiceRPT')}}" class="btn btn-primary">Generate Report </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">2</td>
                                                <td class="text-center">CMN / RX</td>
                                                <td class="text-center">
                                                    <a href="{{url('RXRPT')}}" class="btn btn-primary">Generate Report </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">3</td>
                                                <td class="text-center">Missing Documents</td>
                                                <td class="text-center">
                                                    <a href="{{url('missingDocumentsRPT')}}" class="btn btn-primary">Generate Report </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">4</td>
                                                <td class="text-center">User Daily WorK</td>
                                                <td class="text-center">
                                                    <a href="{{url('UserDailyWorkRPT')}}" class="btn btn-primary">Generate Report </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">5</td>
                                                <td class="text-center">Insurance</td>
                                                <td class="text-center">
                                                    <a href="{{url('InsuranceRPT')}}" class="btn btn-primary">Generate Report </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">6</td>
                                                <td class="text-center">Inventory Items</td>
                                                <td class="text-center">
                                                    <a href="{{url('InventoryRPT')}}" class="btn btn-primary">Generate Report </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">7</td>
                                                <td class="text-center">Orders</td>
                                                <td class="text-center">
                                                    <a href="{{url('orderRPT')}}" class="btn btn-primary">Generate Report </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">8</td>
                                                <td class="text-center">Insurance Claims Denial</td>
                                                <td class="text-center">
                                                    <a href="{{url('InsuranceClaimsDenialRPT')}}" class="btn btn-primary">Generate Report </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">9</td>
                                                <td class="text-center">Insurance Claims Successfully Received</td>
                                                <td class="text-center">
                                                    <a href="{{url('InsuranceClaimsSuccessfullyReceivedRPT')}}" class="btn btn-primary">Generate Report </a>
                                                </td>
                                            </tr>
<tr>
                                                <td class="text-center">10</td>
                                                <td class="text-center">InsuranceClaimRPT</td>
                                                <td class="text-center">
                                                    <a href="{{url('InsuranceClaimRPT')}}" class="btn btn-primary">Generate Report </a>
                                                </td>
                                            </tr>


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
            logAction("Reports List Page Loaded");

            $('#generateReportBtn').on('click', function() {
                $('#generateReportModal').modal('show');
            });

            $('#patientBtn').on('click', function() {
                $('#patientDropdown').show();
            });

            $('#insuranceBtn').on('click', function() {
                $('#patientDropdown').hide();
                window.location.href = '/insuranceReport';
            });

        });
    </script>
