<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;
    protected $fillable=[
        'Name',
        'address',
        'City',
        'State',
        'Code',
        'NPI',
        'FederalTaxID',
        'Zip',
        'Phone',
        'mail',
        'Phone2',
        'Fax',
        'Contact',
        'TaxIDType',
        'POSType',
        'Warehouse',
        'TaxRate',
        'Tickets',
        'Statement',
        'Provider',
    ];
}

