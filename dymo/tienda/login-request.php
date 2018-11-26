<?php 

/* Sublime Text 3 */

/**
 * Archivo php para la consulta del log in del cliente/distribuidor
 *
 * Aquí se hace una consulta a la base de datos por medio del coreo y
 * contraseña del cliente/distribuidor que se reciben del front-end por medio
 * del POST REQUEST.
 * 
 * PHP version 7.2.10
 *
 * @author Luis Fernando Gerónimo Carranza <luisfergeronimo@gmail.com>
 * @author Jesús Emmanuel Zetina Chevez <zcjo151173@upemor.edu.mx>
 * 
 *
 * 
 */

/**
 * Se inicia una session
 */
session_start();

/**
 * Se requiere de la conexión a la base de datos
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
 * 	+ $GLOBALS['results']['match'] = TRUE si encontró el correo y la contraseña
 * 						 			 FALSE en caso contrario
 * 	+ $GLOBALS['results']['rows'] = INT el número de filas encontradas
 *  + $GLOBALS['results'][0] = ARRAY los valores del usuario encontrado
 */
$GLOBALS['results'] = array();

/*
 * Se revisa si el tipo de consulta es por medio de POST.
 */
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if(isset($_POST['correo']) && isset($_POST['contrasena'])){


		/*
		 * Se obtiene el correo y la contraseña por medio de las variables POST.
		 */
		$correo_input = $_POST['correo'];
		$contrasena_input = $_POST['contrasena'];


		/*
		 * Se crea un objeto QueryGenerico para hacer la consulta a la base de datos.
		 */
		$queryGenerico = new QueryGenerico();
		$queryGenerico->setTable('Cliente');
		$queryGenerico->setSelect('id, nombre, apellidoP, apellidoM, correo, contrasena');
		$queryGenerico->setWhere('correo = ? AND contrasena = ?');

		/*
		 * Se asignan los tipos de parámetros que irán en los '?', dentro del query.
		 * Éstos deben ir en el mismo orden a como están puestos los '?'.
		 */
		$queryGenerico->setParamsType(array('s', 's'));

		/*
		 * Se asignan los valores de los parámetros en el mismo orden que los tipos de
		 * parámetros.
		 */
		$queryGenerico->setParamsValues(array($correo_input, $contrasena_input));

		/*
		 * Se ejecuta la función 'read()' para hacer la consulta en la base de datos.
		 * Se almacenan las filas encontradas en la variable global 'results'.
		 */
		$GLOBALS['results'] = $queryGenerico->read();

		//var_dump($GLOBALS['results']);

		if($GLOBALS['results']){

			// Se separan los nombres en caso de que tenga más de uno.
			$nombre = explode(' ', $GLOBALS['results'][0]['nombre']);

			/*
			 * La función de explode devuelve un arreglo vacío cuando no encuentra
			 * espacios en los nombres. Esto quiere decir que el usuario sólo tiene
			 * 1 nombre.
			 */
			if(!empty($nombre)){

				/*
				 * Se guarda el nombre del usuario en la variable de sesión.
				 * Se escoge el primer nombre y el primer apellido.
				 */
				$_SESSION['nombre'] = $nombre[0] . ' ' . $GLOBALS['results'][0]['apellidoP'];

				// Se guarda el id en la sesión.
				$_SESSION['id'] = $GLOBALS['results'][0]['id'];
			} else {

				/*
				 * Se guarda el nombre del usuario en la variable de sesión.
				 * Se escoge el nombre que se obtuvo de la BD y el primer apellido.
				 */
				$_SESSION['nombre'] = $GLOBALS['results'][0]['nombre'] . ' ' . $GLOBALS['results'][0]['apellidoP'];
			}

			$GLOBALS['results']['rows'] = sizeof($GLOBALS['results']);
			$GLOBALS['results']['match'] = "true";
		} else {

			/*
			 * Si 'results' devuelve false, se pone la llave 'match' como false.
			 * Si no devuelve falso, significa que contiene la(s) fila(s) enctrada(s)
			 * por ende se pone la llave 'match' como true y 'rows' como la longitud
			 * del array 'results'.
			 */
			$GLOBALS['results']['match'] = "false";
		}



	} else {
		/*
		 * Si no se encuentran el correo y la contraseña, se pone la llave 'match'
		 * como false y en 'message' se pone el mensaje que podría leer el usuario.
		 */
		$GLOBALS['results']['match'] = 'false';
		$GLOBALS['results']['message'] = 'Favor de llenar todos los campos.';
	}

	/*
	 * Se manda un http response code de 200.
	 * Se le dice la header que el contenido ese de tipo json.
	 * Se imprime el array dentro la variable global 'results' en formato json.
	 */
	http_response_code(200);
	header('Content-Type: application/json');
	echo json_encode($GLOBALS['results']);
}
?>