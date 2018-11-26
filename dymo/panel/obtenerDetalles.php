<?php include_once '../includes/db.php';?>
<?php include_once '../includes/model/queryGenerico.php';?>
<?php 
	/*SELECT.PHP: Archivo PHP para hacer un select simple */


	$results;
	
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		if( isset($_POST['table']) && 
			isset($_POST['select']) && 
			isset($_POST['where']) && 
			isset($_POST['id'])
		){


			$queryGenerico = new QueryGenerico();

			$queryGenerico->setTable($_POST['table']);
			$queryGenerico->setSelect($_POST['select']);
			$queryGenerico->setWhere($_POST['where']);
			$queryGenerico->setParamsType(array('i'));
			$queryGenerico->setParamsValues(array(intval($_POST['id'])));
			
			
			$results['data'] = $queryGenerico->read();

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