var approot = (window.location.pathname.split("/")[1] === app ? "/" + app : "");

$(function () {
    "use strict";

    $("#formSignIn").on('submit', function () {
        SignIn();
        return false;
    });

    function SignIn() {
        $.ajax({
            url: approot + '/Login/SignIn',
            data: { data: $("#formSignIn").serialize() },
            type: 'POST',
            success: function (resp) {
                if (resp.success) {
                    if (getUrlParam("RedirectUrl", "null") != "null") {
                        location.href = approot + decodeURIComponent(getUrlParam("RedirectUrl").replace(/\+/g, " "))
                                                    //location.href.split("RedirectUrl=")[1];
                    } else {
                        location.href = approot + resp.data;
                    }
                } else if (resp.data == "Already logged in.") {
                    location.reload();
                } else {
                    showToast(resp.data, 'error');
                }
            }, error: function () {
                showToast("Could not connect to the server. Please refresh the page and try again.", 'error');
            }
        });
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

    setInterval(function () { CheckSession() }, 5000);

    let reconToastLoaded, reconToast;
    function CheckSession() {
        try {
            $.ajax({
                url: approot + '/Session/CheckTimeout',
                type: 'POST',
                success: function (data) {
                    reconToastLoaded ? (reconToast.reset(), reconToastLoaded = false) : '';
                    if (data.success)
                        location.reload();
                },
                error: function () {
                    if (!reconToastLoaded) {
                        reconToast = $.toast({
                            text: processingSpinner + " <span class='ml-2'>Attempting to reconnect to the server.</span>",
                            hideAfter: false,
                            allowToastClose: false,
                            position: 'bottom-right',
                        });

                        reconToastLoaded = true;
                    }
                }
            });
        } catch { }

    }

    var btn_switch = 1;

    $(".chat-btn").click(function () {
        if (btn_switch == 1) {
            $('.chat-popup').toggle(200);
            //$("#toast").css("visibility", "hidden");
            $("#toaster").css("display", "none");
            
            $('.chat-popup').addClass('show');
            $('.chat-btn').html("<i class='fa-regular fa-xmark' style='font-size: 30px;'></i>");
            /*$('.chat-btn').css("visibility","hidden");*/
            btn_switch = 0;
        } else if (btn_switch == 0) {
            $('.chat-popup').toggle(200);
            $('.chat-popup').removeClass('show');
            $('.chat-btn').html("<i class='fak fa-chatbot' style='font-size: 30px;'></i>");
            btn_switch = 1;
        }
    });

    $("#chat-minimize").click(function () {
        $('.chat-popup').toggle(200);
        $('.chat-popup').removeClass('show');
        $('.chat-btn').html("<i class='fak fa-chatbot' style='font-size: 30px;'></i>");
        btn_switch = 1;
        /*$('.chat-btn').css("visibility","visible");*/
    });

    $("#liveToast").toast('show');
    $("#liveToast").toast({ autohide: true });
    $("#liveToast").toast({ delay: 10000 });
    $(".chat-btn").click(function () {
        $("#liveToast").toast('hide');
    });


    BindSlideshow();

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

    const styleSet = window.WebChat.createStyleSet({
        backgroundColor: 'white',
        botAvatarBackgroundColor: 'white',

        showNub: true,
        bubbleNubOffset: 'bottom',
        bubbleNubSize: 10,

        bubbleTextColor: 'Black',
        bubbleBorderRadius: 10,
        bubbleBackground: '#e6e5eb',

        bubbleFromUserNubOffset: '10',
        bubbleFromUserNubSize: 10,
        bubbleFromUserBorderRadius: 10,
        bubbleFromUserTextColor: 'White',
        bubbleFromUserBackground: '#5b876b',

        // sendBoxButtonColor: '#15532B',
        // sendBoxHeight: 50,
        typingAnimationBackgroundImage: true,
        typingAnimationDuration: 5000,
        typingAnimationHeight: 20,
        typingAnimationWidth: 64,
        suggestedActionBorderRadius: 10,
        suggestedActionBackgroundColorOnHover: '#d0ddd5',
        suggestedActionBorderColor: '#28546c',
        suggestedActionTextColor: '#28546c'

    });

    const chatStyles = {

        suggestedActionLayout: 'flow',


        botAvatarImage: approot+"/img/chatbotlogo.JPG",
        botAvatarInitials: 'BOT',


        hideUploadButton: true,

        showNub: true,
        bubbleNubOffset: 'bottom',
        bubbleNubSize: 10,

        bubbleFromUserNubOffset: '10',
        bubbleFromUserNubSize: 10,
    };

    window.WebChat.renderWebChat({
        directLine: window.WebChat.createDirectLine({
            token: 'SJDLDblDGVQ.4U4t8m24doOgm0uYamhrkXBogDd79EySLnFk6Q1POhI'
        }),
        styleSet,
        styleOptions: chatStyles
    }, document.getElementById('webchat'));


    $(document).on({
        'click': function () {
            $(".webchat__basic-transcript__activity-body").css("display", "none");
            $(".webchat__suggested-actions__flow-box").css("display", "none");
            $(".webchat__send-box-text-box__input").attr("placeholder", "Type 'Hi' to start the conversation");
        }
    }, '#chat-reset');

    $(document).ready(function () {
        $(".webchat__send-box-text-box__input").change(function () {
            $(".webchat__send-box-text-box__input").attr("placeholder", "Type your message");

        });
        $(document).on('keypress', function (e) {
            if (e.which == 13) {
                $(".webchat__send-box-text-box__input").attr("placeholder", "Type your message");
            }
        });

    });

    if (getUrlParam("rate", "null") != "null") {
        $.ajax({
            url: approot + '/Login/Rate',
            type: 'POST',
            data: { token: getUrlParam("rate"), score: getUrlParam("score")},
            success: function (data) {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Thank you for rating!',
                        text: 'We strive to provide with the best in supporting you, so your feedback is very important to us.',
                        showConfirmButton: false,
                        timer: 5000
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: data.data,
                        showConfirmButton: false,
                        timer: 5000
                    });
                }
                history.pushState(null, null, `${approot}/Login`);
            },
            error: function () {
                showToast("Could not connect to the server. Please refresh the page and try again.", 'error');
            }
        });
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