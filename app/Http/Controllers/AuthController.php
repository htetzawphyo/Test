<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function check(LoginRequest $request)
    {
        $userInfo = User::where('email', '=', $request->email)->first();

        if(!$userInfo){
            return back()->with('message', 'We do not recognize your email address');
        } 
        
        if($userInfo){
            if(Hash::check($request->password, $userInfo->password)){
                $request->session()->put('isUser', $userInfo->id);
                $user = User::where('id', '=', session('isUser'))->first();
                Auth::login($user);
                return redirect('home');
            } else {
                return back()->with('message', 'Incorrect password');
            }
        }
    }

    function logout(){
        if(session()->has('isUser')){
            session()->pull('isUser');
            return redirect('/login');
        }
    }
}
