<?php

use Illuminate\Database\Seeder;

class VacunasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Vacunas::class, 100)->create();
    }
}
