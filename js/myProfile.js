$(document).ready(function() {
    var matricula = { "matricula": sessionStorage.getItem("matricula") };

    $.getProfileInfo(matricula);

    $('.user-options').on('click', function() {
        var id = this.id.split('-');
        id = id[2];
        $('#modal-op-' + id).modal('show');
    });

    $('#logout-confirm').on('click', function() {
        jQuery.ajax({
                type: 'POST',
                url: '../php/logout.php',
            })
            .done(function(respuesta) {
                sessionStorage.setItem("matricula", null);
                $(location).attr('href', '../index.php');
            })
            .fail(function(respuesta) {
                console.log(respuesta);
            });
    });

    $('.close-modal-btn').on('click', function() {
        var id = this.id.split('-');
        id = id[2];
        $('#modal-op-' + id).modal('hide');
    });

    $('#profile-op-0').click(function() {
        jQuery.ajax({
                type: 'POST',
                url: '../php/getConsulState.php',
                dataType: 'json',
                data: matricula
            })
            .done(function(respuesta) {
                $('#switch-form').empty();
                for (i = 0; i < respuesta.datos.length; i++) {
                    var state = respuesta.datos[i].data.estado;
                    var newRow = '<div class="row">';
                    newRow += '<div class="col-auto" style="display: flex; align-items: center; justify-content: flex-start;">' +
                        '<label for="switch-' + respuesta.datos[i].data.id_materia + '"><h4>' +
                        $.toTitleCase(respuesta.datos[i].data.materia) + '</h4></label></div>';
                    newRow += '<div class="col" style="display: flex; align-items: center; justify-content: flex-end;">' +
                        '<input class="mat-state-switch" id="switch-' + respuesta.datos[i].data.id_materia +
                        '" type="checkbox" data-toggle="toggle" data-onstyle="success" data-offstyle="danger" data-style="ios" data-on="I" data-off="O"' +
                        (state ? ' checked' : '') + '></div></div>';
                    $('#switch-form').append(newRow).trigger('update');
                }
                $('[data-toggle="toggle"]').bootstrapToggle();
            })
            .fail(function(respuesta) {
                console.log(respuesta);
            });
    });

    $('body').on('click', '#save-mat-state', function() {
        $('.mat-state-switch').each(function() {
            matId = $(this).attr('id').split('-')[1];
            console.log($(this).prop('checked'));
            console.log({
                'matricula': parseInt(Object.values(matricula)[0]),
                'matId': parseInt(matId),
                'state': ($(this).prop('checked') ? 1 : 0)
            })
            jQuery.ajax({
                    type: 'POST',
                    url: '../php/modAsrState.php',
                    dataType: 'json',
                    data: {
                        'matricula': parseInt(Object.values(matricula)[0]),
                        'matId': parseInt(matId),
                        'state': ($(this).prop('checked') ? 1 : 0)
                    }
                })
                .done(function(respuesta) {
                    console.log('done');
                    console.log(respuesta);
                })
                .fail(function(respuesta) {
                    console.log('fail');
                    console.log(respuesta);
                });
        });
        $('#modal-op-0').modal('hide');
        $.showAlertMsg('Cambios guardados con &eacute;xito');
    });

    $('#profile-op-1').click(function() {
        $.getMySolic();
    });

    $('body').on('click', '.accept-btn, .deny-btn', function() {
        var btnid = $(this).attr('id').split('-');
        var newState = (btnid[0] == 'accept') ? 1 : 2;
        jQuery.ajax({
                type: 'POST',
                url: '../php/modMySolic.php',
                dataType: 'json',
                data: {
                    'id': parseInt(btnid[1]),
                    'estado': newState
                }
            })
            .done(function(respuesta) {
                console.log(respuesta);
            })
            .fail(function(respuesta) {
                console / log('fail' + respuesta);
            });
        $.getMySolic();


    });

    $('#profile-op-2').click(function() {
        var thisSem = parseInt($('#semestre').text().split(' ')[1]);
        if (thisSem < 6) {
            $('#alta-cont').text('No haz llegado al semestre mínimo para poder ser asesor aún');
            $('#solic-confirm').attr('hidden', 'hidden');
        } else {
            var newInput = '<label for"id-alta">Indica la clave de la materia a solicitar (cinco caracteres)</labe;>' +
                '<input type="text" minlength="5" maxlength="5" pattern="[0-9]+" id="id-alta">';
            $('#alta-cont').html(newInput);
            $('#solic-confirm').removeAttr('hidden');
        }
    });

    $('body').on('click', '#solic-confirm', function() {
        var idMat = parseInt($('#id-alta').val());
        jQuery.ajax({
                type: 'POST',
                url: '../php/confirmMat.php',
                dataType: 'json',
                data: { 'idMat': idMat }
            })
            .done(function(resp) {
                if (!resp.error) {
                    $('#id-alta').val('');
                    $('#modal-op-1').modal('hide');
                    $.showAlertMsg('Solicitud enviada con &eacute;xito');
                } else {
                    $.showAlertMsg('Clave de materia no v&aacute;lida');
                }
            })
            .fail(function(resp) {
                console.log('fail');
            });
    });

    $('#profile-op-3').click(function() {
        $.getMyMsg(matricula);
    });

    $('body').on('click', '.modify-btn', function() {
        var idMsg = $(this).attr('id').split('-')[2];

        jQuery.ajax({
                type: 'POST',
                url: '../php/modMsgState.php',
                dataType: 'json',
                data: { 'idMsg': parseInt(idMsg) }
            })
            .done(function(respuesta) {
                console.log(respuesta);
            })
            .fail(function() {

            });
    });

    $.getMySolic = function() {
        $('#consul-tbody').empty();
        jQuery.ajax({
                type: 'POST',
                url: '../php/getMySolic.php',
                dataType: 'json',
                data: matricula
            })
            .done(function(respuesta) {
                if (!respuesta.error) {
                    for (i = 0; i < respuesta.datos.length; i++) {
                        var tableRow = '<tr class="table-row" role="row">';
                        tableRow += '<td class="table-cell">' +
                            respuesta.datos[i].data.id + '</td>';
                        tableRow += '<td class="table-cell">' +
                            $.toTitleCase(respuesta.datos[i].data.asdo) + '</td>';
                        tableRow += '<td class="table-cell">' +
                            $.toTitleCase(respuesta.datos[i].data.mat) + '</td>';
                        tableRow += '<td class="table-cell">' +
                            respuesta.datos[i].data.fecha + '</td>';
                        tableRow += '<td class="table-cell">' +
                            respuesta.datos[i].data.hora.split('.')[0].slice(0, -3) + ' - ' +
                            respuesta.datos[i].data.hora.split('.')[1].slice(0, -3) + '</td>';
                        tableRow += '<td class="table-cell">' +
                            '<a id="accept-' + (respuesta.datos[i].data.id) + '" class="accept-btn" href="#"><i class="fas fa-check"></i>&nbsp;Aceptar</a>' +
                            '<br>' +
                            '<a id="deny-' + (respuesta.datos[i].data.id) + '" class="deny-btn" href="#"><i class="fas fa-times"></i>&nbsp;Rechazar</a>' +
                            '</td>';
                        console.log(tableRow);
                        $('#consul-tbody').append(tableRow + '</tr>').trigger('update');
                    }
                } else {
                    $('#consultancies-cont').html('<h3>No tienes solicitudes</h3>')
                }
            })
            .fail(function(respuesta) {
                console.log('fail');
            });
    }

    $.getMyMsg = function(matricula) {
        $('#msg-tbody').empty();
        jQuery.ajax({
                type: 'POST',
                url: '../php/getMsgs.php',
                dataType: 'json',
                data: matricula
            })
            .done(function(respuesta) {
                if (!respuesta.error) {
                    for (i = 0; i < respuesta.datos.length; i++) {
                        var tableRow = '<tr class="table-row" role="row">';
                        tableRow += ('<td class="table-cell">' +
                            respuesta.datos[i].data.id + '</td>');
                        tableRow += ('<td class="table-cell">' +
                            $.toTitleCase(respuesta.datos[i].data.nombre) + '</td>');
                        tableRow += ('<td class="table-cell">' + (respuesta.datos[i].data.state == 0 ? 'No le&iacute;do' : 'Le&iacute;do') + '</td>');
                        tableRow += ('<td class="table-cell">' +
                            '<a id="read-msg-' + (respuesta.datos[i].data.id) + '" data-toggle="popover" data-content="' +
                            respuesta.datos[i].data.msg + '" data-container"#modal-op-2" class="modify-btn" href="#"><i class="fab fa-readme"></i>&nbsp;&nbsp;Leer</a></td>');
                        // tableRow += "<script type='text/javascript'>" +
                        //     "$(function(){$('#read-msg-" + (respuesta.datos[i].data.id) + "').popover({container: 'body'});});" +
                        //     "</script>";
                        $('#msg-tbody').append(tableRow + '</tr>').trigger('update');
                        $(function() {
                            $('[data-toggle="popover"]').popover({});
                        });
                    }
                } else {
                    $('#msg-cont').html('<h3>No tienes mensajes a&uacute;n</h3>');
                }
            })
            .fail(function(resp) {
                console.log('fail');
            });
    }

    $('#msg-table').tablesorter({
        sortList: [
            [2, 1]
        ],
        headers: {
            3: { sorter: false }
        }
    });
});