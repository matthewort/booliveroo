<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

use App\Order;
use App\User;
use App\Dish;
use App\Typology;
// use App\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    // prendiamo user registrato e le tipologie
    {
      $user = Auth::user();
      $typologies = Typology::all();
      return view('home',compact('user','typologies'));
    }

    public function dishIndex() {
      // prendiamo tutti i piatti
      $user = Auth::user();
      $dishes = Dish::all();
      return view('pages.dish-index',compact('dishes', 'user'));
    }

    public function dishCreate() {
      // visulizzare pagina crea piatto
      return view('pages.dish-create');
    }

    public function dishShow($id) {
      // visualizzare pagina piatto
      $dish = Dish::findOrFail($id);
      return view('pages.dish-show',compact('dish'));
    }

    public function dishStore(Request $request) {
      // inseriamo il nuovo piatto creato nel database associato
      // all'utente loggato
      $data = $request -> all(); // dati inseriti nel form
      Validator::make($data,
        [
            'name' => 'required|string|min:4|max:50',
            'ingredients' => 'required|string',
            'price' => 'required|numeric',
        ],
        [
            'name.min' => 'Minimo 4 caratteri per il nome',
            'name.required' => 'Campo obbligatorio',
            'ingredients.required' => 'Campo obbligatorio',
            'price.required' => 'Campo obbligatorio',
            'price.numeric' => 'Inserire un valore numerico',

        ])
        ->validate();

      $user = Auth::user(); // utente loggato

      $newDish = Dish::make($data); // $newDish = dati inseriti
      $newDish -> user() -> associate($user); // associamo il piatto creato all'utente loggato.
      $newDish -> save(); // salviamo il piatto creato.

      return redirect() -> route('dish-index');
    }

    public function dishEdit($id) {
      // possibilità di modificare i piatti del menu all'utente
      //registrato
      $dish = Dish::findOrFail($id);
      return view('pages.dish-edit',compact('dish'));
    }

    public function dishUpdate(Request $request, $id) {
      // aggiorniamo la modifica del piatto
      $data = $request -> all();
      Validator::make($data,
        [
            'name' => 'required|string|min:4|max:50',
            'ingredients' => 'required|string',
            'price' => 'required|numeric',
        ],
        [
            'name.min' => 'Minimo 4 caratteri per il nome',
            'name.required' => 'Campo obbligatorio',
            'ingredients.required' => 'Campo obbligatorio',
            'price.required' => 'Campo obbligatorio',
            'price.numeric' => 'Inserire un valore numerico',

        ])
        ->validate();
        $dish = Dish::findOrFail($id);
        $dish -> update($request -> all());
      return redirect() -> route('dish-index');

    }

      public function dishDelete($id) {
      // cancellazione del piatto
      $dish = Dish::findOrFail($id);

      $dish -> delete();

      return redirect() -> route('dish-index');

    }

    public function orderIndex(){
      $user = Auth::user();
      $orders = Order::all();
      
      $chart_gen=DB::table('orders')->select('count(user_id)')->where('user_id', '=', $user->id)->whereMonth('orders.created_at', '=', 01)->count();
      $chart_feb=DB::table('orders')->select('count(user_id)')->where('user_id', '=', $user->id)->whereMonth('orders.created_at', '=', 02)->count();
      $chart_mar=DB::table('orders')->select('count(user_id)')->where('user_id', '=', $user->id)->whereMonth('orders.created_at', '=', 03)->count();
      $chart_apr=DB::table('orders')->select('count(user_id)')->where('user_id', '=', $user->id)->whereMonth('orders.created_at', '=', 04)->count();
      $chart_mag=DB::table('orders')->select('count(user_id)')->where('user_id', '=', $user->id)->whereMonth('orders.created_at', '=', 05)->count();
      $chart_giu=DB::table('orders')->select('count(user_id)')->where('user_id', '=', $user->id)->whereMonth('orders.created_at', '=', 06)->count();
      $chart_lug=DB::table('orders')->select('count(user_id)')->where('user_id', '=', $user->id)->whereMonth('orders.created_at', '=', 07)->count();
      $chart_ago=DB::table('orders')->select('count(user_id)')->where('user_id', '=', $user->id)->whereMonth('orders.created_at', '=', 8)->count();
      $chart_set=DB::table('orders')->select('count(user_id)')->where('user_id', '=', $user->id)->whereMonth('orders.created_at', '=', 9)->count();
      $chart_ott=DB::table('orders')->select('count(user_id)')->where('user_id', '=', $user->id)->whereMonth('orders.created_at', '=', 10)->count();
      $chart_nov=DB::table('orders')->select('count(user_id)')->where('user_id', '=', $user->id)->whereMonth('orders.created_at', '=', 11)->count();
      $chart_dic=DB::table('orders')->select('count(user_id)')->where('user_id', '=', $user->id)->whereMonth('orders.created_at', '=', 12)->count();

      return view('pages.order-index',compact('orders', 'user', 'chart_gen', 'chart_feb', 'chart_mar', 'chart_apr', 'chart_mag', 'chart_giu', 'chart_lug', 'chart_ago', 'chart_set', 'chart_ott', 'chart_nov', 'chart_dic'));
    }

    //// TEST UPLOAD IMG
    public function updateImg(Request $request) {
      $request -> validate([
         'img' => 'required|file|dimensions:ratio=16/9'
      ]);


      $image = $request -> file('img');

      $ext = $image -> getClientOriginalExtension();
      $name = rand(100000,999999). '_' . time();
      $file = $name . '.'. $ext;

      $user = Auth::user();
      $user -> img = $file;
      $user -> save();

      $fileStore = $image -> storeAs('img', $file ,'public');

      return redirect() -> back();

    }
    public function clearImg() {

      $this -> deleteImg();

      $user = Auth::user();
      $user -> img = null;
      $user -> save();
      return redirect() -> back();
    }

    public function deleteImg() {

      $user = Auth::user();

      try {

        $fileName = $user -> img;

        $file = storage_path('app/public/img/' . $fileName);
        File::delete($file);

      } catch (\Exception $e) {}
    }

}
