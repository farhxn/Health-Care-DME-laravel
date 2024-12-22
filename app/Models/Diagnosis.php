<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diagnosis extends Model
{
    use HasFactory;

    protected $fillable = [
        'DateOfInjury',
        'WorkDate',
        'ConsultDate',
        'Accident',
        'StateInjury',
        'ICD91',
        'ICD92',
        'ICD93',
        'ICD94',
        'ICD101',
        'ICD102',
        'ICD103',
        'ICD104',
        'ICD105',
        'ICD106',
        'ICD107',
        'ICD108',
        'ICD109',
        'ICD1010',
        'ICD1011',
        'ICD1012',
        'OrderID',
        'PatientID',
    ];

}
