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
                    <button type="button" class="btn btn-white text-primary">+ Add New</button>
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
                        <th>Year</th>
                        <th>Theme</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>



<script>
    
    $(function(){

        var datatable = $("#datatable").DataTable({
            ajax: "/academicYear/datatable",
            processing: true,
            serverSide: true,
            ordering: false,
            responsive: true,
            search: {
                return: true,
            },
            language: { search: "", searchPlaceholder: "Search..." },
            columns: [
                {data: 'year', name: 'year'},
                {data: 'theme', name: 'theme'},
                {data: 'action', name: 'action'},
            ],
            drawCallback: function(){
                $(".btn-edit").on('click', function(){
                    console.log($(this).attr(`data-id`));
                })
            },
        })

    });

</script>

@endsection