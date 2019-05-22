function validar(form){
	var error="Por favor, complete los campos\n\n";
	var a="";
	if(form.nombreusuario.value==""){
		a +="Nombre usuario\n";
	}
	if(form.clave.value==""){
		a +="Clave\n";	
	}	
	else{
		if(form.nombreusuario.value!=""){
			if (form.clave.value!=""){
				form.action="controlusuario.php";
			}
		}
	}
	if(a!=""){
		alert(error + a);
		return true;
	}
	form.submit();
}
//Funcion que valida el login disponible en el formulario estudiante
function validardisponiblestudiante(form){
	var error="por favor, complete los campos\n\n";
	var a="";	
	if(form.nombreusuario.value==""){
		a +="Nombre Usuario\n";	
	}
	else {
		form.action="logindisponiblestudiante.php";		
	}
	if(a!=""){
		alert(error + a);
		return true;
	}
	form.disponible();
}
//Funcion que valida el login disponible en el formulario departamento
function validardisponibledepartamento(form){
	var error="por favor, complete los campos\n\n";
	var a="";	
	if(form.nombreusuario.value==""){
		a +="Nombre Usuario\n";	
	}
	else {
		form.action="logindisponibledepartamento.php";		
	}
	if(a!=""){
		alert(error + a);
		return true;
	}
	form.disponible();
}
//Funcion que valida el login disponible en el formulario empresa
function validardisponibleempresa(form){
	var error="por favor, complete los campos\n\n";
	var a="";	
	if(form.nombreusuario.value==""){
		a +="Nombre Usuario\n";	
	}
	else {
		form.action="logindisponiblempresa.php";		
	}
	if(a!=""){
		alert(error + a);
		return true;
	}
	form.disponible();
}


function validarestu(form){
	var error="Por favor, complete los campos\n\n";
	var a="";
	var error2="Por favor, ingrese datos v\u00E1lidos\n\n";
	var b="";
	//var charpos = document.form.nombre.value.search("[^A-Za-z]");
	
	
		
	if(form.nombre.value==""){
		a +="Nombre\n";
	}
	if(form.apellido.value==""){
		a +="Apellido\n";	
	}
	if(form.cedula.value==""){
		a +="C\u00E9dula\n";	
	}
	if(form.nombreusuario.value==""){
		a +="Nombre Usuario\n";	
	}
	if(form.clave.value==""){
		a +="Clave\n";	
	}
	if(form.reclave.value==""){
		a +="Confirmar clave\n";	
	}
	if(form.email.value=="" ){
		a +="Email\n";	
	}
	
	if(isNaN(form.cedula.value)){
		b +="C\u00E9dula\n";	
	}
	if(form.email.value.indexOf('@')== -1){
		b +="Correo electr\u00F3nico\n";	
	}	
	if(b!=""){
		alert(error2 + b);
		return true;
	}	
	else{
		if(form.nombre.value!=""){
			if (form.apellido.value!=""){
				if (form.cedula.value!=""){
					if (form.nombreusuario.value!=""){
						if (form.clave.value!=""){
							if (form.reclave.value!=""){
								if (form.email.value!=""){
									form.action="registroestudiante.php";									
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
function validardep(form){
	var error="Por favor, complete los campos\n\n";
	var a="";
	var error2="Por favor, ingrese datos v\u00E1lidos\n\n";
	var b="";
	
	if(form.nombre.value==""){
		a +="Nombre\n";
	}
	if(form.apellido.value==""){
		a +="Apellido\n";	
	}
	if(form.cedula.value==""){
		a +="C\u00E9dula\n";	
	}
	if(form.cargo.value==""){
		a +="Cargo\n";	
	}
	if(form.nombreusuario.value==""){
		a +="Nombre Usuario\n";	
	}
	if(form.clave.value==""){
		a +="Clave\n";	
	}
	if(form.reclave.value==""){
		a +="Confirmar clave\n";	
	}
	if(form.email.value==""){
		a +="Correo electr\u00F3nico\n";	
	}
		
	if(isNaN(form.cedula.value)){
		b +="C\u00E9dula\n tiene que ser n\u00FAmero";	
	}
	if(form.email.value.indexOf('@')== -1){
		b +="Correo electr\u00F3nico\n";	
	}
	
	if(b!=""){
		alert(error2 + b);
		return true;
	}
	else{
		if(form.nombre.value!=""){
			if (form.apellido.value!=""){
				if (form.cedula.value!=""){
					if (form.cargo.value!=""){
						if (form.nombreusuario.value!=""){
							if (form.clave.value!=""){
								if (form.reclave.value!=""){
									if (form.email.value!=""){
										form.action="registrodepartamento.php";									
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
function validaremp(form){
	var error="Por favor, complete los campos\n\n";
	var a="";
	var error2="Por favor, ingrese datos v\u00E1lidos\n\n";
	var b="";
	
	if(form.nombre.value==""){
		a +="Nombre\n";
	}
	if(form.rif.value==""){
		a +="Apellido\n";	
	}
	if(form.direccion.value==""){
		a +="C\u00E9dula\n";	
	}
	if(form.telefono.value==""){
		a +="Cargo\n";	
	}
	if(form.nombreusuario.value==""){
		a +="Nombre Usuario\n";	
	}
	if(form.clave.value==""){
		a +="Clave\n";	
	}
	if(form.reclave.value==""){
		a +="Confirmar clave\n";	
	}
	if(form.email.value==""){
		a +="Correo electr\u00F3nico\n";	
	}
	
	if(form.email.value.indexOf('@')== -1){
		b +="Correo electr\u00F3nico\n";	
	}
	if(b!=""){
		alert(error2 + b);
		return true;
	}	
	else{
		if(form.nombre.value!=""){
			if (form.rif.value!=""){
				if (form.direccion.value!=""){
					if (form.telefono.value!=""){
						if (form.nombreusuario.value!=""){
							if (form.clave.value!=""){
								if (form.reclave.value!=""){
									if (form.email.value!=""){
										form.action="registroempresa.php";									
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
function validaremail(form){
	var error="Por favor, complete los campos\n\n";
	var a="";
	if(form.email.value==""){
		a +="Email\n";
	}
	if(form.opcion.value==""){
		a +="Opción válida\n";	
	}	
	else{
		if(form.email.value!=""){
			if (form.opcion.value!=""){
				form.action="mandaremail.php";
			}
		}
	}
	if(a!=""){
		alert(error + a);
		return true;
	}
	form.submit();
}

//valida formulario de tutor academico
function validartutoracad(form){
	var error="Por favor, complete los campos\n\n";
	var a="";
	var error2="Por favor, ingrese datos v\u00E1lidos\n\n";
	var b="";
	
	if(form.nombre.value==""){
		a +="Nombre\n";
	}
	if(form.apellido.value==""){
		a +="Apellido\n";	
	}
	if(form.cedula.value==""){
		a +="C\u00E9dula\n";	
	}
	if(form.nombreusuario.value==""){
		a +="Nombre Usuario\n";	
	}
	if(form.clave.value==""){
		a +="Clave\n";	
	}
	if(form.reclave.value==""){
		a +="Confirmaci\u00F3n de clave\n";	
	}	
	if(form.carrera.value==""){
		a +="Carrera\n";	
	}
	if(form.mencion.value==""){
		a +="Menci\u00F3n\n";	
	}
	if(form.area.value==""){
		a +="\u00C1rea de Trabajo\n";	
	}
	if(form.telefono.value==""){
		a +="Tel\u00E9fono\n";	
	}
	if(form.email.value==""){
		a +="Correo electr\u00F3nico\n";	
	}		
	if(isNaN(form.cedula.value)){
		b +="C\u00E9dula\n";	
	}
	if(form.email.value.indexOf('@')== -1){
		b +="Correo electr\u00F3nico\n";	
	}	
	if(b!=""){
		alert(error2 + b);
		return true;
	}	
	else{
		if(form.nombre.value!=""){
			if (form.apellido.value!=""){
				if (form.cedula.value!=""){
					if (form.nombreusuario.value!=""){
						if (form.clave.value!=""){
							if (form.reclave.value!=""){
								if (form.carrera.value!=""){
									if (form.mencion.value!=""){
										if (form.area.value!=""){
											if (form.telefono.value!=""){
												if (form.email.value!=""){
													form.action="registrotutoracademico.php";
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


//validar solitud pasante
function validarsolitudpasan(form){
	var error="Por favor, complete los campos\n\n";
	var a="";
		
	if(form.carrera.value==""){
		a +="Carrera \n";
	}
	if(form.mencion.value==""){
		a +="Menci\u00F3n \n";
	}
	if(form.turno.value==""){
		a +="Turno \n";
	}
	if(form.numpasante.value==""){
		a +="Cantidad de Vacante \n";
	}	
	if(form.carrera.value!=""){
		if(form.mencion.value!=""){
			if(form.turno.value!=""){
				if(form.numpasante.value!=""){
					form.action="alamcenasolitudpasante.php";
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