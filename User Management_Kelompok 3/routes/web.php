<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('template.index');
// })->name('index');

Route::get('/', 'HomeController@homepage')->name('homepage');
// Route::get('/', 'HomeController@homepage')->name('index');
// Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');

Route::get('/home', 'ProfileController@index')->name('home')->middleware('auth');
Route::get('/profile', 'ProfileController@index')->name('profile');
Route::put('/profile', 'ProfileController@update')->name('profile.update');

Route::get('/blank', function () {
    return view('blank');
})->name('blank');

Route::get('/masuk', 'JogjaController@masuk');

Route::get('/keluar', function(){
    Auth::logout();
    return redirect()->route('homepage');
})->name('keluar');

Route::get('/kategori/{articlecategory:slug}', 'HomeController@kategori')->name('kategori');
Route::get('/article/{article:slug}', 'HomeController@artikel')->name('artikel');
