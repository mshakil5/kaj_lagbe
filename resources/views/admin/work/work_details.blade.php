@extends('admin.layouts.admin')

@section('content')
<div class="container">
    
    <div class="row">
        <div class="col-2">
            <a href="{{ route('admin.new') }}">
                <button type="button" class="btn btn-secondary my-3">Go back</button>
            </a>
        </div>
            <h1 class="mt-2">Work Details</h1>
    </div>

    <div class="row">
        <div class="col-md-6">
            <label for="name">Date:</label>
            <input type="text" class="form-control" id="date" name="date" value="{{ \Carbon\Carbon::parse($work->date)->format('d/m/y') }}" disabled>
        </div>
        <div class="col-md-6">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $work->name }}" disabled>
        </div>
    </div>

    <div class="row">
        
        <div class="col-md-6">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $work->email }}" disabled>
        </div>
        <div class="col-md-6">
            <label for="address_first_line">Address First Line:</label>
            <input type="text" class="form-control" id="address_first_line" name="address_first_line" value="{{ $work->address_first_line }}" disabled>
        </div>
    </div>

    <div class="row">
        
        <div class="col-md-6">
            <label for="address_second_line">Address Second Line:</label>
            <input type="text" class="form-control" id="address_second_line" name="address_second_line" value="{{ $work->address_second_line }}" disabled>
        </div>
        <div class="col-md-6">
            <label for="address_third_line">Address Third Line:</label>
            <input type="text" class="form-control" id="address_third_line" name="address_third_line" value="{{ $work->address_third_line }}" disabled>
        </div>
    </div>

    <div class="row">
        
        <div class="col-md-6">
            <label for="town">Town:</label>
            <input type="text" class="form-control" id="town" name="town" value="{{ $work->town }}" disabled>
        </div>
        <div class="col-md-6">
            <label for="post_code">Post Code:</label>
            <input type="text" class="form-control" id="post_code" name="post_code" value="{{ $work->post_code }}" disabled>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <label for="phone">Phone:</label>
            <input type="text" class="form-control" id="phone" name="phone" value="{{ $work->phone }}" disabled>
        </div>
    </div>


     @if($work->workimage)
        @foreach($work->workimage as $index => $image)
            <div class="col-md-12">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <a href="{{ asset('/' . $image->name) }}" data-lightbox="image-{{ $index }}">
                             <div class="d-flex justify-content-center align-items-center" style="height: 200px;">
                                <img src="{{ asset('/' . $image->name) }}" alt="Image" class="img-fluid rounded" style="width: 200px; height: auto;">
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="description{{ $index }}">Description:</label>
                            <textarea class="form-control" id="description{{ $index }}" name="descriptions[{{ $index }}]" disabled>{{ $image->description }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>

@endsection
