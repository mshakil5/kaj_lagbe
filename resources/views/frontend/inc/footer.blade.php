<footer class="site-footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-12 mb-4">
                <img src="{{ asset('frontend/images/logo.jpg')}}" class="logo img-fluid" alt="">
            </div>

            <div class="col-lg-4 col-md-6 col-12 mb-4">
                <h5 class="site-footer-title mb-3">Quick Links</h5>

                <ul class="footer-menu">
                    <li class="footer-menu-item"><a href="#" class="footer-menu-link">About</a></li>

                    <li class="footer-menu-item"><a href="#" class="footer-menu-link">Contact</a></li>

                    <li class="footer-menu-item"><a href="#" class="footer-menu-link">Menu Name</a></li>
                    <li class="footer-menu-item"><a href="{{route('terms')}}" class="footer-menu-link">Terms & Conditions</a></li>
                    <li class="footer-menu-item"><a href="{{route('privacy')}}" class="footer-menu-link">Privacy & Policy</a></li>

                </ul>
            </div>

            <div class="col-lg-4 col-md-6 col-12 mx-auto">
                <h5 class="site-footer-title mb-3">Contact Infomation</h5>

                <p class="text-white d-flex mb-2">
                    <i class="bi-telephone me-2"></i>

                    <a href="tel: 0203-994-7611" class="site-footer-link">
                        0203.994.7611
                    </a>
                </p>

                <p class="text-white d-flex">
                    <i class="bi-envelope me-2"></i>

                    <a href="mailto:sam@edgeemg.co.uk" class="site-footer-link">
                        sam@edgeemg.co.uk
                    </a>
                </p>

                <p class="text-white d-flex mt-3">
                    <i class="bi-geo-alt me-2"></i>
                    Address here
                </p>

            </div>
        </div>
    </div>

    
</footer>