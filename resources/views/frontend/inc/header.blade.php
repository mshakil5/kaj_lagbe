


<nav class="navbar navbar-expand-lg shadow-lg">
    <div class="container">
        <a class="navbar-brand" href="{{route('homepage')}}">
            <img src="{{ asset('frontend/images/image-1200x500.jpg')}}" class="logo img-fluid" alt="">
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
                    <a class="nav-link click-scroll" href="#section_2">Find Help</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link click-scroll" href="#section_3">Contact</a>
                </li>
                
                @if(Auth::check())
                    @if(auth()->user()->is_type == '1')
                        <li class="nav-item">
                            <a class="nav-link click-scroll" href="{{ route('admin.dashboard') }}"><strong>{{ Auth::user()->name }}</strong></a>
                        </li>
                    @elseif(auth()->user()->is_type == '0')
                        <li class="nav-item">
                            <a class="nav-link click-scroll" href="{{ route('user.profile') }}"><strong>{{ Auth::user()->name }}</strong></a>
                        </li>
                    @elseif(auth()->user()->is_type == '2')
                        <li class="nav-item">
                            <a class="nav-link click-scroll" href="{{ route('staff.home') }}"><strong>{{ Auth::user()->name }}</strong></a>
                        </li>
                    @endif
                @else

                    <li class="nav-item">
                        <a class="nav-link click-scroll" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link click-scroll" href="{{ route('register') }}">Register</a>
                    </li>
                @endif

            </ul>
        </div>
    </div>
</nav>