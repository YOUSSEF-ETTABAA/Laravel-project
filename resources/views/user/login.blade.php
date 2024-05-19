@extends('layouts.user.app2')
@section('title')
Login
@endsection

@section('content')
<style>
    html {
        height: 100%;
    }
    body {
        margin:0;
        padding:0;
        font-family: sans-serif;
        background: #3b5d50;
    }
</style>
<div class="login-box">
    <h2>Login</h2>
    <form action="{{ route('login.sumbit') }}" method="POST">
        @csrf
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="user-box">
            <input type="email" name="email" required="">
            <label>Email</label>
        </div>
        <div class="user-box">
            <input type="password" name="password" required="">
            <label>Password</label>
        </div>
        <button type="submit">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            Submit
        </button>
    </form>
    <br>
    <div class="not-member">
        Not a member?
        <span class="signUp">
            <a href="{{ route('signUp') }}" style="color: #ff7200">Register Now</a>
        </span>
    </div>
</div>
@endsection
