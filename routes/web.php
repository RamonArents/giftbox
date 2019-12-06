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
// payment routes
Route::post('/pay', 'UserPageController@pay')->name('pay');
Route::get('/payment/{orderId}', 'UserPageController@payed')->name('payed');
//webhook URL
Route::get('/webhook', 'UserPageController@finishPayment')->name('webhook');
// mail URL
Route::get('sendMail/{paymentId}', 'MailController@ship')->name('sendmail');
//register, login (only for admin)
Auth::routes();
//homepage
Route::get('/home', 'HomeController@index')->name('home');
