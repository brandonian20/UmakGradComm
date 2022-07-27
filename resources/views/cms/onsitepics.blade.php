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
                            <th data-sortable=false>Image</th>
                            <th>Title</th>
                            <th>Subtitle</th>
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
                            <input type="text" class="form-control" id="title" name="title" placeholder="Name"
                                required>
                            <label for="title">Title</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="subtitle" name="subtitle" placeholder="Name">
                            <label for="subtitle">Subtitle</label>
                        </div>

                        <div class="input-group mb-3">
                            <label class="input-group-text pe-0" for="imageUpload">Image</label>
                            <input type="file" accept="image/*" class="form-control border-start-0 ps-1" id="imageUpload"
                                name="image">
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
                            <input type="text" class="form-control" id="e-title" name="e-title" placeholder="Name"
                                required>
                            <label for="e-title">Title</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="e-subtitle" name="e-subtitle" placeholder="Name"
                                required>
                            <label for="e-subtitle">Subtitle</label>
                        </div>

                        <div class="input-group mb-3">
                            <label class="input-group-text pe-0" for="e-imageUpload">Image</label>
                            <input type="file" accept="image/*" class="form-control border-start-0 ps-1"
                                id="e-imageUpload" name="e-image" >
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

            let acadYearLoaded = PopulateSelect('academicYear', '/select2/academicYear', "Select Academic Year",
                "6", null, null, null,
                null);

            $("#addForm").on('submit', function() {
                addnew();
                return false;
            });

            saveAddNew = false;
            $("#SaveAddNew").on('click', function() {
                saveAddNew = true;
            })

            $("#editForm").on('submit', function() {
                postedit();
                return false;
            });

            let viewID = null,
                imageID = null,
                bannerID = null;

            function addnew() {

                let fd = new FormData();
                fd.append("acadYear", $("[name=academicYear]").val());
                fd.append("image", $("[name=image]").get(0).files[0]);

                $.ajax({
                    url: '/onsitepics/add',
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

                            if (saveAddNew) {
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
                    url: '/onsitepics/edit',
                    data: {
                        id: viewID
                    },
                    type: 'GET',
                    success: function(resp) {
                        console.log(resp);

                        imageID = resp.image;

                        $("#editTitle").html(`Editing <b>${resp.title}</b>`);

                        $("[name='e-title']").val(resp.title);
                        $("[name='e-subtitle']").val(resp.subtitle);

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
                    url: '/onsitepics/edit',
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

            $.when(acadYearLoaded).done(function() {
                datatable = $("#datatable").DataTable({
                    ajax: {
                        url: "/onsitepics/datatable",
                        data: function(d) {
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
                    columns: [{
                            data: 'image',
                        },
                        {
                            data: 'title',
                        },
                        {
                            data: 'subtitle',
                        },
                        {
                            data: 'action',
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

            function acadYearLoad() {
                $("[name=academicYear]").on("change", function() {
                    datatable.ajax.reload();
                });
            }

        });
    </script>
    </script>
@endsection
