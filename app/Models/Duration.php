<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Duration extends Model
{
    use HasFactory;
    protected $fillable = [
        'start_time', 'end_time' ,'service_id','hall_id'
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function hall()
    {
        return $this->belongsTo(Hall::class);
    }

}
