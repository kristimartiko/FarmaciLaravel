<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistorikuIBlerjes extends Model
{
    use HasFactory;

    protected $table = 'historikuiblerjes';
    protected $primaryKey = 'historik_id';
    public $timestamps = false;

    protected $fillable = [
        'sasi',
        'data',
        'product_id',
        'user_id'
    ];

    public function product() {
        return $this->belongsTo(Produkt::class, 'product_id', 'product_id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
    
}
