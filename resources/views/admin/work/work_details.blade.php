@extends('admin.layouts.admin')

@section('content')
<div class="container">
<div class="row">
    <div class="col-md-6">
        <label for="name">Name:</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ $work->name }}" disabled>
    </div>
    <div class="col-md-6">
        <label for="email">Email:</label>
        <input type="email" class="form-control" id="email" name="email" value="{{ $work->email }}" disabled>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <label for="address_first_line">Address First Line:</label>
        <input type="text" class="form-control" id="address_first_line" name="address_first_line" value="{{ $work->address_first_line }}" disabled>
    </div>
    <div class="col-md-6">
        <label for="address_second_line">Address Second Line:</label>
        <input type="text" class="form-control" id="address_second_line" name="address_second_line" value="{{ $work->address_second_line }}" disabled>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <label for="address_third_line">Address Third Line:</label>
        <input type="text" class="form-control" id="address_third_line" name="address_third_line" value="{{ $work->address_third_line }}" disabled>
    </div>
    <div class="col-md-6">
        <label for="town">Town:</label>
        <input type="text" class="form-control" id="town" name="town" value="{{ $work->town }}" disabled>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <label for="post_code">Post Code:</label>
        <input type="text" class="form-control" id="post_code" name="post_code" value="{{ $work->post_code }}" disabled>
    </div>
    <div class="col-md-6">
        <label for="phone">Phone:</label>
        <input type="text" class="form-control" id="phone" name="phone" value="{{ $work->phone }}" disabled>
    </div>
</div>
@if($work->workimage)
    @foreach($work->workimage as $index => $image)
        <div class="row mt-3 align-items-center">
            <div class="col-md-3">
                <img src="{{ asset('images/' . $image->name) }}" alt="Image" class="img-fluid mb-2" style="max-height: 150px;">
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="description{{ $index }}">Description:</label>
                    <textarea class="form-control" id="description{{ $index }}" name="descriptions[{{ $index }}]" disabled>{{ $image->description }}</textarea>
                </div>
            </div>
        </div>
    @endforeach
@endif
</div>
@endsection