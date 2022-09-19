@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-header">
            <h6 class="card-title">
                <a class="text-default" data-toggle="collapse" href="#accordion-penilaian-aspek-resiko">Penilaian Aspek Hukum dan Legalitas</a>
            </h6>
        </div>

        <div class="card-body">
            <form class="form-validate-jquery" id="form-verif" action="#">
                @csrf
                <input type="hidden" name="id" value="{{ $proposal->trx_proposal_id }}">

                <div class="table-responsive">
                    <table class="table datatable-pagination" id="tabel-data" width="100%">
                        <thead  style="text-align: center">
                            <tr>
                                <th width="10%" rowspan="2">N0</th>
                                <th width="40%" rowspan="2">LINGKUP PENGUJIAN</th>
                                <th width="20%" colspan="2">PEMENUHAN</th>
                                <th width="30%" rowspan="2">PENJELASAN</th>
                            </tr>
                            <tr>
                                <th width="10%">YA</th>
                                <th width="10%">TIDAK</th>
                            </tr>
                        </thead>
                        <tbody style="vertical-align: top">
                            <tr>
                                <td>1.</td>
                                <td>
                                    Kriteria Kegiatan: <br>
                                    Kegiatan	kemaslahatan	masuk	dalam kategori yang ditentukan: <br>
                                    -	Pelayanan Ibadah Haji <br>
                                    -	Pendidikan dan Dakwah <br>
                                    -	Kesehatan <br>
                                    -	Sosial Keagamaan <br>
                                    -	Ekonomi umat <br>
                                    -	Sarana dan Prasarana Ibadah
                                </td>
                                <td>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" class="custom-control-input" name="verif_1_value" id="verif_1_ya" value="1" checked="">
                                        <label class="custom-control-label" for="verif_1_ya">Ya</label>
                                    </div>        
                                </td>
                                <td>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" class="custom-control-input" name="verif_1_value" id="verif_1_tidak"  value="0">
                                        <label class="custom-control-label" for="verif_1_tidak">Tidak</label>
                                    </div>
                                </td>
                                <td>
                                    <textarea name="verif_1_note" id="verif_1_note" class="form-control" placeholder="Penjelasan"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>2.</td>
                                <td>
                                    Kriteria Mitra Kemaslahatan memenuhi salah satu bentuk badan hukum/lembaga:<br>
                                    -	Badan/Lembaga Amil Zakat/Wakaf yang terakreditasi di Kemenag minimal B;
                                </td>
                                <td>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" class="custom-control-input" name="verif_2_value" id="verif_2_ya" value="2" checked="">
                                        <label class="custom-control-label" for="verif_2_ya">Ya</label>
                                    </div>        
                                </td>
                                <td>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" class="custom-control-input" name="verif_2_value" id="verif_2_tidak"  value="0">
                                        <label class="custom-control-label" for="verif_2_tidak">Tidak</label>
                                    </div>
                                </td>
                                <td>
                                    <textarea name="verif_2_note" id="verif_2_note" class="form-control" placeholder="Penjelasan"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td rowspan="3">3.</td>
                                <td>
                                    Syarat Administrasi Umum <br>
                                    a. Surat permohonan dan proposal yang di tanda-tangani oleh pejabat berwenang;
                                </td>
                                <td>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" class="custom-control-input" name="verif_3a_value" id="verif_3a_ya" value="3" checked="">
                                        <label class="custom-control-label" for="verif_3a_ya">Ya</label>
                                    </div>        
                                </td>
                                <td>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" class="custom-control-input" name="verif_3a_value" id="verif_3a_tidak"  value="0">
                                        <label class="custom-control-label" for="verif_3a_tidak">Tidak</label>
                                    </div>
                                </td>
                                <td>
                                    <textarea name="verif_3a_note" id="verif_3a_note" class="form-control" placeholder="Penjelasan"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    b. Surat pernyataan keabsahan dokumen; dan/atau
                                </td>
                                <td>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" class="custom-control-input" name="verif_3b_value" id="verif_3b_ya" value="3b" checked="">
                                        <label class="custom-control-label" for="verif_3b_ya">Ya</label>
                                    </div>        
                                </td>
                                <td>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" class="custom-control-input" name="verif_3b_value" id="verif_3b_tidak"  value="0">
                                        <label class="custom-control-label" for="verif_3b_tidak">Tidak</label>
                                    </div>
                                </td>
                                <td>
                                    <textarea name="verif_3b_note" id="verif_3b_note" class="form-control" placeholder="Penjelasan"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    c. Pakta integritas, sesuai format standar.
                                </td>
                                <td>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" class="custom-control-input" name="verif_3c_value" id="verif_3c_ya" value="3c" checked="">
                                        <label class="custom-control-label" for="verif_3c_ya">Ya</label>
                                    </div>        
                                </td>
                                <td>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" class="custom-control-input" name="verif_3c_value" id="verif_3c_tidak"  value="0">
                                        <label class="custom-control-label" for="verif_3c_tidak">Tidak</label>
                                    </div>
                                </td>
                                <td>
                                    <textarea name="verif_3c_note" id="verif_3c_note" class="form-control" placeholder="Penjelasan"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td rowspan="4">4.</td>
                                <td>
                                    Khusus Kegiatan yang Bersifat Pembangunan Fisik (pembangunan/ renovasi ruang kelas/asrama):
                                </td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>
                                    -	Rencana Anggaran Biaya (RAB)
                                </td>
                                <td>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" class="custom-control-input" name="verif_4a_value" id="verif_4a_ya" value="4a" checked="">
                                        <label class="custom-control-label" for="verif_4a_ya">Ya</label>
                                    </div>        
                                </td>
                                <td>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" class="custom-control-input" name="verif_4a_value" id="verif_4a_tidak"  value="0">
                                        <label class="custom-control-label" for="verif_4a_tidak">Tidak</label>
                                    </div>
                                </td>
                                <td>
                                    <textarea name="verif_4a_note" id="verif_4a_note" class="form-control" placeholder="Penjelasan"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    -	Gambar rencana desain
                                </td>
                                <td>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" class="custom-control-input" name="verif_4b_value" id="verif_4b_ya" value="4b" checked="">
                                        <label class="custom-control-label" for="verif_4b_ya">Ya</label>
                                    </div>        
                                </td>
                                <td>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" class="custom-control-input" name="verif_4b_value" id="verif_4b_tidak"  value="0">
                                        <label class="custom-control-label" for="verif_4b_tidak">Tidak</label>
                                    </div>
                                </td>
                                <td>
                                    <textarea name="verif_4b_note" id="verif_4b_note" class="form-control" placeholder="Penjelasan"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    -	Foto obyek/lokasi rencana kegiatan
                                </td>
                                <td>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" class="custom-control-input" name="verif_4c_value" id="verif_4c_ya" value="4c" checked="">
                                        <label class="custom-control-label" for="verif_4c_ya">Ya</label>
                                    </div>        
                                </td>
                                <td>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" class="custom-control-input" name="verif_4c_value" id="verif_4c_tidak"  value="0">
                                        <label class="custom-control-label" for="verif_4c_tidak">Tidak</label>
                                    </div>
                                </td>
                                <td>
                                    <textarea name="verif_4c_note" id="verif_4c_note" class="form-control" placeholder="Penjelasan"></textarea>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                @if (isRoleUser('bidhk'))    
                <div class="d-flex justify-content-end align-items-center">
                    <button type="submit" class="btn btn-primary legitRipple">Simpan <i class="icon-floppy-disk ml-2"></i></button>
                </div>
                @endif
            </form>
            <br>

            <form class="form-validate-jquery" id="form-data" action="#">
                @csrf
                <input type="hidden" name="id" value="{{ $proposal->trx_proposal_id }}">
                <h3>ANALISA</h3><br>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group form-group-float">
                            <label class="form-group-float-label is-visible">A.	Status Legalitas Pengusul Proposal <span class="text-danger">*</span></label>
                            <textarea name="analisa_legalitas" id="analisa_legalitas" class="form-control ckeditor" required="required">{{ $analisisHk ? $analisisHk->analisa_legalitas : '' }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group form-group-float">
                            <label class="form-group-float-label is-visible">B.	Analisa Peraturan <span class="text-danger">*</span></label>
                            <textarea name="analisa_peraturan" id="analisa_peraturan" class="form-control ckeditor" required="required">{{ $analisisHk ? $analisisHk->analisa_peraturan : '' }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group form-group-float">
                            <label class="form-group-float-label is-visible">C.	Analisa Hukum  <span class="text-danger">*</span></label>
                            <textarea name="analisa_hukum" id="analisa_hukum" class="form-control ckeditor" required="required">{{ $analisisHk ? $analisisHk->analisa_hukum : '' }}</textarea>
                        </div>
                    </div>
                    <hr>
                    <h3>KESIMPULAN DAN REKOMENDASI</h3><br>
                    <div class="col-md-12">
                        <div class="form-group form-group-float">
                            <label class="form-group-float-label is-visible">1.	Berdasarkan hasil verifikasi dan analisa di atas maka disimpulkan sebagai berikut: <span class="text-danger">*</span></label>
                            <textarea name="kesimpulan" id="kesimpulan" class="form-control ckeditor" required="required">{{ $analisisHk ? $analisisHk->kesimpulan : '' }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group form-group-float">
                            <label class="form-group-float-label is-visible">2.	Berdasarkan hasil verifikasi dan analisa di atas maka kami memberi rekomendasi sebagai berikut: <span class="text-danger">*</span></label>
                            <textarea name="rekomendasi" id="rekomendasi" class="form-control ckeditor" required="required">{{ $analisisHk ? $analisisHk->rekomendasi : '' }}</textarea>
                        </div>
                    </div>
                </div>
                @if (isRoleUser('bidhk'))    
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
    var baseUrl = '{{ url("proposal-analisis-hk") }}';
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

        //--Submit form
        $('#form-verif').submit(function(e){
            if (e.isDefaultPrevented()) {
			//--Handle the invalid form
            } else {
				e.preventDefault();
                var record  = $('#form-verif').serialize();
                var url     = baseUrl;
                var method  = 'POST';

                var record = {
                    0 : { 
                        'verif_id' : 'verif_1', 
                        'verif_value' : $('input[name=verif_1_value]:checked').val(), 
                        'verif_note' : $('textarea[name=verif_1_note]').val()
                    },
                    1 : { 
                        'verif_id' : 'verif_2', 
                        'verif_value' : $('input[name=verif_2_value]:checked').val(), 
                        'verif_note' : $('textarea[name=verif_2_note]').val()
                    },
                    2 : { 
                        'verif_id' : 'verif_3a', 
                        'verif_value' : $('input[name=verif_3a_value]:checked').val(), 
                        'verif_note' : $('textarea[name=verif_3a_note]').val()
                    },
                    3 : { 
                        'verif_id' : 'verif_3b', 
                        'verif_value' : $('input[name=verif_3b_value]:checked').val(), 
                        'verif_note' : $('textarea[name=verif_3b_note]').val()
                    },
                    4 : { 
                        'verif_id' : 'verif_3c', 
                        'verif_value' : $('input[name=verif_3c_value]:checked').val(), 
                        'verif_note' : $('textarea[name=verif_3c_note]').val()
                    },
                    5 : { 
                        'verif_id' : 'verif_4a', 
                        'verif_value' : $('input[name=verif_4a_value]:checked').val(), 
                        'verif_note' : $('textarea[name=verif_4a_note]').val()
                    },
                    6 : { 
                        'verif_id' : 'verif_4b', 
                        'verif_value' : $('input[name=verif_4b_value]:checked').val(), 
                        'verif_note' : $('textarea[name=verif_4b_note]').val()
                    },
                    7 : { 
                        'verif_id' : 'verif_4c', 
                        'verif_value' : $('input[name=verif_4c_value]:checked').val(), 
                        'verif_note' : $('textarea[name=verif_4c_note]').val()
                    }
                };
                
                console.log(record);

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
                            'url' : url + '/verif',
                            'data': {'id' : '{{ $proposal->trx_proposal_id }}', 'record' : record},
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

        @foreach($analisisHkVerif as $item)
        $('input[name={{ $item->verif_id }}_value][value={{ $item->verif_value }}]').prop('checked', true);
        $('textarea[name={{ $item->verif_id }}_note]').text("{{ $item->verif_note }}]")
        @endforeach
    });
   
</script>
@endpush