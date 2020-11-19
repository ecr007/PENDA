<!doctype html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title><?=$title?> - <?=$controllerTitle?></title>
	
	<link rel="stylesheet" href="<?=ASSETS?>/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?=ASSETS?>/css/font-awesome.min.css">
	
	<?php if (!isLogin()): ?>
		<link rel="stylesheet" href="<?=ASSETS?>/css/signin.css">
	<?php else: ?>
		<link rel="stylesheet" href="<?=ASSETS?>/css/dashboard.css">
	<?php endif ?>

	
	<link rel="stylesheet" href="<?=ASSETS?>/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" href="<?=ASSETS?>/css/style.css">

	<link rel="apple-touch-icon" sizes="57x57" href="<?=ASSETS?>/icon/apple-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="<?=ASSETS?>/icon/apple-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="<?=ASSETS?>/icon/apple-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="<?=ASSETS?>/icon/apple-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="<?=ASSETS?>/icon/apple-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="<?=ASSETS?>/icon/apple-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="<?=ASSETS?>/icon/apple-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="<?=ASSETS?>/icon/apple-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="<?=ASSETS?>/icon/apple-icon-180x180.png">
	<link rel="icon" type="image/png" sizes="192x192"  href="<?=ASSETS?>/icon/android-icon-192x192.png">
	<link rel="icon" type="image/png" sizes="32x32" href="<?=ASSETS?>/icon/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="96x96" href="<?=ASSETS?>/icon/favicon-96x96.png">
	<link rel="icon" type="image/png" sizes="16x16" href="<?=ASSETS?>/icon/favicon-16x16.png">
	<link rel="manifest" href="<?=ASSETS?>/icon/manifest.json">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="<?=ASSETS?>/icon/ms-icon-144x144.png">
	<meta name="theme-color" content="#ffffff">
</head>

<body>
	
	<?php if (isLogin()): ?>
			
		<?php include VIEWS.DS.'header.php'; ?>

		<div class="container-fluid">
			<div class="row">
				<?php include VIEWS.DS.'menu.php'; ?>

				<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
					
					
					<div class="pt-4">
						<span class="h2 display-6  pb-2 mb-4"><?=$controllerTitle?></span>
						
						<?php if (!isset($_GET['action'])): ?>
							<a href="<?=DOMAIN?>?c=<?=$controller?>&action=new" class="btn btn-success float-right">Agregar <?=$controllerTitle?></a>
						<?php endif ?>

					</div>

					<div style="clear: both;"></div>

					<hr>

					<?php include VIEWS.DS.'alerts.php'; ?>

					<?php include VIEWS.DS.$view; ?>
				</main>
			</div>
		</div>
	<?php else: ?>
		<?php include VIEWS.DS.$view; ?>
	<?php endif; ?>

	<script>
		window.URL = '<?=DOMAIN?>';
	</script>
	<script src="<?=ASSETS?>/js/jquery.js"></script>
	<script src="<?=ASSETS?>/js/bootstrap.min.js"></script>
	<script src="<?=ASSETS?>/js/jquery.dataTables.min.js"></script>
	<script src="<?=ASSETS?>/js/dataTables.bootstrap4.min.js"></script>
	<script src="<?=ASSETS?>/js/functions.js"></script>
</body>
</html>