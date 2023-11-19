$(document).ready(function(){
    listarCompras();    
   }); 
  function listarCompras(){
    $("#compras").load('accion/listar_compras.php');
  }
  function  cargarCompra(idcompra,idcompraestado,idusuario)
  {
  		$("#contenido").load('accion/cargar_compra_admin.php?idcompra='+idcompra+'&idcompraestado='+idcompraestado+"&idusuario="+idusuario);
  }
  function cambiarEstado(mensaje,idcompraestadotipo,idcompra,idcompraestado,idusuario) {
    //alert("mensaje:"+mensaje+" idcompra:"+idcompra+ " idcompraestado:"+idcompraestado+" idcompraestadotipo:"+idcompraestadotipo+" idusuario:"+idusuario);
   //Creación de la instancia 

//Ocultar modal
var genericModalEl = document.getElementById('exampleModal')
        var modal = bootstrap.Modal.getInstance(genericModalEl)
        var msj = mensaje;
      
    var jqxhr = $.post('accion/agregar_estado.php?idcompra='+idcompra+"&idcompraestado="+idcompraestado+"&idcompraestadotipo="+idcompraestadotipo+"&idusuario="+idusuario, function() {
        //alert( "success" );
      })
      .done(function(result) {
        var result = eval('(' + result + ')');
        if (!result.respuesta) {
          $.messager.alert({
            title: 'Error',
            msg: result.errorMsg
          });
        } else {
          $.messager.show({
            title: 'Mensaje',
            msg: mensaje 
          });
          //modal.hide()
        //  $("#exampleModal").modal("dismiss");
        location.href = 'email.php?mensaje='+mensaje+'&idcompra='+idcompra+"&idcompraestado="+idcompraestado+"&idcompraestadotipo="+idcompraestadotipo+"&idusuario="+idusuario;
        enviarCorreo();
           
        }
      })
      .fail(
        function() {

          $.messager.alert({
            title: 'Error',
            msg: "No se pudo ejecutar"
          });

        }
      )
      .always(function() {
        // alert( "finished" );
      });

    
  }  