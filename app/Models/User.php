<?php

namespace App\Models;
use DateTimeInterface;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;
    protected function serializeDate(DateTimeInterface $date){
        return $date->format('Y-m-d H:i:s');
    }
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        return [];
    }
    protected $fillable = [
        'openID',
        'session_key',
        'avatarUrl',
        'nickName',
        'province',
        'city',
        'country',
        'gender',
        'language',
    ];
    public function integration()
    {
        return $this->hasOne(Integration::class,'user_id','id');
    }
}
