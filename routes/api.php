<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/**
 *  樂透群
 */
Route::group(['prefix'=>'lottery', 'namespace' => 'Lottery'], function () {

    /**
         *  抓獎用
         *  @url --  POST   localhost / api /  lottery / specifyGame
         *  @params -- {
         *                          ['gameid' => 遊戲id],
         *                          ['periodS' => '起始時間'] ,
         *                          ['periodE' => '結束時間']
         *                        }
         * @return -- response(json_data,  status)
         */
    Route::post('specifyGame', 'GameApiController@specifyGame');

    /**
         *  抓獎用 (由期數抓取網址ID)
         * @url -- POST api / lottery / specifyPeriod
         * @params -- {
         *                          [ ' gameid ' => " 遊戲id "],
         *                          [ ' period_str ' => " 日期字串" ]
         *                       }
         * @return -- response(json_data, status)
         */
    Route::post('specifyPeriod', 'GameApiController@specifyPeriod');

    /**
         *  錯誤抓獎系統查詢
         * @url -- POST api / lottery / specifyPeriodError
         * @params -- {
         *                          [ " periodS " => " 起始時間 " ],
         *                          [ " periodE " => " 結束時間 " ]
         *                       }
         * @return --  狀態回傳訊息和期數錯誤資料
         */
    Route::post('specifyPeriodError', 'GameApiController@specifyPeriodError');
});