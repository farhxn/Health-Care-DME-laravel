<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Copayment extends Model
{
    use HasFactory;
    protected $fillable = [
        'PatientID',
        'SignatureFile',
        'MonthsValid',
        'SignatureType',
        'CoPay',
        'Basis',
        'TaxRate',
        'Block12',
        'CoPayDollar',
        'Frequency',
        'InvoiceForm',
        'InvoiceForm',
        'Block13',
        'Hardship',
        'Deductible',
        'OutPocket',
        'SupplierStandards',
        'HIPPANote',
    ];
}
