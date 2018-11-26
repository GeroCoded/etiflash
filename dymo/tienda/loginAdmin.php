<?php

/* Sublime Text 3 */

/**
 * Archivo php con html para el formulario del login de la tienda
 * 
 * PHP version 7.2.10
 *
 * @author Luis Fernando Gerónimo Carranza <luisfergeronimo@gmail.com>
 * @author Jesús Emmanuel Zetina Chevez <zcjo151173@upemor.edu.mx>
 */

// Se inicia la sesión.
session_start();

/*
 * Se verifica si el usuario ya inició sesión y lo envía a la página de inicio
 * de la tienda.
 */
if(isset($_SESSION['idAdmin'])){
    header('Location: ../panel/index.php');
} else {
}

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
        .input-group-text{
            border-color: #5C6375;
            background-color: #5C6375;
        }

        .fas {
          color: white;
        }
    </style>


    <title>Dymo - Tienda</title>
</head>
<body style="background-image: url(../assets/img/ui/registro.jpg); background-size: cover;">


<div class="alert alert-danger fixed-top" role="alert">
    Datos incorrectos
</div>


<div class="container px-0 py-4">
    <div class="row align-items-center bg-transparent mx-0" style="min-height: 100vh; background-color: white;">
        <!-- Columna rellenadora para centrar la columna del formulario -->
        <div class="col-0 col-sm-1 col-md-2 col-lg-3"></div>
        <!-- Columna principal donde está el form del log in -->
        <div class="col-12 col-sm-10 col-md-8 col-lg-6">
            <!-- Estructura del componente _card_ -->
            <div class="card text-white bg-dark">
                <div class="card-header">
                    <!-- Link para ir a la página principal -->
                    <a href="../index.html" class="card-link font-weight-bold text-white border border-white rounded px-3 float-left position-absolute">Inicio</a>
                    <!-- Título del componente _card_ -->
                    <h3 class="card-title text-center text-nowrap">Acceder</h3>
                </div>
                <!-- Cuerpo del componente _card_ -->
                <div class="card-body px-3">
                    <!-- Formulario del log in -->
                    <form class="needs-validation px-0 px-sm-3 pb-0 pb-sm-3 pt-4 px-lg-4" onsubmit="return false;" novalidate>
                        <!-- Grupo del label e input para el usuario -->
                        <div class="form-group">
                            <label for="user">Usuario</label>
                            <!-- Grupo contenedor del input y su ícono -->
                            <div class="input-group">
                                <!-- Contendedor del ícono -->
                                <div class="input-group-prepend">
                                    <!-- Icono de FontAwesome -->
                                    <div class="input-group-text"><i class="fas fa-at"></i></div>
                                </div>
                                <!-- Input del usuario -->
                                <input type="text" class="form-control" id="user" placeholder="nombre@ejemplo.com" required>

                                <div class="invalid-feedback">
                                    Ingresa tu usuario.
                                </div>
                            </div>
                        </div>
                        <!-- Grupo del label e input para el password -->
                        <div class="form-group">
                            <label for="password">Password</label>
                            <!-- Grupo contenedor del input y su ícono -->
                            <div class="input-group">
                                <!-- Contendedor del ícono -->
                                <div class="input-group-prepend">
                                    <!-- Icono de FontAwesome -->
                                    <div class="input-group-text"><i class="fas fa-key"></i></div>
                                </div>
                                <!-- Input del password -->
                                <input type="password" class="form-control" id="password" placeholder="Contraseña" required>
                                <!-- Mensaje de input invalido -->
                                <div class="invalid-feedback">  
                                    Ingresa tu contraseña.
                                </div>
                            </div>
                        </div>

                        <!-- Grupo del label e input para el checkbox de "Recuérdame" -->
                        <div class="form-check">
                            <!-- Input del checkbox -->
                            <input class="form-check-input" type="checkbox" value="" id="recuerdame">
                            <!-- Label del checkbox -->
                            <label class="form-check-label" for="recuerdame">
                                Recuérdame
                            </label>
                        </div>
                        <div class="text-danger" id="mensaje-error">
                            
                        </div>
                        <!-- Boton de "Acceder" -->
                        <button type="submit" class="btn btn-success my-3 w-100" id="btn-acceder">Acceder</button>
                        <!-- Mensaje de error -->
                        <p id="mensaje-error" class="d-none">Mensaje</p>
                        <!-- Link para el usuario que olvidó su contraseña -->
                        <a href="#" class="card-link text-danger">¿Olvidó su contraseña?</a>
                        <!-- Link para el usuario que desea registrarse -->
                        <a href="registro.php" class="card-link font-weight-bold text-info float-right">Registrarse</a>
                    </form>
                </div>
            </div>
        </div>
        <!-- Columna rellenadora para centrar la columna del formulario -->
        <div class="col-0 col-sm-1 col-md-2 col-lg-3"></div>
    </div>
</div>




<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="../assets/js/jquery-3.3.1.min.js"></script>
<script src="../assets/js/popper.min.js"></script>
<script src="../assets/js/bootstrap.min.js"></script>

<!-- Custom scripts -->
<!-- <script src="../assets/js/needs-validation-bootstrap.js"></script> -->


<!-- Envío de datos al servidor con AJAX -->
<script type="text/javascript">

    $('.alert-danger').hide();
    
    $(document).ready(function(){

        /*
         * Cuando se ejecute el evento 'click' en el botón #btn-acceder'
         * AJAX enviará una solicitud al servidor enviando los datos que
         * puso el usuario (usuario y contraseña) para evaluar si están
         * correctos.
         */        
        $("#btn-acceder").on('click', function(){ 
            
            /*
             * Se extraén los valores de los input para el usuario y la
             * contraseña.
             */
            var usuario_input  = $("#user").val();
            var contrasena_input  = $("#password").val();

            console.log(usuario_input);
            console.log(contrasena_input);

            /*
             * AJAX: Envío de solicitud POST al archivo 'login-request.php'.
             */            
            $.ajax({
                type: "POST",
                url: "loginAdminRequest.php",
                data: 
                    {
                        usuario: usuario_input,
                        contrasena: contrasena_input
                    },

                /**
                 * [success description]
                 * @param  {json} @result  json que contiene los datos del usuario en caos de que
                 *                         haya ingresado los datos correctos. En caso contrario,
                 *                         sólo contiene la llave 'match' con un valor boolean
                 *                         que muestra si se encontró o no a un usuario con los
                 *                         datos enviados.
                 * @param  {boolean} @status el boolean que envía AJAX para saber el status de
                 *                           la solciitud
                 * 
                 * @return {void}
                 */
                success: function(result){
                    console.log(result);
                    console.log(status);

                    
                    if(result['match'] === "true"){
                        $('.alert-danger').hide();

                        console.log("Data: " + result +
                            "\nStatus: " + status + 
                            "\nid: " + result[0]['id'] + 
                            "\nNombre " + result[0]['nombre']
                        );

                        /*
                         * Se le muestra al usuario la página principal de la tienda.
                         */
                        window.location.href = "../panel/index.php";

                    } else {
                        console.log("Datos incorrectos.");
                        $('.alert-danger').show();
                        /*
                         * En caso de que el usuario ingrese datos incorrecto
                         * se le muestra un mensaje de error.
                         */
                        $("#mensaje-error").html("Datos incorrectos.");
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