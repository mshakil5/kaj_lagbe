@extends('admin.layouts.admin')

@section('content')
<div class="container">
    
    <div class="row">
        <div class="col-2">
            <a href="{{ route('admin.new') }}">
                <button type="button" class="btn btn-secondary my-3"><i class="fas fa-arrow-left"></i> Go back</button>
            </a>
        </div>
            <h1 class="mt-2">Work Details</h1>
    </div>

    <div class="row">
        <div class="col-md-6">
            <label for="name">Job ID:</label>
            <input type="text" class="form-control" id="date" name="date" value="{{ $work->orderid }}" disabled>
        </div>

        <div class="col-md-6">
            <label for="name">Date:</label>
            <input type="text" class="form-control" id="date" name="date" value="{{ \Carbon\Carbon::parse($work->date)->format('d/m/y') }}" disabled>
        </div>

        <div class="col-md-6">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $work->name }}" disabled>
        </div>

        <div class="col-md-6">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $work->email }}" disabled>
        </div>

        <div class="col-md-6">
            <label for="address_first_line">Address First Line:</label>
            <input type="text" class="form-control" id="address_first_line" name="address_first_line" value="{{ $work->address_first_line }}" disabled>
        </div>

        <div class="col-md-6">
            <label for="address_second_line">Address Second Line:</label>
            <input type="text" class="form-control" id="address_second_line" name="address_second_line" value="{{ $work->address_second_line }}" disabled>
        </div>

        <div class="col-md-6">
            <label for="address_third_line">Address Third Line:</label>
            <input type="text" class="form-control" id="address_third_line" name="address_third_line" value="{{ $work->address_third_line }}" disabled>
        </div>

        <div class="col-md-6">
            <label for="town">Town:</label>
            <input type="text" class="form-control" id="town" name="town" value="{{ $work->town }}" disabled>
        </div>

        <div class="col-md-6">
            <label for="post_code">Post Code:</label>
            <input type="text" class="form-control" id="post_code" name="post_code" value="{{ $work->post_code }}" disabled>
        </div>

        <div class="col-md-6">
            <label for="phone">Phone:</label>
            <input type="text" class="form-control" id="phone" name="phone" value="{{ $work->phone }}" disabled>
        </div>

        <div class="col-md-6">
            <label for="phone">Staff:</label>
            <input type="text" class="form-control" id="staff" name="staff" value="@if ($work->assignedTo) {{ $work->assignedTo->name }} {{ $work->assignedTo->surname }} @endif" disabled>
        </div>
    </div>

    @if($work->workimage)
        @foreach($work->workimage as $index => $image)
            <div class="row pb-5">
                <div class="col-md-12 mt-3">
                    <div class="row align-items-center mt-3">
                        <div class="col-md-6">
                            @if(in_array(pathinfo($image->name, PATHINFO_EXTENSION), ['jpeg', 'jpg', 'png', 'gif', 'svg']))
                                <a href="{{ asset('/' . $image->name) }}" data-lightbox="image-{{ $index }}">
                                    <div class="d-flex justify-content-center align-items-center" style="height: 150px;">
                                        <img src="{{ asset('/' . $image->name) }}" alt="Image" class="img-fluid rounded" style="max-height: 100%; max-width: 100%;">
                                    </div>
                                </a>
                            @elseif(in_array(pathinfo($image->name, PATHINFO_EXTENSION), ['mp4', 'avi', 'mov', 'wmv']))
                                <div class="d-flex justify-content-center align-items-center" style="height: 150px;">
                                    <video controls class="img-fluid rounded" style="max-height: 100%; max-width: 100%;">
                                        <source src="{{ asset('/' . $image->name) }}" type="video/{{ pathinfo($image->name, PATHINFO_EXTENSION) }}">
                                        Your browser does not support the video tag.
                                    </video>
                                </div>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="description{{ $index }}">Description:</label>
                                <textarea class="form-control" id="description{{ $index }}" name="descriptions[{{ $index }}]" disabled>{{ $image->description }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</div>

@endsection
