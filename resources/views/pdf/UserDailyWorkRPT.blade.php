<!DOCTYPE html>
<html lang="en">

<head>
    <title>User Daily Work Report</title>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 15px;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .header {
            display: flex;
            align-items: center;
            padding: 10px 20px;
            border-bottom: 2px solid #333;
        }

        .header img {
            max-height: 70px;
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
            <h1><br> User Daily Work Report</h1>
        </div>
        <div class="date">Order Date: {{ now()->format('m/d/Y') }}</div>
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
                <td>Total Patients Worked</td>
                <td>XX</td>
            </tr>
            <tr>
                <td>Total Patients Assigned</td>
                <td>XX</td>
            </tr>
            <tr>
                <td>Daily Order Assigned Count</td>
                <td>XX</td>
            </tr>
            <tr>
                <td>Current Patients</td>
                <td>XX</td>
            </tr>
            <tr>
                <td>Follow-Up Patients</td>
                <td>XX</td>
            </tr>
            <tr>
                <td>Patients Moved to Another Dept.</td>
                <td>XX</td>
            </tr>
            <tr>
                <td>Notes Added</td>
                <td>XX</td>
            </tr>
            <tr>
                <td>Documents Received</td>
                <td>XX</td>
            </tr>
            <tr>
                <td>Documents Uploaded</td>
                <td>XX</td>
            </tr>
            <tr>
                <td>Resupply Orders Assigned</td>
                <td>XX</td>
            </tr>
        </tbody>

    </table>

    <!-- Detailed Breakdown by Patient Table -->
    <div class="breakdown-title">Detailed Breakdown by Patient:</div>

    <table class="breakdown-table">
        <thead>
            <tr>
                <th>Patient First Name</th>
                <th>Patient Last Name</th>
                <th>Order Number</th>
                <th>Status</th>
                <th>Notes Added</th>
                <th>Documents Received</th>
                <th>Documents Uploaded</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>John</td>
                <td>Doe</td>
                <td>OR123456</td>
                <td>Worked, Follow-Up</td>
                <td>3</td>
                <td>2</td>
                <td>1</td>
            </tr>
        </tbody>
    </table>

    <!-- Footer Section -->
    <div class="footer">
        Page <span class="page-number"></span>
    </div>

</body>

</html>
