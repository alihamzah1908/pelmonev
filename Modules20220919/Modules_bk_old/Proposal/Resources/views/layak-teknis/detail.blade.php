@extends('layouts.app')

@section('content')

<div id="accordion-default">
    <div class="card">
        <div class="card-header">
            <h6 class="card-title">
                <a data-toggle="collapse" class="text-default" href="#accordion-detail">Detail Proposal Layak Teknis </a>
            </h6>
        </div>

        <div id="accordion-detail" class="collapse show" data-parent="#accordion-default">
            <div class="card-body">
                <ul class="nav nav-tabs nav-tabs-solid nav-justified rounded border-0">
                    <li class="nav-item"><a href="#tab-data-proposal" class="nav-link rounded-left active" data-toggle="tab"><i class="{{ $proposal->proposal_fill_st == 1 ? 'icon-floppy-disk' : 'icon-list' }} d-block mb-1 mt-1"></i>Proposal</a></li>
                    <li class="nav-item"><a href="#tab-data-lembaga" class="nav-link rounded-left" data-toggle="tab"><i class="{{ $proposal->lembaga_fill_st == 1 ? 'icon-floppy-disk' : 'icon-list' }} d-block mb-1 mt-1"></i>Lembaga</a></li>
                    <li class="nav-item"><a href="#tab-data-pengurus" class="nav-link rounded-left" data-toggle="tab"><i class="{{ $proposal->pengurus_fill_st == 1 ? 'icon-floppy-disk' : 'icon-list' }} d-block mb-1 mt-1"></i>Pengurus</a></li>
                    <li class="nav-item"><a href="#tab-data-profil" class="nav-link rounded-left" data-toggle="tab"><i class="{{ $proposal->profil_fill_st == 1 ? 'icon-floppy-disk' : 'icon-list' }} d-block mb-1 mt-1"></i>Profil</a></li>
                    <li class="nav-item"><a href="#tab-data-informasi" class="nav-link rounded-left" data-toggle="tab"><i class="{{ $proposal->informasi_fill_st == 1 ? 'icon-floppy-disk' : 'icon-list' }} d-block mb-1 mt-1"></i>Informasi</a></li>
                    <li class="nav-item"><a href="#tab-data-kontak" class="nav-link rounded-left" data-toggle="tab"><i class="{{ $proposal->kontak_fill_st == 1 ? 'icon-floppy-disk' : 'icon-list' }} d-block mb-1 mt-1"></i>Kontak</a></li>
                    <li class="nav-item"><a href="#tab-data-rab" class="nav-link rounded-left" data-toggle="tab"><i class="{{ $proposal->rab_fill_st == 1 ? 'icon-floppy-disk' : 'icon-list' }} d-block mb-1 mt-1"></i>RAB</a></li>
                    <li class="nav-item"><a href="#tab-data-upload" class="nav-link rounded-left" data-toggle="tab"><i class="{{ $proposal->file_fill_st == 1 ? 'icon-floppy-disk' : 'icon-list' }} d-block mb-1 mt-1"></i>Upload Berkas</a></li>
                </ul>
        
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="tab-data-proposal">
                        <form class="form-validate-jquery form-proposal" id="form-proposal" action="#">
                            @csrf
                            <input type="hidden" name="proposal_fill_st" value="1">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">Judul <span class="text-danger">*</span></label>
                                        <input type="text" name="judul_proposal" class="form-control" placeholder="Judul Proposal" aria-invalid="false" required="required" value="{{ $proposal->judul_proposal }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">Mitra Kemaslahatan <span class="text-danger">*</span></label>
                                        @if (!isRoleUser('mitra'))    
                                        @if ($proposal->proses_st == 'PROSES_ST_30')    
                                        <select name="trx_mitra_kemaslahatan_id" id="trx_mitra_kemaslahatan_id" data-placeholder="Pilih Data" class="form-control form-control-select2" required data-fouc>
                                        </select>
                                        @else
                                        <input type="text" name="mitra_kemaslahatan_nm" class="form-control" placeholder="" aria-invalid="false" readonly="readonly">
                                        @endif
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">Nominal <span class="text-danger">*</span></label>
                                        <input type="text" name="nominal" class="form-control money" placeholder="" aria-invalid="false" required="required">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">Ruang Lingkup <span class="text-danger">*</span></label>
                                        <select name="ruang_lingkup" id="ruang_lingkup" data-placeholder="Pilih Data" class="form-control form-control-select2" required data-fouc>
                                            {!! comCodeOptions('RUANG_LINGKUP') !!}
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group form-group-float">
                                <label class="form-group-float-label is-visible">Nama Gedung</label>
                                <input type="text" name="lokasi_nama_gedung" class="form-control" placeholder="Nama Gedung " aria-invalid="false" required="required" value="{{ $proposal->lokasi_nama_gedung }}">
                            </div>
                            <div class="form-group form-group-float">
                                <label class="form-group-float-label is-visible">Propinsi</label>
                                <select name="lokasi_region_prop" id="lokasi_region_prop" data-placeholder="Pilih Data" class="form-control form-control-select2" data-fouc>
                                </select>
                            </div>
                            <div class="form-group form-group-float">
                                <label class="form-group-float-label is-visible">Kabupaten</label>
                                <select name="lokasi_region_kab" id="lokasi_region_kab" data-placeholder="Pilih Data" class="form-control form-control-select2" data-fouc>
                                </select>
                            </div>
                            <div class="form-group form-group-float">
                                <label class="form-group-float-label is-visible">Kecamatan </label>
                                <select name="lokasi_region_kec" id="lokasi_region_kec" data-placeholder="Pilih Data" class="form-control form-control-select2" data-fouc>
                                </select>
                            </div>
                            <div class="form-group form-group-float">
                                <label class="form-group-float-label is-visible">Komunitas / Kelompok yang menjadi tempat pelaksanaan kegiatan</label>
                                <textarea name="lokasi_komunitas" id="lokasi_komunitas" class="form-control">{{ $proposal->lokasi_komunitas }}</textarea>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">Uraian Singkat <span class="text-danger">*</span></label>
                                        <textarea name="uraian_singkat_proposal" id="uraian_singkat_proposal" class="form-control" required="required">{{ $proposal->uraian_singkat_proposal }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">Deskripsi Program yang Diusulkan  <span class="text-danger">*</span></label>
                                        <textarea name="deskripsi_singkat_proposal" id="deskripsi_singkat_proposal" class="form-control" required="required" maxlength="3000">{{ $proposal->deskripsi_singkat_proposal }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
        
                    <div class="tab-pane fade show" id="tab-data-lembaga">
                        <form class="form-validate-jquery form-proposal" id="form-lembaga" action="#">
                            @csrf
                            <input type="hidden" name="lembaga_fill_st" value="1">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">Nama Lembaga<span class="text-danger">*</span></label>
                                        <input type="text" name="pemohon_nm" class="form-control" value="{{ $proposal->pemohon_nm }}" readonly="readonly" placeholder="Nama Pemohon" aria-invalid="false">
                                    </div>
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">Akta Pendirian</label>
                                        <input type="text" name="akta_pendirian" class="form-control" value="{{ $proposal->akta_pendirian }}" required="" placeholder="" aria-invalid="false">
                                    </div>
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">Akta Perubahan Terakhir</label>
                                        <input type="text" name="akta_perubahan_terakhir" class="form-control" placeholder="" value="{{ $proposal->akta_perubahan_terakhir }}" required="" aria-invalid="false">
                                    </div>
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">No SK Pengesahan Pendirian</label>
                                        <input type="text" name="sk_pengesahan_pendirian_no" class="form-control" placeholder="" value="{{ $proposal->sk_pengesahan_pendirian_no }}" required="" aria-invalid="false">
                                    </div>
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">No SK Pengesahan Perubahan Terakhir</label>
                                        <input type="text" name="sk_pengesahan_perubahan_terakhir_no" class="form-control" placeholder="" value="{{ $proposal->sk_pengesahan_perubahan_terakhir_no }}" required="" aria-invalid="false">
                                    </div>
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">No KTP Pimpinan</label>
                                        <input type="text" name="ktp_no_pimpinan" class="form-control" placeholder="" value="{{ $proposal->ktp_no_pimpinan }}" required="" aria-invalid="false">
                                    </div>
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">No NPWP Lembaga</label>
                                        <input type="text" name="npwp_no_lembaga" class="form-control" placeholder="" value="{{ $proposal->npwp_no_lembaga }}" required="" aria-invalid="false">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
        
                    <div class="tab-pane fade show" id="tab-data-pengurus">
                        <form class="form-validate-jquery form-pengurus-kerjasama" action="pengurus" id="form-pengurus" action="#">
                            @csrf
                            <input type="hidden" name="id" value="{{ $proposal->trx_proposal_id }}">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">Nama Pengurus <span class="text-danger">*</span></label>
                                        <input type="text" name="pengurus_nm" class="form-control form-child-field">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">Jabatan <span class="text-danger">*</span></label>
                                        <input type="text" name="jabatan_nm" class="form-control form-child-field">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">Pekerjaan <span class="text-danger">*</span></label>
                                        <input type="text" name="pekerjaan_nm" class="form-control form-child-field">
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="table-responsive">
                            <table class="table datatable-pagination" id="tabel-pengurus" width="100%">
                                <thead>
                                    <tr>
                                        <th width="0%">Kode</th>
                                        <th width="20%" id="pengurus_nm_table">Nama Pengurus</th>
                                        <th width="20%" id="jabatan_nm_table">Jabatan</th>
                                        <th width="20%" id="pekerjaan_nm_table">Pekerjaan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
        
                    <div class="tab-pane fade show" id="tab-data-profil">
                        <form class="form-validate-jquery form-proposal" id="form-profil" action="#">
                            @csrf
                            <input type="hidden" name="profil_fill_st" value="1">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">Profil Singkat <span class="text-danger">*</span></label>
                                        <textarea name="profil_singkat" id="profil_singkat" class="form-control">{{ $proposal->profil_singkat }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
        
                    <div class="tab-pane fade show" id="tab-data-kerjasama">
                        <div class="alert bg-info text-white alert-styled-left alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
                            <span class="font-weight-semibold">Lembaga sudah pernah bekerjasama dengan Pemohon selama 2 thn terakhir.</span>
                        </div>  
                        <form class="form-validate-jquery form-pengurus-kerjasama" action="kerjasama" id="form-kerjasama" action="#">
                            @csrf
                            <input type="hidden" name="id" value="{{ $proposal->trx_proposal_id }}">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">Nama Lembaga <span class="text-danger">*</span></label>
                                        <input type="text" name="lembaga_nm" class="form-control form-child-field">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">Kegiatan <span class="text-danger">*</span></label>
                                        <input type="text" name="kegiatan_nm" class="form-control form-child-field">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">Nominal Bantuan <span class="text-danger">*</span></label>
                                        <input type="text" name="nominal_bantuan" class="form-control money form-child-field">
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="table-responsive">
                            <table class="table datatable-pagination" id="tabel-kerjasama" width="100%">
                                <thead>
                                    <tr>
                                        <th width="0%">Kode</th>
                                        <th width="20%" id="lembaga_nm_table">Nama Lembaga</th>
                                        <th width="20%" id="kegiatan_nm_table">Kegiatan</th>
                                        <th width="20%" id="nominal_bantuan_table">Nominal Bantuan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
        
                    <div class="tab-pane fade show" id="tab-data-informasi">
                        <form class="form-validate-jquery form-proposal" id="form-informasi" action="#">
                            @csrf
                            <input type="hidden" name="informasi_fill_st" value="1">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">Alamat Kantor <span class="text-danger">*</span></label>
                                        <textarea name="address" id="address" class="form-control">{{ $proposal->address }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">No Telepon Kantor <span class="text-danger">*</span></label>
                                        <input type="text" name="phone" class="form-control" value="{{ $proposal->phone }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">Website <span class="text-danger">*</span></label>
                                        <input type="text" name="website" class="form-control" value="{{ $proposal->website }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">Akun Sosial Media <span class="text-danger">*</span></label>
                                        <input type="text" name="socmed" class="form-control" value="{{ $proposal->socmed }}">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
        
                    <div class="tab-pane fade show" id="tab-data-kontak">
                        <form class="form-validate-jquery form-proposal" id="form-kontak" action="#">
                            @csrf
                            <input type="hidden" name="kontak_fill_st" value="1">
                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">Nama Lengkap <span class="text-danger">*</span></label>
                                        <input type="text" name="penanggung_jawab_nm" class="form-control" value="{{ $proposal->penanggung_jawab_nm }}">
                                    </div>
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">Email <span class="text-danger">*</span></label>
                                        <input type="text" name="penanggung_jawab_email" class="form-control" value="{{ $proposal->penanggung_jawab_email }}">
                                    </div>
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">Nomor Handphone <span class="text-danger">*</span></label>
                                        <input type="text" name="penanggung_jawab_phone" class="form-control" value="{{ $proposal->penanggung_jawab_phone }}">
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">Bank Syariah <span class="text-danger">*</span></label>
                                        <select name="bank_cd" id="bank_cd" data-placeholder="Pilih Data" class="form-control form-control-select2" required data-fouc>
                                        @foreach ($banks as $item)
                                            <option value="{{ $item->bank_cd }}">{{ $item->bank_nm }}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">Cabang <span class="text-danger">*</span></label>
                                        <input type="text" name="bank_branch" class="form-control" value="{{ $proposal->bank_branch }}">
                                    </div>
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">Atas Nama <span class="text-danger">*</span></label>
                                        <input type="text" name="bank_holder" class="form-control" value="{{ $proposal->bank_holder }}">
                                    </div>
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">No Rekening <span class="text-danger">*</span></label>
                                        <input type="text" name="bank_account_no" class="form-control" value="{{ $proposal->bank_holder }}">
                                    </div>
                                    {{-- <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">Scan Rekening Bank <span class="text-danger">*</span></label>
                                        <input type="file" name="bank_account_file" id="bank_account_file" class="form-control">
                                    </div> --}}
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="tab-pane fade show" id="tab-data-rab">
                        <form class="form-validate-jquery form-pengurus-kerjasama" action="rab" id="form-rab" action="#">
                            @csrf
                            <input type="hidden" name="id" value="{{ $proposal->trx_proposal_id }}">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">Jenis Pengeluaran <span class="text-danger">*</span></label>
                                        <input type="text" name="rab_jenis_pengeluaran" class="form-control form-child-field">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">Jumlah Unit <span class="text-danger">*</span></label>
                                        <input type="number" name="rab_jumlah_unit" class="form-control form-child-field">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">Biaya Satuan <span class="text-danger">*</span></label>
                                        <input type="text" name="rab_biaya_satuan" class="form-control money form-child-field">
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="table-responsive">
                            <table class="table datatable-pagination" id="tabel-rab" width="100%">
                                <thead>
                                    <tr>
                                        <th width="0%">Kode</th>
                                        <th width="0%">No</th>
                                        <th width="20%" id="jenis_pengeluaran_table">Jenis Pengeluaran</th>
                                        <th width="20%" id="jumlah_unit_table">Jumlah Unit</th>
                                        <th width="20%" id="biaya_satuan_table">Biaya Satuan</th>
                                        <th width="20%" id="nominal_bantuan_table">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
        
                    <div class="tab-pane fade show" id="tab-data-upload">
                        <div class="table-responsive">
                            <table class="table datatable-pagination" id="tabel-files" width="100%">
                                <thead>
                                    <tr>
                                        <th width="10%">No</th>
                                        <th width="0%">Kode</th>
                                        <th width="60%" id="file_tp_table">Nama File</th>
                                        <th width="60%" id="file_tp_nm_table">Nama File</th>
                                        <th width="10%" id="file_ext_table">Ekstensi File</th>
                                        <th width="20%" id="note_table">Catatan</th>
                                        <th width="10%" id="action_table">#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h6 class="card-title">
                <a class="collapsed text-default" data-toggle="collapse" href="#accordion-penilaian-program">Penilaian Kelayakan Kegiatan Kemaslahatan  </a>
            </h6>
        </div>

        <div id="accordion-penilaian-program" class="collapse" data-parent="#accordion-default">
            <div class="card-body">
                <ul class="nav nav-tabs nav-tabs-solid nav-justified rounded border-0">
                    <li class="nav-item"><a href="#tab-penprog-deskripsi" class="nav-link rounded-left active" data-toggle="tab"><i class="d-block mb-1 mt-1"></i>Deskripsi</a></li>
                    <li class="nav-item"><a href="#tab-penprog-rencana" class="nav-link rounded-left" data-toggle="tab"><i class="d-block mb-1 mt-1"></i>Rencana</a></li>
                    <li class="nav-item"><a href="#tab-penprog-pelaksanaan-penilaian" class="nav-link rounded-left" data-toggle="tab"><i class="d-block mb-1 mt-1"></i>Pelaksanaan Penilaian</a></li>
                    <li class="nav-item"><a href="#tab-penprog-aspek-penilaian" class="nav-link rounded-left" data-toggle="tab"><i class="d-block mb-1 mt-1"></i>Aspek Penilaian</a></li>
                    <li class="nav-item"><a href="#tab-penprog-hasil-penilaian" class="nav-link rounded-left" data-toggle="tab"><i class="d-block mb-1 mt-1"></i>Hasil Penilaian</a></li>
                    <li class="nav-item"><a href="#tab-penprog-analisa" class="nav-link rounded-left" data-toggle="tab"><i class="d-block mb-1 mt-1"></i>Analisa</a></li>
                </ul>
                
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="tab-penprog-deskripsi">
                        <form class="form-validate-jquery" id="form-deskripsi" action="#">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">Nama Program <span class="text-danger">*</span></label>
                                        <input type="text" name="nama_program" class="form-control" placeholder="Nama Program" aria-invalid="false" required="required" value="{{ $deskripsi->nama_program }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">Sistem Penyaluran <span class="text-danger">*</span></label>
                                        <input type="text" name="sistem_penyaluran" class="form-control" placeholder="Sistem Penyaluran" aria-invalid="false" required="required" value="{{ $deskripsi->sistem_penyaluran }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">Sub Program <span class="text-danger">*</span></label>
                                        <input type="text" name="sub_program" class="form-control" placeholder="Sub Program " aria-invalid="false" required="required" value="{{ $deskripsi->sub_program }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">Tujuan Program <span class="text-danger">*</span></label>
                                        <input type="text" name="tujuan_program" class="form-control" placeholder="Tujuan Program" aria-invalid="false" required="required" value="{{ $deskripsi->tujuan_program }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">Anggaran dan Sumber Dana <span class="text-danger">*</span></label>
                                        <input type="text" name="anggaran_sumberdana" class="form-control" placeholder="Tujuan Program" aria-invalid="false" required="required" value="{{ $deskripsi->anggaran_sumberdana }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">Rencana Lokasi <span class="text-danger">*</span></label>
                                        <input type="text" name="rencana_lokasi" class="form-control" placeholder="Rencana Lokasi" aria-invalid="false" required="required" value="{{ $deskripsi->rencana_lokasi }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">Penerima Maslahat <span class="text-danger">*</span></label>
                                        <input type="text" name="penerima_maslahat" class="form-control" placeholder="Penerima Maslahat" aria-invalid="false" required="required" value="{{ $deskripsi->penerima_maslahat }}">
                                    </div>
                                </div>
                            </div>
                            @if (isRoleUser('regas'))    
                            <div class="d-flex justify-content-end align-items-center">
                                <button type="submit" class="btn btn-primary legitRipple">Simpan <i class="icon-floppy-disk ml-2"></i></button>
                                <button type="reset" class="btn btn-light ml-2 legitRipple" id="reset">Selesai <i class="icon-reload-alt ml-2"></i></button>
                            </div>
                            @endif
                        </form>
                    </div>
                
                    <div class="tab-pane fade show" id="tab-penprog-rencana">
                        <form class="form-validate-jquery" id="form-rencana" action="#">
                            @csrf
                            <div class="form-group form-group-float">
                                <label class="form-group-float-label is-visible">Mitra Kerja Program <span class="text-danger">*</span></label>
                                <input type="text" name="rencana_mitra_kerja_program" class="form-control" placeholder="Mitra Kerja Program" aria-invalid="false" readonly="readonly" value="{{ $mitra->mitra_kemaslahatan_nm }}">
                            </div>
                            <div class="form-group form-group-float">
                                <label class="form-group-float-label is-visible">Penanggung Jawab <span class="text-danger">*</span></label>
                                <input type="text" name="rencana_penanggung_jawab" class="form-control" placeholder="Penanggung Jawab" aria-invalid="false" value="{{ $mitra->email3 }}">
                            </div>
                            <div class="form-group form-group-float">
                                <label class="form-group-float-label is-visible">Alamat <span class="text-danger">*</span></label>
                                <textarea name="rencana_alamat" id="rencana_alamat" class="form-control" readonly="readonly">{{ $mitra->address }}</textarea>
                            </div>
                            <div class="form-group form-group-float">
                                <label class="form-group-float-label is-visible">Fax / Telepon / HP <span class="text-danger">*</span></label>
                                <input type="text" name="rencana_phone" class="form-control" placeholder="Fax / Telepon / HP" aria-invalid="false" value="{{ $mitra->phone }}">
                            </div>
                            <div class="form-group form-group-float">
                                <label class="form-group-float-label is-visible">Email <span class="text-danger">*</span></label>
                                <input type="text" name="rencana_email" class="form-control" placeholder="Email" aria-invalid="false" value="{{ $mitra->email }}">
                            </div>
                            <div class="d-flex justify-content-end align-items-center">
                                <button type="submit" class="btn btn-primary legitRipple">Simpan <i class="icon-floppy-disk ml-2"></i></button>
                                <button type="reset" class="btn btn-light ml-2 legitRipple" id="reset">Selesai <i class="icon-reload-alt ml-2"></i></button>
                            </div>
                        </form>
                    </div>
                
                    <div class="tab-pane fade show" id="tab-penprog-pelaksanaan-penilaian">
                        <form class="form-validate-jquery" id="form-pelaksanaan-penilaian" action="#">
                            @csrf
                            <div class="form-group form-group-float">
                                <label class="form-group-float-label is-visible">Hari, Tanggal, Waktu <span class="text-danger">*</span></label>
                                <input type="text" name="penilaian_datetime" class="form-control datetime-picker" placeholder="Hari, Tanggal, Waktu" aria-invalid="false">
                            </div>
                            {{-- <div class="form-group form-group-float">
                                <label class="form-group-float-label is-visible">Waktu <span class="text-danger">*</span></label>
                                <input type="text" name="pelaksanaan_penilaian_waktu" class="form-control time-picker" placeholder="Waktu" aria-invalid="false">
                            </div> --}}
                            <div class="form-group form-group-float">
                                <label class="form-group-float-label is-visible">Lokasi <span class="text-danger">*</span></label>
                                <textarea name="penilaian_lokasi" id="pelaksanaan_penilaian_lokasi" class="form-control ckeditor">{{ $pelaksanaanPenilaian->lokasi }}</textarea>
                            </div>
                            <div class="form-group form-group-float">
                                <label class="form-group-float-label is-visible">Petugas <span class="text-danger">*</span></label>
                                <input type="text" name="penilaian_petugas" class="form-control" placeholder="Petugas" aria-invalid="false" value="{{ $pelaksanaanPenilaian->petugas }}">
                            </div>
                            <div class="form-group form-group-float">
                                <label class="form-group-float-label is-visible">Pihak yang Ditemui <span class="text-danger">*</span></label>
                                <input type="text" name="penilaian_pihak" class="form-control" placeholder="Pihak yang Ditemui" aria-invalid="false" value="{{ $pelaksanaanPenilaian->pihak }}">
                            </div>
                            <div class="d-flex justify-content-end align-items-center">
                                <button type="submit" class="btn btn-primary legitRipple">Simpan <i class="icon-floppy-disk ml-2"></i></button>
                                <button type="reset" class="btn btn-light ml-2 legitRipple" id="reset">Selesai <i class="icon-reload-alt ml-2"></i></button>
                            </div>
                        </form>
                    </div>
                
                    <div class="tab-pane fade show" id="tab-penprog-aspek-penilaian">
                        <div class="table-responsive">
                            <table class="table datatable-pagination" id="tabel-penilaian-hasil" width="100%">
                                <thead style="">
                                    <tr>
                                        <th id="trx_proposal_layak_teknis_id_table"></th>
                                        <th width="1%" id="DT_RowIndex_table"></th>
                                        <th width="0%" id="layak_teknis_id_table"></th>
                                        <th width="80%" id="layak_teknis_nm_table"></th>
                                        <th width="20%" id="layak_teknis_value_radio_table"></th>
                                        <th id="layak_teknis_value_table"></th>
                                        <th id="layak_teknis_group_nm_table"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                
                    <div class="tab-pane fade show" id="tab-penprog-hasil-penilaian">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group form-group-float">
                                    <label class="form-group-float-label is-visible">Keterangan Hasil Penilaian</label>
                                </div>
                                <div class="table-responsive">
                                    <table class="table datatable-pagination" id="tabel-pengurus" width="100%">
                                        <thead>
                                            <tr>
                                                <th width="20%">Skor</th>
                                                <th width="20%">Ya</th>
                                                <th width="20%">Tidak</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>LOLOS</td>
                                                <td> > 17</td>
                                                <td>-</td>
                                            </tr>
                                            <tr>
                                                <td>DIPERTIMBANGKAN</td>
                                                <td>-</td>
                                                <td>12 s/d 17</td>
                                            </tr>
                                            <tr>
                                                <td>TIDAK LOLOS</td>
                                                <td>-</td>
                                                <td> < 12</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-group-float">
                                    <label class="form-group-float-label is-visible">Hasil Penilaian</label>
                                </div>
                                <div class="table-responsive">
                                    <table class="table datatable-pagination" id="tabel-pengurus" width="100%">
                                        <thead>
                                            <tr>
                                                <th width="20%"></th>
                                                <th width="20%">Ya</th>
                                                <th width="20%">Tidak</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Jumlah Skor</td>
                                                <td><h4 id="hasil-ya"></h4></td>
                                                <td><h4 id="hasil-tidak"></h4></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                
                    <div class="tab-pane fade show" id="tab-penprog-analisa">
                        <form class="form-validate-jquery" id="form-analisa" action="#">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">Judul Proposal <span class="text-danger">*</span></label>
                                        <input type="text" name="judul_proposal" class="form-control" placeholder="Judul Proposal" aria-invalid="false" required="required" value="{{ $proposal->judul_proposal }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">Kompetensi Tenaga Ahli <span class="text-danger">*</span></label>
                                        <textarea name="kompetensi_tenaga_ahli" id="kompetensi_tenaga_ahli" class="form-control">{{ $analisa->kompetensi_tenaga_ahli }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">Tujuan <span class="text-danger">*</span></label>
                                        <textarea name="tujuan" id="tujuan" class="form-control ckeditor">{{ $analisa->tujuan }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">Kapasitas Mitra <span class="text-danger">*</span></label>
                                        <textarea name="kapasitas_mitra" id="kapasitas_mitra" class="form-control ckeditor">{{ $analisa->kapasitas_mitra }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">Manfaat <span class="text-danger">*</span></label>
                                        <textarea name="manfaat" id="manfaat" class="form-control ckeditor">{{ $analisa->manfaat }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">Aspek Kewajaran Biaya <span class="text-danger">*</span></label>
                                        <textarea name="aspek_kewajaran_biaya" id="aspek_kewajaran_biaya ckeditor" class="form-control">{{ $analisa->aspek_kewajaran_biaya }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">Kuota Kegiatan <span class="text-danger">*</span></label>
                                        <textarea name="kuota_kegiatan" id="kuota_kegiatan" class="form-control ckeditor">{{ $analisa->kuota_kegiatan }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">Kuota Wilayah <span class="text-danger">*</span></label>
                                        <textarea name="kuota_wilayah" id="kuota_wilayah" class="form-control ckeditor">{{ $analisa->kuota_wilayah }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">Dampak Kuantitas <span class="text-danger">*</span></label>
                                        <textarea name="dampak_kuantitas" id="dampak_kuantitas" class="form-control ckeditor">{{ $analisa->dampak_kuantitas }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">Hukum <span class="text-danger">*</span></label>
                                        <textarea name="hukum" id="hukum" class="form-control ckeditor">{{ $analisa->hukum }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">Dampak Kualitas <span class="text-danger">*</span></label>
                                        <textarea name="dampak_kualitas" id="dampak_kualitas" class="form-control ckeditor">{{ $analisa->dampak_kualitas }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">Ekonomi <span class="text-danger">*</span></label>
                                        <textarea name="ekonomi" id="ekonomi" class="form-control ckeditor">{{ $analisa->ekonomi }}</textarea>
                                    </div>
                                </div>
                            </div>
                            @if (isRoleUser('regas'))     
                            <div class="d-flex justify-content-end align-items-center">
                                <button type="submit" class="btn btn-primary legitRipple">Simpan <i class="icon-floppy-disk ml-2"></i></button>
                                <button type="reset" class="btn btn-light ml-2 legitRipple" id="reset">Selesai <i class="icon-reload-alt ml-2"></i></button>
                            </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h6 class="card-title">
                <a class="collapsed text-default" data-toggle="collapse" href="#penilaian-mitra">Penilaian Mitra Kemaslahatan</a>
            </h6>
        </div>

        <div id="penilaian-mitra" class="collapse" data-parent="#accordion-default">
            <div class="card-body">
                <table class="table datatable-pagination" id="tabel-penilaian mitra" width="100%">
                    <thead>
                        <tr>
                            <th width="20%">JENIS PENILAIAN</th>
                            <th width="20%">STATUS PENILAIAN</th>
                            <th width="20%" colspan="2">SKORING</th>
                            <th width="20%">BOBOT</th>
                            <th width="20%">NILAI AKHIR</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td width="20%" rowspan="2">Manfaat</td>
                            <td width="20%" rowspan="2">Pemerintah dan Swasta</td>
                            <td width="20%">
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input pen-mitra" data-bobot = "30" name="pen_mitra_bh" id="pen_mitra_bh_5" value="5">
                                    <label class="custom-control-label" for="pen_mitra_bh_5">1. Pemerintah</label>
                                </div>
                            </td>
                            <td width="20%">5</td>
                            <td width="20%" rowspan="2">30</td>
                            <td width="20%" rowspan="2"><h4 id="pen_mitra_bh_nilai"></h4></td>
                        </tr>
                        <tr>
                            <td width="20%">
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input pen-mitra" data-bobot = "30" name="pen_mitra_bh" id="pen_mitra_bh_3" value="3">
                                    <label class="custom-control-label" for="pen_mitra_bh_3">2. Swasta</label>
                                </div>
                            </td>
                            <td width="20%">3</td>
                        </tr>

                        <tr>
                            <td width="20%" rowspan="5">SDM Pendamping </td>
                            <td width="20%" rowspan="5">Jumlah Total SDM</td>
                            <td width="20%">
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input pen-mitra" data-bobot = "20" name="pen_mitra_sdm_pen" id="pen_mitra_sdm_pen_5" value="5">
                                    <label class="custom-control-label" for="pen_mitra_sdm_pen_5">1. > 100</label>
                                </div>
                            </td>
                            <td width="20%">5</td>
                            <td width="20%" rowspan="5">20</td>
                            <td width="20%" rowspan="5"><h4 id="pen_mitra_sdm_pen_nilai"></h4></td>
                        </tr>
                        <tr>
                            <td width="20%">
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input pen-mitra" data-bobot = "20" name="pen_mitra_sdm_pen" id="pen_mitra_sdm_pen_4" value="4">
                                    <label class="custom-control-label" for="pen_mitra_sdm_pen_4">2. 61 - 100</label>
                                </div>
                            </td>
                            <td width="20%">4</td>
                        </tr>
                        <tr>
                            <td width="20%">
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input pen-mitra" data-bobot = "20" name="pen_mitra_sdm_pen" id="pen_mitra_sdm_pen_3" value="3">
                                    <label class="custom-control-label" for="pen_mitra_sdm_pen_3">3. 26 - 60</label>
                                </div>
                            </td>
                            <td width="20%">3</td>
                        </tr>
                        <tr>
                            <td width="20%">
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input pen-mitra" data-bobot = "20" name="pen_mitra_sdm_pen" id="pen_mitra_sdm_pen_2" value="2">
                                    <label class="custom-control-label" for="pen_mitra_sdm_pen_2">4. 11 - 250</label>
                                </div>
                            </td>
                            <td width="20%">2</td>
                        </tr>
                        <tr>
                            <td width="20%">
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input pen-mitra" data-bobot = "20" name="pen_mitra_sdm_pen" id="pen_mitra_sdm_pen_1" value="1">
                                    <label class="custom-control-label" for="pen_mitra_sdm_pen_1">5. 5 - 1</label>
                                </div>
                            </td>
                            <td width="20%">1</td>
                        </tr>

                        <tr>
                            <td width="20%" rowspan="5">Ruang Lingkup Kegiatan Pemberdayaan Masyarakat  </td>
                            <td width="20%" rowspan="5">
                                Pengalaman Mengelola Jenis Kegiatan Pemberdayaan Masyarakat 
                                1. Kegiatan Pelayanan Ibadah Haji, 
                                2. Pendidikan&Dakwah, 
                                3. Kesehatan, 
                                4. Sosial Keagamaan, 
                                5. Ekonomi Umat, 
                                6. Sarana&Prasarana Ibadah
                            </td>
                            <td width="20%">
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input pen-mitra" data-bobot = "20" name="pen_mitra_ruang_lingkup" id="pen_mitra_ruang_lingkup_5" value="5">
                                    <label class="custom-control-label" for="pen_mitra_ruang_lingkup_5">1. Mencakup ≥ 5 Ruang Lingkup Kegiatan</label>
                                </div>
                            </td>
                            <td width="20%">5</td>
                            <td width="20%" rowspan="5">20</td>
                            <td width="20%" rowspan="5"><h4 id="pen_mitra_ruang_lingkup_nilai"></h4></td>
                        </tr>
                        <tr>
                            <td width="20%">
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input pen-mitra" data-bobot = "20" name="pen_mitra_ruang_lingkup" id="pen_mitra_ruang_lingkup_4" value="4">
                                    <label class="custom-control-label" for="pen_mitra_ruang_lingkup_4">2. Mencakup 4 Ruang Lingkup Kegiatan</label>
                                </div>
                            </td>
                            <td width="20%">4</td>
                        </tr>
                        <tr>
                            <td width="20%">
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input pen-mitra" data-bobot = "20" name="pen_mitra_ruang_lingkup" id="pen_mitra_ruang_lingkup_3" value="3">
                                    <label class="custom-control-label" for="pen_mitra_ruang_lingkup_3">3. Mencakup 3 Ruang Lingkup Kegiatan</label>
                                </div>
                            </td>
                            <td width="20%">3</td>
                        </tr>
                        <tr>
                            <td width="20%">
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input pen-mitra" data-bobot = "20" name="pen_mitra_ruang_lingkup" id="pen_mitra_ruang_lingkup_2" value="2">
                                    <label class="custom-control-label" for="pen_mitra_ruang_lingkup_2">4. Mencakup 2 Ruang Lingkup Kegiatan</label>
                                </div>
                            </td>
                            <td width="20%">2</td>
                        </tr>
                        <tr>
                            <td width="20%">
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input pen-mitra" data-bobot = "20" name="pen_mitra_ruang_lingkup" id="pen_mitra_ruang_lingkup_1" value="1">
                                    <label class="custom-control-label" for="pen_mitra_ruang_lingkup_1">5. Mencakup 1 Ruang Lingkup Kegiatan</label>
                                </div>
                            </td>
                            <td width="20%">1</td>
                        </tr>

                        <tr>
                            <td width="20%" rowspan="5">Dana Kelolaan	</td>
                            <td width="20%" rowspan="5">Pengalaman Mengelola Jumlah Dana Kelolaan Kegiatan</td>
                            <td width="20%">
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input pen-mitra"  data-bobot = "20" name="pen_mitra_dk" id="pen_mitra_dk_5" value="5">
                                    <label class="custom-control-label" for="pen_mitra_dk_5">1. > Rp. 500 juta</label>
                                </div>
                            </td>
                            <td width="20%">5</td>
                            <td width="20%" rowspan="5">20</td>
                            <td width="20%" rowspan="5"><h4 id="pen_mitra_dk_nilai"></h4></td>
                        </tr>
                        <tr>
                            <td width="20%">
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input pen-mitra" data-bobot = "20" name="pen_mitra_dk" id="pen_mitra_dk_4" value="4">
                                    <label class="custom-control-label" for="pen_mitra_dk_4">2.  Rp. 300 - 500 Juta</label>
                                </div>
                            </td>
                            <td width="20%">4</td>
                        </tr>
                        <tr>
                            <td width="20%">
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input pen-mitra" data-bobot = "20" name="pen_mitra_dk" id="pen_mitra_dk_3" value="3">
                                    <label class="custom-control-label" for="pen_mitra_dk_3">3.  Rp. 200 - 300 juta</label>
                                </div>
                            </td>
                            <td width="20%">3</td>
                        </tr>
                        <tr>
                            <td width="20%">
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input pen-mitra" data-bobot = "20" name="pen_mitra_dk" id="pen_mitra_dk_2" value="2">
                                    <label class="custom-control-label" for="pen_mitra_dk_2">4.  Rp. 100 - 200 juta</label>
                                </div>
                            </td>
                            <td width="20%">2</td>
                        </tr>
                        <tr>
                            <td width="20%">
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input pen-mitra" data-bobot = "20" name="pen_mitra_dk" id="pen_mitra_dk_1" value="1">
                                    <label class="custom-control-label" for="pen_mitra_dk_1">5.  Rp. 0 - 100 juta</label>
                                </div>
                            </td>
                            <td width="20%">1</td>
                        </tr>

                        <tr>
                            <td width="20%" rowspan="5">Daerah Jangkauan / Kerjasama</td>
                            <td width="20%" rowspan="5">Jumlah Kantor (cabang) / Jumlah Kerjasama</td>
                            <td width="20%">
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input pen-mitra" data-bobot = "10" name="pen_mitra_djk" id="pen_mitra_djk_1" value="1">
                                    <label class="custom-control-label" for="pen_mitra_djk_1">1. >20</label>
                                </div>
                            </td>
                            <td width="20%">5</td>
                            <td width="20%" rowspan="5">10</td>
                            <td width="20%" rowspan="5"><h4 id="pen_mitra_djk_nilai"></h4></td>
                        </tr>
                        <tr>
                            <td width="20%">
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input pen-mitra" data-bobot = "10" name="pen_mitra_djk" id="pen_mitra_djk_2" value="2">
                                    <label class="custom-control-label" for="pen_mitra_djk_2">2. 15</label>
                                </div>
                            </td>
                            <td width="20%">4</td>
                        </tr>
                        <tr>
                            <td width="20%">
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input pen-mitra" data-bobot = "10" name="pen_mitra_djk" id="pen_mitra_djk_3" value="3">
                                    <label class="custom-control-label" for="pen_mitra_djk_3">3. 10</label>
                                </div>
                            </td>
                            <td width="20%">3</td>
                        </tr>
                        <tr>
                            <td width="20%">
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input pen-mitra" data-bobot = "10" name="pen_mitra_djk" id="pen_mitra_djk_2" value="2">
                                    <label class="custom-control-label" for="pen_mitra_djk_2">4. 5</label>
                                </div>
                            </td>
                            <td width="20%">2</td>
                        </tr>
                        <tr>
                            <td width="20%">
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input pen-mitra" data-bobot = "10" name="pen_mitra_djk" id="pen_mitra_djk_1" value="1">
                                    <label class="custom-control-label" for="pen_mitra_djk_1">5. 1</label>
                                </div>
                            </td>
                            <td width="20%">1</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- modal upload berkas -->
<div id="modal-upload-berkas" class="modal fade" data-backdrop="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title-proposal">Upload Dokumen</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <form class="form-validate-jquery" method="POST" id="form-upload" enctype="multipart/form-data"  data-flag="0">
                    @csrf
                    <input type="hidden" name="proposal_id">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group form-group-float">
                                <label class="form-group-float-label is-visible" id="upload-label"> </label>
                                <input type="file" name="proposal_file" class="form-control" placeholder="" accept="application/pdf,.doc,.docx,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document"">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
                
            <div class="modal-footer">
                <button type="button" class="btn btn-primary legitRipple" id="submit-upload">Upload <i class="icon-floppy-disk ml-2"></i></button>
                <button type="reset" class="btn btn-light legitRipple" data-dismiss="modal">Tutup <i class="icon-reload-alt ml-2"></i></button>
            </div>
        </div>
    </div>
</div>
<!-- /modal upload berkas-->
@endsection
@push('scripts')
<script>
    var tabelFiles;
    var tabelPengurus;
    var tabelRAB;
    var tabelPenilaian;
    var groupColumn = 6;
    var hasilYa = 0;
    var hasilTidak = 0;

    var saveMethod = 'ubah';
    var baseUrl = '{{ url("proposal-layak-teknis") }}';
    var dataCd = '{{ $proposal->trx_proposal_id }}';
	
    $(document).ready(function(){
        tabelPenilaian = $('#tabel-penilaian-hasil').DataTable({
            language: {
                paginate: {'next': $('html').attr('dir') == 'rtl' ? 'Next &larr;' : 'Next &rarr;', 'previous': $('html').attr('dir') == 'rtl' ? '&rarr; Prev' : '&larr; Prev'}
            },
            pagingType: "simple",
            processing	: true, 
            serverSide	: true, 
            ajax		: {
                url: baseUrl + '/item-penilaian/data',
                type: "POST",
                data: function(data){
                    data._token =  $('meta[name="csrf-token"]').attr('content');
                    data.id     =  "{{ $proposal->trx_proposal_id }}";
                },
            },
            dom : 'tpi',
            columns: [
                { data: 'trx_proposal_layak_teknis_id', name: 'trx_proposal_layak_teknis_id', defaultContent: "-", visible:false },
                { data: 'DT_RowIndex', name:'DT_RowIndex', visible:false},
                { data: 'layak_teknis_id', name: 'layak_teknis_id', defaultContent: "-", visible:false },
                { data: 'layak_teknis_nm', name: 'layak_teknis_nm', defaultContent: "-", visible:true },
                { data: 'layak_teknis_value_radio', name: 'layak_teknis_value_radio', defaultContent: "-", visible:true },
                { data: 'layak_teknis_value', name: 'layak_teknis_value', defaultContent: "-", visible:false },
                { data: 'layak_teknis_group_nm', name: 'layak_teknis_group_nm', defaultContent: "-", visible:false }
            ],
            order       : [[ groupColumn, 'asc'], [2,'asc']], 
            columnDefs: [
                { "visible": false, "targets": groupColumn }
            ],
            displayLength: 100,
            drawCallback: function ( settings ) {
                var api   = this.api();
                var rows  = api.rows( {page:'current'} ).nodes();
                var last  = null;

                api.column(groupColumn, {page:'current'} ).data().each( function ( group, i ) {
                    if ( last !== group ) {
                        $(rows).eq( i ).before(
                            '<tr class="group_row" col><td colspan="6" align="center"><h5><b>'+group+'</b></h5></td></tr>'
                        );

                        last = group;
                    }
                } );
            },
            createdRow: function( row, data, dataIndex ) {
                // hasilYa = 0;
                // hasilTidak = 0;

                if (data.layak_teknis_value == 1) {
                    hasilYa += 1;
                } else {
                    hasilTidak += 1;
                }

                $('#hasil-ya').text(hasilYa);
                $('#hasil-tidak').text(hasilTidak);
            },
        });

        $(document).on('click', '.clickable',function(){
            var penilaianId = $(this).attr('name');

            var record = {'value' : $(this).attr('value')};

            $.ajax({
                'type': "PUT",
                'url' : baseUrl+'/item-penilaian/'+penilaianId,
                'data': record,
                'dataType' : 'JSON',
                'success': function(response){
                    if(response["status"] == 'ok') {
                        tabelPenilaian.ajax.reload();
                    }else{
                        swal({title: "Proses gagal",type: "error",showCancelButton: false,showConfirmButton: false,timer: 1000});
                    }
                },
                'error': function(response){ 
                    var errorText = '';
                    $.each(response.responseJSON.errors, function(key, value) {
                        errorText += value+'<br>'
                    });

                    swal({
                        title             : response.status+':'+response.responseJSON.message,
                        type              : "error",
                        html              : errorText, 
                        showCancelButton  : false,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText : "OK",
                        cancelButtonText  : "NO",
                    }).then(function(result){
                        if(result.value){   	
                            reset('ubah');
                        }
                    });  
                }
            });
        });

        //--Submit form
        $('.form-proposal').submit(function(e){
            if (e.isDefaultPrevented()) {
			//--Handle the invalid form
            } else {
				e.preventDefault();

                var record  = new FormData(this);
                var url     = baseUrl + '/update/' + dataCd;
                var method  = 'POST';

                swal({
                    title               : 'Simpan data ?',
                    type                : "question",
                    showCancelButton    : true,
                    confirmButtonColor  : "#00a65a",
                    confirmButtonText   : "OK",
                    cancelButtonText    : "NO",
                    allowOutsideClick : false,
                }).then(function(result){
					if(result.value){
                        swal({allowOutsideClick : false,title: "Proses simpan",onOpen: () => {swal.showLoading();}});

                        $.ajax({
                            'type': method,
                            'url' : url,
                            'data': record,
                            contentType: false,
                            processData: false,
                            'success': function(response){
                                if(response["status"] == 'ok') {
									swal({
                                        title: "Proses berhasil",
                                        type: "success",
                                        showCancelButton: false,
                                        showConfirmButton: false,
                                        timer: 1000
                                    }).then(() => {
                                        $('#reset').click();
                                        swal.close();
                                    });
                                }else{
                                    swal({title: "Proses gagal",type: "error",showCancelButton: false,showConfirmButton: false,timer: 1000});
                                }
                            },
                            'error': function(response){ 
                                var errorText = '';
                                $.each(response.responseJSON.errors, function(key, value) {
                                    errorText += value+'<br>'
                                });

                                swal({
                                    title             : response.status+':'+response.responseJSON.message,
                                    type              : "error",
                                    html              : errorText, 
                                    showCancelButton  : false,
                                    confirmButtonColor: "#DD6B55",
                                    confirmButtonText : "OK",
                                    cancelButtonText  : "NO",
                                }).then(function(result){
                                    if(result.value){   	
                                        reset('ubah');
                                    }
                                });  
                            }
                        });
                    }
                });
            }
        });

        //--Submit form
        $('.form-pengurus-kerjasama').submit(function(e){
            if (e.isDefaultPrevented()) {
			//--Handle the invalid form
            } else {
				e.preventDefault();

                var record  = new FormData(this);
                var url     = baseUrl + '/'+$(this).attr('action');
                var method  = 'POST';
                var id      = $(this).attr('id');

                swal({
                    title               : 'Simpan data ?',
                    type                : "question",
                    showCancelButton    : true,
                    confirmButtonColor  : "#00a65a",
                    confirmButtonText   : "OK",
                    cancelButtonText    : "NO",
                    allowOutsideClick : false,
                }).then(function(result){
					if(result.value){
                        swal({allowOutsideClick : false,title: "Proses simpan",onOpen: () => {swal.showLoading();}});

                        $.ajax({
                            'type': method,
                            'url' : url,
                            'data': record,
                            contentType: false,
                            processData: false,
                            'success': function(response){
                                if(response["status"] == 'ok') {
									swal({
                                        title: "Proses berhasil",
                                        type: "success",
                                        showCancelButton: false,
                                        showConfirmButton: false,
                                        timer: 1000
                                    }).then(() => {
                                        resetPengurusKerjasama(id);
                                        swal.close();
                                    });
                                }else{
                                    swal({title: "Proses gagal",type: "error",showCancelButton: false,showConfirmButton: false,timer: 1000});
                                }
                            },
                            'error': function(response){ 
                                var errorText = '';
                                $.each(response.responseJSON.errors, function(key, value) {
                                    errorText += value+'<br>'
                                });

                                swal({
                                    title             : response.status+':'+response.responseJSON.message,
                                    type              : "error",
                                    html              : errorText, 
                                    showCancelButton  : false,
                                    confirmButtonColor: "#DD6B55",
                                    confirmButtonText : "OK",
                                    cancelButtonText  : "NO",
                                }).then(function(result){
                                    if(result.value){   	
                                        reset('ubah');
                                    }
                                });  
                            }
                        });
                    }
                });
            }
        });

        tabelPengurus = $('#tabel-pengurus').DataTable({
            language: {
                paginate: {'next': $('html').attr('dir') == 'rtl' ? 'Next &larr;' : 'Next &rarr;', 'previous': $('html').attr('dir') == 'rtl' ? '&rarr; Prev' : '&larr; Prev'}
            },
            pagingType: "simple",
            processing	: true, 
            serverSide	: true, 
            order		: [], 
            ajax		: {
                url: baseUrl + '/pengurus/data',
                type: "POST",
                data: {
                    '_token': $('meta[name="csrf-token"]').attr('content'),
                    'id'    : '{{ $proposal->trx_proposal_id }}'
                },
            },
            dom : 'tpi',
            columns: [
                { data: 'trx_proposal_lembaga_pengurus_id', name: 'trx_proposal_lembaga_pengurus_id', visible:false },
                { data: 'pengurus_nm', name: 'pengurus_nm' },
                { data: 'jabatan_nm', name: 'jabatan_nm' },
                { data: 'pekerjaan_nm', name: 'pekerjaan_nm' },
            ],
        });

        tabelKerjasama = $('#tabel-kerjasama').DataTable({
            language: {
                paginate: {'next': $('html').attr('dir') == 'rtl' ? 'Next &larr;' : 'Next &rarr;', 'previous': $('html').attr('dir') == 'rtl' ? '&rarr; Prev' : '&larr; Prev'}
            },
            pagingType: "simple",
            processing	: true, 
            serverSide	: true, 
            order		: [], 
            ajax		: {
                url: baseUrl + '/kerjasama/data',
                type: "POST",
                data: {
                    '_token': $('meta[name="csrf-token"]').attr('content'),
                    'id'    : '{{ $proposal->trx_proposal_id }}'
                },
            },
            dom : 'tpi',
            columns: [
                { data: 'trx_proposal_lembaga_kerjasama_id', name: 'trx_proposal_lembaga_kerjasama_id', visible:false },
                { data: 'lembaga_nm', name: 'lembaga_nm' },
                { data: 'kegiatan_nm', name: 'kegiatan_nm' },
                { data: 'nominal_bantuan', name: 'nominal_bantuan', render: $.fn.dataTable.render.number( '.', ',', 2, 'Rp ' ) },
            ],
        });

        tabelRAB = $('#tabel-rab').DataTable({
            language: {
                paginate: {'next': $('html').attr('dir') == 'rtl' ? 'Next &larr;' : 'Next &rarr;', 'previous': $('html').attr('dir') == 'rtl' ? '&rarr; Prev' : '&larr; Prev'}
            },
            pagingType: "simple",
            processing	: true, 
            serverSide	: true, 
            order		: [], 
            ajax		: {
                url: baseUrl + '/rab/data',
                type: "POST",
                data: {
                    '_token': $('meta[name="csrf-token"]').attr('content'),
                    'id'    : '{{ $proposal->trx_proposal_id }}'
                },
            },
            dom : 'tpi',
            columns: [
                { data: 'trx_proposal_rab_id', name: 'trx_proposal_rab_id', visible:false },
                { data: 'DT_RowIndex', name:'DT_RowIndex', visible:true, orderable: false},
                { data: 'jenis_pengeluaran', name: 'jenis_pengeluaran' },
                { data: 'jumlah_unit', name: 'jumlah_unit' },
                { data: 'biaya_satuan', name: 'biaya_satuan', render: $.fn.dataTable.render.number( '.', ',', 2, 'Rp ' ) },
                { data: 'total', name: 'total', render: $.fn.dataTable.render.number( '.', ',', 2, 'Rp ' ) }
            ],
        });

        // file proposal
        tabelFiles = $('#tabel-files').DataTable({
            language: {
                paginate: {'next': $('html').attr('dir') == 'rtl' ? 'Next &larr;' : 'Next &rarr;', 'previous': $('html').attr('dir') == 'rtl' ? '&rarr; Prev' : '&larr; Prev'}
            },
            pagingType: "simple",
            processing	: true, 
            serverSide	: true, 
            order		: [[2,'asc']], 
            ajax		: {
                url: baseUrl + '/proposal-files/data',
                type: "POST",
                data: function(data){
                    data._token= $('meta[name="csrf-token"]').attr('content');
                    data.id    = dataCd;
                },
            },
            dom : 'tpi',
            pageLength : 20,
            columns: [
                { data: 'DT_RowIndex', name:'DT_RowIndex', visible:true, orderable: false},
                { data: 'trx_proposal_files_id', name: 'trx_proposal_files_id', visible:false },
                { data: 'file_tp', name: 'file_tp', visible:false },
                { data: 'file_tp_nm', name: 'file_tp_nm' },
                { data: 'file_ext', name: 'file_ext' },
                { data: 'note', name: 'note', visible:false },
                { data: 'actions', name: 'actions' },
            ],
        });

        $(document).on('click', '.proposal-file',function(){
            var rowData = tabelData.row($(this).parents('tr')).data();
            dataCd      = rowData.trx_proposal_id;

            tabelFiles.ajax.reload();
            $('#modal-files').modal('show');
        });

        $(document).on('click', '.download-file-proposal',function(){
            var rowData = tabelFiles.row($(this).parents('tr')).data();
            fileId      = rowData.trx_proposal_files_id;

            window.open(baseUrl + '/proposal-files/'+fileId,'_blank');
        });

        $(document).on('click', '.upload-file-proposal',function(){
            var rowData = tabelFiles.row($(this).parents('tr')).data();
            fileId      = rowData.trx_proposal_files_id;

            $('input[name=proposal_id]').val(fileId);
            $('input[name=proposal_file]').val('');
            $('input[name=proposal_file]').attr('placeholder',rowData.file_tp_nm);
            $('#upload-label').html('Berkas ' + rowData.file_tp_nm+' '+'<span class="text-danger">*</span>');
            $('#modal-upload-berkas').modal('show');
        });

        $('#submit-upload').click(function(){
            $('#form-upload').submit();
        });

        //--Submit form
        $('#form-analisa').submit(function(e){
            if (e.isDefaultPrevented()) {
			//--Handle the invalid form
            } else {
				e.preventDefault();
                var record  = $('#form-analisa').serialize();

                swal({
                    title               : 'Simpan Analisa?',
                    type                : "question",
                    showCancelButton    : true,
                    confirmButtonColor  : "#00a65a",
                    confirmButtonText   : "OK",
                    cancelButtonText    : "NO",
                    allowOutsideClick : false,
                }).then(function(result){
					if(result.value){
                        swal({allowOutsideClick : false,title: "Proses simpan",onOpen: () => {swal.showLoading();}});
                        $.ajax({
                            'type': "PUT",
                            'url' : baseUrl+'/analisa/{{ $proposal->trx_proposal_id }}',
                            'data': record,
                            'dataType' : 'JSON',
                            'success': function(response){
                                if(response["status"] == 'ok') {
									swal({
                                        title: "Proses berhasil",
                                        type: "success",
                                        showCancelButton: false,
                                        showConfirmButton: false,
                                        timer: 1000
                                    }).then(() => {
                                        swal.close();
                                    });
                                }else{
                                    swal({title: "Proses gagal",type: "error",showCancelButton: false,showConfirmButton: false,timer: 1000});
                                }
                            },
                            'error': function(response){ 
                                var errorText = '';
                                $.each(response.responseJSON.errors, function(key, value) {
                                    errorText += value+'<br>'
                                });

                                swal({
                                    title             : response.status+':'+response.responseJSON.message,
                                    type              : "error",
                                    html              : errorText, 
                                    showCancelButton  : false,
                                    confirmButtonColor: "#DD6B55",
                                    confirmButtonText : "OK",
                                    cancelButtonText  : "NO",
                                }).then(function(result){
                                    if(result.value){   	
                                        reset('ubah');
                                    }
                                });  
                            }
                        });
                    }
                });
            }
        });

        //--Submit form
        $('#form-deskripsi').submit(function(e){
            if (e.isDefaultPrevented()) {
			//--Handle the invalid form
            } else {
				e.preventDefault();
                var record  = $('#form-deskripsi').serialize();

                swal({
                    title               : 'Simpan Deskripsi?',
                    type                : "question",
                    showCancelButton    : true,
                    confirmButtonColor  : "#00a65a",
                    confirmButtonText   : "OK",
                    cancelButtonText    : "NO",
                    allowOutsideClick : false,
                }).then(function(result){
					if(result.value){
                        swal({allowOutsideClick : false,title: "Proses simpan",onOpen: () => {swal.showLoading();}});
                        $.ajax({
                            'type': "PUT",
                            'url' : baseUrl+'/deskripsi/{{ $proposal->trx_proposal_id }}',
                            'data': record,
                            'dataType' : 'JSON',
                            'success': function(response){
                                if(response["status"] == 'ok') {
									swal({
                                        title: "Proses berhasil",
                                        type: "success",
                                        showCancelButton: false,
                                        showConfirmButton: false,
                                        timer: 1000
                                    }).then(() => {
                                        swal.close();
                                    });
                                }else{
                                    swal({title: "Proses gagal",type: "error",showCancelButton: false,showConfirmButton: false,timer: 1000});
                                }
                            },
                            'error': function(response){ 
                                var errorText = '';
                                $.each(response.responseJSON.errors, function(key, value) {
                                    errorText += value+'<br>'
                                });

                                swal({
                                    title             : response.status+':'+response.responseJSON.message,
                                    type              : "error",
                                    html              : errorText, 
                                    showCancelButton  : false,
                                    confirmButtonColor: "#DD6B55",
                                    confirmButtonText : "OK",
                                    cancelButtonText  : "NO",
                                }).then(function(result){
                                    if(result.value){   	
                                        reset('ubah');
                                    }
                                });  
                            }
                        });
                    }
                });
            }
        });
        

        $(document).on('click', '.pen-mitra',function(){
            var nama = $(this).attr('name');
            var nilai = $(this).val();
            var bobot = $(this).data('bobot');

            $('#'+nama+'_nilai').text(nilai * bobot)
        });
        
        //--Submit form
        $('#form-rencana').submit(function(e){
            if (e.isDefaultPrevented()) {
			//--Handle the invalid form
            } else {
				e.preventDefault();
                var record  = $('#form-rencana').serialize();

                swal({
                    title               : 'Simpan Rencana?',
                    type                : "question",
                    showCancelButton    : true,
                    confirmButtonColor  : "#00a65a",
                    confirmButtonText   : "OK",
                    cancelButtonText    : "NO",
                    allowOutsideClick : false,
                }).then(function(result){
					if(result.value){
                        swal({allowOutsideClick : false,title: "Proses simpan",onOpen: () => {swal.showLoading();}});
                        $.ajax({
                            'type': "PUT",
                            'url' : baseUrl+'/rencana/{{ $proposal->trx_mitra_kemaslahatan_id }}',
                            'data': record,
                            'dataType' : 'JSON',
                            'success': function(response){
                                if(response["status"] == 'ok') {
									swal({
                                        title: "Proses berhasil",
                                        type: "success",
                                        showCancelButton: false,
                                        showConfirmButton: false,
                                        timer: 1000
                                    }).then(() => {
                                        swal.close();
                                    });
                                }else{
                                    swal({title: "Proses gagal",type: "error",showCancelButton: false,showConfirmButton: false,timer: 1000});
                                }
                            },
                            'error': function(response){ 
                                var errorText = '';
                                $.each(response.responseJSON.errors, function(key, value) {
                                    errorText += value+'<br>'
                                });

                                swal({
                                    title             : response.status+':'+response.responseJSON.message,
                                    type              : "error",
                                    html              : errorText, 
                                    showCancelButton  : false,
                                    confirmButtonColor: "#DD6B55",
                                    confirmButtonText : "OK",
                                    cancelButtonText  : "NO",
                                }).then(function(result){
                                    if(result.value){   	
                                        reset('ubah');
                                    }
                                });  
                            }
                        });
                    }
                });
            }
        });

        //--Submit form
        $('#form-pelaksanaan-penilaian').submit(function(e){
            if (e.isDefaultPrevented()) {
			//--Handle the invalid form
            } else {
				e.preventDefault();
                var record  = $('#form-pelaksanaan-penilaian').serialize();

                swal({
                    title               : 'Simpan Pelaksanaan Penilaian?',
                    type                : "question",
                    showCancelButton    : true,
                    confirmButtonColor  : "#00a65a",
                    confirmButtonText   : "OK",
                    cancelButtonText    : "NO",
                    allowOutsideClick : false,
                }).then(function(result){
					if(result.value){
                        swal({allowOutsideClick : false,title: "Proses simpan",onOpen: () => {swal.showLoading();}});
                        $.ajax({
                            'type': "PUT",
                            'url' : baseUrl+'/pelaksanaan-penilaian/{{ $proposal->trx_proposal_id }}',
                            'data': record,
                            'dataType' : 'JSON',
                            'success': function(response){
                                if(response["status"] == 'ok') {
									swal({
                                        title: "Proses berhasil",
                                        type: "success",
                                        showCancelButton: false,
                                        showConfirmButton: false,
                                        timer: 1000
                                    }).then(() => {
                                        swal.close();
                                    });
                                }else{
                                    swal({title: "Proses gagal",type: "error",showCancelButton: false,showConfirmButton: false,timer: 1000});
                                }
                            },
                            'error': function(response){ 
                                var errorText = '';
                                $.each(response.responseJSON.errors, function(key, value) {
                                    errorText += value+'<br>'
                                });

                                swal({
                                    title             : response.status+':'+response.responseJSON.message,
                                    type              : "error",
                                    html              : errorText, 
                                    showCancelButton  : false,
                                    confirmButtonColor: "#DD6B55",
                                    confirmButtonText : "OK",
                                    cancelButtonText  : "NO",
                                }).then(function(result){
                                    if(result.value){   	
                                        reset('ubah');
                                    }
                                });  
                            }
                        });
                    }
                });
            }
        });

        //--Submit form
        $('#form-data').submit(function(e){
            if (e.isDefaultPrevented()) {
			//--Handle the invalid form
            } else {
				e.preventDefault();

                var record  = new FormData(this);

                if(saveMethod == 'tambah'){
					var url     = baseUrl;
                    var method  = 'POST';
                }else{
					var url     = baseUrl + '/' + dataCd;
                    var method  = 'PUT';
                }

                swal({
                    title               : 'Simpan data ?',
                    type                : "question",
                    showCancelButton    : true,
                    confirmButtonColor  : "#00a65a",
                    confirmButtonText   : "OK",
                    cancelButtonText    : "NO",
                    allowOutsideClick : false,
                }).then(function(result){
					if(result.value){
                        swal({allowOutsideClick : false,title: "Proses simpan",onOpen: () => {swal.showLoading();}});

                        $.ajax({
                            'type': method,
                            'url' : url,
                            'data': record,
                            contentType: false,
                            processData: false,
                            'success': function(response){
                                if(response["status"] == 'ok') {
									swal({
                                        title: "Proses berhasil",
                                        type: "success",
                                        showCancelButton: false,
                                        showConfirmButton: false,
                                        timer: 1000
                                    }).then(() => {
                                        $('#reset').click();
                                        swal.close();
                                    });
                                }else{
                                    swal({title: "Proses gagal",type: "error",showCancelButton: false,showConfirmButton: false,timer: 1000});
                                }
                            },
                            'error': function(response){ 
                                var errorText = '';
                                $.each(response.responseJSON.errors, function(key, value) {
                                    errorText += value+'<br>'
                                });

                                swal({
                                    title             : response.status+':'+response.responseJSON.message,
                                    type              : "error",
                                    html              : errorText, 
                                    showCancelButton  : false,
                                    confirmButtonColor: "#DD6B55",
                                    confirmButtonText : "OK",
                                    cancelButtonText  : "NO",
                                }).then(function(result){
                                    if(result.value){   	
                                        reset('ubah');
                                    }
                                });  
                            }
                        });
                    }
                });
            }
        });

        $('#trx_mitra_kemaslahatan_id').select2({
            placeholder : "Pilih Mitra Kemaslahatan",
            @if($proposal->trx_mitra_kemaslahatan_id)
            data:[{"id": "{{ $proposal->trx_mitra_kemaslahatan_id }}" ,"text":"{{ $proposal->trx_mitra_kemaslahatan_id }}" }] ,
            @endif
            ajax : {
                url :  "{{ url('dropdown-data/mitra-kemaslahatan') }}",
                dataType: 'json',
                processResults: function(data){
                    return {
                        results: data
                    };
                },
            },
        });

        $('#lokasi_region_prop').select2({
            placeholder : "Pilih Propinsi",
            @if($proposal->lokasi_region_prop)
            data:[{"id": "{{ $proposal->lokasi_region_prop }}" ,"text":"{{ getRegionNm($proposal->lokasi_region_prop) }}" }] ,
            @endif
            ajax : {
                url :  "{{ url('daftar-daerah/provinsi/') }}",
                dataType: 'json',
                processResults: function(data){
                    return {
                        results: data
                    };
                },
            },
        });

        $('#lokasi_region_kab').select2({
            placeholder : "Pilih Kota",
            @if($proposal->lokasi_region_kab)
            data:[{"id": "{{ $proposal->lokasi_region_kab }}" ,"text":"{{ getRegionNm($proposal->lokasi_region_kab) }}" }] ,
            @endif
            ajax : {
                url :  "{{ url('daftar-daerah/by-root/') }}"+"/{{ $proposal->lokasi_region_prop }}",
                dataType: 'json',
                processResults: function(data){
                    return {
                        results: data
                    };
                },
            },
        });

        $('#lokasi_region_kec').select2({
            placeholder : "Pilih Kota",
            @if($proposal->lokasi_region_kab)
            data:[{"id": "{{ $proposal->lokasi_region_kec }}" ,"text":"{{ getRegionNm($proposal->lokasi_region_kec) }}" }] ,
            @endif
            ajax : {
                url :  "{{ url('daftar-daerah/by-root/') }}"+"/{{ $proposal->lokasi_region_kab }}",
                dataType: 'json',
                processResults: function(data){
                    return {
                        results: data
                    };
                },
            },
        });
  
        $('#lokasi_region_kel').select2({
            placeholder : "Pilih Kota",
            @if($proposal->lokasi_region_kab)
            data:[{"id": "{{ $proposal->lokasi_region_kel }}" ,"text":"{{ getRegionNm($proposal->lokasi_region_kel) }}" }] ,
            @endif
            ajax : {
                url :  "{{ url('daftar-daerah/by-root/') }}"+"/{{ $proposal->lokasi_region_kec }}",
                dataType: 'json',
                processResults: function(data){
                    return {
                        results: data
                    };
                },
            },
        });

        $('#lokasi_region_prop').change(function () {
            $('#lokasi_region_kab').empty();
            $('#lokasi_region_kec').empty();
            $('#lokasi_region_kel').empty();
            $('#lokasi_region_kab').select2({
                placeholder : "Pilih Kota",
                @if($proposal->lokasi_region_kab)
                data:[{"id": "{{ $proposal->lokasi_region_kab }}" ,"text":"{{ getRegionNm($proposal->lokasi_region_kab) }}" }] ,
                @endif
                ajax : {
                    url :  "{{ url('daftar-daerah/by-root/') }}"+"/"+$('#lokasi_region_prop').val(),
                    dataType: 'json',
                    processResults: function(data){
                        return {
                            results: data
                        };
                    },
                },
            });
        });

        $('#lokasi_region_kab').change(function () {
            $('#lokasi_region_kec').empty();
            $('#lokasi_region_kel').empty();
            $('#lokasi_region_kec').select2({
                placeholder : "Pilih Kota",
                @if($proposal->lokasi_region_kec)
                data:[{"id": "{{ $proposal->lokasi_region_kec }}" ,"text":"{{ getRegionNm($proposal->lokasi_region_kec) }}" }] ,
                @endif
                ajax : {
                    url :  "{{ url('daftar-daerah/by-root/') }}"+"/"+$('#lokasi_region_kab').val(),
                    dataType: 'json',
                    processResults: function(data){
                        return {
                            results: data
                        };
                    },
                },
            });
        });

        $('#lokasi_region_kec').change(function () {
            $('#lokasi_region_kel').empty();
            $('#lokasi_region_kel').select2({
                @if($proposal->lokasi_region_kel)
                data:[{"id": "{{ $proposal->lokasi_region_kel }}" ,"text":"{{ getRegionNm($proposal->lokasi_region_kel) }}" }] ,
                @endif
                placeholder : "Pilih Kota",
                ajax : {
                    url :  "{{ url('daftar-daerah/by-root/') }}"+"/"+$('#lokasi_region_kec').val(),
                    dataType: 'json',
                    processResults: function(data){
                        return {
                            results: data
                        };
                    },
                },
            });
        });

        $(document).on('click', '.approve-data',function(){
            $('input[name=approval_status]').val($(this).data('status'));

            var warningTitle    = $(this).data('name');
            var record          = new FormData(document.getElementById('form-approval'));

            swal({
                title               : warningTitle,
                type                : "question",
                showCancelButton    : true,
                confirmButtonColor  : "#00a65a",
                confirmButtonText   : "OK",
                cancelButtonText    : "NO",
                allowOutsideClick : false,
            }).then(function(result){
                if(result.value){
                    swal({allowOutsideClick : false,title: "Proses simpan",onOpen: () => {swal.showLoading();}});

                    $.ajax({
                        'type': 'POST',
                        'url' : baseUrl +"/approve/"+dataCd,
                        'data': record,
                        contentType: false,
                        processData: false,
                        'success': function(response){
                            if(response["status"] == 'ok') {
                                swal({
                                    title: "Proses berhasil",
                                    type: "success",
                                    showCancelButton: false,
                                    showConfirmButton: false,
                                    timer: 1000
                                }).then(() => {
                                    $('#modal-approval').modal('hide');
                                    tabelData.ajax.reload();
                                    swal.close();
                                });
                            }else{
                                swal({title: "Proses gagal",type: "error",showCancelButton: false,showConfirmButton: false,timer: 1000});
                            }
                        },
                        'error': function(response){ 
                            var errorText = '';
                            $.each(response.responseJSON.errors, function(key, value) {
                                errorText += value+'<br>'
                            });

                            swal({
                                title             : response.status+':'+response.responseJSON.message,
                                type              : "error",
                                html              : errorText, 
                                showCancelButton  : false,
                                confirmButtonColor: "#DD6B55",
                                confirmButtonText : "OK",
                                cancelButtonText  : "NO",
                            }).then(function(result){
                                if(result.value){   	
                                    reset('ubah');
                                }
                            });  
                        }
                    });
                }
            });
        });

        $(document).on('click', '#disposisi-proposal',function(){
            $('#modal-approval').modal('show');
        });

        $('input[name=nominal]').val("{{ (int)$proposal->nominal }}").trigger('input');  
        $('select[name=ruang_lingkup]').val("{{ $proposal->ruang_lingkup }}").trigger('change');  
        $('input[name=deskripsi_nominal]').val("{{ (int)$proposal->deskripsi_nominal }}").trigger('input');  
        $('select[name=deskripsi_spesifikasi_kegiatan]').val("{{ $proposal->deskripsi_spesifikasi_kegiatan }}").trigger('change'); 
    });

    function reset(type) {
        saveMethod  = '';
        dataCd = null;
        rowData = null;
        tabelData.ajax.reload();
        
        $('#frame-tabel').show();      
        $('#frame-form').hide(); 
        $('input[name=trx_proposal_id]').val('').prop('readonly',false);
        $('input[name=judul_proposal]').val('');
        $('.card-title').text('Data Proposal');       
    }

    function resetPengurusKerjasama(id) {
        $('.form-child-field').val('');

        tabelPengurus.ajax.reload();
        tabelKerjasama.ajax.reload();
        tabelRAB.ajax.reload();
    }
</script>
@endpush