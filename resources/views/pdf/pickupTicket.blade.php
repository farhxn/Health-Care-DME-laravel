<!DOCTYPE html>
<html>
<head>
    <style>
        @page {
            margin: 20px;
            padding: 0;
        }
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 0;
            font-size: 18px;
        }
        .order-title {
            width: 100%;
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
            position: relative;
        }
        .header-container {
            width: 100%;
            position: relative;
            margin-bottom: 20px;
        }
        .order-info {
            float: left;
            width: 50%;
        }
        .logo {
            float: right;
            width: 100px;
            height: 90px;
        }
        .clearfix::after {
            content: "";
            clear: both;
            display: table;
        }
        .address-box {
            width: 100%;
            border: 1px solid #000;
            margin: 20px 0;
            display: table;
            clear: both;
        }
        .address-section {
            width: 48%;
            padding: 10px;
            float: left;
        }
        .address-section:first-child {
            /* border-right: 1px solid #000; */
        }
        table {
            width: 100%;
            margin: 20px 0;
            border-collapse: collapse;
            clear: both;
        }
        th, td {
            padding: 8px;
            text-align: left;
            vertical-align: top;
        }
        .totals {
            text-align: right;
            margin: 20px 0;
            clear: both;
        }
        .total-box {
            border: 1px solid #000;
            display: inline-block;
            padding: 5px 20px;
            margin-left: 10px;
            min-width: 80px;
        }
        .disclaimers {
            text-align: center;
            margin: 30px 0;
            clear: both;
        }
        .disclaimers p {
            margin: 5px 0;
        }
        .signature-section {
            margin-top: 40px;
            clear: both;
        }
        .signature-line {
            width: 100%;
            margin-top: 30px;
            clear: both;
        }
        .signature-block {
            width: 45%;
            float: left;
            text-align: center;
            margin: 0 2.5%;
        }
        .signature-block div:first-child {
            border-bottom: 1px solid #000;
            min-height: 30px;
        }
        .signature-block div:last-child {
            margin-top: 5px;
            font-size: 11px;
        }
        /* Force page breaks */
        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body>
    <div class="order-title">Pickup Ticket</div>

    <div class="header-container clearfix">
        <div class="order-info">
            Order #: 133,147<br>
            Order Date: 9/16/2024
        </div>
        <div class="logo">
            <img src="assets/images/Headlogo.jpg" height="90" width="100" alt="logo">
        </div>
    </div>

    <div class="address-box clearfix">
        <div class="address-section">
            <strong>Deliver To:</strong>
                        SONG LINH<br>
            Address<br>
            City, State ZIP<br>
            Phone<br>
            <div style="margin-top: 10px;">
                <strong>Account #:</strong> 123432333
            </div>
        </div>
        <div class="address-section">
            <strong>Ordered From:</strong>
            HEALTHCARE DME, LLC<br>
            Address<br>
            City, State ZIP<br>
            Phone
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Code</th>
                <th>Description</th>
                <th>Sale/Rent</th>
                <th>Qty</th>
                <th>Units</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>D</td>
                <td>
                    Item Description<br>
                    Serial #: ___________
                </td>
                <td>R</td>
                <td>1</td>
                <td>EACH</td>
            </tr>
        </tbody>
    </table>

    <div class="totals">
<div class="">$0.00</div><br>
        Amount Due Upon Delivery: <div class="total-box">$0.00</div><br>
        Estimated 0.00% Co-Insurance Total for Customer <div class="total-box">$0.00</div>
    </div>


    <p style="margin: 20px 0;">

    </p>

    <div class="signature-section">
        <div class="signature-line clearfix">
            <div class="signature-block">
                <div></div>
                <div>LAMAR, CHARLES . Signature (or LAMAR, CHARLES Representative)</div>
            </div>
            <div class="signature-block">
                <div></div>
                <div>Date</div>
            </div>
        </div>

        <div class="signature-line clearfix">
            <div class="signature-block">
                <div></div>
                <div>Print Representative Name</div>
            </div>
            <div class="signature-block">
                <div></div>
                <div>Relationship and Reason for Singing</div>
            </div>
        </div>

        <div class="signature-line clearfix">
            <div class="signature-block">
                <div></div>
                <div>HEALTHCARE DME, LLC'S Representative</div>
            </div>
            <div class="signature-block">
                <div></div>
                <div>Date</div>
            </div>
        </div>
    </div>
</body>
</html>
