@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
crossorigin=""/>

<style>
    #maps { height: 300px; };
</style>
<div class="row">
    <div class="col-md-9">
        <div class="card">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">
                @if (isRoleUser(['pemohon']))
                    Pengajuan Long Proposal
                @else
                    {{ $title }}
                @endif</h5>
                <div class="header-elements">
                    <div class="list-icons">
                        <span class='badge badge-info d-block'>{{ substr($proposal->proses_st,7,strlen($proposal->proses_st)).' - '.$proposal->proses_nm }}</span>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <ul class="nav nav-tabs nav-tabs-solid nav-justified rounded border-0">
                    <li class="nav-item"><a href="#tab-data-proposal" class="nav-link rounded-left active" data-toggle="tab"><i class="{{ $proposal->proposal_fill_st == 1 ? 'icon-floppy-disk' : 'icon-list' }} d-block mb-1 mt-1"></i>Proposal</a></li>
                    @if ($proposal->type_proposal==2)
                    <li class="nav-item"><a href="#tab-data-lembaga" class="nav-link rounded-left" data-toggle="tab"><i class="{{ $proposal->lembaga_fill_st == 1 ? 'icon-floppy-disk' : 'icon-list' }} d-block mb-1 mt-1"></i>Lembaga</a></li>
                    <li class="nav-item"><a href="#tab-data-pengurus" class="nav-link rounded-left" data-toggle="tab"><i class="{{ $proposal->pengurus_fill_st == 1 ? 'icon-floppy-disk' : 'icon-list' }} d-block mb-1 mt-1"></i>Pengurus</a></li>
                    <li class="nav-item"><a href="#tab-data-profil" class="nav-link rounded-left" data-toggle="tab"><i class="{{ $proposal->profil_fill_st == 1 ? 'icon-floppy-disk' : 'icon-list' }} d-block mb-1 mt-1"></i>Profil</a></li>
                    {{-- <li class="nav-item"><a href="#tab-data-kerjasama" class="nav-link rounded-left" data-toggle="tab"><i class="{{ $proposal->kerjasama_fill_st == 1 ? 'icon-floppy-disk' : 'icon-list' }} d-block mb-1 mt-1"></i>Kerjasama</a></li> --}}
                    <li class="nav-item"><a href="#tab-data-informasi" class="nav-link rounded-left" data-toggle="tab"><i class="{{ $proposal->informasi_fill_st == 1 ? 'icon-floppy-disk' : 'icon-list' }} d-block mb-1 mt-1"></i>Informasi</a></li>
                    <li class="nav-item"><a href="#tab-data-kontak" class="nav-link rounded-left" data-toggle="tab"><i class="{{ $proposal->kontak_fill_st == 1 ? 'icon-floppy-disk' : 'icon-list' }} d-block mb-1 mt-1"></i>Kontak</a></li>
                    <li class="nav-item"><a href="#tab-data-rab" class="nav-link rounded-left" data-toggle="tab"><i class="{{ $proposal->rab_fill_st == 1 ? 'icon-floppy-disk' : 'icon-list' }} d-block mb-1 mt-1"></i>RAB</a></li>
                    <li class="nav-item"><a href="#tab-data-upload" class="nav-link rounded-left" data-toggle="tab"><i class="{{ $proposal->file_fill_st == 1 ? 'icon-floppy-disk' : 'icon-list' }} d-block mb-1 mt-1"></i>Upload Berkas</a></li>
                    @endif
                    @if (isRoleUser(['regas', 'pelmonev']))
                    <li class="nav-item"><a href="#tab-data-print" class="nav-link rounded-left" data-toggle="tab"><i class="icon-printer d-block mb-1 mt-1"></i>Print File</a></li>
                    @endif
                </ul>
               
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="tab-data-proposal">
                        <div class="row">
                        <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-2">
                                        <label class="font-weight-bold">Nama Pemohon</label>
                                    </div>
                                    <div class="col-md-4">
                                    <label> : </label>
                                    {{ $pemohon ? $pemohon->pemohon_nm : '' }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <label class="font-weight-bold">Nomor HP</label>
                                    </div>
                                    <div class="col-md-4">
                                    <label> : </label>
                                    {{ $pemohon ? $pemohon->phone : '' }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <label class="font-weight-bold">Judul Proposal</label>
                                    </div>
                                    <div class="col-md-4">
                                    <label> : </label>
                                    {{ $proposal ? $proposal->judul_proposal : '' }}
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-2">
                                        <label class="font-weight-bold">Nomor Proposal</label>
                                    </div>
                                    <div class="col-md-4">
                                    <label> : </label>
                                    {{ $proposal ? $proposal->proposal_no : '' }}
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-2">
                                        <label class="font-weight-bold">Ruang Lingkup</label>
                                    </div>
                                    <div class="col-md-4">
                                    <label> : </label>
                                        <span>
                                            @if($proposal->ruang_lingkup == "RUANG_LINGKUP_1")
                                            Reguler - {{ $proposal->code_nm }}
                                            @else
                                            Tanggap Darurat - {{ $proposal->code_nm }}
                                            @endif
                                        </span>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-2">
                                        <label class="font-weight-bold">Nominal</label>
                                    </div>
                                    <div class="col-md-4">
                                    <label> : </label>
                                    {{ $proposal ? number_format($proposal->nominal,2,',','.') : '' }}
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-2">
                                        <label class="font-weight-bold">Provinsi</label>
                                    </div>
                                    <div class="col-md-4">
                                    <label> : </label>
                                        {{ $proposal ? getRegionNm($proposal->region_prop) : '' }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <label class="font-weight-bold">Kabupaten</label>
                                    </div>
                                    <div class="col-md-4">
                                    <label> : </label>
                                        {{ $proposal ? getRegionNm($proposal->region_kab) : '' }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <label class="font-weight-bold">Kecamatan</label>
                                    </div>
                                    <div class="col-md-4">
                                    <label> : </label>
                                        {{ $proposal ? getRegionNm($proposal->region_kec) : '' }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <label class="font-weight-bold">Kelurahan</label>
                                    </div>
                                    <div class="col-md-4">
                                    <label> : </label>
                                        {{ $proposal ? getRegionNm($proposal->region_kel) : '' }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <label class="font-weight-bold">Uraian Singkat</label>
                                    </div>
                                    <div class="col-md-4">
                                        <span style="font-style: italic;">{!! $proposal->uraian_singkat_proposal !!}</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <label class="font-weight-bold"></label>
                                    </div>
                                    <div class="col-md-4">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                @if(isRoleUser(['regas','kepbp']))
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5 class="card-title font-weight-bold">
                                            Hasil Screaning 1:
                                        </h5>
                                    </div>
                                    <div class="col-md-6">
                                        <h5 class="card-title font-weight-bold">
                                            Rekomendasi Pejabat Berwenang:
                                        </h5>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="font-weight-bold">Mitra Kemaslahatan</label>
                                    </div>
                                    <div class="col-md-4">
                                    <label> : </label>
                                        {{ $mitra != '' ? $mitra->mitra_kemaslahatan_nm : '' }}
                                    </div>

                                    <div class="col-md-2">
                                        <label class="font-weight-bold">Mitra Strategis</label>
                                    </div>
                                    <div class="col-md-4">
                                    <label>:</label>
                                        @php 
                                        if($lastPejabat != ''){
                                            $mitrax = \App\Models\PublicTrxMitraStrategis1::where('trx_mitra_strategis_id', $lastPejabat->trx_mitra_strategis_id)->first();
                                            $ms_name = $mitrax->ms_name;
                                        }else{
                                            $mitrax = false;
                                            $ms_name = $mitrax;
                                        }
                                        @endphp
                                        {{ $ms_name }}
                                    </div>

                                    <div class="col-md-2">
                                        <label class="font-weight-bold">Target Penyelesaian</label>
                                    </div>
                                    <div class="col-md-4">
                                    <label> : </label>
                                        {{ $lastScreaning != '' ? $lastScreaning->target_penyelesaian : '' }}
                                    </div>

                                    <div class="col-md-2">
                                        <label class="font-weight-bold">Nama Pejabat</label>
                                    </div>
                                    <div class="col-md-4">
                                    <label>:</label>
                                    {{ $lastPejabat != '' ? $lastPejabat->nama : '' }}
                                    </div>

                                    <div class="col-md-2">
                                        <label class="font-weight-bold">Catatan</label>
                                    </div>
                                    <div class="col-md-4">
                                    <span style="font-style: italic;">{!! $lastScreaning != '' ? $lastScreaning->note : '' !!}</span>
                                    </div>

                                    <div class="col-md-2">
                                        <label class="font-weight-bold">Jabatan</label>
                                    </div>
                                    <div class="col-md-4">
                                    <label>:</label>
                                    {{ $lastPejabat != '' ? $lastPejabat->jabatan : '' }}
                                    </div>

                                    <div class="col-md-2">
                                        <label class="font-weight-bold"></label>
                                    </div>
                                    <div class="col-md-4">
                                    <label></label>
                                    </div>

                                    <div class="col-md-2">
                                        <label class="font-weight-bold">Institusi</label>
                                    </div>
                                    <div class="col-md-4">
                                    <label>:</label>
                                    {{ $lastPejabat != '' ? $lastPejabat->institusi : '' }}
                                    </div>
                                </div>
                                <p></p>
                                @endif
                            </div>
                        </div>
                    </div>
        
                    <div class="tab-pane fade show" id="tab-data-lembaga">    
                        <div class="row">
                            <div class="col-md-12">    
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="font-weight-bold">Nama Lembaga</label>
                                    </div>
                                    <div class="col-md-4">
                                    <label> : </label>
                                    {{ $pemohon != '' ? $pemohon->pemohon_nm : '' }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="font-weight-bold">Nomor Akta Pendirian</label>
                                    </div>
                                    <div class="col-md-4">
                                    <label> : </label>
                                    {{ $proposal != '' ? $proposal->akta_pendirian : '' }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="font-weight-bold">Akta Perubahan Terakhir</label>
                                    </div>
                                    <div class="col-md-4">
                                    <label> : </label>
                                    {{ $proposal != '' ? $proposal->akta_perubahan_terakhir : ''}}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="font-weight-bold">No SK Pengesahan Pendirian</label>
                                    </div>
                                    <div class="col-md-4">
                                    <label> : </label>
                                    {{ $proposal != '' ? $proposal->sk_pengesahan_pendirian_no : '' }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="font-weight-bold">No SK Pengesahan Perubahan Terakhir</label>
                                    </div>
                                    <div class="col-md-4">
                                    <label> : </label>
                                    {{ $proposal != '' ? $proposal->sk_pengesahan_perubahan_terakhir_no : ''}}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="font-weight-bold">No KTP Pimpinan</label>
                                    </div>
                                    <div class="col-md-4">
                                    <label> : </label>
                                    {{ $proposal != '' ? $proposal->ktp_no_pimpinan : '' }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="font-weight-bold">No NPWP Lembaga</label>
                                    </div>
                                    <div class="col-md-4">
                                    <label> : </label>
                                    {{ $proposal != '' ? $proposal->npwp_no_lembaga : '' }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="font-weight-bold"></label>
                                    </div>
                                    <div class="col-md-4">
                                    <label></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade show" id="tab-data-pengurus">
                        <div class="table-responsive">
                            <table class="table datatable-pagination" id="tabel-pengurus" width="100%">
                                <thead>
                                    <tr>
                                        <th width="0%">Kode</th>
                                        <th width="20%" id="pengurus_nm_table">Nama Pengurus</th>
                                        <th width="20%" id="jabatan_nm_table">Jabatan</th>
                                        <th width="20%" id="pekerjaan_nm_table">Pekerjaan</th>
                                        <th width="20%" id="action">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade show" id="tab-data-profil">
                        <div class="row">
                            <div class="col-12">
                                <h5>Profil Singkat:</h5>
                                <p>{!! $proposal->profil_singkat !!}</p>
                                <div class="row">
                                    <div class="col-md-2">
                                        <label class="font-weight-bold"></label>
                                    </div>
                                    <div class="col-md-4">
                                    <label>  </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade show" id="tab-data-kerjasama">
                        <div class="alert bg-info text-white alert-styled-left alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
                            <span class="font-weight-semibold">Lembaga sudah pernah bekerjasama dengan Pemohon selama 2 thn terakhir.</span>
                        </div>  
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
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-2">
                                        <label class="font-weight-bold">Alamat Kantor</label>
                                    </div>
                                    <div class="col-md-4">
                                    <label> : </label>
                                    {{ $proposal->address }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <label class="font-weight-bold">No Telepon Kantor</label>
                                    </div>
                                    <div class="col-md-4">
                                    <label> : </label>
                                    {{ $proposal->phone }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <label class="font-weight-bold">Website</label>
                                    </div>
                                    <div class="col-md-4">
                                    <label> : </label>
                                    {{ $proposal->website }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <label class="font-weight-bold">Akun Sosial Media</label>
                                    </div>
                                    <div class="col-md-4">
                                    <label> : </label>
                                    {{ $proposal->socmed }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <label class="font-weight-bold"></label>
                                    </div>
                                    <div class="col-md-4">
                                    <label> </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
        
                    <div class="tab-pane fade show" id="tab-data-kontak">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-2">
                                        <label class="font-weight-bold">Nama Lengkap</label>
                                    </div>
                                    <div class="col-md-4">
                                    <label> : </label>
                                    {{ $proposal != '' ? $proposal->penanggung_jawab_nm : '' }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <label class="font-weight-bold">Email</label>
                                    </div>
                                    <div class="col-md-4">
                                    <label> : </label>
                                    {{ $proposal != '' ? $proposal->penanggung_jawab_email : ''}}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <label class="font-weight-bold">No. Handphone</label>
                                    </div>
                                    <div class="col-md-4">
                                    <label> : </label>
                                    {{ $proposal != '' ? $proposal->penanggung_jawab_phone : '' }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <label class="font-weight-bold">Bank Syariah</label>
                                    </div>
                                    <div class="col-md-4">
                                    <label> : </label>
                                    {{  $bank != '' ? $bank->bank_nm : '' }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <label class="font-weight-bold">Cabang</label>
                                    </div>
                                    <div class="col-md-4">
                                    <label> : </label>
                                    {{ $proposal != '' ? $proposal->bank_branch : ''}}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <label class="font-weight-bold">Atas Nama</label>
                                    </div>
                                    <div class="col-md-4">
                                    <label> : </label>
                                    {{ $proposal != '' ? $proposal->bank_holder : '' }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <label class="font-weight-bold">No. Rekening</label>
                                    </div>
                                    <div class="col-md-4">
                                    <label> : </label>
                                    {{ $proposal != '' ? $proposal->bank_account_no : '' }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <label class="font-weight-bold"></label>
                                    </div>
                                    <div class="col-md-4">
                                    <label> </label>
                                    </div>
                                </div>                              
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade show" id="tab-data-rab">
                        @if ($proposal->rab_tp == "PENGADAAN")
                        <div class="table-responsive">
                            <table class="table datatable-pagination table-pengadaan" id="tabel-rab-1" width="100%">
                                <thead>
                                    <tr>
                                        <th width="0%">Kode</th>
                                        <th width="0%">No</th>
                                        <th width="20%" id="jenis_pengeluaran_table">Item</th>
                                        <th width="20%" id="jumlah_unit_table">Jumlah</th>
                                        <th width="20%" id="biaya_satuan_table">Harga Satuan</th>
                                        <th width="20%" id="total_table">Jumlah Harga</th>
                                        <th width="10%" id="actions_table">#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        @elseif ($proposal->rab_tp == "PEMBANGUNAN")
                        <div class="table-responsive">
                            <table class="table datatable-pagination table-pembangunan" id="tabel-rab-2" width="100%">
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
                                        <th width="10%" id="actions_table">#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        @elseif ($proposal->rab_tp == "KEGIATAN")
                        <div class="table-responsive">
                            <table class="table datatable-pagination table-kegiatan" id="tabel-rab-3" width="100%">
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
                                        <th width="10%" id="actions_table">#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        @else
                        <div class="table-responsive">
                            <table class="table datatable-pagination table-rab-default" id="tabel-rab-4" width="100%">
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
                                        <th width="10%" id="actions_table">#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        @endif
                    </div>
                    <div class="tab-pane fade show" id="tab-data-upload">
                        <div class="alert alert-info alert-styled-left alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
                            File yang dapat diupload adalah <span class="font-weight-semibold"> PDF </span> dan maksimal ukuran file adalah <span class="font-weight-semibold"> 10 MB </span>
                        </div>
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
                    
                    @if (isRoleUser(['regas', 'pelmonev']))   
                    <div class="tab-pane fade show" id="tab-data-print">
                        @if (!in_array($proposal->proses_st, [
                            'PROSES_01',
                            'PROSES_01D',
                            'PROSES_01F',
                            'PROSES_02',
                            'PROSES_04',
                            'PROSES_04B',
                            'PROSES_05',
                            'PROSES_06',
                            'PROSES_07',
                            'PROSES_08',
                            'PROSES_09',
                            'PROSES_10',
                            'PROSES_100',
                            'PROSES_11',
                            'PROSES_12',
                            'PROSES_13',
                            'PROSES_14',
                            'PROSES_15',
                            'PROSES_16',
                            'PROSES_17',
                            'PROSES_18A',
                            'PROSES_18B',
                            'PROSES_19',
                            'PROSES_20AB',
                            'PROSES_21',
                            'PROSES_22AB',
                            'PROSES_23',
                            'PROSES_24ABC',
                            'PROSES_25ABCD',
                            'PROSES_26AB'
                        ]) || $baseUrl == 'sk-kegiatan')
                            <button type="button" class="btn btn-block btn-primary mb-2" id="print-sk">Print SK Kemaslahatan <i class="icon-print ml-2"></i></button><br>
                        @endif    
                        
                        @if (!in_array($proposal->proses_st, [
                            'PROSES_01',
                            'PROSES_01D',
                            'PROSES_01F',
                            'PROSES_02',
                            'PROSES_04',
                            'PROSES_04B',
                            'PROSES_05',
                            'PROSES_06',
                            'PROSES_07',
                            'PROSES_08',
                            'PROSES_09',
                            'PROSES_10',
                            'PROSES_100',
                            'PROSES_11',
                            'PROSES_12',
                            'PROSES_13',
                            'PROSES_14',
                            'PROSES_15',
                            'PROSES_16',
                            'PROSES_17',
                            'PROSES_18A',
                            'PROSES_18B',
                            'PROSES_19',
                            'PROSES_20AB',
                            'PROSES_21',
                            'PROSES_22AB',
                            'PROSES_23',
                            'PROSES_24ABC',
                            'PROSES_25ABCD',
                            'PROSES_26AB',
                            'PROSES_27',
                            'PROSES_28AB',
                            'PROSES_29',
                            'PROSES_30',
                            'PROSES_31AB',
                            'PROSES_32AB',
                            'PROSES_32C',
                            'PROSES_32D',
                            'PROSES_33'
                        ]))
                            <button type="button" class="btn btn-block btn-primary mb-2" id="print-spjtm">Print SPJTM <i class="icon-print ml-2"></i></button>
                        @endif 
                        
                        <button type="button" class="btn btn-block btn-primary mb-2" id="print-ringkasan">Print Ringkasan Proposal <i class="icon-print ml-2"></i></button>

                        <button type="button" class="btn btn-block btn-primary mb-2" id="print-pks">Print Draft PKS <i class="icon-print ml-2"></i></button><br>
                    </div>
                    @endif
                </div>                         
                            @if((isJabatanUser(3) && $proposal->proses_st == 'PROSES_TR') || (isJabatanUser(4) && $proposal->proses_st == 'PROSES_SKG') ||
                            (isJabatanUser(5) && $proposal->proses_st == 'PROSES_SDK') || (isJabatanUser(7) && $proposal->proses_st == 'PROSES_SABP') || (isJabatanUser(4) && $proposal->proses_st == 'PROSES_AMK') )
                            <ul class="nav nav-tabs nav-tabs-solid nav-justified rounded border-0 mt-5">
                                <li class="nav-item"><a href="#tab-data-screaning" class="nav-link rounded-left active" data-toggle="tab"><i class="icon-floppy-disk d-block mb-1 mt-1"></i>Screaning 1</a></li>
                                <li class="nav-item"><a href="#tab-data-rekomendasi" class="nav-link rounded-left" data-toggle="tab"><i class="icon-floppy-disk d-block mb-1 mt-1"></i>Rekomendasi Pejabat Berwenang</a></li>
                            </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane fade show active" id="tab-data-screaning">
                                            <form class="form-validate-jquery form-proposal" id="form-lembaga" action="#">
                                                @csrf
                                                <input type="hidden" id="trx_screaning1_id" name="trx_screaning1_id" value="{{ $lastScreaning != null ? $lastScreaning->trx_screaning1_id : ''}}">
                                                <input type="hidden" name="type" value="screaning">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        @php 
                                                        $mitra = \App\Models\PublicTrxMitraKemaslahatan::all();
                                                        @endphp
                                                        <div class="form-group form-group-float">
                                                            <label class="form-group-float-label is-visible">Mitra Kemaslahatan <span class="text-danger">*</span></label>
                                                            <select name="trx_mitra_kemaslahatan_id" id="trx_mitra_kemaslahatan_id" data-placeholder="Pilih Data" class="form-control form-control-select2" required data-fouc>
                                                            <option value="">Pilih</option>    
                                                                @if($lastScreaning != null)
                                                                    @foreach($mitra as $val)
                                                                        <option value="{{ $val->trx_mitra_kemaslahatan_id }}"{{ $lastScreaning->trx_mitra_kemaslahatan_id == $val->trx_mitra_kemaslahatan_id ? ' selected': ' '}}>{{ $val->mitra_kemaslahatan_nm }}</option>
                                                                    @endforeach
                                                                @else 
                                                                    @foreach($mitra as $val)
                                                                        <option value="{{ $val->trx_mitra_kemaslahatan_id }}">{{ $val->mitra_kemaslahatan_nm }}</option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group form-group-float">
                                                            <label class="form-group-float-label is-visible">Target Penyelesaian <span class="text-danger">*</span></label>
                                                            <input type="date" value="{{ $lastScreaning != null ? $lastScreaning->target_penyelesaian : ''}}" name="target_penyelesaian" id="target_penyelesaian" class="form-control form-control-date">
                                                        </div>
                                                    </div>  
                                                    <div class="col-md-12">
                                                        <div class="form-group form-group-float">
                                                            <label class="form-group-float-label is-visible">Catatan <span class="text-danger">*</span></label>
                                                            <textarea name="note" id="note" class="form-control ckeditor" required="required">{{ $lastScreaning != null ? $lastScreaning->note : "" }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                               @if ($proposal->sent_st == '0')    
                                                <div class="d-flex justify-content-end align-items-center">
                                                    <button type="submit" class="btn btn-primary legitRipple">Simpan <i class="icon-floppy-disk ml-2"></i></button>
                                                    <!-- <button type="reset" class="btn btn-light ml-2 legitRipple" id="reset">Reset <i class="icon-reload-alt ml-2"></i></button> -->
                                                </div>
                                                @endif
                                            </form>
                                        </div>
                                        <div class="tab-pane fade show" id="tab-data-rekomendasi">
                                            <form class="form-validate-jquery form-proposal" id="form-rekomendasi" action="#">
                                                <input type="hidden" name="type" value="pejabat">
                                                <input type="hidden" name="trx_mitra_strategis_id" id="trx_mitra_strategis_id" value="{{ $lastPejabat ? $lastPejabat->trx_mitra_strategis_id : '' }}">
                                                <input type="hidden" name="trx_proposal_pejabat_rekomendasi_id" id="trx_proposal_pejabat_rekomendasi_id" value="{{ $lastPejabat ? $lastPejabat->trx_proposal_pejabat_rekomendasi_id : '' }}" />
                                                @csrf
                                                @php 
                                                $strategis = \App\Models\PublicTrxMitraStrategis1::all();
                                                @endphp
                                                <div class="form-group form-group-float">
                                                    <label class="form-group-float-label is-visible">Mitra Strategis</label>    
                                                    <select id="ms_code" data-placeholder="Pilih Data" class="trx_mitra_strategis_id form-control form-control-select2" required data-fouc>
                                                        <option value="">Pilih</option>
                                                            @if($lastPejabat != '')
                                                            @foreach($strategis as $val)
                                                                <option value="{{ $val->ms_code }}"{{ $val->pejabat_name == $lastPejabat->nama ? ' selected': ''}}>{{ $val->ms_code }}</option>
                                                            @endforeach
                                                            @else
                                                            @foreach($strategis as $val)
                                                                <option value="{{ $val->ms_code }}">{{ $val->ms_code }}</option>
                                                            @endforeach
                                                            @endif
                                                        </option>
                                                    </select>
                                                </div>
                                                <div class="form-group form-group-float">
                                                    <label class="form-group-float-label is-visible">Nama Pejabat</label>
                                                        <!-- <select name="trx_proposal_pejabat_rekomendasi_id" class="form-control" id="rekomendasi_pejabat"> -->
                                                        <input type="text" name="rekomendasi_nama" id="rekomendasi_nama" class="form-control" readonly="readonly" value="{{ !empty($lastPejabat) ? $lastPejabat->nama : '' }}">
                                                    </select>
                                                </div>
                                                <div class="form-group form-group-float">
                                                    <label class="form-group-float-label is-visible">Jabatan</label>
                                                    <input type="text" name="rekomendasi_jabatan" id="rekomendasi_jabatan" class="form-control" readonly="readonly" value="{{ $lastPejabat ? $lastPejabat->jabatan : '' }}">
                                                </div>
                                                <div class="form-group form-group-float">
                                                    <label class="form-group-float-label is-visible">Institusi</label>
                                                    <input type="text" name="rekomendasi_instansi" id="rekomendasi_instansi" class="form-control" readonly="readonly" value="{{ $lastPejabat ? $lastPejabat->institusi : '' }}">
                                                </div>
                                                {{-- @if ($proposal->sent_st == '0')     --}}
                                                <div class="d-flex justify-content-end align-items-center">
                                                    <button type="submit" class="btn btn-primary legitRipple">Simpan <i class="icon-floppy-disk ml-2"></i></button>
                                                    <button type="reset" class="btn btn-light ml-2 legitRipple" id="reset">Selesai <i class="icon-reload-alt ml-2"></i></button>
                                                </div>
                                                {{-- @endif --}}
                                            </form>
                                        </div>
                                    </div>

                                    @elseif (isRoleUser(['regas', 'mitra', 'bidhk', 'bindmr']) && in_array($proposal->proses_st, $statusAnalisa) || in_array($proposal->proses_st, ['PROSES_AMK']))
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <h5 class="card-title font-weight-bold">
                                                        Hasil Screaning 1:
                                                    </h5>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <label class="font-weight-bold">Mitra Kemaslahatan</label>
                                                </div>
                                                <div class="col-md-4">
                                                    <label> : </label>
                                                        {{ $mitra != '' ? $mitra->mitra_kemaslahatan_nm : '' }}
                                                </div>
                                                <div class="col-md-2">
                                                    <label class="font-weight-bold"></label>
                                                </div>
                                                <div class="col-md-4">
                                                    <label></label>
                                                </div>
                                                <div class="col-md-2">
                                                    <label class="font-weight-bold">Target Penyelesaian</label>
                                                </div>
                                                <div class="col-md-4">
                                                    <label> : </label>
                                                        {{ $lastScreaning != '' ? $lastScreaning->target_penyelesaian : '' }}
                                                </div>
                                                <div class="col-md-2">
                                                    <label class="font-weight-bold"></label>
                                                </div>
                                                <div class="col-md-4">
                                                </div>
                                                <div class="col-md-2">
                                                    <label class="font-weight-bold">Catatan</label>
                                                </div>
                                                <div class="col-md-4">
                                                    <span style="font-style: italic;">{!! $lastScreaning != '' ? $lastScreaning->note : '' !!}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @if ($proposal->proses_st == 'PROSES_AMK')
                                    <ul class="nav nav-tabs nav-tabs-solid nav-justified rounded border-0 mt-5">
                                        <li class="nav-item"><a href="#tab-data-screaning" class="nav-link rounded-left active" data-toggle="tab"><i class="icon-floppy-disk d-block mb-1 mt-1"></i>Assessment</a></li>
                                        <li class="nav-item"><a href="#tab-data-rekomendasi" class="nav-link rounded-left" data-toggle="tab"><i class="icon-floppy-disk d-block mb-1 mt-1"></i>Uji Kelayakan</a></li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane fade show active" id="tab-data-screaning">
                                            <form class="form-validate-jquery form-proposal" id="form-assessment" action="#">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        @if ($assessment != null)
                                                            @if($assessment->photo != null)
                                                                @php 
                                                                    $x = $assessment->photo;
                                                                    $photo_decode = json_decode($x);
                                                                @endphp
                                                                @foreach ($photo_decode as $key => $photo)
                                                                    <div class="form-group form-group-float" id="formFoto-{{ $key }}">
                                                                        <label class="form-group-float-label is-visible">List Foto <span class="text-danger">*</span></label>
                                                                        <div class="row">
                                                                            <div class="col-md-3">
                                                                                <img src="{{ url('storage/app/public/assessment-file/' . $photo) }}" height="50" width="50">
                                                                                <input type="file" name="photo[]" id="photo" autocomplete="off" class="form-control">
                                                                            </div>
                                                                        </div>
                                                                    </div>  
                                                                @endforeach
                                                            @endif
                                                        @endif
                                                        <div class="form-add-foto">
                                                            <div class="form-group mt-3" id="formFoto-0">
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <input type="file" name="photo[]" id="photox" autocomplete="off" class="form-control">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <button id="btnAddFoto" type="button" class="btn btn-outline-primary mt-3">Tambah Pilihan</button><br>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group form-group-float">
                                                            <label class="form-group-float-label is-visible">Laporan Kunjungan Lapangan <span class="text-danger">*</span></label>
                                                            <textarea name="laporan_kunjungan_lapangan" id="laporan_kunjungan_lapangan" class="form-control ckeditor" required="required"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex justify-content-end align-items-center">
                                                        <button type="submit" id="save" class="btn btn-primary legitRipple">Simpan <i class="icon-floppy-disk ml-2"></i></button>
                                                        <!-- <button type="reset" class="btn btn-light ml-2 legitRipple" id="reset">Reset <i class="icon-reload-alt ml-2"></i></button> -->
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="tab-pane fade show" id="tab-data-rekomendasi">
                                            <form class="form-validate-jquery form-proposal" id="form-rekomendasi" action="#">
                                                @csrf
                                                <table class="table datatable-pagination">
                                                    <tr>
                                                        <td>1</td>
                                                        <td>Apakah Progam ini layak dilanjutkan</td>
                                                        <td>
                                                            <div class="form-check form-check-inline">
                                                                <div class="mx-1">
                                                                    <input class="form-check-input" type="radio" value="1" name="uji1">
                                                                    <label class="form-check-label" for="flexRadioDefault1">
                                                                    Ya
                                                                    </label>
                                                                </div>
                                                            
                                                                <div class="mx-1">
                                                                    <input class="form-check-input" type="radio" value="0" name="uji1">
                                                                    <label class="form-check-label" for="flexRadioDefault2">
                                                                    Tidak
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>2</td>
                                                        <td>Apakah Dana yang diajukan sesuai dengan peruntukan</td>
                                                        <td>
                                                            <div class="form-check form-check-inline">
                                                                <div class="mx-1">
                                                                    <input class="form-check-input" type="radio" value="1" name="uji2">
                                                                    <label class="form-check-label" for="flexRadioDefault1">
                                                                    Ya
                                                                    </label>
                                                                </div>
                                                            
                                                                <div class="mx-1">
                                                                    <input class="form-check-input" type="radio" value="0" name="uji2">
                                                                    <label class="form-check-label" for="flexRadioDefault2">
                                                                    Tidak
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>3</td>
                                                        <td>Apakah Penerima Manfaat Mampu Melanjutkan Program Secara Mandiri</td>
                                                        <td>
                                                            <div class="form-check form-check-inline">
                                                                <div class="mx-1">
                                                                    <input class="form-check-input" type="radio" value="1" name="uji3">
                                                                    <label class="form-check-label" for="flexRadioDefault1">
                                                                    Ya
                                                                    </label>
                                                                </div>
                                                            
                                                                <div class="mx-1">
                                                                    <input class="form-check-input" type="radio" value="0" name="uji3">
                                                                    <label class="form-check-label" for="flexRadioDefault2">
                                                                    Tidak
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>4</td>
                                                        <td>Apakah Progam Penerima Manfaat dan Program yang diusulkan memiliki resiko reputasi</td>
                                                        <td>
                                                            <div class="form-check form-check-inline">
                                                                <div class="mx-1">
                                                                    <input class="form-check-input" type="radio" value="1" name="uji4">
                                                                    <label class="form-check-label" for="flexRadioDefault1">
                                                                    Ya
                                                                    </label>
                                                                </div>
                                                            
                                                                <div class="mx-1">
                                                                    <input class="form-check-input" type="radio" value="0" name="uji4">
                                                                    <label class="form-check-label" for="flexRadioDefault2">
                                                                    Tidak
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>5</td>
                                                        <td>Apakah Legalitas Penerima Manfaat Valid</td>
                                                        <td>
                                                            <div class="form-check form-check-inline">
                                                                <div class="mx-1">
                                                                    <input class="form-check-input" type="radio" value="1" name="uji5">
                                                                    <label class="form-check-label" for="flexRadioDefault1">
                                                                    Ya
                                                                    </label>
                                                                </div>
                                                            
                                                                <div class="mx-1">
                                                                    <input class="form-check-input"  type="radio" value="0" name="uji5">
                                                                    <label class="form-check-label" for="flexRadioDefault2">
                                                                    Tidak
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </table>
                                                {{-- @if ($proposal->sent_st == '0')     --}}
                                                <div class="d-flex justify-content-end align-items-center">
                                                    <button type="submit" id="layak" class="btn btn-primary legitRipple">Layak <i class="icon-floppy-disk ml-2"></i></button>
                                                    <!-- <button type="reset" id="tidak_layak" class="btn btn-light ml-2 legitRipple" id="reset">Tidak Layak <i class="icon-reload-alt ml-2"></i></button> -->
                                                </div>
                                                {{-- @endif --}}
                                            </form>
                                        </div>
                                    </div>
                                    @endif
                        @endif
                <div>
                    <a href="{{ url('proposal')."/list-proposal" }}" class="btn btn-sm btn-light mx-1 px-2">Selesai</a>
                     @if ($proposal->proses_st != "PROSES_CPM" && !isRoleUser('pemohon'))                                
                        @if((isJabatanUser(9) && $proposal->proses_st == 'PROSES_KBP') || (isJabatanUser(7) && $proposal->proses_st == 'PROSES_ABP') ||
                            (isJabatanUser(5) && $proposal->proses_st == 'PROSES_DK') || (isJabatanUser(4) && $proposal->proses_st == 'PROSES_KR') )
                            <button id="disposisi-proposal" class="btn btn-sm btn-primary mx-1 px-2">Disposisi</button>
                         @elseif((isJabatanUser(3) && $proposal->proses_st == 'PROSES_TR') || (isJabatanUser(4) && $proposal->proses_st == 'PROSES_SKG') ||
                            (isJabatanUser(5) && $proposal->proses_st == 'PROSES_SDK') || (isJabatanUser(7) && $proposal->proses_st == 'PROSES_SABP'))
                            <button id="disposisi-proposal" class=" btn btn-sm btn-primary mx-1 px-2">Rekomendasikan</button>
                        @endif
                    @endif
                </div>    
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-body border-top-1 border-top-teal">
            @if ($status)
                @if ($status->status == 'PROSES_11' && isRoleUser('pemohon') && $proposal->sent_st == '0' && !in_array(0, [
                    $proposal->proposal_fill_st, 
                    $proposal->lembaga_fill_st, 
                    // $proposal->pengurus_fill_st, 
                    $proposal->profil_fill_st, 
                    $proposal->informasi_fill_st, 
                    $proposal->kontak_fill_st
                    // $proposal->rab_fill_st,
                    // $proposal->file_fill_st
                ]))
                <button type="button" class="btn btn-block btn-primary mb-2" id="kirim-proposal">Kirim Proposal <i class="icon-paperplane ml-2"></i></button>
                @else
                    @if ($status->proses_next_yes)
                    @endif
                @endif
            @endif

            <div class="list-feed">
                @foreach ($disposisi as $timeline)	
                <div class="list-feed-item">
                    <span class='badge badge-info d-block'>{{ substr($timeline->status,7,strlen($timeline->status)).' - '.$timeline->proses_nm }}</span>
                    <div class="text-muted">{{ tgl_dan_jam($timeline->created_at)}}<br>{{ $timeline->timeline_by }}</div>
                    Catatan : {{ $timeline->note }}
                    @if ($timeline->file_asesmen)
                    <br><a href="{{ url('storage/asesmen-file/'.$timeline->file_asesmen) }}" download="{{ $timeline->proses_file_nm }}"> Download {{ $timeline->proses_file_nm ? $timeline->proses_file_nm : 'Berkas Asessment' }} </a>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@if ($status)    
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
                    <input type="hidden" name="approval_status" id="approval_status" value="">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group form-group-float">
                                <label class="form-group-float-label is-visible">Catatan <span class="text-danger">*</span></label>
                                <textarea name="approval_note" id="approval_note" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @if (!empty($status->proses_next_no))
                        <div class="col-md-12">
                            <div class="alert alert-primary alert-rounded approve-data" data-status="{{ substr($status->proses_next_yes,7,strlen($status->proses_next_yes)) }}" data-name="{{ $status->proses_btn_yes_title ? $status->proses_btn_yes_title : "Lanjutkan Ke Proses Berikutnya" }}">
                                <span class="font-weight-semibold">
                                    <center>
                                        <h4>{{ $status->proses_btn_yes_title ? $status->proses_btn_yes_title : "Lanjutkan Ke Proses Berikutnya" }}</h4>
                                    </center>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-12">
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
                <!-- <button type="reset" class="btn btn-light legitRipple" data-dismiss="modal">Tutup <i class="icon-reload-alt ml-2"></i></button> -->
            </div>
        </div>
    </div>
</div>
@endif

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
                <!-- <button type="reset" class="btn btn-light legitRipple" data-dismiss="modal">Tutup <i class="icon-reload-alt ml-2"></i></button> -->
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
                <!-- <button type="reset" class="btn btn-light legitRipple" data-dismiss="modal">Tutup <i class="icon-reload-alt ml-2"></i></button> -->
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
    var baseUrl = '{{ url($baseUrl) }}';
    var dataCd = '{{ $proposal->trx_proposal_id }}';
	console.log(dataCd)
    var peta;
    var marker;

    $(document).ready(function(){
        // alert(baseUrl);
        $('input[name=nominal]').val("{{ (int)$proposal->nominal }}").trigger('input');  
        $('input[name=nominal_approval]').val("{{ (int)$proposal->nominal }}").trigger('input');  
        $('select[name=ruang_lingkup]').val("{{ $proposal->ruang_lingkup }}").trigger('change');  
        $('select[name=ruang_lingkup_child]').val("{{ $proposal->ruang_lingkup_child }}").trigger('change');
        $('select[name=mitra_kemaslahatan]').val("{{ $lastScreaning->mitra_kemaslahatan ?? "" }}").trigger('change');
        $('input[name=deskripsi_nominal]').val("{{ (int)$proposal->deskripsi_nominal }}").trigger('input');  
        $('select[name=deskripsi_spesifikasi_kegiatan]').val("{{ $proposal->deskripsi_spesifikasi_kegiatan }}").trigger('change');  
        $('select[name=rab_tp]').val("{{ $proposal->rab_tp }}").trigger('change');  
        $('input[name=assesment_mitra_view]').val("{{ $proposal->mitra_asessmen_date_start }}");  
        
        
        $(document).on('click', '#print-sk',function(){
            window.open(baseUrl + '/print/sk/'+dataCd,'_blank');
        });

        $(document).on('click', '#print-ringkasan',function(){
            window.open(baseUrl + '/print/ringkasan/'+dataCd,'_blank');
        });

        $(document).on('click', '#print-spjtm',function(){
            window.open(baseUrl + '/print/spjtm/'+dataCd,'_blank');
        });

        $(document).on('click', '#print-pks',function(){
            window.open(baseUrl + '/print/pks/'+dataCd,'_blank');
        });

            let submitForm = ""
            $('#layak').click(function(){
                submitForm =  3;
                $('#form-input-proposal').submit();
            });

            $('#tidak_layak').click(function(){
                submitForm = 4;
                $('#form-input-proposal').submit();
            });
            

            $('#submit-input').click(function(){
                submitForm = 0;
                $('#form-input-proposal').submit();
            });

            $('#draft-input').click(function(){
                submitForm = 0;
                $('#form-input-proposal').submit();
            });

            $('#save').click(function(){
                submitForm = 5;
                $('#form-input-proposal').submit();
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
                if (submitForm != "" || submitForm != null) {
                    record.append('submit', submitForm);
                }
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
                                    $("#trx_proposal_pejabat_rekomendasi_id").val(response["trx_screaning_id"])
									$("#trx_screaning1_id").val(response["trx_screaning_id"])
                                    swal({
                                        title: "Proses berhasil",
                                        type: "success",
                                        showCancelButton: false,
                                        showConfirmButton: false,
                                        timer: 1000
                                    }).then(() => {
                                        // $('#reset').click();
                                        swal.close();
                                        if (submitForm == 1) {
                                            window.location = baseUrl;
                                        }else if(submitForm == 3){
                                            window.location.href = baseUrl + '/list-proposal/create-proposal-mitra/' + dataCd
                                        }
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
                { data: 'action', name: 'action' },
            ],
        });

        $(document).ready(function()
        {
            @if ($proposal->rab_tp == 'PENGADAAN')
                    $(".form-pengadaan").show();
                    $(".table-pengadaan").show();
                    $(".form-pembangunan").hide();
                    $(".table-pembangunan").hide();
                    $(".form-kegiatan").hide();
                    $(".table-kegiatan").hide();
                    $(".form-rab-default").hide();
                    $(".table-rab-default").hide();
                    tabelRAB = $('#tabel-rab-1').DataTable({
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
                        { data: 'total', name: 'total', render: $.fn.dataTable.render.number( '.', ',', 2, 'Rp ' ) },
                        { data: 'actions', name: 'actions', orderable:false }
        
                    ],
                });
                @elseif ($proposal->rab_tp == 'PEMBANGUNAN')
                    $(".form-pembangunan").show();
                    $(".table-pembangunan").show();
                    $(".form-pengadaan").hide();
                    $(".table-pengadaan").hide();
                    $(".form-kegiatan").hide();
                    $(".table-kegiatan").hide();
                    $(".form-rab-default").hide();
                    $(".table-rab-default").hide();
                    tabelRAB = $('#tabel-rab-2').DataTable({
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
                            { data: 'satuan', name: 'satuan', visible:false },
                            { data: 'satuan_nm', name: 'satuan_nm' },   
                            { data: 'biaya_satuan', name: 'biaya_satuan', render: $.fn.dataTable.render.number( '.', ',', 2, 'Rp ' ) },
                            { data: 'total', name: 'total', render: $.fn.dataTable.render.number( '.', ',', 2, 'Rp ' ) },
                            { data: 'actions', name: 'actions', orderable:false }
            
                        ],
                    });
                @elseif($proposal->rab_tp == 'KEGIATAN')
                    $(".form-kegiatan").show();
                    $(".table-kegiatan").show();
                    $(".form-pengadaan").hide();
                    $(".table-pengadaan").hide();
                    $(".form-pembangunan").hide();
                    $(".table-pembangunan").hide();
                    $(".form-rab-default").hide();
                    $(".table-rab-default").hide();
                    tabelRAB = $('#tabel-rab-3').DataTable({
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
                            { data: 'satuan', name: 'satuan', visible:false },
                            { data: 'satuan_nm', name: 'satuan_nm' },   
                            { data: 'biaya_satuan', name: 'biaya_satuan', render: $.fn.dataTable.render.number( '.', ',', 2, 'Rp ' ) },
                            { data: 'jumlah_unit', name: 'jumlah_unit' },
                            { data: 'total', name: 'total', render: $.fn.dataTable.render.number( '.', ',', 2, 'Rp ' ) },
            
                            { data: 'actions', name: 'actions', orderable:false }
            
                        ],
                    });
                @else
                    $(".form-rab-default").show();
                    $(".table-rab-default").show();
                    $(".form-pengadaan").hide();
                    $(".table-pengadaan").hide();
                    $(".form-pembangunan").hide();
                    $(".table-pembangunan").hide();
                    $(".form-kegiatan").hide();
                    $(".table-kegiatan").hide();
                    tabelRAB = $('#tabel-rab-4').DataTable({
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
                            { data: 'satuan', name: 'satuan', visible:false },
                            { data: 'satuan_nm', name: 'satuan_nm' },
            
                            { data: 'jumlah_unit', name: 'jumlah_unit' },
                            { data: 'biaya_satuan', name: 'biaya_satuan', render: $.fn.dataTable.render.number( '.', ',', 2, 'Rp ' ) },
                            { data: 'total', name: 'total', render: $.fn.dataTable.render.number( '.', ',', 2, 'Rp ' ) },
            
                            { data: 'actions', name: 'actions', orderable:false }
            
                        ],
                    });
                @endif
        });


        @if (!in_array($proposal->proses_st, ['PROSES_01','PROSES_01D','PROSES_01F','PROSES_02','PROSES_04','PROSES_04B','PROSES_05','PROSES_06']))    
        // tab bawah
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

        tabelPersiapan = $('#tabel-persiapan').DataTable({
            language: {
                paginate: {'next': $('html').attr('dir') == 'rtl' ? 'Next &larr;' : 'Next &rarr;', 'previous': $('html').attr('dir') == 'rtl' ? '&rarr; Prev' : '&larr; Prev'}
            },
            pagingType: "simple",
            processing	: true, 
            serverSide	: true, 
            order		: [], 
            ajax		: {
                url: baseUrl + '/persiapan/data',
                type: "POST",
                data: {
                    '_token': $('meta[name="csrf-token"]').attr('content'),
                    'id'    : '{{ $proposal->trx_proposal_id }}'
                },
            },
            dom : 'tpi',
            columns: [
                { data: 'trx_proposal_persiapan_id', name: 'trx_proposal_persiapan_id', visible:false },
                { data: 'DT_RowIndex', name:'DT_RowIndex', visible:true},
                { data: 'komponen_persiapan', name: 'komponen_persiapan' },
                { data: 'progress', name: 'progress' },
            ],
        });

        tabelDonasi = $('#tabel-donasi').DataTable({
            language: {
                paginate: {'next': $('html').attr('dir') == 'rtl' ? 'Next &larr;' : 'Next &rarr;', 'previous': $('html').attr('dir') == 'rtl' ? '&rarr; Prev' : '&larr; Prev'}
            },
            pagingType: "simple",
            processing	: true, 
            serverSide	: true, 
            order		: [], 
            ajax		: {
                url: baseUrl + '/donasi/data',
                type: "POST",
                data: {
                    '_token': $('meta[name="csrf-token"]').attr('content'),
                    'id'    : '{{ $proposal->trx_proposal_id }}'
                },
            },
            dom : 'tpi',
            columns: [
                { data: 'trx_proposal_donasi_id', name: 'trx_proposal_donasi_id', visible:false },
                { data: 'DT_RowIndex', name:'DT_RowIndex', visible:true},
                { data: 'donatur', name: 'donatur' },
                { data: 'instansi', name: 'instansi' },
                { data: 'nominal', name: 'nominal', render: $.fn.dataTable.render.number( '.', ',', 2, 'Rp ' ) },
                // { data: 'waktu_kerjasama', name: 'waktu_kerjasama' },
                // { data: 'lokasi', name: 'lokasi' },
                // { data: 'periode', name: 'periode' },
            ],
        });

        tabelKerjasama2 = $('#tabel-kerjasama2').DataTable({
            language: {
                paginate: {'next': $('html').attr('dir') == 'rtl' ? 'Next &larr;' : 'Next &rarr;', 'previous': $('html').attr('dir') == 'rtl' ? '&rarr; Prev' : '&larr; Prev'}
            },
            pagingType: "simple",
            processing	: true, 
            serverSide	: true, 
            order		: [], 
            ajax		: {
                url: baseUrl + '/kerjasama2/data',
                type: "POST",
                data: {
                    '_token': $('meta[name="csrf-token"]').attr('content'),
                    'id'    : '{{ $proposal->trx_proposal_id }}'
                },
            },
            dom : 'tpi',
            columns: [
                { data: 'trx_proposal_kerjasama_id', name: 'trx_proposal_kerjasama_id', visible:false },
                { data: 'DT_RowIndex', name:'DT_RowIndex', visible:true},
                { data: 'jenis_kontraprestasi', name: 'jenis_kontraprestasi' },
                { data: 'jumlah', name: 'jumlah' },
                { data: 'nama_paket', name: 'nama_paket' },
            ],
        });

        tabelPj = $('#tabel-pj').DataTable({
            language: {
                paginate: {'next': $('html').attr('dir') == 'rtl' ? 'Next &larr;' : 'Next &rarr;', 'previous': $('html').attr('dir') == 'rtl' ? '&rarr; Prev' : '&larr; Prev'}
            },
            pagingType: "simple",
            processing	: true, 
            serverSide	: true, 
            order		: [], 
            ajax		: {
                url: baseUrl + '/pj/data',
                type: "POST",
                data: {
                    '_token': $('meta[name="csrf-token"]').attr('content'),
                    'id'    : '{{ $proposal->trx_proposal_id }}'
                },
            },
            dom : 'tpi',
            columns: [
                { data: 'trx_proposal_pj_id', name: 'trx_proposal_pj_id', visible:false },
                { data: 'DT_RowIndex', name:'DT_RowIndex', visible:true},
                { data: 'nama', name: 'nama' },
                { data: 'posisi', name: 'posisi' },
                { data: 'note', name: 'note' },
            ],
        });
        
        tabelOutcome = $('#tabel-outcome').DataTable({
            language: {
                paginate: {'next': $('html').attr('dir') == 'rtl' ? 'Next &larr;' : 'Next &rarr;', 'previous': $('html').attr('dir') == 'rtl' ? '&rarr; Prev' : '&larr; Prev'}
            },
            pagingType: "simple",
            processing	: true, 
            serverSide	: true, 
            order		: [], 
            ajax		: {
                url: baseUrl + '/outcome/data',
                type: "POST",
                data: {
                    '_token': $('meta[name="csrf-token"]').attr('content'),
                    'id'    : '{{ $proposal->trx_proposal_id }}'
                },
            },
            dom : 'tpi',
            columns: [
                { data: 'trx_proposal_outcome_id', name: 'trx_proposal_outcome_id', visible:false },
                { data: 'DT_RowIndex', name:'DT_RowIndex', visible:true},
                { data: 'sub_kegiatan', name: 'sub_kegiatan' },
                { data: 'outcome', name: 'outcome' },
                { data: 'output', name: 'output' },
            ],
        });

        tabelPengalaman = $('#tabel-pengalaman').DataTable({
            language: {
                paginate: {'next': $('html').attr('dir') == 'rtl' ? 'Next &larr;' : 'Next &rarr;', 'previous': $('html').attr('dir') == 'rtl' ? '&rarr; Prev' : '&larr; Prev'}
            },
            pagingType: "simple",
            processing	: true, 
            serverSide	: true, 
            order		: [], 
            ajax		: {
                url: baseUrl + '/pengalaman/data',
                type: "POST",
                data: {
                    '_token': $('meta[name="csrf-token"]').attr('content'),
                    'id'    : '{{ $proposal->trx_proposal_id }}'
                },
            },
            dom : 'tpi',
            columns: [
                { data: 'trx_proposal_pengalaman_id', name: 'trx_proposal_pengalaman_id', visible:false },
                { data: 'DT_RowIndex', name:'DT_RowIndex', visible:true},
                { data: 'program_kegiatan', name: 'program_kegiatan' },
                { data: 'tujuan', name: 'tujuan' },
                { data: 'lokasi', name: 'lokasi' },
                { data: 'outcome', name: 'outcome' },
                { data: 'output', name: 'output' },
            ],
        });
        @endif

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
            @if($proposal->trx_mitra_kemaslahatan_id)
            data:[{"id": "{{ $proposal->trx_mitra_kemaslahatan_id }}" ,"text":"{{ $proposal->mitra_kemaslahatan_nm}}" }] ,
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

        $('select[name=trx_mitra_strategis_id]').select2({
            placeholder : "Pilih Mitra Strategis",
            @if($proposal->trx_mitra_strategis_id)
            data:[{"id": "{{ $proposal->trx_mitra_strategis_id }}" ,"text":"{{ $proposal->mitra_strategis_nm }}" }] ,
            @endif
            ajax : {
                url :  "{{ url('dropdown-data/mitra-strategis') }}",
                dataType: 'json',
                processResults: function(data){
                    return {
                        results: data
                    };
                },
                success: function(response){
                    $('.trx_mitra_strategis_id').on('select2:select', function (e) {
                        var data = e.params.data;
                        $('input[name=rekomendasi_nama]').val(data.text);
                        $('input[name=rekomendasi_jabatan]').val(data.jabatan);
                        $('input[name=rekomendasi_instansi]').val(data.instansi);
                    });
                }
            },
        });

        @if($proposal->trx_mitra_strategis_id)
        $('input[name=rekomendasi_nama]').val("{{ $proposal->mitra_strategis_nm }}");
        $('input[name=rekomendasi_jabatan]').val("{{ $proposal->jabatan }}");
        $('input[name=rekomendasi_instansi]').val("{{ $proposal->instansi }}");
        @endif

        $('.region_prop').select2({
            // placeholder : "Pilih Propinsi",
            @if($proposal->region_prop)
            data:[{"id": "{{ $proposal->region_prop }}" ,"text":"{{ getRegionNm($proposal->region_prop) }}" }] ,
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

        $('.region_kab').select2({
            // placeholder : "Pilih Kota",
            @if($proposal->region_kab)
            data:[{"id": "{{ $proposal->region_kab }}" ,"text":"{{ getRegionNm($proposal->region_kab) }}" }] ,
            @endif
            ajax : {
                url :  "{{ url('daftar-daerah/by-root/') }}"+"/{{ $proposal->region_prop }}",
                dataType: 'json',
                processResults: function(data){
                    return {
                        results: data
                    };
                },
            },
        });

        $('.region_kec').select2({
            // placeholder : "Pilih Kota",
            @if($proposal->region_kab)
            data:[{"id": "{{ $proposal->region_kec }}" ,"text":"{{ getRegionNm($proposal->region_kec) }}" }] ,
            @endif
            ajax : {
                url :  "{{ url('daftar-daerah/by-root/') }}"+"/{{ $proposal->region_kab }}",
                dataType: 'json',
                processResults: function(data){
                    return {
                        results: data
                    };
                },
            },
        });
  
        $('.region_kel').select2({
            // placeholder : "Pilih Kota",
            @if($proposal->region_kab)
            data:[{"id": "{{ $proposal->region_kel }}" ,"text":"{{ getRegionNm($proposal->region_kel) }}" }] ,
            @endif
            ajax : {
                url :  "{{ url('daftar-daerah/by-root/') }}"+"/{{ $proposal->region_kec }}",
                dataType: 'json',
                processResults: function(data){
                    return {
                        results: data
                    };
                },
            },
        });

        $('.region_prop').change(function () {
            $('.region_kab').empty();
            $('.region_kec').empty();
            $('.region_kel').empty();
            $('.region_kab').select2({
                // placeholder : "Pilih Kota",
                @if($proposal->region_kab)
                data:[{"id": "{{ $proposal->region_kab }}" ,"text":"{{ getRegionNm($proposal->region_kab) }}" }] ,
                @endif
                ajax : {
                    url :  "{{ url('daftar-daerah/by-root/') }}"+"/"+$('#region_prop').val(),
                    dataType: 'json',
                    processResults: function(data){
                        return {
                            results: data
                        };
                    },
                },
            });
        });

        $('.region_kab').change(function () {
            $('.region_kec').empty();
            $('.region_kel').empty();
            $('.region_kec').select2({
                // placeholder : "Pilih Kota",
                @if($proposal->region_kec)
                data:[{"id": "{{ $proposal->region_kec }}" ,"text":"{{ getRegionNm($proposal->region_kec) }}" }] ,
                @endif
                ajax : {
                    url :  "{{ url('daftar-daerah/by-root/') }}"+"/"+$('#region_kab').val(),
                    dataType: 'json',
                    processResults: function(data){
                        return {
                            results: data
                        };
                    },
                },
            });
        });

        $('.region_kec').change(function () {
            $('.region_kel').empty();
            $('.region_kel').select2({
                @if($proposal->region_kel)
                data:[{"id": "{{ $proposal->region_kel }}" ,"text":"{{ getRegionNm($proposal->region_kel) }}" }] ,
                @endif
                // placeholder : "Pilih Kota",
                ajax : {
                    url :  "{{ url('daftar-daerah/by-root/') }}"+"/"+$('#region_kec').val(),
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
            $('input[name=approval_status]').val($(this).attr('data-status'));
            $('input[name=approval_id]').val("{{ $lastStatus->trx_proposal_timeline_id ?? "" }}");

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

        @if($proposal->sent_st == "0")
        $(document).on('click', '#kirim-proposal',function(){
            swal({
                title               : "Kirim Proposal?",
                type                : "question",
                showCancelButton    : true,
                confirmButtonColor  : "#00a65a",
                confirmButtonText   : "OK",
                cancelButtonText    : "NO",
                allowOutsideClick : false,
            }).then(function(result){
                if(result.value){
                    swal({allowOutsideClick : false,title: "Kirim Proposal",onOpen: () => {swal.showLoading();}});

                    $.ajax({
                        'type': 'POST',
                        'url' : baseUrl +"/send/"+dataCd,
                        'data': null,
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
        @endif
    });

    function resetRab(type) {
        tabelRAB.clear();
        tabelRAB.destroy();
        tabelRAB.ajax.reload();
    }
    function reset(type) {
        saveMethod  = '';
        dataCd = null;
        rowData = null;
        tabelPengurus.ajax.reload();
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
        tabelRAB.ajax.reload();
        @if (!in_array($proposal->proses_st, ['PROSES_01','PROSES_01D','PROSES_01F','PROSES_02','PROSES_04','PROSES_04B','PROSES_05','PROSES_06']))    
        tabelKerjasama.ajax.reload();
        tabelPersiapan.ajax.reload();
        tabelDonasi.ajax.reload();
        tabelKerjasama2.ajax.reload();
        tabelPj.ajax.reload();
        tabelOutcome.ajax.reload();
        tabelPengalaman.ajax.reload();
        @endif
    }

    function onMapClick(e) {
        $('input[name=proposal_latitude]').val(e.latlng.lat);
        $('input[name=proposal_longitude]').val(e.latlng.lng);

        peta.setView(new L.LatLng(e.latlng.lat, e.latlng.lng), 10);
        peta.removeLayer(marker);
        marker = L.marker(e.latlng).addTo(peta).bindPopup("<div>"+e.latlng+"</div>").openPopup();
    }
    $('body').on('change','#ms_code', function(){
        $.ajax({
            url: baseUrl + '/get-pejabat',
            method: 'get',
            dataType: 'json',
            data: {
                'ms_code': $(this).val()
            }
        }).done(function(response){
            $("#trx_mitra_strategis_id").val(response.trx_mitra_strategis_id)
            $('#rekomendasi_jabatan').val(response.jabatan)
            $('#rekomendasi_instansi').val(response.instansi)
            $('#rekomendasi_nama').val(response.pejabat_name)
        })
    })
</script>
@endpush