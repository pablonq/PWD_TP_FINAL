<?php
$dir="";
$titulo = "Supervisar compras";
include_once $dir."../estructura/headerSeguro.php";
//include_once '../../configuracion.php';

?>

<script type="text/javascript" src="../js/compra/listaCompras.js"></script>


<div class="container border border-secondary principal mt-3 pt-3">
   <h3 class="text-center">Supervisar compras</h3>
    <div id="compras" class="row text-muted m-0">
            <!-- Aquí se cargan las compras de todos los clientes -->
     </div>    
 </div>       
       
<?php
include ("../../Vista/estructura/footer.php");
?>
