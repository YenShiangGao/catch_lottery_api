<?php

use Illuminate\Database\Seeder;

class OpensetTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\LT_openset::class, 10)->create();
    }
}
