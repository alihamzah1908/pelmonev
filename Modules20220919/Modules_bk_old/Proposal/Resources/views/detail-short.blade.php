@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
crossorigin=""/>

<style>
    #maps { height: 300px; };
</style>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">
                @if (isRoleUser(['pemohon']))
                    @if ($title != 'Show Proposal')
                        Edit Pengajuan Short Proposal
                    @endif
                @else
                    {{ $title }}
                @endif</h5>
                <div class="header-elements">
                    <div class="list-icons">
                        <span class='badge badge-info d-block'>{{ substr($proposal->proses_st,7,strlen($proposal->proses_st)).' - '.$proposal->proses_nm }}</span>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form class="form-validate-jquery" id="form-input-proposal" action="#">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group form-group-float">
                                <label class="form-group-float-label is-visible">Nama Pemohon <span class="text-danger">*</span></label>
                                <input type="text" name="pemohon_nm" class="form-control" required="" placeholder="Nama Pemohon" aria-invalid="false" required="required" readonly="readonly" value="{{ $pemohon->pemohon_nm }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-group-float">
                                <label class="form-group-float-label is-visible">No Handphone <span class="text-danger">*</span></label>
                                <input type="text" name="phone" class="form-control" required="" placeholder="No Handphone" aria-invalid="false" required="required" value="{{ $pemohon->phone }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group form-group-float">
                                <label class="form-group-float-label is-visible">Judul Proposal<span class="text-danger">*</span></label>
                                <input type="text" name="judul_proposal" value="{{ $proposal->judul_proposal }}" class="form-control" required="" placeholder="Judul Proposal" aria-invalid="false" required="required">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group form-group-float">
                                <label class="form-group-float-label is-visible">Propinsi</label>
                                <select name="region_prop" id="region_prop" data-placeholder="Pilih Data" class="region_prop form-control form-control-select2" data-fouc>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group form-group-float">
                                <label class="form-group-float-label is-visible">Kabupaten</label>
                                <select name="region_kab" id="region_kab" data-placeholder="Pilih Data" class="region_kab form-control form-control-select2" data-fouc>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group form-group-float">
                                <label class="form-group-float-label is-visible">Kecamatan </label>
                                <select name="region_kec" id="region_kec" data-placeholder="Pilih Data" class="region_kec form-control form-control-select2" data-fouc>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group form-group-float">
                                <label class="form-group-float-label is-visible">Kelurahan </label>
                                <select name="region_kel" id="region_kel" data-placeholder="Pilih Data" class="region_kel form-control form-control-select2" data-fouc>
                                </select>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="row">
                        <div class="col-md-12">
                            <div class="form-group form-group-float">
                                <label class="form-group-float-label is-visible">Alamat <span class="text-danger">*</span></label>
                                <textarea name="address" id="address" class="form-control" required></textarea>
                            </div>
                        </div>
                    </div> --}}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group form-group-float">
                                <label class="form-group-float-label is-visible">Nominal <span class="text-danger">*</span></label>
                                <input type="text" name="nominal" class="form-control money check-kuota" placeholder="" aria-invalid="false" required="required">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-group-float">
                                <label class="form-group-float-label is-visible">Kategori Ruang Lingkup <span class="text-danger">*</span></label>
                                <select name="ruang_lingkup" id="ruang_lingkup" class="form-control form-control-select2" required data-fouc>
                                     <option>Non Selected</option>
                                     <option value="RUANG_LINGKUP_1">Reguler</option>
                                     <option value="RUANG_LINGKUP_2">Tanggap Darurat</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-group-float">
                                <label class="form-group-float-label is-visible">Ruang Lingkup<span class="text-danger">*</span></label>
                                <select name="ruang_lingkup_child" id="ruang_lingkup_child" data-placeholder="Pilih Data" class="form-control form-control-select2" required data-fouc>
                                    <option value="">Non Selected</option>
                                    {!! comCodeOptions('RUANG_LINGKUP') !!}
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group form-group-float">
                                <label class="form-group-float-label is-visible">Uraian Singkat <span class="text-danger">*</span></label>
                                <textarea name="uraian_singkat_proposal" id="uraian_singkat_proposal" class="form-control ckeditor" required="required">{{ $proposal->uraian_singkat_proposal }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-check form-check-inline">
                        @if ($title != 'Detail Proposal')
                        <div class="mx-1">
                            <input class="form-check-input" onclick="document.getElementById('custom').disabled = true; document.getElementById('long-input').disabled = false;" type="radio" value="1" name="flexRadioDefault" id="radio1">
                            <label class="form-check-label" for="flexRadioDefault1">
                            Ya
                            </label>
                        </div>
                        <div class="mx-1">
                            <input class="form-check-input" onclick="document.getElementById('custom').disabled = true; document.getElementById('long-input').disabled = true;"  type="radio" value="0" name="flexRadioDefault" id="radio2" checked>
                            <label class="form-check-label" for="flexRadioDefault2">
                            Tidak
                            </label>
                        </div>
                        @endif
                    </div>
                    @if ($title != 'Detail Proposal')
                        <button type="button" class="btn btn-light legitRipple" id="draft-input">Draft <i class=" icon-attachment ml-2"></i></button>
                        <button type="button" class="btn btn-primary legitRipple" id="submit-input">Submit <i class="icon-floppy-disk ml-2"></i></button>
                        <button type="button" class="btn btn-info legitRipple" id="long-input">Lanjutkan Long Proposal <i class=" icon-file-text2 ml-2"></i></button>
                    @endif
                </form>
                @if (isRoleUser(['regas', 'pelmonev']) && !in_array($proposal->proses_st, ['PROSES_CPM','PROSES_KBP','PROSES_ABP','PROSES_KR','PROSES_DK']))
                            <ul class="nav nav-tabs nav-tabs-solid nav-justified rounded border-0 mt-5">
                                <li class="nav-item"><a href="#tab-data-screaning" class="nav-link rounded-left active" data-toggle="tab"><i class="icon-floppy-disk d-block mb-1 mt-1"></i>Screaning 1</a></li>
                                <li class="nav-item"><a href="#tab-data-rekomendasi" class="nav-link rounded-left" data-toggle="tab"><i class="icon-floppy-disk d-block mb-1 mt-1"></i>Rekomendasi Pejabat Berwenang</a></li>
                            </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane fade show active" id="tab-data-screaning">
                                            <form class="form-validate-jquery form-proposal" id="form-lembaga" action="#">
                                                @csrf
                                                <input type="hidden" name="trx_screaning1_id" value="{{ $lastScreaning != null ? $lastScreaning->trx_screaning1_id : ''}}">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        @php 
                                                        $mitra = \App\Models\PublicTrxMitraKemaslahatan::all();
                                                        @endphp
                                                        <div class="form-group form-group-float">
                                                            <label class="form-group-float-label is-visible">Mitra Kemaslahatan <span class="text-danger">*</span></label>
                                                            <select name="mitra_kemaslahatan" id="mitra_kemaslahatan" data-placeholder="Pilih Data" class="form-control form-control-select2" required data-fouc>
                                                            <option value="">Pilih Data</option>
                                                                @if($lastScreaning != null)
                                                                    <option value="">Pilih</option>
                                                                    @foreach($mitra as $val)
                                                                        <option value="{{ $val->trx_mitra_kemaslahatan_id }}"{{ $lastScreaning->trx_mitra_kemaslahatan_id == $val->trx_mitra_kemaslahatan_id ? ' selected': ' '}}>{{ $val->mitra_kemaslahatan_nm }}</option>
                                                                    @endforeach
                                                                @else 
                                                                    <option value="">Pilih</option>
                                                                    @foreach($mitra as $val)
                                                                        <option value="{{ $val->trx_mitra_kemaslahatan_id }}">{{ $val->mitra_kemaslahatan_nm }}</option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group form-group-float">
                                                            <label class="form-group-float-label is-visible">Target Penyelesaian <span class="text-danger">*</span></label>
                                                            <input type="date" value="{{ $lastScreaning != null ? $lastScreaning->target_penyelesaian : ''}}" name="target_penyelesaian" id="target_penyelesaian" class="form-control form-control-date">
                                                        </div>
                                                    </div>  
                                                    <div class="col-md-12">
                                                        <div class="form-group form-group-float">
                                                            <label class="form-group-float-label is-visible">Catatan <span class="text-danger">*</span></label>
                                                            <textarea name="note" id="note" class="form-control ckeditor" required="required">{{ $lastScreaning != null ? $lastScreaning->note : "" }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                               @if ($proposal->sent_st == '0')    
                                                <div class="d-flex justify-content-end align-items-center">
                                                    <button type="submit" class="btn btn-primary legitRipple">Simpan <i class="icon-floppy-disk ml-2"></i></button>
                                                    <button type="reset" class="btn btn-light ml-2 legitRipple" id="reset">Reset <i class="icon-reload-alt ml-2"></i></button>
                                                </div>
                                                @endif
                                            </form>
                                        </div>
                                        <div class="tab-pane fade show" id="tab-data-rekomendasi">
                                            <form class="form-validate-jquery form-proposal" id="form-rekomendasi" action="#">
                                                @csrf
                                                @php 
                                                $strategis = \App\Models\PublicTrxMitraStrategis::all();
                                                @endphp
                                                <div class="form-group form-group-float">
                                                    <label class="form-group-float-label is-visible">Mitra Strategis</label>    
                                                    <select name="trx_mitra_strategis_id"  data-placeholder="Pilih Data" class="trx_mitra_strategis_id form-control form-control-select2" required data-fouc>
                                                        <option value="">Pilih</option>
                                                        @foreach($strategis as $val)
                                                            <option value="{{ $val->trx_mitra_strategis_id }}">{{ $val->mitra_strategis_nm }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                @php 
                                                $pejabat = \App\Models\PublicTrxProposalPejabatRekomendasi::all();
                                                @endphp
                                                <div class="form-group form-group-float">
                                                    <label class="form-group-float-label is-visible">Nama Pejabat</label>
                                                        <select name="rekomendasi_nama" class="form-control" id="rekomendasi_pejabat">
                                                            <option value="">Pilih</option>
                                                            @foreach($pejabat as $value)
                                                                <option value="{{ $value->trx_proposal_pejabat_rekomendasi_id }}">{{ $value->nama }}</option>
                                                            @endforeach
                                                        <!-- <input type="text" name="rekomendasi_nama" id="rekomendasi_nama" class="form-control" readonly="readonly" value="{{ !empty($rekomendasiPejabat) ? $rekomendasiPejabat->nama : '' }}"> -->
                                                    </select>
                                                </div>
                                                <div class="form-group form-group-float">
                                                    <label class="form-group-float-label is-visible">Jabatan</label>
                                                    <input type="text" name="rekomendasi_jabatan" id="rekomendasi_jabatan" class="form-control" readonly="readonly" value="{{ !empty($rekomendasiPejabat) ? $rekomendasiPejabat->jabatan : '' }}">
                                                </div>
                                                <div class="form-group form-group-float">
                                                    <label class="form-group-float-label is-visible">Institusi</label>
                                                    <input type="text" name="rekomendasi_instansi" id="rekomendasi_instansi" class="form-control" readonly="readonly" value="{{ !empty($rekomendasiPejabat) ? $rekomendasiPejabat->institusi : '' }}">
                                                </div>
                                                {{-- @if ($proposal->sent_st == '0')     --}}
                                                <div class="d-flex justify-content-end align-items-center">
                                                    <button type="submit" class="btn btn-primary legitRipple">Simpan <i class="icon-floppy-disk ml-2"></i></button>
                                                    <button type="reset" class="btn btn-light ml-2 legitRipple" id="reset">Selesai <i class="icon-reload-alt ml-2"></i></button>
                                                </div>
                                                {{-- @endif --}}
                                            </form>
                                        </div>
                                    </div>
                                
                        @endif
            </div>
        </div>
    </div>
</div>

@endsection
@push('scripts')
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
    integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
    crossorigin=""></script>
<script>
    @if ($title == 'Show Proposal')
        $("#form-input-proposal :input").prop("disabled", true);
    @endif
    var tabelFiles;
    var tabelPengurus;
    var tabelKerjasama;
    var tabelPersiapan;
    var tabelDonasi;
    var tabelRAB;
    var tabelKerjasama2;
    var tabelPj;
    var tabelOutcome;
    var tabelPengalaman;

    var saveMethod = 'ubah';
    var baseUrl = '{{ url($baseUrl) }}';
    var dataCd = '{{ $proposal->trx_proposal_id }}';
	
    var peta;
    var marker;

    $(document).ready(function(){
        // alert(baseUrl);
        $('#long-input').prop('disabled', 'disabled');
        $('#ruang_lingkup_child').prop('disabled', 'disabled');
        $('input[name=nominal]').val("{{ (int)$proposal->nominal }}").trigger('input');  
        $('input[name=nominal_approval]').val("{{ (int)$proposal->nominal }}").trigger('input');  
        $('select[name=ruang_lingkup]').val("{{ $proposal->ruang_lingkup }}").trigger('change');  
        $('select[name=ruang_lingkup_child]').val("{{ $proposal->ruang_lingkup_child }}").trigger('change'); 
        $('select[name=ruang_lingkup]').bind('change', function() {
            if ($('select[name=ruang_lingkup]').find(":selected").text().toLowerCase() == "non selected") {
                $('#ruang_lingkup_child').prop('disabled', 'disabled');
            }
            else {
                $('#ruang_lingkup_child').prop('disabled', false);
            }
        });
        $(document).ready(function() {
            $('#radio1').click(function()   {
                $('#long-input').prop('disabled', false);
                $('#submit-input').prop('disabled', 'disabled');
            });
            $('#radio2').click(function()   {
                $('#long-input').prop('disabled', 'disabled');
                $('#submit-input').prop('disabled', false);
            });
        });
        $('#submit-input').click(function(){
            submitForm =  1;
            $('#form-input-proposal').submit();
        });

        $('#draft-input').click(function(){
            submitForm = 0;
            $('#form-input-proposal').submit();
        });

        $('#long-input').click(function(){
            submitForm =  2;
            $('#form-input-proposal').submit();
        });
        //--Submit form
        $('#form-input-proposal').submit(function(e){
            if (e.isDefaultPrevented()) {
			//--Handle the invalid form
            } else {
                if (submitForm == 2) {
                        swal({
                            title               : 'Lanjutkan Ke Long Proposal ?',
                            type                : "question",
                            showCancelButton    : true,
                            confirmButtonColor  : "#00a65a",
                            confirmButtonText   : "OK",
                            cancelButtonText    : "NO",
                            allowOutsideClick : false,
                        }).then(function(result){
                            if(result.value){
                                swal({allowOutsideClick : false,title: "Proses Lanjut Long Proposal",onOpen: () => {swal.showLoading();}});

                                $.ajax({
                                    'type': 'POST',
                                    'url' : "{{ url('proposal-pemohon/input') }}",
                                    'data': record,
                                    contentType: false,
                                    processData: false,
                                    'success': function(response){
                                        if(response["status"] == 'oks') {
                                            swal({
                                                title: "Lanjut Long Proposal berhasil",
                                                type: "success",
                                                showCancelButton: false,
                                                showConfirmButton: false,
                                                timer: 1000
                                            }).then(() => {
                                                swal.close();
                                                window.location.reload();
                                            });
                                        }else if(response["status"] == 'ok'){
                                            swal({
                                                title: "Lanjut Long Proposal berhasil",
                                                type: "success",
                                                showCancelButton: false,
                                                showConfirmButton: false,
                                                timer: 1000
                                            }).then(() => {
                                                swal.close();
                                                window.location = baseUrl+"/list-proposal/"+response["id"];
                                            });
                                        }
                                        else{
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
                    }else{
                        e.preventDefault();
                        for (instance in CKEDITOR.instances) {
                            CKEDITOR.instances[instance].updateElement();
                        }
                        var record  = new FormData(this);
                        record.append('submit', submitForm);
                        var method  = 'POST';
                        var url     = baseUrl + '/update/' + dataCd;

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
                                                if (submitForm == 1) {
                                                    window.location = baseUrl;
                                                }
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
            }
        });

        $('.region_prop').select2({
            // placeholder : "Pilih Propinsi",
            @if($proposal->region_prop)
            data:[{"id": "{{ $proposal->region_prop }}" ,"text":"{{ getRegionNm($proposal->region_prop) }}" }] ,
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

        $('.region_kab').select2({
            // placeholder : "Pilih Kota",
            @if($proposal->region_kab)
            data:[{"id": "{{ $proposal->region_kab }}" ,"text":"{{ getRegionNm($proposal->region_kab) }}" }] ,
            @endif
            ajax : {
                url :  "{{ url('daftar-daerah/by-root/') }}"+"/{{ $proposal->region_prop }}",
                dataType: 'json',
                processResults: function(data){
                    return {
                        results: data
                    };
                },
            },
        });

        $('.region_kec').select2({
            // placeholder : "Pilih Kota",
            @if($proposal->region_kab)
            data:[{"id": "{{ $proposal->region_kec }}" ,"text":"{{ getRegionNm($proposal->region_kec) }}" }] ,
            @endif
            ajax : {
                url :  "{{ url('daftar-daerah/by-root/') }}"+"/{{ $proposal->region_kab }}",
                dataType: 'json',
                processResults: function(data){
                    return {
                        results: data
                    };
                },
            },
        });
  
        $('.region_kel').select2({
            // placeholder : "Pilih Kota",
            @if($proposal->region_kab)
            data:[{"id": "{{ $proposal->region_kel }}" ,"text":"{{ getRegionNm($proposal->region_kel) }}" }] ,
            @endif
            ajax : {
                url :  "{{ url('daftar-daerah/by-root/') }}"+"/{{ $proposal->region_kec }}",
                dataType: 'json',
                processResults: function(data){
                    return {
                        results: data
                    };
                },
            },
        });

        $('.region_prop').change(function () {
            $('.region_kab').empty();
            $('.region_kec').empty();
            $('.region_kel').empty();
            $('.region_kab').select2({
                // placeholder : "Pilih Kota",
                @if($proposal->region_kab)
                data:[{"id": "{{ $proposal->region_kab }}" ,"text":"{{ getRegionNm($proposal->region_kab) }}" }] ,
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

        $('.region_kab').change(function () {
            $('.region_kec').empty();
            $('.region_kel').empty();
            $('.region_kec').select2({
                // placeholder : "Pilih Kota",
                @if($proposal->region_kec)
                data:[{"id": "{{ $proposal->region_kec }}" ,"text":"{{ getRegionNm($proposal->region_kec) }}" }] ,
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

        $('.region_kec').change(function () {
            $('.region_kel').empty();
            $('.region_kel').select2({
                @if($proposal->region_kel)
                data:[{"id": "{{ $proposal->region_kel }}" ,"text":"{{ getRegionNm($proposal->region_kel) }}" }] ,
                @endif
                // placeholder : "Pilih Kota",
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

        $('body').on('change','#rekomendasi_pejabat', function(){
            $.ajax({
                url: baseUrl + '/get-pejabat',
                method: 'get',
                dataType: 'json',
                data: {
                    'trx_proposal_pejabat_rekomendasi_id': $(this).val()
                }
            }).done(function(response){
                $('#rekomendasi_jabatan').val(response.jabatan)
                $('#rekomendasi_instansi').val(response.institusi)
            })
        })
    });
</script>
@endpush