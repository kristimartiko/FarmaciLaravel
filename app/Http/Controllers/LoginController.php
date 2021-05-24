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
        $emaili = $request->emaili;
        $password = $request->password;

        $token = auth()->attempt(compact('emaili', 'password'));

        if(!$token = auth()->attempt(compact('emaili', 'password'))) {
            $this->reportable(function (InvalidOrderException $e) {
                return "Invalid Email/Password";
            });
        }
        return response()->json($token);
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

        $user = User::where('emaili', '=', $request->emaili)->first();
        if($user === null) {

        $valrequest = User::create(compact('emri', 'mbiemri', 'emaili', 'password'));
          
        DB::table('user_role')->insert([
            'user_id' => $valrequest->user_id,
            'role_id' => 1
        ]);
        
        return response()->json([
            'message' => 'Great success',
            'valrequest' => $valrequest, 201
        ]);
        } else {
            $this->reportable(function (InvalidOrderException $e) {
                return "Email Exists";
            });
        }
    }

    public function getActualUser() {
        return auth()->user();
    }

    public function logout() {
        auth()->logout();
        return response()->json(['message' => 'User successfully signed out']);
    }

    public function isAdmin() {
        $user_id = Auth::id();
        $role = DB::table('user_role')->where('user_id', '=', $user_id)->first();
        if($role->role_id == 1) {
            return response()->json("User");
        } else return response()->json("Admin"); 
    }
}
