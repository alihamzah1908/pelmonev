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

Route::group(['prefix' => 'penugasan-bpkh','middleware' => ['check.role.menu:PROPOSALPEN','verified']], function () {
    Route::get('/{id?}', 'PenugasanController@index');
    Route::post('/data', 'PenugasanController@getData');
    
    Route::group(['prefix' => 'item-penugasan','middleware' => ['check.role.menu:PROPOSALPEN','verified']], function () {
        Route::put('/{id}', 'ItemPenugasanController@update');
        Route::post('/data', 'ItemPenugasanController@getData');
    }); 
}); 
