<?php 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if( isset($_POST['nombre']) && 
		isset($_POST['empresa']) &&
		isset($_POST['correo']) &&
		isset($_POST['telefono']) &&
		isset($_POST['comentario'])
	){

		$nombre     = $_POST['nombre'];
		$empresa    = $_POST['empresa'];
		$correo     = $_POST['correo'];
		$telefono   = $_POST['telefono'];
		$asunto     = $_POST['asunto'];
		$comentario = wordwrap($_POST['comentario'], 70);

		$header = "From: " . $correo;


		// send email
		mail("ventas@etiflashenmexico.com.mx", $asunto, $comentario, $header);

		echo '2';


	} else {
		echo '1';
	}
} else {
	echo '0';
}

?>