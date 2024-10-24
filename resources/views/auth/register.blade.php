@extends('layouts.master')

@section('content')

<style>
    .register-form-container {
        margin-top: 50px;
        margin-bottom: 50px;
        background-color: #ffffff;
        padding: 40px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .register-form-container h2 {
        color: rgb(0, 88, 162);
        font-size: 34px;
        margin-bottom: 20px;
        text-align: center;
    }

    .register-form-container input {
        border: 1px solid #e0e0e0;
        border-radius: 5px;
        padding: 10px;
        margin-bottom: 15px;
        width: 100%;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    .register-form-container button {
        background-color: #d71920;
        color: #fff;
        padding: 10px;
        border: none;
        border-radius: 5px;
        width: 100%;
        cursor: pointer; 
        font-weight: 600;
    }

    .register-form-container button:hover {
        background-color: #b7151e;
    }
</style>

<div class="col-lg-6 col-12 mx-auto register-form-container">
    <form class="custom-form contact-form" method="POST" action="{{ route('register') }}" role="form">
        @csrf
        <h2>{{ __('Register with us') }}</h2>

        @if ($errors->any())
            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="row">
            <div class="col-12">
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="{{ __('Name') }}">
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="row">

            <div class="col-6">
                <input id="surname" type="text" class="form-control @error('surname') is-invalid @enderror" name="surname" value="{{ old('surname') }}" required autocomplete="surname" placeholder="{{ __('Company Name') }}">
                @error('surname')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="col-6">
                @error('phone')
                    <span class="invalid-feedback d-block mb-2" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <input id="phone" type="number" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone" placeholder="{{ __('Mobile') }}">
            </div>

        </div>

        <div class="row">

            <div class="col-6">
                <input id="address_first_line" type="text" class="form-control @error('address_first_line') is-invalid @enderror" name="address_first_line" value="{{ old('address_first_line') }}" required autocomplete="address_first_line" placeholder="{{ __('Address First Line') }}">
                @error('address_first_line')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="col-6">
                <input id="address_second_line" type="text" class="form-control @error('address_second_line') is-invalid @enderror" name="address_second_line" value="{{ old('address_second_line') }}" autocomplete="address_second_line" placeholder="{{ __('Address Second Line') }}">
                @error('address_second_line')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

        </div>

        <div class="row">

            <div class="col-6">
                <input id="address_third_line" type="text" class="form-control @error('address_third_line') is-invalid @enderror" name="address_third_line" value="{{ old('address_third_line') }}" autocomplete="address_third_line" placeholder="{{ __('Address Third Line') }}">
                @error('address_third_line')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>


            <div class="col-6">
                <input id="town" type="text" class="form-control @error('town') is-invalid @enderror" name="town" value="{{ old('town') }}" autocomplete="town" placeholder="{{ __('Town') }}">
                @error('town')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

        </div>

        <div class="row">

            <div class="col-6">
                <input id="postcode" type="text" class="form-control @error('postcode') is-invalid @enderror" name="postcode" value="{{ old('postcode') }}" autocomplete="postcode" placeholder="{{ __('Post Code') }}">
                @error('postcode')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="col-6">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="{{ __('Email Address') }}">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

        </div>

        <div class="row">

            <div class="col-6">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="{{ __('Password') }}">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="col-6">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="{{ __('Confirm Password') }}">
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <button type="submit" class="form-control">{{ __('Register') }}</button>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-12 text-center">
                <a href="{{ route('login') }}" class="btn btn-link">Login?</a>
            </div>
        </div>
    </form>
</div>

@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/@ideal-postcodes/address-finder-bundled@4"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        IdealPostcodes.AddressFinder.watch({
            apiKey: "ak_lt4ocv0eHLLo4meBRGHWK4HU0SBxa",
            outputFields: {
            line_1: "#address_first_line",
            line_2: "#address_second_line",
            line_3: "#address_third_line",
            post_town: "#town",
            postcode: "#postcode"
        }
    });
});
</script>
@endsection