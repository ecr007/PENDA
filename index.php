<?php

	require_once $_SERVER['DOCUMENT_ROOT'].'/config.php';
	
	$title = TITLE;

	// SET CONTROLLER

	$allowController = [
		'polizas',
		'seguros',
		'extras',
		'deducibles',
		'clientes',
		'condiciones',
		'materialesConstruccion',
		'tiposInmuebles',
		'inmuebles',
		'inmueblesMateriales',
		'login',
		'salir',
	];

	$controller = '';


	if (isset($_GET['c']) && in_array($_GET['c'], $allowController)) {
		include ROOT.DS.'controllers'.DS.ucfirst($_GET['c']).'Controller.php';
	}else{
		include ROOT.DS.'controllers'.DS.'LoginController.php';
	}

	include ROOT.DS.'views/master.php';
