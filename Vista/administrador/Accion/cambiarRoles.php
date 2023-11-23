<?php
    include_once '../../../configuracion.php';
    include_once '../../../Control/AbmUsuarioRol.php';
    include_once '../../../Modelo/UsuarioRol.php';
    
    session_start();

    $datos = data_submitted();
    verEstructura($datos);
    
    $objUsuarioRol = new AbmUsuarioRol();

    if ($resultado = $objUsuarioRol->cambiarRoles($datos)){
        echo "se pudo";
    } else {
        echo "no se pudo";
    }

  