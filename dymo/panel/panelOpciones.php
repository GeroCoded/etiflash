<?php

/* Sublime Text 3:      TabSize=4 */

if($_SERVER['REQUEST_METHOD'] == 'GET') {
	if(isset($_GET['id'])) {
    	$id = $_GET['id'];

    	$resultado;

    	switch($id) {
    		case 'pedidos-lista':
                // Obtener el contenido de otro archivo en un string. En este caso el contenido es la tabla.
                $tabla = implode('', file('../includes/tablas/pedidos-tabla.php'));

                $tablasADetallar = array(
                    array(
                        'tabla' => 'pedidosView',
                        'id' => null,
                        'llaveForanea' => null,
                        'select' => '`fecha-de-pedido`, `fecha-de-entrega`, estado, cantidad, costo, producto, detalles'
                    )
                );

                $columnas = array(
                    array("data" => "0"),
                    array("data" => "1"),
                    array("data" => "2"),
                    array("data" => "3"),
                    array("data" => "4"),
                    array("data" => "5"),
                    array("data" => "6"),
                    array("data" => "7"),
                    array("data" => "8"),
                    array("data" => "9", "orderable" => false)
                );

                $modalBody = '
                    <ul class="nav nav-tabs " id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link tab-link px-2 active" id="pedido-tab" data-toggle="tab" href="#pedido" role="tab" aria-controls="pedido" aria-selected="true">Pedido</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">


                        <div class="tab-pane show active" id="pedidosView" role="tabpanel" aria-labelledby="pedido-tab">
                            <p class="text-danger" id="mensaje-pedidosView"></p>
                            <form class="needs-validation px-0 px-sm-3 pb-0 pb-sm-1 pt-2" id="form-pedidosView" autocomplete="off"  novalidate>
                                <!-- PASO 1 - PEDIDO -->
                                <div id="paso-1" class="">
                                    <p class="text-danger" id="resultPedido"></p>

                                    <div class="form-row">



                                        <div class="form-group col-md-6">
                                            <label for="fecha-de-pedido">Fecha de pedido <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
                                                </div>
                                                <input type="text" class="form-control" id="fecha-de-pedido" name="fecha-de-pedido" placeholder="" maxlength="<?php echo $maxFechaPedido; ?>" readonly required>
                                                <div class="invalid-feedback">
                                                </div>
                                            </div>
                                        </div>



                                        <div class="form-group col-md-6">
                                            <label for="fecha-de-entrega">Fecha de entrega</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
                                                </div>
                                                <input type="text" class="form-control" id="fecha-de-entrega" name="fecha-de-entrega" placeholder="Fecha de Entrega" maxlength="<?php echo $maxApellido; ?>" readonly>
                                                <div class="invalid-feedback"
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="form-group">
                                        <label for="estado">Estado <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text"><i class="fas fa-shoe-prints"></i></div>
                                            </div>
                                            <select class="form-control" id="estado" name="estado">
                                                <option value="1">En carrito</option>
                                                <option value="2">En proceso</option>
                                                <option value="3">Pedido</option>
                                                <option value="4">Pagado</option>
                                                <option value="5">Solicitud</option>
                                                <option value="6">Cancelado</option>
                                                <option value="7">Entregado</option>
                                            </select>
                                            <div class="invalid-feedback">
                                                Ingrese un correo válido
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="cantidad">Cantidad <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text"><i class="fas fa-boxes"></i></div>
                                                </div>
                                                <input type="text" class="form-control" id="cantidad" name="cantidad" placeholder="777 1234 567" maxlength="<?php echo $maxCantidad; ?>" autocomplete="off" readonly required>
                                                <div class="invalid-feedback">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="costo">Costo <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text"><i class="fas fa-dollar-sign"></i></div>
                                                </div>
                                                <input type="text" class="form-control" id="costo" name="costo" placeholder="" maxlength="<?php echo $maxCantidad; ?>" autocomplete="off" readonly required>
                                                <div class="invalid-feedback">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group w-100">
                                        <label for="producto">Producto <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text"><i class="fas fa-box"></i></div>
                                            </div>
                                            <input type="text" class="form-control" id="producto" name="producto" placeholder="" maxlength="<?php echo $maxProducto; ?>" autocomplete="off" readonly required>
                                            <div class="invalid-feedback">
                                            </div>
                                        </div>
                                    </div>



                                  <div class="form-group w-100">
                                    <label for="detalles">Detalles del cliente</label>
                                    <textarea class="form-control" id="detalles" name="detalles" rows="3"></textarea>
                                  </div>



                                </div>
                             </form>
                        </div>
                    </div>';


                $modalFooter = '
                    <button type="button" class="btn btn-danger mr-auto" id="modal-btn-eliminar">Eliminar</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-info" id="modal-btn-editar">Editar</button>
                    <button type="button" class="btn btn-success d-none" id="modal-btn-anadir" >Añadir registro</button>
                    <button type="button" class="btn btn-success d-none" id="modal-btn-guardar" >Guardar cambios</button>';


                $resultado = array(
                    'tablaString' => $tabla, 
                    'tituloContenido' => '<h2 class="text-center" id="titulo-contenido">Pedidos</h2>',
                    'dataFetchFile' => 'listarPedidos.php',
                    'columnas' => $columnas,
                    'modalBody' => $modalBody,
                    'modalFooter' => $modalFooter,
                    'tablasADetallar' => $tablasADetallar
                );
                break;

    			break;





















        	case 'empresas-lista':
				include 'empresas-tabla.php';
                break;

    		case 'clientes-lista':
    			// Obtener el contenido de otro archivo en un string. En este caso el contenido es la tabla.
				$tabla = implode('', file('../includes/tablas/clientes-tabla.php'));

				$tablasADetallar = array(
                    array(
                        'tabla' => 'cliente',
                        'id' => null,      
                        'llaveForanea' => null, 
                        'select' => 'nombre, apellidoP, apellidoM, correo, telefono'
                    ), 
                    array(
                        'tabla' => 'empresa',
                        'id' => null,      
                        'llaveForanea' => null, 
                        'select' => 'nombre, telefono, correo'
                    ),
                    array(
                        'tabla' => 'direccion',
                        'id' => 'empresa', 
                        'llaveForanea' => 'empresaID', 
                        'select' => 'estado, municipio, cp, colonia, calle, numeroExt, numeroInt'
                    )
                );

				$columnas = array(
					array("data" => "0"),
                    array("data" => "1"),
					array("data" => "2"),
                    array("data" => "3"),
					array("data" => "4", "orderable" => false)
				);

				$modalBody = '
					<ul class="nav nav-tabs " id="myTab" role="tablist">
	                    <li class="nav-item">
	                        <a class="nav-link tab-link px-2 active" id="cliente-tab" data-toggle="tab" href="#cliente" role="tab" aria-controls="cliente" aria-selected="true">Cliente</a>
	                    </li>
	                    <li class="nav-item">
	                        <a class="nav-link tab-link px-2" id="empresa-tab" data-toggle="tab" href="#empresa" role="tab" aria-controls="empresa" aria-selected="false">Empresa</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link tab-link px-2" id="direccion-tab" data-toggle="tab" href="#direccion" role="tab" aria-controls="direccion" aria-selected="false">Direccion</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">


                        <div class="tab-pane show active" id="cliente" role="tabpanel" aria-labelledby="cliente-tab">
                            <p class="text-danger" id="mensaje-cliente"></p>
							<form class="needs-validation px-0 px-sm-3 pb-0 pb-sm-1 pt-2" id="form-cliente" autocomplete="off"  novalidate>
                                <!-- PASO 1 - CUENTA -->
		                        <div id="paso-1" class="">
		                            <p class="text-danger" id="resultCuenta"></p>

		                            <div class="form-group">
		                                <label for="nombres">Nombres <span class="text-danger">*</span></label>
		                                <div class="input-group">
		                                    <div class="input-group-prepend">
		                                        <div class="input-group-text"><i class="fas fa-user"></i></div>
		                                    </div>
		                                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Juan Carlos" maxlength="<?php echo $maxNombre; ?>" readonly required>
		                                    <div class="invalid-feedback">
		                                        Ingrese su nombre.
		                                    </div>
		                                </div>
		                            </div>

		                            <div class="form-row">

		                                <div class="form-group col-md-6">
		                                    <label for="apellidoP">Apellido Paterno <span class="text-danger">*</span></label>
		                                    <div class="input-group">
		                                        <div class="input-group-prepend">
		                                            <div class="input-group-text"><i class="fas fa-user"></i></div>
		                                        </div>
		                                        <input type="text" class="form-control" id="apellidoP" name="apellidoP" placeholder="Perez" maxlength="<?php echo $maxApellido; ?>" readonly required>
		                                        <div class="invalid-feedback">
		                                            Ingrese su apellido paterno.
		                                        </div>
		                                    </div>
		                                </div>

		                                <div class="form-group col-md-6">
		                                    <label for="apellidoM">Apellido Materno</label>
		                                    <div class="input-group">
		                                        <div class="input-group-prepend">
		                                            <div class="input-group-text"><i class="fas fa-user"></i></div>
		                                        </div>
		                                        <input type="text" class="form-control" id="apellidoM" name="apellidoM" placeholder="Rodríguez" maxlength="<?php echo $maxApellido; ?>" readonly>
		                                        <div class="invalid-feedback">
		                                            Ingrese su apellido materno.
		                                        </div>
		                                    </div>
		                                </div>

		                            </div>

		                            <div class="form-group">
		                                <label for="correo-cuenta">E-mail <span class="text-danger">*</span></label>
		                                <div class="input-group">
		                                    <div class="input-group-prepend">
		                                        <div class="input-group-text"><i class="fas fa-at"></i></div>
		                                    </div>
		                                    <input type="email" class="form-control" id="correo" name="correo" placeholder="nombre@ejemplo.com" maxlength="<?php echo $maxCorreo; ?>" readonly required>
		                                    <div class="invalid-feedback">
		                                        Ingrese un correo válido
		                                    </div>
		                                </div>
		                            </div>

		                            <div class="form-group">
		                                <label for="telefono-cuenta">Teléfono <span class="text-danger">*</span></label>
		                                <div class="input-group">
		                                    <div class="input-group-prepend">
		                                        <div class="input-group-text"><i class="fas fa-phone"></i></div>
		                                    </div>
		                                    <input type="text" class="form-control" id="telefono" name="telefono" placeholder="777 1234 567" maxlength="<?php echo $maxTelefono; ?>" autocomplete="off" readonly required>
		                                    <div class="invalid-feedback">
		                                        Ingrese su número de teléfono.
		                                    </div>
		                                </div>
		                            </div>
		                        </div>
	                         </form>
                        </div>






                        <!--TAB EMPRESA-->
                        <div class="tab-pane" id="empresa" role="tabpanel" aria-labelledby="empresa-tab">
                            <p class="text-danger" id="mensaje-empresa"></p>
							<form class="needs-validation px-0 px-sm-3 pb-0 pb-sm-1 pt-2" id="form-empresa" autocomplete="off"  novalidate>

                        		<!-- PASO 2 - EMPRESA -->
                                <div id="paso-2">
                                    <p class="text-danger" id="resultEmpresa"></p>
                                    <div class="form-group">
                                        <label for="empresa">Empresa <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text"><i class="fas fa-user"></i></div>
                                            </div>
                                            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Distribuidora y Mayorista Omega S.A de C.V." maxlength="<?php echo $maxEmpresa; ?>" readonly required>
                                            <div class="invalid-feedback">
                                                Ingrese su empresa.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="telefono-empresa">Teléfono <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text"><i class="fas fa-phone"></i></div>
                                            </div>
                                            <input type="text" class="form-control" id="telefono" name="telefono" placeholder="777 1234 567" maxlength="<?php echo $maxTelefono; ?>" autocomplete="off" readonly required>
                                            <div class="invalid-feedback">
                                                Ingresa el número de teléfono de tu empresa.
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label for="correo-empresa">E-mail <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text"><i class="fas fa-at"></i></div>
                                            </div>
                                            <input type="email" class="form-control" id="correo" name="correo" placeholder="nombre@ejemplo.com" maxlength="<?php echo $maxCorreo; ?>" readonly required>
                                            <div class="invalid-feedback">
                                                Ingrese un correo válido
                                            </div>
                                        </div>
                                    </div>

                                </div>
							</form>
					
                        </div>





						<!-- TAB DIRECCION -->
                        <div class="tab-pane" id="direccion" role="tabpanel" aria-labelledby="direccion-tab">

                            <p class="text-danger" id="mensaje-direccion"></p>
							
							<form class="needs-validation px-0 px-sm-3 pb-0 pb-sm-1 pt-2" id="form-direccion" autocomplete="off"  novalidate>
								<!-- PASO 3 - DIRECCION -->
                                <div id="paso-3">

                                    <p class="text-danger" id="resultDireccion"></p>

                                    <div class="form-row">

                                        <div class="form-group col-md-6">
                                            <label for="estado">Estado <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text"><i class="fas fa-map-marker-alt"></i></div>
                                                </div>
                                                <input type="text" class="form-control" id="estado" name="estado" placeholder="Estado" maxlength="<?php echo $maxEstado; ?>" readonly required>
                                                <div class="invalid-feedback">
                                                    Ingrese el Estado de su empresa.
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-6">
                                        <label for="municipio">Municipio <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text"><i class="fas fa-map-marker-alt"></i></div>
                                                </div>
                                                <input type="text" class="form-control" id="municipio" name="municipio" placeholder="Municipio" maxlength="<?php echo $maxMunicipio; ?>" readonly required>
                                                <div class="invalid-feedback">
                                                    Ingrese el municipio de su empresa.
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="codigo-postal">Código Postal <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text"><i class="fas fa-user"></i></div>
                                            </div>
                                            <input type="text" class="form-control" id="cp" name="cp" placeholder="Código Postal" maxlength="<?php echo $maxCodigoPostal; ?>" readonly required>
                                            <div class="invalid-feedback">
                                                Ingrese el códigio postal.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row">

                                        <div class="form-group col-md-6">
                                            <label for="colonia">Colonia <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text"><i class="fas fa-user"></i></div>
                                                </div>
                                                <input type="text" class="form-control" id="colonia" name="colonia" placeholder="Colonia" maxlength="<?php echo $maxColonia; ?>" readonly required>
                                                <div class="invalid-feedback">
                                                    Ingrese la colonia de su empresa.
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="calle">Calle <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text"><i class="fas fa-user"></i></div>
                                                </div>
                                                <input type="text" class="form-control" id="calle" name="calle" placeholder="Calle" maxlength="<?php echo $maxCalle; ?>" readonly required>
                                                <div class="invalid-feedback">
                                                    Ingrese la calle de su empresa.
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row">

                                        <div class="form-group col-md-6">
                                            <label for="numero-ext">Número exterior <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text"><i class="fas fa-user"></i></div>
                                                </div>
                                                <input type="text" class="form-control" id="numeroExt" name="numeroExt" placeholder="Número exterior" maxlength="<?php echo $maxNumerosExtInt; ?>" readonly required>
                                                <div class="invalid-feedback">
                                                    Ingrese el número exterior.
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="numero-int">Número interior</label>
                                        
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text"><i class="fas fa-user"></i></div>
                                                </div>
                                                <input type="text" class="form-control" id="numeroInt" name="numeroInt" placeholder="Número interior" maxlength="<?php echo $maxNumerosExtInt; ?>" readonly required>
                                                <div class="invalid-feedback">
                                                    Ingrese el número interior.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                        </div>
                    </div>';


                $modalFooter = '
                    <button type="button" class="btn btn-danger mr-auto" id="modal-btn-eliminar">Eliminar</button>
	                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	                <button type="button" class="btn btn-info" id="modal-btn-editar">Editar</button>
                    <button type="button" class="btn btn-success d-none" id="modal-btn-anadir" >Añadir registro</button>
	                <button type="button" class="btn btn-success d-none" id="modal-btn-guardar" >Guardar cambios</button>';


				$resultado = array(
					'tablaString' => $tabla, 
					'tituloContenido' => '<h2 class="text-center" id="titulo-contenido">Clientes</h2>',
					'dataFetchFile' => 'listarClientes.php',
					'columnas' => $columnas,
					'modalBody' => $modalBody,
					'modalFooter' => $modalFooter,
					'tablasADetallar' => $tablasADetallar
				);
				break;

















          	case 'vendedores-lista':
				// Obtener el contenido de otro archivo en un string. En este caso el contenido es la tabla.
                $tabla = implode('', file('../includes/tablas/vendedores-tabla.php'));

                $tablasADetallar = array(
                    array(
                        'tabla' => 'vendedor',
                        'id' => null,      
                        'llaveForanea' => null, 
                        'select' => 'nombre, apellidoP, apellidoM, usuario'
                    )
                );

                $columnas = array(
                    array("data" => "0"),
                    array("data" => "1"),
                    array("data" => "2"),
                    array("data" => "3", "orderable" => false)
                );

                $modalBody = '
                    <ul class="nav nav-tabs " id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link tab-link px-2 active" id="vendedor-tab" data-toggle="tab" href="#vendedor" role="tab" aria-controls="vendedor" aria-selected="true">Vendedor</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">


                        <div class="tab-pane show active" id="vendedor" role="tabpanel" aria-labelledby="vendedor-tab">
                            <p class="text-danger" id="mensaje-vendedor"></p>
                            <form class="needs-validation px-0 px-sm-3 pb-0 pb-sm-1 pt-2" id="form-vendedor" autocomplete="off"  novalidate>
                                <!-- PASO 1 - CUENTA -->
                                <div id="paso-1" class="">
                                    <p class="text-danger" id="resultCuenta"></p>

                                    <div class="form-group">
                                        <label for="nombres">Nombre <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text"><i class="fas fa-user"></i></div>
                                            </div>
                                            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Juan Carlos" maxlength="<?php echo $maxNombre; ?>" readonly required>
                                            <div class="invalid-feedback">
                                                Ingrese su nombre.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row">

                                        <div class="form-group col-md-6">
                                            <label for="apellidoP">Apellido Paterno <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text"><i class="fas fa-user"></i></div>
                                                </div>
                                                <input type="text" class="form-control" id="apellidoP" name="apellidoP" placeholder="Perez" maxlength="<?php echo $maxApellido; ?>" readonly required>
                                                <div class="invalid-feedback">
                                                    Ingrese su apellido paterno.
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="apellidoM">Apellido Materno</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text"><i class="fas fa-user"></i></div>
                                                </div>
                                                <input type="text" class="form-control" id="apellidoM" name="apellidoM" placeholder="Rodríguez" maxlength="<?php echo $maxApellido; ?>" readonly>
                                                <div class="invalid-feedback">
                                                    Ingrese su apellido materno.
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="form-group">
                                        <label for="correo-cuenta">Usuario<span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text"><i class="fas fa-user"></i></div>
                                            </div>
                                            <input type="text" class="form-control" id="usuario" name="usuario" placeholder="usuario" maxlength="<?php echo MAX_USUARIO; ?>" readonly required>
                                            <div class="invalid-feedback">
                                                Ingrese un correo válido
                                            </div>
                                        </div>
                                    </div>
                                </div>
                             </form>
                        </div>
                    </div>';


                $modalFooter = '
                    <button type="button" class="btn btn-danger mr-auto" id="modal-btn-eliminar">Eliminar</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-info" id="modal-btn-editar">Editar</button>
                    <button type="button" class="btn btn-success d-none" id="modal-btn-anadir" >Añadir registro</button>
                    <button type="button" class="btn btn-success d-none" id="modal-btn-guardar" >Guardar cambios</button>';


                $resultado = array(
                    'tablaString' => $tabla, 
                    'tituloContenido' => '<h2 class="text-center" id="titulo-contenido">Vendedores</h2>',
                    'dataFetchFile' => 'listarVendedores.php',
                    'columnas' => $columnas,
                    'modalBody' => $modalBody,
                    'modalFooter' => $modalFooter,
                    'tablasADetallar' => $tablasADetallar
                );

                break;















          	case 'administradores-lista':

				// Obtener el contenido de otro archivo en un string. En este caso el contenido es la tabla.
                $tabla = implode('', file('../includes/tablas/administradores-tabla.php'));

                $tablasADetallar = array(
                    array(
                        'tabla' => 'administrador',
                        'id' => null,      
                        'llaveForanea' => null, 
                        'select' => 'nombre, apellidoP, apellidoM, usuario'
                    )
                );

                $columnas = array(
                    array("data" => "0"),
                    array("data" => "1"),
                    array("data" => "2"),
                    array("data" => "3", "orderable" => false)
                );

                $modalBody = '
                    <ul class="nav nav-tabs " id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link tab-link px-2 active" id="administrador-tab" data-toggle="tab" href="#administrador" role="tab" aria-controls="administrador" aria-selected="true">Administrador</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">


                        <div class="tab-pane show active" id="administrador" role="tabpanel" aria-labelledby="administrador-tab">
                            <p class="text-danger" id="mensaje-administrador"></p>
                            <form class="needs-validation px-0 px-sm-3 pb-0 pb-sm-1 pt-2" id="form-administrador" autocomplete="off"  novalidate>
                                <!-- PASO 1 - CUENTA -->
                                <div id="paso-1" class="">
                                    <p class="text-danger" id="resultCuenta"></p>

                                    <div class="form-group">
                                        <label for="nombre">Nombre <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text"><i class="fas fa-user"></i></div>
                                            </div>
                                            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Juan Carlos" maxlength="<?php echo $maxNombre; ?>" readonly required>
                                            <div class="invalid-feedback">
                                                Ingrese su nombre.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row">

                                        <div class="form-group col-md-6">
                                            <label for="apellidoP">Apellido Paterno <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text"><i class="fas fa-user"></i></div>
                                                </div>
                                                <input type="text" class="form-control" id="apellidoP" name="apellidoP" placeholder="Perez" maxlength="<?php echo $maxApellido; ?>" readonly required>
                                                <div class="invalid-feedback">
                                                    Ingrese su apellido paterno.
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="apellidoM">Apellido Materno</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text"><i class="fas fa-user"></i></div>
                                                </div>
                                                <input type="text" class="form-control" id="apellidoM" name="apellidoM" placeholder="Rodríguez" maxlength="<?php echo $maxApellido; ?>" readonly>
                                                <div class="invalid-feedback">
                                                    Ingrese su apellido materno.
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="form-group">
                                        <label for="usuario">Usuario<span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text"><i class="fas fa-user"></i></div>
                                            </div>
                                            <input type="text" class="form-control" id="usuario" name="usuario" placeholder="usuario" maxlength="<?php echo MAX_USUARIO; ?>" readonly required>
                                            <div class="invalid-feedback">
                                                Ingrese un correo válido
                                            </div>
                                        </div>
                                    </div>
                                </div>
                             </form>
                        </div>
                    </div>';


                $modalFooter = '
                    <button type="button" class="btn btn-danger mr-auto" id="modal-btn-eliminar">Eliminar</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-info" id="modal-btn-editar">Editar</button>
                    <button type="button" class="btn btn-success d-none" id="modal-btn-anadir" >Añadir registro</button>
                    <button type="button" class="btn btn-success d-none" id="modal-btn-guardar" >Guardar cambios</button>';


                $resultado = array(
                    'tablaString' => $tabla, 
                    'tituloContenido' => '<h2 class="text-center" id="titulo-contenido">Administradores</h2>',
                    'dataFetchFile' => 'listarAdministradores.php',
                    'columnas' => $columnas,
                    'modalBody' => $modalBody,
                    'modalFooter' => $modalFooter,
                    'tablasADetallar' => $tablasADetallar
                );

                break;
        } 
  	}

  	echo json_encode($resultado);
} 

?>