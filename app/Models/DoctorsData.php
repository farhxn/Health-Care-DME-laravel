<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorsData extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'FirstName',
        'LastName',
        'MI',
        'Suffix',
        'Address',
        'Courtesy',
        'City',
        'State',
        'Zip',
        'Phone',
        'Phone2',
        'Fax',
        'UPIN',
        'Medicaid',
        'NPI',
        'License',
        'Expiry',
        'Federal',
        'Other',
        'DES',
        'PECOS',
        'DoctorType',
        'Contact',
        'Title',
        'LastCheck',
    ];

}
