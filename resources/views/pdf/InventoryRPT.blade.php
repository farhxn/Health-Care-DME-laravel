<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Inventory Report</title>
    <style>
        /* General Styling */
        body {
            font-family: Arial, sans-serif;
            font-size: 15px;
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
        .metrics-table,
        .breakdown-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        .metrics-table th,
        .metrics-table td,
        .breakdown-table th,
        .breakdown-table td {
            border: 1px solid #999;
            padding: 8px;
            text-align: center;
        }

        .metrics-table th,
        .breakdown-table th {
            background-color: #f5f5f5;
            font-weight: bold;
            color: #333;
        }

        .breakdown-title {
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
            <h1><br> Inventory Report</h1>
        </div>
        <div class="date">Report Date: {{ now()->format('m/d/Y') }}</div>
    </div>

    <table class="metrics-table">
        <thead>
            <tr>
                <th>Metric</th>
                <th>Value</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Total Item Sold</td>
                <td>{{ $totalSoldItem }}</td>
            </tr>
            <tr>
                <td>Total Item Purchased</td>
                <td>50</td>
            </tr>
            <tr>
                <td>Sold via Insurance</td>
                <td>35</td>
            </tr>
            <tr>
                <td>Sold via Retail</td>
                <td>10</td>
            </tr>
        </tbody>
    </table>

    <!-- Detailed Breakdown by Patient Table -->
    <div class="breakdown-title">Detailed Breakdown by Patient:</div>

    <table class="breakdown-table">
        <thead>
            <tr>
                <th>Item Name</th>
                <th>Warehouse</th>
                <th>Quantity Sold</th>
                <th>Quantity Purchased</th>
                <th>Sold Price</th>
                <th>Purchase Price</th>
                <th>Sales Method (Insurance/Retail)</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($inventory as $inv)

            <tr>
                <td>{{ $inv->Item_Name }}</td>
                <td>
                    @php
                    $warehouses = json_decode($inv->warehouse, true);
                    @endphp

                    @if(!empty($warehouses))
                    <ul>
                        @foreach($warehouses as $warehouse)
                        <li>{{ nl2br(e($warehouse)) }}</li>
                        @endforeach
                    </ul>
                    @else
                    <span>No warehouses available</span>
                    @endif
                </td>

                <td>{{ $inv->Sold }}</td>
                <td>{{ $inv->Sold }}</td>
                <td>{{ $inv->MSRPPrice }}</td>
                <td>{{ $inv->Purchase_Price }}</td>
                <td>1</td>
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