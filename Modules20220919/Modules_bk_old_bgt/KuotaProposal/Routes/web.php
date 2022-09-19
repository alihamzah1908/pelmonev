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

Route::group(['prefix' => 'kuota','middleware' => ['check.role.menu:KUOTA','verified']], function () {
    Route::group(['prefix' => 'wilayah','middleware' => ['check.role.menu:KUOTA01','verified']], function () {
        Route::get('/', 'KuotaWilayahController@index');
        Route::post('/data', 'KuotaWilayahController@getData');
        Route::put('/{id}', 'KuotaWilayahController@update');
    });

    Route::group(['prefix' => 'mitra','middleware' => ['check.role.menu:KUOTA02','verified']], function () {
        Route::get('/', 'KuotaMitraController@index');
        Route::post('/data', 'KuotaMitraController@getData');
        Route::put('/{id}', 'KuotaMitraController@update');
    });

    Route::group(['prefix' => 'ruang-lingkup','middleware' => ['check.role.menu:KUOTA03','verified']], function () {
        Route::get('/', 'KuotaRuangLingkupController@index');
        Route::post('/data', 'KuotaRuangLingkupController@getData');
        Route::put('/{id}', 'KuotaRuangLingkupController@update');
    });
});
