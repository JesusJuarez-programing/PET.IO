<?php

use Illuminate\Database\Seeder;

class DueñosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Dueño::class, 100)->create();
    }
}
