@extends('layouts.master')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-10">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h2 class="mb-0">Contact Us</h2>
                </div>
                <div class="card-body p-4">
                    @if(session('message'))
                        <div class="alert alert-success">{{ session('message') }}</div>
                    @elseif(session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    <form action="{{ route('contactMessage') }}" method="POST">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="firstname" class="form-label">First Name</label>
                                    <input type="text" name="firstname" id="firstname" class="form-control" required>
                                    @error('firstname')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="lastname" class="form-label">Last Name</label>
                                    <input type="text" name="lastname" id="lastname" class="form-control" required>
                                    @error('lastname')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-4">
                            <label for="contactemail" class="form-label">Email</label>
                            <input type="email" name="contactemail" id="contactemail" class="form-control" required>
                            @error('contactemail')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-4">
                            <label for="contactmessage" class="form-label">Message</label>
                            <textarea name="contactmessage" id="contactmessage" class="form-control" rows="5" required></textarea>
                            @error('contactmessage')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg">Send Message</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection