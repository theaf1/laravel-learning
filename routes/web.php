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

Route::get('/tasks','TaskController@index');

Route::get('/tasks/create','TaskController@create');

Route::post('/tasks/store','TaskController@store');

Route::get('/tasks/{id}','TaskController@edit');

Route::put('/tasks/{id}','TaskController@update');

Route::patch('/tasks/{task}','TaskController@updateStatus');

Route::delete('/tasks/{task}','TaskController@destroy');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');