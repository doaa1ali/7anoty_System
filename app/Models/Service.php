<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'name', 'description', 'price', 'location', 'lat', 'long', 'is_discount', 'discount', 'start_time', 'end_time', 'image',
    ];
}
