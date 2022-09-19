@extends('layouts.app')

@section('content')
<div class="card">
	<div class="card-header header-elements-inline">
		<h5 class="card-title">{{ $title }}</h5>
		<div class="header-elements">
			<div class="list-icons">
				<a class="list-icons-item" data-action="reload" id="reload-table"></a>
			</div>
		</div>
	</div>
	<div class="card-body">
		<!--Frame Tabel-->
		<div id="frame-tabel">
			<button type="button" class="btn btn-primary legitRipple" id="tambah"><i class="icon-add mr-2"></i> Tambah</button>
			<!--
			<button type="button" class="btn btn-warning legitRipple" id="ubah"><i class="icon-pencil mr-2"></i> Ubah</button>
			<button type="button" class="btn btn-danger legitRipple" id="hapus"><i class="icon-trash mr-2"></i> Hapus</button>
			-->
			@if ($rootnm != '')
			<button type="button" class="btn bg-teal-600" id="back" onclick="window.history.back();"><i class="icon-reload-alt mr-2"></i> Kembali</button>
			<button type="button" class="btn bg-teal-600" id="home" onclick="window.location='/data/region';"><i class="icon-home2 mr-2"></i> Awal</button>
			@endif
			<div class="row">
				<div class="col-md-12">
					<div class="form-group form-group-float">
						<input name="search_param" id="search_param" placeholder="Pencarian" class="form-control" data-fouc />
					</div>
				</div>
			</div>
			<div class="table-responsive">
				<table class="table datatable-pagination" id="tabel-data" width="100%">
					<thead>
						@if ($rootnm != '')
						<tr>
							<th colspan="3"><h5>{{ $parent }} {{ $rootnm }}</h5></th>
						</tr>
						@endif
						<tr>
							<th id="region_cd_table">Kode {{ $region }}</th>
							<th id="region_nm_table">Nama {{ $region }}</th>
							<th class="text-center" width="30%"></th>
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
					@if ($rootnm != '')
					<div class="col-md-12">
						<div class="form-group form-group-float">
							<label class="form-group-float-label is-visible">{{ $parent }} {{ $rootnm }}</label>
							<input type="text" name="region_root" class="form-control text-uppercase" required="" placeholder="" aria-invalid="false" value="{{ $rootcd }}" readonly="readonly">
						</div>
					</div>
					@endif
					<div class="col-md-4">
						<div class="form-group form-group-float">
							<label class="form-group-float-label is-visible">Kode <span class="text-danger">*</span></label>
							<input type="text" name="region_cd" class="form-control text-uppercase" required="" placeholder="" aria-invalid="false">
						</div>
					</div>
					<div class="col-md-8">
						<div class="form-group form-group-float">
							<label class="form-group-float-label is-visible">Nama <span class="text-danger">*</span></label>
							<input type="text" name="region_nm" class="form-control" required="" placeholder="" aria-invalid="false">
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
@endsection
@push('scripts')
<script>
    var tabelData;
    var saveMethod = 'tambah';
    var baseUrl = '{{ url("data/region/") }}';
	
	var dataCd;
	var trxUrl;
	var rootcd = '{{ $rootcd }}';
	
	$(document).ready(function(){
        $('#frame-form').hide();
		
		if (rootcd == '') {
			trxUrl = baseUrl + '/data';
		} else {
			trxUrl = baseUrl + '/root';
		}

        tabelData = $('#tabel-data').DataTable({
            language: {
                paginate: {'next': $('html').attr('dir') == 'rtl' ? 'Next &larr;' : 'Next &rarr;', 'previous': $('html').attr('dir') == 'rtl' ? '&rarr; Prev' : '&larr; Prev'}
            },
            pagingType: "simple",
            processing	: true, 
            serverSide	: true, 
            order		: [], 
            ajax		: {
                //url: baseUrl + '/data',
				url: trxUrl,
				type: "POST",
				data: {
                    '_token': $('meta[name="csrf-token"]').attr('content'),
					'rootcd' : "{{ $rootcd }}",
					'level' : "{{ $level }}",
                },
            },
            dom : 'tpi',
            columns: [
                { data: 'region_cd', name: 'region_cd', visible:true },
                { data: 'region_nm', name: 'region_nm' },
				{ data: 'actions', name: 'actions' }
            ],
        });

        $(document).on('keyup', '#search_param',function(){ 
            //tabelData.column('#region_nm_table').search($(this).val()).draw();
			tabelData.search($(this).val()).draw();
        });
		
		$('#reload-table').click(function(){
			$('input[name=search_param]').val('').trigger('keyup');
			
			tabelData.ajax.reload();
			
			//window.location = '/data/region/';
		});

        //--Tambah data
        $('#tambah').click(function()   {
			saveMethod  = 'tambah';

            $('input[name=region_nm]').focus();
            $('#frame-tabel').hide();      
            $('#frame-form').show(); 
            $('.card-title').text('Tambah Data');       
        });

        //--Cek kode
        $('input[name=region_cd]').focusout(function(){
			var id          = $(this).val();
            var urlUpdate   = baseUrl + '/' + id;
            
            if ($(this).val() && saveMethod === 'tambah') {
                $.getJSON( urlUpdate, function(data){
                    if (data['status'] == 'ok') {
                        swal({
                            title: "Peringatan !",
                            text: "Kode sudah digunakan",
                            type: "warning",
                            showCancelButton: false,
                            showConfirmButton: false,
                            timer: 1000
                        }).then(() => {
                            $('input[name=region_cd]').val('');
                            $('input[name=region_cd]').focus();
                            swal.close();
                        });
                    }
                });
            }
        });

        //--Reset form
        $('#reset').click(function()   {
            saveMethod  = '';

            tabelData.ajax.reload();
            $('#frame-tabel').show();      
            $('#frame-form').hide(); 
            $('.card-title').text('Data Wilayah');
			$('input[name=region_cd]').val(rowData['region_cd']).prop('readonly',false);
        });
        
        //--Submit form
        $('#form-data').submit(function(e){
            if (e.isDefaultPrevented()) {
			//--Handle the invalid form
            } else {
				e.preventDefault();

                var record  = $('#form-data').serialize();
                if(saveMethod == 'tambah'){
					var url     = baseUrl;
                    var method  = 'POST';
                }else{
					var url     = baseUrl + '/' + dataCd;
                    var method  = 'PUT';
                }
					
				/* var record=$('#form-data').serialize();
                var url     = '{{ url("/data/region/") }}';
                var method  = 'POST'; */

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

        //--Ubah data
        $(document).on('click', '#ubah',function(){
			var rowData=tabelData.row($(this).parents('tr')).data();
            dataCd = rowData['region_cd'];
			
            if (dataCd == null) {
                swal({
                    title: "Pilih data !",
                    type: "warning",
                    showCancelButton: false,
                    showConfirmButton: false,
                    timer: 1000
                });
            }else{
                saveMethod  = 'ubah';
				
				$('input[name=region_cd]').val(rowData['region_cd']).prop('readonly',true);
                $('input[name=region_nm]').val(rowData['region_nm']);
				
                $('#frame-tabel').hide();      
                $('#frame-form').show(); 
            }
        });

        //--Hapus data
        $(document).on('click', '#hapus',function(){
			var rowData=tabelData.row($(this).parents('tr')).data();
            dataCd = rowData['region_cd'];
			
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
    });
	
	//--Child
	$(document).on('click', '#detail',function(){ 
		var rowData=tabelData.row($(this).parents('tr')).data();
		dataCd = rowData['region_cd'];
		
		window.location = '/data/region/root/' + dataCd;
	});

    function reset(type) {
        saveMethod  = '';
        dataCd = null;
        rowData = null;
        tabelData.ajax.reload();
        
        $('#frame-tabel').show();      
        $('#frame-form').hide(); 
        $('input[name=region_cd]').val('').prop('readonly',false);
        $('input[name=region_nm]').val('');
        $('.card-title').text('Data Wilayah');       
    }
</script>
@endpush