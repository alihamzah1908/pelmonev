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
			    <button type="button" class="btn btn-primary legitRipple mr-2" id="tambah"><i class="icon-add mr-2"></i> Tambah</button>
                <button type="button" data-toggle="modal" data-target="#uploadMutasiModal" class="btn btn-primary legitRipple"><i class="icon-upload mr-2"></i> Upload</button>
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
							<th width="0%">No</th>
							<th width="0%">Mutasi ID</th>
							<th width="10%" id="debit">Debit</th>
                            <th width="10%" id="credit">Credit</th>
                            <th width="10%" id="balance">Balance</th>
                            <th width="10%" id="ref_no">Nomor Referensi</th>
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
                    <div class="col-md-12">
                        <div class="form-group form-group-float">
                            <label class="form-group-float-label is-visible">No. Referensi <span class="text-danger">*</span></label>
                            <input type="text" name="ref_no" class="form-control" required="" placeholder="No. Referensi" aria-invalid="false">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group form-group-float">
                            <label class="form-group-float-label is-visible">Post Date <span class="text-danger">*</span></label>
                            <input type="date" name="post_date" class="form-control datepicker" placeholder="" aria-invalid="false" required="required">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-group-float">
                            <label class="form-group-float-label is-visible">Post Time <span class="text-danger">*</span></label>
                            <input type="time" name="post_time" class="form-control datepicker" placeholder="" aria-invalid="false" required="required">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group form-group-float">
                            <label class="form-group-float-label is-visible">Eff Date <span class="text-danger">*</span></label>
                            <input type="date" name="eff_date" class="form-control datepicker" placeholder="" aria-invalid="false" required="required">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-group-float">
                            <label class="form-group-float-label is-visible">Eff Time <span class="text-danger">*</span></label>
                            <input type="time" name="eff_time" class="form-control datepicker" placeholder="" aria-invalid="false" required="required">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group form-group-float">
                            <label class="form-group-float-label is-visible">Debit <span class="text-danger">*</span></label>
                            <input type="text" name="debit" class="form-control money" placeholder="" aria-invalid="false" required="required">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group form-group-float">
                            <label class="form-group-float-label is-visible">Credit <span class="text-danger">*</span></label>
                            <input type="text" name="credit" class="form-control money" placeholder="" aria-invalid="false" required="required">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group form-group-float">
                            <label class="form-group-float-label is-visible">Balance <span class="text-danger">*</span></label>
                            <input type="text" name="balance" class="form-control money" placeholder="" aria-invalid="false" required="required">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group form-group-float">
                            <label class="form-group-float-label is-visible">Deskripsi <span class="text-danger"></span></label>
                            <input type="text" name="description" class="form-control" required="" placeholder="Deskripsi" aria-invalid="false">
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

<!-- Upload Modal -->
<div data-backdrop="static" data-keyboard="false" class="modal fade" id="uploadMutasiModal" tabindex="-1" aria-labelledby="uploadMutasiModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="uploadMutasiModalLabel">Upload Mutasi Rekening</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="mb-5">
            <a href="{{asset('excel_templates/import-mutasi-template.xlsx')}}" class="btn btn-primary">Download Template</a>
        </div>
        <form id='formUpload'>
            <input accept=".xls,.xlsx" type="file" id="uploadExcelMutasFileInput" style="display:none"/> 
            <div class="form-row">
                <div class="col-8">
                    <input type="text" class="form-control" id="fileNameUpload" readonly />
                </div>
                <div class="col">
                    <button type="button" id="uploadExcelMutasiBtn" class="btn btn-primary btn-block">Upload</button>
                </div>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection
@push('scripts')
<script>
    var tabelData;
    var saveMethod = 'tambah';
    var baseUrl = '{{ url("mutasi-rekening") }}';

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
                { data: 'trx_mutasi_rek_id', name: 'trx_mutasi_rek_id', visible:false },
                { data: 'debit', name: 'debit', visible:true, render: $.fn.dataTable.render.number( '.', ',', 2, 'Rp ' )},
                { data: 'credit', name: 'credit', visible:true, render: $.fn.dataTable.render.number( '.', ',', 2, 'Rp ' )},
                { data: 'balance', name: 'balance', visible:true, render: $.fn.dataTable.render.number( '.', ',', 2, 'Rp ' )},
                { data: 'ref_no', name: 'ref_no', visible:true },
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

            $('input[name=coo_desc]').focus();
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
            $('.card-title').text('Data Master COO');
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
            saveMethod = 'ubah';
            var rowData = tabelData.row($(this).parents('tr')).data();
            dataCd      = rowData.trx_mutasi_rek_id;

            $('input[name=ref_no]').val(rowData.ref_no);
            $('input[name=post_date]').val(rowData.post_date);
            $('input[name=post_time]').val(rowData.post_time);
            $('input[name=eff_date]').val(rowData.eff_date);
            $('input[name=eff_time]').val(rowData.eff_time);
            $('input[name=debit]').val(rowData.debit);
            $('input[name=credit]').val(rowData.credit);
            $('input[name=balance]').val(rowData.balance);
            $('input[name=description]').val(rowData.description);

            $('#frame-tabel').hide();
            $('#frame-form').show();
        });

        //--Hapus data
        $(document).on('click', '.hapus',function(){
            saveMethod = 'ubah';
            var rowData = tabelData.row($(this).parents('tr')).data();
            dataCd      = rowData.trx_mutasi_rek_id;
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
        });

        $('#uploadExcelMutasiBtn').click(function(){ $('#uploadExcelMutasFileInput').trigger('click'); });
        $('#uploadExcelMutasFileInput').change(function(e) {
            let fileMetaData = e.target.files[0];
            console.log("Terget File", fileMetaData.name, fileMetaData);
            $('#fileNameUpload').val(fileMetaData.name);

            let fd = new FormData();
            fd.append('mutasi_file', fileMetaData);
       
            $.ajax({
                url: baseUrl + '/upload-mutasi-rekening',
                type: 'post',
                data: fd,
                contentType: false,
                processData: false,
                success: function(response){
                    $('#formUpload').trigger('reset');

                    if(response != 0){
                        swal({
                                        title: "Upload Data berhasil",
                                        type: "success",
                                        showCancelButton: false,
                                        showConfirmButton: false,
                                        timer: 1000
                                    }).then(() => {
                                        $('#reset').click();
                                        swal.close();
                                    });
                    }
                    else{
                        swal({title: "Proses gagal",type: "error",showCancelButton: false,showConfirmButton: false,timer: 1000});
                    }
                },
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
        $('input[name=coo_id]').val('').prop('readonly',false);
        $('input[name=coo_desc]').val('');
        $('.card-title').text('Data Master COO');
    }
</script>
@endpush
