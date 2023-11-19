<?php
include_once("../../configuracion.php");
$tituloPagina = "TechnoMate | Administrador";
include_once("../estructura/headSeguro.php");
include_once("../estructura/navSeguro.php");

$objUsuario = new AbmUsuario();
$colUsuarios = $objUsuario->buscar("");

$objUsuarioRol = new AbmUsuarioRol();
$colUsuarioRol = $objUsuarioRol->buscar("");
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
        <td><button class='btn text-white btn-dark' data-bs-toggle='modal' data-bs-target='#modalModificacion' tabindex='-1'><a style='text-decoration: none;' href='formModificarUsuarios.php?idusuario= ". $usuario->getIdusuario() . "'>Datos</a></button>
        <button class='btn text-white btn-dark' data-bs-toggle='modal' data-bs-target='#modalModificacion' tabindex='-1'><a style='text-decoration: none;' href='formModificarRoles.php?idusuario= ". $usuario->getIdusuario() . "'>Roles</a></button>
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