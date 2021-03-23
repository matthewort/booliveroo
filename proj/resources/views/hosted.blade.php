{{-- FORM PAGAMENTO --}}
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title></title>
    <style media="screen">
      #card-number,#cvv,#expiration-date{
        display: block;
        width: 100%;
        height: calc(1.6em + 0.75rem + 2px);
        padding: 0.375rem 0.75rem;
        font-size: 0.9rem;
        font-weight: 400;
        line-height: 1.6;
        color: #495057;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
      }

    </style>
  </head>
  <body class="prova">

  <div class="container hosted">


  @extends('layouts.main-layout')

    @if (session('success_message'))
      <div class="alert alert-success">
        {{session('success_message')}}
      </div>

    @endif

    @if (count($errors) > 0)
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors -> all() as $error) {{-- stampo tutti gli errori possibili che possono comparire --}}
            <li>{{$error}}</li>
          @endforeach
        </ul>
      </div>

    @endif


    <div class="row">

          <div class="col-md-8 order-md-1">
              <h4 class="mb-3">Billing address</h4>
              <form class="needs-validation" novalidate="" method="post" id="payment-form" action="{{url('/checkout')}}">
                @csrf
                  <div class="row">
                      <div class="col-md-6 mb-3">
                          <label for="firstName">First name</label>
                          <input id="firstName" name="firstName" type="text" class="form-control">
                          <div class="invalid-feedback"> Valid first name is required. </div>
                      </div>
                      <div class="col-md-6 mb-3">
                          <label for="lastName">Last name</label>
                          <input type="text" name="lastName" class="form-control" id="lastName" placeholder="" value="" required="">
                          <div class="invalid-feedback"> Valid last name is required. </div>
                      </div>
                  </div>

                  <div class="mb-3">
                      <label for="email">Email <span class="text-muted">(Optional)</span></label>
                      <input type="email" name="email" class="form-control" id="email" placeholder="you@example.com">
                      <div class="invalid-feedback"> Please enter a valid email address for shipping updates. </div>
                  </div>
                  <div class="mb-3">
                      <label for="address">Address</label>
                      <input type="text" name="extendedAddress" class="form-control" id="extendedAddress" placeholder="1234 Main St" required="">
                      <div class="invalid-feedback"> Please enter your shipping address. </div>
                  </div>

                  <hr class="mb-4">

                  <h4 class="mb-3">Payment</h4>
                  <label for="amount">
                      <span class="input-label">Amount</span>
                      <div class="input-wrapper amount-wrapper">
                          <input id="amount" name="amount" type="tel" value="{{\Cart::session('_token')->getTotal()}}" readonly>&euro;
                      </div>
                  </label>
                  <div class="d-block my-3">
                      <div class="custom-control custom-radio">
                          <input id="credit" name="paymentMethod" type="radio" class="custom-control-input" checked="" required="">
                          <label class="custom-control-label" for="credit">Credit card</label>
                      </div>
                      <div class="custom-control custom-radio">
                          <input id="debit" name="paymentMethod" type="radio" class="custom-control-input" required="">
                          <label class="custom-control-label" for="debit">Debit card</label>
                      </div>

                  </div>

                  <div class="row">
                      <div class="col-md-6 mb-3">
                          <label for="cc-name">Name on card</label>
                          <input type="text" class="form-control" id="cc-name" placeholder="" required="">
                          <small class="text-muted">Full name as displayed on card</small>
                          <div class="invalid-feedback"> Name on card is required </div>
                      </div>
                  </div>

                  <div class="row d-none">
                    <label for="amount">
                        <span class="input-label">Amount</span>
                        <div class="input-wrapper amount-wrapper">

                            @foreach ($cartItems as $item)
                              <input id="user_id" name="user_id" type="" value="{{$item -> associatedModel -> user_id}}" readonly>&euro;
                              @break
                            @endforeach
                        </div>

                    </label>

                    <label for="dishes[]">
                      @foreach ($cartItems as $item)
                        <input id="dish_id" type="" name="dishes[]" value="{{$item -> id}}">
                      @endforeach
                    </label>
                  </div>

                  <div class="row">

                    <div class="col-md-6">
                      <label for="cc-number">Credit card number</label>
                      <div id="card-number"class="form-group">
                      </div>
                    </div>

                    <div class="col-md-3">
                      <label for="cc-expiration">Expiration</label><br>
                      <div id="expiration-date"class="form-group">
                      </div>
                    </div>

                    <div class="col-md-3">
                      <label for="cc-cvv">CVV</label><br>
                      <div id="cvv" class="form-group">
                      </div>
                    </div>


                  </div>
                  <hr class="mb-4">
                  <input id="nonce" name="payment_method_nonce" type="hidden" />
                  <button class="btn btn-success btn-lg btn-block" type="submit">Checkout</button>
              </form>
          </div>
      </div>
  </div>

  </body>

  <script src="https://js.braintreegateway.com/web/3.73.1/js/client.min.js"></script>
    <script src="https://js.braintreegateway.com/web/3.73.1/js/hosted-fields.min.js"></script>
    <script>
      var form = document.querySelector('#payment-form');
      var submit = document.querySelector('input[type="submit"]');

      braintree.client.create({
        authorization: '{{$token}}'
      }, function (clientErr, clientInstance) {
        if (clientErr) {
          console.error(clientErr);
          return;
        }

        // This example shows Hosted Fields, but you can also use this
        // client instance to create additional components here, such as
        // PayPal or Data Collector.

        braintree.hostedFields.create({
          client: clientInstance,
          styles: {
            'input': {
              'font-size': '14px'
            },
            'input.invalid': {
              'color': 'red'
            },
            'input.valid': {
              'color': 'green'
            }
          },
          fields: {
            number: {
              selector: '#card-number',
              placeholder: '4111 1111 1111 1111'
            },
            cvv: {
              selector: '#cvv',
              placeholder: '123'
            },
            expirationDate: {
              selector: '#expiration-date',
              placeholder: '10/2022'
            }
          }
        }, function (hostedFieldsErr, hostedFieldsInstance) {
          if (hostedFieldsErr) {
            console.error(hostedFieldsErr);
            return;
          }

          form.addEventListener('submit', function (event) {
            event.preventDefault();

            hostedFieldsInstance.tokenize(function (tokenizeErr, payload) {
              if (tokenizeErr) {
                console.error(tokenizeErr);
                return;
              }

              // If this was a real integration, this is where you would
              // send the nonce to your server.
              // console.log('Got a nonce: ' + payload.nonce);
              document.querySelector('#nonce').value = payload.nonce;
              form.submit();
            });
          }, false);
        });
      });

  // Example starter JavaScript for disabling form submissions if there are invalid fields
  (function () {
    'use strict'

    window.addEventListener('load', function () {
      // Fetch all the forms we want to apply custom Bootstrap validation styles to
      var forms = document.getElementsByClassName('needs-validation')

      // Loop over them and prevent submission
      Array.prototype.filter.call(forms, function (form) {
          form.addEventListener('submit', function (event) {
            if (form.checkValidity() === false) {
              event.preventDefault()
              event.stopPropagation()
            }
            form.classList.add('was-validated')
          }, false)
      })
    }, false)
    }())
  </script>
</html>
