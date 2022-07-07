<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard - SB Admin Pro</title>
        <link href="../cdn.jsdelivr.net/npm/simple-datatables%40latest/dist/style.css" rel="stylesheet" />
        <link href="../cdn.jsdelivr.net/npm/litepicker/dist/css/litepicker.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <link rel="icon" type="image/x-icon" href="assets/img/favicon.png" />
        <script data-search-pseudo-elements="" defer="" src="../cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js" crossorigin="anonymous"></script>
        <script src="../cdnjs.cloudflare.com/ajax/libs/feather-icons/4.28.0/feather.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="nav-fixed">
        <nav class="topnav navbar navbar-expand shadow justify-content-between justify-content-sm-start navbar-light bg-white" id="sidenavAccordion">
            <!-- Sidenav Toggle Button-->
            <button class="btn btn-icon btn-transparent-dark order-1 order-lg-0 me-2 ms-lg-2 me-lg-0" id="sidebarToggle"><i data-feather="menu"></i></button>
            <!-- Navbar Brand-->
            <a class="navbar-brand pe-3 ps-4 ps-lg-2" href="index.html">Commencement CMS</a>
            <!-- Navbar Items-->
            <ul class="navbar-nav align-items-center ms-auto">

                <div class="input-group input-group-joined me-3 " data-bs-toggle="tooltip" title="Selected Academic Year">
                    <span class="input-group-text"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg></span>
                    <select name="currentacadyear" id="currentacadyear" class="form-control ps-0 pt-3">
                        <option value="2021-2022" selected>2021 - 2022</option>
                        <option value="2020-2021">2020 - 2021</option>
                    </select>
                </div>

                
                
                <!-- User Dropdown-->
                <li class="nav-item dropdown no-caret dropdown-user me-3 me-lg-4">
                    <a class="btn btn-icon btn-transparent-dark dropdown-toggle" id="navbarDropdownUserImage" href="javascript:void(0);" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img class="img-fluid" src="assets/img/illustrations/profiles/profile-1.png" /></a>
                    <div class="dropdown-menu dropdown-menu-end border-0 shadow animated--fade-in-up" aria-labelledby="navbarDropdownUserImage">
                        <h6 class="dropdown-header d-flex align-items-center">
                            <img class="dropdown-user-img" src="assets/img/illustrations/profiles/profile-1.png" />
                            <div class="dropdown-user-details">
                                <div class="dropdown-user-details-name">Valerie Luna</div>
                                <div class="dropdown-user-details-email"><a href="cdn-cgi/l/email-protection.html" class="__cf_email__" data-cfemail="681e041d060928090704460b0705">[email&#160;protected]</a></div>
                            </div>
                        </h6>
                        <div class="dropdown-divider"></div>
                        <!-- <a class="dropdown-item" href="#!">
                            <div class="dropdown-item-icon"><i data-feather="settings"></i></div>
                            Account
                        </a> -->
                        <a class="dropdown-item" href="#!">
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
                            <a class="nav-link" href="dashboard-1.html">
                                <div class="nav-link-icon"><i class="fa-solid fa-chart-line"></i></div>
                                Dashboard
                            </a>

                            <div class="sidenav-menu-heading">Entity</div>
                            <!-- Sidenav Accordion (Dashboard)-->
                            <a class="nav-link" href="">
                                <div class="nav-link-icon"><i class="fa-solid fa-user-graduate"></i></div>
                                Graduates
                            </a>
                            <a class="nav-link" href="">
                                <div class="nav-link-icon"><i class="fa-solid fa-user-tie"></i></div>
                                Faculty
                            </a>
                            <a class="nav-link" href="">
                                <div class="nav-link-icon"><i class="fa-solid fa-user"></i></div>
                                Guest
                            </a>
                            
                            <!-- Sidenav Menu Heading (Core)-->
                            <div class="sidenav-menu-heading">Information</div>
                            <!-- Sidenav Accordion (Dashboard)-->
                            <a class="nav-link" href="">
                                <div class="nav-link-icon"><i class="fa-solid fa-calendar"></i></div>
                                Academic Year
                            </a>
                            <a class="nav-link" href="">
                                <div class="nav-link-icon"><i data-feather="activity"></i></div>
                                Semester
                            </a>
                            <a class="nav-link" href="">
                                <div class="nav-link-icon"><i class="fa-solid fa-building-columns"></i></div>
                                College
                            </a>
                            <a class="nav-link" href="">
                                <div class="nav-link-icon"><i class="fa-solid fa-book"></i></div>
                                Program
                            </a>
                            <a class="nav-link" href="">
                                <div class="nav-link-icon"><i data-feather="activity"></i></div>
                                Organization
                            </a>
                            <a class="nav-link" href="">
                                <div class="nav-link-icon"><i data-feather="activity"></i></div>
                                Position
                            </a>
                            <a class="nav-link" href="">
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
                    <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
                        <div class="container-xl px-4">
                            <div class="page-header-content pt-4">
                                <div class="row align-items-center justify-content-between">
                                    <div class="col-auto mt-4">
                                        <h1 class="page-header-title">Dashboard</h1>
                                        <div class="page-header-subtitle">Example dashboard overview and content summary</div>
                                    </div>
                                    <div class="col-12 col-xl-auto mt-4">
                                        <div class="input-group input-group-joined border-0" style="width: 16.5rem">
                                            <span class="input-group-text"><i class="text-primary" data-feather="calendar"></i></span>
                                            <input class="form-control ps-0 pointer" id="litepickerRangePlugin" placeholder="Select date range..." />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </header>
                    <!-- Main page content-->
                    <div class="container-xl px-4 mt-n10">
                        <div class="row">
                            <div class="col-xxl-4 col-xl-12 mb-4">
                                <div class="card h-100">
                                    <div class="card-body h-100 p-5">
                                        <div class="row align-items-center">
                                            <div class="col-xl-8 col-xxl-12">
                                                <div class="text-center text-xl-start text-xxl-center mb-4 mb-xl-0 mb-xxl-4">
                                                    <h1 class="text-primary">Welcome to SB Admin Pro!</h1>
                                                    <p class="text-gray-700 mb-0">Browse our fully designed UI toolkit! Browse our prebuilt app pages, components, and utilites, and be sure to look at our full documentation!</p>
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-xxl-12 text-center"><img class="img-fluid" src="assets/img/illustrations/at-work.svg" style="max-width: 26rem" /></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xxl-4 col-xl-6 mb-4">
                                <div class="card card-header-actions h-100">
                                    <div class="card-header">
                                        Recent Activity
                                        <div class="dropdown no-caret">
                                            <button class="btn btn-transparent-dark btn-icon dropdown-toggle" id="dropdownMenuButton" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="text-gray-500" data-feather="more-vertical"></i></button>
                                            <div class="dropdown-menu dropdown-menu-end animated--fade-in-up" aria-labelledby="dropdownMenuButton">
                                                <h6 class="dropdown-header">Filter Activity:</h6>
                                                <a class="dropdown-item" href="#!"><span class="badge bg-green-soft text-green my-1">Commerce</span></a>
                                                <a class="dropdown-item" href="#!"><span class="badge bg-blue-soft text-blue my-1">Reporting</span></a>
                                                <a class="dropdown-item" href="#!"><span class="badge bg-yellow-soft text-yellow my-1">Server</span></a>
                                                <a class="dropdown-item" href="#!"><span class="badge bg-purple-soft text-purple my-1">Users</span></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="timeline timeline-xs">
                                            <!-- Timeline Item 1-->
                                            <div class="timeline-item">
                                                <div class="timeline-item-marker">
                                                    <div class="timeline-item-marker-text">27 min</div>
                                                    <div class="timeline-item-marker-indicator bg-green"></div>
                                                </div>
                                                <div class="timeline-item-content">
                                                    New order placed!
                                                    <a class="fw-bold text-dark" href="#!">Order #2912</a>
                                                    has been successfully placed.
                                                </div>
                                            </div>
                                            <!-- Timeline Item 2-->
                                            <div class="timeline-item">
                                                <div class="timeline-item-marker">
                                                    <div class="timeline-item-marker-text">58 min</div>
                                                    <div class="timeline-item-marker-indicator bg-blue"></div>
                                                </div>
                                                <div class="timeline-item-content">
                                                    Your
                                                    <a class="fw-bold text-dark" href="#!">weekly report</a>
                                                    has been generated and is ready to view.
                                                </div>
                                            </div>
                                            <!-- Timeline Item 3-->
                                            <div class="timeline-item">
                                                <div class="timeline-item-marker">
                                                    <div class="timeline-item-marker-text">2 hrs</div>
                                                    <div class="timeline-item-marker-indicator bg-purple"></div>
                                                </div>
                                                <div class="timeline-item-content">
                                                    New user
                                                    <a class="fw-bold text-dark" href="#!">Valerie Luna</a>
                                                    has registered
                                                </div>
                                            </div>
                                            <!-- Timeline Item 4-->
                                            <div class="timeline-item">
                                                <div class="timeline-item-marker">
                                                    <div class="timeline-item-marker-text">1 day</div>
                                                    <div class="timeline-item-marker-indicator bg-yellow"></div>
                                                </div>
                                                <div class="timeline-item-content">Server activity monitor alert</div>
                                            </div>
                                            <!-- Timeline Item 5-->
                                            <div class="timeline-item">
                                                <div class="timeline-item-marker">
                                                    <div class="timeline-item-marker-text">1 day</div>
                                                    <div class="timeline-item-marker-indicator bg-green"></div>
                                                </div>
                                                <div class="timeline-item-content">
                                                    New order placed!
                                                    <a class="fw-bold text-dark" href="#!">Order #2911</a>
                                                    has been successfully placed.
                                                </div>
                                            </div>
                                            <!-- Timeline Item 6-->
                                            <div class="timeline-item">
                                                <div class="timeline-item-marker">
                                                    <div class="timeline-item-marker-text">1 day</div>
                                                    <div class="timeline-item-marker-indicator bg-purple"></div>
                                                </div>
                                                <div class="timeline-item-content">
                                                    Details for
                                                    <a class="fw-bold text-dark" href="#!">Marketing and Planning Meeting</a>
                                                    have been updated.
                                                </div>
                                            </div>
                                            <!-- Timeline Item 7-->
                                            <div class="timeline-item">
                                                <div class="timeline-item-marker">
                                                    <div class="timeline-item-marker-text">2 days</div>
                                                    <div class="timeline-item-marker-indicator bg-green"></div>
                                                </div>
                                                <div class="timeline-item-content">
                                                    New order placed!
                                                    <a class="fw-bold text-dark" href="#!">Order #2910</a>
                                                    has been successfully placed.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xxl-4 col-xl-6 mb-4">
                                <div class="card card-header-actions h-100">
                                    <div class="card-header">
                                        Progress Tracker
                                        <div class="dropdown no-caret">
                                            <button class="btn btn-transparent-dark btn-icon dropdown-toggle" id="dropdownMenuButton" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="text-gray-500" data-feather="more-vertical"></i></button>
                                            <div class="dropdown-menu dropdown-menu-end animated--fade-in-up" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item" href="#!">
                                                    <div class="dropdown-item-icon"><i class="text-gray-500" data-feather="list"></i></div>
                                                    Manage Tasks
                                                </a>
                                                <a class="dropdown-item" href="#!">
                                                    <div class="dropdown-item-icon"><i class="text-gray-500" data-feather="plus-circle"></i></div>
                                                    Add New Task
                                                </a>
                                                <a class="dropdown-item" href="#!">
                                                    <div class="dropdown-item-icon"><i class="text-gray-500" data-feather="minus-circle"></i></div>
                                                    Delete Tasks
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <h4 class="small">
                                            Server Migration
                                            <span class="float-end fw-bold">20%</span>
                                        </h4>
                                        <div class="progress mb-4"><div class="progress-bar bg-danger" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div></div>
                                        <h4 class="small">
                                            Sales Tracking
                                            <span class="float-end fw-bold">40%</span>
                                        </h4>
                                        <div class="progress mb-4"><div class="progress-bar bg-warning" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div></div>
                                        <h4 class="small">
                                            Customer Database
                                            <span class="float-end fw-bold">60%</span>
                                        </h4>
                                        <div class="progress mb-4"><div class="progress-bar" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div></div>
                                        <h4 class="small">
                                            Payout Details
                                            <span class="float-end fw-bold">80%</span>
                                        </h4>
                                        <div class="progress mb-4"><div class="progress-bar bg-info" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div></div>
                                        <h4 class="small">
                                            Account Setup
                                            <span class="float-end fw-bold">Complete!</span>
                                        </h4>
                                        <div class="progress"><div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div></div>
                                    </div>
                                    <div class="card-footer position-relative">
                                        <div class="d-flex align-items-center justify-content-between small text-body">
                                            <a class="stretched-link text-body" href="#!">Visit Task Center</a>
                                            <i class="fas fa-angle-right"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Example Colored Cards for Dashboard Demo-->
                        <div class="row">
                            <div class="col-lg-6 col-xl-3 mb-4">
                                <div class="card bg-primary text-white h-100">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="me-3">
                                                <div class="text-white-75 small">Earnings (Monthly)</div>
                                                <div class="text-lg fw-bold">$40,000</div>
                                            </div>
                                            <i class="feather-xl text-white-50" data-feather="calendar"></i>
                                        </div>
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between small">
                                        <a class="text-white stretched-link" href="#!">View Report</a>
                                        <div class="text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-xl-3 mb-4">
                                <div class="card bg-warning text-white h-100">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="me-3">
                                                <div class="text-white-75 small">Earnings (Annual)</div>
                                                <div class="text-lg fw-bold">$215,000</div>
                                            </div>
                                            <i class="feather-xl text-white-50" data-feather="dollar-sign"></i>
                                        </div>
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between small">
                                        <a class="text-white stretched-link" href="#!">View Report</a>
                                        <div class="text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-xl-3 mb-4">
                                <div class="card bg-success text-white h-100">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="me-3">
                                                <div class="text-white-75 small">Task Completion</div>
                                                <div class="text-lg fw-bold">24</div>
                                            </div>
                                            <i class="feather-xl text-white-50" data-feather="check-square"></i>
                                        </div>
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between small">
                                        <a class="text-white stretched-link" href="#!">View Tasks</a>
                                        <div class="text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-xl-3 mb-4">
                                <div class="card bg-danger text-white h-100">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="me-3">
                                                <div class="text-white-75 small">Pending Requests</div>
                                                <div class="text-lg fw-bold">17</div>
                                            </div>
                                            <i class="feather-xl text-white-50" data-feather="message-circle"></i>
                                        </div>
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between small">
                                        <a class="text-white stretched-link" href="#!">View Requests</a>
                                        <div class="text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Example Charts for Dashboard Demo-->
                        <div class="row">
                            <div class="col-xl-6 mb-4">
                                <div class="card card-header-actions h-100">
                                    <div class="card-header">
                                        Earnings Breakdown
                                        <div class="dropdown no-caret">
                                            <button class="btn btn-transparent-dark btn-icon dropdown-toggle" id="areaChartDropdownExample" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="text-gray-500" data-feather="more-vertical"></i></button>
                                            <div class="dropdown-menu dropdown-menu-end animated--fade-in-up" aria-labelledby="areaChartDropdownExample">
                                                <a class="dropdown-item" href="#!">Last 12 Months</a>
                                                <a class="dropdown-item" href="#!">Last 30 Days</a>
                                                <a class="dropdown-item" href="#!">Last 7 Days</a>
                                                <a class="dropdown-item" href="#!">This Month</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item" href="#!">Custom Range</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="chart-area"><canvas id="myAreaChart" width="100%" height="30"></canvas></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 mb-4">
                                <div class="card card-header-actions h-100">
                                    <div class="card-header">
                                        Monthly Revenue
                                        <div class="dropdown no-caret">
                                            <button class="btn btn-transparent-dark btn-icon dropdown-toggle" id="areaChartDropdownExample" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="text-gray-500" data-feather="more-vertical"></i></button>
                                            <div class="dropdown-menu dropdown-menu-end animated--fade-in-up" aria-labelledby="areaChartDropdownExample">
                                                <a class="dropdown-item" href="#!">Last 12 Months</a>
                                                <a class="dropdown-item" href="#!">Last 30 Days</a>
                                                <a class="dropdown-item" href="#!">Last 7 Days</a>
                                                <a class="dropdown-item" href="#!">This Month</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item" href="#!">Custom Range</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="chart-bar"><canvas id="myBarChart" width="100%" height="30"></canvas></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
        <script data-cfasync="false" src="cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script src="../cdn.jsdelivr.net/npm/bootstrap%405.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="../cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables/datatables-simple-demo.js"></script>
        <script src="../cdn.jsdelivr.net/npm/litepicker/dist/bundle.js" crossorigin="anonymous"></script>
        <script src="js/litepicker.js"></script>

        <script src="../assets.startbootstrap.com/js/sb-customizer.js"></script>

    </body>

<!-- Mirrored from sb-admin-pro.startbootstrap.com/dashboard-1.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 06 Jul 2022 06:10:53 GMT -->
</html>
