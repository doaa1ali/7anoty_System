<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookDuration extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'service_id', 'hall_id', 'duration_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function hall()
    {
        return $this->belongsTo(Hall::class);
    }

    public function duration()
    {
        return $this->belongsTo(Duration::class);
    }
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

}
