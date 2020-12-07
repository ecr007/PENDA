<div class="page-sidebar-wrapper">
		<div class="page-sidebar navbar-collapse collapse">
			<ul class="page-sidebar-menu">
				<li class="sidebar-toggler-wrapper">
					<div class="sidebar-toggler"></div>
					<div class="clearfix"></div>
				</li>

				<li class="start @if($current == "dashboard") active @endif">
					<a href="{{route('dashboard')}}">
						<i class="fa fa-cogs"></i>
						<span class="title">Dashboard</span>
					</a>
				</li>
			</ul>
		</div>
	</div>