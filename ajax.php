<?php

	require_once $_SERVER['DOCUMENT_ROOT'].'/config.php';

	if( isset($_REQUEST['action']))	{
		$function = $_REQUEST['action'];
		$function ($_REQUEST);

		exit();
	}