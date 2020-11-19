<?php

	//clear session from globals
	$_SESSION = array();
	//clear session from disk
	session_destroy();

	irA(DOMAIN);