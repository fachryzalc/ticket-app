@extends('user.main')
@include('sweetalert::alert')

@section('style')
    @vite(['resources/css/app.css', 'resources/css/user/register.css', 'resources/js/app.js'])
@endsection

@section('container')
    <div class="login-box">
        <div class="title1 flex">Register</div>
        <div class="title2 flex">Create your account.</div>
        <form class="input" action="/register" method="post">
            @csrf
            <input class="name @error('name') 
            is-invalid
            @enderror" name="name" autofocus
                type="text" placeholder="Full Name" value="{{ old('name') }}">
            @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
            <input class="username @error('username') 
            is-invalid 
            @enderror" name="username"
                type="text"placeholder="Username" value="{{ old('username') }}">
            @error('username')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
            <input class="password @error('password')
                is-invalid
            @enderror" name="password"
                type="password" placeholder="Password">
            @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
            <input class="password @error('password')
            is-invalid
        @enderror" name="confirm_password"
                type="password" placeholder="Confirm Password">
            @error('confirm_password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
            <button class="btn" type="submit">Register</button>
        </form>
        <div class="register">
            Have an account? <a href="/login" class="register-link">Sign in</a>
        </div>
    </div>
@endsection
