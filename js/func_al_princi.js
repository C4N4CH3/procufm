// JavaScript Document
$(function () {
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
                maxlength: "El usuario debe tener un máximo de 8 caracteres.",
                equalTo : "No coincide con la clave"
            }

            /*fecha : {
             required : "Debe ingresar el e-mail.",
             email : "Debe ingresar un e-mail válido."
             },
             my_name : {
             required : "Debe ingresar un nombre.",
             minlength : "El nombre debe tener un minimo de 2 caracteres.",
             maxlength : "el nombre debe tener un máximo de 9 caracteres."
             }*/
        }
    });
});  