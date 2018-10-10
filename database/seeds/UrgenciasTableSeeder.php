<?php

use Illuminate\Database\Seeder;

class UrgenciasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Urgencias::class, 100)->create();
    }
}
