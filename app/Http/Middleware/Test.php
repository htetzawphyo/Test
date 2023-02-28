<?php

namespace App\Http\Middleware;

use App\Models\Permissions;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Test
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
        $permission_ids = Permissions::all(['id']);
        $user_permissions = [];

        foreach(Auth::user()->roles->permissions as $permission){
            $user_permissions[] = $permission->id;
        }

        foreach($permission_ids as $per_id){
            $check = in_array($per_id->id,$user_permissions);
            if(!$check){
                return back()->with('message', 'Unauthorize');
            }
        } 
        return $next($request);
    }
}
