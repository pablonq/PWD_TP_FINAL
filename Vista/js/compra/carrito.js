$(document).ready(function(){
  verCarrito();    
 }); 
function verCarrito(){
  $("#compras").load('accion/listar_compras.php');
}