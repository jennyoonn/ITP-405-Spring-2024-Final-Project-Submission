@extends('layout')

@section('title', 'Registration')

@section('main')
<div class="auth-wrapper">
    <div class="auth-form">
        <h1>Create an Account</h1>
        <p>Its so easy to get started ✨</p>

        <form method="post" action="{{ route('registration.create') }}">
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
            <input type="submit" value="Register" class="btn btn-primary">
        </form>
    </div>

    <div> Already Have an Account? <a href="{{ route('auth.login') }}" > LogIn ↗ </a>

</div>

@endsection