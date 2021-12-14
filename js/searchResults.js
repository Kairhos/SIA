$(document).ready(function() {
    var materia = sessionStorage.getItem('idMateria');
    console.log(materia);

    jQuery.ajax({
            url: '../php/searchResults.php',
            type: 'POST',
            dataType: 'json',
            data: { 'idMat': parseInt(materia) }
        })
        .done(function(respuesta) {
            $('#table-cont').empty();
            var j = 0;
            do {
                $('#table-cont').prepend('<div class="table-row">');
                for (i = 0; i < respuesta.datos.length; i++) {
                    var newResult = '<div id="item-' + respuesta.datos[i].data.matricula +
                        '" class="table-cell btn" style="width:auto;">';
                    newResult += '<div class="card" style="width:14rem;">' +
                        '<img src="' + respuesta.datos[i].data.ruta + '" class="card-img-top">';
                    newResult += '<div class="card-body">' +
                        '<h5 class="card-tittle">' + respuesta.datos[i].data.matricula + '</h5>';
                    newResult += '<p class="card-text">' + $.toTitleCase(respuesta.datos[i].data.nombre) + '</p>';
                    newResult += '</div></div></div>';
                    $('#table-cont').children().last().append(newResult).trigger('update');
                }
                j++;
            } while (j < (parseInt(respuesta.datos.length / 4)) + 1)
        })
        .fail(function(respuesta) {
            console.log('fail');
        });

    $('body').on('click', '.table-cell', function() {
        var matAsr = $(this).attr('id').split('-')[1];
        if (matAsr == sessionStorage.getItem('matricula'))
            $(location).attr('href', 'myProfile.php');
        else {
            sessionStorage.setItem('consultantMat', matAsr);
            $(location).attr('href', 'consultantProfile.php');
        }
    });
});