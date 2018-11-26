<?php
/* Sublime Text 3  Tab-Size: 4 */

/**
 * Archivo PHP para realizar el pedido desde el carrito
 *
 *
 * @author Luis Fernando Gerónimo Carranza <luisfergeronimo@gmail.com>
 * @author Jesús Emmanuel Zetina Chevez <zcjo151173@uepmor.edu.mx>
 */

/*
 * Se requiere de la conexión a la base de datos.
 */
require '../../includes/db.php';

/*
 * Se requiere de la clase 'QueryGenerico' para hacer consultas a la BD para
 * filtrar los productos.
 */
require '../../includes/model/queryGenerico.php';

/**
 * Variable global para almacenar los resultados que se enviarán al front-end.
 * 
 * Posibles valores:
 * 	+ $GLOBALS['results']['result'] = TRUE  - si hubo una inserción exitosa
 * 						 			  FALSE - en caso contrario
 * 	+ $GLOBALS['results']['reason'] = INT-> -1: La solicitud no es POST
 * 											 0: No se llenaron todos los datos
 * 											 1: Error de odificación
 */
$GLOBALS['results'] = [];
$GLOBALS['results']['create'] = [];


// Zona horaria de la Ciudad de México.
date_default_timezone_set("America/Mexico_City");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	//======================================================================
	// VERIFICACIÓN DE VARIABLES POST
	//======================================================================

	//-----------------------------------------------------
	// Datos Del Pedido
	//-----------------------------------------------------
	
	if(isset($_POST['pedidoID'])){

		//======================================================================
		// OBTENCIÓN DE VARIABLES POST
		//======================================================================
		
		//-----------------------------------------------------
		// Datos Del Pedido
		//-----------------------------------------------------
		$pedidoID = $_POST['pedidoID'];
		$fechaPedido = date('Y-m-d');


		//======================================================================
		// ACTUALIZAR EL ESTADO DEL PEDIDO
		//======================================================================

		/**
		 * Variable 'QueryGenerico' para hacer las consultas en la BD.
		 * 
		 * @var QueryGenerico
		 */
		$queryGenerico = new QueryGenerico();

		// Especificación de la tabla con la que se trabajará.
		$queryGenerico->setTable('pedido');

		// Especificación del select
		$queryGenerico->setSet('estado = 3, fechaPedido = ?');

		// Especificación del where
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
		$queryGenerico->setParamsType(array('s', 'i'));

		// Especificación de los parámetros en forma de array.
		$queryGenerico->setParamsValues(array($fechaPedido, $pedidoID));

		// Ejecucíón del update.
		$GLOBALS['results']['info'] = $queryGenerico->update();

		$GLOBALS['results']['result'] = true;

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