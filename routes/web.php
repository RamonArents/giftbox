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
Route::get('/pay', 'UserPageController@pay')->name('pay');
Route::get('/payment/{orderId}', 'UserPageController@payed')->name('payed');
Route::get('/paymentstatus/{payStatus}', 'UserPageController@checkPayment')->name('paystatus');
//register, login (only for admin)
Auth::routes();
//homepage
Route::get('/home', 'HomeController@index')->name('home');
