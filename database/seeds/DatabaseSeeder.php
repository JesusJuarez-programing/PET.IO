<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([CitasTableSeeder::class,
        DoctoresTableSeeder::class,
        DueñosTableSeeder::class,
        MascotasTableSeeder::class,
        MedicamentosTableSeeder::class,
        OperacionesTableSeeder::class,
        PreinscripcionesTableSeeder::class,
        UrgenciasTableSeeder::class,
        VacunasTableSeeder::class,
        ]);
    }
}
