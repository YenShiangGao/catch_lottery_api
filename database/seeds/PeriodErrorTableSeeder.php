<?php

use Illuminate\Database\Seeder;

class PeriodErrorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\LT_period_error::class, 10)->create();
    }
}
