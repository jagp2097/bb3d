
















// $(document).ready(function () {
//   /*---   Inicialización de objeto y contenedor del modelo    ---*/
//   var stl_viewer = new StlViewer(document.getElementById('stl_cont'), {
//     bgcolor: '#2e333a',
//     model_loaded_callback: model_info, // Callback que ejecuta model_info para obtener las dimensiones
//   });
//
//   $('#quitar').prop('disabled', true);
//
//   /*---  Select con todos los stl disponibles. Almacenados en la carpeta public. Doble click para ver uno  ---*/
//   $('#stl_files option').dblclick(function() {
//     // Método para agregar y ver un modelo
//     stl_viewer.add_model({
//       filename: this.value, // dirección donde se localiza el stl
//     });
//     // Deshabilita el select
//     $('#stl_files').prop('disabled', true);
//     $('#quitar').prop('disabled', false);
//   });
//
//   // Función para obtener la información del archivo stl actual
//   function model_info(model_id) {
//     $('#stl_info').append(`
//
//         <p>Nombre: `+stl_viewer.get_model_info(model_id).name+`</p>
//         <p>Área: `+stl_viewer.get_model_info(model_id).area+` mm2</p>
//         <p>Dimensiones</p>
//         <p>X = `+stl_viewer.get_model_info(model_id).dims.x+` mm</p>
//         <p>Y = `+stl_viewer.get_model_info(model_id).dims.y+` mm</p>
//         <p>Z = `+stl_viewer.get_model_info(model_id).dims.z+` mm</p>
//         <p>Volúmen: `+stl_viewer.get_model_info(model_id).volume+` mm3</p>
//
//     `);
//
//   // Evento click: elimina el stl actual del contenedor
//    $('#quitar').click(function() {
//      stl_viewer.remove_model(model_id);
//      // Se habilita el select
//      $('#stl_files').prop('disabled', false);
//      // Se limpia el área donde aprarece toda la información
//      $('#stl_info').empty();
//      $('#quitar').prop('disabled', true);
//    });
//
//
//
// }
//
// });
