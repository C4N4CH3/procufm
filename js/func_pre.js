// JavaScript Document
$(document).ready(function () {
    $('#btnagregar').click(function(){
     confirmar=confirm("¿Desea guardar?"); 
     if (confirmar){ 
        return true;
     }else{
        return false;   
     }
    });  
    
    $('#btnactualizar').click(function(){
     confirmar=confirm("¿Desea actualizar?"); 
     if (confirmar){ 
        return true;
     }else{
        return false;   
     }
    });
    
    $("#nvoform").click(function() {
        $("#todosreg").hide();
    }); 
    
});

function editarpreinscipcion(alumno){
    /*alert(alumno);*/
    $(document).ready(function () {    
        $(".oculto").show();     
        $("#todosreg").hide();        
        $("#btnagregar").hide();        
        
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
            dateFormat: 'dd-mm-yy',
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
                
        
        $.post("../includes/controlador_menu.php", {opc: 'cargaAl',idal: alumno},
         function(data){
            /*alert(data);*/           
            dataJson=eval(data);  
            
            $("#id_al").val(alumno);
            $("#ced_al").val(dataJson[0].cedula);
            
            $("#nom_al").html(dataJson[0].nombre+' '+dataJson[0].apellido);
            $("#cedula").html(dataJson[0].cedula);
            $("#email").html(dataJson[0].email);
            $("#carnet").val(dataJson[0].carnet);
            $("#direccion").val(dataJson[0].direccion_habitacion);
            
            
            fecha = dataJson[0].fecha_nacimiento
            trozo = fecha.split("-");
            fecha_nacimiento = trozo[2]+"-"+trozo[1]+"-"+trozo[0];
            $("#fechaNacimiento").val(fecha_nacimiento);
            
             if(dataJson[0].sexo==1){
                 $("#sexom").attr('checked', true);
             }else if(dataJson[0].sexo==2){
                 $("#sexof").attr('checked', true);
             }    
            $("#carrera").val(dataJson[0].id_carrera);
            $("#mencion").val(dataJson[0].id_mencion);
            $("#creditos_aprobados").val(dataJson[0].creditos_aprobados);
            $("#indice_academico").val(dataJson[0].indice_academico);
            $("#turno").val(dataJson[0].turno);
            $("#semestre").val(dataJson[0].semestre);
            $("#telefono_habitacion").val(dataJson[0].telefono_habitacion);
            $("#telefono_celular").val(dataJson[0].telefono_celular);
                        
             if(dataJson[0].empleo=='si'){
                $("#empleos").attr('checked', true);
                $("#nombre_empleo").val(dataJson[0].nombre_empleo);
                $("#cargo_empleo").val(dataJson[0].cargo_empleo);
                $("#telefono_empleo").val(dataJson[0].telefono_empleo);
                $("#email_empleo").val(dataJson[0].email_empleo);
             }else if(dataJson[0].empleo=='no'){
                $("#empleon").attr('checked', true);
                $("#nombre_empleo").attr('disabled', 'true');
                $("#cargo_empleo").attr('disabled', 'true');
                $("#telefono_empleo").attr('disabled', 'true');
                $("#email_empleo").attr('disabled', 'true');
             }          
            
           
        });        
        
    });
}

function nuevopreinscipcion(alumno){    
    $(document).ready(function () {    
        $(".oculto").show();     
        $("#todosreg").hide();        
        $("#btnactualizar").hide();
        
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
            dateFormat: 'dd-mm-yy',
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
                
        $.post("../includes/controlador_menu.php", {opc: 'cargaAl',idal: alumno},
         function(data){
            /*alert(data);*/           
            dataJson=eval(data);  
            /*PARA LLENAR CAMPOS IMPUT*/
            $("#id_al").val(alumno);
            $("#ced_al").val(dataJson[0].cedula);           
            
            $("#nom_al").html(dataJson[0].nombre+' '+dataJson[0].apellido);
            $("#cedula").html(dataJson[0].cedula);
            $("#email").html(dataJson[0].email);
            $("#carnet").val(dataJson[0].carnet);
            $("#direccion").val(dataJson[0].direccion_habitacion);
            
            fecha = dataJson[0].fecha_nacimiento
            trozo = fecha.split("-");
            fecha_nacimiento = trozo[2]+"-"+trozo[1]+"-"+trozo[0];
            $("#fechaNacimiento").val(fecha_nacimiento);
            
            /*$("#fechaNacimiento").val(dataJson[0].fecha_nacimiento);*/
            
             if(dataJson[0].sexo==1){
                 $("#sexom").attr('checked', true);
             }else if(dataJson[0].sexo==2){
                 $("#sexof").attr('checked', true);
             }    
            $("#carrera").val(dataJson[0].id_carrera);
            $("#mencion").val(dataJson[0].id_mencion);
            $("#creditos_aprobados").val(dataJson[0].creditos_aprobados);
            $("#indice_academico").val(dataJson[0].indice_academico);
            $("#turno").val(dataJson[0].turno);
            $("#semestre").val(dataJson[0].semestre);
            $("#telefono_habitacion").val(dataJson[0].telefono_habitacion);
            $("#telefono_celular").val(dataJson[0].telefono_celular);
                        
             if(dataJson[0].empleo=='si'){
                 $("#empleos").attr('checked', true);
             }else if(dataJson[0].empleo=='no'){
                 $("#empleon").attr('checked', true);
             }          
            $("#nombre_empleo").val(dataJson[0].nombre_empleo);
            $("#cargo_empleo").val(dataJson[0].cargo_empleo);
            $("#telefono_empleo").val(dataJson[0].telefono_empleo);
            $("#email_empleo").val(dataJson[0].email_empleo);
        }); 
        
        
        
    });
}


function eliminarpreinscripcion(alumno){    
    $(document).ready(function () {
        confirmar = confirm("¿Seguro que Desea eliminar?");
        if (confirmar) {
            $.post("../includes/controlador_menu.php", {opc: 'eliminarAl', idal: alumno},
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
    
    
    
    $('#empleos').click(function(){
            $("#nombre_empleo").removeAttr('disabled');
            $("#cargo_empleo").removeAttr('disabled');
            $("#telefono_empleo").removeAttr('disabled');
            $("#email_empleo").removeAttr('disabled');
        });
    
    $("#empleon").click(function(){
                $("#nombre_empleo").attr('disabled', 'true');
                $("#cargo_empleo").attr('disabled', 'true');
                $("#telefono_empleo").attr('disabled', 'true');
                $("#email_empleo").attr('disabled', 'true');
        });
    
    
    $('#form1').validate({
        onclick: false, // <-- add this option
        onfocusout: false,
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
                required: "Ingrese Carnet"
            },
            direccion: {
                required: "Ingrese Direccion"
            },
            fechaNacimiento: {
                required: "Ingrese Fecha Nacimiento"
            },
            sexo: {
                required: "Ingrese su Sexo"
            },
            carrera: {
                required: "Ingrese Carrera"
            },
            mencion: {
                required: "Ingrese Mencion"
            },
            creditosaprobados: {
                required: "Ingrese Ceditos Aprobados"
            },
            ira: {
                required: "Ingrese IRA"
            },
            turno: {
                required: "Ingrese Turno"
            },
            semestre: {
                required: "Ingrese Semestre"
            },
            telefonohab: {
                required: "Ingrese Telefono Habitacion"
            },
            telefonocel: {
                required: "Ingrese Telefono Celular"
            },
            trabajo: {
                required: "Ingrese Trabajo"
            }
        },
        errorPlacement: function (error, element) {
            /*error.insertAfter(element); */            
            element.css('outline', 'solid 1px red');
            alert(error.html());             
        }
    });
});    


