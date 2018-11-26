<?php
/* Sublime Text 3  Tab-Size: 4 */

/**
 * Detalles de producto Ribbon
 *
 * Se muestran los detalles del Ribbon. Aquí se podrá meter productos al
 * carrito.
 *
 * @author Luis Fernando Gerónimo Carranza <luisfergeronimo@gmail.com>
 * @author Jesús Emmanuel Zetina Chevez <zcjo151173@uepemor.edu.mx>
 */

session_start();

if(!isset($_SESSION['id'])){
	header('Location: login.php');
}

/*
 * Se requiere de la conexión a la base de datos.
 */
require '../includes/db.php';

/*
 * Se requiere de la clase 'QueryGenerico' para hacer consultas a la BD para
 * filtrar los productos.
 */
require '../includes/model/queryGenerico.php';
$GLOBALS['results']['productos'] = [];
$GLOBALS['results']['request'] = false;
?>

<!doctype html>
<html lang="es-mx">
<head>
	<!-- Required meta tags -->
	<meta http-equiv="Content-Type" content="text/html" charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="../assets/css/bootstrap.css">

    <!-- FontAwesome -->
    <link rel="stylesheet" href="../assets/css/regular.css">
    <link rel="stylesheet" href="../assets/css/solid.css">
    <link rel="stylesheet" href="../assets/css/fontawesome.css">

    <!-- Smartsupp Live Chat script -->
    <script type="text/javascript">
        var _smartsupp = _smartsupp || {};
        _smartsupp.key = '8fde5e5a0b5beef908e268b0f2dab6b97c538dd9';
        window.smartsupp||(function(d) {
            var s,c,o=smartsupp=function(){ o._.push(arguments)};o._=[];
            s=d.getElementsByTagName('script')[0];c=d.createElement('script');
            c.type='text/javascript';c.charset='utf-8';c.async=true;
            c.src='https://www.smartsuppchat.com/loader.js?';s.parentNode.insertBefore(c,s);
        })(document);
    </script>


	<title>Carrito de compras</title>
</head>
<body>

<div class="alert alert-success alert-dismissible fade show fixed-top" role="alert" style="display: none;">
  	<strong>¡Su pedido se ha realizado!</strong> Será contactado por uno de nuestros vendedores.
  	<button type="button" class="close" aria-label="Close">
    	<span aria-hidden="true">&times;</span>
  	</button>
</div>

<?php include '../includes/tienda_header.php'; ?>

<!-- CONTAINER -->
<div class="container my-5">


<?php


$queryGenerico = new QueryGenerico();

$queryGenerico->setTable('pedidosView');
$queryGenerico->setSelect('*');
$queryGenerico->setWhere('clienteID = ? AND estado = 1 ORDER BY producto ASC');
$queryGenerico->setParamsType(array('i'));
$queryGenerico->setParamsValues(array($_SESSION['id']));
$pedidos = $queryGenerico->read();

$where = '';
$paramsType = [];
$paramsValues = [];

if(sizeof($pedidos) > 0){

	// Estructuración de la consulta WHERE.
	/*
	 * Se recorren los pedidos para poder formar nuestra consulta WHERE
	 * que contiene todos los códigos de los productos para buscarlos
	 * dentro de la tabla de productos y sacar sus características
	 * generales.
	 */
	for ($i=0; $i < sizeof($pedidos); $i++) { 

        $where .= 'codigo = ?';
        if($i < sizeof($pedidos)-1){
            $where .= ' OR ';
        }

         /*
         * Se 'empuja' el tipo de dato ('s') del parámetro al arreglo
         * 'paramsType'.
         */
        array_push($paramsType, 's');

        // Se 'empuja' el valor del parámetro al arreglo
        // 'paramsValues'.
        array_push($paramsValues, $pedidos[$i]['producto']);

	}

	$where .= ' ORDER BY codigo ASC';

	$queryGenerico = new QueryGenerico();

	$queryGenerico->setTable('producto');
	$queryGenerico->setSelect('*');
	$queryGenerico->setWhere($where);
	$queryGenerico->setParamsType($paramsType);
	$queryGenerico->setParamsValues($paramsValues);
	$productos = $queryGenerico->read();

	$pedidosHTML = '';
	$pedidoTotal = 0;

	for ($i=0; $i < sizeof($pedidos); $i++) {
		$pedidoTotal = $pedidoTotal + $pedidos[$i]['costo'];

		$pedidoTotalFormatted = number_format($pedidoTotal, 2, ',', '.');

		$pedidosHTML .= '
			<div class="row producto">

				<!-- Imagen -->
				<div class="col-12 col-sm-3 col-lg-2 py-4 py-sm-0">
					<img class="img-fluid" onerror="this.src=`../assets/img/products/img-placeholder.png`" src="../assets/img/products/ribbon-'.$productos[$i]['codigo'].'.png" alt="">
				</div>

				<!-- Detalles -->
				<div class="col-12 col-sm-4 col-lg-5">
					
					<!-- Titulo y descripcion -->
					<div class="row">
						<div class="col-12 text-center text-sm-left">
							<h4>'.$productos[$i]['nombre'].' <small class="text-muted producto-codigo" data-id="'.$pedidos[$i]['pedidoID'].'">'.$productos[$i]['codigo'].'</small></h4>
							<h6 class="text-muted font-italic">'.$productos[$i]['descripcion'].'</h6>
						</div>
					</div>

					<!-- Precio por Unidad-->
					<div class="row mt-2">
						<div class="col-12 text-center text-sm-left">
							<span class="font-weight-bold">Precio: </span>
							$<span class="precio-unidad">'.number_format($productos[$i]['costo'], 2, ',', '.').'</span> M.X.N./<span class="unidad-pedido">'.$productos[$i]['unidadDePedido'].'</span>
						</div>
					</div>
				</div>


				<!-- Cantidad -->
				<div class="col-12 col-sm-3 col-lg-2 my-3 mt-sm-4 mt-lg-4 px-0 pt-sm-3 ">
					<div class="input-group m-auto" style="width: 125px;">
					    <div class="input-group-prepend">
					    	<button class="btn btn-primary restar px-2"><i class="fas fa-minus"></i></button>
					    </div>
					    <input type="text" class="form-control text-center cantidad" value="'.$pedidos[$i]['cantidad'].'">
					    <div class="input-group-prepend">
					    	<button class="btn btn-primary sumar px-2"  style=""><i class="fas fa-plus"></i></button>
					    </div>
				  	</div>
				</div>


				<!-- Precio total -->
				<div class="col-12 col-sm-2 col-lg-3 m-auto mt-sm-1">

					<!-- Eliminar producto -->
					<div class="row d-none d-sm-flex">
						<div class="col-12 px-0">
					  		<button type="button" class="close float-right" aria-label="Close">
						    	<span aria-hidden="true">&times;</span>
					  		</button>
				  		</div>
					</div>
					
					<div class="row">
						<div class="col-12 text-center px-0">
							<small class="text-muted">Precio total</small>
						</div>
					</div>
					<div class="row">
						<div class="col-12 text-center px-0">
							<h4 class="text-success">$ <span class="precio-total">'.number_format($pedidos[$i]['costo'], 2, ',', '.').'</span> M.X.N.</h4>
						</div>
					</div>
				</div>



				<!-- Eliminar (Pantalla Móvil) -->
				<div class="col-12 mt-4 d-block d-sm-none">

					<!-- Eliminar producto -->
					<div class="row">
						<div class="col-12 text-center m-auto px-0">
					  		<button type="button" class="btn btn-danger" aria-label="Close">
						    	Eliminar producto
					  		</button>
				  		</div>
					</div>

				</div>

			</div>
		';

		if($i < sizeof($pedidos)){
			$pedidosHTML .= '<hr class="w-100">';
		}

		if($i == sizeof($pedidos) - 1){
			$pedidosHTML .= '
			<div class="row precio-suma">
			
				<div class="col"></div>

				<!-- Cantidad -->
				<div class="col-12 col-sm-3 col-lg-2 my-3 mt-sm-4 mt-lg-4 px-0 pt-sm-3 ">
					    <h3 class="text-center text-info">Suma Total:</h3>
				</div>

				<div class="col-12 col-sm-2 col-lg-3 m-auto">
					<div class="row">
						<div class="col-12 text-center px-0">
							<small class="text-muted">Precio pedido</small>
						</div>
					</div>
					<div class="row">
						<div class="col-12 text-center px-0">
							<h4 class="text-primary">$ <span class="pedido-total">'.$pedidoTotalFormatted.'</span> M.X.N.</h4>
						</div>
					</div>
				</div>
			</div>

			<div class="row precio-suma">
			
				<div class="col"></div>

				<div class="col-12 col-sm-2 col-lg-3 text-center">
			  		<button type="button" class="btn btn-primary w-100 px-0" id="btn-realizar-pedido" aria-label="Close">
						<span class="d-none d-sm-block d-lg-none">Enviar</span><span class="d-block d-sm-none d-lg-block">Realizar pedido</span>
			  		</button>
				</div>
			</div>';
			
		}
	}
} else {
	$pedidosHTML = '
	<div class="row text-center">
		<div class="col-12">
			<div class="row">
				<div class="col"></div>
				<div class="col-6 col-sm-4 col-lg-3">
					<img class="img-fluid" src="../assets/img/shopping-cart.png">
				</div>
				<div class="col"></div>
			</div>
			<div class="row">
				<div class="col">
					<h3 class="text-muted d-none d-sm-block">No tienes ningún producto en tu carrito</h3>
					<h4 class="text-muted d-block d-sm-none">No tienes ningún producto en tu carrito</h4>
				</div>
			</div>
			<div class="row mt-2">
				<div class="col">
					<h5 class="text-dark">Ve a la <a class="alert-link" href="index.php">tienda</a>.</h5>
				</div>
			</div>
			<div class="row">
				<div class="col">
					<h5 class="text-dark">Ver tus <a class="alert-link" href="pedidos.php">pedidos</a>.</h5>
				</div>
			</div>
		</div>
	</div>';
}
echo $pedidosHTML;

?>


</div> <!-- FIN - CONTAINER -->




<!-- --------------------------  -->
<!--   FOOTER | PIE DE PÁGINA    -->
<!-- --------------------------  -->
<?php include '../includes/footer.php' ?>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="../assets/js/jquery-3.3.1.js"></script>
<script src="../assets/js/popper.js"></script>
<script src="../assets/js/bootstrap.js"></script>


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
				$('#precio-total').html(cantidad * precio);
			}
		}


		// Restar la cantidad
		$('.restar, .sumar').on('click', function(){
			var producto = $(this).closest('.producto').find('.producto-codigo');
			var codigo = producto.html();
			var pedidoID = producto.attr('data-id');
			var cantidad = $(this).closest('.producto').find('.cantidad').val();

			if($(this).hasClass('restar')){
				var operacion = 'restar';
			} else if($(this).hasClass('sumar')){
				var operacion = 'sumar';
			}

			console.log(codigo);
			console.log(pedidoID);
			console.log(operacion);
			console.log(cantidad);


			$.ajax({
				type: 'POST',
				url: 'pedidos/modificarCantidad.php',
				data: {
					cantidad: cantidad,
					pedidoID: pedidoID,
					codigo: codigo,
					operacion: operacion
				},
				dataType: 'json',
				success: function(data){
					console.log(data);
					if(data != false){
						location.reload();
					}
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

		});


		// Detectar cuando se escriba en el input de cantidad calcular el total.
		$('.cantidad').on('change', function(){
			var producto = $(this).closest('.producto').find('.producto-codigo');
			var codigo = producto.html();
			var pedidoID = producto.attr('data-id');
			var cantidad = $(this).closest('.producto').find('.cantidad').val();

			if($(this).hasClass('restar')){
				var operacion = 'restar';
			} else if($(this).hasClass('sumar')){
				var operacion = 'sumar';
			} else {
				var operacion = '';
			}

			console.log(codigo);
			console.log(pedidoID);
			console.log(operacion);
			console.log(cantidad);


			$.ajax({
				type: 'POST',
				url: 'pedidos/modificarCantidad.php',
				data: {
					cantidad: cantidad,
					pedidoID: pedidoID,
					codigo: codigo,
					operacion: operacion
				},
				dataType: 'json',
				success: function(data){
					console.log(data);
					if(data != false){
						location.reload();
					}
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
		});
	});
</script>

<!-- Script para enviar el pedido -->
<script>


    //$('.alert-success').hide();

    $('.close').on('click', function(){
		$('.alert-success').hide();    	
    });

    $( function () {
    	if(sessionStorage.getItem('alert') == 'true'){
			$('.alert-success').show();    	
    		sessionStorage.setItem('alert', 'false');
    	}
    });	


	$(document).ready(function(){

		$('#btn-realizar-pedido').on('click', function(){

			var pedidoID = $('body').find('.producto-codigo').attr('data-id');
			
			//var clienteID = $('#datos-usuario').attr('data-column');

			console.log(pedidoID);
			//console.log(clienteID);

			$.ajax({
				type: 'POST',
				url: 'pedidos/realizarPedido.php',
				data: {
					pedidoID: pedidoID
				},
				dataType: 'json',
				success: function(data){
					console.log(data);
					if(data['result']){

				        sessionStorage.setItem('alert', "true");    
				        window.location.reload();
						// Mensaje de éxito
    					//$('.alert-success').show();
					}
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
		});
	});
	
</script>

</body>
</html>