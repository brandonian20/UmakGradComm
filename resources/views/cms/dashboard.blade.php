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

@endsection