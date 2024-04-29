@extends('layout')

@section('title', 'Add To List')

@section('main')
<div class="task-wrapper">
    <div class="task-form">
        <h1>Add to Your Todo List: </h1>
        @if(session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <form method="post" action="{{ route('task.store') }}" id="addTaskForm">
            @csrf
            <div class="mb-3">
                <label for="content" class="form-label">Task Title</label>
                <input type="text" class="form-control @error('content') is-invalid @enderror" id="content" name="content" placeholder="e.g. Finish homework">
                @error('content')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="user" class="form-label">Assign to Team Members (Enter username of your team member)</label>
                <input type="text" class="form-control" id="user" name="user" placeholder="e.g., user1">
            </div>
            <button type="submit" class="btn btn-primary">Add Task</button>
        </form>
    </div>
</div>
@endsection

