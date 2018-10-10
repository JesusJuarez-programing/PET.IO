<?php

use Faker\Generator as Faker;

$factory->define(App\Medicamentos::class, function (Faker $faker) {
    return [
        'nombre' => $faker->name,
        'cantidad' => $faker->numberBetween($min = 1, $max = 100),
        'aplicacion' => $faker->realText($maxNbChars = 100, $indexSize = 2),
        'fabricante' => $faker->company ,
        'existencia' => $faker->numberBetween($min = 1, $max = 1000)
    ];
});
