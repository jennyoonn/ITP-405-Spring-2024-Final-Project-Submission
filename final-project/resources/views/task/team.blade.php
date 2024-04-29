@extends('layout')

@section('title', 'Team Tasks')

@section('main')
<div class="task-wrapper team">
    <h1 class="team-header">Team Tasks</h1>
    <!-- Display shared tasks here -->
    @if ($shared_tasks->isEmpty())
        <div class="announce">No tasks shared with you yet.</div>
    @else
        <div class="team-section">
            @foreach ($shared_tasks as $task)
                <div class="task-box">
                        <form class="team-delete" method="POST" action="{{ route('task.delete')}}">
                            @csrf
                            <input type="checkbox" class="custom-check" id="task{{ $task->id }}" name="tasks" value="{{ $task->id }}">
                            <button type="submit" class="btn btn-sm btn-danger team-btn">Mark as Done</button>
                        </form>
                    <div class="teamtask-title">{{ $task->content }}</div>
                    <div class="team-members">
                        @foreach ($task->users as $user)
                            {{ $user->username }},
                        @endforeach
                    </div>
                    <!-- Add a comment section for each task -->
                    <div class="comment-section">
                        <h3>Comments</h3>
                            @if ($task->comments->isEmpty())
                            <div>
                                No Comments for this post yet...
                            </div>
                            @endif
                            @foreach ($task->comments()->latest()->get() as $comment)
                                <div class="comment-content">
                                    <div class="comment-left">
                                        <div class="commenter">{{ $comment->user->username }}</div>
                                        <span class="comment-timestamp">{{ $comment->created_at }}</span>
                                        <div class="actual-comment">{{ $comment->content }}</div>
                                    </div>
                                    @if ($comment->user_id === Auth::id())
                                    <div class="comment-btn">
                                        <form method="POST" action="{{ route('comment.delete', ['comment' => $comment->id]) }}">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-danger team-btn btn-comment">Delete</button>
                                        </form>
                                        <a href="{{ route('comment.edit', ['comment' => $comment->id]) }}" class="btn btn-sm btn-primary btn-edit">Edit</a>
                                    </div>
                                    @endif
                                </div>
                            @endforeach

                        <!-- Form to add a new comment -->
                        <form method="POST" action="{{ route('comment.store', ['task' => $task->id]) }}">
                            @csrf
                            <div class="form-group">
                                <textarea name="content" class="form-control" rows="3" placeholder="Add a comment"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Add Comment</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
