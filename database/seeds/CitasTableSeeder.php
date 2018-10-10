<?php

use Illuminate\Database\Seeder;

class CitasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Cita::class, 100)->create();
    }
}
