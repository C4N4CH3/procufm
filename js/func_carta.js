$(function () {   
    $('#form1').validate({
        rules: {
            fecha_actual: {
                required: true
            },
            nombre_centro: {
                required: true
            },
            carta_dirigida: {
                required: true
            },
            cargo_asignado: {
                required: true
            },
            telefono: {
                required: true
            }
        },
        messages: {
            fecha_actual: {
                required: "Campo requerido."
            },
            nombre_centro: {
                required: "Campo requerido."
            },
            carta_dirigida: {
                required: "Campo requerido."
            },
            cargo_asignado: {
                required: "Campo requerido."
            },
            telefono: {
                required: "Campo requerido."
            },
            mencion: {
                required: "Campo requerido."
            }
        }
    });
}); 


$(document).ready(function () {
    $.datepicker.regional['es'] = {
        closeText: 'Cerrar',
        prevText: '<Ant',
        nextText: 'Sig>',
        currentText: 'Hoy',
        monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
        dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
        dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Juv', 'Vie', 'Sáb'],
        dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sá'],
        weekHeader: 'Sm',
        dateFormat: 'dd-mm-yy',
        firstDay: 1,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: ''
    };
    $.datepicker.setDefaults($.datepicker.regional['es']);
    $(".datepicker").datepicker();

});
