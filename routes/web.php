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
    Route::any('/wechat/notify', 'NotifyController@NotifyWechat');
    Route::get('/success', 'NotifyController@successWechat');
    Route::get('/failed', 'NotifyController@errorWechat');
});
Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('/wechat', 'AdminController@wechat');
});
Route::get('/getNombre', 'WechatController@getNombre');
Route::get('/getStatus', 'WechatController@getLastPayment');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
