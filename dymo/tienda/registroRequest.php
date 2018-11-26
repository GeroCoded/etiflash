<?php

/* Sublime Text 3: Tab Size=4  */

/**
 * Registro del cliente en la base de datos
 * 
 * Archivo PHP para hacer el registro en la base de datos después de 
 * recibir los datos del formulario de registro desde el front-end.
 * 
 * PHP version 7.2.10
 *
 * @author Luis Fernando Gerónimo Carranza <luisfergeronimo@gmail.com>
 * @author Jesús Emmanuel Zetina Chevez <zcjo151173@upemor.edu.mx>
 */

/**
 * Se requiere de la conexión a la base de datos para hacer el registro
 * de los datos del formulario y consultas para evitar duplicados.
 */
include_once '../includes/db.php';

/**
 * Se incluye una vez el archivo de la clase 'queryGenerico' donde están las
 * funciones utilizadas para acceder a la base de datos.
 */
include_once  '../includes/model/queryGenerico.php';

/**
 * Variable global para almacenar los resultados que se enviarán al front-end.
 * 
 * Posibles valores:
 * 	+ $GLOBALS['results']['result'] = TRUE  - si hubo un registro exitoso
 * 						 			  FALSE - en caso contrario
 * 	+ $GLOBALS['results']['reason'] = INT-> -1: La solicitud no es POST
 * 											 0: No se llenaron todos los datos
 * 											 1: Nombre de empresa repetido
 * 											 2: Correo de cuenta repetido
 * 											 3: No se pudo registar la dirección
 */
$GLOBALS['results'] = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

		//======================================================================
		// VERIFICACIÓN DE VARIABLES POST
		//======================================================================

		//-----------------------------------------------------
		// Datos De Cuenta Personal
		//-----------------------------------------------------
	if( isset($_POST['nombres']) && 
		isset($_POST['apellidoP']) &&
		isset($_POST['telefono-cuenta']) &&
		isset($_POST['correo-cuenta']) &&

		//-----------------------------------------------------
		// Datos De La Empresa Del Cliente
		//-----------------------------------------------------
		isset($_POST['empresa']) &&
		isset($_POST['telefono-empresa']) &&
		isset($_POST['correo-empresa']) &&

		//-----------------------------------------------------
		// Datos De La Dirección De La Empresa
		//-----------------------------------------------------
		isset($_POST['estado']) &&
		isset($_POST['municipio']) &&
		isset($_POST['codigo-postal']) &&
		isset($_POST['colonia']) &&
		isset($_POST['calle']) &&
		isset($_POST['numero-ext']) &&

		//-----------------------------------------------------
		// Datos De Contraseña
		//-----------------------------------------------------
		isset($_POST['contrasena']) &&
		isset($_POST['contrasena-repetida'])
	){

		//======================================================================
		// OBTENCIÓN DE VARIABLES POST
		//======================================================================
		
		//-----------------------------------------------------
		// Datos De Cuenta Personal
		//-----------------------------------------------------
		$nombres = 			$_POST['nombres'];
		$apellidoP = 		$_POST['apellidoP'];
		$apellidoM = 		$_POST['apellidoM'];
		$telefonoCuenta = 	$_POST['telefono-cuenta'];
		$correoCuenta = 	$_POST['correo-cuenta'];

		//-----------------------------------------------------
		// Datos De La Empresa Del Cliente
		//-----------------------------------------------------
		$empresa = 			$_POST['empresa'];
		$telefonoEmpresa = 	$_POST['telefono-empresa'];
		$correoEmpresa = 	$_POST['correo-empresa'];

		//-----------------------------------------------------
		// Datos De La Dirección De La Empresa
		//-----------------------------------------------------
		$estado = 			$_POST['estado'];
		$municipio = 		$_POST['municipio'];
		$codigoPostal = 	$_POST['codigo-postal'];
		$colonia = 			$_POST['colonia'];
		$calle = 			$_POST['calle'];
		$numeroExt = 		$_POST['numero-ext'];
		$numeroInt = 		$_POST['numero-int'];

		//-----------------------------------------------------
		// Datos De Contraseña
		//-----------------------------------------------------
		$contrasena = 		$_POST['contrasena'];


	
		//======================================================================
		// CREACIÓN DE LA EMPRESA
		//======================================================================

		/**
		 * Variable 'QueryGenerico' para hacer consultas y registros en la BD.
		 * 
		 * @var QueryGenerico
		 */
		$queryGenerico = new QueryGenerico();

		// Especificación de la tabla con la que se trabajará.
		$queryGenerico->setTable('Empresa');

		// Especificación de columnas a las que se les asignará un valor.
		$queryGenerico->setFields('nombre, telefono, correo');

		// Especificación de espacios de parámetros para el Prepared Statement.
		$queryGenerico->setValues('?, ?, ?');

		/*
		 * Especificación de los tipos de parámetros en forma de array.
		 *
		 * Tipos de datos:
		 *   - 'i' -> int
		 *   - 'd' -> double
		 *   - 's' -> string
		 *   - 'b' -> boolean
		 */
		$queryGenerico->setParamsType(array('s', 's', 's'));

		// Especificación de los parámetros en forma de array.
		$queryGenerico->setParamsValues(array($empresa, $telefonoEmpresa, $correoEmpresa));

		// Ejecución de la función 'create()'.
		$resultsCreateEmpresa = $queryGenerico->create();


		/*
		 * QueryGenerico almacena el resultado de del query en la llave 'result'
		 * Si 'result' es falso, significa que está repetido el nombre de la
		 * empresa.
		 */
		if($resultsCreateEmpresa["result"]){

			//======================================================================
			// OBTENCIÓN DEL ID DE LA EMPRESA RECIENTEMENTE REGISTRADA
			//======================================================================

			/*
			 * Se obtiene el ID de la empresa para asignarla a la llave foránea
			 * del cliente y de la dirección.
			 */

			// Especificación de las columnas que se desean obtener
			$queryGenerico->setSelect('id, nombre');

			// Especificación de la condición
			$queryGenerico->setWhere('nombre = ?');

			$queryGenerico->setParamsType(array('s'));
			$queryGenerico->setParamsValues(array($empresa));

			// Ejecución de la función 'read()'.
			$resultsReadEmpresa = $queryGenerico->read();

			// Extracción del ID de la empresa.
			$empresaID = $resultsReadEmpresa[0]['id'];

			//======================================================================
			// CREACIÓN DE LA CUENTA DEL CLIENTE
			//======================================================================
			$queryGenerico = new QueryGenerico();
			$queryGenerico->setTable('Cliente');
			$queryGenerico->setFields('nombre, apellidoP, apellidoM, telefono, correo, contrasena, empresaID');
			$queryGenerico->setValues('?, ?, ?, ?, ?, ?, ?');
			$queryGenerico->setParamsType(array('s', 's', 's', 's', 's', 's', 'i'));
			$queryGenerico->setParamsValues(array($nombres, $apellidoP, $apellidoM, $telefonoCuenta, $correoCuenta, $contrasena, $empresaID));
			$resultsCreateCliente = $queryGenerico->create();

			if($resultsCreateCliente["result"]){
				//======================================================================
				// CREACIÓN DE LA DIRECCIÓN DE LA EMPRESA
				//======================================================================
				$queryGenerico = new QueryGenerico();
				$queryGenerico->setTable('Direccion');
				$queryGenerico->setFields('numeroExt, numeroInt, calle, colonia, cp, municipio, estado, empresaID');
				$queryGenerico->setValues('?, ?, ?, ?, ?, ?, ?, ?');
				$queryGenerico->setParamsType(array('i', 'i', 's', 's', 'i', 's', 's', 'i'));
				$queryGenerico->setParamsValues(array($numeroExt, $numeroInt, $calle, $colonia, $codigoPostal, $municipio, $estado, $empresaID));
				$resultsCreateDireccion = $queryGenerico->create();


				if($resultsCreateDireccion["result"]){

					$GLOBALS['results']['result'] = true;
				} else {
					$GLOBALS['results']['result'] = false;
					$GLOBALS['results']['reason'] = 3;
				}

			} else {
				$GLOBALS['results']['result'] = false;
				$GLOBALS['results']['reason'] = 2;
			}



		}else {
			$GLOBALS['results']['result'] = false;
			$GLOBALS['results']['reason'] = 1;
		}

	} else {

		$GLOBALS['results']['result'] = false;
		$GLOBALS['results']['reason'] = 0;
	}


} else {
	$GLOBALS['results']['result'] = false;
	$GLOBALS['results']['reason'] = -1;
}

//======================================================================
// RESPUESTA DEL SERVIDOR
//======================================================================

// Http response code = 200
http_response_code(200);
// El contenido que se enviará al front-end es de tipo json
header('Content-Type: application/json');
// 'Echo' de los resultados obtenidos
echo json_encode($GLOBALS['results']);
?>