<?php

/* Sublime Text 3: Tab Size=4  */

/**
 * Eliminación de algún registro en la base de datos
 * 
 * Archivo PHP para hacer eliminaciones en la base de datos dentro
 * del modal después de dar click en el botón "Eliminar".
 * 
 * PHP version 7.2.10
 *
 * @author Luis Fernando Gerónimo Carranza <luisfergeronimo@gmail.com>
 * @author Jesús Emmanuel Zetina Chevez <zcjo151173@upemor.edu.mx>
 */

/**
 * Se requiere de la conexión a la base de datos para hacer las eliminaciones
 * de los registros.
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

$results;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

		//======================================================================
		// VERIFICACIÓN DE VARIABLES POST
		//======================================================================

		//-----------------------------------------------------
		// Llave Primaria De Administrador
		//-----------------------------------------------------
	if( isset($_POST['id'])){

		//======================================================================
		// OBTENCIÓN DE VARIABLES POST
		//======================================================================
		
		//-----------------------------------------------------
		// Llave Primaria De Administrador
		//-----------------------------------------------------
		$id = $_POST['id'];


		//======================================================================
		// ELIMINACIÓN DE ADMINISTRADOR
		//======================================================================

		/**
		 * Variable 'QueryGenerico' para hacer las modificaciones en la BD.
		 * 
		 * @var QueryGenerico
		 */
		$queryGenerico = new QueryGenerico();

		// Especificación de la tabla con la que se trabajará.
		$queryGenerico->setTable('Administrador');

		/* Especificación de la condición del query con los espacios de 
		 * parámetros para el Prepared Statement.
		 */
		$queryGenerico->setWhere('id = ?');

		/*
		 * Especificación de los tipos de parámetros en forma de array.
		 *
		 * Tipos de datos:
		 *   - 'i' -> int
		 *   - 'd' -> double
		 *   - 's' -> string
		 *   - 'b' -> boolean
		 */
		$queryGenerico->setParamsType(array('i'));

		// Especificación de los parámetros en forma de array.
		$queryGenerico->setParamsValues(array($id));

		// Ejecución de la eliminación
		$GLOBALS['results'] = $queryGenerico->delete();


		if(!$GLOBALS['results']){
			$GLOBALS['results']['match'] = "false";
		} else {
			$GLOBALS['results']['match'] = "true";
			$GLOBALS['results']['rows'] = sizeof($GLOBALS['results'])-1;
		}



	} else {
		$results['match'] = 'false';
		$results['message'] = 'Favor de llenar todos los campos.';
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
}
?>