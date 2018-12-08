<?php 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if( isset($_POST['nombre']) && 
		isset($_POST['empresa']) &&
		isset($_POST['correo']) &&
		isset($_POST['telefono']) &&
		isset($_POST['asunto']) &&
		isset($_POST['comentario'])
	){

		$nombre     = strip_tags($_POST['nombre']);
		$empresa    = strip_tags($_POST['empresa']);
		$correo     = strip_tags($_POST['correo']);
		$telefono   = strip_tags($_POST['telefono']);
		$asunto     = strip_tags($_POST['asunto']);
		$comentario = strip_tags($_POST['comentario']);

		$headers = "From: " . $correo . "\r\n";
		$headers .= "Reply-To: ". $correo . "\r\n";
		//$headers .= "CC: ". $correo . "\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=utf-8\r\n";


		$message = '<html><body>';
		$message .= '<h2 style="color: #0075C8;">Nuevo mensaje desde <i>etiflashenmexico.com.mx</i><h2>';
		$message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
		$message .= "<tr style='background: #eee;'><td><strong>Nombre:</strong> </td><td>" . $nombre . "</td></tr>";
		$message .= "<tr><td><strong>Empresa:</strong> </td><td>" . $empresa . "</td></tr>";
		$message .= "<tr><td><strong>Correo:</strong> </td><td>" . $correo . "</td></tr>";
		$message .= "<tr><td><strong>Teléfono:</strong> </td><td>" . $telefono . "</td></tr>";
		$message .= "<tr><td><strong>Asunto:</strong> </td><td>" . $asunto . "</td></tr>";
		$message .= "<tr><td><strong>Comentario:</strong> </td><td>" . $comentario . "</td></tr>";
		$message .= "</table>";
		$message .= "</body></html>";


		$asunto = "Sitio Web: " . $asunto;

		// send email
		mail("ventas@etiflashenmexico.com.mx", $asunto, $message, $headers);

		echo 2;


	} else {
		echo 1;
	}
} else {
	echo 0;
}

?>