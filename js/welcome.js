jQuery(document).ready(function() {
    $('#welcome-user').text('Hola de nuevo, ' + $.toTitleCase(sessionStorage.getItem("nombre").toString()));

    var matricula = { "matricula": sessionStorage.getItem("matricula") };

    jQuery.ajax({
            url: '../php/welcome.php',
            type: 'POST',
            dataType: 'json',
            data: matricula
        })
        .done(function(respuesta) {
            console.log(respuesta)
            $('#profile-pic-welcome').attr('src', respuesta.ruta);
            sessionStorage.setItem("profile-pic", respuesta.ruta)
        })
        .fail(function(respuesta) {
            console.log(respuesta.responseText);
        })
        .always(function(respuesta) {
            console.log("complete");
        });
});