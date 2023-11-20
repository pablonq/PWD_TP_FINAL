<?php
include_once '../../../configuracion.php';

$datos = data_submitted();
$abmUsuario = new AbmUsuario();

$abmUsuario->borradoLogico($datos);

header('Location:../homeAdministrador.php');

?>