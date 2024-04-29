<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; 
use Hash; 
use Auth; 

class RegistrationController extends Controller
{
    public function index(){
        return view('registration/index'); 
    }

    public function register(Request $request){
        $request->validate([
            'username' => 'required|string|max:245',
            'password' => 'required',
        ]);




        $user = new User();
        $user->username = $request->input('username'); 
        $user->password = Hash::make($request->input('password')); 
        $user->save(); 

        Auth::login($user);

        return redirect() -> route('profile.index')->with('success', 'Successfully created an account!') ;
    }
}
