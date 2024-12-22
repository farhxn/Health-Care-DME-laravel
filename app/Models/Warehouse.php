<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    use HasFactory;
    protected $fillable = [
        'Warehouse_Name',
        'Contact',
        'Address',
        'City',
        'State',
        'Zip',
        'Phone',
        'Phone2',
        'Fax',
    ];
}
