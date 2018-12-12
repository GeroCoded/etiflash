<?php $paginaActual = "Inicio"; ?>
<?php include('includes/topHtml.php'); ?>

<body>

	<!-- FACEBOOK CHAT -->

	<!-- Load Facebook SDK for JavaScript -->
	<div id="fb-root"></div>
	<script>
		(function(d, s, id) {
		  	var js, fjs = d.getElementsByTagName(s)[0];
		  	if (d.getElementById(id)) return;
		  	js = d.createElement(s); js.id = id;
		  	js.src = 'https://connect.facebook.net/es_LA/sdk/xfbml.customerchat.js';
		  	fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));
	</script>

	<!-- Your customer chat code -->
	<div class="fb-customerchat"
	  	attribution=install_email
	  	page_id="202339923221842"
	  	logged_in_greeting="¡Hola! ¿Cómo puedo ayudarte?"
	  	logged_out_greeting="¡Hola! ¿Cómo puedo ayudarte?">
	</div>


	<!-- HEADER -->
	<?php include('includes/header.php'); ?>


	<!-- CONTENT -->
	<section id="section-presentacion">

		<span class="titulo-principal">Nueva engrapadora FLASH ST-9000</span> <br><br>
		<p class="titulo-comentario">Llámanos o contáctanos para más información</p> <br><br><br>
		<img id="etiquetadora-principal" src="images/engrapadora-flash-st-9000.png"> <br><br><br>
		<a href="contacto.php">
			<button class="boton-verde" value="Login">
				<!--<img id="icon-tienda" src="images/tienda.png"/>-->
				<span id="boton-texto-tienda">Contáctanos</span>
			</button>
		</a>
	</section>

	<!-- FOOTER -->
	<?php include('includes/footer.php'); ?>

</body>
</html>