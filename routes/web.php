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


Route::get('/', 'StoreController@index');
Route::get('/stores/create', 'StoreController@create');
Route::get('/stores/{store}/edit', 'StoreController@edit');
Route::put('/stores/{store}', 'StoreController@update');
Route::delete('/stores/{store}', 'StoreController@delete');
Route::get('/stores/{store}', 'StoreController@show');
Route::post('/stores' , 'StoreController@store');




Route::get('/reviews' , 'ReviewController@index');
Route::get('/users' , 'UserController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
