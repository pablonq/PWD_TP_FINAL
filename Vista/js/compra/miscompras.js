function  cargarCompra(idcompra,idcompraestado)
{
        $("#contenido").load('accion/cargar_compra.php?idcompra='+idcompra+'&idcompraestado='+idcompraestado);
}
