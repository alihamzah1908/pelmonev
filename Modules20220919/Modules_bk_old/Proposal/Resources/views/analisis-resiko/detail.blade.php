@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-header">
            <h6 class="card-title">
                <a class="text-default" data-toggle="collapse" href="#accordion-penilaian-aspek-resiko">Penilaian Aspek Resiko</a>
            </h6>
        </div>

        <div class="card-body">
            <form class="form-validate-jquery" id="form-data" action="#">
                @csrf
                <input type="hidden" name="id" value="{{ $proposal->trx_proposal_id }}">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group form-group-float">
                            <label class="form-group-float-label is-visible">Resiko Reputasi <span class="text-danger">*</span></label>
                            <textarea name="resiko_reputasi" id="resiko_reputasi" class="form-control ckeditor" required="required">{{ $analisisResiko ? $analisisResiko->resiko_reputasi : '' }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group form-group-float">
                            <label class="form-group-float-label is-visible">Resiko Keberlanjutan <span class="text-danger">*</span></label>
                            <textarea name="resiko_keberlanjutan" id="resiko_keberlanjutan" class="form-control ckeditor" required="required">{{ $analisisResiko ? $analisisResiko->resiko_keberlanjutan : '' }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group form-group-float">
                            <label class="form-group-float-label is-visible">Mitigasi Resiko Reputasi <span class="text-danger">*</span></label>
                            <textarea name="mitigasi_resiko_reputasi" id="mitigasi_resiko_reputasi" class="form-control ckeditor" required="required">{{ $analisisResiko ? $analisisResiko->mitigasi_resiko_reputasi : '' }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group form-group-float">
                            <label class="form-group-float-label is-visible">Mitigasi Resiko Keberlanjutan <span class="text-danger">*</span></label>
                            <textarea name="mitigasi_resiko_keberlanjutan" id="mitigasi_resiko_keberlanjutan" class="form-control ckeditor" required="required">{{ $analisisResiko ? $analisisResiko->mitigasi_resiko_keberlanjutan : '' }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group form-group-float">
                            <label class="form-group-float-label is-visible">Kesimpulan <span class="text-danger">*</span></label>
                            <textarea name="kesimpulan" id="kesimpulan" class="form-control ckeditor" required="required">{{ $analisisResiko ? $analisisResiko->kesimpulan : '' }}</textarea>
                        </div>
                    </div>
                </div>
                @if (isRoleUser('bidmr'))    
                <div class="d-flex justify-content-end align-items-center">
                    <button type="submit" class="btn btn-primary legitRipple">Simpan <i class="icon-floppy-disk ml-2"></i></button>
                    <button type="reset" class="btn btn-light ml-2 legitRipple" id="reset">Selesai <i class="icon-reload-alt ml-2"></i></button>
                </div>
                @endif
            </form>
        </div>
    </div>


@endsection
@push('scripts')
<script>
    var tabelPenilaianIu;
    var tabelPenilaianAl;


    var saveMethod = 'ubah';
    var baseUrl = '{{ url("proposal-analisis-resiko") }}';
    var dataCd = '{{ $proposal->trx_proposal_id }}';
	
    $(document).ready(function(){
        //--Submit form
        $('#form-data').submit(function(e){
            if (e.isDefaultPrevented()) {
			//--Handle the invalid form
            } else {
				e.preventDefault();
                for (instance in CKEDITOR.instances) {
                    CKEDITOR.instances[instance].updateElement();
                }
                var record  = $('#form-data').serialize();
                var url     = baseUrl;
                var method  = 'POST';
                console.log(record)
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

        $(document).on('submit', 'form',function(){
            // alert('aaa');
            // for (instance in CKEDITOR.instances) {
            //     CKEDITOR.instances[instance].updateElement();
            // }
        });
    });
   
</script>
@endpush