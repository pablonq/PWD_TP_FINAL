<?php
include_once("../../configuracion.php");


$datos = data_submitted();
print_r($datos);

$valor=$datos['precio'];
$cantidad=$datos['cantidad'];

$param['idproducto']= $datos['id'];

$total=$valor * $cantidad;

$objAbmProducto = new ABMproducto();

$listaProducto = $objAbmProducto->buscar($param);  



?>
