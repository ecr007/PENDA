<?php

	if (!isLogin()) {
		irA(DOMAIN."?c=login");
	}
	
	$success = [];
	$errors = [];

	$controllerTitle = 'Calles';
	$controller = 'calles';


	// Default action
	if (!isset($_GET['action'])) {

		$info = $db->getCalles();

		if ($info == false) {
			array_push($errors, "Aun no hay calles registradas.");
			setErrors($errors);
		}

		$view = 'calles.php';
	}
	elseif(isset($_GET['action']) && $_GET['action'] == 'new'){
		$municipios = $db->getMunicipios();

		$view = 'new-calles.php';
	}
	elseif(isset($_GET['action']) && $_GET['action'] == 'insert'){

		$name = trim($_POST['ecr-nombre']);
		$sector = trim($_POST['ecr-sectores']);

		if (empty($name)) array_push($errors, "Nombre es requerido.");
		if (empty($sector)) array_push($errors, "Sector es requerido.");

		if (count($errors) == 0) {

			$res = $db->insertCalles($name,$sector);

			if ($res != false) {
				
				array_push($success, "Calle insertada satisfactoriamente.");
				setSuccess($success);
			}else{
				array_push($errors, "Lo sentimos, no se pudo insertar la calle.");
				setErrors($errors);
			}
		}else{

			setErrors($errors);
		}

		irA(DOMAIN."?c=".$controller."&action=new");
	}
	elseif(isset($_GET['action']) && $_GET['action'] == 'disable'){

		$id = trim($_GET['id']);

		//$info = $db->getCalles(null,$id);

		if ($info == false) {
			array_push($errors, "No existe cuenta con el ID proporcionado.");
			setErrors($errors);
		}else{

			if($db->status("user",$info->id,0)){

				array_push($success, "Cuenta desactivada satisfactoriamente.");
				setSuccess($success);

			}else{
				array_push($errors, "No se pudo desactivar el calle.");
				setErrors($errors);
			}
		}

		irA(DOMAIN."?c=".$controller);
	}
	elseif(isset($_GET['action']) && $_GET['action'] == 'enable'){

		$id = trim($_GET['id']);

		$info = $db->getCalles(null,$id);

		if ($info == false) {
			array_push($errors, "No existe cuenta con el ID proporcionado.");
			setErrors($errors);
		}else{

			if($db->status("user",$info->id,1)){

				array_push($success, "Cuenta activada satisfactoriamente.");
				setSuccess($success);

			}else{
				array_push($errors, "No se pudo activar el calle.");
				setErrors($errors);
			}
		}

		irA(DOMAIN."?c=".$controller);
	}
	elseif(isset($_GET['action']) && $_GET['action'] == 'delete'){

		$id = trim($_GET['id']);

		if($db->delete("calles",$id)){

			array_push($success, "Calle eliminada satisfactoriamente.");
			setSuccess($success);
		}else{
			array_push($errors, "No se pudo eliminar la calle.");
			setErrors($errors);
		}

		irA(DOMAIN."?c=".$controller);
	}
	elseif(isset($_GET['action']) && $_GET['action'] == 'edit'){

		$id = trim($_GET['id']);

		$info = $db->getCalles($id);

		if ($info == false) {
			array_push($errors, "No existe calle con el ID proporcionado.");
			setErrors($errors);

			irA(DOMAIN."?c=".$controller);
		}else{

			$municipios = $db->getMunicipios();
			$sectores = $db->getSectores(null,$info->id_municipio);
			
			$view = 'edit-calles.php';			
		}
	}
	elseif(isset($_GET['action']) && $_GET['action'] == 'update'){

		$id = $_GET['id'];

		$name = trim($_POST['ecr-nombre']);
		$sector = trim($_POST['ecr-sectores']);

		if (empty($name)) array_push($errors, "Nombre es requerido.");
		if (empty($sector)) array_push($errors, "Sector es requerido.");

		$get = $db->getCalles($id);

		if ($get == false) array_push($errors, "La calle seleccionada no es valida.");

		if (count($errors) == 0) {

			$update = $db->updateCalles($id,$name,$sector);

			if ($update) {
				array_push($success, "Calle actualizada satisfactoriamente.");
				setSuccess($success);
			}else{
				array_push($errors, "Lo sentimos, no se pudo actualizar el calle.");
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