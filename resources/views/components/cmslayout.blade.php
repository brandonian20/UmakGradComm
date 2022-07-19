<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <title>{{$title}} | UMak Commencement CMS</title>
        <link rel="icon" type="image/png" href="{{ asset('/img/umak_logo.png') }}" />
        <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
        <link href="{{ asset('vendors/css/litepicker.css') }}" rel="stylesheet" />
        <link href="{{ asset('vendors/css/datatable-style.css')}}" rel="stylesheet" />
        <script src="{{ asset('vendors/js/fontawesome.min.js') }}" data-search-pseudo-elements="" defer="" crossorigin="anonymous"></script>
        <script src="{{ asset('vendors/js/feather.min.js') }}" crossorigin="anonymous"></script>

        {{-- <script data-cfasync="false" src="cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script> --}}
        <script src="{{ asset('vendors/js/jquery.min.js') }}"></script>
        <script src="{{ asset('js/scripts.js') }}"></script>
        <script src="{{ asset('vendors/js/bootstrap.bundle.min.js') }}" crossorigin="anonymous"></script>
        <script src="{{ asset('vendors/js/Chart.min.js') }}" crossorigin="anonymous"></script>
        {{-- <script src="{{ asset('vendors/js/simple-datatables@latest.js') }}" crossorigin="anonymous"></script> --}}
        <script src="{{ asset('vendors/js/litepicker.js') }}" crossorigin="anonymous"></script>
        <script src="{{ asset('vendors/js/sb-customizer.js') }}"></script>

        <script src="{{ asset('js/global.js') }}"></script>

        {{-- Datatable --}}
        <link href="{{ asset('vendors/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
        <script src="{{ asset('vendors/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('vendors/js/dataTables.bootstrap5.min.js') }}"></script>
        
        {{-- Sweet Alert --}}
        <script src="{{ asset('vendors/js/sweetalert2.all.min.js') }}"></script>
        <link rel="stylesheet" href="{{ asset('vendors/css/sweetalert2.css') }}">

        {{-- Select2 --}}
        <script src="{{ asset('vendors/js/select2.min.js') }}"></script>
        <link rel="stylesheet" href="{{ asset('vendors/css/select2.min.css') }}">

    </head>
    <body class="nav-fixed">
        <nav class="topnav navbar navbar-expand shadow justify-content-between justify-content-sm-start navbar-light bg-white" id="sidenavAccordion">
            <!-- Sidenav Toggle Button-->
            <button class="btn btn-icon btn-transparent-dark order-1 order-lg-0 me-2 ms-lg-2 me-lg-0" id="sidebarToggle"><i data-feather="menu"></i></button>
            <!-- Navbar Brand-->
            <a class="navbar-brand pe-3 ps-4 ps-lg-2" href="index.html">Commencement CMS</a>
            <!-- Navbar Items-->
            <ul class="navbar-nav align-items-center ms-auto">

                {{-- <div class="input-group input-group-joined me-3 " data-bs-toggle="tooltip" title="Selected Academic Year">
                    <span class="input-group-text"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg></span>
                    <select name="currentacadyear" id="currentacadyear" class="form-control ps-0 pt-3">
                        <option value="2022" selected>2022</option>
                        <option value="2021">2021</option>
                        <option value="2020">2020</option>
                    </select>
                </div> --}}

                <!-- User Dropdown-->
                <li class="nav-item dropdown no-caret dropdown-user me-3 me-lg-4">
                    <a class="btn btn-icon border btn-transparent-dark dropdown-toggle" id="navbarDropdownUserImage" href="javascript:void(0);" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa-solid fa-user" style="height: 25px; width: 25px;"></i></a>
                    <div class="dropdown-menu dropdown-menu-end border-0 shadow animated--fade-in-up" aria-labelledby="navbarDropdownUserImage">
                        <h6 class="dropdown-header d-flex align-items-center">
                            <i class="dropdown-user-img fa-solid fa-user"></i>
                            {{-- <img class="dropdown-user-img" src="assets/img/illustrations/profiles/profile-1.png" /> --}}
                            <div class="dropdown-user-details">
                                <div class="dropdown-user-details-name">{{ Session::get('userData.name') }}</div>
                                <div class="dropdown-user-details-email"><small>{{ Session::get('userData.email') }}</small></div>
                            </div>
                        </h6>
                        <div class="dropdown-divider"></div>
                        <!-- <a class="dropdown-item" href="#!">
                            <div class="dropdown-item-icon"><i data-feather="settings"></i></div>
                            Account
                        </a> -->
                        <a class="dropdown-item" href="/login/signout">
                            <div class="dropdown-item-icon"><i data-feather="log-out"></i></div>
                            Logout
                        </a>
                    </div>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sidenav shadow-right sidenav-light">
                    <div class="sidenav-menu">
                        <div class="nav accordion" id="accordionSidenav">
                            <!-- Sidenav Menu Heading (Core)-->
                            <div class="sidenav-menu-heading"></div>
                            <!-- Sidenav Accordion (Dashboard)-->
                            <a class="nav-link" href="/dashboard">
                                <div class="nav-link-icon"><i class="fa-solid fa-chart-line"></i></div>
                                Dashboard
                            </a>

                            <div class="sidenav-menu-heading">Entity</div>
                            <!-- Sidenav Accordion (Dashboard)-->
                            <a class="nav-link" href="/graduates">
                                <div class="nav-link-icon"><i class="fa-solid fa-user-graduate"></i></div>
                                Graduates
                            </a>
                            <a class="nav-link" href="/faculty">
                                <div class="nav-link-icon"><i class="fa-solid fa-user-tie"></i></div>
                                Faculty
                            </a>
                            <a class="nav-link" href="/guest">
                                <div class="nav-link-icon"><i class="fa-solid fa-user"></i></div>
                                Guest
                            </a>
                            
                            <!-- Sidenav Menu Heading (Core)-->
                            <div class="sidenav-menu-heading">Information</div>
                            <!-- Sidenav Accordion (Dashboard)-->
                            <a class="nav-link" href="/academicYear">
                                <div class="nav-link-icon"><i class="fa-solid fa-calendar"></i></div>
                                Academic Year
                            </a>
                            <a class="nav-link" href="/semester">
                                <div class="nav-link-icon"><i data-feather="activity"></i></div>
                                Semester
                            </a>
                            <a class="nav-link" href="/college">
                                <div class="nav-link-icon"><i class="fa-solid fa-building-columns"></i></div>
                                College
                            </a>
                            <a class="nav-link" href="/program">
                                <div class="nav-link-icon"><i class="fa-solid fa-book"></i></div>
                                Program
                            </a>
                            <a class="nav-link" href="/organization">
                                <div class="nav-link-icon"><i data-feather="activity"></i></div>
                                Organization
                            </a>
                            <a class="nav-link" href="/position">
                                <div class="nav-link-icon"><i data-feather="activity"></i></div>
                                Position
                            </a>
                            <a class="nav-link" href="/honor">
                                <div class="nav-link-icon"><i class="fa-solid fa-award"></i></div>
                                Honor
                            </a>
                            
                        </div>
                    </div>
                    <!-- Sidenav Footer-->
                    <div class="sidenav-footer">
                        <div class="sidenav-footer-content">
                            <!-- <div class="sidenav-footer-subtitle">Logged in as:</div>
                            <div class="sidenav-footer-title">Valerie Luna</div> -->
                        </div>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    @yield('content')
                </main>
                <footer class="footer-admin mt-auto footer-light">
                    <div class="container-xl px-4">
                        <div class="row">
                            <div class="col-md-6 small">Copyright © UMak Commencement CMS</div>
                            <div class="col-md-6 text-md-end small">
                                <a href="#!">Privacy Policy</a>
                                ·
                                <a href="#!">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        

        <script>
            $(document).ready(function () {
                var path = window.location.pathname;
                var page = path.split("/").pop();
                $(`a.nav-link[href='/${page}']`).addClass('active');
            });
        </script>
    </body>

<!-- Mirrored from sb-admin-pro.startbootstrap.com/dashboard-1.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 06 Jul 2022 06:10:53 GMT -->
</html>
