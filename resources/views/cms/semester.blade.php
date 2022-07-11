@extends('components.cmslayout')

@section('content')
    <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
        <div class="container-xl px-4">
            <div class="page-header-content pt-4">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto mt-4">
                        <h1 class="page-header-title">{{ $title }}</h1>
                    </div>
                    <div class="col-12 col-xl-auto mt-4">
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
                            <th>Description</th>
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
                <form id="addForm">
                    <div class="modal-header border-0">
                        <h5 class="modal-title">Add New</h5>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control"
                                id="desc" name="desc" placeholder="Desc" required>
                            <label for="desc">Description</label>
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

    {{-- Edit --}}
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form id="editForm">
                    <div class="modal-header border-0">
                        <h5 class="modal-title" id="editTitle"></h5>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control"
                                id="e-desc" name="e-desc" placeholder="Desc" required>
                            <label for="e-desc">Description</label>
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
        $(function() {

            $("#addForm").on('submit', function() {
                addnew();
                return false;
            });
            $("#editForm").on('submit', function() {
                postedit();
                return false;
            });

            let viewID = null;

            function addnew() {
                $.ajax({
                    url: '/semester/add',
                    data: GetFD($("#addForm")),
                    type: 'POST',
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(resp) {
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
                    url: '/semester/edit',
                    data: {
                        id: viewID
                    },
                    type: 'GET',
                    success: function(resp) {
                        $("#editTitle").html(`Editing <b>${resp.desc}</b>`);

                        $("[name='e-desc']").val(resp.desc);

                        $("#editModal").modal("show");
                    }
                });
            }

            function postedit() {
                let fd = new FormData();
                fd.append("id", viewID);

                $.ajax({
                    url: '/semester/edit',
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
                ajax: "/semester/datatable",
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
                columns: [{
                        data: 'desc',
                        name: 'desc'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    },
                ],
                drawCallback: function() {
                    $(".btn-edit").on('click', function() {
                        getedit($(this).attr(`data-id`));
                    })
                },
            })

        });
    </script>
@endsection
