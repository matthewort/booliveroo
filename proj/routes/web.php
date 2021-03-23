<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Order;
use App\Dish;

// rotta per pagina Welcome
Route::get('/', function () {
    return view('welcome');
});

//prova

//Ricerca avanzata
Route::get('/live_search', 'LiveSearch@index') -> name('live_search');
Route::get('/live_search/action', 'LiveSearch@action')->name('live_search.action');

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');


//// HOME CONTROLLER USER REGISTRATO ///////////

// rotta per tornare alla home
Route::get('/home', 'HomeController@index')->name('home');

// rotta per lista piatti
Route::get('/dish/index','HomeController@dishIndex')->name('dish-index');

// rotta per visulizzare il piatto selezionato
Route::get('/dish/show/{id}','HomeController@dishShow')->name('dish-show');

// rotta per creare e storare il piatto creato
Route::get('/dish/create','HomeController@dishCreate')->name('dish-create');
Route::post('/dish/store/','HomeController@dishStore')->name('dish-store');

// rotta per modificare e fare l'update del piatto
Route::get('/dish/edit/{id}' ,'HomeController@dishEdit')->name('dish-edit');
Route::post('/dish/update/{id}', 'HomeController@dishUpdate')->name('dish-update');

// rotta per eliminare il piatto
Route::get('/dish/delete/{id}','HomeController@dishDelete')->name('dish-delete');

// rotta mostrare tutti gli ordini dell'utente registrato
Route::get('/order/index', 'HomeController@orderIndex')->name('order-index');

/////////ROTTE PER CHIAMATA AXIOS //////////////

Route::get('/getTypologies' , 'UserController@getTypologies')
    ->name('get-typologies');

Route::get('/getUserId/{id}' , 'UserController@getUsers')
    ->name('get-users');

Route::get('/getRandUsers','UserController@getRandUsers')
    ->name('get-rand-users');


///////////// ROTTE PER RICERCA CLIENTE ///////////

Route::get('/clientSearch', 'TypologyController@clientSearch')
    ->name('clientSearch');
Route::get('/restaurant/{id}' , 'TypologyController@showMenu')
    ->name('show-menu');

///////// ROTTE PER ULOAD IMG ///////////

Route::post('/uploadImg','HomeController@updateImg')
    ->name('upload-img');

Route::get('/clearImg','HomeController@clearImg')
    ->name('clear-img');


///////// ROTTA PAYMENT ///////////
Route::get('/hosted', function () {
$gateway = new Braintree\Gateway([
  'environment' => config('services.braintree.environment'),
  'merchantId' => config('services.braintree.merchantId'),
  'publicKey' => config('services.braintree.publicKey'),
  'privateKey' => config('services.braintree.privateKey')
]);

$token = $gateway->ClientToken()->generate();
$cartItems = \Cart::session('_token') -> getContent();

$cartItems = \Cart::session('_token') -> getContent();

return view('hosted',compact('cartItems'), [
    'token' => $token
  ]);

});

Route::post('/checkout', function (Request $request){

$gateway = new Braintree\Gateway([
  'environment' => config('services.braintree.environment'),
  'merchantId' => config('services.braintree.merchantId'),
  'publicKey' => config('services.braintree.publicKey'),
  'privateKey' => config('services.braintree.privateKey')
]);
$amount = $request->amount;
$nonce = $request->payment_method_nonce;
$firstName = $request->firstName;
$lastName = $request->lastName;
$email = $request->email;
$address = $request->extendedAddress;
$userId = $request->user_id;

$result = $gateway->transaction()->sale([
  'amount' => $amount,
  'paymentMethodNonce' => $nonce,
  'customer' => [
    'firstName'=> $firstName,
    'lastName' => $lastName,
    'email'=> $email,
  ],
  'options'=> [
    'submitForSettlement' => true
  ]
]);

if ($result->success) {
    $transaction = $result->transaction;
    Cart::clear();
    Cart::session('_token')->clear();

    $newOrder = new Order;
    $newOrder -> user_id = $userId;
    $newOrder -> name = $firstName;
    $newOrder -> lastname = $lastName;
    $newOrder -> email = $email;
    $newOrder -> address = $address;
    $newOrder -> status = 1;
    $newOrder -> price = $amount;
    $newOrder -> save();


    $newOrder->dishes()->attach($request['dishes']);
    $newOrder->save();

    return redirect()->back()->with('success_message', 'Transaction succesful. The Id is :' . $transaction->id);

} else {
    $errorString = "";

    foreach($result->errors->deepAll() as $error) {
        $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
    }

      return back()->withErrors('An error occured with the message: ' . $result->message);
}
});

//////// ROTTA CARRELLO/////////

Route::get('/add-to-cart/{dish}', 'CartController@add')->name('cart.add');

Route::get('/cart', 'CartController@index')->name('cart.index');

Route::get('/cart/destroy/{itemId}', 'CartController@destroy')->name('cart.destroy');

Route::get('/cart/update/{itemId}', 'CartController@update')->name('cart.update');
