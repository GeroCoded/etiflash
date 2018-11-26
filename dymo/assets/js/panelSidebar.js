 // JavaScript del Panel para:
 // - Hacer el Sidebar más chico y viceversa
 // - Cambiar el ícono (la flechita hacia abajo/arriba) del dropdown al hacer click

 $(document).ready(function(){


    // FUNCIÓN PARA OCULTAR LA BARRA LATERAL Y HACERLA CHICA CON SÓLO ÍCONOS.
    $('#dismiss').on('click', function(){

        // Cerrar Sidebar
        if($('#dismiss-arrow').hasClass('fa-arrow-left')){

            //$('#over-sidebar').removeClass('col-7 col-sm-4 col-md-3 col-lg-2').addClass('pl-3 pt-2').css('width', '75px');
            $('#over-sidebar').css('width', '75px');
            $('.list-group-item').addClass('pl-3');
            $('.item-text').hide();
            $('#datos-usuario').hide();
            $('.fa-caret-up, .fa-caret-down').hide();
            
            $('#dismiss').parent().closest('div').addClass('pl-2').parent().closest('div').removeClass('mr-0').addClass('mx-0');
            $('#dismiss-arrow').removeClass('fa-arrow-left').addClass('fa-arrow-right');



        // Abrir Sidebar
        } else {

            //$('#over-sidebar').addClass('col-7 col-sm-4 col-md-3 col-lg-2').removeClass('pl-3 pt-2').css('width', 'auto');
            $('#over-sidebar').css('width', '240px');
            $('.list-group-item').removeClass('pl-3');
            $('.item-text').show();
            $('#datos-usuario').show();
            $('.fa-caret-up, .fa-caret-down').show();

            $('#dismiss').parent().closest('div').removeClass('pl-2').parent().closest('div').addClass('mr-0').removeClass('mx-0');
            $('#dismiss-arrow').removeClass('fa-arrow-right').addClass('fa-arrow-left');
        
        }
        
    });


    // Cambio de la flecha de dropdown
    $('.nav-link').on('click', function(){
        //if($('#dismiss-arrow').hasClass('fa-arrow-left')){ // Si no está oculto el sidebar... 
            if ($(this).find('.fa-caret-up')[0]){
                $(this).find('.fa-caret-up').addClass('fa-caret-down').removeClass('fa-caret-up');
            } else {
                $(this).find('.fa-caret-down').addClass('fa-caret-up').removeClass('fa-caret-down');
            }
        //}
    });
});