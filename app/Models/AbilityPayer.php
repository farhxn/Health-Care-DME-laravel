<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbilityPayer extends Model
{
    use HasFactory;
    protected $fillable =[
        'Code',
        'name',
        'Comment',
    ];
}
