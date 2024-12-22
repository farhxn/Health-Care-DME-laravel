<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RetailSale extends Model
{
    use HasFactory;
    protected $fillable = [
        'Date',
        'SoldBy',
        'Discount',
        'Customer',
        'Address',
        'City',
        'State',
        'ZIP',
        'Phone',
        'TaxRate',
        'per',
        'Items',
        'Sub_total',
        'DiscountPer',
        'Total',
        'Tax',
    ];
}
