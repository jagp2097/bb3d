function selectOpcion(opcion) {

    let id = opcion.getAttribute("data-product");
    let elementoSeleccionado;
    let filaOpcion = document.getElementById(id);

    for(let i = 0; i < filaOpcion.childNodes.length; i++) {

        if(filaOpcion.childNodes[i].nodeName != "#text") {
            if(filaOpcion.childNodes[i].childNodes[1].classList.contains("box-selected")) {
                elementoSeleccionado = filaOpcion.childNodes[i].childNodes[1];
            }
        }

    }

    if(elementoSeleccionado != undefined) {
        elementoSeleccionado.classList.remove("box-selected");
        opcion.classList.add("box-selected")
    } else {
        opcion.classList.add("box-selected")
    }

}

function continueProcessMedida(productos, envio, recarga) {

    let medidasSeleccionadas = document.getElementsByClassName('box-selected');
    let medidasSeleccionadasCantidad = document.getElementsByClassName('box-selected').length;

    if(medidasSeleccionadasCantidad == productos) {

        var arrayProductos = new Array();

        // agarrar la medida y lo precio_extra
        for(let i = 0; i < medidasSeleccionadas.length; i++) {

            var objectProductos = {
                medida: '',
                precio_extra: ''
            };

            objectProductos.medida = medidasSeleccionadas[i].childNodes[3].textContent;

            if(medidasSeleccionadas[i].childNodes[5].textContent == 'Bb3D') {
                objectProductos.precio_extra = 0;
            } else {
                let dinero = medidasSeleccionadas[i].childNodes[5].textContent;
                objectProductos.precio_extra = parseFloat(dinero.slice(1, dinero.indexOf('MX')).replace(',', ''));
            }

            arrayProductos.push(objectProductos);

        }

        ajaxSend(envio, arrayProductos, recarga);

    }
    else {
        errorSeleccionProductos();
    }
    
}

function continueProcessBase(productos, envio, recarga) {

    let basesSeleccionadas = document.getElementsByClassName('box-selected');
    let basesSeleccionadasCantidad = document.getElementsByClassName('box-selected').length;

    if(basesSeleccionadasCantidad == productos) {

        var arrayProductos = new Array();

        // agarrar la base
        for(let i = 0; i < basesSeleccionadas.length; i++) {

            var objectProductos = {
                base: '',
            };

            objectProductos.base = basesSeleccionadas[i].childNodes[3].textContent;

            arrayProductos.push(objectProductos);

        }

        ajaxSend(envio, arrayProductos, recarga);

    }
    else {
        errorSeleccionProductos();
    }

}

function continueProcessCantidad(productos, envio, recarga) {

    let cantidadesSeleccionadas = document.getElementsByClassName('box-selected');
    let cantidadSeleccionadasNum = document.getElementsByClassName('box-selected').length;

    if(cantidadSeleccionadasNum == productos) {

        var arrayProductos = new Array();

        for(let i = 0; i < cantidadesSeleccionadas.length; i++) {

            var objectProductos = {
                cantidad: '',
                precio_extra: ''
            };

            objectProductos.cantidad = cantidadesSeleccionadas[i].childNodes[3].textContent;

            if(cantidadesSeleccionadas[i].childNodes[5].textContent == 'Bb3D') {
                objectProductos.precio_extra = 0;
            } else {
                let dinero =cantidadesSeleccionadas[i].childNodes[5].textContent;
                objectProductos.precio_extra = parseFloat(dinero.slice(1, dinero.indexOf('MX')).replace(',', ''));
            }

            arrayProductos.push(objectProductos);

        }

        ajaxSend(envio, arrayProductos, recarga);

    }
    else {
        errorSeleccionProductos();
    }

}

function ajaxSend(envio, arrayProductos, recarga) {
    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $("input[name='_token']").val(),
        }
    });
    
    $.ajax({
        url: envio,
        type: 'POST',
        dataType: 'json',
        data: {
            productos_specs: arrayProductos,
        },
        success: function(data) {
            console.log(data);
            window.location.href = recarga;
        },
        error: function(e) {
            console.log(e);
        }
    });

}

function errorSeleccionProductos() {

    $('html, body').animate({scrollTop:0}, 'slow');
    $('#erroresMedida').append('<div id="errors" class="container alert alert-danger" role="alert">Seleccione una opción para cada producto</div>');
    $('#errors').delay(3000).fadeTo(500, 0).slideUp(500, function() {
        $(this).remove();
    });

}