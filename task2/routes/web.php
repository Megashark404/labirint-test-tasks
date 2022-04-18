<?php

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
Route::get('/', 'App\Http\Controllers\NewsController@index');
Route::get('/create', 'App\Http\Controllers\NewsController@createForm');
Route::post('/store', 'App\Http\Controllers\NewsController@createAction');
Route::get('/delete/{id}', 'App\Http\Controllers\NewsController@delete');
Route::get('/news/id={id}', 'App\Http\Controllers\NewsController@findById');
Route::get('/news/q={query}', 'App\Http\Controllers\NewsController@findByQuery');
