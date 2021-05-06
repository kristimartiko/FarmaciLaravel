<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\User_Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public function login(Request $request) {
        $request->validate([
            'emaili' => 'required',
            'password' => 'required'
        ]);
        $email = $request->email;
        $password = $request->password;

        $token = auth()->attempt(compact('emaili', 'password'));

        if(!$token = auth()->attempt(compact('emaili', 'password'))) {
            return response()->json(['error' => 'Incorrect email/password']);
        }
        return resonse()->json(['token' => $token]);
    }

    public function register(Request $request) {
        $request->validate([
            'emri' => 'required',
            'mbiemri' => 'required',
            'emaili' => 'required',
            'password' => 'required'
        ]);

        $emri = $request->emri;
        $mbiemri = $request->mbiemri;
        $emaili = $request->emaili;
        $password = Hash::make($request->password);

        $valrequest = User::create($request->all());
        $role_id = DB::table('role')->select('role_id')->where('emriRolit', '=', 'User')->get();
        
      
        DB::table('user_role')->insert([
            'user_id' => $valrequest->user_id,
            'role_id' => 1
        ]);
        
        return response()->json([
            'message' => 'Great success',
            'valrequest' => $valrequest, 201
        ]);
    }

    public function getActualUser() {
        return auth()->user();
    }

    public function logout() {
        auth()->logout();
        return response()->json(['message' => 'User successfully signed out']);
    }
}
