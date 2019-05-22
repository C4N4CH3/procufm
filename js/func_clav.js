$(function () {
    $('#form1').validate({
        rules: {
            con_actual: {
                required: true
            },
            con_nva: {
                required: true,
                minlength: 4,
                maxlength: 8
            },
            re_con_nva: {
                required: true,
                minlength: 4,
                maxlength: 8,
                equalTo: "#con_nva"
            }
        },
        messages: {
            con_actual: {
                required: "Campo requerido."
            },
            con_nva: {
                required: "Campo requerido.",
                minlength: "El usuario debe tener un minimo de 4 caracteres.",
                maxlength: "el usuario debe tener un máximo de 8 caracteres."
            },
            re_con_nva: {
                required: "Campo requerido.",
                minlength: "El usuario debe tener un minimo de 4 caracteres.",
                maxlength: "El usuario debe tener un máximo de 8 caracteres.",
                equalTo : "No coincide con la clave"
            }
        },
        submitHandler: function(form){
            
            // var valores = 'con_actual='+$('#con_actual').val()+'&con_nva='+$('#con_nva').val()+'&re_con_nva='+$('#re_con_nva').val()+$('#usuario').val();
            
            valores = ({usuario: $("#usuario").val(),
                con_actual: $("#con_actual").val(),
                con_nva:$("#con_nva").val(),
                re_con_nva:$("#re_con_nva").val()
            });
                
            
            $.post("../includes/controlador_menu.php", {opc: 'cambioClave', valores: valores},
            function (data) {   
                /*alert(data);*/
                $("#con_actual").val('');
                $("#con_nva").val('');
                $("#re_con_nva").val('');
                $("#usuario").val('');
                /*location.reload();*/
                $("#resultado").html(data);
            }); 
        }
    });
});


/*
function actualizar(id){    
    confirmar = confirm("¿Seguro que Desea eliminar?");
    if (confirmar) {
        $.post("../includes/controlador_menu.php", {opc: 'eliAlumno', id: id},
        function (data) {
            alert(data);
            
            $("#nombre").val('');
            $("#apellido").val('');
            $("#cedula").val('');
            $("#nombreusuario").val('');
            $("#clave").val('');
            $("#reclave").val('');
            $("#email").val('');            

            location.reload();
        });
    } else {
        return false;
    }    
}*/
