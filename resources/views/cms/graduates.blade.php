@extends('components.cmslayout')

@section('content')
    <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
        <div class="container-xl px-4">
            <div class="page-header-content pt-4">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto mt-4">
                        <h1 class="page-header-title">{{ $title }}</h1>
                    </div>
                    <div class="col-12 col-xl-auto mt-4 d-flex">

                        <select name="academicYear" class="form-select form-select-sm me-2" style="width: 100px;"></select>

                        <button type="button" class="btn btn-white text-primary" data-bs-toggle="modal"
                            data-bs-target="#addModal">+ Add New</button>

                    </div>
                </div>
            </div>
        </div>
    </header>

    

    <div class="container-xl px-4 mt-n10">
        <div class="card mb-4">
            <div class="card-body">
                <table id="datatable" class="table table-responsive table-sm dataTable">
                    <thead>
                        <tr>
                            <th data-sortable=false>Image(s)</th>
                            <th>Full Name</th>
                            <th>Program</th>
                            <th>Semester</th>
                            <th data-sortable=false>Action</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Add --}}
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form id="addForm" enctype="multipart/form-data" autocomplete="off">
                    <div class="modal-header border-0">
                        <h5 class="modal-title">Add New</h5>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="lastname" name="lastname"
                                placeholder="Name" required>
                            <label for="lastname">Last Name</label>
                        </div>
                        
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="firstname" name="firstname"
                                placeholder="Name" required>
                            <label for="firstname">First Name</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="middlename" name="middlename"
                                placeholder="Name">
                            <label for="middlename">Middle Name</label>
                        </div>

                        <div class="input-group mb-3">
                            <label class="input-group-text pe-0" for="imageUpload">Image</label>
                            <input type="file" accept="image/*" class="form-control border-start-0 ps-1" id="imageUpload" name="image">
                        </div>

                        <div class="input-group mb-3">
                            <label class="input-group-text pe-0" for="bannerUpload">Slide Deck</label>
                            <input type="file" accept="image/*" class="form-control border-start-0 ps-1" id="bannerUpload" name="banner">
                        </div>

                        <div class="w-100 mb-3">
                            <div id="semester-spinner">
                                Loading...
                            </div>
                            <div class="input-group flex-nowrap">
                                <select name="semester" class="form-select select-accent w-100" required></select>

                                <input type="checkbox" class="btn-check" id="semester-lock" autocomplete="off">
                                <label class="btn btn-outline-primary" for="semester-lock"><i class="fa-solid fa-lock"></i></label>
                            </div>
                            
                        </div>

                        <div class="w-100 mb-3">
                            <div id="program-spinner">
                                Loading...
                            </div>
                            <div class="input-group flex-nowrap">
                                <select name="program" class="form-select select-accent w-100" required></select>

                                <input type="checkbox" class="btn-check" id="program-lock" autocomplete="off">
                                <label class="btn btn-outline-primary" for="program-lock"><i class="fa-solid fa-lock"></i></label>
                            </div>
                            
                        </div>

                        <div class="d-flex justify-content-center">
                            <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                <input type="radio" class="btn-check" name="honor" value="3" id="cumlaude" autocomplete="off">
                                <label class="btn btn-outline-primary" for="cumlaude">Cum Laude</label>
                              
                                <input type="radio" class="btn-check" name="honor" value="2" id="mcumlaude" autocomplete="off">
                                <label class="btn btn-outline-primary" for="mcumlaude">Magna Cum Laude</label>
                              
                                <input type="radio" class="btn-check" name="honor" value="1" id="scumlaude" autocomplete="off">
                                <label class="btn btn-outline-primary" for="scumlaude">Summa Cum Laude</label>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer border-0">
                        <button class="btn btn-light" type="button" data-bs-dismiss="modal">Close</button>
                        <button class="btn btn-primary" type="submit">Save</button>
                        <button class="btn btn-primary" id="SaveAddNew" type="submit">Save & Add New</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Edit --}}
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <form id="editForm" enctype="multipart/form-data" autocomplete="off">
                    <div class="modal-header border-0">
                        <h5 class="modal-title" id="editTitle"></h5>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="text-center">Toga Picture</div>
                                    <img id="e-toga" src="" alt="">
                                </div>
                                <div class="row mt-2">
                                    <div class="text-center">Slide Deck Picture</div>
                                    <img id="e-banner" src="" alt="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="e-lastname" name="e-lastname"
                                        placeholder="Name" required>
                                    <label for="e-lastname">Last Name</label>
                                </div>
                                
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="e-firstname" name="e-firstname"
                                        placeholder="Name" required>
                                    <label for="e-firstname">First Name</label>
                                </div>
        
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="e-middlename" name="e-middlename"
                                        placeholder="Name">
                                    <label for="e-middlename">Middle Name</label>
                                </div>
        
                                <div class="input-group mb-3">
                                    <label class="input-group-text pe-0" for="e-imageUpload">Image</label>
                                    <input type="file" accept="image/*" class="form-control border-start-0 ps-1" id="e-imageUpload" name="e-image">
                                </div>
        
                                <div class="input-group mb-3">
                                    <label class="input-group-text pe-0" for="bannerUpload">Slide Deck</label>
                                    <input type="file" accept="image/*" class="form-control border-start-0 ps-1" id="e-bannerUpload" name="e-banner">
                                </div>
        
                                <div class="w-100 mb-3">
                                    <div id="e-semester-spinner">
                                        Loading...
                                    </div>
                                    <div class="input-group flex-nowrap">
                                        <select name="e-semester" class="form-select select-accent w-100" required></select>
                                    </div>
                                    
                                </div>
        
                                <div class="w-100 mb-3">
                                    <div id="e-program-spinner">
                                        Loading...
                                    </div>
                                    <div class="input-group flex-nowrap">
                                        <select name="e-program" class="form-select select-accent w-100" required></select>
                                    </div>
                                    
                                </div>
        
                                <div class="d-flex justify-content-center">
                                    <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                        <input type="radio" class="btn-check" name="e-honor" value="3" id="e-cumlaude" autocomplete="off">
                                        <label class="btn btn-outline-primary" for="e-cumlaude">Cum Laude</label>
                                      
                                        <input type="radio" class="btn-check" name="e-honor" value="2" id="e-mcumlaude" autocomplete="off">
                                        <label class="btn btn-outline-primary" for="e-mcumlaude">Magna Cum Laude</label>
                                      
                                        <input type="radio" class="btn-check" name="e-honor" value="1" id="e-scumlaude" autocomplete="off">
                                        <label class="btn btn-outline-primary" for="e-scumlaude">Summa Cum Laude</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        

                    </div>
                    <div class="modal-footer border-0">
                        <button class="btn btn-light" type="button" data-bs-dismiss="modal">Close</button>
                        <button class="btn btn-primary" type="submit">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>

        let datatable = null;

        $(function() {

            let acadYearLoaded = PopulateSelect('academicYear', '/select2/academicYear', "Select Academic Year", "6", null, null, null,
                null);

            $("#addForm").on('submit', function() {
                addnew();
                return false;
            });

            saveAddNew = false;
            $("#SaveAddNew").on('click', function(){
                saveAddNew = true;
            })

            $("#editForm").on('submit', function() {
                postedit();
                return false;
            });

            $("#addModal").on("shown.bs.modal", function() {
                PopulateSelect('semester', '/select2/semester', "Select Semester Graduated", null, false, null, null, null);
                PopulateSelect('program', '/select2/program', "Select Program", null, true, null, null, null);
                $("#honorName").focus();
            });

            let wasChecked = 0, wasChecked2 = 0;
            $('[name=honor]').on('click', function(){
                if ($('[name=honor]:checked').val() == wasChecked){
                    $('[name=honor]').prop('checked', false);
                    wasChecked = 0;
                } else {
                    wasChecked = $('[name=honor]:checked').val();    
                }
            });

            $('[name=e-honor]').on('click', function(){
                if ($('[name=e-honor]:checked').val() == wasChecked2){
                    $('[name=e-honor]').prop('checked', false);
                    wasChecked2 = 0;
                } else {
                    wasChecked2 = $('[name=e-honor]:checked').val();    
                }
            });

            let viewID = null, imageID = null, bannerID = null;

            function addnew() {

                let fd = new FormData();
                fd.append("acadYear", $("[name=academicYear]").val());
                fd.append("image", $("[name=image]").get(0).files[0]);
                fd.append("banner", $("[name=banner]").get(0).files[0]);

                $.ajax({
                    url: '/graduates/add',
                    data: GetFD($("#addForm"), fd),
                    type: 'POST',
                    contentType: false,
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(resp) {
                        // console.log(resp);
                        if (resp.success) {
                            showToast(resp.data, "success");

                            if (saveAddNew){
                                $('[name="lastname"], [name="firstname"], [name="middlename"], [name="image"], [name="banner"], [name="honor"]').val("");
                                $('[name="honor"]').prop('checked', false);

                                //Clear semester if locked
                                if(!$("#semester-lock").prop("checked")) $("[name='semester']").select2("val", " ");

                                //Clear program if locked
                                if(!$("#program-lock").prop("checked")) $("[name='program']").select2("val", " ");

                                saveAddNew = false;

                            } else {
                                $('#addForm')[0].reset();
                                $("#addModal").modal("hide");
                            }

                            

                            datatable.ajax.reload(null, false);
                        } else {
                            showToast(resp.data, "error");
                        }
                    }
                });
            }

            function getedit(id) {
                viewID = id;

                $.ajax({
                    url: '/graduates/edit',
                    data: {
                        id: viewID
                    },
                    type: 'GET',
                    success: function(resp) {
                        console.log(resp);

                        imageID = resp.pictureID;
                        bannerID = resp.bannerImageID;
                        wasChecked2 = resp.honorID;

                        $("#editTitle").html(`Editing <b>${resp.Lastname}, ${resp.Firstname} ${resp.Middlename}</b>`);

                        $("[name='e-lastname']").val(resp.Lastname);
                        $("[name='e-firstname']").val(resp.Firstname);
                        $("[name='e-middlename']").val(resp.Middlename);

                        PopulateSelect('e-semester', '/select2/semester', "Select Semester Graduated", resp.semID, false, null, null, null);
                        PopulateSelect('e-program', '/select2/program', "Select Program", resp.programID, true, null, null, null);

                        $("[name='e-image']").val("");
                        $("[name='e-banner']").val("");

                        if ($(`[name='e-honor'][value='${resp.honorID}']`).length > 0)
                            $(`[name='e-honor'][value='${resp.honorID}']`).prop('checked', true);
                        else 
                            $(`[name='e-honor']`).prop('checked', false);

                        $("#e-toga").attr("src", `/pictures/image?id=${resp.image}`);
                        $("#e-banner").attr("src", `/pictures/image?id=${resp.banner}`);

                        $("#editModal").modal("show");
                    }
                });
            }

            function postedit() {
                let fd = new FormData();
                fd.append("id", viewID);
                fd.append("image", $("[name=e-image]").get(0).files[0]);
                fd.append("banner", $("[name=e-banner]").get(0).files[0]);
                fd.append("imageID", imageID);
                fd.append("bannerID", bannerID);

                $.ajax({
                    url: '/graduates/edit',
                    data: GetFD($("#editForm"), fd),
                    type: 'POST',
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(resp) {
                        console.log(resp);
                        if (resp.success) {
                            showToast(resp.data, "success");

                            datatable.ajax.reload(null, false);
                            $("#editModal").modal("hide");
                        } else {
                            showToast(resp.data, "error");
                        }
                    }
                });
            }

            let tblFilterEvent = true;

            $.when(acadYearLoaded).done(function () { 
                datatable = $("#datatable").DataTable({
                    ajax: {
                        url: "/graduates/datatable",
                        data: function(d){
                            d.acadYear = $("[name=academicYear]").val();
                        }
                    },
                    processing: true,
                    serverSide: true,
                    ordering: true,
                    responsive: true,
                    search: {
                        return: true,
                    },
                    language: {
                        search: "",
                        searchPlaceholder: "Search..."
                    },
                    columns: [
                        {
                            data: 'pictureID',
                        },
                        {
                            data: 'Lastname',
                        },
                        {
                            data: 'Firstname',
                        },
                        {
                            data: 'Middlename',
                        },
                        {
                            data: 'action'  ,
                        },
                    ],
                    drawCallback: function() {
                        $(".btn-edit").on('click', function() {
                            getedit($(this).attr(`data-id`));
                        });
                        initTooltip();
                    },
                    initComplete: function() {
                        if (tblFilterEvent) {
                            acadYearLoad();
                            tblFilterEvent = false;
                        }
                    },
                })
            });

            function acadYearLoad(){
                $("[name=academicYear]").on("change", function () {
                    datatable.ajax.reload();
                });
            }

        });
    </script>
@endsection
