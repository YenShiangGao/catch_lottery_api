<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\LT_vac;
use Faker\Generator as Faker;

$factory->define(LT_vac::class, function (Faker $faker) {
    static $game_id = 1;
    return [
        'game_id' => $game_id++,
        'vacStart'=> $faker->dateTime,
        'vacEnd'  => $faker->dateTime,
        'enable'  => '0'
    ];
});
