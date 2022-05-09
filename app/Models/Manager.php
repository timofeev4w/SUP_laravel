<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Contracts\Auth\Authenticatable;


class Manager extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'managers';

    protected $primary_key = 'id';

    protected $fillable = ['name', 'password'];

    protected $hidden = ['password'];

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
    }
}
