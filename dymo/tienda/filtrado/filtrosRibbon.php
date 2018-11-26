<?php
/* Sublime Text 3  Tab-Size: 4 */

/**
 * Filtros de la lista de productos de la tienda
 *
 * Se obtienen los parámetros de los filtros de los ribbon's.
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
 * obtener los tipos de filtros para los Ribbon's.
 */
require '../../includes/model/queryGenerico.php';

$GLOBALS['results'] = array();


//======================================================================
// MATERIAL
//======================================================================

// Nuevo QueryGenerico. 
$queryGenerico = new QueryGenerico();
// Buscar en la Vista 'RibbonView'.
$queryGenerico->setTable('RibbonView');
// Seleccionar los materiales, sin repetirlos.
$queryGenerico->setSelect('DISTINCT material');

$queryGenerico->setParamsType(array());
$queryGenerico->setParamsValues(array());

$readResults = $queryGenerico->read();

$GLOBALS['results']['material'] = '';

for ($i=0; $i < sizeof($readResults); $i++) { 

    $filtro = ucfirst($readResults[$i]['material']);
    $filtroMinusculas = strtolower($filtro);

    $GLOBALS['results']['material'] .= '
    <!-- Filtro - '.$filtro.'-->
    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="'.$filtroMinusculas.'" data-column="material" id="'.$filtroMinusculas.'">
        <label class="form-check-label" for="'.$filtroMinusculas.'">
            '.$filtro.'
        </label>
    </div>

    ';
}



//======================================================================
// MÁQUINA
//======================================================================

// Nuevo QueryGenerico. 
$queryGenerico = new QueryGenerico();
// Buscar en la Vista 'RibbonView'.
$queryGenerico->setTable('RibbonView');
// Seleccionar los materiales, sin repetirlos.
$queryGenerico->setSelect('DISTINCT maquina');
$queryGenerico->setParamsType(array());
$queryGenerico->setParamsValues(array());

$readResults = $queryGenerico->read();

$GLOBALS['results']['maquina'] = '';

for ($i=0; $i < sizeof($readResults); $i++) { 

    $filtro = ucfirst($readResults[$i]['maquina']);
    $filtroMinusculas = strtolower($filtro);

    $GLOBALS['results']['maquina'] .= '
    <!-- Filtro - '.$filtro.'-->
    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="'.$filtroMinusculas.'" id="'.$filtroMinusculas.'">
        <label class="form-check-label" for="'.$filtroMinusculas.'">
            '.$filtro.'
        </label>
    </div>

    ';
}


//======================================================================
// MEDIDA
//======================================================================

// Nuevo QueryGenerico. 
$queryGenerico = new QueryGenerico();
// Buscar en la Vista 'RibbonView'.
$queryGenerico->setTable('RibbonView');
// Seleccionar los materiales, sin repetirlos.
$queryGenerico->setSelect('DISTINCT ancho, unidadAncho, largo, unidadLargo');
$queryGenerico->setParamsType(array());
$queryGenerico->setParamsValues(array());

$readResults = $queryGenerico->read();

$GLOBALS['results']['medida'] = '';

for ($i=0; $i < sizeof($readResults); $i++) { 

    $filtro = $readResults[$i]['ancho'].$readResults[$i]['unidadAncho'] . 'x' . $readResults[$i]['largo'].$readResults[$i]['unidadLargo'];

    

    $GLOBALS['results']['medida'] .= '
    <!-- Filtro - '.$filtro.'-->
    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="medida-'.$filtro.'" id="medida'.$i.'">
        <label class="form-check-label" for="medida'.$i.'">
            '.$filtro.'
        </label>
    </div>

    ';
}

$GLOBALS['results']['result'] = true;

echo json_encode($GLOBALS['results']);

?>