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

Route::get('/', ['as' => 'home', 'uses' => 'SiteController@index', 'middleware' => 'cachepage']);
Route::get('/{category_slug}/{post_slug}/{post_id}', ['as' => 'post', 'uses' => 'SiteController@post', 'middleware' => 'cachepage']);