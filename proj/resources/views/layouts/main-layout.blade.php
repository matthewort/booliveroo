<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Booliveroo</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="{{ asset('js/app.js') }}"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>
  <body>

    {{-- <div class="container"> --}}

      <!-- header -->
      @include('components.header')
    <div id="app">
        @yield('contenuto-pagina')
    </div>
    @yield('chart')
      <!-- contenuto pagina -->
      {{-- @yield('test') --}}
    {{-- </div> --}}

    {{-- creare contenitore per il footer --}}
    <div class="container1">
      <!-- footer -->
      @include('components.footer')
    </div>

    @yield('script')

  </body>
</html>
