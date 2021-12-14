$(document).ready(function() {
    $.getProfileInfo = function(matricula) {
        $('#profile-pic').attr('src', sessionStorage.getItem('profile-pic'));

        jQuery.ajax({
                url: '../php/profile.php',
                type: 'POST',
                dataType: 'json',
                data: matricula
            })
            .done(function(respuesta) {
                console.log(respuesta);
                aux = respuesta.apellido_p + ' ' + respuesta.apellido_m + ' ' + respuesta.nombre;
                aux = $.toTitleCase(aux);
                $("#nombre-usr").html(aux);

                $('#matricula').html("<b>Matr&iacute;cula: </b>" + respuesta.matricula.toString() + "<br>");
                $('#nombre').html("<b>Nombre: </b>" + aux + "<br>");
                $('#semestre').html("<b>Semestre: </b>" + respuesta.semestre.toString() + "<br>");
                $('#edad').html("<b>Edad: </b>" + respuesta.edad.toString() + "<br>");
                aux = (respuesta.sexo == 'M') ? "Mujer" : "Hombre"
                $('#sexo').html("<b>Sexo: </b>" + aux + "<br>");
                $('#facultad').html("<b>Facultad: </b>" + $.toTitleCase(respuesta.nombre_facultad) + "<br>");
                $('#carrera').html("<b>Carrera: </b>" + $.toTitleCase(respuesta.nombre_carrera) + "<br>");
                $('#plan').html("<b>Plan de estudios: </b>" + respuesta.id_plan.toString() + "<br>");

                for (i = 0; i < 2; i++) {
                    if (respuesta.tipo_usuario == 1) {
                        $('#profile-op-' + i).attr('disabled', 'disabled');
                        $('#profile-op-' + i).attr('style', 'opacity: 0.6; pointer-events: none;');
                        $('#prof-btn-cont-' + i).attr('data-toggle', 'popover');
                        $('#prof-btn-cont-' + i).attr('data-content', 'Debes ser asesor para usar estas opciones');
                        $('#prof-btn-cont-' + i).attr('data-trigger', 'hover');
                        $('[data-toggle="popover"]').popover({});
                    } else {
                        $('#profile-op-' + i).removeAttr('disabled');
                        $('#profile-op-' + i).attr('style', 'opacity: 1; pointer-events: auto;');
                    }
                }
            })
            .fail(function(respuesta) {
                console.log(respuesta.responseText);
            })
            .always(function(respuesta) {
                console.log("complete");
            });
    }

    $.getSchedule = function(matricula, esAjeno, soyAsesor) {
        $('#table-cont').empty();
        var inicio = [],
            fin = [];
        var tableCont = '<div id="sch-table" class="table">'
        var headRow = ['Hora', 'Lunes', 'Martes', 'M&iacute;ercoles',
            'Jueves', 'Viernes', 'S&aacute;bado'
        ];
        for (i = 0; i < 14; i++) {
            tableCont += '<div class="table-row">';
            for (j = 0; j < 7; j++) {
                tableCont += ('<div class="table-cell" id="' + i + '-' + j + '">');
                if (i == 0)
                    tableCont += ('<b>' + headRow[j] + '</b>');
                if (j == 0 && i > 0)
                    tableCont += ('<b>' + (i + 7).toString() + ':00' + '-' + (i + 8).toString() + ':00' + '</b>');
                tableCont += '</div>'
            }
            tableCont += '</div>'
        }
        tableCont += '</div>';

        $('#table-cont').append(tableCont).trigger('update');

        jQuery.ajax({
                url: '../php/getSchedule.php',
                type: 'POST',
                dataType: 'json',
                data: matricula
            })
            .done(function(respuesta) {
                var length = respuesta.row.length;
                $.each(respuesta.row, function(i) {
                    inicio.push([
                        i,
                        respuesta.row[i].data.id_materia, [
                            respuesta.row[i].data.hora_inicio_1,
                            respuesta.row[i].data.hora_inicio_2,
                            respuesta.row[i].data.hora_inicio_3,
                            respuesta.row[i].data.hora_inicio_4,
                            respuesta.row[i].data.hora_inicio_5,
                            respuesta.row[i].data.hora_inicio_6,
                        ]
                    ]);
                    fin.push([
                        i,
                        respuesta.row[i].data.id_materia, [
                            respuesta.row[i].data.hora_fin_1,
                            respuesta.row[i].data.hora_fin_2,
                            respuesta.row[i].data.hora_fin_3,
                            respuesta.row[i].data.hora_fin_4,
                            respuesta.row[i].data.hora_fin_5,
                            respuesta.row[i].data.hora_fin_6,
                        ]
                    ]);

                    var id = { 'id': respuesta.row[i].data.id_materia };

                    jQuery.ajax({
                            url: '../php/getSubject.php',
                            type: 'POST',
                            dataType: 'json',
                            data: id
                        })
                        .done(function(datos) {
                            sessionStorage.setItem(id.id.toString(), datos.nombre);
                            var nombres = { 'nombre': datos.nombre.toString() };
                            inicio[i].push(nombres);
                        })
                        .fail(function(datos) {
                            console.log(datos.responseText);
                        })
                        .always(function(datos) {});
                });

                for (i = 1; i < 14; i++) {
                    for (j = 1; j < 7; j++) {
                        var selector = '#' + i.toString() + '-' + j.toString();
                        if (soyAsesor) {
                            $(selector).addClass('btn hr-btn');
                            $(selector).attr('type', 'checkbox');
                            $(selector).attr('data-state', '0'); //0 libre, 1 reservado
                        }
                        for (k = 0; k < length; k++) {
                            var horaI = inicio[k][2][j - 1].split(':');
                            horaI = parseInt(horaI[0]);
                            var horaF = fin[k][2][j - 1].split(':');
                            horaF = parseInt(horaF[0]);
                            if (horaI != 0) {
                                for (horaI; horaI < horaF; horaI++)
                                    if (i + 7 == horaI) {
                                        if (esAjeno)
                                            $(selector).text('Ocupado');
                                        else
                                            $(selector).text($.toTitleCase(sessionStorage.getItem(inicio[k][1].toString())));
                                        $(selector).attr('class', 'table-cell-reserved subject').trigger('update');
                                        // $(selector).removeAttr('type');
                                        // $(selector).removeClass('btn hr-btn');
                                    }
                            }
                        }
                    }
                }
            })
            .fail(function(respuesta) {
                console.log(respuesta.responseText);
            })
            .always(function(respuesta) {});

        //agregar parte que identifica horas reservadas, mostrar ocupado para asesorado y reservada para asesor
        jQuery.ajax({
                url: '../php./getReservedHrs.php',
                type: 'POST',
                dataType: 'json',
                data: matricula
            })
            .done(function(respuesta) {
                console.log(respuesta);
                console.log('done');
                for (i = 0; i < respuesta.datos.length; i++) {
                    var cellId = '#' + (respuesta.datos[i].data.hora - 7) + '-' + respuesta.datos[i].data.dia;
                    if (esAjeno)
                        $(cellId).text('Ocupado');
                    else
                        $(cellId).text('Reservada');
                    $(cellId).addClass('table-cell-reserved subject').trigger('update');
                }
            })
            .fail(function(respuesta) {
                console.log('fail');
                console.log(respuesta);
            })

    }
})