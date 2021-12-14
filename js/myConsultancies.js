$(document).ready(function() {
    var regId;
    jQuery.ajax({
            url: '../php/getMyConsult.php',
            type: 'POST',
            dataType: 'json',
            data: { 'matricula': sessionStorage.getItem('matricula') }
        })
        .done(function(respuesta) {
            console.log('done');
            console.log(respuesta);
            if (!respuesta.error) {
                for (i = 0; i < respuesta.datos.length; i++) {
                    var tableRow = '<tr class="table-row" role="row">';
                    tableRow += '<td class="table-cell">' +
                        respuesta.datos[i].data.id + '</td>';
                    tableRow += '<td class="table-cell">' +
                        $.toTitleCase(respuesta.datos[i].data.asr) + '</td>';
                    tableRow += '<td class="table-cell">' +
                        $.toTitleCase(respuesta.datos[i].data.mat) + '</td>';
                    switch (respuesta.datos[i].data.state) {
                        case 0:
                            tableRow += '<td class="table-cell">En proceso</td>';
                            break;
                        case 1:
                            tableRow += '<td class="table-cell">Aprobada</td>';
                            break;
                        case 2:
                            tableRow += '<td class="table-cell">Rechazada</td>';
                            break;
                        case 3:
                            tableRow += '<td class="table-cell">Completada</td>';
                            break;
                        case 4:
                            tableRow += '<td class="table-cell">Cancelada</td>';
                            break;
                    }
                    if (respuesta.datos[i].data.state == 0)
                        tableRow += '<td class="table-cell">' +
                        '<a id="mod-' + (respuesta.datos[i].data.id - 1) + '" class="modify-btn" href="#"><i class="fas fa-pencil-alt"></i>&nbsp;Modificar</a>' +
                        '&nbsp;&nbsp;&nbsp;&nbsp;' +
                        '<a id="del-' + (respuesta.datos[i].data.id - 1) + '" class="cancel-btn" href="#"><i class="fas fa-trash"></i>&nbsp;Cancelar</a>' +
                        '</td>';
                    else
                        tableRow += '<td class="table-cell">' +
                        '<a id="del-' + (respuesta.datos[i].data.id - 1) + '" class="delete-btn" href="#"><i class="fas fa-trash"></i>&nbsp;Borrar</a>' +
                        '</td>';
                    console.log(tableRow);
                    $('#sch-tbody').append(tableRow + '</tr>').trigger('update');

                }
            } else {
                console.log('sin asesorias');
                $('#consultancies-cont').html('<h3>No tienes asesor&iacute;as</h3>')
            }
        })
        .fail(function(respuesta) {
            console.log('fail');
            console.log(respuesta);
        })
        .always(function() {

        });

    $('body').on('click', '.modify-btn', function() {
        $('#modal-modify').modal('show');
        regId = $(this).attr('id').split('-')[1];
        console.log(parseInt(regId) + 1);

        jQuery.ajax({
                url: '../php/getConsultInfo.php',
                type: 'POST',
                dataType: 'json',
                data: { 'regId': parseInt(regId) + 1 }
            })
            .done(function(respuesta) {
                console.log(respuesta);
                $('#lugar').val(respuesta.lugar);
                $('#date-picker').val(respuesta.fecha);
                $('#start-time').val(parseInt(respuesta.hora_inicio.split(':')[0]));
                $('#end-time').val(parseInt(respuesta.hora_fin.split(':')[0]));
            });
    });

    $('body').on('click', '#save-chng', function() {
        var data = {
            'id': parseInt(regId) + 1,
            'lugar': $('#lugar').val(),
            'fecha': $('#date-picker').val(),
            'inicio': '' + $('#start-time').val() + '0000',
            'fin': '' + $('#end-time').val() + '0000'
        };
        console.log(data);

        jQuery.ajax({
                url: '../php/modConsult.php',
                type: 'POST',
                dataType: 'json',
                data: data
            })
            .done(function(respuesta) {
                console.log(respuesta);
                $('#modal-modify').modal('hide');
                $.showAlertMsg('Cambios guardados con &eacute;xito');
            });
    });

    $('body').on('click', '.cancel-btn', function() {
        regId = $(this).attr('id').split('-')[1];
        $('#modal-cancel').modal('show');
    });

    $('body').on('click', '.delete-btn', function() {
        regId = $(this).attr('id').split('-')[1];
        $('#modal-delete').modal('show');
    });

    $('body').on('click', '#del-rqst', function() {
        jQuery.ajax({
                url: '../php/delConsult.php',
                type: 'POST',
                dataType: 'json',
                data: { 'id': parseInt(regId) + 1 }
            })
            .done(function(respuesta) {
                console.log(respuesta);
                $('#modal-delete').modal('hide');
                $.showAlertMsg('Solicitud cancelada');
                location.reload();
            });
    });

    $('body').on('click', '.close-modal', function() {
        var id = this.id.split('-');
        id = id[2];
        $('.modal-op-' + id).modal('hide');
    });

    $('#consul-table').tablesorter({
        sortList: [
            [0, 1]
        ],
        headers: {
            4: { sorter: false }
        }
    });
});