@extends('layout')

@section('title', 'Login')

@section('main')
<div class="auth-wrapper">
    <div class="auth-form">
        <h1>Login</h1>
        <p>Hey, welcome back 👋</p>
        @if(session('incorrect'))
         <div class="alert alert-danger" role="alert">
            {{session('incorrect')}}
        </div>
        @endif
        <form method="post" action="{{ route('auth.login') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label" for="username">Username</label>
                <input type="text" id="username" name="username" class="form-control @error('content') is-invalid @enderror">
                @error('username')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label" for="password">Password</label>
                <input type="password" id="password" name="password" class="form-control @error('content') is-invalid @enderror">
                @error('password')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <input type="submit" value="Login" class="btn btn-primary">
        </form>
    </div>
    
    <div> Don't Have an Account? <a href="{{ route('registration.index') }}" > Create an Account ↗ </a>


</div>



@endsection