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
							<th width="5%">No</th>
							<th width="0%">ID</th>
							<th width="5%" id="trx_year_table">Tahun</th>
							<th width="0%" id="kuota_cd_table">kuota_cd</th>
							<th width="15%" id="kuota_nm_table">Propinsi</th>
							<th width="15%" id="kuota_table">Kuota</th>
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
                    <div class="col-md-6">
                        <div class="form-group form-group-float">
                            <label class="form-group-float-label is-visible">Tahun <span class="text-danger">*</span></label>
                            <input type="text" name="trx_year" class="form-control" readonly placeholder="Tahun" aria-invalid="false">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-group-float">
                            <label class="form-group-float-label is-visible">Propinsi</label>
                            <input type="text" name="kuota_nm" class="form-control" readonly placeholder="" aria-invalid="false">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group form-group-float">
                            <label class="form-group-float-label is-visible">Kuota <span class="text-danger">*</span></label>
                            <input type="text" name="kuota" class="form-control money" required placeholder="Tahun" aria-invalid="false">
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
    var baseUrl = '{{ url("kuota/wilayah") }}';
	
    $(document).ready(function(){
        $('#frame-form').hide();  

        tabelData = $('#tabel-data').DataTable({
            language: {
                paginate: {'next': $('html').attr('dir') == 'rtl' ? 'Next &larr;' : 'Next &rarr;', 'previous': $('html').attr('dir') == 'rtl' ? '&rarr; Prev' : '&larr; Prev'}
            },
            pagingType: "simple",
            processing	: true, 
            serverSide	: true, 
            order		: [[3, 'asc']], 
            ajax		: {
                url: baseUrl + '/data',
				//url: "{{ url('data/pemohon/data') }}",
                type: "POST",
                data: function (data){
                    data._token = $('meta[name="csrf-token"]').attr('content');
                    data.nama   = $('input[name="search_param"]').val();
                    data.tahun  = $('select[name="trx_year_param"]').val();
                },
            },
            dom : 'tpi',
            columns: [
                { data: 'DT_RowIndex', name:'DT_RowIndex', visible:true},
                { data: 'trx_kuota_proposal_id', name: 'trx_kuota_proposal_id', visible:false },
                { data: 'trx_year', name: 'trx_year' },
                { data: 'kuota_cd', name: 'kuota_cd', visible:false  },
                { data: 'kuota_nm', name: 'kuota_nm' },
                { data: 'kuota', name: 'kuota', render: $.fn.dataTable.render.number( '.', ',', 2, 'Rp ' ) },
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
                var url     = baseUrl + '/' + dataCd;
                var method  = 'PUT';

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
        $(document).on('click', '.ubah',function(){
            var rowData = tabelData.row($(this).parents('tr')).data();
            dataCd      = rowData.trx_kuota_proposal_id;
            console.log(rowData);

            $('input[name=kuota]').val(rowData.kuota).trigger('input');
            $('input[name=kuota_nm]').val(rowData.kuota_nm);
            $('input[name=trx_year]').val(rowData.trx_year);

            $('#frame-tabel').hide();      
            $('#frame-form').show(); 
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