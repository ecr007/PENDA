<?php

// $this->db->lastInsertId();

class Model
{    
	/**
	 * @param object $db A PDO database connection
	 */
	function __construct($dbHost,$dbName,$dbUser,$dbPass)
	{
		try {
			$this->db = new PDO('mysql:host='.$dbHost.';dbname='.$dbName, $dbUser, $dbPass);

			/**
			 * Fixed caracteres especiales
			 */
			$this->db->query("SET CHARACTER SET 'utf8'");
			$this->db->query("SET lc_time_names = 'es_MX'");

			/**
			 * Fecha RD
			 */
			ini_set('date.timezone','America/Santo_Domingo');
			date_default_timezone_set('America/Santo_Domingo');

		} catch (PDOException $e) {
			exit('Los Sentimos, la conexion no se pudo realizar. intentarlo nuevamente.');
		}
	}

	/*
	 * Get Usuarios
	 */
	public function getUser($user,$pass,$rol_id){
		$sql = "SELECT * FROM user WHERE email = ? AND password = ? AND rol_id = ?";
		$bind  = [$user,sha1(KEY.$pass),$rol_id];

		$query = $this->db->prepare($sql);
		
		if($query->execute($bind)){
			return $query->fetch(PDO::FETCH_OBJ);
		}else{
			return false;
		}
	}

	/*
	 * Get Usuarios
	 */
	public function getUserAccount($phone,$pass,$rol_id){
		$sql = "SELECT 
		u.id,u.name,u.phone,u.status, c.name AS company  
		FROM user AS u 
		INNER JOIN company_account AS ca ON u.id = ca.user_id 
		INNER JOIN company AS com ON ca.company_id = com.id 
		INNER JOIN user AS c ON com.user_id = c.id 
		WHERE u.phone = ? AND u.password = ? AND u.rol_id = ?";

		$bind  = [$phone,sha1(KEY.$pass),$rol_id];

		$query = $this->db->prepare($sql);
		
		if($query->execute($bind)){
			return $query->fetch(PDO::FETCH_OBJ);
		}else{
			return false;
		}
	}


	/**
	 * Insert
	 *
	 */
	public function insertUser($name,$email,$phone,$password,$status,$is_show,$rol_id){
		
		$sql = "INSERT INTO user (name,email,phone,password,status,is_show,rol_id,created_at) 
		VALUES(?,?,?,?,?,?,?,?)";
		
		$bind = [$name,$email,$phone,sha1(KEY.$password),$status,$is_show,$rol_id,date("Y-m-d H:i:s")];

		$query = $this->db->prepare($sql);
		
		if($query->execute($bind)){
			return $this->db->lastInsertId();
		}else{
			return false;
		}
	}


	/**
	 * update
	 *
	 */
	public function updateUser($id,$name,$email,$phone,$password,$status,$is_show,$rol_id){

		$sql = "UPDATE user SET name = ?, email = ?, phone = ?, password = ?, status = ?, is_show = ?, rol_id = ?, updated_at = ? WHERE id = ?";

		$bind = [
			$name,
			$email,
			$phone,
			sha1(KEY.$password),
			$status,
			$is_show,
			$rol_id,
			date("Y-m-d H:i:s"),
			$id
		];

		$query = $this->db->prepare($sql);
		
		if($query->execute($bind)){
			return true;
		}else{
			return false;
		}
	}



	/*
	 * Get
	 */
	public function getProvincias($id = null){
		$sql = "SELECT * FROM provincias";
		
		$bind  = [];

		if (!is_null($id)) {
			$sql .= where($sql,'id = ?','');
			array_push($bind, $id);
		}

		$query = $this->db->prepare($sql);
		
		if($query->execute($bind)){
			
			if (!is_null($id)) {
				$res = $query->fetch(PDO::FETCH_OBJ);
			}else{
				$res = $query->fetchAll(PDO::FETCH_OBJ);
			}
			
			return $res;
		}else{
			return false;
		}
	}


	/*
	 * Get
	 */
	public function getMunicipios($id = null,$id_provincia = null){
		$sql = "SELECT * FROM municipios";
		
		$bind  = [];

		if (!is_null($id)) {
			$sql .= where($sql,'id = ?','');
			array_push($bind, $id);
		}

		if (!is_null($id_provincia)) {
			$sql .= where($sql,'id_provincia = ?','AND');
			array_push($bind, $id_provincia);
		}

		$query = $this->db->prepare($sql);
		
		if($query->execute($bind)){
			
			if (!is_null($id)) {
				$res = $query->fetch(PDO::FETCH_OBJ);
			}else{
				$res = $query->fetchAll(PDO::FETCH_OBJ);
			}
			
			return $res;
		}else{
			return false;
		}
	}


	/*
	 * Get
	 */
	public function getSectores($id = null,$id_municipio = null){
		$sql = "SELECT s.*, m.nombre AS municipio, p.nombre AS provincia 
		FROM sectores AS s INNER JOIN municipios AS m ON s.id_municipio = m.id 
		INNER JOIN provincias AS p ON m.id_provincia = p.id";
		
		$bind  = [];

		if (!is_null($id)) {
			$sql .= where($sql,'id = ?','');
			array_push($bind, $id);
		}

		if (!is_null($id_municipio)) {
			$sql .= where($sql,'id_municipio = ?','AND');
			array_push($bind, $id_municipio);
		}

		$query = $this->db->prepare($sql);
		
		if($query->execute($bind)){
			
			if (!is_null($id)) {
				$res = $query->fetch(PDO::FETCH_OBJ);
			}else{
				$res = $query->fetchAll(PDO::FETCH_OBJ);
			}
			
			return $res;
		}else{
			return false;
		}
	}


	/**
	 * Insert
	 *
	 */
	public function insertSectores($nombre,$id_municipio){
		
		$sql = "INSERT INTO sectores (nombre,id_municipio,created_at) 
		VALUES(?,?,?)";
		
		$bind = [$nombre,$id_municipio,date("Y-m-d H:i:s")];

		$query = $this->db->prepare($sql);
		
		if($query->execute($bind)){
			return $this->db->lastInsertId();
		}else{
			return false;
		}
	}



	/**
	 * update
	 *
	 */
	public function updateSectores($id,$nombre,$id_municipio){

		$sql = "UPDATE sectores SET nombre = ?, id_municipio = ?, updated_at = ? WHERE id = ?";

		$bind = [
			$nombre,
			$id_municipio,
			date("Y-m-d H:i:s"),
			$id
		];

		$query = $this->db->prepare($sql);
		
		if($query->execute($bind)){
			return true;
		}else{
			return false;
		}
	}



	/*
	 * Get
	 */
	public function getCalles($id = null,$id_sector){
		$sql = "SELECT ca.*, s.nombre AS sector, m.nombre AS municipio, m.id AS id_municipio, 
		p.nombre AS provincia, p.id AS id_provincia 
		FROM calles AS ca INNER JOIN sectores AS s 
		ON ca.id_sector = s.id INNER JOIN municipios AS m ON s.id_municipio = m.id 
		INNER JOIN provincias AS p ON m.id_provincia = p.id";
		
		$bind  = [];

		if (!is_null($id)) {
			$sql .= where($sql,'id = ?','');
			array_push($bind, $id);
		}

		if (!is_null($id_sector)) {
			$sql .= where($sql,'id_sector = ?','AND');
			array_push($bind, $id_sector);
		}

		$query = $this->db->prepare($sql);
		
		if($query->execute($bind)){
			
			if (!is_null($id)) {
				$res = $query->fetch(PDO::FETCH_OBJ);
			}else{
				$res = $query->fetchAll(PDO::FETCH_OBJ);
			}
			
			return $res;
		}else{
			return false;
		}
	}


	/**
	 * Insert
	 *
	 */
	public function insertCalles($nombre,$id_sector){
		
		$sql = "INSERT INTO calles (nombre,id_sector,created_at) 
		VALUES(?,?,?)";
		
		$bind = [$nombre,$id_sector,date("Y-m-d H:i:s")];

		$query = $this->db->prepare($sql);
		
		if($query->execute($bind)){
			return $this->db->lastInsertId();
		}else{
			return false;
		}
	}



	/**
	 * update
	 *
	 */
	public function updateCalles($id,$nombre,$id_sector){

		$sql = "UPDATE calles SET nombre = ?, id_sector = ?, updated_at = ? WHERE id = ?";

		$bind = [
			$nombre,
			$id_sector,
			date("Y-m-d H:i:s"),
			$id
		];

		$query = $this->db->prepare($sql);
		
		if($query->execute($bind)){
			return true;
		}else{
			return false;
		}
	}


	/*
	 * Get
	 */
	public function getTiposTelefonos($id = null){
		$sql = "SELECT * FROM tipos_telefonos";
		
		$bind  = [];

		if (!is_null($id)) {
			$sql .= where($sql,'id = ?','');
			array_push($bind, $id);
		}

		$query = $this->db->prepare($sql);
		
		if($query->execute($bind)){
			
			if (!is_null($id)) {
				$res = $query->fetch(PDO::FETCH_OBJ);
			}else{
				$res = $query->fetchAll(PDO::FETCH_OBJ);
			}
			
			return $res;
		}else{
			return false;
		}
	}


	/**
	 * Insert
	 *
	 */
	public function insertTiposTelefonos($nombre){
		
		$sql = "INSERT INTO tipos_telefonos (nombre,created_at) 
		VALUES(?,?)";
		
		$bind = [$nombre,date("Y-m-d H:i:s")];

		$query = $this->db->prepare($sql);
		
		if($query->execute($bind)){
			return $this->db->lastInsertId();
		}else{
			return false;
		}
	}



	/**
	 * update
	 *
	 */
	public function updateTiposTelefonos($id,$nombre){

		$sql = "UPDATE tipos_telefonos SET nombre = ?, updated_at = ? WHERE id = ?";

		$bind = [
			$nombre,
			date("Y-m-d H:i:s"),
			$id
		];

		$query = $this->db->prepare($sql);
		
		if($query->execute($bind)){
			return true;
		}else{
			return false;
		}
	}


	/*
	 * Get
	 */
	public function getClientes($id = null){
		$sql = "SELECT * FROM clientes";
		
		$bind  = [];

		if (!is_null($id)) {
			$sql .= where($sql,'id = ?','');
			array_push($bind, $id);
		}

		$query = $this->db->prepare($sql);
		
		if($query->execute($bind)){
			
			if (!is_null($id)) {
				$res = $query->fetch(PDO::FETCH_OBJ);
			}else{
				$res = $query->fetchAll(PDO::FETCH_OBJ);
			}
			
			return $res;
		}else{
			return false;
		}
	}


	/**
	 * Insert
	 *
	 */
	public function insertClientes($nombre,$cedula,$telefono,$direccion){
		
		$sql = "INSERT INTO clientes (nombre,cedula,telefono,direccion,created_at) 
		VALUES(?,?,?,?,?)";
		
		$bind = [$nombre,$cedula,$telefono,$direccion,date("Y-m-d H:i:s")];

		$query = $this->db->prepare($sql);
		
		if($query->execute($bind)){
			return $this->db->lastInsertId();
		}else{
			return false;
		}
	}



	/**
	 * update
	 *
	 */
	public function updateClientes($id,$nombre,$cedula,$telefono,$direccion){

		$sql = "UPDATE clientes SET nombre = ?, cedula = ?, telefono = ?, direccion = ?, updated_at = ? WHERE id = ?";

		$bind = [
			$nombre,
			$cedula,
			$telefono,
			$direccion,
			date("Y-m-d H:i:s"),
			$id
		];

		$query = $this->db->prepare($sql);
		
		if($query->execute($bind)){
			return true;
		}else{
			return false;
		}
	}



	/*
	 * Get
	 */
	public function getTelefonosClientes($id = null,$id_cliente = null){
		$sql = "SELECT * FROM telefonos_clientes";
		
		$bind  = [];

		if (!is_null($id)) {
			$sql .= where($sql,'id = ?','');
			array_push($bind, $id);
		}

		if (!is_null($id)) {
			$sql .= where($sql,'id_cliente = ?','AND');
			array_push($bind, $id);
		}

		$query = $this->db->prepare($sql);
		
		if($query->execute($bind)){
			
			if (!is_null($id)) {
				$res = $query->fetch(PDO::FETCH_OBJ);
			}else{
				$res = $query->fetchAll(PDO::FETCH_OBJ);
			}
			
			return $res;
		}else{
			return false;
		}
	}


	/**
	 * Insert
	 *
	 */
	public function insertTelefonosClientes($numero,$id_cliente,$id_tipo_telefono){
		
		$sql = "INSERT INTO telefonos_clientes (numero,id_cliente,id_tipo_telefono,created_at) 
		VALUES(?,?,?,?)";
		
		$bind = [$numero,$id_cliente,$id_tipo_telefono,date("Y-m-d H:i:s")];

		$query = $this->db->prepare($sql);
		
		if($query->execute($bind)){
			return $this->db->lastInsertId();
		}else{
			return false;
		}
	}



	/**
	 * update
	 *
	 */
	public function updateTelefonosClientes($id,$numero,$id_cliente,$id_tipo_telefono){

		$sql = "UPDATE telefonos_clientes SET numero = ?, id_cliente = ?, id_tipo_telefono = ?, updated_at = ? WHERE id = ?";

		$bind = [
			$numero,
			$id_cliente,
			$id_tipo_telefono,
			date("Y-m-d H:i:s"),
			$id
		];

		$query = $this->db->prepare($sql);
		
		if($query->execute($bind)){
			return true;
		}else{
			return false;
		}
	}


	/*
	 * Get
	 */
	public function getDireccionClientes($id = null,$id_cliente = null){
		$sql = "SELECT * FROM direccion_clientes";
		
		$bind  = [];

		if (!is_null($id)) {
			$sql .= where($sql,'id = ?','');
			array_push($bind, $id);
		}

		if (!is_null($id)) {
			$sql .= where($sql,'id_cliente = ?','AND');
			array_push($bind, $id);
		}

		$query = $this->db->prepare($sql);
		
		if($query->execute($bind)){
			
			if (!is_null($id)) {
				$res = $query->fetch(PDO::FETCH_OBJ);
			}else{
				$res = $query->fetchAll(PDO::FETCH_OBJ);
			}
			
			return $res;
		}else{
			return false;
		}
	}


	/**
	 * Insert
	 *
	 */
	public function insertDireccionClientes($informacion,$id_cliente,$id_calle){
		
		$sql = "INSERT INTO direccion_clientes (informacion,id_cliente,id_calle,created_at) 
		VALUES(?,?,?,?)";
		
		$bind = [$informacion,$id_cliente,$id_calle,date("Y-m-d H:i:s")];

		$query = $this->db->prepare($sql);
		
		if($query->execute($bind)){
			return $this->db->lastInsertId();
		}else{
			return false;
		}
	}



	/**
	 * update
	 *
	 */
	public function updateDireccionClientes($id,$informacion,$id_cliente,$id_calle){

		$sql = "UPDATE direccion_clientes SET informacion = ?, id_cliente = ?, id_calle = ?, updated_at = ? WHERE id = ?";

		$bind = [
			$informacion,
			$id_cliente,
			$id_calle,
			date("Y-m-d H:i:s"),
			$id
		];

		$query = $this->db->prepare($sql);
		
		if($query->execute($bind)){
			return true;
		}else{
			return false;
		}
	}



	/*
	 * Get
	 */
	public function getCondiciones($id = null){
		$sql = "SELECT * FROM condiciones";
		
		$bind  = [];

		if (!is_null($id)) {
			$sql .= where($sql,'id = ?','');
			array_push($bind, $id);
		}

		$query = $this->db->prepare($sql);
		
		if($query->execute($bind)){
			
			if (!is_null($id)) {
				$res = $query->fetch(PDO::FETCH_OBJ);
			}else{
				$res = $query->fetchAll(PDO::FETCH_OBJ);
			}
			
			return $res;
		}else{
			return false;
		}
	}


	/**
	 * Insert
	 *
	 */
	public function insertCondiciones($nombre){
		
		$sql = "INSERT INTO condiciones (nombre,created_at) 
		VALUES(?,?)";
		
		$bind = [$nombre,date("Y-m-d H:i:s")];

		$query = $this->db->prepare($sql);
		
		if($query->execute($bind)){
			return $this->db->lastInsertId();
		}else{
			return false;
		}
	}



	/**
	 * update
	 *
	 */
	public function updateCondiciones($id,$nombre){

		$sql = "UPDATE condiciones SET nombre = ?, updated_at = ? WHERE id = ?";

		$bind = [
			$nombre,
			date("Y-m-d H:i:s"),
			$id
		];

		$query = $this->db->prepare($sql);
		
		if($query->execute($bind)){
			return true;
		}else{
			return false;
		}
	}


	/*
	 * Get
	 */
	public function getTiposInmuebles($id = null){
		$sql = "SELECT * FROM tipos_inmuebles";
		
		$bind  = [];

		if (!is_null($id)) {
			$sql .= where($sql,'id = ?','');
			array_push($bind, $id);
		}

		$query = $this->db->prepare($sql);
		
		if($query->execute($bind)){
			
			if (!is_null($id)) {
				$res = $query->fetch(PDO::FETCH_OBJ);
			}else{
				$res = $query->fetchAll(PDO::FETCH_OBJ);
			}
			
			return $res;
		}else{
			return false;
		}
	}


	/**
	 * Insert
	 *
	 */
	public function insertTiposInmuebles($nombre){
		
		$sql = "INSERT INTO tipos_inmuebles (nombre,created_at) 
		VALUES(?,?)";
		
		$bind = [$nombre,date("Y-m-d H:i:s")];

		$query = $this->db->prepare($sql);
		
		if($query->execute($bind)){
			return $this->db->lastInsertId();
		}else{
			return false;
		}
	}



	/**
	 * update
	 *
	 */
	public function updateTiposInmuebles($id,$nombre){

		$sql = "UPDATE tipos_inmuebles SET nombre = ?, updated_at = ? WHERE id = ?";

		$bind = [
			$nombre,
			date("Y-m-d H:i:s"),
			$id
		];

		$query = $this->db->prepare($sql);
		
		if($query->execute($bind)){
			return true;
		}else{
			return false;
		}
	}



	/*
	 * Get
	 */
	public function getInmuebles($id = null,$id_cliente=null){
		$sql = "SELECT i.*, c.nombre AS propietario, co.nombre AS condicion, ti.nombre AS tipo 
		FROM inmuebles AS i INNER JOIN clientes AS c ON i.id_cliente = c.id 
		INNER JOIN condiciones AS co ON i.id_condicion = co.id 
		INNER JOIN tipos_inmuebles AS ti ON i.id_tipos_inmuebles = ti.id";
		
		$bind  = [];

		if (!is_null($id)) {
			$sql .= where($sql,'id = ?','');
			array_push($bind, $id);
		}

		if (!is_null($id_cliente)) {
			$sql .= where($sql,'id_cliente = ?','AND');
			array_push($bind, $id_cliente);
		}

		$query = $this->db->prepare($sql);
		
		if($query->execute($bind)){
			
			if (!is_null($id)) {
				$res = $query->fetch(PDO::FETCH_OBJ);
			}else{
				$res = $query->fetchAll(PDO::FETCH_OBJ);
			}
			
			return $res;
		}else{
			return false;
		}
	}


	/**
	 * Insert
	 *
	 */
	public function insertInmuebles($nombre,$tamano,$banos,$parqueos,$habitaciones,$precio,$direccion,$id_condicion,$id_tipos_inmuebles,$id_cliente){
		$sql = "INSERT INTO inmuebles (nombre,tamano,banos,parqueos,habitaciones,precio,direccion,id_condicion,id_tipos_inmuebles,id_cliente,created_at) VALUES(?,?,?,?,?,?,?,?,?,?,?)";
		
		$bind = [
			$nombre,
			$tamano,
			$banos,
			$parqueos,
			$habitaciones,
			$precio,
			$direccion,
			$id_condicion,
			$id_tipos_inmuebles,
			$id_cliente,
			date("Y-m-d H:i:s")
		];

		$query = $this->db->prepare($sql);
		
		if($query->execute($bind)){
			return $this->db->lastInsertId();
		}else{
			return false;
		}
	}



	/**
	 * update
	 *
	 */
	public function updateInmuebles($id,$nombre,$tamano,$banos,$parqueos,$habitaciones,$precio,$direccion,$id_condicion,$id_tipos_inmuebles,$id_cliente){

		$sql = "UPDATE inmuebles SET nombre = ? ,tamano = ? ,banos = ? ,parqueos = ? ,habitaciones = ? ,precio = ?, direccion = ? ,id_condicion = ? ,id_tipos_inmuebles = ? ,id_cliente = ? , updated_at = ? WHERE id = ?";

		$bind = [
			$nombre,
			$tamano,
			$banos,
			$parqueos,
			$habitaciones,
			$precio,
			$direccion,
			$id_condicion,
			$id_tipos_inmuebles,
			$id_cliente,
			date("Y-m-d H:i:s"),
			$id
		];

		$query = $this->db->prepare($sql);
		
		if($query->execute($bind)){
			return true;
		}else{
			return false;
		}
	}


	/*
	 * Get
	 */
	public function getDireccionInmuebles($id_inmueble = null){
		$sql = "SELECT * FROM direccion_inmuebles";
		
		$bind  = [];

		if (!is_null($id_inmueble)) {
			$sql .= where($sql,'id_inmueble = ?','');
			array_push($bind, $id_inmueble);
		}

		$query = $this->db->prepare($sql);
		
		if($query->execute($bind)){
			
			if (!is_null($id_inmueble)) {
				$res = $query->fetch(PDO::FETCH_OBJ);
			}else{
				$res = $query->fetchAll(PDO::FETCH_OBJ);
			}
			
			return $res;
		}else{
			return false;
		}
	}


	/**
	 * Insert
	 *
	 */
	public function insertDireccionInmuebles($id_calle,$id_inmueble,$informacion){
		
		$sql = "INSERT INTO direccion_inmuebles (id_calle,id_inmueble,informacion,created_at) 
		VALUES(?,?,?,?)";
		
		$bind = [$id_calle,$id_inmueble,$informacion,date("Y-m-d H:i:s")];

		$query = $this->db->prepare($sql);
		
		if($query->execute($bind)){
			return $this->db->lastInsertId();
		}else{
			return false;
		}
	}



	/**
	 * update
	 *
	 */
	public function updateDireccionInmuebles($id,$id_calle,$id_inmueble,$informacion){

		$sql = "UPDATE direccion_inmuebles SET id_calle = ?, id_inmueble = ?, informacion = ?, updated_at = ? WHERE id = ?";

		$bind = [
			$id_calle,
			$id_inmueble,
			$informacion,
			date("Y-m-d H:i:s"),
			$id
		];

		$query = $this->db->prepare($sql);
		
		if($query->execute($bind)){
			return true;
		}else{
			return false;
		}
	}



	/*
	 * Get
	 */
	public function getMaterialesConstruccion($id = null){
		$sql = "SELECT * FROM materiales_construccion";
		
		$bind  = [];

		if (!is_null($id)) {
			$sql .= where($sql,'id = ?','');
			array_push($bind, $id);
		}

		$query = $this->db->prepare($sql);
		
		if($query->execute($bind)){
			
			if (!is_null($id)) {
				$res = $query->fetch(PDO::FETCH_OBJ);
			}else{
				$res = $query->fetchAll(PDO::FETCH_OBJ);
			}
			
			return $res;
		}else{
			return false;
		}
	}


	/**
	 * Insert
	 *
	 */
	public function insertMaterialesConstruccion($nombre,$tipo_calculo,$deducir,$aumentar){
		$sql = "INSERT INTO materiales_construccion (nombre,tipo_calculo,deducir,aumentar,created_at) 
		VALUES(?,?,?,?,?)";
		
		$bind = [
			$nombre,
			$tipo_calculo,
			$deducir,
			$aumentar,
			date("Y-m-d H:i:s")
		];

		$query = $this->db->prepare($sql);
		
		if($query->execute($bind)){
			return $this->db->lastInsertId();
		}else{
			return false;
		}
	}



	/**
	 * update
	 *
	 */
	public function updateMaterialesConstruccion($id,$nombre,$tipo_calculo,$deducir,$aumentar){

		$sql = "UPDATE materiales_construccion SET nombre = ? ,tipo_calculo = ? ,deducir = ? ,aumentar = ? , updated_at = ? 
		WHERE id = ?";

		$bind = [
			$nombre,
			$tipo_calculo,
			$deducir,
			$aumentar,
			date("Y-m-d H:i:s"),
			$id
		];

		$query = $this->db->prepare($sql);
		
		if($query->execute($bind)){
			return true;
		}else{
			return false;
		}
	}



	/*
	 * Get
	 */
	public function getInmuebleMateriales($id = null,$id_inmueble = null){
		$sql = "SELECT * FROM inmueble_materiales";
		
		$bind  = [];

		if (!is_null($id)) {
			$sql .= where($sql,'id = ?','');
			array_push($bind, $id);
		}

		if (!is_null($id_inmueble)) {
			$sql .= where($sql,'id_inmueble = ?','AND');
			array_push($bind, $id_inmueble);
		}

		$query = $this->db->prepare($sql);
		
		if($query->execute($bind)){
			
			if (!is_null($id)) {
				$res = $query->fetch(PDO::FETCH_OBJ);
			}else{
				$res = $query->fetchAll(PDO::FETCH_OBJ);
			}
			
			return $res;
		}else{
			return false;
		}
	}


	/**
	 * Insert
	 *
	 */
	public function insertInmuebleMateriales($id_material,$id_inmueble){
		$sql = "INSERT INTO inmueble_materiales (id_material,id_inmueble,created_at) 
		VALUES(?,?,?)";
		
		$bind = [
			$id_material,
			$id_inmueble,
			date("Y-m-d H:i:s")
		];

		$query = $this->db->prepare($sql);
		
		if($query->execute($bind)){
			return $this->db->lastInsertId();
		}else{
			return false;
		}
	}



	/**
	 * update
	 *
	 */
	public function updateInmuebleMateriales($id,$id_material,$id_inmueble){

		$sql = "UPDATE inmueble_materiales SET id_material = ? ,id_inmueble = ? , updated_at = ? WHERE id = ?";

		$bind = [
			$id_material,
			$id_inmueble,
			date("Y-m-d H:i:s"),
			$id
		];

		$query = $this->db->prepare($sql);
		
		if($query->execute($bind)){
			return true;
		}else{
			return false;
		}
	}



	/*
	 * Get
	 */
	public function getSeguros($id = null){
		$sql = "SELECT * FROM seguros";
		
		$bind  = [];

		if (!is_null($id)) {
			$sql .= where($sql,'id = ?','');
			array_push($bind, $id);
		}

		$query = $this->db->prepare($sql);
		
		if($query->execute($bind)){
			
			if (!is_null($id)) {
				$res = $query->fetch(PDO::FETCH_OBJ);
			}else{
				$res = $query->fetchAll(PDO::FETCH_OBJ);
			}
			
			return $res;
		}else{
			return false;
		}
	}


	/**
	 * Insert
	 *
	 */
	public function insertSeguros($nombre,$costo,$informacion){
		$sql = "INSERT INTO seguros (nombre,costo,informacion,created_at) 
		VALUES(?,?,?,?)";
		
		$bind = [
			$nombre,
			$costo,
			$informacion,
			date("Y-m-d H:i:s")
		];

		$query = $this->db->prepare($sql);
		
		if($query->execute($bind)){
			return $this->db->lastInsertId();
		}else{
			return false;
		}
	}



	/**
	 * update
	 *
	 */
	public function updateSeguros($id,$nombre,$costo,$informacion){

		$sql = "UPDATE seguros SET nombre = ? ,costo = ? , informacion = ?, updated_at = ? WHERE id = ?";

		$bind = [
			$nombre,
			$costo,
			$informacion,
			date("Y-m-d H:i:s"),
			$id
		];

		$query = $this->db->prepare($sql);
		
		if($query->execute($bind)){
			return true;
		}else{
			return false;
		}
	}



	/*
	 * Get
	 */
	public function getExtras($id = null){
		$sql = "SELECT * FROM extras";
		
		$bind  = [];

		if (!is_null($id)) {
			$sql .= where($sql,'id = ?','');
			array_push($bind, $id);
		}

		$query = $this->db->prepare($sql);
		
		if($query->execute($bind)){
			
			if (!is_null($id)) {
				$res = $query->fetch(PDO::FETCH_OBJ);
			}else{
				$res = $query->fetchAll(PDO::FETCH_OBJ);
			}
			
			return $res;
		}else{
			return false;
		}
	}


	/**
	 * Insert
	 *
	 */
	public function insertExtras($nombre,$tipo_calculo,$deducir,$aumentar){
		$sql = "INSERT INTO extras (nombre,tipo_calculo,deducir,aumentar,created_at) 
		VALUES(?,?,?,?,?)";
		
		$bind = [
			$nombre,
			$tipo_calculo,
			$deducir,
			$aumentar,
			date("Y-m-d H:i:s")
		];

		$query = $this->db->prepare($sql);
		
		if($query->execute($bind)){
			return $this->db->lastInsertId();
		}else{
			return false;
		}
	}



	/**
	 * update
	 *
	 */
	public function updateExtras($id,$nombre,$tipo_calculo,$deducir,$aumentar){

		$sql = "UPDATE extras SET nombre = ? ,tipo_calculo = ? ,deducir = ? ,aumentar = ? , updated_at = ? 
		WHERE id = ?";

		$bind = [
			$nombre,
			$tipo_calculo,
			$deducir,
			$aumentar,
			date("Y-m-d H:i:s"),
			$id
		];

		$query = $this->db->prepare($sql);
		
		if($query->execute($bind)){
			return true;
		}else{
			return false;
		}
	}



	/*
	 * Get
	 */
	public function getDeducibles($id = null){
		$sql = "SELECT * FROM deducibles";
		
		$bind  = [];

		if (!is_null($id)) {
			$sql .= where($sql,'id = ?','');
			array_push($bind, $id);
		}

		$query = $this->db->prepare($sql);
		
		if($query->execute($bind)){
			
			if (!is_null($id)) {
				$res = $query->fetch(PDO::FETCH_OBJ);
			}else{
				$res = $query->fetchAll(PDO::FETCH_OBJ);
			}
			
			return $res;
		}else{
			return false;
		}
	}


	/**
	 * Insert
	 *
	 */
	public function insertDeducibles($nombre,$tipo_calculo,$deducir,$aumentar){
		$sql = "INSERT INTO deducibles (nombre,tipo_calculo,deducir,aumentar,created_at) 
		VALUES(?,?,?,?,?)";
		
		$bind = [
			$nombre,
			$tipo_calculo,
			$deducir,
			$aumentar,
			date("Y-m-d H:i:s")
		];

		$query = $this->db->prepare($sql);
		
		if($query->execute($bind)){
			return $this->db->lastInsertId();
		}else{
			return false;
		}
	}



	/**
	 * update
	 *
	 */
	public function updateDeducibles($id,$nombre,$tipo_calculo,$deducir,$aumentar){

		$sql = "UPDATE deducibles SET nombre = ? ,tipo_calculo = ? ,deducir = ? ,aumentar = ? , updated_at = ? 
		WHERE id = ?";

		$bind = [
			$nombre,
			$tipo_calculo,
			$deducir,
			$aumentar,
			date("Y-m-d H:i:s"),
			$id
		];

		$query = $this->db->prepare($sql);
		
		if($query->execute($bind)){
			return true;
		}else{
			return false;
		}
	}


	/*
	 * Get
	 */
	public function getPolizas($id = null){
		$sql = "SELECT p.*, i.nombre AS inmueble, c.nombre AS cliente, s.nombre AS seguro FROM polizas AS p 
		INNER JOIN inmuebles AS i ON p.id_inmueble = i.id 
		INNER JOIN clientes AS c ON i.id_cliente = c.id 
		INNER JOIN seguros AS s ON p.id_seguro = s.id";
		
		$bind  = [];

		if (!is_null($id)) {
			$sql .= where($sql,'p.id = ?','');
			array_push($bind, $id);
		}

		$query = $this->db->prepare($sql);
		
		if($query->execute($bind)){
			
			if (!is_null($id)) {
				$res = $query->fetch(PDO::FETCH_OBJ);
			}else{
				$res = $query->fetchAll(PDO::FETCH_OBJ);
			}
			
			return $res;
		}else{
			return false;
		}
	}


	/**
	 * Insert
	 *
	 */
	public function insertPolizas($subtotal,$total,$fecha_inicio,$fecha_final,$id_inmueble,$id_seguro,$id_deducible){
		
		$sql = "INSERT INTO polizas (subtotal,total,fecha_inicio,fecha_final,id_inmueble,id_seguro,id_deducible,created_at)
		VALUES(?,?,?,?,?,?,?,?)";
		
		$bind = [
			$subtotal,
			$total,
			$fecha_inicio,
			$fecha_final,
			$id_inmueble,
			$id_seguro,
			$id_deducible,
			date("Y-m-d H:i:s")
		];

		$query = $this->db->prepare($sql);
		
		if($query->execute($bind)){
			return $this->db->lastInsertId();
		}else{
			return false;
		}
	}



	/**
	 * update
	 *
	 */
	public function updatePolizas($id,$subtotal,$total,$fecha_inicio,$fecha_final,$id_inmueble,$id_seguro,$id_deducible){

		$sql = "UPDATE polizas SET subtotal = ?,total = ?,fecha_inicio = ?,fecha_final = ?,id_inmueble = ?, 
		id_seguro = ?,id_deducible = ?, updated_at = ? WHERE id = ?";

		$bind = [
			$subtotal,
			$total,
			$fecha_inicio,
			$fecha_final,
			$id_inmueble,
			$id_seguro,
			$id_deducible,
			date("Y-m-d H:i:s"),
			$id
		];

		$query = $this->db->prepare($sql);
		
		if($query->execute($bind)){
			return true;
		}else{
			return false;
		}
	}


	/*
	 * Get
	 */
	public function getPolizasExtras($id_poliza = null){
		$sql = "SELECT * FROM polizas_extras";
		
		$bind  = [];

		if (!is_null($id_poliza)) {
			$sql .= where($sql,'id_poliza = ?','');
			array_push($bind, $id_poliza);
		}

		$query = $this->db->prepare($sql);
		
		if($query->execute($bind)){
			
			$res = $query->fetchAll(PDO::FETCH_OBJ);
			
			return $res;
		}else{
			return false;
		}
	}


	/**
	 * Insert
	 *
	 */
	public function insertPolizasExtras($id_extra,$id_poliza){
		
		$sql = "INSERT INTO polizas_extras (id_extra,id_poliza,created_at)
		VALUES(?,?,?)";
		
		$bind = [
			$id_extra,
			$id_poliza,
			date("Y-m-d H:i:s")
		];

		$query = $this->db->prepare($sql);
		
		if($query->execute($bind)){
			return $this->db->lastInsertId();
		}else{
			return false;
		}
	}



	/**
	 * update
	 *
	 */
	public function updatePolizasExtras($id,$id_extra,$id_poliza){

		$sql = "UPDATE polizas_extras SET id_extra = ?,id_poliza = ?, updated_at = ? WHERE id = ?";

		$bind = [
			$id_extra,
			$id_poliza,
			date("Y-m-d H:i:s"),
			$id
		];

		$query = $this->db->prepare($sql);
		
		if($query->execute($bind)){
			return true;
		}else{
			return false;
		}
	}



	/*
	 * Get
	 */
	public function getInmueblesMateriales($id_inmueble = null){
		$sql = "SELECT im.*, i.nombre AS inmueble, c.nombre AS propietario, mc.nombre AS material, mc.tipo_calculo as tipo_calculo, mc.deducir AS deducir, mc.aumentar AS aumentar  
		FROM inmuebles_materiales AS im INNER JOIN inmuebles AS i ON im.id_inmueble = i.id 
		INNER JOIN clientes AS c ON i.id_cliente = c.id INNER JOIN materiales_construccion AS mc ON im.id_material = mc.id";
		
		$bind  = [];

		if (!is_null($id_inmueble)) {
			$sql .= where($sql,'id_inmueble = ?','');
			array_push($bind, $id_inmueble);
		}

		$query = $this->db->prepare($sql);
		
		if($query->execute($bind)){
			
			$res = $query->fetchAll(PDO::FETCH_OBJ);
			
			return $res;
		}else{
			return false;
		}
	}


	/**
	 * Insert
	 *
	 */
	public function insertInmueblesMateriales($id_material,$id_inmueble){
		
		$sql = "INSERT INTO inmuebles_materiales (id_material,id_inmueble,created_at)
		VALUES(?,?,?)";
		
		$bind = [
			$id_material,
			$id_inmueble,
			date("Y-m-d H:i:s")
		];

		$query = $this->db->prepare($sql);
		
		if($query->execute($bind)){
			return $this->db->lastInsertId();
		}else{
			return false;
		}
	}



	/**
	 * update
	 *
	 */
	public function updateInmueblesMateriales($id,$id_material,$id_inmueble){

		$sql = "UPDATE inmuebles_materiales SET id_material = ?,id_inmueble = ?, updated_at = ? WHERE id = ?";

		$bind = [
			$id_material,
			$id_inmueble,
			date("Y-m-d H:i:s"),
			$id
		];

		$query = $this->db->prepare($sql);
		
		if($query->execute($bind)){
			return true;
		}else{
			return false;
		}
	}


	/**
	 * Funciones Generales desde aqui
	 *
	 */
	public function delete($table,$id){
		
		$sql = "DELETE FROM $table WHERE id = ?";

		$bind = [$id];

		$query = $this->db->prepare($sql);
		
		if($query->execute($bind)){
			return true;
		}else{
			return false;
		}
	}

	/**
	 * Funcion query
	 *
	 */
	public function query($sql){
		$this->db->query($sql);
	}

	public function status($table,$id,$status){

		$sql = "UPDATE $table SET status = ?, updated_at = ? WHERE id = ?";

		$bind = [$status,date('Y-m-d H:i:s'),$id];

		$query = $this->db->prepare($sql);
		
		if($query->execute($bind)){
			return true;
		}else{
			//var_export($query->errorInfo());die;
			return false;
		}
	}
	
}