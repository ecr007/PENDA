<nav class="navbar d-none d-md-flex navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow text-center">
	<a class="navbar-brand col-sm-3 col-md-2 gathr-col-md-2 mr-0" href="{{url('')}}"><img src="{{ asset('images/gathr-logo-39h.png') }}" alt="{{ config('app.name') }} Logo" /></a>

	<ul class="navbar-nav d-none d-md-flex px-3">
		<li class="nav-item text-nowrap">
			<button class="btn btn-sm btn-outline-primary mr-2" style="cursor: default;">Hi, {{Auth::user()->firstname}}</button>

			<a class="gathr-logout btn btn-sm btn-outline-secondary" href="{{ route('logout') }}">{{ __('Logout') }}</a>
			<form id="gathr-logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
				@csrf
			</form>
		</li>
	</ul>
</nav>

<nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap  shadow d-md-none d-lg-none">
	
	<a class="navbar-brand" href="{{url('')}}"><img src="{{ asset('images/gathr-logo-39h.png') }}" alt="{{ config('app.name') }} Logo" /></a>

	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>

	<div class="collapse navbar-collapse gathr-menu gathr-mb-menu" id="navbarSupportedContent">
		<ul class="navbar-nav mr-auto">
			@include('layouts/menu-list')

			<li class="nav-item">
				<a class="nav-link gathr-logout" href="{{ route('logout') }}">
					<i class="fa fa-sign-out" aria-hidden="true"></i>
					{{ __('Logout') }}
				</a>

				<div class="dropdown-divider"></div>
			</li>
		</ul>
	</div>
</nav>