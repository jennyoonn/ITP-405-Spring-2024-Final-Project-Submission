@extends('layout')

@section('title', 'profile')

@section('main')
    <div class="profile-wrapper"> 
        <div class="profile-title">
            Welcome Back {{$user->username}}
        </div>
        <div class="favorites">
        @if($tasks->isEmpty())
            <div class="profile-message">Currently no tasks bookmarked.</p>
        @else
            <h2>Bookmarked Tasks</h2>
            <div class="task-box">
                @foreach($tasks as $task)
                    <div>{{ $task->content }}</div>
                @endforeach
            </div>
        @endif
    </div>
    </div>
@endsection
