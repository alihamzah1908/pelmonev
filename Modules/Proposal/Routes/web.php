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
Route::group(['prefix' => 'proposal','middleware' => ['check.role.menu:PROPOSAL','verified'], ['check.role.menu:PROPOSALLT','verified'], ['check.role.menu:PROPOSALPM','verified']], function () {
    Route::get('/list-proposal/{id?}', 'ProposalController@index');
    Route::get('/list-proposal/{id}/show', 'ProposalController@show');
    Route::get('/list-proposal/mitra/{id}', 'ProposalController@detail_mitra_proposal');
    Route::get('/data/mitra', 'ProposalController@getDataMitra');
    Route::get('/data/rapat', 'ProposalController@getDataRapat');
    Route::post('/data', 'ProposalController@getData');
    Route::get('/history', 'ProposalController@indexHistory');
    Route::get('/get-pejabat', 'ProposalController@getPejabat');
    Route::get('/list-proposal/create-proposal-mitra/{id}', 'ProposalController@create_proposal_mitra');
    Route::get('/rapatbp', 'ProposalController@viewbp');
    Route::get('/rapat/{id}/show', 'ProposalController@showrapatbp');
    Route::get('/keputusan-rbp/{id}/show', 'ProposalController@showkeputusanrbp');
    Route::get('/rapatkek', 'ProposalController@viewkek');
    Route::get('/rapat/bp/proposal', 'ProposalController@ambil_data_proposal');
    Route::get('/ringkasan/{id}', 'ProposalController@ringkasan');
    Route::get('/surat-pernyataan/{id}', 'ProposalController@surat_pernyataan');
    Route::get('/download/assesment/{file}', 'ProposalController@download_assesment_file');

    Route::post('/rapatbp/data', 'ProposalController@getRapatBp');
    Route::post('/proposal-mitra/penilaian/data', 'ProposalLayakTeknis\ItemPenilaianController@getData');
    Route::post('/data/history', 'ProposalController@getDataHistory');
    Route::post('/', 'ProposalController@store');
    Route::post('/update/{id}', 'ProposalController@update');
    Route::post('/insert-proposal-mitra/{id}', 'ProposalController@insert_proposal_mitra');
    Route::delete('/delete/{id}', 'ProposalController@destroy');
    Route::post('/disposisi/{id}', 'ProposalController@disposisi');
    Route::post('/rekomendasi/{id}', 'ProposalController@rekomendasi');
    Route::post('/send-proposal-mitra/{id}', 'ProposalController@send_proposal_mitra');
    Route::post('/pejabat-rekomendasi/{id}', 'ProposalPejabatRekomendasiController@store');
    Route::post('/rapatbp/simpan/klasifikasi', 'ProposalController@simpan_klasifikasi');
    Route::post('/rapatbp/ubah/proposalrbp', 'ProposalController@ubah_proposal_rbp');
    Route::post('/simpan/analis-resiko', 'ProposalController@simpan_analis_resiko'); 
    Route::post('/keputusan-rbp/data', 'ProposalController@getKeputusanRbp');

    // PELMONEV
    Route::get('/program/task-program','Pelmonev\ProgramController@index');
    Route::get('/program/history/program','Pelmonev\ProgramController@history');
    Route::get('/program/pencairan','Pelmonev\ProgramController@pencairanindex');
    Route::get('/program/perikatan','Pelmonev\ProgramController@perikatanindex');
    Route::get('/program/task-program/{id}/show','Pelmonev\ProgramController@show');
    Route::get('/program/perikatan/{id}/show','Pelmonev\ProgramController@detailPerikatan')->name('show.perikatan');
    Route::get('/program/pencairan/{id}/show','Pelmonev\ProgramController@detailPerikatan');
    Route::get('/program/print/pks/{id}', 'Pelmonev\ProgramController@print_pks')->name('print.pks');
    Route::get('/program/print/pks/spjtm/{id}', 'Pelmonev\ProgramController@spjtm')->name('print.spjtm');
    Route::get('/download/lampiran/{file}', 'Pelmonev\ProgramController@download_lampiran_file')->name('download.lampiran');
    Route::post('/program/data','Pelmonev\ProgramController@data_program');
    Route::post('/program/history','Pelmonev\ProgramController@data_history');
    Route::post('/program/pencairanperikatan/data','Pelmonev\ProgramController@data_pencairanperikatan');
    Route::post('/program/disposisi/{id}', 'Pelmonev\ProgramController@disposisi');
    Route::post('/program/save-pks', 'Pelmonev\ProgramController@save_pks')->name('save.pks');

    Route::group(['prefix' => 'print','middleware' => ['check.role.menu:PROPOSAL','verified']], function () {
        Route::get('/sk/{id}', 'PrintController@sk');
        Route::get('/ringkasan/{id}', 'PrintController@ringkasan');
        Route::get('/spjtm/{id}', 'PrintController@spjtm');
        Route::get('/pks/{id}', 'PrintController@pks');
    });

    Route::group(['prefix' => 'proposal-files','middleware' => ['check.role.menu:PROPOSAL','verified']], function () {
        Route::get('/{id}', 'ProposalFilesController@index');
        Route::post('/data', 'ProposalFilesController@getData');
        Route::post('/upload', 'ProposalFilesController@store');
        Route::post('/catatan', 'ProposalFilesController@update');
    });

    Route::group(['prefix' => 'pengurus','middleware' => ['check.role.menu:PROPOSAL','verified']], function () {
        Route::post('/', 'ProposalLembagaPengurusController@store');
        Route::post('/data', 'ProposalLembagaPengurusController@getData');
        Route::delete('/{id}', 'ProposalLembagaPengurusController@destroy');
        Route::post('/update/{id}', 'ProposalLembagaPengurusController@update');
    });

    Route::group(['prefix' => 'kerjasama','middleware' => ['check.role.menu:PROPOSAL','verified']], function () {
        Route::post('/', 'ProposalLembagaKerjasamaController@store');
        Route::post('/data', 'ProposalLembagaKerjasamaController@getData');
        Route::delete('/{id}', 'ProposalLembagaKerjasamaController@destroy');
    });

    Route::group(['prefix' => 'persiapan','middleware' => ['check.role.menu:PROPOSAL','verified']], function () {
        Route::post('/', 'ProposalPersiapanController@store');
        Route::post('/data', 'ProposalPersiapanController@getData');
        Route::delete('/{id}', 'ProposalPersiapanController@destroy');
    });
    
    Route::group(['prefix' => 'rab','middleware' => ['check.role.menu:PROPOSAL','verified']], function () {
        Route::post('/', 'ProposalRABController@store');
        Route::post('/data', 'ProposalRABController@getData');
        Route::post('/data/mitra', 'ProposalRABController@getDataMitra');
        Route::post('/update/{id}', 'ProposalRABController@update');
        Route::delete('/{id}', 'ProposalRABController@destroy');
    });

    Route::group(['prefix' => 'donasi','middleware' => ['check.role.menu:PROPOSAL','verified']], function () {
        Route::post('/', 'ProposalDonasiController@store');
        Route::post('/data', 'ProposalDonasiController@getData');
        Route::delete('/{id}', 'ProposalDonasiController@destroy');
    });

    Route::group(['prefix' => 'kerjasama2','middleware' => ['check.role.menu:PROPOSAL','verified']], function () {
        Route::post('/', 'ProposalKerjasamaController@store');
        Route::post('/data', 'ProposalKerjasamaController@getData');
        Route::delete('/{id}', 'ProposalKerjasamaController@destroy');
    });

    Route::group(['prefix' => 'pj','middleware' => ['check.role.menu:PROPOSAL','verified']], function () {
        Route::post('/', 'ProposalPJController@store');
        Route::post('/data', 'ProposalPJController@getData');
        Route::delete('/{id}', 'ProposalPJController@destroy');
    });

    Route::group(['prefix' => 'outcome','middleware' => ['check.role.menu:PROPOSAL','verified']], function () {
        Route::post('/', 'ProposalOutcomeController@store');
        Route::post('/data', 'ProposalOutcomeController@getData');
        Route::delete('/{id}', 'ProposalOutcomeController@destroy');
    });

    Route::group(['prefix' => 'pengalaman','middleware' => ['check.role.menu:PROPOSAL','verified']], function () {
        Route::post('/', 'ProposalPengalamanController@store');
        Route::post('/data', 'ProposalPengalamanController@getData');
        Route::delete('/{id}', 'ProposalPengalamanController@destroy');
    });

    Route::group(['prefix' => 'approve','middleware' => ['check.role.menu:PROPOSAL','verified']], function () {
        Route::post('/{id}', 'ApprovalProposalController@store');
    });

    Route::post('/send/{id}', 'ApprovalProposalController@send');
}); 

Route::group(['prefix' => 'proposal-penerima-manfaat','middleware' => ['check.role.menu:PROPOSALPM','verified']], function () {
    Route::get('/{id?}', 'ProposalPenerimaManfaatController@index');
    Route::post('/data', 'ProposalPenerimaManfaatController@getData');
    Route::post('/', 'ProposalController@store');
    Route::post('/update/{id}', 'ProposalController@update');

    Route::post('/pejabat-rekomendasi/{id}', 'ProposalPejabatRekomendasiController@store');

    Route::group(['prefix' => 'print','middleware' => ['check.role.menu:PROPOSALPM','verified']], function () {
        Route::get('/sk/{id}', 'PrintController@sk');
        Route::get('/ringkasan/{id}', 'PrintController@ringkasan');
        Route::get('/spjtm/{id}', 'PrintController@spjtm');
    });

    Route::group(['prefix' => 'proposal-files','middleware' => ['check.role.menu:PROPOSALPM','verified']], function () {
        Route::get('/{id}', 'ProposalFilesController@index');
        Route::post('/data', 'ProposalFilesController@getData');
        Route::post('/upload', 'ProposalFilesController@store');
        Route::post('/catatan', 'ProposalFilesController@update');
    });

    Route::group(['prefix' => 'pengurus','middleware' => ['check.role.menu:PROPOSALPM','verified']], function () {
        Route::post('/', 'ProposalLembagaPengurusController@store');
        Route::post('/data', 'ProposalLembagaPengurusController@getData');
        Route::delete('/{id}', 'ProposalLembagaPengurusController@destroy');
    });

    Route::group(['prefix' => 'kerjasama','middleware' => ['check.role.menu:PROPOSALPM','verified']], function () {
        Route::post('/', 'ProposalLembagaKerjasamaController@store');
        Route::post('/data', 'ProposalLembagaKerjasamaController@getData');
        Route::delete('/{id}', 'ProposalLembagaKerjasamaController@destroy');
    });

    Route::group(['prefix' => 'persiapan','middleware' => ['check.role.menu:PROPOSALPM','verified']], function () {
        Route::post('/', 'ProposalPersiapanController@store');
        Route::post('/data', 'ProposalPersiapanController@getData');
        Route::delete('/{id}', 'ProposalPersiapanController@destroy');
    });
    
    Route::group(['prefix' => 'rab','middleware' => ['check.role.menu:PROPOSALPM','verified']], function () {
        Route::post('/', 'ProposalRABController@store');
        Route::post('/data', 'ProposalRABController@getData');
        Route::delete('/{id}', 'ProposalRABController@destroy');
    });

    Route::group(['prefix' => 'donasi','middleware' => ['check.role.menu:PROPOSALPM','verified']], function () {
        Route::post('/', 'ProposalDonasiController@store');
        Route::post('/data', 'ProposalDonasiController@getData');
        Route::delete('/{id}', 'ProposalDonasiController@destroy');
    });

    Route::group(['prefix' => 'kerjasama2','middleware' => ['check.role.menu:PROPOSALPM','verified']], function () {
        Route::post('/', 'ProposalKerjasamaController@store');
        Route::post('/data', 'ProposalKerjasamaController@getData');
        Route::delete('/{id}', 'ProposalKerjasamaController@destroy');
    });

    Route::group(['prefix' => 'pj','middleware' => ['check.role.menu:PROPOSALPM','verified']], function () {
        Route::post('/', 'ProposalPJController@store');
        Route::post('/data', 'ProposalPJController@getData');
        Route::delete('/{id}', 'ProposalPJController@destroy');
    });

    Route::group(['prefix' => 'outcome','middleware' => ['check.role.menu:PROPOSALPM','verified']], function () {
        Route::post('/', 'ProposalOutcomeController@store');
        Route::post('/data', 'ProposalOutcomeController@getData');
        Route::delete('/{id}', 'ProposalOutcomeController@destroy');
    });

    Route::group(['prefix' => 'pengalaman','middleware' => ['check.role.menu:PROPOSALPM','verified']], function () {
        Route::post('/', 'ProposalPengalamanController@store');
        Route::post('/data', 'ProposalPengalamanController@getData');
        Route::delete('/{id}', 'ProposalPengalamanController@destroy');
    });

    Route::group(['prefix' => 'approve','middleware' => ['check.role.menu:PROPOSALPM','verified']], function () {
        Route::post('/{id}', 'ApprovalProposalController@store');
    });

    Route::post('/send/{id}', 'ApprovalProposalController@send');
}); 

Route::group(['prefix' => 'proposal-penugasan','middleware' => ['check.role.menu:PROPOSALPN','verified']], function () {
    Route::get('/{id?}', 'ProposalPenugasanController@index');
    Route::post('/data', 'ProposalPenugasanController@getData');

    Route::post('/', 'ProposalController@store');
    Route::post('/update/{id}', 'ProposalController@update');

    Route::post('/pejabat-rekomendasi/{id}', 'ProposalPejabatRekomendasiController@store');

    Route::group(['prefix' => 'print','middleware' => ['check.role.menu:PROPOSALPN','verified']], function () {
        Route::get('/sk/{id}', 'PrintController@sk');
        Route::get('/ringkasan/{id}', 'PrintController@ringkasan');
        Route::get('/spjtm/{id}', 'PrintController@spjtm');
    });

    Route::group(['prefix' => 'proposal-files','middleware' => ['check.role.menu:PROPOSALPN','verified']], function () {
        Route::get('/{id}', 'ProposalFilesController@index');
        Route::post('/data', 'ProposalFilesController@getData');
        Route::post('/upload', 'ProposalFilesController@store');
        Route::post('/catatan', 'ProposalFilesController@update');
    });

    Route::group(['prefix' => 'pengurus','middleware' => ['check.role.menu:PROPOSALPN','verified']], function () {
        Route::post('/', 'ProposalLembagaPengurusController@store');
        Route::post('/data', 'ProposalLembagaPengurusController@getData');
        Route::delete('/{id}', 'ProposalLembagaPengurusController@destroy');
    });

    Route::group(['prefix' => 'kerjasama','middleware' => ['check.role.menu:PROPOSALPN','verified']], function () {
        Route::post('/', 'ProposalLembagaKerjasamaController@store');
        Route::post('/data', 'ProposalLembagaKerjasamaController@getData');
        Route::delete('/{id}', 'ProposalLembagaKerjasamaController@destroy');
    });

    Route::group(['prefix' => 'persiapan','middleware' => ['check.role.menu:PROPOSALPN','verified']], function () {
        Route::post('/', 'ProposalPersiapanController@store');
        Route::post('/data', 'ProposalPersiapanController@getData');
        Route::delete('/{id}', 'ProposalPersiapanController@destroy');
    });
    
    Route::group(['prefix' => 'rab','middleware' => ['check.role.menu:PROPOSALPN','verified']], function () {
        Route::post('/', 'ProposalRABController@store');
        Route::post('/data', 'ProposalRABController@getData');
        Route::delete('/{id}', 'ProposalRABController@destroy');
    });

    Route::group(['prefix' => 'donasi','middleware' => ['check.role.menu:PROPOSALPN','verified']], function () {
        Route::post('/', 'ProposalDonasiController@store');
        Route::post('/data', 'ProposalDonasiController@getData');
        Route::delete('/{id}', 'ProposalDonasiController@destroy');
    });

    Route::group(['prefix' => 'kerjasama2','middleware' => ['check.role.menu:PROPOSALPN','verified']], function () {
        Route::post('/', 'ProposalKerjasamaController@store');
        Route::post('/data', 'ProposalKerjasamaController@getData');
        Route::delete('/{id}', 'ProposalKerjasamaController@destroy');
    });

    Route::group(['prefix' => 'pj','middleware' => ['check.role.menu:PROPOSALPN','verified']], function () {
        Route::post('/', 'ProposalPJController@store');
        Route::post('/data', 'ProposalPJController@getData');
        Route::delete('/{id}', 'ProposalPJController@destroy');
    });

    Route::group(['prefix' => 'outcome','middleware' => ['check.role.menu:PROPOSALPN','verified']], function () {
        Route::post('/', 'ProposalOutcomeController@store');
        Route::post('/data', 'ProposalOutcomeController@getData');
        Route::delete('/{id}', 'ProposalOutcomeController@destroy');
    });

    Route::group(['prefix' => 'pengalaman','middleware' => ['check.role.menu:PROPOSALPN','verified']], function () {
        Route::post('/', 'ProposalPengalamanController@store');
        Route::post('/data', 'ProposalPengalamanController@getData');
        Route::delete('/{id}', 'ProposalPengalamanController@destroy');
    });

    Route::group(['prefix' => 'approve','middleware' => ['check.role.menu:PROPOSALPN','verified']], function () {
        Route::post('/{id}', 'ApprovalProposalController@store');
    });

    Route::post('/send/{id}', 'ApprovalProposalController@send');
}); 

Route::group(['prefix' => 'proposal-hasil-assesmen','middleware' => ['check.role.menu:PROPOSALHA','verified']], function () {
    Route::get('/{id?}', 'ProposalHasilAssesmenController@index');
    Route::post('/data', 'ProposalHasilAssesmenController@getData');

    Route::post('/', 'ProposalController@store');
    Route::post('/update/{id}', 'ProposalController@update');

    Route::post('/pejabat-rekomendasi/{id}', 'ProposalPejabatRekomendasiController@store');

    Route::group(['prefix' => 'print','middleware' => ['check.role.menu:PROPOSALHA','verified']], function () {
        Route::get('/sk/{id}', 'PrintController@sk');
        Route::get('/ringkasan/{id}', 'PrintController@ringkasan');
        Route::get('/spjtm/{id}', 'PrintController@spjtm');
    });

    Route::group(['prefix' => 'proposal-files','middleware' => ['check.role.menu:PROPOSALHA','verified']], function () {
        Route::get('/{id}', 'ProposalFilesController@index');
        Route::post('/data', 'ProposalFilesController@getData');
        Route::post('/upload', 'ProposalFilesController@store');
        Route::post('/catatan', 'ProposalFilesController@update');
    });

    Route::group(['prefix' => 'pengurus','middleware' => ['check.role.menu:PROPOSALHA','verified']], function () {
        Route::post('/', 'ProposalLembagaPengurusController@store');
        Route::post('/data', 'ProposalLembagaPengurusController@getData');
        Route::delete('/{id}', 'ProposalLembagaPengurusController@destroy');
    });

    Route::group(['prefix' => 'kerjasama','middleware' => ['check.role.menu:PROPOSALHA','verified']], function () {
        Route::post('/', 'ProposalLembagaKerjasamaController@store');
        Route::post('/data', 'ProposalLembagaKerjasamaController@getData');
        Route::delete('/{id}', 'ProposalLembagaKerjasamaController@destroy');
    });

    Route::group(['prefix' => 'persiapan','middleware' => ['check.role.menu:PROPOSALHA','verified']], function () {
        Route::post('/', 'ProposalPersiapanController@store');
        Route::post('/data', 'ProposalPersiapanController@getData');
        Route::delete('/{id}', 'ProposalPersiapanController@destroy');
    });
    
    Route::group(['prefix' => 'rab','middleware' => ['check.role.menu:PROPOSALHA','verified']], function () {
        Route::post('/', 'ProposalRABController@store');
        Route::post('/data', 'ProposalRABController@getData');
        Route::delete('/{id}', 'ProposalRABController@destroy');
    });

    Route::group(['prefix' => 'donasi','middleware' => ['check.role.menu:PROPOSALHA','verified']], function () {
        Route::post('/', 'ProposalDonasiController@store');
        Route::post('/data', 'ProposalDonasiController@getData');
        Route::delete('/{id}', 'ProposalDonasiController@destroy');
    });

    Route::group(['prefix' => 'kerjasama2','middleware' => ['check.role.menu:PROPOSALHA','verified']], function () {
        Route::post('/', 'ProposalKerjasamaController@store');
        Route::post('/data', 'ProposalKerjasamaController@getData');
        Route::delete('/{id}', 'ProposalKerjasamaController@destroy');
    });

    Route::group(['prefix' => 'pj','middleware' => ['check.role.menu:PROPOSALHA','verified']], function () {
        Route::post('/', 'ProposalPJController@store');
        Route::post('/data', 'ProposalPJController@getData');
        Route::delete('/{id}', 'ProposalPJController@destroy');
    });

    Route::group(['prefix' => 'outcome','middleware' => ['check.role.menu:PROPOSALHA','verified']], function () {
        Route::post('/', 'ProposalOutcomeController@store');
        Route::post('/data', 'ProposalOutcomeController@getData');
        Route::delete('/{id}', 'ProposalOutcomeController@destroy');
    });

    Route::group(['prefix' => 'pengalaman','middleware' => ['check.role.menu:PROPOSALHA','verified']], function () {
        Route::post('/', 'ProposalPengalamanController@store');
        Route::post('/data', 'ProposalPengalamanController@getData');
        Route::delete('/{id}', 'ProposalPengalamanController@destroy');
    });

    Route::group(['prefix' => 'approve','middleware' => ['check.role.menu:PROPOSALHA','verified']], function () {
        Route::post('/{id}', 'ApprovalProposalController@store');
    });

    Route::post('/send/{id}', 'ApprovalProposalController@send');
});

Route::group(['prefix' => 'proposal-mitra','middleware' => ['check.role.menu:PROPOSALMIT','verified']], function () {
    Route::get('/{id?}', 'ProposalMitraController@index');
    Route::post('/data', 'ProposalMitraController@getData');
    Route::post('/', 'ProposalMitraController@store');
    Route::post('/update/{id}', 'ProposalMitraController@update');

    Route::group(['prefix' => 'proposal-files','middleware' => ['check.role.menu:PROPOSALMIT','verified']], function () {
        Route::get('/{id}', 'ProposalFilesController@index');
        Route::post('/data', 'ProposalFilesController@getData');
        Route::post('/upload', 'ProposalFilesController@store');
    });

    Route::group(['prefix' => 'pengurus','middleware' => ['check.role.menu:PROPOSALMIT','verified']], function () {
        Route::post('/', 'ProposalLembagaPengurusController@store');
        Route::post('/data', 'ProposalLembagaPengurusController@getData');
        Route::delete('/{id}', 'ProposalLembagaPengurusController@destroy');
    });

    Route::group(['prefix' => 'kerjasama','middleware' => ['check.role.menu:PROPOSALMIT','verified']], function () {
        Route::post('/', 'ProposalLembagaKerjasamaController@store');
        Route::post('/data', 'ProposalLembagaKerjasamaController@getData');
        Route::delete('/{id}', 'ProposalLembagaKerjasamaController@destroy');
    });

    Route::group(['prefix' => 'persiapan','middleware' => ['check.role.menu:PROPOSALMIT','verified']], function () {
        Route::post('/', 'ProposalPersiapanController@store');
        Route::post('/data', 'ProposalPersiapanController@getData');
        Route::delete('/{id}', 'ProposalPersiapanController@destroy');
    });
    
    Route::group(['prefix' => 'rab','middleware' => ['check.role.menu:PROPOSALMIT','verified']], function () {
        Route::post('/', 'ProposalRABController@store');
        Route::post('/data', 'ProposalRABController@getData');
        Route::delete('/{id}', 'ProposalRABController@destroy');
    });

    Route::group(['prefix' => 'donasi','middleware' => ['check.role.menu:PROPOSALMIT','verified']], function () {
        Route::post('/', 'ProposalDonasiController@store');
        Route::post('/data', 'ProposalDonasiController@getData');
        Route::delete('/{id}', 'ProposalDonasiController@destroy');
    });

    Route::group(['prefix' => 'kerjasama2','middleware' => ['check.role.menu:PROPOSALMIT','verified']], function () {
        Route::post('/', 'ProposalKerjasamaController@store');
        Route::post('/data', 'ProposalKerjasamaController@getData');
        Route::delete('/{id}', 'ProposalKerjasamaController@destroy');
    });

    Route::group(['prefix' => 'pj','middleware' => ['check.role.menu:PROPOSALMIT','verified']], function () {
        Route::post('/', 'ProposalPJController@store');
        Route::post('/data', 'ProposalPJController@getData');
        Route::delete('/{id}', 'ProposalPJController@destroy');
    });

    Route::group(['prefix' => 'outcome','middleware' => ['check.role.menu:PROPOSALMIT','verified']], function () {
        Route::post('/', 'ProposalOutcomeController@store');
        Route::post('/data', 'ProposalOutcomeController@getData');
        Route::delete('/{id}', 'ProposalOutcomeController@destroy');
    });

    Route::group(['prefix' => 'pengalaman','middleware' => ['check.role.menu:PROPOSALMIT','verified']], function () {
        Route::post('/', 'ProposalPengalamanController@store');
        Route::post('/data', 'ProposalPengalamanController@getData');
        Route::delete('/{id}', 'ProposalPengalamanController@destroy');
    });

    Route::group(['prefix' => 'approve','middleware' => ['check.role.menu:PROPOSALMIT','verified']], function () {
        Route::post('/{id}', 'ApprovalProposalController@store');
    });

    Route::post('/send/{id}', 'ApprovalProposalController@send');
});

Route::group(['prefix' => 'proposal-analisis-resiko','middleware' => ['check.role.menu:PROPOSALRES','verified']], function () {
    Route::get('/{id?}', 'AnalisisResiko\AnalisisResikoController@index');
    Route::post('/data', 'AnalisisResiko\AnalisisResikoController@getData');
    Route::post('/', 'AnalisisResiko\AnalisisResikoController@store');
}); 

Route::group(['prefix' => 'proposal-analisis-hk','middleware' => ['check.role.menu:PROPOSALHK','verified']], function () {
    Route::get('/{id?}', 'AnalisisHk\AnalisisHkController@index');
    Route::post('/data', 'AnalisisHk\AnalisisHkController@getData');
    Route::post('/', 'AnalisisHk\AnalisisHkController@store');
    Route::post('/verif', 'AnalisisHk\AnalisisHkController@storeVerif');
}); 

Route::group(['prefix' => 'status-proposal','middleware' => ['check.role.menu:PROPOSAL','verified']], function () {
    Route::get('/{id?}', 'StatusProposalController@index');
    Route::post('/data', 'StatusProposalController@getData');
}); 

Route::group(['prefix' => 'ringkasan-proposal','middleware' => ['check.role.menu:RINGPROP','verified']], function () {
    Route::get('/{id?}', 'RingkasanProposalController@index');
    Route::post('/data', 'RingkasanProposalController@getData');
    Route::post('/', 'RingkasanProposalController@store');
    Route::post('/update/{id}', 'RingkasanProposalController@update');

    Route::group(['prefix' => 'proposal-files','middleware' => ['check.role.menu:RINGPROP','verified']], function () {
        Route::get('/{id}', 'ProposalFilesController@index');
        Route::post('/data', 'ProposalFilesController@getData');
        Route::post('/upload', 'ProposalFilesController@store');
    });

    Route::group(['prefix' => 'pengurus','middleware' => ['check.role.menu:RINGPROP','verified']], function () {
        Route::post('/', 'ProposalLembagaPengurusController@store');
        Route::post('/data', 'ProposalLembagaPengurusController@getData');
        Route::delete('/{id}', 'ProposalLembagaPengurusController@destroy');
    });

    Route::group(['prefix' => 'kerjasama','middleware' => ['check.role.menu:RINGPROP','verified']], function () {
        Route::post('/', 'ProposalLembagaKerjasamaController@store');
        Route::post('/data', 'ProposalLembagaKerjasamaController@getData');
        Route::delete('/{id}', 'ProposalLembagaKerjasamaController@destroy');
    });

    Route::group(['prefix' => 'persiapan','middleware' => ['check.role.menu:RINGPROP','verified']], function () {
        Route::post('/', 'ProposalPersiapanController@store');
        Route::post('/data', 'ProposalPersiapanController@getData');
        Route::delete('/{id}', 'ProposalPersiapanController@destroy');
    });
    
    Route::group(['prefix' => 'rab','middleware' => ['check.role.menu:RINGPROP','verified']], function () {
        Route::post('/', 'ProposalRABController@store');
        Route::post('/data', 'ProposalRABController@getData');
        Route::post('/update/{id}', 'ProposalRABController@update');
        Route::delete('/{id}', 'ProposalRABController@destroy');
    });

    Route::group(['prefix' => 'donasi','middleware' => ['check.role.menu:RINGPROP','verified']], function () {
        Route::post('/', 'ProposalDonasiController@store');
        Route::post('/data', 'ProposalDonasiController@getData');
        Route::delete('/{id}', 'ProposalDonasiController@destroy');
    });

    Route::group(['prefix' => 'kerjasama2','middleware' => ['check.role.menu:RINGPROP','verified']], function () {
        Route::post('/', 'ProposalKerjasamaController@store');
        Route::post('/data', 'ProposalKerjasamaController@getData');
        Route::delete('/{id}', 'ProposalKerjasamaController@destroy');
    });

    Route::group(['prefix' => 'pj','middleware' => ['check.role.menu:RINGPROP','verified']], function () {
        Route::post('/', 'ProposalPJController@store');
        Route::post('/data', 'ProposalPJController@getData');
        Route::delete('/{id}', 'ProposalPJController@destroy');
    });

    Route::group(['prefix' => 'outcome','middleware' => ['check.role.menu:RINGPROP','verified']], function () {
        Route::post('/', 'ProposalOutcomeController@store');
        Route::post('/data', 'ProposalOutcomeController@getData');
        Route::delete('/{id}', 'ProposalOutcomeController@destroy');
    });

    Route::group(['prefix' => 'pengalaman','middleware' => ['check.role.menu:RINGPROP','verified']], function () {
        Route::post('/', 'ProposalPengalamanController@store');
        Route::post('/data', 'ProposalPengalamanController@getData');
        Route::delete('/{id}', 'ProposalPengalamanController@destroy');
    });

    Route::group(['prefix' => 'approve','middleware' => ['check.role.menu:RINGPROP','verified']], function () {
        Route::post('/{id}', 'ApprovalProposalController@store');
    });

    Route::post('/send/{id}', 'ApprovalProposalController@send');
});

Route::group(['prefix' => 'keputusan-rbp','middleware' => ['check.role.menu:KEPUTUSANRBP','verified']], function () {
    Route::get('/{id?}', 'KeputusanRBPController@index');
    Route::post('/data', 'KeputusanRBPController@getData');
    Route::post('/', 'KeputusanRBPController@store');
    Route::post('/update/{id}', 'KeputusanRBPController@update');

    Route::group(['prefix' => 'proposal-files','middleware' => ['check.role.menu:KEPUTUSANRBP','verified']], function () {
        Route::get('/{id}', 'ProposalFilesController@index');
        Route::post('/data', 'ProposalFilesController@getData');
        Route::post('/upload', 'ProposalFilesController@store');
    });

    Route::group(['prefix' => 'pengurus','middleware' => ['check.role.menu:KEPUTUSANRBP','verified']], function () {
        Route::post('/', 'ProposalLembagaPengurusController@store');
        Route::post('/data', 'ProposalLembagaPengurusController@getData');
        Route::delete('/{id}', 'ProposalLembagaPengurusController@destroy');
    });

    Route::group(['prefix' => 'kerjasama','middleware' => ['check.role.menu:KEPUTUSANRBP','verified']], function () {
        Route::post('/', 'ProposalLembagaKerjasamaController@store');
        Route::post('/data', 'ProposalLembagaKerjasamaController@getData');
        Route::delete('/{id}', 'ProposalLembagaKerjasamaController@destroy');
    });

    Route::group(['prefix' => 'persiapan','middleware' => ['check.role.menu:KEPUTUSANRBP','verified']], function () {
        Route::post('/', 'ProposalPersiapanController@store');
        Route::post('/data', 'ProposalPersiapanController@getData');
        Route::delete('/{id}', 'ProposalPersiapanController@destroy');
    });
    
    Route::group(['prefix' => 'rab','middleware' => ['check.role.menu:KEPUTUSANRBP','verified']], function () {
        Route::post('/', 'ProposalRABController@store');
        Route::post('/data', 'ProposalRABController@getData');
        Route::delete('/{id}', 'ProposalRABController@destroy');
    });

    Route::group(['prefix' => 'donasi','middleware' => ['check.role.menu:KEPUTUSANRBP','verified']], function () {
        Route::post('/', 'ProposalDonasiController@store');
        Route::post('/data', 'ProposalDonasiController@getData');
        Route::delete('/{id}', 'ProposalDonasiController@destroy');
    });

    Route::group(['prefix' => 'kerjasama2','middleware' => ['check.role.menu:KEPUTUSANRBP','verified']], function () {
        Route::post('/', 'ProposalKerjasamaController@store');
        Route::post('/data', 'ProposalKerjasamaController@getData');
        Route::delete('/{id}', 'ProposalKerjasamaController@destroy');
    });

    Route::group(['prefix' => 'pj','middleware' => ['check.role.menu:KEPUTUSANRBP','verified']], function () {
        Route::post('/', 'ProposalPJController@store');
        Route::post('/data', 'ProposalPJController@getData');
        Route::delete('/{id}', 'ProposalPJController@destroy');
    });

    Route::group(['prefix' => 'outcome','middleware' => ['check.role.menu:KEPUTUSANRBP','verified']], function () {
        Route::post('/', 'ProposalOutcomeController@store');
        Route::post('/data', 'ProposalOutcomeController@getData');
        Route::delete('/{id}', 'ProposalOutcomeController@destroy');
    });

    Route::group(['prefix' => 'pengalaman','middleware' => ['check.role.menu:KEPUTUSANRBP','verified']], function () {
        Route::post('/', 'ProposalPengalamanController@store');
        Route::post('/data', 'ProposalPengalamanController@getData');
        Route::delete('/{id}', 'ProposalPengalamanController@destroy');
    });

    Route::group(['prefix' => 'approve','middleware' => ['check.role.menu:KEPUTUSANRBP','verified']], function () {
        Route::post('/{id}', 'ApprovalProposalController@store');
    });

    Route::post('/send/{id}', 'ApprovalProposalController@send');
});

Route::group(['prefix' => 'sk-kegiatan','middleware' => ['check.role.menu:SKKM','verified']], function () {
    Route::get('/{id?}', 'SKKegiatanKemaslahatanController@index');
    Route::post('/data', 'SKKegiatanKemaslahatanController@getData');
    Route::post('/', 'SKKegiatanKemaslahatanController@store');
    Route::post('/update/{id}', 'SKKegiatanKemaslahatanController@update');

    Route::group(['prefix' => 'proposal-files','middleware' => ['check.role.menu:SKKM','verified']], function () {
        Route::get('/{id}', 'ProposalFilesController@index');
        Route::post('/data', 'ProposalFilesController@getData');
        Route::post('/upload', 'ProposalFilesController@store');
    });

    Route::group(['prefix' => 'pengurus','middleware' => ['check.role.menu:SKKM','verified']], function () {
        Route::post('/', 'ProposalLembagaPengurusController@store');
        Route::post('/data', 'ProposalLembagaPengurusController@getData');
        Route::delete('/{id}', 'ProposalLembagaPengurusController@destroy');
    });

    Route::group(['prefix' => 'kerjasama','middleware' => ['check.role.menu:SKKM','verified']], function () {
        Route::post('/', 'ProposalLembagaKerjasamaController@store');
        Route::post('/data', 'ProposalLembagaKerjasamaController@getData');
        Route::delete('/{id}', 'ProposalLembagaKerjasamaController@destroy');
    });

    Route::group(['prefix' => 'persiapan','middleware' => ['check.role.menu:SKKM','verified']], function () {
        Route::post('/', 'ProposalPersiapanController@store');
        Route::post('/data', 'ProposalPersiapanController@getData');
        Route::delete('/{id}', 'ProposalPersiapanController@destroy');
    });
    
    Route::group(['prefix' => 'rab','middleware' => ['check.role.menu:SKKM','verified']], function () {
        Route::post('/', 'ProposalRABController@store');
        Route::post('/data', 'ProposalRABController@getData');
        Route::delete('/{id}', 'ProposalRABController@destroy');
    });

    Route::group(['prefix' => 'donasi','middleware' => ['check.role.menu:SKKM','verified']], function () {
        Route::post('/', 'ProposalDonasiController@store');
        Route::post('/data', 'ProposalDonasiController@getData');
        Route::delete('/{id}', 'ProposalDonasiController@destroy');
    });

    Route::group(['prefix' => 'kerjasama2','middleware' => ['check.role.menu:SKKM','verified']], function () {
        Route::post('/', 'ProposalKerjasamaController@store');
        Route::post('/data', 'ProposalKerjasamaController@getData');
        Route::delete('/{id}', 'ProposalKerjasamaController@destroy');
    });

    Route::group(['prefix' => 'pj','middleware' => ['check.role.menu:SKKM','verified']], function () {
        Route::post('/', 'ProposalPJController@store');
        Route::post('/data', 'ProposalPJController@getData');
        Route::delete('/{id}', 'ProposalPJController@destroy');
    });

    Route::group(['prefix' => 'outcome','middleware' => ['check.role.menu:SKKM','verified']], function () {
        Route::post('/', 'ProposalOutcomeController@store');
        Route::post('/data', 'ProposalOutcomeController@getData');
        Route::delete('/{id}', 'ProposalOutcomeController@destroy');
    });

    Route::group(['prefix' => 'pengalaman','middleware' => ['check.role.menu:SKKM','verified']], function () {
        Route::post('/', 'ProposalPengalamanController@store');
        Route::post('/data', 'ProposalPengalamanController@getData');
        Route::delete('/{id}', 'ProposalPengalamanController@destroy');
    });

    Route::group(['prefix' => 'approve','middleware' => ['check.role.menu:SKKM','verified']], function () {
        Route::post('/{id}', 'ApprovalProposalController@store');
    });

    Route::post('/send/{id}', 'ApprovalProposalController@send');
});

Route::group(['prefix' => 'sp-kegiatan','middleware' => ['check.role.menu:SPKM','verified']], function () {
    Route::get('/{id?}', 'SPKegiatanKemaslahatanController@index');
    Route::post('/data', 'SPKegiatanKemaslahatanController@getData');
    Route::post('/', 'SPKegiatanKemaslahatanController@store');
    Route::post('/update/{id}', 'SPKegiatanKemaslahatanController@update');

    Route::group(['prefix' => 'proposal-files','middleware' => ['check.role.menu:SPKM','verified']], function () {
        Route::get('/{id}', 'ProposalFilesController@index');
        Route::post('/data', 'ProposalFilesController@getData');
        Route::post('/upload', 'ProposalFilesController@store');
    });

    Route::group(['prefix' => 'pengurus','middleware' => ['check.role.menu:SPKM','verified']], function () {
        Route::post('/', 'ProposalLembagaPengurusController@store');
        Route::post('/data', 'ProposalLembagaPengurusController@getData');
        Route::delete('/{id}', 'ProposalLembagaPengurusController@destroy');
    });

    Route::group(['prefix' => 'kerjasama','middleware' => ['check.role.menu:SPKM','verified']], function () {
        Route::post('/', 'ProposalLembagaKerjasamaController@store');
        Route::post('/data', 'ProposalLembagaKerjasamaController@getData');
        Route::delete('/{id}', 'ProposalLembagaKerjasamaController@destroy');
    });

    Route::group(['prefix' => 'persiapan','middleware' => ['check.role.menu:SPKM','verified']], function () {
        Route::post('/', 'ProposalPersiapanController@store');
        Route::post('/data', 'ProposalPersiapanController@getData');
        Route::delete('/{id}', 'ProposalPersiapanController@destroy');
    });
    
    Route::group(['prefix' => 'rab','middleware' => ['check.role.menu:SPKM','verified']], function () {
        Route::post('/', 'ProposalRABController@store');
        Route::post('/data', 'ProposalRABController@getData');
        Route::delete('/{id}', 'ProposalRABController@destroy');
    });

    Route::group(['prefix' => 'donasi','middleware' => ['check.role.menu:SPKM','verified']], function () {
        Route::post('/', 'ProposalDonasiController@store');
        Route::post('/data', 'ProposalDonasiController@getData');
        Route::delete('/{id}', 'ProposalDonasiController@destroy');
    });

    Route::group(['prefix' => 'kerjasama2','middleware' => ['check.role.menu:SPKM','verified']], function () {
        Route::post('/', 'ProposalKerjasamaController@store');
        Route::post('/data', 'ProposalKerjasamaController@getData');
        Route::delete('/{id}', 'ProposalKerjasamaController@destroy');
    });

    Route::group(['prefix' => 'pj','middleware' => ['check.role.menu:SPKM','verified']], function () {
        Route::post('/', 'ProposalPJController@store');
        Route::post('/data', 'ProposalPJController@getData');
        Route::delete('/{id}', 'ProposalPJController@destroy');
    });

    Route::group(['prefix' => 'outcome','middleware' => ['check.role.menu:SPKM','verified']], function () {
        Route::post('/', 'ProposalOutcomeController@store');
        Route::post('/data', 'ProposalOutcomeController@getData');
        Route::delete('/{id}', 'ProposalOutcomeController@destroy');
    });

    Route::group(['prefix' => 'pengalaman','middleware' => ['check.role.menu:SPKM','verified']], function () {
        Route::post('/', 'ProposalPengalamanController@store');
        Route::post('/data', 'ProposalPengalamanController@getData');
        Route::delete('/{id}', 'ProposalPengalamanController@destroy');
    });

    Route::group(['prefix' => 'approve','middleware' => ['check.role.menu:SPKM','verified']], function () {
        Route::post('/{id}', 'ApprovalProposalController@store');
    });

    Route::post('/send/{id}', 'ApprovalProposalController@send');
});

Route::group(['prefix' => 'proposal-layak-teknis','middleware' => ['check.role.menu:PROPOSALLT','verified']], function () {
    Route::get('/{id?}', 'ProposalLayakTeknis\ProposalLayakTeknisController@index');
    Route::post('/data', 'ProposalLayakTeknis\ProposalLayakTeknisController@getData');

    Route::group(['prefix' => 'item-penilaian','middleware' => ['check.role.menu:PROPOSALLT','verified']], function () {
        Route::put('/{id}', 'ProposalLayakTeknis\ItemPenilaianController@update');
	Route::put('/simpan-penilaia-mitra/{id}', 'ProposalLayakTeknis\ItemPenilaianController@update_penilaian_mitra');
	Route::put('/analis-kepatuhan/{id}', 'ProposalLayakTeknis\ItemPenilaianController@update_analis_kepatuhan');
        Route::post('/data', 'ProposalLayakTeknis\ItemPenilaianController@getData');
    }); 

    Route::group(['prefix' => 'analisa','middleware' => ['check.role.menu:PROPOSALLT','verified']], function () {
        Route::put('/{id}', 'ProposalLayakTeknis\AnalisaController@update');
        Route::post('/data', 'ProposalLayakTeknis\AnalisaController@getData');
    }); 

    Route::group(['prefix' => 'rencana','middleware' => ['check.role.menu:PROPOSALLT','verified']], function () {
        Route::put('/{id}', 'ProposalLayakTeknis\RencanaController@update');
        Route::post('/data', 'ProposalLayakTeknis\RencanaController@getData');
    }); 

    Route::group(['prefix' => 'pelaksanaan-penilaian','middleware' => ['check.role.menu:PROPOSALLT','verified']], function () {
        Route::put('/{id}', 'ProposalLayakTeknis\PelaksanaanPenilaianController@update');
        Route::post('/data', 'ProposalLayakTeknis\PelaksanaanPenilaianController@getData');
    }); 

    Route::group(['prefix' => 'deskripsi','middleware' => ['check.role.menu:PROPOSALLT','verified']], function () {
        Route::put('/{id}', 'ProposalLayakTeknis\DeskripsiController@update');
        Route::post('/data', 'ProposalLayakTeknis\DeskripsiController@getData');
    }); 

    Route::group(['prefix' => 'print','middleware' => ['check.role.menu:PROPOSALLT','verified']], function () {
        Route::get('/sk/{id}', 'PrintController@sk');
        Route::get('/ringkasan/{id}', 'PrintController@ringkasan');
        Route::get('/spjtm/{id}', 'PrintController@spjtm');
    });

    Route::group(['prefix' => 'proposal-files','middleware' => ['check.role.menu:PROPOSALLT','verified']], function () {
        Route::get('/{id}', 'ProposalFilesController@index');
        Route::post('/data', 'ProposalFilesController@getData');
        Route::post('/upload', 'ProposalFilesController@store');
        Route::post('/catatan', 'ProposalFilesController@update');
    });

    Route::group(['prefix' => 'pengurus','middleware' => ['check.role.menu:PROPOSALLT','verified']], function () {
        Route::post('/', 'ProposalLembagaPengurusController@store');
        Route::post('/data', 'ProposalLembagaPengurusController@getData');
        Route::delete('/{id}', 'ProposalLembagaPengurusController@destroy');
    });

    Route::group(['prefix' => 'kerjasama','middleware' => ['check.role.menu:PROPOSALLT','verified']], function () {
        Route::post('/', 'ProposalLembagaKerjasamaController@store');
        Route::post('/data', 'ProposalLembagaKerjasamaController@getData');
        Route::delete('/{id}', 'ProposalLembagaKerjasamaController@destroy');
    });

    Route::group(['prefix' => 'persiapan','middleware' => ['check.role.menu:PROPOSALLT','verified']], function () {
        Route::post('/', 'ProposalPersiapanController@store');
        Route::post('/data', 'ProposalPersiapanController@getData');
        Route::delete('/{id}', 'ProposalPersiapanController@destroy');
    });
    
    Route::group(['prefix' => 'rab','middleware' => ['check.role.menu:PROPOSALLT','verified']], function () {
        Route::post('/', 'ProposalRABController@store');
        Route::post('/data', 'ProposalRABController@getData');
        Route::delete('/{id}', 'ProposalRABController@destroy');
    });

    Route::group(['prefix' => 'donasi','middleware' => ['check.role.menu:PROPOSALLT','verified']], function () {
        Route::post('/', 'ProposalDonasiController@store');
        Route::post('/data', 'ProposalDonasiController@getData');
        Route::delete('/{id}', 'ProposalDonasiController@destroy');
    });

    Route::group(['prefix' => 'kerjasama2','middleware' => ['check.role.menu:PROPOSALLT','verified']], function () {
        Route::post('/', 'ProposalKerjasamaController@store');
        Route::post('/data', 'ProposalKerjasamaController@getData');
        Route::delete('/{id}', 'ProposalKerjasamaController@destroy');
    });

    Route::group(['prefix' => 'pj','middleware' => ['check.role.menu:PROPOSALLT','verified']], function () {
        Route::post('/', 'ProposalPJController@store');
        Route::post('/data', 'ProposalPJController@getData');
        Route::delete('/{id}', 'ProposalPJController@destroy');
    });

    Route::group(['prefix' => 'outcome','middleware' => ['check.role.menu:PROPOSALLT','verified']], function () {
        Route::post('/', 'ProposalOutcomeController@store');
        Route::post('/data', 'ProposalOutcomeController@getData');
        Route::delete('/{id}', 'ProposalOutcomeController@destroy');
    });

    Route::group(['prefix' => 'pengalaman','middleware' => ['check.role.menu:PROPOSALLT','verified']], function () {
        Route::post('/', 'ProposalPengalamanController@store');
        Route::post('/data', 'ProposalPengalamanController@getData');
        Route::delete('/{id}', 'ProposalPengalamanController@destroy');
    });

    Route::group(['prefix' => 'approve','middleware' => ['check.role.menu:PROPOSALLT','verified']], function () {
        Route::post('/{id}', 'ApprovalProposalController@store');
    });

    Route::post('/send/{id}', 'ApprovalProposalController@send');
}); 

Route::group(['prefix' => 'proposal-penilaian','middleware' => ['check.role.menu:PROPOSALPEN','verified']], function () {
    Route::get('/{id?}', 'ProposalPenilaian\ProposalPenilaianController@index');
    Route::post('/data', 'ProposalPenilaian\ProposalPenilaianController@getData');
    
    Route::group(['prefix' => 'item-penilaian','middleware' => ['check.role.menu:PROPOSALPEN','verified']], function () {
        Route::put('/{id}', 'ProposalPenilaian\ItemPenilaianController@update');
        Route::post('/data', 'ProposalPenilaian\ItemPenilaianController@getData');
    }); 
}); 

Route::group(['prefix' => 'proposal-pengajuan','middleware' => ['check.role.menu:PROPOSALPEN','verified']], function () {
    Route::group(['prefix' => 'proposal-input','middleware' => ['check.role.menu:PROPOSALPEN','verified']], function () {
        Route::get('/', 'ProposalPengajuan\ProposalPengajuanController@index');
        Route::post('/store', 'ProposalPengajuan\ProposalPenilaianController@store');
    }); 
    Route::group(['prefix' => 'proposal-upload','middleware' => ['check.role.menu:PROPOSALPEN','verified']], function () {
        Route::get('/', 'ProposalPengajuan\ProposalUploadController@index');
        Route::post('/store', 'ProposalPengajuan\ProposalUploadController@store');
    }); 
}); 

Route::group(['prefix' => 'proposal-monitoring','middleware' => ['check.role.menu:PROPOSALMON','verified']], function () {
    Route::get('/{id?}', 'ProposalMonitoring\ProposalMonitoringController@index');
    Route::post('/data', 'ProposalMonitoring\ProposalMonitoringController@getData');
    
    Route::group(['prefix' => 'proposal-laporan-monitoring','middleware' => ['check.role.menu:PROPOSALMON','verified']], function () {
        Route::post('/', 'ProposalMonitoring\ProposalLaporanMonitoringController@store');
        Route::post('/data', 'ProposalMonitoring\ProposalLaporanMonitoringController@getData');
        Route::put('/{id}', 'ProposalMonitoring\ProposalLaporanMonitoringController@update');
    }); 
}); 
