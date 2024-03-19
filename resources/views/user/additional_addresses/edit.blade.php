@extends('layouts.user')

@section('content')
<div class="row" id="admin-profile-table">
    <div class="col-12">
        <a href="{{ route('additional-addresses.index') }}" class="btn btn-secondary mb-3">Go Back</a>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Edit Additional Address</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('additional-addresses.update', $address->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-1">
                                <label class="mb-1" for="first_line">First Line</label>
                                <input type="text" class="form-control" id="first_line" name="first_line" value="{{ $address->first_line }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-1">
                                <label class="mb-1" for="second_line">Second Line</label>
                                <input type="text" class="form-control" id="second_line" name="second_line" value="{{ $address->second_line }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-1">
                                <label class="mb-1" for="third_line">Third Line</label>
                                <input type="text" class="form-control" id="third_line" name="third_line" value="{{ $address->third_line }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-1">
                                <label class="mb-1" for="town">Town</label>
                                <input type="text" class="form-control" id="town" name="town" value="{{ $address->town }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-1">
                                <label class="mb-1" for="post_code">Post Code</label>
                                <input type="text" class="form-control" id="post_code" name="post_code" value="{{ $address->post_code }}">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3 float-right btn-redish-hover">Update Address</button>
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
                line_1: "#first_line",
                line_2: "#second_line",
                line_3: "#third_line",
                post_town: "#town",
                postcode: "#post_code"
            }
        });
    });
</script>

@endsection
