@extends('layout')

@section('title', 'All Tasks')

@section('main')

<div class="task-wrapper">
    <h1>Personal Tasks</h1>
    @if(session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @elseif(session('empty'))
        <div class="alert alert-danger" role="alert">
            {{ session('empty') }}
        </div>
    @endif

    <div class="task-form">
        @if ($tasks->isEmpty())
            <div class="announce">To-Do List is empty, you are all caught up!</div>
            <a href="{{ route('task.quick') }}">Add to your list!</a>
        @else
        <form id="taskForm" method="POST" action="{{ route('task.update') }}">
            @csrf
            <table class="table">
                <thead>
                    <tr>
                        <th></th>
                        <th>Task</th>
                        <th>Priority</th>
                        <th>Status</th>
                        <th>Bookmark</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tasks as $task)
                    <tr>
                        <td>
                            <input class="custom-check" type="checkbox" name="delete_tasks" value="{{ $task->id }}">
                            <input type="hidden" name="task_ids" value="{{ $task->id }}">
                        </td>
                        <td>
                            <label for="task{{ $task->id }}">{{ $task->content }}</label>
                        </td>
                        <td>
                            <select name="priorities" class="dropdown">
                                <option value="low" {{ $task->priority === 'low' ? 'selected' : '' }}>Low</option>
                                <option value="medium" {{ $task->priority === 'medium' ? 'selected' : '' }}>Medium</option>
                                <option value="high" {{ $task->priority === 'high' ? 'selected' : '' }}>High</option>
                            </select>
                            <input type="hidden" name="task_ids" value="{{ $task->id }}">
                        </td>
                        <td>
                            <select name="status" class="dropdown">
                                <option value="pending" {{ $task->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="in_progress" {{ $task->status === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                <option value="completed" {{ $task->status === 'completed' ? 'selected' : '' }}>Completed</option>
                            </select>
                            <input type="hidden" name="task_ids" value="{{ $task->id }}">
                        </td>
                        <td>
                            <input type="checkbox" class="custom-check" name="favorites" value="{{ $task->id }}" {{ $task->favorite ? 'checked' : '' }}>
                            <input type="hidden" name="task_ids" value="{{ $task->id }}">

                        </td>
                        <td>
                            <button type="submit" class="btn btn-primary update">Update Tasks</button>
                        <td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </form>
        @endif
    </div>
</div>
@endsection
