<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceForm extends Model
{
    use HasFactory;

    protected $fillable =[
        'name',
        'CR_File_Name',
        'Special_Coding',
        'Right',
        'Left',
        'Bottom',
        'Top',
    ];
}
