<div class="footer">
    <p>
        <a href="{{ route('aboutUs') }}">
            About us
        </a>
        |
        <a href="#">
            Terms of use
        </a>
        |
        <a href="#">
            Privacy
        </a>
        |
        <a href="#">
            Cookies
        </a>
        |
        <a href="{{ route('contact.show') }}">
            Contact us
        </a>
        |
        <a href="#">
            Sitemap
        </a>
        |
        <a href="#">
            Careers
        </a>
    </p>
    <div class="social-icons">
        <i class="fab fa-facebook-f">
        </i>
        <i class="fab fa-twitter">
        </i>
        <i class="fab fa-instagram">
        </i>
        <i class="fab fa-youtube">
        </i>
        <i class="fab fa-linkedin-in">
        </i>
    </div>
    <p>
        ©  {{ $companyDetails->company_name }} {{ date('Y') }} all rights reserved
    </p>
</div>