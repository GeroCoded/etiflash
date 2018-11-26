<?php include_once '../db.php';?>
<?php include_once  'queryGenerico.php';?>
<?php //header('Content-Type: text/html; charset=utf-8');?>
<?php 

/*
CREATE TABLE `Cliente` (
  `id`          INT                                  ,
  `nombre`      VARCHAR(45) COLLATE latin1_spanish_ci NOT NULL,
  `apellidoP`   VARCHAR(30) COLLATE latin1_spanish_ci NOT NULL,
  `apellidoM`   VARCHAR(30) COLLATE latin1_spanish_ci NOT NULL,
  `telefono`    VARCHAR(24) COLLATE latin1_spanish_ci NOT NULL,
  `correo`      VARCHAR(64) COLLATE latin1_spanish_ci NOT NULL,
  `contrasena`  VARCHAR(64) COLLATE latin1_spanish_ci NOT NULL,
  `empresaID`   INT                                   NOT NULL 
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
*/

	$results;
	
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		if(isset($_POST['id'])){


			// Obtención de variables POST.
			$id = $_POST['id'];


			// Cliente::Parámetros: ($id, $nombres, $apellidoP, $apellidoM, $telefono, $correo, $contrasena, $empresaID)
			$queryGenerico = new QueryGenerico();
			$queryGenerico->setTable('Empresa');
			$queryGenerico->setWhere('id = ?');
			$queryGenerico->setParamsType(array('i'));
			$queryGenerico->setParamsValues(array($id));
			$results = $queryGenerico->delete();


			if(!$results){
				$results['match'] = "false";
			} else {
				$results['match'] = "true";
				$results['rows'] = sizeof($results)-1;
			}



		} else {
			$results['match'] = 'false';
			$results['message'] = 'Favor de llenar todos los campos.';
		}


		header('Content-Type: application/json');
		echo json_encode($results);
	}
?>