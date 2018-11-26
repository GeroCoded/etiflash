<?php

/* Sublime Text 3: Tab Size=4  */

/**
 * Inserción de un cliente en la base de datos
 * 
 * Archivo PHP para hacer inserciones en la base de datos dentro
 * del modal después de dar click en el botón "Añadir registro".
 * 
 * PHP version 7.2.10
 *
 * @author Luis Fernando Gerónimo Carranza <luisfergeronimo@gmail.com>
 * @author Jesús Emmanuel Zetina Chevez <zcjo151173@upemor.edu.mx>
 */

/**
 * Se requiere de la conexión a la base de datos para hacer las inserciones
 * de los registros de las direcciones.
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
		// Datos De Cuenta Personal (Cliente)
		//-----------------------------------------------------
	if( isset($_POST['id']) && 
	    isset($_POST['nombre']) && 
		isset($_POST['apellidoP']) &&
		isset($_POST['apellidoM']) &&
		isset($_POST['telefono']) &&
		isset($_POST['correo'])
	){

		//======================================================================
		// OBTENCIÓN DE VARIABLES POST
		//======================================================================
		
		//-----------------------------------------------------
		// Datos De Cuenta Personal (Cliente)
		//-----------------------------------------------------
		$id 			= $_POST['id'];
		$nombre			= $_POST['nombre'];
		$apellidoP 		= $_POST['apellidoP'];
		$apellidoM 		= $_POST['apellidoM'];
		$telefono 		= $_POST['telefono'];
		$correo 		= $_POST['correo'];

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
		$queryGenerico->setTable('Cliente');

		// Especificación de columnas a las que se les asignará un valor.
		$queryGenerico->setFields('nombre, apellidoP, apellidoM, telefono, correo, empresaID');

		// Espacios de los valores de los parámetros.
		$queryGenerico->setValues('?, ?, ?, ?, ?, ?, ?, ?');

		// Tipos de parámetros de los valores.
		$queryGenerico->setParamsType(array('s', 's', 's', 's', 's', 'i'));

		// Valores de los parámetros.
		$queryGenerico->setParamsValues(array($municipio, $estado, $cp, $colonia, $calle, $numeroExt, $numeroInt, $id));

		// Ejecución del query.
		$GLOBALS['results']= $queryGenerico->create();
		$GLOBALS['results']['result'] = true;
	} else {

		$GLOBALS['results']['result'] = false;
		$GLOBALS['results']['reason'] = 0;
	}


} else {
	$GLOBALS['results']['result'] = false;
	$GLOBALS['results']['reason'] = -1;
}

?>