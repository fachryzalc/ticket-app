@extends('user.main')


@section('style')
    @vite(['resources/css/app.css', 'resources/css/user/login.css', 'resources/js/app.js'])
@endsection
@section('container')
    @include('sweetalert::alert')
    <div class="login-box flex">
        <div>
            <div class="title1 flex">Login</div>
            <div class="title2 flex">Please sign in to continue.</div>
            <form class="input" action="/login" method="post">
                @csrf
                <input class="username" type="text" name="username" placeholder="Username" autofocus required>
                <input class="password" name="password" type="password" placeholder="Password" required>
                <button class="btn" type="submit">Sign In</button>
            </form>
            <div class="register">
                Don't have an account? <a href="/register" class="register-link">Sign up</a>
            </div>
        </div>
    </div>
@endsection
