<?php

use Illuminate\Database\Seeder;

use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

     // inserisco factory e creo n righe dentro la colonna user
    public function run()
    {
     factory(User::class,10) -> create();//create() crea elementi e li inserisce in database
    }
}
