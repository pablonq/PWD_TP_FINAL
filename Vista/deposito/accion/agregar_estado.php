
    <?php
    include_once "../../../configuracion.php";
    $datos=data_submitted();
    echo $datos["idcompra"];
    if (isset($datos["idcompra"])){    
          
        $objCtrlCE=new ABMcompraestado();  
        $objCtrlCI=new ABMcompraitem();
          
        $respuesta= $objCtrlCE->cambiarEstado($datos); 
        
        if($datos["idcompraestadotipo"]==4)
        {
           $data["idcompra"]=$datos["idcompra"];
           $objCtrlCI->devolverProductos($data);
        }   
    }
    else{ $mensaje="no se pudo concretar";
    }
    $retorno['respuesta'] = $respuesta["seagrego"];
    $retorno['seactualizo'] = $respuesta["seactualizo"];
    if (isset($mensaje)){   
        $retorno['errorMsg']=$mensaje;
    }
        echo json_encode($retorno);
?>

