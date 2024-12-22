<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SerialNumber extends Model
{
    use HasFactory;

    protected $fillable=[
        'SerialNumber',
        'InventoryCode',
        'Status',
        'Warranty',
        'WarrantyLength',
        'Manufacturer',
        'ManufacturerSerialNumber',
        'Model',
        'Warehouse',
        'PurchaseAmount',
        'PurchaseDate',
        'SoldDate',
        'NextMaintenanceDate',
        'MonthsRented',
        'CurrentCustomer',
        'LastCustomer',
        'LotNumber',
        'FirstRented',
        'OwnRent',
        'Vendor',
    ];
}
