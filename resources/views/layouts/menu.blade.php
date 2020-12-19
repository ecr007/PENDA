<div class="page-sidebar-wrapper">
		<div class="page-sidebar navbar-collapse collapse">
			<ul class="page-sidebar-menu">
				<li class="sidebar-toggler-wrapper">
					<div class="sidebar-toggler"></div>
					<div class="clearfix"></div>
				</li>

				<li class="start @if($current == "transacciones") active @endif">
					<a href="{{route('transacciones')}}">
						<i class="fa fa-line-chart"></i>
						<span class="title">Transacciones</span>
					</a>
				</li>

				<li class="start @if($current == "socios") active @endif">
					<a href="{{route('socios')}}">
						<i class="fa fa-users"></i>
						<span class="title">Socios</span>
					</a>
				</li>

				<li class="start @if($current == "cuentas") active @endif">
					<a href="{{route('cuentas')}}">
						<i class="fa fa-address-book-o"></i>
						<span class="title">Cuentas</span>
					</a>
				</li>

				<li class="start @if($current == "prestamos") active @endif">
					<a href="{{route('prestamos')}}">
						<i class="fa fa-money"></i>
						<span class="title">Prestamos</span>
					</a>
				</li>

				<li class="start @if($current == "tipotransacciones") active @endif">
					<a href="{{route('tipos-transacciones')}}">
						<i class="fa fa-pie-chart"></i>
						<span class="title">Tipo Transacciones</span>
					</a>
				</li>
			</ul>
		</div>
	</div>