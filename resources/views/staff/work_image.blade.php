@extends('layouts.staff')

@section('content')
<div class="container">
    
    <div class="row">
        <div class="col-2">
            <a href="{{ route('assigned.tasks.staff') }}">
                <button type="button" class="btn btn-secondary my-3">Go back</button>
            </a>
        </div>
            <h1 class="mt-2">Work Details</h1>
    </div>

    <div class="row">
        <div class="col-md-6">
            

            <div class="card mb-4">
                <div class="card-header bg-success text-white">
                        <h5 class="card-title mb-0">Add Image or Video</h5>
                </div>
                <div class="card-body">
                    <form action="{{route('staff.workimages.upload')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <div class="form-item">
                                <input type="file" id="image" name="image" class="form-control">
                                <input type="hidden" id="work_id" name="work_id" value="{{$work->id}}" class="form-control">
                            </div>
                        </div>
        
                        <div class="form-group">
                            <div class="form-item">
                                <button type="submit" class="btn btn-success">Upload</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>


        </div>
    </div>


     @if($work->workimage)
        @foreach($work->workimage as $index => $image)
            <div class="row">
            <div class="col-md-12 mt-3">
                <div class="row align-items-center mt-3">
                    <div class="col-md-6">
                        <a href="{{ asset('/' . $image->name) }}" data-lightbox="image-{{ $index }}">
                             <div class="d-flex justify-content-center align-items-center" style="height: 100px;">
                                <img src="{{ asset('/' . $image->name) }}" alt="Image" class="img-fluid rounded" style="width: 100px; height: 100px;">
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
        </div>
            
        @endforeach
    @endif
</div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>

@endsection
