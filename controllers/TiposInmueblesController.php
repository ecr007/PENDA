<?php

	if (!isLogin()) {
		irA(DOMAIN."?c=login");
	}
	
	$success = [];
	$errors = [];

	$controllerTitle = 'Tipos Inmuebles';
	$controller = 'tiposInmuebles';


	// Default action
	if (!isset($_GET['action'])) {

		$info = $db->getTiposInmuebles();

		if ($info == false) {
			array_push($errors, "Aun no hay tipos de inmuebles registrados.");
			setErrors($errors);
		}

		$view = 'tipos_inmuebles.php';
	}
	elseif(isset($_GET['action']) && $_GET['action'] == 'new'){
		$view = 'new-tipos_inmuebles.php';
	}
	elseif(isset($_GET['action']) && $_GET['action'] == 'insert'){

		$name = trim($_POST['ecr-nombre']);

		if (empty($name)) array_push($errors, "Nombre es requerido.");

		if (count($errors) == 0) {

			$res = $db->insertTiposInmuebles($name);

			if ($res != false) {
				
				array_push($success, "Tipo inmueble insertado satisfactoriamente.");
				setSuccess($success);
			}else{
				array_push($errors, "Lo sentimos, no se pudo insertar el tipo inmueble.");
				setErrors($errors);
			}
		}else{

			setErrors($errors);
		}

		irA(DOMAIN."?c=".$controller."&action=new");
	}
	elseif(isset($_GET['action']) && $_GET['action'] == 'disable'){

		$id = trim($_GET['id']);

		//$info = $db->getTiposInmuebles(null,$id);

		if ($info == false) {
			array_push($errors, "No existe cuenta con el ID proporcionado.");
			setErrors($errors);
		}else{

			if($db->status("user",$info->id,0)){

				array_push($success, "Tipo inmueble desactivado satisfactoriamente.");
				setSuccess($success);

			}else{
				array_push($errors, "No se pudo desactivar el tipo inmueble.");
				setErrors($errors);
			}
		}

		irA(DOMAIN."?c=".$controller);
	}
	elseif(isset($_GET['action']) && $_GET['action'] == 'enable'){

		$id = trim($_GET['id']);

		$info = $db->getTiposInmuebles(null,$id);

		if ($info == false) {
			array_push($errors, "No existe cuenta con el ID proporcionado.");
			setErrors($errors);
		}else{

			if($db->status("user",$info->id,1)){

				array_push($success, "Tipo inmueble activada satisfactoriamente.");
				setSuccess($success);

			}else{
				array_push($errors, "No se pudo activar el tipo inmueble.");
				setErrors($errors);
			}
		}

		irA(DOMAIN."?c=".$controller);
	}
	elseif(isset($_GET['action']) && $_GET['action'] == 'delete'){

		$id = trim($_GET['id']);

		if($db->delete("tipos_inmuebles",$id)){

			array_push($success, "Tipo inmueble eliminado satisfactoriamente.");
			setSuccess($success);
		}else{
			array_push($errors, "No se pudo eliminar el tipo inmueble.");
			setErrors($errors);
		}

		irA(DOMAIN."?c=".$controller);
	}
	elseif(isset($_GET['action']) && $_GET['action'] == 'edit'){

		$id = trim($_GET['id']);

		$info = $db->getTiposInmuebles($id);

		if ($info == false) {
			array_push($errors, "No existe tipo inmueble con el ID proporcionado.");
			setErrors($errors);

			irA(DOMAIN."?c=".$controller);
		}else{
			
			$view = 'edit-tipos_inmuebles.php';			
		}
	}
	elseif(isset($_GET['action']) && $_GET['action'] == 'update'){

		$id = $_GET['id'];

		$name = trim($_POST['ecr-nombre']);

		if (empty($name)) array_push($errors, "Nombre es requerido.");

		$get = $db->getTiposInmuebles($id);

		if ($get == false) array_push($errors, "El tipo inmueble seleccionado no es valido.");

		if (count($errors) == 0) {

			$update = $db->updateTiposInmuebles($id,$name);

			if ($update) {
				array_push($success, "Tipo inmueble actualizado satisfactoriamente.");
				setSuccess($success);
			}else{
				array_push($errors, "Lo sentimos, no se pudo actualizar el tipo inmueble.");
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