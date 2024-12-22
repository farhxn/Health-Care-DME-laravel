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
            <h1><br> Missing Documents Report</h1>
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
                <td>Orders with Missing/Expiring RX</td>
                <td>XX</td>
            </tr>
            <tr>
                <td>Orders with Missing/Expiring Docs</td>
                <td>XX</td>
            </tr>
            <tr>
                <td>Orders with Missing/Expiring Auths</td>
                <td>XX</td>
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
                <th>Missing Info (RX, Docs, Auths)</th>
                <th>Expiry Date (if applicable)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>OR654987</td>
                <td>David</td>
                <td>Brown</td>
                <td>RX, Delivery Paper</td>
                <td>10/15/2024</td>
            </tr>
            <tr>
                <td>OR123456</td>
                <td>John</td>
                <td>Doe</td>
                <td>Authorization, Office Visit Notes</td>
                <td>11/05/2024</td>
            </tr>
        </tbody>
    </table>

    <!-- Footer Section -->
    <div class="footer">
        Page <span class="page-number"></span>
    </div>

</body>
</html>
