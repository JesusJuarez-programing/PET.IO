<?php

use Faker\Generator as Faker;

$factory->define(Model::class, function (Faker $faker) {
    return [
        'mascota_id' => $faker->numberBetween($min = 1, $max = 100),
        'doctor_id' => $faker->numberBetween($min = 1, $max = 100),
        'tipo' => $faker->randomElement($array = array ('BAJO','URGENTE','NORMAL')),
        'sala' => $faker->numberBetween($min = 1, $max = 10),
        'fecha_hora' => $faker->dateTimeThisDecade($max = 'now')
    ];
});
