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
                url: baseUrl + '/data/history',
                type: "POST",
                data: function(data){
                    data._token     = $('meta[name="csrf-token"]').attr('content');
                    data.judul      = $('input[name=search_param]').val();
                    data.proses     = $('select[name=proses_st_param]').val();
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

        $('#reload-table').click(function(){
			$('input[name=search_param]').val('').trigger('keyup');

			tabelData.ajax.reload();
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
    });
</script>
@endpush