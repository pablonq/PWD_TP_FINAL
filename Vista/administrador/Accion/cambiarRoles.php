<?php
    include_once '../../../configuracion.php';
    include_once '../../../Control/AbmUsuarioRol.php';
    include_once '../../../Modelo/UsuarioRol.php';
    
    session_start();

    $datos = data_submitted();
    verEstructura($datos);

    $objUsuarioRol = new AbmUsuarioRol();
    $objUsuario = new AbmUsuario();

   if ($datos['accion'] == "alta"){
    echo "entra al if";
    if ($objUsuarioRol->alta($datos)){
        echo "se pudo"; 
    } else {
        echo "no se pudo";
    }
   }
   if ($datos['accion'] == "baja"){
    echo "entra al if de baja ";
    if ($objUsuarioRol->baja($datos)){
        echo "lo elimino";
    } else {
        echo "no lo eliminó";
    }
   }

  