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
                                <label class="mb-1" for="surname">Company Name</label>
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
                                <label class="mb-1" for="address_first_line">Address First Line</label>
                                <input type="text" class="form-control" id="address_first_line" name="address_first_line" value="{{ $user->address_first_line }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-1">
                                <label class="mb-1" for="address_second_line">Address Second Line</label>
                                <input type="text" class="form-control" id="address_second_line" name="address_second_line" value="{{ $user->address_second_line }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-1">
                                <label class="mb-1" for="address_third_line">Address Third Line</label>
                                <input type="text" class="form-control" id="address_third_line" name="address_third_line" value="{{ $user->address_third_line }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-1">
                                <label class="mb-1" for="town">Town</label>
                                <input type="text" class="form-control" id="town" name="town" value="{{ $user->town }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-1">
                                <label class="mb-1" for="postcode">Post Code</label>
                                <input type="text" class="form-control" id="postcode" name="postcode" value="{{ $user->postcode }}">
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

<script src="https://cdn.jsdelivr.net/npm/@ideal-postcodes/address-finder-bundled@4"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        IdealPostcodes.AddressFinder.watch({
            apiKey: "ak_lt4ocv0eHLLo4meBRGHWK4HU0SBxa",
            outputFields: {
            line_1: "#address_first_line",
            line_2: "#address_second_line",
            line_3: "#address_third_line",
            post_town: "#town",
            postcode: "#postcode"
        }
    });
});
</script>

@endsection
