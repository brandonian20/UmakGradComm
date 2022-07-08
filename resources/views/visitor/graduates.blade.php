@extends('components.layout')

@section('content')
     <!-- Programme Content -->
     <section id="programme">
        <div class="pt-120 pb-130 alert-warning shape-parent text-center">
            <!-- Shape-->
            <div class="shape justify-content-end"><img loading="lazy" src="{{ asset('img/root/404-shape-326x321.png') }}"
                    alt="" width="542" height="382"></div><!-- Shape-->
            <div class="shape align-items-end"><img loading="lazy"
                    src="{{ asset('/img/root/contact-2-shape-558x364.png') }}" alt="" width="309"
                    height="435"></div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 offset-lg-3" style="margin-bottom: 5rem">
                        <h2 class="m-0" data-show="startbox">Graduates</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection