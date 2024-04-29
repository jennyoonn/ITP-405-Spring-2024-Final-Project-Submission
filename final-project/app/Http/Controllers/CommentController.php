<?php

namespace App\Http\Controllers;
use App\Models\Comment;
use App\Models\Task; 
use App\Models\User;
use Auth; 

use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function comment(Request $request, $taskId)
    {
        $request->validate([
            'content' => 'required|string',
        ]);

        $task = Task::find($taskId);

        if (!$task) {
            return redirect()->route('task.team')->with('error', 'Task not found.');
        }

        $comment = new Comment();
        $comment->content = $request->input('content');
        $comment->user_id = Auth::id();
        $comment->task_id = $taskId;
        $comment->save();

        return redirect()->route('task.team')->with('success', 'Comment added successfully.');
    }

    public function edit(Comment $comment)
    {
        if ($comment->user_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        return view('comments.edit', compact('comment'));
    }

    public function update(Request $request, Comment $comment)
    {
        // Only allow updating if the user owns the comment
        if ($comment->user_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        $request->validate([
            'content' => 'required|string',
        ]);

        $comment->content = $request->input('content');
        $comment->save();

        return redirect()->route('task.team')->with('success', 'Comment updated successfully.');
    } 

    public function delete(Comment $comment)
    {
        if ($comment->user_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        $comment->delete();

        return redirect()->route('task.team')->with('success', 'Comment deleted successfully.');
    }
}
