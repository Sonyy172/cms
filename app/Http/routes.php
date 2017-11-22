<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/','LoginController@getLogin');

Route::get('login','LoginController@getLogin');
Route::post('login','LoginController@postLogin');
Route::get('logout','LoginController@logout');

Route::get('news', 'NewsController@getNews')->name('news.get');

Route::get('insertnew', 'NewsController@insertNew');

Route::get('broadcast', 'BroadcastController@getBroadcasts')->name('broadcast.get');
Route::get('insertbroadcast', 'BroadcastController@insertBroadcast');
Route::get('insertbroadcastnow', 'BroadcastController@insertBroadcastNow');

Route::post('broadcastnow','BroadcastController@postBroadcastMessageNow');
Route::post('broadcast','BroadcastController@postBroadcastMessage');