@extends('components.layout')

@section('content')
    <!-- Showcase -->
    <div class="shape align-items-start justify-content-start" style="margin-left: -8rem;">
        <img loading="lazy" src="{{ asset('/img/speakers/asset-2.svg') }}" alt="" width="420px" height="487">
    </div>
    <div class="shape align-items-end justify-content-end" style="margin-right: -8rem;">
        <img loading="lazy" src="{{ asset('/img/speakers/asset-1.svg') }}" alt="" width="420px" height="487">
    </div>
    <section class="pt-lg-100 pb-100 mt-lg-80 pt-50 mt-40">
        <section class="p-5 text-center text-sm-start mb-50">
            <div class="container">`
                <div class="row">
                    <div class="col-lg-8 col-12 text-lg-start text-center align-text-between">
                        <!-- <h1>Become a <span class="text-warning">Web Developer</span></h1> -->
                        <h3 class="mb-0" style="font-family: Marcellus !important; color: #d5ac44;">Message from the</h3>
                        <h1 style="font-family: Marcellus !important; color: #d5ac44;">{{$data['header']}}</h1>
                        <!-- <button class="btn btn-primary btn-lg"
                        data-bs-toggle="modal"
                        data-bs-target="#enroll">Start The Enrollment</button> -->
                    </div>
                    <div class="col-lg-4 col-12 d-flex justify-content-center">
                        <img class="w-75 d-sm-block d-flex" src="/pictures/image?id={{$data['image']}}" alt="Showcase Photo"
                            style="border-radius: 50%">
                    </div>
                </div>
            </div>
        </section>

        <section class="p-2 text-center ">
            <div class="container">
                <div class="d-sm-flex align-items-center justify-content-between">
                    <div class="row">
                        <div class="col-12" style="text-align: justify;">
                            <!-- <h1>Become a <span class="text-warning">Web Developer</span></h1> -->
                            <p class="my-4 text-justify" style="font-family: Metropolis; ">
                              {!! $data['body'] !!}
                            </p>

                            <h3 style="font-family: Marcellus !important;"><br>{{$data['name']}}</h3>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </section>
    <script>
        $(function() {
            $(".navbar").attr("style", "background-color: #052964");
        });
    </script>
@endsection
