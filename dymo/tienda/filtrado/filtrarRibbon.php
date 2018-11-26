<?php
/* Sublime Text 3  Tab-Size: 4 */

/**
 * Filtro de la lista de productos de la tienda
 *
 * Se filtra la lista de productos dependiendo de lo que el usuario seleccione
 * en el menú izquierdo de filtrado.
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



$GLOBALS['results']['productos'] = [];
$GLOBALS['results']['request'] = false;


if($_SERVER['REQUEST_METHOD']=='POST'){
	if(isset($_POST['values'])){

		$values = $_POST['values'];

        if($values != null){
            $materiales = [];
            for ($i=0; $i < sizeof($values) ; $i++) {
                if($values[$i]['filtro'] == 'material'){
                    array_push($materiales, $values[$i]['name']);
                }
            }


            $maquinas = [];
            for ($i=0; $i < sizeof($values) ; $i++) {
                if($values[$i]['filtro'] == 'maquina'){
                    array_push($maquinas, $values[$i]['name']);
                }
            }


            $medidas = [];
            for ($i=0; $i < sizeof($values) ; $i++) {
                if($values[$i]['filtro'] == 'medida'){
                    array_push($medidas, substr($values[$i]['name'], 8));
                }
            }
    /*
            echo json_encode($materiales);
            echo "<br><br>";
            echo json_encode($maquinas);
            echo "<br><br>";
            echo json_encode($medidas);
            echo "<br><br>";
    */

            $where = '';

            for ($i=0; $i < sizeof($materiales); $i++) { 
                $where .= 'material LIKE CONCAT("%",?,"%")';
                if($i < sizeof($materiales)-1){
                    $where .= ' OR ';
                }

                 /*
                 * Se 'empuja' el tipo de dato ('s') del parámetro al arreglo
                 * 'paramsType'.
                 */
                array_push($paramsType, 's');

                // Se 'empuja' el valor (searchValue) del parámetro al arreglo
                // 'paramsValues'.
                array_push($paramsValues, $materiales[$i]);

            }


            /*
             * Si hay filtros de: materiales Y máquinas...
             */
            if(!empty($materiales) && !empty($maquinas)){
                $where .= ' OR ';
            }

            for ($i=0; $i < sizeof($maquinas); $i++) { 
                $where .= 'maquina LIKE CONCAT("%",?,"%")';
                if($i < sizeof($maquinas)-1){
                    $where .= ' OR ';
                }

                 /*
                 * Se 'empuja' el tipo de dato ('s') del parámetro al arreglo
                 * 'paramsType'.
                 */
                array_push($paramsType, 's');

                // Se 'empuja' el valor (searchValue) del parámetro al arreglo
                // 'paramsValues'.
                array_push($paramsValues, $maquinas[$i]);

            }

            /*
             * Si hay filtros de: materiales O máquinas Y medidas...
             */
            if((!empty($materiales) || !empty($maquinas)) && !empty($medidas)){
                $where .= ' OR ';
            }

            for ($i=0; $i < sizeof($medidas); $i++) {

                $where .= 'medidas LIKE CONCAT("%",?,"%")';
                if($i < sizeof($medidas)-1){
                    $where .= ' OR ';
                }

                 /*
                 * Se 'empuja' el tipo de dato ('s') del parámetro al arreglo
                 * 'paramsType'.
                 */
                array_push($paramsType, 's');

                // Se 'empuja' el valor (searchValue) del parámetro al arreglo
                // 'paramsValues'.
                array_push($paramsValues, $medidas[$i]);

            }
        } else {
            $where = null;
        }


        //echo "Where -> " . $where . "\n";




        $queryGenerico = new QueryGenerico();

        $queryGenerico->setTable('RibbonView');

        $queryGenerico->setSelect('*');

        $queryGenerico->setWhere($where);

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

		$GLOBALS['results']['result'] = $queryGenerico->read();


        //echo "Resultados: " . sizeof($GLOBALS['results']['result']) . "      | \n";

        $filasTotal = ceil(sizeof($GLOBALS['results']['result']) / 3);
        $columnasResiduales = sizeof($GLOBALS['results']['result'])%3;

		for ($i=0; $i < sizeof($GLOBALS['results']['result']); $i++) { 
           // echo "I (i): " . $i . "      |  \n\n";



            $fila = intdiv(($i), 3) + 1;
            $modulus = $i % 3;


            if($modulus == 0){
                $columna = 1;
            } else {
                $columna++;
            }

            $GLOBALS['results']['productos'][$fila] = "";
            /**
             * 0 % 3 = 0
             * 1 % 3 = 1
             * 2 % 3 = 2
             * 3 % 3 = 0
             * 4 % 3 = 1
             * 5 % 3 = 2
             * 6 % 3 = 0
             * 7 % 3 = 1
             * 
             * 0 / 3 = 0 - Fila 1 -> Columna = 1
             * 1 / 3 = 0 - Fila 1 -> Columna++
             * 2 / 3 = 0 - Fila 1 -> Columna++
             * 
             * 3 / 3 = 1 - Fila 2 -> Columna = 1
             * 4 / 3 = 1 - Fila 2 -> Columna++
             * 5 / 3 = 1 - Fila 2 -> Columna++
             * 
             * 6 / 3 = 2 - Fila 3 -> Columna = 1
             * 7 / 3 = 2 - Fila 3 -> Columna++
             * 8 / 3 = 2 - Fila 3 -> Columna++
             * 
             */
			
		
			$GLOBALS['results']['productos'][$fila] .=
			'<!-- Productos - FILA '.$fila.' -->
            <div class="row m-0 py-2">';

            for ($j=0; $j < 3; $j++) {


                ////echo "I (j) BG: " . $i . "      | \n";
                //echo "J (j) BG: " . $j . "      | \n\n";

                $GLOBALS['results']['productos'][$fila] .='
                <div class="col-12 col-md-4 col-lg-3 py-3">
                    <div class="card" style="">
                        <img class="card-img-top" src="../assets/img/products/ribbon-'.$GLOBALS['results']['result'][$i]['codigo'].'.png">
                        <div class="card-header">
                            <h5 class="card-title">'.ucfirst($GLOBALS['results']['result'][$i]['nombre']).'</h5>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><span id="producto-material">'.ucfirst($GLOBALS['results']['result'][$i]['material']).' </span><span class="badge badge-pill  badge-primary">Material</span></li>
                            <li class="list-group-item"><span id="producto-máquina">'.ucfirst($GLOBALS['results']['result'][$i]['maquina']).' </span><span class="badge badge-pill  badge-danger">Máquina</span></li>
                            <li class="list-group-item"><span id="producto-medida">'.$GLOBALS['results']['result'][$i]['medidas'].' </span><span class="badge badge-pill  badge-secondary">Medida</span></li>
                        </ul>
                        <a href="#" class="btn btn-info w-100 detalles" data-id="'.$GLOBALS['results']['result'][$i]['codigo'].'">Detalles</a>

                    </div>

                </div>';

                

                //echo "Fila: " . $fila . "      | \n";
                //echo "FilasTotal: " . $filasTotal . "      | \n";
                //echo "ColumnasRes: " . $columnasResiduales . "      | \n\n";

                if($j == 2 || ($fila == $filasTotal && $j == ($columnasResiduales-1))){

                    //echo "FIN FILA      | \n\n";

                    /*
                     * Si ya es la última columna de la fila (3er columna)...
                     * ... poner una columna de relleno final y cerrar el de la fila.
                     */
                    $GLOBALS['results']['productos'][$fila] .='

                <div class="d-none d-xl-block col-xl-1"></div>
            </div> <!-- FIN - Productos - FILA '.$fila.' -->';


                
                } else {
                    //echo "SIG. COLUMNA...      | \n\n";
                    /*
                     * Si no es la última columna de la fila (1er o 2da columna)...
                     * ... poner una columna de relleno no-final.
                     */
                    $GLOBALS['results']['productos'][$fila] .='
                <div class="d-none d-lg-block col-lg-1"></div>';

                }


                //echo "I (j): " . $i . "      | \n";
                //echo "J (j): " . $j . "      | \n\n";
                if($j < 2){
                    $i++;
                }

                if($fila == $filasTotal && $j == ($columnasResiduales-1) ) {
                    break;
                }
            }

            // Separador de filas si no es la última fila
            if($fila < $filasTotal){
                $GLOBALS['results']['productos'][$fila] .= ' <hr class="w-100 d-none d-md-block">';
            }

        }


        // Paginación de productos... 
        // @todo Hacer bien la paginación.
        $GLOBALS['results']['productos'][$fila] .= '
            <!-- Pagination -->
            <div class="row ml-auto"">
                <div class="col">
                    
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <li class="page-item">
                                <a class="page-link" href="#" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                    <span class="sr-only">Previous</span>
                                </a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>';


        $GLOBALS['results']['productos']['filas'] = $filasTotal;



    } else {

        $GLOBALS['results']['request'] = false;
        $GLOBALS['results']['reason'] = "isset";
        
    }
} else {

    $GLOBALS['results']['request'] = false;
    $GLOBALS['results']['reason'] = "POST";
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