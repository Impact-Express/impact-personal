<?php

Auth::routes();

Route::post('/stage3login', 'Auth\LoginController@loginFromStep3')->name('login-from-stage-3');

Route::get('/', 'PersonalBookingController@stage1')->name('stage1');
Route::post('/', function() {abort(404);});

Route::get('/2', function() {abort(404);});
Route::post('/2', 'PersonalBookingController@stage2')->name('stage2');

Route::get('/3', 'PersonalBookingController@stage3');
Route::post('/3', 'PersonalBookingController@stage3')->name('stage3');


Route::middleware(['auth'])->group(function() {

    Route::get('/4', 'PersonalBookingController@stage4')->name('stage4');
    
    Route::post('/5', 'PersonalBookingController@stage5')->name('stage5');

    Route::get('/confirmation', 'PersonalBookingController@complete')->name('complete');
});


Route::get('/hermesparcelshop', 'PagesController@locateHermesParcelShop')->name('locateHermesParcelShop');


// Route::get('/createOrder', 'PaymentController@createOrder');
Route::post('/createOrder', 'PaymentController@createOrder')->name('paypal-create');

// Route::get('/capturePayment', 'PaymentController@capturePayment');
Route::post('/capturePayment', 'PaymentController@capturePayment')->name('paypal-capture');

Route::get('/test', 'PagesController@test');