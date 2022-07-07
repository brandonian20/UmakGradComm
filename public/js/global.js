$(function () {
    "use strict";

    $(".preloader").fadeOut();

    $(".modal").modal({
        backdrop: 'static'
    });

    window.onbeforeunload = () => {
        if ($('.modal').hasClass('show')) {
            try {
                if (document.activeElement.href.includes("/Session/Download"))
                    return null;
            } catch (e) {

            }
            return true;
        } else {
            return null;
        }
    }

    $(".modal").on("show.bs.modal", function () {
        discussionIsExpanded = false;
        discussionExpander();

        !$("#auditTrailBody").hasClass("show") ? $("#auditTrailBody").addClass("show") : ``;
        !$("#resolutionBody").hasClass("show") ? $("#resolutionBody").addClass("show") : ``;
    });

    $(".modal").on("shown.bs.modal", function () {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });
        
        initProfilePopover();
    });

    $("#modalUpdateConclusion, #modalAddRelatedTicket, #modalRemoveRelatedTicket, #modalAttachment, #modalConfirm").on("show.bs.modal", function () { $("#modalView").css("filter", "blur(3px)"); })
        .on("hide.bs.modal", function () { $("#modalView").focus(); $("#modalView").css("filter", "blur(0px)"); })
        .on("shown.bs.modal", function () { $(this).focus(); })
        .on("hidden.bs.modal", function () { $("#modalView").focus();});

    $("#modalUpdateConclusion").on("shown.bs.modal", function () {
        $("#modalUpdateConclusion").focus();

        $("[name=con-conclusion]").attr("required", "required");

        $("[name=con-question]").removeAttr("required");
        $("[name=con-issue]").removeAttr("required");
        $("[name=con-privacy]").removeAttr("required");
        $("[name=con-answer]").removeAttr("required");

        $("#con-linkActionRow").css("display", "block");

        $.when(PopulateSelect('con-conclusion', 'Select2/Get', 'Select a Conclusion', null, true, { type: "Conclusion" }, null, "Conclusion")).done(function () {
            $("[name=con-conclusion]").select2("val", " ");
            $('[name=con-conclusion]').select2('open');
        });
    }).on("hidden.bs.modal", function () { $("#modalView").focus(); })
        .on("show.bs.modal", function () {
            $("#con-linkActionRow").css("display", "none");
            $("#con-addActionRow").css("display", "none");
        });

    $("[name=con-decision]").on("change", function (e) {

        $("#con-linkActionRow").css("display", "none");
        $("#con-addActionRow").css("display", "none");

        switch ($(e.target).attr("data-decision")) {
            case
                "link":
                $("[name=con-conclusion]").attr("required", "required");

                $("[name=con-question]").removeAttr("required");
                $("[name=con-issue]").removeAttr("required");
                $("[name=con-privacy]").removeAttr("required");
                $("[name=con-answer]").removeAttr("required");

                $("#con-linkActionRow").css("display", "block");

                $.when(PopulateSelect('con-conclusion', 'Select2/Get', 'Select a Conclusion', null, true, { type: "Conclusion" }, null, "Conclusion")).done(function () {
                    $('[name=con-conclusion]').select2('open');
                });
                break;
            case "add":
                $("[name=con-conclusion]").removeAttr("required");

                $("[name=con-question]").attr("required", "required");
                $("[name=con-issue]").attr("required", "required");
                $("[name=con-privacy]").attr("required", "required");
                $("[name=con-answer]").attr("required", "required");

                trumbo("con-answer", "50px");

                
                $("#con-addActionRow").css("display", "block");
                $.when(PopulateSelect('con-issue', 'Select2/Get', 'Select Issue', null, true, { type: "Category" }, null, null, true)).done(function () {
                    $("[name=con-issue]").select2("val", " ");
                });
                break;
        }
    });

    $("#btnLogout").on('click', function () {

        $.ajax({
            url: approot + '/Login/signout',
            type: 'POST',
            success: function (resp) {
                if (resp.success) {
                    location.href = approot+"/Login";
                } else {
                    showToast(resp.data[0], 'error');
                }
            }, error: function () {
                showToast("Could not connect to the server. Please refresh the page and try again.", 'error');
            }
        });
    });

    setTimeout(function () { $("#menu-toggle").on('click', function () { $("#wrapper").toggleClass("toggled") }); }, 200);

    NavbarCounter();

    csrfToken = $(`[name=__RequestVerificationToken]`).val();

    let discussionIsExpanded = true;
    $("#discussionExpander").on("click", function () { discussionExpander();});

    function discussionExpander() {
        if (discussionIsExpanded) { //Expand
            $("#commentCard").addClass("col-lg-12").removeClass("col-lg-8");
            $("#titleCard").css("display", "none");
            $("#resolutionCard").css("display", "none");
            $("#miscColumn").css("display", "none");
            $("#commentCard .card-body").css("height", $("#modalView .modal-body").height() - 22).css("max-height", $("#modalView .modal-body").height() - 22);
            discussionIsExpanded = false;
        } else { //Shrink
            $("#commentCard").removeClass("col-lg-12").addClass("col-lg-8");
            $("#titleCard").css("display", "block");
            $("#resolutionCard").css("display", "block");
            $("#miscColumn").css("display", "block");
            $("#commentCard .card-body").css("height", "400px").css("max-height", "400px");
            discussionIsExpanded = true;
        }
    }

    (function ($) {
        $.fn.confirm = function (options) {
            var settings = $.extend({}, $.fn.confirm.defaults, options);

            return this.each(function () {
                var element = this;

                $('.modal-title', this).html(settings.title);
                $('.message', this).html(settings.message);
                $('.confirm', this).html(settings.confirm);
                $('.dismiss', this).html(settings.dismiss);

                $(this).off('click', '.confirm').on('click', '.confirm', function (event) {
                    $(this).trigger('confirm', event);

                    $(element).modal('hide');
                });

                $(this).off('click', '.dismiss').on('click', '.dismiss', function (event) {
                    $(this).trigger('dismiss', event);

                    $(element).modal('hide');
                });

                $(this).on("show.bs.modal", function () {
                    $("#modalAdd").css("filter", "blur(3px)");
                }).on("shown.bs.modal", function () {
                    $(element).focus();
                });

                $(this).on('hide.bs.modal', function (event) {
                    $("#modalAdd").css("filter", "blur(0px)");
                    $(this).off('confirm dismiss');
                }).on("hidden.bs.modal", function () {
                    $("#modalAdd").focus();
                });

                $(this).modal('show');
            });
        };

        $.fn.confirm.defaults = {
            title: 'Modal title',
            message: 'One fine body&hellip;',
            confirm: 'OK',
            dismiss: 'Cancel'
        };
    })(jQuery);

});

$.trumbowyg.svgPath = 'https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.25.1/ui/icons.svg';


//var approot = "/ITHelpDesk";
var approot = (window.location.pathname.split("/")[1] === app ? "/" + app : "");
var root = approot + "/" + window.location.pathname.split("/").pop();

var tblDataTable;

var processingSpinner = `<div class="spinner-border spinner-border-sm" role="status"> <span class="sr-only">Processing...</span> </div>`;

var csrfToken;

let toastCounter = 0;
function showToast(text, type) {
    $.toast({
        //text: (type == "error" ? `<span><i class="fa-duotone fa-copy copyErrMsg float-end me-1" data-bs-toggle="tooltip" title="Copy error message" style="cursor: pointer"></i><span id="toast` + (toastCounter++) + `">` + text + `</span></span>` : text),
        text: (type == "error" ? `<span id="toast` + (toastCounter++) + `">` + text + `</span>` : text),
        showHideTransition: 'slide',
        icon: type,
        position: 'bottom-right',
        hideAfter: (type == "error" && "info" ? 15000 : 7000),
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

let popoverUniqueCounter = 0, listenerInit = false;
function initProfilePopover() {
    
    $('[data-bs-toggle=popover]').popover({
        container: $("body"),
        html: true,
        animation: false,
        trigger: "manual",
        placement: "right",
        title: function () {
            return "Employee Profile";
        },
        content: function () {
            
            var titleID = "title-id-" + $.now();
            var contentID = "content-id-" + $.now();

            let employeeEnc = $(this).attr("data-empenc");
            let employeeData = null;

            $.ajax({
                url: approot + '/Select2/Get',
                type: 'GET',
                data: { type: "EmployeePopover", id: employeeEnc },
                success: function (resp) {
                    if (resp.success) {

                        let data = resp.data[0];
                        employeeData = data;
                        
                        let img = "", nickname = "", division = "", department = "", disabled = "", phoneext = "";

                        if (data["Active"] != undefined)
                            img = (data["Active"] == "" || data["Active"] == null ? `<div class="position-relative me-2"> <img class="popover-img rounded-circle d-inline" loading="lazy" src="https://communityext.ismanila.org/photomanager/handler/Get_ProfilePhoto.ashx?Filename=${employeeEnc}&Size=1" /> <span class="position-absolute top-100 start-100 popover-active translate-middle bg-secondary rounded-circle"><span class="visually-hidden"></span></span></div> `
                                : ` <div class="position-relative me-2"> <img class="popover-img rounded-circle d-inline" loading="lazy" src="https://communityext.ismanila.org/photomanager/handler/Get_ProfilePhoto.ashx?Filename=${employeeEnc}&Size=1" /> <span class="position-absolute top-100 start-100 popover-active translate-middle bg-success rounded-circle"><span class="visually-hidden"></span></span></div> `);

                        if (data["Nickname"] != undefined) nickname = ((data["Nickname"] != undefined || data["Nickname"] != null) && data["Fname"] != data["Nickname"] ? ` "${data["Nickname"]}"` : ``);

                        if (data["DisabledDate"] != undefined) disabled = (data["DisabledDate"] != "" || data["DisabledDate"] != null ? `<div class="mt-1 row"><span class="badge badge-pill bg-secondary"><i class="fa-solid fa-lock"></i> Disabled</span></div>` : ``);
                        if (data["Division"] != undefined) division = (data["Division"] != "" || data["Division"] != null ? `<div class="mt-1 row"><i class="fa-solid fa-building col-1 pe-0"></i> <small class="ps-1 col-9">${format(data["Division"], "Division")} division</small></div>` : ``);
                        if (data["PhoneExt"] != undefined) phoneext = (data["PhoneExt"] != "" || data["PhoneExt"] != null ? `<div class="mt-1 row"><i class="fa-solid fa-phone-rotary col-1 pe-0"></i> <small class="ps-1 col-9">${data["PhoneExt"]}</small></div>` : ``);
                        if (data["Department"] != undefined) department = (data["Department"] != "" || data["Department"] != null ? `<div class="mt-1 row"><i class="fa-solid fa-people-group col-1 pe-0"></i> <small class="ps-1 col-9">${data["Department"]} department</small></div>` : ``);

                        let padding = (disabled != "" || division != "" || department != "" || phoneext != "" ? `class="mt-3"` : ``);

                        $(`#${titleID}`).html(`
                            <div class="d-flex" style="width: 276px">
                                ${img}
                                <div class="d-flex flex-wrap flex-column justify-content-center text-break ms-3">
                                    <h6 class="fw-bold mb-1"> ${data["Fname"]}${nickname} ${data["Lname"]}</h6>
                                    <small>${data["Email"]}</small>
                                </div>
                            </div>
                            <div ${padding}>
                                ${disabled}
                                ${phoneext}
                                ${division}
                                ${department}
                            </div>
                        `);

                        let email = "", contact = "";

                        if (employeeData["Email"] != undefined) email = (employeeData["Email"] != "" || employeeData["Email"] != null ? `<a href="mailto: ${employeeData["Email"]}" class="btn btn-sm alert-primary"><i class="fa-solid fa-envelope"></i></a>` : ``);
                        if (employeeData["ContactNumber"] != undefined) contact = (employeeData["ContactNumber"] != "" || employeeData["ContactNumber"] != null ? `<a href="tel: ${employeeData["ContactNumber"].replace("0", "+63")}" class="btn btn-sm alert-primary"><i class="fa-solid fa-phone"></i></a>` : ``);

                        $(`#${contentID}`).html(`<hr class="mb-2" />
                        <div class="d-flex justify-content-between">
                            <!--<a class="btn btn-sm alert-primary">View Profile</a>-->
                            <div>
                                ${email}
                                ${contact}
                            </div>
                        </div>
                    `);

                    }
                }, error: function () {
                    showToast("Could not connect to the server. Please refresh the page and try again.", 'error');
                }
            });

            return `<div id="${titleID}"><div class="spinner-border spinner-border-sm" role="status"> <span class="sr-only">Processing...</span> </div></div> <div id="${contentID}"></div>`;
        }
    }).on("mouseenter", function () {
        var _this = this;
        $(this).popover("show");
        
        $(".popover").on("mouseleave", function () { setTimeout(function () { $(_this).popover('hide'); }, 0); });

        /*if (!listenerInit) {
            $(".popover").on("mouseleave", function () { $(_this).popover('hide'); });
            listenerInit = true;
        }*/
      
    }).on("mouseleave", function () {
        var _this = this;

        if (!$(".popover:hover").length) {
            if ($(`#${$(_this).attr("aria-describedby")} .popover-body`).text().includes("Processing...")) {

                var interval = setInterval(function () {

                    if (!$(`#${$(_this).attr("aria-describedby")} .popover-body`).text().includes("Processing...")) {
                        clearInterval(interval);
                        $(_this).popover('hide');
                    }

                }, 200);
            }
            else {
                setTimeout(function () { $(_this).popover('hide'); }, 0);
            }

        }
    });

    

}

function CheckTableStatus() {
        
    if (getUrlParam("s", "null") != "null") {
        let status = "";

        switch (getUrlParam("s")) {

            case "AllActive": status = "All Active"; break;
            case "Open": status = "Open"; break;
            case "Pending": status = "Pending"; break;
            case "TP": status = "Third Party"; break;
            case "FD": status = "For Development"; break;
            case "Resolved": status = "Resolved"; break;
            case "Cancelled": status = "Cancelled"; break;
            case "Closed": status = "Closed"; break;
                break;
            default:
                location.href = root + "?s=AllActive";
                break;
        }

        $("#headStatus").html(` - ${status}`);
    }
}

function ReloadDatatable(tblName = "#tblDBTable", reset = false, callback = null) {
    $(tblName).DataTable().ajax.reload(callback, reset);
    NavbarCounter();
}



let attachmentsCount = 0, trumboText = "", trumboEditor = "";
function trumbo(name, minHeight = "150px", appendPost = true) {

    $("[name=" + name + "]").trumbowyg({
        btns: [['strong', 'em', 'justifyLeft', 'justifyCenter', 'justifyRight', 'unorderedList', 'orderedList']],
        autogrow: true,
        //removeformatPasted: true,
    });

    $(".trumbowyg-box, .trumbowyg-editor").css("min-height", minHeight);
    $(".trumbowyg-editor").css("max-height", "450px");

    $("[name=" + name + "]").off("tbwchange").on("tbwchange", function () {
        $("#charLength").html($(".trumbowyg-editor").text().length);

        if ($(".trumbowyg-editor").text().length > 1000) {
            $("[name=" + name + "]").val($(".trumbowyg-editor").text());
            $(".trumbowyg-editor").html(trumboEditor);
            $(".trumbowyg-editor").focus();
            $("#charLength").html($(".trumbowyg-editor").text().length);
            showToast("1000 character limit reached.", "error");
            return false;
        }

        if ($("[name=" + name + "]").val().match(/<img[^>]*>/gi)) {
            $("[name=" + name + "]").val($("[name=" + name + "]").val().replace(/<img[^>]*>/gi, ""));
            $(".trumbowyg-editor img").remove();
            showToast("Please use attachments to send images.", "error")
        }

        if ($(".trumbowyg-editor").text().length > 0) {
            $("#charCounter").css("display", "block");
        } else {
            $("#charCounter").css("display", "none");
        }

        trumboText = $(".trumbowyg-editor").text();
        trumboEditor = $(".trumbowyg-editor").html();

    });

    if (appendPost && !$(".btnCommentSubmit").length) { 

        $("#formCommentSubmit .trumbowyg-button-group").append(`<button type="button" class="btn btn-sm" style="padding: 0px !important;"><label for="comment-attachment" class="h-100 w-100 d-grid justify-content-center align-items-center" style="cursor: pointer;"><i class="fa-solid fa-paperclip-vertical" style="height: 15px;" ></i></label> <input class="form-control d-none" id="comment-attachment" name="comment-attachment" type="file" accept=".csv,.doc,.docx,.gif,.jpg,.jpeg,.mov,.pdf,.png,.ppt,.pptx,.psd,.txt,.wav,.xls,.xlsx,.mp3,.mp4" multiple></button>`);

        if (location.pathname.includes("/MyTickets")) {
            $("#formCommentSubmit .trumbowyg-button-group").append(`<button type="submit" class="btn btn-outline-primary text-align-center float-end btnCommentSubmit"><i class="fa-duotone fa-paper-plane-top"></i> <span class="d-none d-lg-inline-block">Post</span></button>`);
        } else {
            $("#formCommentSubmit .trumbowyg-button-group").append(`<div class="btn-group text-align-center float-end" role="group" aria-label="Email/Post Button Group"> <input type="checkbox" class="btn-check" name="sendEmail" id="sendEmail" autocomplete="off"><label class="btn btn-outline-primary" data-bs-toggle="tooltip" title="Post w/ email" for="sendEmail"><i class="fa-duotone fa-envelope"></i></label> <button type="submit" class="btn btn-outline-primary btnCommentSubmit d-flex"><i class="fa-duotone fa-paper-plane-top"></i> <span class="d-none d-lg-inline-block ms-lg-1 ms-sm-0">Post</span></button></div>`);
        }

        $("#comment-attachment").on("change", function () {
            attachmentsCount = $("#comment-attachment")[0].files.length;

            if (attachmentsCount >= 1) {
                $("#commentAttachment").html(`<div class="p-3"><span class="rounded-pill border px-2"><i class="fa-solid fa-paperclip-vertical"></i> ${attachmentsCount} files attached <a href="javascript:;" class="text-danger ms-1" data-bs-toggle="tooltip" title="Cancel Attachment" data-bs-placement="right" id="btnCancelAttachment"><i class="fa-duotone fa-circle-x"></i></a></span></div>`);

                $("#btnCancelAttachment").on("click", function () {
                    $("#comment-attachment").val("").trigger("change");
                    $("#commentAttachment").html("");
                });

            }

        });
    }

    $("#charCounter").remove();
    $("div.trumbowyg-box.trumbowyg-editor-visible.trumbowyg-en.trumbowyg").append(`<div id="charCounter" style="position: absolute;right: 14px;top: 41px; display: none;" class="text-secondary"><small><span id="charLength">0</span>/1000 characters remaining</small></div>`);

}

function format(data, type, params) {
    switch (type) {
        case "Importance":
            let low = `<div class="badge badge-pill alert-secondary">Low</div>`,
                med = `<div class="badge badge-pill alert-warning">Normal</div>`,
                high = `<div class="badge badge-pill alert-danger">High</div>`;
            if (params == "noBadge") {
                low = `Low`,
                    med = `Normal`,
                    high = `High`;
            }

            return (data == 1 ? low : (data == 2 ? med : (data == 3 ? high : "")));
        case "Description":
            return data.length > 100 ? data.substring(0, 100) + "..." : data;
        case "Rating":
            let stars = ``;

            for (let i = 0; i < data; i++) {
                stars += `<i class="fa-solid fa-star"></i> `;
            }

            return `<span class="text-warning" data-bs-toggle="tooltip" title="Rated at ${moment(params).format("MMM DD, YYYY h:mm A")} (${moment(params).from(moment())})">${stars}</span>`;
        case "Status":
            if (params == "Small") {
                let open = `<span class="badge badge-pill alert-success">Open</span>`,
                    pending = `<span class="badge badge-pill alert-primary">Pending</span>`,
                    tp = `<span class="badge badge-pill alert-info">TP</span>`,
                    dev = `<span class="badge badge-pill alert-info">For Devt.</span>`,
                    resolved = `<span class="badge badge-pill alert-warning">Resolved</span>`,
                    cancelled = `<span class="badge badge-pill alert-danger">Cancelled</span>`,
                    closed = `<span class="badge badge-pill alert-secondary">Closed</span>`;
                return (data == "Open" ? open : (data == "Pending" ? pending : (data == "Third Party" ? tp : (data == "For Devt." ? dev : (data == "Resolved" ? resolved : (data == "Cancelled" ? cancelled : (data == "Closed" ? closed : "")))))))
            } else {
                let open = `<div class="badge alert-success"><h6 class="mb-0 p-1">Open</h6></div>`,
                    pending = `<div class="badge alert-primary"><h6 class="mb-0 p-1">Pending</h6></div>`,
                    tp = `<div class="badge alert-info"><h6 class="mb-0 p-1">TP</h6></div>`,
                    dev = `<div class="badge alert-info"><h6 class="mb-0 p-1">For Devt.</h6></div>`,
                    resolved = `<div class="badge alert-warning"><h6 class="mb-0 p-1">Resolved</h6></div>`,
                    cancelled = `<div class="badge alert-danger"><h6 class="mb-0 p-1">Cancelled</h6></div>`,
                    closed = `<div class="badge alert-secondary"><h6 class="mb-0 p-1">Closed</h6></div>`;
                return (data == "Open" ? open : (data == "Pending" ? pending : (data == "Third Party" ? tp : (data == "For Devt." ? dev : (data == "Resolved" ? resolved : (data == "Cancelled" ? cancelled : (data == "Closed" ? closed : "")))))))
            }
        case "Location":
            return (data == "" ? "<b>N/A</b>" : data);
        case "PrefDate":
            return (data == "" || data == null ? "Anytime" : "<span data-bs-toggle='tooltip' data-bs-placement='right' title='" + moment(data).from(moment()) + "'>" + moment(data).format("MMM DD, YYYY h:mm A") + "</span>");
        case "OnBehalf":
            return (data == "" || data == null ? "None" : `<img class="rounded-circle d-inline" height="20" width="20" loading="lazy" src="img/login-image.jpg"/> <div class="d-inline" data-bs-toggle="tooltip" data-bs-html="true" data-bs-placement='right' title="${params.name}<br />${params.email}">${params.nick}</div>`);
        case "Staff":
            return (data == "" || data == null ? "TBA" : `<img class="rounded-circle d-inline" height="20" width="20" loading="lazy" src="img/login-image.jpg"/> <div class="d-inline" data-bs-toggle="tooltip" data-bs-html="true" data-bs-placement='right' title="${params.name}<br />${params.email}">${params.nick}</div>`);
        case "Admin":
            //return (data == 0 || data == "" || data == null ? `` : `<small class="ms-1 badge-pill text-white bg-secondary">Admin</small>`);
            return "";
        case "Reassign":
            switch (params.approved) {
                case "0":
                    return `<span class="d-inline ms-1" data-bs-toggle="tooltip" title="${params.date}"><div class="badge badge-pill bg-danger text-white">Denied reassignment</div></span>`;
                case "1":
                    return ``;
                default:
                    return `<span class="d-inline ms-1" data-bs-toggle="tooltip" title="${params.date}"><div class="badge badge-pill bg-warning text-white">For reassignment</div></span>`;

            }
        case "Privacy":
            return data == "1" ? `<span class="d-inline ms-1"><div class="badge badge-pill bg-secondary"><i class="fa-solid fa-lock"></i> Private</div></span>` : `<span class="d-inline ms-1"><div class="badge badge-pill bg-success"><i class="fa-solid fa-unlock"></i> Public</div></span>`;
        case "Division":
            return (data == "MS" ? "Middle School" : (data == "HS" ? "High School" : (data == "ES" ? "Elementary school" : "")))
    }
}

function InitDateRange(name, value = null) {
    $(`input[name=${name}]`).daterangepicker({
        //autoUpdateInput: false,
        timePicker: true,
        singleDatePicker: true,
        minDate: moment(),
        locale: {
            format: 'MMM DD, YYYY h:mm A'
        },
        ranges: {
            "Now": [moment()],
            //"In an hour": [moment().add(1, 'hour')],
            "After school hours": [moment(moment().format("M/DD/YY 15:30")).format("MMM DD, YYYY h:mm A")],
        }
    });
    $(`[name=${name}]`).val('').attr('placeholder', 'Anytime');
    $(`#resetDateTime`).on('click', function () { $(`[name=${name}]`).val(''); })
}

let btnAppended = true, tblFilterEvent = true;
function InitCompleteHandler() {
    $("#tblDBTableCard").unblock();

    $('#datatableSearchFilter [type=search]').attr('maxlength', 150).unbind().bind('keyup', function (e) {
        if (e.keyCode == 13) {
            FilterDTTable();
        }
    });

    if (tblFilterEvent) {
        $("[name=tblDBTableFilter]").on("change", function () {
            tblDataTable.api().ajax.url(root + "/List?filter=" + $("[name=tblDBTableFilter]").val()).load();
        });
        tblFilterEvent = false;
    }
    
    
    $("div.dataTables_filter label a").tooltip({ container: 'body' });

}



var filterDBcer;

function FilterDTTable(reset) {

    clearTimeout(filterDBcer);
    filterDBcer = setTimeout(function () {
        let searchBar = $("#datatableSearchFilter input[type=search]");
        if (reset) {
            tblDataTable.fnFilter("");
            searchBar.val("");
        } else {
            tblDataTable.fnFilter(searchBar.val());
        }
    }, 200);

}

function drawbackFN() {
    CallBackHandler();
}

function CallBackHandler() {
    adjustPage();

    $("#tblDBTable a").tooltip({ container: 'body' });
    $("#tblDBTable span").tooltip({ container: 'body' });

    setTimeout(function () {
        $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
    }, 100);

}

var timerDelay = 200;

var throttler;
function adjustPage() {

    if (throttler) { return; }

    throttler = setTimeout(function () {

        let DTtable = "#tblDBTable";

        if ($(DTtable).length) {
            /*$("#tblDBTable_filter label input").attr('placeholder', 'Search...');
            $("#tblDBTable_filter label input").css('font-size', '15px !important;');*/

            $('#tblDBTable').on('processing.dt', function (e, settings, processing) {
                if (processing) {

                    $('#tblDBTableCard').block();
                } else {
                    $('#tblDBTableCard').unblock();
                }
            }).dataTable();

            $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
        }

        throttler = undefined;
    }, timerDelay);

}

function NavbarCounter() {

    $.ajax({
        url: approot + '/Session/NavbarCounter',
        type: 'GET',
        success: function (resp) {
            if (resp.success) {
                data = resp.data;
                for (let i = 0; i < data.length; i++) {
                    if (data[i][1] != 0) {
                        $("#" + domQuerySafe(approot) + domQuerySafe(data[i][0]) + "-counter").html(`<div class="badge badge-pill ${(location.pathname + location.search == approot + data[i][0]) && data[i][0].includes("?") ? `alert-primary` : `bg-secondary`} mb-2 pt-1">${data[i][1]}</div>`);
                    }
                }

            } else {
                showToast("Something went wrong in fetching navbar counter", "error");
            }
        }
    });
}

function GetUserRole() {
    let retVal = "";
    $.ajax({
        url: approot + '/Session/UserRole',
        type: 'GET',
        async: false,
        success: function (resp) {
            if (resp.success) {
                retVal = resp.data;
            } else {
                showToast("Something went wrong in fetching navbar counter", "error");
            }
        }
    });

    return retVal;
}

function domQuerySafe(string) {
    //return string.replace(new RegExp("/", "g"), "\\/").replace("?", "\\?").replace("=", "\\=").replace('"', '\\"');
    return string.replace(new RegExp("\\/", "g"), "\\/").replace(new RegExp("\\?", "g"), "\\?").replace(new RegExp("\\=", "g"), "\\=");
}

setInterval(function () { CheckSession() }, 5000);

let reconToastLoaded, reconToast;
function CheckSession() {
    try {
        $.ajax({
            url: approot + '/Session/CheckTimeout',
            type: 'POST',
            success: function (data) {
                reconToastLoaded ? (reconToast.reset(), reconToastLoaded = false) : '';

                if (!data.success)
                    location.reload();

                /*if (!data.success) {
                    if (!$('#modalTimeout').hasClass('show')) {
                        $("div.modal.show").modal('hide');
                        $("#modalTimeout").modal({ backdrop: 'static', keyboard: false });
                    }
                } else {
                    if ($('#modalTimeout').hasClass('show')) {
                        $("#modalTimeout").modal("hide");
                    }
                }*/
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
    } catch(e) { }

}


function getConclusion(id) {
    $(`#resolutionCard`).html(``);

    if (id != null || id != 0) {
        $.ajax({
            url: approot + '/ResolutionDatabank/View',
            data: { id: id },
            type: 'POST',
            success: function (resp) {
                
                if (resp.success) {
                    let data = resp.data[0];

                    $("#resolutionCard").html(`<div class="col-12 mb-3">
                    <div class="card shadow-sm bg-white">
                        <div class="card-header border-bottom-0 bg-white">
                            <i class="fa-duotone fa-lightbulb-on"></i> Resolution
                            <a class="float-end" data-bs-toggle="collapse" href="#resolutionBody" role="button" aria-expanded="false">
                                <i class="fa-duotone fa-minus" data-bs-toggle="tooltip" title="Collapse/Show Conclusion"></i>
                            </a>
                        </div>
                        <div class="card-body p-0 collapse show" id="resolutionBody">
                            <div class="row m-0 p-2">
                                <div class="col-lg-12 col-sm-12">
                                    <div class="row px-2 py-1">
                                        <div class="col-lg-12">
                                            <div class="d-flex flex-wrap justify-content-between">
                                                <!--<div class="d-flex flex-wrap"><h5 class="text-bold d-inline mb-0 fw-bold">${data["Question"]}</h5> <span class="d-inline ms-2"><span class="badge badge-pill bg-success"><i class="fa-solid fa-check"></i> Conclusion</span></span> </div>-->
                                                <div class="d-flex flex-wrap"><h5 class="text-bold d-inline mb-0 fw-bold">${data["Question"]}</h5></div>
                                            </div>
                                            <div class="d-flex flex-wrap justify-content-between">
                                                <div><small class="text-secondary">${data["Category"]}</small> </div>
                                            </div>
                                            <div class="d-flex flex-wrap justify-content-between mt-3" style="max-height: 500px; overflow-y: scroll;">
                                                <span style="line-break: auto; white-space: break-spaces;">`+ data["Answer"] + `</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-12">
                                </div>
                            </div>
                        </div>
                    </div>
                                </div >
                            </div >`);

                }
            }, error: function () {
                showToast("Could not connect to the server. Please refresh the page and try again.", 'error');
            }
        });

    }

    
}

function getCaseComments(id, scrollToBot = true, viewStatus) {
    $.ajax({
        url: root + '/CaseComments',
        data: { id: id },
        type: 'POST',
        success: function (resp) {
            if (resp.success) {
                let data = resp.data,
                    arrLength = data.length;

                commentsLength = arrLength;

                let sdata = "";

                let AccordionCounter = 0;
                for (let i = 0; i < arrLength; i++) {
                    if (data[i]["ParentId"] == 0) { /* Comment is Parent */

                        sdata += `<div class="d-flex  flex-column" data-comment-id="${data[i]["CommentId"]}">
                                    <div class="d-flex ">
                                        <img class="rounded-circle d-inline" height="40" width="40" loading="lazy" src="https://communityext.ismanila.org/photomanager/handler/Get_ProfilePhoto.ashx?Filename=${data[i]["EmpIDEnc"]}&Size=1"/>
                                        <div class="d-flex  flex-column">
                                            <div class="d-flex  flex-column ms-3">
                                                <div class="p-2 px-3 commentBody">
                                                    <div><span class="fw-bold" data-bs-toggle="tooltip" data-bs-placement="right" title="${data[i]["EmployeeEmail"]}">${data[i]["EmployeeName"]} ${format(data[i]["IsAdmin"], "Admin")}</span></div>
                                                    <div class="mt-1 commentDetail" style="line-break: anywhere;">${cleanseAttr(data[i]["Contents"])}</div>
                                                    ${data[i]["AttachmentCount"] >= 1 ? `<div class="d-flex flex-wrap mt-2" style="max-height:100px; overflow-y: auto;" id="attachmentRow-${data[i]["CommentId"]}"></div>` : ``}
                                                </div>
                                                <span class="m-1"><a href="javascript:;" class="text-secondary text-decoration-none fw-bold btnReply d-inline" data-id="${data[i]["CommentIdEnc"]}" data-commenter="${data[i]["EmployeeName"]}" data-id-raw="${data[i]["CommentId"]}">Reply •</a> <small class="text-secondary" data-bs-toggle="tooltip" title="${moment(data[i]["DateSubmitted"]).format("MMM DD, YYYY h:mm A")}">${moment(data[i]["DateSubmitted"]).from(moment())}</small></span>
                                            </div>`;

                        let replyCounter = 0;
                        for (let j = 0; j < arrLength; j++) {
                            if (data[j]["ParentId"] == data[i]["CommentId"]) {
                                ++replyCounter;
                            }
                        }

                        if (replyCounter > 1) {
                            sdata += `  </div>
                                        </div>
                                        <div class="ms-5">`;
                        }
                        if (replyCounter > 3) {
                            sdata += `           <div class="accordion accordion-flush" id="accordionFlush${++AccordionCounter}">
                                                    <div class="accordion-item">
                                                        <h6 class="accordion-header" id="flush-heading${AccordionCounter}">
                                                          <a class="collapsed p-1 ms-2 text-decoration-none" onclick="$('#accordionTitle${AccordionCounter}').html(($('#accordionTitle${AccordionCounter}').text() == 'Show' ? 'Hide' : 'Show'));" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse${AccordionCounter}" aria-expanded="false" aria-controls="flush-collapse${AccordionCounter}">
                                                            <span id="accordionTitle${AccordionCounter}">Show</span><span class="ms-1">${replyCounter} replies</span>
                                                          </a>
                                                        </h6>
                                                        <div id="flush-collapse${AccordionCounter}" class="accordion-collapse collapse" aria-labelledby="flush-heading${AccordionCounter}" data-bs-parent="#accordionFlush${AccordionCounter}">
                                                          <div class="accordion-body p-0">`;
                        }

                        for (let j = 0; j < arrLength; j++) {
                            if (data[j]["ParentId"] == data[i]["CommentId"]) {
                                sdata += `  <div class="d-flex  flex-column mt-2 ms-3" data-comment-id="${data[j]["CommentId"]}">
                                                    <div class="d-flex ">
                                                        <img class="rounded-circle d-inline" height="40" width="40" loading="lazy" src="https://communityext.ismanila.org/photomanager/handler/Get_ProfilePhoto.ashx?Filename=${data[j]["EmpIDEnc"]}&Size=1"/>
                                                        <div class="d-flex  flex-column">
                                                            <div class="d-flex  flex-column ms-3">
                                                                <div class="p-2 px-3 commentBody">
                                                                    <div><span class="fw-bold" data-bs-toggle="tooltip" data-bs-placement="right" title="${data[i]["EmployeeEmail"]}">${data[j]["EmployeeName"]} ${format(data[i]["IsAdmin"], "Admin")}</span></div>
                                                                    <div class="mt-1 commentDetail" style="line-break: anywhere;">${cleanseAttr(data[j]["Contents"])}</div>
                                                                    ${data[j]["AttachmentCount"] >= 1 ? `<div class="d-flex flex-wrap mt-2" style="max-height:100px; overflow-y: auto;" id="attachmentRow-${data[j]["CommentId"]}"></div>` : ``}
                                                                </div>
                                                                <span class="m-1"><small class="text-secondary" data-bs-toggle="tooltip" title="${moment(data[j]["DateSubmitted"]).format("MMM DD, YYYY h:mm A")}">${moment(data[j]["DateSubmitted"]).from(moment())}</small></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>`;
                            }
                        }

                        if (replyCounter > 3) {
                            sdata += `    </div>
                                        </div>
                                    </div>
                                </div>`;
                        }

                        sdata += `   </div>
                                    </div>
                                </div>`;

                    }
                }

                for (let i = 0; i < data.length; i++) {
                    if (data[i]["AttachmentCount"] >= 1) {
                        getCommentAttachment(data[i]["CommentIdEnc"], data[i]["CommentId"]);
                    }
                }

                $("#caseComments tbody").html(``).append(sdata);
                $(".commentDetail p").css("margin-bottom", "0px");
                $(".commentDetail img").addClass("img-fluid");

                if (scrollToBot) $("#caseComments").parent().scrollTop($("#caseComments").parent()[0].scrollHeight);

                switch (viewStatus) {
                    case 1: case 2: case 3: case 4: $(".btnReply").css("display", "inline-block"); break;
                    case 7:
                        $(".btnReply").css("display", "none").toggleClass("d-inline");
                    default: $(".btnReply").css("display", "none");
                }

                $(".btnReply").on("click", function () { replyComment(this); return false; });
            } else {
                $("#caseComments tbody").html(`<tr><td class="text-center p-5">No discussion(s) yet</td></tr>`);
            }
        }, error: function () {
            showToast("Could not connect to the server. Please refresh the page and try again.", 'error');
        }
    });
}

function getCommentAttachment(id, commentID) {
    $.ajax({
        url: approot + '/Select2/Get',
        data: { id: id, type: "CommentAttachmentPreview" },
        type: 'GET',
        success: function (resp) {
            if (resp.success) {

                let data = resp.data;

                for (let i = 0; i < data.length; i++) {

                    let icon = `<i class="fa-duotone fa-circle-question" color="black" data-bs-toggle="tooltip" title="${data[i][5]}"></i>`;
                    switch (data[i][5].split("/")[0]) {
                        case "video": icon = `<i class="fa-duotone fa-clapperboard-play" color="blue" data-bs-toggle="tooltip" title="${data[i][5]}"></i>`; break;
                        case "audio": icon = `<i class="fa-duotone fa-volume" color="orange" data-bs-toggle="tooltip" title="${data[i][5]}"></i>`; break;
                        case "image": icon = `<i class="fa-duotone fa-image" color="green" data-bs-toggle="tooltip" title="${data[i][5]}"></i>`; break;
                        case "text": icon = `<i class="fa-duotone fa-file-lines" color="gray" data-bs-toggle="tooltip" title="${data[i][5]}"></i>`; break;
                        case "application": icon = `<i class="fa-duotone fa-memo" color="teal" data-bs-toggle="tooltip" title="${data[i][5]}"></i>`; break;
                    }

                    if (data[i][5] == "application/pdf") icon = `<i class="fa-duotone fa-file-pdf" color="red" data-bs-toggle="tooltip" title="${data[i][5]}"></i>`;

                    let filename = data[i][2]
                    if (filename.length > 15)
                        filename = filename.substring(0, 12) + "...";

                    $(`#attachmentRow-${commentID}`).append(`<a class="comment-attachmentItem" data-id="${data[i][0]}" data-filename="${data[i][2]}" data-content-type="${data[i][5]}" data-href="${approot}/Session/DownloadCommentAttachment?id=${data[i][0]}" data-icon='${icon}' href="javascript:;"><div class="rounded-pill border px-2 me-2 mb-1">${icon}<span class="text-secondary ms-1" data-bs-toggle="tooltip" title="${data[i][2]}">${filename}</span></div></a>`);
                }

                //$(".comment-attachmentItem").on("click", function () { downloadCommentAttachment($(this).attr("data-id")); });
                $(".comment-attachmentItem").off("click").on("click", function () { attachmentPreview($(this)); });

                $("#caseComments").parent().scrollTop($("#caseComments").parent()[0].scrollHeight);

            } else {
                showToast(resp.data, 'error');
            }
        }, error: function () {
            showToast("Could not connect to the server. Please refresh the page and try again.", 'error');
        }
    });
}

function addComment(viewID) {

    var fd = new FormData();

    let files = $('[name=comment-attachment]').get(0).files;
    for (let i = 0; i < files.length; i++) {
        fd.append(files[i].name, files[i]);
    }

    fd.append("__RequestVerificationToken", csrfToken);
    fd.append("id", viewID);
    fd.append("replyID", replyToID);
    fd.append("commentArea", $("[name=commentArea]").val());
    fd.append("sendEmail", $("[name=sendEmail]").prop("checked"));


    $.ajax({
        url: root + '/AddComment',
        data: fd,
        //data: { id: viewID, replyID: replyToID, data: $("#formCommentSubmit").serialize(), __RequestVerificationToken: csrfToken },
        type: 'POST',
        contentType: false,
        processData: false,
        success: function (resp) {
            if (resp.success) {
                showToast('Comment Submitted.', 'success');

                getCaseComments(viewID, replyToID == "" ? true : false);

                clearCommentArea();

            } else {
                showToast(resp.data, 'error');
            }
        }, error: function () {
            showToast("Total file size reached 25MB limit.", 'error');
        }
    });
}

function clearCommentArea() {
    $("#formCommentSubmit")[0].reset();
    $("[name=commentArea]").trumbowyg('empty');
    $("#replyTab").html("");
    $("#comment-attachment").val("").trigger("change");
    $("#commentAttachment").html("");
    $("#charLength").html($(".trumbowyg-editor").text().length);
    $("#charCounter").css("display", "none");

    attachmentsCount = 0;
    replyToID = "";
    replyToIDRaw = "";
}

let replyToID = "", replyToIDRaw = "";


function replyComment(me) {

    $("#replyTab").html(`<div class="p-3"><span class="rounded-pill border px-2">Replying to <b>` + $(me).attr("data-commenter") + `</b> <a href="javascript:;" class="text-danger ms-1" data-bs-toggle="tooltip" title="Cancel reply" data-bs-placement="right" id="btnDeleteReply"><i class="fa-duotone fa-circle-x"></i></a></span></div>`);
    replyToID = $(me).attr("data-id");
    replyToIDRaw = $(me).attr("data-id-raw");
    $("[name=commentArea]").focus();
    $(".trumbowyg-editor").focus();

    $("#btnDeleteReply").on("click", function () {
        $("#replyTab").html("");
        replyToID = "";
        replyToIDRaw = "";
    });
}

let attachmentSiblingArray = [], attachmentIndex = 0;
function attachmentPreview(el) {

    attachmentSiblingArray = [];

    el.parent().children().each(function () {
        attachmentSiblingArray.push($(this).attr("data-href"));
    });

    attachmentIndex = attachmentSiblingArray.indexOf(el.attr("data-href"));

    if (attachmentSiblingArray.length > 1) {
        $("a.carousel-control-prev").removeClass("d-none");
        $("a.carousel-control-next").removeClass("d-none");
    } else {
        $("a.carousel-control-prev").addClass("d-none");
        $("a.carousel-control-next").addClass("d-none");
    }

    $("#modalAttachment .modal-content").css("transform", "rotate(0deg)").data('rotateangle', "0");
    $("#modalAttachment .navbar-brand").html(`${el.attr("data-icon").replace("fa-duotone", "fa-regular")}<small class="ms-2 modal-name text-truncate">${el.attr("data-filename")}</small>`);
    $("#modalAttachment .btnDownload").attr("href", el.attr("data-href")).attr("download", el.attr("data-filename"));

    let content = `<object data="${el.attr("data-href")}#toolbar=0&navpanes=0&view=FitH&scrollbar=0&download=false" type="${el.attr("data-content-type")}" class="bg-light" style="width: 60vw;height: 100vh;"><div class="my-5 py-5 text-center align-middle"><i class="fad fa-file-slash fa-6x mb-3"></i><br><h4>Preview not available.</h4><label>Please download the file and use your default viewer.</label></div></object>`;

    if (el.attr("data-content-type").split("/")[0] == "image") {
        content = `<object data="${el.attr("data-href")}#toolbar=0&navpanes=0&view=FitH&scrollbar=0&download=false" type="${el.attr("data-content-type")}" class="bg-light" style="width: 60vw;"></object>`;
    }

    $("#modalAttachment #attachment-content").html(content);

    $("#modalAttachment").modal("show");

}

function attachmentTraverse(next) {
    $("#modalAttachment .modal-content").css("transform", "rotate(0deg)").data('rotateangle', "0");

    if (next) {
        attachmentPreview($(`a[data-href="${(attachmentIndex == attachmentSiblingArray.length - 1 ? attachmentSiblingArray[0] : attachmentSiblingArray[attachmentIndex + 1])}"]`));
    } else {
        attachmentPreview($(`a[data-href="${(attachmentIndex == 0 ? attachmentSiblingArray[attachmentSiblingArray.length - 1] : attachmentSiblingArray[attachmentIndex - 1])}"]`));
    }
}

function getAuditTrail(id) {
    //$("#caseHistory tbody").html(`<tr><td>` + processingSpinner + `</td></tr>`);
    $.ajax({
        url: root + '/AuditTrail',
        data: { id: id },
        type: 'POST',
        success: function (resp) {
            if (resp.success) {
                $("#caseHistory tbody").html(``);
                let data = resp.data;
                for (let i = 0; i < data.length; i++) {
                    if (data[i]["ActByID"] == "999999") {
                        $(`#caseHistory tbody`).append(`<tr><td class="pt-2 text-center" style="width: 30%;"><small class="">${moment(data[i]["DateTime"]).format("MMM DD, YYYY h:mm A")}</small></td><td class="track_dot ${i == 0 ? `track_dot_latest align-middle` : ``}"><span class="${data.length == "1" ? "" : "track_line"}"></span></td><td><div class="p-1">
                                <div><span class="${i == 0 ? `fw-bold` : `fw-secondary`}">${data[i]["Action"]}</span></div> <div><span class=""> <small class="text-secondary pe-2" data-bs-toggle="tooltip" data-bs-placement="right" title="${data[i]["ActByEmail"]}">${data[i]["ActByName"]}</small></span></div>
                                
                                <div class="mt-3 ${i == 0 ? `` : `text-secondary`}">${data[i]["Description"]}</div>
                            </div></td></tr>`);
                    } else {
                        if (i == 0) {
                            $(`#caseHistory tbody`).append(`<tr><td class="pt-2 text-center" style="width: 30%;"><small class="">${moment(data[i]["DateTime"]).format("MMM DD, YYYY h:mm A")}</small></td><td class="track_dot track_dot_latest align-middle"><span class="${data.length == "1" ? "" : "track_line"}"></span></td><td><div class="p-1">
                                <div><span class="fw-bold">${data[i]["Action"]}</span></div> <div><span class=""><img class="rounded-circle d-inline" height="20" width="20" loading="lazy" src="https://communityext.ismanila.org/photomanager/handler/Get_ProfilePhoto.ashx?Filename=${data[i]["ActByIDEnc"]}&Size=1"/> <small class="text-secondary pe-2" data-bs-toggle="tooltip" data-bs-placement="right" title="${data[i]["ActByEmail"]}">${data[i]["ActByName"].split(" ")[0]}</small></span></div>
                                
                                <div class="mt-3">${data[i]["Description"]}</div>
                            </div></td></tr>`);
                        } else {
                            $(`#caseHistory tbody`).append(`<tr><td class="pt-2 text-center" style="width: 30%;"><small class="text-secondary">${moment(data[i]["DateTime"]).format("MMM DD, YYYY h:mm A")}</small></td><td class="track_dot"><span class="track_line"></span></td><td><div class="p-1">
                                <div><span class="fw-secondary">${data[i]["Action"]}</span></div><div><span class=""><img class="rounded-circle d-inline" height="20" width="20" loading="lazy" src="https://communityext.ismanila.org/photomanager/handler/Get_ProfilePhoto.ashx?Filename=${data[i]["ActByIDEnc"]}&Size=1"/> <small class="text-secondary pe-2" data-bs-toggle="tooltip" data-bs-placement="right" title="${data[i]["ActByEmail"]}">${data[i]["ActByName"].split(" ")[0]}</small></span></div>
                                
                                <div class="text-secondary mt-3">${data[i]["Description"]}</div>
                            </div></td></tr>`);
                        }
                    }
                }
            } else {
                $("#caseHistory tbody").html(`<tr><td class="text-center p-5">No Case History found.</td></tr>`);
            }
        }, error: function () {
            showToast("Could not connect to the server. Please refresh the page and try again.", 'error');
        }
    });
}

function updateConclusion(id) {
    $.ajax({
        url: approot + '/AllTickets/UpdateConclusion',
        data: { id: id, data: $("#modalUpdateConclusion form").serialize(), __RequestVerificationToken: csrfToken  },
        type: 'POST',
        success: function (resp) {
            if (resp.success) {
                showToast('Conclusion Updated.', 'success');

                ReloadDatatable();

                $(".modal").modal("hide");
            } else {
                showToast(resp.data, 'error');
            }
        }, error: function () {
            showToast("Could not connect to the server. Please refresh the page and try again.", 'error');
        }
    });
}

function getAttachmentPreview(id) {
    $.ajax({
        url: approot + '/Select2/Get',
        data: { id: id, type: "AttachmentPreview"},
        type: 'GET',
        success: function (resp) {
            if (resp.success) {

                let data = resp.data;

                for (let i = 0; i < data.length; i++) {

                    let icon = `<i class="fa-duotone fa-circle-question" color="black" data-bs-toggle="tooltip" title="${data[i][5]}"></i>`;
                    switch (data[i][5].split("/")[0]) {
                        case "video": icon = `<i class="fa-duotone fa-clapperboard-play" color="blue" data-bs-toggle="tooltip" title="${data[i][5]}"></i>`; break;
                        case "audio": icon = `<i class="fa-duotone fa-volume" color="orange" data-bs-toggle="tooltip" title="${data[i][5]}"></i>`; break;
                        case "image": icon = `<i class="fa-duotone fa-image" color="green" data-bs-toggle="tooltip" title="${data[i][5]}"></i>`; break;
                        case "text": icon = `<i class="fa-duotone fa-file-lines" color="gray" data-bs-toggle="tooltip" title="${data[i][5]}"></i>`; break;
                        case "application": icon = `<i class="fa-duotone fa-memo" color="teal" data-bs-toggle="tooltip" title="${data[i][5]}"></i>`; break;
                    }

                    if (data[i][5] == "application/pdf") icon = `<i class="fa-duotone fa-file-pdf" color="red" data-bs-toggle="tooltip" title="${data[i][5]}"></i>`;

                    let filename = data[i][2]
                    if (filename.length > 15)
                        filename = filename.substring(0, 12) + "...";

                    $(`.attachmentRow`).append(`<a class="attachmentItem" data-id="${data[i][0]}" data-filename="${data[i][2]}" data-content-type="${data[i][5]}" data-href="${approot}/Session/DownloadAttachment?id=${data[i][0]}" data-icon='${icon}'><div class="rounded-pill border px-2 me-2 mb-1">${icon}<span class="text-secondary ms-1" data-bs-toggle="tooltip" title="${data[i][2]}">${filename}</span></div></a>`);
                }

                //$(".attachmentItem").on("click", function () { downloadAttachment($(this).attr("data-id")); });
                $(".attachmentItem").off("click").on("click", function () { attachmentPreview($(this)); });

            } else {
                showToast(resp.data, 'error');
            }
        }, error: function () {
            showToast("Could not connect to the server. Please refresh the page and try again.", 'error');
        }
    });
}

function downloadAttachment(id) {
    open(`${approot}/Session/DownloadAttachment?id=${id}`);
}

function downloadCommentAttachment(id) {
    open(`${approot}/Session/DownloadCommentAttachment?id=${id}`);
}

/*function addRelatedTicket() {
    $.ajax({
        url: approot + '/Select2/Save',
        data: { ticketlist: $("[name=ticketlist]").val(), id: viewID, type: "SaveRelatedTicket" },
        type: 'GET',
        success: function (resp) {
            if (resp.success) {
                showToast("Successfully added", 'success');

                $("a.openModalDetails").on("click", function () { $("#modalView").modal("hide"); let openID = this; setTimeout(function () { modalViewDetails($(openID).attr("data-id")); }, 500)});

                $("#modalAddRelatedTicket").modal("hide");
                $.when(getRelatedTickets(viewID, resp.data)).done(function () { setTimeout(function () { $("a.openModalDetails").on("click", function () { $("#modalView").modal("hide"); let openID = this; setTimeout(function () { modalViewDetails($(openID).attr("data-id")); }, 500); }); eventClickSet = true; }, 200); })

            } else {
                showToast(resp.data, 'error');
            }
        }, error: function () {
            showToast("Could not connect to the server. Please refresh the page and try again.", 'error');
        }
    });
}*/

let eventClickSet = false, viewID = "", _parentTicket = "";
function getRelatedTickets(id, parentTicket) {

    let promise = undefined;

    viewID = id;
    _parentTicket = parentTicket;

     $.ajax({
        url: approot + '/Select2/Get',
        data: { id: id, type: "ChildRelatedTickets" },
        type: 'GET',
        success: function (resp) {
            if (resp.success) {
                let data = resp.data;
                let appendString = ``;
                
                $("#relatedChildTicket tbody").html("")
                if (data.length >= 1) {
                    $("#relatedChildTicket").addClass("mt-2")
                    appendString += `<tr class="border-bottom"><th colspan="5">Child Ticket(s)</th></tr>`;
                    for (let i = 0; i < data.length; i++) {
                        appendString += `<tr><td><div class="row"><div class="col-4"><small><a href="javascript:;" class="openModalDetails" data-id="${data[i][0]}">#${pad(data[i][1], 6)}</a></small></div><div class="col-7"><small>by ${data[i][3]}</small></div></div></td></tr>`;
                    }
                    $("#relatedChildTicket tbody").append(appendString);
                }
            } else {
                showToast(resp.data, 'error');
            }

            promise = $.ajax({
                url: approot + '/Select2/Get',
                data: { id: parentTicket, type: "ParentRelatedTicket", ticketID: id },
                type: 'GET',
                success: function (resp) {
                    if (resp.success) {
                        let data = resp.data;
                        let appendString = ``;

                        $("#relatedParentTicket tbody").html("")
                        appendString += `<tr class="border-bottom"><th colspan="5">Parent Ticket</th></tr>`;
                        if (data.length >= 1) {
                            for (let i = 0; i < data.length; i++) {
                                appendString += `<tr><td><div class="row"><div class="col-4"><small><a href="javascript:;" class="openModalDetails" data-id="${data[i][0]}">#${pad(data[i][1], 6)}</a></small></div><div class="col-6"><small>by ${data[i][3]}</small></div><div class="col-1"><a href="javascript:;" onclick="$('#modalRemoveRelatedTicket').modal('show');" data-id="${data[i][5]}" data-bs-toggle="tooltip" title="Unlink parent"><i class="fa-duotone fa-link-horizontal-slash"></i></a></div></div></td></tr>`;
                            }
                        } else {
                            appendString += `<tr><td><a href="javascript:;" onclick="$('#modalAddRelatedTicket').modal('show');">Add Parent Ticket</a></td></tr>`;
                        }

                        $("#modalRemoveRelatedTicket form").off("submit").on("submit", function () { RemoveRelatedTicket(viewID); return false; });

                        $("#relatedParentTicket tbody").append(appendString);
                    } else {
                        showToast(resp.data, 'error');
                    }
                }, error: function () {
                    showToast("Could not connect to the server. Please refresh the page and try again.", 'error');
                }
            });

        }, error: function () {
            showToast("Could not connect to the server. Please refresh the page and try again.", 'error');
        }
     });

    return promise;
}

function RemoveRelatedTicket(id) {
    $.ajax({
        url: approot + '/Select2/Save',
        data: { id: id, type: "RemoveRelatedTicket" },
        type: 'GET',
        success: function (resp) {
            if (resp.success) {
                showToast('Ticket unlinked.', 'success');

                ReloadDatatable();

                $(".modal").modal("hide");
            } else {
                showToast(resp.data, 'error');
            }
        }
    });
}

function Rotate(e) {
    var rotate = $(e).data('rotate')
    var angle = $('#modalAttachment').find('.modal-content').data('rotateangle');

    if (rotate == 'cw') {
        angle += 90;
    }
    else {
        angle -= 90;
    }

    $('#modalAttachment').find('.modal-content').css('transform', `rotate(${angle}deg)`)
    $('#modalAttachment').find('.modal-content').data('rotateangle', angle)
}

$(document).on('select2:open', () => {
    document.querySelector('.select2-search__field').focus();
});

let s2EventsDeclared = false;

function PopulateSelect(name, url, placeholder, value, search, dataIN, prepend, params, resetData = false, allowTags = false) {

    let promise = undefined;

    let employeeImg = (params == "Employee" || params == "ITStaff" ? `<span class="position-relative me-2"><img class="rounded-circle d-inline me-2" height="20" width="20" loading="lazy" src="img/login-image.jpg"/> <span class="position-absolute top-100 start-100 translate-middle p-2 bg-danger border border-2 border-light rounded-circle"><span class="visually-hidden">New alerts</span></span></span>` : ``);

    try {
        if (resetData && $(`[name=${name}]`).hasClass("select2-hidden-accessible")) {
            $(`#${name}-spinner`).css("display", "block");
            $(`[name=${name}]`).empty().trigger('change');
            $(`[name=${name}]`).select2('destroy');
            $(`[name=${name}]`).css("display", "none");
        }
    } catch (e) {

    }

    if (!$("[name=" + name + "] option").length) {

        $("[name=" + name + "]").css("display", "none");

        promise = $.ajax({
            url: url,
            type: 'GET',
            data: dataIN,
            success: function (resp) {
                if (resp.success) {
                    let data = resp.data;

                    try {
                        if (data[0].length > 2) {
                            for (var i = 0; i < data.length; i++) {
                                let metaData = ``;
                                for (let j = 3; j < data[i].length; j++)
                                    metaData += ` data-meta-${j}="${escapeHtml(data[i][j])}"`;

                                var newOption = $(`<option value="${data[i][0]}" data-id-raw="${data[i][1]}" ${metaData} >${data[i][2]} ${allowTags ? `<span class="d-none">${metaData}</span>` : ``}</option>`);

                                /*var newOption = search ? $(`<option value="${data[i][0]}" data-id-raw="${data[i][1]}" ${metaData} >${data[i][2]} <span class="d-none">${metaData}</span></option>`) :
                                    $(`<option value="${data[i][0]}" data-id-raw="${data[i][1]}" ${metaData} > ${params == "Employee" ? employeeImg : ``} ${data[i][2]}</option>`);*/
                                $(`[name=${name}]`).append(newOption);
                            }
                        } else {
                            for (var i = 0; i < data.length; i++) {

                                var newOption = $(`<option value="${data[i][0]}" data-id-raw="${data[i][1]}" ${metaData} >${data[i][2]} ${allowTags ? `<span class="d-none">${metaData}</span>` : ``}</option>`);

                                /*var newOption = search ? $(`<option value="${data[i][0]}" data-id-raw="${data[i][1]}" >${data[i][2]}</option>`) :
                                    $(`<option value="${data[i][0]}" data-id-raw="${data[i][1]}" ${metaData} > ${params == "Employee" ? employeeImg : ``} ${data[i][2]}</option>`);*/
                                $(`[name=${name}]`).append(newOption);
                            }
                        }
                    } catch (e) {
                        showToast(`No data available for ${url} dropdown.`, 'warning');
                    }

                    $(`#${name}-spinner`).css("display", "none");
                    $(`[name=${name}]`).val("");
                    $(`[name=${name}]`).css("display", "block");

                    if (search == true || search == false) {

                        if (prepend) {
                            $(`[name=${name}]`).prepend(prepend);
                        } else if (params == "Multiple") {
                            $(`[name=${name}]`).prepend("");
                        } else {
                            $(`[name=${name}]`).prepend("<option></option>");
                        }

                        let minSearch = (search == false ? -1 : 0);

                        $(`[name=${name}]`).select2({
                            placeholder: placeholder,
                            multiple: (params == "Multiple" ? true : false),
                            minimumResultsForSearch: minSearch,
                            dropdownParent: ($('.modal').hasClass('show') ? $(`#` + $(`[name=${name}]`).closest(".modal").attr("id")) : $(`[name=${name}]`).closest("div")),
                            templateResult: function (state) {

                                let image = (params == "Employee" ? `<img class="rounded-circle d-inline me-2" height="30" width="30" loading="lazy" src="https://communityext.ismanila.org/photomanager/handler/Get_ProfilePhoto.ashx?Filename=${$(state.element).val()}&Size=1" />`
                                    : (params == "ITStaff" ? ($(state.element).attr("data-meta-5") == "" || $(state.element).attr("data-meta-5") == null ? `<span class="position-relative me-2"><img class="rounded-circle d-inline" height="30" width="30" loading="lazy" src="https://communityext.ismanila.org/photomanager/handler/Get_ProfilePhoto.ashx?Filename=${$(state.element).attr("data-meta-4")}&Size=1" /><span class="position-absolute top-100 start-100 translate-middle p-1 bg-secondary border border-2 border-light rounded-circle"><span class="visually-hidden"></span></span></span>` : `<span class="position-relative me-2"><img class="rounded-circle d-inline" height="30" width="30" loading="lazy" src="https://communityext.ismanila.org/photomanager/handler/Get_ProfilePhoto.ashx?Filename=${$(state.element).attr("data-meta-4")}&Size=1" /><span class="position-absolute top-100 start-100 translate-middle p-1 bg-success border border-2 border-light rounded-circle"><span class="visually-hidden"></span></span></span>`) : ``)) + "";
                                let itstaffTickets = (params == "ITStaff" ? `<span class="badge badge-pill bg-secondary">${$(state.element).attr("data-meta-3")}</span>` : ``);

                                let returnString = "";

                                if (params == "Conclusion") {
                                    returnString = `<div class="d-flex flex-wrap justify-content-between align-items-center" data-bs-toggle="tooltip" data-bs-html="true" data-bs-placement="right" title="${escapeHtml($(state.element).html())}">
                                                        <span>${$(state.element).attr("data-meta-3")}</span>
                                                    </div>`;
                                } else if (params == "RelatedTicket") {
                                    returnString = `<div class="d-flex flex-wrap justify-content-between align-items-center" >
                                                        <span>${$(state.element).attr("data-meta-3")}</span>
                                                    </div>`;
                                } else if (params == "Multiple") {
                                    returnString = `${$(state.element).html()}`;
                                } else {
                                    returnString = `<div class="d-flex text-truncate justify-content-between align-items-center">
                                                        <span>${image}<span>${$(state.element).html()}</span></span>
                                                        ${$(state.element).attr("data-meta-3") != 0 ? itstaffTickets : ``}
                                                    </div>`;
                                }

                                return returnString;
                            },
                            templateSelection: function (state) {

                                if (!state.id)
                                    return state.text;

                                let image = (params == "Employee" ? `<img class="rounded-circle d-inline me-2" height="30" width="30" loading="lazy" src="https://communityext.ismanila.org/photomanager/handler/Get_ProfilePhoto.ashx?Filename=${$(state.element).val()}&Size=1" />`
                                    : (params == "ITStaff" ? ($(state.element).attr("data-meta-5") == "" || $(state.element).attr("data-meta-5") == null ? `<span class="position-relative me-2"><img class="rounded-circle d-inline" height="30" width="30" loading="lazy" src="https://communityext.ismanila.org/photomanager/handler/Get_ProfilePhoto.ashx?Filename=${$(state.element).attr("data-meta-4")}&Size=1" /><span class="position-absolute top-100 start-100 translate-middle p-1 bg-secondary border border-2 border-light rounded-circle"><span class="visually-hidden"></span></span></span>` : `<span class="position-relative me-2"><img class="rounded-circle d-inline" height="30" width="30" loading="lazy" src="https://communityext.ismanila.org/photomanager/handler/Get_ProfilePhoto.ashx?Filename=${$(state.element).attr("data-meta-4")}&Size=1" /><span class="position-absolute top-100 start-100 translate-middle p-1 bg-success border border-2 border-light rounded-circle"><span class="visually-hidden"></span></span></span>`) : ``)) + "";
                                let itstaffTickets = (params == "ITStaff" ? `<span class="badge badge-pill bg-secondary">${$(state.element).attr("data-meta-3")}</span>` : ``);

                                let returnString = ``;

                                if (params == "Conclusion") {
                                    returnString = `<div class="d-flex flex-wrap justify-content-between align-items-center p-2">
                                                        <span>${$(state.element).html()}</span>
                                                    </div>`;
                                } else if (params == "RelatedTicket") {
                                    returnString = `<div class="d-flex flex-wrap justify-content-between align-items-center">
                                                        <span>${$(state.element).attr("data-meta-3")}</span>
                                                    </div>`;
                                } else if (params == "Multiple") {
                                    returnString = `${$(state.element).html()}`;
                                }  else {
                                    returnString = `<div class="d-flex text-truncate justify-content-between align-items-center">
                                                        <span>${image}<span>${$(state.element).html()}</span></span>
                                                        ${$(state.element).attr("data-meta-3") != 0 ? itstaffTickets : ``}
                                                    </div>`;
                                }

                                return returnString;
                            },
                            escapeMarkup: function (markup) { return markup; }
                        });

                        if (params == "Conclusion" && !s2EventsDeclared) {
                            $('.select2-hidden-accessible').on('select2:open', function (e) {
                                setTimeout(function () {
                                    $(".select2-results__option div").tooltip({ container: 'body', trigger: 'hover' }).on('click mousedown mouseup', function () {
                                        $('[data-bs-toggle="tooltip"], [title]:not([data-bs-toggle="popover"])').tooltip('dispose');
                                    });
                                }, 200);
                            });

                            s2EventsDeclared = true;
                        }

                        if (params == "Multiple") {
                            $(`[name=${name}]`).parent().find('textarea.select2-search__field').css("height", "23.75px");
                        }

                        $('.select2-hidden-accessible').on('select2:open', function (e) {
                            $(".select2-search__field").attr("placeholder", "Search")
                        });


                    } else {
                        $("[name=" + name + "]").addClass("form-control");
                        if (prepend) {
                            $("[name=" + name + "]").prepend(prepend);
                        } else {
                            $("[name=" + name + "]").prepend("<option value='' selected disabled hidden>" + placeholder + "</option>")
                        }
                    }

                    if (value != null) {
                        let val = $("[name=" + name + "] *[data-id-raw='" + value + "']").val();
                        $("[name=" + name + "]").val(val).trigger('change.select2');
                        if (!val) {
                            showToast(`Cannot find ` + value + ` value on select2 ` + name, 'error');
                            $("[name=" + name + "]").select2("val", "");
                            $("[name=" + name + "]").val("").trigger("change");
                        }
                    }
                } else {
                    showToast(url + ` URL not found.`, 'error');
                }

            }
        });
    } else {
        if (value != null) {
            let val = $(`[name=${name}] *[data-id-raw='${value}']`).val();
            $("[name=" + name + "]").val(val).trigger('change.select2');
            if (!val) {
                showToast(`Cannot find ` + value + ` value on select2 ` + name, 'error');
                $("[name=" + name + "]").select2("val", "");
                $("[name=" + name + "]").val("").trigger("change");
            }
        }
        $("#" + name + "-spinner").css("display", "none");
    }

    return promise;
}

function GetFD(formSelector, appendFD = null) {
    let fd = new FormData();

    for (let x of formSelector.serializeArray()) {
        fd.append(x.name, x.value);
    }

    fd.append('__RequestVerificationToken', csrfToken);

    if (appendFD) {
        for (let i = 0; i < appendFD.length; i++) {
            fd.append(appendFD[i].name, appendFD[i]);
        }
        /*for (let x of appendFD.entries()) {
            fd.append(appendFD[0], appendFD[1]);
        }*/
    }

    return fd;
}

function stripTags(html) {
    //let sanitized = DOMPurify.sanitize(html.replace(/=\".*?\"/g, "").replace(/\\/g, "").replace(/(<([^>]+)>)/gi, "").replace(/\//g, ""), { ALLOW_UNKNOWN_PROTOCOLS: true });

    //let sanitized = DOMPurify.sanitize(html, { ALLOW_UNKNOWN_PROTOCOLS: true });
    //return (sanitized.length >= 1 ? sanitized : "<i>Content removed by the system.</i>");
    if (html.match(/<img/))
        return `<i class="fa-duotone fa-image me-1" color="green"></i><i>Ticket contains image, click to show.</i>`;
    else {
        let sanitized = DOMPurify.sanitize(html.replace(/=\".*?\"/g, "").replace(/\\/g, "").replace(/(<([^>]+)>)/gi, "").replace(/\//g, ""), { ALLOW_UNKNOWN_PROTOCOLS: true });
        return (sanitized.length >= 1 ? sanitized : `<i class="fa-duotone fa-square-x me-1" color="red"></i><i>Content removed by the system.</i>`);
    }
}

function cleanseAttr(html) {
    let sanitized = DOMPurify.sanitize(html, { ALLOW_UNKNOWN_PROTOCOLS: true });
    if (html.includes("<img")) {

        html = html.replace(/style="[^\"]*"/g, "");

        let msb = html.substring(
            html.indexOf(`src="`) + 5,
            html.lastIndexOf(`"`)
        );

        let newB64 = msb.replace(/ /g, "+");

        return sanitized.replace(/style="[^\"]*"/g, "").replace(msb, newB64);
    }
    else
        return ($.trim($(sanitized).text()).length >= 1 ? sanitized : `<i class="fa-duotone fa-square-x me-1" color="red"></i><i>Content removed by the system.</i>`);
}

function Print() {
    $('.pdfIframe').remove()
    var url = $('#modalAttachment').find('.btnDownload').attr('href')

    var iframe = document.createElement('iframe');
    iframe.className = 'pdfIframe'
    document.body.appendChild(iframe);
    iframe.style.display = 'none';
    iframe.onload = function () {
        setTimeout(function () {
            iframe.focus();
            iframe.contentWindow.print();
            URL.revokeObjectURL(url)
        }, 1);
    };
    iframe.src = url;
}

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

function Numify(data) {
    let val = data;
    if (!Number.isNaN(parseFloat(data))) {
        val = parseFloat(data).toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
    }

    return val;
}

var entityMap = {
    '&': '&amp;',
    '<': '&lt;',
    '>': '&gt;',
    '"': '&quot;',
    "'": '&#39;',
    '/': '&#x2F;',
    '`': '&#x60;',
    '=': '&#x3D;'
};

function escapeHtml(string) {
    return String(string).replace(/[&<>"'`=\/]/g, function (s) {
        return entityMap[s];
    });
}

function pad (str, max) {
  str = str.toString();
  return str.length < max ? pad("0" + str, max) : str;
}



