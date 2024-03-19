@extends('layouts.user')

@section('content')
<div class="row" id="admin-profile-table">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Profile</h4>
            </div>
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success" role="alert">
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

                <form action="{{ route('user.profile.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-1">
                                <label class="mb-1" for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-1">
                                <label class="mb-1" for="surname">Surname</label>
                                <input type="text" class="form-control" id="surname" name="surname" value="{{ $user->surname }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-1">
                                <label class="mb-1" for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-1">
                                <label class="mb-1" for="phone">Phone</label>
                                <input type="text" class="form-control" id="phone" name="phone" value="{{ $user->phone }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-1">
                                <label class="mb-1" for="street_name">Street Name</label>
                                <input type="text" class="form-control" id="street_name" name="street_name" value="{{ $user->street_name }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-1">
                                <label class="mb-1" for="house_number">House Number</label>
                                <input type="text" class="form-control" id="house_number" name="house_number" value="{{ $user->house_number }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-1">
                                <label class="mb-1" for="postcode">Postcode</label>
                                <input type="text" class="form-control" id="postcode" name="postcode" value="{{ $user->postcode }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-1">
                                <label class="mb-1" for="town">Town</label>
                                <input type="text" class="form-control" id="town" name="town" value="{{ old('town', $user->additionalAddress->town ?? '') }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-1">
                                <label class="mb-1" for="country">Country</label>
                                <input type="text" class="form-control" id="country" name="country" value="{{ $user->country }}">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-secondary mt-3 float-right btn-redish-hover">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    .btn-redish-hover {
        transition: background-color 0.3s ease;
    }

    .btn-redish-hover:hover {
        background-color: #dc3545;
        border-color: #dc3545;
    }
</style>

@endsection
