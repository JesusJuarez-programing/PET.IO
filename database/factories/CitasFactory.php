<?php

use Faker\Generator as Faker;

$factory->define(App\Citas::class, function (Faker $faker) {
    return [
        'mascota_id' => $faker->numberBetween($min = 0, $max = 100),
        'doctor_id' => $faker->numberBetween($min = 0, $max = 100),
        'fecha_hora' => $faker->dateTimeThisDecade($max = 'now'),
        'tipo' => $faker->randomElement($array = array ('BAJO','URGENTE','NORMAL'))
    ];
});
