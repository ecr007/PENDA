<?php

	if (!isLogin()) {
		irA(DOMAIN."?c=login");
	}
	
	$success = [];
	$errors = [];

	$controllerTitle = 'TiposTelefonos';
	$controller = 'tipos_telefonos';


	// Default action
	if (!isset($_GET['action'])) {

		$info = $db->getTiposTelefonos();

		if ($info == false) {
			array_push($errors, "Aun no hay tipos de telefonos registrados.");
			setErrors($errors);
		}

		$view = 'tipos_telefonos.php';
	}
	elseif(isset($_GET['action']) && $_GET['action'] == 'new'){
		$view = 'new-tipos_telefonos.php';
	}
	elseif(isset($_GET['action']) && $_GET['action'] == 'insert'){

		$name = trim($_POST['ecr-nombre']);

		if (empty($name)) array_push($errors, "Nombre es requerido.");

		if (count($errors) == 0) {

			$res = $db->insertTiposTelefonos($name);

			if ($res != false) {
				
				array_push($success, "Tipo telefono insertado satisfactoriamente.");
				setSuccess($success);
			}else{
				array_push($errors, "Lo sentimos, no se pudo insertar el tipo telefono.");
				setErrors($errors);
			}
		}else{

			setErrors($errors);
		}

		irA(DOMAIN."?c=".$controller."&action=new");
	}
	elseif(isset($_GET['action']) && $_GET['action'] == 'disable'){

		$id = trim($_GET['id']);

		//$info = $db->getTiposTelefonos(null,$id);

		if ($info == false) {
			array_push($errors, "No existe cuenta con el ID proporcionado.");
			setErrors($errors);
		}else{

			if($db->status("user",$info->id,0)){

				array_push($success, "Tipo telefono desactivado satisfactoriamente.");
				setSuccess($success);

			}else{
				array_push($errors, "No se pudo desactivar el tipo telefono.");
				setErrors($errors);
			}
		}

		irA(DOMAIN."?c=".$controller);
	}
	elseif(isset($_GET['action']) && $_GET['action'] == 'enable'){

		$id = trim($_GET['id']);

		$info = $db->getTiposTelefonos(null,$id);

		if ($info == false) {
			array_push($errors, "No existe cuenta con el ID proporcionado.");
			setErrors($errors);
		}else{

			if($db->status("user",$info->id,1)){

				array_push($success, "Tipo telefono activada satisfactoriamente.");
				setSuccess($success);

			}else{
				array_push($errors, "No se pudo activar el tipo telefono.");
				setErrors($errors);
			}
		}

		irA(DOMAIN."?c=".$controller);
	}
	elseif(isset($_GET['action']) && $_GET['action'] == 'delete'){

		$id = trim($_GET['id']);

		if($db->delete("tipos_telefonos",$id)){

			array_push($success, "Tipo telefono eliminado satisfactoriamente.");
			setSuccess($success);
		}else{
			array_push($errors, "No se pudo eliminar el tipo telefono.");
			setErrors($errors);
		}

		irA(DOMAIN."?c=".$controller);
	}
	elseif(isset($_GET['action']) && $_GET['action'] == 'edit'){

		$id = trim($_GET['id']);

		$info = $db->getTiposTelefonos($id);

		if ($info == false) {
			array_push($errors, "No existe tipo telefono con el ID proporcionado.");
			setErrors($errors);

			irA(DOMAIN."?c=".$controller);
		}else{
			
			$view = 'edit-tipos_telefonos.php';			
		}
	}
	elseif(isset($_GET['action']) && $_GET['action'] == 'update'){

		$id = $_GET['id'];

		$name = trim($_POST['ecr-nombre']);

		if (empty($name)) array_push($errors, "Nombre es requerido.");

		$get = $db->getTiposTelefonos($id);

		if ($get == false) array_push($errors, "El tipo telefono seleccionado no es valido.");

		if (count($errors) == 0) {

			$update = $db->updateTiposTelefonos($id,$name);

			if ($update) {
				array_push($success, "Tipo telefono actualizado satisfactoriamente.");
				setSuccess($success);
			}else{
				array_push($errors, "Lo sentimos, no se pudo actualizar el tipo telefono.");
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