<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'cemetery_id', 'final_price'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function bookDurations()
    {
        return $this->hasMany(BookDuration::class, 'order_id');
    }

    public function cemetery()
    {
        return $this->belongsTo(Cemetery::class);
    }
    
}
