@extends('layout')

@section('title', 'Edit Comment')

@section('main')
<div class="task-wrapper">
    <h1>Edit Comment</h1>
    <form method="POST" action="{{ route('comment.update', ['comment' => $comment->id]) }}">
        @csrf
        <div class="form-group">
            <label for="content">Comment</label>
            <textarea name="content" class="form-control" rows="3">{{ $comment->content }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update Comment</button>
    </form>
</div>
@endsection
