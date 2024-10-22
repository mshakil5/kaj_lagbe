<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="">
    <meta name="author" content="">

    <title>Solomon Maintainance</title>

    <link rel="icon" type="image/x-icon" href="">
    
    <!-- CSS FILES -->
    <link href="{{ asset('frontend/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ asset('frontend/css/bootstrap-icons.css')}}" rel="stylesheet">
    <link href="{{ asset('frontend/css/templatemo-kind-heart-charity.css')}}" rel="stylesheet">


</head>

<body id="section_1">

    @include('frontend.inc.header')

    @yield('content')

    @include('frontend.inc.footer')

    <!-- JAVASCRIPT FILES -->
    <script src="{{ asset('frontend/js/jquery.min.js')}}"></script>
    <script src="{{ asset('frontend/js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('frontend/js/counter.js')}}"></script>
    <script src="{{ asset('frontend/js/custom.js')}}"></script>

    @yield('script')

</body>

</html>