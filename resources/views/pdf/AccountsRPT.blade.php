<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
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

    <!-- Header Section -->
    <div class="header">
        <div class="header-title">
            <img src="assets/images/logo.png" alt="Company Logo">
            <h1><br> Accounts Report</h1>
        </div>
        <div class="date">Report Date: {{ now()->format('m/d/Y') }}</div>
    </div>

    <!-- Summary Table -->
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
                <td>Total Items Sold</td>
                <td>XX</td>
            </tr>
            <tr>
                <td>Total Purchase Price</td>
                <td>XX</td>
            </tr>
            <tr>
                <td>Total Sold Price</td>
                <td>XX</td>
            </tr>
            <tr>
                <td>Payments from Insurance</td>
                <td>XX</td>
            </tr>
            <tr>
                <td>Payments from Patients</td>
                <td>XX</td>
            </tr>
            <tr>
                <td>Payments from Retail</td>
                <td>XX</td>
            </tr>
        </tbody>
    </table>

    <!-- Detailed Breakdown by Transaction Table -->
    <div class="section-title">Detailed Breakdown by Transaction:</div>
    <table class="breakdown-table">
        <thead>
            <tr>
                <th>Item Name</th>
                <th>Order Number</th>
                <th>Patient First Name</th>
                <th>Patient Last Name</th>
                <th>Purchase Price</th>
                <th>Sold Price</th>
                <th>Payment Source (Insurance/Patient/Retail)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Oxygen Mask</td>
                <td>OR987654</td>
                <td>Linda</td>
                <td>Wright</td>
                <td>$50</td>
                <td>$100</td>
                <td>Insurance</td>
            </tr>
            <tr>
                <td>CPAP Machine</td>
                <td>OR123456</td>
                <td>John</td>
                <td>Doe</td>
                <td>$200</td>
                <td>$500</td>
                <td>Retail</td>
            </tr>
        </tbody>
    </table>

    <!-- Footer Section -->
    <div class="footer">
        Page <span class="page-number"></span>
    </div>

</body>
</html>
