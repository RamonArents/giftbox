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
Route::get('/payed/{orderNumber}', 'UserPageController@finishPayment')->name('finish');
Route::get('/opladen_payed/{cardNumber}', 'UserPageController@finishPaymentAddToCard')->name('finishAdd');
//order status URL
Route::get('/order-status/{order}/{payment}', 'UserPageController@getOrderStatus')->name('order_status');
// mail URL
Route::get('sendMail/{paymentId}', 'MailController@ship')->name('sendmail');
//activate code
Route::post('/activate', 'UserPageController@useCode')->name('usecode');
//route that gets json file to target LEDS
Route::get('/jsonLED', 'UserPageController@getLeds')->name('getLeds');
//get the page to set the balance on the RFID
Route::get('/opladen','UserPageController@getBalancePage')->name('getBalance');
//set balance on RFID
Route::post('/addBalance', 'UserPageController@addBalance')->name('addBalance');
//set value to get balance
Route::post('/getBalanceFromDB', 'UserPageController@getBalanceFromDB')->name('getBalanceFromDB');
//login (only for admin)
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
//pass reset
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');
//homepage
Route::get('/home', 'HomeController@index')->name('home');
//admin routes
Route::group(['middleware' => 'auth'], function(){
    //return orders view
    Route::get('/orders','AdminController@orders')->name('orders');
    //edit order
    Route::get('/editOrderView/{id}', 'AdminController@editOrderView')->name('editOrderView');
    Route::post('editOrder/{id}', 'AdminController@editOrder')->name('editOrder');
    //delete order
    Route::post('/deleteOrder/{id}','AdminController@deleteOrder')->name('deleteOrder');
    //return coces view
    Route::get('/codes','AdminController@codes')->name('codes');
    //edit code
    Route::get('/editCodeView/{id}', 'AdminController@editCodeView')->name('editCodeView');
    Route::post('editCode/{id}', 'AdminController@editCode')->name('editCode');
    //delete code
    Route::post('/deleteCode/{id}','AdminController@deleteCode')->name('deleteCode');
    //return cards view
    Route::get('/cards', 'AdminController@cards')->name('cards');
    // edit card
    Route::get('/editCardView/{id}', 'AdminController@editCardView')->name('editCardView');
    Route::post('editCard/{id}', 'AdminController@editCard')->name('editCard');
    //delete card
    Route::post('/deleteCard/{id}','AdminController@deleteCard')->name('deleteCard');
});
