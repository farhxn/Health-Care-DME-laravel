<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Patient Report</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f7f6;
            margin: 0;
            padding: 0;
            font-size: 14px;
        }

        .container {
            max-width: 95%;
            padding-right: 15px;
            padding-left: 15px;
            margin-right: auto;
            margin-left: auto;
            background-color: #ffffff;
            box-shadow: 0 0 8px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
            padding: 20px;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            margin-right: -15px;
            margin-left: -15px;
        }

        .col-md-12 {
            flex: 0 0 100%;
            max-width: 100%;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            /* Adjusted to fixed */
            margin-top: 20px;
        }

        th,
        td {
            text-align: left;
            padding: 12px;
            border: 1px solid #e3e6e5;
            word-wrap: break-word;
            vertical-align: middle;
            overflow: hidden;
            /* Added to hide text that overflows */
            text-overflow: ellipsis;
            /* Add ellipsis for overflowed content */
        }

        th {
            background-color: #008cba;
            color: #ffffff;
            font-size: 12px;
        }

        td {
            font-size: 11px;
        }

        /* Example specific column widths */
        th:nth-child(1),
        td:nth-child(1) {
            width: 8%;
        }

        th:nth-child(2),
        td:nth-child(2) {
            width: 12%;
        }

        th:nth-child(3),
        td:nth-child(3) {
            width: 15%;
        }

        th:nth-child(4),
        td:nth-child(4) {
            width: 13%;
        }

        th:nth-child(5),
        td:nth-child(5) {
            width: 10%;
        }

        th:nth-child(6),
        td:nth-child(6) {
            width: 13%;
        }

        th:nth-child(7),
        td:nth-child(7) {
            width: 13%;
        }

        th:nth-child(8),
        td:nth-child(8) {
            width: 12%;
        }

        th:nth-child(9),
        td:nth-child(9) {
            width: 10%;
        }

        h2 {
            color: #333;
            font-size: 24px;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Patient Report</h2>
                <table>
    <thead>
        <tr>
            <th>No.</th>
            <th>PT&nbsp;First&nbsp;&&nbsp;Last&nbsp;Name</th>
            <th>Item</th>
            <th>DOB</th>
            <th>Department</th>
            <th>User</th>
            <th>Status</th>
            <th>Order&nbsp;Date</th>
        </tr>
    </thead>
    <tbody>
        <?php $sno = 1; ?>
        @foreach ($pat as $pt)
        @php
        // Ensure $pt is accessed correctly as an array
        $user = \App\Models\Users::find($pt['User']);
        $dept = \App\Models\Departments::find($pt['Dept']);
        $status = \App\Models\Status::find($pt['Order_Status']);

        $userName = $user ? $user->name : 'N/A'; // Handle case when user is not found
        $deptName = $dept ? $dept->Department : 'N/A'; // Handle case when department is not found
        $statusName = $status ? $status->Status : 'N/A'; // Handle case when status is not found
        @endphp

        <tr>
            <td>{{ $sno++ }}</td>
            <td>{{ $pt['name'] }} {{ $pt['last_Name'] }}</td>
            <td>{{ $pt['Item'] }}</td>
            <td>{{ $pt['Dob'] }}</td>
            <td>{{ $deptName }}</td>
            <td>{{ $userName }}</td>
            <td>{{ $statusName }}</td>
            <td>{{ $pt['created_at'] }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

            </div>
        </div>
    </div>

</body>

</html>