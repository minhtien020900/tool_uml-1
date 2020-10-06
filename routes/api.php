<?php

use Illuminate\Http\Request;

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
Route::get('/card','Japanese\api\APIJapaneseController@card');
Route::post('/save_comment','Japanese\api\APIJapaneseController@save_comment');
// /api/get-all-voca
Route::post('/get-all-voca','Japanese\api\APIJapaneseController@get_all_voca');
Route::post('/pullsource', 'Japanese\JapaneseController@pullsource')->name('japanese.pullsource');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
