@extends('layouts.user')

@section('content')
<div class="container my-2">
    <div class="row justify-content-center">
        
        <div class="col-lg-10 col-md-12 col-sm-12">

        <a href="{{ route('user.works') }}" class="btn btn-primary mb-3">Go Back</a>

            <div class="card">
                <div class="card-header bg-primary text-center">
                    <h2 class="card-title text-white">Update Your Job Request for {{ $work->category->name }}</h2>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @isset($work)
                    <form id="updateWorkForm" action="{{ route('work.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="workid" value="{{ $work->id }}">

                        <div class="row mt-3">
                            <div class="col-lg-4 col-12">
                                <label for="name">Name</label>
                                <input type="text" name="name" class="form-control" value="{{ $work->name }}" required>
                            </div>
                            <div class="col-lg-4 col-12">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="form-control" value="{{ $work->email }}" required>
                            </div>
                            <div class="col-lg-4 col-12">
                                <label for="phone">Phone</label>
                                <input type="number" name="phone" id="phone" class="form-control" value="{{ $work->phone }}" required>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-lg-4 col-12">
                                <label for="address_first_line">Address First Line</label>
                                <input type="text" name="address_first_line" id="address_first_line" class="form-control" value="{{ $work->address_first_line }}" required>
                            </div>
                            <div class="col-lg-4 col-12">
                                <label for="address_second_line">Address Second Line</label>
                                <input type="text" name="address_second_line" id="address_second_line" class="form-control" value="{{ $work->address_second_line }}">
                            </div>
                            <div class="col-lg-4 col-12">
                                <label for="address_third_line">Address Third Line</label>
                                <input type="text" name="address_third_line" id="address_third_line" class="form-control" value="{{ $work->address_third_line }}">
                            </div>
                            <div class="col-lg-6 col-12 mt-3">
                                <label for="town">Town</label>
                                <input type="text" name="town" id="town" class="form-control" value="{{ $work->town }}">
                            </div>
                            <div class="col-lg-6 col-12 mt-3">
                                <label for="post_code">Post Code</label>
                                <input type="text" name="post_code" id="post_code" class="form-control" value="{{ $work->post_code }}">
                            </div>
                        </div>

                        <div id="imageContainer">
                            @foreach($work->workimage as $index => $image)
                            <div class="row image-row mt-3" id="imageRow{{ $index }}">
                                <div class="col-lg-6">
                                    <div class="input-group mb-3">
                                        <img src="{{ asset('/' . $image->name) }}" alt="Image" class="img-fluid mb-2" style="max-height: 150px;">
                                        <div class="w-100">
                                            <input type="file" class="form-control image-upload mt-2" name="images[{{ $index }}]" accept="image/*">
                                        </div>
                                        <input type="hidden" name="workimageid[]" value="{{ $image->id }}">
                                    </div>
                                </div>
                                <div class="col-lg-5">
                                    <textarea class="form-control description resizable" name="descriptions[{{ $index }}]" rows="5">{{ $image->description }}</textarea>
                                </div>
                                <div class="col-lg-1 text-end">
                                    <button class="btn btn-danger btn-sm remove-image" type="button" data-index="{{ $index }}">Remove</button>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <div class="row mt-3">
                            <div class="col-lg-12 col-12">
                                <button type="button" class="btn btn-success add-row">Add New</button>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success mt-3">Update</button>

                    </form>
                    @else
                    <p>No work details found.</p>
                    @endisset
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')

<script>
    $(document).ready(function() {
        $('.add-row').click(function() {
            var newIndex = $('.image-row').length;
            var newRow = `
                <div class="row image-row mt-3" id="imageRow${newIndex}">
                    <div class="col-lg-6">
                        <div class="input-group mb-3">
                            <input type="file" class="form-control image-upload" name="images[${newIndex}]" accept="image/*" required>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <textarea class="form-control description resizable" name="descriptions[${newIndex}]" rows="5" required></textarea>
                    </div>
                    <div class="col-lg-1 text-end">
                        <button class="btn btn-danger btn-sm remove-image" type="button" data-index="${newIndex}">Remove</button>
                    </div>
                </div>
            `;
            $('#imageContainer').append(newRow);
            initRemoveButtons();
        });

        function initRemoveButtons() {
            $('.remove-image').off('click').on('click', function() {
                var index = $(this).data('index');
                $('#imageRow' + index).remove();
            });
        }

        initRemoveButtons();
    });
</script>

@endsection