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
                            <th>Full Name</th>
                            <th>Program</th>
                            <th>Semester</th>
                            <th>Action</th>
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
                                placeholder="Name" required>
                            <label for="middlename">Middle Name</label>
                        </div>

                        <div class="input-group mb-3">
                            <label class="input-group-text pe-0" for="imageUpload">Image</label>
                            <input type="file" class="form-control border-start-0 ps-1" id="imageUpload" name="image">
                        </div>

                        <div class="input-group mb-3">
                            <label class="input-group-text pe-0" for="bannerUpload">Banner</label>
                            <input type="file" class="form-control border-start-0 ps-1" id="bannerUpload" name="banner">
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
                                <input type="radio" class="btn-check" name="honor" value="1" id="cumlaude" autocomplete="off">
                                <label class="btn btn-outline-primary" for="cumlaude">Cum Laude</label>
                              
                                <input type="radio" class="btn-check" name="honor" value="2" id="mcumlaude" autocomplete="off">
                                <label class="btn btn-outline-primary" for="mcumlaude">Magna Cum Laude</label>
                              
                                <input type="radio" class="btn-check" name="honor" value="3" id="scumlaude" autocomplete="off">
                                <label class="btn btn-outline-primary" for="scumlaude">Summa Cum Laude</label>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer border-0">
                        <button class="btn btn-light" type="button" data-bs-dismiss="modal">Close</button>
                        <button class="btn btn-primary" type="submit">Save</button>
                        <button class="btn btn-primary" type="button">Save & Add New</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(function() {

            PopulateSelect('academicYear', '/select2/academicYear', "Select Academic Year", "6", null, null, null,
                null);

            $("#addForm").on('submit', function() {
                addnew();
                return false;
            });

            $("#editForm").on('submit', function() {
                postedit();
                return false;
            });

            $("#addModal").on('show.bs.modal',function(){
                PopulateSelect('semester', '/select2/semester', "Select Semester Graduated", null, false, null, null, null);
                PopulateSelect('program', '/select2/program', "Select Program", null, true, null, null, null);

            }).on("shown.bs.modal", function() {
                $("#honorName").focus();
            });

            let viewID = null;

            function addnew() {

                let fd = new FormData();
                fd.append("acadYear", $("[name=academicYear]").val());
                fd.append("image", $("[name=image]").get(0).files[0]);
                fd.append("banner", $("[name=banner]").get(0).files[0]);

                $.ajax({
                    url: '/graduates/add',
                    data: GetFD($("#addForm"), fd),
                    //data: GetFD2($("#addForm"), $("[name=image]").get(0).files),
                    type: 'POST',
                    contentType: false,
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(resp) {
                        console.log(resp);
                        if (resp.success) {
                            showToast(resp.data, "success");

                            $('#addForm')[0].reset();
                            $("#addModal").modal("hide");

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
                        $("#editTitle").html(`Editing <b>${resp.graduatesName}</b>`);

                        $("[name='e-graduatesName']").val(resp.graduatesName);

                        $("#editModal").modal("show");
                    }
                });
            }

            function postedit() {
                let fd = new FormData();
                fd.append("id", viewID);

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

            var datatable = $("#datatable").DataTable({
                ajax: {
                    url: "/graduates/datatable",
                    data: {
                        "acadYr": $('[name=academicYear]').val(),
                    },
                },
                processing: true,
                serverSide: true,
                ordering: false,
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
                        data: 'Lastname',
                        name: 'Full Name'
                    },
                    {
                        data: 'Firstname',
                        name: 'Program Name'
                    },
                    {
                        data: 'Middlename',
                        name: 'Semester'
                    },
                    {
                        data: 'action'  ,
                        name: 'action'
                    },
                ],
                drawCallback: function() {
                    $(".btn-edit").on('click', function() {
                        getedit($(this).attr(`data-id`));
                    })
                },
                initComplete: function() {
                    //$('[name=academicYear]').prependTo("#datatable_filter").removeClass("d-none");

                    // $("#datatable_filter").addClass("d-flex").addClass("justify-content-end");
                },
            })

        });
    </script>
@endsection
