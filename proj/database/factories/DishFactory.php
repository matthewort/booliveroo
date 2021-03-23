<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

// inserisco model riferimento
use App\Dish;
use Faker\Generator as Faker;

// inserisco model riferimento e per ogni colonna inserisco dati($faker o altro)
$factory->define(Dish::class, function (Faker $faker) {
    return [
        'name' => $faker -> randomElement($array = array (
          'Croissant','Pizza','Hamburger','Pasta','Gelato','Sushi','Patatine fritte','Panino','Piadina')),
        'ingredients' => $faker -> sentence($nbWords = 6, $variableNbWords = true),
        // 'price' => rand(100,2000),
        'price' => rand(5,50),
        'visible' => $faker -> boolean,
    ];
});
