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

Route::group(['prefix' => 'dashboard','middleware' => ['check.role.menu:DASH','verified']], function () {
    Route::get('/', function (){
        return redirect('dashboard/mitra-strategis');
    });

    Route::group(['prefix' => 'mitra-kemaslahatan','middleware' => ['check.role.menu:DASHMK','verified']], function () {
        Route::get('/{id?}', 'MitraKemaslahatanController@index');
        Route::post('/data', 'MitraKemaslahatanController@getData');
    });

    Route::group(['prefix' => 'mitra-strategis','middleware' => ['check.role.menu:DASHMS','verified']], function () {
        Route::get('/{id?}', 'MitraStrategisController@index');
        Route::post('/data', 'MitraStrategisController@getData');
    });

    Route::group(['prefix' => 'realisasi-anggaran','middleware' => ['check.role.menu:DASHREALISASI','verified']], function () {
        Route::get('/{id?}', 'RealisasiAnggaranController@index');
        Route::post('/data', 'RealisasiAnggaranController@getData');
    });
});

