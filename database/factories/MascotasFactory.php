<?php

use Faker\Generator as Faker;

$factory->define(App\Mascotas::class, function (Faker $faker) {
    return [
        'nombre' => $faker->name,
        'edad' => $faker->numberBetween($min = 1, $max = 100),
        'dueño_id' => $faker->numberBetween($min = 1, $max = 100),
        'raza' => $faker->randomElement($array = array ('Golden','Pitbull','Chihuahua'))
    ];
});
