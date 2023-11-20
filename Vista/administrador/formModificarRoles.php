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
// verEstructura($idUsuario);

$objUsuarioRol = new AbmUsuarioRol();
$colUsuarioRol = $objUsuarioRol->buscar($idUsuario);

?>

<div class="container" style="padding: 50px;">
    <div id="estado-cambio-rol">

    </div>
    <form name="actualizarUsuario" id="actualizarUsuario" method="POST" class="needs-validation" novalidate>
        <h3>Modificar roles</h3>
        <br>
        <?php
        echo "<table class='table table-striped'>";
        echo "<th>#</th>
        <th>Nombre de Usuario</th>
        <th>Roles actuales</th>
        <th>
        <div class='dropdown'>
        <button class='btn btn-success dropdown-toggle' type='button' data-bs-toggle='dropdown' aria-expanded='false'>
        Agregar roles
        </button>
        <ul class='dropdown-menu'>
            <input class='btn btn-dark boton-accion' value='darAdmin' type='submit' onclick='cambiarRoles(this);'></input>
            <input class='btn btn-dark boton-accion' value='darDeposito' type='submit' onclick='cambiarRoles(this);'></input>
            <input class='btn btn-dark boton-accion' value='darCliente' type='submit' onclick='cambiarRoles(this);'></input>
        </ul>
        </div>
        </th>
        <th>
        <div class='dropdown'>
        <button class='btn btn-danger dropdown-toggle' type='button' data-bs-toggle='dropdown' aria-expanded='false'>
        Quitar roles
        </button>
        <ul class='dropdown-menu'>
            <input class='btn btn-dark boton-accion' value='quitarAdmin' type='submit' onclick='cambiarRoles(this);'></input>
            <input class='btn btn-dark boton-accion' value='quitarDeposito' type='submit' onclick='cambiarRoles(this);'></input>
            <input class='btn btn-dark boton-accion' value='quitarCliente' type='submit' onclick='cambiarRoles(this);'></input>
        </ul>
        </div>
        </th>
        <tr>
        <td>".$colUsuarios[0]->getIdUsuario()."</td>
        <td>".$colUsuarios[0]->getUsNombre()."</td>
        <td>"; foreach ($colUsuarioRol as $rol){
            print_r($rol->getObjRol()->getRolDescripcion());
            echo "<br>";
        }";
        </td>
        </tr>";
        echo "</table>";
        ?>
    </form>
    <a href="./homeAdministrador.php"><input type="submit" value="Volver" class="btn text- white btn-dark">
        </input></a>
</div>

<script>
function cambiarRoles(elementoBoton) {

    var accion = elementoBoton.value;
    var idusuario = <?php echo $colUsuarios[0]->getIdUsuario(); ?>;
    alert(idusuario);
    var parametros = {
        'operacion': accion,
        'idusuario': idusuario
    };

    $.ajax({
        data: parametros,
        url: './ajax/cambiarRoles.php',
        type: 'POST',
        dataType: "json",
        async: false,

        beforeSend: function() {
            $('#estado-cambio-rol').html("<div class='spinner-border text-primary' role='status'>");
        },

        success: function(respuesta) {
            if (respuesta == 'exito') {}
            $('#estado-cambio-rol').html(
                "<div class='alert alert-success' role='alert'>¡Operación exitosa!</div>");
        }
    });
}
</script>
<?php 
include_once('../estructura/footer.php');
?>