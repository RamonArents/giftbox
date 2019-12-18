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

// User routes
Route::get('/', 'UserPageController@getHomePage')->name('homepage');
Route::get('/doneer', 'UserPageController@getDoneerPage')->name('donatiepage');
//route to buy code
Route::get('/buycode', 'UserPageController@getBuyPage')->name('buycode');
// payment routes
Route::post('/pay', 'UserPageController@pay')->name('pay');
// webhook url
Route::get('/payment', 'UserPageController@payed')->name('webhook');
//payed URL
Route::get('/payed/{orderId}', 'UserPageController@finishPayment')->name('finish');
//order status URL
Route::get('/order-status/{order}/{payment}', 'UserPageController@getOrderStatus')->name('order_status');
// mail URL
Route::get('sendMail/{paymentId}', 'MailController@ship')->name('sendmail');
//route that gets json file to target LEDS
Route::get('/jsonLED', 'UserPageController@getLeds')->name('getLeds');
//register, login (only for admin)
Auth::routes();
//homepage
Route::get('/home', 'HomeController@index')->name('home');
