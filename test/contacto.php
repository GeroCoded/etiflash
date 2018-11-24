<?php $paginaActual = "Contacto"; ?>

<?php include('includes/topHtml.php'); ?>

<body>
	<?php include('includes/header.php'); ?>


	<section class="section-mapa centered">
		<h1>Ubicación</h1>

		<p class="titulo-comentario">Calz. Coyuya #199 Col. Santa Anita CD. de México, Iztacalco 08300</p><br>

		<article class="mapa">

			<iframe id="mapa-dymo" src="https://maps.google.com/maps?q=Coyuya%20199%2C%20La%20Cruz%20Coyuya%2C%2008310%20Ciudad%20de%20M%C3%A9xico%2C%20CDMX&t=&z=17&ie=UTF8&iwloc=&output=embed" 
					frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>

		</article>
	</section>

	<section class="centered row" style="margin-bottom: 50px;">
		<section id="section-form-contacto" class="col-7">
			<h1>Contáctanos</h1>
			<form  method="POST" name="form-contacto" id="form-contacto" onsubmit="return enviar();">
				<label for="nombre">Nombre *</label>
				<input type="text" name="nombre" id="nombre" placeholder="Nombre">
				
				<label for="empresa">Empresa *</label>
				<input type="text" name="empresa" id="empresa" placeholder="Empresa">
				
				<label for="correo">Correo *</label>
				<input type="email" name="correo" id="correo" placeholder="Correo">
				
				<label for="telefono">Teléfono *</label>
				<input type="text" name="telefono" id="telefono" placeholder="Teléfono">
				
				
				<label for="comentario">Comentario *</label>
				<textarea name="comentario" id="comentario" form="contacto-form" placeholder="Comentarios..." style="height: 200px" maxlength="200"></textarea>
				<p>Caracteres: <label for="comentario" id="contador">0</label>/200</p>

				<br><br>

				<input type="checkbox" name="terminos" id="terminos" value="Terminos"> <a href="javascript:void(0)" onclick="return aceptarTerminos();">Aceptar términos y condiciones</a><br><br>
				
				<input type="submit" name="enviarBtn" id="enviarBtn" value="Enviar" disabled="true">
			</form>
		</section>

		<aside id="aside-otras-sucursales" class="col-5">
			<h1>Otras sucursales</h1>

			<article class="mapa">

				<h2>Etitex</h2>
				<p class="titulo-comentario">Calz. Coyuya #199 Col. Santa Anita CD. de México, Iztacalco 08300</p> <br>

				<iframe class="mapa-otras-sucursales" src="https://maps.google.com/maps?q=Coyuya%20199%2C%20La%20Cruz%20Coyuya%2C%2008310%20Ciudad%20de%20M%C3%A9xico%2C%20CDMX&t=&z=17&ie=UTF8&iwloc=&output=embed" 
						frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>

			</article>
		</aside>
	</section>


	<?php include('includes/footer.php'); ?>

	<script type="application/javascript">

		document.forms['form-contacto'].onsubmit = enviar;

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
        	} else if (! /^[0-9]+$/.test(telefono)) {
        		mensaje += '\n        Un teléfono válido.';
	            valido = false;
	        } else if(telefono.length != 10){
	        	mensaje += '\n        Un teléfono de 10 dígitos';
	        	valido = false;
	        }

	        if(comentario===null || comentario===''){
	        	mensaje += '\n        Su comentario.';
	            valido = false;
			}

			if(valido===false){
				alert(mensaje);
				return false;
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
		var terminos = document.getElementById('terminos');
		var enviarBtn = document.getElementById('enviarBtn');

		// Link para el label "Aceptar términos y condiciones."
		function aceptarTerminos(){

			if(terminos.checked){
				terminos.checked = false;
			} else {
				terminos.checked = true;
			}
		 	
		 	enviarBtn.disabled = !terminos.checked;

			return false;
		}

		// Funcion para deshabilitar el botón de enviar dependiendo del estado del checkbox.
		terminos.onchange = function() {
		  enviarBtn.disabled = !this.checked;
		};

	</script>
	
</body>
</html>