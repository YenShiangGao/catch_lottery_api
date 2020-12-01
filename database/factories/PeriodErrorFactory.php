<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\LT_period_error;
use Faker\Generator as Faker;

$factory->define(LT_period_error::class, function (Faker $faker) {
    static $lottery_id = '1';
    return [
        'game_id' => '124',
        'lottery_id' => $lottery_id++,
        'lottery' => '29,34,38,42,44,47,36',
    ];
});
