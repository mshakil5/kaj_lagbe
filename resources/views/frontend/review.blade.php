@extends('layouts.master')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-10">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h2 class="mb-0">Leave a Review</h2>
                </div>
                <div class="card-body p-4">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form action="#" method="POST">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name" class="form-label">Your Name</label>
                                    <input type="text" name="name" id="name" class="form-control" required>
                                    @error('name')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="stars" class="form-label">Rate Us</label>
                                    <div id="star-rating" class="star-rating">
                                        <input type="radio" name="stars" value="5" id="star5"><label for="star5">&#9733;</label>
                                        <input type="radio" name="stars" value="4" id="star4"><label for="star4">&#9733;</label>
                                        <input type="radio" name="stars" value="3" id="star3"><label for="star3">&#9733;</label>
                                        <input type="radio" name="stars" value="2" id="star2"><label for="star2">&#9733;</label>
                                        <input type="radio" name="stars" value="1" id="star1"><label for="star1">&#9733;</label>
                                    </div>
                                    @error('stars')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-4">
                            <label for="review" class="form-label">Your Review</label>
                            <textarea name="review" id="review" class="form-control" rows="5" required></textarea>
                            @error('review')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg">Submit Review</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .card {
        border: none;
        border-radius: 15px;
    }

    .card-header {
        border-radius: 15px 15px 0 0 !important;
        border-bottom: none;
    }

    .star-rating {
        direction: rtl;
        font-size: 2rem;
        display: inline-block;
        padding: 10px 0;
    }

    .star-rating input[type="radio"] {
        display: none;
    }

    .star-rating label {
        color: #ccc;
        cursor: pointer;
        padding: 0 2px;
        transition: all 0.2s ease;
    }

    .star-rating input[type="radio"]:checked ~ label {
        color: gold;
    }

    .star-rating label:hover,
    .star-rating label:hover ~ label {
        color: gold;
    }

    .form-control {
        padding: 0.75rem;
        border-radius: 8px;
    }

     .form-label {
        font-weight: bold;
        margin-bottom: 0.5rem;
    }
</style>

@endsection