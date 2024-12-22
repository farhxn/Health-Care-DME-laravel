<!DOCTYPE html>
<html>

<head>
    <title>{{ $order->Patient_Name }} {{ $order->Patient_Last_Name }} Order</title>

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

        th,
        td {
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
    <div class="order-title">Order</div>

    <div class="header-container clearfix">
        <div class="order-info">
            Order #: {{ $order->id }}<br>
            Order Date: {{ \Carbon\Carbon::now()->format('n/j/Y') }}
        </div>
        <div class="logo">
            <img src="assets/images/Headlogo.jpg" height="90" width="100" alt="logo">
        </div>
    </div>

    <div class="address-box clearfix">
        <div class="address-section">
            <strong>Deliver To:</strong>
            {{ $order->Patient_Name }} {{ $order->Patient_Last_Name }}<br>
            {{ $order->Address }}<br>
            <!-- City, State ZIP<br> -->
            {{ $order->Phone }}<br>
            <div style="margin-top: 10px;">
                <strong>Account #:</strong> {{ $order->Account }}
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
                <th>Price</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orderItems as $item)
            <tr>
                <td>D</td>
                <td>
                    {{ $item->item }}<br>
                    Serial #: {{ $item->Serial }}
                </td>
                <td>R</td>
                <td>{{ $item->Quantity }}</td>
                <td>{{ $item->Units }}</td>
                <td>0.00 per month</td>
                <td>0.00</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="totals">
        * taxes included &nbsp;&nbsp;&nbsp; Total Billed <div class="total-box">$0.00</div><br>
        Amount Due Upon Delivery: <div class="total-box">$0.00</div><br>
        Estimated 0.00% Co-Insurance Total for Customer <div class="total-box">$0.00</div>
    </div>

    <div class="disclaimers">
        <p><strong>HEALTHCARE DME, LLC IS NOT RESPONSIBLE FOR ACCIDENTS OR INJURIES</strong></p>
        <p>I have been instructed on how to use the equipment I have received.</p>
        <p>I have been instructed on the manufacturer's warranties, if applicable.</p>
        <p>I have received a copy of the Supplier Standards and HIPAA notice.</p>
        <p>I have received and understand my Patient Bill of rights and Patient Responsibilities</p>
        <p>I have received and understand the Assignment of Benefits form.</p>
    </div>

    <p style="margin: 20px 0;">
        I have not received any of the above listed equipment from any other provider. I understand that I am responsible for the charges or balance of charges associated with the rental and/or purchase (as indicated) of the above listed equipment if all or part of the associated charges are not covered by my insurance. I further understand the anticipated allowable charges for the listed equipment and understand my responsibility for any co-payments and deductibles.
    </p>

    <div class="signature-section">
        <div class="signature-line clearfix">
            <div class="signature-block">
                <div></div>
                <div>SONG, LINH . Signature (or SONG, LINH's Representative)</div>
            </div>
            <div class="signature-block">
                <div>{{ \Carbon\Carbon::now()->format('n/j/Y') }}</div>
                <div>Date</div>
            </div>
        </div>

        @php
        $username = Session::get('LoginName');
        @endphp

        <div class="signature-line clearfix">
            <div class="signature-block">
                <div>{{$username}}</div>
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
                <div>{{ \Carbon\Carbon::now()->format('n/j/Y') }}</div>
                <div>Date</div>
            </div>
        </div>
    </div>
</body>

</html>
