<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Insurance Claim Report</title>
    <style>
        /* General Styles */
        body {
            font-family: Courier, monospace;
            font-size: 15px;
            margin: 0;
            padding: 0;
            width: 100%;
        }

        .container {
            padding: 10px;
            width: 100%;
            box-sizing: border-box;
        }

        .header,
        .footer {
            width: 100%;
            text-align: center;
            margin-bottom: 10px;
        }

        .header-details,
        .footer-page {
            display: flex;
            justify-content: space-between;
            margin: 0;
            font-size: 10px;
        }

        .dashed-line {
            border-bottom: 1px dashed #000;
            margin: 5px 0;
            width: 100%;
        }

        .section {
            margin-bottom: 10px;
        }

        .section-title {
            /* font-weight: bold; */
            margin: 5px 0;
            text-align: center;
        }

        .section-content {
            display: flex;
            justify-content: space-between;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            font-size: 10px;
            margin-top: 5px;
        }

        .table th,
        .table td {
            padding: 3px;
            text-align: left;
        }

        .table th {
            font-weight: bold;
        }

        .inline-block {
            display: inline-block;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="header">
            <div class="header-details" style="text-align: left;">
                <span>PRINT DATE: {{ now()->format('m/d/Y') }}</span> <br>
                <span>HEALTHCARE DME</span>
            </div>
            <div class="header-details" style="text-align: right;">
                <span>PAGE 1 of 1</span>
            </div>
            <p class="section-title">Formatted X12 Batch Report</p>
        </div>

        <!-- Report Details -->
        <div class="section">
            <div class="dashed-line"></div>
            <p>File Name: 20240X &nbsp;&nbsp; Provider No: Batch No: 81 &nbsp;&nbsp; Created: 04/05/2024 00 &nbsp;&nbsp; Control: 00000</p>
            <div class="dashed-line"></div>
        </div>

        <div class="section">
            <p>Patient Name: &nbsp;&nbsp;&nbsp;&nbsp; Account #: &nbsp;&nbsp;&nbsp;&nbsp; Insurance Company:</p>
            <div class="dashed-line"></div>
            <p>WASHINGTON, H70S &nbsp;&nbsp;&nbsp;&nbsp; 20240X &nbsp;&nbsp;&nbsp;&nbsp; HUMANA</p>

            <table class="table">
                <tr>
                    <td>From</td>
                    <td>To</td>
                    <td>Qty</td>
                    <td>Proc</td>
                    <td>Modifiers</td>
                    <td>Submitted</td>
                    <td>Assigned</td>
                    <td>RxType</td>
                    <td>Date</td>
                    <td>#Mos</td>
                    <td>DR Number</td>
                </tr>
                <tr>
                    <td colspan="11">
                        <div class="dashed-line"></div>
                    </td>
                </tr>
                <tr>
                    <td>2023</td>
                    <td>2024C</td>
                    <td>1</td>
                    <td>E0570</td>
                    <td>RR KJ KX</td>
                    <td>15.00</td>
                    <td>Y</td>
                    <td></td>
                    <td>20240329</td>
                    <td></td>
                    <td>NPI: 1215</td>
                </tr>
            </table>
        </div>

        <div class="section">
            <p>Patient Name: &nbsp;&nbsp;&nbsp;&nbsp; Account #: &nbsp;&nbsp;&nbsp;&nbsp; Insurance Company:</p>
            <div class="dashed-line"></div>
            <p>WASHINGTON, H70S &nbsp;&nbsp;&nbsp;&nbsp; 20240X &nbsp;&nbsp;&nbsp;&nbsp; HUMANA</p>

            <table class="table">
                <tr>
                    <td>From</td>
                    <td>To</td>
                    <td>Qty</td>
                    <td>Proc</td>
                    <td>Modifiers</td>
                    <td>Submitted</td>
                    <td>Assigned</td>
                    <td>RxType</td>
                    <td>Date</td>
                    <td>#Mos</td>
                    <td>DR Number</td>
                </tr>
                <tr>
                    <td colspan="11">
                        <div class="dashed-line"></div>
                    </td>
                </tr>
                <tr>
                    <td>2023</td>
                    <td>2024C</td>
                    <td>1</td>
                    <td>E0570</td>
                    <td>RR KJ KX</td>
                    <td>15.00</td>
                    <td>Y</td>
                    <td></td>
                    <td>20240329</td>
                    <td></td>
                    <td>NPI: 1215</td>
                </tr>
                <tr>
                    <td>2023</td>
                    <td>2024C</td>
                    <td>1</td>
                    <td>E0570</td>
                    <td>RR KJ KX</td>
                    <td>15.00</td>
                    <td>Y</td>
                    <td></td>
                    <td>20240329</td>
                    <td></td>
                    <td>NPI: 1215</td>
                </tr>
                <tr>
                    <td>2023</td>
                    <td>2024C</td>
                    <td>1</td>
                    <td>E0570</td>
                    <td>RR KJ KX</td>
                    <td>15.00</td>
                    <td>Y</td>
                    <td></td>
                    <td>20240329</td>
                    <td></td>
                    <td>NPI: 1215</td>
                </tr>
            </table>
         </div>


        <!-- Footer Section -->
        <!-- <div class="footer">
            <div class="footer-page">
                <span>Formatted X12 Batch Report</span>
                <span>Page 1 of 1</span>
            </div>
        </div> -->
    </div>

</body>

</html>
