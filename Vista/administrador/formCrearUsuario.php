<!-- Crea un modal con un formulario para crear una cuenta -->
<div class="modal fade" id="modalCrearCuenta" data-bs-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Crea un usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form name="formCrearCuenta" id="formCrearCuenta" method="POST" class="needs-validation" novalidate>

                    <div class="contenedor-dato">
                        <label for="usnombreCrearCuenta" class="form-label">Nombre usuario</label>
                        <input type="text" class="form-control" id="usnombreCrearCuenta" name="usnombreCrearCuenta">
                    </div>
                    <br>

                    <div class="contenedor-dato">
                        <label for="usemailCrearCuenta" class="form-label">Email</label>
                        <input type="text" class="form-control" id="usmailCrearCuenta" name="usmailCrearCuenta"
                            placeholder="nombre@mail.com">
                    </div>
                    <br>

                    <br>
                    <div class="d-grid mb-3 gap-2">
                        <a href="./homeAdministrador.php"><button type="submit" name="botonCrearCuenta"
                                id="botonCrearCuenta" class="btn text-white  btn-dark">Crear</button></a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>