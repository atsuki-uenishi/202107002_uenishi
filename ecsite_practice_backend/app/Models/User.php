<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory;

    protected $guarded = array('id');

    public static $rules = array(
        'name' => 'required | min:4',
        'email' => 'required | email',
        'password' => 'required | min:6'
    );

    public $hidden = [
        'password',
        'remember_token'
    ];

    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
