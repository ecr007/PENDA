<li class="nav-item">
	<a class="nav-link @if($current == 'dashboard') active @endif" href="{{route('dashboard')}}">
		<i class="fa fa-tachometer" aria-hidden="true"></i>
		Dashboard
	</a>

	<div class="dropdown-divider"></div>
</li>

@if(Auth::user()->verifyRoles('administrator'))
	<li class="nav-item">
		<a class="nav-link @if($current == 'companies') active @endif" href="{{route('companies')}}">
			<i class="fa fa-building" aria-hidden="true"></i>
			Companies
		</a>

		<div class="dropdown-divider"></div>
	</li>

	<li class="nav-item">
		<a class="nav-link @if($current == 'venues') active @endif" href="{{route('venues')}}">
			<i class="fa fa-map-marker" aria-hidden="true"></i>
			Venues
		</a>

		<div class="dropdown-divider"></div>
	</li>
@endif

@if(Auth::user()->verifyRoles(['administrator','organizer','organizer-staff','gathr-admin','gathr-production','speaker']))
	<li class="nav-item">
		<a class="nav-link @if($current == 'events') active @endif" href="{{route('events')}}">
			<i class="fa fa-calendar" aria-hidden="true"></i>
			Events
		</a>

		<div class="dropdown-divider"></div>
	</li>
@endif

@if(Auth::user()->verifyRoles('administrator'))
	<li class="nav-item">
		<a class="nav-link @if($current == 'emails') active @endif" href="{{route('emails')}}">
			<i class="fa fa-envelope-o" aria-hidden="true"></i>
			Emails
		</a>

		<div class="dropdown-divider"></div>
	</li>

	<li class="nav-item">
		<a class="nav-link @if($current == 'parameters') active @endif" href="{{route('parameters')}}">
			<i class="fa fa-filter" aria-hidden="true"></i>
			Parameters
		</a>

		<div class="dropdown-divider"></div>
	</li>

	<li class="nav-item">
		<a class="nav-link @if($current == 'skins') active @endif" href="{{route('skins')}}">
			<i class="fa fa-asterisk" aria-hidden="true"></i>
			Skins
		</a>

		<div class="dropdown-divider"></div>
	</li>

	<li class="nav-item">
		<a class="nav-link @if($current == 'platforms') active @endif" href="{{route('view-platforms')}}">
			<i class="fa fa-desktop" aria-hidden="true"></i>
			Platforms
		</a>

		<div class="dropdown-divider"></div>
	</li>
	
	<li class="nav-item">
		<a class="nav-link @if($current == 'aliasesevent') active @endif" href="{{route('aliasesevent')}}">
			<i class="fa fa-server" aria-hidden="true"></i>
			GameLift Aliases
		</a>

		<div class="dropdown-divider"></div>
	</li>

	<li class="nav-item">
		<a class="nav-link @if($current == 'users') active @endif" href="{{route('users')}}">
			<i class="fa fa-users" aria-hidden="true"></i>
			Users
		</a>

		<div class="dropdown-divider"></div>
	</li>
@endif