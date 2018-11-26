<?php

/* Sublime Text 3: Tab Size=4  */

/**
 * Modificación de la dirección en la base de datos
 * 
 * Archivo PHP para hacer modificaciones en la base de datos dentro
 * del modal después de dar click en el botón "Guardar cambios".
 * 
 * PHP version 7.2.10
 *
 * @author Luis Fernando Gerónimo Carranza <luisfergeronimo@gmail.com>
 * @author Jesús Emmanuel Zetina Chevez <zcjo151173@upemor.edu.mx>
 */

/**
 * Se requiere de la conexión a la base de datos para hacer las modificaciones
 * a los registros de las direcciones.
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
 * 	+ $GLOBALS['results']['result'] = TRUE  - si hubo una modificación exitosa
 * 						 			  FALSE - en caso contrario
 * 	+ $GLOBALS['results']['reason'] = INT-> -1: La solicitud no es POST
 * 											 0: No se llenaron todos los datos
 * 											 1: Error de odificación
 */
$GLOBALS['results'] = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

		//======================================================================
		// VERIFICACIÓN DE VARIABLES POST
		//======================================================================

		//-----------------------------------------------------
		// Datos De Dirección
		//-----------------------------------------------------
	if( isset($_POST['id']) && 
	    isset($_POST['estado']) && 
		isset($_POST['municipio']) &&
		isset($_POST['cp']) && 
		isset($_POST['colonia']) && 
		isset($_POST['calle']) && 
		isset($_POST['numeroExt']) && 
		isset($_POST['numeroInt'])
	){

		//======================================================================
		// OBTENCIÓN DE VARIABLES POST
		//======================================================================
		
		//-----------------------------------------------------
		// Datos De Dirección
		//-----------------------------------------------------
		$id 			= $_POST['id'];
		$estado			= $_POST['estado'];
		$municipio 		= $_POST['municipio'];
		$cp 			= $_POST['cp'];
		$colonia 		= $_POST['colonia'];
		$calle 			= $_POST['calle'];
		$numeroExt 		= $_POST['numeroExt'];
		$numeroInt 		= $_POST['numeroInt'];

	
		//======================================================================
		// MODIFICACIÓN DE LOS DATOS DE LA DIRECCIÓN
		//======================================================================

		/**
		 * Variable 'QueryGenerico' para hacer las modificaciones en la BD.
		 * 
		 * @var QueryGenerico
		 */
		$queryGenerico = new QueryGenerico();

		// Especificación de la tabla con la que se trabajará.
		$queryGenerico->setTable('Direccion');

		// Especificación de columnas a las que se les asignará un valor.
		$queryGenerico->setSet('estado = ?, municipio = ?, cp = ?, colonia = ?, calle = ?, numeroExt = ?, numeroInt = ?');

		// Especificación de espacios de parámetros para el Prepared Statement.
		$queryGenerico->setWhere('empresaID = ?');

		/*
		 * Especificación de los tipos de parámetros en forma de array.
		 *
		 * Tipos de datos:
		 *   - 'i' -> int
		 *   - 'd' -> double
		 *   - 's' -> string
		 *   - 'b' -> boolean
		 */
		$queryGenerico->setParamsType(array('s', 's', 'i', 's', 's', 'i', 'i', 'i'));

		// Especificación de los parámetros en forma de array.
		$queryGenerico->setParamsValues(array($estado, $municipio, $cp, $colonia, $calle, $numeroExt, $numeroInt, $id));

		/* Ejecución de la función 'update() */
		/*
		 * QueryGenerico->update devuelve la información de la consulta.
		 *  - Rows matched:  (int) número de filas coincididas
		 *  - Changed: 		 (int) número de filas modificadas
		 *  - Warnings: 	 (int) número de warnings
		 */
		$GLOBALS['results']['info'] = $queryGenerico->update();
		
		switch (true) {
			case $GLOBALS['results']['info']['Rows matched'] == 0:
				// 0 = No existe el registro. Se debe crear.

				//======================================================================
				// INSERCIÓN DE LOS DATOS DE LA DIRECCIÓN
				//======================================================================

				/**
				 * Variable 'QueryGenerico' para hacer la inserción en la BD.
				 * 
				 * @var QueryGenerico
				 */
				$queryGenerico = new QueryGenerico();
				// Especificación de la tabla con la que se trabajará.
				$queryGenerico->setTable('Direccion');

				// Especificación de columnas a las que se les asignará un valor.
				$queryGenerico->setFields('municipio, estado, cp, colonia, calle, numeroExt, numeroInt, empresaID');

				// Espacios de los valores de los parámetros.
				$queryGenerico->setValues('?, ?, ?, ?, ?, ?, ?, ?');

				// Tipos de parámetros de los valores.
				$queryGenerico->setParamsType(array('s', 's', 'i', 's', 's', 'i', 'i', 'i'));

				// Valores de los parámetros.
				$queryGenerico->setParamsValues(array($municipio, $estado, $cp, $colonia, $calle, $numeroExt, $numeroInt, $id));

				// Ejecución del query.
				$GLOBALS['results']= $queryGenerico->create();
				$GLOBALS['results']['result'] = true;
				break;

			case $GLOBALS['results']['info']['Changed'] >= 0:
				// >= 0 No fue necesario modificar el registro, o se logró modificar y no hubo problema.
				$GLOBALS['results']['result'] = true;
				break;
			
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
// 'Echo' de los resultados obtenidos en json
echo json_encode($GLOBALS['results']);
?>