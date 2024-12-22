<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrders extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'Cost',
        'Freight',
        'Vendor',
        'Vendor_Account',
        'Confirm',
        'Tax',
        'Total_Due',
        'Billing_Address',
        'Shipping_Address',
        'Order_Patient',
        'Items',
        'dropShip',
        'status',
        'Created_By',
    ];

}
