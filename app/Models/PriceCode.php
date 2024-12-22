<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PriceCode extends Model
{
    use HasFactory;

    protected $fillable = [
        "Item",
        "Insurance",
        "OrderType",
        "PredefinedText",
        "Billable_Price",
        "AllowablePrice",
        "Rental_Billable_Price",
        "RentalAllowablePrice",
        "RentalType",
        "Bill_Billable_Code",
        "DMNRX",
        "modifier1",
        "modifier2",
        "modifier3",
        "modifier4",
        "PriorAuth",
        "Quantity",
        "Units",
        "When",
        "Converter",
        "BQuantity",
        "BUnits",
        "BWhen",
        "BConverter",
        "DQuantity",
        "DUnits",
        "DWhen",
        "DConverter",
        "ReoccuringSale",
        "AcceptAssignment",
        "SpanDates",
        "Insurance",
        "Taxable",
        "DayDelivery",
        "LastPeriod",
        "BillPickUp",
        "LastMonth",
    ];
}
