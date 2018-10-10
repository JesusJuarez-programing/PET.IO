<?php

use Faker\Generator as Faker;

$factory->define(App\Vacunas::class, function (Faker $faker) {
    return [
        'mascota_id' => $faker->numberBetween($min = 1, $max = 100),
        'medicamento_id' => $faker->numberBetween($min = 1, $max = 100)
    ];
});
