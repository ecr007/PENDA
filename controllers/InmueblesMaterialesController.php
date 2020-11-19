<?php

	if (!isLogin()) {
		irA(DOMAIN."?c=login");
	}
	
	$success = [];
	$errors = [];

	$controllerTitle = 'Inmuebles materiales';
	$controller = 'inmueblesMateriales';


	// Default action
	if (!isset($_GET['action'])) {

		$info = $db->getInmueblesMateriales();

		if ($info == false) {
			array_push($errors, "Aun no hay inmuebles materiales registrados.");
			setErrors($errors);
		}

		$view = 'inmuebles_materiales.php';
	}
	elseif(isset($_GET['action']) && $_GET['action'] == 'new'){

		$inmuebles = $db->getInmuebles();
		$materiales = $db->getMaterialesConstruccion();

		$view = 'new-inmuebles_materiales.php';
	}
	elseif(isset($_GET['action']) && $_GET['action'] == 'insert'){

		$inmuebles = trim($_POST['ecr-inmuebles']);
		$materiales = trim($_POST['ecr-materiales']);

		if (empty($inmuebles)) array_push($errors, "Inmueble es requerido.");
		if (empty($materiales)) array_push($errors, "Materiales es requerido.");

		if (count($errors) == 0) {

			$res = $db->insertInmueblesMateriales($materiales,$inmuebles);

			if ($res != false) {
				
				array_push($success, "Material insertado satisfactoriamente.");
				setSuccess($success);
			}else{
				array_push($errors, "Lo sentimos, no se pudo insertar el material.");
				setErrors($errors);
			}
		}else{

			setErrors($errors);
		}

		irA(DOMAIN."?c=".$controller."&action=new");
	}
	elseif(isset($_GET['action']) && $_GET['action'] == 'disable'){

		$id = trim($_GET['id']);

		//$info = $db->getInmueblesMateriales(null,$id);

		if ($info == false) {
			array_push($errors, "No existe cuenta con el ID proporcionado.");
			setErrors($errors);
		}else{

			if($db->status("user",$info->id,0)){

				array_push($success, "Cuenta desactivada satisfactoriamente.");
				setSuccess($success);

			}else{
				array_push($errors, "No se pudo desactivar el material.");
				setErrors($errors);
			}
		}

		irA(DOMAIN."?c=".$controller);
	}
	elseif(isset($_GET['action']) && $_GET['action'] == 'enable'){

		$id = trim($_GET['id']);

		$info = $db->getInmueblesMateriales(null,$id);

		if ($info == false) {
			array_push($errors, "No existe cuenta con el ID proporcionado.");
			setErrors($errors);
		}else{

			if($db->status("user",$info->id,1)){

				array_push($success, "Cuenta activada satisfactoriamente.");
				setSuccess($success);

			}else{
				array_push($errors, "No se pudo activar el material.");
				setErrors($errors);
			}
		}

		irA(DOMAIN."?c=".$controller);
	}
	elseif(isset($_GET['action']) && $_GET['action'] == 'delete'){

		$id = trim($_GET['id']);

		if($db->delete("inmuebles_materiales",$id)){

			array_push($success, "Material eliminado satisfactoriamente.");
			setSuccess($success);
		}else{
			array_push($errors, "No se pudo eliminar el material.");
			setErrors($errors);
		}

		irA(DOMAIN."?c=".$controller);
	}
	elseif(isset($_GET['action']) && $_GET['action'] == 'edit'){

		$id = trim($_GET['id']);

		$info = $db->getInmueblesMateriales($id);

		if ($info == false) {
			array_push($errors, "No existe material con el ID proporcionado.");
			setErrors($errors);

			irA(DOMAIN."?c=".$controller);
		}else{

			$inmuebles = $db->getInmuebles();
			$materiales = $db->getMaterialesConstruccion();
			
			$view = 'edit-inmuebles_materiales.php';			
		}
	}
	elseif(isset($_GET['action']) && $_GET['action'] == 'update'){

		$id = $_GET['id'];

		$inmuebles = trim($_POST['ecr-inmuebles']);
		$materiales = trim($_POST['ecr-materiales']);

		if (empty($inmuebles)) array_push($errors, "Inmueble es requerido.");
		if (empty($materiales)) array_push($errors, "Materiales es requerido.");

		$get = $db->getInmueblesMateriales($id);

		if ($get == false) array_push($errors, "El material seleccionado no es valido.");

		if (count($errors) == 0) {

			$update = $db->updateInmueblesMateriales($id,$materiales,$inmuebles);

			if ($update) {
				array_push($success, "Material actualizado satisfactoriamente.");
				setSuccess($success);
			}else{
				array_push($errors, "Lo sentimos, no se pudo actualizar el material.");
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