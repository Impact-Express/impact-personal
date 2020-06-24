<?php

//Route::middleware(['auth.basic'])->group(function() {
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
        
        Route::get('/5', function() {abort(404);});
        Route::post('/5', 'PersonalBookingController@stage5')->name('stage5');
    
        Route::get('/complete', 'PersonalBookingController@complete')->name('complete');
        Route::get('/confirmation', 'PersonalBookingController@confirmation')->name('confirmation');
    
        Route::get('/shipments', 'AccountsController@shipments')->name('shipments');
        Route::get('/account', 'AccountsController@index')->name('account');
        Route::post('/account', 'AccountsController@update')->name('update-user');
        Route::get('/changepassword', 'AccountsController@showChangePasswordForm')->name('change-password-form');
        Route::post('/changepassword', 'AccountsController@changePassword')->name('change-password');
    
        Route::get('label/{shipment}', 'LabelsController@showpdf')->name('get-label-pdf');
    });
    
    Route::middleware(['auth', 'admin'])->group(function() {
        Route::get('/admin', 'AdminController@home')->name('admin');
        Route::get('/customers', 'AdminController@customers')->name('customers');
    });
    
    Route::get('/error', 'PagesController@error')->name('error');
    
    Route::get('/hermesparcelshop', 'PagesController@locateHermesParcelShop')->name('locateHermesParcelShop');
    
    // Route::get('/createOrder', 'PaymentController@createOrder');
    Route::post('/createOrder', 'PaymentController@createOrder')->name('paypal-create');
    
    // Route::get('/capturePayment', 'PaymentController@capturePayment');
    Route::post('/capturePayment', 'PaymentController@capturePayment')->name('paypal-capture');
    
    Route::get('/test', 'PagesController@test'); 
// });