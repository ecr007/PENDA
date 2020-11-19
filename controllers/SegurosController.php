<?php

	if (!isLogin()) {
		irA(DOMAIN."?c=login");
	}
	
	$success = [];
	$errors = [];

	$controllerTitle = 'Seguros';
	$controller = 'seguros';


	// Default action
	if (!isset($_GET['action'])) {

		$info = $db->getSeguros();

		if ($info == false) {
			array_push($errors, "Aun no hay seguros registrados.");
			setErrors($errors);
		}

		$view = 'seguros.php';
	}
	elseif(isset($_GET['action']) && $_GET['action'] == 'new'){
		$view = 'new-seguros.php';
	}
	elseif(isset($_GET['action']) && $_GET['action'] == 'insert'){

		$name = trim($_POST['ecr-nombre']);
		$costo = trim($_POST['ecr-costo']);
		$informacion = trim($_POST['ecr-informacion']);

		if (empty($name)) array_push($errors, "Nombre es requerido.");
		if (empty($costo)) array_push($errors, "Costo es requerido.");
		if (empty($informacion)) array_push($errors, "Información es requerido.");

		if (count($errors) == 0) {

			$res = $db->insertSeguros($name,$costo,$informacion);

			if ($res != false) {
				
				array_push($success, "Seguro insertado satisfactoriamente.");
				setSuccess($success);
			}else{
				array_push($errors, "Lo sentimos, no se pudo insertar el seguro.");
				setErrors($errors);
			}
		}else{

			setErrors($errors);
		}

		irA(DOMAIN."?c=".$controller."&action=new");
	}
	elseif(isset($_GET['action']) && $_GET['action'] == 'disable'){

		$id = trim($_GET['id']);

		//$info = $db->getSeguros(null,$id);

		if ($info == false) {
			array_push($errors, "No existe cuenta con el ID proporcionado.");
			setErrors($errors);
		}else{

			if($db->status("user",$info->id,0)){

				array_push($success, "Cuenta desactivada satisfactoriamente.");
				setSuccess($success);

			}else{
				array_push($errors, "No se pudo desactivar el seguro.");
				setErrors($errors);
			}
		}

		irA(DOMAIN."?c=".$controller);
	}
	elseif(isset($_GET['action']) && $_GET['action'] == 'enable'){

		$id = trim($_GET['id']);

		$info = $db->getSeguros(null,$id);

		if ($info == false) {
			array_push($errors, "No existe cuenta con el ID proporcionado.");
			setErrors($errors);
		}else{

			if($db->status("user",$info->id,1)){

				array_push($success, "Cuenta activada satisfactoriamente.");
				setSuccess($success);

			}else{
				array_push($errors, "No se pudo activar el seguro.");
				setErrors($errors);
			}
		}

		irA(DOMAIN."?c=".$controller);
	}
	elseif(isset($_GET['action']) && $_GET['action'] == 'delete'){

		$id = trim($_GET['id']);

		if($db->delete("seguros",$id)){

			array_push($success, "Seguro eliminado satisfactoriamente.");
			setSuccess($success);
		}else{
			array_push($errors, "No se pudo eliminar el seguro.");
			setErrors($errors);
		}

		irA(DOMAIN."?c=".$controller);
	}
	elseif(isset($_GET['action']) && $_GET['action'] == 'edit'){

		$id = trim($_GET['id']);

		$info = $db->getSeguros($id);

		if ($info == false) {
			array_push($errors, "No existe seguro con el ID proporcionado.");
			setErrors($errors);

			irA(DOMAIN."?c=".$controller);
		}else{
			
			$view = 'edit-seguros.php';			
		}
	}
	elseif(isset($_GET['action']) && $_GET['action'] == 'update'){

		$id = $_GET['id'];

		$name = trim($_POST['ecr-nombre']);
		$costo = trim($_POST['ecr-costo']);
		$informacion = trim($_POST['ecr-informacion']);

		if (empty($name)) array_push($errors, "Nombre es requerido.");
		if (empty($costo)) array_push($errors, "Costo es requerido.");
		if (empty($informacion)) array_push($errors, "Información es requerido.");

		$get = $db->getSeguros($id);

		if ($get == false) array_push($errors, "El seguro seleccionado no es valido.");

		if (count($errors) == 0) {

			$update = $db->updateSeguros($id,$name,$costo,$informacion);

			if ($update) {
				array_push($success, "Seguro actualizado satisfactoriamente.");
				setSuccess($success);
			}else{
				array_push($errors, "Lo sentimos, no se pudo actualizar el seguro.");
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