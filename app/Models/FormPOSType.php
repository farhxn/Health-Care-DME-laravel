<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormPOSType extends Model
{
    use HasFactory;
    protected $fillable = [
        'Code',
        'Description',
    ];
}
