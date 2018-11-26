<?php
/* Sublime Text 3  Tab-Size: 4 */

/**
 * Archivo PHP corto para modificar la cantidad de un pedido
 *
 *
 * @author Luis Fernando Gerónimo Carranza <luisfergeronimo@gmail.com>
 * @author Jesús Emmanuel Zetina Chevez <zcjo151173@upemor.edu.mx>
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


function obtenerCosto($producto, $cantidad){

	//======================================================================
	// OBTENCIÓN DEL COSTO DEL PRODUCTO Y COSTO TOTAL DEL PEDIDO
	//======================================================================

	/**
	 * Variable 'QueryGenerico' para hacer las modificaciones en la BD.
	 * 
	 * @var QueryGenerico
	 */
	$queryGenerico = new QueryGenerico();

	// Especificación de la tabla con la que se trabajará.
	$queryGenerico->setTable('Producto');

	// Especificación del select
	$queryGenerico->setSelect('*');

	// Especificación del where
	$queryGenerico->setWhere('codigo = ?');

	/*
	 * Especificación de los tipos de parámetros en forma de array.
	 *
	 * Tipos de datos:
	 *   - 'i' -> int
	 *   - 'd' -> double
	 *   - 's' -> string
	 *   - 'b' -> boolean
	 */
	$queryGenerico->setParamsType(array('s'));

	// Especificación de los parámetros en forma de array.
	$queryGenerico->setParamsValues(array($producto));

	// Obtener costo total del pedido.
	$costo = $queryGenerico->read()[0]['costo'] * $cantidad;

	return $costo;
}



if($_SERVER['REQUEST_METHOD'] == 'POST'){
	if( isset($_POST['cantidad']) &&
		isset($_POST['pedidoID']) && 
		isset($_POST['codigo']) && 
		isset($_POST['operacion'])){


		$cantidad = $_POST['cantidad'];
		$pedidoID = $_POST['pedidoID']; 
		$codigo = $_POST['codigo'];
		$operacion = $_POST['operacion'];



		if($operacion == 'sumar'){
			if($cantidad < 9999){
				$cantidad = $cantidad + 1;
			}
		} else if($operacion == 'restar'){
			if($cantidad > 1){
				$cantidad = $cantidad - 1;
			}
		}

		$costo = obtenerCosto($codigo, $cantidad);

		//======================================================================
		// MODIFICAR CANTIDAD DEL PEDIDO
		//======================================================================

	    $queryGenerico = new QueryGenerico();
	    $queryGenerico->setTable('pedidosView');
	    $queryGenerico->setSet('cantidad = ?, costo = ?');
	    $queryGenerico->setWhere('pedidoID = ? AND producto = ?');
	    $queryGenerico->setParamsType(array('i', 'd', 'i', 's'));
	    $queryGenerico->setParamsValues(array($cantidad, $costo, $pedidoID, $codigo));
	    $result = $queryGenerico->update();


	} else {
		$result = false;
	}
} else {
	$result = false;
}

echo json_encode($result);

?>