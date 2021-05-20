<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class isAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        return $next($request);
    }
    
    public function isAdmin() {
        $user_id = Auth::id();
        $role = DB::table('user_role')->where('user_id', '=', $user_id)->first();
        if($role->role_id == 1) {
            return false;
        } else return true;
    }
}
