@extends('layouts.master')
@section('content')

<style>
    .login-form-container {
        margin-top: 50px;
        margin-bottom: 50px;
    }
</style>

<div class="col-lg-5 col-12 mx-auto login-form-container">
    <form class="custom-form contact-form" method="POST" action="{{ route('login') }}" role="form">
        @csrf
        <h2>Login</h2>

        @if (isset($message))
            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                <strong>{{ $message }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="row">
            <div class="col-12">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="" required autocomplete="email" autofocus placeholder="Email">
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

        <button type="submit" class="form-control">Sign In</button>
    </form>
</div>

@endsection
