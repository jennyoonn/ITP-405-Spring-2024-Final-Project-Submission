<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request; 
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\CommentController; 


Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function(){
    return view('home'); 
}); 

Route::get('/profile', function(){
    return view('home'); 
})->name('profile.index');

//registration page
Route::get('/register',[RegistrationController::class, 'index'])->name('registration.index'); 
Route::post('/register',[RegistrationController::class, 'register'])->name('registration.create'); 

//login page
Route::get('/login', [AuthController::class, 'loginForm'])->name('auth.login'); 
Route::post('/login', [AuthController::class, 'login'])->name('login');

//quick tasks 
Route::get('/tasks', [TaskController::class, 'quicknote'])->name('task.quick'); 
Route::post('/tasks', [TaskController::class, 'store'])->name('task.store');

//todo task page
Route::get('/tasks/todo', [TaskController::class, 'view'])->name('task.view');
Route::post('/tasks/delete', [TaskController::class, 'delete'])->name('task.delete');
Route::post('/tasks/todo', [TaskController::class, 'update'])->name('task.update');

//todo group tasks 
Route::get('/tasks/team', [TaskController::class, 'team'])->name('task.team'); 
Route::post('/tasks/{task}/comment', [CommentController::class, 'comment'])->name('comment.store'); 
Route::post('/tasks/{comment}/delete', [CommentController::class, 'delete'])->name('comment.delete'); 
Route::get('/tasks/{comment}/edit', [CommentController::class, 'edit'])->name('comment.edit'); 
Route::post('/tasks/{comment}/update', [CommentController::class, 'update'])->name('comment.update'); 

//reddit API 

Route::get('/tasks/reddit', function(Request $request){

    $subreddit = $request->input('subreddit'); 

    $term = urlencode($subreddit); 
    $response = Http::get("https://www.reddit.com/r/$term.json"); 


    $cacheKey="reddit-api-$term";
    $seconds = 60; 
    Cache::remember($cacheKey, $seconds, function() use ($term) {
        $response = Http::get("https://www.reddit.com/r/$term.json"); 
        return $response->object(); 
    });

    // dd($response->object()); 

    return view('api/reddit', [
        'response'=> $response->object(),
        'subreddit' => $subreddit,
    ]);
})->name('reddit.forum'); 

Route::middleware(['auth']) ->group(function(){
    //profile pages
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    //logout
    Route::post('logout', [AuthController::class, 'logout'])->name('auth.logout');
    
});