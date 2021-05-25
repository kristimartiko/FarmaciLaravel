<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produkt;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\HistorikuIBlerjes;

class ShporteController extends Controller
{
    public function shtoNeShporte($id) {
        if (Auth::check()) {
         $user_id = Auth::id();
        }
        $is_present = DB::table('shporta')->where('product_id','=', $id)->where('user_id', '=', $user_id)->first();
        if($is_present) {
            return DB::table('shporta')->increment('sasi')->where('product_id', '=', $id);
        } if(!$is_present) {
            return DB::table('shporta')->insert([
                'sasi' => 1,
                'product_id' => $id,
                'user_id' => $user_id
            ]);
        }
    }

    public function getShporte() {
           $user_id = Auth::id();
           $shporta = DB::table('shporta')->where('user_id', '=', $user_id)->get();
           foreach($shporta as $shporte) {
               return DB::select("SELECT produkt.product_id, produkt.emri, produkt.cmimi, shporta.sasi, shporta.shporte_id from produkt join shporta on produkt.product_id = shporta.product_id where shporta.user_id = '$user_id'");
           }
    }

    public function shtoSasi($id) {
        DB::table('shporta')->where('shporte_id', '=', $id)->increment('sasi');
    }

    public function hiqSasi($id) {
        DB::table('shporta')->where('shporte_id', '=', $id)->decrement('sasi');
    }

    public function fshij($id) {
        DB::table('shporta')->where('shporte_id', '=', $id)->delete();
    }

    public function purchase() {
        $user = Auth::id();
        $date = date("Y/m/d");
        $purchases = DB::table('shporta')->where('user_id', '=', $user)->get();
        foreach($purchases as $purchase) {
            DB::table('historikuiblerjes')->insert([
                'sasi' => $purchase->sasi,
                'data' => $date,
                'product_id' => $purchase->product_id,
                'user_id' => $user
            ]);
            $sasiHistorik = DB::table('depofarmacie')->select('depofarmacie.sasi')->where('product_id', '=', $purchase->product_id)->get();
            $sasiResult = $sasiHistorik[0]->sasi - $purchase->sasi;
            DB::table('depofarmacie')->where('product_id', '=', $purchase->product_id)->update(['sasi' => $sasiResult]);
        }
        DB::table('shporta')->where('user_id', '=', $user)->delete();
    }

    public function getPurchases() {
        $user = Auth::id();
        $historik = DB::table('historikuiblerjes')->where('user_id', '=', $user)->get();
        foreach($historik as $hist) {
            return DB::select("SELECT produkt.product_id, produkt.emri, historikuiblerjes.sasi, historikuiblerjes.data, historikuiblerjes.historik_id from produkt join historikuiblerjes on produkt.product_id = historikuiblerjes.product_id where historikuiblerjes.user_id = '$user'");
        }
    }
}
