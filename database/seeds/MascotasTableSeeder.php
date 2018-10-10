<?php

use Illuminate\Database\Seeder;

class MascotasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Mascota::class, 100)->create();
    }
}
