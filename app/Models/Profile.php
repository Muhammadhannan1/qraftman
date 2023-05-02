<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    protected $fillable = [
        'userId',
        'companyName',
        'image',
        'organizationNum',
        'website',
        'companyDescription',
        'country',
        'city',
        'postaddress',
        'streetaddress',
        'zipcode',
        'number',
    ];
}
