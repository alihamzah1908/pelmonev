@extends('layouts.app')

@section('content')
    <div class="row">
		<div class="col-xl-12">
            <div class="card" style="zoom: 1;">
                <div class="card-header header-elements-inline">
                    <h5 class="card-title">Data Negara</h5>
                </div>

                <div class="card-body">
                    <div id="bagian-tabel">
                        <button type="button" class="btn btn-primary legitRipple" id="tambah"><i class="icon-add mr-2"></i> Tambah</button>
                        <div class="row" style="margin-top:10px">
                            <div class="col-md-12">
                                <div class="form-group form-group-float">
                                    <label class="form-group-float-label is-visible">Nama Negara</label>
                                    <input name="search_param" id="search_param" placeholder="Pencarian Negara" class="form-control" data-fouc />
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table datatable-pagination" id="tabel-data">
                                <thead>
                                    <tr>
                                        <th>Kode Negara</th>
                                        <th id="nation_nm_table">Nama Negara</th>
                                        <th class="text-center" width="20%">#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div id="bagian-form">
                        <form class="form-validate-jquery" id="form-isian" action="#">
                            @csrf
                            <input type="hidden" name="nation_root" value="{{$id}}">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">Kode Negara <span class="text-danger">*</span></label>
                                        <input type="text" name="nation_cd" class="form-control" id="nation_cd" required placeholder="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">Nama Negara<span class="text-danger">*</span></label>
                                        <input type="text" name="nation_nm" class="form-control" required="" placeholder="" aria-invalid="false">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">Capital </label>
                                        <input type="text" name="capital" class="form-control" aria-invalid="false">
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end align-items-center">
                                <button type="reset" class="btn btn-light legitRipple" id="reset">Kembali <i class="icon-reload-alt ml-2"></i></button>
                                <button type="submit" class="btn btn-primary ml-3 legitRipple">Simpan <i class="icon-paperplane ml-2"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
		</div>
	</div>
@endsection
@push('scripts')
    <script>
        var tabelData;
	    var baseUrl = '{{ url("sistem/nation") }}';
        var saveMethod = 'tambah';

        $(document).ready(function(){
            //pre-usage + misc + tabel
            $('#bagian-form').hide();  

            $('#reset').click(function(){
                reset();
            });
            
            tabelData = $('#tabel-data').DataTable({
                pagingType: "simple",
                language: {
                    paginate: {'next': $('html').attr('dir') == 'rtl' ? 'Next &larr;' : 'Next &rarr;', 'previous': $('html').attr('dir') == 'rtl' ? '&rarr; Prev' : '&larr; Prev'}
                },
                processing	: true, 
                serverSide	: true, 
                order		: [], 
                ajax		: {
                    url: baseUrl + '/data',
                    type: "POST",
                    data: {
                        '_token': $('meta[name="csrf-token"]').attr('content'),
                        'root'  : '{{$id}}',
                    },
                },
                dom : 'tpi',
                columns: [
                    { data: 'nation_cd', name: 'nation_cd', visible:true },
                    { data: 'nation_nm', name: 'nation_nm' },
                    { data: 'actions', name: 'actions' },
                ]
            });

            $(document).on('keyup', '#search_param',function(){ 
                tabelData.column('#nation_nm_table').search($(this).val()).draw();
            });

            //--Tambah data
            $('#tambah').click(function()   {
                saveMethod  ='tambah';

                $('#bagian-tabel').hide();      
                $('#bagian-form').show(); 
            });

            //--Reset form
            $('#reset').click(function()   {
                reset();    
            });

            //--Ubah data
            $(document).on('click', '#ubah',function(){ 

                var rowData=tabelData.row($(this).parents('tr')).data();
                dataCd = rowData['nation_cd'];
                saveMethod = 'ubah';
                $('#tambah').hide();
                $('#kembali').show();
                $('input[name=nation_nm]').focus();
                $('input[name=nation_cd]').val(rowData['nation_cd']).prop('readonly',true);
                $('input[name=nation_nm]').val(rowData['nation_nm']);
                $('input[name=capital]').val(rowData['capital']);
                $('#bagian-tabel').hide();      
                $('#bagian-form').show(); 

            });

            //--Submit form
            $('#form-isian').submit(function(e){
                if (e.isDefaultPrevented()) {
                //--Handle the invalid form
                } else {
                    e.preventDefault();
                    var record=$('#form-isian').serialize();
                    if(saveMethod == 'tambah'){
                        var url     = baseUrl;
                        var method  = 'POST';
                    }else{
                        var url     = baseUrl+'/'+ dataCd;
                        var method  = 'PUT';
                    }

                    swal({
                        title               : "Simpan data?",
                        type                : "question",
                        showCancelButton    : true,
                        // confirmButtonColor  : "#00a65a",
                        confirmButtonText   : "YA",
                        cancelButtonText    : "TIDAK",
                        allowOutsideClick   : false,
                    }).then((result) => {
                        if(result.value){
                            swal({
                                allowOutsideClick   : false,
                                title               : "Proses Simpan",
                                didOpen             : () => {swal.showLoading();}
                            });
                            $.ajax({
                                'type': method,
                                'url' : url,
                                'data': record,
                                'dataType': 'JSON',
                                'success': function(response){
                                    if(response["status"] == 'ok') {  
                                        swal({
                                            title               : "Proses berhasil",
                                            type                : "success",
                                            showConfirmButton   : false,
                                            timer               : 1000,
                                        }).then(() => {
                                            reset();
                                            swal.close();
                                        });
                                    }else{
                                        swal({
                                            title               : "Proses Gagal",
                                            type                : "error",
                                            showConfirmButton   : false,
                                            timer               : 1000,
                                        });
                                    }
                                },
                                'error': function(response){ 
                                    var errorText = '';
                                    $.each(response.responseJSON.errors, function(key, value) {
                                        errorText += value+'<br>'
                                    });

                                    swal({
                                        //title             : response.status+':'+response.responseJSON.message,
                                        title               : response.status.toString(),
                                        type                : 'error',
                                        html                : errorText,
                                        confirmButtonText : "OK",
                                    }).then((result) => {
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
                var rowData=tabelData.row($(this).parents('tr')).data();
                dataCd = rowData['nation_cd'];
                swal({
                    title             : "Hapus Data?",
                    type              : "question",
                    showCancelButton  : true,
                    // confirmButtonColor: "#00a65a",
                    confirmButtonText : "YA",
                    cancelButtonText  : "TIDAK",
                    allowOutsideClick : false,
                }).then((result)=>{
                    if(result.value){
                        swal({
                            allowOutsideClick   : false,
                            title               : "Proses Hapus",
                            didOpen             : () => {swal.showLoading();}
                        });
                        $.ajax({
                            url: baseUrl + '/' + dataCd,
                            type: "DELETE",
                            dataType: "JSON",
                            data: {
                                '_token': $('input[name=_token]').val(),
                            },
                            success: function(response)
                            {
                                if (response.status == 'ok') {
                                    swal({
                                        title               : "Proses berhasil",
                                        type                : "success",
                                        showConfirmButton   : false,
                                        timer               : 1000,
                                    }).then(() => {
                                        reset();
                                        swal.close();
                                    });
                                }else{
                                    swal({
                                    title               : "Proses gagal",
                                    type                : "success",
                                    showConfirmButton   : false,
                                    timer               : 1000,
                                })
                                }
                            },
                            error: function (jqXHR, textStatus, errorThrown)
                            {
                                swal({
                                    title               : "Terjadi kesalahan sistem",
                                    text                : "Silahkan hubungi Administrator",
                                    type                : "error",
                                    showConfirmButton   : false,
                                    timer               : 1000,
                                });
                            }
                        })
                    } else {
                        swal.close();
                    }
                    
                });
            });
            //--Detail data
            $(document).on('click','#detail',function(){
                var rowData=tabelData.row($(this).parents('tr')).data();
                dataCd = rowData['nation_cd'];
                window.location = baseUrl + '/' + dataCd;
            })
        });
    function reset(){
        saveMethod  ='';
        $('input[name=search_param]').val('').trigger('keyup');
        $('input[name=nation_cd]').val('').prop('readonly',false).removeClass("bg-gray-100 cursor-not-allowed");
        $('input[name=nation_nm]').val('');
        $('input[name=nation_postcode]').val('');
        // $('input[name=capital]').val('');
        $('#bagian-tabel').show();      
        $('#bagian-form').hide(); 
        $('#kembali').hide();
        $('#tambah').show();
        tabelData.ajax.reload();
    }
    </script>
@endpush