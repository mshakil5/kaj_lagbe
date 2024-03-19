@extends('layouts.master')
@section('content')
<div class="container">
    @if($errors->any())
        <div class="alert alert-danger" role="alert">
            <strong>Error:</strong> {{$errors->first()}}
        </div>
    @endif

    <div class="alert alert-danger" role="alert">
        <strong>Error:</strong> PayPal Error - Transaction Declined
    </div>
</div>
@endsection