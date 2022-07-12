<!DOCTYPE html>
<html class="no-js') }}" lang="en">
    <!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
    <head>
        <meta charset="utf-8">
        <title>Commencement | UMak</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="description" content="Landing Page of UMak Commencement Website">
        <meta name="author" content="Umak"> 
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"><!-- Favicon-->
        <link rel="icon" type="image/png" href="{{ asset('/img/umak_logo.png') }}"><!-- Fonts-->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&amp;display=swap"><!-- Style-->
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Marcellus&display=swap" rel="stylesheet">
        <script src="{{ asset('vendors/js/fontawesome.min.js') }}" data-search-pseudo-elements="" defer="" crossorigin="anonymous"></script> <!-- Font Awesome-->
        <!-- build:css -->
        <link rel="stylesheet" href="{{ asset('/vendors/css/magnific-popup.css') }}">
        <link rel="stylesheet" href="{{ asset('/vendors/css/swiper-bundle.css') }}">
        <link rel="stylesheet" href="{{ asset('/css/main.css') }}">
        <link rel="stylesheet" href="{{ asset('/css/style.css') }}"><!-- endbuild -->
        <!-- jQuery-->
        <script src="{{ asset('/vendors/js/jquery.min.js') }}"></script>

    </head>
    <body class="">
        <!-- Header-->
        <!-- Navbar top-->
        <nav class="navbar navbar-expand-lg navbar-top navbar-fixed navbar-dark navbar-opaque navbar-border-bottom text-white">
            <div class="container">
                <a class="navbar-brand position-fixed" href="/">
                    <img src="{{ asset('/img/umak_logo.png') }}" class="img pt-5" style="width: 60px;"/> 
                        {{-- <span class="ps-10 h6 d-none d-lg-inline-block text-white" style="font-family: Helvetica;">UMak Commencement</span> --}}
                    <img src="{{ asset('/img/49th-Commencement-text.png') }}" class="img ms-10 d-none d-sm-inline" style="height: 60px;"/>
                </a>
                <a class="navbar-toggle order-4 ms-auto pe-10 popup-inline" href="#navbar-mobile-style-1"><span></span><span></span><span></span></a>
                <ul class="nav navbar-nav order-2 ms-auto nav-no-opacity"  style="font-family: Helvetica;">
                    <li class="nav-item {{ (request()->is('/*')) ? 'active' : '' }}"><a class="nav-link" href="/"><span>Home</span></a></li >
                    <li class="nav-item {{ (request()->is('gallery')) ? 'active' : '' }}"><a class="nav-link" href="{{url('/gallery')}}"><span>Gallery</span></a></li>
                    <li class="nav-item {{ (request()->is('graduates-gallery')) ? 'active' : '' }} {{ (request()->is('/*')) ? 'd-none' : '' }}"><a class="nav-link" href="{{url('/graduates-gallery')}}"><span>Graduates</span></a></li>
                    {{-- <li class="nav-item navbar-dropdown {{ (request()->is('programflow*')) ? 'active' : '' }}"><a class="nav-link" href="{{ url('/programflow') }}"><span>Programme</span></a>
                        <div class="dropdown-menu rounded-2 shadow">
                            <ul class="nav navbar-nav">
                                <li class="nav-item {{ (request()->is('programflow')) ? 'active' : '' }}"><a class="nav-link" href="{{ url('/programflow') }}"><span>Program Flow</span></a></li>
                                <li class="nav-item {{ (request()->is('programflow#regalia')) ? 'active' : '' }}"><a class="nav-link" href="home-02.html"><span>Regalia</span></a></li>
                                <li class="nav-item {{ (request()->is('programflow#venue')) ? 'active' : '' }}"><a class="nav-link" href="home-03.html"><span>Venue</span></a></li>
                                <li class="nav-item {{ (request()->is('programflow#policies')) ? 'active' : '' }}"><a class="nav-link" href="home-04.html"><span>Policies</span></a></li>
                            </ul>
                        </div>
                    </li> --}}
                </ul>
            </div>
        </nav><!-- Navbar mobile-->
        <div class="navbar navbar-mobile navbar-mobile-style-1 bg-white mfp-hide" id="navbar-mobile-style-1">
            <div class="navbar-wrapper">
                <div class="navbar-head">
                    <a class="navbar-brand d-block d-md-none mt-20" href="/">
                        <img src="{{ asset('/img/umak_logo.png') }}" width="60px" class="float-start me-15">
                        <div class="ps-10 h6 mt-20 ms-15"  style="font-family: Helvetica !important;">UMak Commencement</div>
                        <a class="navbar-toggle popup-modal-dismiss" href="#"><span></span><span></span><span></span>
                    </a>
                </div>
                <div class="navbar-body">
                    <ul class="nav navbar-nav navbar-nav-collapse">
                        <li class="nav-item {{ (request()->is('/*')) ? 'active' : '' }}"><a class="nav-link" href="/"><span>Home</span></a></li>
                        <li class="nav-item {{ (request()->is('gallery')) ? 'active' : '' }}"><a class="nav-link" href="{{url('/gallery')}}"><span>Gallery</span></a></li>
                        <li class="nav-item {{ (request()->is('graduates-gallery')) ? 'active' : '' }} {{ (request()->is('/*')) ? 'd-none' : '' }}"><a class="nav-link" href="{{url('/graduates-gallery')}}"><span>Graduates</span></a></li>
                    </ul>
                </div>
            </div>
        </div>

        {{-- MAIN CONTENT --}}
        <main>
            @yield('content')
        </main>

        <footer class="bg-accent-2 text-dark py-20 footerNext" style="background-color: #052964 !important">
            <div class="container text-white">
                {{-- <div class="d-flex justify-content-between align-items-center gy-50">
                    <img src="{{ asset('/img/umak_logo.png') }}" width="140" class="mb-0 mb-sm-20">
                    <p class="font-size-15 mb-35 text-justify ms-30">The <b>University of Makati (UMak)</b> is a public, locally funded university of the local government of Makati. It is envisioned as the primary instrument where university education and industry training programs interface to mold Makati and non-Makati youth into productive citizens and IT-enabled professionals who are exposed to cutting-edge technology in their areas of specialization. UMak is the final stage of Makati City's integrated primary level to tertiary level educational system that enables its less privileged citizens to compete for job opportunities in various businesses and industries.</p>
                </div> --}}
                {{-- <p class="text-center mb-10">© Copyright 2022 - University of Makati. All Rights Reserved.</p>
                <p class="text-center mb-0"><a href="https://umak.edu.ph/olrog/assets/n_assets/DATA%20PRIVACY%20NOTICE%20FOR%20STUDENTS.pdf" class="text-dark fw-bold text-white" target="_blank" style="top: 0px;">Data Privacy Notice</a></p> --}}
                <div class="row">
                    <div class="row col-lg-6 d-flex justify-content-sm-center text-center text-lg-start">
                        <span>&copy Copyright 2022.</span>
                        <span>University of Makati. All Rights Reserved.</span>
                        <span>Developed by CCIS Student Assistants</span>
                    </div>
                    <div class="row col-lg-6 d-flex justify-content-center justify-content-lg-start">
                        <div class="col-lg-8 d-flex justify-content-center">
                            <span class="me-10">
                                <a class="footer-link"   href="https://www.umak.edu.ph/" target="_blank" alt="University of Makati"> University of Makati</a>
                            </span>
                            <span class="ms-10">
                                <a class="footer-link" href="https://www.makati.gov.ph/" target="_blank" alt="City of Makati"> City of Makati </a>
                            </span>
                        </div>
                        <div class="col-lg-4 d-flex justify-content-center">
                                <a href="https://www.facebook.com/UMakPH/" alt="fb.com/UMakPH" target="_blank"><i class="fa-brands fa-facebook text-white mx-10 footer-icon"></i></a>
                                <a href="https://twitter.com/umakph" alt="twitter.com/umakph" target="_blank"><i class="fa-brands fa-twitter-square mx-10 text-white footer-icon"></i></a>
                                <a href="https://www.youtube.com/universityofmakatiph" alt="youtube.com/universityofmakatiph" target="_blank"><i class="fa-brands fa-youtube mx-10 text-white footer-icon"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </footer><!-- Vendors-->

        <!-- build:js -->
        <script src="{{ asset('/vendors/js/bootstrap.js') }}"></script>
        <script src="{{ asset('/vendors/js/imagesloaded.pkgd.js') }}"></script>
        <script src="{{ asset('/vendors/js/isotope.pkgd.js') }}"></script>
        <script src="{{ asset('/vendors/js/jarallax.js') }}"></script>
        <script src="{{ asset('/vendors/js/jarallax-element.js') }}"></script>
        <script src="{{ asset('/vendors/js/jquery.countdown.js') }}"></script>
        <script src="{{ asset('/vendors/js/jquery.magnific-popup.js') }}"></script>
        <script src="{{ asset('/vendors/js/ofi.js') }}"></script>
        <script src="{{ asset('/vendors/js/jquery.inview.js') }}"></script>
        <script src="{{ asset('/vendors/js/swiper-bundle.js') }}"></script>
        <script src="{{ asset('/vendors/js/gist-embed.min.js') }}"></script>
        <script src="{{ asset('/js/helpers.js') }}"></script>
        <script src="{{ asset('/js/controllers/show-on-scroll.js') }}"></script>
        <script src="{{ asset('/js/controllers/countdown.js') }}"></script>
        <script src="{{ asset('/js/controllers/isotope.js') }}"></script>
        <script src="{{ asset('/js/controllers/navbar.js') }}"></script>
        <script src="{{ asset('/js/controllers/stretch-column.js') }}"></script>
        <script src="{{ asset('/js/controllers/swiper.js') }}"></script>
        <script src="{{ asset('/js/controllers/others.js') }}"></script><!-- endbuild -->
    </body>
</html>
