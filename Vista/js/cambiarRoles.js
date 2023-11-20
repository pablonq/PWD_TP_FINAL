function cambiarRoles() {
    var parametros =
    {
        "variable1": "mensaje1",
        "variable1": "mensaje1",
        "variable1": "mensaje1",
    };

    $.ajax({
        data: parametros,
        url: 'programacion.php',
        type: 'POST',

        beforesend: function () {
            $('#ID_Mostrar_info').html("Mensaje antes de enviar");
        },

        success: function (mensaje_mostrar) {
            $('#ID_Mostrar_info').html(mensaje_mostrar);
        }
    });
}