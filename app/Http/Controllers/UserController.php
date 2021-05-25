<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use app\Models\User;

class UserController extends Controller
{
    public function deleteUser($id) {
        DB::table('user')->where('user_id', '=', $id)->delete();
        DB::table('user_role')->where('user_id', '=', $id)->delete();
    }

    public function getUsers() {
        return DB::table('user')->select('user.*')->get();
    }

    public function updateUser(Request $request, $user_id) {
        $user = User::find($user_id);
        $user->update($request->all());
        return $user;
    }

}
