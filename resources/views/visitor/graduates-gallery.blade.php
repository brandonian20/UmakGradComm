@extends('components.layout')

@section('content')
<section class="graduates-bg pt-100 pb-100">
    <section id="questions" class="pt-4">
        <div class="container">
            <div class="d-flex justify-content-center">
                <img src="http://127.0.0.1:8000/img/ccis-logo.png" class="img-fluid  me-3 " style="width: 100px;">
            </div>
            <div class="">
                <h1 class="text-center mb-4 text-light mt-3" style="font-family: Marcellus;">College of Computing and Information Sciences</h2>
            </div>
        </div>
    </section>

  <!-- PROGRAM -->
   <section class=" d-flex justify-content-center mb-3  " style="width:100%; ">
    <div class="program_section " >
      <div class="">
        <div class="card text-center bg-dark rounded-5" >
          <div class="card-header row border-0">
            <div class=" d-flex pt-4 justify-content-center" >
              <h3 class="text-light  " style="font-family: Marcellus;">Bachelor of Science in Computer Science Major in Application Development</h2>
            </div>
          </div>
          <div class="card-body mt-0" >
            <a data-bs-toggle="modal" data-bs-target="#slide-deck"><img src="{{ asset('/img/sample.jpg') }}" class="card-img-top mx-2 mb-3 rounded grad_pic"  alt="..." ></a>
            <a data-bs-toggle="modal" data-bs-target="#slide-deck"><img src="{{ asset('/img/sample.jpg') }}" class="card-img-top mx-2 mb-3 rounded grad_pic"  alt="..." ></a>
            <a data-bs-toggle="modal" data-bs-target="#slide-deck"><img src="{{ asset('/img/sample.jpg') }}" class="card-img-top mx-2 mb-3 rounded grad_pic"  alt="..." ></a>
            <a data-bs-toggle="modal" data-bs-target="#slide-deck"><img src="{{ asset('/img/sample.jpg') }}" class="card-img-top mx-2 mb-3 rounded grad_pic"  alt="..." ></a>
            <a data-bs-toggle="modal" data-bs-target="#slide-deck"><img src="{{ asset('/img/sample.jpg') }}" class="card-img-top mx-2 mb-3 rounded grad_pic"  alt="..." ></a>
            <a data-bs-toggle="modal" data-bs-target="#slide-deck"><img src="{{ asset('/img/sample.jpg') }}" class="card-img-top mx-2 mb-3 rounded grad_pic"  alt="..." ></a>
            <a data-bs-toggle="modal" data-bs-target="#slide-deck"><img src="{{ asset('/img/sample.jpg') }}" class="card-img-top mx-2 mb-3 rounded grad_pic"  alt="..." ></a>
            <a data-bs-toggle="modal" data-bs-target="#slide-deck"><img src="{{ asset('/img/sample.jpg') }}" class="card-img-top mx-2 mb-3 rounded grad_pic"  alt="..." ></a>
            <a data-bs-toggle="modal" data-bs-target="#slide-deck"><img src="{{ asset('/img/sample.jpg') }}" class="card-img-top mx-2 mb-3 rounded grad_pic"  alt="..." ></a>
            <a data-bs-toggle="modal" data-bs-target="#slide-deck"><img src="{{ asset('/img/sample.jpg') }}" class="card-img-top mx-2 mb-3 rounded grad_pic"  alt="..." ></a>
            <a data-bs-toggle="modal" data-bs-target="#slide-deck"><img src="{{ asset('/img/sample.jpg') }}" class="card-img-top mx-2 mb-3 rounded grad_pic"  alt="..." ></a>
            <a data-bs-toggle="modal" data-bs-target="#slide-deck"><img src="{{ asset('/img/sample.jpg') }}" class="card-img-top mx-2 mb-3 rounded grad_pic"  alt="..." ></a>
            <a data-bs-toggle="modal" data-bs-target="#slide-deck"><img src="{{ asset('/img/sample.jpg') }}" class="card-img-top mx-2 mb-3 rounded grad_pic"  alt="..." ></a>
            <a data-bs-toggle="modal" data-bs-target="#slide-deck"><img src="{{ asset('/img/sample.jpg') }}" class="card-img-top mx-2 mb-3 rounded grad_pic"  alt="..." ></a>
            <a data-bs-toggle="modal" data-bs-target="#slide-deck"><img src="{{ asset('/img/sample.jpg') }}" class="card-img-top mx-2 mb-3 rounded grad_pic"  alt="..." ></a>
            <a data-bs-toggle="modal" data-bs-target="#slide-deck"><img src="{{ asset('/img/sample.jpg') }}" class="card-img-top mx-2 mb-3 rounded grad_pic"  alt="..." ></a>
            <a data-bs-toggle="modal" data-bs-target="#slide-deck"><img src="{{ asset('/img/sample.jpg') }}" class="card-img-top mx-2 mb-3 rounded grad_pic"  alt="..." ></a>

            <!-- <a data-bs-toggle="modal" data-bs-target="#slide-deck"><img src="elias.jpg" class="card-img-top mx-2 mb-3 rounded grad_pic"  alt="..." ></a>
            <a data-bs-toggle="modal" data-bs-target="#slide-deck"><img src="elias.jpg" class="card-img-top mx-2 mb-3 rounded grad_pic"  alt="..." ></a>
            <a data-bs-toggle="modal" data-bs-target="#slide-deck"><img src="elias.jpg" class="card-img-top mx-2 mb-3 rounded grad_pic"  alt="..." ></a>
            <a data-bs-toggle="modal" data-bs-target="#slide-deck"><img src="elias.jpg" class="card-img-top mx-2 mb-3 rounded grad_pic"  alt="..." ></a>
            <a data-bs-toggle="modal" data-bs-target="#slide-deck"><img src="elias.jpg" class="card-img-top mx-2 mb-3 rounded grad_pic"  alt="..." ></a>
            <a data-bs-toggle="modal" data-bs-target="#slide-deck"><img src="elias.jpg" class="card-img-top mx-2 mb-3 rounded grad_pic"  alt="..." ></a>
            <a data-bs-toggle="modal" data-bs-target="#slide-deck"><img src="elias.jpg" class="card-img-top mx-2 mb-3 rounded grad_pic"  alt="..." ></a>
            <a data-bs-toggle="modal" data-bs-target="#slide-deck"><img src="elias.jpg" class="card-img-top mx-2 mb-3 rounded grad_pic"  alt="..." ></a>
            <a data-bs-toggle="modal" data-bs-target="#slide-deck"><img src="elias.jpg" class="card-img-top mx-2 mb-3 rounded grad_pic"  alt="..." ></a>
            <a data-bs-toggle="modal" data-bs-target="#slide-deck"><img src="elias.jpg" class="card-img-top mx-2 mb-3 rounded grad_pic"  alt="..." ></a>
            <a data-bs-toggle="modal" data-bs-target="#slide-deck"><img src="elias.jpg" class="card-img-top mx-2 mb-3 rounded grad_pic"  alt="..." ></a>
            <a data-bs-toggle="modal" data-bs-target="#slide-deck"><img src="elias.jpg" class="card-img-top mx-2 mb-3 rounded grad_pic"  alt="..." ></a>
            <a data-bs-toggle="modal" data-bs-target="#slide-deck"><img src="elias.jpg" class="card-img-top mx-2 mb-3 rounded grad_pic"  alt="..." ></a>
            <a data-bs-toggle="modal" data-bs-target="#slide-deck"><img src="elias.jpg" class="card-img-top mx-2 mb-3 rounded grad_pic"  alt="..." ></a>
            <a data-bs-toggle="modal" data-bs-target="#slide-deck"><img src="elias.jpg" class="card-img-top mx-2 mb-3 rounded grad_pic"  alt="..." ></a>
            <a data-bs-toggle="modal" data-bs-target="#slide-deck"><img src="elias.jpg" class="card-img-top mx-2 mb-3 rounded grad_pic"  alt="..." ></a>
            <a data-bs-toggle="modal" data-bs-target="#slide-deck"><img src="elias.jpg" class="card-img-top mx-2 mb-3 rounded grad_pic"  alt="..." ></a>
            <a data-bs-toggle="modal" data-bs-target="#slide-deck"><img src="elias.jpg" class="card-img-top mx-2 mb-3 rounded grad_pic"  alt="..." ></a>
            <a data-bs-toggle="modal" data-bs-target="#slide-deck"><img src="elias.jpg" class="card-img-top mx-2 mb-3 rounded grad_pic"  alt="..." ></a>
            <a data-bs-toggle="modal" data-bs-target="#slide-deck"><img src="elias.jpg" class="card-img-top mx-2 mb-3 rounded grad_pic"  alt="..." ></a>
            <a data-bs-toggle="modal" data-bs-target="#slide-deck"><img src="elias.jpg" class="card-img-top mx-2 mb-3 rounded grad_pic"  alt="..." ></a>
            <a data-bs-toggle="modal" data-bs-target="#slide-deck"><img src="elias.jpg" class="card-img-top mx-2 mb-3 rounded grad_pic"  alt="..." ></a>
            <a data-bs-toggle="modal" data-bs-target="#slide-deck"><img src="elias.jpg" class="card-img-top mx-2 mb-3 rounded grad_pic"  alt="..." ></a>
            <a data-bs-toggle="modal" data-bs-target="#slide-deck"><img src="elias.jpg" class="card-img-top mx-2 mb-3 rounded grad_pic"  alt="..." ></a>
            <a data-bs-toggle="modal" data-bs-target="#slide-deck"><img src="elias.jpg" class="card-img-top mx-2 mb-3 rounded grad_pic"  alt="..." ></a>
            <a data-bs-toggle="modal" data-bs-target="#slide-deck"><img src="elias.jpg" class="card-img-top mx-2 mb-3 rounded grad_pic"  alt="..." ></a>
            <a data-bs-toggle="modal" data-bs-target="#slide-deck"><img src="elias.jpg" class="card-img-top mx-2 mb-3 rounded grad_pic"  alt="..." ></a>
            <a data-bs-toggle="modal" data-bs-target="#slide-deck"><img src="elias.jpg" class="card-img-top mx-2 mb-3 rounded grad_pic"  alt="..." ></a>
            <a data-bs-toggle="modal" data-bs-target="#slide-deck"><img src="elias.jpg" class="card-img-top mx-2 mb-3 rounded grad_pic"  alt="..." ></a>
            <a data-bs-toggle="modal" data-bs-target="#slide-deck"><img src="elias.jpg" class="card-img-top mx-2 mb-3 rounded grad_pic"  alt="..." ></a>
            <a data-bs-toggle="modal" data-bs-target="#slide-deck"><img src="elias.jpg" class="card-img-top mx-2 mb-3 rounded grad_pic"  alt="..." ></a>
            <a data-bs-toggle="modal" data-bs-target="#slide-deck"><img src="elias.jpg" class="card-img-top mx-2 mb-3 rounded grad_pic"  alt="..." ></a>
-->

          </div>
          <!-- <div class=" card-footer text-muted border-0">
            <h6>@Batch 2022<h6>
          </div> -->
        </div>
      </div>
    </div>
  </section>

  <!-- Modal -->
  <div class="modal fade" id="slide-deck" tabindex="-1" aria-labelledby="slide-deckLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" >
      <div class="modal-content">
        <div class="modal-body" style="background-color: #d5ac44; padding: 0.5rem !important">
          <img src="{{ asset('/img/slide-deck.png') }}" class="card-img-top  rounded img-fluid " alt="..."  style="max-width: 100%">
      </div>
    </div>
  </div>
</section>
@endsection