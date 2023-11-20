<?php
include_once("../../configuracion.php");
$tituloPagina = "Home administrador";
include_once("../estructura/headSeguro.php");
include_once("../estructura/navSeguro.php");

$datos= data_submitted();

$objUsuario = new AbmUsuario();
$colUsuarios = $objUsuario->buscar("");

$objUsuarioRol = new AbmUsuarioRol();
$colUsuarioRol = $objUsuarioRol->buscar("");

if(isset($datos['error'])) {
    $error = $datos['error'];
    if($error === 'fallo') {
        echo '<div class="alert alert-danger" role="alert">No ha actualizado ningún campo.</div>';
    } elseif($error === 'exito'){
        echo '<div class="alert alert-success" role="alert">¡Operación exitosa!</div>';
    }
}
?>
<div class="container-fluid" style="padding: 50px;">

    <button class='btn text-white btn-success'><i class="bi bi-person-fill-add"></i> Crear usuario</button>
    <p></p>
    <?php
    if (!empty($colUsuarioRol)){
        echo "<h4>Listado de usuarios</h4>";
        echo "<table class='table table-striped'>";
        echo "<th>#</th>
        <th>Nombre de Usuario</th>
        <th>Roles</th>
        <th>Modificar</th>";
    foreach($colUsuarios as $usuario){
        echo "<tr>
        <td>".$usuario->getIdUsuario()."</td>
        <td>".$usuario->getUsNombre()."</td>
        <td>Pongo sus roles</td>
        <td><a style='text-decoration: none;' href='formModificarUsuarios.php?idusuario= ". $usuario->getIdusuario() . "'><button class='btn text-white btn-primary' data-bs-toggle='modal' data-bs-target='#modalModificacion' tabindex='-1'>Datos</button></a>
        <a style='text-decoration: none;' href='formModificarRoles.php?idusuario= ". $usuario->getIdusuario() . "'><button class='btn text-white btn-primary' data-bs-toggle='modal' data-bs-target='#modalModificacion' tabindex='-1'>Roles</button></a>
        </td>
        </tr>";
    }
    echo "</table>";
    } else {
        echo "<h4>No hay usuarios cargados en la Base de Datos";
    }
?>
</div>

<?php
include_once("../estructura/footer.php");
?>