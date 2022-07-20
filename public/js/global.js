$(function () {
    "use strict";

    $(".preloader").fadeOut();

    $(".modal").modal({
        backdrop: 'static'
    });

    $(".modal").on("shown.bs.modal", function () {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });
    });
    
});

var processingSpinner = `<div class="spinner-border spinner-border-sm" role="status"> <span class="sr-only">Processing...</span> </div>`;

let toastCounter = 0;
function showToast(text, type) {
    const Toast = Swal.mixin({
        toast: true,
        position: 'bottom-right',
        iconColor: 'white',
        customClass: {
          popup: 'colored-toast'
        },
        showConfirmButton: false,
        timer: 5000,
        timerProgressBar: false
      })
    
    Toast.fire({
        icon: type,
        title: text
    });

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


let s2EventsDeclared = false;

function PopulateSelect(name, url, placeholder, value, search, dataIN, prepend, params, resetData = false, allowTags = false) {

    let promise = undefined;

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
                                
                                $(`[name=${name}]`).append(newOption);
                            }
                        } else {
                            for (var i = 0; i < data.length; i++) {

                                var newOption = $(`<option value="${data[i][0]}" data-id-raw="${data[i][1]}" ${metaData} >${data[i][2]} ${allowTags ? `<span class="d-none">${metaData}</span>` : ``}</option>`);

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
                            // templateResult: function (state) {

                            //     let returnString = `<div class="d-flex text-truncate justify-content-between align-items-center">
                            //                     <span><span>${$(state.element).html()}</span></span>
                            //                 </div>`;

                            //     return returnString;
                            // },
                            // templateSelection: function (state) {

                            //     if (!state.id)
                            //         return state.text;

                            //     let returnString = `<div class="d-flex text-truncate justify-content-between align-items-center">
                            //                         <span><span>${$(state.element).html()}</span></span>
                            //                     </div>`;

                            //     return returnString;
                            // },
                            // escapeMarkup: function (markup) { return markup; }
                        });

                        if (params == "Multiple") {
                            $(`[name=${name}]`).parent().find('textarea.select2-search__field').css("height", "23.75px");
                        }

                        $('.select2-hidden-accessible').on('select2:open', function (e) {
                            $(".select2-search__field").attr("placeholder", "Search")
                        });

                        $(document).on('select2:open', () => {
                            document.querySelector('.select2-search__field').focus();
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
        //console.log(`${x.name},  ${x.value}`);
        fd.append(x.name, x.value);
    }

    if (appendFD) {
        for(let pair of appendFD){
            fd.append(pair[0], pair[1]);
        }
    }

    return fd;
}

function GetFD2(formSelector, appendFD = null) {
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

function initTooltip(){
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
    })
}

