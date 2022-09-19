<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="icon" type="image/png" sizes="16x16" href="/images/favicon.ico">
	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>{{ 'Registrasi | '.configuration('APP_NAME') }}</title>

	<!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet"
		type="text/css">
	<link href="/global_assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
	<link href="/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="/css/bootstrap_limitless.min.css" rel="stylesheet" type="text/css">
	<link href="/css/layout.min.css" rel="stylesheet" type="text/css">
	<link href="/css/components.min.css" rel="stylesheet" type="text/css">
	<link href="/css/colors.min.css" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->

	<style>
        :root {
            --app-white: #ffffff;
            --app-sidebar-dark: #021545;
            --app-sidebar-dark-secondary: #014B8E;
        }
        .btn-primary {
            background-color: var(--app-sidebar-dark) !important;
        }
	</style>

	<link href="/css/style.min.css" rel="stylesheet" type="text/css">
	{{-- <link href="/css/style.css" rel="stylesheet" type="text/css"> --}}

	<!-- Core JS files -->
	<script src="/global_assets/js/main/jquery.min.js"></script>
	<script src="/global_assets/js/main/bootstrap.bundle.min.js"></script>
	<script src="/global_assets/js/plugins/loaders/blockui.min.js"></script>
	<script src="/global_assets/js/plugins/ui/ripple.min.js"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
	<script src="/global_assets/js/plugins/forms/styling/uniform.min.js"></script>
	<script src="/global_assets/js/plugins/notifications/sweet_alert.min.js"></script>
	<script src="/global_assets/js/plugins/forms/validation/validate.min.js"></script>
	<script src="/global_assets/js/plugins/forms/validation/localization/messages_id.js"></script>
    <script src="/global_assets/js/plugins/forms/selects/select2.min.js"></script>
	<script src="{{ asset('/global_assets/js/plugins/forms/inputs/passy.js') }}"></script>

	<script src="/js/app.js"></script>

	<style>
		body {
			background-color: #fff;
		}
		.login-cover2 {
            background: url("/images/bpkh_2b.jpg") no-repeat;
            background-size: cover;
            background-attachment: fixed;
		}

		.logo-content {
			margin-bottom: 24px;
		}

		.logo-content .logo {
			height: 108px;
		}

		.logo-content span {
			font-size: 10px;
			color: #999;
			margin-top: 8px;
		}

		.footer {
			position: absolute;
			bottom: 0;
			width: 100%;
			background-color: transparent;
			padding-bottom: 10px;
		}

		.footer img {
			height: 40px;
		}

		.footer .tagline {
			font-size: 10px;
			letter-spacing: 6px;
			color: #ccc;
			margin-top: 8px;
			margin-bottom: 0;
		}
	</style>

</head>

<body>
	<!-- Page content -->
	<div class="page-content login-cover2">

		<!-- Main content -->
		<div class="content-wrapper">

			<!-- Content area -->
			<div class="content d-flex justify-content-center align-items-center">

				<!-- Login form -->
				<form class="w-xl-75" class="form-validate" method="POST" action="{{ route('register') }}">
					@csrf
                    <div class="card mb-0">
                        <div class="card-body">
                            <div class="card-group-control card-group-control-right">
                                {{-- Personal --}}
                                <div class="text-center logo-content">
                                    <a href="{{url('/')}}"><img src="{{ url(configuration('APP_ALIAS_LOGO')) }}" class="logo"></a>
                                    <span class="d-block text-muted">{{ configuration('APP_ALIAS_DESC') }}</span>
                                </div>
                                {{-- Akun --}}
                                <div class="card">
                                    <div class="card-header bg-slate">
                                        <h6 class="card-title">
                                            <a data-toggle="collapse" class="text-white" href="#collapsible-control-right-group2">DATA AKUN</a>
                                        </h6>
                                    </div>
                                    <div id="collapsible-control-right-group2" class="collapse show">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6 form-group form-group-feedback form-group-feedback-left">
                                                    <input type="text" id="name" name="name" class="form-control" placeholder="{{ __('Nama Pemohon') }}" required="" placeholder="" aria-invalid="false" />
                                                    <div class="form-control-feedback">
                                                        <i class="ml-3 icon-user text-muted"></i>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 form-group form-group-feedback form-group-feedback-left">
                                                    <input type="text" id="nik" name="nik" class="form-control" placeholder="{{ __('NIK') }}" required="" placeholder="" aria-invalid="false" />
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
                                                    <div class="badge-indicator">
                                                        <input type="password" id="password" name="password" class="form-control" placeholder="{{ __('Password') }}" required="">
                                                        <span class="badge form-text password-indicator-badge"></span>
                                                    </div>
                                                    <div class="form-control-feedback">
                                                        <i class="ml-3 icon-key text-muted"></i>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 form-group form-group-feedback form-group-feedback-left">
                                                    <div class="badge-indicator">
                                                        <input type="password" id="repeat_password" name="password_confirmation" class="form-control" placeholder="{{ __('Konfirmasi Password') }}" required="">
                                                        <span class="badge form-text password-indicator-badge"></span>
                                                    </div>
                                                    <div class="form-control-feedback">
                                                        <i class="ml-3 icon-key text-muted"></i>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 form-group form-group-feedback form-group-feedback-left">
                                                    <input type="text" id="phone" name="phone" class="form-control" placeholder="{{ __('No Telepon') }}" required="" placeholder="" maxlength="20" aria-invalid="false" />
                                                    <div class="form-control-feedback">
                                                        <i class="ml-3 icon-phone text-muted"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-block">{{ __('PROSES REGISTRASI') }} <i class="icon-circle-right2 ml-2"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>

				</form>

				<!-- /login form -->

			</div>
			<!-- /content area -->

		</div>
		<!-- /main content -->

	</div>
	<!-- /page content -->

	<script>
		$(document).ready(function () {
            $('.form-control-select2').select2();

            $('#region_prop').select2({
                placeholder : "Pilih Propinsi",
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

            $('#region_prop').change(function () {
                $('#region_kab').empty();
                $('#region_kec').empty();
                $('#region_kel').empty();
                $('#region_kab').select2({
                    placeholder : "Pilih Kota",
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

			$('.form-input-styled').uniform();

			@if ($errors->has('email'))
				swal({
					title: "{{ $errors->first('email') }}",
					type: "error",
					showCancelButton: false,
					showConfirmButton: false,
					timer: 2000
				}).then(() => {
					swal.close();
				});
			@endif

			@if ($errors->has('user_id'))
				swal({
					title: "{{ $errors->first('user_id') }}",
					type: "error",
					showCancelButton: false,
					showConfirmButton: false,
					timer: 2000
				}).then(() => {
					swal.close();
				});
			@endif

			@if ($errors->has('password'))
				swal({
					title: "{{ $errors->first('password') }}",
					type: "error",
					showCancelButton: false,
					showConfirmButton: false,
					timer: 2000
				}).then(() => {
					swal.close();
				});
			@endif

			var validator = $('.form-validate').validate({
				ignore: 'input[type=hidden], .select2-search__field', // ignore hidden fields
				errorClass: 'validation-invalid-label',
				successClass: 'validation-valid-label',
				validClass: 'validation-valid-label',
				highlight: function (element, errorClass) {
					$(element).removeClass(errorClass);
				},
				unhighlight: function (element, errorClass) {
					$(element).removeClass(errorClass);
				},
				// Different components require proper error label placement
				errorPlacement: function (error, element) {

					// Unstyled checkboxes, radios
					if (element.parents().hasClass('form-check')) {
						error.appendTo(element.parents('.form-check').parent());
					}

					// Input with icons and Select2
					else if (element.parents().hasClass('form-group-feedback') || element.hasClass('select2-hidden-accessible')) {
						error.appendTo(element.parent());
					}

					// Input group, styled file input
					else if (element.parent().is('.uniform-uploader, .uniform-select') || element.parents().hasClass('input-group')) {
						error.appendTo(element.parent().parent());
					}

					// Other elements
					else {
						error.insertAfter(element);
					}
				},
				rules: {
					password: {
						minlength: 6,
                        maxlength: 12
					},
					repeat_password: {
						equalTo: '#password'
					},
					email: {
						email: true
					},
					repeat_email: {
						equalTo: '#email'
					},
					minimum_characters: {
						minlength: 10
					},
					maximum_characters: {
						maxlength: 10
					},
					minimum_number: {
						min: 10
					},
					maximum_number: {
						max: 10
					},
					number_range: {
						range: [10, 20]
					},
					url: {
						url: true
					},
					date: {
						date: true
					},
					date_iso: {
						dateISO: true
					},
					numbers: {
						number: true
					},
					digits: {
						digits: true
					},
					creditcard: {
						creditcard: true
					},
					basic_checkbox: {
						minlength: 2
					},
					styled_checkbox: {
						minlength: 2
					},
					switchery_group: {
						minlength: 2
					},
					switch_group: {
						minlength: 2
					}
				},
				messages: {
					custom: {
						required: 'This is a custom error message'
					},
					basic_checkbox: {
						minlength: 'Please select at least {0} checkboxes'
					},
					styled_checkbox: {
						minlength: 'Please select at least {0} checkboxes'
					},
					switchery_group: {
						minlength: 'Please select at least {0} switches'
					},
					switch_group: {
						minlength: 'Please select at least {0} switches'
					},
					agree: 'Please accept our policy'
				}
			});


			// Passy
			var _componentPassy = function() {
				if (!$().passy) {
					console.warn('Warning - passy.js is not loaded.');
					return;
				}

				// Input badges
				var $inputLabel = $('.badge-indicator input');
				var $outputLabel = $('.badge-indicator > span');

				$.passy.requirements = {
					// Character types a password should contain
					characters: [
						$.passy.character.DIGIT,
						$.passy.character.LOWERCASE,
						$.passy.character.UPPERCASE,
						$.passy.character.PUNCTUATION
					],

					// A minimum and maximum length
					length: {
						min: 6,
						max: 12
					}
				};


				// Strength meter
				var feedback = [
					{color: '#D55757', text: 'Lemah', textColor: '#fff'},
					{color: '#EB7F5E', text: 'Normal', textColor: '#fff'},
					{color: '#3BA4CE', text: 'Baik', textColor: '#fff'},
					{color: '#40B381', text: 'Kuat', textColor: '#fff'}
				];


				// Label indicator
				$inputLabel.passy(function(strength) {
					$outputLabel.text(feedback[strength].text);
					$outputLabel.css({
						'display': 'block',
						'background-color': feedback[strength].color,
						'color': feedback[strength].textColor
					});
				});
			};

			_componentPassy();
		});
	</script>

</body>

</html>
