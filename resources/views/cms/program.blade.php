@extends('components.cmslayout')

@section('content')

<header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
    <div class="container-xl px-4">
        <div class="page-header-content pt-4">
            <div class="row align-items-center justify-content-between">
                <div class="col-auto mt-4">
                    <h1 class="page-header-title">{{ $title }}</h1>
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
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>

<script>
    window.addEventListener('DOMContentLoaded', event => {
    // Simple-DataTables
    // https://github.com/fiduswriter/Simple-DataTables/wiki

    const datatablesSimple = document.getElementById('datatablesSimple');
    if (datatablesSimple) {
        new simpleDatatables.DataTable(datatablesSimple);
    }
});

</script>

@endsection