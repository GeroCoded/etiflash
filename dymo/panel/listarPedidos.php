<?php 

/* Sublime Text 3: TabSize=4  */

/**
 * Lista de pedidos para la tabla del Panel de Control.
 * 
 * Archivo PHP para mostrar en la tabla del Panel de Control la lista de
 * pedidos que hay en la BD. Este archivo está adaptado para el plugin de
 * DataTables del lado del Servidor (server-side).
 *
 * Para más información sobre las variables que se trabajan en este archivo
 * por favor visite la siguiente página web:
 * https://datatables.net/manual/server-side
 * 
 * PHP version 7.2.10
 *
 * @author Luis Fernando Gerónimo Carranza <luisfergeronimo@gmail.com>
 * @author Jesús Emmanuel Zetina Chevez <zcjo151173@upemor.edu.mx>
 */

/**
 * Se requiere de la conexión a la base de datos para hacer la consulta
 * de los datos del formulario.
 */
include_once '../includes/db.php';


/**
 * Se incluye una vez el archivo de la clase 'queryGenerico' donde están las
 * funciones utilizadas para acceder a la base de datos.
 */
include_once  '../includes/model/queryGenerico.php';

/**
 * Se incluye una vez el archivo moneyFormat donde están las funciones
 * utilizadas para imprimir el costo en un formato adecuado.
 */
include_once  '../includes/moneyFormat.php';


/**
 * En nuestro caso, DataTables maneja las columnas de nuestras tablas por medio
 * de índices (empezando desde el 0). Cada índice representa cierta columna.
 * Aquí transformamos el índice que recibimos al nombre de nuestra columna.
 * 
 * @param  int    $columna  índice recibido por DataTables en el array
 *                          "$order['0']['column']".
 *                       
 * @return String        	nombre de la columna de nuestra tabla para poder
 *                          ordenar en MySQL.
 */
function getColumnaNombre($columna){
	switch ($columna) {
		case 0: return 'empresa';
		case 1: return 'telefono';
		case 2: return 'nombres';
		case 3: return '`fecha-de-pedido`';
		case 4: return '`fecha-de-entrega`';
		case 5: return 'estado';
		case 6: return 'cantidad';
		case 7: return 'costo';
		case 8: return 'Producto';
	}
}

function getEstado($estadoString){
	switch (strtolower($estadoString)) {
		case 'en carrito'; return 1; break;
		case 'en proceso'; return 2; break;
		case 'pedido'; 	   return 3; break;
		case 'pagado';     return 4; break;
		case 'solicitud';  return 5; break;
		case 'cancelado';  return 6; break;
		case 'entregado';  return 7; break;
		default: 		   return $estadoString; break;
	}
}


//======================================================================
// DECLARACIÓN DE VARIABLES
//======================================================================

/**
 * Almacena los tipos de parámetros.
 *
 * Esta variables es la encargada de almacenar en un arreglo los tipos
 * de parámetros que se le pasarán al Prepared Statement.
 *
 * Recordemos que los tipos de parámetros son los siguientes:
 *   - 'i' -> int
 *   - 'd' -> double
 *   - 's' -> string
 *   - 'b' -> boolean
 * 
 * @var array
 */
$paramsType = array();

/**
 * Almacena los valores de los parámetros.
 *
 * Esta variables es la encargada de almacenar en un arreglo los valores
 * de los parámetros que se le pasarán al Prepared Statement.
 * 
 * @var array
 */
$paramsValues = array();


/**
 * Variable 'QueryGenerico' para hacer consultas y registros en la BD.
 * 
 * @var QueryGenerico
 */
$queryGenerico = new QueryGenerico();

// Especificación de la tabla con la que se trabajará.
$queryGenerico->setTable("ListarPedidosView");

// Especificación del select
$queryGenerico->setSelect('*');



//=============================================================================
// OBTENCIÓN DE VARIABLES RECIBIDAS POR DATATABLES POR MEDIO DE SOLICITUD POST
//=============================================================================

/* 
 * En esta sección se obtienen las variables que se reciben por parte del plugin
 * DataTables. Para más información sobre dichas variables, por favor visite la
 * siguiente página web:
 * https://datatables.net/manual/server-side#Sent-parameters
 */

//-----------------------------------------------------
// Valor De Búsqueda
//-----------------------------------------------------

/*
 * Se verifica si existe algún valor de búsqueda. Es decir, si el usuario
 * escribió algo en el buscador de la tabla DataTables.
 */
if(isset($_POST['search']['value'])) {
	/**
	 * Variables recibida por parte del plugin 'DataTables'.
	 * 
	 * DataTables envía lo que el vendedor o administrador ingresa en el
	 * input del buscador dentro de la tabla de DataTables y nos lo envía
	 * a este archivo para poder buscar este valor dentro de nuestra BD.
	 * 
	 * @var String
	 */
	$searchValue = $_POST['search']['value'];
	
	/**
	 * Valor de búsqueda filtrado por medio de una expresión regular (Regex)
	 * 
	 * Se ha encontrado que caracteres de la wildcard 'LIKE' (_ y %) no son
	 * filtrados o "escapados" por defecto en las consultas de los
	 * Prepared Statements así que puede producir resultados inesperados.
	 *
	 * Por lo tanto, cuando se usa 'LIKE' en una consulta, se debe usar
	 * un Regex para asegurarse de filtrar o "escapar" estos caracteres.
	 * 
	 * @var String
	 */
	$searchValue = preg_replace('/(?<!\\\)([%_])/', '\\\$1',$searchValue);

	/*
	 * Se evalúa si lo que está buscando el usuario es el estado de algún pedido
	 * llevando el valor del buscador a una función donde compara los valores
	 * en string de los estados, y devuelve el número equivalente al estado.
	 */
	$searchValueEstado = getEstado($searchValue = $_POST['search']['value']);
	
	/*
	 * Especifiación de condición 'Where' para buscar dentro de las columnas 
	 * 'nombre', 'apellidoP' y 'usuario'.
	 */
	$queryGenerico->setWhere('estado = ? OR empresa LIKE CONCAT("%",?,"%") OR telefono LIKE CONCAT("%",?,"%") OR nombres LIKE CONCAT("%",?,"%") OR `fecha-de-pedido` LIKE CONCAT("%",?,"%") OR `fecha-de-entrega` LIKE CONCAT("%",?,"%") OR cantidad LIKE CONCAT("%",?,"%") OR costo LIKE CONCAT("%",?,"%") OR producto LIKE CONCAT("%",?,"%")');

		/*
		 * Se 'empuja' el tipo de dato ('i') del parámetro al arreglo
		 * 'paramsType'.
		 */
		array_push($paramsType, 'i');

		// Se 'empuja' el valor (searchValueEstado) del parámetro al arreglo
		// 'paramsValues'.
		array_push($paramsValues, $searchValueEstado);
	
	// Cuenta el número de veces que se repite el signo '?'.
	$n = substr_count($queryGenerico->getWhere(), '?');

	// Reproduce n-1 veces el tipo de parámetro 's' (String) y el valor del SearchValue
	for ($i=0; $i < $n-1; $i++) { 

		/*
		 * Se 'empuja' el tipo de dato ('s') del parámetro al arreglo
		 * 'paramsType'.
		 */
		array_push($paramsType, 's');

		// Se 'empuja' el valor (searchValue) del parámetro al arreglo
		// 'paramsValues'.
		array_push($paramsValues, $searchValue);
	}
}


//-----------------------------------------------------
// Ordenamiento
//-----------------------------------------------------

/*
 * Se verifica si existe algún valor de ordenamiento. Es decir, si el
 * usuario le click al botón de ordenar la columna, ya sea de forma
 * ascendente o descendente.
 */
if(isset($_POST['order'])){
	/**
	 * Array de ordenamiento
	 *
	 * Esta variable se encarga de almacenar el array enviado por DataTables
	 * que nos dice la columna por la que vas a ordenar los datos
	 * (['0']['column']) y la dirección, ascendente o descendente
	 * (['0']['dir']).
	 * 
	 * @var array
	 */
	$order = $_POST['order'];

	/*
	 *Se remplaza el índice obtenido de DataTables por el nombre de nuestra
	 *columna dentro de MySQL para poder ordenar nuestros datos.
	 */
	$order['0']['column'] = getColumnaNombre($order['0']['column']);


	$queryGenerico->setOrder($order['0']['column'].' '.$order['0']['dir']);
}


//-----------------------------------------------------
// Límite De Cantidad De Datos
//-----------------------------------------------------

/*
 * Datatables siempre envía la variable length para saber si requiere de todas
 * las filas del resultado o sólo N números de filas.
 * 
 * Se verifica si la variable POST length es diferente a -1. -1 significa que
 * DataTables quiere todas las filas del resultado.
 *
 * Que sea diferente de -1 significa que existe 1 variable POST. Sabemos que
 * existe así que no es necesario verificar si existe con el método isset.
 * Ésta es la variable start.
 * 
 * 
 */
if($_POST['length'] != -1){
	/**
	 * Indica desde qué fila DataTables quiere el resultado.
	 * @var int
	 */
 	$start = $_POST['start'];

 	/**
 	 * Indica hasta qué fila DataTables quiere el resultado.
 	 * @var int
 	 */
 	$length = $_POST['length'];

 	// Se especifican los parámetros del Prepared Statement.
 	$queryGenerico->setLength('?, ?');
	
	// Se asigna el valor Start a nuestro objeto QueryGenerico.
 	$queryGenerico->setStartValue($start);

 	// Se asigan el valor Length a nuestro objeto QueryGenerico.
 	$queryGenerico->setLengthValue($length);

 	/*
 	 * Cabe denotar que para este proceso, no asignamos diréctamente los tipos
 	 * de parámetros del Prepared Statement ni sus valores. Esto se debe a que
 	 * dentro del método fetchData se hace este proceso ya que primero se
 	 * desea saber el número total de filas resultadas de la consulta y
 	 * poniendo el límite obtenido aquí limitaríamos y afectaríamos ese número
 	 * total de filas.
 	 *
 	 * DataTables necesita que se le mande el número total de filas y el número
 	 * de filas filtradas, es decir, el número de filas límitadas por estas dos
 	 * variables.
 	 *
 	 * Para más detallles, referirse al método fetchData dentro de la clase
 	 * @QueryGenerico.
 	 */
}

//-----------------------------------------------------
// Asignación De Los Parámetros Del Prepared Statement
//-----------------------------------------------------

/*
 * Se asignan todos nuestros tipos de parámetros, y sus respectivos
 * valores, obtenidos en los procesos anteriores.
 */
$queryGenerico->setParamsType($paramsType);
$queryGenerico->setParamsValues($paramsValues);


//======================================================================
// EJECUCIÓN DE CONSULTA Y EXTRACCIÓN DE LOS RESULTADOS
//======================================================================

//-----------------------------------------------------
// Ejecución De Consulta
//-----------------------------------------------------

/** @var array Almacena el número de filas obtenidas y las filas mismas */
$resArr = $queryGenerico->fetchData();


//-----------------------------------------------------
// Extracción De Los Resultados
//-----------------------------------------------------
//
/** @var int Almacena el número de filas filtradas o "limitadas". */
$number_filter_row = $resArr['recordsFiltered'];

/*
 * Se extraen las filas a la misma variable pero quitando el número de filas
 * filtradas.
 */
$resArr = $resArr['records'];


//======================================================================
// TRANSFORMACIÓN DE DATOS OBTENIDOS A ELEMENTOS HTML
//======================================================================


/**
 * Almacena los elementos HTML que se enviarán a DataTables.
 * Estos elementos se almacenan en grupos de a 5 por índice.
 * Es decir, data[0] tendra 5 elementos y así...
 * 
 * Cada elemento dentro de un índice representa 1 columna. Y cada índice
 * representa 1 fila.
 *
 * Ejemplo:
 *   - data[0][0] -> Fila 1 Columna 1
 *   - data[0][1] -> Fila 1 Columna 2
 *   - data[0][2] -> Fila 1 Columna 2
 *   - data[1][0] -> Fila 2 Columna 1
 * 
 * @var array
 */
$data = array();
setlocale(LC_MONETARY, 'es_MX');

// Se recorren las filas obtenidas de la consulta fetchData.
for ($i=0; $i < count($resArr); $i++) { 
	/**
	 * Almacena los elementos HTML que se enviarán a DataTables.
	 * Estos elementos se almacenan uno por íncide.
	 * Es decir, sub_array[0] tendrá 1 div o 1 button.
	 * 
	 * @var array
	 */
 	$sub_array = array();

 	/*
 	 * Nota: 'id' representa a la columna de MySQL llamada 'zonaID' dentro
 	 * 	     de la tabla 'Empresa'. Por ende, representa a la columna 'Zona'.
 	 *
 	 * Se verifica si la columna de Zona (que es la de 'id') es null.
 	 * En caso de serlo, se le asigna un String con la leyenda 'Sin zona'.
 	 */
	if($resArr[$i]["id"] === null){
		$resArr[$i]["id"] = 'Sin zona';
	}

	switch ($resArr[$i]["estado"]) {
		case 1: $resArr[$i]["estado"] = 'En carrito'; break;
		case 2: $resArr[$i]["estado"] = 'En proceso'; break;
		case 3: $resArr[$i]["estado"] = 'Pedido'; break;
		case 4: $resArr[$i]["estado"] = 'Pagado'; break;
		case 5: $resArr[$i]["estado"] = 'Solicitud'; break;
		case 6: $resArr[$i]["estado"] = 'Cancelado'; break;
		case 7: $resArr[$i]["estado"] = 'Entregado'; break;
	}

	if($resArr[$i]["fecha-de-entrega"] == null || $resArr[$i]["fecha-de-entrega"] == '' || $resArr[$i]["fecha-de-entrega"] == '0000-00-00'){
		$resArr[$i]["fecha-de-entrega"] = "Sin entregar";
	}

	$resArr[$i]["costo"] = money_format('%i', $resArr[$i]["costo"]);

	// Se transforman los datos obtenidos de cada columna en un div que se enviará a DataTables.
 	$sub_array[] = '<div  data-id="' . $resArr[$i]["empresaID"] . '" data-column="empresa">' 	 . $resArr[$i]["empresa"]           . '</div>';
 	$sub_array[] = '<div  data-id="' . $resArr[$i]["empresaID"] . '" data-column="empresa">' 	 . $resArr[$i]["telefono"] 	        . '</div>';
 	$sub_array[] = '<div  data-id="' . $resArr[$i]["clienteID"] . '" data-column="cliente">' 	 . $resArr[$i]["nombres"] 			. '</div>';
 	$sub_array[] = '<div  data-id="' . $resArr[$i]["id"] 		. '" data-column="pedidosview">' . $resArr[$i]["fecha-de-pedido"]   . '</div>';
 	$sub_array[] = '<div  data-id="' . $resArr[$i]["id"] 		. '" data-column="pedidosview">' . $resArr[$i]["fecha-de-entrega"]  . '</div>';
 	$sub_array[] = '<div  data-id="' . $resArr[$i]["id"] 		. '" data-column="pedidosview">' . $resArr[$i]["estado"]            . '</div>';
 	$sub_array[] = '<div  data-id="' . $resArr[$i]["id"] 		. '" data-column="pedidosview">' . $resArr[$i]["cantidad"]          . '</div>';
 	$sub_array[] = '<div  data-id="' . $resArr[$i]["id"] 		. '" data-column="pedidosview">' . $resArr[$i]["costo"]             . '</div>';
 	$sub_array[] = '<div  data-id="' . $resArr[$i]["id"] 		. '" data-column="pedidosview">' . $resArr[$i]["producto"]          . '</div>';

 	// Se agrega un botón en la última columna que servirá para editar los datos de la fila.
 	$sub_array[] = '<button type="button" name="detalles" class="btn btn-info btn-xs detalles p-1" id="'.$resArr[$i]["id"].'">Detalles</button>';

 	// Se pasa el array de elementos HTML al array data.
 	$data[] = $sub_array;
}

/**
 * Almacena el número total de filas existentes en la tabla especificada al
 * inicio.
 * 
 * @var int
 */
$recordsTotal = $queryGenerico->getAllData();

// Se verifica si el numero de filas filtradas es nulo
if($number_filter_row===null){
	/*
	 * Si es nulo, el número de filas filtradas será igual al número total
	 * de filas existentes en la tabla de la base de datos.
	 */
	$number_filter_row = $recordsTotal;
}

/**
 * Se almacenan todos los datos que requiere DataTables para funcionar
 * correctamente en un arreglo.
 * 
 * Se verifica que POST draw sea de valor numérico y no un dato malicioso de
 * parte de alguien atancando al sistema. (XSS).
 *
 * Para más información sobre las siguientes variables, por favor ir a:
 * https://datatables.net/manual/server-side#Returned-data
 *
 * @var array
 */
$output = array(
 	"draw"    => intval($_POST["draw"]),
 	"recordsTotal"  =>  $recordsTotal,
 	"recordsFiltered" => $number_filter_row,
 	"data"    => $data
);

// Se imprime el arreglo output en formato JSON para que lo reciba DataTables.
echo json_encode($output);

?>