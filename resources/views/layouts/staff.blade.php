<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solomon Maintainance</title>

    @php
        $companyDetails = \App\Models\CompanyDetails::first();
    @endphp

    <link rel="icon" href="{{ asset('images/company/' . $companyDetails->fav_icon) }}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <link rel="stylesheet" href="{{ asset('assets/staff/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/staff/css/app.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/admin/datatables/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/admin/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/admin/datatables-buttons/css/buttons.bootstrap4.min.css')}}">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets/admin/css/adminlte.min.css')}}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('assets/admin/css/OverlayScrollbars.min.css')}}">
    <!-- Ekko Lightbox -->
    <link rel="stylesheet" href="{{ asset('assets/admin/ekko-lightbox/ekko-lightbox.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/admin/lightbox/lightbox.min.css')}}">

    <style>
        .navbar.navbar-light {
            background-color: transparent !important;
        }
    </style>
</head>

<body>

    <section class='header-main'>
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light ">
                <div class="container-fluid">
                    <a class="navbar-brand" href="{{ route('homepage') }}">
                        <img src="{{ asset('frontend/images/image-1200x500.jpg')}}" class="img-fluid d-block" alt=""
                            style="width: 200px;">
                    </a>

                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0"> </ul>
                        <ul class="navbar-nav mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link mt-2 fs-4" aria-current="page" style="cursor: pointer;">
                                    <strong>{{ auth()->user()->name }} {{ auth()->user()->surname }}</strong>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </section>

    <section class='dashboard'>

        <div class="leftBar" id="sidebar">
            <div class="slide" onclick="slide()"> 
                <span class="iconify" data-icon="ion:log-in-outline"
                    data-inline="false">
                </span> 
            </div>

            <div class="sideMenu">

                <div class="profile w-100 d-flex justify-content-center mb-4">
                   <img src="{{ asset('images/staff/' . auth()->user()->photo) }}" style="border-radius: 50%; width: 150px; height: 150px;">

                </div>

                <p>general</p>

                <ul class="menu-items">
                    <li class="nav-item {{ request()->routeIs('staff.home') ? 'active' : '' }}">
                        <a href="{{ route('staff.home') }}" class="d-flex align-items-center">
                            <span class="iconify" data-icon="ant-design:dashboard-filled" data-inline="false" style="font-size: 1.5em;"></span>
                            <span class="ms-2">Dashboard</span>
                        </a>
                    </li>

                    <li class="nav-item {{ request()->routeIs('assigned.tasks.staff') ? 'active' : '' }}">
                        <a href="{{ route('assigned.tasks.staff') }}" class="d-flex align-items-center">
                            <span class="iconify" data-icon="ant-design:file-outlined" data-inline="false" style="font-size: 1.5em;"></span>
                            <span class="ms-2">Due Tasks</span>
                        </a>
                    </li>

                    <li class="nav-item {{ request()->routeIs('completed.tasks.staff') ? 'active' : '' }}">
                        <a href="{{ route('completed.tasks.staff') }}" class="d-flex align-items-center">
                            <span class="iconify" data-icon="ant-design:check-outlined" data-inline="false" style="font-size: 1.5em;"></span>
                            <span class="ms-2">Completed Tasks</span>
                        </a>
                    </li>
                </ul>

                <ul class="menu-items">

                    <p>Account</p>

                    <li class="nav-item {{ request()->routeIs('staff.profile.edit') ? 'active' : '' }}">
                        <a href="{{ route('staff.profile.edit') }}" class="d-flex align-items-center">
                            <span class="iconify" data-icon="ant-design:user-outlined" data-inline="false" style="font-size: 1.5em;"></span>
                            <span class="ms-2">Profile</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <span class="iconify icon" data-icon="fa:sign-out" data-inline="false"></span>
                            {{ __('Sign Out') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>

        </div>

        <div class="rightBar p-4">
            <!-- Main content -->
                 @yield('content')
            <!-- /.content -->
        </div>

    </section>

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="footer-block">
                        <a class="navbar-brand" href="#">
                            <img src="{{ asset('frontend/images/image-1200x500.jpg')}}" class="img-fluid d-block" alt=""
                                style="width: 150px; height: 70px;">
                        </a>
                        <div class="copyright">
                            <!-- <span> &copy;</span> 2021 ifundEducation -->
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-lg-4">
                            <ul class="links">
                                <li><a href="">Terms</a></li>
                                <li><a href="">Privacy Policy</a></li>
                            </ul>
                        </div>
                        <div class="col-lg-4">
                            <ul class="links">
                                <li><a href="">FAQS</a></li>
                                <li><a href="">About</a></li>
                            </ul>
                        </div>
                        <div class="col-lg-4 d-none">
                            <h5 class="social-title">Connect with us</h5>
                            <div class="social">
                                <a href="" title="Facebook">
                                    <span class="iconify" data-icon="ic:baseline-facebook" data-inline="false"></span>
                                </a>
                                <a href="" title="Instagram">
                                    <span class="iconify" data-icon="ant-design:instagram-filled" data-inline="false"></span>
                                </a>
                                <a href="" title="LinkedIn">
                                    <span class="iconify" data-icon="entypo-social:linkedin-with-circle" data-inline="false"></span>
                                </a>
                                <a href="" title="Twitter">
                                    <span class="iconify" data-icon="entypo-social:twitter-with-circle" data-inline="false"></span>
                                </a>
                                <a href="" title="Email">
                                    <span class="iconify" data-icon="carbon:email" data-inline="false"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>


    <script src="https://code.iconify.design/2/2.0.1/iconify.min.js"></script>
    <script src="{{ asset('assets/staff/js/app.js')}}"></script>
    <script src="{{ asset('assets/staff/js/popper.min.js')}}"></script>
    <script src="{{ asset('assets/staff/js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('assets/staff/js/jquery-3.5.1.min.js')}}"></script>


    <script src="{{ asset('assets/admin/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('assets/admin/datatables/dataTables.bootstrap4.min.js')}}"></script>

    <script src="{{ asset('assets/admin/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{ asset('assets/admin/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>

    <script src="{{ asset('assets/admin/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{ asset('assets/admin/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{ asset('assets/admin/datatables/jszip/jszip.min.js')}}"></script>
    <script src="{{ asset('assets/admin/datatables/pdfmake/pdfmake.min.js')}}"></script>
    <script src="{{ asset('assets/admin/datatables/pdfmake/vfs_fonts.js')}}"></script>

    <script src="{{ asset('assets/admin/datatables-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{ asset('assets/admin/datatables-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{ asset('assets/admin/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
    <script src="{{ asset('assets/admin/lightbox/lightbox.min.js')}}"></script>

    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('assets/admin/js/jquery-ui.min.js')}}"></script>

    <!-- Bootstrap 4 -->
    <script src="{{ asset('assets/admin/js/bootstrap.bundle.min.js')}}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('assets/admin/js/jquery.overlayScrollbars.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('assets/admin/js/adminlte.js')}}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ asset('assets/admin/js/dashboard.js')}}"></script>
    <!-- Ekko Lightbox -->
    <script src="{{ asset('assets/admin/ekko-lightbox/ekko-lightbox.min.js')}}"></script>
    <script src="{{ asset('assets/staff/js/sweetalert.min.js')}}"></script>

    @yield('script')
    
</body>

</html>