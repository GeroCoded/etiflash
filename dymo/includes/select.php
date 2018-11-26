<?php include_once 'db.php';?>
<?php include_once 'model/queryGenerico.php';?>
<?php 
	/*SELECT.PHP: Archivo PHP para hacer un select simple */


	$results;
	
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		if(isset($_POST['table']) && isset($_POST['select'])){



			$queryGenerico = new QueryGenerico();

			$queryGenerico->setTable($_POST['table']);
			$queryGenerico->setSelect($_POST['select']);
			$queryGenerico->setParamsType(array());
			$queryGenerico->setParamsValues(array());

			if(isset($_POST['where'])){
				$queryGenerico->setWhere($_POST['where']);
			}
			
			$results = $queryGenerico->read();

			$results['match'] = 'true';
		} else {
			$results['match'] = 'false';
			$results['message'] = 'Parameters not set';
		}
		
	} else {
		$results['match'] = 'false';
		$results['message'] = 'Invalid request';
	}

	http_response_code(200);
	header('Content-Type: application/json');
	echo json_encode($results);
?>