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

Route::get('/', ['as' => 'site/index', 'uses' => 'SiteController@index', 'middleware' => 'cachepage']);
Route::get('/{category_slug}/{post_slug}/{post_id}', ['as' => 'site/post', 'uses' => 'SiteController@post', 'middleware' => 'cachepage'])->where(['post_id' => '[0-9]+']);