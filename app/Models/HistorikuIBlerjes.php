<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistorikuIBlerjes extends Model
{
    use HasFactory;

    protected $fillable = [
        'sasi',
        'data',
        'product_id',
        'user_id'
    ];

    public $timestamps = false;
}
