<?php $paginaActual = "Contacto"; ?>
<?php include('includes/topHtml.php'); ?>

<body>
	<?php include('includes/header.php'); ?>
	
    <section class="section-mapa centered">
		<h1>Ubicación</h1>

		<p class="titulo-comentario">Vicente Suárez 813, Niños Héroes, 75760 Tehuacán, Puebla.</p><br>

		<article class="mapa">

			<!--<iframe id="mapa-dymo" src="https://maps.google.com/maps?q=Coyuya%20199%2C%20La%20Cruz%20Coyuya%2C%2008310%20Ciudad%20de%20M%C3%A9xico%2C%20CDMX&t=&z=17&ie=UTF8&iwloc=&output=embed" 
					frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
-->
			<iframe width="100%" height="500" id="gmap_canvas" src="https://maps.google.com/maps?q=Vicente%20Su%C3%A1rez%20813%2C%20Ni%C3%B1os%20H%C3%A9roes%2C%2075760%20Tehuac%C3%A1n%2C%20Pue.&t=&z=15&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>

		</article>
	</section>
<!--
	<div class="mapouter">
		<div class="gmap_canvas">
			<iframe width="600" height="500" id="gmap_canvas" src="https://maps.google.com/maps?q=Vicente%20Su%C3%A1rez%20813%2C%20Ni%C3%B1os%20H%C3%A9roes%2C%2075760%20Tehuac%C3%A1n%2C%20Pue.&t=&z=15&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0">
				
			</iframe>
			<a href="https://www.embedgooglemap.net"></a>
		</div>
		<style>.mapouter{text-align:right;height:500px;width:600px;}.gmap_canvas {overflow:hidden;background:none!important;height:500px;width:600px;}</style>
	</div>
-->
	<section class="centered row">
		<section id="section-form-contacto" class="col-7">
			<h1>Contáctanos</h1>
			<h4>Por correo: 
				<a id="link-correo" title="ventas@etiflashenmexico.com.mx" href="mailto:ventas@etiflashenmexico.com.mx">
					ventas@etiflashenmexico.com.mx
				</a>
			</h4>
			<br>
			<h4>O por nuestro formulario:</h4>
			<br>
			<form  method="POST" name="form-contacto" id="form-contacto">
				<label for="nombre">Nombre *</label>
				<input type="text"  name="nombre"   id="nombre"   placeholder="Nombre">
				
				<label for="empresa">Empresa *</label>
				<input type="text"  name="empresa"  id="empresa"  placeholder="Empresa">
				
				<label for="correo">Correo *</label>
				<input type="email" name="correo"   id="correo"   placeholder="Correo">
				
				<label for="telefono">Teléfono *</label>
				<input type="text"  name="telefono" id="telefono" placeholder="Teléfono">
				
				<label for="asunto">Asunto *</label>
				<input type="text"  name="asunto" id="asunto" placeholder="Asunto">
				
				
				<label for="comentario">Comentario *</label>
				<textarea name="comentario" id="comentario" form="form-contacto" placeholder="Comentarios..." style="height: 200px" maxlength="750"></textarea>
				<p>Caracteres: <label for="comentario" id="contador">0</label>/750</p>

				<br>
				<span id="mensaje-respuesta"></span>
				<br>
				<br>

				<!--<input type="checkbox" name="terminos" id="termios" value="Terminos"> <a href="javascript:void(0)" onclick="return aceptarTerminos();">Aceptar términos y condiciones</a><br><br>-->
				
				<input type="button" name="enviarBtn" id="enviarBtn" value="Enviar">
			</form>
		</section>

		<aside id="aside-otras-sucursales" class="col-5">
			<h1>Otras sucursales</h1>

			<article class="mapa">

				<h2>DYMO</h2>
				<p class="titulo-comentario">Calz. Coyuya #199 Col. Santa Anita CD. de México, Iztacalco 08300</p> <br>

				<iframe class="mapa-otras-sucursales" src="https://maps.google.com/maps?q=Coyuya%20199%2C%20La%20Cruz%20Coyuya%2C%2008310%20Ciudad%20de%20M%C3%A9xico%2C%20CDMX&t=&z=17&ie=UTF8&iwloc=&output=embed" 
						frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>

				<br><br>

				<span class="titulo-detalles"><a href="http://dymo.etiflashenmexico.com.mx/">Página web</a></span><br><br>
				<span class="titulo-detalles">Teléfono</span> <br>
				<span class="titulo-detalles">(55) 5650-2369</span> <br>
				<span class="titulo-detalles">(55) 5654-1001</span> <br>
				<span class="titulo-detalles">(55) 5657-6210</span> <br>
				<span class="titulo-detalles">(55) 5650-2873</span> <br>

			</article>
		</aside>
	</section>
	


	<?php include('includes/footer.php'); ?>
 

    <!-- JQUERY -->
    <!-- TODO: Cambiar los assets a una carpeta de Etiflash y no una de DYMO -->
    <script src="dymo/assets/js/jquery-3.3.1.js"></script>

	<script type="application/javascript">

		//document.forms['form-contacto'].onsubmit = enviar;

		function enviar(){

			// Obtención de valores de los input
	        var nombre = document.getElementById('nombre').value;
	        var empresa = document.getElementById('empresa').value;
	        var correo = document.getElementById('correo').value;
	        var telefono = document.getElementById('telefono').value;
	        var comentario = document.getElementById('comentario').value;

	        var mensaje = "Favor de ingresar:";
	        var valido = true;

	        // Validación de los inpui
	        if (nombre===null || nombre===''){
	            mensaje += '\n        Su nombre.';
	            valido = false;
        	} else if (! /^[a-zA-Z\s]+$/.test(nombre)) {
        		mensaje += '\n        Un nombre válido.';
	            valido = false;
			} 

			if(empresa===null || empresa===''){
				mensaje += '\n        Su empresa.';
	            valido = false;
        	} else if (! /^[a-zA-Z\s]+$/.test(empresa)) {
        		mensaje += '\n        Una empresa válida.';
	            valido = false;
	        } 

	        if(correo===null || correo===''){
	        	mensaje += '\n        Su correo.';
	            valido = false;
        	}

        	if(telefono===null || telefono===''){
        		mensaje += '\n        Su teléfono.';
	            valido = false;
        	} else if (! /^[0-9\s]+$/.test(telefono)) {
        		mensaje += '\n        Un teléfono válido.';
	            valido = false;
	        }

	        if(comentario===null || comentario===''){
	        	mensaje += '\n        Su comentario.';
	            valido = false;
			}

			if(valido===false){
				alert(mensaje);
				return false;
			} else {
				return true;
			}
		}

		// Contador de comentarios
		var comentarios = document.getElementById('comentario');
		var contador = document.getElementById('contador');

		comentarios.addEventListener('keyup', function(){
			var caracteres = comentarios.value.split('');
			contador.innerText = caracteres.length;
		});

		//		- - - - TÉRMINOS DE ACEPTACIÓN - - - - 
		// Obtención del checkbox y el botón de enviar
		//var terminos = document.getElementById('terminos');
		//var enviarBtn = document.getElementById('enviarBtn');

		// Link para el label "Aceptar términos y condiciones."
		/*function aceptarTerminos(){

			if(terminos.checked){
				terminos.checked = false;
			} else {
				terminos.checked = true;
			}
		 	
		 	enviarBtn.disabled = !terminos.checked;

			return false;
		}*/

		// Funcion para deshabilitar el botón de enviar dependiendo del estado del checkbox.
		/*terminos.onchange = function() {
		  enviarBtn.disabled = !this.checked;
		};*/

	</script>
	

	<!-- Script para enviar el formulario por correo -->
	<script>

		$(document).ready(function(){
			$('#enviarBtn').on('click', function(){
				console.log("onclick");
				if(enviar()){

					console.log("ajax");


					var formulario = $('#form-contacto').serialize();

					console.log("Formulario");
					console.log(formulario);

					$.ajax({
						type: 'POST',
						url: 'controladores/enviarCorreoContacto.php',
						data: formulario,
						success: function(data){
							console.log("success Data: " +  data);

							switch(data){
								//case 0:
								//	break;
								case '1':
									console.log("Case 1");
									$('#mensaje-respuesta').css('color', 'red');
									$('#mensaje-respuesta').html('<strong>Favor de ingresar todos los datos<Strong>');
									break;

								case '2':
									console.log("Case 2");
									$('#mensaje-respuesta').css('color', '#45A049');
									$('#mensaje-respuesta').html('<strong>Se ha enviado su consulta.<Strong>');
									break;
								default:
									console.log("Case Default");
							}
						}
					});
				}
			});
		});
		
	</script>
</body>
</html>