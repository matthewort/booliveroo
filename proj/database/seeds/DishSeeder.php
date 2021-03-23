<?php

use Illuminate\Database\Seeder;
use App\Dish;
use App\User;

class DishSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

     // facciamo n dish (procedimento 1 a molti)
    public function run()
    {
      factory(Dish::class, 100)
       -> make() //make() crea istanze e permette modifica dati prima di salvarli in tabella
       -> each(function($dish) {
          //per ogni dish associamo il primo user dopo averli ordinati casualmente e associamo user a dish
         $user = User::inRandomOrder() -> first(); //prendo user casuale
         $dish -> user() -> associate($user);
         //associate per uno a molti o uno a uno(senza tabelle ponte)
         $dish -> save(); //make richiede salvataggio dati
       });
    }
}
