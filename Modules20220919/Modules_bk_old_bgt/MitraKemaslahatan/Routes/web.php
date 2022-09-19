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

Route::group(['prefix' => 'mitra-kemaslahatan','middleware' => ['check.role.menu:MITRA','verified']], function () {
    Route::get('/{id?}', 'MitraKemaslahatanController@index');
    Route::post('/data', 'MitraKemaslahatanController@getData');
    Route::put('/{id}', 'MitraKemaslahatanController@update');
    Route::post('/update/{id}', 'MitraKemaslahatanController@update');
});