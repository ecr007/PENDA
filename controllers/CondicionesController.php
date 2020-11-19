<?php

	if (!isLogin()) {
		irA(DOMAIN."?c=login");
	}
	
	$success = [];
	$errors = [];

	$controllerTitle = 'Condiciones';
	$controller = 'condiciones';


	// Default action
	if (!isset($_GET['action'])) {

		$info = $db->getCondiciones();

		if ($info == false) {
			array_push($errors, "Aun no hay condiciones registradas.");
			setErrors($errors);
		}

		$view = 'condiciones.php';
	}
	elseif(isset($_GET['action']) && $_GET['action'] == 'new'){
		$view = 'new-condiciones.php';
	}
	elseif(isset($_GET['action']) && $_GET['action'] == 'insert'){

		$name = trim($_POST['ecr-nombre']);

		if (empty($name)) array_push($errors, "Nombre es requerido.");

		if (count($errors) == 0) {

			$res = $db->insertCondiciones($name);

			if ($res != false) {
				
				array_push($success, "Condición insertada satisfactoriamente.");
				setSuccess($success);
			}else{
				array_push($errors, "Lo sentimos, no se pudo insertar la condición.");
				setErrors($errors);
			}
		}else{

			setErrors($errors);
		}

		irA(DOMAIN."?c=".$controller."&action=new");
	}
	elseif(isset($_GET['action']) && $_GET['action'] == 'disable'){

		$id = trim($_GET['id']);

		//$info = $db->getCondiciones(null,$id);

		if ($info == false) {
			array_push($errors, "No existe cuenta con el ID proporcionado.");
			setErrors($errors);
		}else{

			if($db->status("user",$info->id,0)){

				array_push($success, "Cuenta desactivada satisfactoriamente.");
				setSuccess($success);

			}else{
				array_push($errors, "No se pudo desactivar el condición.");
				setErrors($errors);
			}
		}

		irA(DOMAIN."?c=".$controller);
	}
	elseif(isset($_GET['action']) && $_GET['action'] == 'enable'){

		$id = trim($_GET['id']);

		$info = $db->getCondiciones(null,$id);

		if ($info == false) {
			array_push($errors, "No existe cuenta con el ID proporcionado.");
			setErrors($errors);
		}else{

			if($db->status("user",$info->id,1)){

				array_push($success, "Cuenta activada satisfactoriamente.");
				setSuccess($success);

			}else{
				array_push($errors, "No se pudo activar el condición.");
				setErrors($errors);
			}
		}

		irA(DOMAIN."?c=".$controller);
	}
	elseif(isset($_GET['action']) && $_GET['action'] == 'delete'){

		$id = trim($_GET['id']);

		if($db->delete("condiciones",$id)){

			array_push($success, "Condición eliminada satisfactoriamente.");
			setSuccess($success);
		}else{
			array_push($errors, "No se pudo eliminar la condición.");
			setErrors($errors);
		}

		irA(DOMAIN."?c=".$controller);
	}
	elseif(isset($_GET['action']) && $_GET['action'] == 'edit'){

		$id = trim($_GET['id']);

		$info = $db->getCondiciones($id);

		if ($info == false) {
			array_push($errors, "No existe condición con el ID proporcionado.");
			setErrors($errors);

			irA(DOMAIN."?c=".$controller);
		}else{
			
			$view = 'edit-condiciones.php';			
		}
	}
	elseif(isset($_GET['action']) && $_GET['action'] == 'update'){

		$id = $_GET['id'];

		$name = trim($_POST['ecr-nombre']);

		if (empty($name)) array_push($errors, "Nombre es requerido.");

		$get = $db->getCondiciones($id);

		if ($get == false) array_push($errors, "La condición seleccionada no es valida.");

		if (count($errors) == 0) {

			$update = $db->updateCondiciones($id,$name);

			if ($update) {
				array_push($success, "Condición actualizada satisfactoriamente.");
				setSuccess($success);
			}else{
				array_push($errors, "Lo sentimos, no se pudo actualizar el condición.");
				setErrors($errors);
			}
		}else{
			setErrors($errors);
		}

		irA(DOMAIN."?c=".$controller."&action=edit&id=".$id);
	}	
	else{
		irA(DOMAIN."?c=error");
	}