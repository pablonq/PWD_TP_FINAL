<?php
    include_once '../../../configuracion.php';
    include_once '../../../Control/AbmUsuarioRol.php';
    include_once '../../../Modelo/UsuarioRol.php';
    
    session_start();

    $datos = data_submitted();
    $param = ['idusuario' => $datos['idusuario'], 'idrol' => $datos['operacion']];

    $objUsuarioRol = new AbmUsuarioRol();
   
    $resultado = $objUsuarioRol->cambiarRol(['idusuario' => $datos['idusuario'], 'idrol' => $datos['operacion']]);

    // if ($resultado){
    //     $respuesta = array("resultado" => "exito", "mensaje" => "Producto agregado con exito.");
        
    // } else {
    //     $respuesta = array("resultado" => "error", "mensaje" => "No fue posible agregar el producto.");
        
    // }