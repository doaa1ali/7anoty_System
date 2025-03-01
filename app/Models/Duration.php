<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Duration extends Model
{
    use HasFactory;
   // protected $table="durations";
    protected $fillable = [
        'service_id','hall_id', 'start_time', 'end_time'
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
