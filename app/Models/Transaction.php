<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'InvoiceNumber',
        'Payer',
        'Billable',
        'Allowable',
        'Balance',
        'Expected',
        'Allowed',
        'Deductible',
        'Coins',
        'Paid',
        'Actual',
        'PostingDate',
        'CheckDate',
        'Check',
        'ICN',
        'PaymentComment',
        'Company',
        'Tran',
        'Transaction',
        'Amount',
        'Quantity',
        'Taxes',
        'Batches',
        'Comment',
    ];
}
