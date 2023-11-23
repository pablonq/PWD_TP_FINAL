$('#agregarRolesForm button').on('click', function (event) {
    event.preventDefault(); // Evita el comportamiento por defecto del botón
    var idRol = $(this).val(); // Obtiene el valor del botón presionado
    var accion = 'alta'; // Supongo que 'alta' es para agregar roles

    $.ajax({
        type: 'POST',
        url: './Accion/cambiarRoles.php', // Ruta al archivo PHP que procesará los datos
        data: {
            accion: accion,
            idrol: idRol,
            idusuario: <? php echo $id?>
        }, // Datos a enviar al servidor
        success: function (response) {
            // Manejo de la respuesta si es necesaria
            console.log('Datos enviados con éxito:', response);
        },
        error: function (xhr, status, error) {
            // Manejo de errores si es necesario
            console.error('Error en la solicitud:', status, error);
        }
    });
});