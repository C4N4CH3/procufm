$(function () {
    $('#form1').validate({
        rules: {
            email: {
                required: true
            },
            ci: {
                required: true
            }
        },
        messages: {
            email: {
                required: "Campo requerido."
            },
            ci: {
                required: "Campo requerido."
            }
        }
    });
}); 

$(function () {
    $('#formprinci').validate({
        rules: {
            nombreusuario: {
                required: true
            },
            clave: {
                required: true
            }
        },
        messages: {
            nombreusuario: {
                required: "Campo requerido."
            },
            clave: {
                required: "Campo requerido."
            }
        }
    });
}); 