@extends('layouts.main-layout')
@section('contenuto-pagina')
{{-- CREAZIONE DEL PIATTO --}}

  <form class="form-group mt-4" action="{{ route('dish-store')}}" method="post">
    @csrf
    @method('post')

    <label for="name">Name</label>
    <input type="text" name="name" value="" class="form-control mb-3 @error('name') is-invalid @enderror"  placeholder="Enter name">
    @error('name')
       <span class="invalid-feedback" role="alert">
           <strong>{{ $message }}</strong>
       </span>
    @enderror
    <label for="ingredients">Ingredients</label>
    <textarea type="text" name="ingredients" value="" class=" form-control mb-3 @error('ingredients') is-invalid @enderror" placeholder="Enter ingredients"></textarea>
    @error('ingredients')
       <span class="invalid-feedback" role="alert">
           <strong>{{ $message }}</strong>
       </span>
    @enderror
    <label for="price">Price</label>
    <input type="text" name="price" value="" class=" form-control mb-3 @error('price') is-invalid @enderror" placeholder="Enter price">
    @error('price')
       <span class="invalid-feedback" role="alert">
           <strong>{{ $message }}</strong>
       </span>
    @enderror

    <div class="form-check mt-2">

      <input checked type="radio" name="visible" value="1" class="form-check-input"> {{-- il piatto creato parte come visibile di default --}} 
      <label for="visible" class="form-check-label">Visible</label>

    </div>

    <div class="form-check mt-2">

      <input type="radio" name="visible" value="0" class="form-check-input">
      <label for="visible" class="form-check-label">Not Visible</label>

    </div>

    <input type="submit" name="" value="Salva" class="btn btn-success mt-3 mb-4">

  </form>

@endsection
