<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

// inserisco model riferimento
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

// inserisco model riferimento e per ogni colonna inserisco dati($faker o altro)

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->randomElement($array = array (
          'Riviera Wave','Kashmir Gala','Bella Cucina','Food Delight','Frasca Food & Wine','Yum!','Krusty Krab','Nacho Daddy','The Tipsy Cow','Backyard Bowl')),
        // 'img' => $faker->randomElement($array = array ( 'https://media-cdn.tripadvisor.com/media/photo-s/1a/16/32/e3/wine-room-dari-ristorante.jpg','https://www.aprireazienda.com/wp-content/uploads/2019/11/aprire-un-ristorante-giapponese-1024x683.jpg')),
        // 'img' => $faker->randomElement($array = array ("http://localhost:8000/storage/img/default-logo.png")),
        'img' => $faker->randomElement($array = array ("default-logo.jpg")),
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
        'indirizzo' => $faker -> streetAddress,
        'piva' => $faker -> unique() -> creditCardNumber,
    ];
});
