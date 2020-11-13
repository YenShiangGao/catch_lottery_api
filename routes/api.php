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
         *  @url --  POST   localhost / api /  lottery / catch
         *  @params -- { [gameid' => 遊戲id],
         *                       ['periodS' => '起始時間'] ,
         *                       ['periodE' => '結束時間'] }
         * @return -- response(json_data,  status)
         */
    Route::post('catch', 'GameApiController@specify');
});