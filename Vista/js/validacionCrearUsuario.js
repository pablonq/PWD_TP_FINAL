$(document).ready(function () {

    $("#formCrearCuenta").validate({
        rules: {
            usnombreCrearCuenta: {
                required: true,
                //nombre //valor que debe tener
                nombreNoRepetido: { nombreNoRepetido: true }
            },
            usmailCrearCuenta: {
                required: true,
                mailValido: { mailValido: true }
            }
        },
        messages: {
            usnombreCrearCuenta: {
                required: "Ingrese su usuario"
            },
            usmailCrearCuenta: {
                required: "Ingrese su dirección de mail"
            }
        },
        errorElement: "span",

        errorPlacement: function (error, element) {
            error.addClass("invalid-feedback");
            element.closest(".contenedor-dato").append(error);
        },
        highlight: function (element) {
            $(element).addClass("is-invalid").removeClass("is-valid");
        },
        unhighlight: function (element) {
            $(element).removeClass("is-invalid").addClass("is-valid");
        },

        submitHandler: function (form) {

            var formData = $(form).serialize()

            $.ajax({
                url: "../../Control/Ajax Antiguo/crearCuenta.php",
                type: "POST",
                dataType: "json",
                data: formData,
                async: false,

                complete: function (xhr, textStatus) {
                    //se llama cuando se recibe la respuesta (no importa si es error o éxito)
                    console.log("La respuesta regreso");
                },
                success: function (respuesta, textStatus, xhr) {
                    //se llama cuando tiene éxito la respuesta
                    if (respuesta.resultado == "exito") {
                        console.log("El resultado de la consulta es: " + respuesta.resultado);
                        alert("entra");

                    } else {
                        console.log(respuesta.resultado);
                    }

                    // $(form).find('.is-valid').removeClass('is-valid');
                    // $("#formCrearCuenta")[0].reset();
                    // $("#imgCaptchaCrearCuenta").attr("src", "../../Control/captchaCrearCuenta.php?r=" + Math.random());
                    // alert(respuesta.mensaje);
                    // //$("#modalCrearCuenta").modal("hide");

                },
                error: function (xhr, textStatus, errorThrown) {
                    //called when there is an error
                    console.error("Error en la solicitud Ajax: " + textStatus + " - " + errorThrown)
                    console.log(xhr.responseText);//muestra en la consola del navegador todos los errores
                }
            });
        }
    });
});

jQuery.validator.addMethod("nombreNoRepetido", function (value, element) {
    return this.optional(element) || nombreNoRepetido(value);
}, "Nombre de usuario en uso");

jQuery.validator.addMethod("mailValido", function (value, element) {
    return this.optional(element) || (/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test(value));
}, "Mail ingresado no válido");

function nombreNoRepetido(value) {

    var formData = { 'usnombreCrearCuenta': value };//array en formato json. value es el dato recibido desde el formulario
    var ruta = "../../Control/Ajax Antiguo/nombreNoRepetido.php";
    var resultado = false;

    $.ajax({

        url: ruta,
        type: "POST",
        data: formData,
        dataType: "json",
        async: false,

        success: function (respuesta) {

            if (respuesta.validacion == "exito") {
                resultado = true;
            }
        }

    });

    return resultado;
}