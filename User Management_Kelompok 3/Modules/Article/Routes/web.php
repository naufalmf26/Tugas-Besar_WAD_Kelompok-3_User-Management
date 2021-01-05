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

Route::name('article.')->middleware('can:admin')->prefix('admin/article')->group(function() {
    Route::get('/', 'ArticleController@index')->name('index');
    Route::post('/', 'ArticleController@index');
    Route::get('/cat', 'ArticleController@category')->name('category');
    Route::post('/cat', 'ArticleController@category');
});
