<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Durable Medical Equipment Rental Agreement</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 8.5in;
            margin: 0 auto;
            padding: 0.5in;
            font-size: 14.5px;
            line-height: 1.3;
        }

        .page {
            margin-bottom: 1in;
            page-break-after: none;
        }

        .header {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
        }

        .logo-container {
            position: relative;
            width: 100%;
            text-align: center;
        }

        .logo-image {
            width: 450px;
            height: auto;
        }

        .hours-badge {
            position: absolute;
            right: 50px;
            top: 0;
            color: red;
            font-weight: bold;
        }

        .title {
            text-align: center;
            font-weight: bold;
            margin: 15px 0;
        }

        .content {
            margin: 10px 0;
        }

        ul {
            list-style-type: disc;
            margin: 10px 0 10px 20px;
            padding-left: 0;
        }

        li {
            margin-bottom: 10px;
            text-align: justify;
        }

        .section-title {
            font-weight: bold;
            margin: 15px 0 5px 0;
        }

        .form-row {
            display: flex;
            gap: 15px;
            margin: 10px 0;
            align-items: center;
        }

        .signature-line {
            margin-top: 20px;
            border-bottom: 1px solid #000;
            width: 200px;
            display: inline-block;
        }

        .page-number {
            text-align: right;
            margin-top: 10px;
        }

        .footer {
            text-align: center;
            /* margin-top: 3px; */
            border-top: 1px solid #000;
            padding-top: 8px;
        }

        .page-2-content {
            text-align: center;
            justify-content: center;
            line-height: 1.4;
        }

        .agreement-text {
            margin-bottom: 20px;
            text-align: justify;
        }

        .items-section {
            margin: 20px 0;
        }

        .items-title {
            font-weight: bold;
            border-bottom: 1px solid black;
            margin-bottom: 10px;
            padding-bottom: 5px;
        }

        .items-box {
            padding: 15px;
        }

        .rental-details {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
        }

        .auth-section {
            margin: 20px 0;
        }

        .auth-title {
            text-align: center;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .auth-text {
            font-size: 16px;
            margin-bottom: 20px;
        }

        .form-group {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
        }

        .form-field {
            flex: 1;
        }

        .address-field {
            margin: 15px 0;
        }

        .card-numbers {
            text-align: center;
            margin: 15px 0;
        }

        .signature-section {
            margin-top: 30px;
        }

        .footer-notice {
            text-align: center;
            margin-top: 30px;
        }

        .underline {
            border-bottom: 1px solid black;
            display: inline-block;
            min-width: 150px;
        }

        .formUnderline {
            border-bottom: 1px solid black;
            display: inline-block;
            min-width: 250px;
        }

        @media print {
            .page {
                height: 11in;
                position: relative;
            }

            .footer {
                position: absolute;
                bottom: 0;
                width: 100%;
            }
        }
    </style>
</head>

<body>

   <!-- Page 2 -->
   <div class="page">
        <div class="header">
            <div class="logo-container">
                <img src="assets/images/logo.png" alt="Healthcare Home Medical Supply" class="logo-image">
            </div>
        </div>

        <div class="title">Durable Medical Equipment Rental Agreement</div>

        <div class="page-2-content">
            <div class="agreement-text">
                agreement, Renter shall forfeit any deposit, as permitted by law. If returned equipment appears broken due to misuse,
                handling fees and repair charge of $100.00 may be charged for inspection, testing and other repairs required to return the
                Equipment to service. This charge will be payable at the end of this agreement. If the Equipment cannot be repaired, the
                Renter will be notified and will be responsible for the charge/replacement cost of the Equipment.
            </div>

            <div class="items-box">
                    <div class="rental-details">
                        <span>Description of Items Rented : <span class="formUnderline"></span><span class="formUnderline"></span></span>
                    </div>
                </div>

            <div class="items-section">
                <div class="items-box">
                    <div class="rental-details">
                        <span>Weekly Rent: <span class="underline"></span></span>
                        <span>Monthly Rent: <span class="underline"></span></span>
                        <span>Security Deposit: <span class="underline"></span></span>
                    </div>
                </div>
            </div>

            <div class="auth-section">
                <div class="auth-title">Credit Card Payment Authorization</div>
                <div class="auth-text">
                    • By signing this form, I acknowledge that I have read the rental agreement and understand the terms and
                    conditions set forth herein. I also agree to the charges being made to my credit card and understand that if the
                    equipment cannot go in service after the STARTING DATE, additional charges will be incurred. *Payments for
                    weekly/monthly rental items will be charged on the renewal date of each month indicated above until the item is returned.
                    <br><br>
                    • I authorize the company to bill my credit card indicated below for payment for goods/services described, for the amount indicated above.
                    I certify that I am an authorized user of this credit card and that I will not dispute the payment with my credit card
                    company; so long as the transaction corresponds to the terms indicated in this Agreement.
                </div>

                <div class="items-box">
                    <div class="rental-details">
                        <span>Customer Name: <span class="formUnderline">{{$order->Patient_Name . ' '. $order->Patient_Last_Name}}</span></span>
                        <span>DOB: <span class="formUnderline">{{$patient->Dob}}</span></span>
                    </div>
                </div>

                <div class="items-box">
                    <div class="rental-details">
                        <span>Customer Address: <span class="formUnderline">{{$order->Address}}</span></span>
                    </div>
                </div>

                <div class="items-box">
                    <div class="rental-details">
                        <span>Credit Card #: <span class="formUnderline"></span></span>
                        <span>CVV: <span class="formUnderline"></span></span>
                    </div>
                </div>



                <div class="items-box">
                    <div class="rental-details">
                        <span>Expiration: <span class="formUnderline"></span></span>
                        <span>Credit Card Type: <span class="formUnderline"></span></span>
                    </div>
                </div>


                <div class="items-box">
                    <div class="rental-details">
                        <span>Customer Height: <span class="formUnderline">{{$patient?->height}}</span></span>
                        <span>Customer Weight: <span class="formUnderline">{{$patient?->weight}}</span></span>
                    </div>
                </div>


                <div class="items-box">
                    <div class="rental-details">
                        <span>Customer Driver License #: <span class="formUnderline"></span></span>
                        <span>State: <span class="formUnderline">{{$order->State}}</span></span>
                    </div>
                </div>

                <div class="items-box">
                    <div class="rental-details">
                        <span>Customer Signature: <span class="formUnderline"></span></span>
                        <span>Date: <span class="formUnderline">{{ now()->format('m/d/Y') }}</span></span>
                    </div>
                </div>

                <div class="items-box">
                    <div class="rental-details">
                        <span>Healthcare DME Signature: <span class="formUnderline"></span></span>
                        <span>Date: <span class="formUnderline">{{ now()->format('m/d/Y') }}</span></span>
                    </div>
                </div>

            </div>

            <div class="footer-notice"><strong>

                A COPY OF YOUR GOVERNMENT ISSUED PHOTO IDENTIFICATION CARD IS REQUIRED TO BE ON<br>
                FILE WITH THIS DURABLE MEDICAL EQUIPMENT RENTAL AGREEMENT.
            </strong>
            </div>


            <div class="footer">
                <p>2511 Carpenter Road, Ann Arbor, MI 48108</p>
                <p>Phone: (734) 975-6568 Initials:_____</p>
                <p>Website: www.HealthcareDME.com</p>
            </div>

            <div class="page-number">2</div>
        </div>
    </div>

<!-- Page 2 -->
    <div class="page">
        <div class="header">
            <div class="logo-container">
                <img src="assets/images/logo.png" alt="Healthcare Home Medical Supply" class="logo-image">
            </div>
        </div>

        <div class="title">Durable Medical Equipment Rental Agreement</div>

        <div class="content">
            <p>Healthcare DME rents to the Renter signing this agreement, medical equipment subject to all terms and conditions set forth in this Rental Agreement and Renter agrees all terms listed below:</p>

            <ul>
                <li>The medical equipment is the property of Healthcare DME and is in good condition. Renter shall return equipment in the same condition as when received to Healthcare DME, at the end of rental period except for normal wear, at the above, upon the expiration of lease term. Healthcare DME may repossess equipment without demand at any time if the equipment is used in any way that may violate the terms of this agreement.</li>

                <li>Healthcare DME shall not be held legally responsible for the loss of or damage to the equipment due to theft, misuse, stolen, altered or transported by Renter, its agents, servants, or employees, or any other person on or using the medical equipment and/or before or at the result thereof to Healthcare DME. Renter assumes all risk of and responsibility for any theft, mysterious disappearance or damage from any cause whatsoever, to the equipment, from and to defend and indemnify Healthcare DME against all claims based upon or arising out of such loss or damage.</li>
            </ul>

            <div class="section-title">Rental Equipment Repairs/Maintenance Policy:</div>
            <ul>
                <li>No warranty service is available for rental equipment. No onsite service is available regardless if equipment has a defect, damage or replacement parts needed. Patient will need to bring equipment to Healthcare DME located at 2511 Carpenter Road, Ann Arbor, MI 48108 for service, repairs, or replacements Monday - Friday between the hours of (9AM-5PM EDT). There is no guarantee that the patient will receive another piece of equipment, replacement or service has a back-ordered part.</li>
            </ul>

            <div class="section-title">Rental Equipment Delivery, Pickup, Return:</div>
            <ul>
                <li>Delivery of Equipment is $75 within a 20-mile radius of our Ann Arbor location. (Additional mileage will be charged $3.00 per mile.)</li>
                <li>Pick up of Equipment is $75 within a 20-mile radius of our Ann Arbor location. (Additional mileage will be charged $3.00 per mile.)</li>
            </ul>

            <div class="section-title">Security Deposit:</div>
            <p>Prior to taking possession of the Equipment, Renter shall deposit with Healthcare DME, in trust, a security deposit as security for the performance by Renter of the terms under this agreement and for any damages caused by Renter or Renter's agents to the Equipment during the Lease Term. Healthcare DME may use part or all of the security deposit to repair any damage to Equipment caused by Renter or Renter's agents. However, Healthcare DME is not just limited to the security deposit amount when seeking damages.</p>
        </div>

        <div class="footer">
            <p>2511 Carpenter Road, Ann Arbor, MI 48108</p>
            <p>Phone: (734) 975-6568 Initials:_____</p>
            <p>Website: www.HealthcareDME.com</p>
        </div>

        <div class="page-number">1</div>
    </div>


</body>

</html>
