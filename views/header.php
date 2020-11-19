<nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
	<a class="navbar-brand col-sm-12 col-md-3 col-lg-2 mr-0" href="<?=DOMAIN?>/?c=negocios"><?=TITLE?></a>

	<ul class="navbar-nav px-3">
		<li class="nav-item d-block d-sm-block d-md-none">
			<a class="nav-link <?php if(isset($_GET['c']) && $controller == 'negocios' && !isset($_GET['action'])): ?>active<?php endif;?>" href="<?=DOMAIN?>?c=negocios">
				Negocios
			</a>
		</li>

		<li class="nav-item d-block d-sm-block d-md-none">
			<a class="nav-link <?php if(isset($_GET['c']) && $controller == 'negocios' && isset($_GET['action']) && ($_GET['action'] == 'new' || $_GET['action'] == 'edit' ) ): ?>active<?php endif;?>" href="<?=DOMAIN?>?c=negocios&action=new">
				Agregar negocio
			</a>
		</li>

		<li class="nav-item d-block d-sm-block d-md-none">
			<a class="nav-link <?php if(isset($_GET['c']) && $controller == 'cuentas' && !isset($_GET['action'])): ?>active<?php endif;?>" href="<?=DOMAIN?>?c=cuentas">
				Cuentas
			</a>
		</li>

		<li class="nav-item d-block d-sm-block d-md-none">
			<a class="nav-link <?php if(isset($_GET['c']) && $controller == 'cuentas' && isset($_GET['action']) && ($_GET['action'] == 'new' || $_GET['action'] == 'edit' ) ): ?>active<?php endif;?>" href="<?=DOMAIN?>?c=cuentas&action=new">
				Agregar cuenta
			</a>
		</li>

		<li class="nav-item text-nowrap">
			<a class="nav-link" href="<?=DOMAIN?>?c=salir">Cerrar sesión</a>
		</li>
	</ul>
</nav>