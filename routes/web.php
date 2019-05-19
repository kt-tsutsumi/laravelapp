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

Route::get('logout','LogoutController@index')
->middleware('auth');

Route::get('/','ArticleController@index')
->middleware('auth');

Route::get('article', 'ArticleController@index')
->middleware('auth');
Route::get('article/edit/{id}', 'ArticleController@edit')
->middleware('auth');
Route::post('article/edit/{id}', 'ArticleController@update')
->middleware('auth');
Route::get('article/new', 'ArticleController@new')
->middleware('auth');
Route::post('article/new', 'ArticleController@post')
->middleware('auth');
Route::post('article/remove', 'ArticleController@remove')
->middleware('auth');

Auth::routes();
