<!DOCTYPE html>
<html>
<head>
    <style>
        .table-cards, .table {
            width: 100%;
            border-collapse: collapse;
        }
        .table-cards td, .table th, .table td {
            border: 1px solid black;
            padding: 5px;
            text-align: center;
        }
        .table th {
            background-color: gainsboro;
        }
        .card {
            margin: 5px;
            padding: 10px;
        }
    </style>
</head>
<body>
    <h1 style="text-align: center;">All Patients</h1>

    <table class="table-cards">
        @php
            $counter = 0;
            $colors = ['red', 'blue', 'green', 'yellow'];
        @endphp
        @foreach ($status as $index => $statusItem)
            @php
                $StatusCounter = collect($pets)->where('Order_Status', $statusItem->id)->count();
                $color = $colors[$index % 4];
            @endphp
            @if ($counter % 4 == 0)
                @if ($counter != 0)
                    </tr>
                    <tr>
                @endif
            @endif
            <td class="card" style="border-top: 4px solid {{ $color }}">
                <p>{{ $statusItem->Status }}</p>
                <div class="status-total">Total: {{ $StatusCounter }}</div>
            </td>
            @php $counter++; @endphp
        @endforeach
        @if ($counter % 4 != 0)
            </tr>
        @endif
    </table>



    @foreach ($depts as $dept)
        <div style="page-break-before: always;"></div>
        <h2 style="text-align: center;">{{ $dept->Department }}</h2>
        <table class="table-cards">
            @php $counter = 0; @endphp
            @foreach ($status as $index => $statusItem)
                @php
                    $StatusCounter = collect($pets)->where('Dept', $dept->id)->where('Order_Status', $statusItem->id)->count();
                    $color = $colors[$index % 4];
                @endphp
                @if ($counter % 4 == 0)
                    @if ($counter != 0)
                        </tr>
                        <tr>
                    @endif
                @endif
                <td class="card" style="border-top: 4px solid {{ $color }}">
                    <p>{{ $statusItem->Status }}</p>
                    <div class="status-total">Total: {{ $StatusCounter }}</div>
                </td>
                @php $counter++; @endphp
            @endforeach
            @if ($counter % 4 != 0)
                </tr>
            @endif
        </table>

        <table class="table">
            <thead>
                <tr>
                    <th>Priority</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Status</th>
                    <th>Order Date</th>
                </tr>
            </thead>
            <tbody>
                @php $sno = 1; @endphp
                @foreach (collect($pets)->where('Dept', $dept->id) as $pat)
                    @php
                        $statusName = $status->firstWhere('id', $pat['Order_Status']);
                        $borderColor = 'yellow'; // Default color
                        if ($statusName) {
                            $borderColor = match($statusName->Status) {
                                'Pending' => 'lightblue',
                                'Completed' => 'lightgreen',
                                'InProgress' => 'greenyellow',
                                'Cancelled' => 'grey',
                                default => 'yellow',
                            };
                        }
                    @endphp
                    <tr>
                        <td>{{ $sno++ }}</td>
                        <td>{{ $pat['name'] }}</td>
                        <td>{{ $pat['last_Name'] }}</td>
                        <td style="background-color: {{ $borderColor }};">
                            {{ $statusName->Status ?? 'Unknown' }}
                        </td>
                        <td>{{ $pat['created_at'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endforeach
</body>
</html>
