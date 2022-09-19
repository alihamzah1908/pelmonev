@extends('layouts.app')

@section('content')
    <!-- Inner container -->
    <div class="d-md-flex align-items-md-start">

        <!-- Left sidebar component -->
        <div class="sidebar sidebar-light bg-transparent sidebar-component sidebar-component-left wmin-300 border-0 shadow-0 sidebar-expand-md">

            <!-- Sidebar content -->
            <div class="sidebar-content">

                <!-- Navigation -->
                <div class="card">
                    <div class="card-body bg-indigo-400 text-center card-img-top" style="background-image: url({{ asset('/global_assets/images/backgrounds/panel_bg.png') }}); background-size: contain;">
                        <div class="card-img-actions d-inline-block mb-3">
                            @if ($dataUser->image == NULL)                                     
                                <img class="img-fluid rounded-circle" src="{{ asset('/images/profile.jpeg') }}" width="170" height="170" alt="">
                            @else
                                <!--<img class="img-fluid rounded-circle" src="{{ url($dataUser->image) }}" width="170" height="170" style="background: #fff" alt="">-->
								<img class="img-fluid rounded-circle" src="{{ asset('/storage/file/image/') }}/{{ $dataUser->image }}" width="170" height="170" style="background: #fff" alt="">
                            @endif
                        </div>

                        <h6 class="font-weight-semibold mb-0">{{ $dataUser->user_nm }}</h6>
                        <span class="d-block opacity-75">{{ $dataUser->role_nm }}</span>

                        <div class="list-icons list-icons-extended mt-3">
                        </div>
                    </div>

                    <div class="card-body p-0">
                        <ul class="nav nav-sidebar mb-2" id="tab-menu">
                            <li class="nav-item-header"></li>
                            <li class="nav-item">
                                <a href="#profile" class="nav-link active" data-toggle="tab">
                                    <i class="icon-user"></i>
									Profil User
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#data-foto" class="nav-link" data-toggle="tab">
                                    <i class="icon-image3"></i>
                                    Foto Profil User
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#data-password" class="nav-link" data-toggle="tab">
                                    <i class="icon-key"></i>
                                    Ubah Password
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- /navigation -->

            </div>
            <!-- /sidebar content -->

        </div>
        <!-- /left sidebar component -->


        <!-- Right content -->
        <div class="tab-content w-100 overflow-auto">
            <div class="tab-pane fade active show" id="profile">
                <!-- Profil User -->
                <div class="card">
                    <div class="card-header header-elements-sm-inline">
                        <h6 class="card-title">Profil User</h6>
                    </div>

                    <div class="card-body">
                        <form class="form-validate-jquery" id="form-isian" action="#">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">Nama User <span class="text-danger">*</span></label>
                                        <input type="text" name="user_nm" class="form-control" required="" placeholder="" aria-invalid="false">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">Email </label>
                                        <input type="email" name="email" class="form-control" id="email" placeholder="">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="d-flex justify-content-end align-items-center">
                                <button type="submit" class="btn btn-primary legitRipple">Simpan <i class="icon-floppy-disks ml-2"></i></button>
								<button type="reset" class="btn btn-light ml-2 legitRipple" id="reset">Reset <i class="icon-reload-alt ml-2"></i></button>
                            </div>
                        </form>
                    </div>
                </div>

                @if ($dataUser->role_cd === 'mitra')
                <div class='card'>
                    <div class="card-header header-elements-sm-inline">
                        <h6 class="card-title">Data Mitra</h6>
                    </div>
                    
                        <div class="card-body">
                            <form class="form-validate-jquery" id="form-data" action="#">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group form-group-float">
                                            <label class="form-group-float-label is-visible">No Telepon</label>
                                            <input type="text" name="phone" class="form-control" value="{{ $mitra->phone }}" placeholder="" aria-invalid="false" maxlength="20">
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
                                    <button type="reset" class="btn btn-light ml-2 legitRipple" id="reset-mitra">Reset <i class="icon-reload-alt ml-2"></i></button>
                                </div>
                            </form>
                        </div>
                       
                </div>
                @endif
                <!-- /profil perusahaan -->
            </div>

            <div class="tab-pane fade" id="data-foto">
                <!-- change company image -->
                <div class="card">
                    <div class="card-header header-elements-inline">
                        <h6 class="card-title">Foto Profil User</h6>
                    </div>

                    <div class="card-body">
                        <div class="alert alert-warning"> 
                            <i class="fa fa-exclamation-triangle"></i> 
                            Ukuran file maksimal 2 MB
                        </div>
                        <div class="row" id="img-cropper">
                            <div class="col-md-12 p-20">
                                <div class="img-container" style="display:none" id="img-container">
                                    <img id="image" src="" class="img-responsive" alt="Picture">
                                </div>
                                <label class="data-url"></label>
                            </div>
                        </div>
                        <div class="btn-group btn-group-justified">
                            <button type="button" id="image-select" class="btn bg-slate-700 legitRipple"><i class="fa fa-image">Pilih Foto</i></button>
                            <input type="file" class="sr-only" id="inputImage" name="file" accept="image/*" style="display:none">
                            <button type="button" id="image-save" class="btn bg-slate-700 legitRipple"><i class="fa fa-floppy-o">Simpan Foto</i></button>
                            <button type="button" id="reset-cropper" class="btn bg-slate-700 legitRipple"><i class="fa fa-refresh">Reset</i></button>
                        </div><br>
                        <div class="btn-group btn-group-justified">
                            <button type="button" id="image-delete" class="btn bg-slate-700 legitRipple"><i class="fa fa-trash-o">Hapus Foto</i></button>
                            <button type="button" id="image-cancel" class="btn bg-slate-700 legitRipple"><i class="fa fa-remove">Selesai</i></button>
                        </div>
                    </div>
                </div>
                <!-- /change company image -->
            </div>

            <div class="tab-pane fade" id="data-password">
                <!-- Account settings -->
                <div class="card">
                    <div class="card-header header-elements-inline">
                        <h5 class="card-title">Ubah Password</h5>
                    </div>

                    <div class="card-body">
                        <form action="#" id="form-password">
							<input type="hidden" name="user_id" value="{{ $dataUser->user_id }}">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>Password Lama <span class="text-danger">*</span></label>
                                        <input type="password" name="old_password" value="password" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Password Baru <span class="text-danger">*</span></label>
                                        <input type="password" name="password" id="password" class="form-control" required placeholder="Password">
                                    </div>

                                    <div class="col-md-6">
                                        <label>Konfirmasi Passsword</label>
                                        <input type="password" name="repeat_password" class="form-control" required placeholder="Konfirmasi Password">
                                    </div>
                                </div>
                            </div>
                            <div class="text-right">
                                <button type="submit" class="btn btn-primary legitRipple">Simpan <i class="icon-floppy-disks ml-2"></i></button>
								<button type="reset" class="btn btn-light ml-2 legitRipple" id="reset-password">Reset <i class="icon-reload-alt ml-2"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /account settings -->
            </div>
        </div>
        <!-- /right content -->

    </div>
    <!-- /inner container -->

@endsection
@push('scripts')
<script src="/global_assets/js/plugins/media/cropper.min.js"></script>
<script>
    var dataCd = "{{ $dataUser->user_id }}";
    var base64Image = '';

    var baseUrlMitra = '{{ url("mitra-kemaslahatan") }}';
    var dataCdMitra = '{{ $mitra->trx_mitra_kemaslahatan_id ?? "" }}';

    $(function () {

        'use strict';

        var console = window.console || { log: function () {} };
        var $image = $('#image');
        var options = {
            aspectRatio: 200/200,
            preview: '.img-preview',
            crop: function (e) {
                base64Image = $image.cropper('getCroppedCanvas').toDataURL(0.5)
            }
        };

        //--Cropper
        $image.cropper(options);

        $('#reset-cropper').click(function(){
            $image.cropper("reset");  
        });

        $('#image-select').click(function(){
            $('#inputImage').click();  
        });

        //--Import image
        var $inputImage = $('#inputImage');
        var URL = window.URL || window.webkitURL;
        var blobURL;

        if (URL) {
            $inputImage.change(function () {
                var files = this.files;
                var file;

                if (!$image.data('cropper')) {
                    return;
                }

                if (files && files.length) {
                    file = files[0];

                    if(file.size < 3000000){
                        if (/^image\/\w+$/.test(file.type)) {
                            blobURL = URL.createObjectURL(file);
                            
                            $image.one('built.cropper', function () {

                                //--Revoke when load complete
                                URL.revokeObjectURL(blobURL);
                            }).cropper('reset').cropper('replace', blobURL);
                            
                            $inputImage.val('');
                            $('#img-container').show();
                        } else {
                            swal({
                                title: "Silakan pilih foto",
                                type: "error",
                                showCancelButton: false,
                                showConfirmButton: false,
                                timer: 1000
                            }).then(() => {
                                swal.close()
                            });
                        }
                    }else{
                        swal({
                            title: "Ukuran foto terlalu besar",
                            type: "error",
                            showCancelButton: false,
                            showConfirmButton: false,
                            timer: 1000
                        }).then(() => {
                            $inputImage.val('');
                            swal.close()
                        });
                    }

                }
            });
        } else {
            $inputImage.prop('disabled', true).parent().addClass('disabled');
        }

        //--Simpan foto
        $('#image-save').click(function(){
            if(base64Image == ''){
                swal({
                    title: "Silakan pilih foto",
                    type: "error",
                    showCancelButton: false,
                    showConfirmButton: false,
                    timer: 1000
                }).then(() => {
                    swal.close()
                });
                return false;
            }

            swal({
                title               : 'Upload foto?',
                type                : "question",
                showCancelButton    : true,
                confirmButtonColor  : "#00a65a",
                confirmButtonText   : "OK",
                cancelButtonText    : "NO",
            }).then(function(result){
                if(result.value){
                    swal({title: "Proses simpan",onOpen: () => {swal.showLoading();}});

                    $.ajax({
                        url          : "{{ url('profile/image') }}",
                        type         : "PUT", 
                        data         :{"image" : base64Image, '_token': $('input[name=_token]').val()},
                        dataType     : 'JSON',
                        success   : function(response){
                            if(response.status == 'ok') {     
                                swal({
                                    title: "Proses berhasil",
                                    type: "success",
                                    showCancelButton: false,
                                    showConfirmButton: false,
                                    timer: 1000
                                }).then(() => {
                                    swal.close();
                                    window.location = '{{ url("profile/") }}';
                                });
                            }else{
                                swal({title: "Proses gagal",type: "error",showCancelButton: false,showConfirmButton: false,timer: 1000});
                            }
                        },
                        error: function(response){ 
                            var errorText = '';
                            console.log(response)
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

        $('#image-delete').click(function(){
            swal({
                title             : "Hapus foto?",
                type              : "warning",
                showCancelButton  : true,
                confirmButtonColor: "#00a65a",
                confirmButtonText : "OK",
                cancelButtonText  : "NO",
            }).then(function(result){
                if(result.value){
                    swal({title: "Proses hapus",onOpen: () => {swal.showLoading();}});
                    $.ajax({
                        url       : "{{ url('profile/image') }}",
                        type      : "PUT", 
                        data      :{"image" : base64Image, '_token': $('input[name=_token]').val()},
                        dataType  : "JSON",
                        success   : function(response){
                            if(response.status == 'ok') {     
                                swal({
                                    title: "Proses berhasil",
                                    type: "success",
                                    showCancelButton: false,
                                    showConfirmButton: false,
                                    timer: 1000
                                }).then(() => {
                                    swal.close();
                                    window.location = '{{ url("profile/") }}';
                                });
                            }else{
                                swal({title: "Proses gagal",type: "error",showCancelButton: false,showConfirmButton: false,timer: 1000});
                            }
                        },
                        error: function(response){ 
                            var errorText = '';
                            console.log(response)
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
                    })
                }else {
                    swal.close();
                }
            });
        });

        $('#image-cancel').click(function(){
            swal({
                title             : "Batal upload foto ?",
                type              : "question",
                showCancelButton  : true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText : "OK",
                cancelButtonText  : "NO",
            }).then(function(result){
                if(result.value){   
                    $('.nav-sidebar a[href="#profile"]').tab('show');
                }
            });
        });

    });

    $(document).ready(function(){
        //--Submit form
        $('#form-isian').submit(function(e){
            if (e.isDefaultPrevented()) {
            //--Handle the invalid form
            } else {
                e.preventDefault();
                var record  = $('#form-isian').serialize();
                var url     = '{{ url("/profile/") }}';
                var method  = 'PUT';

                swal({
                    title               : 'Simpan data?',
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
                                        init();
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
                                        swal.close();
                                    }
                                });  
                            }
                        });
                    }
                });
            }
        });

        //--Password
        $('#form-password').submit(function(e){
            if (e.isDefaultPrevented()) {
            //--Handle the invalid form
            } else {
                e.preventDefault();
                var record = $('#form-password').serialize();
                var url     = '{{ url("/profile/password/") }}';
                var method  = 'POST';

                swal({
                    title               : 'Simpan data?',
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
                                        init();
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
                                        swal.close();
                                    }
                                });  
                            }
                        });
                    }
                });
            }
        });

        // Submit data mitra
        $('.form-validate-jquery').submit(function(e){
            if (e.isDefaultPrevented()) {
			//--Handle the invalid form
            } else {
				e.preventDefault();

                var record  = new FormData(this);
                var url     = baseUrlMitra + '/update/' + dataCdMitra;
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
                                        $('#reset-mitra').click();
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

        @if($dataUser->role_cd === 'mitra')
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
        @endif

        init();
    });

    function init(){
        var urlUpdate='{{ url("/profile/".$dataUser->user_id) }}';

        $.getJSON( urlUpdate, function(data){
            if (data['status'] == 'ok') {
                $.each(data['data'], function (index, data) {
                    $('input[name='+index+']').val(data);
                    $('textarea[name='+index+']').val(data);
                    $('select[name='+index+']').val(data).trigger('change');
                });
            
                $('#tab-menu a[href="#profile"]').tab('show');

                $('#reset-password').click();
            }
        });
    }
</script>
@endpush