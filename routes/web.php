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

Route::get('/', 'HomeController@index')->name('dashboard');
Route::get('/welcome', function() { return view('welcome'); })->name('welcome');

Auth::routes();

// Posts
Route::resource('posts', 'PostController');

// Photos
Route::resource('photos', 'PhotoController');

