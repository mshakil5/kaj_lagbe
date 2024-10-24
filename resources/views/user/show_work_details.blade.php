@extends('layouts.user')

@section('content')
<div class="row mt-3">
    <div class="col-10 mx-auto">
        <a href="{{ route('user.works') }}" class="btn btn-primary mb-3">Go Back</a>
        <div class="card">
            <div class="card-header bg-primary">
                <h2 class="card-title text-white">Job Details</h2>    
            </div>
            <div class="card-body">
                @isset($work)
                    <div class="row" style="border-bottom: 1px solid #dee2e6; padding-bottom: 10px;">
                        <div class="col-md-6">
                            <div class="form-group mb-1">
                                <label class="mb-1" for="name">Date:</label>
                                <p>{{ \Carbon\Carbon::parse($work->date)->format('d/m/Y') }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-1">
                                <label class="mb-1" for="name">Job ID:</label>
                                <p>{{ $work->orderid }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="row" style="border-bottom: 1px solid #dee2e6; padding-bottom: 10px;">
                        <div class="col-md-6">
                            <div class="form-group mb-1">
                                <label class="mb-1" for="name">Job Category:</label>
                                <p>{{ $work->category->name }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-1">
                                <label class="mb-1" for="name">Name:</label>
                                <p>{{ $work->name }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="row" style="border-bottom: 1px solid #dee2e6; padding-bottom: 10px;">
                        <div class="col-md-6">
                            <div class="form-group mb-1">
                                <label class="mb-1" for="email">Email:</label>
                                <p>{{ $work->email }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-1">
                                <label class="mb-1" for="phone">Phone:</label>
                                <p>{{ $work->phone }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="row" style="border-bottom: 1px solid #dee2e6; padding-bottom: 10px;">
                        <div class="col-md-6">
                            <div class="form-group mb-1">
                                <label class="mb-1" for="address_first_line">Address First Line:</label>
                                <p>{{ $work->address_first_line }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-1">
                                <label class="mb-1" for="address_second_line">Address Second Line:</label>
                                <p>{{ $work->address_second_line }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="row" style="border-bottom: 1px solid #dee2e6; padding-bottom: 10px;">
                        <div class="col-md-6">
                            <div class="form-group mb-1">
                                <label class="mb-1" for="address_third_line">Address Third Line:</label>
                                <p>{{ $work->address_third_line }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-1">
                                <label class="mb-1" for="town">Town:</label>
                                <p>{{ $work->town }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="row" style="border-bottom: 1px solid #dee2e6; padding-bottom: 10px;">
                        <div class="col-md-6">
                            <div class="form-group mb-1">
                                <label class="mb-1" for="post_code">Post Code:</label>
                                <p>{{ $work->post_code }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-1">
                                <label class="mb-1" for="transaction_id">Transaction ID:</label>
                                @if ($work->transactions->isNotEmpty())
                                    <p>{{ $work->transactions->first()->tranid }}</p>
                                @else
                                    <p>No transaction generated</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    @if($work->workimage)
                        @foreach($work->workimage as $index => $image)
                            <div class="row" style="border-bottom: 1px solid #dee2e6; padding-bottom: 10px;">
                                <div class="col-md-6">
                                    <div class="form-group mb-1">
                                        @if(in_array(pathinfo($image->name, PATHINFO_EXTENSION), ['jpeg', 'jpg', 'png', 'gif', 'svg']))
                                            <label class="mb-1" for="image{{ $index }}">Image:</label>
                                            <div class="image-container text-center">
                                                <a href="{{ asset('/' . $image->name) }}" data-lightbox="image-{{ $index }}" data-title="{{ $image->description }}">
                                                    <img src="{{ asset('/' . $image->name) }}" alt="Image" class="img-fluid mb-2 rounded" style="max-height: 120px;">
                                                </a>
                                            </div>
                                        @elseif(in_array(pathinfo($image->name, PATHINFO_EXTENSION), ['mp4', 'avi', 'mov', 'wmv']))
                                            <label class="mb-1" for="video{{ $index }}">Video:</label>
                                            <div class="video-container text-center">
                                                <video controls class="img-fluid mb-2 rounded" style="max-height: 120px;">
                                                    <source src="{{ asset('/' . $image->name) }}" type="video/{{ pathinfo($image->name, PATHINFO_EXTENSION) }}">
                                                    Your browser does not support the video tag.
                                                </video>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-1">
                                        <label class="mb-1" for="description{{ $index }}">Description:</label>
                                        <p>{!! $image->description !!}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                @else
                    <p>No work details found.</p>
                @endisset
            </div>
        </div>
    </div>
</div>

@endsection