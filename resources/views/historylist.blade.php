@section('title', 'Department List')
@include('layout.Head')

<div class="dashboard-wrapper">
    <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="page-header">
                        <h2 class="pageheader-title ml-auto">Work History</h2>
                        <div class="page-breadcrumb">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <!-- Breadcrumb content -->
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
                            <div class="card-header">
                                <h5>Filter by Date</h5>
                                <form id="filterForm">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <input type="date" id="startDate" class="form-control" placeholder="From Date">
                                        </div>
                                        <div class="col-md-3">
                                            <input type="date" id="endDate" class="form-control" placeholder="To Date">
                                        </div>
                                        <div class="col-md-2">
                                            <button type="button" class="btn btn-primary" onclick="filterByDate()">Filter</button>
                                        </div>
                                        <div class="col-md-2">
                                            <button type="button" class="btn btn-secondary" onclick="clearFilters()">Clear</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table display" id="myTable">
                                        <thead class="bg-light text-center">
                                            <tr class="border-0 text-center">
                                                <th class="border-0 text-center">No.</th>
                                                <th class="border-0 text-center">Patient First Name</th>
                                                <th class="border-0 text-center">Patient Last Name</th>
                                                <th class="border-0 text-center">DOB</th>
                                                <th class="border-0 text-center">Order Number</th>
                                                <th class="border-0 text-center">Account Number</th>
                                                <th class="border-0 text-center">Department</th>
                                                <th class="border-0 text-center">User</th>
                                                <th class="border-0 text-center">Status</th>
                                                <th class="border-0 text-center">PT MOVE DATE</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $sno = 1; @endphp
                                            @foreach ($his as $user)
                                                @php
                                                    $userName = \App\Models\Users::find($user->user);
                                                    $deptName = \App\Models\Departments::find($user->Dept);
                                                    $statusName = \App\Models\Status::find($user->status);
                                                @endphp
                                                <tr>
                                                    <td class="text-center">{{ $sno++ }}</td>
                                                    <td class="text-center">{{ $user->PtName }}</td>
                                                    <td class="text-center">{{ $user?->last_Name }}</td>
                                                    <td class="text-center">{{ $user->DOB }}</td>
                                                    <td class="text-center">{{ $user->order_num }}</td>
                                                    <td class="text-center">{{ $user->Acc_num }}</td>
                                                    <td class="text-center">{{ $deptName?->Department }}</td>
                                                    <td class="text-center">{{ $userName?->name }}</td>
                                                    <td class="text-center">{{ $statusName?->Status }}</td>
                                                    <td class="text-center">{{ $user->created_at->format('m/d/Y h:i:s A') }}</td>
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
</div>

@include('layout.footer')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        var table = $('#myTable').DataTable();

        window.filterByDate = function() {
            var startDate = $('#startDate').val();
            var endDate = $('#endDate').val();

            $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
                var moveDate = data[9]; // PT MOVE DATE column index (10th column, zero-based index is 9)
                if (moveDate) {
                    var date = new Date(moveDate);
                    var start = startDate ? new Date(startDate) : null;
                    var end = endDate ? new Date(endDate) : null;

                    if ((start === null && end === null) ||
                        (start === null && date <= end) ||
                        (start <= date && end === null) ||
                        (start <= date && date <= end)) {
                        return true;
                    }
                }
                return false;
            });
            table.draw();
            $.fn.dataTable.ext.search.pop();
        };

        window.clearFilters = function() {
            $('#startDate').val('');
            $('#endDate').val('');
            table.draw();
        };

        logAction("History List Page Loaded");
    });
</script>
