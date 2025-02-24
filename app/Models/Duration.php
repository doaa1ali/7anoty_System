<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Duration extends Model
{
protected $table="duration";
    protected $fillable = [
        'service_id','hall_id', 'start_time', 'end_time'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
