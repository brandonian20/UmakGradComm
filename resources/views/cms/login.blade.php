<!DOCTYPE html>
<html class="no-js') }}" lang="en">

<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
<head>
    <meta charset="utf-8">
    <title>Log In CMS | UMak</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Landing Page of UMak Commencement Website">
    <meta name="author" content="Umak">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"><!-- Favicon-->
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="icon" type="image/png" href="{{ asset('/img/umak_logo.png') }}"><!-- Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&amp;display=swap"><!-- Style-->
    <!-- build:css -->
    <link rel="stylesheet" href="{{ asset('/vendors/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('/vendors/css/swiper-bundle.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/login.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/Poppins.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}"><!-- endbuild -->
    <!-- jQuery-->
    <script src="{{ asset('/vendors/js/jquery.min.js') }}"></script>

</head>

<body class="">

<div class="container-fluid px-0 vh-100">
        <div class="background-img"></div>

        <div class="background-container">
            <div class="header-logo">
                <div class="row">
                    <div class="col-md-2" style="margin: auto">
                        <img src="{{ asset('/img/umak_logo.png') }}" style="width: 90px; margin-bottom: 10px;" />
                    </div>

                    <div class="col-md-10 my-0" style="margin: auto">
                        <table style="width: 100%; color: white">
                            <tr>
                                <td><span style="font-size: 35px;">University Of Makati</span></td>
                            </tr>
                            <tr>
                                <td><small>A public, locally funded university of the local government of Makati.</small></td>
                            </tr>
                            <tr>
                                <td><small>
                                    <?php
                                    
                                        if (DB::connection()->getPdo()){
                                            echo "successfullyconnceted to the database ";
                                        }

                                    ?>
                                </small></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="login-container">
            <div style="display: table-cell; vertical-align: middle;">
                <div class="row">
                    <!--LOGO-->
                    <div class="col-sm-12 text-center">
                        <img src="{{ asset('/img/umak_logo.png') }}" height="230" class="img-responsive login-logo" />
                    </div>
                    <div class="col-sm-12 text-center mb-4">
                        <div class="d-flex justify-content-center align-items-center">
                            <h3 class="h3 mb-0 me-2" style="color: #333; margin-left: -45px">UMak Commencement</h3>
                            <!-- <p class="border border-success text-success px-1 ml-1 rounded mb-0">Beta</p> -->
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="div-controls px-3">
                            <div class="row justify-content-center">
                                <div class="col-sm-8 text-center">
                                    <div class="row">
                                        <form id="formSignIn">
                                            <div class="form-floating mb-3">
                                                <input type="email" class="form-control" name="email" id="floatingEmail">
                                                <label for="floatingEmail">Email address</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input type="password" class="form-control" name="pass" id="floatingPassword">
                                                <label for="floatingPassword">Password</label>
                                            </div>
                                            <button type="submit" class="btn btn-primary btn-block">
                                                Sign In
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!--FOOTER-->
                <div class="row login-footer pb-4 text-secondary mt-5">
                    <p style="margin: 0">Copyright &copy;<script>document.write(new Date().getFullYear());</script></p>
                    <small>All rights reserved | University Of Makati</small>
                </div>
            </div>

        </div>
    </div>


</html>