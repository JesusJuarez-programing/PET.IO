<?php

use Faker\Generator as Faker;

$factory->define(App\Dueños::class, function (Faker $faker) {
    return [
        'nombre' => $faker->name,
        'apellidos' => $faker->lastName,
        'edad' => $faker->numberBetween($min = 1, $max = 100),
        'direccion' => $faker->streetAddress    ,
        'telefono' => $faker->tollFreePhoneNumber 
    ];
});
