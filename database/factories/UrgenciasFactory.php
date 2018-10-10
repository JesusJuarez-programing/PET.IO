<?php

use Faker\Generator as Faker;

$factory->define(App\Urgencias::class, function (Faker $faker) {
    return [
        'mascota_id' => $faker->numberBetween($min = 1, $max = 100),
        'doctor_id' => $faker->numberBetween($min = 1, $max = 100)
    ];
});
