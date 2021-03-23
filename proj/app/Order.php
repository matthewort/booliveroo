<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
  protected $fillable = [
    'name',
    'lastname',
    'email',
    'status',
    'address',
    'price'
  ];

  // relazione one to one
  public function user(){

   return $this -> belongsTo(User::class);

  }

  // relazione many to many
  public function dishes() {

   return $this-> belongsToMany(Dish::class);

  }
}
