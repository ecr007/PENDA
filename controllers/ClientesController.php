<?php

	if (!isLogin()) {
		irA(DOMAIN."?c=login");
	}
	
	$success = [];
	$errors = [];

	$controllerTitle = 'Clientes';
	$controller = 'clientes';


	// Default action
	if (!isset($_GET['action'])) {

		$info = $db->getClientes();

		if ($info == false) {
			array_push($errors, "Aun no hay clientes registrados.");
			setErrors($errors);
		}

		$view = 'clientes.php';
	}
	elseif(isset($_GET['action']) && $_GET['action'] == 'new'){
		$view = 'new-clientes.php';
	}
	elseif(isset($_GET['action']) && $_GET['action'] == 'insert'){

		$name = trim($_POST['ecr-nombre']);
		$cedula = trim($_POST['ecr-cedula']);
		$telefono = trim($_POST['ecr-telefono']);
		$direccion = trim($_POST['ecr-direccion']);

		if (empty($name)) array_push($errors, "Nombre es requerido.");
		if (empty($cedula)) array_push($errors, "Cedula es requerido.");
		if (empty($telefono)) array_push($errors, "Telefono es requerido.");
		if (empty($direccion)) array_push($errors, "Dirección es requerido.");

		if (count($errors) == 0) {

			$res = $db->insertClientes($name,$cedula,$telefono,$direccion);

			if ($res != false) {
				
				array_push($success, "Cliente insertado satisfactoriamente.");
				setSuccess($success);
			}else{
				array_push($errors, "Lo sentimos, no se pudo insertar el cliente.");
				setErrors($errors);
			}
		}else{

			setErrors($errors);
		}

		irA(DOMAIN."?c=".$controller."&action=new");
	}
	elseif(isset($_GET['action']) && $_GET['action'] == 'disable'){

		$id = trim($_GET['id']);

		//$info = $db->getClientes(null,$id);

		if ($info == false) {
			array_push($errors, "No existe cuenta con el ID proporcionado.");
			setErrors($errors);
		}else{

			if($db->status("user",$info->id,0)){

				array_push($success, "Cuenta desactivada satisfactoriamente.");
				setSuccess($success);

			}else{
				array_push($errors, "No se pudo desactivar el cliente.");
				setErrors($errors);
			}
		}

		irA(DOMAIN."?c=".$controller);
	}
	elseif(isset($_GET['action']) && $_GET['action'] == 'enable'){

		$id = trim($_GET['id']);

		$info = $db->getClientes($id);

		if ($info == false) {
			array_push($errors, "No existe cuenta con el ID proporcionado.");
			setErrors($errors);
		}else{

			if($db->status("user",$info->id,1)){

				array_push($success, "Cuenta activada satisfactoriamente.");
				setSuccess($success);

			}else{
				array_push($errors, "No se pudo activar el cliente.");
				setErrors($errors);
			}
		}

		irA(DOMAIN."?c=".$controller);
	}
	elseif(isset($_GET['action']) && $_GET['action'] == 'delete'){

		$id = trim($_GET['id']);

		if($db->delete("clientes",$id)){

			array_push($success, "Cliente eliminado satisfactoriamente.");
			setSuccess($success);
		}else{
			array_push($errors, "No se pudo eliminar el cliente.");
			setErrors($errors);
		}

		irA(DOMAIN."?c=".$controller);
	}
	elseif(isset($_GET['action']) && $_GET['action'] == 'edit'){

		$id = trim($_GET['id']);

		$info = $db->getClientes($id);

		if ($info == false) {
			array_push($errors, "No existe cliente con el ID proporcionado.");
			setErrors($errors);

			irA(DOMAIN."?c=".$controller);
		}else{
			$municipios = $db->getMunicipios();
			
			$view = 'edit-clientes.php';			
		}
	}
	elseif(isset($_GET['action']) && $_GET['action'] == 'update'){

		$id = $_GET['id'];

		$name = trim($_POST['ecr-nombre']);
		$cedula = trim($_POST['ecr-cedula']);
		$telefono = trim($_POST['ecr-telefono']);
		$direccion = trim($_POST['ecr-direccion']);

		if (empty($name)) array_push($errors, "Nombre es requerido.");
		if (empty($cedula)) array_push($errors, "Cedula es requerido.");
		if (empty($telefono)) array_push($errors, "Telefono es requerido.");
		if (empty($direccion)) array_push($errors, "Dirección es requerido.");

		$get = $db->getClientes($id);

		if ($get == false) array_push($errors, "El cliente seleccionado no es valido.");

		if (count($errors) == 0) {

			$update = $db->updateClientes($id,$name,$cedula,$telefono,$direccion);

			if ($update) {
				array_push($success, "Cliente actualizado satisfactoriamente.");
				setSuccess($success);
			}else{
				array_push($errors, "Lo sentimos, no se pudo actualizar el cliente.");
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