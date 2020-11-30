<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\LT_url;
use Faker\Generator as Faker;

$factory->define(LT_url::class, function (Faker $faker) {
    return [
        'game_id'       => '10',
        'url'           => 'http://api.caipiaokong.cn/lottery/?name=ahks&format=json&uid=799694&token=5cf9e1150bfc94830efba15ec9efdb04b71fc846&date=',
        'url_name'      => '彩票控API',
        'api_name'      => 'ahks_nine',
        'post'          => '',
        'enable'        => $faker->boolean,
        'code_order'    => $faker->boolean,
        'last_period'   => '20201130180',
        'last_status'   => '1',
        'last_proxy'    => '0',
        'proxy_enable'  => '1'
    ];
});
