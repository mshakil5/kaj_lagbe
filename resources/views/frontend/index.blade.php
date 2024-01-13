<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="">
    <meta name="author" content="">

    <title>Template</title>

    <!-- CSS FILES -->
    <link href="{{ asset('frontend/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ asset('frontend/css/bootstrap-icons.css')}}" rel="stylesheet">
    <link href="{{ asset('frontend/css/templatemo-kind-heart-charity.css')}}" rel="stylesheet">

</head>

<body id="section_1">

    <header class="site-header">
        <div class="container">
            <div class="row">

                <div class="col-lg-8 col-12 d-flex flex-wrap">
                    <p class="d-flex me-4 mb-0">
                        <i class="bi-geo-alt me-2"></i>
                        Akershusstranda 20, 0150 Oslo, Norway
                    </p>

                    <p class="d-flex mb-0">
                        <i class="bi-envelope me-2"></i>

                        <a href="mailto:info@company.com">
                            info@company.com
                        </a>
                    </p>
                </div>

                <div class="col-lg-3 col-12 ms-auto d-lg-block d-none">
                    <ul class="social-icon">
                        <li class="social-icon-item">
                            <a href="#" class="social-icon-link bi-twitter"></a>
                        </li>

                        <li class="social-icon-item">
                            <a href="#" class="social-icon-link bi-facebook"></a>
                        </li>

                        <li class="social-icon-item">
                            <a href="#" class="social-icon-link bi-instagram"></a>
                        </li>

                        <li class="social-icon-item">
                            <a href="#" class="social-icon-link bi-youtube"></a>
                        </li>

                        <li class="social-icon-item">
                            <a href="#" class="social-icon-link bi-whatsapp"></a>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </header>

    <nav class="navbar navbar-expand-lg bg-light shadow-lg">
        <div class="container">
            <a class="navbar-brand" href="{{route('homepage')}}">
                <img src="{{ asset('frontend/images/logo.png')}}" class="logo img-fluid" alt="">
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">

                    <li class="nav-item">
                        <a class="nav-link click-scroll" href="#section_1">About</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link click-scroll" href="#section_2">Volunteer</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link click-scroll" href="#section_3">Contact</a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>

    <main>

        <section class="hero-section hero-section-full-height" style="display: none">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-lg-12 col-12 p-0">
                        <div id="hero-slide" class="carousel carousel-fade slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="{{ asset('frontend/images/slide/volunteer-helping-with-donation-box.jpg')}}"
                                        class="carousel-image img-fluid" alt="...">

                                    <div class="carousel-caption d-flex flex-column justify-content-end">
                                        <h1>be a Kind Heart</h1>

                                        <p>Professional charity theme based on Bootstrap 5.2.2</p>
                                    </div>
                                </div>

                                <div class="carousel-item">
                                    <img src="{{ asset('frontend/images/slide/volunteer-selecting-organizing-clothes-donations-charity.jpg')}}"
                                        class="carousel-image img-fluid" alt="...">

                                    <div class="carousel-caption d-flex flex-column justify-content-end">
                                        <h1>Non-profit</h1>

                                        <p>You can support us to grow more</p>
                                    </div>
                                </div>

                                <div class="carousel-item">
                                    <img src="{{ asset('frontend/images/slide/medium-shot-people-collecting-donations.jpg')}}"
                                        class="carousel-image img-fluid" alt="...">

                                    <div class="carousel-caption d-flex flex-column justify-content-end">
                                        <h1>Humanity</h1>

                                        <p>Please tell your friends about our website</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <section class="section-padding section-bg" id="section_1">
            <div class="container">
                <div class="row">

                    <div class="col-lg-6 col-12 mb-5 mb-lg-0">
                        <img src="{{ asset('frontend/images/group-people-volunteering-foodbank-poor-people.jpg')}}"
                            class="custom-text-box-image img-fluid" alt="">
                    </div>

                    <div class="col-lg-6 col-12">
                        <div class="custom-text-box">
                            <h2 class="mb-2">Our Story</h2>

                            <h5 class="mb-3">Kind Heart Charity, Non-Profit Organization</h5>

                            <p class="mb-0">This is a Bootstrap 5.2.2 CSS template for charity organization websites.
                                You can feel free to use it. Please tell your friends about TemplateMo website. Thank
                                you.</p>
                        </div>

                        {{-- <div class="row">
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="custom-text-box mb-lg-0">
                                    <h5 class="mb-3">Our Mission</h5>

                                    <p>Sed leo nisl, posuere at molestie ac, suscipit auctor quis metus</p>

                                    <ul class="custom-list mt-2">
                                        <li class="custom-list-item d-flex">
                                            <i class="bi-check custom-text-box-icon me-2"></i>
                                            Charity Theme
                                        </li>

                                        <li class="custom-list-item d-flex">
                                            <i class="bi-check custom-text-box-icon me-2"></i>
                                            Semantic HTML
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="custom-text-box d-flex flex-wrap d-lg-block mb-lg-0">
                                    <div class="counter-thumb">
                                        <div class="d-flex">
                                            <span class="counter-number" data-from="1" data-to="2009"
                                                data-speed="1000"></span>
                                            <span class="counter-number-text"></span>
                                        </div>

                                        <span class="counter-text">Founded</span>
                                    </div>

                                    <div class="counter-thumb mt-4">
                                        <div class="d-flex">
                                            <span class="counter-number" data-from="1" data-to="120"
                                                data-speed="1000"></span>
                                            <span class="counter-number-text">B</span>
                                        </div>

                                        <span class="counter-text">Donations</span>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                    </div>

                </div>
            </div>
        </section>

        <section class="volunteer-section p-3" id="section_2">
            <div class="container">
                <div class="row justify-content-md-center">

                    <div class="col-lg-8 col-12">
                        <h2 class="text-white mb-4">Find a worker</h2>

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
                                    Akershusstranda 20, 0150 Oslo, Norway
                                </p>

                                <p class="d-flex mb-2">
                                    <i class="bi-telephone me-2"></i>

                                    <a href="tel: 305-240-9671">
                                        305-240-9671
                                    </a>
                                </p>

                                <p class="d-flex">
                                    <i class="bi-envelope me-2"></i>

                                    <a href="mailto:info@yourgmail.com">
                                        donate@charity.org
                                    </a>
                                </p>

                                {{-- <a href="#" class="custom-btn btn mt-3">Get Direction</a> --}}
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-5 col-12 mx-auto">
                        <form class="custom-form contact-form" action="#" method="post" role="form">
                            <h2>Contact form</h2>

                            <p class="mb-4">Or, you can just send an email:
                                <a href="#">info@charity.org</a>
                            </p>
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

    <footer class="site-footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-12 mb-4">
                    <img src="{{ asset('frontend/images/logo.png')}}" class="logo img-fluid" alt="">
                </div>

                <div class="col-lg-4 col-md-6 col-12 mb-4">
                    <h5 class="site-footer-title mb-3">Quick Links</h5>

                    <ul class="footer-menu">
                        <li class="footer-menu-item"><a href="#" class="footer-menu-link">About</a></li>

                        <li class="footer-menu-item"><a href="#" class="footer-menu-link">Contact</a></li>

                        <li class="footer-menu-item"><a href="#" class="footer-menu-link">Find an assistant</a></li>

                    </ul>
                </div>

                <div class="col-lg-4 col-md-6 col-12 mx-auto">
                    <h5 class="site-footer-title mb-3">Contact Infomation</h5>

                    <p class="text-white d-flex mb-2">
                        <i class="bi-telephone me-2"></i>

                        <a href="tel: 305-240-9671" class="site-footer-link">
                            305-240-9671
                        </a>
                    </p>

                    <p class="text-white d-flex">
                        <i class="bi-envelope me-2"></i>

                        <a href="mailto:info@yourgmail.com" class="site-footer-link">
                            donate@charity.org
                        </a>
                    </p>

                    <p class="text-white d-flex mt-3">
                        <i class="bi-geo-alt me-2"></i>
                        Akershusstranda 20, 0150 Oslo, Norway
                    </p>

                </div>
            </div>
        </div>

        
    </footer>

    <!-- JAVASCRIPT FILES -->
    <script src="{{ asset('frontend/js/jquery.min.js')}}"></script>
    <script src="{{ asset('frontend/js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('frontend/js/jquery.sticky.js')}}"></script>
    <script src="{{ asset('frontend/js/click-scroll.js')}}"></script>
    <script src="{{ asset('frontend/js/counter.js')}}"></script>
    <script src="{{ asset('frontend/js/custom.js')}}"></script>

    <script>
        
    $(document).ready(function () {

        //header for csrf-token is must in laravel
      $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
      //

        //check post code start 
      var url = "{{URL::to('/check-post-code')}}";
        $("#post_code").keyup(function(){
            var length =  $(this).val().length;

            var postcode = $("#post_code").val();
            
            if (length > 2) {
                $.ajax({
                    url: url,
                    method: "POST",
                    data: {postcode},

                    success: function (d) {
                        if (d.status == 303) {
                            $(".perrmsg").html(d.message);
                            $('#submitBtn').attr('disabled', false);
                        }else if(d.status == 300){
                            // console.log(d);
                            $(".perrmsg").html(d.message);
                            $('#submitBtn').attr('disabled', true);
                        }
                    },
                    error: function (d) {
                        console.log(d);
                    }
                }); 
            }else{
                $(".perrmsg").html("");
            }

            
        });
        //check post code end 

    });

    </script>

</body>

</html>