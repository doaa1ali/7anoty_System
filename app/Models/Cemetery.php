<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cemetery extends Model
{

    protected $fillable = ['name', 'description', 'location', 'lat', 'long', 'size', 'image', 'price', 'is_discount', 'discount', 'user_id'];

    public function user()
    {
       return $this->belongsTo(User::class);
    }
}
