<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;
    protected $fillable = [
        'Patient_ID',
        'Patient_Name',
        'Patient_Last_Name',
        'Address',
        'City',
        'Account',
        'Phone',
        'State',
        'ZIP',
        'Patient_DOB',
        'Email',
        'OrderStatus',
        'Department',
        'AssignUser',
        'Phone2',
        'DrOffice',
        'DrPhone',
        'DrFax',
        'DrNPI',
        'DrName',
        'DrPhone1',
        'LastCheckUser',
        'CheckedDate',
        'OrderType',
        'Policy1',
        'Policy2',
        'Policy3',
        'Policy4',
        'Items',
        'SignatureFile',
        'MonthsValid',
        'block12',
        'block13',
        'InsuranceEligibility',
        'TaxRate',
        'OutPocket',
        'Basis',
        'InvoiceForm',
        'SupplierStandards',
        'HIPPANote',
        'POS',
    ];
}
