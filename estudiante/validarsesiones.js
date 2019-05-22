function validarpreincrip(form){
	var error="Por favor, complete los campos\n\n";
	var a="";
	var error2="Ingrese un rango comprendido entre 90 y 102 Cr\u00E9ditos";
	var error3="Ingrese un rango de IRA entre 0 y 20";
	
	opciones1 = document.getElementsByName("sexo");
	var seleccionado1 = false;
	for(var i=0; i<opciones1.length; i++) {	
  		if(opciones1[i].checked) {
    	seleccionado1 = true;
    	break;
  	}
	} 
	if(!seleccionado1) {
		alert("seleccione su g\u00E9nero");
  		return false;
	}	
	
	opciones2 = document.getElementsByName("trabajo");
	var seleccionado2 = false;
	for(var i=0; i<opciones2.length; i++) {	
  		if(opciones2[i].checked) {
    	seleccionado2 = true;
    	break;
  	}
	}
 
	if(!seleccionado2) {
		alert("seleccione si Ud. trabaja");
  		return false;
	}	
	
	if(form.carnet.value==""){
		a +="Carnet\n";
	}	
	if(form.direccion.value==""){
		a +="Direcci\u00F3n\n";
	}
	if(form.fechaNacimiento.value==""){
		a +="Edad\n";
	}
	/*if(form.sexo.value==""){
		a +="Sexo\n";
	}*/	
	if(form.carrera.value==""){
		a +="Carrera\n";
	}
	if(form.mencion.value==""){
		a +="Menci\u00F3n\n";
	}	
	if(form.creditosaprobados.value==""){
		a +="Cr\u00E9dito aprobados\n";
	}
	if(form.ira.value==""){
		a +="IRA\n";
	}
	if(form.ira.value<0 || form.ira.value>20){
		 alert(error3);
		 return true;
	}	
	
	if(form.turno.value==""){
		a +="Turno\n";
	}	
	if(form.semestre.value==""){
		a +="Semestre\n";
	}	
	if(form.trabajo.value==""){
		a +="Trabajo\n";
	}	
	if(form.creditosaprobados.value<90 || form.creditosaprobados.value>102){
		alert(error2);
		return true;
	}		
	if(form.carnet.value!=""){
		if(form.direccion.value!=""){
			if(form.fechaNacimiento.value!=""){
				/*if(form.sexo.value!=""){*/
					if(form.carrera.value!=""){
						if(form.mencion.value!=""){
							if(form.creditosaprobados.value!=""){
								if(form.ira.value!=""){
									if(form.turno.value!=""){
										if(form.semestre.value!=""){
											if(form.trabajo.value!=""){
												form.action="almacenapreincripcion.php";
											}
										}
									}
								}
							}
						}							
					}
				}
			
		}
	}
	if(a!=""){
		alert(error + a);
		return true;
	}
	form.submit();		
}

// ojo a este le faltaaaaaa es de las fechas
function valcronogram(form){
	form.action="almacenacronograma.php";
	form.submit();
}

function editarcronogram(form){
	form.action="editarcronograma.php";
	form.submit();
}



function centropasan(form){
	var error="Por favor, complete los campos\n\n";
	var a="";
	if(form.nombre.value==""){
		a +="Nombre del Centro\n";
	}
	if(form.ubicacion.value==""){
		a +="Ubicaci\u00F3n del Centro\n";
	}
	if(form.num_pasante.value==""){
		a +="N\u00FAmeros de pasantes\n";
	}
	if(form.carrera.value==""){
		a +="Carrera\n";
	}
	if(form.mencion.value==""){
		a +="Menci\u00F3n\n";
	}
	else{		
			if(form.nombre.value!=""){
				if(form.ubicacion.value!=""){
					if(form.num_pasante.value!=""){
						if(form.carrera.value!=""){
							if(form.mencion.value!=""){
								form.action="almacenacentrodepartamento.php";
							}					
						}					
					}
				}
			}
	}	
	if(a!=""){
		alert(error + a);
		return true;
	}
	form.submit();	
}

function guardacentro(form){	
	form.action="almacenacentroestudiante.php";
	form.submit();
}

function validarinscripcion(form){	
	var error="Por favor, complete los campos: \n\n";
	var a="";	
	var error2="Por favor, ingrese datos v\u00E1lidos\n\n";
	var b="";
	
	//validar radio seleccionfecha
	opciones2 = document.getElementsByName("seleccionfecha");
	var seleccionado2 = false;
	for(var i=0; i<opciones2.length; i++) {	
  		if(opciones2[i].checked) {
    	seleccionado2 = true;
    	break;
  	}
	}
 
	if(!seleccionado2) {
		alert("seleccione una fecha de pasant\u00EDa");
  		return false;
	}
	
	//validar radio obtenercentro
	opciones = document.getElementsByName("obtenercentro");
	var seleccionado = false;
	for(var i=0; i<opciones.length; i++) {	
  		if(opciones[i].checked) {
    	seleccionado = true;
    	break;
  	}
	}
 
	if(!seleccionado) {
		alert("seleccione como obtuvo el centro");
  		return false;
	}	
			
	if(form.nombre.value==""){
		a +="Nombre de la Empresa\n";
	}
	if(form.direccion.value==""){
		a +="Direcci\u00F3n de la Empresa\n";
	}
	if(form.telefono.value==""){
		a +="Tel\u00E9fono de la Empresa\n";
	}
	if(form.responsable.value==""){
		a +="Responsable del \u00C1rea\n";
	}
	if(form.cargo.value==""){
		a +="Cargo del responsable del \u00C1rea\n";
	}
	if(form.telresponsable.value==""){
		a +="Tel\u00E9fono del responsable del \u00C1rea\n";
	}
	if(form.emailresponsable.value==""){
		a +="Email del responsable del \u00C1rea\n";
	}
	if(form.area.value==""){
		a +="\u00C1rea de pasant\u00EDa\n";
	}
	if(form.horario.value==""){
		a +="Horario de pasant\u00EDa\n";
	}	
				
	if(form.nombretutor.value==""){
		a +="Nombre del tutor empresarial\n";
	}	
	if(form.cargotutor.value==""){
		a +="Cargo del tutor empresarial\n";
	}
	if(form.emailtutor.value==""){
		a +="Email del tutor empresarial\n";
	}	
	if(form.teletutor.value==""){
		a +="Tel\u00E9fono del tutor empresarial\n";
	}
	if(isNaN(form.teletutor.value)){
		b +="Tel\u00E9fono";	
	}
	if(form.emailtutor.value.indexOf('@')== -1){
		b +="Correo electr\u00F3nico del Tutor\n";	
	}	
	if(b!=""){
		alert(error2 + b);
		return true;
	}		
	else{
		if(form.nombre.value!=""){
			if(form.direccion.value!=""){
				if(form.telefono.value!=""){
					if(form.responsable.value!=""){
						if(form.cargo.value!=""){
							if(form.telresponsable.value!=""){
								if(form.emailresponsable.value!=""){
									if(form.area.value!=""){
										if(form.horario.value!=""){
											if(form.nombretutor.value!=""){
												if(form.cargotutor.value!=""){
													if(form.emailtutor.value!=""){
														if(form.teletutor.value!=""){
															form.action="almacenainscripcion.php";
														}
													}
												}
											}
										}
									}										
								}
							}								
						}							
					}
				}					
			}		
		}			
	}
	if(a!=""){
		alert(error + a);
		return true;
	}
	form.submit();
}


function validarinf(form){
	
	var error="Por favor, complete los campos: \n\n";
	var a="";	
	
	//validar radio seleccionfecha
	opciones1 = document.getElementsByName("radioacademico");
	var seleccionado1 = false;
	for(var i=0; i<opciones1.length; i++) {	
  		if(opciones1[i].checked) {
    	seleccionado1 = true;
    	break;
  	}
	}
 
	if(!seleccionado1) {
		alert("Por favor indique si se entrevist\u00F3 con su Tutor Academico");
  		return false;
	}
	
	
	//validar radio obtenercentro
	opciones2 = document.getElementsByName("radioacademico");
	var seleccionado2 = false;
	for(var i=0; i<opciones2.length; i++) {	
  		if(opciones2[i].checked) {
    	seleccionado2 = true;
    	break;
  	}
	}
 
	if(!seleccionado2) {
		alert("Por favor indique si se entrevist\u00F3 con su Tutor Empresarial");
  		return false;
	}
		
	if(form.unidad.value==""){
		a +="Unidad Administrativa \n";
	}	
	
    if(form.actividades.value==""){
		a +="Actividades Realizadas \n";
	}	
	
	if(form.limitaciones.value==""){
		a +="Limitaciones Presentadas \n";
	}	
	
	/*if(form.academico.value==""){
		a +="Entrevista con su Tutor Acad\u00E9mico \n";
	}
	
	if(form.empresarial.value==""){
		a +="Entrevista con su Tutor Empresarial \n";
	}*/	
	else{
		if(form.unidad.value!=""){
			if(form.actividades.value!=""){
				if(form.limitaciones.value!=""){
                                    form.action="almacenainformestudiante.php";															
					
				}					
			}		
		}			
	}
	if(a!=""){
		alert(error + a);
		return true;
	}
	form.submit();	
}

