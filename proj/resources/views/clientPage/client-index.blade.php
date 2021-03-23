@extends('layouts.main-layout')
@section('contenuto-pagina')
<!--PAGINA INDEX RISTORANTI E TIPOLOGIE-->
  <div class="container vh-80 my-5 client-index" id="grand">

    {{-- Back to Typologies button --}}
    <div v-if="showUser" @click="showUser = !showUser"> <!--come scritto us app.js showUser parte come false, al click scompare la pagina delle tipologie e compaiono i ristoranti della tipologia cliccata, se è false appaiono le tipologie, se è true appaiono i ristoranti per ogni tipologia-->
      <i class="fas fa-arrow-left" id="backArrow"></i>
    </div>

    <section>
      {{-- se !showUser --}}
        {{-- row --}}
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4">
          {{-- colonna --}}
          <div class="col mb-4" v-for="typology in allTypologies" style="width: 18rem;" v-if="!showUser">
            {{-- card tipologia --}}
            <div class="card text-center">
              {{-- logo tipologia --}}
              <img class="card-img-top" :src="typology.logo" alt="Card image cap">
              <div class="card-body">
                {{-- nome tipologia --}}
                <h5 class="card-title mb-0"><strong>@{{typology.type.toUpperCase()}}</strong></h5>
              </div>
              <div class="card-footer bg-dark">
                {{-- bottone per vedere ristoratnti --}}
                <button type="button" class="btn" @click="getRestaurant(typology.id)"><span>Scopri i Ristoranti</span></button>
              </div>
            </div>
          </div>
        </div> 

        {{-- se showUser --}}
        <div v-if="showUser" class="row text-center row-cols-1 row-cols-sm-1 row-cols-md-2 row-cols-lg-3 card-group">
          <div  v-for="user in userArray" class="col pb-1">
            <div class="card mb-4">
              <img class="card-img-top" :src="'http://localhost:8000/storage/img/' + user.img" alt="Not found image">
              <div class="card-body">
                <h5 class="card-title"><strong>@{{user.name.toUpperCase()}}</strong></h5>
                <p class="card-text">@{{user.indirizzo}}</p>
              </div>
              <div class="card-footer bg-dark">
                <a :href=`{{route('show-menu','')}}/${user.id}` class="btn text-light"><span>Scopri il Menu</span></a>
              </div>
            </div>
          </div>
        </div>

    </section>
  </div>
@endsection
