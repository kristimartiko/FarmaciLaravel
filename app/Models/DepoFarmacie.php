<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepoFarmacie extends Model
{
    use HasFactory;

    protected $table = 'depofarmacie';
    protected $primaryKey = 'depo_id';
    public $timestamps = false;
    
    protected $fillable = [
        'sasi',
        'product_id'
    ];

    public function product() {
        return $this->belongsTo(Produkt::Class, 'product_id', 'product_id');
    }
}
