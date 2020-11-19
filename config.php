<?php
	session_start();

	ini_set('display_errors',1);
	ini_set('display_startup_errors',1);
	error_reporting(0);

	ini_set('date.timezone','America/Santo_Domingo');

	define('VERSION', 'v1.0');
	define('TITLE', 'Aseguradora Bello Jardín');
	define('URL', 'bellojardin.lc');

	define('DBHOST', 'localhost');
	define('DBUSER', 'root');
	define('DBPASS', 'PASS');
	define('DBNAME', 'bellojardin');
	
	define('KEY', 'bellojardin34996@');

	define('ROOT', $_SERVER['DOCUMENT_ROOT']);
	define('DOMAIN', (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://".$_SERVER['HTTP_HOST']);
	define('DS', '/');	
	define('VIEWS', ROOT.DS.'views');
	define('ASSETS', DOMAIN.'/assets');

	require_once ROOT.DS.'vendor/autoload.php';
	require_once ROOT.DS.'functions.php';
	require_once ROOT.DS.'models/model.php';
	require_once ROOT.DS.'libs/BreakeDate.php';

	$db = new Model(DBHOST,DBNAME,DBUSER,DBPASS);

	// Create First user
	// $db->insertUser("","","","admin",1,"admin",1);