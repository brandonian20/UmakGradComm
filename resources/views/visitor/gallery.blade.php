@extends('components.layout')

@section('content')
     <!-- Programme Content -->
     <section id="gallery">
        <div class="pt-120 pb-130 text-center bg-image"   style="
        background-image: url({{ asset('/img/BG1-Black.png') }});
        background-repeat: repeat-y;
        background-size: auto 100%;;
    ">
            <!-- Shape-->
            {{-- <div class="shape justify-content-end"><img loading="lazy" src="{{ asset('img/root/404-shape-326x321.png') }}"
                    alt="" width="542" height="382"></div><!-- Shape--> --}}
            {{-- <div class="shape align-items-end"><img loading="lazy"
                    src="{{ asset('/img/root/contact-2-shape-558x364.png') }}" alt="" width="309"
                    height="435"></div> --}}
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 offset-lg-3" style="margin-bottom: 2rem">
                        <h2 class="m-0 text-white" data-show="startbox">Assembly and Procession Gallery</h2>
                    </div>
                </div>
                <div class="isotope shape-parent mt-100" data-show="startbox">
                    <div class="row isotope-grid gy-30 gallery-wrapper animated ">
                        <div class=" isotope-item col-12 col-md-6 col-lg-4" data-filters="marketing">
                            <!-- Portfolio--><a class="card card-portfolio gallery-item card-overlay card-hover-appearance text-white text-center rounded-4" href="https://media.interaksyon.com/wp-content/uploads/2021/05/makati-coliseum-covid-19-vaccination-queue.jpg"><span class="card-img" data-img-height style="--img-height: 72%;"><img loading="lazy" src="https://media.interaksyon.com/wp-content/uploads/2021/05/makati-coliseum-covid-19-vaccination-queue.jpg" alt=""><span class="background-color" style="--background-color: rgba(148,126,3, 0.9);"></span></span><span class="card-img-overlay"><span class="card-title h4">Makati Coliseum</span><span class="card-category subtitle">Location</span></span></a>
                        </div>
                        <div class=" isotope-item col-12 col-md-6 col-lg-4" data-filters="development">
                            <!-- Portfolio--><a class="card card-portfolio gallery-item card-overlay card-hover-appearance text-white text-center rounded-4" href="https://www.umak.edu.ph/sites/default/files/inline-images/John%20Philip%20Bravo%20-%20UMak.jpg"><span class="card-img" data-img-height style="--img-height: 116%;"><img loading="lazy" src="https://www.umak.edu.ph/sites/default/files/inline-images/John%20Philip%20Bravo%20-%20UMak.jpg" alt=""><span class="background-color" style="--background-color: rgba(148,126,3, 0.9);"></span></span><span class="card-img-overlay"><span class="card-title h4">Graduand</span><span class="card-category subtitle">2022</span></span></a>
                        </div>
                        <div class=" isotope-item col-12 col-md-6 col-lg-4" data-filters="branding">
                            <!-- Portfolio--><a class="card card-portfolio gallery-item card-overlay card-hover-appearance text-white text-center rounded-4" href="http://davaotimes.net/wp-content/uploads/2019/12/Manny-Pacquiao.jpg"><span class="card-img" data-img-height style="--img-height: 72%;"><img loading="lazy" src="http://davaotimes.net/wp-content/uploads/2019/12/Manny-Pacquiao.jpg" alt=""><span class="background-color" style="--background-color: rgba(148,126,3, 0.9);"></span></span><span class="card-img-overlay"><span class="card-title h4">Manny Pacquiao</span><span class="card-category subtitle"></span>Celebrity</span></a>
                        </div>
                        <div class=" isotope-item col-12 col-md-6 col-lg-4" data-filters="architecture">
                            <!-- Portfolio--><a class="card card-portfolio gallery-item card-overlay card-hover-appearance text-white text-center rounded-4" href="https://pbs.twimg.com/media/CFlJrutUEAADlN6.jpg"><span class="card-img" data-img-height style="--img-height: 116%;"><img loading="lazy" src="https://pbs.twimg.com/media/CFlJrutUEAADlN6.jpg" alt=""><span class="background-color" style="--background-color: rgba(148,126,3, 0.9);"></span></span><span class="card-img-overlay"><span class="card-title h4">Graduand</span><span class="card-category subtitle">Architecture</span></span></a>
                        </div>
                        <div class=" isotope-item col-12 col-md-6 col-lg-4" data-filters="development">
                            <!-- Portfolio--><a class="card card-portfolio gallery-item card-overlay card-hover-appearance text-white text-center rounded-4" href="https://fastly.4sqi.net/img/general/600x600/akwhsb6hMSyKb-8lv3aaQbXTo5_pPnD2ChemZ8leZBw.jpg"><span class="card-img" data-img-height style="--img-height: 116%;"><img loading="lazy" src="https://fastly.4sqi.net/img/general/600x600/akwhsb6hMSyKb-8lv3aaQbXTo5_pPnD2ChemZ8leZBw.jpg" alt=""><span class="background-color" style="--background-color: rgba(148,126,3, 0.9);"></span></span><span class="card-img-overlay"><span class="card-title h4">Makati Col</span><span class="card-category subtitle">Environment</span></span></a>
                        </div>
                        <div class=" isotope-item col-12 col-md-6 col-lg-4" data-filters="marketing">
                            <!-- Portfolio--><a class="card card-portfolio gallery-item card-overlay card-hover-appearance text-white text-center rounded-4" href="https://tribune.net.ph/wp-content/uploads/2019/06/UMAK.jpg"><span class="card-img" data-img-height style="--img-height: 72%;"><img loading="lazy" src="https://tribune.net.ph/wp-content/uploads/2019/06/UMAK.jpg" alt=""><span class="background-color" style="--background-color: rgba(148,126,3, 0.9);"></span></span><span class="card-img-overlay"><span class="card-title h4">UMak</span><span class="card-category subtitle">Environment</span></span></a>
                        </div>
                    </div>
                </div>
                <a class="btn btn-accent-1 mt-50 button-color" href="services-01.html" target="_self">Load more...</a>   
            </div>
        </div>
    </section>
@endsection