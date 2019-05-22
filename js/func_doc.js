 

function postulacion(id_pre,id_doc){
    /*alert(enviada);*/
    $(document).ready(function () {    
        $("#todosreg").hide();
        $(".oculto").show();  
        
        $("#id_pre").val(id_pre);        
        $("#id_doc").val(id_doc);
        
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
        $(".datepicker").datepicker();   
    });
}


function permiso(id_pre){
    $(document).ready(function () {    
        /*$("#todosreg").hide();
        $(".oculto").show();    
        */
        /*valores = ({id_al:id,
                    ira_al:ira
                });
        */
        $.post("../includes/controlador_menu.php", {opc: 'guarPermiso',id: id_pre},
         function(data){              
            window.location="documentodepartamento_admin.php";
            alert(data);
        });
        
    });
}


function constancia(id_pre){
    $(document).ready(function () {    
        /*$("#todosreg").hide();
        $(".oculto").show();    
        */
        /*valores = ({id_al:id,
                    ira_al:ira
                });
        */
        $.post("../includes/controlador_menu.php", {opc: 'guarConstancia',id: id_pre},
         function(data){
            window.location="documentodepartamento_admin.php";
            alert(data);            
        });
        
    });
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

/*$(function () { 
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
});*/