// JavaScript Document
$(document).ready(function () {   
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
});

function eliminar(id){    
    confirmar = confirm("¿Seguro que Desea eliminar?");
    if (confirmar) {
        $.post("../includes/controlador_menu.php", {opc: 'eliTutor', id: id},
        function (data) {
            alert(data);

            /*blanquear variables*/
            
            $("#nombre").val('');
            $("#apellido").val('');
            $("#cedula").val('');
            $("#nombreusuario").val('');
            $("#clave").val('');
            $("#reclave").val('');
            $("#email").val('');            
            $("#area_trabajo").val('');
            $("#telefono").val('');
            $("#carrera").val('');
            $("#mencion").val('');
            location.reload();
        });
    } else {
        return false;
    }    
}


function tablefilter(table_selector, input_selector, search_level, colspan) {

        var table = $(table_selector);
        if(table.length == 0)
                return;

        var input = $(input_selector);
        if(input.length == 0)
                return;

        if(search_level == "undefined" || search_level < 1)
                search_level = 3;

        if(colspan == "undefined" || colspan < 0)
                colspan = 2;

        $(input).val("Filtrar…");

        $(input).focus(function() {
                if($(this).val() == "Filtrar…") {
                        $(this).val("");
                }
                $(this).select();
        });

        $(input).blur(function() {
                if($(this).val() == "") {
                        $(this).val("Filtrar…");
                }
        });

        $(input).keyup(function() {
			if($(this).val().length >= search_level) {
				// Ocultamos las filas que no contienen el contenido del edit.
				var existe = $(table).find("tbody tr").not(":contains(\"" + $(this).val() + "\")").hide("slow");
				
				//if(existe.length==0)
									
				// Si no hay resultados, lo indicamos.
				if($(table).find("tbody tr:visible").length <= 0) {			
					$("tbody tr.botonGuar").hide();
					$(table).find("tbody:first").append('<tr id="noresults" class="aligncenter"><td colspan="' + colspan + '">Lo siento pero no hay resultados para la búsqueda indicada.</td></tr>');
				}
			} else{
					// Borramos la fila de que no hay resultados.
					$(table).find("tbody tr#noresults").remove();
					
					// Mostramos todas las filas.
					$(table).find("tbody tr").show();
					/*$("tbody tr.botonGuar").show();*/
			}			
        });
}

jQuery.expr[':'].contains = function(a, i, m) {
        return jQuery(a).text().toUpperCase().indexOf(m[3].toUpperCase()) >= 0; 
};

$(function() {
    tablefilter("table#mi_tabla", "table thead tr input#filtrar", 2, 2);
});


$(function () {
    $('#form1').validate({
        onclick: false, // <-- add this option
        onfocusout: false,
        onkeyup: false,
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
                required: "Nombre"
            },
            apellido: {
                required: "Apellido"
            },
            cedula: {
                required: "Cedula",
                number: "El campo tiene que ser numerico"
            },
            nombreusuario: {
                required: "Nombre Usuario",
                minlength: "El usuario debe tener un minimo de 4 caracteres.",
                maxlength: "el usuario debe tener un máximo de 10 caracteres."
            },
            carrera: {
                required: "Carrera"
            },
            mencion: {
                required: "Mencion"
            },
            area_trabajo: {
                required: "Area de trabajo"
            },
            telefono: {
                required: "Telefono",
                number: "El campo tiene que ser numerico"
            },
            email: {
                required: "Email",
                email: "Debe ingresar un e-mail válido."
            },
            clave: {
                required: "Clave",
                minlength: "El usuario debe tener un minimo de 4 caracteres.",
                maxlength: "el usuario debe tener un máximo de 8 caracteres."
            },
            reclave: {
                required: "Confirmar clave",
                minlength: "El usuario debe tener un minimo de 4 caracteres.",
                maxlength: "el usuario debe tener un máximo de 8 caracteres.",
                equalTo : "No coincide con la clave"
            }            
        },
        errorPlacement: function (error, element) {
            /*error.insertAfter(element);             
            element.css('outline', 'solid 1px red');*/
            alert(error.html());             
        },
        
    });
});    