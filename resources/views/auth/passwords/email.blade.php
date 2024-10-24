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

    #loading {
        position: fixed;
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        opacity: 0.7;
        background-color: #fff;
        z-index: 99;
    }

    #loading-image {
        z-index: 100;
    }
</style>

<div class="col-lg-4 col-12 mx-auto login-form-container">
    <form id="resetPasswordForm" class="custom-form contact-form" method="POST" action="{{ route('password.email') }}" role="form">
        @csrf
        <h2>Password Reset</h2>

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>{{ session('error') }}</strong>
            </div>
        @endif

        @if (session('status'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ session('status') }}</strong>
            </div>
        @endif

        <div class="row mt-3">
            <div class="col-12">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ Auth::check() ? Auth::user()->email : old('email') }}" required autocomplete="email" autofocus placeholder="Email">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <button type="submit" class="mt-1">Send Password Reset Link</button>

        <div id='loading' style='display:none ;'>
            <img src="{{ asset('loader.gif') }}" id="loading-image" alt="Loading..." />
        </div>

    </form>
</div>

@endsection

@section('script')


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('resetPasswordForm');
        const loadingDiv = document.getElementById('loading');

        form.addEventListener('submit', function() {
            loadingDiv.style.display = 'flex';
        });
    });
</script>

@endsection