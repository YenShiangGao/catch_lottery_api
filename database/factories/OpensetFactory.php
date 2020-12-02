<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\LT_openset;
use Faker\Generator as Faker;

$factory->define(LT_openset::class, function (Faker $faker) {
    return [
        'game_id' => '66',
        'lottery_year' => '2020',
        'lottery_month' => $faker->month,
        'lottery_day' => '1,3,5,8,10,13,15,17,19,22,24,26,29,31',
        'enable' => '1'
    ];
});
