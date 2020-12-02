<?php

use Illuminate\Database\Seeder;

class GameSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\LT_game::class, 10)->create();
    }
}
