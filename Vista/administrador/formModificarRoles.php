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
$id = $colUsuarios[0]->getIdUsuario();

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
                    <form id='agregarRolesForm' method='POST'>
                        <button class='btn btn-dark boton-accion' type='button' value='alta1'
                            onclick="cambiarRol('alta1', <?php echo $id ?>);">Admin</button>
                        <button class='btn btn-dark boton-accion' type='button' value='alta2'
                            onclick="cambiarRol('alta2', <?php echo $id ?>);">Deposito</button>
                        <button class='btn btn-dark boton-accion' type='button' value='alta3'
                            onclick="cambiarRol('alta3', <?php echo $id ?>);">Cliente</button>
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
                    <form id='quitarRolesForm' method='POST'>
                        <button class='btn btn-dark boton-accion' type='button' value='baja1'
                            onclick="cambiarRol('baja1', <?php echo $id ?>);">Admin</button>
                        <button class='btn btn-dark boton-accion' type='button' value='baja2'
                            onclick="cambiarRol('baja2', <?php echo $id ?>);">Deposito</button>
                        <button class='btn btn-dark boton-accion' type='button' value='baja3'
                            onclick="cambiarRol('baja3', <?php echo $id ?>);">Cliente</button>
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
<script>
// Se cuando se hace click en los botones dentro del formulario
// $('#agregarRolesForm button, #quitarRolesForm button').on('click', function(event) {

function cambiarRol(rol, idusuario) {
    var accion = {
        rol: rol,
        idusuario: idusuario
    };

    $.ajax({

        type: 'POST',
        url: './Accion/cambiarRoles.php',
        data: accion,

        // Datos a enviar al servidor
        success: function(response) {
            // Respuesta
            console.log('Datos enviados con éxito:', response);
            location.reload(true);
        },
        error: function(xhr, status, error) {
            // Errores
            console.error('Error en la solicitud:', status, error);
        }
    });
}
</script>

<?php 
include_once('../estructura/footer.php');
?>