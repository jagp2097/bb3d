function preview_image(event) {
	// FileReader permite que las aplicaciones web lean ficheros de forma asincrona
	var reader = new FileReader();
	// Controlador para el evento onload, se activa cuando la operación de lectura se ha completado con éxito
	reader.onload = function() {
		var output = document.getElementById('output_image');
		// reader.resul contiene el fichero
		output.src = reader.result;
	}

	// Comienza la lectura del contenido del objeto (reader), una vez terminada, el atributo result contine una 
	// URL que representa los datos del fichero
	reader.readAsDataURL(event.target.files[0]);

}