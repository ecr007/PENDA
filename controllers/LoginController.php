<?php

	if (isLogin()) {
		irA(DOMAIN."?c=polizas");
	}
	
	$success = [];
	$errors = [];

	$controllerTitle = 'Iniciar sesión';
	$controller = 'login';


	// Default action
	if (!isset($_GET['action'])) {
		$view = 'login.php';
	}
	elseif(isset($_GET['action']) && $_GET['action'] == 'login'){
		if (isset($_POST['usuario'],$_POST['pass'])) {

			if(empty(trim($_POST['usuario']))) array_push($errors, "Por favor escribir el nombre de usuario.");
			if(empty(trim($_POST['pass']))) array_push($errors, "Por favor escribir la contraseña.");

			if (count($errors) == 0) {		

				$send = $db->getUser($_POST['usuario'],$_POST['pass'],1);

				if ($send) {
					$_SESSION['login'] = $send;

					irA(DOMAIN."?c=polizas");
				}else{
					array_push($errors, "El usuario no existe.");

					setErrors($errors);
				}
			}else{

				setErrors($errors);
			}		
		}else{
			array_push($errors, "Todos los campos son requeridos.");

			setErrors($errors);
		}

		irA(DOMAIN."?c=login");
	}
	else{
		irA(DOMAIN."?c=error");
	}