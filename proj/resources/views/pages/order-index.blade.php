@extends('layouts.main-layout')
@section('chart')
{{-- LISTA ORDINI RISTORATORI CON GRAFICO --}}

  <div class="container order-index text-center">

    <a href="{{route('home')}}" class="btn mb-3 px-5">Torna alla home <i class="fas fa-home"></i></a>
    <h1 class="text-center  mb-3">Ordini Ricevuti</h1>

    <div class="row row-cols-1 row-cols-sm-1 row-cols-md-2 row-cols-lg-2">

        @foreach ($user -> orders as $order)

                <div class="col mb-4 card-group">
                    <div class="card">
                        <div class="card-header text-center text-white bg-dark">
                            Cliente: {{$order -> name}} {{$order -> lastname}}
                        </div>
                        <div class="card-body text-dark text-left">
                            <h5 class="card-title text-center">Informazioni utili:</h5>

                            <p class="card-text">
                                <u><strong>Indirizzo:</strong></u> {{$order -> address}}
                            </p>

                            <p class="card-text">
                                <u><strong>Mail:</strong></u> {{$order -> email}}
                            </p>

                            <p>
                              <u><strong>Piatti Ordinati:</strong></u>
                            </p>

                            @foreach ($order -> dishes as $dish)
                              <p>{{$dish -> name}} {{$dish -> price}}&euro;</p>
                            @endforeach

                            <p class="card-text">
                                <u><strong>Totale ordine:</strong></u> {{$order -> price}}&euro;
                            </p>
                        </div>
                        <div class="card-footer text-center text-white bg-dark">
                            Data dell'ordine: {{$order -> created_at}}
                        </div>
                    </div>
                </div>

        @endforeach
    </div>
    
  </div>


    {{-- grafico --}}
    <div class="container mb-3 bg-white">
        <canvas id="myChart"></canvas>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>

    <script>
        let myChart = document.getElementById('myChart').getContext('2d');
        let masPopChart = new Chart(myChart, {
            // The type of chart we want to create
            type: 'bar',

            // The data for our dataset
            data: {
                labels: ['Gennaio', 'Febbraio', 'Marzo', 'Aprile', 'Maggio', 'Giugno', 'Luglio', 'Agosto', ' Settembre', 'Ottobre', 'Novembre', 'Dicembre'],
                datasets: [{
                    label: 'Ordini per mese',
                    backgroundColor: '#92D293',
                    borderColor: 'rgb(255, 99, 132)',
                    data: [
                        {{$chart_gen}},
                        {{$chart_feb}},
                        {{$chart_mar}},
                        {{$chart_apr}},
                        {{$chart_mag}},
                        {{$chart_giu}},
                        {{$chart_lug}},
                        {{$chart_ago}},
                        {{$chart_set}},
                        {{$chart_ott}},
                        {{$chart_nov}},
                        {{$chart_dic}}

                    ]
                }]
            },

            // Configuration options go here
            options: { }
        });
    </script>
@endsection
