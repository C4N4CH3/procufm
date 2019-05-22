$(function () {
    $('#form1').validate({
        onclick: false,
        onfocusout: false,
        debug: true,
        rules: {
            pregunta: {
                required: true
            },
            respuesta: {
                required: true
            }
        },
        messages: {
            pregunta: {
                required: "Seleccione la pregunta"
            },
            respuesta: {
                required: "Ingrese la respuesta"
            }
        },
        errorPlacement: function (error, element) {
            /*error.insertAfter(element);             
            element.css('outline', 'solid 1px red');*/
            alert(error.html());             
        },
        submitHandler: function(form) {
            confirmar = confirm("¿Seguro que desea Guardar?");
            if (confirmar) { 
                valores = ({id: $("#id").val(),
                            pre: $("#pregunta").val(),
                            res: $("#respuesta").val()
                        });
                $.post("../includes/controlador_menu.php", {opc: 'guardarPregunta', valores: valores},
                function (data) {
                    alert(data);
                    var idgrupo = $("#id_grupo").val(); 
                    if(idgrupo==1){
                        location.href="../estudiante/sesionestudiante.php";
                    }else if(idgrupo==5){
                        location.href="../tutor/sesiontutoracademico.php";
                    } 
                });
            } else {
                return false;
            }
        }
    });
});  