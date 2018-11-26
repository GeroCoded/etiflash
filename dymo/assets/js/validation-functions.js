


// ======================================================== //
// ======================================================== //
// ======================================================== //
// ================ VALIDACIONES DE TECLAS ================ //


function validarTeclasTelefono(inputId){
    $(inputId).on('keydown keypress', function(e) {
        teclasTelefono(e);
    });
}


function validarTeclasNumerosSinPuntos(inputId){
    $(inputId).on('keydown keypress', function(e) {
        teclasNumerosSinPuntos(e);        
    });
}


function validarTeclasNombres(inputId){
    $(inputId).on('keydown keypress', function(e) {
        teclasNombres(e);
    });
}



function teclasTelefono(e){
        //alert(e.which);

        // keys: 
        //  • backspace   [8],
        //  • tab         [9], 
        //  • enter      [13],
        //  • escape     [27],
        //  • space      [32],
        //  • delete     [46], and
        //  • +         [43/107/187]
        //  • -         [45/109/189]
        //  • .         [110/190]
        //  • F5        [116]
        var allowed_keys = [8, 9, 13, 27, 32, 43, 45, 46, 110, 107, 109, 116, 187, 189, 190];
        if (
            // Allow "allowed_keys" array but whitout shift, ctrl or cmd key pressed
            (($.inArray(e.which, allowed_keys) !== -1) && !e.shiftKey) ||
             // Allow: Ctrl+A, Command+A
            (e.which === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
             // Allow: home, end, left, right, down, up
            (e.which >= 35 && e.which <= 40) ||
            // Allow: Shift + Home, Shift + End
            (e.shiftKey && (e.which == 35 || e.which === 36)) ||
            // Allow: Control + f5 
            (e.ctrlKey && e.which==116)
           ) {
                // let it happen, don't do anything
//                  alert("Return");
                return;
        }

        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.which < 48 || e.which > 57)) && (e.which < 96 || e.which > 105) ||
            (e.which === 186 || e.which === 222)){
//            alert("PreventDefault");
            e.preventDefault();
        }
}




function teclasNumerosSinPuntos(e){
    //alert(e.which);

    // keys: 
    //  • backspace   [8],
    //  • tab         [9], 
    //  • enter      [13],
    //  • escape     [27],
    //  • space      [32],
    //  • delete     [46], and
    //  • F5        [116]
    var allowed_keys = [8, 9, 13, 27, 32, 46, 116];
    if (
        // Allow "allowed_keys" array but whitout shift, ctrl or cmd key pressed
        (($.inArray(e.which, allowed_keys) !== -1) && !e.shiftKey) ||
         // Allow: Ctrl+A, Command+A
        (e.which === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
         // Allow: home, end, left, right, down, up
        (e.which >= 35 && e.which <= 40) ||
        // Allow: Shift + Home, Shift + End
        (e.shiftKey && (e.which == 35 || e.which === 36)) ||
        // Allow: Control + f5 
        (e.ctrlKey && e.which==116)
       ) {
            // let it happen, don't do anything
//                  alert("Return");
            return;
    }

    // Ensure that it is a number and stop the keypress
    if ((e.shiftKey || (e.which < 48 || e.which > 57)) && (e.which < 96 || e.which > 105) ||
        (e.which === 186 || e.which === 222)){
//            alert("PreventDefault");
        e.preventDefault();
    }
}



function teclasNombres(e){
    var accentKey = false;
    //alert("Type: " + event.type + ", 1st: " + e.which + ", accentKey: " + accentKey);
    if(event.type == 'keydown'){
        // keys: 
        //  • backspace   [8],
        //  • tab         [9],
        //  • enter      [13],
        //  • escape     [27],
        //  • space      [32],
        //  • delete     [46], and
        //  • +         [43/107/187]
        //  • -         [45/109/189]
        //  • .         [110/190]
        //  • F5        [116]
        //  • ñ         [192]
        var allowed_keys = [8, 9, 13, 27, 32, 46, 116, 192];
        if (
            // Allow "allowed_keys" array but whitout shift, ctrl or cmd key pressed
            (($.inArray(e.which, allowed_keys) !== -1) && !e.shiftKey) ||
             // Allow: Ctrl+A, Command+A
            (e.which === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
             // Allow: home, end, left, right, down, up
            (e.which >= 35 && e.which <= 40) ||
            // Allow: Shift + Home, Shift + End
            (e.shiftKey && (e.which == 35 || e.which === 36 || e.which === 9)) || 
            //(e.shiftKey && ((e.which >= 65 && e.which <= 90) || (e.which >= 97 && e.which <= 122)) ) ||
            // Allow: Control + f5 
            (e.ctrlKey && e.which==116)
           ) {
                // let it happen, don't do anything
                //alert("Return");
                
                return;
        }
    }

    if(event.type == 'keypress'){
        // keys: 
        //  • backspace   [8],
        //  • tab         [9],
        //  • enter      [13],
        //  • escape     [27],
        //  • space      [32],
        //  • delete     [46], and
        //  • +         [43/107/187]
        //  • -         [45/109/189]
        //  • .         [110/190]
        //  • ñ         [241]
        var allowed_keys = [13, 27, 32, 241];
        if (
            // Allow "allowed_keys" array but whitout shift, ctrl or cmd key pressed
            (($.inArray(e.which, allowed_keys) !== -1) && !e.shiftKey) ||
             // Allow: Ctrl+A, Command+A
            (e.which === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
             // Allow: home, end, left, right, down, up
            (e.which >= 35 && e.which <= 40) ||
            // Allow: Shift + Home, Shift + End
            (e.shiftKey && (e.which == 35 || e.which === 36)) ||
            // Allow: Control + f5 
            (e.ctrlKey && e.which==116)
           ) {
                // let it happen, don't do anything
                //alert("Return");
                return;
        }
    }


    // Ensure that it is a letter
    if((e.which === 186 || e.which === 222 || e.which === 46)){
        //alert("FIRST IF");

        if(accentKey === false){
            accentKey = true;
            //alert("Accentkey = TRUE");
            return;
        } else {
            accentKey = false;
            //alert("Accentkey = FALSE");
            e.preventDefault();

            
        }

    } else if ((e.which < 65 || e.which > 90) && (e.which < 97 || e.which > 122) && 
        (e.which != 193 && e.which != 201 && e.which != 205 && e.which != 211 && e.which != 218 && 
            e.which != 225 && e.which != 233 && e.which != 237 && e.which != 243 && e.which != 250)){
        // 193 = Á
        // 201 - É
        // 205 - Í
        // 211 - Ó
        // 218 - Ú
        // 225 = á
        // 233 = é
        // 237 = í
        // 243 = ó
        // 250 = ú
        //alert("ELSE IF, e.which: " + e.which);
        accentKey = false;
        e.preventDefault();
    }
}



// =============== FIN VALIDACIONES DE TECLAS ============= //
// ======================================================== //
// ======================================================== //
// ======================================================== //



















// ======================================================== //
// ======================================================== //
// ======================================================== //
// =============== VALIDACIONES DE LONGITUD =============== //



// Función para validar el tamaño del input ingresado, con mínimo y máximo.
function validarInputLength(input, form, nombreInput, min, max){
    if(input.val().length < min) {      // Si es menor al MÍNIMO...
        //alert("Password < min: " + min + "!");
        input.removeClass('is-valid').addClass('is-invalid');
        input.siblings(".invalid-feedback").text(nombreInput + " debe ser mayor o igual a " +min+ ".");
        form.removeClass('was-validated');
        return false;

    } else if(input.val().length > max) {  // Si es mayor al máximo...
        //alert("Password < max: " + max + "!");
        input.removeClass('is-valid').addClass('is-invalid');
        input.siblings(".invalid-feedback").text(nombreInput + " debe ser menor o igual a " +max+ ".");
        form.removeClass('was-validated');
        return false;
    } else {
        //alert("Password is valid!");
        input.removeClass('is-invalid').addClass('is-valid');
        return true;
    }
}

function validarInputVacio(input, form, nombreInput){
    if(input.val().localeCompare("") === 0){
        input.removeClass('is-valid').addClass('is-invalid');
        input.siblings(".invalid-feedback").text("Ingrese " + nombreInput);
        form.removeClass('was-validated');
        return false;
    } else {
        input.removeClass('is-invalid').addClass('is-valid');
        return true;
    }
}



// ============= FIN VALIDACIONES DE LONGITUD ============= //
// ======================================================== //
// ======================================================== //
// ======================================================== //























// ======================================================== //
// ======================================================== //
// ======================================================== //
// =========  VALIDACIONES DE CARACTERES INVÁLIDOS ======== //


        // =======================================//           
        // =======================================//           
        // =======================================//           
        // =========  FUNCIONES REGEX ============//


        function containsOtherThanPhone(str){
            var regex = new RegExp("[^+0-9-.\\s]", "g");
            return regex.test(str);
        }

        function containsOtherThanName(str){
            var regex = new RegExp("[^A-Záéíóú\\s]", "ig");
            return regex.test(str);
        }

        function containsOtherThanNumber(str){
            var regex = new RegExp("[^0-9]", "g");
            return regex.test(str);
        }



        function containsNumber(str){
            var regex = new RegExp("[0-9]+"); // Now we check for numbers   
            return regex.test(str);
        }



        function containsUppercase(str){
            var regex = new RegExp("[A-Z]+"); // Check for uppercase first  
            return regex.test(str); 
        }



        function containsLowercase(str){
            var regex = new RegExp("[a-z]+"); // checking now for lowercase
            return regex.test(str); 
        }


        // =======================================//           
        // =======================================//           
        // =======================================//           
        // =========  FUNCIONES INPUT ============//


function validarInputLettersOnly(input, form, nombreInput){

    if(containsOtherThanName(input.val())){
        input.removeClass('is-valid').addClass('is-invalid');
        input.siblings(".invalid-feedback").text(nombreInput + " sólo debe contener letras.");
        form.removeClass('was-validated');
        return false;
    } else {
        input.removeClass('is-invalid').addClass('is-valid');
        return true;
    }

}

function validarInputNumbersOnly(input, form, nombreInput){

    if(containsOtherThanNumber(input.val())){
        input.removeClass('is-valid').addClass('is-invalid');
        input.siblings(".invalid-feedback").text(nombreInput + " sólo debe contener números.");
        form.removeClass('was-validated');
        return false;
    } else {
        input.removeClass('is-invalid').addClass('is-valid');
        return true;
    }

}

function validarInputTelefonoOnly(input, form){

    if(containsOtherThanPhone(input.val())){
        input.removeClass('is-valid').addClass('is-invalid');
        input.siblings(".invalid-feedback").text("Ingrese un teléfono válido.");
        form.removeClass('was-validated');
        return false;
    } else {
        input.removeClass('is-invalid').addClass('is-valid');
        return true;
    }
}


function validarInputContrasena(input, str, form) {
    if(containsUppercase(str)) {
        if(containsNumber(str)) {
            if(containsLowercase(str)) {
                input.removeClass('is-invalid').addClass('is-valid');
                return true;
            } else{
                input.siblings(".invalid-feedback").text("Debe tener mínimo una letra minúscula.");
            }
        } else{
           input.siblings(".invalid-feedback").text("Debe tener mínimo un número.");
        }
    } else {
        input.siblings(".invalid-feedback").text("Debe tener mínimo una letra mayúscula.");
    }

    input.removeClass('is-valid').addClass('is-invalid');
    form.removeClass('was-validated');
    return false;
}

/*
function validarContrasena(str) {
    if(containsUppercase(str)) {
        if(containsNumber(str)) {
            if(containsLowercase(str)) {
                return 1;   
            } else return 2;
        } else return 3;
    } else return 4;
}
*/

/*
function validarContra(str) {
    var regex = new RegExp("[A-Z]+"); // Check for uppercase first   
    if(regex.test(str) == true) {
        regex = new RegExp("[0-9]+"); // Now we check for numbers   
        if(regex.test(str) == true) {
            regex = new RegExp("[a-z]+"); // checking now for lowercase
            if(regex.test(str) == true) {
                return 1;   
            } else return 2;
        } else return 3;
    } else return 4;
}
*/


// ======= FIN VALIDACIONES DE CARACTERES INVÁLIDOS ======= //
// ======================================================== //
// ======================================================== //
// ======================================================== //

















// ======================================================== //
// ======================================================== //
// ======================================================== //
// ==============  VALIDACIONES DE IGUALDAD =============== //



function validarCoincidencia(input1, input2, form){

    if( input1.val().localeCompare(input2.val()) === 0){
        input2.removeClass('is-invalid').addClass('is-valid');
        return true;
    } else {
        input2.removeClass('is-valid').addClass('is-invalid');
        form.removeClass('was-validated');
        return false;
    }

}



// ============= FIN VALIDACIONES DE IGUALDAD ============ //
// ======================================================== //
// ======================================================== //
// ======================================================== //







function submitOrNotSubmitForm(){
    if($('#paso-4').is(":hidden")){
        alert("Paso 4 hidden.")
        return false;
    } else {
        return true;
    }

}