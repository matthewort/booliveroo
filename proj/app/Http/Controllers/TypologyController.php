<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Typology;
use App\User;

class TypologyController extends Controller
{


  /// funzioni per visualizzare ristoranti
  public function clientSearch(){
        return view('clientPage.client-index');
    }
    public function showMenu($id){
        $user = User::findOrFail($id);
        return view('clientPage.user-show' ,compact('user'));
    }

}
