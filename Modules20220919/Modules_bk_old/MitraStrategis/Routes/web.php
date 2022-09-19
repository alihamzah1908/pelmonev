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

Route::group(['prefix' => 'mitra-strategis','middleware' => ['check.role.menu:MITRAST','verified']], function () {
    Route::get('/{id?}', 'MitraStrategisController@index');
    Route::post('/data', 'MitraStrategisController@getData');
    Route::post('/', 'MitraStrategisController@store');
    Route::put('/{id}', 'MitraStrategisController@update');
    Route::delete('/{id}', 'MitraStrategisController@destroy');
});
