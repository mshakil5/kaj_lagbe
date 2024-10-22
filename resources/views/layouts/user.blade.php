<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Solomon Maintainance</title>
    <link rel="icon" type="image/x-icon" href="">
    
    <link href="{{ asset('frontend/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/templatemo-kind-heart-charity.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/admin/lightbox/lightbox.min.css')}}">

</head>

<body>
    
<nav class="navbar navbar-expand-lg shadow-lg">
    <div class="container">
        <a class="navbar-brand" href="{{ route('homepage') }}">
            <img src="{{ asset('frontend/images/logo.jpg') }}" class="logo img-fluid" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link click-scroll" href="{{ route('homepage') }}">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link click-scroll" href="{{ route('homepage') }}">Find Help</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link click-scroll" href="{{ route('homepage') }}">Contact</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <strong>{{ Auth::user()->name }}</strong>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('user.profile') }}">Profile</a>
                        <a class="dropdown-item" href="{{ route('user.password') }}">Change Password</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('user.works') }}">Job History</a>
                        <!-- <a class="dropdown-item" href="{{ route('additional-addresses.index') }}">Address</a> -->
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="me-50" data-feather="power"></i> {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-3 mb-3">
    @yield('content')
</div>

<script src="{{ asset('frontend/js/jquery.min.js')}}"></script>
<script src="{{ asset('frontend/js/bootstrap.min.js')}}"></script>
<script src="{{ asset('frontend/js/counter.js')}}"></script>
<script src="{{ asset('frontend/js/custom.js')}}"></script>
<script src="{{ asset('assets/admin/lightbox/lightbox.min.js')}}"></script>

<script>
    document.querySelector('#navbarDropdown').addEventListener('click', function() {
        var dropdownMenu = document.querySelector('.dropdown-menu');
        dropdownMenu.classList.toggle('show');
    });

    window.addEventListener('click', function(event) {
        var dropdownMenu = document.querySelector('.dropdown-menu');
        var dropdownToggle = document.querySelector('#navbarDropdown');
        if (!dropdownToggle.contains(event.target)) {
            dropdownMenu.classList.remove('show');
        }
    });
</script>

</body>
</html>
