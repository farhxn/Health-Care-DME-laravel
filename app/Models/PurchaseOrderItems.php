<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrderItems extends Model
{
    use HasFactory;
    
    protected $fillable =[
        'customer',
        'item',
        'price',
        'orderedQty',
        'dateReceived',
        'backOrder',
        'receivedQty',
        'warehouse',
        'uniqueId',
        'status',
    ];
}
