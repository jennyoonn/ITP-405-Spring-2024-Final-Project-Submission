<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task; 
use App\Models\User;
use App\Models\Comment;
use Auth; 

class TaskController extends Controller
{
    public function quicknote(){
        return view('task.quick');
    }



    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string|max:245',
            'user' => 'nullable|string',
        ]);
        
        // Create a new task
        $task = new Task();
        $task->content = $request->input('content');
        $task->user_id = Auth::id(); // Assign the task to the currently authenticated user
        $task->save();
        
        // If another user is specified, associate the task with that user
        if ($request->filled('user')) {
            $username = $request->input('user');
            $user = User::where('username', $username)->first();
            
            if ($user) {
                // Associate the task with the specified user
                $task->users()->attach($user->id);
            } else {
                return redirect()->route('task.quick')->with('error', 'User with username ' . $username . ' does not exist');
            }
        }
        
        // Associate the task with the currently authenticated user
        $task->users()->attach(Auth::id());
        
        return redirect()->route('task.quick')->with('success', $task->content . ' added to list successfully');
    }
    


    

    

    public function view()
    {
        if (!Auth::check()) {
            return redirect()->route('auth.login');
        }

        return view('task.todo', [
            'tasks' => Task::where('user_id', Auth::id())->limit(10)->get(),
        ]);
    }

    public function delete(Request $request)
    {
        $selectedTaskIds = $request->input('tasks');

        if (empty($selectedTaskIds)) {
            return redirect()->route('task.team')->with('empty', 'No task selected.');


        } else{

            Task::where('id', $selectedTaskIds)->delete();
    
    
            return redirect()
                ->route('task.view')
                ->with('success', 'Tasks deleted successfully.');
        }


    }

    public function update(Request $request)
    {
        $taskIds = $request->input('task_ids'); 
        $task = Task::find($taskIds); 
        $task->priority = $request->input('priorities'); 
        $task->status = $request->input('status'); 
        
        $favoriteTask = $request->input('favorites');
        if (!empty($favoriteTask)) {
            $task->favorite = true; 
        } else{
            $task->favorite = false; 
        }
        $task->save();

        $deleteTaskId = $request->input('delete_tasks');
        if (!empty($deleteTaskId)) {
            Task::where('user_id', Auth::id())->where('id', $deleteTaskId)->delete();
        }


        return redirect()->route('task.view')->with('success', 'Task updated successfully'); 

    }

    public function team(){

        if (!Auth::check()) {
            return redirect()->route('auth.login');
        }
    
        $shared_tasks = Task::whereHas('users', function($query) {
            $query->where('user_id', Auth::id());
        })->get();
    
        return view('task.team', compact('shared_tasks'));
    }

    // public function comment(Request $request, $taskId)
    // {
    //     $request->validate([
    //         'content' => 'required|string',
    //     ]);

    //     $task = Task::find($taskId);

    //     if (!$task) {
    //         return redirect()->route('task.team')->with('error', 'Task not found.');
    //     }

    //     $comment = new Comment();
    //     $comment->content = $request->input('content');
    //     $comment->user_id = Auth::id();
    //     $comment->task_id = $taskId;
    //     $comment->save();

    //     return redirect()->route('task.team')->with('success', 'Comment added successfully.');
    // }

};
