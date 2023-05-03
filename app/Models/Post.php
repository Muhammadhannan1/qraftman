<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
    'userId',
    'postTypeId',
    'projectTitle',
    'description',
    'location',
    'latitude',
    'longitude',
    'startDateTime',
    'endDateTime',
    'status',
    'image',
    'numberOfWorkers',
    'serviceId',
    'requiredId',
    ];
}
