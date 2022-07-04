@page
@model ITHelpDesk.Views.Login.IndexModel
@inject IConfiguration _config
@{
    Layout = null;
}

<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Sign In - IT Helpdesk</title>

    <link rel="stylesheet" href="~/css/login.css" />
    <link rel="stylesheet" href="~/css/all.css" />
    <link rel="stylesheet" href="~/css/vegas.min.css" />
    <link href="~/css/Poppins.css" rel="stylesheet" />
    <link rel="stylesheet" href="~/css/bootstrap.min.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="icon" sizes="72x72" href="~/img/ITHelpdesk.svg" />
    <link rel="manifest" href="manifest.json" />
    <link rel="icon" type="image/png" sizes="72x72" href="~/img/icons/icon-72x72.png" />
    <script src="https://kit.fontawesome.com/cbb8b7ea9e.js" crossorigin="anonymous"></script>

    <script src="https://cdn.botframework.com/botframework-webchat/latest/webchat.js"></script>

</head>

<body ontouchstart="">
    <div class="container-fluid px-0 vh-100">
        <div class="background-img"></div>

        <div class="background-container">
            <div class="header-logo">
                <div class="row">
                    <div class="col-md-2" style="margin: auto">
                        <img src="~/img/ISM-new.png" style="width: 90px; margin-bottom: 10px;" />
                    </div>

                    <div class="col-md-10 my-0" style="margin: auto">
                        <table style="width: 100%; color: white">
                            <tr>
                                <td><span style="font-size: 35px;">International School Manila</span></td>
                            </tr>
                            <tr>
                                <td><small>A private, non-profit day school for boys and girls</small></td>
                            </tr>
                            <tr>
                                <td><small>from Preschool to Grade 12 in the Philippines</small></td>
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
                        <img src="~/img/ITHelpdesk.svg" height="230" class="img-responsive login-logo" />
                    </div>
                    @{
                        string appname = _config.GetValue<string>("App:Name");
                    }
                    <div class="col-sm-12 text-center mb-4">
                        <div class="d-flex justify-content-center align-items-center">
                            <h3 class="h3 mb-0 me-2" style="color: #333; margin-left: -45px">@appname</h3>
                            <p class="border border-success text-success px-1 ml-1 rounded mb-0">Beta</p>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="div-controls px-3">
                            <div class="row justify-content-center">
                                <div class="col-sm-8 text-center">
                                    <div class="row">
                                        <form id="formSignIn">
                                            @*<input type="email" class="form-control" name="email" value="AgootF@ismanila.org"/>*@
                                            <input type="email" class="form-control" name="email" value="AlarH@ismanila.org" />
                                            <button type="submit" class="btn btn-primary btn-block">
                                                Submit
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
                    <small>All rights reserved | International School Manila</small>
                </div>
            </div>

            @*Chatbot iFrame*@
            @*<div>
                <iframe src="https://webchat.botframework.com/embed/ISMITBOT-V1?s=SJDLDblDGVQ.4U4t8m24doOgm0uYamhrkXBogDd79EySLnFk6Q1POhI" style="height: 100vh"></iframe>
                </div>*@

            <button class="chat-btn">
                <i class='fak fa-chatbot' style='font-size: 30px;'></i>
            </button>
            <div class="chat-popup" style="text-align:left !important">
                <div class="card-header">
                    <h5 class=" mb-0 text-white "> IT Helpdesk Chatbot  
                        <button id="chat-reset" style="position:absolute; right: 50px; background-color:transparent  ;" data-bs-toggle="tooltip" data-bs-placement="top" title="Start Over">  <i class="fa-solid fa-arrows-rotate" style="color:white;"></i></button>
                        <button id="chat-minimize" style="position:absolute; right: 15px; background-color:transparent  ;" data-bs-toggle="tooltip" data-bs-placement="top" title="Minimize">  <i class="fa-solid fa-angle-down align-self-end " style="color:white;"></i></button>
                    </h5>
                </div>
                <div class="chat-area" id="webchat">
                </div>
            </div>

            <div id="toaster" style="text-align:left !important">
                <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-body">
                        Hi I’m your IT Virtual Assistant! How may I help you today?
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Application Install Modal -->
    <!--<div id="divInstallOverlay" style="position: fixed; bottom: 0px; display: none; left: 0px; width: 100vw; height: 100vh; background: rgba(0, 0, 0, 0.5); z-index: 2;"></div>
    <div id="divInstall" class="position-fixed w-100 p-4 bg-white shadow-lg" style="bottom: 0px; opacity: 0; left: 0px; z-index: 2;">
        <div class="media">
            <img src="img/icons/icon.png" class="mr-3" style="width: 70px;" />
            <div class="media-body py-2">
                <h5 class="mb-0"><% ConfigurationManager.AppSettings["SiteName"].ToString() %></h5>
            </div>
        </div>

        <button type="button" id="btnInstall" class="mt-2 btn btn-primary float-right">Add to Homescreen</button>
    </div>-->
    <!-- JAVASCRIPT -->
    <script src="~/js/libs/jquery.min.js"></script>
    <script src="~/js/libs/bootstrap.bundle.min.js"></script>
    <script src="~/js/libs/vegas.min.js"></script>

    <script src="~/js/libs/toast/src/jquery.toast.js"></script>
    <link href="~/js/libs/toast/src/jquery.toast.css" rel="stylesheet" />

    <!-- SWALERT -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>let app = "@_config["App:Root"]"</script>
    @*<script src="~/js/global.js"></script>*@

    <script src="~/js/pages/login.js"></script>

</body>
</html>
