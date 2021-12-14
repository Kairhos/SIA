$(document).ready(function() {
    var matricula = { "matricula": sessionStorage.getItem("matricula") };
    //we will auto-triggering js function
    //to refresh once after first load


    jQuery.ajax({
            url: '../php/getMyType.php',
            type: 'POST',
            dataType: 'json',
            data: matricula
        })
        .done(function(respuesta) {
            console.log(respuesta);
            if (respuesta.tipo == 2)
                sessionStorage.setItem('miTipo', true);
            else if (respuesta.tipo == 1)
                sessionStorage.setItem('miTipo', false);
        })
        .fail(function() {
            console.log('paso algo malo');
        });
    var miTipo = (sessionStorage.getItem('miTipo') === 'true' ? true : false);
    console.log(miTipo);

    $.getSchedule(matricula, false, miTipo);

    $('body').on('click', '.hr-btn', function() {
        var temp = $(this).attr('id').split('-');
        var hour = parseInt(temp[0]) + 7;
        var day = parseInt(temp[1]);
        temp = {
            'matricula': parseInt(sessionStorage.getItem('matricula')),
            'hora': hour,
            'dia': day
        }
        console.log(temp)
        if ($(this).attr('data-state') == '0') {
            $(this).attr('data-state', '1');
            $(this).addClass('table-cell-reserved');
            $(this).removeClass('table-cell');
            $(this).text('Reservada');
            jQuery.ajax({
                    url: '../php/addReservedHr.php',
                    type: 'POST',
                    dataType: 'json',
                    data: temp
                })
                .done(function(respuesta) {
                    console.log('done');
                    console.log(respuesta);
                })
                .fail(function(respuesta) {
                    console.log('fail');
                    console.log(respuesta);
                });
        } else {
            $(this).attr('data-state', '0');
            $(this).addClass('table-cell');
            $(this).removeClass('table-cell-reserved');
            $(this).text('');
            jQuery.ajax({
                    url: '../php/removeReservedHr.php',
                    type: 'POST',
                    dataType: 'json',
                    data: temp
                })
                .done(function(respuesta) {
                    console.log('done');
                    console.log(respuesta);
                })
                .fail(function(respuesta) {
                    console.log('fail');
                    console.log(respuesta);
                });
        }
    });


    (function() {
        if (window.localStorage) {
            //check if reloaded once already 
            if (!localStorage.getItem('firstLoad')) {
                //if not reloaded once, then set firstload to true
                localStorage['firstLoad'] = true;
                //reload the webpage using reload() method
                window.location.reload(true);
            } else
                localStorage.removeItem('firstLoad');
        }
    })();
});