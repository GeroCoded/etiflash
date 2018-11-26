<?php

/* Sublime Text 3: Tab Size=4  */

/**
 * Clase genérica para hacer operaciones en la BD de datos
 *
 * Este archivo maneja variables de operaciones SQL del lenguaje MySQL.
 * También maneja variables que maneja el plugin DataTables.
 * Finalmente, las operaciones se hacen por medio de Prepared Statements
 * para evitar los ataques de inyecciones SQL.
 *
 * 
 * PHP version 7.2.10
 *
 * @author Luis Fernando Gerónimo Carranza <luisfergeronimo@gmail.com>
 * @author Jesús Emmanuel Zetina Chevez <zcjo151173@upemor.edu.mx>
 * @todo  -  Analizar si es se puede juntar los métodos read y fetchData.
 */

/**
 * Un auxiliar genérico para hacer consultas a la base de datos
 * 
 * Ayuda a hacer el CRUD de la base de datos utilizando Prepared
 * Statements para evitar los ataques de inyecciones SQL.
 *
 * Es genérica ya que puede ser utilizada para todas las tablas
 * de la base de datos.
 *
 * Se hace uso extensivo de los Setter's para asignar los parámetros de los
 * Query's y de los Prepared Statements.
 *
 *
 * 
 * A continuación, se enlistan los métodos dentro de esta clase con los
 * atributos necesarios para ejecutar un query exitoso.
 *
 *  + fetchData():
 *  	- $_table  		:Obligatorio
 *      - $_where
 *      - $_order
 *      - $_length
 *      - $_startValue
 *      - $_lengthValue
 *      - $_paramsType
 *      - $_paramsValue
 *
 *  + getAllData():
 *  	- $_table 		:Obligatorio
 * 
 *  + read():
 *  	- Select     	:Obligatorio
 *  	- Tabla 		:Obligatorio
 *  	- Where
 *  	- ParamsType 	:Obligatorio, sólo si se asignaron espacios '?'
 *  	- ParamsValues  :Obligatorio, sólo si se asignaron espacios '?'
 *
 *  + create():
 *  	- Tabla 		:Obligatorio
 *  	- Fields
 *  	- Values 		:Obligatorio
 *  	- ParamsType 	:Obligatorio, ya que Values es obligatorio
 *  	- ParamsValues  :Obligatorio, ya que Values es obligatorio
 *
 *  + update():
 *  	- Tabla 		:Obligatorio
 *  	- Set 			:obligatorio
 * 		- Where 		:Obligatorio (preferentemente, aunque no lo es)
 *  	- ParamsType 	:Obligatorio, ya que Values es obligatorio
 *  	- ParamsValues  :Obligatorio, ya que Values es obligatorio
 * 
 *  + delete():
 *  	- Tabla 		:Obligatorio
 *  	- Where 		:Obligatorio
 *  	- ParamsType 	:Obligatorio, ya que Where es obligatorio
 *  	- ParamsValues  :Obligatorio, ya que Where es obligatorio
 *
 *
 * 
 * Ahora, clasificamos los parámetros para tener una mejor perspectiva de ellos:
 * 
 * //-----------------------------------------------------
 * // Parámetros de Query's:
 * //-----------------------------------------------------
 * 
 * 	 General:
 *   - Table - La tabla o vista afectada
 *   - Where - La condición del Query
 *
 *   SELECT
 *   - Select - Campos que se desean seleccionar
 *
 *   INSERT
 *   - $_fields - Los campos de la tabla del insert
 *   - $_values - Los valores para esos campos
 *
 *   UPDATE
 *   - $_set - Los campos de la tabla del update
 *   - $_values - Los valores para esos campos
 *
 * 
 * //-----------------------------------------------------
 * // Parámetros de Prepared Statement:
 * //-----------------------------------------------------
 *   - $_paramsType - Tipos de parámetros
 *   - $_paramsValues - Los valores para esos tipos de parámetros
 *
 * 
 * //-----------------------------------------------------
 * // Parámetros enviados por DataTables
 * //-----------------------------------------------------
 *   - $_order 	     - String de ordenamiento (e.g. 'id DESC')
 *   - $_startValue  - Variable de inicio de límite
 *   - $_lengthValue - Variable de límite
 *   - $_length 	 - String de parámetros de límite (e.g. '?, ?')
 * 
 * @author Luis Fernando Gerónimo Carranza <luisfergeronimo@gmail.com>
 * @author Jesús Emmanuel Zetina Chevez <zcjo151173@upemor.edu.mx>
 */
class QueryGenerico{

	//=====================================================================
	// DECLARACIÓN DE PROPIEDADES
	//======================================================================


	//-----------------------------------------------------
	// Propiedades De Query's
	//-----------------------------------------------------

	/**
	 * La tabla con la que se hará el Query.
	 * Ejemplo:
	 * 
	 * <code>
	 * $queryGenerico->setTable('cliente');
	 * </code>
	 * 
	 * @var String
	 */
	private $_table = null;

	/**
	 * La condición que se aplicará al Query.
	 *
	 * La condición suele venir con signos de interrogación para los 
	 * parámetros del Prepared Statement. 
	 * Ejemplo:
	 * 
	 * <code>
	 * $queryGenerico->setWhere('nombre = ? AND apellidoP = ?');
	 * </code>
	 * 
	 * @var String
	 */
	private $_where = null;

	/**
	 * Campos que se seleccionan en un query.
	 * Ejemplo:
	 * 
	 * <code>
	 * $queryGenerico->setSelect('nombre, apellidoP, correo' );
	 * </code>
	 * @var String
	 */
	private $_select = null;

	/**
	 * Los campos que serán insertados.
	 * Ejemplo:
	 * 
	 * <code>
	 * $queryGenerico->setFields('nombre, apellidoP, correo, telefono' );
	 * </code>
	 * 
	 * @var String
	 */
	private $_fields = null;

	/**
	 * Lo valores que serán asignados al insert o update.
	 * Ejemplo:
	 * 
	 * <code>
	 * $queryGenerico->setValues('?, ?, ?');
	 * </code>
	 * 
	 * @var String
	 */
	private $_values = null;

	/**
	 * Los campos de la tabla que se modificarán en el update.
	 * Ejemplo:
	 * 
	 * <code>
	 * $queryGenerico->setSet('nombre, apellidoP, correo, telefono');
	 * </code>
	 * 
	 * @var String
	 */
	private $_set = null;


	//-----------------------------------------------------
	// Propiedades De Prepared Statements
	//-----------------------------------------------------

	/**
	 * Los parámetros que serán "bindeados" al Query Statement dentro del
	 * Prepared Statement.
	 *
	 * Este arreglo contendrá los tipos de parámetros y los valores de
	 * los parámetros.
	 * 
	 * @var array
	 */
	private $_params = null;

	/**
	 * Los tipos de parámetros que serán "bindeados" al Query Statement
	 * dentro del Prepared Statement.
	 *
	 * Este arreglo contendrá los caracteres del tipo de parámetros.
	 *
	 * El número de tipos de parámetros debe ser igual que el número
	 * de valores de parámetros (@$_paramsValues).
	 * Ejemplo:
	 * 
	 * <code>
	 * $queryGenerico->setParamsType(array( 's', 's', 's', 's', 'i'));
	 * </code>
	 * 
	 * 
	 * @var array
	 */
	private $_paramsType = null;

	/**
	 * Los valores de parámetros que serán "bindeados" al Query Statement
	 * dentro del Prepared Statement.
	 *
	 * Este arreglo contendrá los valores del tipo de parámetros.
	 *
	 * El número de valores de parámetros debe ser igual que el número
	 * de tipos de parámetros (@$_paramsType).
	 * Ejemplo:
	 * 
	 * <code>
	 * $queryGenerico->setParamsValues(array( $nombre, $apellidoP, $apellidoM, $estado, $codigoPostal));
	 * </code>
	 * 
	 * @var array
	 */
	private $_paramsValues = null;



	//-----------------------------------------------------
	// Propiedades De DataTables
	//-----------------------------------------------------
	/**
	 * El orden en que debe ir el resultado de la consulta.
	 * Ejemplo:
	 * 
	 * <code>
	 * $queryGenerico->setOrder('nombre ASC');
	 * </code>
	 * 
	 * @var array
	 */
	private $_order = null;

	/**
	 * El índice de fila por el cual comienza a mostrase una consulta.
	 * Ejemplo:
	 * 
	 * <code>
	 * $queryGenerico->setStartValue(0);
	 * </code>
	 * 
	 * @var int
	 */
	private $_startValue = null;

	/**
	 * El índice límite de fila hasta donde termina de mostrase una consulta.
	 * Ejemplo:
	 * 
	 * <code>
	 * // Se muestran 10 filas apartir del índice de startValue.
	 * $queryGenerico->setLengthValue(10); 
	 * </code>
	 * 
	 * @var int
	 */
	private $_lengthValue = null;

	/**
	 * Los espacios de los parámetros para el LIMIT.
	 * Ejemplo:
	 * 
	 * <code>
	 * $queryGenerico->setLength('?, ?');
	 * </code>
	 * 
	 * @var String
	 */
	private $_length = null;

	/**
	 * La conexión a la Base de Dato.
	 * 
	 * @var Database
	 */
	private $_db;















	/**
	 * Constructor de la QueryGenerico
	 *
	 * Al instanciar un nuevo objeto QueryGenerico el constructor crea
	 * una nueva Base de Datos (Database).
	 */
	public function __construct() {

		$this->_db = new Database();

	}
















	/**
	 * Envía información de consultas para las tablas de DataTables
	 *
	 * Obtiene información de la base de datos en base a las variables que
	 * son enviadas por DataTables y recibidas en el servidor. Ya sea que
	 * el usuario administrador o vendedor haya querido ordenar una columna
	 * de forma ascendente o descendente, o que haya ingresado algún valor
	 * de búsqueda en el buscador.
	 * 
	 * Datos que se ocupan en este método:
	 *  - $_table  		:Obligatorio
	 *  - $_where
	 *  - $_order
	 *  - $_length
	 *  - $_startValue
	 *  - $_lengthValue
	 *  - $_paramsType
	 *  - $_paramsValue
	 * 
	 * Es necesario haber asignado la tabla. Los demás datos son opcionales.
	 *
	 * 
	 * @return array  arreglo con el número de filas filtradas (int), y otra
	 * 				  con los datos obtenidos
	 */	
	public function fetchData(){

		//======================================================================
		// BASE DE DATOS
		//======================================================================

		// Obtención del objeto de la conexión mysqli
		$mysqli = $this->_db->getDB();

		//======================================================================
		// QUERY
		//======================================================================


		//-----------------------------------------------------
		// SELECT [select] FROM [tabla]
		//-----------------------------------------------------
		
		// Declaración del Query.
		$query = "SELECT " . $this->_select . " FROM " . $this->_table;


		//-----------------------------------------------------
		// WHERE [where]
		//-----------------------------------------------------

		if($this->_where != null){ 
			$query .= ' WHERE ' . $this->_where; 
		}


		//-----------------------------------------------------
		// ORDER BY [order]
		//-----------------------------------------------------

		if($this->_order != null){
			$query .= ' ORDER BY ' . $this->_order;
		} else {
			$query .= ' ORDER BY id ASC ';
		}


		//-----------------------------------------------------
		// LIMIT [length]
		//-----------------------------------------------------
		
		$lengthQuery = '';

		if($this->_length != null){
		 	$lengthQuery = ' LIMIT ' . $this->_length;
		}



		//======================================================================
		// PREPARED STATEMENT
		//======================================================================

		//-----------------------------------------------------
		// Preparación Del Statement
		//-----------------------------------------------------
		/**
		 * Variable donde se almacena el Prepared Statement.
		 * @var statement object
		 */
		$stmt = $mysqli->prepare($query);


		//-----------------------------------------------------
		// Mensaje De Error
		//-----------------------------------------------------
		// Verificación de errores de sintaxis MySQL.
		if($stmt === false) {
			// Mensaje de sintaxis incorrecta.
		  	trigger_error('Wrong SQL: ' . $query . ' Error: ' . $mysqli->errno . ' ' . $mysqli->error, E_USER_ERROR);
		}


		//-----------------------------------------------------
		// Construcción De Los Parámetros
		//-----------------------------------------------------
		$this->paramsBuilder();

		//-----------------------------------------------------
		// Vinculación De Parámetros Con El Query
		//-----------------------------------------------------
		// Se verifica que el arreglo de parámetros al menos tenga uno.
		if(count($this->_params) > 0){
			// Se vincula el Statement con los parámetros ($this->_params)
			call_user_func_array(array($stmt, 'bind_param'), $this->_params);
		}
		 
		 
		//-----------------------------------------------------
		// Ejecucíón Del Prepared Statement
		//-----------------------------------------------------
		/*
		 * Se ejecuta el query con los parámetros vinculados. (O sin parámetros,
		 * en caso de que no haya habido ninguno.)
		 */
		$stmt->execute();
		
		/**
		 * Variable para el almacenamiento del numero de filas filtradas.
		 * Este valor se almacena en el arreglo que se retorna en esta función.
		 * 
		 * @var int
		 */
		$number_filter_row = null;

		
		/*
		 * Se verifica si el query del LIMIT o length está vacío o no.
		 * Vacío -> No hay ningún límite de filas.
		 * String -> startValue y lengthValue existen. Hay un límite.
		 */
    	if($lengthQuery != ''){

    		// Se almacena el resultado.
    		$stmt->store_result();

			// Se extrae el número de filas.
	    	$number_filter_row =  $stmt->num_rows;
		
			/*
			 * Se almacena el tipo de parámetro de startValue (int) al arreglo
			 * paramsType
			 */
			array_push($this->_paramsType, 'i');
			/* 
			 * Se almacena el valor del parámetro startValue al arreglo
			 *  paramsValues. 
			 */
			array_push($this->_paramsValues, $this->_startValue);
			
			
			/*
			 * Se almacena el tipo de parámetro del lengthValue (int) al arreglo
			 * paramsType.
			 */
			array_push($this->_paramsType, 'i');
			/* 
			 * Se almacena el valor del parámetro lengthValue al arreglo
			 *  paramsValues. 
			 */
			array_push($this->_paramsValues, $this->_lengthValue);


			//======================================================================
			// PREPARED STATEMENT
			//======================================================================

			//-----------------------------------------------------
			// Preparación Del Statement
			//-----------------------------------------------------
			$stmt = $mysqli->prepare($query.$lengthQuery);

			//-----------------------------------------------------
			// Mensaje De Error
			//-----------------------------------------------------
			// Verificación de errores de sintaxis MySQL.
			if($stmt === false) {
				// Mensaje de sintaxis incorrecta.
			  	trigger_error('Wrong SQL: ' . $query . ' Error: ' . $mysqli->errno . ' ' . $mysqli->error, E_USER_ERROR);
			}

			//-----------------------------------------------------
			// Construcción De Los Parámetros
			//-----------------------------------------------------
			$this->paramsBuilder();

			//-----------------------------------------------------
			// Vinculación De Parámetros Con El Query
			//-----------------------------------------------------
			// Se verifica que el arreglo de parámetros al menos tenga uno.
			if(count($this->_params) > 0){
				// Se vincula el Statement con los parámetros ($this->_params)
				call_user_func_array(array($stmt, 'bind_param'), $this->_params);
			}
			 
			//-----------------------------------------------------
			// Ejecucíón Del Prepared Statement
			//-----------------------------------------------------
			$stmt->execute();

		}


		//-----------------------------------------------------
		// Obtención De Resultados Del Prepared Statement
		//-----------------------------------------------------
		$resArr = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);


		//-----------------------------------------------------
		// Cierre De Los Objetos Stmt && Mysqli
		//-----------------------------------------------------
		$stmt->close();
		$mysqli->close();

		// 
		/*
		 * Retornamos un arreglo con:
		 *  - El número de filas filtradas, si es que hubo algún límite.
		 *    Si no hubo, el valor es null.
		 *
		 *  - Y los registros obtenidos de la consulta
		 */
		return array('recordsFiltered' => $number_filter_row, 'records' => $resArr);

	}
















	/**
	 * Función para obtener el número total de filas en una tabla.
	 * Datos que se ocupan en este método:
	 *  - $_table  		:Obligatorio
	 *  
	 * @return int  número total de filas en una tabla.
	 */
	public function getAllData(){
		//======================================================================
		// BASE DE DATOS
		//======================================================================

		// Obtención del objeto de la conexión mysqli
		$mysqli = $this->_db->getDB();


		//======================================================================
		// QUERY
		//======================================================================


		//-----------------------------------------------------
		// SELECT * FROM [tabla]
		//-----------------------------------------------------
		$query = "SELECT * FROM " . $this->_table;


		//======================================================================
		// PREPARED STATEMENT
		//======================================================================

		//-----------------------------------------------------
		// Preparación Del Statement
		//-----------------------------------------------------
		$stmt = $mysqli->prepare($query);

		//-----------------------------------------------------
		// Mensaje De Error
		//-----------------------------------------------------
		// Verificación de errores de sintaxis MySQL.
		if($stmt === false) {
			// Mensaje de sintaxis incorrecta.
		  	trigger_error('Wrong SQL: ' . $query . ' Error: ' . $mysqli->errno . ' ' . $mysqli->error, E_USER_ERROR);
		}
 
		//-----------------------------------------------------
		// Ejecucíón Del Prepared Statement
		//-----------------------------------------------------
		$stmt->execute();

		// Se almacena el resultado.
		$stmt->store_result();

		// Se obtiene el número de filas obtenidas.
		$num_rows = $stmt->num_rows;

		//-----------------------------------------------------
		// Cierre De Los Objetos Stmt && Mysqli
		//-----------------------------------------------------
		$stmt->close();
		$mysqli->close();
		
		/*
		 * Se retorna el número de filas obtenidas.
		 */
		return $num_rows;
	}



















	/**
	 * Método para hacer consultas en la BD. 
	 * Los sig. valores se ocupan en el método:
	 *  - Select     	:Obligatorio
	 *  - Tabla 		:Obligatorio
	 *  - Where
	 *  - ParamsType 	:Obligatorio, sólo si se asignaron espacios '?'
	 *  - ParamsValues  :Obligatorio, sólo si se asignaron espacios '?'
	 *  
	 * @return array  arreglo con las filas resultantes de la consulta.
	 */
	public function read(){

		//======================================================================
		// BASE DE DATOS
		//======================================================================

		// Obtención del objeto de la conexión mysqli
		$mysqli = $this->_db->getDB();

		//======================================================================
		// QUERY
		//======================================================================


		//-----------------------------------------------------
		// SELECT [select] FROM [tabla]
		//-----------------------------------------------------
		$query = "SELECT " . $this->_select . " FROM " . $this->_table;


		//-----------------------------------------------------
		//  WHERE [where]
		//-----------------------------------------------------
		if($this->_where != null){
			$query .= " WHERE " . $this->_where;
		}


		//======================================================================
		// PREPARED STATEMENT
		//======================================================================

		//-----------------------------------------------------
		// Preparación Del Statement
		//-----------------------------------------------------
		$stmt = $mysqli->prepare($query);


		//-----------------------------------------------------
		// Mensaje De Error
		//-----------------------------------------------------
		// Verificación de errores de sintaxis MySQL.
		if($stmt === false) {
			// Mensaje de sintaxis incorrecta.
		  trigger_error('Wrong SQL: ' . $query . ' Error: ' . $mysqli->errno . ' ' . $mysqli->error, E_USER_ERROR);
		}

		//-----------------------------------------------------
		// Construcción De Los Parámetros
		//-----------------------------------------------------
		$this->paramsBuilder();

		//-----------------------------------------------------
		// Vinculación De Parámetros Con El Query
		//-----------------------------------------------------
		// Se verifica que el arreglo de parámetros al menos tenga uno.
		if(count($this->_params) > 0){
			// Se vincula el Statement con los parámetros ($this->_params)
			call_user_func_array(array($stmt, 'bind_param'), $this->_params);
		}
		 
		//-----------------------------------------------------
		// Ejecucíón Del Prepared Statement
		//-----------------------------------------------------
		$stmt->execute();

		//-----------------------------------------------------
		// Obtención de los resultados
		//-----------------------------------------------------
		/*
		 * Se extraen los resultados del objeto Statement en forma de un
		 * arreglo asociativo con todas las filas resultantes.
		 */
		$resArr = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

		//-----------------------------------------------------
		// Cierre De Los Objetos Stmt && Mysqli
		//-----------------------------------------------------
		$stmt->close();
		$mysqli->close();

		// Se retorna el arreglo de resultados.
		return $resArr;
	}


















	/**
	 * Método para hacer inserciones en la BD. 
	 * Los sig. valores se ocupan en el método:
	 *  - Tabla 		:Obligatorio
	 *  - Fields
	 *  - Values 		:Obligatorio
	 *  - ParamsType 	:Obligatorio, ya que Values es obligatorio
	 *  - ParamsValues  :Obligatorio, ya que Values es obligatorio
	 *  
	 * @return array  arreglo con las filas resultantes de la consulta.
	 */
	public function create(){

		//======================================================================
		// BASE DE DATOS
		//======================================================================

		// Obtención del objeto de la conexión mysqli
		$mysqli = $this->_db->getDB();

		//======================================================================
		// QUERY
		//======================================================================


		//-----------------------------------------------------
		// INSERT INTO [Table]
		//-----------------------------------------------------
		$query = "INSERT INTO " . $this->_table;

		//-----------------------------------------------------
		//  ( [fields] )
		//-----------------------------------------------------
		if($this->_fields != null){
			$query .= "(".$this->_fields.")";
		}

		//-----------------------------------------------------
		// VALUES ( [values] )
		//-----------------------------------------------------
		$query .= " VALUES(".$this->_values.")";


		//======================================================================
		// PREPARED STATEMENT
		//======================================================================

		//-----------------------------------------------------
		// Preparación Del Statement
		//-----------------------------------------------------
		$stmt = $mysqli->prepare($query);

		//-----------------------------------------------------
		// Mensaje De Error
		//-----------------------------------------------------
		// Verificación de errores de sintaxis MySQL.
		if($stmt === false) {
			// Mensaje de sintaxis incorrecta.
		  	trigger_error('Wrong SQL: ' . $query . ' Error: ' . $mysqli->errno . ' ' . $mysqli->error, E_USER_ERROR);
		}
 
 		//-----------------------------------------------------
		// Construcción De Los Parámetros
		//-----------------------------------------------------
		$this->paramsBuilder();

		//-----------------------------------------------------
		// Vinculación De Parámetros Con El Query
		//-----------------------------------------------------
		// Se vincula el Statement con los parámetros ($this->_params)
		call_user_func_array(array($stmt, 'bind_param'), $this->_params);
		 

		//-----------------------------------------------------
		// Ejecucíón Del Prepared Statement
		//-----------------------------------------------------
		/*
		 * Se ejecuta el Prepared Statement y se almacena el resultado de la
		 * inserción. Puede ser verdadero o falso.
		 */
		$resArr['result'] = $stmt->execute();

		/*
		 * Se extrae la última llave primaria creada de la consulta INSERT.
		 */
		$resArr['primaryKey'] = $mysqli->insert_id;


		//-----------------------------------------------------
		// Obención Información De La Ejecución Del Query
		//-----------------------------------------------------
		/*
		 * Se obtiene el número de filas coincidentes, cambiasdas y warnings
		 * se almacena dentro del array info.
		 */
		$resArr['info'] = $this->_getRowsMatched($mysqli->info);

		//-----------------------------------------------------
		// Cierre De Los Objetos Stmt && Mysqli
		//-----------------------------------------------------
		$stmt->close();
		$mysqli->close();

		// Se retorna el arreglo de resultados.
		return $resArr;
	}










	/**
	 * Método para hacer modificaciones en la BD. 
	 * Los sig. valores se ocupan en el método:
 	 *  - Tabla 		:Obligatorio
 	 *  - Set 			:obligatorio
 	 *  - Where 		:Obligatorio (preferentemente, aunque no lo es)
  	 *  - ParamsType 	:Obligatorio, ya que Set es obligatorio
  	 *  - ParamsValues  :Obligatorio, ya que Set es obligatorio
	 *  
	 * @return array  arreglo con las filas resultantes de la consulta.
	 */
	public function update(){

		//======================================================================
		// BASE DE DATOS
		//======================================================================

		// Obtención del objeto de la conexión mysqli
		$mysqli = $this->_db->getDB();

		//======================================================================
		// QUERY
		//======================================================================


		//-----------------------------------------------------
		// UPDATE [table]
		//-----------------------------------------------------
		$query = "UPDATE " . $this->_table;

		//-----------------------------------------------------
		// SET [set]
		//-----------------------------------------------------
		$query .= " SET ".$this->_set;
		
		//-----------------------------------------------------
		// WHERE [where]
		//-----------------------------------------------------
		$query .= " WHERE ".$this->_where;


		//======================================================================
		// PREPARED STATEMENT
		//======================================================================

		//-----------------------------------------------------
		// Preparación Del Statement
		//-----------------------------------------------------
		$stmt = $mysqli->prepare($query);

		//-----------------------------------------------------
		// Mensaje De Error
		//-----------------------------------------------------
		// Verificación de errores de sintaxis MySQL.
		if($stmt === false) {
			// Mensaje de sintaxis incorrecta.
		  	trigger_error('Wrong SQL: ' . $query . ' Error: ' . $mysqli->errno . ' ' . $mysqli->error, E_USER_ERROR);
		}
 
 		//-----------------------------------------------------
		// Construcción De Los Parámetros
		//-----------------------------------------------------
		$this->paramsBuilder();

		//-----------------------------------------------------
		// Vinculación De Parámetros Con El Query
		//-----------------------------------------------------
		// Se vincula el Statement con los parámetros ($this->_params)
		call_user_func_array(array($stmt, 'bind_param'), $this->_params);
		 

		//-----------------------------------------------------
		// Ejecucíón Del Prepared Statement
		//-----------------------------------------------------
		/*
		 * Se ejecuta el Prepared Statement y se almacena el resultado de la
		 * inserción. Puede ser verdadero o falso.
		 */
		$stmt->execute();

		//-----------------------------------------------------
		// Obención Información De La Ejecución Del Query
		//-----------------------------------------------------
		/*
		 * Se obtiene el número de filas coincidentes, cambiasdas y warnings
		 * se almacena dentro del array info.
		 */
		$info = $this->_getRowsMatched($mysqli->info);

		//-----------------------------------------------------
		// Cierre De Los Objetos Stmt && Mysqli
		//-----------------------------------------------------
		$stmt->close();
		$mysqli->close();

		// Se retorna el número de filas afectadas.
		return $info;
	}











	/**
	 * Método para hacer eliminaciones en la BD. 
	 * Los sig. valores se ocupan en el método:
	 *  - Tabla 		:Obligatorio
	 *  - Where 		:Obligatorio
	 *  - ParamsType 	:Obligatorio, ya que Where es obligatorio
	 *  - ParamsValues  :Obligatorio, ya que Where es obligatorio
	 *  
	 * @return array  arreglo con las filas resultantes de la consulta.
	 */
	public function delete(){

		/*
		 * Verifica si la condición where está asignada o no con el fin de
		 * evitar errores de eliminar todos los registros de la tabla.
		 */
		if($this->_where != null){

			//======================================================================
			// BASE DE DATOS
			//======================================================================

			// Obtención del objeto de la conexión mysqli
			$mysqli = $this->_db->getDB();

			//======================================================================
			// QUERY
			//======================================================================

			//-----------------------------------------------------
			// DELETE FROM [Table] WHERE [where]
			//-----------------------------------------------------
			$query = "DELETE FROM " . $this->_table . " WHERE " . $this->_where;


			//======================================================================
			// PREPARED STATEMENT
			//======================================================================

			//-----------------------------------------------------
			// Preparación Del Statement
			//-----------------------------------------------------
			$stmt = $mysqli->prepare($query);

			//-----------------------------------------------------
			// Mensaje De Error
			//-----------------------------------------------------
			// Verificación de errores de sintaxis MySQL.
			if($stmt === false) {
				// Mensaje de sintaxis incorrecta.
			  	trigger_error('Wrong SQL: ' . $query . ' Error: ' . $mysqli->errno . ' ' . $mysqli->error, E_USER_ERROR);
			}


	 		//-----------------------------------------------------
			// Construcción De Los Parámetros
			//-----------------------------------------------------
			$this->paramsBuilder();

			//-----------------------------------------------------
			// Vinculación De Parámetros Con El Query
			//-----------------------------------------------------
			
			//-----------------------------------------------------
			// Vinculación De Parámetros Con El Query
			//-----------------------------------------------------
			// Se vincula el Statement con los parámetros ($this->_params)
			call_user_func_array(array($stmt, 'bind_param'), $this->_params);
			 

			//-----------------------------------------------------
			// Ejecucíón Del Prepared Statement
			//-----------------------------------------------------
			/*
			 * Se ejecuta el Prepared Statement y se almacena el resultado de la
			 * inserción. Puede ser verdadero o falso.
		 	*/
			$resArr['result'] = $stmt->execute();

			//-----------------------------------------------------
			// Cierre De Los Objetos Stmt && Mysqli
			//-----------------------------------------------------			
			$stmt->close();
			$mysqli->close();

			// Se retorna el arreglo de resultados.			
			return $resArr;
		} else {

			//Si no está asignado la condición Where, se retorna un falso.
			return false;
		}
	}


	private function _getRowsMatched($mysqliInfo){
		preg_match_all('/(\S[^:]+): (\d+)/', $mysqliInfo, $matches);
		$infoArr = array_combine ($matches[1], $matches[2]);
		return $infoArr;
	}

	/**
	 * Setter para la tabla con la que se va a trabajar.
	 * (Ver la declaración del atributo para encontrar un ejemplo.)
	 * 
	 * @param String $table String con el nombre de la tabla o vista.
	 */
	public function setTable($table){

		//======================================================================
		// CONVERSIÓN DEL NOMBRE DE LA TABLA A MAYÚSCULA (PRIMERA LETRA)
		//======================================================================

		$finalTable = '';

		// Se separa el nombre de la tabla en caso de que tenga '_' separando
		// los nombres de la tabla que deberían ir en mayúscula.
		$table = explode('_', $table);


		for ($i=0; $i < sizeof($table); $i++) { 
			$finalTable .= ucfirst($table[$i]);

			if($i < (sizeof($table) -1)){
				$finalTable .= '_';
			}
		}

		$this->_table = $finalTable;
	}

	/**
	 * Setter para la seleccion de columnas.
	 * (Ver la declaración del atributo para encontrar un ejemplo.)
	 * 
	 * @param String $select String con las columnas que se desean seleccionar.
	 */
	public function setSelect($select){
		$this->_select = $select;
	}

	/**
	 * Setter para la condición del query.
	 * (Ver la declaración del atributo para encontrar un ejemplo.)
	 * 
	 * @param String $where String con la condición where.
	 */
	public function setWhere($where){
		$this->_where = $where;
	}

	/**
	 * Setter para los campos que se desean insertar.
	 * (Ver la declaración del atributo para encontrar un ejemplo.)
	 * 
	 * @param String $length campos separados por coma.
	 */
	public function setFields($fields){
		$this->_fields = $fields;
	}

	/**
	 * Setter para los espacios de los parámetros de los valores que
	 * se desean insertar.
	 * (Ver la declaración del atributo para encontrar un ejemplo.)
	 * 
	 * @param String $length espacios de los parámetros separados por comas.
	 */
	public function setValues($values){
		$this->_values = $values;
	}

	/**
	 * Setter para los campos que se desean modificar.
	 * (Ver la declaración del atributo para encontrar un ejemplo.)
	 * 
	 * @param String $length campos separados por coma.
	 */
	public function setSet($set){
		$this->_set = $set;
	}

	/**
	 * Setter para los tipos de parámetros que se ocuparán en un query.
	 * (Ver la declaración del atributo para encontrar un ejemplo.)
	 * 
	 * @param array $length arreglo con caracteres, representando cada uno
	 *                      de los tipos de parámetros que se están pasando
	 *                      al query.
	 */
	public function setParamsType($paramsType){
		$this->_paramsType = $paramsType;
	}

	/**
	 * Setter para los valores de los parámetros que se ocuparán en un query.
	 * (Ver la declaración del atributo para encontrar un ejemplo.)
	 * 
	 * @param array $length arreglo con los valores de los parámetros.
	 */
	public function setParamsValues($paramsValues){
		$this->_paramsValues = $paramsValues;
	}

	/**
	 * Setter para el orden en que se desea que aparezcan los resultados
	 * (Ver la declaración del atributo para encontrar un ejemplo.)
	 * 
	 * @param String $order String con el nombre y tipo de ordenamiento.
	 */
	public function setOrder($order){
		$this->_order = $order;
	}

	/**
	 * Setter para los espacios de los parámetros del límite.
	 * (Ver la declaración del atributo para encontrar un ejemplo.)
	 * 
	 * @param String $length String con los espacios de los parámetros.
	 */
	public function setLength($length){
		$this->_length = $length;
	}

	/**
	 * Setter del comienzo del límite de los resultados
	 * (Ver la declaración del atributo para encontrar un ejemplo.)
	 * 
	 * @param int $length número del comienzo del límite.
	 */
	public function setStartValue($startValue){
		$this->_startValue = $startValue;
	}

	/**
	 * Setter del final del límite de los resultados
	 * (Ver la declaración del atributo para encontrar un ejemplo.)
	 * 
	 * @param int $length número del final del límite.
	 */
	public function setLengthValue($lengthValue){
		$this->_lengthValue = $lengthValue;
	}

	/**
	 * Getter para los tipos de parámetros que se ocuparán en un query.
	 * (Ver la declaración del atributo para encontrar un ejemplo.)
	 * 
	 * @param array $length arreglo con caracteres, representando cada uno
	 *                      de los tipos de parámetros que se están pasando
	 *                      al query.
	 */
	public function getParamsType(){
		return $this->_paramsType;
	}

	/**
	 * Getter para los valores de los parámetros que se ocuparán en un query.
	 * (Ver la declaración del atributo para encontrar un ejemplo.)
	 * 
	 * @param array $length arreglo con los valores de los parámetros.
	 */
	public function getParamsValues(){
		return $this->_paramsValues;
	}

	/**
	 * Getter para la condición del query.
	 * (Ver la declaración del atributo para encontrar un ejemplo.)
	 * 
	 * @param String $where String con la condición where.
	 */
	public function getWhere(){
		return $this->_where;
	}


	/**
	 * Método para construir nuestro arreglo 'params' que es el que contiene
	 * los tipos de parámetros con los valores de los mismos.
	 *
	 * Este arreglo es el que se vincula con el Statement. Los arreglos de
	 * paramsType y paramsValues sólo son auxiliares para poder construir
	 * este arreglo.
	 * 
	 * @return void  no regresa nada, simplemente almacena la información en el
	 *               atributo params para usarlo en los Query's.
	 */
	public function paramsBuilder(){
		//======================================================================
		// VINCULACIÓN DE PARÁMETROS
		//======================================================================

		/* 
		 * Los tipos de parámetros pueden ser los siguientes:
		 *   - s = string
		 *   - i = integer
		 *   - d = double
		 *   - b = blob 
		 */

		// Se inicializa un arreglo vacío dentro del atributo _params.
		$this->_params = array();
		 
		// Se declara e inicializa una variable string vacía.
		$param_type_string = '';

		// Contamos el número de tipos de parámetros que fueron asignados.
		$n = count($this->_paramsType);

		/*
		 * Pasamos los tipos de parámetros que están en un arreglo de caracteres
		 * a un sólo string:
		 * 
		 * 		   $_paramsType 	     |    $param_type_string
		 *  ---------------------------------------------------------
		 *   array('i', 's', 's', 'i')  -|>      'issi'
		 *   
		 */
		// Recorremos el arreglo de tipos de parámetros.
		for($i = 0; $i < $n; $i++) {
			// Concatenamos el caracter en la posición $i a la variable string.
			$param_type_string .= $this->_paramsType[$i];
		}
		 

		/*
		 * Si hay mínimo 1 parámetro, se almacena el string de los tipos de 
		 * parámetros.
		 *
		 * Nótese que hay un signo ampersand (&) antes de la variabel del string
		 * con los tipo de parámetros. Esto se debe a que no se está almacenando
		 * directamente, sino que estamos pasando al string por referencia.
		 *
		 * Es necesario hacer esto para poder vincular un array de parámetros al
		 * query que se ejecutará ya que el método 'call_user_func_array'
		 * requiere que los datos hayan sido pasados por referencia dentro del
		 * arreglo.
		 * 
		 */
		if($n>0){
			$this->_params[] = & $param_type_string;
		}
		 
		 /*
		  * Sucede los mismo con el arreglo de valores de los parámetros.
		  * Se pasan por referencia al arreglo _params.
		  */
		for($i = 0; $i < $n; $i++) {
	  		$this->_params[] = & $this->_paramsValues[$i];
		}

	}

}

?>