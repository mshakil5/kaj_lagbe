@extends('layouts.user')

@section('content')
<div class="row" id="basic-table">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Job Details</h4>
            </div>
            <div class="card-body">
                @isset($work)
                    <form action="{{ route('work.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-1">
                                    <label class="mb-1" for="name">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ $work->name }}" required>
                                    <input type="hidden" class="form-control" id="workid" name="workid" value="{{ $work->id }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-1">
                                    <label class="mb-1" for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" value="{{ $work->email }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-1">
                                    <label class="mb-1" for="address_first_line">Address First Line</label>
                                    <input type="text" class="form-control" id="address_first_line" name="address_first_line" value="{{ $work->address_first_line }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-1">
                                    <label class="mb-1" for="address_second_line">Address Second Line</label>
                                    <input type="text" class="form-control" id="address_second_line" name="address_second_line" value="{{ $work->address_second_line }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-1">
                                    <label class="mb-1" for="address_third_line">Address Third Line</label>
                                    <input type="text" class="form-control" id="address_third_line" name="address_third_line" value="{{ $work->address_third_line }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-1">
                                    <label class="mb-1" for="town">Town</label>
                                    <input type="text" class="form-control" id="town" name="town" value="{{ $work->town }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-1">
                                    <label class="mb-1" for="post_code">Post Code</label>
                                    <input type="text" class="form-control" id="post_code" name="post_code" value="{{ $work->post_code }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-1">
                                    <label class="mb-1" for="phone">Phone</label>
                                    <input type="text" class="form-control" id="phone" name="phone" value="{{ $work->phone }}" required>
                                </div>
                            </div>
                        </div>


                       @if($work->workimage)
                        @foreach($work->workimage as $index => $image)
                            <div class="row mt-3 align-items-center" id="imageRow{{ $index }}">
                                <div class="col-md-3">
                                    <img src="{{ asset('images/' . $image->name) }}" alt="Image" class="img-fluid mb-2" style="max-height: 150px;">
                                    <input type="file" class="form-control image-upload" name="images[{{ $index }}]" accept="image/*">
                                    <input type="hidden" class="form-control" id="workimageid" name="workimageid[]" value="{{ $image->id }}" required>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="description{{ $index }}">Description</label>
                                        <textarea class="form-control textarea" id="description{{ $index }}" name="descriptions[{{ $index }}]">{{ $image->description }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <button class="btn btn-danger btn-sm btn-redish-hover remove" type="button" data-index="{{ $index }}">Remove</button>
                                </div>
                            </div>
                        @endforeach
                    @endif



                        <div class="row mt-3 align-items-center" id="imageContainer"></div>

                        <div class="row mt-3">
                            <div class="col-lg-12 col-12">
                                <div class="input-group input-group-file">
                                    <input type="button" class="form-control" id="inputGroupFile02" style="display: none;">
                                    <label class="input-group-text text-center" for="inputGroupFile02" id="addImageLabel" style="cursor: pointer;">Add image and description</label>
                                    <i class="bi-cloud-arrow-up ms-auto"></i>
                                </div>
                            </div>
                        </div>


                    <button type="submit" class="btn btn-primary mt-3 float-right btn-redish-hover">Update </button>

                    </form>

                    
                @else
                    <p>No work details found.</p>
                @endisset
            </div>
        </div>
    </div>
</div>


<style>
    .form-control.textarea {
        min-height: 150px; 
    }
    .btn-redish-hover {
        transition: background-color 0.3s ease;
    }

    .btn-redish-hover:hover {
        background-color: #dc3545;
        border-color: #dc3545;
    }
</style>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    $(document).ready(function(){
        $('#addImageLabel').click(function(){
            var newRow = `
                <div class="row mt-3 align-items-center">
                    <div class="col-md-3">
                        <input type="file" class="form-control image-upload" name="images[]" accept="image/*">
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control textarea" id="description" name="descriptions[]"></textarea>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <button class="btn btn-danger btn-sm btn-redish-hover remove" type="button">Remove</button>
                    </div>
                </div>
            `;
            $('#imageContainer').append(newRow);
            initRemoveButtons();
        });

        function initRemoveButtons() {
            $('.remove').off('click').on('click', function(){
                $(this).closest('.row').remove();
            });
        }

        initRemoveButtons();
    });
</script>



@endsection
