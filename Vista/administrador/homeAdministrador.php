<?php
include_once("../../configuracion.php");
$tituloPagina = "Home administrador";
include_once("../estructura/headSeguro.php");
include_once("../estructura/navSeguro.php");
include_once('formCrearUsuario.php');

$datos= data_submitted();

$objUsuario = new AbmUsuario();
$colUsuarios = $objUsuario->buscar("");

$objUsuarioRol = new AbmUsuarioRol();
$colUsuarioRol = $objUsuarioRol->buscar("");

if(isset($datos['error'])) {
    $error = $datos['error'];
    if($error === 'fallo') {
    echo '<script>';
    echo 'Swal.fire("Ningún campo modificado.");';
    echo '</script>';   
    } elseif($error === 'exito'){
        echo '<script>';
        echo '
        Swal.fire({
            title: "Operación exitosa!",
            text: "Los cambios se han realizado.",
            icon: "success"
          });';
        echo '</script>';
    }
}
?>
<div class="container-fluid" style="padding: 50px;">

    <button class='btn text-white btn-success' data-bs-toggle="modal" data-bs-target="#modalCrearCuenta"
        tabindex="-1"><i class="bi bi-person-fill-add"></i> Crear usuario</button>
    <button onclick="window.location.reload();" class="btn btn-secondary"><i class="bi bi-arrow-clockwise"></i></button>
    <p></p>
    <?php
    if (!empty($colUsuarioRol)){
        echo "<h4>Listado de usuarios</h4>";
        echo "<table class='table table-striped'>";
        echo "<th>#</th>
        <th>Nombre de Usuario</th>
        <th>Email</th>
        <th>Deshabilitado</th>
        <th>Acciones</th>";
    foreach($colUsuarios as $usuario){
        echo "<tr>
        <td>".$usuario->getIdUsuario()."</td>
        <td>".$usuario->getUsNombre()."</td>
        <td>".$usuario->getUsMail()."</td>
        <td>".$usuario->getUsDeshabilitado()."</td>
        <td><a style='text-decoration: none;' href='formModificarUsuarios.php?idusuario= ". $usuario->getIdusuario() . "'><button class='btn text-white btn-primary'><i class='bi bi-pencil'></i> Editar</button></a>
        <a style='text-decoration: none;' href='formModificarRoles.php?idusuario= ". $usuario->getIdusuario() . "'><button class='btn text-white btn-secondary'><i class='bi bi-exposure'></i> Roles</button></a>
        <a style='text-decoration: none;' href='./Accion/deshabilitarUsuario.php?idusuario= ". $usuario->getIdusuario() . "'><button class='btn text-white btn-danger'><i class='bi bi-trash'></i></button></a>
        </td>
        </tr>";
    }
    echo "</table>";
    } else {
        echo "<h4>No hay usuarios cargados en la Base de Datos";
    }
?>

</div>
<script src="../js/validacionCrearUsuario.js"></script>

<?php
include_once("../estructura/footer.php");
?>