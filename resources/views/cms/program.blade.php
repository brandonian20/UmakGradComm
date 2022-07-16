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

    {{-- Program Table --}}
    <div class="container-xl px-4 mt-n10">
        <div class="card mb-4">
            <div class="card-body">
                <table id="datatable" class="table table-responsive table-sm dataTable">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>College</th>
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
                <form id="addForm">
                    <div class="modal-header border-0">
                        <h5 class="modal-title">Add New</h5>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control"
                                id="programName" name="programName" placeholder="Name" required>
                            <label for="programName">Program Name</label>
                        </div>
                        <div class="form-floating mb-3">
                            <select name="collegeID" id="collegeID" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" required>
                                <option value selected disabled>Select from...</option>
                                
                                @foreach($collegeList as $college)
                                    <option value="{{$college["collegeID"]}}">{{$college["collegeName"]}}</option>
                                @endforeach
                                
                              </select>
                            <label for="collegeID">College</label>
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


    <script>
        $(function() {

            $("#addForm").on('submit', function() {
                addnew();
                return false;
            });

            let viewID = null;

            function addnew() {
                $.ajax({
                    url: '/program/add',
                    data: GetFD($("#addForm")),
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

                            $('#addForm')[0].reset();
                            $("#addModal").modal("hide");

                            datatable.ajax.reload(null, false);
                        } else {
                            showToast(resp.data, "error");
                        }
                    }
                });
            }


            var datatable = $("#datatable").DataTable({
                ajax: "/program/datatable",
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
                        data: 'programName',
                        name: 'programName'
                    },
                    {
                        data: 'shortname',
                        name: 'shortname'
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