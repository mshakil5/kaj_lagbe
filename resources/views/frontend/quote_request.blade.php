@extends('layouts.master')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-10">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h2 class="mb-0">Request a Quote</h2>
                </div>
                <div class="card-body p-4">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form action="{{ route('quote.request') }}" method="POST">
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
                                    <label for="email" class="form-label">Your Email</label>
                                    <input type="email" name="email" id="email" class="form-control" required>
                                    @error('email')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-4">
                            <label for="phone" class="form-label">Your Phone Number</label>
                            <input type="text" name="phone" id="phone" class="form-control" required>
                            @error('phone')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-4">
                            <label for="details" class="form-label">Details of Your Request</label>
                            <textarea name="details" id="details" class="form-control" rows="5" required></textarea>
                            @error('details')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg">Submit Request</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection