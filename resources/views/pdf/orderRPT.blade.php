<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order Report</title>
    <style>
        /* General Styling */
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #333;
            margin: 0;
            padding: 0;
        }

        /* Header Styling */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            border-bottom: 2px solid #333;
        }
        .header img {
            max-height: 60px;
        }
        .header-title {
            text-align: center;
            flex-grow: 1;
        }
        .header-title h1 {
            font-size: 18px;
            color: #333;
            margin: 0;
        }
        .header .date {
            font-size: 12px;
            color: #777;
            text-align: right;
        }

        /* Table Styling */
        .summary-table, .breakdown-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        .summary-table th, .summary-table td,
        .breakdown-table th, .breakdown-table td {
            border: 1px solid #999;
            padding: 8px;
            text-align: center;
        }
        .summary-table th, .breakdown-table th {
            background-color: #f5f5f5;
            font-weight: bold;
            color: #333;
        }
        .section-title {
            font-size: 14px;
            font-weight: bold;
            color: #333;
            margin-top: 20px;
            margin-bottom: 10px;
        }

        /* Footer Styling */
        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            padding: 10px 0;
            text-align: center;
            font-size: 10px;
            color: #777;
            border-top: 1px solid #ccc;
        }
        .footer .page-number:after {
            content: counter(page);
        }
    </style>
</head>
<body>

    <div class="header">
        <div class="header-title">
            <img src="assets/images/logo.png" alt="Company Logo">
            <h1><br> Orders Report</h1>
        </div>
        <div class="date">Report Date: {{ now()->format('m/d/Y') }}</div>
    </div>

    <div class="section-title">Summary Table:</div>
    <table class="summary-table">
        <thead>
            <tr>
                <th>Metric</th>
                <th>Value</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Total Orders Created</td>
                <td>{{count($order)}}</td>
            </tr>
            <tr>
                <td>Insurance Orders</td>
                <td>{{ $insCount }}</td>
            </tr>
            <tr>
                <td>Rental Orders</td>
                <td>{{ $rentalCount }}</td>
            </tr>
            <tr>
                <td>Retail Orders</td>
                <td>{{ $retailCount }}</td>
            </tr>
            <tr>
                <td>Successfully Billed Orders</td>
                <td>{{ $billCount }}</td>
            </tr>
            <tr>
                <td>Pending Copayments</td>
                <td>{{$copayCount}}</td>
            </tr>
            <tr>
                <td>Incomplete/Canceled Orders</td>
                <td>{{ $cancelCount }}</td>
            </tr>
        </tbody>
    </table>

    <!-- Detailed Breakdown by Order Table -->
    <div class="section-title">Detailed Breakdown by Order:</div>
    <table class="breakdown-table">
        <thead>
            <tr>
                <th>Order Number</th>
                <th>Patient First Name</th>
                <th>Patient Last Name</th>
                <th>Order Type (Insurance/Retail)</th>
                <th>Billing Status (Success/Pending)</th>
                <th>Payment Status (Received/Pending)</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order as $ord)
            <tr>
                <td>{{ $ord->id }}</td>
                <td>{{ $ord->Patient_Name }}</td>
                <td>{{ $ord->Patient_Last_Name }}</td>
                <td>{{ $ord->OrderType }}</td>
                <td>{{ ($ord->OrderStatus == "12" ? "Success" : "Pending") }}</td>
                <td>{{ ($ord->OrderStatus == "28" ? "Received" : "Pending") }}</td>
            </tr>
            @endforeach

        </tbody>
    </table>

    <!-- Footer Section -->
    <div class="footer">
        Page <span class="page-number"></span>
    </div>

</body>
</html>
