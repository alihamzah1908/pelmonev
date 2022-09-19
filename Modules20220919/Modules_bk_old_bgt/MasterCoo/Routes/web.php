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

Route::group(['prefix' => 'master-coo','middleware' => ['check.role.menu:MSCOO','verified']], function () {
    Route::get('/{id?}', 'MasterCooController@index');
    Route::post('/data', 'MasterCooController@getData');
    Route::post('/', 'MasterCooController@store');
    Route::put('/{id}', 'MasterCooController@update');
    Route::delete('/{id}', 'MasterCooController@destroy');
});
