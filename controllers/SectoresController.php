<?php

	if (!isLogin()) {
		irA(DOMAIN."?c=login");
	}
	
	$success = [];
	$errors = [];

	$controllerTitle = 'Sectores';
	$controller = 'sectores';


	// Default action
	if (!isset($_GET['action'])) {

		$info = $db->getSectores();

		if ($info == false) {
			array_push($errors, "Aun no hay sectores registrados.");
			setErrors($errors);
		}

		$view = 'sectores.php';
	}
	elseif(isset($_GET['action']) && $_GET['action'] == 'new'){
		
		$municipios = $db->getMunicipios();

		$view = 'new-sectores.php';
	}
	elseif(isset($_GET['action']) && $_GET['action'] == 'insert'){

		$name = trim($_POST['ecr-nombre']);
		$municipio = trim($_POST['ecr-municipio']);

		if (empty($name)) array_push($errors, "Nombre es requerido.");
		if (empty($municipio)) array_push($errors, "Municipio es requerido.");

		if (count($errors) == 0) {

			$res = $db->insertSectores($name,$municipio);

			if ($res != false) {
				
				array_push($success, "Sector insertado satisfactoriamente.");
				setSuccess($success);
			}else{
				array_push($errors, "Lo sentimos, no se pudo insertar el sector.");
				setErrors($errors);
			}
		}else{

			setErrors($errors);
		}

		irA(DOMAIN."?c=".$controller."&action=new");
	}
	elseif(isset($_GET['action']) && $_GET['action'] == 'disable'){

		$id = trim($_GET['id']);

		//$info = $db->getSectores(null,$id);

		if ($info == false) {
			array_push($errors, "No existe cuenta con el ID proporcionado.");
			setErrors($errors);
		}else{

			if($db->status("user",$info->id,0)){

				array_push($success, "Cuenta desactivada satisfactoriamente.");
				setSuccess($success);

			}else{
				array_push($errors, "No se pudo desactivar el sector.");
				setErrors($errors);
			}
		}

		irA(DOMAIN."?c=".$controller);
	}
	elseif(isset($_GET['action']) && $_GET['action'] == 'enable'){

		$id = trim($_GET['id']);

		$info = $db->getSectores(null,$id);

		if ($info == false) {
			array_push($errors, "No existe cuenta con el ID proporcionado.");
			setErrors($errors);
		}else{

			if($db->status("user",$info->id,1)){

				array_push($success, "Cuenta activada satisfactoriamente.");
				setSuccess($success);

			}else{
				array_push($errors, "No se pudo activar el sector.");
				setErrors($errors);
			}
		}

		irA(DOMAIN."?c=".$controller);
	}
	elseif(isset($_GET['action']) && $_GET['action'] == 'delete'){

		$id = trim($_GET['id']);

		if($db->delete("sectores",$id)){

			array_push($success, "Sector eliminado satisfactoriamente.");
			setSuccess($success);
		}else{
			array_push($errors, "No se pudo eliminar el sector.");
			setErrors($errors);
		}

		irA(DOMAIN."?c=".$controller);
	}
	elseif(isset($_GET['action']) && $_GET['action'] == 'edit'){

		$id = trim($_GET['id']);

		$info = $db->getSectores($id);

		if ($info == false) {
			array_push($errors, "No existe sector con el ID proporcionado.");
			setErrors($errors);

			irA(DOMAIN."?c=".$controller);
		}else{
			$municipios = $db->getMunicipios();
			
			$view = 'edit-sectores.php';			
		}
	}
	elseif(isset($_GET['action']) && $_GET['action'] == 'update'){

		$id = $_GET['id'];

		$name = trim($_POST['ecr-nombre']);
		$municipio = trim($_POST['ecr-municipio']);

		if (empty($name)) array_push($errors, "Nombre es requerido.");
		if (empty($municipio)) array_push($errors, "Municipio es requerido.");

		$get = $db->getSectores($id);

		if ($get == false) array_push($errors, "El sector seleccionado no es valido.");

		if (count($errors) == 0) {

			$update = $db->updateSectores($id,$name,$municipio);

			if ($update) {
				array_push($success, "Sector actualizado satisfactoriamente.");
				setSuccess($success);
			}else{
				array_push($errors, "Lo sentimos, no se pudo actualizar el sector.");
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