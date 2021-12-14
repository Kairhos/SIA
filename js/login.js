jQuery(document).on('submit', '#login-form', function(event) {
    event.preventDefault();

    jQuery.ajax({
            url: 'php/login.php',
            type: 'POST',
            dataType: 'json',
            data: $(this).serialize(),
            beforeSend: function() {
                $('#login-btn').html('Validando...');
            }
        })
        .done(function(respuesta) {
            console.log(respuesta);
            $('#login-btn').html('Entrar');
            if (respuesta.error) {
                // $('#login-error').slideDown('slow');
                // setTimeout(function() {
                //     $('#login-error').slideUp('slow');
                // }, 3000);
                $.showAlertMsg('Credenciales no v&aacute;lidas, verifique su informaci&oacute;n');
            } else {
                sessionStorage.setItem("nombre", respuesta.nombre);
                sessionStorage.setItem("matricula", respuesta.matricula);
                $(location).attr('href', 'vista/welcome.php');
            }
        })
        .fail(function(respuesta) {
            console.log(respuesta.responseText);
        })
        .always(function(respuesta) {
            console.log("complete");
        });
});