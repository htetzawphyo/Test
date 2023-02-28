<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleUpdate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user_permissions = [];
        foreach(Auth::user()->roles->permissions as $permission){
            $user_permissions[] = $permission->id;
        }
        
        $check = in_array(7,$user_permissions);
        if(!$check){
            return back()->with('message', 'Unauthorize');
        }
        return $next($request);
    }
}
