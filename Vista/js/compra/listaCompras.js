$(document).ready(function(){
    listarCompras();    
   }); 
  function listarCompras(){
    $("#compras").load('accion/listar_compras.php');
  }
  function  cargarCompra(idcompra,idcompraestado,idusuario)
  {  
    $("#contenido").load('accion/cargar_compra_admin.php?idcompra='+idcompra+'&idcompraestado='+idcompraestado+"&idusuario="+idusuario, function(){
        if(idcompraestado==1){
      $('#BotonAceptar').show();
      $('#BotonCancelar').hide();
      $('#BotonEnviar').hide();
      }
      if(idcompraestado==2){
        $('#BotonAceptar').hide();
        $('#BotonCancelar').show();
        $('#BotonEnviar').show();
        }
        if(idcompraestado==3){
          $('#BotonAceptar').hide();
          $('#BotonCancelar').hide();
          $('#BotonEnviar').hide();
          }
          if(idcompraestado==4){
            $('#BotonAceptar').hide();
            $('#BotonCancelar').hide();
            $('#BotonEnviar').hide();
            }});
       }
    
 function cambiarEstado(idcompraestadotipo,idcompra,idcompraestado,idusuario) {
  
//Ocultar modal
let registro = {idcompraestadotipo:idcompraestadotipo , idcompra:idcompra, idcompraestado:idcompraestado, idusuario:idusuario}
var genericModalEl = document.getElementById('exampleModal')
var modal = bootstrap.Modal.getInstance(genericModalEl)
$.ajax({
  type: 'POST',
  url:'accion/agregar_estado.php',
  data: registro,
  complete: function (xhr, textStatus) {
    //se llama cuando se recibe la respuesta (no importa si es error o éxito)
    console.log("La respuesta regreso")
  },
  success: function(msg) {
    console.log(msg);

    // Espera a que el documento esté listo
    $(document).ready(function() {
    // Maneja el clic en el botón dentro del modal
      $('.cerraryRecargar').on("click", function() {
      // Cierra el modal
      $("#exampleModal").modal("hide");
      // Recarga la página
      location.reload(true);
    });
  });
},
error: function (xhr, textStatus, errorThrown) {
  //called when there is an error
  console.error("Error en la solicitud Ajax: " + textStatus + " - " + errorThrown);
  console.log(xhr.responseText);//muestra en la consola del navegador todos los errores
  //console.error(xhr);
  //console.error(textStatus);
  //console.error(errorThrown);
}
});
 }
    
     
