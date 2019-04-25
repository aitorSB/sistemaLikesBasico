//Carga de las discusiones de la BD mediante Jquery 
$(document.body).ready(function() {
    cargaDiscusiones();
    $.ajaxSetup({"cache": false});
});

/* 
función que realiza una llamada a la bd para 
obtener las discusiones y así mostrarlas
*/
function cargaDiscusiones() {
    $.ajax({
        type: "POST",
        url: "controller/controller.php?accion=cargaDiscusiones"
    }).done(function(resultado) {
        $('#campo-discusiones').html(resultado);
    });
}
