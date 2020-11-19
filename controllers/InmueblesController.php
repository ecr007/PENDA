<?php

	if (!isLogin()) {
		irA(DOMAIN."?c=login");
	}
	
	$success = [];
	$errors = [];

	$controllerTitle = 'Inmuebles';
	$controller = 'inmuebles';


	// Default action
	if (!isset($_GET['action'])) {

		$info = $db->getInmuebles();

		if ($info == false) {
			array_push($errors, "Aun no hay inmuebles registrados.");
			setErrors($errors);
		}

		$view = 'inmuebles.php';
	}
	elseif(isset($_GET['action']) && $_GET['action'] == 'new'){
		
		$clientes = $db->getClientes();
		$condiciones = $db->getCondiciones();
		$tipos = $db->getTiposInmuebles();

		$view = 'new-inmuebles.php';
	}
	elseif(isset($_GET['action']) && $_GET['action'] == 'insert'){

		$nombre = trim($_POST['ecr-nombre']);
		$tamano = trim($_POST['ecr-tamano']);
		$banos = trim($_POST['ecr-banos']);
		$parqueos = trim($_POST['ecr-parqueos']);
		$habitaciones = trim($_POST['ecr-habitaciones']);
		$precio = trim($_POST['ecr-precio']);
		$direccion = trim($_POST['ecr-direccion']);
		$clientes = trim($_POST['ecr-clientes']);
		$condiciones = trim($_POST['ecr-condiciones']);
		$tipos = trim($_POST['ecr-tipos']);

		if (empty($nombre)) array_push($errors, "Nombre es requerido.");
		if (empty($tamano)) array_push($errors, "Tamaño es requerido.");
		if (empty($banos)) array_push($errors, "Baños es requerido.");
		if (empty($parqueos)) array_push($errors, "Parqueos es requerido.");
		if (empty($habitaciones)) array_push($errors, "Habitaciones es requerido.");
		if (empty($precio)) array_push($errors, "Precio es requerido.");
		if (empty($direccion)) array_push($errors, "Dirección es requerido.");
		if (empty($clientes)) array_push($errors, "Propietario es requerido.");
		if (empty($condiciones)) array_push($errors, "Condicion es requerido.");
		if (empty($tipos)) array_push($errors, "Tipo es requerido.");

		if (count($errors) == 0) {

			$res = $db->insertInmuebles($nombre,$tamano,$banos,$parqueos,$habitaciones,$precio,$direccion,$condiciones,$tipos,$clientes);

			if ($res != false) {
				
				array_push($success, "Cliente insertado satisfactoriamente.");
				setSuccess($success);
			}else{
				array_push($errors, "Lo sentimos, no se pudo insertar el inmueble.");
				setErrors($errors);
			}
		}else{

			setErrors($errors);
		}

		irA(DOMAIN."?c=".$controller."&action=new");
	}
	elseif(isset($_GET['action']) && $_GET['action'] == 'disable'){

		$id = trim($_GET['id']);

		//$info = $db->getInmuebles(null,$id);

		if ($info == false) {
			array_push($errors, "No existe inmueble con el ID proporcionado.");
			setErrors($errors);
		}else{

			if($db->status("user",$info->id,0)){

				array_push($success, "Cuenta desactivada satisfactoriamente.");
				setSuccess($success);

			}else{
				array_push($errors, "No se pudo desactivar el inmueble.");
				setErrors($errors);
			}
		}

		irA(DOMAIN."?c=".$controller);
	}
	elseif(isset($_GET['action']) && $_GET['action'] == 'enable'){

		$id = trim($_GET['id']);

		$info = $db->getInmuebles($id);

		if ($info == false) {
			array_push($errors, "No existe inmueble con el ID proporcionado.");
			setErrors($errors);
		}else{

			if($db->status("user",$info->id,1)){

				array_push($success, "Cuenta activada satisfactoriamente.");
				setSuccess($success);

			}else{
				array_push($errors, "No se pudo activar el inmueble.");
				setErrors($errors);
			}
		}

		irA(DOMAIN."?c=".$controller);
	}
	elseif(isset($_GET['action']) && $_GET['action'] == 'delete'){

		$id = trim($_GET['id']);

		if($db->delete("inmuebles",$id)){

			array_push($success, "Cliente eliminado satisfactoriamente.");
			setSuccess($success);
		}else{
			array_push($errors, "No se pudo eliminar el inmueble.");
			setErrors($errors);
		}

		irA(DOMAIN."?c=".$controller);
	}
	elseif(isset($_GET['action']) && $_GET['action'] == 'edit'){

		$id = trim($_GET['id']);

		$info = $db->getInmuebles($id);

		if ($info == false) {
			array_push($errors, "No existe inmueble con el ID proporcionado.");
			setErrors($errors);

			irA(DOMAIN."?c=".$controller);
		}else{
			$clientes = $db->getClientes();
			$condiciones = $db->getCondiciones();
			$tipos = $db->getTiposInmuebles();
			
			$view = 'edit-inmuebles.php';			
		}
	}
	elseif(isset($_GET['action']) && $_GET['action'] == 'update'){

		$id = $_GET['id'];

		$nombre = trim($_POST['ecr-nombre']);
		$tamano = trim($_POST['ecr-tamano']);
		$banos = trim($_POST['ecr-banos']);
		$parqueos = trim($_POST['ecr-parqueos']);
		$habitaciones = trim($_POST['ecr-habitaciones']);
		$precio = trim($_POST['ecr-precio']);
		$direccion = trim($_POST['ecr-direccion']);
		$clientes = trim($_POST['ecr-clientes']);
		$condiciones = trim($_POST['ecr-condiciones']);
		$tipos = trim($_POST['ecr-tipos']);

		if (empty($nombre)) array_push($errors, "Nombre es requerido.");
		if (empty($tamano)) array_push($errors, "Tamaño es requerido.");
		if (empty($banos)) array_push($errors, "Baños es requerido.");
		if (empty($parqueos)) array_push($errors, "Parqueos es requerido.");
		if (empty($habitaciones)) array_push($errors, "Habitaciones es requerido.");
		if (empty($precio)) array_push($errors, "Precio es requerido.");
		if (empty($direccion)) array_push($errors, "Dirección es requerido.");
		if (empty($clientes)) array_push($errors, "Propietario es requerido.");
		if (empty($condiciones)) array_push($errors, "Condicion es requerido.");
		if (empty($tipos)) array_push($errors, "Tipo es requerido.");

		$get = $db->getInmuebles($id);

		if ($get == false) array_push($errors, "El inmueble seleccionado no es valido.");

		if (count($errors) == 0) {

			$update = $db->updateInmuebles($id,$nombre,$tamano,$banos,$parqueos,$habitaciones,$precio,$direccion,$condiciones,$tipos,$clientes);

			if ($update) {
				array_push($success, "Cliente actualizado satisfactoriamente.");
				setSuccess($success);
			}else{
				array_push($errors, "Lo sentimos, no se pudo actualizar el inmueble.");
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