$(function () {
    $('#form1').validate({
        rules: {
            respuesta: {
                required: true
            }
        },
        messages: {
            respuesta: {
                required: "Campo requerido."
            }
        },
        submitHandler: function(form) {
            valores = ({respuesta: $("#respuesta").val(),
                id_usuario: $("#id_usuario").val()
            });
            $.post("includes/controlador_menu.php", {opc: 'verificarPregunta', valores: valores},
            function (data) {
                alert(data);
                /*var html='';
                html += data;                
                $("#resultado_pregunta").html(html);*/                
            });
        }
    });
}); 