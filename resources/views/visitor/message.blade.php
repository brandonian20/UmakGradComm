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
                   <h1 style="font-family: Marcellus !important; color: #d5ac44;">Message from the<br> OIC President and Concurrent Vice President for Academic Affairs</h1>
                   <!-- <button class="btn btn-primary btn-lg"
                    data-bs-toggle="modal"
                    data-bs-target="#enroll">Start The Enrollment</button> -->
                </div>
                <div class="col-lg-4 col-12 d-flex justify-content-center"> 
                   <img class="w-75 d-sm-block d-flex" src="{{ asset('/img/binay.jpg') }}" alt="Showcase Photo" style="border-radius: 50%">
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
                 <span class="text-uppercase" style="font-weight: 900 !important">I am pleased to extend my warmest greetings</span>
                 <p class="my-4 text-justify" style="font-family: Metropolis; "> 
                  to the graduating class of the University of Makati (UMak) for School Year 2021-2022.<br><br>
                  
                  Today marks a milestone in your life's journey, my dear Proud Makatizen graduates. It is time for you to reap the fruits of your hard work and perseverance in completing your studies amid an unprecedented crisis.<br><br>
                  
                  This year's commencement theme, "Celebrating our Past,  Igniting  our Future," reflects your readiness for bigger challenges and greater opportunities for growth.<br><br>
                  
                  As you begin your journey as a professional, may you remember with gratitude your parents and guardians whose unconditional love and support helped you surmount the obstacles. Your professors, university officials, and other school personnel also deserve to be acknowledged for ensuring that you leave the portals of UMak as individuals capable of succeeding in your respective fields.<br><br>
                  
                  Above all, honor and thank our Almighty God for His graces and guidance. Continue to glorify Him with your achievements and successes.<br><br>
                  
                  Congratulations to all! Mabuhay kayo!<br><br>
                  
                 </p>

                 <h3 style="font-family: Marcellus !important;"><br>Professor Ederson DT. Tapia, PhD. DPA</h3>
                 </div>
              
               </div>
             </div>
           </div>
        </section>
    </section>
    <script>
      $(function(){
        $(".navbar").attr("style","background-color: #052964"); 
      }); 
    </script>
@endsection