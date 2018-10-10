<?php

use Illuminate\Database\Seeder;

class PreinscripcionesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Preinscripciones::class, 100)->create();
    }
}
