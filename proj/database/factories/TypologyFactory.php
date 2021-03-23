<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

// inserisco model riferimento

use App\Typology;
use Faker\Generator as Faker;

// inserisco model riferimento e per ogni colonna inserisco dati($faker o altro)
$factory->define(Typology::class, function (Faker $faker) {
    return [
        // 'type' => $faker -> word
    ];
});
