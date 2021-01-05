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

Route::name('admin.member.')->middleware('can:admin')->prefix('members')->group(function() {
    Route::get('/', 'MemberController@index')->name('member');
    Route::post('/', 'MemberController@index');
    Route::get('/admin', 'MemberController@admin')->name('admin');
    Route::post('/admin', 'MemberController@admin');
    Route::get('/site', 'MemberController@site')->name('site');
    Route::post('/site', 'MemberController@site');
});
