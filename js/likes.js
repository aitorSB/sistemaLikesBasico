var botonPulsado;

$('.like').click(function() {
    botonPulsado = this;

    var usuario = $('#usuarioLogin').text();
    var idPublicacion = $(botonPulsado).parent().attr('id');

    $.ajax({
        type: "POST",
        url: "controller/controller.php?accion=comprobarUsuarioLike&usuarioLogin=" 
            + usuario + "&idPublicacion=" + idPublicacion
    }).done(function(resultado) {
        if (resultado == "si") {
            $(botonPulsado).css('border-style','none');
            $.ajax({
                type: "POST",
                url: "controller/controller.php?accion=quitarLike&idPublicacion=" 
                + idPublicacion + "&usuarioLogin=" + usuario
            }).done(function(resultado) {
                cargarLike(idPublicacion);
            });
        } else {
            $(botonPulsado).css('border-style','inset');
            $.ajax({
                type: "POST",
                url: "controller/controller.php?accion=like&idPublicacion="
                 + idPublicacion + "&usuarioLogin=" + usuario
            }).done(function(resultado) {
                cargarLike(idPublicacion);
            });
        }
    });
})

function cargarLike(idPublicacion) {
    $.ajax({
        type: "POST",
        url: "controller/controller.php?accion=cargarLikes&idPublicacion=" + idPublicacion
    }).done(function(resultado) {
        $(botonPulsado).children('span').html(resultado);
    });
}

$('.noLogin').click(function() {
    $('#accionNoLogin').click();
});

