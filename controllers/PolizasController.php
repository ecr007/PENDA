<?php

	if (!isLogin()) {
		irA(DOMAIN."?c=login");
	}
	
	$success = [];
	$errors = [];

	$controllerTitle = 'Polizas';
	$controller = 'polizas';


	// Default action
	if (!isset($_GET['action'])) {

		$info = $db->getPolizas();

		if ($info == false) {
			array_push($errors, "Aun no hay polizas registrados.");
			setErrors($errors);
		}

		$view = 'polizas.php';
	}
	elseif(isset($_GET['action']) && $_GET['action'] == 'new'){

		$seguros = $db->getSeguros();
		$inmuebles = $db->getInmuebles();
		$deducibles = $db->getDeducibles();
		$extras = $db->getExtras();

		$view = 'new-polizas.php';
	}
	elseif(isset($_GET['action']) && $_GET['action'] == 'insert'){

		$seguros = trim($_POST['ecr-seguros']);
		$inmuebles = trim($_POST['ecr-inmuebles']);
		$deducible = trim($_POST['ecr-deducible']);
		$finicio = trim($_POST['ecr-finicio']);
		$ffinal = trim($_POST['ecr-ffinal']);

		if (empty($seguros)) array_push($errors, "Nombre es requerido.");
		if (empty($inmuebles)) array_push($errors, "Inmueble es requerido.");
		if (empty($deducible)) array_push($errors, "Deducible es requerido.");
		if (empty($finicio)) array_push($errors, "Fecha de inicio es requerida.");
		if (empty($ffinal)) array_push($errors, "Fecha final es requerida.");
		
		if (count($errors) == 0) {

			$fecha_inicio = date("Y-m-d H:i:s",strtotime($finicio));
			$fecha_final = date("Y-m-d H:i:s",strtotime($ffinal));

			$resSeguros = $db->getSeguros($seguros);
			$resDeducibles = $db->getDeducibles($deducible);

			// Costo del seguro
			$subtotal = $resSeguros->costo;

			// Calculo los deducibles
			$subtotal = calcular($resDeducibles,$subtotal);
			
			// calculo los extras
			if(isset($_POST['ecr-extras']) && count($_POST['ecr-extras']) > 0){
				
				foreach ($_POST['ecr-extras'] as $key) {
					$extra = $db->getExtras($key);

					$subtotal =  calcular($extra,$subtotal);
				}
			}

			// Busco el total y verifico a ver si el inmueble aumenta o 
			// dismunuye el precio de la poliza segun los materiales de construccion
			$inmuebleMateriales = $db->getInmuebleMateriales(null,$inmuebles);
			
			$total = $subtotal;
			
			if (count($inmuebleMateriales) > 0) {

				foreach ($inmuebleMateriales as $key) {
					$material = $db->getMaterialesConstruccion($key->id_material);

					$total = calcular($material,$total);
				}
			}

			$setPoliza = $db->insertPolizas($subtotal,$total,$fecha_inicio,$fecha_final,$inmuebles,$seguros,$deducible);

			if(isset($_POST['ecr-extras']) && count($_POST['ecr-extras']) > 0){
				foreach ($_POST['ecr-extras'] as $key) {
					$db->insertPolizasExtras($key,$setPoliza);
				}
			}
			
			if ($setPoliza == false){
				array_push($errors, "No se pudo realizar la acción, intentar nuevamente.");
				setErrors($errors);
				irA(DOMAIN."?c=".$controller."&action=new");
			}

			array_push($success, "Poliza generada satisfactoriamente.");
			setSuccess($success);
		}else{

			setErrors($errors);
		}

		irA(DOMAIN."?c=".$controller."&action=new");
	}
	elseif(isset($_GET['action']) && $_GET['action'] == 'view'){

		$id = trim($_GET['id']);

		$info = $db->getPolizas($id);

		if ($info == false) {
			array_push($errors, "No existe poliza con el ID proporcionado.");
			setErrors($errors);
		}else{

			$deducibles = $db->getDeducibles($info->id_deducible);

			$polizasExtras = $db->getPolizasExtras($id);

			$extras = [];

			foreach ($polizasExtras as $key) {
				array_push($extras, $db->getExtras($key->id_extra));
			}

			$materialesConstruccion = $db->getInmueblesMateriales($info->id_inmueble);
		}

		$view = 'view-polizas.php';
	}
	elseif(isset($_GET['action']) && $_GET['action'] == 'delete'){

		$id = trim($_GET['id']);

		if($db->delete("polizas",$id)){

			array_push($success, "Poliza eliminada satisfactoriamente.");
			setSuccess($success);

		}else{
			array_push($errors, "No se pudo eliminar la poliza.");
			setErrors($errors);
		}

		irA(DOMAIN."?c=".$controller);
	}
	elseif(isset($_GET['action']) && $_GET['action'] == 'enable'){
		
	}
	elseif(isset($_GET['action']) && $_GET['action'] == 'edit'){
			
	}
	elseif(isset($_GET['action']) && $_GET['action'] == 'update'){

	}	
	else{
		irA(DOMAIN."?c=error");
	}