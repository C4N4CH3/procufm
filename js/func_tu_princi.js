$(function () {
    
    $('.carrera').change(function (){
            $.post("includes/controlador_menu.php", {opc: 'mencion',car:$(this).val()},
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
            nombre: {
                required: true
            },
            apellido: {
                required: true
            },
            cedula: {
                required: true,
                number: true
            },
            nombreusuario: {
                required: true,
                minlength: 4,
                maxlength: 10
            },
            carrera: {
                required: true
            },
            mencion: {
                required: true
            },
            area_trabajo: {
                required: true
            },
            telefono: {
                required: true,
                number: true
            },
            email: {
                required: true,
                email: true
            },
            clave: {
                required: true,
                minlength: 4,
                maxlength: 8
            },
            reclave: {
                required: true,
                minlength: 4,
                maxlength: 8,
                equalTo: "#clave"
            }            
        },
        messages: {
            nombre: {
                required: "Campo requerido."
            },
            apellido: {
                required: "Campo requerido."
            },
            cedula: {
                required: "Campo requerido.",
                number: "El campo tiene que ser numerico"
            },
            nombreusuario: {
                required: "Campo requerido.",
                minlength: "El usuario debe tener un minimo de 4 caracteres.",
                maxlength: "el usuario debe tener un máximo de 10 caracteres."
            },
            carrera: {
                required: "Campo requerido."
            },
            mencion: {
                required: "Campo requerido."
            },
            area_trabajo: {
                required: "Campo requerido."
            },
            telefono: {
                required: "Campo requerido.",
                number: "El campo tiene que ser numerico"
            },
            email: {
                required: "Campo requerido.",
                email: "Debe ingresar un e-mail válido."
            },
            clave: {
                required: "Campo requerido.",
                minlength: "El usuario debe tener un minimo de 4 caracteres.",
                maxlength: "el usuario debe tener un máximo de 8 caracteres."
            },
            reclave: {
                required: "Campo requerido.",
                minlength: "El usuario debe tener un minimo de 4 caracteres.",
                maxlength: "el usuario debe tener un máximo de 8 caracteres.",
                equalTo : "No coincide con la clave"
            }            
        }
    });
});    


