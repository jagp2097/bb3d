function abrir_modal_eliminar() {
    document.getElementById('modal_eliminar_cuenta').style.zIndex = 999;
    document.getElementById('modal_eliminar_cuenta').style.display = 'block';
}

function cerrar_modal_eliminar() {
    document.getElementById('modal_eliminar_cuenta').style.display = 'none';
}

function abrir_modal_eliminar_album() {
    document.getElementById('modal_eliminar_album').style.zIndex = 999;
    document.getElementById('modal_eliminar_album').style.display = 'block';
}

function cerrar_modal_eliminar_album() {
    document.getElementById('modal_eliminar_album').style.display = 'none';
}

function abrir_modal_eliminar_archivo(ruta, nombre_archivo) {
    document.getElementById('modal_eliminar_archivo').style.zIndex = 999;
    document.getElementById('modal_eliminar_archivo').style.display = 'block';
    document.getElementById('text_modal').innerHTML = "¿Estás seguro de querer eliminar el archivo <strong>"+nombre_archivo+"</strong>?";
    document.getElementById('form-borrar').action = ruta;
}

function cerrar_modal_eliminar_archivo() {
    document.getElementById('modal_eliminar_archivo').style.display = 'none';
}

function abrir_modal_eliminar_card(ruta, numero_tarjeta) {
    document.getElementById('modal_eliminar_card').style.zIndex = 999;
    document.getElementById("modal_eliminar_card").style.display = "block";
    document.getElementById('text_modal').innerHTML = "¿Estás seguro de querer eliminar la tarjeta con número <strong>"+numero_tarjeta+"</strong>?";
    document.getElementById('form-borrar-card').action = ruta;
}

function cerrar_modal_eliminar_card() {
    document.getElementById('modal_eliminar_card').style.display = 'none';
}

function abrir_modal_eliminar_direccion(ruta) {
    document.getElementById('modal_eliminar_direccion').style.zIndex = 999;
    document.getElementById("modal_eliminar_direccion").style.display = "block";
    document.getElementById('text_modal').innerHTML = "¿Estás seguro de querer eliminar esta dirección?";
    document.getElementById('form-borrar-direccion').action = ruta;
}

function cerrar_modal_eliminar_direccion() {
    document.getElementById('modal_eliminar_direccion').style.display = 'none';
}
