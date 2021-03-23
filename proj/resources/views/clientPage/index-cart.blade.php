@extends('layouts.main-layout')
@section('contenuto-pagina')

{{-- PAGINA DEL CARRELLO --}}
<div class="container index-chart">

  <h2>Il tuo carrello</h2>

  <table>
      <table class="table">
          <thead>
              <tr>
                  <th>Nome</th>
                  <th>Prezzo</th>
                  <th>Quantità</th>
                  <th></th>
              </tr>
          </thead>
          <tbody>
  @foreach ($cartItems as $item)
              <tr>
                  <td scope="row">{{$item->name}}</td>
                  <td>
                      {{Cart::session('_token')->get($item->id) -> getPriceSum()}}&euro;
                  </td>
                  <td>
                      <form action="{{route('cart.update', $item->id)}}">
                          <input name ="quantity" type="number" value = {{$item->quantity}}>
                          <input type="submit" value = 'save'>
                      </form>

                  </td>
                  <td class="pt-3">
                      <a href="{{route('cart.destroy', $item -> id)}}"><i class="fas fa-times"></i></a>
                  </td>
              </tr>
  @endforeach
          </tbody>
      </table>
  </table>

  <h3>
      Total Price: {{\Cart::session('_token')->getTotal()}}&euro;
  </h3>

  <a class="btn btn-success mb-3 mt-2" href="{{url('/hosted')}}" role="button">Proceed to checkout</a>

</div>

@endsection
