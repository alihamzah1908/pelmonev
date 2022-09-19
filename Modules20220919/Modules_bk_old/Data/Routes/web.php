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

/*--Data--*/
Route::group(['prefix' => 'data','middleware' => ['check.role.menu:DATA','verified']], function () {
    //--Region
	//Route::get('/region', '\Modules\Data\Http\Controllers\Master\RegionController@index');
	Route::group(['prefix' => 'region'], function () {
		Route::get('/', 'Master\RegionController@index');
		Route::post('/data', 'Master\RegionController@getData');
		Route::get('/root/{id}', 'Master\RegionController@indexroot');
		Route::post('/root', 'Master\RegionController@getRegionByRoot');
		
		Route::post('/', 'Master\RegionController@store');
		Route::get('/{id}', 'Master\RegionController@show');
        Route::put('/{id}', 'Master\RegionController@update');
        Route::delete('/{id}', 'Master\RegionController@destroy');
		
		//Route::get('/regionlist', 'Master\RegionController@getRegionList');
    });
	
	//--Region List
	Route::group(['prefix' => 'regionlist'], function () {
		Route::get('/', 'Master\RegionController@getRegionList');
		Route::get('/root/{id}', 'Master\RegionController@getRegionList');
		
		Route::get('/propinsi', [
			'uses'          => 'Master\RegionController@getRegionList',
			'region_level'  => 1
		]);

		Route::get('/kabupaten', [
			'uses'          => 'Master\RegionController@getRegionList',
			'region_level'  => 2
		]);
		Route::get('/kabupaten/{id}', [
			'uses'          => 'Master\RegionController@getRegionList',
			'region_level'  => 2
		]);

		Route::get('/kecamatan', [
			'uses'          => 'Master\RegionController@getRegionList',
			'region_level'  => 3
		]);
		Route::get('/kecamatan/{id}', [
			'uses'          => 'Master\RegionController@getRegionList',
			'region_level'  => 3
		]);

		Route::get('/kelurahan', [
			'uses'          => 'Master\RegionController@getRegionList',
			'region_level'  => 4
		]);
		Route::get('/kelurahan/{id}', [
			'uses'          => 'Master\RegionController@getRegionList',
			'region_level'  => 4
		]);

	});
	
	//--Bank
	//Route::get('/bank', '\Modules\Data\Http\Controllers\Master\BankController@index');
    Route::group(['prefix' => 'bank'], function () {
		Route::get('/', 'Master\BankController@index');
        Route::post('/data', 'Master\BankController@getData');
        Route::post('/', 'Master\BankController@store');
        Route::get('/{id}', 'Master\BankController@show');
        Route::put('/{id}', 'Master\BankController@update');
        Route::delete('/{id}', 'Master\BankController@destroy');
    });
	
	//--Nation
	Route::group(['prefix' => 'nation'], function () {
		Route::get('/', 'Master\NationController@index');
        Route::post('/data', 'Master\NationController@getData');
        Route::post('/', 'Master\NationController@store');
        Route::get('/{id}', 'Master\NationController@show');
        Route::put('/{id}', 'Master\NationController@update');
        Route::delete('/{id}', 'Master\NationController@destroy');
    });
	
	Route::get('/nationlist', 'Master\NationController@getNationList');
});
