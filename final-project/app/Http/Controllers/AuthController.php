<?php

namespace App\Http\Controllers;
use Auth; 

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function logout(){
        Auth::logout(); 

        //redirect

        return redirect()->route('auth.login');
    }

    public function loginForm(){
        return view('auth/login'); 
    }

    public function login(Request $request){

        $request->validate([
            'username' => 'required|string|max:245',
            'password' => 'required',
        ]);

        $wasLoginSuccessful = Auth::attempt([
            'username'=>$request->input('username'),
            'password'=>$request->input('password'),
        ]);

        if($wasLoginSuccessful){
            return redirect()->route('profile.index');
        } 

        return redirect()-> route('auth.login')->with('incorrect', 'Password and/or Username does not match');
    }
}
