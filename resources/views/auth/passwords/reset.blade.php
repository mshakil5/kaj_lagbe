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
    <form class="custom-form contact-form" method="POST" action="{{ route('password.update') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">

        <h2>Reset Password</h2>

        @if (session('status'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ session('status') }}</strong>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>{{ $errors->first() }}</strong>
            </div>
        @endif

        <div class="row mb-3">
            <div class="col-12">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus placeholder="Email">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-12">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="New Password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-12">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password">
            </div>
        </div>

        <button type="submit" class="mt-1">Reset Password</button>
    </form>
</div>

@endsection