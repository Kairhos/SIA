$(document).ready(function() {
    var consultMat = sessionStorage.getItem('consultantMat');
    var matricula = { 'matricula': consultMat };
    var today;
    var fecha;

    $.getComments = function() {
        $('.comments-cont').empty();
        jQuery.ajax({
                url: '../php/getComments.php',
                type: 'POST',
                dataType: 'json',
                data: matricula
            })
            .done(function(respuesta) {
                console.log('done')
                console.log(respuesta);
                if (!respuesta.error) {
                    for (i = 0; i < respuesta.datos.length; i++) {
                        var newCom = '<h5 style="color: #a5b0cd;"><i class="fas fa-comment-dots"></i>&nbsp;&nbsp;' + respuesta.datos[i].data.msg + '</h5>';
                        $('.comments-cont').append(newCom);
                    }
                } else {
                    var newCom = '<h5 style="color: #a5b0cd; border:solid 1px #a5b0cd">No hay comentarios a&uacute;n</h5>';
                    $('.comments-cont').append(newCom);
                }
            })
            .fail(function(respuesta) {
                console.log('fail')
                console.log(respuesta.responseText);
            })
    }

    jQuery.ajax({
            url: '../php/welcome.php',
            type: 'POST',
            dataType: 'json',
            data: matricula
        })
        .done(function(respuesta) {
            $('#profile-pic').attr('src', respuesta.ruta);
        })
        .fail(function(respuesta) {
            console.log(respuesta.responseText);
        })
        .always(function(respuesta) {
            console.log("complete");
        });

    $.getProfileInfo(matricula);
    $.getSchedule(matricula, true, false);
    $.getComments();


    $('.user-options').on('click', function() {
        var id = this.id.split('-');
        id = id[2];
        $('#modal-op-' + id).modal('show');
    });

    $('.close-modal').on('click', function() {
        var id = this.id.split('-');
        id = id[2];
        $('#modal-op-' + id).modal('hide');
    });

    $('body').on('click', '#profile-op-1', function() {
        today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = today.getFullYear();

        fecha = yyyy + '-' + mm + '-' + dd;

        $('#date-picker').attr('value', fecha);
        $('#date-picker').attr('min', fecha);

        $('#start-time').attr('value', '' + (today.getHours() + 1));
        $('#start-time').attr('min', '' + (today.getHours() + 1));
        $('#end-time').attr('value', '' + (today.getHours() + 2));
        $('#end-time').attr('min', '' + (today.getHours() + 2));


    });

    jQuery.ajax({
            url: '../php/getConsulMats.php',
            type: 'POST',
            dataType: 'json',
            data: matricula
        })
        .done(function(respuesta) {
            console.log('done')
            console.log(respuesta.datos);
            if (!respuesta.error) {
                for (i = 0; i < respuesta.datos.length; i++) {
                    var option = '<option value="' +
                        respuesta.datos[i].data.id_materia +
                        '">' + respuesta.datos[i].data.id_materia + ' : ' +
                        $.toTitleCase(respuesta.datos[i].data.materia) +
                        '</option>';
                    $('#mat-select').append(option);
                    $('#request-send').removeAttr('disabled');
                }
            } else {
                var option = '<option disabled selected>No hay materias activas</option>';
                $('#mat-select').append(option);
                $('#request-send').attr('disabled', 'disabled');
            }
        })
        .fail(function() {

        })
        .always(function() {

        });

    $('body').on('change', '#date-picker', function() {
        if ($('#date-picker').val() == fecha) {
            $('#start-time').attr('value', '' + (today.getHours() + 1));
            $('#end-time').attr('value', '' + (today.getHours() + 2));
        } else {
            $('#start-time').attr('min', '' + 8);
            $('#end-time').attr('min', '' + 9);
        }
    });

    $('#request-send').click(function() {
        if (!$('#lugar').val())
            $.showAlertMsg('Debes especificar el lugar donde se llevará a cabo la asesor&iacute;a');
        else if (parseInt($('#start-time').val()) >= parseInt($('#end-time').val()))
            $.showAlertMsg('La Hora de fin debe ser mayor a la de inicio');
        else if (!$('#mat-select').val())
            $.showAlertMsg('Selecciona una materia de la lista');
        else {
            var solInfo = {
                'matAsdo': parseInt(sessionStorage.getItem('matricula')),
                'matAsr': parseInt(consultMat),
                'materia': parseInt($('#mat-select').val()),
                'estado': 0,
                'fecha': $('#date-picker').val(),
                'tInicio': $('#start-time').val() + '0000',
                'tFin': $('#end-time').val() + '0000',
                'duracion': '' + parseInt($('#end-time').val()) - parseInt($('#start-time').val()) + '0000',
                'lugar': $('#lugar').val(),
                'msg': $('#solc-msg').val()
            };
            console.log(solInfo);

            jQuery.ajax({
                    url: '../php/setConsult.php',
                    type: 'POST',
                    dataType: 'json',
                    data: solInfo
                })
                .done(function(respuesta) {
                    console.log('done')
                    $('#request-send').text('Procesando...');
                    setTimeout(function() {
                        $('#request-send').text('Enviar');
                        $('#modal-op-1').modal('hide');
                        $.showAlertMsg('Solicitud enviada con &eacute;xito');

                    }, 1000);
                })
                .fail(function(respuesta) {
                    console.log(respuesta.responseText);
                })
                .always(function(respuesta) {
                    console.log("complete");
                });
        }
    });

    $('#profile-op-2').click(function() {
        jQuery.ajax({
                url: '../php/validSession.php',
                type: 'POST',
                dataType: 'json',
                data: {
                    'asdo': parseInt(sessionStorage.getItem('matricula')),
                    'asr': parseInt(consultMat)
                }
            })
            .done(function(respuesta) {
                console.log(respuesta);
                if (respuesta.error) {
                    $('#text-comment').attr('disabled', 'disabled');
                    $('#text-comment').attr('placeholder', 'Solo puedes comentar luego de haber tenido una sesión con este asesor');
                    $('#comment-send').attr('disabled', 'disabled');
                } else {
                    $('#text-comment').removeAttr('disabled');
                    $('#text-comment').attr('placeholder', 'Escribe tus comentarios');
                    $('#comment-send').removeAttr('disabled');
                }
            })
    });

    $('body').on('click', '#comment-send,#msg-send', function() {
        var tipo = $(this).attr('id').split('-')[0];
        var msg = {
            'origen': parseInt(sessionStorage.getItem('matricula')),
            'destino': parseInt(consultMat),
            'msg': $('#text-' + tipo).val(),
            'estado': 0,
            'tipo': (tipo == 'comment') ? 0 : 1
        }
        console.log(msg);

        jQuery.ajax({
                url: '../php/sendMsg.php',
                type: 'POST',
                dataType: 'json',
                data: msg
            })
            .done(function(respuesta) {
                console.log(respuesta);
                if (tipo == 'comment') {
                    $('#modal-op-2').modal('hide');
                    $.showAlertMsg('Comentarios enviados')
                    $.getComments();
                } else {
                    $('#modal-op-3').modal('hide');
                    $.showAlertMsg('Mensaje enviado')
                }
                $('#text-' + tipo).val('');
            })

    });
});