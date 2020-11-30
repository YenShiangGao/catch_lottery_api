<?php

use Illuminate\Database\Seeder;

class UrlTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\LT_url::class, 5)->create();
    }
}
