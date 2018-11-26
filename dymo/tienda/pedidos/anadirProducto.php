<?php
/* Sublime Text 3  Tab-Size: 4 */

/**
 * Archivo PHP para añadir productos al carrito
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


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	//======================================================================
	// VERIFICACIÓN DE VARIABLES POST
	//======================================================================

	//-----------------------------------------------------
	// Datos Del Pedido
	//-----------------------------------------------------
	
	if(isset($_POST['origen'])){
		$origen = $_POST['origen'];

		if($origen === 'tienda'){

			if( isset($_POST['clienteID']) &&
				isset($_POST['cantidad']) &&
				isset($_POST['producto'])
			){



				//======================================================================
				// OBTENCIÓN DE VARIABLES POST
				//======================================================================
				
				//-----------------------------------------------------
				// Datos Del Pedido
				//-----------------------------------------------------
				$clienteID 		= $_POST['clienteID'];
				$cantidad 		= $_POST['cantidad'];
				$producto 		= $_POST['producto'];
				$fechaPedido = date('Y-m-d');
				$fechaEntrega = null;
				$estado = 1;
				$detalles = null;







				//======================================================================
				// VERIFICAR SI EXISTE ALGÚN PEDIDO CREADO EN EL CARRITO
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
				$queryGenerico->setSelect('*');

				// Especificación del where
				$queryGenerico->setWhere('clienteID = ? AND estado = 1');

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
				$queryGenerico->setParamsValues(array($clienteID));

				// Obtener pedidos del cliente
				$pedidosCarrito = $queryGenerico->read();


				if(sizeof($pedidosCarrito) > 0){




					//======================================================================
					// VERIFICAR SI EXISTE ALGÚN PEDIDO CON EL MISMO PRODUCTO 
					//======================================================================


					/**
					 * Variable 'QueryGenerico' para hacer las consultas en la BD.
					 * 
					 * @var QueryGenerico
					 */
					$queryGenerico = new QueryGenerico();

					// Especificación de la tabla con la que se trabajará.
					$queryGenerico->setTable('pedidosView');

					// Especificación del select
					$queryGenerico->setSelect('*');

					// Especificación del where
					$queryGenerico->setWhere('clienteID = ? AND estado = ? AND producto = ?');

					/*
					 * Especificación de los tipos de parámetros en forma de array.
					 *
					 * Tipos de datos:
					 *   - 'i' -> int
					 *   - 'd' -> double
					 *   - 's' -> string
					 *   - 'b' -> boolean
					 */
					$queryGenerico->setParamsType(array('i', 'i', 's'));

					// Especificación de los parámetros en forma de array.
					$queryGenerico->setParamsValues(array($clienteID, $estado, $producto));

					// Obtener pedidos del cliente
					$pedidos = $queryGenerico->read();





					if(sizeof($pedidos) > 0){
						// Ya existe un pedido en el carrito con ese producto

						$pedidoID = $pedidos[0]['pedidoID'];
						$cantidad = $cantidad + $pedidos[0]['cantidad'];
						$costo = obtenerCosto($producto, $cantidad);

						//======================================================================
						// ACTUALIZAR LA FECHA DEL PEDIDO A 'HOY' - TABLA['PEDIDO']
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
						$queryGenerico->setSet('fechaPedido = ?');

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

						// Modificar fecha de pedido
						$queryGenerico->update();




						//======================================================================
						// ACTUALIZAR LA CANTIDAD Y EL COSTO TOTAL DEL PEDIDO - TABLA['PEDIDO_PRODUCTO']
						//======================================================================

						/**
						 * Variable 'QueryGenerico' para hacer las consultas en la BD.
						 * 
						 * @var QueryGenerico
						 */
						$queryGenerico = new QueryGenerico();

						// Especificación de la tabla con la que se trabajará.
						$queryGenerico->setTable('pedido_producto');

						// Especificación del select
						$queryGenerico->setSet('cantidad = ?, costo = ?');

						// Especificación del where
						$queryGenerico->setWhere('pedidoID = ? AND productoCodigo = ?');

						/*
						 * Especificación de los tipos de parámetros en forma de array.
						 *
						 * Tipos de datos:
						 *   - 'i' -> int
						 *   - 'd' -> double
						 *   - 's' -> string
						 *   - 'b' -> boolean
						 */
						$queryGenerico->setParamsType(array('i', 'd', 'i', 's'));

						// Especificación de los parámetros en forma de array.
						$queryGenerico->setParamsValues(array($cantidad, $costo, $pedidoID, $producto));

						// Modificar cantidad y costo
						$queryGenerico->update();

						$GLOBALS['results']['result'] = true;













					} else {

						$pedidoID = $pedidosCarrito[0]['id'];

						$costo = obtenerCosto($producto, $cantidad);

						// Pedido del mismo producto NO EXISTENTE.

						//======================================================================
						// CREAR NUEVO PRODUCTO DENTRO DEL CARRITO
						//======================================================================

						/**
						 * Variable 'QueryGenerico' para hacer las modificaciones en la BD.
						 * 
						 * @var QueryGenerico
						 */
						$queryGenerico = new QueryGenerico();

						// Especificación de la tabla con la que se trabajará.
						$queryGenerico->setTable('pedido_producto');

						// Especificación de columnas a las que se les asignará un valor.
						$queryGenerico->setFields('pedidoID, productoCodigo, cantidad, costo, detalles');

						// Especificación de espacios de valores
						$queryGenerico->setValues('?, ?, ?, ?, ?');


						/*
						 * Especificación de los tipos de parámetros en forma de array.
						 *
						 * Tipos de datos:
						 *   - 'i' -> int
						 *   - 'd' -> double
						 *   - 's' -> string
						 *   - 'b' -> boolean
						 */
						$queryGenerico->setParamsType(array('i', 's', 'i', 'd', 's'));

						// Especificación de los parámetros en forma de array.
						$queryGenerico->setParamsValues(array($pedidoID, $producto, $cantidad, $costo, $detalles));

						// Ejecución de la función 'create()'.
						$GLOBALS['results'] = $queryGenerico->create();


						$GLOBALS['results']['result'] = true;
					}



























				} else {
					// No existe ningún carrito de este cliente
					

					/*
					INSERT INTO pedidosView(`fecha-de-pedido`, `fecha-de-entrega`, estado, clienteId) VALUES ('2018-11-18', NULL, 1, 5);
					INSERT INTO pedidosView(pedidoID, producto, cantidad, costo, detalles) VALUES (2, 'RI38X300MCP', 10, 353.00, NULL);
					 */
				
					//======================================================================
					// INSERCIÓN DE LOS DATOS DEL PEDIDO - PARTE I [TABLA: PEDIDO]
					//======================================================================

					/**
					 * Variable 'QueryGenerico' para hacer las modificaciones en la BD.
					 * 
					 * @var QueryGenerico
					 */
					$queryGenerico = new QueryGenerico();

					// Especificación de la tabla con la que se trabajará.
					$queryGenerico->setTable('Pedido');

					// Especificación de columnas a las que se les asignará un valor.
					$queryGenerico->setFields('fechaPedido, fechaEntrega, estado, clienteID');

					// Especificación de espacios de valores
					$queryGenerico->setValues('?, ?, ?, ?');

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
					$queryGenerico->setParamsValues(array($fechaPedido, $fechaEntrega, $estado, $clienteID));

					// Ejecución de la función 'create()'.
					$GLOBALS['results'] = $queryGenerico->create();

					// Obtención de la llave primaria del pedido creado.
					$pedidoID = $GLOBALS['results']['primaryKey'];


					//======================================================================
					// OBTENCIÓN DEL COSTO DEL PRODUCTO Y COSTO TOTAL DEL PEDIDO
					//======================================================================

					$costo = obtenerCosto($producto, $cantidad);



					//======================================================================
					// INSERCIÓN DE LOS DATOS DEL PEDIDO - PARTE II [TABLA: PEDIDO_PRODUCTO]
					//======================================================================

					/**
					 * Variable 'QueryGenerico' para hacer las modificaciones en la BD.
					 * 
					 * @var QueryGenerico
					 */
					$queryGenerico = new QueryGenerico();

					// Especificación de la tabla con la que se trabajará.
					$queryGenerico->setTable('pedido_producto');

					// Especificación de columnas a las que se les asignará un valor.
					$queryGenerico->setFields('pedidoID, productoCodigo, cantidad, costo, detalles');

					// Especificación de espacios de valores
					$queryGenerico->setValues('?, ?, ?, ?, ?');


					/*
					 * Especificación de los tipos de parámetros en forma de array.
					 *
					 * Tipos de datos:
					 *   - 'i' -> int
					 *   - 'd' -> double
					 *   - 's' -> string
					 *   - 'b' -> boolean
					 */
					$queryGenerico->setParamsType(array('i', 's', 'i', 'd', 's'));

					// Especificación de los parámetros en forma de array.
					$queryGenerico->setParamsValues(array($pedidoID, $producto, $cantidad, $costo, $detalles));

					// Ejecución de la función 'create()'.
					$GLOBALS['results'] = $queryGenerico->create();


					$GLOBALS['results']['result'] = true;
				}


			}

		} else if($origen === 'panel'){
			// Inserción desde el panel.
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