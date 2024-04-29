<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth; 
use App\Models\Task; 
use App\Models\User;
use App\Models\Comment;

class ProfileController extends Controller
{
    public function index(){
        if (!Auth::check()) {
            return redirect()->route('auth.login');
        }

        return view('profile/index', [
            'tasks' => Task::where('user_id', Auth::id())->where('favorite', true)->get(),
            'user' => Auth::user(), 
        ]);
    }
}
