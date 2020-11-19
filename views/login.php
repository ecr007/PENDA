<div class="text-center" style="width: 100%;">
	
	<form class="form-signin" action="<?=DOMAIN?>?c=login&action=login" method="post">
		<img class="img-fluid" src="<?=ASSETS?>/img/logo-jardin.png" alt="">

		<h1 class="h3 mb-3 font-weight-normal"><?=TITLE?></h1>
		
		<?php include VIEWS.DS.'alerts.php'; ?>

		<label for="ecr-email" class="sr-only">Correo electrónico:</label>
		<input type="email" name="usuario" id="ecr-email" class="form-control" placeholder="Correo electrónico" required="" autofocus="">
		
		<label for="ecr-pass" class="sr-only">Contraseña:</label>
		<input type="password" name="pass" id="ecr-pass" class="form-control" placeholder="Contraseña" required="">

		<button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
		
		<p class="mt-5 mb-3 text-muted">© <?=TITLE.' '.date("Y").'<br> '.VERSION?></p>
	</form>
</div>
