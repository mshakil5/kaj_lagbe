@extends('layouts.master')

@section('content')

<style>
    .login-form-container {
        margin-top: 50px;
        margin-bottom: 50px;
        background-color: #ffffff;
        padding: 40px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .login-form-container h2 {
        color: rgb(0, 88, 162);
        font-size: 34px;
        margin-bottom: 20px;
        text-align: center;
    }

    .login-form-container input {
        border: 1px solid #e0e0e0;
        border-radius: 5px;
        padding: 10px;
        margin-bottom: 15px;
        width: 100%;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    .login-form-container button {
        background-color: #d71920;
        color: #fff;
        padding: 10px;
        border: none;
        border-radius: 5px;
        width: 100%;
        cursor: pointer; 
        font-weight: 600;
    }

    .login-form-container button:hover {
        background-color: #b7151e;
    }
</style>

<div class="col-lg-4 col-12 mx-auto login-form-container">
    <form class="custom-form contact-form" method="POST" action="{{ route('login') }}" role="form">
        @csrf
        <h2>Login</h2>

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>{{ session('error') }}</strong>
            </div>
        @endif

        <div class="row mt-3">
            <div class="col-12">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <button type="submit" class="mt-1">Log In</button>

        <div class="row mt-3">
            <div class="col-12 text-center">
                <a href="{{ route('password.request.form') }}" class="btn btn-link">Forgot Password?</a>
                <br>
                <a href="{{ route('register') }}" class="btn btn-link">Register?</a>
            </div>
        </div>

    </form>
</div>

@endsection