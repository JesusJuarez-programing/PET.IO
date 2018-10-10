<?php

use Illuminate\Database\Seeder;

class OperacionesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Operacion::class, 100)->create();
    }
}
