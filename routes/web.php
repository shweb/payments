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
Route::get('/test','AlipayController@test_view');
Route::get('/test-retour','AlipayController@test_return');

Route::group(['prefix' => 'payments'], function () {
    Route::get('/wechat', 'QRCodeController@qrCodeWechat');
    Route::any('/wechat/notify', 'NotifyController@NotifyWechat');
    Route::get('/success', 'NotifyController@successWechat');
    Route::get('/failed', 'NotifyController@errorWechat');


    /*alipay*/
    Route::get('/alipay','AlipayController@alipayhome');
    Route::get('/alipay-qrcode','AlipayController@alipayqrcode');
    Route::get('/alipay/notify','AlipayController@notify_url');
    Route::get('/alipay/return','AlipayController@return_url');
    /*alipay*/
});
Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('/wechat', 'AdminController@wechat');
    Route::post('/resutl_search', 'AdminController@trie_date');
});


Route::get('/getNombre', 'WechatController@getNombre');
Route::get('/getStatus', 'WechatController@getLastPayment');
Route::get('/getPayement', 'WechatController@getPayement');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
