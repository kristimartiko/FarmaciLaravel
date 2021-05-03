<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_Role extends Model
{
    use HasFactory;

    protected $table = 'user_role';
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'role_id'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function role() {
        return $this->belongsTo(Role::class, 'role_id', 'role_id');
    }
}
