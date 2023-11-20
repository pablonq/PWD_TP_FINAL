<?php
include_once("../../configuracion.php");
include_once '../../Control/AbmUsuario.php';
include_once '../../Modelo/Conector/BaseDatos.php';
include_once '../../Modelo/Usuario.php';
include_once ('../../configuracion.php');

$idUsuario = data_submitted();
$objUsuario = new AbmUsuario();
$usuario = $objUsuario->buscar($idUsuario);

$tituloPagina = "TechnoMate | Administrador";
include_once '../estructura/headSeguro.php';
include_once '../estructura/navSeguro.php';

?>
<div class="container" style="padding: 50px;">
    <form name="actualizarUsuario" id="actualizarUsuario" method="POST" action="Accion/actionActualizar.php"
        class="needs-validation" novalidate>
        <h3>DATOS A MODIFICAR</h3>
        <br>

        <div class="contenedor-dato">
            <label for="idusuario" class="form-label">ID de usuario</label>
            <input type="text" name="idusuario" id="idusuario" class="form-control"
                value="<?php echo $usuario[0]->getIdUsuario() ?>" readonly></input>
        </div>
        <br>

        <div class="contenedor-dato">
            <label for="usnombre" class="form-label">Nombre de usuario</label>
            <input type="text" name="usnombre" id="usnombre" class="form-control"
                value="<?php echo $usuario[0]->getUsNombre() ?>"></input>
        </div>
        <br>

        <div class="contenedor-dato">
            <label for="usmail" class="form-label">Email</label>
            <input type="text" name="usmail" id="usmail" class="form-control"
                value="<?php echo $usuario[0]->getUsMail() ?>"></input>
        </div>
        <br>

        <input type="password" name="uspass" id="uspass" class="form-control"
            value="<?php echo $usuario[0]->getUsPass() ?>" hidden></input>

        <input type="password" name="usdeshabilitado" id="usdeshabilitado" class="form-control"
            value="<?php echo $usuario[0]->getUsDeshabilitado() ?>" hidden></input>

        <div class="d-grid mb-3 gap-2">
            <input type="submit" value="Editar" class="btn text-white btn-success"></input>
        </div>
    </form>
    <a href="./homeAdministrador.php"><input type="submit" value="Volver" class="btn text-white btn-dark">
        </input></a>
</div>

<?php
include_once '../estructura/footer.php';
?>