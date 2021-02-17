$(document).ready(function() {
     // Stuff to do as soon as the DOM is ready

     var qty_input = document.getElementsByClassName('qty');

     Array.from(qty_input).forEach(function(element) {
         element.addEventListener('change', function(){
             console.log('Hola');
             $.ajax({
                 url: route,
                 contenType: 'application/json',
                 type: 'PATCH',
                 dataType: 'json',
                 data: {
                     rowId : rowId,
                     new_qty : new_qty,
                 },
                 success: function(data) {
                     console.log(data);
                 },
                 error: function(e) {
                     console.log(e);
                     //console.log(e.responseJSON);
                     // $.each(e.responseJSON.errors, function(key, value) {
                         // 	if (key == 'nombre') $('#errorNombreFamiliar').html(value);
                         // 	if (key == 'ap_pa') $('#errorAPFamiliar').html(value);
                         // 	if (key == 'ap_ma') $('#errorAMFamiliar').html(value);
                         // 	if (key == 'fecha_nacimiento') $('#errorFNFamiliar').html(value);
                         // 	if (key == 'correo') $('#errorCorreoFamiliar').html(value);
                         // 	if (key == 'parentesco') $('#errorParentesco').html(value);
                         // });
                     }
                 });
         });
     });


     console.log(qty_input);




});




function updateItem(route) {

    var rowId   = $('#rowId').val();
    var new_qty = $('#qty').val();
    var token   = $("input[name='_token']").val();
    var route   = route;

    console.log(rowId, new_qty, route, token);

    $.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': token,
		}
	});



}
