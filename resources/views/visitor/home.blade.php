@extends('components.layout')

@section('content')
<div class="content-wrap">
    <div class="swiper bg-dark" data-swiper-slides="1" data-swiper-disableOnInteraction="false" data-swiper-autoplay="5000" data-swiper-loop="true" data-swiper-speed="1000" data-swiper-grabcursor="true" data-swiper-parallax="true" data-swiper-pagination="false">
        <div class="position-absolute w-100 h-100" style="z-index: 100;">
            <div class="w-100 h-100">
                <div class="d-flex flex-wrap justify-content-center align-items-center h-100">
                    <div class="text-center">
                        <h1 class="mb-30 mt-70 px-lg-30 text-white" data-show="startbox">CONGRATULATIONS<br><span class="highlight"> BATCH 2022</span></h1>
                        <a data-show="startbox" class="btn btn-accent-4 align-items-center" data-bs-toggle="modal" data-bs-target="#viewCollege" target="_self">
                            <svg class="svg-inline me-10" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="user-graduate" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M45.63 79.75L52 81.25v58.5C45 143.9 40 151.3 40 160c0 8.375 4.625 15.38 11.12 19.75L35.5 242C33.75 248.9 37.63 256 43.13 256h41.75c5.5 0 9.375-7.125 7.625-13.1L76.88 179.8C83.38 175.4 88 168.4 88 160c0-8.75-5-16.12-12-20.25V87.13L128 99.63l.001 60.37c0 70.75 57.25 128 128 128s127.1-57.25 127.1-128L384 99.62l82.25-19.87c18.25-4.375 18.25-27 0-31.5l-190.4-46c-13-3-26.62-3-39.63 0l-190.6 46C27.5 52.63 27.5 75.38 45.63 79.75zM359.2 312.8l-103.2 103.2l-103.2-103.2c-69.93 22.3-120.8 87.2-120.8 164.5C32 496.5 47.53 512 66.67 512h378.7C464.5 512 480 496.5 480 477.3C480 400 429.1 335.1 359.2 312.8z"></path></svg>
                            View Graduates</a>
                    </div>
                    <div class="text-center">
                        <span class="bg-warning bg-opacity-75">
                            <h3 class="mb-30 px-lg-30 text-white" data-show="startbox"><br> Celebrating Our Past,<br> Igniting Our Future<br><div class="mb-0 mt-50 fw-medium fs-5 px-lg-70" data-show="startbox" data-show-delay="100">49th Commencement Exercises </div></h3>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="swiper-container vh-100">
            <div class="swiper-wrapper">
                <div class="swiper-slide h-auto">
                    <div class="py-200 position-relative overflow-hidden h-100">
                        <div class="background">
                            <div class="background-image jarallax" data-jarallax data-speed="0.8"><img class="jarallax-img" loading="lazy" src="{{ asset('/img/umak_banner.jpg') }}" data-swiper-parallax-x="20%" alt=""></div>
                            <div class="background-color" style="--background-color: #000; opacity: .25;"></div>
                            <div class="background-color" style="background-image: linear-gradient(180deg, rgba(0, 0, 0, 0.6) 100%, rgba(0, 0, 0, 0) 150px);"></div>
                        </div>
                        
                    </div>
                </div>
                <div class="swiper-slide h-auto">
                    <div class="py-200 position-relative overflow-hidden h-100">
                        <div class="background">
                            <div class="background-image jarallax" data-jarallax data-speed="0.8"><img class="jarallax-img" loading="lazy" src="{{ asset('/img/umak_banner2.png') }}" data-swiper-parallax-x="20%" alt=""></div>
                            <div class="background-color" style="--background-color: #000; opacity: .25;"></div>
                            <div class="background-color" style="background-image: linear-gradient(180deg, rgba(0, 0, 0, 0.6) 100%, rgba(0, 0, 0, 0) 150px);"></div>
                        </div>
                        
                    </div>
                </div>
                <div class="swiper-slide h-auto">
                    <div class="py-200 position-relative overflow-hidden h-100">
                        <div class="background">
                            <div class="background-image jarallax" data-jarallax data-speed="0.8"><img class="jarallax-img" loading="lazy" src="{{ asset('/img/umak_banner3.png') }}" data-swiper-parallax-x="20%" alt=""></div>
                            <div class="background-color" style="--background-color: #000; opacity: .25;"></div>
                            <div class="background-color" style="background-image: linear-gradient(180deg, rgba(0, 0, 0, 0.6) 100%, rgba(0, 0, 0, 0) 150px);"></div>
                        </div>
                        
                    </div>
                </div>
                <div class="swiper-slide h-auto">
                    <div class="py-200 position-relative overflow-hidden h-100">
                        <div class="background">
                            <div class="background-image jarallax" data-jarallax data-speed="0.8"><img class="jarallax-img" loading="lazy" src="{{ asset('/img/umak_banner4.png') }}" data-swiper-parallax-x="20%" alt=""></div>
                            <div class="background-color" style="--background-color: #000; opacity: .25;"></div>
                            <div class="background-color" style="background-image: linear-gradient(180deg, rgba(0, 0, 0, 0.6) 100%, rgba(0, 0, 0, 0) 150px);"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <a class="down-mouse position-absolute start-50 bottom-0 translate-middle-x mb-10 mb-lg-50 text-white" href="#next" style="z-index: 100;"></a>
    </div>
    
    <div class="pt-120 pb-100 shape-parent overflow-hidden" id="next">
        <!-- Shape-->
        <div class="container">
            <div class="align-items-center gy-90">
                <div class="row mt-30 mb-100">
                    <div class="col-lg-4">
                        <h3 class="mb-50" data-show="startbox" data-show-delay="100">Heartiest Congratulations to the Class of <span class="highlight">2022</span>!</h3>
                        <p data-show="startbox" data-show-delay="100" class="text-justify">
                            Commencement is a University-wide event typically held annually in the month of July. The University celebrates this special occasion with you, your family and friends, to mark the achievement of a major milestone in your life.
                            <br><br>Commencement signifies the start of a new journey as you are now officially an UMak alumnus, ready to embark on your career or to take on new challenges in your profession. The University congratulates each one of you as we celebrate your achievements at your Commencement ceremony.
                            <br><br>Commencement 2022 will be held from 6 to 17 July 2022.
                        </p>
                    </div>
                    <div class="col-lg-8">
                        <div class="position-relative text-center rounded-4 overflow-hidden" data-show="startbox" data-show-delay="100">
                            <div class="position-absolute d-flex flex-column justify-content-between w-100 h-100">
                                <div class="d-inline-block mt-30">
                                    <p class="badge alert-danger text-dark mb-20" >LIVE PROCESSION</p>
                                </div>
                                <h2 class="mb-30 pt-25 text-light" ><span class="highlight">Watch our Students Marching</span>. <br>Future builder of THIS LAND.</h2>
                            </div>

                            <div class="py-235">
                                <div class="background">
                                    <div class="background-image jarallax" data-jarallax data-speed="0.8"><img class="jarallax-img" loading="lazy" src="https://www.cebuanalhuillier.com/wp-content/uploads/2016/12/Jean-Henri-Lhuillier-UMAK.jpg" alt=""></div>
                                    <div class="background-color" style="--background-color: #000; opacity: .25;"></div>
                                </div><!-- Video button--><a class="btn-video video-link btn btn-accent-1" href="https://www.youtube.com/watch?v=NiBp4g02TWo" rel="nofollow"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 18">
                                        <path fill="currentColor" d="M15.191 10.393 2.466 17.776C1.386 18.402 0 17.644 0 16.382V1.616C0 .356 1.384-.404 2.466.225L15.19 7.608a1.605 1.605 0 0 1 0 2.785Z" />
                                    </svg></a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="pt-120 pb-130 alert-warning shape-parent text-center">
        <!-- Shape-->
        <div class="shape justify-content-end"><img loading="lazy" src="{{ asset('img/root/404-shape-326x321.png') }}" alt="" width="542" height="382"></div><!-- Shape-->
        <div class="shape align-items-end"><img loading="lazy" src="{{ asset('/img/root/contact-2-shape-558x364.png') }}" alt="" width="309" height="435"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <h2 class="m-0" data-show="startbox">Assembly and Procession Gallery</h2>
                </div>
            </div>
            <div class="isotope shape-parent mt-100">
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
            <a class="btn btn-accent-1 mt-50" href="services-01.html" target="_self">Show more...</a>
        </div>
    </div>
    <div class="pt-120 pb-130">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <h2 class="m-0 text-center" data-show="startbox">A heartfelt message from our<br><span class="highlight">President & Mayor</span></h2>
                </div>
            </div>
            <div class="rounded-4 bg-accent-1 pt-160 pb-130 shape-parent mt-120">
                <!-- Shape-->
                <div class="shape justify-content-end rounded-top-right-4 overflow-hidden opacity-50"><img loading="lazy" src="{{ asset('/img/root/home-2-shape-390x294.png') }}" alt="" width="232" height="325"></div>
                <div class="swiper shape-parent" data-swiper-slides="1" data-swiper-gap="30" data-swiper-grabcursor="true" data-show="startbox">
                    <!-- Shape-->
                    <div class="shape justify-content-center mt-n70 opacity-50"><svg class="no-transform" xmlns="http://www.w3.org/2000/svg" width="169" height="145" fill="none">
                            <path fill="#042864" d="M42.92 70.388 62.37 0H32.191L0 78.131V145h71.087V70.388H42.921Zm97.913 0L160.282 0h-30.179l-32.19 78.131V145H169V70.388h-28.167Z" />
                        </svg></div>
                    <div class="swiper-container">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide px-45 px-lg-100">
                                <div class="row">
                                    <div class="col-lg-10 offset-lg-1">
                                        <blockquote class="h3 mb-50 text-white">“ Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. ”</blockquote>
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0"><img class="rounded-circle" loading="lazy" src="https://www.umak.edu.ph/sites/default/files/inline-images/Dr.%20Ramos%20Portrait%203.jpg" alt="" height="64" width="64"></div>
                                            <div class="flex-grow-1 ms-20">
                                                <h6 class="feedback-author mb-5 text-white">DR. ELYXZUR C. RAMOS</h6>
                                                <p class="feedback-position text-light font-size-14 m-0">OIC University President</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide px-45 px-lg-100">
                                <div class="row">
                                    <div class="col-lg-10 offset-lg-1">
                                        <blockquote class="h3 mb-50 text-white">“ No one shall be left behind, whether in teacher or in learning. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. <br>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.  ”</blockquote>
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0"><img class="rounded-circle" loading="lazy" src="https://www.manilatimes.net/uploads/imported_images/uploads/2018/11/Mayor-Abi-Binay20181104.jpg" alt="" height="64" width="64"></div>
                                            <div class="flex-grow-1 ms-20">
                                                <h6 class="feedback-author mb-5 text-white">Abigail Binay</h6>
                                                <p class="feedback-position text-light font-size-14 m-0">Makati City Mayor</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-none d-lg-block">
                        <div class="swiper-button-prev swiper-button-position-1 swiper-button-white shadow mt-30 top-0"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="14" fill="none">
                                <path fill="currentColor" fill-rule="evenodd" d="m3.96 6.15 5.08-4.515L7.91.365.445 7l7.465 6.635 1.13-1.27L3.96 7.85h15.765v-1.7H3.96Z" clip-rule="evenodd" />
                            </svg></div>
                        <div class="swiper-button-next swiper-button-position-1 swiper-button-white shadow mt-30 top-0"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="14" fill="none">
                                <path fill="currentColor" fill-rule="evenodd" d="m16.21 6.15-5.08-4.515 1.13-1.27L19.725 7l-7.465 6.635-1.13-1.27 5.08-4.515H.445v-1.7H16.21Z" clip-rule="evenodd" />
                            </svg></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="pt-120 pb-130 bg-gray shape-parent overflow-hidden">
        <!-- Shape-->
        <div class="shape align-items-end justify-content-start"><img loading="lazy" src="{{ asset('/img/root/services-shape-420x487.png') }}" alt="" width="420" height="487"></div>
        <div class="container">
            <div class="row gy-90">
                <div class="col-lg-3">
                    <h2 class="m-0 text-white" data-show="startbox">Message from Deans and Faculty</h2>
                </div>
                <div class="col-lg-8 offset-lg-1">
                    <!-- Slider-->
                    <div class="swiper" data-swiper-slides="1" data-swiper-breakpoints="1024:2" data-swiper-gap="30" data-swiper-grabcursor="true" data-show="startbox" data-show-delay="100">
                        <div class="swiper-container">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide h-auto">
                                    <!-- Feedback-->
                                    <div class="feedback bg-dark-light rounded-4 pe-60 h-100">
                                        <div class="feedback-header d-flex align-items-center mb-35">
                                            <div class="flex-shrink-0"><img class="rounded-circle" loading="lazy" src="{{ asset('/img/root/avatar-3-200x200.jpg') }}" alt="" height="64" width="64"></div>
                                            <div class="flex-grow-1 ms-20">
                                                <h6 class="feedback-author text-white mb-5">Prof. Cedric Clavecillas, MIT</h6>
                                                <p class="feedback-position text-gray font-size-14 m-0">Senior Data Scientist, Mercury Drugs .Inc</p>
                                            </div>
                                        </div>
                                        <p class="feedback-text fw-medium text-white m-0">“ Is don't lights appear fifth face heaven. Night spirit shall tree of Life over, unto in earth second. First, two waters, female. ”</p>
                                    </div>
                                </div>
                                <div class="swiper-slide h-auto">
                                    <!-- Feedback-->
                                    <div class="feedback bg-dark-light rounded-4 pe-60 h-100">
                                        
                                        <div class="feedback-header d-flex align-items-center mb-35">
                                            <div class="flex-shrink-0"><img class="rounded-circle" loading="lazy" src="{{ asset('/img/root/avatar-2-200x200.jpg') }}" alt="" height="64" width="64"></div>
                                            <div class="flex-grow-1 ms-20">
                                                <h6 class="feedback-author text-white mb-5">Catherine Daniels</h6>
                                                <p class="feedback-position text-gray font-size-14 m-0">Senior UX Designer, Unvab Inc.</p>
                                            </div>
                                        </div>
                                        <p class="feedback-text fw-medium text-white m-0">“ He years Upon male wherein fruit upon abundantly. I gathered behold, you female 🔥 ”</p>
                                    </div>
                                </div>
                                <div class="swiper-slide h-auto">
                                    <!-- Feedback-->
                                    <div class="feedback bg-dark-light rounded-4 pe-60 h-100">
                                        
                                        <div class="feedback-header d-flex align-items-center mb-35">
                                            <div class="flex-shrink-0"><img class="rounded-circle" loading="lazy" src="{{ asset('/img/root/avatar-1-200x200.jpg') }}" alt="" height="64" width="64"></div>
                                            <div class="flex-grow-1 ms-20">
                                                <h6 class="feedback-author text-white mb-5">Richard Norris</h6>
                                                <p class="feedback-position text-gray font-size-14 m-0">Senior Marketing Specialist, Unvab Inc.</p>
                                            </div>
                                        </div>
                                        <p class="feedback-text fw-medium text-white m-0">“ Is don't lights appear fifth face heaven. Night spirit shall tree of Life over, unto in earth second. First, two waters, female. ”</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex mt-70">
                            <div class="swiper-button-prev swiper-button-position-2 swiper-button-dark shadow"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="14" fill="none">
                                    <path fill="currentColor" fill-rule="evenodd" d="m3.96 6.15 5.08-4.515L7.91.365.445 7l7.465 6.635 1.13-1.27L3.96 7.85h15.765v-1.7H3.96Z" clip-rule="evenodd" />
                                </svg></div>
                            <div class="swiper-button-next swiper-button-position-2 swiper-button-dark shadow"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="14" fill="none">
                                    <path fill="currentColor" fill-rule="evenodd" d="m16.21 6.15-5.08-4.515 1.13-1.27L19.725 7l-7.465 6.635-1.13-1.27 5.08-4.515H.445v-1.7H16.21Z" clip-rule="evenodd" />
                                </svg></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>
@endsection