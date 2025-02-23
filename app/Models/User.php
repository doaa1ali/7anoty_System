<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{

    use HasFactory, Notifiable;

    protected $fillable = ['name','email','password','phone','location','image','type' ];

    public function cemeteries()
    {
       return $this->hasMany(Cemetery::class);
    }


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

    public function halls()
    {
        return $this->hasMany(Hall::class, 'user_id'); // A User has many Halls
    }
}
