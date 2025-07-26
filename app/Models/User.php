<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'email',
        'password',
        'user_role',
        'account_type',
        'otp_code',
        'is_verified',
    ];

    protected $hidden = [
        'password',
        'remember_token',  
    ];

    // Relations
    public function solo()
    {
        return $this->hasOne(Solo::class);
    }

    public function company()
    {
        return $this->hasOne(Company::class);
    }
}
