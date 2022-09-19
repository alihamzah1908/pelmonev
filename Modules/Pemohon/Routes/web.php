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

Route::group(['prefix' => 'pemohon','middleware' => ['check.role.menu:PEMOHON','verified']], function () {
    Route::get('/{id?}', 'PemohonController@index');
    Route::post('/data', 'PemohonController@getData');
    Route::put('/{id}', 'PemohonController@update');
    Route::post('/update/{id}', 'PemohonController@update');
    
    Route::group(['prefix' => 'pengurus','middleware' => ['check.role.menu:PEMOHON','verified']], function () {
        Route::post('/', 'PemohonPengurusController@store');
        Route::post('/data', 'PemohonPengurusController@getData');
        Route::delete('/{id}', 'PemohonPengurusController@destroy');
    });

    Route::group(['prefix' => 'kerjasama','middleware' => ['check.role.menu:PEMOHON','verified']], function () {
        Route::post('/', 'PemohonKerjasamaController@store');
        Route::post('/data', 'PemohonKerjasamaController@getData');
        Route::delete('/{id}', 'PemohonKerjasamaController@destroy');
    });

});
