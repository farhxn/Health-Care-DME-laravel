<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;
    protected $fillable = [
        'Fax',
        'Phone2',
        'Phone',
        'Zip',
        'State',
        'City',
        'Address',
        'Account',
        'Contact',
        'Vendor_Name',
    ];
}
