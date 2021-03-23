<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use App\Typology;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'indirizzo' => ['required' ,'string','max:255'],
            'piva' => ['required','string','min:11','max:11','digits:11','unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'typologies' => ['required']
        ]);

        // prova commento
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
      $user = User::create([
          'name' => $data['name'],
          'email' => $data['email'],
          'indirizzo' => $data['indirizzo'],
          'img' => 'default-logo.jpg',
          'piva' => $data['piva'],
          'password' => Hash::make($data['password']),
      ]);

        $typologies = Typology::findOrFail($data['typologies']);
        $user -> typologies() -> attach($typologies);

      return $user;
    }
}
