// JavaScript Document
$(document).ready(function () {
    $("#nvoform").click(function() {
        $("#todosreg").hide();
    });
    /*$("#buscar_al").click(function() {
        alert("Bien");	
    });
     */
});

function editar(enviada){
    /*alert(enviada);*/
    $(document).ready(function () {    
        $(".oculto").show();     
        $("#todosreg").hide();   
        
        $.post("../includes/controlador_menu.php", {opc: 'cargarFormCro'},
            function (data) {
                /*alert(data);*/
                $("#mi_form").html(data);
                
                $.datepicker.regional['es'] = {
                        closeText: 'Cerrar',
                        prevText: '<Ant',
                        nextText: 'Sig>',
                        currentText: 'Hoy',
                        monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                        monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
                        dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
                        dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
                        dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
                        weekHeader: 'Sm',
                        dateFormat: 'dd-mm-yy',
                        firstDay: 1,
                        isRTL: false,
                        showMonthAfterYear: false,
                        yearSuffix: ''
                };
                $.datepicker.setDefaults($.datepicker.regional['es']);	
                $( ".datepicker" ).datepicker();
                
                /* PARA LAS VALIDACIONES */
                $(function () {
                    $('#form1').validate({
                        rules: {
                            cod_lapso: {
                                required: true
                            },
                            reunion_diurno: {
                                required: true
                            },
                            reunion_vesper: {
                                required: true
                            },
                            reunion_nocturno: {
                                required: true
                            },
                            fecha_preinscripcion: {
                                required: true
                            },
                            cod_lap: {
                                required: true
                            },
                            fecha_tci1: {
                                required: true
                            },
                            fecha_tcc1: {
                                required: true
                            },
                            fecha_if1: {
                                required: true
                            },
                            fecha_tci2: {
                                required: true
                            },
                            fecha_tcc2: {
                                required: true
                            },
                            fecha_if2: {
                                required: true
                            },
                            fecha_tci3: {
                                required: true
                            },
                            fecha_tcc3: {
                                required: true
                            },
                            fecha_if3: {
                                required: true
                            },
                            fecha_tci4 : {
                                required: true
                            },
                            fecha_tcc4: {
                                required: true
                            },
                            fecha_if4: {
                                required: true
                            },
                            fecha_mti1: {
                                required: true
                            },
                            fecha_mtc1: {
                                required: true
                            },
                            fecha_mtif: {
                                required: true
                            },
                            fecha_li1: {
                                required: true
                            },
                            fecha_lc1: {
                                required: true
                            },
                            fecha_lif1: {
                                required: true
                            },
                            fecha_li2: {
                                required: true
                            },
                            fecha_lc2: {
                                required: true
                            },
                            fecha_lif2: {
                                required: true
                            },
                            fecha_li3: {
                                required: true
                            },
                            fecha_lc3: {
                                required: true
                            },
                            fecha_lif3: {
                                required: true
                            }
                        },
                        messages: {
                            cod_lapso: {
                                required: "Campo requerido."
                            },
                            reunion_diurno: {
                                required: "Campo requerido."
                            },
                            reunion_vesper: {
                                required: "Campo requerido."
                            },
                            reunion_nocturno: {
                                required: "Campo requerido."
                            },
                            fecha_preinscripcion: {
                                required: "Campo requerido."
                            },
                            cod_lap: {
                                required: "Campo requerido."
                            },
                            fecha_tci1: {
                                required: "Campo requerido."
                            },
                            fecha_tcc1: {
                                required: "Campo requerido."
                            },
                            fecha_if1: {
                                required: "Campo requerido."
                            },
                            fecha_tci2: {
                                required: "Campo requerido."
                            },
                            fecha_tcc2: {
                                required: "Campo requerido."
                            },
                            fecha_if2: {
                                required: "Campo requerido."
                            },
                            fecha_tci3: {
                                required: "Campo requerido."
                            },
                            fecha_tcc3: {
                                required: "Campo requerido."
                            },
                            fecha_if3: {
                                required: "Campo requerido."
                            },
                            fecha_tci4 : {
                                required: "Campo requerido."
                            },
                            fecha_tcc4: {
                                required: "Campo requerido."
                            },
                            fecha_if4: {
                                required: "Campo requerido."
                            },
                            fecha_mti1: {
                                required: "Campo requerido."
                            },
                            fecha_mtc1: {
                                required: "Campo requerido."
                            },
                            fecha_mtif: {
                                required: "Campo requerido."
                            },
                            fecha_li1: {
                                required: "Campo requerido."
                            },
                            fecha_lc1: {
                                required: "Campo requerido."
                            },
                            fecha_lif1: {
                                required: "Campo requerido."
                            },
                            fecha_li2: {
                                required: "Campo requerido."
                            },
                            fecha_lc2: {
                                required: "Campo requerido."
                            },
                            fecha_lif2: {
                                required: "Campo requerido."
                            },
                            fecha_li3: {
                                required: "Campo requerido."
                            },
                            fecha_lc3: {
                                required: "Campo requerido."
                            },
                            fecha_lif3: {
                                required: "Campo requerido."
                            }            
                        }
                    });
                });  /* FIN DE VALIDACIONES*/
        });    
        
        $.post("../includes/controlador_menu.php", {opc: 'cargaCro',id: enviada},
         function(data){          
            dataJson=eval(data);
            $("#id").val(enviada);
            $("#id_fe_ev").val(dataJson[0].id_fecha_evento);
            $("#cod_lapso").val(dataJson[0].codigo_lapso);
            
            fecha = dataJson[0].fecha_diurna
            trozo = fecha.split("-");
            fecha_diurna = trozo[2]+"-"+trozo[1]+"-"+trozo[0];
                        
            
            fecha = dataJson[0].fecha_vespertino
            trozo = fecha.split("-");
            fecha_vespertino = trozo[2]+"-"+trozo[1]+"-"+trozo[0];
             
            fecha = dataJson[0].fecha_nocturno
            trozo = fecha.split("-");
            fecha_nocturno = trozo[2]+"-"+trozo[1]+"-"+trozo[0]; 
            
             
            fecha = dataJson[0].fecha_preins
            trozo = fecha.split("-");
            fecha_preins = trozo[2]+"-"+trozo[1]+"-"+trozo[0]; 
             
             
             
            $("#reunion_diurno").val(fecha_diurna);
            $("#reunion_vesper").val(fecha_vespertino);
            $("#reunion_nocturno").val(fecha_nocturno);
            $("#fecha_preinscripcion").val(fecha_preins);                        
            for(var i=0; i<8;i++){
                $("#id_fecha_"+(i+1)).val(dataJson[i].id_fecha);        
                
                fecha = dataJson[i].fecha_inicio
                trozo = fecha.split("-");
                fecha_inicio = trozo[2]+"-"+trozo[1]+"-"+trozo[0];
                 
                $("#fecha_ini_"+(i+1)).val(fecha_inicio);
                
                fecha = dataJson[i].fecha_culminacion
                trozo = fecha.split("-");
                fecha_culminacion = trozo[2]+"-"+trozo[1]+"-"+trozo[0];
                
                $("#fecha_cul_"+(i+1)).val(fecha_culminacion);
                
                fecha = dataJson[i].fecha_infinal
                trozo = fecha.split("-");
                fecha_infinal = trozo[2]+"-"+trozo[1]+"-"+trozo[0];
                
                $("#fecha_inf_"+(i+1)).val(fecha_infinal);    
            }
        });
    });
}

function nuevo(){
    /*alert(enviada+"---- falta");*/
    $(document).ready(function () {  
        $("#todosreg").hide();
        $.post("../includes/controlador_menu.php", {opc: 'cargarFormCro'},
            function (data) {
                /*alert(data);*/
                $("#mi_form").html(data);
                
                $.datepicker.regional['es'] = {
                        closeText: 'Cerrar',
                        prevText: '<Ant',
                        nextText: 'Sig>',
                        currentText: 'Hoy',
                        monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                        monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
                        dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
                        dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
                        dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
                        weekHeader: 'Sm',
                        dateFormat: 'dd-mm-yy',
                        firstDay: 1,
                        isRTL: false,
                        showMonthAfterYear: false,
                        yearSuffix: ''
                };                
                $.datepicker.setDefaults($.datepicker.regional['es']);	
                $( ".datepicker" ).datepicker();
                
                /* PARA LAS VALIDACIONES */
                $(function () {
                    $('#form1').validate({
                        rules: {
                            cod_lapso: {
                                required: true
                            },
                            reunion_diurno: {
                                required: true
                            },
                            reunion_vesper: {
                                required: true
                            },
                            reunion_nocturno: {
                                required: true
                            },
                            fecha_preinscripcion: {
                                required: true
                            },
                            cod_lap: {
                                required: true
                            },
                            fecha_tci1: {
                                required: true
                            },
                            fecha_tcc1: {
                                required: true
                            },
                            fecha_if1: {
                                required: true
                            },
                            fecha_tci2: {
                                required: true
                            },
                            fecha_tcc2: {
                                required: true
                            },
                            fecha_if2: {
                                required: true
                            },
                            fecha_tci3: {
                                required: true
                            },
                            fecha_tcc3: {
                                required: true
                            },
                            fecha_if3: {
                                required: true
                            },
                            fecha_tci4 : {
                                required: true
                            },
                            fecha_tcc4: {
                                required: true
                            },
                            fecha_if4: {
                                required: true
                            },
                            fecha_mti1: {
                                required: true
                            },
                            fecha_mtc1: {
                                required: true
                            },
                            fecha_mtif: {
                                required: true
                            },
                            fecha_li1: {
                                required: true
                            },
                            fecha_lc1: {
                                required: true
                            },
                            fecha_lif1: {
                                required: true
                            },
                            fecha_li2: {
                                required: true
                            },
                            fecha_lc2: {
                                required: true
                            },
                            fecha_lif2: {
                                required: true
                            },
                            fecha_li3: {
                                required: true
                            },
                            fecha_lc3: {
                                required: true
                            },
                            fecha_lif3: {
                                required: true
                            }
                        },
                        messages: {
                            cod_lapso: {
                                required: "Campo requerido."
                            },
                            reunion_diurno: {
                                required: "Campo requerido."
                            },
                            reunion_vesper: {
                                required: "Campo requerido."
                            },
                            reunion_nocturno: {
                                required: "Campo requerido."
                            },
                            fecha_preinscripcion: {
                                required: "Campo requerido."
                            },
                            cod_lap: {
                                required: "Campo requerido."
                            },
                            fecha_tci1: {
                                required: "Campo requerido."
                            },
                            fecha_tcc1: {
                                required: "Campo requerido."
                            },
                            fecha_if1: {
                                required: "Campo requerido."
                            },
                            fecha_tci2: {
                                required: "Campo requerido."
                            },
                            fecha_tcc2: {
                                required: "Campo requerido."
                            },
                            fecha_if2: {
                                required: "Campo requerido."
                            },
                            fecha_tci3: {
                                required: "Campo requerido."
                            },
                            fecha_tcc3: {
                                required: "Campo requerido."
                            },
                            fecha_if3: {
                                required: "Campo requerido."
                            },
                            fecha_tci4 : {
                                required: "Campo requerido."
                            },
                            fecha_tcc4: {
                                required: "Campo requerido."
                            },
                            fecha_if4: {
                                required: "Campo requerido."
                            },
                            fecha_mti1: {
                                required: "Campo requerido."
                            },
                            fecha_mtc1: {
                                required: "Campo requerido."
                            },
                            fecha_mtif: {
                                required: "Campo requerido."
                            },
                            fecha_li1: {
                                required: "Campo requerido."
                            },
                            fecha_lc1: {
                                required: "Campo requerido."
                            },
                            fecha_lif1: {
                                required: "Campo requerido."
                            },
                            fecha_li2: {
                                required: "Campo requerido."
                            },
                            fecha_lc2: {
                                required: "Campo requerido."
                            },
                            fecha_lif2: {
                                required: "Campo requerido."
                            },
                            fecha_li3: {
                                required: "Campo requerido."
                            },
                            fecha_lc3: {
                                required: "Campo requerido."
                            },
                            fecha_lif3: {
                                required: "Campo requerido."
                            }            
                        }
                    });
                });   /* FIN DE VALIDACIONES*/
        });
    });
}


function eliminar(enviada){    
    $(document).ready(function () {
        /*confirmar = confirm("¿Seguro que Desea eliminar?");
        if (confirmar) {
            $.post("../includes/controlador_menu.php", {opc: 'eliminarAl', idal: enviada},
            function (data) {
                alert(data);
                location.reload();
            });
        } else {
            return false;
        }*/

    });
}



function hab_des(enviada){    
    $(document).ready(function () {
        confirmar = confirm("¿Seguro que Desea cambiar?");
        if (confirmar) {
            $.post("../includes/controlador_menu.php", {opc: 'cambiar_status_cronograma', id: enviada},
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

 