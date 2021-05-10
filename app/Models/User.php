<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;

    protected $table = 'user';
    protected $primaryKey = 'user_id';
    public $timestamps = false;

    protected $fillable = [
        'emri',
        'mbiemri',
        'emaili',
        'password'
    ];

    protected $hidden = [
        'password'
    ];

    protected $guarded = [
        'emri',
        'mbiemri',
        'email'
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function shporte() {
        return $this->hasMany(shporte::class);
    }

    public function historikuIBlerjes() {
        return $this->hasMany(historikuIBlerjes::Class);
    }
    public function getJWTIdentifier() {
        return $this->getKey();
    }

    public function getJWTCustomClaims() {
        return [];
    }
}
