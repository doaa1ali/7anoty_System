<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hall extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'description', 'location', 'lat', 'long', 'price', 'seats', 'has_buffet', 'start_time', 'end_time', 'image','user_id',
    ];

    public function durations()
    {
        return $this->hasMany(Duration::class);
    }

    public function user()
    {
       return $this->belongsTo(User::class);
    }
}
