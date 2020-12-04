<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\tb_telegram_user;
use Faker\Generator as Faker;

$factory->define(tb_telegram_user::class, function (Faker $faker) {
    return [
        "group_id"  => $faker->randomDigit,
        "user_id"   => $faker->randomNumber('9'),
        "first_name"=> "抓講通知",
        "last_name" => "測試站",
        "username"  => "TEST",
        "web"       => "TEST",
        "url"       => "http://cdt.hzjiashang.com/",
        "enable"    => "N"
    ];
});
