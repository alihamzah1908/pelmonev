<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('/images/favicon.ico') }}">
	<!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @stack('meta')
	{{-- <title>{{ $title.' - '.configuration('APP_NAME') }}</title> --}}
	<title>{{ $title ?? configuration('APP_NAME') }}</title>

	<!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="{{ asset('/global_assets/css/icons/icomoon/styles.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('/css/bootstrap_limitless.min.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('/css/layout.min.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('/css/components.min.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('/css/colors.min.css') }}" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->

	<style>
		:root {
			--app-white: #ffffff;
			--app-sidebar-dark: #004d80;
			--app-sidebar-dark-secondary: #f8bf24;
		}
	</style>
	<link href="/css/style.min.css" rel="stylesheet" type="text/css">
	{{-- <link href="/css/style.css" rel="stylesheet" type="text/css"> --}}

    @stack('styles')

	<!-- Core JS files -->
	<script src="{{ asset('/global_assets/js/main/jquery.min.js') }}"></script>
	<script src="{{ asset('/global_assets/js/main/bootstrap.bundle.min.js') }}"></script>
	<script src="{{ asset('/global_assets/js/plugins/loaders/blockui.min.js') }}"></script>
	<script src="{{ asset('/global_assets/js/plugins/ui/slinky.min.js') }}"></script>
	<script src="{{ asset('/global_assets/js/plugins/ui/ripple.min.js') }}"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
	<script src="{{ asset('/global_assets/js/plugins/notifications/sweet_alert.min.js') }}"></script>
	<script src="{{ asset('/global_assets/js/plugins/forms/validation/validate.min.js') }}"></script>
	<script src="{{ asset('/global_assets/js/plugins/forms/validation/localization/messages_id.js') }}"></script>
	<script src="{{ asset('/global_assets/js/plugins/forms/inputs/touchspin.min.js') }}"></script>
	<script src="{{ asset('/global_assets/js/plugins/forms/selects/select2.min.js') }}"></script>
	<script src="{{ asset('/global_assets/js/plugins/forms/styling/switch.min.js') }}"></script>
	<script src="{{ asset('/global_assets/js/plugins/forms/styling/switchery.min.js') }}"></script>
	<script src="{{ asset('/global_assets/js/plugins/forms/styling/uniform.min.js') }}"></script>
	<script src="{{ asset('/global_assets/js/plugins/visualization/d3/d3.min.js') }}"></script>
	<script src="{{ asset('/global_assets/js/plugins/visualization/d3/d3_tooltip.js') }}"></script>
	<script src="{{ asset('/global_assets/js/plugins/forms/selects/bootstrap_multiselect.js') }}"></script>
	<script src="{{ asset('/global_assets/js/plugins/ui/moment/moment.min.js') }}"></script>
	<script src="{{ url('/') }}/global_assets/js/plugins/ui/moment/moment_locales.min.js"></script>
	<script src="{{ asset('/global_assets/js/plugins/pickers/anytime.min.js') }}"></script>
	<script src="{{ asset('/global_assets/js/plugins/tables/datatables/datatables.min.js') }}"></script>
	<script src="{{ asset('/global_assets/js/plugins/tables/datatables/extensions/responsive.min.js') }}"></script>
	<script src="{{ asset('/global_assets/js/plugins/forms/inputs/passy.js') }}"></script>

	<script src="{{ asset('/js/app.js') }}"></script>
	{{-- <script src="{{ asset('/global_assets/js/demo_pages/dashboard.js') }}"></script> --}}
	{{-- <script src="{{ asset('/global_assets/js/demo_pages/form_validation.js') }}"></script> --}}
	<script src="{{ asset('/global_assets/js/demo_pages/extra_sweetalert.js') }}"></script>
	<!-- /theme JS files -->

	{{-- othen plugins --}}
	<!-- jquery mask -->
	<script src="{{ asset('plugins/jquery-mask/jquery.mask.min.js') }}"></script>
	<script src="{{ asset('plugins/cell-edit/cell-edit.js') }}"></script>
	<script src="{{ asset('plugins/printjs/print.min.js') }}"></script>

	<link href="{{ asset('plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet" type="text/css">
	<script src="{{ asset('plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js') }}"></script>

	<script src="{{ url('/') }}/global_assets/js/plugins/pickers/daterangepicker.js"></script>
	<script src="{{ url('/') }}/global_assets/js/plugins/uploaders/fileinput/plugins/purify.min.js"></script>
	<script src="{{ url('/') }}/global_assets/js/plugins/uploaders/fileinput/plugins/sortable.min.js"></script>
	<script src="{{ url('/') }}/global_assets/js/plugins/uploaders/fileinput/fileinput.min.js"></script>
	<script src="{{ url('/') }}/global_assets/js/plugins/editors/ckeditor/ckeditor.js"></script>
</head>
<body class="">

	@include('layouts.navbar')
	<!-- Page content -->
	<div class="page-content">
		@include('layouts.sidebar')
		<!-- Main content -->
		<div class="content-wrapper">

			<!-- Page header -->
			{{-- <div class="page-header">
				<div class="page-header-content header-elements-md-inline">
					<div class="page-title d-flex">
						<h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">{{ $title }}</span></h4>
						<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
					</div>

					<div class="header-elements d-none text-center text-md-left mb-3 mb-md-0">

					</div>
				</div>
			</div> --}}
			<!-- /page header -->


			<!-- Content area -->
			<div class="content mt-0">

				@yield('content')

			</div>
			<!-- /content area -->

			@include('layouts.footer')

			</div>
			<!-- /main content -->
		</div>
	<!-- /page content -->
	<script>
		var dataCd;
		var rowData;
		var validatedForm;
		var validator = [];

		$(document).ready(function(){
			moment.locale('id');

			$('.money').mask('000.000.000.000.000', {reverse: true});
			$('.mask-date').mask('00/00/0000');
			$('.mask-time').mask('00:00');
			$('.mask-phone').mask('00000000000');

			$('.form-check-input-styled').uniform();

			$('.daterange-single').daterangepicker({
				applyClass: 'bg-slate-600',
            	cancelClass: 'btn-light',
				locale: {
					format: 'DD/MM/YYYY'
				}
			});

			$('.date-picker').daterangepicker({
				singleDatePicker: true,
				locale: {
					format: 'DD/MM/YYYY'
				}
			});

			$('.datetime-picker').daterangepicker({
				singleDatePicker: true,
				timePicker: true,
				locale: {
					format: 'DD/MM/YYYY h:mm'
				}
			});

			$('.daterange-picker').daterangepicker({
				locale: {
					format: 'DD/MM/YYYY'
				}
			});

			$.ajaxSetup({
				headers: { "X-CSRF-TOKEN":  $('meta[name="csrf-token"]').attr('content')},
				crossDomain : true,
				xhrFields: {
					withCredentials: true
				},
			});

			validatedForm = $('form').each(function() {
				$formId = $(this).attr("id");
				validator[$formId] = $('#'+$formId).validate({
					ignore: 'input[type=hidden], .select2-search__field', // ignore hidden fields
					errorClass: 'validation-invalid-label',
					successClass: 'validation-valid-label',
					validClass: 'validation-valid-label',
					highlight: function(element, errorClass) {
						$(element).removeClass(errorClass);
					},
					unhighlight: function(element, errorClass) {
						$(element).removeClass(errorClass);
					},
					// Different components require proper error label placement
					errorPlacement: function(error, element) {

						// Unstyled checkboxes, radios
						if (element.parents().hasClass('form-check')) {
							error.appendTo( element.parents('.form-check').parent() );
						}

						// Input with icons and Select2
						else if (element.parents().hasClass('form-group-feedback') || element.hasClass('select2-hidden-accessible')) {
							error.appendTo( element.parent() );
						}

						// Input group, styled file input
						else if (element.parent().is('.uniform-uploader, .uniform-select') || element.parents().hasClass('input-group')) {
							error.appendTo( element.parent().parent() );
						}

						// Other elements
						else {
							error.insertAfter(element);
						}
					},
					rules: {
						password: {
							minlength: 5
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

			});

			$('.table-single-select tbody').on( 'click', 'tr', function () {
				if ( ! $(this).hasClass('group_row') ) {
					if ( $(this).hasClass('selected') ) {
						$(this).removeClass('selected');
						dataCd 	= null;
						rowData	= null;
					}else{
						var selectedTable = $('#'+$(this).closest('table').attr('id')).DataTable();
						selectedTable.$('tr.selected').removeClass('selected');
						var data = selectedTable.row(this).data();
						if (data != null) {
							$(this).addClass('selected');
							rowData=data;
							dataCd=data[Object.keys(data)[0]];
						}
					}
				}
			});

			$('.modal').on('hidden.bs.modal', function() {
				dataCd=null;
				rowData=null;
			});

			@if(session('success'))
				swal({
					title: "{{ session('success') }}",
					type: "success",
					showCancelButton: false,
					showConfirmButton: false,
					timer: 1000
				}).then(() => {
					swal.close();
				});
			@endif

			@if(session('error'))
				swal({
					title: "{{ session('error') }}",
					type: "error",
					showCancelButton: false,
					showConfirmButton: false,
					timer: 1000
				}).then(() => {
					swal.close();
				});
			@endif

			$('.form-control-select2').select2();

			$('.modal').on('hide.bs.modal', function() {
				$formId = $(this).find('.form-validate-jquerys').attr('id');
				if ($formId) {
					$(this).find('select').val('').trigger('change').prop("disabled",false);
					$(this).find('input').val('').prop("readonly",false);
					$(this).find('textarea').val('').prop("readonly",false);
					$(this).find('.date-picker').val('{{ date("d/m/Y") }}');
					// validator[$formId].resetForm();
				}
			});

			$('.file-input-document').fileinput({
				browseLabel: 'Cari Berkas',
				browseIcon: '<i class="icon-file-plus mr-2"></i>',
				browseClass: 'btn bg-slate-700',
				uploadLabel: 'Simpan Data',
				uploadIcon: '<i class="icon-file-upload2 mr-2"></i>',
				uploadClass: 'btn bg-teal-400',
				removeLabel: 'Buang Berkas',
				removeIcon: '<i class="icon-cross2 font-size-base mr-2"></i>',
				removeClass: 'btn btn-danger',
				allowedFileExtensions: ["pdf", "doc", "docx"],
				initialCaption: "Belum Ada Berkas",
				initialPreviewAsData: true,
				overwriteInitial: true,
				maxFileSize: 1000,
			});

			$('.file-input-image').fileinput({
				browseLabel: 'Cari Gambar',
				browseIcon: '<i class="icon-file-plus mr-2"></i>',
				browseClass: 'btn bg-slate-700',
				uploadLabel: 'Simpan Gambar',
				uploadIcon: '<i class="icon-file-upload2 mr-2"></i>',
				uploadClass: 'btn bg-teal-400',
				removeLabel: 'Buang Berkas',
				removeIcon: '<i class="icon-cross2 font-size-base mr-2"></i>',
				removeClass: 'btn btn-danger',
				allowedFileExtensions: ["png", "jpg", "jpeg"],
				initialCaption: "Belum Ada Gambar Yang Dipilih",
				initialPreviewAsData: true,
				overwriteInitial: true,
				maxFileSize: 1000,
			});

			if (typeof CKEDITOR == 'undefined') {
				console.warn('Warning - ckeditor.js is not loaded.');
				return;
			}

			// Setup
			CKEDITOR.replace('ckeditor', {
				height: 400
			});
		});

		function regionLayout(region) {
			if (!region.id) {
				return region.text;
			}

			var root = '';
			if (region.root != null) {
				root = region.root;
			}

			/*var $state = $(
				'<div class="list" style="overflow:hidden;">'+
				'<div><strong>'+ region.text +'</strong> <br></div>'+
				'<i class="icon-location4"></i> '+region.long_region+
				'</div>'
				);*/
			var $state = $(
				'<div class="list" style="overflow:hidden;">'+
				'<div><strong>'+ root +'</strong> <br></div>'+
				'<i class="icon-location4"></i> '+region.text+
				'</div>'
				);

			return $state;
		};

		function spelling(a){
			let val;
			if (isNaN(a) || a==="" ||  a === null){
			val = 0;
			}else{
			a = parseFloat(a);
			val = (a/1).toFixed(0).replace('.', ',');
			val=val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
			}
			return val;
		}

		function getCurrentDateTime() {
			return moment().format('DD/MM/YYYY HH:mm:ss')
		}

		$.extend( $.fn.dataTable.defaults, {
            pagingType	: "full_numbers",
			language	: {"url": "{{ asset('/plugins/DataTables/indonesian.json')}}"},
			dom 		: 'tpir',
			pageLength	: 30
        });

	</script>
	@stack('scripts')
	<script>
		$(document).ready(function(){
			// Passy
			var _componentPassy = function() {
				if (!$().passy) {
					console.warn('Warning - passy.js is not loaded.');
					return;
				}

				// Input badges
				var $inputLabel 	= $('.badge-indicator input');
				var $outputLabel 	= $('.badge-indicator > span');

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
						min: 8,
						max: Infinity
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
