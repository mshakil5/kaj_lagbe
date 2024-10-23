<div class="header navbar navbar-expand-md navbar-light bg-white">
    <a class="logo" href="{{ route('homepage') }}">
        <i class="fas fa-tools"></i> {{ $companyDetails->company_name }}
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <nav class="navbar-nav ml-auto">
            <a class="nav-item nav-link" href="#">
                Homeowner
            </a>
            <a class="nav-item nav-link" href="#">
                Trades
            </a>
            @if(Auth::check())
                @if(auth()->user()->is_type == '1')
                <a class="nav-item nav-link" href="{{ route('admin.dashboard') }}">
                {{ Auth::user()->name }}
                </a>
                @elseif(auth()->user()->is_type == '0')
                <a class="nav-item nav-link" href="{{ route('user.profile') }}">
                {{ Auth::user()->name }}
                </a>
                @elseif(auth()->user()->is_type == '2')
                <a class="nav-item nav-link" href="{{ route('staff.home') }}">
                {{ Auth::user()->name }}
                </a>
                @endif

                @else
                <a class="nav-item nav-link" href="{{ route('login') }}">
                    Login
                </a>
                @endif
        </nav>
    </div>
</div>  