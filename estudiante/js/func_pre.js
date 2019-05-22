$(function () {
    
    $('.carrera').change(function (){
            $.post("../includes/controlador_menu.php", {opc: 'mencion',car:$(this).val()},
            function(data){
                var $op="";
                /*alert(data);*/
                var dataJson = eval(data);
                $op += '<option value="">SELECCIONE</option>';
                for(var i in dataJson){
                  $op += '<option value="'+dataJson[i].id_mencion+'">'+dataJson[i].nombre_mencion+'</option>';
                }
                $('.mencion').html($op);
            });
        });
    
    $('#form1').validate({
        rules: {
            carnet: {
                required: true
            },
            direccion: {
                required: true
            },
            fechaNacimiento: {
                required: true
            },
            sexo: {
                required: true
            },
            carrera: {
                required: true
            },
            mencion: {
                required: true
            },
            creditosaprobados: {
                required: true
            },
            ira: {
                required: true
            },
            turno: {
                required: true
            },
            semestre: {
                required: true
            },
            telefonohab: {
                required: true
            },
            telefonocel: {
                required: true
            },
            trabajo: {
                required: true
            }
        },
        messages: {
            carnet: {
                required: "Campo requerido."
            },
            direccion: {
                required: "Campo requerido."
            },
            fechaNacimiento: {
                required: "Campo requerido."
            },
            sexo: {
                required: "Campo requerido."
            },
            carrera: {
                required: "Campo requerido."
            },
            mencion: {
                required: "Campo requerido."
            },
            creditosaprobados: {
                required: "Campo requerido."
            },
            ira: {
                required: "Campo requerido."
            },
            turno: {
                required: "Campo requerido."
            },
            semestre: {
                required: "Campo requerido."
            },
            telefonohab: {
                required: "Campo requerido."
            },
            telefonocel: {
                required: "Campo requerido."
            },
            trabajo: {
                required: "Campo requerido."
            }
        }
    });
});    


$(document).ready(function(){
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
            dateFormat: 'yy-mm-dd',
            firstDay: 1,
            isRTL: false,
            showMonthAfterYear: false,
            yearSuffix: ''
        };
    $.datepicker.setDefaults($.datepicker.regional['es']);
    $(".datepicker").datepicker({
            changeYear: true,
            yearRange: '-100:+0'
        });
        
    $('#empleos').click(function(){
            $("#nombre_empleo").removeAttr('disabled');
            $("#cargo_empleo").removeAttr('disabled');
            $("#telefono_empleo").removeAttr('disabled');
            $("#email_empleo").removeAttr('disabled');
        });
    
    $("#emplon").click(function(){
                $("#nombre_empleo").attr('disabled', 'true');
                $("#cargo_empleo").attr('disabled', 'true');
                $("#telefono_empleo").attr('disabled', 'true');
                $("#email_empleo").attr('disabled', 'true');
        });
});