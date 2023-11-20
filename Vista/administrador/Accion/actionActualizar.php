<?php
    include_once '../../../configuracion.php';
    session_start();
    
    $datos = data_submitted();
    $objUsuario = new AbmUsuario();
    
    // Busco el objeto usuario por su ID para modificarlo
    $param['idusuario'] = $datos['idusuario'];
    $usuario = $objUsuario->buscar($param);

    $arrayDatos['idusuario'] = $datos['idusuario'];
    $arrayDatos['usnombre'] =$datos['usnombre'];
    $arrayDatos['uspass'] = $datos['uspass'];
    $arrayDatos['usmail'] = $datos['usmail'];
    $arrayDatos['usdeshabilitado'] = $datos['usdeshabilitado'];

    if (!empty($usuario)){
        if ($objUsuario->modificar($arrayDatos)){
            $_SESSION['usnombre'] = $datos['usnombre'];
            header("Location: ../homeAdministrador.php?error=exito");
            exit();
        } else {
            header("Location: ../homeAdministrador.php?error=fallo");
            exit();
        }
    }
    