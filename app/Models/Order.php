<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    // protected $table="order";

    protected $fillable = [
        'final_price','user_id','cemetery_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function book_duration()
    {
        return $this->hasMany(BookDuration::class);
    }

    public function cemetery()
    {
        return $this->belongsTo(cemetery::class);
    }


}
