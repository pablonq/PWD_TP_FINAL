<?php
include_once("../../configuracion.php");
$datos = data_submitted();
$texto = $datos["nombre"];

$tituloPagina = "TechnoMate | " . $texto;

include_once("../estructura/headSeguro.php");
include_once("../estructura/navSeguro.php");

?>

<<link rel="stylesheet" href="../vista/css/bootstrap/4.5.2/bootstrap.min.css">
<div class="container border border-secondary principal mt-3 pt-3">
   <h3 class="text-center">Listado de Productos</h3>
    <div class="row text-muted m-0">
        <?php 
        
           $datos = data_submitted();
           //print_r($datos);
           $param['idproducto']= $datos['id'];
/*
           $valor=$datos['precio'];
           $cantidad=$datos['cantidad'];
           
           $param['idproducto']= $datos['id'];

           $total=$valor * $cantidad;
        */
          $objAbmProducto = new ABMproducto(); 

        $listaProducto = $objAbmProducto->cargarProdCarrito($param);

    
        print_r($listaProducto);
        if(count($listaProducto)>0){
            ?>
            <table class="table table-dark table-striped text-center table-hover" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Cantidad </th>
                        <th scope="col">Modificar</th>
                      
                                        
                    </tr>
                </thead>
                <tbody>
                <?php
                    
                    foreach ($listaProducto as $objProducto) {                         
                        echo '<tr>
        
                        <td>'.$objProducto->getProNombre().'</td>';
                        echo '
                        <td>'.$objProducto->getProDetalle().'</td>';
                        echo '
                        <td>'.$total.'</td>';
                    
                        echo '<td><a href="editarProducto.php?accion=editar&idproducto='.$objProducto->getIdproducto().'" class="btn btn-success">Editar</a></td>';
                        echo '<td><a href="accionBorradoLogico.php?accion=borradoLogico&idproducto='.$objProducto->getIdproducto().'" class="btn btn-success">Deshabilitar</a></td>';
                   
                           echo'</tr>';
                  
                     }
                    //fin foreach
                    echo '    </tbody>
                    </table>';
                }
                else{

                    echo "<h3>No hay productos registrados </h3>";
                }
                
                ?>
            
        
</div>
<div class="col-md-3">
            <a href="formProducto.php"class="btn btn-primary mb-4">Nuevo Producto</a>
        </div>
</div>
<div>
<?php
include ("../../Vista/estructura/footer.php");
?>
