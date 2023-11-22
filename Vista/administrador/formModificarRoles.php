<?php
include_once("../../configuracion.php");
include_once '../../Control/AbmUsuario.php';
include_once '../../Modelo/Conector/BaseDatos.php';
include_once '../../Modelo/Usuario.php';
include_once '../../Control/AbmUsuarioRol.php';
include_once '../../Modelo/UsuarioRol.php';
include_once ('../../configuracion.php');
include_once '../estructura/headSeguro.php';
include_once '../estructura/navSeguro.php';

$tituloPagina = "TechnoMate | Cambiar roles";

// Traigo el id del formulario
$datos = data_submitted();
$objUsuario = new AbmUsuario();

// Busco el usuario
$colUsuarios = $objUsuario->buscar($datos);

// Agarro su id
$idUsuario['idusuario'] = $colUsuarios[0]->getIdUsuario();

// Guardo todos sus roles vinculados para después mostrarlos por pantalla
$objUsuarioRol = new AbmUsuarioRol();
$colUsuarioRol = $objUsuarioRol->buscar($idUsuario);

?>

<div class="container" style="padding: 50px;">
    <div id="estado-cambio-rol">

    </div>
    <h3>Modificar roles</h3>
    <br>
    <table class='table table-striped'>
        <th>#</th>
        <th>Nombre de Usuario</th>
        <th>Roles actuales</th>
        <th>
            <div class='dropdown'>
                <button class='btn btn-success dropdown-toggle' type='button' data-bs-toggle='dropdown'
                    aria-expanded='false'>
                    Agregar roles
                </button>
                <ul class='dropdown-menu'>
                    <form name='agregarRolesForm' method='POST' action='Accion/cambiarRoles.php'>
                        <input type='hidden' name='idusuario' value="<?php echo $colUsuarios[0]->getIdUsuario(); ?>">
                        <input type='hidden' name='accion' value="alta">
                        <button class='btn btn-dark' name='idrol' value='1' type='submit'>Admin</button>
                        <button class='btn btn-dark' name='idrol' value='2' type='submit'>Deposito</button>
                        <button class='btn btn-dark' name='idrol' value='3' type='submit'>Cliente</button>
                    </form>

                </ul>
            </div>
        </th>
        <th>
            <div class='dropdown'>
                <button class='btn btn-danger dropdown-toggle' type='button' data-bs-toggle='dropdown'
                    aria-expanded='false'>
                    Quitar roles
                </button>
                <ul class='dropdown-menu'>
                    <form name='quitarRolesForm' method='POST' action='Accion/cambiarRoles.php'>
                        <input type='hidden' name='idusuario' value="<?php echo $colUsuarios[0]->getIdUsuario(); ?>">
                        <input type='hidden' name='accion' value="baja">
                        <button class='btn btn-dark' name='idrol' value='1' type='submit'>Admin</button>
                        <button class='btn btn-dark' name='idrol' value='2' type='submit'>Deposito</button>
                        <button class='btn btn-dark' name='idrol' value='3' type='submit'>Cliente</button>
                    </form>

                </ul>
            </div>
        </th>
        <tr>
            <?php
            echo "<td>".$colUsuarios[0]->getIdUsuario()."</td>
            <td>".$colUsuarios[0]->getUsNombre()."</td>
            <td>"; foreach ($colUsuarioRol as $rol){
                print_r($rol->getObjRol()->getRolDescripcion());
                echo "<br>";
                }";
            </td>
        </tr>";
        echo "
    </table>";
    ?>
            <a href="./homeAdministrador.php"><input type="submit" value="Volver" class="btn text- white btn-dark">
                </input></a>
</div>
<?php 
include_once('../estructura/footer.php');
?>