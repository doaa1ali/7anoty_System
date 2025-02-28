<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'description', 'price', 'location', 'lat', 'long', 'is_discount', 'discount', 'start_time', 'end_time', 'image',
    ];


    public function order()
    {
        return $this->hasMany(Order::class);
    }

    //-------
    public function user()
{
    return $this->belongsToMany(User::class, 'order','service_id','user_id');

}
}
