@extends('components.cmslayout')

@section('content')

<style>
    .form-floating > .form-control:not(:-moz-placeholder-shown) ~ label {
    opacity: 1;
    color: rgba(0, 0, 0, 0.5);
    background-color: #fff;
    height: auto;
    padding: 0px;
    padding: 0px 0px 0px 10px;
    width: 100%;
    transform: scale(0.982) translateY(0.045rem) translateX(0.1rem);
    border-radius: 5px 0 0 0;
}
.form-floating > .form-control:focus ~ label,
.form-floating > .form-control:not(:placeholder-shown) ~ label,
.form-floating > .form-select ~ label {
    opacity: 1;
    color: rgba(0, 0, 0, 0.5);
    background-color: #fff;
    height: auto;
    padding: 0px 0px 0px 10px;
    width: 100%;
    transform: scale(0.982) translateY(0.045rem) translateX(0.1rem);
    border-radius: 5px 0 0 0;
}
.form-floating > .form-control:-webkit-autofill ~ label {
    opacity: 1;
    color: rgba(0, 0, 0, 0.5);
    background-color: #fff;
    height: auto;
    padding: 0px;
    padding: 0px 0px 0px 10px;
    width: 100%;
    transform: scale(0.982) translateY(0.045rem) translateX(0.1rem);
    border-radius: 5px 0 0 0;
}
</style>

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
                        <th data-sortable=false>Image</th>
                        <th>Name</th>
                        <th>Header</th>
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
                        <input type="text" class="form-control" id="name" name="name"
                            placeholder="Name" required>
                        <label for="name">Name</label>
                    </div>
                    
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="header" name="header"
                            placeholder="Name" required>
                        <label for="header">Header</label>
                    </div>

                    <div class="form-floating mb-3">
                        <textarea name="body" id="body" cols="30" rows="50" class="form-control" placeholder="Input Body Message here (html enabled)" required></textarea>
                        <label for="body">Body</label>
                    </div>

                    <div class="input-group mb-3">
                        <label class="input-group-text pe-0" for="imageUpload">Image</label>
                        <input type="file" accept="image/*" class="form-control border-start-0 ps-1" id="imageUpload" name="image">
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
                    
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="e-name" name="e-name"
                            placeholder="Name" required>
                        <label for="e-name">Name</label>
                    </div>
                    
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="e-header" name="e-header"
                            placeholder="Name" required>
                        <label for="e-header">Header</label>
                    </div>

                    <div class="form-floating mb-3">
                        <textarea name="e-body" id="e-body" cols="30" rows="50" class="form-control" placeholder="Input Body Message here (html enabled)" required></textarea>
                        <label for="e-body">Body</label>
                    </div>

                    <div class="input-group mb-3">
                        <label class="input-group-text pe-0" for="e-imageUpload">Image</label>
                        <input type="file" accept="image/*" class="form-control border-start-0 ps-1" id="e-imageUpload" name="e-image">
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

        let viewID = null, imageID = null, bannerID = null;

        function addnew() {

            let fd = new FormData();
            fd.append("acadYear", $("[name=academicYear]").val());
            fd.append("image", $("[name=image]").get(0).files[0]);

            $.ajax({
                url: '/messages/add',
                data: GetFD($("#addForm"), fd),
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

                        if (saveAddNew){
                            $('#addForm')[0].reset();

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
                url: '/messages/edit',
                data: {
                    id: viewID
                },
                type: 'GET',
                success: function(resp) {
                    console.log(resp);

                    imageID = resp.image;

                    $("#editTitle").html(`Editing <b>${resp.name}</b>`);

                    $("[name='e-name']").val(resp.name);
                    $("[name='e-header']").val(resp.header);
                    $("[name='e-body']").val(resp.body);

                    $("[name='e-image']").val("");

                    $("#editModal").modal("show");
                }
            });
        }

        function postedit() {
            let fd = new FormData();
            fd.append("id", viewID);
            fd.append("image", $("[name=e-image]").get(0).files[0]);
            fd.append("imageID", imageID);

            $.ajax({
                url: '/messages/edit',
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
                    url: "/messages/datatable",
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
                        data: 'image',
                    },
                    {
                        data: 'name',
                    },
                    {
                        data: 'header',
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