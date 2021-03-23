<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

// inserisco model riferimento

use App\Order;
use Faker\Generator as Faker;

// inserisco model riferimento e per ogni colonna inserisco dati($faker o altro)
$factory->define(Order::class, function (Faker $faker) {
    return [

        'name' => $faker -> firstName,
        'lastname' => $faker -> lastName,
        'email' => $faker->unique()->safeEmail,
        'address' => $faker -> address,
        'status' => $faker -> boolean,
        'price' => rand(1,20),
    ];
});
