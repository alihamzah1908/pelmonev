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

Auth::routes(['register' => true,'verify' => true]);

Route::get('/', 'HomeController@index')->name('home')->middleware('verified');
Route::get('/dashboard-ms', 'HomeController@dashMs')->name('dashboard-ms')->middleware('verified');
Route::get('/dashboard-realisasi', 'HomeController@dashRealisasi')->name('dashboard-realisasi')->middleware('verified');
Route::get('/dashboard-pencairan', 'HomeController@dashPencairan')->name('dashboard-pencairan')->middleware('verified');
Route::get('/dashboard-pelaksanaan-monev', 'HomeController@dashboardPelaksanaanMonev')->name('dashboard-pelaksanaan-monev')->middleware('verified');
Route::get('/dashboard-pelaksanaan-monev-mitra/{mitra_id}', 'HomeController@dashboardPelaksanaanMonevMitra')->name('dashboard-pelaksanaan-monev-mitra')->middleware('verified');
Route::get('/dashboard-pelaksanaan-monev-kegiatan/{kegiatan_id}', 'HomeController@dashboardPelaksanaanMonevKegiatan')->name('dashboard-pelaksanaan-monev-kegiatan')->middleware('verified');
Route::get('/dashboard-monitoring-st', 'HomeController@dashMonitoringSt')->name('dashboard-monitoring-st')->middleware('verified');
Route::get('/report-rekap-lpj', 'HomeController@reportRekapLPJ')->name('report-rekap-lpj')->middleware('verified');
Route::get('/report-rekap-pengembalian-ke-kas-haji', 'HomeController@reportRekapPengembalianKeKasHaji')->name('report-rekap-pengembalian-ke-kas-haji')->middleware('verified');
Route::get('/report-rekap-keuangan', 'HomeController@reportRekapKeuangan')->name('report-rekap-keuangan')->middleware('verified');
Route::get('/report-rekap-total-realisasi-mitra', 'HomeController@reportRekapTotalRealisasiMitra')->name('report-rekap-total-realisasi-mitra')->middleware('verified');
Route::get('/report-rekap-total-per-asnaf', 'HomeController@reportRekapTotalPerAsnaf')->name('report-rekap-total-per-asnaf')->middleware('verified');
Route::get('/report-rekap-total-per-provinsi-alokasi-asnaf', 'HomeController@reportRekapTotalPerProvinsiPerAlokasiPerAsnaf')->name('report-rekap-total-per-provinsi-alokasi-asnaf')->middleware('verified');
Route::get('/get-pemohon', 'HomeController@getPemohon')->name('get-pemohon');
Route::get('/get-proposal', 'HomeController@getProposal')->name('get-proposal');
Route::get('/reload-captcha', 'Auth\LoginController@reloadCaptcha');

Route::group(['prefix' => 'proposal-pemohon'], function () {
    Route::post('/input', 'PemohonProposalController@store');
    Route::post('/upload', 'PemohonProposalController@upload');
    Route::post('/check-kuota', 'PemohonProposalController@checkKuota')->name('check-kuota');
});

Route::group(['prefix' => 'dashboard'], function () {
    Route::post('/detail', 'HomeController@detailDashboard');
    Route::post('/detail-provinsi', 'HomeController@detailProvinsi');
});

/*--Sistem--*/
Route::group(['prefix' => 'sistem','middleware' => ['check.role.menu:SYS','verified']], function () {
    Route::get('/', function () {
        return redirect('sistem/user');
    });

    //--Autorisasi
    Route::group(['prefix' => 'autorisasi','middleware' => ['check.role.menu:SYS02']], function () {
        Route::get('/', 'RoleController@index');
        Route::post('/', 'RoleController@store');
        Route::post('/data', 'RoleController@getData')->name('autorisasi.get-data');
        Route::get('/{id}', 'RoleController@show');
        Route::put('/{id}', 'RoleController@update');
        Route::delete('/{id}', 'RoleController@destroy');
        Route::get('/detail/{id}', 'RoleController@detail');
        Route::post('/role-menu', 'RoleController@saveRoleMenu');
    });

    //--User
    Route::group(['prefix' => 'user','middleware' => ['check.role.menu:SYS01']], function () {
        Route::get('/', 'UserController@index');
        Route::post('/', 'UserController@store');
        Route::post('/data', 'UserController@getData')->name('autorisasi.get-data');
        Route::get('/{id}', 'UserController@show');
        Route::put('/{id}', 'UserController@update');
        Route::delete('/{id}', 'UserController@destroy');
        Route::post('/password', 'UserController@changePassword');

        Route::group(['prefix' => 'profil','middleware' => ['check.role.menu:SYS01']], function () {
			Route::get('/{id}', 'UserController@profil');
            Route::put('/image/{id}', 'UserController@changeImage');
        });
    });

    //--Kode
    Route::group(['prefix' => 'configuration','middleware' => ['check.role.menu:SYS03']], function () {
        Route::get('/', 'CodeController@index');
		Route::post('/data', 'CodeController@getData');
        Route::post('/', 'CodeController@store');
        Route::get('/{id}', 'CodeController@show');
        Route::put('/{id}', 'CodeController@update');
		Route::delete('/{id}', 'CodeController@destroy');
    });

    Route::group(['prefix' => 'bank','middleware' => ['check.role.menu:SYS06']], function () {
		Route::get('/', 'BankController@index');
        Route::post('/data', 'BankController@getData');
        Route::post('/', 'BankController@store');
        Route::get('/{id}', 'BankController@show');
        Route::put('/{id}', 'BankController@update');
        Route::delete('/{id}', 'BankController@destroy');
    });

    /* region */
    Route::group(['prefix' => 'region','middleware' => ['check.role.menu:SYS05']], function () {
        Route::get('/{id?}', 'RegionController@index');
        Route::post('/', 'RegionController@store');
        Route::post('/data', 'RegionController@getData');
        Route::put('/{id}', 'RegionController@update');
        Route::get('/{id}', 'RegionController@show');
        Route::delete('/{id}', 'RegionController@destroy');
    });

     /* nation */
     Route::group(['prefix' => 'nation','middleware' => ['check.role.menu:SYS05']], function () {
        Route::get('/{id?}', 'NationController@index');
        Route::post('/', 'NationController@store');
        Route::post('/data', 'NationController@getData');
        Route::put('/{id}', 'NationController@update');
        Route::get('/{id}', 'NationController@show');
        Route::delete('/{id}', 'NationController@destroy');
    });


    /* log-activity */
    Route::group(['prefix' => 'log-activity','middleware' => ['check.role.menu:SYS07']], function () {
        Route::get('/', 'LogActivityController@index');
        Route::post('/', 'LogActivityController@store');
        Route::post('/data', 'LogActivityController@getData');
        Route::get('/{id}', 'LogActivityController@show');
        Route::delete('/{id?}', 'LogActivityController@destroy');
    });
});

/* daftar-daerah */
Route::group(['prefix' => 'daftar-daerah'], function () {
    Route::get('/', 'DaftarDaerahController@getRegionList');
    Route::get('/by-root/{id}', 'DaftarDaerahController@getRegionList');

    Route::get('/provinsi', [
        'uses'          => 'DaftarDaerahController@getRegionList',
        'region_level'  => 1
    ]);

    Route::get('/kabupaten', [
        'uses'          => 'DaftarDaerahController@getRegionList',
        'region_level'  => 2
    ]);

    Route::get('/kecamatan', [
        'uses'          => 'DaftarDaerahController@getRegionList',
        'region_level'  => 3
    ]);

    Route::get('/kelurahan', [
        'uses'          => 'DaftarDaerahController@getRegionList',
        'region_level'  => 4
    ]);

});

/* dropdown-data */
Route::group(['prefix' => 'dropdown-data'], function () {
    Route::get('/mitra-kemaslahatan', '\Modules\MitraKemaslahatan\Http\Controllers\DropdownController@index');
    Route::get('/mitra-strategis', '\Modules\MitraStrategis\Http\Controllers\DropdownController@index');
});

/*--Profile--*/
Route::group(['prefix' => 'profile'], function () {
    Route::get('/', 'ProfileController@index');
    Route::get('/{id}', 'ProfileController@show');
    Route::put('/', 'ProfileController@update');
    Route::put('/image', 'ProfileController@changeImage');
    Route::post('/password', 'ProfileController@changePassword');
});

Route::get('/test-email', 'HomeController@testEmail');


