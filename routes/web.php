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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/feeds', 'FeedController@index')->name('feeds');

Route::get('/add-feed', 'FeedController@addFeedForm')->name('add-feed');
Route::post('/save-feed', 'FeedController@save')->name('save-feed');

Route::post('/disable-feed', 'FeedController@disable')->name('disable-feed');
Route::post('/enable-feed', 'FeedController@enable')->name('enable-feed');
