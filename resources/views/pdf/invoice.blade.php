<!DOCTYPE html>
<html lang="en">
<title>{{ $order->Patient_Name }} {{ $order->Patient_Last_Name }} Order</title>
<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            font-size: 15px;
            line-height: 1.3;
        }

        .header {
            display: table;
            width: 100%;
            margin-bottom: 20px;
        }

        .header-left {
            display: table-cell;
            vertical-align: top;
            width: 70%;
        }

        .header-right {
            display: table-cell;
            vertical-align: top;
            width: 30%;
            text-align: right;
        }

        .logo {
            width: 80px;
            height: 80px;
        }

        .company-info {
            margin-bottom: 20px;
        }

        .company-name {
            font-weight: bold;
            font-size: 14px;
            margin: 0;
            padding: 0;
        }

        .company-address {
            margin: 5px 0;
        }

        .invoice-title {
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            margin: 0 0 15px 0;
        }

        .date-info {
            text-align: right;
            margin-bottom: 15px;
        }

        .invoice-number {
            margin: 10px 0;
        }

        .billing-section {
            display: table;
            width: 100%;
            margin-bottom: 20px;
        }

        .bill-to {
            display: table-cell;
            width: 50%;
            vertical-align: top;
            padding-right: 20px;
        }

        .customer-info {
            display: table-cell;
            width: 50%;
            vertical-align: top;
        }

        .section-title {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .invoice-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .invoice-table th,
        .invoice-table td {
            padding: 4px 6px;
            font-size: 15px;
        }

        .invoice-table th {
            /* border: 1px solid #000; */
            background-color: #f5f5f5;
            font-weight: bold;
            text-align: left;
        }

        .invoice-table thead {
            border: 1px solid #000;
            /* Outer border for thead */
        }

        .invoice-table thead th {
            border: none;
            background-color: #f5f5f5;
            font-weight: bold;
            text-align: left;
        }

        .totals-table {
            width: 100%;
            margin-bottom: 20px;
        }

        .totals-table td {
            padding: 2px 0;
        }

        .totals-table td:first-child {
            text-align: left;
        }

        .totals-table td:last-child {
            text-align: right;
            width: 100px;
        }

        .amount-paid {
            margin: 15px 0;
        }

        .payment-box {
            border: 1px solid #000;
            display: inline-block;
            width: 150px;
            height: 20px;
            margin-left: 10px;
        }

        .card-section {
            margin: 15px 0;
        }

        .card-boxes {
            margin: 10px 0;
        }

        .card-box {
            border: 1px solid #000;
            display: inline-block;
            width: 50px;
            height: 20px;
            /* margin-right:     10px; */
        }

        .card-details {
            margin: 5px 0;
            font-size: 11px;
        }

        .signature-line {
            margin-top: 20px;
            border-top: 1px solid #000;
            width: 250px;
        }

        .payment-methods {
            /* margin-bottom: 15px; */
        }

        .payment-methods label {
            margin-right: 15px;
        }

        .total-due {
            font-weight: bold;
        }

        .net-30 {

            float: right;
            margin-top: 10px;
        }

        .payment-section {
            /* margin: 20px 0; */
        }

        .card-boxes {
            display: flex;
            gap: 3px;
            margin: 10px 0;
        }

        .card-box {
            border: 1px solid #000;
            width: 15px;
            height: 25px;
        }

        .signature-line {
            margin-top: 30px;
            border-top: 1px solid #000;
            width: 250px;
        }

        .payment-methods {
            text-align: right;
            margin-bottom: 20px;
        }

        .payment-options {
            display: flex;
            justify-content: flex-end;
            gap: 15px;
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="date-info">
        Date: {{ \Carbon\Carbon::now()->format('n/j/Y') }}<br>
        Page: 1 of 1
    </div>

    <div class="invoice-title">Invoice</div>

    <div class="header">
        <div class="header-left">
            <div class="company-info">
                <div class="company-name">HEALTHCARE DME, LLC</div>
                <div class="company-address">
                    2911 CARPENTER ROAD<br>
                    ANN ARBOR, MI 481081163<br>
                    (734)975-6668
                </div>
            </div>
            <div class="invoice-number">
                Invoice Number: {{ $order->invoice }}
            </div>
        </div>
        <div class="header-right">
            <img src="assets/images/Headlogo.jpg" alt="Healthcare DME Logo" class="logo">
        </div>
    </div>

    <div class="billing-section">
        <div class="bill-to">
            <div class="section-title">Bill To:</div>
            {{ $order->Patient_Name }} {{ $order->Patient_Last_Name }}<br>
            {{ $order->Address }}<br>
            <!-- City, State ZIP<br> -->
            {{ $order->Phone }}<br>
        </div>
        <div class="customer-info">
            <div class="section-title">Customer:</div>
            {{ $order->Patient_Name }} {{ $order->Patient_Last_Name }}<br>
            {{ $order->Address }}<br>
            <!-- City, State ZIP<br> -->
            {{ $order->Phone }}<br>
            <div style="margin-top: 10px;">
                <strong>Account #:</strong> {{ $order->Account }}
            </div>
        </div>
    </div>

    <table class="invoice-table">
        <thead>
            <tr>
                <th>From</th>
                <th>To</th>
                <th>Item</th>
                <th>Name</th>
                <th>Qty</th>
                <th>Billed</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($orderItems as $item)

            <tr>
                <td>{{ $item->DOSFrom }}</td>
                <td>{{ $item->DOSTo }}</td>
                <td>{{ $item->itemId }}</td>
                <td>{{ $item->item }}</td>
                <td>{{ $item->Quantity }}</td>
                <td>680.00</td>
            </tr>
            @endforeach
            <!-- <tr>
                <td colspan="5">Deductible</td>
                <td>84.85</td>
            </tr> -->

        </tbody>
    </table>

    <table class="totals-table">
        <tr>
            <td>Sub-Total For All Charges</td>
            <td>870.00</td>
        </tr>
        <tr>
            <td>Total Sales Tax</td>
            <td>0.00</td>
        </tr>
        <tr>
            <td>Total Amount Billed</td>
            <td>870.00</td>
        </tr>
        <tr>
            <td>Total Adjustments</td>
            <td>0.00</td>
        </tr>
        <tr>
            <td>Total Amount Paid by Insurance</td>
            <td>-491.35</td>
        </tr>
        <tr>
            <td>Total Amount Paid by Customer</td>
            <td>0.00</td>
        </tr>
        <tr>
            <td>Total Write-Offs & Disallowed</td>
            <td>171.21</td>
        </tr>
        <tr class="total-due">
            <td>Total Amount Due</td>
            <td>207.44</td>
        </tr>
    </table>

    <div class="amount-paid">
        Amount Paid: <div class="payment-box"></div>
        <span class="net-30">Net 30</span>
    </div>

</div>
<div style="display: flex; justify-content: space-between; align-items: flex-start; margin: 20px 0;">
    <div style="flex: 1;">
        If paying by credit card complete below:
        <br>
        <div class="card-boxes">
            <div class="card-box"></div>
            <div class="card-box"></div>
            <div class="card-box"></div>
            <div class="card-box"></div>
            &nbsp;
            <div class="card-box"></div>
            <div class="card-box"></div>
            <div class="card-box"></div>
            <div class="card-box"></div>
            &nbsp;
            <div class="card-box"></div>
            <div class="card-box"></div>
            <div class="card-box"></div>
            <div class="card-box"></div>
            &nbsp;
            <div class="card-box"></div>
            <div class="card-box"></div>
            <div class="card-box"></div>
            <div class="card-box"></div>
        </div>
        <div style="margin: 10px 0;">
            exp. month_____ year_____ cvv_____
        </div>
        <div style="margin: 10px 0; font-size: 12px;">
            I authorize payment of the above amount with above credit card information
        </div>
        <div class="signature-line"></div>
        <div style="font-size: 12px;">signature</div>
    </div>

    <div class="payment-methods" style="text-align: right;">
        <div>All Major Credit Cards Accepted</div>
        <div class="payment-options" style="display: flex; justify-content: flex-end; gap: 15px; margin-top: 10px;">
            <label><input type="checkbox"> <img src="assets/images/visa.png" width="40" height="40" alt=""></label>
            <label><input type="checkbox"> <img src="assets/images/master.jpg" width="40" height="40" alt=""></label>
            <label><input type="checkbox"> <img src="assets/images/amex.jpg" width="40" height="40" alt=""></label>
            <label><input type="checkbox"> <img src="assets/images/discover.jpg" width="40" height="40" alt=""></label>
            <label><input type="checkbox"> HSA</label>
        </div>
    </div>
</div>


</body>

</html>
