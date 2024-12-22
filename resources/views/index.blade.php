@section('title', 'Home')
@include('layout.Head')
@php
$userR = Session::get('LoginRole');

$allpt = $viewPatients;
@endphp

<div class="dashboard-wrapper">
    <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="page-header">
                        <h2 class="pageheader-title ml-auto">Dashboard </h2>
                        <div class="page-breadcrumb">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <!-- <li class="breadcrumb-item">
                        <a href="#" class="breadcrumb-link">Dashboard</a>
                      </li>
                      <li class="breadcrumb-item active" aria-current="page">
                        Home
                      </li> -->
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <div class="ecommerce-widget">

                <div class="row">
                    @php
                    $currentUserRole = $currentUser->role;
                    $deptJson = json_decode($currentUser->Dept, true);
                    $deptIds = $currentUserRole < 1 && $deptJson && is_array($deptJson) ? array_map('intval', $deptJson) : [];

                        $userView=Session::get('LoginViewCheck');
                        $userViewDept=Session::get('LoginViewDept');
                        $viewDeptJson=json_decode($userViewDept, true);
                        $viewdeptIds=$currentUserRole < 1 && $viewDeptJson && is_array($viewDeptJson) ? array_map('intval', $viewDeptJson) : [];

                        $patientCounts=$drs->filter(function ($patient) {
                        return $patient->Order_Status != 17;
                        })->reduce(function ($counts, $patient) {
                        $counts[$patient->Dept] = ($counts[$patient->Dept] ?? 0) + 1;
                        return $counts;
                        }, []);

                        $viewPatientCounts = $allpt->filter(function ($patient) {
                        return $patient->Order_Status != 17;
                        })->reduce(function ($counts, $patient) {
                        $counts[$patient->Dept] = ($counts[$patient->Dept] ?? 0) + 1;
                        return $counts;
                        }, []);

                        $graphData = [];
                        $redirectUrls = [];

                        @endphp

                        @foreach ($departments as $dps)
                        @php
                        $useViewCount = $userView == 'on' && in_array($dps->id, $viewdeptIds);
                        $deptCount = $useViewCount ? ($viewPatientCounts[$dps->id] ?? 0) : ($patientCounts[$dps->id] ?? 0);

                        if (($currentUserRole == 0 && in_array($dps->id, $deptIds)) || $currentUserRole >= 1 || $useViewCount) {
                        $graphData[] = ['name' => $dps->Department, 'count' => $deptCount, 'url' => url('DepartPatient', $dps->id)];
                        }
                        @endphp
                        @endforeach

                        <div class="col" style="background-color: #fff; margin: 2px;">
                            <canvas id="barChart"></canvas>

                        </div>
                        <div class="col" style="background-color: #fff;  margin: 2px;">
                            <!-- <div class="card">
                                <h5 class="card-header">Bar Chart</h5>
                                <div class="card-body"> -->
                            <canvas id="doughnutChart"></canvas>
                            <!-- </div> -->
                        </div>
                </div>


            </div>



            <br><br>


            <div class="row">
                <div class="col">
                    <div class="card">
                        <h5></h5>
                        <div class="container card-header">
                            <div class="row">


                                <div class="col p-2">
                                    @php
                                    use Carbon\Carbon;

                                    $twentyFourHoursAgo = Carbon::now()->subHours(24);
                                    $rspcount = 0;
                                    $flpcount = 0;
                                    $completedCount = 0;

                                    // Preload all necessary statuses in one query
                                    $statusIds = $drs->pluck('Order_Status')->unique();
                                    $statuses = \App\Models\Status::whereIn('id', $statusIds)->pluck('Status', 'id');

                                    // Iterate over the data and count
                                    foreach ($drs as $pti) {
                                    $statusName = $statuses[$pti->Order_Status] ?? 'Unknown Status';

                                    // Resupply count logic
                                    if (str_contains(strtolower($statusName), 'resupply') && $pti->resupplyDate) {
                                    $resupplyDate = Carbon::parse($pti->resupplyDate);
                                    if ($resupplyDate->isTomorrow() || $resupplyDate->lessThanOrEqualTo(now())) {
                                    $rspcount++;
                                    }
                                    }

                                    // Follow-up count logic
                                    if ($pti->updated_at->lessThanOrEqualTo($twentyFourHoursAgo) && !in_array($pti->Order_Status, [17, 18, 16, 5, 28])) {
                                    $flpcount++;
                                    }

                                    // Completed count logic
                                    if (str_contains(strtolower($statusName), 'completed') && $pti->updated_at->lessThanOrEqualTo($twentyFourHoursAgo)) {
                                    $completedCount++;
                                    }
                                    }
                                    @endphp



                                    <a href="{{ url('ResupplyPatient',0) }}" class="btn btn-block btn-sm p-2" style="background-color: #427ed1; color: white;">Resupply&nbsp;<span class="badge badge-light">( {{ $rspcount }} )</span> </a>
                                </div>
                                &nbsp;
                                <div class="col p-2">
                                    <a href="{{ url('followUpPatient',0) }}" class="btn btn-block btn-sm p-2" style="background-color: #427ed1; color: white;">FollowUp&nbsp;<span class="badge badge-light">( {{ $flpcount }} )</span> </a>
                                </div>
                                &nbsp;
                                @if($userR =="2")
                                <div class="col p-2">
                                    <button type="button" data-toggle="modal" data-target="#PatientReport" class="btn btn-primary btn-block p-2" style="background-color: #427ed1; color: white;">Export Patients Report</button>
                                </div>
                                &nbsp;
                                <div class="col p-2">
                                    <button type="button" data-toggle="modal" data-target="#dateRangeModal" class="btn btn-primary btn-block p-2" style="background-color: #427ed1; color: white;">Export Report</button>
                                </div>
                                @endif
                                &nbsp;
                                <div class="col p-2">
                                    <a href="{{ url('Reminders') }}" class="btn btn-block btn-sm p-2" style="background-color: #427ed1; color: white;">Reminders</a>
                                </div>
                            </div>
                            <br>
                        </div>
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

                                        <tr onclick="window.location.href='/PatientDetail/{{ $pt->Patient_ID }}';"
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

@php
$barGraphData = $st->map(function ($sts) use ($drs) {
$count = $drs->filter(fn($pt) => $sts->id == $pt->Order_Status)->count();
return [
'name' => $sts->Status,
'count' => $count,
'url' => url('StatusPatient', $sts->id),
];
})->values();
@endphp


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<script>
    $(document).ready(function() {
        var table = $('#myTable').DataTable();
        logAction("Home Page Loaded");

    });


    document.addEventListener('DOMContentLoaded', function() {
        const graphData = @json($graphData);
        const barGraphData = @json($barGraphData);

        // Extract data for charts
        const departmentNames = graphData.map(item => item.name);
        const departmentCounts = graphData.map(item => item.count);
        const redirectUrls = graphData.map(item => item.url);

        //bar graph
        const statusNames = barGraphData.map(item => item.name);
        const statusCounts = barGraphData.map(item => item.count);
        const statusRedirectUrls = barGraphData.map(item => item.url);


        const colors = [
            '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0',
            '#9966FF', '#FF9F40', '#2ECC71', '#F39C12',
            '#E74C3C', '#8E44AD'
        ];

        new Chart(document.getElementById('barChart'), {
    type: 'bar',
    data: {
        labels: statusNames,
        datasets: [{
            label: 'Number of Patients',
            data: statusCounts,
            backgroundColor: colors,
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: false, // Hide legend for bar chart
            },
            tooltip: {
                titleFont: {
                    weight: 'normal' // Makes the tooltip title non-bold
                },
                bodyFont: {
                    weight: 'normal' // Makes the tooltip body text non-bold
                },
                titleAlign: 'center', // Optional: Align the tooltip title in the center
                callbacks: {
                    label: function(context) {
                        return `${context.label}: ${context.raw}`; // Customize the tooltip label
                    }
                }
            }
        },
        onClick: (event, elements) => {
            if (elements.length > 0) {
                const index = elements[0].index;
                window.location.href = statusRedirectUrls[index];
            }
        }
    }
});


        // Doughnut Chart
        new Chart(document.getElementById('doughnutChart'), {
            type: 'doughnut',
            data: {
                labels: departmentNames, // Array of department names
                datasets: [{
                    label: 'Number of Patients',
                    data: departmentCounts, // Array of counts
                    backgroundColor: colors, // Array of background colors
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        position: 'bottom',
                        labels: {
                            generateLabels: (chart) => {
                                return chart.data.labels.map((label, i) => ({
                                    text: `${label}: ${chart.data.datasets[0].data[i]}`,
                                    fillStyle: chart.data.datasets[0].backgroundColor[i],
                                    index: i // Include index for identifying the clicked legend item
                                }));
                            }
                        },
                        onClick: (e, legendItem, legend) => {
                            // Redirect to a specific link when a legend item is clicked
                            const index = legendItem.index;
                            window.location.href = redirectUrls[index];
                        }
                    }
                },
                onClick: (event, elements) => {
                    if (elements.length > 0) {
                        const index = elements[0].index; // Slice click redirection
                        window.location.href = redirectUrls[index];
                    }
                }
            },
            plugins: [{
                // Custom plugin to change mouse cursor over legends
                id: 'legendPointer',
                afterEvent(chart, args) {
                    const {
                        event
                    } = args;
                    const legend = chart.legend;

                    // Detect if the mouse is over a legend
                    const legendHitbox = legend.legendHitBoxes || [];
                    let isHovering = false;

                    legendHitbox.forEach((box, i) => {
                        if (
                            event.x >= box.left &&
                            event.x <= box.left + box.width &&
                            event.y >= box.top &&
                            event.y <= box.top + box.height
                        ) {
                            isHovering = true;
                        }
                    });

                    // Set cursor style
                    chart.canvas.style.cursor = isHovering ? 'pointer' : 'default';
                }
            }]
        });

    });
</script>
