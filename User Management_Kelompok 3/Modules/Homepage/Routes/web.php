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

Route::name('admin.homepage.')->middleware('can:admin')->prefix('homepage')->group(function() {
    Route::get('/slider', 'HomepageController@slider')->name('slider');
    Route::post('/slider', 'HomepageController@slider');
    Route::get('/video', 'HomepageController@video')->name('video');
    Route::post('/video', 'HomepageController@video');
});
