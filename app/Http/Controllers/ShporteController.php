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
            return DB::table('shporta')->increment('sasi');
        } if(!$is_present) {
            return DB::table('shporta')->insert([
                'sasi' => 1,
                'product_id' => $id,
                'user_id' => $user_id
            ]);
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
        $purchased = HistorikuIBlerjes::where('user_id', '=', $user)->get();
        DB::table('historikuiblerjes')->insert([
            'sasi' => $purchased->sasi,
            'data' => $date,
            'product_id' => $purchased->product_id,
            'user_id' => $user
        ]);
    }
}
