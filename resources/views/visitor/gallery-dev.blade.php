@extends('components.layout')

@section('content')
     <!-- Programme Content -->
     <section id="gallery">
        <div class="pt-120 pb-130 text-center bg-image graduates-bg">
            <!-- Shape-->
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 offset-lg-3" style="margin-bottom: 2rem">
                        <h2 class="m-0 text-white" data-show="startbox">Assembly and Procession Gallery</h2>
                    </div>
                </div>
                <div class="isotope shape-parent mt-100" data-show="startbox">
                    <div class="row isotope-grid gy-30 gallery-wrapper animated ">
                        @foreach ($onsitepics as $pic)
                            <div class="isotope-item col-12 col-md-6 col-lg-4" data-filters="marketing">
                                <a class="card card-portfolio gallery-item card-overlay card-hover-appearance text-white text-center rounded-4"
                                    href="/pictures/image?id={{$pic['image']}}"><span
                                        class="card-img" data-img-height style="--img-height: 72%;"><img loading="lazy"
                                            src="/pictures/image?id={{$pic['image']}}"
                                            alt=""><span class="background-color"
                                            style="--background-color: rgba(148,126,3, 0.3);"></span></span><span
                                        class="card-img-overlay"><span class="card-title h4">{{$pic['title']}}</span><span
                                            class="card-category subtitle">{{$pic['subtitle']}}</span></span></a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection