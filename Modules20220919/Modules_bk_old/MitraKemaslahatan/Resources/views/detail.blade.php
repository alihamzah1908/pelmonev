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
        <form class="form-validate-jquery" id="form-data" action="#">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group form-group-float">
                        <label class="form-group-float-label is-visible">Nama <span class="text-danger">*</span></label>
                        <input type="text" name="mitra_kemaslahatan_nm" class="form-control" value="{{ $mitra->mitra_kemaslahatan_nm }}" readonly="readonly" placeholder="Nama Pemohon" aria-invalid="false">
                    </div>
                    <div class="form-group form-group-float">
                        <label class="form-group-float-label is-visible">No Telepon</label>
                        <input type="text" name="phone" class="form-control" value="{{ $mitra->phone }}" placeholder="" aria-invalid="false" maxlength="20">
                    </div>
                    <div class="form-group form-group-float">
                        <label class="form-group-float-label is-visible">Email </label>
                        <input type="text" name="email" class="form-control" value="{{ $mitra->email }}" placeholder="" aria-invalid="false" maxlength="100">
                    </div>
                </div>
                <div class="col-md-6">
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
                        <textarea name="address" id="address" class="form-control is-textarea" required>{{ $mitra->address }}</textarea>
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
@endsection
@push('scripts')
<script>
    var tabelPengurus;
    var tabelKerjasama;
    var saveMethod = 'ubah';
    var baseUrl = '{{ url("mitra-kemaslahatan") }}';
    var dataCd = '{{ $mitra->trx_mitra_kemaslahatan_id }}';
	
    $(document).ready(function(){
        //--Submit form
        $('.form-validate-jquery').submit(function(e){
            if (e.isDefaultPrevented()) {
			//--Handle the invalid form
            } else {
				e.preventDefault();

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

        //--Ubah data
        $(document).on('click', '#reset',function(){ 
            window.location = baseUrl;
        });


        $('#region_prop').select2({
            placeholder : "Pilih Propinsi",
            @if($mitra->region_prop)
            data:[{"id": "{{ $mitra->region_prop }}" ,"text":"{{ getRegionNm($mitra->region_prop) }}" }] ,
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

        $('#region_kab').select2({
            placeholder : "Pilih Kota",
            @if($mitra->region_kab)
            data:[{"id": "{{ $mitra->region_kab }}" ,"text":"{{ getRegionNm($mitra->region_kab) }}" }] ,
            @endif
            ajax : {
                url :  "{{ url('daftar-daerah/by-root/') }}"+"/{{ $mitra->region_prop }}",
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
            @if($mitra->region_kab)
            data:[{"id": "{{ $mitra->region_kec }}" ,"text":"{{ getRegionNm($mitra->region_kec) }}" }] ,
            @endif
            ajax : {
                url :  "{{ url('daftar-daerah/by-root/') }}"+"/{{ $mitra->region_kab }}",
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
            @if($mitra->region_kab)
            data:[{"id": "{{ $mitra->region_kel }}" ,"text":"{{ getRegionNm($mitra->region_kel) }}" }] ,
            @endif
            ajax : {
                url :  "{{ url('daftar-daerah/by-root/') }}"+"/{{ $mitra->region_kec }}",
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
                @if($mitra->region_kab)
                data:[{"id": "{{ $mitra->region_kab }}" ,"text":"{{ getRegionNm($mitra->region_kab) }}" }] ,
                @endif
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
                @if($mitra->region_kec)
                data:[{"id": "{{ $mitra->region_kec }}" ,"text":"{{ getRegionNm($mitra->region_kec) }}" }] ,
                @endif
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
                @if($mitra->region_kel)
                data:[{"id": "{{ $mitra->region_kel }}" ,"text":"{{ getRegionNm($mitra->region_kel) }}" }] ,
                @endif
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
    });

</script>
@endpush