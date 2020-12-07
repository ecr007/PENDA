<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">
	@php
		if(Route::currentRouteName() == 'login'){
			$title = "Login";
		} else {
			$title = "Resetore";
		}


	@endphp

	<title>{{$title}} - {{ env('APP_NAME') }}</title>

	<link rel="shortcut icon" href="{{asset('images/favicon.ico')}}"/>  
	
	<!-- BEGIN GLOBAL MANDATORY STYLES -->
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
	<link href="{{asset('assets/plugins/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css"/>
	<link href="{{asset('assets/plugins/simple-line-icons/simple-line-icons.min.css')}}" rel="stylesheet" type="text/css"/>
	<link href="{{asset('assets/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
	<!-- END GLOBAL MANDATORY STYLES -->

	<!-- BEGIN PAGE LEVEL STYLES -->
	<link rel="stylesheet" type="text/css" href="{{asset('assets/plugins/select2/select2.css')}}"/>
	<!-- END PAGE LEVEL SCRIPTS -->

	<!-- BEGIN THEME STYLES -->
	<link href="{{asset('assets/css/style-conquer.css')}}" rel="stylesheet" type="text/css"/>
	<link href="{{asset('assets/css/style.css')}}" rel="stylesheet" type="text/css"/>
	<link href="{{asset('assets/css/main.css')}}" rel="stylesheet" type="text/css"/>
	<link href="{{asset('assets/css/style-responsive.css')}}" rel="stylesheet" type="text/css"/>
	<link href="{{asset('assets/css/plugins.css')}}" rel="stylesheet" type="text/css"/>
	<link href="{{asset('assets/css/themes/default.css')}}" rel="stylesheet" type="text/css" id="style_color"/>
	<link href="{{asset('assets/css/pages/login.css')}}?ver={{env('APP_ASSETS_VERSION')}}" rel="stylesheet" type="text/css"/>
	<link href="{{asset('css/styles.css')}}?ver={{env('APP_ASSETS_VERSION')}}" rel="stylesheet">
	<!-- END THEME STYLES -->

	<!-- Styles -->
	@stack('styles')
</head>
<body class="body-login login">
	<div id="mbe-ky-app">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div class="logo ecr-logo-admin">
						<img src="{{asset('images/logo.png')}}?ver={{env('APP_ASSETS_VERSION')}}" class="img-responsive">
					</div>
				</div>
			</div>

			<div class="row">				
				<div class="col-sm-12">
					<div class="content">
						@yield('content')
					</div>

					<div class="copyright">
						{{date("Y")}} &copy; {{ env('APP_NAME') }} ~ Administrator <br />
					    MBE System v1.0
					</div>

				</div>
			</div>


		</div>
	</div>
	@include('layouts/modal')
	
	<!-- Scripts -->
	<script src="{{asset('assets/plugins/jquery-1.11.0.min.js')}}" type="text/javascript"></script>
	<script src="{{asset('assets/plugins/jquery-validation/js/jquery.validate.min.js')}}" type="text/javascript"></script>
	<script src="{{asset('assets/scripts/app.js')}}" type="text/javascript"></script>
	<script src="{{asset('assets/scripts/login.js')}}" type="text/javascript"></script>

	<script src="{{ asset('js/functions.js') }}?ver={{env('APP_ASSETS_VERSION')}}" ></script>
	
	@stack('scripts')

	<script>
		$(document).ready(function(){
			KY.init();

			{{-- Open modal --}}
			@if(isset($open_modal))
				$('{{$open_modal}}').click();
			@endif
		});

		@stack('scripts-code')
	</script>
</body>
</html>
