$(document).ready(function() {
    $(".main-option").click(function(e) {
        var options = ["myProfile", "mySchedule", "myConsultancies"];
        var id = this.id.split('-');
        $(location).attr('href', options[id[1]] + '.php');
    });

    $.toTitleCase = function(str) {
        return str.toLowerCase().split(' ').map(function(word) {
            return (word.charAt(0).toUpperCase() + word.slice(1));
        }).join(' ');
    }

    $.showAlertMsg = function(msg) {
        $('.msg-alert').children().html(msg)
        $('.msg-alert').slideDown('slow');
        setTimeout(function() {
            $('.msg-alert').slideUp('slow');
        }, 3000);
    }
});