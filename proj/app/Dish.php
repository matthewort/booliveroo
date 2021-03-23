<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
  // inseriamo dati da compilare
    protected $fillable = [
      'name',
      'ingredients',
      'price',
      'visible'
    ];

    // relazione one to one
    public function user(){

     return $this -> belongsTo(User::class);

    }
    // relazione one to many
    public function orders() {

     return $this-> belongsToMany(Order::class);

    }
}
