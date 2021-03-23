<header>

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{-- {{ config('app.name', 'BOOLIVEROO') }} --}}
            <img src="http://localhost:8000/storage/logos/logo2.png" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                {{-- <a href="{{route('cart.index')}}" class="nav-link"><i class="fas fa-shopping-cart"></i>

                    <div class="badge">
                        {{Cart::session('_token') -> getTotalQuantity()}}
                    </div>

                </a> --}}
                <!-- Authentication Links -->
                @guest
                    <a href="{{route('cart.index')}}" class="nav-link"><i class="fas fa-shopping-cart"></i>

                        <div class="badge">
                            {{Cart::session('_token') -> getTotalQuantity()}}
                        </div>

                    </a>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                  {{-- <div class="card-body">
                      @if (session('status'))
                          <div class="alert alert-success" role="alert">
                              {{ session('status') }}
                          </div>
                      @endif --}}

                      {{-- {{ __('You are logged in!') }} --}}
                  {{-- </div> --}}
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle " href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-right bg-dark" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <a class="dropdown-item" href="{{ route('home')}}">Profilo</a>
                            <a class="dropdown-item" href="{{ route('dish-index')}}">Vedi il menu</a>
                            <a class="dropdown-item" href="{{route('order-index')}}">Mostrami gli ordini</a>


                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>

                @endguest
            </ul>
        </div>
    </div>
  </nav>


</header>
