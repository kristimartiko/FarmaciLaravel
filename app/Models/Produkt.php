<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Produkt extends Model
{
    use HasFactory;

    protected $table = 'produkt';
    protected $timestamps = false;
    protected $primaryKey = 'product_id';

    protected $fillable = [
        'emri',
        'cmimi',
        'imazhi',
        'pershkrimi'
    ];

    public function shporte() {
        return $this->hasMany(Shporte::class);
    }

    public function depoFarmacie() {
        return $this->hasOne(depoFarmacie::class);
    }

    public function historikuIBlerjes() {
        return $this->hasMany(historikuIBlerjes::class);
    }

    
}
