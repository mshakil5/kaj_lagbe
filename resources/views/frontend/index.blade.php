
@extends('layouts.master')
@section('content')


<main>
    <section class="section-padding section-bg" id="section_1">
        <div class="container">
            <div class="row">

                <div class="col-lg-6 col-12 mb-5 mb-lg-0">
                    <img src="{{ asset('image.jpg')}}"
                        class="custom-text-box-image img-fluid" alt="">
                </div>

                <div class="col-lg-6 col-12">
                    <div class="custom-text-box">
                        <h5 class="mb-3">Handyman, Assembly, repairs.</h5>

                        <p class="mb-0">When you don’t have the time, tools, or know-how to do those niggling handyman jobs such as replacing light bulbs or property maintenance, book our handyman . They’ll cross tasks off your to-do list for you, no matter how big or small.</p>
                    </div>

                    
                    <img src="{{ asset('image2.jpg')}}"
                        class="custom-text-box-image img-fluid" alt="">

                </div>

            </div>
        </div>
    </section>

    <section class="volunteer-section p-3" id="section_2">
        <div class="container">
            <div class="row justify-content-md-center">

                <div class="col-lg-8 col-12">
                    <h2 class="text-white mb-4">Tell us about your task. We will get in touch with you soon.</h2>

                    @if ($success = Session::get('success'))
                        <div class="alert alert-primary alert-dismissible fade show" role="alert">
                            <strong>{{ $success }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <form class="custom-form volunteer-form mb-5 mb-lg-0" action="{{route('work.store')}}" method="post" role="form" enctype="multipart/form-data">
                        @csrf
                        {{-- <h3 class="mb-4">Submit your details</h3> --}}

                        <div class="row">
                            <div class="col-lg-4 col-12">
                                <label for="name"> Name</label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="Jack Doe" value="{{ auth()->check() ? auth()->user()->name : '' }}" required>
                            </div>

                            <div class="col-lg-4 col-12">
                                <label for="email"> Email</label>
                                <input type="email" name="email" id="email" pattern="[^ @]*@[^ @]*" class="form-control" placeholder="Jackdoe@gmail.com" value="{{ auth()->check() ? auth()->user()->email : '' }}" required>
                            </div>

                            <div class="col-lg-4 col-12">
                                <label for="phone"> Phone</label>
                                <input type="number" name="phone" id="phone" class="form-control" value="{{ auth()->check() ? auth()->user()->phone : '' }}" required>
                            </div>

                            <div class="col-lg-4 col-12">
                                <label for="address_first_line"> Address First Line</label>
                                <input type="text" name="address_first_line" id="address_first_line" class="form-control" value="" required>
                            </div>

                            <div class="col-lg-4 col-12">
                                <label for="address_second_line"> Address Second Line</label>
                                <input type="text" name="address_second_line" id="address_second_line" class="form-control" value="" readonly>
                            </div>

                            <div class="col-lg-4 col-12">
                                <label for="address_third_line"> Address Third Line</label>
                                <input type="text" name="address_third_line" id="address_third_line" class="form-control" value="" readonly>
                            </div>

                            <div class="col-lg-6 col-12">
                                <label for="town"> Town</label>
                                <input type="text" name="town" id="town" class="form-control" required value="" >
                            </div>

                            <div class="col-lg-6 col-12">
                                <label for="post_code"> Post Code</label>
                                <input type="text" name="post_code" id="post_code" class="form-control" required value="">
                                <div class="perrmsg"></div>
                            </div>

                            <div class="col-lg-12 col-12">
                                <div class="input-group input-group-file">
                                    <input type="button" class="form-control" id="inputGroupFile02"  style="display: none;">
                                    <label class="input-group-text text-center" for="inputGroupFile02" id="addImageLabel" style="cursor: pointer;">Add image and description</label>
                                    <i class="bi-cloud-arrow-up ms-auto"></i>
                                </div>
                                <div id="imageContainer">
                                </div>
                            </div>

                        <button type="submit" class="form-control submitBtn" id="submitBtn">Submit</button>
                    </form>
                </div>

            </div>
        </div>
    </section>

    
    <section class="contact-section section-padding" id="section_3">
        <div class="container">
            <div class="row">

                <div class="col-lg-4 col-12 ms-auto mb-5 mb-lg-0">
                    <div class="contact-info-wrap">
                        <h2>Get in touch</h2>

                        {{-- <div class="contact-image-wrap d-flex flex-wrap">
                            <img src="{{ asset('frontend/images/avatar/pretty-blonde-woman-wearing-white-t-shirt.jpg')}}"
                                class="img-fluid avatar-image" alt="">

                            <div class="d-flex flex-column justify-content-center ms-3">
                                <p class="mb-0">Clara Barton</p>
                                <p class="mb-0"><strong>HR & Office Manager</strong></p>
                            </div>
                        </div> --}}

                        <div class="contact-info">
                            <h5 class="mb-3">Contact Infomation</h5>

                            <p class="d-flex mb-2">
                                <i class="bi-geo-alt me-2"></i>
                                100 fairholt rd
                                London 
                                N165HN
                            </p>

                            <p class="d-flex mb-2">
                                <i class="bi-telephone me-2"></i>

                                <a href="tel: 0203-994-7611">
                                    0203-994-7611
                                </a>
                            </p>

                            <p class="d-flex">
                                <i class="bi-envelope me-2"></i>

                                <a href="mailto:sam@edgeemg.co.uk">
                                    sam@edgeemg.co.uk
                                </a>
                            </p>

                            {{-- <a href="#" class="custom-btn btn mt-3">Get Direction</a> --}}
                        </div>
                    </div>
                </div>

                <div class="col-lg-5 col-12 mx-auto">
                    <form class="custom-form contact-form" action="{{route('contactMessage')}}" method="post" role="form">
                        @csrf
                        <h2>Contact form</h2>

                        @if ($message = Session::get('message'))
                            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                <strong>{{ $message }}</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-12">
                                <input type="text" name="firstname" id="firstname" class="form-control" placeholder="Jack" value="{{ auth()->check() ? auth()->user()->name : '' }}" required>
                                @error('firstname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-lg-6 col-md-6 col-12">
                                <input type="text" name="lastname" id="lastname" class="form-control" placeholder="Doe" value="{{ auth()->check() ? auth()->user()->surname : '' }}" required>

                                @error('lastname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror


                            </div>
                        </div>

                        <input type="email" name="contactemail" id="contactemail" pattern="[^ @]*@[^ @]*" class="form-control" placeholder="Jackdoe@gmail.com" value="{{ auth()->check() ? auth()->user()->email : '' }}" required>
                        @error('contactemail')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        <textarea name="contactmessage" rows="5" class="form-control" id="contactmessage" placeholder="What can we help you?"></textarea>

                        <button type="submit" class="form-control">Send Message</button>
                    </form>
                </div>

            </div>
        </div>
    </section>

    
</main>


    
@endsection


@section('script')

  
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
                postcode: "#post_code"
            }
        });
    });
    </script>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
   $(document).ready(function(){
        $('#addImageLabel').click(function(){
            var newRow = `
                <div class="row" style="margin-top: 10px;">
                    <div class="col-lg-11 col-12">
                        <div class="row">
                            <div class="col-lg-6 col-12">
                                <div class="input-group mb-3">
                                    <input type="file" class="form-control image-upload" name="images[]" accept="image/*">
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="input-group mb-3">
                                    <textarea class="form-control description resizable" placeholder="Description" rows="3" name="descriptions[]"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-1 col-12 text-end">
                        <button class="btn btn-danger remove" type="button">-</button>
                    </div>
                </div>
            `;
            $('#imageContainer').append(newRow);
            $('.remove').off('click').on('click', function(){
                $(this).closest('.row').remove();
            });
        });
    });

</script>


@endsection