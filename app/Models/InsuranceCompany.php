<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InsuranceCompany extends Model
{
    use HasFactory;
    protected $fillable = [
        'AbilityPayer',
        'Prefix',
        'TaxonomyCode',
        'RenderingPhysician',
        'ReferingPhysician',
        'OrderingPhysician',
        'ParticipatingProvider',
        'Zirmed',
        'OfficeAlly',
        'Medicare',
        'Medicaid',
        'ClaimMD',
        'Availability',
        'Ability',
        'ECSFormat',
        'Invoice',
        'Group',
        'Type',
        'HAOCodeInvoice',
        'InventoryInvoice',
        'Bill',
        'Expected',
        'PriceCode',
        'ContactName',
        'Phone2',
        'Phone',
        'address',
        'Name',
        'Fax'
    ];
}
