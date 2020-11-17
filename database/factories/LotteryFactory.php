<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Models\LT_periods;
use Faker\Generator as Faker;

$factory->define(LT_periods::class, function (Faker $faker) {
    return [
        'game_id' => $faker->numberBetween(1,100),
        'it_error_id' => '0',
        'lottery' => '01,02,03,04,05,06,07,08,09,10',
        'period_date' => $faker->date('Y-m-d', 'now'),
        'period_num' => $faker->numberBetween(3,4),
        'period_str' => '201904080005',
        'lottery_time' => $faker->dateTime('now', null),
        'be_lottery_time' => $faker->dateTime('now', null),
        'lottery_status' => '1',
        'checks' => $faker->numberBetween(0,1),
        'url_id' => '265'
    ];
});
