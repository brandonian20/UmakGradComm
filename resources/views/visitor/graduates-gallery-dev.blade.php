@extends('components.layout')

@section('content')
<section class="graduates-bg-blur pt-100 pb-100">
  <div class="container">

    <section id="questions" class="pt-4 pb-30 mt-40">
      <div class="container">
        <div class="row">
          <div class="col-12 col-lg-3 d-flex justify-content-center align-items-center order-1">
            <img src="/pictures/image?id={{$data['insignia']}}" class="img-fluid  me-3 " style="max-width: 200px; max-height: 200px;">
          </div>
          <div class="col-12 col-lg-9 d-flex justify-content-center align-items-center order-2 ">
            <h1 class="mt-30 mt-lg-0 text-center text-lg-start text-light mb-0 fw-bold" style="font-family: 'Marcellus' !important;">{{$data['collegeName']}}</h2>
          </div>
        </div>
          
      </div>
  </section>

  @foreach($data['program'] as $prog)
    <section class="d-flex justify-content-center mb-30 w-100" id="{{ str_replace(" ", "%20", $prog['name']) }}">
      <div class="program_section w-100">
        <div class=" text-center bg-gradient bg-dark rounded-5" style="border-radius: 14px;">
          <div class="card-header row border-0 pb-0">
            <div class=" d-flex pt-4 justify-content-center" >
              <h3 class="text-light  m-0" style="font-family: 'Metropolis' !important;">{{$prog['name']}}</h2>
            </div>
          </div>
          <div class="card-body mt-0 p-30 pt-0 shape-parent">
            


            @foreach($prog['semester'] as $sem)

            
            <h4 class="text-light mt-30 mb-10 mb-0" style="font-family: 'Metropolis' !important;;">{{$sem['name']}}</h4>
            
              <div class="row justify-content-center isotope-grid gallery-wrapper animated ">

                @foreach($sem['graduates'] as $grad)
                  <div class="isotope-item  col-6 col-md-3 col-lg-2 p-5">
                    <a class="card card-portfolio gallery-item card-overlay card-hover-appearance text-white text-center rounded-4" href="{{$grad['banner'] == null ? "#" : "/pictures/image?id=".$grad['banner'] }}" style="border: 3px solid #d5ac44;">
                      <span class="card-img" data-img-height style="--img-height: 120%;">
                        <img loading="lazy" src="{{ $grad['image'] == null ? 'https://www.acstechnologies.com/church-growth/wp-content/uploads/sites/5/2020/06/Graduate_06.20_Blog_Image_Resize.jpg' : "/pictures/image?id=".$grad['image'] }}" alt="">
                        <span class="background-color" style="--background-color: rgba(0,0,0, 0.2);"></span>
                      </span>
                      <span class="card-img-overlay p-5"><span class="card-title h4">{{$grad['name']}}</span>
                      <span class="card-category"><small>{{$grad['honor']}}</small></span>
                    </a>
                  </div>

                @endforeach
              
              </div>
            @endforeach

          </div>
        </div>
      </div>
    </section>
  @endforeach

  </div>
    

  <!-- Modal -->
  <div class="modal fade" id="slide-deck" tabindex="-1" aria-labelledby="slide-deckLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" >
      <div class="modal-content">
        <div class="modal-body rounded" style="background-color: #d5ac44; padding: 0.5rem !important">
          <img id="slide-deck-img" src="" class="card-img-top  rounded img-fluid " alt="..."  style="max-width: 100%">
      </div>
    </div>
  </div>

  <script>
    // $(function(){
    //   $("a[data-bs-target='#slide-deck']").on("click", function(){
    //     $("#slide-deck-img").attr('src', $(this).attr('data-slide-img'));
    //   });
    // })
  </script>

</section>
@endsection