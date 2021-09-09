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

//店舗の新規作成・詳細画面
Route::get('/', 'StoreController@index');
Route::get('/stores/create', 'StoreController@create');
Route::get('/stores/edit/{store}', 'StoreController@edit');
Route::put('/stores/{store}', 'StoreController@update');
Route::delete('/stores/{store}', 'StoreController@delete');
Route::get('/stores/{store}', 'StoreController@show');
Route::post('/stores' , 'StoreController@store');

// いいねボタン
Route::get('/stores/like/{store}', 'LikeController@like')->name('like');
Route::get('/stores/unlike/{store}', 'LikeController@unlike')->name('unlike');

//レビュー機能
//Route::get('/stores/{store}' , 'ReviewController@index');
Route::get('/reviews/create/{store}' , 'ReviewController@create');
Route::post('/reviews' , 'ReviewController@store');

Route::get('/users' , 'UserController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
