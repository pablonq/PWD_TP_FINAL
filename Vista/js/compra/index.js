$(document).ready(function() {
    cargarCarrito();

  }

);

function cargarCarrito() {

  $("#contenido").load('accion/cargar_carrito.php');
}

function comprar(mensaje, idcompraestadotipo) {
  var jqxhr = $.post('accion/confirmar_compra.php?idcompraestadotipo=' + idcompraestadotipo , function() {
      //alert( "success" );
    })
    .done(function(result) {
      var result = eval('(' + result + ')');
      if (!result.respuesta) {
        $.messager.show({
          title: 'Error',
          msg: result.errorMsg
        });
      } else {
        
        
        $.messager.show({
          title: 'Mensaje',
          msg: mensaje 
        });
        cargarCarrito();
 
      }
    }, 'json')
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

function eliminarItem(idproducto, idcompraitem, cicantidad) {
  //var row = $('#dg').datagrid('getSelected');

  $.messager.confirm('Confirm', 'Seguro que desea eliminar el producto?', function(r) {
    if (r) {
      $.post('accion/eliminar_item_carrito.php?idproducto=' + idproducto + '&idcompraitem=' + idcompraitem + '&cicantidad=' + cicantidad,
        function(result) {
          //     	 alert("Volvio Serviodr");  

          if (result.respuesta) {
            /*  $.messager.alert({  
                    title: 'Mensaje',
                    msg: "se elimino:"+result.respuesta+" y se actualizo stock:"+result.seactualizo
              });*/
       //     window.location.href = window.location.href;
       cargarCarrito();
        
            //	 alert("se pudo enviar, idproducto:"+result.idproducto +" y su idcompraitem es"+result.idcompraitem);
            //$('#dg').datagrid('reload');    // reload the  data
          } else {
            $.messager.show({ // show error message
              title: 'Error',
              msg: result.errorMsg
            });
          }
        }, 'json');
    }
  });

}
function cambiarCantidad(idcompraitem, cicantidad) {
 
       var cant=parseInt(cicantidad);

      $.post('accion/cambiar_cantidad.php?idcompraitem=' + idcompraitem + '&cicantidad=' + cant,
        function(result) {
          //     	 alert("Volvio Serviodr");  

          if (result==1) {
            /*  $.messager.alert({  
                    title: 'Mensaje',
                    msg: "se elimino:"+result.respuesta+" y se actualizo stock:"+result.seactualizo
              });*/
       //     window.location.href = window.location.href;
       cargarCarrito();
     
          } else {
            cargarCarrito();
            $.messager.show({ // show error message
              title: 'Error',
              msg: "Se detecto un problema"
            });
          }
        }, 'json');


}