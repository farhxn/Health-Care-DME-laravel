<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Batches extends Model
{
    use HasFactory;
    protected $fillable = [
        'OrderID',
        'PatientID',
        'BatchNumber',
        'Status',
        'Created',
        'BatchStatus',
        'Item',
        'Balance',
        'BillingCode',
        'InvoiceDate',
        'HAO',
        'Modifier1',
        'Modifier2',
        'Modifier3',
        'Modifier4',
        'From',
        'To',
        'BillingMonth',
        'BillableAmount',
        'AllowedAmount',
        'Quantity',
        'Taxes',
        'Ins1',
        'Ins2',
        'Ins3',
        'Ins4',
        'NoPay',
        'Dx10',
        'PriorAuthType',
        'PriorAuth',
        'SpecialCode',
        'ReviewCode',
        'CMNRX',
        'lastInvoiceGeneratedOn',
        'AcceptAssignment',
    ];
}
