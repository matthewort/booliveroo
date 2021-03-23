@extends('layouts.main-layout')
@section('contenuto-pagina')
{{-- MODIFICO IL PIATTO --}}
  <form class="form-group mt-4" action="{{ route('dish-update', $dish -> id)}}" method="post">
    @csrf
    @method('post')

    <label for="name">Name</label>
    <input type="text" name="name" value="{{ $dish -> name}}" class="form-control mb-3 @error('name') is-invalid @enderror">
      @error('name')
         <span class="invalid-feedback" role="alert">
             <strong>{{ $message }}</strong>
         </span>
      @enderror
    <label for="ingredients">Ingredients</label>
    <textarea  type="text" name="ingredients" value="{{ $dish -> ingredients}}" class="form-control mb-3 @error('ingredients') is-invalid @enderror">{{ $dish -> ingredients}}</textarea>
      @error('ingredients')
         <span class="invalid-feedback" role="alert">
             <strong>{{ $message }}</strong>
         </span>
      @enderror
    <label for="price">Price</label>
    
    <input type="text" name="price" value="{{ $dish -> price}}" class="form-control mb-3 @error('price') is-invalid @enderror">
      @error('price')
         <span class="invalid-feedback" role="alert">
             <strong>{{ $message }}</strong>
         </span>
      @enderror

    <div class="form-check mt-2">

      <input checked class="form-check-input" type="radio" name="visible"
        @if ($dish -> visible == 1) {{-- per lasciare visibile il check rispetto a quanto abbiamo selezionato --}}
         checked 
       @endif value="1">
      <label for="visible" class="form-check-label" >Visible</label>

    </div>
    <div class="form-check mt-2">

      <input class="form-check-input" type="radio" name="visible"
        @if ($dish -> visible == 0) {{-- per lasciare non visibile il check rispetto a quanto abbiamo selezionato --}}
         checked
       @endif value="0">
      <label for="visible" class="form-check-label" >Not Visible</label>

    </div>

    <input type="submit" name="" value="salva" class="btn btn-success mt-3 mb-4">

  </form>

@endsection
