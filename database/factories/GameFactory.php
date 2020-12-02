<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\LT_game;
use Faker\Generator as Faker;

$factory->define(LT_game::class, function (Faker $faker) {
    return [
        'cname' => '重庆时时彩',
        'ename' => 'cqssc',
        'enable'=> $faker->boolean,
        'cycle' => 'dayss',
        'param' => '20201020000',
        'param_1' => '2020-10-14',
//        'param_2' => null,
        'repeat' => 'Y',
        'urlCheck' => '1',
        'notice' => 'N',
        'noticeTime' => '300',
        'period_format' => 'ymd',
        'period_num' => 3,
        'lottery_num' => 5,
        'min_number' => 0,
        'max_number' => 9
    ];
});
