// JavaScript Document
function nuevo(id,ira){
    /*alert(enviada);*/
    $(document).ready(function () {    
        $("#todosreg").hide();
        $(".oculto").show();
        valores = ({id_al:id,
                    ira_al:ira
                });
        
        $.post("../includes/controlador_menu.php", {opc: 'cargaIra',valores: valores},
         function(data){ 
            $("input:hidden[name=id_al_hidden]").val(id);
            $("#mi_tabla2").html(data);
        });
    });
}


function editar(id,ira){
    /*alert(enviada);*/
    $(document).ready(function () {    
        $("#todosreg").hide();
        $(".oculto").show();     
        
        valores = ({id_al:id,
                    ira_al:ira
                });
                
        $.post("../includes/controlador_menu.php", {opc: 'cargaIra',valores: valores},
         function(data){ 
            $("#id_al_hidden").val(id);
            $("#mi_tabla2").html(data);
        });
                
        $.post("../includes/controlador_menu.php", {opc: 'cargaIns',id: id},
         function(data){
            /*alert(data);*/           
            dataJson=eval(data);              
            
            $("#id_al_hidden").val(id);
            $("#id_ins").val(dataJson[0].id_inscrito);
            
            var fe = dataJson[0].id_fecha;            
            $('input[name=seleccionfecha]:radio').each(function(){
                if ($(this).val() == fe) {           
                    $('#fecha_'+fe).attr("checked",true);
                }
            });                    
            
            if(dataJson[0].id_vacante_dep==0){    
                $("#nombre").val(dataJson[0].nombre_empresa);
            }else{
                $("#nombre").val(dataJson[0].nombre_emp);
            }
            
            $("#direccion").val(dataJson[0].direccion_empresa);
            $("#telefono").val(dataJson[0].telefono_empresa);
            $("#responsable").val(dataJson[0].jefe_responsable);            
            $("#cargo").val(dataJson[0].cargo_jefe);
            $("#telresponsable").val(dataJson[0].telefono_jefe);
            $("#emailresponsable").val(dataJson[0].email_jefe); 
            $("#area").val(dataJson[0].area_pasantia);
            $("#horario").val(dataJson[0].horario);           
            
            var centro = dataJson[0].obtencion_centro;          
            
            if(centro=='trabaja alli'){
                $('#obtener1').attr("checked",true); 
            }
            if(centro=='gestion propia'){
                $('#obtener2').attr("checked",true);
            }
            if(centro=='dpto pasantia'){
                $('#obtener3').attr("checked",true);
            }
            if(centro=='otro'){
                $('#obtener4').attr("checked",true);
            }            
            
            $("#nombretutor").val(dataJson[0].tutor_empresarial);
            $("#cargotutor").val(dataJson[0].cargo_tutor);
            $("#emailtutor").val(dataJson[0].email_tutor);
            $("#teletutor").val(dataJson[0].telefono_tutor);
        });  
        
    });
}



function eliminar(id){    
    $(document).ready(function () {
        confirmar = confirm("¿Seguro que Desea eliminar?");
        if (confirmar) {
            $.post("../includes/controlador_menu.php", {opc: 'eliminarIns', id: id},
            function (data) {
                alert(data);
                location.reload();
            });
        } else {
            return false;
        }

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
			
			/* BUENO CUALQUIER COSA BORRAR
				if($(this).val().length >= search_level) {
                        // Ocultamos las filas que no contienen el contenido del edit.
                        $(table).find("tbody tr.aeb").not(":contains(\"" + $(this).val() + "\")").hide("slow");
						
						// Si no hay resultados, lo indicamos.
                        if($(table).find("tbody tr.aeb:visible").length == 0) {
							$(table).find("tbody tr.botonGuar").hide();
                            $(table).find("tbody:first").append('<tr id="noresults" class="aligncenter"><td colspan="' + colspan + '">Lo siento pero no hay resultados para la búsqueda indicada.</td></tr>');
                        }
                } else {
                        // Borramos la fila de que no hay resultados.
                        $(table).find("tbody tr#noresults").remove();
						
						// Mostramos todas las filas.
						$(table).find("tbody tr.aeb").show();
						$(table).find("tbody tr.botonGuar").show();
                }
				hasta aqui*/				
        });
}

jQuery.expr[':'].contains = function(a, i, m) {
        return jQuery(a).text().toUpperCase().indexOf(m[3].toUpperCase()) >= 0; 
};

$(function() {
    tablefilter("table#mi_tabla", "table thead tr input#filtrar", 2, 2);
});


$(function() {
    
    $('#btnagregar').click(function(){
            confirmar=confirm("¿Desea guardar?"); 
            if (confirmar){ 
               return true;
            }else{
               return false;   
            }
        });
    
    $('#form1').validate({
        onclick: false, // <-- add this option
        onfocusout: false,
        rules: {
            nombre: {
                required: true
            },
            direccion: {
                required: true
            },
            telefono: {
                required: true
            },
            responsable: {
                required: true
            },
            cargo: {
                required: true
            },
            telresponsable: {
                required: true
            },
            emailresponsable: {
                required: true
            },
            area: {
                required: true
            },
            horario: {
                required: true
            },
            nombretutor: {
                required: true
            },
            cargotutor: {
                required: true
            },
            emailtutor: {
                required: true
            },
            teletutor: {
                required: true
            }
        },
        messages: {
            nombre: {
                required: "Ingrese Nombre"
            },
            direccion: {
                required: "Ingrese Direccion"
            },
            telefono: {
                required: "Ingrese Telefono"
            },
            responsable: {
                required: "Ingrese Responsable"
            },
            cargo: {
                required: "Ingrese Cargo Responsable"
            },
            telresponsable: {
                required: "Ingrese Telefono responsable"
            },
            emailresponsable: {
                required: "Ingrese Email Responsable"
            },
            area: {
                required: "Ingrese Area de trabajo"
            },
            horario: {
                required: "Ingrese Horario"
            },
            nombretutor: {
                required: "Ingrese Nombre Tutor Empresarial"
            },
            cargotutor: {
                required: "Ingrese Cargo Tutor Empresarial"
            },
            emailtutor: {
                required: "Ingrese Email Tutor Empresarial"
            },
            teletutor: {
                required: "Ingrese Telefono Tutor Empresarial"
            }
        },
        errorPlacement: function (error, element) {
            /*error.insertAfter(element); */            
            element.css('outline', 'solid 1px red');
            alert(error.html());             
        }
    });
});