$(document.body).ready(function() {
    $('#accionModal').css('display', 'none');
    $('#iniciarSesion').click(comprobarDatosLogin);
    $.ajaxSetup({"cache": false});
});

function comprobarDatosLogin() {
    var datosFormulario = $('#formulario').serialize();
    $.ajax({
        type: "POST",
        url: "../../controller/controller.php?accion=comprobarDatosLogin",
        data: datosFormulario
    }).done(function(resultado) {
        console.log(resultado);
        if (resultado == "no") {
            $('#accionModal').click();
        } else {
            window.location = "../../index.php?login=" + $('#aliasCorreo').val() + resultado;
        }
    });
}
