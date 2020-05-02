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

Route::get('/', 'EntriesController@index');
Route::get('/entries/{entry}', 'EntriesController@show')->where('entry', '[0-9]+');
Route::get('/entries/create', 'EntriesController@create');
Route::post('/entries', 'EntriesController@store');
Route::get('/entries/{entry}/edit', 'EntriesController@edit');
Route::patch('/entries/{entry}', 'EntriesController@update');
Route::delete('/entries/{entry}', 'EntriesController@destroy');
