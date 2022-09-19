@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
crossorigin=""/>

<style>
    #maps { height: 300px; };
</style>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">Input Proposal</h5>
                <div class="header-elements">
                    <div class="list-icons">
                        <span class='badge badge-info d-block'></span>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <ul class="nav nav-tabs nav-tabs-solid nav-justified rounded border-0">
                    <li class="nav-item"><a href="#tab-data-proposal" class="nav-link rounded-left active" data-toggle="tab"><i class="icon-list d-block mb-1 mt-1"></i>Proposal</a></li>
                    <li class="nav-item"><a href="#tab-data-lembaga" class="nav-link rounded-left" data-toggle="tab"><i class="icon-list d-block mb-1 mt-1"></i>Lembaga</a></li>
                    <li class="nav-item"><a href="#tab-data-pengurus" class="nav-link rounded-left" data-toggle="tab"><i class="icon-list d-block mb-1 mt-1"></i>Pengurus</a></li>
                    <li class="nav-item"><a href="#tab-data-profil" class="nav-link rounded-left" data-toggle="tab"><i class="icon-list d-block mb-1 mt-1"></i>Profil</a></li>
                    {{-- <li class="nav-item"><a href="#tab-data-kerjasama" class="nav-link rounded-left" data-toggle="tab"><i class="{{ $proposal->kerjasama_fill_st == 1 ? 'icon-floppy-disk' : 'icon-list' }} d-block mb-1 mt-1"></i>Kerjasama</a></li> --}}
                    <li class="nav-item"><a href="#tab-data-informasi" class="nav-link rounded-left" data-toggle="tab"><i class="icon-list d-block mb-1 mt-1"></i>Informasi</a></li>
                    <li class="nav-item"><a href="#tab-data-kontak" class="nav-link rounded-left" data-toggle="tab"><i class="'icon-list d-block mb-1 mt-1"></i>Kontak</a></li>
                    <li class="nav-item"><a href="#tab-data-rab" class="nav-link rounded-left" data-toggle="tab"><i class="icon-list d-block mb-1 mt-1"></i>RAB</a></li>
                    <li class="nav-item"><a href="#tab-data-upload" class="nav-link rounded-left" data-toggle="tab"><i class="icon-list d-block mb-1 mt-1"></i>Upload Berkas</a></li>
                    @if (isRoleUser('regas'))
                    <li class="nav-item"><a href="#tab-data-rekomendasi" class="nav-link rounded-left" data-toggle="tab"><i class="icon-floppy-disk d-block mb-1 mt-1"></i>Rekomendasi Pejabat Berwenang</a></li>
                    @endif

                    @if (isRoleUser(['regas', 'pelmonev']))
                    <li class="nav-item"><a href="#tab-data-print" class="nav-link rounded-left" data-toggle="tab"><i class="icon-printer d-block mb-1 mt-1"></i>Print File</a></li>
                    @endif
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
                                        <input type="text" name="judul_proposal" class="form-control" required="" placeholder="Judul Proposal" aria-invalid="false" required="required">
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
                            @if (isRoleUser('pemohon') == FALSE)    
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">Rekomendasi Pagu <span class="text-danger">*</span></label>
                                        <input type="text" name="nominal_rekomendasi" class="form-control money" placeholder="" aria-invalid="false" required="required">
                                    </div>
                                </div>
                            </div>
                            @if (isRoleUser('mitra') == FALSE)
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">Mitra Kemaslahatan <span class="text-danger">*</span></label>    
                                        <select name="trx_mitra_kemaslahatan_id" id="trx_mitra_kemaslahatan_id" data-placeholder="Pilih Data" class="trx_mitra_kemaslahatan_id form-control form-control-select2" required data-fouc>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            @endif
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">Jangka Waktu Assesmen </label>
                                        <input type="text" name="assesment_mitra_view" class="form-control daterange-picker" placeholder="Jangka Waktu Assesmen oleh Mitra">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group form-group-float">
                                <label class="form-group-float-label is-visible">Nama Gedung</label>
                                <input type="text" name="lokasi_nama_gedung" class="form-control" placeholder="Nama Gedung " aria-invalid="false" required="required">
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
                                <div id="maps"></div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">Latitude </label>
                                        <input type="text" name="proposal_latitude" readonly="readonly" class="form-control" placeholder="" aria-invalid="false">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">Longitude </label>
                                        <input type="text" name="proposal_longitude" readonly="readonly" class="form-control" placeholder="" aria-invalid="false">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group form-group-float">
                                <label class="form-group-float-label is-visible">Komunitas / Kelompok yang menjadi tempat pelaksanaan kegiatan</label>
                                <textarea name="lokasi_komunitas" id="lokasi_komunitas" class="form-control"></textarea>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">Uraian Singkat <span class="text-danger">*</span></label>
                                        <textarea name="uraian_singkat_proposal" id="uraian_singkat_proposal" class="form-control ckeditor" required="required"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">Deskripsi Program yang Diusulkan  <span class="text-danger">*</span></label>
                                        <textarea name="deskripsi_singkat_proposal" id="deskripsi_singkat_proposal" class="form-control ckeditor" required="required" maxlength="3000"></textarea>
                                    </div>
                                </div>
                            </div>
                           
                            <div class="d-flex justify-content-end align-items-center">
                                <button type="submit" class="btn btn-primary legitRipple">Simpan <i class="icon-floppy-disk ml-2"></i></button>
                                <button type="reset" class="btn btn-light ml-2 legitRipple" id="reset">Selesai <i class="icon-reload-alt ml-2"></i></button>
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
                                        <input type="text" name="pemohon_nm" class="form-control" readonly="readonly" placeholder="Nama Pemohon" aria-invalid="false">
                                    </div>
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">Nomor Akta Pendirian</label>
                                        <input type="text" name="akta_pendirian" class="form-control" required="" placeholder="" aria-invalid="false">
                                    </div>
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">Akta Perubahan Terakhir</label>
                                        <input type="text" name="akta_perubahan_terakhir" class="form-control" placeholder="" required="" aria-invalid="false">
                                    </div>
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">No SK Pengesahan Pendirian</label>
                                        <input type="text" name="sk_pengesahan_pendirian_no" class="form-control" placeholder="" required="" aria-invalid="false">
                                    </div>
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">No SK Pengesahan Perubahan Terakhir</label>
                                        <input type="text" name="sk_pengesahan_perubahan_terakhir_no" class="form-control" placeholder="" required="" aria-invalid="false">
                                    </div>
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">No KTP Pimpinan</label>
                                        <input type="text" name="ktp_no_pimpinan" class="form-control" placeholder="" required="" aria-invalid="false">
                                    </div>
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">No NPWP Lembaga</label>
                                        <input type="text" name="npwp_no_lembaga" class="form-control" placeholder="" required="" aria-invalid="false">
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end align-items-center">
                                <button type="submit" class="btn btn-primary legitRipple">Simpan <i class="icon-floppy-disk ml-2"></i></button>
                                <button type="reset" class="btn btn-light ml-2 legitRipple" id="reset">Selesai <i class="icon-reload-alt ml-2"></i></button>
                            </div>
                        </form>
                    </div>
        
                    <div class="tab-pane fade show" id="tab-data-pengurus">
                        <form class="form-validate-jquery form-pengurus-kerjasama" action="pengurus" id="form-pengurus" action="#">
                            @csrf
                            <input type="hidden" name="id">
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
                            <div class="d-flex justify-content-end align-items-center">
                                <button type="submit" class="btn btn-primary legitRipple">Simpan <i class="icon-floppy-disk ml-2"></i></button>
                                <button type="reset" class="btn btn-light ml-2 legitRipple" id="reset">Selesai <i class="icon-reload-alt ml-2"></i></button>
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
                                        <textarea name="profil_singkat" id="profil_singkat" class="form-control ckeditor"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end align-items-center">
                                <button type="submit" class="btn btn-primary legitRipple">Simpan <i class="icon-floppy-disk ml-2"></i></button>
                                <button type="reset" class="btn btn-light ml-2 legitRipple" id="reset">Selesai <i class="icon-reload-alt ml-2"></i></button>
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
                            <input type="hidden" name="id" value="">
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
                            <div class="d-flex justify-content-end align-items-center">
                                <button type="submit" class="btn btn-primary legitRipple">Simpan <i class="icon-floppy-disk ml-2"></i></button>
                                <button type="reset" class="btn btn-light ml-2 legitRipple" id="reset">Selesai <i class="icon-reload-alt ml-2"></i></button>
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
                                        <textarea name="address" id="address" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">No Telepon Kantor <span class="text-danger">*</span></label>
                                        <input type="text" name="phone" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">Website </label>
                                        <input type="text" name="website" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">Akun Sosial Media </label>
                                        <input type="text" name="socmed" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end align-items-center">
                                <button type="submit" class="btn btn-primary legitRipple">Simpan <i class="icon-floppy-disk ml-2"></i></button>
                                <button type="reset" class="btn btn-light ml-2 legitRipple" id="reset">Selesai <i class="icon-reload-alt ml-2"></i></button>
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
                                        <input type="text" name="penanggung_jawab_nm" class="form-control">
                                    </div>
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">Email <span class="text-danger">*</span></label>
                                        <input type="text" name="penanggung_jawab_email" class="form-control">
                                    </div>
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">Nomor Handphone <span class="text-danger">*</span></label>
                                        <input type="text" name="penanggung_jawab_phone" class="form-control">
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
                                        <input type="text" name="bank_branch" class="form-control">
                                    </div>
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">Atas Nama <span class="text-danger">*</span></label>
                                        <input type="text" name="bank_holder" class="form-control">
                                    </div>
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">No Rekening <span class="text-danger">*</span></label>
                                        <input type="text" name="bank_account_no" class="form-control">
                                    </div>
                                    {{-- <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">Scan Rekening Bank <span class="text-danger">*</span></label>
                                        <input type="file" name="bank_account_file" id="bank_account_file" class="form-control">
                                    </div> --}}
                                </div>
                            </div>
                            <div class="d-flex justify-content-end align-items-center">
                                <button type="submit" class="btn btn-primary legitRipple">Simpan <i class="icon-floppy-disk ml-2"></i></button>
                                <button type="reset" class="btn btn-light ml-2 legitRipple" id="reset">Selesai <i class="icon-reload-alt ml-2"></i></button>
                            </div>
                        </form>
                    </div>

                    <div class="tab-pane fade show" id="tab-data-rab">
                        <form class="form-validate-jquery form-proposal" action="#" id="form-rab-type" action="#">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">Jenis RAB <span class="text-danger">*</span></label>
                                        <select name="rab_tp" id="rab_tp" data-placeholder="Pilih Data" class="form-control form-control-select2" required data-fouc>
                                            <option value="PENGADAAN">PENGADAAN</option>
                                            <option value="PEMBANGUNAN">PEMBANGUNAN</option>
                                            <option value="KEGIATAN">KEGIATAN</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end align-items-center">
                                <button type="submit" class="btn btn-primary legitRipple">Simpan <i class="icon-floppy-disk ml-2"></i></button>
                            </div>
                        </form>
                                <form class="form-validate-jquery form-pengurus-kerjasama" action="rab" id="form-rab" action="#">
                                    @csrf
                                    <input type="hidden" name="rab_id">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group form-group-float">
                                                <label class="form-group-float-label is-visible">Item <span class="text-danger">*</span></label>
                                                <input type="text" name="rab_jenis_pengeluaran" class="form-control form-child-field">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group form-group-float">
                                                <label class="form-group-float-label is-visible">Jumlah Unit <span class="text-danger">*</span></label>
                                                <input type="number" name="rab_jumlah_unit" class="form-control form-child-field">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group form-group-float">
                                                <label class="form-group-float-label is-visible">Harga Satuan <span class="text-danger">*</span></label>
                                                <input type="text" name="rab_biaya_satuan" class="form-control money form-child-field">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-end align-items-center">
                                        <button type="submit" class="btn btn-primary legitRipple">Simpan <i class="icon-floppy-disk ml-2"></i></button>
                                        <button type="reset" class="btn btn-light ml-2 legitRipple" id="reset">Selesai <i class="icon-reload-alt ml-2"></i></button>
                                    </div>
                                </form>
                                <div class="table-responsive">
                                    <table class="table datatable-pagination" id="tabel-rab" width="100%">
                                        <thead>
                                            <tr>
                                                <th width="0%">Kode</th>
                                                <th width="0%">No</th>
        
                                                <th width="20%" id="jenis_pengeluaran_table">Item</th>
        
                                                <th width="20%" id="jumlah_unit_table">Jumlah</th>
                                                <th width="20%" id="biaya_satuan_table">Harga Satuan</th>
                                                <th width="20%" id="total_table">Jumlah Harga</th>
                                                
                                                <th width="20%" id="jumlah_unit_mitra_table">Jumlah (mitra)</th>
                                                <th width="20%" id="biaya_satuan_mitra_table">Harga Satuan (mitra)</th>
                                                <th width="20%" id="total_mitra_table">Jumlah Harga (mitra)</th>
        
                                                <th width="20%" id="jumlah_unit_mitra_table">Jumlah (BPKH)</th>
                                                <th width="20%" id="biaya_satuan_mitra_table">Harga Satuan (BPKH)</th>
                                                <th width="20%" id="total_mitra_table">Jumlah Harga (BPKH)</th>
        
                                                <th width="10%" id="actions_table">#</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                                <form class="form-validate-jquery form-pengurus-kerjasama" action="rab" id="form-rab" action="#">
                                    @csrf
                                    <input type="hidden" name="rab_id">
                                    <input type="hidden" name="proposal_id">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group form-group-float">
                                                <label class="form-group-float-label is-visible">Bagian Jenis Pekerjaan <span class="text-danger">*</span></label>
                                                <input type="text" name="rab_jenis_pengeluaran" class="form-control form-child-field">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group form-group-float">
                                                <label class="form-group-float-label is-visible">Volume <span class="text-danger">*</span></label>
                                                <input type="number" name="rab_jumlah_unit" class="form-control form-child-field">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group form-group-float">
                                                <label class="form-group-float-label is-visible">Satuan <span class="text-danger">*</span></label>
                                                <select name="rab_satuan" id="rab_satuan" data-placeholder="Pilih Data" class="form-control form-control-select2" required data-fouc>
                                                    {!! comCodeOptions('SATUAN_RAB') !!}
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group form-group-float">
                                                <label class="form-group-float-label is-visible">Harga Satuan <span class="text-danger">*</span></label>
                                                <input type="text" name="rab_biaya_satuan" class="form-control money form-child-field">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-end align-items-center">
                                        <button type="submit" class="btn btn-primary legitRipple">Simpan <i class="icon-floppy-disk ml-2"></i></button>
                                        <button type="reset" class="btn btn-light ml-2 legitRipple" id="reset">Selesai <i class="icon-reload-alt ml-2"></i></button>
                                    </div>
                                </form>
                                <div class="table-responsive">
                                    <table class="table datatable-pagination" id="tabel-rab" width="100%">
                                        <thead>
                                            <tr>
                                                <th width="0%">Kode</th>
                                                <th width="0%">No</th>
        
                                                <th width="20%" id="jenis_pengeluaran_table">BAGIAN JENIS PEKERJAAN</th>
                                                <th width="20%" id="jumlah_unit_table">Volume</th>
                                                <th width="20%" id="satuan_table">Satuan</th>
                                                <th width="20%" id="satuan_nm_table">Satuan</th>

                                                <th width="20%" id="biaya_satuan_table">Harga Satuan</th>
                                                <th width="20%" id="total_table">Jumlah Harga</th>
                                                
                                                <th width="20%" id="jumlah_unit_mitra_table">Harga (mitra)</th>
                                                <th width="20%" id="biaya_satuan_mitra_table">Biaya Satuan (mitra)</th>
                                                <th width="20%" id="total_mitra_table">Jumlah Harga (mitra)</th>
        
                                                <th width="20%" id="jumlah_unit_mitra_table">Harga (BPKH)</th>
                                                <th width="20%" id="biaya_satuan_mitra_table">Biaya Satuan (BPKH)</th>
                                                <th width="20%" id="total_mitra_table">Jumlah Harga (BPKH)</th>
        
                                                <th width="10%" id="actions_table">#</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                                <form class="form-validate-jquery form-pengurus-kerjasama" action="rab" id="form-rab" action="#">
                                    @csrf
                                    <input type="hidden" name="rab_id">
                                    <input type="hidden" name="proposal_id">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group form-group-float">
                                                <label class="form-group-float-label is-visible">URAIAN KEGIATAN <span class="text-danger">*</span></label>
                                                <input type="text" name="rab_jenis_pengeluaran" class="form-control form-child-field">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group form-group-float">
                                                <label class="form-group-float-label is-visible">QTY <span class="text-danger">*</span></label>
                                                <input type="number" name="rab_jumlah_unit" class="form-control form-child-field">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group form-group-float">
                                                <label class="form-group-float-label is-visible">Satuan <span class="text-danger">*</span></label>
                                                <select name="rab_satuan" id="rab_satuan" data-placeholder="Pilih Data" class="form-control form-control-select2" required data-fouc>
                                                    {!! comCodeOptions('SATUAN_RAB') !!}
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group form-group-float">
                                                <label class="form-group-float-label is-visible">Biaya <span class="text-danger">*</span></label>
                                                <input type="text" name="rab_biaya_satuan" class="form-control money form-child-field">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-end align-items-center">
                                        <button type="submit" class="btn btn-primary legitRipple">Simpan <i class="icon-floppy-disk ml-2"></i></button>
                                        <button type="reset" class="btn btn-light ml-2 legitRipple" id="reset">Selesai <i class="icon-reload-alt ml-2"></i></button>
                                    </div>
                                </form>
                                <div class="table-responsive">
                                    <table class="table datatable-pagination" id="tabel-rab" width="100%">
                                        <thead>
                                            <tr>
                                                <th width="0%">Kode</th>
                                                <th width="0%">No</th>
        
                                                <th width="20%" id="jenis_pengeluaran_table">URAIAN KEGIATAN</th>
                                                <th width="20%" id="satuan_table">Satuan</th>
                                                <th width="20%" id="satuan_nm_table">Satuan</th>
                                                <th width="20%" id="biaya_satuan_table">Biaya</th>
                                                <th width="20%" id="jumlah_unit_table">QTY</th>
                                                <th width="20%" id="total_table">Jumlah</th>
                                                
                                                <th width="20%" id="jumlah_unit_mitra_table">QTY (mitra)</th>
                                                <th width="20%" id="biaya_satuan_mitra_table">Biaya (mitra)</th>
                                                <th width="20%" id="total_mitra_table">Jumlah (mitra)</th>
        
                                                <th width="20%" id="jumlah_unit_mitra_table">QTY (BPKH)</th>
                                                <th width="20%" id="biaya_satuan_mitra_table">Biaya (BPKH)</th>
                                                <th width="20%" id="total_mitra_table">Jumlah (BPKH)</th>
        
                                                <th width="10%" id="actions_table">#</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                                <form class="form-validate-jquery form-pengurus-kerjasama" action="rab" id="form-rab" action="#">
                                    @csrf
                                    <input type="hidden" name="rab_id">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group form-group-float">
                                                <label class="form-group-float-label is-visible">Jenis Pengeluaran <span class="text-danger">*</span></label>
                                                <input type="text" name="rab_jenis_pengeluaran" class="form-control form-child-field">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group form-group-float">
                                                <label class="form-group-float-label is-visible">Frekuensi <span class="text-danger">*</span></label>
                                                <input type="number" name="rab_jumlah_unit" class="form-control form-child-field">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group form-group-float">
                                                <label class="form-group-float-label is-visible">Satuan <span class="text-danger">*</span></label>
                                                <select name="rab_satuan" id="rab_satuan" data-placeholder="Pilih Data" class="form-control form-control-select2" required data-fouc>
                                                    {!! comCodeOptions('SATUAN_RAB') !!}
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group form-group-float">
                                                <label class="form-group-float-label is-visible">Biaya Satuan <span class="text-danger">*</span></label>
                                                <input type="text" name="rab_biaya_satuan" class="form-control money form-child-field">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-end align-items-center">
                                        <button type="submit" class="btn btn-primary legitRipple">Simpan <i class="icon-floppy-disk ml-2"></i></button>
                                        <button type="reset" class="btn btn-light ml-2 legitRipple" id="reset">Selesai <i class="icon-reload-alt ml-2"></i></button>
                                    </div>
                                </form>
                                <div class="table-responsive">
                                    <table class="table datatable-pagination" id="tabel-rab" width="100%">
                                        <thead>
                                            <tr>
                                                <th width="0%">Kode</th>
                                                <th width="0%">No</th>
        
                                                <th width="20%" id="jenis_pengeluaran_table">Jenis Pengeluaran</th>
                                                <th width="20%" id="satuan_table">Frekuensi</th>
                                                <th width="20%" id="satuan_nm_table">Frekuensi</th>
        
                                                <th width="20%" id="jumlah_unit_table">Jumlah</th>
                                                <th width="20%" id="biaya_satuan_table">Biaya Satuan</th>
                                                <th width="20%" id="total_table">Total</th>
                                                
                                                <th width="20%" id="jumlah_unit_mitra_table">Jumlah (mitra)</th>
                                                <th width="20%" id="biaya_satuan_mitra_table">Biaya Satuan (mitra)</th>
                                                <th width="20%" id="total_mitra_table">Total (mitra)</th>
        
                                                <th width="20%" id="jumlah_unit_mitra_table">Jumlah (BPKH)</th>
                                                <th width="20%" id="biaya_satuan_mitra_table">Biaya Satuan (BPKH)</th>
                                                <th width="20%" id="total_mitra_table">Total (BPKH)</th>
        
                                                <th width="10%" id="actions_table">#</th>
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
                                        <th width="1%">No</th>
                                        <th width="0%">Kode</th>
                                        <th width="0%" id="file_tp_table">Nama File</th>
                                        <th width="30%" id="file_tp_nm_table">Nama File</th>
                                        <th width="0%" id="file_ext_table">Ekstensi File</th>
                                        <th width="20%" id="note_table">Catatan</th>
                                        <th width="10%" id="action_table">#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    @if (isRoleUser('regas'))    
                    <div class="tab-pane fade show" id="tab-data-rekomendasi">
                        <form class="form-validate-jquery" id="form-rekomendasi" action="#">
                            @csrf
                            <div class="form-group form-group-float">
                                <label class="form-group-float-label is-visible">Nama Pejabat <span class="text-danger">*</span></label>
                                <input type="text" name="rekomendasi_nama" id="rekomendasi_nama" class="form-control" value="{{ !empty($rekomendasiPejabat) ? $rekomendasiPejabat->nama : '' }}">
                            </div>
                            <div class="form-group form-group-float">
                                <label class="form-group-float-label is-visible">Jabatan <span class="text-danger">*</span></label>
                                <input type="text" name="rekomendasi_jabatan" id="rekomendasi_jabatan" class="form-control" value="{{ !empty($rekomendasiPejabat) ? $rekomendasiPejabat->jabatan : '' }}">
                            </div>
                            <div class="form-group form-group-float">
                                <label class="form-group-float-label is-visible">Institusi <span class="text-danger">*</span></label>
                                <input type="text" name="rekomendasi_institusi" id="rekomendasi_institusi" class="form-control" value="{{ !empty($rekomendasiPejabat) ? $rekomendasiPejabat->institusi : '' }}">
                            </div>
                           {{-- @if ($proposal->sent_st == '0')     --}}
                            <div class="d-flex justify-content-end align-items-center">
                                <button type="submit" class="btn btn-primary legitRipple">Simpan <i class="icon-floppy-disk ml-2"></i></button>
                                <button type="reset" class="btn btn-light ml-2 legitRipple" id="reset">Selesai <i class="icon-reload-alt ml-2"></i></button>
                            </div>
                            {{-- @endif --}}
                        </form>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="col-md-3">
        <div class="card card-body border-top-1 border-top-teal"> --}}
            {{-- @if ($status)
                @if ($status->status == 'PROSES_11' && isRoleUser('pemohon'))
                <button type="button" class="btn btn-block btn-primary mb-2" id="kirim-proposal">Kirim Proposal <i class="icon-paperplane ml-2"></i></button>
                @else
                    @if ($status->proses_next_yes)
                    <button type="button" class="btn btn-block btn-primary mb-2" id="disposisi-proposal">{{ substr($status->trx_proses_status_id,7,strlen($status->trx_proses_status_id)).' - '.$status->proses_nm }} <i class="icon-merge ml-2"></i></button>
                    @endif
                @endif
            @endif --}}

            {{-- <div class="list-feed">
                @foreach ($disposisi as $timeline)	
                <div class="list-feed-item">
                    <span class='badge badge-info d-block'>{{ substr($timeline->status,7,strlen($timeline->status)).' - '.$timeline->proses_nm }}</span>
                    <div class="text-muted">{{ tgl_dan_jam($timeline->created_at)}}<br>{{ $timeline->timeline_by }}</div>
                    Catatan : {{ $timeline->note }}
                    @if ($timeline->file_asesmen)
                    <br><a href="{{ url('storage/asesmen-file/'.$timeline->file_asesmen) }}" download="{{ $timeline->proses_file_nm }}"> Download {{ $timeline->proses_file_nm ? $timeline->proses_file_nm : 'Berkas Asesmen' }} </a>
                    @endif
                </div>
                @endforeach
            </div> --}}
        {{-- </div>
    </div> --}}
</div>

{{-- @if ($status)    
@switch($proposal->proses_st)
    @case('PROSES_06')
        <!-- modal approval proposal -->
        <div id="modal-approval" class="modal fade" data-backdrop="false">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal-title-proposal">{{ $status->proses_nm }}</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <div class="modal-body">
                        <form class="form-validate-jquery" id="form-approval" action="#">
                            @csrf
                            <input type="hidden" name="approval_status" id="approval_status">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">Rekomendasi Pagu <span class="text-danger">*</span></label>
                                        <input type="text" name="nominal_rekomendasi" class="form-control money" placeholder="" aria-invalid="false" required="required" value="{{ $proposal->nominal_rekomendasi }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">Mitra Kemaslahatan <span class="text-danger">*</span></label>    
                                        <select name="trx_mitra_kemaslahatan_id" id="trx_mitra_kemaslahatan_id" data-placeholder="Pilih Data" class="trx_mitra_kemaslahatan_id form-control form-control-select2" required data-fouc>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">Jangka Waktu Assesmen </label>
                                        <input type="text" name="assesment_mitra" class="form-control daterange-picker" placeholder="Jangka Waktu Assesmen oleh Mitra">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="alert alert-primary alert-rounded approve-data" data-status="{{ substr($status->proses_next_yes,7,strlen($status->proses_next_yes)) }}" data-name="Tugaskan Ke Mitra">
                                        <span class="font-weight-semibold">
                                            <center>
                                                <h4>Tugaskan Ke Mitra</h4>
                                            </center>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                        
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-light legitRipple" data-dismiss="modal">Tutup <i class="icon-reload-alt ml-2"></i></button>
                    </div>
                </div>
            </div>
        </div>
        <!-- /modal approval proposal-->
        @break
        @case('PROSES_20')
        <!-- modal approval proposal -->
        <div id="modal-approval" class="modal fade" data-backdrop="false">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal-title-proposal">{{ $status->proses_nm }}</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <div class="modal-body">
                        <form class="form-validate-jquery" id="form-approval" action="#">
                            @csrf
                            <input type="hidden" name="approval_status" id="approval_status">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">Judul <span class="text-danger">*</span></label>
                                        <input type="text" name="judul_proposal_approval" class="form-control" required="" placeholder="Judul Proposal" aria-invalid="false" readonly="readonly" value="{{ $proposal->judul_proposal }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">Nominal <span class="text-danger">*</span></label>
                                        <input type="text" name="nominal_approval" class="form-control money" placeholder="" aria-invalid="false" readonly="readonly">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">Catatan <span class="text-danger">*</span></label>
                                        <textarea name="approval_note" id="approval_note" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">{{ $status->proses_file_nm ? $status->proses_file_nm : 'Berkas Asesmen' }} </label>
                                        <input type="file" name="file_asesmen" class="form-control" placeholder="{{ $status->proses_file_nm ? $status->proses_file_nm : 'Berkas Asesmen' }}" accept="application/pdf,.doc,.docx,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                @if (!empty($status->proses_next_no))
                                <div class="col-md-6">
                                    <div class="alert alert-primary alert-rounded approve-data" data-status="{{ substr($status->proses_next_yes,7,strlen($status->proses_next_yes)) }}" data-name="{{ $status->proses_btn_yes_title ? $status->proses_btn_yes_title : "Lanjutkan Ke Proses Berikutnya" }}">
                                        <span class="font-weight-semibold">
                                            <center>
                                                <h4>{{ $status->proses_btn_yes_title ? $status->proses_btn_yes_title : "Lanjutkan Ke Proses Berikutnya" }}</h4>
                                            </center>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="alert alert-danger alert-rounded approve-data" data-status="{{ substr($status->proses_next_no,7,strlen($status->proses_next_no)) }}" data-name="{{ $status->proses_btn_no_title }}">
                                        <span class="font-weight-semibold">
                                            <center>
                                                <h4>{{ $status->proses_btn_no_title }}</h4>
                                            </center>
                                        </span>
                                    </div>
                                </div>
                                @else
                                <div class="col-md-12">
                                    <div class="alert alert-primary alert-rounded approve-data" data-status="{{ substr($status->proses_next_yes,7,strlen($status->proses_next_yes)) }}" data-name="{{ $status->proses_btn_yes_title ? $status->proses_btn_yes_title : "Lanjutkan Ke Proses Berikutnya" }}">
                                        <span class="font-weight-semibold">
                                            <center>
                                                <h4>{{ $status->proses_btn_yes_title ? $status->proses_btn_yes_title : "Lanjutkan Ke Proses Berikutnya" }}</h4>
                                            </center>
                                        </span>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </form>
                    </div>
                        
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-light legitRipple" data-dismiss="modal">Tutup <i class="icon-reload-alt ml-2"></i></button>
                    </div>
                </div>
            </div>
        </div>
        <!-- /modal upload proposal-->
        @break
    @case('PROSES_22AB')
        <!-- modal approval proposal -->
        <div id="modal-approval" class="modal fade" data-backdrop="false">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal-title-proposal">Memberikan rekomendasi ringkasan proposal</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <div class="modal-body">
                        <form class="form-validate-jquery" id="form-approval" action="#">
                            @csrf
                            <input type="hidden" name="approval_status" id="approval_status">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">Catatan Asesmen <span class="text-danger">*</span></label>
                                        <textarea name="approval_note" id="approval_note" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">Berkas Assesmen </label>
                                        <input type="file" name="file_asesmen" class="form-control" placeholder="Berkas Assesmen" accept="application/pdf,.doc,.docx,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="alert alert-primary alert-rounded approve-data" data-status="11" data-name="Major">
                                        <span class="font-weight-semibold">
                                            <center>
                                                <h4>Major </h4>
                                            </center>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="alert alert-primary alert-rounded approve-data" data-status="13" data-name="Minor">
                                        <span class="font-weight-semibold">
                                            <center>
                                                <h4>Minor </h4>
                                            </center>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="alert alert-primary alert-rounded approve-data" data-status="23" data-name="Tanpa Perbaikan">
                                        <span class="font-weight-semibold">
                                            <center>
                                                <h4>Tanpa Perbaikan </h4>
                                            </center>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                        
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-light legitRipple" data-dismiss="modal">Tutup <i class="icon-reload-alt ml-2"></i></button>
                    </div>
                </div>
            </div>
        </div>
        <!-- /modal approval proposal-->
        @break
    @default
        <!-- modal approval proposal -->
        <div id="modal-approval" class="modal fade" data-backdrop="false">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal-title-proposal">{{ $status->proses_nm }}</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <div class="modal-body">
                        <form class="form-validate-jquery" id="form-approval" action="#">
                            @csrf
                            <input type="hidden" name="approval_status" id="approval_status">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">Catatan <span class="text-danger">*</span></label>
                                        <textarea name="approval_note" id="approval_note" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">{{ $status->proses_file_nm ? $status->proses_file_nm : 'Berkas Asesmen' }} </label>
                                        <input type="file" name="file_asesmen" class="form-control" placeholder="{{ $status->proses_file_nm ? $status->proses_file_nm : 'Berkas Asesmen' }}" accept="application/pdf,.doc,.docx,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                @if (!empty($status->proses_next_no))
                                <div class="col-md-6">
                                    <div class="alert alert-primary alert-rounded approve-data" data-status="{{ substr($status->proses_next_yes,7,strlen($status->proses_next_yes)) }}" data-name="{{ $status->proses_btn_yes_title ? $status->proses_btn_yes_title : "Lanjutkan Ke Proses Berikutnya" }}">
                                        <span class="font-weight-semibold">
                                            <center>
                                                <h4>{{ $status->proses_btn_yes_title ? $status->proses_btn_yes_title : "Lanjutkan Ke Proses Berikutnya" }}</h4>
                                            </center>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="alert alert-danger alert-rounded approve-data" data-status="{{ substr($status->proses_next_no,7,strlen($status->proses_next_no)) }}" data-name="{{ $status->proses_btn_no_title }}">
                                        <span class="font-weight-semibold">
                                            <center>
                                                <h4>{{ $status->proses_btn_no_title }}</h4>
                                            </center>
                                        </span>
                                    </div>
                                </div>
                                @else
                                <div class="col-md-12">
                                    <div class="alert alert-primary alert-rounded approve-data" data-status="{{ substr($status->proses_next_yes,7,strlen($status->proses_next_yes)) }}" data-name="{{ $status->proses_btn_yes_title ? $status->proses_btn_yes_title : "Lanjutkan Ke Proses Berikutnya" }}">
                                        <span class="font-weight-semibold">
                                            <center>
                                                <h4>{{ $status->proses_btn_yes_title ? $status->proses_btn_yes_title : "Lanjutkan Ke Proses Berikutnya" }}</h4>
                                            </center>
                                        </span>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </form>
                    </div>
                        
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-light legitRipple" data-dismiss="modal">Tutup <i class="icon-reload-alt ml-2"></i></button>
                    </div>
                </div>
            </div>
        </div>
        <!-- /modal upload proposal-->
@endswitch
@endif --}}

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
                                <input type="file" name="proposal_file" class="form-control" required="" placeholder="" accept="application/pdf">
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

<!-- modal preview berkas -->
<div id="modal-preview-berkas" class="modal fade" data-backdrop="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title-proposal">Preview Dokumen</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <form class="form-validate-jquery" method="POST" id="form-preview">
                    @csrf
                    <input type="hidden" name="proposal_id">
                    <div class="row">
                        <object id="object-preview" width="100%" height="400px" data=""></object><br><br><br>
                        <div class="col-md-12">
                            <div class="form-group form-group-float">
                                <label class="form-group-float-label is-visible" id="preview-label"> </label>
                                <textarea name="file_note" id="file_note" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
                
            <div class="modal-footer">
                <button type="button" class="btn btn-primary legitRipple" id="submit-preview">Simpan Catatan <i class="icon-floppy-disk ml-2"></i></button>
                <button type="reset" class="btn btn-light legitRipple" data-dismiss="modal">Tutup <i class="icon-reload-alt ml-2"></i></button>
            </div>
        </div>
    </div>
</div>
<!-- /modal preview berkas-->

@endsection
@push('scripts')
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
    integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
    crossorigin=""></script>
<script>
    var tabelFiles;
    var tabelPengurus;
    var tabelKerjasama;
    var tabelPersiapan;
    var tabelDonasi;
    var tabelRAB;
    var tabelKerjasama2;
    var tabelPj;
    var tabelOutcome;
    var tabelPengalaman;

    var saveMethod = 'ubah';
    var baseUrl = '{{ url("proposal-mitra") }}';
    var dataCd = '';
	
    var peta;
    var marker;

    $(document).ready(function(){
        // alert(baseUrl);
        $('input[name=nominal]').val().trigger('input');  
        $('input[name=nominal_approval]').val().trigger('input');  
        $('select[name=ruang_lingkup]').val().trigger('change');  
        $('input[name=assesment_mitra_view]').val();  
        
        // Create the maps
        peta = L.map('maps').setView([-1.60, 117.45], 5);
        L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            maxZoom: 18,
            id: 'mapbox/streets-v11',
            tileSize: 512,
            zoomOffset: -1,
            accessToken: '{{ env("MAP_TOKEN") }}'
        }).addTo(peta);
        marker = L.marker(peta.getCenter()).addTo(peta);
        
        peta.setView(new L.LatLng(), 10);
        peta.removeLayer(marker);
        marker = L.marker([]).addTo(peta).bindPopup("<div>"+[]+"</div>").openPopup();

        peta.on('click', onMapClick);

        $('#form-rekomendasi').submit(function(e){
            if (e.isDefaultPrevented()) {
			//--Handle the invalid form
            } else {
				e.preventDefault();
                
                var record  = $('#form-rekomendasi').serialize();
                var url     = baseUrl + '/pejabat-rekomendasi/'+dataCd;
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
                            'dataType': 'JSON',
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

        $(document).on('click', '#print-sk',function(){
            window.open(baseUrl + '/print/sk/'+dataCd,'_blank');
        });

        $(document).on('click', '#print-ringkasan',function(){
            window.open(baseUrl + '/print/ringkasan/'+dataCd,'_blank');
        });

        //--Submit form
        $('.form-proposal').submit(function(e){
            if (e.isDefaultPrevented()) {
			//--Handle the invalid form
            } else {
				e.preventDefault();
                for (instance in CKEDITOR.instances) {
                    CKEDITOR.instances[instance].updateElement();
                }
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
                for (instance in CKEDITOR.instances) {
                    CKEDITOR.instances[instance].updateElement();
                }
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
                    'id'    : ''
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

        

        $(document).on('click', '.ubah-rab',function(){
            saveMethod  = 'ubah';
            var rowData = tabelRAB.row($(this).parents('tr')).data();
            dataCd      = rowData.trx_proposal_rab_id;
            
            @switch(roleUser())
                @case('mitra')
                    $('input[name=rab_id]').val(rowData.trx_proposal_rab_id);
                    $('input[name=rab_biaya_satuan]').val(rowData.biaya_satuan_mitra).trigger('input');
                    $('input[name=rab_jumlah_unit]').val(rowData.jumlah_unit_mitra).trigger('input');
                    @break
                @case('regas')
                    $('input[name=rab_id]').val(rowData.trx_proposal_rab_id);
                    $('input[name=rab_biaya_satuan]').val(rowData.biaya_satuan_bpkh).trigger('input');
                    $('input[name=rab_jumlah_unit]').val(rowData.jumlah_unit_bpkh).trigger('input');
                    @break
                @default
                    $('input[name=rab_id]').val(rowData.trx_proposal_rab_id);
                    $('input[name=rab_biaya_satuan]').val(rowData.biaya_satuan).trigger('input');
                    $('input[name=rab_jumlah_unit]').val(rowData.jumlah_unit).trigger('input');
            @endswitch

            $('select[name=rab_satuan]').val(rowData.satuan).trigger('change');
            $('input[name=rab_jenis_pengeluaran]').val(rowData.jenis_pengeluaran).trigger('input');
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
                { data: 'file_tp_nm', name: 'file_tp_nm', visible:true },
                { data: 'file_ext', name: 'file_ext', visible:false },
                { data: 'note', name: 'note', visible:true },
                { data: 'actions', name: 'actions' },
            ],
        });

        $(document).on('click', '.proposal-file',function(){
            var rowData = tabelData.row($(this).parents('tr')).data();
            dataCd      = rowData.trx_proposal_id;

            tabelFiles.ajax.reload();
            $('#modal-files').modal('show');
        });

        $(document).on('click', '.download-file',function(){
            var rowData = tabelFiles.row($(this).parents('tr')).data();
            fileId      = rowData.trx_proposal_files_id;

            window.open(baseUrl + '/proposal-files/'+fileId,'_blank');
        });

        $(document).on('click', '.preview-file',function(){
            var rowData = tabelFiles.row($(this).parents('tr')).data();
            fileId      = rowData.trx_proposal_files_id;
            console.log(rowData);
            $('input[name=proposal_id]').val(fileId);
            $('#object-preview').attr('data',  '{{ url("storage/proposal-file") }}/'+rowData.file_path);

            $('#preview-label').html('');
            $('#preview-label').html('Catatan Berkas ' + rowData.file_tp_nm);
            $('textarea[name=file_note]').text(rowData.note)
            $('#modal-preview-berkas').modal('show');
        });

        $('#submit-preview').click(function(){
            $('#form-preview').submit();
        });

        //--Submit form
        $('#form-preview').submit(function(e){
            if (e.isDefaultPrevented()) {
			//--Handle the invalid form
            } else {
				e.preventDefault();
                var record  = new FormData(this);
                swal({
                    title               : 'Ubah Catatan Dokumen ?',
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
                            'type': "POST",
                            'url' : '{{ url("/proposal/proposal-files/catatan") }}',
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
                                        tabelFiles.ajax.reload();
                                        $('#modal-preview-berkas').modal('hide');
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

        $(document).on('click', '.upload-file',function(){
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
        $('#form-upload').submit(function(e){
            if (e.isDefaultPrevented()) {
			//--Handle the invalid form
            } else {
				e.preventDefault();
                for (instance in CKEDITOR.instances) {
                    CKEDITOR.instances[instance].updateElement();
                }
                var record  = new FormData(this);

                swal({
                    title               : 'Upload Dokumen ?',
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
                            'type': "POST",
                            'url' : '{{ url("/proposal/proposal-files/upload") }}',
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
                                        tabelFiles.ajax.reload();
                                        $('#modal-upload-berkas').modal('hide');
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
                for (instance in CKEDITOR.instances) {
                    CKEDITOR.instances[instance].updateElement();
                }
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

        $('.trx_mitra_kemaslahatan_id').select2({
            placeholder : "Pilih Mitra Kemaslahatan",
            
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
            
            ajax : {
                url :  "{{ url('daftar-daerah/by-root/') }}"+"/",
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
            
            ajax : {
                url :  "{{ url('daftar-daerah/by-root/') }}"+"/",
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
            
            ajax : {
                url :  "{{ url('daftar-daerah/by-root/') }}"+"/",
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
            $('input[name=approval_id]').val();

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
                                    // tabelData.ajax.reload();
                                    location.reload();
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

       
    });

    function reset(type) {
        saveMethod  = '';
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
        // tabelPersiapan.ajax.reload();
        // tabelDonasi.ajax.reload();
        // tabelKerjasama2.ajax.reload();
        // tabelPj.ajax.reload();
        // tabelOutcome.ajax.reload();
        // tabelPengalaman.ajax.reload();
        // @endif
    }

    function onMapClick(e) {
        $('input[name=proposal_latitude]').val(e.latlng.lat);
        $('input[name=proposal_longitude]').val(e.latlng.lng);

        peta.setView(new L.LatLng(e.latlng.lat, e.latlng.lng), 10);
        peta.removeLayer(marker);
        marker = L.marker(e.latlng).addTo(peta).bindPopup("<div>"+e.latlng+"</div>").openPopup();
    }
</script>
@endpush