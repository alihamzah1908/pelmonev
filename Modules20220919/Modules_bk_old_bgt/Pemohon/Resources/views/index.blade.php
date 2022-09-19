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
			{{-- <button type="button" class="btn btn-primary legitRipple" id="tambah"><i class="icon-add mr-2"></i> Tambah</button> --}}
			{{-- <button type="button" class="btn btn-warning legitRipple" id="ubah"><i class="icon-pencil mr-2"></i> Ubah</button> --}}
			{{-- <button type="button" class="btn btn-danger legitRipple" id="hapus"><i class="icon-trash mr-2"></i> Hapus</button> --}}
			<div class="row">
				<div class="col-md-12">
					<div class="form-group form-group-float">
						<input name="search_param" id="search_param" placeholder="Pencarian Nama" class="form-control" data-fouc />
					</div>
				</div>
			</div>
			<div class="table-responsive">
				<table class="table datatable-pagination" id="tabel-data" width="100%">
					<thead>
						<tr>
							<th width="5%">NO</th>
							<th width="0%">Kode Pemohon</th>
							<th width="75%" id="pemohon_nm_table">Nama Pemohon</th>
							<th width="10%" id="actions_table"></th>
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
                    <div class="col-md-4">
                        <div class="form-group form-group-float">
                            <label class="form-group-float-label is-visible">Nama <span class="text-danger">*</span></label>
                            <input type="text" name="pemohon_nm" class="form-control" required="" placeholder="Nama Pemohon" aria-invalid="false">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group form-group-float">
                            <label class="form-group-float-label is-visible">No Telepon 1</label>
                            <input type="text" name="phone1" class="form-control" placeholder="" aria-invalid="false">
                        </div>
                        <div class="form-group form-group-float">
                            <label class="form-group-float-label is-visible">No Telepon 2 </label>
                            <input type="text" name="phone2" class="form-control" placeholder="" aria-invalid="false">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group form-group-float">
                            <label class="form-group-float-label is-visible">Propinsi</label>
                            <select name="region_prop" id="region_prop" data-placeholder="Pilih Data" class="form-control form-control-select2" data-fouc>
                            </select>
                        </div>
                        <div class="form-group form-group-float">
                            <label class="form-group-float-label is-visible">Kabupaten</label>
                            <select name="region_kab" id="region_kab" data-placeholder="Pilih Data" class="form-control form-control-select2" data-fouc>
                            </select>
                        </div>
                        <div class="form-group form-group-float">
                            <label class="form-group-float-label is-visible">Kecamatan </label>
                            <select name="region_kec" id="region_kec" data-placeholder="Pilih Data" class="form-control form-control-select2" data-fouc>
                            </select>
                        </div>
                        <div class="form-group form-group-float">
                            <label class="form-group-float-label is-visible">Kelurahan </label>
                            <select name="region_kel" id="region_kel" data-placeholder="Pilih Data" class="form-control form-control-select2" data-fouc>
                            </select>
                        </div>
                        <div class="form-group form-group-float">
                            <label class="form-group-float-label is-visible">Alamat <span class="text-danger">*</span></label>
                            <textarea name="address" id="address" class="form-control" required></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 form-group form-group-feedback form-group-feedback-left">
                        <input type="text" id="name" name="name" class="form-control" placeholder="{{ __('User ID') }}" required="" placeholder="" aria-invalid="false" />
                        <div class="form-control-feedback">
                            <i class="ml-3 icon-user text-muted"></i>
                        </div>
                    </div>
                    <div class="col-md-6 form-group form-group-feedback form-group-feedback-left">
                        <input type="email" id="email" name="email" class="form-control" placeholder="{{ __('Email') }}" required="" placeholder="" aria-invalid="false" />
                        <div class="form-control-feedback">
                            <i class="ml-3 icon-envelope text-muted"></i>
                        </div>
                    </div>
                    <div class="col-md-6 form-group form-group-feedback form-group-feedback-left">
                        <input type="password" id="password" name="password" class="form-control" placeholder="{{ __('Password') }}" required="" placeholder="" aria-invalid="false" />
                        <div class="form-control-feedback">
                            <i class="ml-3 icon-key text-muted"></i>
                        </div>
                    </div>
                    <div class="col-md-6 form-group form-group-feedback form-group-feedback-left">
                        <input type="password" id="password-confirm" name="password_confirmation" class="form-control" placeholder="{{ __('Konfirmasi Password') }}" required="" placeholder="" aria-invalid="false" />
                        <div class="form-control-feedback">
                            <i class="ml-3 icon-key text-muted"></i>
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
    var baseUrl = '{{ url("pemohon") }}';
	
    $(document).ready(function(){
        $('#frame-form').hide();  

        tabelData = $('#tabel-data').DataTable({
            language: {
                paginate: {'next': $('html').attr('dir') == 'rtl' ? 'Next &larr;' : 'Next &rarr;', 'previous': $('html').attr('dir') == 'rtl' ? '&rarr; Prev' : '&larr; Prev'}
            },
            pagingType: "simple",
            processing	: true, 
            serverSide	: true, 
            order		: [], 
            ajax		: {
                url: baseUrl + '/data',
                type: "POST",
                data: function (data){
                    data._token = $('meta[name="csrf-token"]').attr('content');
                    data.nama   = $('input[name="search_param"]').val();
                },
            },
            dom : 'tpi',
            columns: [
                { data: 'DT_RowIndex', name:'DT_RowIndex', visible:true},
                { data: 'trx_pemohon_id', name: 'trx_pemohon_id', visible:false },
                { data: 'pemohon_nm', name: 'pemohon_nm' },
                { data: 'actions', name: 'actions', orderable : false, searchable: false }
            ],
        });

        $(document).on('keyup', '#search_param',function(){ 
            tabelData.ajax.reload();
        });

        $('#reload-table').click(function(){
			$('input[name=search_param]').val('').trigger('keyup');

			tabelData.ajax.reload();
		});

        //--Tambah data
        $('#tambah').click(function()   {
			saveMethod  = 'tambah';

            $('input[name=pemohon_nm]').focus();
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
            $('.card-title').text('Data Pemohon');
			$('input[name=trx_pemohon_id]').val(rowData['trx_pemohon_id']).prop('readonly',false);
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
                var url     = '{{ url("/data/pemohon/") }}';
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

        //  -- detail data
        $(document).on('click', '.detail',function(){
            var rowData = tabelData.row($(this).parents('tr')).data();
            dataCd      = rowData.trx_pemohon_id;
            window.location = "{{ url('pemohon') }}/"+dataCd;
        });
    });

    function reset(type) {
        saveMethod  = '';
        dataCd = null;
        rowData = null;
        tabelData.ajax.reload();
        
        $('#frame-tabel').show();      
        $('#frame-form').hide(); 
        $('input[name=trx_pemohon_id]').val('').prop('readonly',false);
        $('input[name=pemohon_nm]').val('');
        $('.card-title').text('Data Pemohon');       
    }
</script>
@endpush