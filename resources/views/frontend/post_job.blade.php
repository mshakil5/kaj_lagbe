@extends('layouts.master')

@section('content')

@include('frontend.inc.hero')

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-10 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-header text-center">
                    <h2>
                        Complete Your Job Request for {{ $category->name }}
                    </h2>
                </div>
                <div class="card-body">

                @if ($success = Session::get('success'))
                        <div class="alert alert-primary alert-dismissible fade show" role="alert">
                            <strong>{{ $success }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
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

                    <form id="categoryForm" action="{{route('work.store')}}" method="post" role="form" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="category_id" value="{{ $category->id }}">

                        @auth
                        <div class="row">
                            <div class="col-lg-6 col-12" >
                                 <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="useRegisteredAddress">
                                    <label class="form-check-label" for="useRegisteredAddress">
                                        Use registered address
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-6 col-12" >
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="useRegisteredPhone">
                                    <label class="form-check-label" for="useRegisteredPhone">
                                        Use registered phone number
                                    </label>
                                </div>
                            </div>
                        </div>
                        @endauth

                        <div class="row mt-3">
                            <div class="col-lg-4 col-12">
                                <label for="name">Name</label>
                                <input type="text" name="name" class="form-control" placeholder="Your Name" value="{{ auth()->user()->name ?? '' }}" required>
                            </div>
                            <div class="col-lg-4 col-12">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="form-control" placeholder="you@example.com" value="{{ auth()->user()->email ?? '' }}" required>
                            </div>
                            <div class="col-lg-4 col-12">
                                <label for="phone">Phone</label>
                                <input type="number" name="phone" id="phone" class="form-control" required>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-lg-4 col-12">
                                <label for="address_first_line">Address First Line</label>
                                <input type="text" name="address_first_line" id="address_first_line" class="form-control" required>
                            </div>
                            <div class="col-lg-4 col-12">
                                <label for="address_second_line">Address Second Line</label>
                                <input type="text" name="address_second_line" id="address_second_line" class="form-control">
                            </div>
                            <div class="col-lg-4 col-12">
                                <label for="address_third_line">Address Third Line</label>
                                <input type="text" name="address_third_line" id="address_third_line" class="form-control">
                            </div>
                            <div class="col-lg-6 col-12 mt-3">
                                <label for="town">Town</label>
                                <input type="text" name="town" id="town" class="form-control">
                            </div>
                            <div class="col-lg-6 col-12 mt-3">
                                <label for="post_code">Post Code</label>
                                <input type="text" name="post_code" id="post_code" class="form-control">
                            </div>
                        </div>

                        <div id="imageContainer">
                            <div class="row image-row mt-3">
                                <div class="col-lg-6">
                                    <div class="input-group mb-3">
                                        <input type="file" class="form-control image-upload" name="images[]" accept="image/*,video/*" required>
                                    </div>
                                </div>
                                <div class="col-lg-5">
                                    <div class="input-group mb-3">
                                        <textarea class="form-control description resizable" placeholder="Description" rows="3" name="descriptions[]" required></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-1 text-end">
                                    <button class="btn btn-success add-row" type="button">+</button>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success mt-3">Submit</button>

                        <div id='loading' style='display:none ;'>
                            <img src="{{ asset('loader.gif') }}" id="loading-image" alt="Loading..." />
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
        #loading {
        position: fixed;
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        opacity: 0.7;
        background-color: #fff;
        z-index: 99;
    }

    #loading-image {
        z-index: 100;
    }
</style>


@endsection

@section('script')
<script>
    $(document).ready(function() {
        function addNewRow() {
            var newRow = `
                <div class="row image-row" style="margin-top: 10px;">
                    <div class="col-lg-6 col-12">
                        <div class="input-group mb-3">
                            <input type="file" class="form-control image-upload" name="images[]" accept="image/*,video/*" required>
                        </div>
                    </div>
                    <div class="col-lg-5 col-12">
                        <div class="input-group mb-3">
                            <textarea class="form-control description resizable" placeholder="Description" rows="3" name="descriptions[]" required></textarea>
                        </div>
                    </div>
                    <div class="col-lg-1 col-12 text-end">
                        <button class="btn btn-danger remove-row" type="button">-</button>
                    </div>
                </div>
            `;
            $('#imageContainer').append(newRow);
        }

        $(document).on('click', '.add-row', function() {
            addNewRow();
        });

        $(document).on('click', '.remove-row', function() {
            $(this).closest('.row').remove();
        });

    });
</script>

<script>
    $(document).ready(function() {
        // Use registered address
        $('#useRegisteredAddress').on('change', function() {
            if ($(this).is(':checked')) {
                $('#address_first_line').val('{{ auth()->check() ? auth()->user()->address_first_line : '' }}');
                $('#address_second_line').val('{{ auth()->check() ? auth()->user()->address_second_line : '' }}');
                $('#address_third_line').val('{{ auth()->check() ? auth()->user()->address_third_line : '' }}');
                $('#town').val('{{ auth()->check() ? auth()->user()->town : '' }}');
                $('#post_code').val('{{ auth()->check() ? auth()->user()->post_code : '' }}');
            } else {
                $('#address_first_line, #address_second_line, #address_third_line, #town, #post_code').val('');
            }
        });

        // Use registered phone number
        $('#useRegisteredPhone').on('change', function() {
            if ($(this).is(':checked')) {
                $('#phone').val('{{ auth()->check() ? auth()->user()->phone : '' }}');
            } else {
                $('#phone').val('');
            }
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('categoryForm');
        const loadingDiv = document.getElementById('loading');

        form.addEventListener('submit', function() {
            loadingDiv.style.display = 'flex';
        });
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        IdealPostcodes.AddressFinder.watch({
            apiKey: "ak_lt4ocv0eHLLo4meBRGHWK4HU0SBxa",
            outputFields: {
            line_1: "#address_first_line",
            line_2: "#address_second_line",
            line_3: "#address_third_line",
            post_town: "#town",
            postcode: "#post_code"
            }
        });
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/@ideal-postcodes/address-finder-bundled@4"></script>
@endsection