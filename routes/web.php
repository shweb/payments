<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::group(['prefix' => 'payments'], function () {
    Route::get('/wechat', 'QRCodeController@qrCodeWechat');
    Route::get('/wechat/notify', 'NotifyController@NotifyWechat');
    Route::get('/success', 'NotifyController@successWechat');
    Route::get('/test', 'QRCodeController@test');
});
Route::get('/wechat', 'QRCodeController@qrCodeWechat');
Route::get('/wxpay/example/native.php', 'QRCodeController@qrCodeWechat');