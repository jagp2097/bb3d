$(document).ready(function() {
    
    $('#fecha_nacimiento').mask('00/00/0000');
    $('#telefono').mask('(00) 0000 0000');
                         
    $('#holder_name').keypress(function(event) {
        var inputValue = event.which;

        if(!(inputValue >= 65 && inputValue <= 122) && (inputValue != 32 && inputValue != 0)) { 
            event.preventDefault(); 
        }
    });

    $('#card_number').mask('0000000000000000');
    $('#expiration_month').mask('00');
    $('#expiration_year').mask('00');
    
    
    var SPMaskBehavior = function (val) {
        return val.replace(/\D/g, '').length === 4 ? '0000' : '0000';
    },
    spOptions = {
        onKeyPress: function(val, e, field, options) {
            field.mask(SPMaskBehavior.apply({}, arguments), options);
        }
    };
    
    $('#cvv').mask(SPMaskBehavior, spOptions);
    
    
    $("#estado, #ciudad, #colonia, #calle, #pais").keypress(function(event){
        var inputValue = event.which;
        // allow letters and whitespaces only.
        if(!(inputValue >= 65 && inputValue <= 122) && (inputValue != 32 && inputValue != 0)) { 
            event.preventDefault(); 
        }
    });
    
    $("#numero_direccion, #cp").keypress(function(event){
        var inputValue = event.which;
        // allow letters and whitespaces only.
        if(!(inputValue >= 48 && inputValue <= 57) && (inputValue != 32 && inputValue != 0)) { 
            event.preventDefault(); 
        }
    });
    
    
});
