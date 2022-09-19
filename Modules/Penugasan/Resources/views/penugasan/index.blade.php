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
		<!--Frame Tabel-->
		<div id="frame-tabel">
			{{-- <button type="button" class="btn btn-primary legitRipple" id="tambah"><i class="icon-add mr-2"></i> Tambah</button> --}}
			{{-- <button type="button" class="btn btn-info legitRipple" id="detail"><i class="icon-enlarge mr-2"></i> Detail Proposal</button> --}}
			{{-- <button type="button" class="btn btn-danger legitRipple" id="hapus"><i class="icon-trash mr-2"></i> Hapus</button> --}}
			<div class="row mt-2">
				<div class="col-md-8">
					<div class="form-group form-group-float">
                        <label class="form-group-float-label is-visible">Judul Proposal <span class="text-danger">*</span></label>
						<input name="search_param" id="search_param" placeholder="Pencarian Judul" class="form-control param" data-fouc />
					</div>
				</div>
                <div class="col-md-4">
					<div class="form-group form-group-float">
                        <label class="form-group-float-label is-visible">Status Proposal <span class="text-danger">*</span></label>
                        <select name="proses_st_param" id="proses_st_param" data-placeholder="Pilih Data" class="form-control form-control-select2 param" required data-fouc>
                            <option value="SEMUA">==Tampilkan Semua ==</option>
                            {!! listStatus() !!}
                        </select>
					</div>
				</div>
			</div>
			<div class="table-responsive">
				<table class="table datatable-pagination" id="tabel-data" width="100%">
					<thead>
						<tr>
							<th width="0%">No</th>
							<th width="10%">Kode Proposal</th>
							<th width="0%" id="trx_pemohon_id_table">Pemohon</th>
							<th width="10%" id="pemohon_nm_table">Pemohon</th>
							<th width="30%" id="judul_proposal_table">Judul Proposal</th>
                            <th width="10%" id="nominal_table">Nominal</th>
                            <th width="0%" id="ruang_lingkup_table">Ruang Lingkup</th>
                            <th width="10%" id="ruang_lingkup_nm_table">Ruang Lingkup</th>
                            <th width="10%" id="ruang_lingkup_nm_table">Status</th>
                            <th width="10%" id="date_picker">Rencana Penyelesaian Penugasan</th>
                            <th width="0%" id="order_column_table">Order Column</th>
                            <th width="30%" id="actions_table">#</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>
		</div>
		<!--Frame Form-->
		<div id="frame-form">
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
		</div>
	</div>
</div>

<!-- modal upload proposal -->
<div id="modal-files" class="modal fade" data-backdrop="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title-proposal">File Proposal</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
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

<!-- Modal Terima -->
<div class="modal fade" id="terimaProposalModal" tabindex="-1" role="dialog" aria-labelledby="terimaProposalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="terimaProposalLabel">Terima Proposal</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="custom-control custom-radio">
            <input type="radio" id="customRadio1" name="customRadio" class="custom-control-input">
            <label class="custom-control-label" for="customRadio1">Terima Sepenuhnya</label>
        </div>
        <div class="custom-control custom-radio">
            <input type="radio" id="customRadio2" name="customRadio" class="custom-control-input">
            <label class="custom-control-label" for="customRadio2">Terima dengan Revisi Tanggal</label>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Submit</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Tolak -->
<div class="modal fade" id="tolakProposalModal" tabindex="-1" role="dialog" aria-labelledby="tolakProposalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tolakProposalLabel">Tolak Proposal</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <select class="custom-select">
            <option selected>-- Pilih Alasan Penolakan --</option>
            <option value="1">Alasan 1</option>
            <option value="2">Alasan 2</option>
            <option value="3">Lainnya</option>
        </select>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Submit</button>
      </div>
    </div>
  </div>
</div>


@endsection
@push('scripts')
<script>
    var tabelData;
    var tabelFiles;
    var saveMethod = 'tambah';
    var baseUrl = '{{ url("proposal-penilaian") }}';
	
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
                url: baseUrl + '/data',
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
                { data: 'trx_pemohon_id', name: 'trx_pemohon_id', defaultContent: "-", visible:false },
                { data: 'pemohon_nm', name: 'pemohon_nm', visible:true },
                { data: 'judul_proposal', name: 'judul_proposal', visible:true },
                { data: 'nominal', name: 'nominal', visible:true, render: $.fn.dataTable.render.number( '.', ',', 2, 'Rp ' )},
                { data: 'ruang_lingkup', name: 'ruang_lingkup', defaultContent: "-", visible:false },
                { data: 'ruang_lingkup_nm', name: 'ruang_lingkup_nm', visible:false },
                { data: 'proses_st_nm', name: 'proses_st_nm', visible:true },
                { data: 'order_column', name: 'order_column', visible:false },
                { data: 'date_picker', name: 'date_picker', visible:false },
                { data: 'actions', name: 'actions', visible:true }
            ],
        });

        $(document).on('keyup change', '.param',function(){ 
            tabelData.ajax.reload();
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
                            url : baseUrl + '/' + dataCd,
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
            window.location = "{{ url('proposal-penilaian') }}/"+dataCd;
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
</script>
@endpush