$(function () {
    "use strict";

    $("#formSignIn").on('submit', function () {
        SignIn();
        return false;
    });

    function SignIn() {
        $.ajax({
            url: '/login/signin',
            data: GetFD($("#formSignIn")),
            processData: false,
            contentType: false,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type: 'POST',
            success: function (resp) {
                //console.log(resp);
                if (resp.success) {
                    location.href = resp.data;
                } else if (resp.data == "Already logged in.") {
                    location.reload();
                } else {
                    Swal.mixin({
                        toast: true,
                        position: 'bottom-right',
                        iconColor: 'white',
                        color: 'white',
                        customClass: {
                          popup: 'colored-toast'
                        },
                        showConfirmButton: false,
                        timer: 5000,
                        timerProgressBar: true,
                        background: '#f87474',
                      }).fire({
                        icon: 'error',
                        title: resp.data
                      })
                }
            }, error: function () {
                showToast("Could not connect to the server. Please refresh the page and try again.", 'error');
            }
        });

        return false;
    }

    let toastCounter = 0;
    function showToast(text, type) {
        $.toast({
            text: (type == "error" ? `<span><span id="toast` + (toastCounter++) + `">` + text + `</span></span>` : text),
            showHideTransition: 'slide',
            icon: type,
            position: 'bottom-right',
            hideAfter: (type == "error" && "info" ? 30000 : 7000),
        });

        $(".copyErrMsg").unbind().on('click', function () {
            let prevID = $(this).prev().attr("id");
            CopyToClipboard("" + prevID);
            var $temp = $("<input>");
            $("body").append($temp);
            $temp.val($(this).parent().text()).select();
            document.execCommand("copy");
            $temp.remove();
        });

    }

    

    var processingSpinner = `<div class="spinner-border spinner-border-sm" role="status"> <span class="sr-only">Processing...</span> </div>`;

    // setInterval(function () { CheckSession() }, 5000);

    // let reconToastLoaded, reconToast;
    // function CheckSession() {
    //     try {
    //         $.ajax({
    //             url: '/Session/CheckTimeout',
    //             type: 'POST',
    //             success: function (data) {
    //                 reconToastLoaded ? (reconToast.reset(), reconToastLoaded = false) : '';
    //                 if (data.success)
    //                     location.reload();
    //             },
    //             error: function () {
    //                 if (!reconToastLoaded) {
    //                     reconToast = $.toast({
    //                         text: processingSpinner + " <span class='ml-2'>Attempting to reconnect to the server.</span>",
    //                         hideAfter: false,
    //                         allowToastClose: false,
    //                         position: 'bottom-right',
    //                     });

    //                     reconToastLoaded = true;
    //                 }
    //             }
    //         });
    //     } catch { }

    // }

    function BindSlideshow() {
        setTimeout(function () {
            $(".background-img").vegas({
                timer: false,
                transition: 'fade',
                transitionDuration: 2000,
                delay: 5000,
                slides: [
                    { src: "https://cdn.tatlerasia.com/asiatatler/i/ph/2020/05/05104717-ism-bgc-campus-edit_cover_1999x1140.jpg" },
                    /*{ src: "https://i1.wp.com/newartcenter.org/wp-content/uploads/2021/05/CCF21301-scaled.jpg?fit=2048%2C1497&ssl=1" },
                    { src: "https://lh3.googleusercontent.com/_hK5QJBsCXYOWilAtbrkxQdWLOUdBxU3M5cqhi3-HYMqt3ME4hLHdbIn6UPpQrF-n3L1BmdWj3dX06jaIhiH1e6BKgqNV6JpWAKzoLE6dtUvu0y2=w1280" },
                    { src: "http://www.speedlinellc.com/uploads/1/4/0/8/14088677/img-5466_orig.jpg" },
                    { src: "https://kb.vex.com/hc/article_attachments/360083782811/VEX_IQ_12.jpg" },*/
                ]
            });
        }, 5000);
    }

    function showLoader() {
        $('.invalid').addClass('d-none');
        //$('.loader').removeClass('d-none');
        var loader = '<div class="spinner-border text-warning loader" style="width: 25px;height: 25px; margin:0px 2px;" role="status"></div>';
        $('#btnLoginGoogle').find('img').after(loader).remove();
    }

});

function getUrlVars() {
    var vars = {};
    var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function (m, key, value) {
        vars[key] = value;
    });
    return vars;
}

function getUrlParam(parameter, defaultvalue) {
    var urlparameter = defaultvalue;
    if (window.location.href.indexOf(parameter) > -1) {
        urlparameter = getUrlVars()[parameter];
    }
    return decodeURI(urlparameter);
}

function GetFD(formSelector, appendFD = null) {
    let fd = new FormData();

    for (let x of formSelector.serializeArray()) {
        fd.append(x.name, x.value);
    }

    if (appendFD) {
        for (let i = 0; i < appendFD.length; i++) {
            fd.append(appendFD[i].name, appendFD[i]);
        }
    }

    return fd;
}