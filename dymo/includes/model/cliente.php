<?php

class Cliente{
	public $id = null;
	public $nombres = null;
	public $apellidoP = null;
	public $apellidoM = null;
	public $telefono = null;
	public $correo = null;
	public $contrasena = null;
	public $empresaID = null;



	public $select = null;
	public $where = null;
	public $fields = null;
	public $values = null;

	public $params = null;
	public $paramsType = null;
	public $paramsValues = null;

	public $db;


	public function __construct() {

		$this->db = new Database();

	}

	public function constructor($id, $nombres, $apellidoP, $apellidoM, $telefono, $correo, $contrasena, $empresaID) {
		$this->id = $id;
		$this->nombres = $nombres;
		$this->apellidoP = $apellidoP;
		$this->apellidoM = $apellidoM;
	 	$this->telefono = $telefono;
		$this->correo = $correo;
		$this->contrasena = $contrasena;
		$this->empresaID = $empresaID;
	}



	public function read(){



		// Obtención del objecto de la conexión mysqli
		$mysqli = $this->db->getDB();

		// Query
		$query = "SELECT " . $this->select . " FROM Cliente ";

		if($this->where != null){
			$query .= " WHERE " . $this->where;
		}

		//echo "Query: " . $query;
		//echo "<br><br>";


		// Preparación del statement.
		$stmt = $mysqli->prepare($query);

		if($stmt === false) {
		  trigger_error('Wrong SQL: ' . $query . ' Error: ' . $mysqli->errno . ' ' . $mysqli->error, E_USER_ERROR);
		}
 

		$this->paramsBuilder();

		/* use call_user_func_array, as $stmt->bind_param('s', $param); does not accept params array */
		if(count($this->params) > 0){
			call_user_func_array(array($stmt, 'bind_param'), $this->params);
		}
		 
		/* Execute statement */
		$stmt->execute();

		// Obtención de los resultados.
		$resArr = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

/*
		if(!$resArr){
			$resArr['match'] = "false";
		} else {
			$resArr['match'] = "true";
			$resArr['rows'] = sizeof($resArr)-1;
		}
*/

		$stmt->close();
		$mysqli->close();
		return $resArr;
	}

	public function create(){



		// Obtención del objecto de la conexión mysqli
		$mysqli = $this->db->getDB();

		// Query
		$query = "INSERT INTO Cliente ";

		if($this->fields != null){
			$query .= "(".$this->fields.")";
		}

		$query .= " VALUES(".$this->values.")";

		//echo "Query: " . $query;
		//echo "<br><br>";


		// Preparación del statement.
		$stmt = $mysqli->prepare($query);

		if($stmt === false) {
		  trigger_error('Wrong SQL: ' . $query . ' Error: ' . $mysqli->errno . ' ' . $mysqli->error, E_USER_ERROR);
		}
 
		$this->paramsBuilder();

		/* use call_user_func_array, as $stmt->bind_param('s', $param); does not accept params array */
		call_user_func_array(array($stmt, 'bind_param'), $this->params);
		 

		/* Execute statement */
		$resArr['result'] = $stmt->execute();


		$stmt->close();
		$mysqli->close();
		return $resArr;
	}


	public function setSelect($select){
		$this->select = $select;
	}

	public function setWhere($where){
		$this->where = $where;
	}

	public function setFields($fields){
		$this->fields = $fields;
	}

	public function setValues($values){
		$this->values = $values;
	}

	public function setParamsType($paramsType){
		$this->paramsType = $paramsType;
	}

	public function setParamsValues($paramsValues){
		$this->paramsValues = $paramsValues;
	}

	public function closeConnection(){
		$mysqli->close();
	}



	public function paramsBuilder(){
		/* Bind parameters. Types: s = string, i = integer, d = double,  b = blob */
		$this->params = array();
		 
		$param_type_string = '';

		$n = count($this->paramsType);
		for($i = 0; $i < $n; $i++) {
			$param_type_string .= $this->paramsType[$i];
		}
		 
		/* with call_user_func_array, array params must be passed by reference */
		if($n>0){/* AÑADIR A DONDE SE DEBA */
			$this->params[] = & $param_type_string;
		}/* AÑADIR A DONDE SE DEBA */
		 
		for($i = 0; $i < $n; $i++) {
			/* with call_user_func_array, array params must be passed by reference */
	  		$this->params[] = & $this->paramsValues[$i];
		}

	}


/*
	public function paramAndColumnsBuilder(){
		//for ($i=0; $i <8 ; $i++) { 
		var param = '';
		var columns = '';
		var columnsN = 0;
		var where = '';

		if($id != null){
			param += 'i';
			columns += 'id';
			columnsN++;
			where += 'id = ?';
		}
		if($nombres != null){
			param += 's';
			if(columnsN > 0){
				columns += ', ';
				where += ' AND ';
			}
			columns += 'nombres';
			columnsN++;
			where += 'nombres = ?';
		}
		if($apellidoP != null){
			param += 's';
			if(columnsN > 0){
				columns += ', ';
				where += ' AND ';
			}
			columns += 'apellidoP';
			columnsN++;
			where += 'apellidoP = ?';
		}
		if($apellidoM != null){
			param += 's';
			if(columnsN > 0){
				columns += ', ';
				where += ' AND ';
			}
			columns += 'apellidoM';
			columnsN++;
			where += 'apellidoM = ?';
		}
		if($telefono != null){
			param += 's';
			if(columnsN > 0){
				columns += ', ';
				where += ' AND ';
			}
			columns += 'telefono';
			columnsN++;
			where += 'telefono = ?';
		}
		if($correo != null){
			param += 's';
			if(columnsN > 0){
				columns += ', ';
				where += ' AND ';
			}
			columns += 'correo';
			columnsN++;
			where += 'correo = ?';
		}
		if($contrasena != null){
			param += 's';
			if(columnsN > 0){
				columns += ', ';
				where += ' AND ';
			}
			columns += 'contrasena';
			columnsN++;
			where += 'contrasena = ?';
		}
		if($empresaID != null){
			param += 'i';
			if(columnsN > 0){
				columns += ', ';
				where += ' AND ';
			}
			columns += 'empresaID';
			columnsN++;
			where += 'empresaID = ?';
		}
		

		return array('params' => $params, 'columns' => $columns);

	}
	*/

}


class Zona{
	public $numeroExt;
	public $numeroInt;
	public $calle;
	public $colonia;
	public $cp;
	public $municipio;
	public $estado;
	public $empresaID;
}

?>