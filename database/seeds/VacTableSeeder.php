<?php

use Illuminate\Database\Seeder;

class VacTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\LT_vac::class, 10)->create();
    }
}
