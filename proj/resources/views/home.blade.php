<!--PAGINA DI AVVENUTA REGISTRAZIONE-->
@extends('layouts.main-layout')

@section('contenuto-pagina')

<div class="container home d-flex justify-content-center">

  <div class="card mb-5 mt-4" style="width: 50%;">
    <div class="p-3">
      @if (Auth::user()-> img) <!--inserisco l'immagine del ristoratore, deve essere l'img dello user registrato-->
        <img class="card-img-top img-fluid max-width: 100%" src="http://localhost:8000/storage/img/{{ $user -> img}}">
      @endif
    </div>
      <div class="card-body">
        <h4 class="card-title">Benvenuto {{ $user -> name}}</h4>
        <p class="card-text">Mail: {{ $user -> email }}</p>
        <p class="card-text">Address: {{ $user -> indirizzo }}</p>
        <p class="card-text">Piva: {{ $user -> piva }}</p>
        <p class="card-text">
          Tiopolgie:
          @foreach ($user -> typologies as $typology)
            &#174;{{ $typology -> type}}
          @endforeach
        </p>

        @if ($errors->any()) <!--frase di errore-->
          <div class="alert alert-danger d-flex justify-content-center align-items-center">
            @foreach ($errors->all() as $error) <!--cicla tutti gli errori e li stampa tutti-->
              <p class="mb-0">{{ $error }}</p>
            @endforeach
          </div>
        @endif

        {{-- inserimento immagine profilo --}}
        <form class="" action="{{ route('upload-img')}}" method="post" enctype="multipart/form-data">
          @csrf
          @method('post')

          <input type="file" class="form-control border-0 p-0" name="img" value="">
          <p>*inserire un'immagine in 16/9 e max 1920 x 1080</p>
          {{-- contenitore bottoni --}}
          <div class="d-flex justify-content-center">
            <button type="submit" class=" mr-1 btn bg-dark text-white px-5" name="" value="Update">Update <i class="fas fa-upload"></i></button>
          </div>

        </form>
    </div>
  </div>

</div>


@endsection
