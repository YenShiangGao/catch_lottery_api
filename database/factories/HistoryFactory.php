<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Models\LT_history;
use Faker\Generator as Faker;

$factory->define(LT_history::class, function (Faker $faker) {
    static $lottery_id = 981796;
    static $period_str = 201904090574;
    return [
        'game_id'       => '121',
        'lottery_id'    => $lottery_id++,
        'period_str'    => $period_str++,
        'lottery'       => '7,1,2,1,2',
        'lottery_time'  => $faker->dateTime,
        'url_id'        => '277',
        'proxy'         => 'null',
        'code_order'    => '0'
    ];
});
