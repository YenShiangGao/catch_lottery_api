<?php

use Illuminate\Database\Seeder;

class TelegramUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\tb_telegram_user::class, 10)->create();
    }
}
