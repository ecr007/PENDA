@extends('layouts/app-login')

@section('content')

	<div class="fixed-top text-right login-link">
		
		<a class="btn btn-link" href="{{ route('login') }}">{{ __('Already registered? Log in now' ) }}</a>
	
	</div>

	<div class="gathr-form-register">
	
		<img class="mb-5" src="{{ asset('images/gathr-logo-gr-88h@2x.png') }}" alt="{{ config('app.name') }} Logo" height="60">
   		
   		@include('layouts/alert')

		<h1 class="h3 mt-0 mb-3 font-weight-normal">Thanks!</h1>
		
		<p>
			You're now registered. Please, click the link sent to your email to confirm your account with GathR.
		</p>
			       
	</div>

@endsection
