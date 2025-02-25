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

    protected $fillable = ['id','name','email','password','phone','location','image','type', 'role' ];

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

    public function hasRole(string $role): bool
    {
        return $this->role === $role;
    }

    public function services()
    {
        return $this->hasMany(Service::class);

    }
    public function halls()
    {
        return $this->hasMany(Hall::class, 'user_id'); // A User has many Halls
    }
}
