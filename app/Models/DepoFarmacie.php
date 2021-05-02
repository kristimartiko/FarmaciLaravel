<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepoFarmacie extends Model
{
    use HasFactory;

    protected $fillable = [
        'sasi',
        'product_id'
    ];

    public $timestamps = false;
}
