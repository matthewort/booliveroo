<?php

use Illuminate\Database\Seeder;

use App\Dish;
use App\Order;
use App\Typology;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */

         // richiamo tutti i seeder ordinatamente in base a relazioni tra tabelle es: order contiene user,guest e dish id quindi prima si inseriscono user,guest e dish seeder e successivamente order
    public function run()
    {
        $this->call([
          UserSeeder::class,
          DishSeeder::class,
          OrderSeeder::class,
          TypologySeeder::class
        ]);
    }
}
