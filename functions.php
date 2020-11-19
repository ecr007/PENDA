<?php 

	function irA($link){
		header("HTTP/1.1 301 Moved Permanently");
		header("Location: ".$link);exit();
	}

	// Array $success
	function setSuccess($success){
		flushAlerts();

		$_SESSION['success'] = $success;
	}

	// Array $errors
	function setErrors($errors){
		flushAlerts();

		$_SESSION['errors'] = $errors;
	}

	// Delete Alerts
	function flushAlerts(){
		if(isset($_SESSION['success'])) unset($_SESSION['success']);
		if(isset($_SESSION['errors'])) unset($_SESSION['errors']);
	}


	// CheckLogin
	function isLogin(){
		if (isset($_SESSION['login'])) {
			return true;
		} else {
			return false;
		}
	}

	function slug($text)
	{
		// replace non letter or digits by -
		$text = preg_replace('~[^\pL\d]+~u', '-', $text);

		// transliterate
		$text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

		// remove unwanted characters
		$text = preg_replace('~[^-\w]+~', '', $text);

		// trim
		$text = trim($text, '-');

		// remove duplicate -
		$text = preg_replace('~-+~', '-', $text);

		// lowercase
		$text = strtolower($text);

		if (empty($text)) {
			return 'n-a';
		}

		return $text;
	}


	/**
	 * 
	 * Esta funcion se limita a concatenar un where satisfacotiamente
	 * 
	 */
	function where($sql,$column,$type)
	{
		$res = '';
		
		if (preg_match("/where/i", $sql)) {
			$res .= ' '.$type.' '.$column;
		}else{
			$res .= ' WHERE '.$column;
		}

		return $res;
	}


	function json($res,$code = 200){
		header("Content-Type: application/json");
		echo json_encode($res);exit();
	}

	function calcular($object,$total){
		$aumentar = $object->aumentar;
		$deducir = $object->deducir;
		
		if($object->tipo_calculo == 'porciento'){
			if($deducir > 0){
				$total -= ($total * $deducir) / 100;
			}
			elseif($aumentar){
				$total += ($total * $aumentar) / 100;
			}
		}
		else{
			if($deducir > 0){
				$total -= $deducir;
			}
			elseif($aumentar){
				$total += $aumentar;
			}
		}

		return $total;
	}

	function getData($data){
		global $db;

		$method = $data['method'];

		$response = $db->$method(null,$data['value']);

		$html = "<option value=''>Seleccionar...</option>";

		if (count($response) > 0) {
			foreach ($variable as $key) {
				$html .= "<option value='".$key->id."'>".$key->nombre."</option>";
			}
		}else{
			$html = "<option value=''>No hay data disponible</option>";
		}

		json(['code'=>200,'html'=>$html]);
	}