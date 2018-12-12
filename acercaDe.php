

<?php $paginaActual = "Acerca de"; ?>



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



	<?php include('includes/header.php'); ?>





	<section id="section-acerca-de" class="centered">



		<h1>ACERCA DE<br>NOSOTROS</h1>

		<br><br>



		<article class="row">
			<div class="acerca-de-titulo col-4">Historia de la Empresa</div>
			<div class="acerca-de-parrafo col-8">

				Distribuidora y Mayorista Omega S.A. de C.V. fue fundada el 17 de 

				Septiembre de 1986 para el sector industrial con el fin de hacer y distribuir etiquetas y 

				etiquetadoras a empresas comerciales para ayudarles a adherir el precio a cada 

				producto. Con el paso del tiempo se empezó a vender diversos productos más como 

				diferentes tipos de etiquetas y en mayor cantidad.

			</div>
		</article>



		<hr><br><br>



		<article class="row">
			<div class="acerca-de-titulo col-4">Misión</div>
			<div class="acerca-de-parrafo col-8">

				En Distribuidora y Mayorista Omega, con más de 30 años de experiencia, nos dedicamos a brindarles a nuestros

				clientes un servicio cordial. Valoramos su negocio. Nuestra misión es ofrecer productos 

				y servicios confiables con un enfoque orientado al cliente.

			</div>
		</article>



		<hr><br><br>



		<article class="row">
			<div class="acerca-de-titulo col-4">Visión</div>
			<div class="acerca-de-parrafo col-8">

				Nuestra visión es ser la empresa de equipos y servicios más admirada por la calidad

				de productos que representa y el soporte técnico brindado a nuestros clientes.

			</div>
		</article>



	</section>



	<?php include('includes/footer.php'); ?>



	

</body>

</html>