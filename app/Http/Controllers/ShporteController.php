<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produkt;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
}
