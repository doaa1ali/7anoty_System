<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hall extends Model
{

    protected $fillable = [
        'name', 'description', 'location', 'lat', 'long', 'price', 'seats', 'has_buffet', 'start_time', 'end_time', 'image','user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id'); // Hall belongs to a User
    }
}
