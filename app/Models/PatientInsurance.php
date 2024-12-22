<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientInsurance extends Model
{
    use HasFactory;

    protected $fillable = [
        'Policy',
        'PatientID',
        'Group',
        'Company',
        'Type',
        'Insured',
        'First',
        'Last',
        'DOB',
        'City',
        'State',
        'ZIP',
        'MI',
        'Suffix',
        'Gender',
        'Address',
        'Phone',
        'Mobile',
        'Payment',
        'Eligibility',
        'Basis',
        'Inactive',
        'EligibilityRequested',
    ];

}
