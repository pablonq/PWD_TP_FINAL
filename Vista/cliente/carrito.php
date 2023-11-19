<?php
include_once("../../configuracion.php");
$objetoCompra = new AbmCompra();
$fechaAlta = date('Y-m-d H:i:s');

$parametros["idusuario"] = $_SESSION['idusuario'];

$objUsuario = new AbmUsuario(); 
$usuario =$objUsuario->buscar($parametros);

$param["cofecha"] = $_SESSION['idusuario'];
$param["idusuario"] = $usuario->getIdUsuario();

$objCompra-> alta($param);
// ESTO LO PUSE PORQUE CUANDO TENES LA CANTIDAD PODES CARGAR LA COMPRA ITEM
/*
CREATE TABLE `compraitem` (
    `idcompraitem` bigint(20) UNSIGNED NOT NULL,
    `idproducto` bigint(20) NOT NULL,
    `idcompra` bigint(20) NOT NULL,
    `cicantidad` int(11) NOT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
  
  -- Volcado de datos para la tabla compraitem // cambiar los idproducto
  
  INSERT INTO `compraitem` (`idcompraitem`, `idproducto`, `idcompra`, `cicantidad`) VALUES
  (1, 123, 1, 1),
  (2, 234, 2, 1),
  (3, 345, 3, 1),
  (4, 456, 4, 1);
*/
$datos = data_submitted();
print_r($datos);

$valor=$datos['precio'];
$cantidad=$datos['cantidad'];

$total=$valor * $cantidad;
?>


<div class="container" id="divCarrito">
    <table class="table table-bordered">
        <thead>
            <th>Id Producto</th>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Cantidad</th>
            <th>Total</th>
            <th></th>
        </thead>
        <tbody>
               <td><?php echo $datos['id'] ?></td>
               <td><?php echo $datos['nombre'] ?></td>
               <td>$<?php echo $datos['precio'] ?></td>
               <td><?php echo $datos['cantidad'] ?></td>
               <th>$<?php echo $total?></th>
        </tbody>
    </table>
</div>

<?php
include_once("../../configuracion.php");

$datos = data_submitted();
$texto = $datos["nombre"];

$tituloPagina = "TechnoMate | " . $texto;

include_once("../estructura/headSeguro.php");
include_once("../estructura/navSeguro.php");
?>

<!-- Contenido -->
<main class="col-12 my-3 mx-auto w-100 max">
    <!-- TABLA -->
    <h2>Mis Compras</h2>

    <table class="table table-striped table-bordered nowrap" id="tabla">
        <thead class="bg-dark text-light">
            <th field="producto">Producto</th>
            <th field="cantidad">Cantidad</th>
            <th field="precio">Precio</th>
            <th field="accion">Modificar</th>
        </thead>
        <tbody>

        </tbody>
    </table>


    <!-- MODAL -->
    <div class="modal fade" id="dlg" tabindex="-1" aria-labelledby="dlg" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="fw-5 text-center m-3" id="title"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="" id="form-abm" method="post">
                    <div class="modal-body">
                        <div id="errores" class="col-12"></div>
                        <div id="edit-form">
                            <input type="text" name="idcompraitem" id="idcompraitem" hidden>
                            <div class="col-12 mb-2">
                                <label for="cantidad" class="form-label">Cantidad</label>
                                <input type="number" min="0" class="form-control" name="cantidad" id="cantidad">
                                <div class="invalid-feedback" id="feedback-cantidad"></div>
                            </div>
                        </div>
                        <div id="delete-form">
                            <p class="text-danger">¿Esta seguro de que quiere sacar <span id="rol-name"></span> de su carrito?</p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="btn-submit" class="btn btn-primary">Enviar</button>
                        <input type="button" value="Cancelar" class="btn btn-secondary" onclick="$('#dlg').modal('hide');">
                    </div>
                </form>
            </div>
        </div>
</main>
<script src="../js/carrito.js"></script>
<?php
include_once "../Estructura/footer.php";
?>