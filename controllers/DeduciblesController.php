<?php

	if (!isLogin()) {
		irA(DOMAIN."?c=login");
	}
	
	$success = [];
	$errors = [];

	$controllerTitle = 'Deducibles';
	$controller = 'deducibles';


	// Default action
	if (!isset($_GET['action'])) {

		$info = $db->getDeducibles();

		if ($info == false) {
			array_push($errors, "Aun no hay deducibles registrados.");
			setErrors($errors);
		}

		$view = 'deducibles.php';
	}
	elseif(isset($_GET['action']) && $_GET['action'] == 'new'){
		$view = 'new-deducibles.php';
	}
	elseif(isset($_GET['action']) && $_GET['action'] == 'insert'){

		$name = trim($_POST['ecr-nombre']);
		$tipocalculo = trim($_POST['ecr-tipocalculo']);
		$deducir = trim($_POST['ecr-deducir']);
		$aumentar = trim($_POST['ecr-aumentar']);

		if (empty($name)) array_push($errors, "Nombre es requerido.");
		if (empty($tipocalculo)) array_push($errors, "Tipo calculo es requerido.");

		if (count($errors) == 0) {

			$res = $db->insertDeducibles($name,$tipocalculo,$deducir,$aumentar);

			if ($res != false) {
				
				array_push($success, "Deducible insertado satisfactoriamente.");
				setSuccess($success);
			}else{
				array_push($errors, "Lo sentimos, no se pudo insertar el extra.");
				setErrors($errors);
			}
		}else{

			setErrors($errors);
		}

		irA(DOMAIN."?c=".$controller."&action=new");
	}
	elseif(isset($_GET['action']) && $_GET['action'] == 'disable'){

		$id = trim($_GET['id']);

		//$info = $db->getDeducibles(null,$id);

		if ($info == false) {
			array_push($errors, "No existe cuenta con el ID proporcionado.");
			setErrors($errors);
		}else{

			if($db->status("user",$info->id,0)){

				array_push($success, "Cuenta desactivada satisfactoriamente.");
				setSuccess($success);

			}else{
				array_push($errors, "No se pudo desactivar el extra.");
				setErrors($errors);
			}
		}

		irA(DOMAIN."?c=".$controller);
	}
	elseif(isset($_GET['action']) && $_GET['action'] == 'enable'){

		$id = trim($_GET['id']);

		$info = $db->getDeducibles(null,$id);

		if ($info == false) {
			array_push($errors, "No existe cuenta con el ID proporcionado.");
			setErrors($errors);
		}else{

			if($db->status("user",$info->id,1)){

				array_push($success, "Cuenta activada satisfactoriamente.");
				setSuccess($success);

			}else{
				array_push($errors, "No se pudo activar el extra.");
				setErrors($errors);
			}
		}

		irA(DOMAIN."?c=".$controller);
	}
	elseif(isset($_GET['action']) && $_GET['action'] == 'delete'){

		$id = trim($_GET['id']);

		if($db->delete("deducibles",$id)){

			array_push($success, "Deducible eliminado satisfactoriamente.");
			setSuccess($success);
		}else{
			array_push($errors, "No se pudo eliminar el extra.");
			setErrors($errors);
		}

		irA(DOMAIN."?c=".$controller);
	}
	elseif(isset($_GET['action']) && $_GET['action'] == 'edit'){

		$id = trim($_GET['id']);

		$info = $db->getDeducibles($id);

		if ($info == false) {
			array_push($errors, "No existe extra con el ID proporcionado.");
			setErrors($errors);

			irA(DOMAIN."?c=".$controller);
		}else{
			
			$view = 'edit-deducibles.php';			
		}
	}
	elseif(isset($_GET['action']) && $_GET['action'] == 'update'){

		$id = $_GET['id'];

		$name = trim($_POST['ecr-nombre']);
		$tipocalculo = trim($_POST['ecr-tipocalculo']);
		$deducir = trim($_POST['ecr-deducir']);
		$aumentar = trim($_POST['ecr-aumentar']);

		if (empty($name)) array_push($errors, "Nombre es requerido.");
		if (empty($tipocalculo)) array_push($errors, "Tipo calculo es requerido.");

		$get = $db->getDeducibles($id);

		if ($get == false) array_push($errors, "El extra seleccionado no es valido.");

		if (count($errors) == 0) {

			$update = $db->updateDeducibles($id,$name,$tipocalculo,$deducir,$aumentar);

			if ($update) {
				array_push($success, "Deducible actualizado satisfactoriamente.");
				setSuccess($success);
			}else{
				array_push($errors, "Lo sentimos, no se pudo actualizar el extra.");
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