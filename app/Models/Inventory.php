<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;
    protected $fillable = [
        'DiagnoseCode',
        'itemQuantity',
        'warehouse',
        'Manufacturer',
        'Barcode_Type',
        'Predefined_Text',
        'Model',
        'Product_Type',
        'Barcode',
        'Vendor',
        'Purchase_Price',
        'MAP_Price',
        'MSRPPrice',
        'TotalSellItems',
        'InStockQty',
        'Inv_Code',
        'Basis',
        'Frequency',
        'Item_Name',
        'Inventory_Code',
        'O2Tank',
        'Service',
        'Serialized',
        'Inactive',
        'PaidAt'
    ];
}
