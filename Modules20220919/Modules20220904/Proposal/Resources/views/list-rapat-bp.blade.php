@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
          integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
          crossorigin=""/>
<div class="card">
	<div class="card-header header-elements-inline">
		<h5 class="card-title">{{ $title }}</h5>
		<div class="header-elements">
			<div class="list-icons">
				
			</div>
		</div>
	</div>
	<div class="card-body">
		<!--Frame Tabel-->
		<div id="frame-tabel">
			{{-- <button type="button" class="btn btn-info legitRipple" id="detail"><i class="icon-enlarge mr-2"></i> Detail Proposal</button> --}}
			{{-- <button type="button" class="btn btn-danger legitRipple" id="hapus"><i class="icon-trash mr-2"></i> Hapus</button> --}}
			<div class="row mt-2">
				<div class="col-md-6">
					<div class="form-group form-group-float">
                        <label class="form-group-float-label is-visible">Judul Proposal <span class="text-danger">*</span></label>
						<input name="search_param" id="search_param" placeholder="Pencarian Judul" class="form-control param" data-fouc />
					</div>
				</div>
                <div class="col-md-6">
					<div class="form-group form-group-float">
                        <label class="form-group-float-label is-visible">Status Proposal <span class="text-danger">*</span></label>
                        <select name="proses_st_param" id="proses_st_param" data-placeholder="Pilih Data" class="form-control form-control-select2 param" required data-fouc>
                            <option value="SEMUA">==Tampilkan Semua ==</option>
                            {!! listStatus() !!}
                        </select>
					</div>
				</div>
			</div>
            @if (isRoleUser(['pemohon']))
            <div class="d-flex justify-content-end">
                <button type="button" class="btn btn-primary legitRipple" id="input-proposal"><i class="icon-add mr-2"></i> Create</button>
            </div>
            @endif
            @if (isRoleUser(['mitra']))
            <h3>Registrasi</h3>
            @endif
			<div class="table-responsive">
				<table class="table datatable-pagination" id="tabel-data" width="100%">
					<thead>
						<tr>
							<th width="0%">No</th>
							<th width="10%">Kode Proposal</th>
                            <th width="10%">Id</th>
                            <th width="0%" id="tanggal_pengajuan_table">tanggal_pengajuan</th>
							<th width="0%" id="trx_pemohon_id_table">Pemohon</th>
							<th width="10%" id="pemohon_nm_table">Pemohon</th>
							<th width="0%" id="trx_mitra_kemaslahatan_id_table">Mitra Kemaslahatan</th>
							<th width="10%" id="mitra_kemaslahatan_nm_table">Mitra Kemaslahatan</th>
							<th width="30%" id="judul_proposal_table">Judul Proposal</th>
                            <th width="10%" id="nominal_table">Nominal</th>
                            <th width="0%" id="ruang_lingkup_table">ruang_lingkup</th>
                            <th width="10%" id="ruang_lingkup_nm_table">Ruang Lingkup</th>
                            <th width="0%" id="ruang_lingkup_nm_table">Status</th>
                            <th width="0%" id="order_column_table">order_column</th>
                            <th width="20%" id="actions_table">#</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>
		</div>
		<!--Frame Form-->
		{{-- <div id="frame-form">
			<form class="form-validate-jquery" id="form-data" action="#">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group form-group-float">
                            <label class="form-group-float-label is-visible">Judul <span class="text-danger">*</span></label>
                            <input type="text" name="judul_proposal" class="form-control" required="" placeholder="Judul Proposal" aria-invalid="false" required="required">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group form-group-float">
                            <label class="form-group-float-label is-visible">Mitra Kemaslahatan <span class="text-danger">*</span></label>
                            <select name="trx_mitra_kemaslahatan_id" id="trx_mitra_kemaslahatan_id" data-placeholder="Pilih Data" class="form-control form-control-select2" data-fouc>
                            </select>
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
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group form-group-float">
                            <label class="form-group-float-label is-visible">Uraian Singkat <span class="text-danger">*</span></label>
                            <textarea name="uraian_singkat_proposal" id="uraian_singkat_proposal" class="form-control" required="required"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group form-group-float">
                            <label class="form-group-float-label is-visible">Berkas Proposal <span class="text-danger">*</span></label>
                            <input type="file" name="proposal_file" class="form-control" placeholder="" aria-invalid="false" required="required">
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end align-items-center">
                    <button type="submit" class="btn btn-primary legitRipple">Simpan <i class="icon-floppy-disk ml-2"></i></button>
                    <button type="reset" class="btn btn-light ml-2 legitRipple" id="reset">Selesai <i class="icon-reload-alt ml-2"></i></button>
                </div>
            </form>
		</div> --}}
	</div>
</div>
@if (isRoleUser(['pemohon']))
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
                                <div class="col-md-6">
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">Nama Pemohon <span class="text-danger">*</span></label>
                                        <input type="text" name="pemohon_nm" class="form-control" required="" placeholder="Nama Pemohon" aria-invalid="false" required="required" readonly="readonly" value="{{ Auth::user()->user_nm }}">
                                    </div>
                                </div>
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
                            {{-- <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">Alamat <span class="text-danger">*</span></label>
                                        <textarea name="address" id="address" class="form-control" required></textarea>
                                    </div>
                                </div>
                            </div> --}}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">Nominal <span class="text-danger">*</span></label>
                                        <input type="text" name="nominal" class="form-control money check-kuota" placeholder="" aria-invalid="false" required="required">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">Kategori Ruang Lingkup <span class="text-danger">*</span></label>
                                        <select name="ruang_lingkup" id="ruang_lingkup" class="form-control form-control-select2" required data-fouc>
                                             <option>Non Selected</option>
                                             <option value="RUANG_LINGKUP_1">Reguler</option>
                                             <option value="RUANG_LINGKUP_2">Tanggap Darurat</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">Ruang Lingkup<span class="text-danger">*</span></label>
                                        <select name="ruang_lingkup_child" id="ruang_lingkup_child" data-placeholder="Pilih Data" class="form-control form-control-select2" required data-fouc>
                                            <option value="">Non Selected</option>
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
                        <p>Apakah anda akan mengisi Long Proposal? Jika Ya, maka akan kami arahkan untuk mengisi proposal lengkap dan jika Tidak maka akan dibantu oleh Mitra Kemaslahatan</p><br>
                        <div class="form-check form-check-inline">
                            <div class="mx-1">
                                <input class="form-check-input" onclick="document.getElementById('custom').disabled = true; document.getElementById('long-input').disabled = false;" type="radio" value="1" name="flexRadioDefault" id="radio1">
                                <label class="form-check-label" for="flexRadioDefault1">
                                Ya
                                </label>
                            </div>
                        
                            <div class="mx-1">
                                <input class="form-check-input" onclick="document.getElementById('custom').disabled = true; document.getElementById('long-input').disabled = true;"  type="radio" value="0" name="flexRadioDefault" id="radio2" checked>
                                <label class="form-check-label" for="flexRadioDefault2">
                                Tidak
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-info legitRipple" id="long-input">Lanjutkan Long Proposal <i class=" icon-file-text2 ml-2"></i></button>
                        <button type="button" class="btn btn-light legitRipple" id="draft-input">Draft <i class=" icon-attachment ml-2"></i></button>
                        <button type="button" class="btn btn-primary legitRipple" id="submit-input">Submit <i class="icon-floppy-disk ml-2"></i></button>
                        <button type="reset" class="btn btn-dark legitRipple" data-dismiss="modal">Tutup <i class="icon-reload-alt ml-2"></i></button>
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
<!-- modal upload proposal -->
<div id="modal-files" class="modal fade" data-backdrop="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title-proposal">File Proposal</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <div class="alert alert-info alert-styled-left alert-dismissible">
                    {{-- <button type="button" class="close" data-dismiss="alert"><span>×</span></button> --}}
                    <span class="font-weight-semibold">Maksimal Ukuran File 1 MB</span>
                </div>
                <div class="table-responsive">
                    <table class="table table-single-select datatable-pagination" id="tabel-files" width="100%">
                        <thead>
                            <tr>
                                <th width="0%">No</th>
                                <th width="0%">Kode</th>
                                <th width="90%" id="file_tp_nm_table">Nama File</th>
                                <th width="20%" id="file_ext_table">Ekstensi File</th>
                                <th width="10%" id="action_table">#</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
                
            <div class="modal-footer">
                <button type="reset" class="btn btn-light legitRipple" data-dismiss="modal">Tutup <i class="icon-reload-alt ml-2"></i></button>
            </div>
        </div>
    </div>
</div>
<!-- /modal upload proposal-->


<!-- modal approval proposal -->
<div id="modal-approval" class="modal fade" data-backdrop="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title-proposal">Disposisi Proposal</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <form class="form-validate-jquery" id="form-approval" action="#">
                    @csrf
                    <input type="hidden" name="approval_status" id="approval_status">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group form-group-float">
                                <label class="form-group-float-label is-visible">Catatan Disposisi <span class="text-danger">*</span></label>
                                <textarea name="approval_note" id="approval_note" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group form-group-float">
                                <label class="form-group-float-label is-visible">Berkas Assesmen <span class="text-danger">*</span></label>
                                <input type="file" name="file_asesmen" class="form-control" placeholder="Berkas Assesmen" accept="application/pdf,.doc,.docx,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document"">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="alert alert-primary alert-rounded approve-data" data-status="20" data-name="Disposisi Proposal">
                                <span class="font-weight-semibold">
                                    <center>
                                        <h4>Memenuhi Syarat</h4>
                                    </center>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="alert alert-danger alert-rounded approve-data" data-status="11" data-name="Tolak Proposal">
                                <span class="font-weight-semibold">
                                    <center>
                                        <h4>Belum Memenuhi Syarat</h4>
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
<!-- /modal upload proposal-->

<!-- modal klasifikasi -->
<div id="modal-klasifikasi" class="modal fade" data-backdrop="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title-proposal">Klasifikasi Proposal</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <form class="form-validate-jquery" method="post" id="form-klasifikasi" action='{{ url("/proposal/rapatbp/simpan/klasifikasi") }}' enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="trx_proposal_mitra_id" id="trx_proposal_mitra_id_klasifikasi">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group form-group-float">
                                <label class="form-group-float-label is-visible">Kajian Lengkap Tanpa Catatan <span class="text-danger">*</span></label>
                                <input type="radio" name="kategori_kajian" value="lengkap_tanpa_catatan" class="lengkap_tanpa_catatan">
                            </div>
                        </div>
                    </div>
		    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group form-group-float">
                                <label class="form-group-float-label is-visible">Kajian Lengkap Dengan Catatan <span class="text-danger">*</span></label>
				<input type="radio" name="kategori_kajian" class="lengkap_dengan_catatan" value="lengkap_dengan_catatan">
                            </div>
                        </div>
                    </div>
		   <div class="row" id="klasifikasi_catatan" style="display:none">
                        <div class="col-md-12">
                            <div class="form-group form-group-float">
                                <label class="form-group-float-label is-visible">Klasifikasi Catatan <span class="text-danger">*</span></label>
				<textarea name="klasifikasi_catatan" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
                
            <div class="modal-footer">
		<button type="button" class="btn btn-primary legitRipple" id="simpan-klasifikasi">Simpan</button>
		<button type="reset" class="btn btn-light legitRipple" data-dismiss="modal">Tutup <i class="icon-reload-alt ml-2"></i></button>
            </div>
        </div>
    </div>
</div>
<!-- modal klasifikasi -->
<div id="modal-proposal-edit" class="modal fade" data-backdrop="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title-proposal">Ubah Proposal</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <form class="form-validate-jquery" method="post" id="form-proposal-rbp" action='{{ url("/proposal/rapatbp/ubah/proposalrbp") }}' enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="trx_proposal_mitra_id" id="trx_proposal_mitra_id_ubah_proposal">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group form-group-float">
                                <label class="form-group-float-label is-visible">Judul Proposal <span class="text-danger">*</span></label>
                                <input type="text" name="judul_proposal_rbp" class="form-control" id="judul_proposal_rbp">
                            </div>
                        </div>
                    </div>
		    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group form-group-float">
                                <label class="form-group-float-label is-visible">Ruang Lingkup <span class="text-danger">*</span></label>
				<input type="text" name="ruang_lingkup" class="form-control" id="ruang_lingkup_rbp">
                            </div>
                        </div>
                    </div>
		   <div class="row" id="klasifikasi_catatan">
                        <div class="col-md-12">
                            <div class="form-group form-group-float">
                                <label class="form-group-float-label is-visible">Nominal <span class="text-danger">*</span></label>
				<input type="text" name="nominal" class="form-control" id="nominal_rbp">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
                
            <div class="modal-footer">
		<button type="button" class="btn btn-primary legitRipple" id="simpan-proposal-rbp">Ubah </button>
                <button type="reset" class="btn btn-light legitRipple" data-dismiss="modal">Tutup <i class="icon-reload-alt ml-2"></i></button>
            </div>
        </div>
    </div>
</div>
<!-- /modal klasifikasi -->
@endsection
@push('scripts')
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
                integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
                crossorigin=""></script>
    <script src="/js/catiline.js"></script>
    <script src="/js/shp.js"></script>
    <script src="/js/leaflet.shpfile.js"></script>
    <script src="/global_assets/shp/batas_provinsi.js"></script>
<script>
    var tabelData;
    var tabelFiles;
    var saveMethod = 'tambah';
    var baseUrl = '{{ url($baseUrl) }}';
    let peta;

	$(document).ready(function(e){
        $('#long-input').prop('disabled', 'disabled');
        $('#ruang_lingkup_child').prop('disabled', 'disabled');
        $('select[name=ruang_lingkup]').bind('change', function() {
            if ($('select[name=ruang_lingkup]').find(":selected").text().toLowerCase() == "non selected") {
                $('#ruang_lingkup_child').prop('disabled', 'disabled');
            }
            else {
                $('#ruang_lingkup_child').prop('disabled', false);
            }
        });
        $(document).ready(function() {
            $('#radio1').click(function()   {
                $('#long-input').prop('disabled', false);
                $('#submit-input').prop('disabled', 'disabled');
            });
            $('#radio2').click(function()   {
                $('#long-input').prop('disabled', 'disabled');
                $('#submit-input').prop('disabled', false);
            });
        });
        
        //     $('#modal-input-proposal').on('shown.bs.modal', function (event) {
        //         let button = $(event.relatedTarget);
                    
        //             let sendId = button.data('id');
        //             let sendJudul = button.data('judul');
        //             let sendProv = button.data('prov');
        //             let sendKab = button.data('kab');
        //             let sendKec = button.data('kec');
        //             let sendKel = button.data('kel');
        //             let sendNominal = button.data('nominal');
        //             let sendLingkup = button.data('lingkup');
        //             let sendLChild = button.data('lchild');
        //             let sendUraian = button.data('uraian');
        //             let modal = $(this);
        //             modal.find("input[name='id']").val(sendId);
        //             modal.find("input[name='judul_proposal']").val(sendJudul);
        //             modal.find("input[name='region_prop']").val(sendProv);
        //             modal.find("input[name='region_kab']").val(sendKab);
        //             modal.find("input[name='region_kec']").val(sendKec);
        //             modal.find("input[name='region_kel']").val(sendKel);
        //             modal.find("input[name='nominal']").val(sendNominal);
        //             modal.find("input[name='ruang_lingkup']").val(sendLingkup);
        //             modal.find("input[name='ruang_lingkup_child']").val(sendLChild);
        //             modal.find("textarea[name='uraian_singkat_proposal']").text(sendUraian);
        //     });
    $(document).ready(function(){
        $('#frame-form').hide();  

        tabelData = $('#tabel-data').DataTable({
            language: {
                paginate: {'next': $('html').attr('dir') == 'rtl' ? 'Next &larr;' : 'Next &rarr;', 'previous': $('html').attr('dir') == 'rtl' ? '&rarr; Prev' : '&larr; Prev'}
            },
            pagingType: "simple",
            processing	: true, 
            serverSide	: true, 
            order		: [[12,'desc']], 
            ajax		: {
                url: baseUrl + '/rapatbp/data',
                type: "POST",
                data: function(data){
                    data._token     = $('meta[name="csrf-token"]').attr('content');
                    data.judul      = $('input[name=search_param]').val();
                    data.proses     = $('select[name=proses_st_param]').val();
		    data.last_status     = 'PROSES_RBP';
                },
            },
            dom : 'tpi',
            columns: [
                { data: 'DT_RowIndex', name:'DT_RowIndex', visible:true, orderable: false},
                { data: 'trx_proposal_id', name: 'trx_proposal_id', defaultContent: "-", visible:true },
                { data: 'trx_proposal_uid', name: 'trx_proposal_uid', defaultContent: "-", visible:false },
                { data: 'tanggal_pengajuan', name: 'tanggal_pengajuan', defaultContent: "-", visible:false },
                { data: 'trx_pemohon_id', name: 'trx_pemohon_id', defaultContent: "-", visible:false },
                @if (!isRoleUser('pemohon'))
                { data: 'pemohon_nm', name: 'pemohon_nm', visible:true },
                @else
                { data: 'pemohon_nm', name: 'pemohon_nm', visible:false },
                @endif
                { data: 'trx_mitra_kemaslahatan_id', name: 'trx_mitra_kemaslahatan_id', defaultContent: "-", visible:false },
                { data: 'mitra_kemaslahatan_nm', name: 'mitra_kemaslahatan_nm', visible:true },
                { data: 'judul_proposal', name: 'judul_proposal', visible:true },
                { data: 'nominal', name: 'nominal', visible:true, render: $.fn.dataTable.render.number( '.', ',', 2, 'Rp ' )},
                { data: 'ruang_lingkup', name: 'ruang_lingkup', defaultContent: "-", visible:false },
                { data: 'ruang_lingkup_nm', name: 'ruang_lingkup_nm', visible:true },
                { data: 'proses_st_nm', name: 'proses_st_nm', visible:true },
                { data: 'order_column', name: 'order_column', visible:false },
                { data: 'actions', name: 'actions', visible:true }
            ],
        });

        $(document).on('change keyup click', '.param, .select-search, .custom-control-input',function(){ 
            tabelData.ajax.reload();
        });
        $(document).on('change keyup click', '.param, .select-search, .custom-control-input',function(){ 
            tabelDataMitra.ajax.reload();
        });

        $('#reload-table').click(function(){
			$('input[name=search_param]').val('').trigger('keyup');

			tabelData.ajax.reload();
		});

        //--Tambah data
        $('#tambah').click(function()   {
			saveMethod  = 'tambah';

            $('input[name=judul_proposal]').focus();
            $('#frame-tabel').hide();      
            $('#frame-form').show(); 
            $('.card-title').text('Tambah Data');       
        });

        //--Reset form
        $('#reset').click(function()   {
            saveMethod  = '';

            tabelData.ajax.reload();
            $('#frame-tabel').show();      
            $('#frame-form').hide(); 
            $('.card-title').text('Data Proposal');
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


        //--Hapus data
        $(document).on('click', '#hapus',function(){
            var rowData = tabelData.row($(this).parents('tr')).data();
            dataCd      = rowData.trx_proposal_uid;
            if (dataCd == null) {
                swal({
                    title: "Pilih Data!",
                    type: "warning",
                    showCancelButton: false,
                    showConfirmButton: false,
                    timer: 1000
                });
            }else{
                swal({
                    title             : "Hapus data?",
                    type              : "question",
                    showCancelButton  : true,
                    confirmButtonColor: "#00a65a",
                    confirmButtonText : "OK",
                    cancelButtonText  : "NO",
                    allowOutsideClick : false,
                }).then(function(result){
                    if(result.value){
                        swal({allowOutsideClick : false, title: "Proses hapus",onOpen: () => {swal.showLoading();}});
                        
                        $.ajax({
                            url : baseUrl + '/delete/' + dataCd,
                            type: "DELETE",
                            dataType: "JSON",
                            data: {
                                '_token': $('input[name=_token]').val(),
                            },
                            success: function(response)
                            {
                                if (response.status == 'ok') {
                                    swal({
                                        title: "Proses berhasil",
                                        type: "success",
                                        showCancelButton: false,
                                        showConfirmButton: false,
                                        timer: 1000
                                    }).then(() => {
                                        reset('')
                                        swal.close();
                                    });
                                }else{
                                    swal({title: "Proses gagal",type: "error",showCancelButton: false,showConfirmButton: false,timer: 1000});
                                }
                            },
                            error: function (jqXHR, textStatus, errorThrown)
                            {
                                swal({title: "Terjadi kesalahan sistem !", text:"Silakan hubungi Administrator", type: "error",showCancelButton: false,showConfirmButton: false,timer: 1000});
                            }
                        })
                    }else {
                        swal.close();
                    }
                });
            } 
        });

        $(document).on('click', '#disposisi',function(){
            var rowData = tabelData.row($(this).parents('tr')).data();
            var status = $(this).attr('data-status')
            dataCd      = rowData.trx_proposal_uid;
            if (dataCd == null) {
                swal({
                    title: "Pilih Data!",
                    type: "warning",
                    showCancelButton: false,
                    showConfirmButton: false,
                    timer: 1000
                });
            }else{
                swal({
                    @if (isJabatanUser(9))
                        title             : "Apakah anda akan mendisposisi proposal ke Anggota BP Kemaslahatan?",
                    @elseif (isJabatanUser(7))
                        title             : "Apakah anda akan mendisposisi proposal ke Deputi Kemaslahatan?",
                    @elseif (isJabatanUser(5))
                        title             : "Apakah anda akan mendisposisi proposal ke Kadiv Regas?",
                    @elseif (isJabatanUser(4))
                        title             : "Apakah anda akan merekomendasikan proposal ke Tim Analis?",
                    @elseif(isJabatanUser(3))
                        title : '',
                    @else
                        title             : "Disposisikan",
                    @endif
                    type              : "question",
                    showCancelButton  : true,
                    confirmButtonColor: "#00a65a",
                    confirmButtonText : "OK",
                    cancelButtonText  : "NO",
                    allowOutsideClick : false,
                }).then(function(result){
                    if(result.value){
                        swal({allowOutsideClick : false, title: "Proses Disposisi",onOpen: () => {swal.showLoading();}});
                        
                        $.ajax({
                            url : baseUrl + '/disposisi/' + dataCd,
                            type: "POST",
                            dataType: "JSON",
                            data: {
                                '_token': $('input[name=_token]').val(),
                            },
                            success: function(response)
                            {
                                if (response.status == 'ok') {
                                    swal({
                                        title: "Proses Disposisi Berhasil",
                                        type: "success",
                                        showCancelButton: false,
                                        showConfirmButton: false,
                                        timer: 1000
                                    }).then(() => {
                                        reset('')
                                        swal.close();
                                    });
                                }else{
                                    swal({title: "Proses gagal",type: "error",showCancelButton: false,showConfirmButton: false,timer: 1000});
                                }
                            },
                            error: function (jqXHR, textStatus, errorThrown)
                            {
                                swal({title: "Terjadi kesalahan sistem !", text:"Silakan hubungi Administrator", type: "error",showCancelButton: false,showConfirmButton: false,timer: 1000});
                            }
                        })
                    }else {
                        swal.close();
                    }
                });
            } 
        });

        $(document).on('click', '#rekomendasikan',function(){
            var rowData = tabelData.row($(this).parents('tr')).data();
            var status = $(this).attr('data-status')
            dataCd      = rowData.trx_proposal_uid;
            if (dataCd == null) {
                swal({
                    title: "Pilih Data!",
                    type: "warning",
                    showCancelButton: false,
                    showConfirmButton: false,
                    timer: 1000
                });
            }else{
                swal({
                    @if (isJabatanUser(9))
                        title             : "Apakah anda akan merekomendasikan proposal ke Bagian Hukum dan Kepatuhan?",
                    @elseif (isJabatanUser(7))
                        title             : "Apakah anda akan merekomendasikan proposal ke Mitra Kemaslahatan?",
                    @elseif (isJabatanUser(5))
                        title             : "Apakah anda akan merekomendasikan proposal ke Anggota BP Kemaslahatan?",
                    @elseif (isJabatanUser(4))
                        title             : "Apakah anda akan merekomendasikan proposal ke Deputi Kemaslahatan?",
                    @elseif(isJabatanUser(3))
                        title             : "Apakah anda akan merekomendasikan proposal ke Kadiv Regas?",
                    @elseif(isJabatanUser(6))
                        title             : "Apakah anda akan merekomendasikan proposal ke Kadiv Regas?",
                    @else
                        title             : "Rekomendasikan",
                    @endif
                    type              : "question",
                    showCancelButton  : true,
                    confirmButtonColor: "#00a65a",
                    confirmButtonText : "OK",
                    cancelButtonText  : "NO",
                    allowOutsideClick : false,
                }).then(function(result){
                    if(result.value){
                        swal({allowOutsideClick : false, title: "Proses Rekomendasi",onOpen: () => {swal.showLoading();}});
                        
                        $.ajax({
                            url : baseUrl + '/rekomendasi/' + dataCd,
                            type: "POST",
                            dataType: "JSON",
                            data: {
                                '_token': $('input[name=_token]').val(),
                            },
                            success: function(response)
                            {
                                if (response.status == 'ok') {
                                    swal({
                                        title: "Proses Rekomendasi Berhasil",
                                        type: "success",
                                        showCancelButton: false,
                                        showConfirmButton: false,
                                        timer: 1000
                                    }).then(() => {
                                        reset('')
                                        swal.close();
                                    });
                                }else{
                                    swal({title: "Proses gagal",type: "error",showCancelButton: false,showConfirmButton: false,timer: 1000});
                                }
                            },
                            error: function (jqXHR, textStatus, errorThrown)
                            {
                                swal({title: "Terjadi kesalahan sistem !", text:"Silakan hubungi Administrator", type: "error",showCancelButton: false,showConfirmButton: false,timer: 1000});
                            }
                        })
                    }else {
                        swal.close();
                    }
                });
            } 
        });

        $(document).on('click', '#rekomendasi-abp',function(){
            var rowData = tabelData.row($(this).parents('tr')).data();
            dataCd      = rowData.trx_proposal_uid;
            if (dataCd == null) {
                swal({
                    title: "Pilih Data!",
                    type: "warning",
                    showCancelButton: false,
                    showConfirmButton: false,
                    timer: 1000
                });
            }else{
                swal({
                    title             : "Apakah anda akan merekomendasikan proposal ke Analis Hukum?",
                    type              : "question",
                    showCancelButton  : true,
                    confirmButtonColor: "#00a65a",
                    confirmButtonText : "OK",
                    cancelButtonText  : "NO",
                    allowOutsideClick : false,
                }).then(function(result){
                    if(result.value){
                        swal({allowOutsideClick : false, title: "Proses Disposisi",onOpen: () => {swal.showLoading();}});
                        
                        $.ajax({
                            url : baseUrl + '/disposisi/' + dataCd,
                            type: "POST",
                            dataType: "JSON",
                            data: {
                                '_token': $('input[name=_token]').val(),
                                'flag_button' : 'rekomendasi'
                            },
                            success: function(response)
                            {
                                if (response.status == 'ok') {
                                    swal({
                                        title: "Proses Disposisi Berhasil",
                                        type: "success",
                                        showCancelButton: false,
                                        showConfirmButton: false,
                                        timer: 1000
                                    }).then(() => {
                                        reset('')
                                        swal.close();
                                    });
                                }else{
                                    swal({title: "Proses gagal",type: "error",showCancelButton: false,showConfirmButton: false,timer: 1000});
                                }
                            },
                            error: function (jqXHR, textStatus, errorThrown)
                            {
                                swal({title: "Terjadi kesalahan sistem !", text:"Silakan hubungi Administrator", type: "error",showCancelButton: false,showConfirmButton: false,timer: 1000});
                            }
                        })
                    }else {
                        swal.close();
                    }
                });
            } 
        });

        $(document).on('click', '#disposisi-proposal-akr',function(){
            var trx_proposal_mitra_id = $(this).attr('data-bind')
            var status = $(this).attr('data-status')
            swal({
                title             : "Apakah anda akan merekomendasikan proposal?",
                type              : "question",
                showCancelButton  : true,
                confirmButtonColor: "#00a65a",
                confirmButtonText : "OK",
                cancelButtonText  : "NO",
                allowOutsideClick : false,
            }).then(function(result){
                if(result.value){
                    swal({allowOutsideClick : false, title: "Proses Rekomendasi",onOpen: () => {swal.showLoading();}});
                    
                    $.ajax({
                        url : baseUrl + '/send-proposal-mitra/' + trx_proposal_mitra_id,
                        type: "POST",
                        dataType: "JSON",
                        data: {
                            '_token': $('input[name=_token]').val(),
                            'proses': status,
                        },
                        success: function(response)
                        {
                            if (response.status == 'ok') {
                                swal({
                                    title: "Proses Rekomendasi Berhasil",
                                    type: "success",
                                    showCancelButton: false,
                                    showConfirmButton: false,
                                    timer: 1000
                                }).then(() => {
                                    reset('')
                                    swal.close();
                                    location.reload()
                                });
                            }else{
                                swal({title: "Proses gagal",type: "error",showCancelButton: false,showConfirmButton: false,timer: 1000});
                            }
                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            swal({title: "Terjadi kesalahan sistem !", text:"Silakan hubungi Administrator", type: "error",showCancelButton: false,showConfirmButton: false,timer: 1000});
                        }
                    })
                }else {
                    swal.close();
                }
            });
        });

        $(document).on('click', '#disposisi-akr-back',function(){
            var trx_proposal_mitra_id = $(this).attr('data-bind')
            var status = $(this).attr('data-status')
            swal({
                title             : "Apakah anda akan mengembalikan proposal ke mitra?",
                type              : "question",
                showCancelButton  : true,
                confirmButtonColor: "#00a65a",
                confirmButtonText : "OK",
                cancelButtonText  : "NO",
                allowOutsideClick : false,
            }).then(function(result){
                if(result.value){
                    swal({allowOutsideClick : false, title: "Proses Kembalikan",onOpen: () => {swal.showLoading();}});
                    
                    $.ajax({
                        url : baseUrl + '/send-proposal-mitra/' + trx_proposal_mitra_id,
                        type: "POST",
                        dataType: "JSON",
                        data: {
                            '_token': $('input[name=_token]').val(),
                            'proses': 'PROSES_AMK',
                            'status': 'kembalikan'
                        },
                        success: function(response)
                        {
                            if (response.status == 'ok') {
                                swal({
                                    title: "Proses Kembalikan Berhasil",
                                    type: "success",
                                    showCancelButton: false,
                                    showConfirmButton: false,
                                    timer: 1000
                                }).then(() => {
                                    reset('')
                                    swal.close();
                                    location.reload()
                                });
                            }else{
                                swal({title: "Proses gagal",type: "error",showCancelButton: false,showConfirmButton: false,timer: 1000});
                            }
                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            swal({title: "Terjadi kesalahan sistem !", text:"Silakan hubungi Administrator", type: "error",showCancelButton: false,showConfirmButton: false,timer: 1000});
                        }
                    })
                }else {
                    swal.close();
                }
            });
        });

        $('#trx_kemaslahatan_id').select2({
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

        //--Lengkapi proposal
        $(document).on('click', '.lengkapi-proposal',function(){ 
            var rowData = tabelData.row($(this).parents('tr')).data();
            dataCd      = rowData.trx_proposal_id;
            window.location = baseUrl+"/"+dataCd;
        });

        $(document).on('click', '.approve',function(){
            var rowData = tabelData.row($(this).parents('tr')).data();
            dataCd      = rowData.trx_proposal_id;
            $('#modal-approval').modal('show');
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


        // file proposal
        tabelFiles = $('#tabel-files').DataTable({
            language: {
                paginate: {'next': $('html').attr('dir') == 'rtl' ? 'Next &larr;' : 'Next &rarr;', 'previous': $('html').attr('dir') == 'rtl' ? '&rarr; Prev' : '&larr; Prev'}
            },
            pagingType: "simple",
            processing	: true, 
            serverSide	: true, 
            order		: [[12,'desc']], 
            ajax		: {
                url: baseUrl + '/proposal-files/data',
                type: "POST",
                data: function(data){
                    data._token= $('meta[name="csrf-token"]').attr('content');
                    data.id    = dataCd;
                },
            },
            dom : 'tpi',
            columns: [
                { data: 'DT_RowIndex', name:'DT_RowIndex', visible:true, orderable: false},
                { data: 'trx_proposal_files_id', name: 'trx_proposal_files_id', visible:false },
                { data: 'file_tp_nm', name: 'file_tp_nm' },
                { data: 'file_ext', name: 'file_ext' },
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
    $(document).ready(function() {
            @if (isRoleUser(['pemohon', 'mitra']))
            $('#input-proposal').click(function(){
                $('#modal-input-proposal').modal('show');
            });

            let submitForm;
            $('#submit-input').click(function(){
                submitForm =  1;
                $('#form-input-proposal').submit();
            });

            $('#draft-input').click(function(){
                submitForm = 0;
                $('#form-input-proposal').submit();
            });

            $('#long-input').click(function(){
                submitForm =  2;
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
                    let record  = new FormData(this);
                    record.append('submit', submitForm);
                    if (submitForm == 2) {
                        swal({
                            title               : 'Lanjutkan Ke Long Proposal ?',
                            type                : "question",
                            showCancelButton    : true,
                            confirmButtonColor  : "#00a65a",
                            confirmButtonText   : "OK",
                            cancelButtonText    : "NO",
                            allowOutsideClick : false,
                        }).then(function(result){
                            if(result.value){
                                swal({allowOutsideClick : false,title: "Proses Lanjut Long Proposal",onOpen: () => {swal.showLoading();}});

                                $.ajax({
                                    'type': 'POST',
                                    'url' : "{{ url('proposal-pemohon/input') }}",
                                    'data': record,
                                    contentType: false,
                                    processData: false,
                                    'success': function(response){
                                        if(response["status"] == 'oks') {
                                            swal({
                                                title: "Lanjut Long Proposal berhasil",
                                                type: "success",
                                                showCancelButton: false,
                                                showConfirmButton: false,
                                                timer: 1000
                                            }).then(() => {
                                                swal.close();
                                                window.location.reload();
                                            });
                                        }else if(response["status"] == 'ok'){
                                            swal({
                                                title: "Lanjut Long Proposal berhasil",
                                                type: "success",
                                                showCancelButton: false,
                                                showConfirmButton: false,
                                                timer: 1000
                                            }).then(() => {
                                                swal.close();
                                                window.location = baseUrl+"/list-proposal/"+response["id"];
                                            });
                                        }
                                        else{
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
                    }else{
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
                                        if(response["status"] == 'oks') {
                                            swal({
                                                title: "Proses berhasil",
                                                type: "success",
                                                showCancelButton: false,
                                                showConfirmButton: false,
                                                timer: 1000
                                            }).then(() => {
                                                swal.close();
                                                window.location.reload();
                                            });
                                        }else if(response["status"] == 'ok'){
                                            swal({
                                                title: "Proses berhasil",
                                                type: "success",
                                                showCancelButton: false,
                                                showConfirmButton: false,
                                                timer: 1000
                                            }).then(() => {
                                                swal.close();
                                                window.location = baseUrl+"/"+response["id"];
                                            });
                                        }
                                        else{
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
            tileLayer = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
                attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                maxZoom: 18,
                minZoom: 5,
                id: 'mapbox/outdoors-v10',
                tileSize: 512,
                zoomOffset: -1,
                accessToken: '{{ env("MAP_TOKEN") }}'
            }).addTo(peta);

            // marker = L.marker(peta.getCenter()).addTo(peta);

            provInfo = L.control();
            provInfo.onAdd = function (map) {
                this._div = L.DomUtil.create('div', 'prov-info'); // create a div with a class "prov-info"
                this.update();
                return this._div;
            };

            // method that we will use to update the control based on feature properties passed
            provInfo.update = function (props) {
                let innerHTMl = 'Silakan klik pada provinsi di peta';
                if (props) {
                    briefProvInfo = '';
                    detailProvInfo = '';
                    for (const propsKey in props) {
                        if (propsKey.indexOf('Nilai Total ') < 0) {
                            briefProvInfo += '<strong>' + propsKey + '</strong>:' + props[propsKey] + '<br />';
                        }

                        if (props[propsKey].indexOf('[detail]') >= 0) {
                            let str = props[propsKey].replace('[detail]', '[ringkasan]');
                            detailProvInfo += '<strong>' + propsKey + '</strong>:' + str + '<br />';
                        } else {
                            detailProvInfo += '<strong>' + propsKey + '</strong>:' + props[propsKey] + '<br />';
                        }
                    }
                    innerHTMl = briefProvInfo;
                }
                currentInfo = 'brief';
                // console.log(briefProvInfo);
                this._div.innerHTML = innerHTMl;
            };

            provInfo.addTo(peta);

            let legend = L.control({position: 'bottomleft'});

            legend.onAdd = function (map) {
                let div = L.DomUtil.create('div', 'info legend');
                let labels = [];

                labels.push('<i style="background:#00B050; width: 50px;"></i> Sisa Alokasi >= 10%');
                labels.push('<i style="background:#FFFF00; width: 50px;"></i> Sisa Alokasi < 10%');
                labels.push('<i style="background:#FF0000; width: 50px;"></i> Sisa Alokasi = 0');
                labels.push('<i style="background:#000000; width: 50px;"></i> Sisa Alokasi < 0');

                div.innerHTML = labels.join('<br>');
                return div;
            };

            legend.addTo(peta);


            shpFile = L.geoJson(provinsiIndonesia, {
                style: provStyle,
                onEachFeature: function(feature, layer) {
                    // console.log(feature);
                    if (feature.properties) {

                        layer.bindPopup(feature.properties.Provinsi, {
                            maxHeight: 200
                        });

                        layer.on({
                            click: function (e) {
                                peta.fitBounds(e.target.getBounds());
                                // console.log(e.target.feature.properties.Provinsi);
                                currentProvinsi = e.target.feature.properties.Provinsi;
                                $.ajax({
                                    method: "POST",
                                    url: "{{ url("dashboard") }}/detail-provinsi",
                                    data: {
                                        _token: $('meta[name="csrf-token"]').attr('content'),
                                        tahun: $('select[name=trx_year_param]').val(),
                                        provinsi: e.target.feature.properties.Provinsi
                                    }
                                })
                                    .done(function( msg ) {
                                        console.log(msg);
                                        provInfo.update(msg.data);
                                        currentProvinsi = msg.kode_provinsi;
                                    });
                            }
                        });
                    }
                }
            }).addTo(peta);

            let maxBounds = shpFile.getBounds();
            peta.setMaxBounds(maxBounds);

            $('#reset-filter-dashboard').click(function () {
                console.log("reset clicked!");
                if (null !== tabelData) {
                    console.log("datatable clear!");
                    // tabelData.clear().draw();
                    // tabelData.destroy();
                    $('#tabel-detail tbody').empty();
                    // tabelData = null;
                }
                $('select[name=region_prop_param]').val('').trigger('change');
                // $('select[name=trx_year_param]').val('').trigger('change');
                $('select[name=mitra_kemaslahatan_param]').val('').trigger('change');
                $('select[name=mitra_strategis_param]').val('').trigger('change');
            });

            $('#show-details').click(function () {
                $('select[name=region_prop_param]').val(currentProvinsi).trigger('change');
                $('select[name=mitra_kemaslahatan_param]').val('').trigger('change');
                $('select[name=mitra_strategis_param]').val('').trigger('change');
                $('#filter-dashboard').trigger('click');
                // console.log($('select[name=region_prop_param]').val());
            });

            $(document).on('click', '#daftar-proposal-peta', function (e) {
                console.log('Tombol detail diklik');
                console.log(e);

                if ('brief' === currentInfo) {
                    console.log('Masuk ke brief');
                    e.target.parentElement.parentElement.innerHTML = detailProvInfo;
                    currentInfo = 'details';
                } else {
                    console.log('Masuk ke details');
                    e.target.parentElement.parentElement.innerHTML = briefProvInfo;
                    currentInfo = 'brief';
                }
            })

            $('#filter-dashboard').click(function(){
                if (null === tabelData) {
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
                                let provSelect = $('select[name=region_prop_param]');
                                data._token             = $('meta[name="csrf-token"]').attr('content');
                                data.provinsi           = (null === provSelect.val())? currentProvinsi : provSelect.val() ;
                                data.tahun              = $('select[name=trx_year_param]').val();
                                data.mitra_kemaslahatan = $('select[name=mitra_kemaslahatan_param]').val();
                                data.mitra_strategis    = $('select[name=mitra_strategis_param]').val();
                            },
                        },
                        dom : 'tpi',
                        columns: [
                            { data: 'DT_RowIndex', name:'DT_RowIndex', visible:true},
                            // { data: 'trx_proposal_id', name: 'trx_proposal_id', defaultContent: "-", visible:false },
                            { data: 'judul_proposal', name: 'judul_proposal', visible:true },
                            // { data: 'ruang_lingkup', name: 'ruang_lingkup', defaultContent: "-", visible:false },
                            { data: 'ruang_lingkup_nm', name: 'ruang_lingkup_nm', visible:true },
                            { data: 'nominal', name: 'nominal', visible:true, render: $.fn.dataTable.render.number( '.', ',', 2, 'Rp ' )},
                            // { data: 'trx_mitra_kemaslahatan_id', name: 'trx_mitra_kemaslahatan_id', defaultContent: "-", visible:false },
                            { data: 'mitra_kemaslahatan_nm', name: 'mitra_kemaslahatan_nm', visible:true },
                            // { data: 'trx_mitra_strategis_id', name: 'trx_mitra_strategis_id', defaultContent: "-", visible:false },
                            //{ data: 'mitra_strategis_nm', name: 'mitra_strategis_nm', visible:true },
                        ],
                    });
                } else {
                    tabelData.ajax.reload();
                }

            });

            @endif
        });
	
        $(document).on('click', '#izinkan-rapat',function(){
            var trx_proposal_mitra_id = $(this).attr('data-bind')
            var status = $(this).attr('data-status')
	    console.log(trx_proposal_mitra_id)
            swal({
                title             : "Apakah anda akan mengizinkan proposal?",
                type              : "question",
                showCancelButton  : true,
                confirmButtonColor: "#00a65a",
                confirmButtonText : "OK",
                cancelButtonText  : "NO",
                allowOutsideClick : false,
            }).then(function(result){
                if(result.value){
                    swal({allowOutsideClick : false, title: "Proses Izinkan",onOpen: () => {swal.showLoading();}});
                    
                    $.ajax({
                        url : baseUrl + '/send-proposal-mitra/' + trx_proposal_mitra_id,
                        type: "POST",
                        dataType: "JSON",
                        data: {
                            '_token': $('input[name=_token]').val(),
                            'proses': status,
                        },
                        success: function(response)
                        {
                            if (response.status == 'ok') {
                                swal({
                                    title: "Proses Kembalikan Berhasil",
                                    type: "success",
                                    showCancelButton: false,
                                    showConfirmButton: false,
                                    timer: 1000
                                }).then(() => {
                                    reset('')
                                    swal.close();
                                    location.reload()
                                });
                            }else{
                                swal({title: "Proses gagal",type: "error",showCancelButton: false,showConfirmButton: false,timer: 1000});
                            }
                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            swal({title: "Terjadi kesalahan sistem !", text:"Silakan hubungi Administrator", type: "error",showCancelButton: false,showConfirmButton: false,timer: 1000});
                        }
                    })
                }else {
                    swal.close();
                }
            });
        });

	$(document).on('click', '#kembalikan-rapat',function(){
            var trx_proposal_mitra_id = $(this).attr('data-bind')
            var status = $(this).attr('data-status')
	    console.log(status)
            swal({
                title             : "Apakah anda akan mengembalikan proposal?",
                type              : "question",
                showCancelButton  : true,
                confirmButtonColor: "#00a65a",
                confirmButtonText : "OK",
                cancelButtonText  : "NO",
                allowOutsideClick : false,
            }).then(function(result){
                if(result.value){
                    swal({allowOutsideClick : false, title: "Proses Kembalikan",onOpen: () => {swal.showLoading();}});
                    
                    $.ajax({
                        url : baseUrl + '/send-proposal-mitra/' + trx_proposal_mitra_id,
                        type: "POST",
                        dataType: "JSON",
                        data: {
                            '_token': $('input[name=_token]').val(),
                            'proses': status,
                            'status': 'kembalikan'
                        },
                        success: function(response)
                        {
                            if (response.status == 'ok') {
                                swal({
                                    title: "Proses Kembalikan Berhasil",
                                    type: "success",
                                    showCancelButton: false,
                                    showConfirmButton: false,
                                    timer: 1000
                                }).then(() => {
                                    reset('')
                                    swal.close();
                                    location.reload()
                                });
                            }else{
                                swal({title: "Proses gagal",type: "error",showCancelButton: false,showConfirmButton: false,timer: 1000});
                            }
                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            swal({title: "Terjadi kesalahan sistem !", text:"Silakan hubungi Administrator", type: "error",showCancelButton: false,showConfirmButton: false,timer: 1000});
                        }
                    })
                }else {
                    swal.close();
                }
            });
        });
	
	$('body').on('click','#klasifikasi', function(){
	     var id = $(this).attr('data-bind');
	     $('#trx_proposal_mitra_id_klasifikasi').val(id);
             $('#modal-klasifikasi').modal('show');
        });

	$('body').on('click','#form-proposal', function(){
	     var id = $(this).attr('data-bind');
	     $.ajax({
		url: baseUrl + '/rapat/bp/proposal',
		dataType: 'json',
		method: 'get',
		data: {
		   'trx_proposal_mitra_id': id
		},
	     }).done(function(response){
		$('#trx_proposal_mitra_id_ubah_proposal').val(id);
	     	$('#judul_proposal_rbp').val(response.judul_proposal);
	        $('#ruang_lingkup_rbp').val(response.ruang_lingkup);
	        $('#nominal_rbp').val(response.nominal)
                $('#modal-proposal-edit').modal('show');
	     })
        });

	$('body').on('click','.lengkap_dengan_catatan', function(){
             $('#klasifikasi_catatan').show();
        });

	$('body').on('click','.lengkap_tanpa_catatan', function(){
             $('#klasifikasi_catatan').hide();
        });

        $('#simpan-klasifikasi').click(function(){
             $('#form-klasifikasi').submit();
        });
	
	$('body').on('click','#simpan-proposal-rbp', function(){
             $('#form-proposal-rbp').submit();
        });

    });
</script>
@endpush