<?php
/* Sublime Text 3  Tab-Size: 4 */

/**
 * Detalles de producto Ribbon
 *
 * Se muestran los detalles del Ribbon. Aquí se podrá meter productos al
 * carrito.
 *
 * @author Luis Fernando Gerónimo Carranza <luisfergeronimo@gmail.com>
 * @author Jesús Emmanuel Zetina Chevez <zcjo151173@uepmor.edu.mx>
 */

session_start();

/*
 * Se requiere de la conexión a la base de datos.
 */
require '../../includes/db.php';

/*
 * Se requiere de la clase 'QueryGenerico' para hacer consultas a la BD para
 * filtrar los productos.
 */
require '../../includes/model/queryGenerico.php';

$GLOBALS['results']['productos'] = [];
$GLOBALS['results']['request'] = false;

if(isset($_GET['codigo'])){

	$codigo = $_GET['codigo'];

    $queryGenerico = new QueryGenerico();

    $queryGenerico->setTable('RibbonView');

    $queryGenerico->setSelect('*');

    $queryGenerico->setWhere('codigo = ?');

    //-----------------------------------------------------
    // Asignación De Los Parámetros Del Prepared Statement
    //-----------------------------------------------------

    /*
     * Se asignan todos nuestros tipos de parámetros, y sus respectivos
     * valores, obtenidos en los procesos anteriores.
     */
    $queryGenerico->setParamsType(array('s'));
    $queryGenerico->setParamsValues(array($codigo));


    //======================================================================
    // EJECUCIÓN DE CONSULTA Y EXTRACCIÓN DE LOS RESULTADOS
    //======================================================================

    //-----------------------------------------------------
    // Ejecución De Consulta
    //-----------------------------------------------------

	$GLOBALS['results']['ribbon'] = $queryGenerico->read();


	setlocale(LC_MONETARY, 'es_MX');

} else {
	header('Location: ../ribbon.php');
}
?>
<!doctype html>
<html lang="es-mx">
<head>
	<!-- Required meta tags -->
	<meta http-equiv="Content-Type" content="text/html" charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="../../assets/css/bootstrap.css">

    <!-- FontAwesome -->
    <link rel="stylesheet" href="../../assets/css/regular.css">
    <link rel="stylesheet" href="../../assets/css/solid.css">
    <link rel="stylesheet" href="../../assets/css/fontawesome.css">

	<title>Detalles - Ribbon</title>
</head>
<body>

<div class="alert alert-success alert-dismissible fade show fixed-top" role="alert">
  	<strong>¡Producto añadido al carrito!</strong>
  	<button type="button" class="close" aria-label="Close">
    	<span aria-hidden="true">&times;</span>
  	</button>
</div>

<?php include '../../includes/tienda_header.php'; ?>

<!-- BREADCRUMB -->
<div>
	 
	<nav aria-label="breadcrumb">
	  	<ol class="breadcrumb ">
	    	<li class="breadcrumb-item"><a href="../index.php">Inicio</a></li>
	    	<li class="breadcrumb-item"><a href="../ribbon.php">Ribbon</a></li>
	    	<li class="breadcrumb-item active font-italic" aria-current="page">Detalles</li>
	  	</ol>
	</nav>
</div> <!-- FIN - BREADCRUMB -->

<!-- CONTAINER -->
<div class="container mt-5">
	<div class="row">

		<!-- Imagen -->
		<div class="col-12 col-sm-4">
			<img class="img-fluid" id="img-producto" data-column="<?php echo $GLOBALS['results']['ribbon'][0]['codigo'];?>" onerror="this.src='../../assets/img/products/img-placeholder.png'" src="/DymoWeb/assets/img/products/ribbon-<?php echo $GLOBALS['results']['ribbon'][0]['codigo']; ?>.png">
		</div>

		<!-- Detalles -->
		<div class="col-12 col-sm-8 pl-md-5">
			
			<!-- Titulo y descripcion -->
			<div class="row">
				<div class="col-12 text-center text-sm-left">
					<h4 ><?php echo $GLOBALS['results']['ribbon'][0]['nombre'];?></h4>
					<h6 class="text-muted font-italic"><?php echo $GLOBALS['results']['ribbon'][0]['descripcion'];?></h6>
				</div>
			</div>

			<!-- Precio -->
			<div class="row">
				<div class="col-6 col-sm-4 text-right text-sm-left">
					<span class="font-weight-bold">Precio: </span>
				</div>
				<div class="col-6 col-sm-8 text-left text-sm-left pl-0">
					$ <span id="precio"><?php echo $GLOBALS['results']['ribbon'][0]['costo']; ?></span> M.X.N.
				</div>
			</div>


			<!-- Cantidad -->
			<div class="row mt-4">
				<div class="col-6 col-sm-4 text-right text-sm-left align-self-center">
					<span class="font-weight-bold">Cantidad: </span>
				</div>
				<div class="col-6 col-sm-8 text-left text-sm-left pl-0">
					<div class="input-group" style="width: 125px;">
					    <div class="input-group-prepend">
					    	<button class="btn btn-primary restar px-2"><i class="fas fa-minus"></i></button>
					    </div>
					    <input type="text" class="form-control text-center" id="cantidad" value="1">
					    <div class="input-group-prepend">
					    	<button class="btn btn-primary sumar px-2"  style=""><i class="fas fa-plus"></i></button>
					    </div>
				  	</div>
				</div>
			</div>


			<!-- Precio total -->
			<div class="row mt-4">
				<div class="col-6 col-sm-4 text-right text-sm-left">
					<span class="font-weight-bold">Total: </span>
				</div>
				<div class="col-6 col-sm-8 text-left text-sm-left pl-0">
					$ <span id="precio-total"><?php echo number_format($GLOBALS['results']['ribbon'][0]['costo'], 2, ',', '.');?></span> M.X.N.
				</div>
			</div>


			<!-- Botones Carrito && Favorito -->
			<div class="row mt-4">
				<div class="col-12 col-sm-6 col-lg-4 pl-sm-0">
					<button class="btn btn-success w-100" id="btn-carrito"><i class="fas fa-shopping-cart fa-lg"></i> Añadir al carrito</button>
				</div>
				<div class="col-12 col-sm-6 col-lg-4 ml-lg-2 my-2 m-sm-0 pr-sm-0">
					<button class="btn btn-danger w-100" id="btn-favorito"><i class="far fa-heart"></i> Añadir a favoritos</button>
				</div>
				<div class="col col-sm col-lg-4"></div>
			</div>



		</div>
	</div>

	<hr class="w-100 my-5">

	<ul class="nav nav-pills nav-fill mt-5 mb-3" id="pills-tab" role="tablist">
	  	<li class="nav-item">
	    	<a class="nav-link " id="pills-detalles-tab" data-toggle="pill" href="#pills-detalles" role="tab" aria-controls="pills-detalles" aria-selected="false">Detalles</a>
	  	</li>
	  	<li class="nav-item">
	    	<a class="nav-link active" id="pills-faq-tab" data-toggle="pill" href="#pills-faq" role="tab" aria-controls="pills-faq" aria-selected="true">Preguntas frecuentes</a>
	  	</li>
	</ul>

	<!-- MAIN TAB CONTENT -->
	<div class="tab-content mb-3" id="pills-tabContent">
  		<!-- Tab Content - DETALLES -->
  		<div class="tab-pane fade" id="pills-detalles" role="tabpanel" aria-labelledby="pills-detalles-tab">..</div>


  		<!-- Tab Content - FAQ -->
  		<div class="tab-pane fade show active" id="pills-faq" role="tabpanel" aria-labelledby="pills-faq-tab">

			<!-- Accordion -->
  			<div class="accordion" id="accordionExample">
				
  				
  				<!-- Definición de ribbon -->
		  		<div class="card">

		  			<!-- PREGUNTA - ¿Qué es un ribbon? -->
		    		<div class="card-header px-0" id="headingOne">
		      			<h5 class="mb-0">
		        			<button class="btn btn-link" style="white-space: normal;" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
		          				¿Qué es un ribbon?
		        			</button>
		      			</h5>
				    </div> <!-- FIN - PREGUNTA -->

				    <!-- RESPUESTA -->
		    		<div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
				    	
				    	<!-- Card body -->
		      			<div class="card-body">
		        			<p>Las cintas o películas de impresión utilizadas en las impresoras de transferencia térmica son llamadas <strong>ribbons</strong> (su traducción literal sería <cite>listón</cite> o <cite>cinta</cite>), y son utilizadas principalmente para la impresión de etiquetas y códigos de barras.</p>

							<p>Los <strong>ribbons</strong> contienen un sustrato de <strong>cera, resina</strong> o la mezcla de ambas; este material  se transfiere desde el ribbon hacia la etiqueta que se va a imprimir cuando se le aplica el calor generado por el  cabezal de la impresora.</p>

							<p>De esta manera se plasma la imagen o texto en la etiqueta y es dependiendo del sustrato que contenga la película que será su durabilidad.</p>
		      			</div> <!-- FIN - Card body -->
			    	</div> <!-- FIN - RESPUESTA -->

			  	</div> <!-- FIN - Definición de ribbon -->

			  	<!-- Tipos de Materiales -->
			  	<div class="card">

			  		<!-- PREGUNTA - ¿Qué tipos de materiales usan los ribbon? -->
				    <div class="card-header px-0" id="headingTwo">
				      	<h5 class="mb-0">
				        	<button class="btn btn-link collapsed" style="white-space: normal;" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
				          		¿Qué tipos de materiales usan los ribbon?
			        		</button>
				      	</h5>
				    </div> <!-- FIN -  PREGUNTA -->

				    <!-- RESPUESTA -->
				    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">

				    	<!-- Card body -->
				      	<div class="card-body">
				        	<p>Los ribbon suelen contener cera o recina, y comúnmente se utiliza ambas en un sólo ribbon.</p>
				        	<p>También, hay diferentes formas de cera y recina. Entre ellos estan: </p>
				        	<ul>
				        		<li>Cera </li>
				        		<li>Cera GP</li>
				        		<li>Resina</li>
				        		<li>Resina TR</li>
				        		<li>Resina TP</li>
				        		<li>Resina Textil</li>
				        	</ul>
				      	</div> <!-- FIN - Card body -->

			    	</div> <!-- FIN - RESPUESTA -->

			  	</div> <!-- FIN - Tipos de Materiales -->
			  	
			</div> <!-- FIN - Accordion -->

  		</div> <!-- FIN - Tab Content - FAQ -->

	</div> <!-- FIN - MAIN TAB CONTENT -->

</div> <!-- FIN - CONTAINER -->




<!-- --------------------------  -->
<!--   FOOTER | PIE DE PÁGINA    -->
<!-- --------------------------  -->
<?php include '../../includes/footer.php' ?>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="../../assets/js/jquery-3.3.1.js"></script>
<script src="../../assets/js/popper.js"></script>
<script src="../../assets/js/bootstrap.js"></script>


<!-- Script para calcular el precio -->
<script>
	$(document).ready(function(){

		/**
		 * Restar 1 al input de cantidad y calcular el precio total.
		 * 
		 * @param  {DOM element} input  input donde se muestra la cantidad.
		 * @return {void}       
		 */
		function restar(input){
			var cantidad = parseInt(input.val());
			
			if(cantidad > 1){
				input.val(cantidad - 1);
				calcularTotal(cantidad - 1);
			}
		}

		/**
		 * Añadir 1 al input de cantidad y calcular el precio total.
		 * 
		 * @param  {DOM element} input  input donde se muestra la cantidad.
		 * @return {void}       
		 */
		function sumar(input){
			var cantidad = parseInt(input.val());

			if(cantidad < 999){
				input.val(cantidad + 1);
				calcularTotal(cantidad + 1);
			}

		}

		/**
		 * Calcular el total del precio multiplicando la cantidad por el
		 * precio por unidad.
		 * 
		 * @param  {int} cantidad  Valor del input de Cantidad en Int.
		 * @return {void}        
		 */
		function calcularTotal(cantidad){
			if(isNaN(cantidad)){
				$('#precio-total').html('0.00');
			} else {
				var precio = parseFloat($('#precio').html());
				console.log($('#precio').html());
				console.log(precio);
				console.log(cantidad * precio);
				$('#precio-total').html(cantidad * precio);
			}
		}


		// Restar la cantidad
		$('.restar').on('click', function(){
			restar($('#cantidad'));
		});


		// Sumar la cantidad
		$('.sumar').on('click', function(){
			sumar($('#cantidad'));
		});

		// Detectar cuando se escriba en el input de cantidad calcular el total.
		$('#cantidad').on('change paste keyup', function(){

			calcularTotal(parseFloat($(this).val()));
		});
	});
</script>


<!-- Script para añadir producto al carrito -->
<script>

    $('.alert-success').hide();

    $('.close').on('click', function(){
		$('.alert-success').hide();    	
    });

	$(document).ready(function(){

		$('#btn-carrito').on('click', function(){
			
			var clienteID = $('#datos-usuario').attr('data-column');

			console.log("ClienteID: ");
			console.log(clienteID);

			if(clienteID != null){

				var origen = 'tienda';
				
				var cantidad = parseInt($('#cantidad').val());
				console.log("Cantidad: ");
				console.log(cantidad);
				
				var producto = $('#img-producto').attr('data-column');
				console.log("Producto: ");
				console.log(producto);

				


				$.ajax({
					type: 'POST',
					url: '../pedidos/anadirProducto.php',
					data: 
					{
						origen: origen,
						cantidad: cantidad,
						producto: producto,
						clienteID: clienteID
					},
					dataType: 'json',
					success: function(data){
						console.log(data);
    					$('.alert-success').show();
					},
	                error: function (xhr, status, error) { 
	                    console.log("Xhr: " + xhr);
	                    console.log("Xhr.responseText: " + xhr.responseText);
	                    console.log("Status: " + status);
	                    console.log("Error: " + error);
	                    var err = JSON.parse(xhr.responseText);
	                    console.log(err);
	                    console.log(err.error);
	                }
				});
			} else {
				window.location = '../login.php';
			}
		});

	});
</script>



</body>
</html>