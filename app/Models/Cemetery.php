<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cemetery extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description', 'location','lat', 'long',  'size', 'image', 'price', 'is_discount', 'discount', 'user_id'];

    protected $hidden = [
        'created_at','updated_at',
    ];

    // protected $hidden=['lat', 'long'];
    public function user()
    {
       return $this->belongsTo(User::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
