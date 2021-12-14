$(document).ready(function() {
    $('body').on('click', '.search-suggest-btn', function() {
        var btnid = $(this).attr('id');

        if (btnid.toString().length > 5) {
            if (sessionStorage.getItem('matricula') != btnid) {
                sessionStorage.setItem('consultantMat', parseInt(btnid));
                $(location).attr('href', 'consultantProfile.php');
            } else
                $(location).attr('href', 'myProfile.php');
        } else {
            sessionStorage.setItem('idMateria', parseInt(btnid));
            $(location).attr('href', 'searchResults.php');
        }
    });

    $('#search-input').keyup(function() {
        if ($('#search-input').val() != '') {
            $('#search-suggest-cont').removeClass('search-suggest-cont-hidden');
            var data = { 'search': $('#search-input').val().toLowerCase() };
            jQuery.ajax({
                    url: '../php/search.php',
                    type: 'POST',
                    dataType: 'json',
                    data: data
                })
                .done(function(respuesta) {
                    console.log(respuesta);
                    if (respuesta.error == false) {
                        $('#search-suggest-cont').html('');

                        var mats = [],
                            ids = [];
                        $.each(respuesta.resultado, function(i) {
                            var name = respuesta.resultado[i].data.nombre.toLowerCase();
                            var id = respuesta.resultado[i].data.matricula;
                            var mat = respuesta.resultado[i].data.materia.toLowerCase();
                            var clv = respuesta.resultado[i].data.id_materia;

                            if (ids.indexOf(id) == -1 || mats.indexOf(clv) == -1) {
                                var suggest = '';
                                var idLocal;
                                if (respuesta.resultado[i].data.estado && ids.indexOf(id) == -1 && (name.includes(data.search) || id.toString().includes(data.search))) {
                                    idLocal = id.toString();
                                    suggest += id.toString() + ' : ' + $.toTitleCase(name);
                                    ids.push(id);
                                    suggest = ('<div class="search-suggest-option"><a id="' + idLocal + '" href="#" class="search-suggest-btn">' +
                                        suggest + '</a></div>');
                                    $('#search-suggest-cont').append(suggest);
                                } else if (mats.indexOf(clv) == -1 && (clv.toString().includes(data.search) || mat.includes(data.search))) {
                                    idLocal = clv.toString();
                                    suggest += clv.toString() + ' : ' + $.toTitleCase(mat);
                                    mats.push(clv);
                                    suggest = ('<div class="search-suggest-option"><a id="' + idLocal + '" href="#" class="search-suggest-btn">' +
                                        suggest + '</a></div>');
                                    $('#search-suggest-cont').append(suggest);
                                }
                            }
                        })
                    } else {
                        $('#search-suggest-cont').addClass('search-suggest-cont-hidden');
                        $('#search-suggest-cont').html('');
                    }
                })
                .fail(function(respuesta) {

                })
                .always(function(respuesta) {

                });
        } else {
            $('#search-suggest-cont').addClass('search-suggest-cont-hidden');
            $('#search-suggest-cont').html('');
        }
    });
});