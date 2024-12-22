<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItems extends Model
{
    use HasFactory;

    protected $fillable = [
        'item',
        'itemId',
        'uniqueOrderId',
        'patientID',
        'warehouse',
        'priceCode',
        'Type',
        'Bill_Billable_Code',
        'price_Code',
        'modifier1',
        'modifier2',
        'modifier3',
        'modifier4',
        'RentalType',
        'Billable_Price',
        'AllowablePrice',
        'Taxable',
        'Quantity',
        'Units',
        'QuantityOrderType',
        'BQuantity',
        'BUnits',
        'BOrderType',
        'DQuantity',
        'DUnits',
        'PriorAuth',
        'PriorAuthType',
        'AcceptAssignment',
        'ins1',
        'ins2',
        'ins3',
        'ins4',
        'noIns1',
        'HAO',
        'Serial',
        'BillItem',
        'invoice',
        'PriorAuthNo',
        'PriorAuthExpiry',
        'RXExp',
        'DOSFrom',
        'DOSTo',
        'DOSBillingMonth',
        'DXPointer10',
        'SellType',
        'CMN',
    ];

}
