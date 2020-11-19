<nav class="col-md-3 col-lg-2 d-none d-md-block bg-light sidebar">
	<div class="sidebar-sticky">
		<h5 class="ml-3 mt-3">Sección seguros</h5>
		<ul class="nav flex-column border-bottom mb-3">
			<li class="nav-item">
				<a class="nav-link <?php if(isset($_GET['c']) && $controller == 'polizas'): ?>active<?php endif;?>" href="<?=DOMAIN?>?c=polizas">
					
					<img src="<?=ASSETS?>img/icon-menu.svg" alt="">
					Polizas
				</a>
			</li>

			<li class="nav-item">
				<a class="nav-link <?php if(isset($_GET['c']) && $controller == 'seguros'): ?>active<?php endif;?>" href="<?=DOMAIN?>?c=seguros">
					
					<img src="<?=ASSETS?>img/icon-menu.svg" alt="">
					Seguros
				</a>
			</li>

			<li class="nav-item">
				<a class="nav-link <?php if(isset($_GET['c']) && $controller == 'extras'): ?>active<?php endif;?>" href="<?=DOMAIN?>?c=extras">
					
					<img src="<?=ASSETS?>img/icon-menu.svg" alt="">
					Extras
				</a>
			</li>

			<li class="nav-item ">
				<a class="nav-link <?php if(isset($_GET['c']) && $controller == 'deducibles'): ?>active<?php endif;?>" href="<?=DOMAIN?>?c=deducibles">
					
					<img src="<?=ASSETS?>img/icon-menu.svg" alt="">
					Deducibles
				</a>
			</li>
		</ul>

		<h5 class="ml-3 mt-3">Sección cliente</h5>

		<ul class="nav flex-column">
			<li class="nav-item">
				<a class="nav-link <?php if(isset($_GET['c']) && $controller == 'clientes'): ?>active<?php endif;?>" href="<?=DOMAIN?>?c=clientes">
					
					<img src="<?=ASSETS?>img/icon-menu.svg" alt="">
					Clientes
				</a>
			</li>

			<li class="nav-item">
				<a class="nav-link <?php if(isset($_GET['c']) && $controller == 'condiciones'): ?>active<?php endif;?>" href="<?=DOMAIN?>?c=condiciones">
					
					<img src="<?=ASSETS?>img/icon-menu.svg" alt="">
					Condiciones
				</a>
			</li>

			<li class="nav-item">
				<a class="nav-link <?php if(isset($_GET['c']) && $controller == 'materialesConstruccion'): ?>active<?php endif;?>" href="<?=DOMAIN?>?c=materialesConstruccion">
					
					<img src="<?=ASSETS?>img/icon-menu.svg" alt="">
					Materiales construcción
				</a>
			</li>

			<li class="nav-item">
				<a class="nav-link <?php if(isset($_GET['c']) && $controller == 'tiposInmuebles'): ?>active<?php endif;?>" href="<?=DOMAIN?>?c=tiposInmuebles">
					
					<img src="<?=ASSETS?>img/icon-menu.svg" alt="">
					Tipos inmuebles
				</a>
			</li>

			<li class="nav-item">
				<a class="nav-link <?php if(isset($_GET['c']) && $controller == 'inmuebles'): ?>active<?php endif;?>" href="<?=DOMAIN?>?c=inmuebles">
					
					<img src="<?=ASSETS?>img/icon-menu.svg" alt="">
					Inmuebles
				</a>
			</li>

			<li class="nav-item border-bottom">
				<a class="nav-link <?php if(isset($_GET['c']) && $controller == 'inmueblesMateriales'): ?>active<?php endif;?>" href="<?=DOMAIN?>?c=inmueblesMateriales">
					
					<img src="<?=ASSETS?>img/icon-menu.svg" alt="">
					Inmueble materiales
				</a>
			</li>
		</ul>
	</div>
</nav>