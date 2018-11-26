<?php

/* Sublime Text 3: Tab Size=4  */

/**
 * Modificación de pedidos en la base de datos
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
 * a los registros de los pedidos.
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
		// Datos Del Pedido
		//-----------------------------------------------------
	if( isset($_POST['id']) && 
	    isset($_POST['fecha-de-pedido']) && 
	    isset($_POST['fecha-de-entrega']) && 
		isset($_POST['estado']) &&
		isset($_POST['cantidad']) &&
		isset($_POST['costo']) &&
		isset($_POST['producto'])
	){

		//======================================================================
		// OBTENCIÓN DE VARIABLES POST
		//======================================================================
		
		//-----------------------------------------------------
		// Datos Del Pedido
		//-----------------------------------------------------
		$id 			= $_POST['id'];
		$fechaPedido	= $_POST['fecha-de-pedido'];
		$fechaEntrega	= $_POST['fecha-de-entrega'];
		$estado 		= $_POST['estado'];
		$cantidad 		= $_POST['cantidad'];
		$costo 			= $_POST['costo'];
		$producto 		= $_POST['producto'];

	
		//======================================================================
		// MODIFICACIÓN DE LOS DATOS DEL PEDIDO - PARTE I
		//======================================================================

		/**
		 * Variable 'QueryGenerico' para hacer las modificaciones en la BD.
		 * 
		 * @var QueryGenerico
		 */
		$queryGenerico = new QueryGenerico();

		// Especificación de la tabla con la que se trabajará.
		$queryGenerico->setTable('PedidosView');

		// Especificación de columnas a las que se les asignará un valor.
		$queryGenerico->setSet('`fecha-de-pedido` = ?, `fecha-de-entrega` = ?, estado = ?');

		// Especificación de espacios de parámetros para el Prepared Statement.
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
		$queryGenerico->setParamsType(array('s', 's', 'i', 'i'));

		// Especificación de los parámetros en forma de array.
		$queryGenerico->setParamsValues(array($fechaPedido, $fechaEntrega, $estado, $id));

		/* Ejecución de la función 'update() */
		/*
		 * QueryGenerico->update devuelve la información de la consulta.
		 *  - Rows matched:  (int) número de filas coincididas
		 *  - Changed: 		 (int) número de filas modificadas
		 *  - Warnings: 	 (int) número de warnings
		 */
		$GLOBALS['info'] = $queryGenerico->update();


		
		//======================================================================
		// MODIFICACIÓN DE LOS DATOS DEL PEDIDO - PARTE II
		//======================================================================

		/**
		 * Variable 'QueryGenerico' para hacer las modificaciones en la BD.
		 * 
		 * @var QueryGenerico
		 */
		$queryGenerico = new QueryGenerico();

		// Especificación de la tabla con la que se trabajará.
		$queryGenerico->setTable('PedidosView');

		// Especificación de columnas a las que se les asignará un valor.
		$queryGenerico->setSet('cantidad = ?, costo = ?, producto = ?');

		// Especificación de espacios de parámetros para el Prepared Statement.
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
		$queryGenerico->setParamsType(array('i', 'd', 's', 'i'));

		// Especificación de los parámetros en forma de array.
		$queryGenerico->setParamsValues(array($cantidad, $costo, $producto, $id));

		// Ejecución de la función 'update()'.
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