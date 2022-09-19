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

Route::group(['prefix' => 'mutasi-rekening','middleware' => ['check.role.menu:MUTASIREK','verified']], function () {
    Route::get('/{id?}', 'MutasiRekeningController@index');
    Route::post('/data', 'MutasiRekeningController@getData');
    Route::post('/', 'MutasiRekeningController@store');
    Route::put('/{id}', 'MutasiRekeningController@update');
    Route::delete('/{id}', 'MutasiRekeningController@destroy');
    Route::post('/upload-mutasi-rekening', 'MutasiRekeningController@uploadExcel');
});
