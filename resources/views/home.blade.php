@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
    integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
    crossorigin=""/>
    <!-- Dashboard content -->
    <div class="row">
        <div class="col-xl-12">
            @switch(roleUser())
                @case('pemohon')
                     <!-- pemohon proposal -->
                     <div class="card">
                        <div class="card-header header-elements-sm-inline">
                            <h4 class="card-title">Pengajuan Proposal Mitra Kemaslahatan Selaku Penerima Manfaat</h4>
                        </div>

                        <div class="card-body">
                            <ul class="list mb-0">
                                <li><h4>Silahkan pilih jenis pengiriman proposal</h4>
                                    <ul class="list">
                                        <li><h4>Ajukan online</h4>
                                            <ul class="list">
                                                <li><h4>adalah mengisi pengajuan proposal melalui aplikasi</h4></li>
                                            </ul>
                                        </li>
                                        <li><h4>Upload dokumen (berlaku hingga 30 April 2022 Pukul 23:59)</h4>
                                            <ul class="list">
                                                <li><h4>adalah mengisi dan upload satu dokumen pdf</h4> </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="alert alert-primary alert-rounded alert-dismissible" id="input-proposal">
                                        <span class="font-weight-semibold">
                                            <center>
                                                <h4>Ajukan Online</h4>
                                            </center>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="alert alert-primary alert-rounded alert-dismissible" id="upload-proposal">
                                        <span class="font-weight-semibold">
                                            <center>
                                                <h4>Upload Dokumen</h4>
                                            </center>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @break
                @case('mitra')
                    <!-- pemohon proposal -->
                    <div class="card">
                        <div class="card-header header-elements-sm-inline">
                            <h4 class="card-title">Pengajuan Proposal Mitra Kemaslahatan Selaku Penerima Manfaat</h4>
                        </div>

                        <div class="card-body">
                            {{-- <ul class="list mb-0">
                                <li><h4>Silahkan pilih jenis pengiriman proposal</h4>
                                    <ul class="list">
                                        <li><h4>Ajukan online</h4>
                                            <ul class="list">
                                                <li><h4>adalah mengisi pengajuan proposal melalui aplikasi</h4></li>
                                            </ul>
                                        </li>
                                        <li><h4>Upload dokumen (berlaku hingga 30 April 2022 Pukul 23:59)</h4>
                                            <ul class="list">
                                                <li><h4>adalah mengisi dan upload satu dokumen pdf</h4> </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                            </ul> --}}
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="alert alert-primary alert-rounded alert-dismissible" id="input-proposal">
                                        <span class="font-weight-semibold">
                                            <center>
                                                <h4>Ajukan Online</h4>
                                            </center>
                                        </span>
                                    </div>
                                </div>
                                {{-- <div class="col-md-6">
                                    <div class="alert alert-primary alert-rounded alert-dismissible" id="upload-proposal">
                                        <span class="font-weight-semibold">
                                            <center>
                                                <h4>Upload Dokumen</h4>
                                            </center>
                                        </span>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                    @break
                @case('regas')
                    <style>
                        #maps { height: 500px; };
                    </style>
                    <!-- pemohon proposal -->
                    <div class="card">
                        <div class="card-header header-elements-sm-inline">
                            <h4 class="card-title">Pengajuan Proposal Mitra Kemaslahatan Selaku Penerima Manfaat</h4>
                        </div> 

                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="alert alert-primary alert-rounded alert-dismissible" id="input-proposal">
                                        <span class="font-weight-semibold">
                                            <center>
                                                <h4>Ajukan Untuk Kuota Nasional</h4>
                                            </center>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header header-elements-sm-inline">
                            <center><h4 class="card-title">Sebaran Penerima Manfaat</h4></center>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">Tahun <span class="text-danger">*</span></label>    
                                        <select name="trx_year_param" id="trx_year_param" class="form-control form-control-select2 select-search" data-fouc>
                                            @for ($i = 2022 ; $i <= date('Y') ; $i++)
                                            <option value="<?= $i ?>"><?= $i ?></option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">Mitra Kemaslahatan <span class="text-danger">*</span></label>    
                                        <select name="mitra_kemaslahatan_param" id="mitra_kemaslahatan_param" data-placeholder="Pilih Data" class="trx_mitra_kemaslahatan_id form-control form-control-select2" required data-fouc>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">Mitra Strategis <span class="text-danger">*</span></label>    
                                        <select name="mitra_strategis_param" id="mitra_strategis_param" data-placeholder="Pilih Data" class="trx_mitra_strategis_id form-control form-control-select2" required data-fouc>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">Propinsi</label>
                                        <select name="region_prop_param" id="region_prop_param" data-placeholder="Pilih Data" class="form-control form-control-select2 check-kuota" data-fouc>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible"></label>    
                                        <button type="button" id="filter-dashboard" class="btn btn-primary btn-block">Filter</button>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <button type="button" data-tp="pemohon" class="koordinat btn btn-primary btn-block">Pemohon</button>
                                </div>
                                <div class="col-md-6">
                                    <button type="button" data-tp="proposal" class="koordinat btn btn-primary btn-block">Proposal</button>
                                </div>
                            </div>
                            <div id="maps"></div>
        
                            <div class="table-responsive">
                                <table class="table datatable-pagination" id="tabel-detail" width="100%">
                                    <thead>
                                        <tr>
                                            <th width="" id="DT_RowIndex_table">No</th>
                                            <th width="" id="trx_proposal_id_table">trx_proposal_id_table</th>
                                            <th width="" id="judul_proposal_table">Judul Kegiatan</th>
                                            <th width="" id="ruang_lingkup_table">ruang_lingkup_table</th>
                                            <th width="" id="ruang_lingkup_nm_table">Ruang Lingkup</th>
                                            <th width="" id="nominal_table">Nilai Bantuan</th>
                                            <th width="" id="trx_mitra_kemaslahatan_id_table">trx_mitra_kemaslahatan_id_table</th>
                                            <th width="" id="mitra_kemaslahatan_nm_table">Mitra Kemaslahatan</th>
                                            <th width="" id="trx_mitra_strategis_id_table">trx_mitra_strategis_id_table</th>
                                            <th width="" id="mitra_strategis_nm_table">Mitra Strategis</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    @break
                @default
                    <style>
                        #maps { height: 500px; };
                    </style>
        
                    <div class="card">
                        <div class="card-header header-elements-sm-inline">
                            <center><h4 class="card-title">Sebaran Penerima Manfaat</h4></center>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">Tahun <span class="text-danger">*</span></label>    
                                        <select name="trx_year_param" id="trx_year_param" class="form-control form-control-select2 select-search" data-fouc>
                                            @for ($i = 2022 ; $i <= date('Y') ; $i++)
                                            <option value="<?= $i ?>"><?= $i ?></option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">Mitra Kemaslahatan <span class="text-danger">*</span></label>    
                                        <select name="mitra_kemaslahatan_param" id="mitra_kemaslahatan_param" data-placeholder="Pilih Data" class="trx_mitra_kemaslahatan_id form-control form-control-select2" required data-fouc>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">Mitra Strategis <span class="text-danger">*</span></label>    
                                        <select name="mitra_strategis_param" id="mitra_strategis_param" data-placeholder="Pilih Data" class="trx_mitra_strategis_id form-control form-control-select2" required data-fouc>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">Propinsi</label>
                                        <select name="region_prop_param" id="region_prop_param" data-placeholder="Pilih Data" class="form-control form-control-select2 check-kuota" data-fouc>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible"></label>    
                                        <button type="button" id="filter-dashboard" class="btn btn-primary btn-block">Filter</button>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <button type="button" data-tp="pemohon" class="koordinat btn btn-primary btn-block">Pemohon</button>
                                </div>
                                <div class="col-md-6">
                                    <button type="button" data-tp="proposal" class="koordinat btn btn-primary btn-block">Proposal</button>
                                </div>
                            </div>
                            <div id="maps"></div>
        
                            <div class="table-responsive">
                                <table class="table datatable-pagination" id="tabel-detail" width="100%">
                                    <thead>
                                        <tr>
                                            <th width="" id="DT_RowIndex_table">No</th>
                                            <th width="" id="trx_proposal_id_table">trx_proposal_id_table</th>
                                            <th width="" id="judul_proposal_table">Judul Kegiatan</th>
                                            <th width="" id="ruang_lingkup_table">ruang_lingkup_table</th>
                                            <th width="" id="ruang_lingkup_nm_table">Ruang Lingkup</th>
                                            <th width="" id="nominal_table">Nilai Bantuan</th>
                                            <th width="" id="trx_mitra_kemaslahatan_id_table">trx_mitra_kemaslahatan_id_table</th>
                                            <th width="" id="mitra_kemaslahatan_nm_table">Mitra Kemaslahatan</th>
                                            <th width="" id="trx_mitra_strategis_id_table">trx_mitra_strategis_id_table</th>
                                            <th width="" id="mitra_strategis_nm_table">Mitra Strategis</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
            @endswitch
        </div>          
    </div>

    @if (isRoleUser(['pemohon', 'mitra', 'regas']))
        <!-- modal input proposal -->
        <div id="modal-input-proposal" class="modal fade" data-backdrop="false">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal-title-proposal">Ajukan Online</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <div class="modal-body">
                        <form class="form-validate-jquery" id="form-input-proposal" action="#">
                            @csrf
                            <div class="row">
                                @if (isRoleUser('regas'))    
                                    <div class="col-md-6">
                                        <div class="form-group form-group-float">
                                            <label class="form-group-float-label is-visible">Pemohon <span class="text-danger">*</span></label>
                                            <select name="trx_pemohon_id" id="trx_pemohon_id" data-placeholder="Pilih Data" class="trx_pemohon_id form-control form-control-select2" required data-fouc>
                                            </select>
                                        </div>
                                    </div>
                                @else
                                <div class="col-md-6">
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">Nama Pemohon <span class="text-danger">*</span></label>
                                        <input type="text" name="pemohon_nm" class="form-control" required="" placeholder="Nama Pemohon" aria-invalid="false" required="required" readonly="readonly" value="{{ Auth::user()->user_nm }}">
                                    </div>
                                </div>
                                @endif
                                <div class="col-md-6">
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">No Handphone <span class="text-danger">*</span></label>
                                        <input type="text" name="phone" class="form-control" required="" placeholder="No Handphone" aria-invalid="false" required="required" value="{{ Auth::user()->phone }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">Judul Proposal<span class="text-danger">*</span></label>
                                        <input type="text" name="judul_proposal" class="form-control" required="" placeholder="Judul Proposal" aria-invalid="false" required="required">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">Propinsi</label>
                                        <select name="region_prop" id="region_prop" data-placeholder="Pilih Data" class="form-control form-control-select2 check-kuota" data-fouc>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">Kabupaten</label>
                                        <select name="region_kab" id="region_kab" data-placeholder="Pilih Data" class="form-control form-control-select2" data-fouc>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">Kecamatan </label>
                                        <select name="region_kec" id="region_kec" data-placeholder="Pilih Data" class="form-control form-control-select2" data-fouc>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">Kelurahan </label>
                                        <select name="region_kel" id="region_kel" data-placeholder="Pilih Data" class="form-control form-control-select2" data-fouc>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">Nominal <span class="text-danger">*</span></label>
                                        <input type="text" name="nominal" class="form-control money check-kuota" placeholder="" aria-invalid="false" required="required">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">Ruang Lingkup <span class="text-danger">*</span></label>
                                        <select name="ruang_lingkup" id="ruang_lingkup" data-placeholder="Pilih Data" class="form-control form-control-select2 check-kuota" required data-fouc>
                                            {!! comCodeOptions('RUANG_LINGKUP') !!}
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">Uraian Singkat <span class="text-danger">*</span></label>
                                        <textarea name="uraian_singkat_proposal" id="uraian_singkat_proposal" class="form-control ckeditor" required="required"></textarea>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                        
                    <div class="modal-footer" id="submit-proposal" style="display: none">
                        <button type="button" class="btn btn-primary legitRipple" id="submit-input">Kirim <i class="icon-floppy-disk ml-2"></i></button>
                        <button type="reset" class="btn btn-light legitRipple" data-dismiss="modal">Tutup <i class="icon-reload-alt ml-2"></i></button>
                    </div>
                </div>
            </div>
        </div>
        <!-- /modal input proposal-->

        <!-- modal upload proposal -->
        <div id="modal-upload-proposal" class="modal fade" data-backdrop="false">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal-title-proposal">Upload Dokumen</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <div class="modal-body">
                        <form class="form-validate-jquery" method="POST" id="form-upload" action='{{ url("/proposal-pemohon/upload") }}' enctype="multipart/form-data"  data-flag="0">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">Nama Pemohon <span class="text-danger">*</span></label>
                                        <input type="text" name="pemohon_nm" class="form-control" required="" placeholder="Judul Proposal" aria-invalid="false" required="required" readonly="readonly" value="{{ Auth::user()->user_nm }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">No Handphone <span class="text-danger">*</span></label>
                                        <input type="text" name="phone" class="form-control" placeholder="No Handphone" aria-invalid="false" required="required" value="{{ Auth::user()->phone }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">File Proposal <span class="text-danger">*</span></label>
                                        <input type="file" name="file_short_proposal" class="form-control" required="" placeholder="File Proposal" accept="application/pdf,.doc,.docx,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document"">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">File Akte Pendirian <span class="text-danger">*</span></label>
                                        <input type="file" name="file_akte_pendirian" class="form-control" required="" placeholder="File Akte Pendirian" accept="application/pdf,.doc,.docx,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document"">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">File Akte Perubahan <span class="text-danger">*</span></label>
                                        <input type="file" name="file_akte_perubahan" class="form-control" required="" placeholder="File Akte Perubahan" accept="application/pdf,.doc,.docx,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document"">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">File SK Pendirian <span class="text-danger">*</span></label>
                                        <input type="file" name="file_sk_pendirian" class="form-control" required="" placeholder="File SK Pendirian" accept="application/pdf,.doc,.docx,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document"">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">File SK Perubahan <span class="text-danger">*</span></label>
                                        <input type="file" name="file_sk_perubahan" class="form-control" required="" placeholder="File SK Perubahan" accept="application/pdf,.doc,.docx,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document"">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <button type="button" class="btn btn-info btn-block" id="template-short">Download Template Proposal <i class="icon-download ml-2"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                        
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary legitRipple" id="submit-upload">Kirim <i class="icon-floppy-disk ml-2"></i></button>
                        <button type="reset" class="btn btn-light legitRipple" data-dismiss="modal">Tutup <i class="icon-reload-alt ml-2"></i></button>
                    </div>
                </div>
            </div>
        </div>
        <!-- /modal upload proposal-->
    @endif
@endsection
@push('scripts')
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
    integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
    crossorigin=""></script>
    <script>
        var tabelData;
        var marker;
        var peta;

        $(document).ready(function() {
            @if (isRoleUser(['pemohon', 'mitra', 'regas']))
                $('#input-proposal').click(function(){
                    $('#modal-input-proposal').modal('show');
                });

                $('#submit-input').click(function(){
                    $('#form-input-proposal').submit();
                });

                //--Submit form
                $('#form-input-proposal').submit(function(e){
                    if (e.isDefaultPrevented()) {
                    //--Handle the invalid form
                    } else {
                        e.preventDefault();
                        for (instance in CKEDITOR.instances) {
                            CKEDITOR.instances[instance].updateElement();
                        }
                        
                        var record  = new FormData(this);

                        console.log(record);
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
                                    'type': 'POST',
                                    'url' : "{{ url('proposal-pemohon/input') }}",
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
                                                swal.close();
                                                window.location = "{{ url('proposal-penerima-manfaat') }}";
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

                $('#upload-proposal').click(function(){
                    $('#modal-upload-proposal').modal('show');
                });

                $('#submit-upload').click(function(){
                    $('#form-upload').submit();
                });

                $('#template-short').click(function(){
                    window.open("{{ url('storage/proposal-template/Short_Proposal.docx') }}",'_blank');
                });

                
                $('#region_prop').select2({
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

                $('#region_kab').select2({
                    placeholder : "Pilih Kota",
                    ajax : {
                        url :  "{{ url('daftar-daerah/by-root/root') }}",
                        dataType: 'json',
                        processResults: function(data){
                            return {
                                results: data
                            };
                        },
                    },
                });

                $('#region_kec').select2({
                    placeholder : "Pilih Kota",
                    ajax : {
                        url :  "{{ url('daftar-daerah/by-root/root') }}",
                        dataType: 'json',
                        processResults: function(data){
                            return {
                                results: data
                            };
                        },
                    },
                });
        
                $('#region_kel').select2({
                    placeholder : "Pilih Kota",
                    ajax : {
                        url :  "{{ url('daftar-daerah/by-root/root') }}",
                        dataType: 'json',
                        processResults: function(data){
                            return {
                                results: data
                            };
                        },
                    },
                });

                $('#region_prop').change(function () {
                    $('#region_kab').empty();
                    $('#region_kec').empty();
                    $('#region_kel').empty();
                    $('#region_kab').select2({
                        placeholder : "Pilih Kota",
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

                $('#region_kab').change(function () {
                    $('#region_kec').empty();
                    $('#region_kel').empty();
                    $('#region_kec').select2({
                        placeholder : "Pilih Kota",
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

                $('#region_kec').change(function () {
                    $('#region_kel').empty();
                    $('#region_kel').select2({
                        placeholder : "Pilih Kota",
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

                $(document).on('change keyup click', '.check-kuota',function(){ 
                    checkKuota();
                });
            @else
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

            tabelData = $('#tabel-detail').DataTable({
                language: {
                    paginate: {'next': $('html').attr('dir') == 'rtl' ? 'Next &larr;' : 'Next &rarr;', 'previous': $('html').attr('dir') == 'rtl' ? '&rarr; Prev' : '&larr; Prev'}
                },
                pagingType: "simple",
                processing	: true, 
                serverSide	: true, 
                order		: [], 
                ajax		: {
                    url: '{{ url("dashboard") }}/detail',
                    type: "POST",
                    data: function(data){
                        data._token             = $('meta[name="csrf-token"]').attr('content');
                        data.provinsi           = $('select[name=region_prop_param]').val();
                        data.tahun              = $('select[name=trx_year_param]').val();
                        data.mitra_kemaslahatan = $('select[name=mitra_kemaslahatan_param]').val();
                        data.mitra_strategis    = $('select[name=mitra_strategis_param]').val();
                    },
                },
                dom : 'tpi',
                columns: [
                    { data: 'DT_RowIndex', name:'DT_RowIndex', visible:true},
                    { data: 'trx_proposal_id', name: 'trx_proposal_id', defaultContent: "-", visible:false },
                    { data: 'judul_proposal', name: 'judul_proposal', visible:true },
                    { data: 'ruang_lingkup', name: 'ruang_lingkup', defaultContent: "-", visible:false },
                    { data: 'ruang_lingkup_nm', name: 'ruang_lingkup_nm', visible:true },
                    { data: 'nominal', name: 'nominal', visible:true, render: $.fn.dataTable.render.number( '.', ',', 2, 'Rp ' )},
                    { data: 'trx_mitra_kemaslahatan_id', name: 'trx_mitra_kemaslahatan_id', defaultContent: "-", visible:false },
                    { data: 'mitra_kemaslahatan_nm', name: 'mitra_kemaslahatan_nm', visible:true },
                    { data: 'trx_mitra_strategis_id', name: 'trx_mitra_strategis_id', defaultContent: "-", visible:false },
                    { data: 'mitra_strategis_nm', name: 'mitra_strategis_nm', visible:true },
                ],
            });

            $('#filter-dashboard').click(function(){
                tabelData.ajax.reload();
            });

            $('#region_prop_param').select2({
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

            @endif

            $('.koordinat').click(function(){
                if ($(this).data('tp') == 'pemohon') {
                    getPemohon();
                }else{
                    getProposal();
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

            $('.trx_pemohon_id').select2({
                placeholder : "Pilih Pemohon",
                ajax : {
                    url :  "{{ url('dropdown-data/pemohon') }}",
                    dataType: 'json',
                    processResults: function(data){
                        return {
                            results: data
                        };
                    },
                },
            });

            $('.trx_mitra_strategis_id').select2({
                placeholder : "Pilih Mitra Strategis",
                ajax : {
                    url :  "{{ url('dropdown-data/mitra-strategis') }}",
                    dataType: 'json',
                    processResults: function(data){
                        return {
                            results: data
                        };
                    },
                },
            });

            getPemohon();
        });

        function getPemohon() {
            var url      ='{{ url("get-pemohon") }}'+'';

            $.getJSON( url, function(data){
                if (data['status'] == 'ok') {
                    peta.removeLayer(marker);
                    $.each(data['data'], function (index, data) {
                        if (data.pemohon_latitude && data.pemohon_longitude) {
                            console.log(data);
                            marker = L.marker([data.pemohon_latitude, data.pemohon_longitude]).addTo(peta).bindPopup("<div><h4>"+data.pemohon_nm+"</h4><br>"+data.address+"</div>").openPopup();
                        }
                    });
                }
            });
        }

        function getProposal() {
            var url      ='{{ url("get-proposal") }}'+'';

            $.getJSON( url, function(data){
                if (data['status'] == 'ok') {
                    peta.removeLayer(marker);
                    $.each(data['data'], function (index, data) {
                        if (data.proposal_latitude && data.proposal_longitude) {
                            console.log(data);
                            marker = L.marker([data.proposal_latitude, data.proposal_longitude]).addTo(peta).bindPopup("<div><h4>"+data.judul_proposal+"</h4><br>"+data.address+"</div>").openPopup();
                        }
                    });
                }
            });
        }

        function checkKuota() {
            if($('select[name=ruang_lingkup]').val() && $('select[name=region_prop]').val() && $('input[name=nominal]').val()){
                var url      ='{{ url("proposal-pemohon/check-kuota") }}'+'';
                var data = {
                    'region_prop'   : $('select[name=region_prop]').val(),
                    'ruang_lingkup' : $('select[name=ruang_lingkup]').val(),
                    'nominal'       : $('input[name=nominal]').val(),
                };

                $.post( url, data ,function( result ) {
                    if(result.status == 'ok'){
                        $('#submit-proposal').show();
                    }else{
                        swal({
                            title: result.msg,
                            type: "error",
                            showCancelButton: false,
                            showConfirmButton: false,
                            timer: 3000
                        });

                        $('#submit-proposal').hide();
                    }
                });
            }
        }


    </script>
@endpush
