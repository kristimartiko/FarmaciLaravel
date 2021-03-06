<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shporte extends Model
{
    use HasFactory;

    protected $table = 'shporta';
    protected $primaryKey = 'shporte_id';
    public $timestamps = false;

    protected $fillable = [
        'sasi',
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
