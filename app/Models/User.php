<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Define role constants
    const ROLE_CREATOR = 'creator';
    const ROLE_ADMIN = 'admin';
    const ROLE_USER = 'user';

    protected $fillable = ['name','email','password','phone','location','lat','long','image','type' ];

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
}
