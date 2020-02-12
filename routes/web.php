<?php

Auth::routes();

Route::get('/', 'PersonalBookingController@stage1')->name('stage1');
Route::post('/', function() {abort(404);});

Route::get('/2', function() {abort(404);});
Route::post('/2', 'PersonalBookingController@stage2')->name('stage2');

Route::get('/3', 'PersonalBookingController@stage3');
Route::post('/3', 'PersonalBookingController@stage3')->name('stage3');


Route::middleware(['auth'])->group(function() {

    Route::get('/4', 'PersonalBookingController@stage4')->name('stage4');
    
    Route::get('/5', 'PersonalBookingController@stage5')->name('stage5');

});


Route::get('/hermesparcelshop', 'PagesController@locateHermesParcelShop')->name('locateHermesParcelShop');