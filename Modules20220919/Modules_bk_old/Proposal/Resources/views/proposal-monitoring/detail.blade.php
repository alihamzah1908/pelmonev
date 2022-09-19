@extends('layouts.app')

@section('content')
<div class="card">
	<div class="card-header header-elements-inline">
		<h5 class="card-title">{{ $title }}</h5>
		<div class="header-elements">
			<div class="list-icons">
				
			</div>
		</div>
	</div>
	<div class="card-body">	
        <ul class="nav nav-tabs nav-tabs-solid nav-justified rounded border-0">
            <li class="nav-item"><a href="#tab-monitoring-ringkasan" class="nav-link rounded-left active" data-toggle="tab"><i class="d-block mb-1 mt-1"></i>Ringkasan {{ $proposal->judul_proposal }}</a></li>
            <li class="nav-item"><a href="#tab-monitoring-monitoring" class="nav-link rounded-left" data-toggle="tab"><i class="d-block mb-1 mt-1"></i>Monitoring {{ $proposal->judul_proposal }}</a></li>
            <li class="nav-item"><a href="#tab-booking-monitoring" class="nav-link rounded-left" data-toggle="tab"><i class="d-block mb-1 mt-1"></i>Booking Monitoring {{ $proposal->judul_proposal }}</a></li>
        </ul>
        
        <div class="tab-content">
            <div class="tab-pane fade show active" id="tab-monitoring-ringkasan">
                <form class="form-validate-jquery form-proposal" id="form-proposal" action="#">
                    @csrf  
                    <div class="form-group row">
                        <label class="col-form-label col-lg-2">Dana yang Disetujui</label>
                        <div class="col-lg-10">
                            <input name="ringkasan_dana_disetujui" type="text" class="form-control money">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-2">Total Realisasi</label>
                        <div class="col-lg-10">
                            <input name="ringkasan_dana_realisasi" type="text" class="form-control money">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-2">Sisa Dana</label>
                        <div class="col-lg-10">
                            <input name="ringkasan_dana_sisa" type="text" class="form-control money">
                        </div>
                    </div>
                    <legend class="text-uppercase font-size-sm font-weight-bold">Biodata Proyek</legend>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-2">Status</label>
                        <div class="col-lg-10">
                            <input name="ringkasan_status" type="text" class="form-control" value="{{ $proposal->proses_nm }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-2">Mitra</label>
                        <div class="col-lg-10">
                            <input name="ringkasan_mitra_kemaslahatan_nm" type="text" class="form-control" value="{{ $proposal->mitra_kemaslahatan_nm }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-2">Jenis Kegiatan</label>
                        <div class="col-lg-10">
                            <input name="ringkasan_jenis_kegiatan" type="text" class="form-control" value="{{ $proposal->judul_proposal }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-2">Daerah</label>
                        <div class="col-lg-10">
                            <input name="ringkasan_daerah" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-2">Koordinat Lokasi</label>
                        <div class="col-lg-10">
                            <input name="ringkasan_koordinat" type="text" class="form-control"value="{{ $proposal->proposal_latitude." , ".$proposal->proposal_longitude }}">
                        </div>
                    </div>
                    <legend class="text-uppercase font-size-sm font-weight-bold">Deskripsi Proyek</legend>
                    <div class="form-group row">
                        <div class="col-lg-12">
                            <textarea name="ringkasan_deskripsi" type="text" class="form-control ckeditor">{{ $proposal->deskripsi_singkat_proposal }}</textarea>
                        </div>
                    </div>
                    <legend class="text-uppercase font-size-sm font-weight-bold">Lampiran Proyek</legend>
                </form>
            </div>
        
            <div class="tab-pane fade show" id="tab-monitoring-monitoring">
                <legend class="text-uppercase font-size-sm font-weight-bold">Buat Laporan Monitoring</legend>
			    <button type="button" class="btn btn-primary legitRipple" id="tambah-laporan"><i class="icon-add mr-2"></i> Tambah Laporan</button>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group form-group-float">
                            <label class="form-group-float-label is-visible">Pilih Periode Monitoring <span class="text-danger">*</span></label>
                            <select name="laporan_periode_monitoring_param" id="laporan_periode_monitoring_param" data-placeholder="Pilih Data" class="form-control form-control-select2" data-fouc>
                                {!! comCodeOptions('PERIODE_MONITORING') !!}
                            </select>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table datatable-pagination" id="tabel-data-laporan-monitoring" width="100%">
                        <thead>
                            <tr>
                                <th width="0%">No</th>
                                <th width="0%" id="trx_proposal_laporan_monitoring_id_table">tanggal_pengajuan</th>
                                <th width="10%" id="jenis_kegiatan_table">Jenis Kegiatan</th>
                                <th width="10%" id="nama_kegiatan_table">Nama Kegiatan</th>
                                <th width="10%" id="metode_pelaksanaan_table">Metode Pelaksanaan</th>
                                <th width="10%" id="tanggal_monitoring_table">Tanggal</th>
                                <th width="10%" id="periode_monitoring_table">Periode</th>
                                <th width="10%" id="kesimpulan_monitoring_table">Kesimpulan</th>
                                <th width="10%" id="created_at_table">Dibuat</th>
                                <th width="10%" id="updated_at_table">Diupdate</th>
                                <th width="20%" id="actions_table">#</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                
                               
                <legend class="text-uppercase font-size-sm font-weight-bold">Laporan Pengembalian Uang</legend>
                <h6 class="mb-0 font-weight-semibold">Belum ada laporan</h6>
                <legend class="text-uppercase font-size-sm font-weight-bold">Kesimpulan</legend>
                <h6 class="mb-0 font-weight-semibold">Tambah kesimpulan setelah monitoring selesai</h6>
            </div>

            <div class="tab-pane fade show" id="tab-booking-monitoring">
                <legend class="text-uppercase font-size-sm font-weight-bold">Buat Booking Monitoring</legend>
			    <button type="button" class="btn btn-primary legitRipple" id="tambah-booking"><i class="icon-add mr-2"></i> Tambah Booking</button>
                <div class="table-responsive">
                    <table class="table datatable-pagination" id="tabel-data-booking-monitoring" width="100%">
                        <thead>
                            <tr>
                                <th width="0%">No</th>
                                <th width="0%" id="trx_proposal_laporan_monitoring_id_table">tanggal_pengajuan</th>
                                <th width="10%" id="jenis_kegiatan_table">Jenis Kegiatan</th>
                                <th width="10%" id="nama_kegiatan_table">Nama Kegiatan</th>
                                <th width="10%" id="metode_pelaksanaan_table">Metode Pelaksanaan</th>
                                <th width="10%" id="tanggal_monitoring_table">Tanggal</th>
                                <th width="10%" id="periode_monitoring_table">Periode</th>
                                <th width="10%" id="kesimpulan_monitoring_table">Kesimpulan</th>
                                <th width="10%" id="created_at_table">Dibuat</th>
                                <th width="10%" id="updated_at_table">Diupdate</th>
                                <th width="20%" id="actions_table">#</th>
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

<!-- modal laporan monitoring -->
<div id="modal-laporan-monitoring" class="modal fade" data-backdrop="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title-proposal">Laporan Monitoring</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <form class="form-validate-jquery" id="form-laporan-monitoring" method="POST" enctype="multipart/form-data"  data-flag="0">
                    @csrf
                    <input type="hidden" name="status" id="status" value="1">
                    <input type="hidden" name="trx_proposal_id" id="trx_proposal_id" value="{{ $proposal->trx_proposal_id }}">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group form-group-float">
                                <label class="form-group-float-label is-visible">Jenis Kegiatan <span class="text-danger">*</span></label>
                                <input type="text" name="laporan_jenis_kegiatan" class="form-control" placeholder="Jenis Kegiatan" aria-invalid="false" required="required" value="{{ $proposal->judul_proposal }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group form-group-float">
                                <label class="form-group-float-label is-visible">Nama Kegiatan <span class="text-danger">*</span></label>
                                <input type="text" name="laporan_nama_kegiatan" class="form-control" placeholder="Nama Kegiatan" aria-invalid="false" required="required" value="{{ $proposal->judul_proposal }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group form-group-float">
                                <label class="form-group-float-label is-visible">Metode Pelaksanaan <span class="text-danger">*</span></label>
                                <select name="laporan_metode_pelaksanaan" id="laporan_metode_pelaksanaan" data-placeholder="Pilih Data" class="form-control form-control-select2" data-fouc>
                                    {!! comCodeOptions('METODE_PELAKSANAAN') !!}
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group form-group-float">
                                <label class="form-group-float-label is-visible">Tanggal Monitoring <span class="text-danger">*</span></label>
                                <input type="text" name="laporan_tanggal_monitoring" class="form-control date-picker" placeholder="Tanggal Monitoring" aria-invalid="false" required="required" value="{{ date('d/m/Y') }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group form-group-float">
                                <label class="form-group-float-label is-visible">Periode Monitoring <span class="text-danger">*</span></label>
                                <select name="laporan_periode_monitoring" id="laporan_periode_monitoring" data-placeholder="Pilih Data" class="form-control form-control-select2" data-fouc>
                                    {!! comCodeOptions('PERIODE_MONITORING') !!}
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group form-group-float">
                                <label class="form-group-float-label is-visible">Bukti Foto Monitoring <span class="text-danger">*</span></label>
                                <input type="file" name="laporan_bukti_foto_monitoring[]" class="form-control file-input-image" placeholder="" multiple="multiple" data-show-upload="false" required="required" accept="image/png, image/jpeg, image/jpg">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group form-group-float">
                                <label class="form-group-float-label is-visible">Kesimpulan Hasil Monitoring <span class="text-danger">*</span></label>
                                <div class="form-group">
                                    {{-- <div class="border p-3 rounded"> --}}
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" class="custom-control-input" name="laporan_kesimpulan_monitoring" id="laporan_kesimpulan_monitoring_sesuai" value="sesuai" checked="">
                                            <label class="custom-control-label" for="laporan_kesimpulan_monitoring_sesuai">
                                                Progress kegiatan kemaslahatan sesuai dengan persetujuan dari BPKH dan dapat dilanjutkan ke tahap selanjutnya
                                            </label>
                                        </div>

                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" class="custom-control-input" name="laporan_kesimpulan_monitoring" id="laporan_kesimpulan_monitoring_belum_sesuai"  value="belum_sesuai">
                                            <label class="custom-control-label" for="laporan_kesimpulan_monitoring_belum_sesuai">
                                                Progress kegiatan kemaslahatan belum sesuai dengan persetujuan dari BPKH dan tidak dapat dilanjutkan ke tahap selanjutnya
                                            </label>
                                        </div>

                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" class="custom-control-input" name="laporan_kesimpulan_monitoring" id="laporan_kesimpulan_monitoring_perbaikan"  value="perbaikan">
                                            <label class="custom-control-label" for="laporan_kesimpulan_monitoring_perbaikan">
                                                Progress kegiatan kemaslahatan belum sesuai dengan persetujuan dari BPKH dan masih dapat dilanjutkan ke tahap selanjutnya dengan melakukan perbaikan sesuai rekomendasi yang dijelaskan pada Tabel Analisa Pelaksanaan Kegiatan diatas untuk ditindaklanjuti oleh Mitra
                                            </label>
                                        </div>
                                    {{-- </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            
            <div class="modal-footer">
                <button type="reset" class="btn btn-light legitRipple" data-dismiss="modal">Tutup <i class="icon-reload-alt ml-2"></i></button>
                <button type="button" class="btn btn-primary submit-laporan-monitoring">Simpan <i class="icon-floppy-disk ml-2"></i></button>
            </div>
        </div>
    </div>
</div>
<!-- /modal laporan monitoring-->


<!-- modal booking monitoring -->
<div id="modal-booking-monitoring" class="modal fade" data-backdrop="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title-proposal">Booking Monitoring</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <form class="form-validate-jquery" id="form-booking-monitoring" method="POST" enctype="multipart/form-data"  data-flag="0">
                    @csrf
                    <input type="hidden" name="status" id="status" value="2">
                    <input type="hidden" name="trx_proposal_id" id="trx_proposal_id" value="{{ $proposal->trx_proposal_id }}">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group form-group-float">
                                <label class="form-group-float-label is-visible">Nama Kegiatan <span class="text-danger">*</span></label>
                                <input type="text" name="laporan_nama_kegiatan" class="form-control" placeholder="Nama Kegiatan" aria-invalid="false" required="required" value="{{ $proposal->judul_proposal }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group form-group-float">
                                <label class="form-group-float-label is-visible">Tanggal Sebelum <span class="text-danger">*</span></label>
                                <input type="text" name="laporan_tanggal_monitoring_sebelum" class="form-control date-picker" placeholder="Tanggal Monitoring" aria-invalid="false" required="required">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-group-float">
                                <label class="form-group-float-label is-visible">Tanggal Sesudah <span class="text-danger">*</span></label>
                                <input type="text" name="laporan_tanggal_monitoring_sesudah" class="form-control date-picker" placeholder="Tanggal Monitoring" aria-invalid="false" required="required">
                            </div>
                        </div>
                    </div>

                </form>
            </div>
            
            <div class="modal-footer">
                <button type="reset" class="btn btn-light legitRipple" data-dismiss="modal">Tutup <i class="icon-reload-alt ml-2"></i></button>
                <button type="button" class="btn btn-primary submit-booking-monitoring">Simpan <i class="icon-floppy-disk ml-2"></i></button>
            </div>
        </div>
    </div>
</div>
<!-- /modal laporan monitoring-->

@endsection

@push('scripts')

<script>
    var tabelDataLaporanMonitoring;
    var tabelDataBookingMonitoring;

    var saveMethod = 'ubah';
    var baseUrl = '{{ url("proposal-monitoring") }}';
    var dataCd = '{{ $proposal->trx_proposal_id }}';
	
    $(document).ready(function(){

        tabelDataLaporanMonitoring = $('#tabel-data-laporan-monitoring').DataTable({
            language: {
                paginate: {'next': $('html').attr('dir') == 'rtl' ? 'Next &larr;' : 'Next &rarr;', 'previous': $('html').attr('dir') == 'rtl' ? '&rarr; Prev' : '&larr; Prev'}
            },
            pagingType: "simple",
            processing	: true, 
            serverSide	: true, 
            order		: [], 
            ajax		: {
                url: baseUrl + '/proposal-laporan-monitoring/data',
                type: "POST",
                data: function(data){
                    data._token = $('meta[name="csrf-token"]').attr('content');
                    data.id     = '{{ $proposal->trx_proposal_id }}';
                    data.periode = $('#laporan_periode_monitoring_param').val();
                    data.status = 1;
                },
            },
            dom : 'tpi',
            columns: [
                { data: 'DT_RowIndex', name:'DT_RowIndex', visible:true, orderable: false},
                { data: 'trx_proposal_laporan_monitoring_id', name : 'trx_proposal_laporan_monitoring_id', visible:false, defaultContent:'-'},
                { data: 'jenis_kegiatan', name : 'jenis_kegiatan', visible:true, defaultContent:'-'},
                { data: 'nama_kegiatan', name : 'nama_kegiatan', visible:true, defaultContent:'-'},
                { data: 'metode_pelaksanaan', name : 'metode_pelaksanaan', visible:true, defaultContent:'-'},
                { data: 'tanggal_monitoring', name : 'tanggal_monitoring', visible:true, defaultContent:'-'},
                { data: 'periode_monitoring', name : 'periode_monitoring', visible:true, defaultContent:'-'},
                { data: 'kesimpulan_monitoring', name : 'kesimpulan_monitoring', visible:true, defaultContent:'-'},
                { data: 'created_at', name : 'created_at', visible:true, defaultContent:'-'},
                { data: 'updated_at', name : 'updated_at', visible:true, defaultContent:'-'},
                { data: 'actions', name: 'actions', visible:true }
            ],
        });

        $('#laporan_periode_monitoring_param').change(function(){
            tabelDataLaporanMonitoring.ajax.reload();
        });

        tabelDataBookingMonitoring = $('#tabel-data-booking-monitoring').DataTable({
            language: {
                paginate: {'next': $('html').attr('dir') == 'rtl' ? 'Next &larr;' : 'Next &rarr;', 'previous': $('html').attr('dir') == 'rtl' ? '&rarr; Prev' : '&larr; Prev'}
            },
            pagingType: "simple",
            processing	: true, 
            serverSide	: true, 
            order		: [], 
            ajax		: {
                url: baseUrl + '/proposal-laporan-monitoring/data',
                type: "POST",
                data: function(data){
                    data._token = $('meta[name="csrf-token"]').attr('content');
                    data.id     = '{{ $proposal->trx_proposal_id }}';
                    data.periode = $('#laporan_periode_monitoring_param').val();
                    data.status = '2';
                },
            },
            dom : 'tpi',
            columns: [
                { data: 'DT_RowIndex', name:'DT_RowIndex', visible:true, orderable: false},
                { data: 'trx_proposal_laporan_monitoring_id', name : 'trx_proposal_laporan_monitoring_id', visible:false, defaultContent:'-'},
                { data: 'jenis_kegiatan', name : 'jenis_kegiatan', visible:false, defaultContent:'-'},
                { data: 'nama_kegiatan', name : 'nama_kegiatan', visible:true, defaultContent:'-'},
                { data: 'metode_pelaksanaan', name : 'metode_pelaksanaan', visible:false, defaultContent:'-'},
                { data: 'tanggal_monitoring', name : 'tanggal_monitoring', visible:true, defaultContent:'-'},
                { data: 'periode_monitoring', name : 'periode_monitoring', visible:false, defaultContent:'-'},
                { data: 'kesimpulan_monitoring', name : 'kesimpulan_monitoring', visible:false, defaultContent:'-'},
                { data: 'created_at', name : 'created_at', visible:false, defaultContent:'-'},
                { data: 'updated_at', name : 'updated_at', visible:false, defaultContent:'-'},
                { data: 'actions', name: 'actions', visible:true }
            ],
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

        $('#tambah-laporan').click(function(){
            $('#modal-laporan-monitoring').modal('show');
        });

        $('.submit-laporan-monitoring').click(function(){
            $('#form-laporan-monitoring').submit();
        });

        $('#tambah-booking').click(function(){
            $('#modal-booking-monitoring').modal('show');
        });

        $('.submit-booking-monitoring').click(function(){
            $('#form-booking-monitoring').submit();
        });

        $('#form-laporan-monitoring').submit(function(e){
            if (e.isDefaultPrevented()) {
			//--Handle the invalid form
            } else {
				e.preventDefault();
                for (instance in CKEDITOR.instances) {
                    CKEDITOR.instances[instance].updateElement();
                }

                var record  = new FormData(this);

                swal({
                    title               : 'Simpan Laporan Monitoring ?',
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
                            'url' : "{{ url('proposal-monitoring/proposal-laporan-monitoring') }}",
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
            }
        });

        $('#form-booking-monitoring').submit(function(e){
            if (e.isDefaultPrevented()) {
			//--Handle the invalid form
            } else {
				e.preventDefault();
                for (instance in CKEDITOR.instances) {
                    CKEDITOR.instances[instance].updateElement();
                }
                
                var record  = new FormData(this);

                swal({
                    title               : 'Simpan Booking Monitoring ?',
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
                            'url' : "{{ url('proposal-monitoring/proposal-laporan-monitoring') }}",
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

        $('input[name=ringkasan_dana_disetujui]').val("{{ (int)$proposal->nominal }}").trigger('input');  
        $('input[name=ringkasan_dana_realisasi]').val("{{ (int)$proposal->nominal }}").trigger('input');  
        $('input[name=ringkasan_dana_sisa]').val("{{ (int)$proposal->nominal }}").trigger('input');
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

        // tabelPersiapan.ajax.reload();
        // tabelDonasi.ajax.reload();
        // tabelKerjasama2.ajax.reload();
        // tabelPj.ajax.reload();
        // tabelOutcome.ajax.reload();
        // tabelPengalaman.ajax.reload();
    }
</script>
@endpush