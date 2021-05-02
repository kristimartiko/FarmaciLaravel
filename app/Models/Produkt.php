<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produkt extends Model
{
    use HasFactory;

    protected $table = 'produkt';
    protected $timestamps = false;

    protected $fillable = [
        'emri',
        'cmimi',
        'imazhi',
        'pershkrimi'
    ];
}
