<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produkt;
use App\Models\DepoFarmacie;
use Illuminate\Support\Facades\DB;
use Validator;

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

    public function addProduct(Request $request) {
        $request->validate([
            'emri' => 'required',
            'cmimi' => 'required',
            'imazhi' => 'required',
            'pershkrimi' => 'required'
        ]);
        $emri = $request->emri;
        $cmimi = $request->cmimi;
        $imazhi = $request->imazhi;
        $pershkrimi = $request->pershkrimi;
        DB::table('produkt')->insert([
            'emri' => $emri,
            'cmimi' => $cmimi,
            'imazhi' => $imazhi,
            'pershkrimi' => $pershkrimi
        ]);
    }

    public function addQuantity(Request $request, $id) {
        $request->validate([
            'sasi' => 'required'
        ]);
        $sasi = $request->sasi;
        DB::table('depofarmacie')->insert([
            'sasi' => $sasi,
            'product_id' => $id
        ]);
    }

    
}
