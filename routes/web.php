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

Auth::routes();

// Posts
Route::resource('posts', 'PostController');

// Photos
Route::resource('photos', 'PhotoController');

// Categories
Route::resource('categories', 'CategoryController');

// Videos
Route::resource('videos', 'VideoController');

