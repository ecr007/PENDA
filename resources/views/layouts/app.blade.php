<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="app-url" content="{{ url('') }}">

	<title>@if(isset($title)){{$title}} - @endif{{ env('APP_NAME') }}</title>

	<link rel="shortcut icon" href="{{asset('images/favicon.ico')}}"/>

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
    
    <link href="{{asset('assets/plugins/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/css/style-conquer.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/css/style.css')}}?ver=1" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/css/style-responsive.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/css/plugins.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/css/themes/default.css')}}" rel="stylesheet" type="text/css" id="style_color"/>
    <link href="{{asset('assets/css/pages/profile.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/plugins/password_strength/password_strength.css')}}?ver=1.0" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/css/jquery.timepicker.css')}}" rel="stylesheet" type="text/css"/>

	<!-- Styles -->
	<link href="{{ asset('css/styles.css') }}?ver={{env('APP_ASSETS_VERSION')}}" rel="stylesheet">
	<link href="{{ asset('css/responsive.css') }}?ver={{env('APP_ASSETS_VERSION')}}" rel="stylesheet">
</head>
<body>
	
	<div class="header navbar">
	    <div class="header-inner">
	        
	        <div class="page-logo">
	            <h4> <a href="{{ route('dashboard') }}">{{env('APP_NAME')}}</a></h4>
	        </div>

	        <a href="javascript:;" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
	            <img src="{{asset('assets/img/menu-toggler.png')}}" alt=""/>
	        </a>

	        <ul class="nav navbar-nav pull-right">
	            <li class="dropdown user">
	                <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
	                <!-- <img alt="" src="assets/img/avatar3_small.jpg"/> -->
	                <span class="username">Welcome {{Auth::user()->firstname}} {{Auth::user()->lastname}}</span>
	                <i class="fa fa-angle-down"></i>
	                </a>
	                <ul class="dropdown-menu">
	                    <li>
	                        <a href="{{ URL::to('salir') }}" class="ecr-logout"><i class="fa fa-key"></i> Logout</a>
	                        <form id="ecr-logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
								@csrf
							</form>
	                    </li>
	                </ul>
	            </li>
	        </ul>
	    </div>
	</div>

	<div class="clearfix"></div>

	<div class="page-container">

		@include('layouts/menu')

		<div class="page-content-wrapper">

        <div class="page-content">

            <h3 class="page-title">{{{$title}}}</h3>

            <div class="row">

                <div class="col-md-12">

                    <div class="tabbable tabbable-custom">

                    	@include('layouts/alert')
						
						@yield('content')
					</div>
				</div>
			</div>
		</div>
	</div>

	@include('layouts/modal')

	<script src="{{asset('assets/plugins/jquery-1.11.0.min.js')}}" type="text/javascript"></script>
	<script src="{{asset('assets/plugins/jquery-migrate-1.2.1.min.js')}}" type="text/javascript"></script>
	<script src="{{asset('assets/plugins/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
	<script src="{{asset('assets/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js')}}" type="text/javascript"></script>
	<script src="{{asset('assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js')}}" type="text/javascript"></script>
	<script src="{{asset('assets/plugins/jquery.blockui.min.js')}}" type="text/javascript"></script>
	<script src="{{asset('assets/scripts/app.js')}}?ver={{env('APP_ASSETS_VERSION')}}"></script>


	<script src="{{asset('assets/scripts/form-samples.js')}}"></script>
	<script src="{{asset('assets/scripts/index.js')}}" type="text/javascript"></script>

	<!-- Scripts -->
	<script src="{{ asset('js/functions.js') }}?ver={{env('APP_ASSETS_VERSION')}}" ></script>
	<script>
		jQuery(document).ready(function(){
			App.init();
			KY.init();

			{{-- Open modal --}}
			@if(isset($open_modal))
				jQuery('{{$open_modal}}').click();
			@endif
		});

		jQuery(window).on("load", function (e) {
			KY.onload();
		});
	</script>

	@stack('scripts')
</body>
</html>
