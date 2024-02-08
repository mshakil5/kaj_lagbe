
@extends('layouts.master')
@section('content')


<main>
    <section class="section-padding section-bg" id="section_1">
        <div class="container">
            <div class="row">

                <div class="col-lg-6 col-12 mb-5 mb-lg-0">
                    <img src="{{ asset('6242692.jpg')}}"
                        class="custom-text-box-image img-fluid" alt="">
                </div>

                <div class="col-lg-6 col-12">
                    <div class="custom-text-box">
                        <h2 class="mb-2">About Us</h2>

                        <h5 class="mb-3">About our details will be there...</h5>

                        <p class="mb-0">About our details will be there...</p>
                    </div>

                </div>

            </div>
        </div>
    </section>

    <section class="volunteer-section p-3" id="section_2">
        <div class="container">
            <div class="row justify-content-md-center">

                <div class="col-lg-8 col-12">
                    <h2 class="text-white mb-4">Title will be there...</h2>

                    @if ($message = Session::get('message'))
                        <div class="alert alert-primary alert-dismissible fade show" role="alert">
                            <strong>{{ $message }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <form class="custom-form volunteer-form mb-5 mb-lg-0" action="{{route('work.store')}}" method="post" role="form" enctype="multipart/form-data">
                        @csrf
                        <h3 class="mb-4">Submit your details</h3>

                        <div class="row">
                            <div class="col-lg-4 col-12">
                                <label for="name"> Name</label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="Jack Doe" required>
                            </div>

                            <div class="col-lg-4 col-12">
                                <label for="email"> Email</label>
                                <input type="email" name="email" id="email"
                                    pattern="[^ @]*@[^ @]*" class="form-control" placeholder="Jackdoe@gmail.com" required>
                            </div>

                            <div class="col-lg-4 col-12">
                                <label for="phone"> Phone</label>
                                <input type="number" name="phone" id="phone" class="form-control" required>
                            </div>

                            
                            <div class="col-lg-3 col-12">
                                <label for="house_number"> House Number</label>
                                <input type="text" name="house_number" id="house_number" class="form-control" required>
                            </div>

                            
                            <div class="col-lg-3 col-12">
                                <label for="town"> Town</label>
                                <input type="text" name="town" id="town" class="form-control" required>
                            </div>

                            
                            <div class="col-lg-3 col-12">
                                <label for="street">Street Name</label>
                                <input type="text" name="street" id="street" class="form-control" required>
                            </div>

                            
                            <div class="col-lg-3 col-12">
                                <label for="post_code"> Post Code</label>
                                <input type="text" name="post_code" id="post_code" class="form-control" required>
                                <div class="perrmsg"></div>
                            </div>

                            <div class="col-lg-12 col-12">
                                <div class="input-group input-group-file">
                                    <input type="file" class="form-control" id="inputGroupFile02" name="images[]" multiple>
                                    <label class="input-group-text" for="inputGroupFile02">Upload Images</label>
                                    <i class="bi-cloud-arrow-up ms-auto"></i>
                                </div>
                            </div>
                        </div>

                        <textarea name="message" rows="3" class="form-control" id="message"
                            placeholder="Comment (Optional)"></textarea>

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

                        <div class="contact-image-wrap d-flex flex-wrap">
                            <img src="{{ asset('frontend/images/avatar/pretty-blonde-woman-wearing-white-t-shirt.jpg')}}"
                                class="img-fluid avatar-image" alt="">

                            <div class="d-flex flex-column justify-content-center ms-3">
                                <p class="mb-0">Clara Barton</p>
                                <p class="mb-0"><strong>HR & Office Manager</strong></p>
                            </div>
                        </div>

                        <div class="contact-info">
                            <h5 class="mb-3">Contact Infomation</h5>

                            <p class="d-flex mb-2">
                                <i class="bi-geo-alt me-2"></i>
                                Address here
                            </p>

                            <p class="d-flex mb-2">
                                <i class="bi-telephone me-2"></i>

                                <a href="tel: 305-240-9671">
                                    Phone number here
                                </a>
                            </p>

                            <p class="d-flex">
                                <i class="bi-envelope me-2"></i>

                                <a href="mailto:info@yourgmail.com">
                                    Email here
                                </a>
                            </p>

                            {{-- <a href="#" class="custom-btn btn mt-3">Get Direction</a> --}}
                        </div>
                    </div>
                </div>

                <div class="col-lg-5 col-12 mx-auto">
                    <form class="custom-form contact-form" action="#" method="post" role="form">
                        <h2>Contact form</h2>

                        
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-12">
                                <input type="text" name="first-name" id="first-name" class="form-control"
                                    placeholder="Jack" required>
                            </div>

                            <div class="col-lg-6 col-md-6 col-12">
                                <input type="text" name="last-name" id="last-name" class="form-control"
                                    placeholder="Doe" required>
                            </div>
                        </div>

                        <input type="email" name="email" id="email" pattern="[^ @]*@[^ @]*" class="form-control"
                            placeholder="Jackdoe@gmail.com" required>

                        <textarea name="message" rows="5" class="form-control" id="message"
                            placeholder="What can we help you?"></textarea>

                        <button type="submit" class="form-control">Send Message</button>
                    </form>
                </div>

            </div>
        </div>
    </section>

    
</main>
    
@endsection