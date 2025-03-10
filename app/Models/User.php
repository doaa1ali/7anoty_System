<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $fillable = ['name','email','password','phone','location','lat','long','image','type','access_token' ];

    protected $hidden = [
        'password',
    ];


    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function cemeteries()
    {
       return $this->hasMany(Cemetery::class);
    }

    public function bookDurations()
    {
        return $this->hasMany(BookDuration::class, 'user_id');
    }

    public function hall()
    {
       return $this->hasMany(Hall::class);
    }

    public function services()
    {
       return $this->belongsToMany(Service::class, 'service_user');
    }
}
