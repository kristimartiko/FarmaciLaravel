<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(Request $request) {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
        $email = $request->email;
        $password = $request->password;

        $token = auth()->attempt(compact('email', 'password'));

        if(!$token = auth()->attempt(compact('email', 'password'))) {
            return response()->json(['error' => 'Incorrect email/password']);
        }
        return resonse()->json(['token' => $token]);
    }

    public function register(Request $request) {
        $request->validate([
            'emri' => 'register',
            'mbiemeri' => 'register',
            'email' => 'register',
            'password' => 'register'
        ]);
        $emri = $request->emri;
        $mbiemri = $request->mbiemri;
        $email = $request->email;
        $password = Hash::make($request->password);

        $valrequest = User::create(compact('emri', 'mbiemri', 'email', 'password'));

        return response()->json([
            'message' => 'Great Success',
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
