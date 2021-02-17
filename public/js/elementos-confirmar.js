$(document).ready(function() {
    // Tarjetas de credito
    $('#other-card').hide();
    $('#btnOcultar').text('Nueva tarjeta');
    
    $('#btnOcultar').on('click',function() {
        
        $('#saved-cards').fadeToggle({
            // effect: 'fade',
            easing: 'linear',
            duration: 500,
        });
        $('#other-card').fadeToggle({
            // effect: 'fade',
            easing: 'linear',
            duration: 500,
        });
        
        $('#btnOcultar').text() == 'Nueva tarjeta' ? $('#btnOcultar').text('Tarjetas guardadas') : $('#btnOcultar').text('Nueva tarjeta');
        
    });
    
    
    //Direcciones
    $("#other_direccion").hide();
    $('#btnOcultarDireccion').text("Otra dirección");
    
    $("#btnOcultarDireccion").on('click', function() {
        
        $('#saved-direcciones').fadeToggle({
            // effect: 'fade',
            easing: 'linear',
            duration: 500,
        });
        $('#other_direccion').fadeToggle({
            // effect: 'fade',
            easing: 'linear',
            duration: 500,
        });
        
        if (document.getElementById('direccion-select').disabled)
        document.getElementById('direccion-select').disabled = false;
        else
        document.getElementById('direccion-select').disabled = true;
        
        $("#btnOcultarDireccion").text() == 'Otra dirección' ? $("#btnOcultarDireccion").text("Direcciones guardadas") : $("#btnOcultarDireccion").text("Otra dirección");
        
    });
    
    //Archivos
    var btnToggle = document.getElementsByClassName('btn-toggle');
    var archivoSelect = document.getElementsByClassName('archivo-select');
    var archivoInput = document.getElementsByClassName('archivo-input');
    var hiddenInput = document.getElementsByClassName('input-hidden');
    var i = 0;
    
    Array.from(btnToggle).forEach(function(btn) {
        
        btn.dataset.indexRow = i;
        // hiddenInput[btn.dataset.indexRow].value = btn.dataset.indexRow;
        
        btn.addEventListener('click', function() {
            
            // console.log(btn.innerHTML);
            
            if (btn.innerHTML == "Cargar uno nuevo") {

                archivoSelect[btn.dataset.indexRow].disabled = true;
                archivoInput[btn.dataset.indexRow].disabled = false;
                // hiddenInput[btn.dataset.indexRow].disabled = true;
                
                btn.innerHTML = "Cargar uno guardado";
                
            } else {

                archivoInput[btn.dataset.indexRow].disabled = true;
                archivoSelect[btn.dataset.indexRow].disabled = false;
                // hiddenInput[btn.dataset.indexRow].disabled = true;
                
                btn.innerHTML = "Cargar uno nuevo";
                
            }

            // console.log(hiddenInput[btn.dataset.indexRow].value); 

            
        });
        
        i++;
        
    });
    
    
});

