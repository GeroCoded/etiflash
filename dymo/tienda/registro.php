<?php

/* Sublime Text 3 */

/**
 * Formulario del registro de clientes
 * 
 * PHP version 7.2.10
 *
 * @author Luis Fernando Gerónimo Carranza <luisfergeronimo@gmail.com>
 * @author Jesús Emmanuel Zetina Chevez <zcjo151173@upemor.edu.mx>
 */


// {{{ constants


//===============================================================================
// CONSTANTES PARA EL NÚMERO MÁXIMO DE CARACTERES EN LOS INPUTS DEL REGISTRO
//===============================================================================


//-----------------------------------------------------
// Cuenta Del Cliente
//-----------------------------------------------------

// Nombre de cliente
define('MAX_NOMBRE', 32);

// Apellidos del cliente
define('MAX_APELLIDO', 24);

// Correo del cliente 
define('MAX_CORREO', 64);

// Teléfono del cliente
define('MAX_TELEFONO', 19);


//-----------------------------------------------------
// Empresa Del Cliente
//-----------------------------------------------------

// Empresa del cliente
define('MAX_EMPRESA', 100);


//-----------------------------------------------------
// Dirección De La Empresa
//-----------------------------------------------------

// Estado de la empresa
define('MAX_ESTADO', 24);

// Municipio de la empresa
define('MAX_MUNICIPIO', 50);

// Código postal de la empresa
define('MAX_CODIGO_POSTAL', 5);

// Colonia de la empresa
define('MAX_COLONIA', 50);

// Calle de la empresa
define('MAX_CALLE', 50);

// Número Interior y Exterior de la empresa
define('MAX_NUMEROS_EXT_INT', 5);


//-----------------------------------------------------
// Seguridad De La Cuenta
//-----------------------------------------------------

// Mínimo y máximo de la contraseña de la cuenta
define('MIN_CONTRASENA', 10);
define('MAX_CONTRASENA', 26);

// }}}

?>

<!doctype html>
<html lang="es-mx">
<head>
    <!-- Required meta tags -->
    <meta http-equiv="Content-Type" content="text/html" charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../assets/css/bootstrap.css">

    <link rel="stylesheet" href="../assets/css/solid.css">
    <link rel="stylesheet" href="../assets/css/fontawesome.css">

    <style>

        /* Color de las letras de los input de los form's */
        input{
            color:black !important;
        }

        /* Color de fondo y color del borde del div donde
         * se encuentran los íconos FontAwesome de los input
         */
        .input-group-text{
            border-color: #5C6375;
            background-color: #5C6375;
        }

        /* Color de los íconos FontAwesome */
        .fas {
          color: white;
        }

        /* Por defecto no se muestran los pasos 2 al 4 */
        #paso-2, #paso-3, #paso-4 {
            display: none;
        }
    </style>

    <title>Dymo - Tienda</title>
</head>
<body style="background-image: url(../assets/img/ui/registro.jpg); background-size: cover;">

<div class="alert alert-success fixed-top" id="mensaje-error" role="alert">
    Registro exitoso
</div>


<!-- CONTENEDOR -->
<div class="container px-0 py-4">

    <!-- FILA FORMULARIO -->
    <div class="row align-items-center bg-transparent mx-0" style="min-height: 100vh; background-color: white;">
        
        <!-- COLUMNA RELLENADORA - IZQUIERDA-->
        <div class="col-0 col-sm-1 col-md-2 col-lg-3"></div>
        

        <!-- COLUMNA CON FORMULARIO -->
        <div class="col-12 col-sm-10 col-md-8 col-lg-6">
            <div class="card text-white bg-dark" style="background-color:rgba(0, 0, 0, 0.8);">


                <div class="card-body px-3">

                    
                    <div class="card-header mb-3 text-center">


                        <!-- BARRA DE PROGRESO -->
                        <div class="progress" style="height: 22px;">
                            <div class="progress-bar progress-bar-striped bg-success" id="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"><span class="lead" id="progress-bar-text">PASO 1</span></div>
                        </div>

                    </div>                                
                    
                    <h3 class="card-title text-center text-nowrap" id="card-title">Cuenta Personal</h3>
                    





                    <!-- FORMULARIO -->
                    <form class="needs-validation px-0 px-sm-3 pb-0 pb-sm-1 pt-2" id="form-registro" novalidate>




                        <!-- PASO 1 - CUENTA -->
                        <div id="paso-1">
                            <p class="text-danger" id="resultCuenta"></p>

                            <div class="form-group">
                                <label for="nombres">Nombres <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-user"></i></div>
                                    </div>
                                    <input type="text" class="form-control" id="nombres" name="nombres" placeholder="ej. Juan Carlos" maxlength="<?php echo MAX_NOMBRE; ?>" required>
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
                                        <input type="text" class="form-control" id="apellidoP" name="apellidoP" placeholder="ej. Perez" maxlength="<?php echo MAX_APELLIDO; ?>" required>
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
                                        <input type="text" class="form-control" id="apellidoM" name="apellidoM" placeholder="ej. Rodríguez" maxlength="<?php echo MAX_APELLIDO; ?>">
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
                                    <input type="email" class="form-control" id="correo-cuenta" name="correo-cuenta" placeholder="ej. nombre@ejemplo.com" maxlength="<?php echo MAX_CORREO; ?>" required>
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
                                    <input type="text" class="form-control" id="telefono-cuenta" name="telefono-cuenta" placeholder="ej. (55) 5650-2369" maxlength="<?php echo MAX_TELEFONO; ?>" autocomplete="off" required>
                                    <div class="invalid-feedback">
                                        Ingrese su número de teléfono.
                                    </div>
                                </div>
                            </div>

                            <a href="#" class="btn btn-success my-3 w-100" id="btn-cuenta-sig">Siguiente</a>
                        </div><!-- FIN PASO 1 - CUENTA -->





                        <!-- PASO 2 - EMPRESA -->
                        <div id="paso-2">
                            <p class="text-danger" id="resultEmpresa"></p>
                            <div class="form-group">
                                <label for="empresa">Empresa <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-user"></i></div>
                                    </div>
                                    <input type="text" class="form-control" id="empresa" name="empresa" placeholder="ej. Distribuidora y Mayorista Omega S.A de C.V." maxlength="<?php echo MAX_EMPRESA; ?>" required>
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
                                    <input type="text" class="form-control" id="telefono-empresa" name="telefono-empresa" placeholder="ej. (55) 5650-2369" maxlength="<?php echo MAX_TELEFONO; ?>" autocomplete="off" required>
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
                                    <input type="email" class="form-control" id="correo-empresa" name="correo-empresa" placeholder="ej. nombre@ejemplo.com" maxlength="<?php echo MAX_CORREO; ?>" required>
                                    <div class="invalid-feedback">
                                        Ingrese un correo válido
                                    </div>
                                </div>
                            </div>

                            <!-- Boton de "Anterior" && "Siguiente" -->
                            <div class="form-row">

                                <div class="col-12 col-md-6">
                                    <a href="#" class="btn btn-secondary my-3 w-100" id="btn-empresa-ant">Anterior</a>
                                </div>

                                <div class="col-12 col-md-6">
                                    <a href="#" class="btn btn-success my-3 w-100" id="btn-empresa-sig">Siguiente</a>
                                </div>
                            </div>
                        </div><!-- FIN PASO 2 - EMPRESA -->






                        <!-- PASO 3 - DIRECCION -->
                        <div id="paso-3">
                            
                            <h4 class="text-secondary">Su empresa</h4>

                            <p class="text-danger" id="resultDireccion"></p>

                            <div class="form-row">

                                <div class="form-group col-md-6">
                                    <label for="estado">Estado <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fas fa-map-marker-alt"></i></div>
                                        </div>
                                        <input type="text" class="form-control" id="estado" name="estado" placeholder="ej. Ciudad de México" maxlength="<?php echo MAX_ESTADO; ?>" required>
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
                                        <input type="text" class="form-control" id="municipio" name="municipio" placeholder="ej. Iztacalco" maxlength="<?php echo MAX_MUNICIPIO; ?>" required>
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
                                    <input type="text" class="form-control" id="codigo-postal" name="codigo-postal" placeholder="ej. 08300" maxlength="<?php echo MAX_CODIGO_POSTAL; ?>" required>
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
                                        <input type="text" class="form-control" id="colonia" name="colonia" placeholder="ej. Santa Anita" maxlength="<?php echo MAX_COLONIA; ?>" required>
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
                                        <input type="text" class="form-control" id="calle" name="calle" placeholder="ej. Coyuya" maxlength="<?php echo MAX_CALLE; ?>" required>
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
                                        <input type="text" class="form-control" id="numero-ext" name="numero-ext" placeholder="ej. 12345" maxlength="<?php echo MAX_NUMEROS_EXT_INT; ?>" required>
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
                                        <input type="text" class="form-control" id="numero-int" name="numero-int" placeholder="ej. 54321" maxlength="<?php echo MAX_NUMEROS_EXT_INT; ?>" required>
                                        <div class="invalid-feedback">
                                            Ingrese el número interior.
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Boton de "Anterior" && "Siguiente" -->
                            <div class="form-row">

                                <div class="col-12 col-md-6">
                                    <a href="#" class="btn btn-secondary my-3 w-100" id="btn-direccion-ant">Anterior</a>
                                </div>

                                <div class="col-12 col-md-6">
                                    <a href="#" class="btn btn-success my-3 w-100" id="btn-direccion-sig">Siguiente</a>
                                </div>
                            </div>
                        </div><!-- FIN PASO 3 - DIRECCION -->









                        <!-- PASO 4 - Contraseña -->
                        <div id="paso-4">
                            <p class="text-danger" id="resultContrasena"></p>

                            <div class="form-group">
                                <label for="contrasena">Contraseña <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-key"></i></div>
                                    </div>
                                    <input type="password" class="form-control" id="contrasena" name="contrasena" aria-describedby="emailHelp" placeholder="ej. C-nt0rs1n.8a" maxlength="<?php echo MAX_CONTRASENA; ?>" required>

                                    <div class="invalid-feedback">
                                        Ingrese una contraseña segura
                                    </div>
                                </div>
                                <small id="passwordHelp" class="form-text text-muted">Ingrese una contraseña entre 8 y 26 caracteres.</small>
                            </div>

                            <div class="form-group">
                                <label for="contrasena-repetida">Repita su contraseña <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-key"></i></div>
                                    </div>
                                    <input type="password" class="form-control" id="contrasena-repetida" name="contrasena-repetida" placeholder="ej. C-nt0rs1n.8a" maxlength="<?php echo MAX_CONTRASENA; ?>" required>

                                    <div class="invalid-feedback">
                                        Sus contraseñas no coinciden.
                                    </div>
                                </div>


                            <!-- Boton de "Anterior" && "Registrarse" -->
                            <div class="form-row">

                                <!-- Anterior -->
                                <div class="col-12 col-md-6">
                                    <a href="#" class="btn btn-secondary my-3 w-100" id="btn-contrasena-ant">Anterior</a>
                                </div>

                                <!-- Registrarse -->
                                <div class="col-12 col-md-6">
                                    <button type="submit" class="btn btn-info my-3 w-100" id="btn-contrasena-sig">Registrarse</button>
                                </div>

                            </div><!-- FIN Boton de "Anterior" && "Registrarse" -->

                        </div><!-- FIN PASO 4 - Contraseña -->

                        
                    </form> <!-- FIN FORMULARIO -->
                    

                </div>
                <div class="card-footer text-muted text-center">
                    <div class="row">
                        <div class="col-4">
                            <!-- Link para ir a la página principal -->
                            <a href="../index.html" class="card-link font-weight-bold text-success float-left">Inicio</a>
                        </div>
                        <div class="col-4">
                            <!-- Link para ir a la tienda -->
                            <a href="../tienda/index.php" class="card-link font-weight-bold text-white ">Tienda</a>
                        </div>
                        <div class="col-4">
                            <!-- Link para ir al inicio de sesión -->
                            <a href="login.php" class="card-link font-weight-bold text-danger float-right">Iniciar sesión</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

                        
        <!-- COLUMNA RELLENADORA - DERECHA -->
        <div class="col-0 col-sm-1 col-md-2 col-lg-3"></div>
    </div>
</div>





<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="../assets/js/jquery-3.3.1.js"></script>
<script src="../assets/js/popper.js"></script>
<script src="../assets/js/bootstrap.js"></script>


<!-- CUSTOM SCRIPTS -->

<!-- Validaciones de bootstrap -->
<script src="../assets/js/needs-validation-bootstrap.js"></script>

<!-- Funciones para las validaciones de los input's -->
<script src="../assets/js/validation-functions.js"></script>

<!-- Inputs del formulario -->
<script>

    /**
     * Instancias de input's y el form
     *
     * Este script se encarga de extraer los input y el formulario en 
     * variables para poder accesarlas más adelante de manera más fácil.
     *
     * @author Luis Fernando Gerónimo Carranza <luisfergeronimo@gmail.com>
     * @author Jesús Emmanuel Zetina Chevez <zcjo151173@upemor.edu.mx>
     */
    
    //======================================================================
    // VARIABLES GLOBALES DE INSTANCIAS DE ELEMENTOS HTML
    //======================================================================

    //-----------------------------------------------------
    // Formulario
    //-----------------------------------------------------
    
    var form = $("#form-registro");

    //-----------------------------------------------------
    // Paso 1: Cuenta
    //-----------------------------------------------------
    
    var inputNombres         = $("#nombres");
    var inputApellidoP       = $("#apellidoP");
    var inputApellidoM       = $("#apellidoM");
    var inputCorreoCuenta    = $("#correo-cuenta");
    var inputTelefonoCuenta  = $("#telefono-cuenta");

    //-----------------------------------------------------
    // Paso 2: Empresa
    //-----------------------------------------------------
    
    var inputEmpresa         = $("#empresa");
    var inputTelefonoEmpresa = $("#telefono-empresa");
    var inputCorreoEmpresa   = $("#correo-empresa");

    //-----------------------------------------------------
    // Paso 3: Dirección
    //-----------------------------------------------------
    
    var inputEstado          = $("#estado");
    var inputMunicipio       = $("#municipio");
    var inputCodigoPostal    = $("#codigo-postal");
    var inputColonia         = $("#colonia");
    var inputCalle           = $("#calle");
    var inputNumeroExt       = $("#numero-ext");
    var inputNumeroInt       = $("#numero-int");

    //-----------------------------------------------------
    // Paso 4: Seguridad
    //-----------------------------------------------------


    var inputContrasena         = $("#contrasena");
    var inputContrasenaRepetida = $("#contrasena-repetida");

    //-----------------------------------------------------
    // Mensajes de respuesta.
    //-----------------------------------------------------
    $('#mensaje-error').hide();

</script>

<script>
    /**
     * Script de validaciones del input
     * 
     * Este script se encarga de hacer las siguientes validaciones:
     * 
     *   + Tecla Enter:     Se relaciona la tecla Enter con los botones
     *                      "Siguiente" de los formularios.
     * 
     *   + Inhabilitación   El usuario no podrá hacer uso de ciertas teclas
     *     de teclas:       dependiendo del input en el que esté escribiendo
     * 
     *   + Validación de    Si el usuario llega a poder ingresar algún
     *     caracteres:      caracter no permitido, se le muestra un mensaje
     *                      por debajo del input.
     *               
     *   + Longitud:        El usuario recibirá un mensaje en caso de que,
     *                      de alguna forma, exceda el número de caracteres
     *                      permitidos en un input. Cabe destacar que el
     *                      límite de caracteres también está asigando en
     *                      html como atributo de los input.
     *                   
     *   + Coincidencia:    JavaScript validará que las contraseñas en el
     *                      último formulario sean iguales. En caso contrario
     *                      le mostrará al usuario un mensaje.
     *
     *   + Contraseñas:     Valida que la contraseñas tenga cierto nivel de
     *                      seguridad. Debe tener mínimo: 1 letra mayúscula,
     *                      1 letra minúscula y 1 número.
     *
     *   + Vacío:           Se verifica que el input no este vacío.
     *
     * Cuando se ejecuta el evento 'click' de los respectivos botones que
     * llevan al siguiente formulario, o en su caso, al envío de datos para
     * el registro, el script volverá a verificar las siguientes validaciones:
     * 
     *   + Validación de caracteres
     *   + Longitud
     *   + Coincidencia (En el caso de las contraseñas)
     *   + Vacío
     *   
     * @author Luis Fernando Gerónimo Carranza <luisfergeronimo@gmail.com>
     * @author Jesús Emmanuel Zetina Chevez <zcjo151173@upemor.edu.mx>
     */
    
    $(document).ready(function() {

        /**
         * Cada que se apriete la tecla Enter, se verificará en qué paso
         * del formulario se encuentra el usuario y dependiendo de esto
         * se ejecutrará el evento 'click' del botón "siguiente" de
         * dicho paso donde se encuentre el usuario.
         */
        $(window).keydown(function(event){

            // 13 es el código para la tecla 'Enter'
            if(event.keyCode == 13) {
                if($('#paso-1').is(":visible")){
                    $("#btn-cuenta-sig").trigger("click");
                    
                    event.preventDefault();
                    return false;

                } else if($('#paso-2').is(":visible")){
                    $("#btn-empresa-sig").trigger("click");

                    event.preventDefault();
                    return false;
                        
                } else if($('#paso-3').is(":visible")){
                    $("#btn-direccion-sig").trigger("click");
                    
                    event.preventDefault();                                    
                    return false;
                } else {
                    //alert("paso4 visible");
                }
            }
        });

        var form = $("#form-registro");


        //======================================================================
        // CUENTA DEL CLIENTE
        //======================================================================
        

        //-----------------------------------------------------
        // Inhabilitación De Teclas
        //-----------------------------------------------------

        // Inhabilitación de teclas para nombres
        validarTeclasNombres("#nombres");
        validarTeclasNombres("#apellidoP");
        validarTeclasNombres("#apellidoM");

        // Inhabilitación de teclas para teléfonos
        validarTeclasTelefono("#telefono-cuenta");



        //-----------------------------------------------------
        // Validación De Caracteres, Longitud && Vacío
        //-----------------------------------------------------
        
        /*
         * Cada que se aprieta una tecla en el input 'inputNombres'
         * javascript se encarga de hacer las validaciones en el sig.
         * orden:
         *
         *   1. Vacío
         *   2. Longitud
         *   3. Validación de caracteres
         *
         * Cada validación tiene un mensaje para su respectivo caso.
         */
        inputNombres.on('keyup', function(e){
            e.preventDefault();

            if(e.which === 13) {

            } else if(validarInputVacio($(this),  form, "el nombre")){

                // Funcion para validar el tamaño del input ingresado por el usuario.
                // Params:            (input,    form,       nombreInput,  min,             max)
                if(validarInputLength($(this),    form,     "El nombre",  0, <?php echo MAX_NOMBRE;   ?>)){ 
                    // Validación de sólo letras, incluyendo letras con acentos.
                    validarInputLettersOnly($(this), form, "El nombre");
                }
            }
        });

        /*
         * Cada que se aprieta una tecla en el input con id 'apellidoP'
         * o 'apellidoM' javascript se encarga de hacer las
         * validaciones en el siguiente orden:
         *
         *   1. Vacío (sólo en el caso del apellidoP)
         *   2. Longitud
         *   3. Validación de caracteres
         *
         * Cada validación tiene un mensaje para su respectivo caso.
         */
        $("#apellidoP, #apellidoM").on('keyup', function(e){
            e.preventDefault();

            if(e.which === 13) {

            } else{

                if($(this).attr('id') === 'apellidoP'){
                    validarInputVacio($(this),  form, "el apellido");
                    return;
                }


                // Funcion para validar el tamaño del input ingresado por el usuario.
                // Params:            (input,    form,       nombreInput,  min,             max)
                if(validarInputLength($(this),    form,     "El apellido",  0, <?php echo MAX_APELLIDO;   ?>)){

                    // Validación de sólo letras, incluyendo letras con acentos.
                    validarInputLettersOnly($(this), form, "El apellido");
                }
            }
        });
        
        /*
         * Cada que se aprieta una tecla en el input 'inputCorreoCuenta'
         * javascript se encarga de hacer las validaciones en el sig.
         * orden:
         *
         *   1. Vacío
         *   2. Longitud
         *
         * Cada validación tiene un mensaje para su respectivo caso.
         *
         * Este input no tiene restricciones de caracteres.
         */
        inputCorreoCuenta.on('keyup', function(e){
            e.preventDefault();

            if(e.which === 13) {

                // Funcion para validar el tamaño del input ingresado por el usuario.
                // Params:            (input,    form,       nombreInput,  min,             max)
            } else if(validarInputVacio($(this),  form, "el correo")){

                // Funcion para validar el tamaño del input ingresado por el usuario.
                // Params:          (input,    form, articuloInput, nombreInput, min, max)
                validarInputLength($(this),    form,     "El correo",  0, <?php echo MAX_CORREO;   ?>);
            }
        });

        /*
         * Cada que se aprieta una tecla en el input 
         * 'inputTelefonoCuenta' javascript se encarga de hacer las
         * validaciones en el siguiente orden:
         *
         *   1. Vacío
         *   2. Longitud
         *   3. Validación de caracteres
         *
         * Cada validación tiene un mensaje para su respectivo caso.
         */
        inputTelefonoCuenta.on('keyup', function(e){
            e.preventDefault();

            if(e.which === 13) {
            } else if(validarInputVacio($(this),  form, "el teléfono")){

                // Funcion para validar el tamaño del input ingresado por el usuario.
                // Params:            (input,    form,       nombreInput,  min,             max)
                if(validarInputLength($(this),    form,     "El teléfono",  0, <?php echo MAX_TELEFONO;   ?>)){

                    // Validar que sólo se metan caracteres válidos para un teléfono (+, -,  , 0-9)
                    validarInputTelefonoOnly($(this), form); 
                }
            }
        });
        
        //======================================================================
        // EMPRESA
        //======================================================================
        

        //-----------------------------------------------------
        // Inhabilitación De Teclas
        //-----------------------------------------------------

        // Inhabilitación de teclas para nombres
        validarTeclasNombres("#empresa");

        // Inhabilitación de teclas para teléfonos
        validarTeclasTelefono("#telefono-empresa");


        //-----------------------------------------------------
        // Validación De Caracteres, Longitud && Vacío
        //-----------------------------------------------------
        
        /*
         * Cada que se aprieta una tecla en el input 'inputEmpresa'
         * javascript se encarga de hacer las validaciones en el sig.
         * orden:
         *
         *   1. Vacío
         *   2. Longitud
         *   3. Validación de caracteres
         *
         * Cada validación tiene un mensaje para su respectivo caso.
         */
        inputEmpresa.on('keyup', function(e){
            e.preventDefault();

            if(e.which === 13) {

            } else if(validarInputVacio($(this),  form, "la empresa")){

                // Funcion para validar el tamaño del input ingresado por el usuario.
                // Params:            (input,    form,       nombreInput,  min,             max)
                if(validarInputLength($(this),    form,     "La empresa",  0, <?php echo MAX_EMPRESA; ?>)){
                    validarInputLettersOnly($(this), form, "La empresa");
                }
            }
        });

        /*
         * Cada que se aprieta una tecla en el input 'inputTelefonoEmpresa'
         * javascript se encarga de hacer las validaciones en el sig.
         * orden:
         *
         *   1. Vacío
         *   2. Longitud
         *   3. Validación de caracteres
         *
         * Cada validación tiene un mensaje para su respectivo caso.
         */
        inputTelefonoEmpresa.on('keyup', function(e){
            e.preventDefault();

            if(e.which === 13) {

            } else if(validarInputVacio($(this),  form, "el teléfono")){

                // Funcion para validar el tamaño del input ingresado por el usuario.
                // Params:            (input,    form,       nombreInput,  min,             max)
                if(validarInputLength($(this),    form,     "El teléfono",  0, <?php echo MAX_TELEFONO;   ?>)){

                    // Validar que sólo se metan caracteres válidos para un teléfono (+, -,  , 0-9)
                    validarInputTelefonoOnly($(this), form); 
                }
            }
        });

        /*
         * Cada que se aprieta una tecla en el input 'inputCorreoEmpresa'
         * javascript se encarga de hacer las validaciones en el sig.
         * orden:
         *
         *   1. Vacío
         *   2. Longitud
         *
         * Cada validación tiene un mensaje para su respectivo caso.
         *
         * Este input no tiene validación de caracteres.
         */
        inputCorreoEmpresa.on('keyup', function(e){
            e.preventDefault();

            if(e.which === 13) {

            } else if(validarInputVacio($(this),  form, "el correo")){

                // Funcion para validar el tamaño del input ingresado por el usuario.
                // Params:         (input,    form,     nombreInput,  min,             max)
                validarInputLength($(this),    form,     "El correo",  0, <?php echo MAX_CORREO;   ?>);   
            }
        });



        //======================================================================
        // DIRECCIÓN
        //======================================================================
        

        //-----------------------------------------------------
        // Inhabilitación De Teclas
        //-----------------------------------------------------

        // Inhabilitación de teclas para nombres
        validarTeclasNombres("#estado");
        validarTeclasNombres("#municipio");
        validarTeclasNombres("#colonia");
        validarTeclasNombres("#calle");

        // Inhabilitación de teclas para números sin puntos
        validarTeclasNumerosSinPuntos("#codigo-postal");
        validarTeclasNumerosSinPuntos("#numero-ext");
        validarTeclasNumerosSinPuntos("#numero-int");


        //-----------------------------------------------------
        // Validación De Caracteres, Longitud && Vacío
        //-----------------------------------------------------
        
        /*
         * Cada que se aprieta una tecla en el input 'inputEstado'
         * javascript se encarga de hacer las validaciones en el sig.
         * orden:
         *
         *   1. Vacío
         *   2. Longitud
         *   3. Validación de caracteres
         *
         * Cada validación tiene un mensaje para su respectivo caso.
         */
        inputEstado.on('keyup', function(e){
            e.preventDefault();

            if(e.which === 13) {

            } else if(validarInputVacio($(this),  form, "el estado")){

                // Funcion para validar el tamaño del input ingresado por el usuario.
                // Params:            (input,    form,       nombreInput,  min,             max)
                if(validarInputLength($(this),    form,     "El estado",  0, <?php echo MAX_ESTADO;   ?>)){
                    validarInputLettersOnly($(this), form, "El estado");
                }
            }

        });

        /*
         * Cada que se aprieta una tecla en el input 'inputMunicipio'
         * javascript se encarga de hacer las validaciones en el sig.
         * orden:
         *
         *   1. Vacío
         *   2. Longitud
         *   3. Validación de caracteres
         *
         * Cada validación tiene un mensaje para su respectivo caso.
         */
        inputMunicipio.on('keyup', function(e){
            e.preventDefault();

            if(e.which === 13) {

            } else if(validarInputVacio($(this),  form, "el municipio")){

                // Funcion para validar el tamaño del input ingresado por el usuario.
                // Params:            (input,    form,       nombreInput,  min,             max)
                if(validarInputLength($(this),    form,     "El municipio",  0, <?php echo MAX_MUNICIPIO;   ?>)){
                    validarInputLettersOnly($(this), form, "El municipio");
                }
            }
        });

        /*
         * Cada que se aprieta una tecla en el input 'inputCodigoPostal'
         * javascript se encarga de hacer las validaciones en el sig.
         * orden:
         *
         *   1. Vacío
         *   2. Longitud
         *   3. Validación de caracteres
         *
         * Cada validación tiene un mensaje para su respectivo caso.
         */
        inputCodigoPostal.on('keyup', function(e){
            e.preventDefault();

            if(e.which === 13) {

            } else if(validarInputVacio($(this),  form, "el código postal")){

                // Funcion para validar el tamaño del input ingresado por el usuario.
                // Params:            (input,    form,       nombreInput,  min,             max)
                if(validarInputLength($(this),    form,     "El código postal",  0, <?php echo MAX_CODIGO_POSTAL;   ?>)){
                    validarInputNumbersOnly($(this), form, "El código postal");
                }
            }
        });

        /*
         * Cada que se aprieta una tecla en el input 'inputColonia'
         * javascript se encarga de hacer las validaciones en el sig.
         * orden:
         *
         *   1. Vacío
         *   2. Longitud
         *   3. Validación de caracteres
         *
         * Cada validación tiene un mensaje para su respectivo caso.
         */
        inputColonia.on('keyup', function(e){
            e.preventDefault();

            if(e.which === 13) {

            } else if(validarInputVacio($(this),  form, "la colonia")){

                // Funcion para validar el tamaño del input ingresado por el usuario.
                // Params:            (input,    form,       nombreInput,  min,             max)
                if(validarInputLength($(this),    form,     "La colonia",  0, <?php echo MAX_COLONIA;   ?>)){
                    validarInputLettersOnly($(this), form, "La colonia");
                }
            }
        });

        /*
         * Cada que se aprieta una tecla en el input 'inputCalle'
         * javascript se encarga de hacer las validaciones en el sig.
         * orden:
         *
         *   1. Vacío
         *   2. Longitud
         *   3. Validación de caracteres
         *
         * Cada validación tiene un mensaje para su respectivo caso.
         */
        inputCalle.on('keyup', function(e){
            e.preventDefault();

            if(e.which === 13) {

            } else if(validarInputVacio($(this),  form, "la calle")){

                // Funcion para validar el tamaño del input ingresado por el usuario.
                // Params:            (input,    form,       nombreInput,  min,             max)
                if(validarInputLength($(this),    form,     "La calle",  0, <?php echo MAX_CALLE;   ?>)){
                    validarInputLettersOnly($(this), form, "La calle");
                }
            }
        });

        /*
         * Cada que se aprieta una tecla en el input 'inputNumeroExt'
         * javascript se encarga de hacer las validaciones en el sig.
         * orden:
         *
         *   1. Vacío
         *   2. Longitud
         *   3. Validación de caracteres
         *
         * Cada validación tiene un mensaje para su respectivo caso.
         */
        inputNumeroExt.on('keyup', function(e){
            e.preventDefault();

            if(e.which === 13) {

            } else if(validarInputVacio($(this),  form, "el número exterior")){

                // Funcion para validar el tamaño del input ingresado por el usuario.
                // Params:            (input,    form,       nombreInput,  min,             max)
                if(validarInputLength($(this),    form,     "El número exterior",  0, <?php echo MAX_NUMEROS_EXT_INT;   ?>)){
                    validarInputNumbersOnly($(this), form, "El número exterior");
                }
            }
        });

        /*
         * Cada que se aprieta una tecla en el input 'inputNumeroInt'
         * javascript se encarga de hacer las validaciones en el sig.
         * orden:
         *
         *   1. Longitud
         *   2. Validación de caracteres
         *
         * Cada validación tiene un mensaje para su respectivo caso.
         *
         * Este input no tiene validación de Vacío porque no es
         * obligatorio.
         */
        inputNumeroInt.on('keyup', function(e){
            e.preventDefault();

            if(e.which === 13) {

                // Funcion para validar el tamaño del input ingresado por el usuario.
                // Params:              (input,     form,       nombreInput,         min,             max)
            } else if(validarInputLength($(this),    form,     "El número interior",  0, <?php echo MAX_NUMEROS_EXT_INT;   ?>)){
                validarInputNumbersOnly($(this), form, "El número interior");
            }
        });


//======================================================================
        //======================================================================
        // SEGURIDAD
        //======================================================================
        

        //-----------------------------------------------------
        // Inhabilitación De Teclas
        //-----------------------------------------------------

        // SIN Inhabilitación de teclas


        //-----------------------------------------------------
        // Validación de Contraseñas, Longitud, Coincidencia y Vacío
        //-----------------------------------------------------
        
        /*
         * Cada que se aprieta una tecla en el input 'inputContrasena'
         * javascript se encarga de hacer las validaciones en el sig.
         * orden:
         *
         *   1. Vacío
         *   2. Longitud
         *   3. Contraseñas
         *   4. Coincidencia
         *
         * Cada validación tiene un mensaje para su respectivo caso.
         */
        inputContrasena.on('keyup',function(e){
            e.preventDefault();

            if(e.which === 13) {

            } else if(validarInputVacio($(this),  form, "la contraseña")){

                // Funcion para validar el tamaño del input ingresado por el usuario.
                // Params:            (input,    form,       nombreInput,  min,             max)
                if(validarInputLength($(this),    form,     "La contraseña",  8, <?php echo MAX_CONTRASENA;   ?>)){
                    if(validarInputContrasena($(this), $(this).val(), form)){
                        // Función para validar que dos input coincidan.
                        // Params:       (   input1,         input2, form)
                        validarCoincidencia($(this), $("#contrasena-repetida"), form);
                    }    
                }
            }
        });

        
        
        /*
         * Cada que se aprieta una tecla en el input 
         * 'inputContrasenaRepetida' javascript se encarga de hacer las
         * validaciones en el siguiente orden:
         *
         *   1. Coincidencia
         *
         * Cada validación tiene un mensaje para su respectivo caso.
         */
        inputContrasenaRepetida.on('keyup',function(){
            validarCoincidencia($("#contrasena"), $(this), form);
        });
    });


</script>

<script>
    /**
     * @author Luis Fernando Gerónimo Carranza <luisfergeronimo@gmail.com>
     * @author Jesús Emmanuel Zetina Chevez <zcjo151173@upemor.edu.mx>
     * 
     * @todo Verificar si es viable solucionar el problema de repetición de
     *       código en las validaciones de este script. Tal vez reducirlo
     *       junto con el script de las validaciones al escribir dentro
     *       del input.
     *
     * @todo Crear un Alert de Bootstrap para el registro exitoso y el
     *       mensaje de verificación de correo.
     *       
     * On click listeners de los botones del formulario
     *
     * Este script contiene las funciones que se ejecutarán cuando se
     * reconozca un evento click en los botones del formulario completo
     * (es decir, los 4 pasos: Cuenta, Empresa, Dirección y Seguridad).
     *
     * Al momento de que el usuario quiera pasar al siguiente paso,
     * ya sea por medio de la tecla 'Enter' o dando click izquierdo
     * en el boton "Siguiente", se verifican los valores de los input 
     * que están visibles y, en caso de que algún input esté inválido, se
     * le muestra un mensaje de error al usuario justo por debajo de los 
     * input's inválidos.
     *
     * Las validaciones se hacen de igual forma que se valida cuando el
     * usuario escribe dentro de los input a excepción que en este caso
     * se validan todos los input y se muestran todos los mensajes
     * necesarios.
     *
     * No se írá a detalle en cuanto a comentarios en este caso, porque
     * es prácticamente igual para cada paso:
     * 
     *   1. Se crea una bandera (boolean) para saber si el formulario
     *      es inválido o no.
     *
     *   2. Se verifican los input's con las validaciones 
     *      correspondientes.
     *
     *   3. Si una de las validaciones devuelve "falso", se niega y 
     *      entra al IF y la bandera se vuelve TRUE.
     *
     *   4. Si la bandera es TRUE, no le deja pasar al siguiente paso.
     *
     *   5. Si la bandera es FALSE, se muestra el siguiente paso.
     *
     *
     * 
     */
    $(document).ready(function(){

        
        //======================================================================
        // ON CLICK LISTENERS DE LOS BOTONES DEL FORMULARIO
        //======================================================================
        

        //-----------------------------------------------------
        // Cuenta Del Cliente - Paso 1
        //-----------------------------------------------------
        
        // Cuenta - Botón "Siguiente" */
        $('#btn-cuenta-sig').click(function(e){
            /**
             * Esta función valida cada uno de los input del Paso 1 - Cuenta
             *
             * Al momento de que el usuario queira pasar al siguiente paso,
             * ya sea por medio de la tecla 'Enter' o dando click izquierdo
             * en el boton "Siguiente"Los valida de igual forma que se validan cuando se escribe
             * dentro de ellos.
             */
            
            /**
             * Flag que decide si el formulario es ínválido o no.
             * 
             * @type {Boolean}
             */
            var formularioInvalido = false;
            
            e.preventDefault();

            /*
             * Validación de los inputs del Paso 1 - Cuenta
             *
             */
            if( !validarInputVacio(      inputNombres,  form, "el nombre" ) ||
                !validarInputLettersOnly(inputNombres,  form, "El nombre" ) ||
                !validarInputLength(inputApellidoP, form, "El nombre", 0, <?php echo MAX_NOMBRE;?>) ){
                formularioInvalido = true;
            }
                
            if( !validarInputVacio(inputApellidoP,       form, "el apellido") ||
                !validarInputLettersOnly(inputApellidoP, form, "El apellido") ||
                !validarInputLength(inputApellidoP, form, "El apellido",0, <?php echo MAX_APELLIDO; ?>) ){
                formularioInvalido = true;
            }

            if( !validarInputLettersOnly(inputApellidoM,      form, "El apellido") ||
                !validarInputLength(inputApellidoM, form, "El apellido",0, <?php echo MAX_APELLIDO; ?>) ){
                formularioInvalido = true;

            }
                
            if( !validarInputVacio(inputCorreoCuenta,   form, "el correo"           ) ||
                //!validarInputLettersOnly(inputCorreoCuenta,   form, "su correo"          ) || -- Poner validarInputEmailOnly
                !validarInputLength(inputCorreoCuenta, form, "El correo",          0, <?php echo MAX_CORREO;   ?>) ){
                formularioInvalido = true;
            }
                
            if( !validarInputVacio(inputTelefonoCuenta, form, "el teléfono"         ) || 
                !validarInputTelefonoOnly(inputTelefonoCuenta, form ) ||
                !validarInputLength(inputTelefonoCuenta, form, "El teléfono",        0, <?php echo MAX_TELEFONO; ?>)) {
                formularioInvalido = true;
            }

            if(formularioInvalido === true){
                return false;
            } else {
                $('#paso-2').show();
                $('#paso-1').hide();
                $('#progress-bar').css("width", "50%");
                $('#progress-bar-text').html("PASO 2");
                $('#card-title').html("Empresa");
            }
        });



        //-----------------------------------------------------
        // Empresa Del Cliente - Paso 2
        //-----------------------------------------------------
        

        // Empresa - Botón "Anterior";
        $('#btn-empresa-ant').click(function(e){
            $('#paso-1').show();
            $('#paso-2').hide();
            $('#progress-bar').css("width", "25%");
            $('#progress-bar-text').html("PASO 1");
            $('#card-title').html("Cuenta Personal");
        });

        // Empresa - Botón "Siguiente";
        $('#btn-empresa-sig').click(function(e){

            /**
             * Bandera que decide si el formulario es ínválido o no.
             * 
             * @type {Boolean}
             */
            var formularioInvalido = false;

            e.preventDefault();

            if( !validarInputVacio(      inputEmpresa,  form, "la empresa" ) ||
                !validarInputLettersOnly(inputEmpresa,  form, "La empresa" ) ||
                !validarInputLength(inputEmpresa, form, "La empresa", 0, <?php echo MAX_EMPRESA;?>) ){
                formularioInvalido = true;
            }
                
            if( !validarInputVacio(inputTelefonoEmpresa, form, "el teléfono"         ) || 
                !validarInputTelefonoOnly(inputTelefonoEmpresa, form ) ||
                !validarInputLength(inputTelefonoEmpresa, form, "El teléfono",        0, <?php echo MAX_TELEFONO; ?>)) {
                formularioInvalido = true;
            }

            if( !validarInputVacio(inputCorreoEmpresa,   form, "el correo"           ) ||
                //!validarInputLettersOnly(inputCorreoEmpresa,   form, "su correo"          ) || -- Poner validarInputEmailOnly
                !validarInputLength(inputCorreoEmpresa, form, "El correo",          0, <?php echo MAX_CORREO;   ?>) ){
                formularioInvalido = true;
            }

            if(formularioInvalido === true){
                return false;
            } else {
                $('#paso-3').show();
                $('#paso-2').hide();
                $('#progress-bar').css("width", "75%");
                $('#progress-bar-text').html("PASO 3");
                $('#card-title').html("Dirección");
            }
        });


        //-----------------------------------------------------
        // Dirección De La Empresa - Paso 3
        //-----------------------------------------------------
        
        // Direccion - Botón "Anterior";
        $('#btn-direccion-ant').click(function(){
            $('#paso-2').show();
            $('#paso-3').hide();
            $('#progress-bar').css("width", "50%");
            $('#progress-bar-text').html("PASO 2");
            $('#card-title').html("Empresa");
        });

        // Direccion - Botón "Siguiente";
        $('#btn-direccion-sig').click(function(e){

            /**
             * Bandera que decide si el formulario es ínválido o no.
             * 
             * @type {Boolean}
             */
            var formularioInvalido = false;

            e.preventDefault();

            if( !validarInputVacio(      inputEstado,  form, "el estado" ) ||
                !validarInputLettersOnly(inputEstado,  form, "El estado" ) ||
                !validarInputLength(inputEstado, form, "El estado", 0, <?php echo MAX_ESTADO;?>) ){
                formularioInvalido = true;
            }

            if( !validarInputVacio(      inputMunicipio,  form, "el municipio" ) ||
                !validarInputLettersOnly(inputMunicipio,  form, "El municipio" ) ||
                !validarInputLength(inputMunicipio, form, "El municipio", 0, <?php echo MAX_MUNICIPIO;?>) ){
                formularioInvalido = true;
            }

            if( !validarInputVacio(      inputCodigoPostal,  form, "el código postal" ) ||
                !validarInputNumbersOnly(inputCodigoPostal,  form, "El código postal" ) ||
                !validarInputLength(inputCodigoPostal, form, "El código postal", 0, <?php echo MAX_CODIGO_POSTAL;?>) ){
                formularioInvalido = true;
            }

            if( !validarInputVacio(      inputColonia,  form, "la colonia" ) ||
                !validarInputLettersOnly(inputColonia,  form, "La colonia" ) ||
                !validarInputLength(inputColonia, form, "La colonia", 0, <?php echo MAX_COLONIA;?>) ){
                formularioInvalido = true;
            }

            if( !validarInputVacio(      inputCalle,  form, "la calle" ) ||
                !validarInputLettersOnly(inputCalle,  form, "La calle" ) ||
                !validarInputLength(inputCalle, form, "La calle", 0, <?php echo MAX_CALLE;?>) ){
                formularioInvalido = true;
            }

            if( !validarInputVacio(      inputNumeroExt,  form, "el número exterior" ) ||
                !validarInputNumbersOnly(inputNumeroExt,  form, "El número exterior" ) ||
                !validarInputLength(inputNumeroExt, form, "El número exterior", 0, <?php echo MAX_NUMEROS_EXT_INT;?>) ){
                formularioInvalido = true;
            }

            if( !validarInputNumbersOnly(inputNumeroInt,  form, "El número interior" ) ||
                !validarInputLength(inputNumeroInt, form, "El número interior", 0, <?php echo MAX_NUMEROS_EXT_INT;?>) ){
                formularioInvalido = true;
            }

            if(formularioInvalido === true){
                return false;
            } else {
                $('#paso-4').show();
                $('#paso-3').hide();
                $('#progress-bar').css("width", "100%");
                $('#progress-bar-text').html("PASO 4");
                $('#card-title').html("Seguridad");
            }
        });


        //-----------------------------------------------------
        // Seguridad de la Cuenta/Contrasena - Paso 4
        //-----------------------------------------------------
        
        // Seguridad/Contrasena - Botón "Anterior";
        $('#btn-contrasena-ant').click(function(){
            $('#paso-3').show();
            $('#paso-4').hide();
            $('#progress-bar').css("width", "75%");
            $('#progress-bar-text').html("PASO 3");
            $('#card-title').html("Dirección");
        });

        // Seguridad/Contrasena - Botón "Registrarse/Siguiente";
        $('#btn-contrasena-sig').click(function(e){

            /**
             * Bandera que decide si el formulario es ínválido o no.
             * 
             * @type {Boolean}
             */
            var formularioInvalido = false;
            
            e.preventDefault();


            if( !validarInputVacio(      inputContrasena,  form, "la contraseña" ) ||
                !validarInputLength(inputContrasena, form, "La contraseña", 8, <?php echo MAX_CONTRASENA;?>) ||
                !validarInputContrasena(inputContrasena, inputContrasena.val(), form) || 
                !validarCoincidencia(inputContrasena, inputContrasenaRepetida, form)){
                formularioInvalido = true;
            }

            if( !validarCoincidencia(inputContrasena, inputContrasenaRepetida, form ) ){
                formularioInvalido = true;
            }


            if(formularioInvalido === true){
                return false;
            } else {

                /**
                 * Variable que almacena el form serializado para enviarlo
                 * al servidor por medio de AJAX.
                 * 
                 * @type {String}
                 */
                var datastring = form.serialize();

                $.ajax({
                    type: "POST",
                    url: "registroRequest.php",
                    cache: false,
                    data: datastring,
                    success: function(data) {

                        /**
                         * Bandera que dice si se pudo hacer el registro o no.
                         * 
                         * @type {boolean}
                         */
                        var resultado = data["result"];

                        if(!resultado){
                            /**
                             * Número que dice la razón por la que no se pudo
                             * hacer el registro exitosamente.
                             * 
                             * @type {int}
                             */
                            var reason = data["reason"];

                            $('#mensaje-error').removeClass('alert-success');
                            $('#mensaje-error').addClass('alert-danger');

                            switch(reason){

                                // No se llenaron todos los campos.
                                case 0:
                                    $('#mensaje-error').html('Favor de llenar todos los campos.');
                                    $('#mensaje-error').show();
                                    $("#resultContrasena").html("Favor de llenar todos los campos.");
                                    break;

                                // El nombre de la empresa que se introdujo ya está registrado.
                                case 1:
                                    $('#mensaje-error').html('El nombre de empresa que introdujo ya existe.');
                                    $('#mensaje-error').show();
                                    $("#resultEmpresa").html("El nombre de empresa que introdujo ya existe.");
                                    $('#paso-2').show();
                                    $('#paso-4').hide();
                                    $('#progress-bar').css("width", "50%");
                                    $('#progress-bar-text').html("PASO 2");
                                    $('#card-title').html("Empresa");
                                    break;

                                // El correo de la cuenta que se introdujo ya está registrado.
                                case 2:
                                    $('#mensaje-error').html('Ya existe una cuenta con el correo.');
                                    $('#mensaje-error').show();
                                    $("#resultCuenta").html("Ya existe una cuenta con el correo.");
                                    $('#paso-1').show();
                                    $('#paso-4').hide();
                                    $('#progress-bar').css("width", "25%");
                                    $('#progress-bar-text').html("PASO 1");
                                    $('#card-title').html("Cuenta Personal");
                                    break;
                            }
                        } else {
                            // Registro exitoso.
                            $('#mensaje-error').removeClass('alert-danger');
                            $('#mensaje-error').addClass('alert-success');
                            $('#mensaje-error').html('¡Registro exitoso!');
                            $('#mensaje-error').show();
                            
                        }

                    }
                    ,
                    error: function (xhr, status, error) { 
                        console.log("Xhr: " + xhr);
                        console.log("Xhr.responseText: " + xhr.responseText);
                        console.log("Status: " + status);
                        console.log("Error: " + error);
                        var err = JSON.parse(xhr.responseText);
                        console.log(err);
                        console.log(err.error);
                        alert(err.error); 
                    }
                    
                });
            }

        });
    });
</script>

</body>
</html>