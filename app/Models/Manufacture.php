<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manufacture extends Model
{
    use HasFactory;
    protected $fillable =[
        'Fax',
        'Phone2',
        'Phone',
        'Zip',
        'State',
        'City',
        'Address',
        'Account',
        'Contact',
        'Manufacture_Name',
    ]; 
}
