<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\Models\Produkt;
use app\Models\DepoFarmacie;
use Illuminate\Support\Facades\DB;

class ProduktController extends Controller
{
    public function getAllProducts() {
        return DB::table('produkt')
        ->select('produkt.*')
        ->join('depofarmacie', function($join) {
            $join->on('produkt.product_id','=','depofarmacie.product_id')
            ->where('depofarmacie.sasi', '>', 0);
        })
        ->get();
    }
}
