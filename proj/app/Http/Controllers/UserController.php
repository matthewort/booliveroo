<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Typology;

class UserController extends Controller
{
  public function show($id) {

    $user = User::findOrFail($id);

    return view('clientPage.user-show',compact('user'));
  }

  public function getTypologies(){
     $typologies = Typology::all();
     return response() -> json($typologies);
 }
 public function getUsers($id){
     $users = Typology::findOrFail($id) -> users() -> get() ;

     return response() ->json($users);
 }

 public function getRandUsers(){
    $users = User::all();
    return response() ->json($users);
 }

}
