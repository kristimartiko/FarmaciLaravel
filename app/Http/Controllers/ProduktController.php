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
            'pershkrimi' => 'required',
            'sasi' => 'required'
        ]);
        $emri = $request->emri;
        $cmimi = $request->cmimi;
        $imazhi = $request->imazhi;
        $pershkrimi = $request->pershkrimi;
        $sasi = $request->sasi;

        $request->except('sasi');

        $valrequest = Produkt::create($request->all());

        DB::table('depofarmacie')->insert([
            'sasi' => $sasi,
            'product_id' => $valrequest->product_id
        ]);
    }    

    public function destroy($id) {
        Produkt::destroy($id);
        DB::table('depofarmacie')->where('product_id', '=', $id)->delete();
    }

    public function update(Request $request, $id) {
        $product = Produkt::find($id);
        $product->update($request->all());
        return $product;
    }

}
