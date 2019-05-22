function validarcartapostulacion(form) {
		var error="Por favor, complete los campos\n\n";
	var a="";
	if(form.fecha_actual.value==""){
		a +="fecha_actual\n";
	}	
	if(form.nombre_centro.value==""){
		a +="nombre_centro\n";
	}	
	if(form.cargo_asignado.value==""){
		a +="cargo_asignado\n";
	}	
	if(form.carta_dirigida.value==""){
		a +="carta_dirigida\n";
	}	
	if(form.telefono.value==""){
		a +="telefono\n";
	}	
	if(form.fecha_actual.value!=""){
		if(form.nombre_centro.value!=""){
			if(form.cargo_asignado.value!=""){
				if(form.carta_dirigida.value!=""){
					if(form.telefono.value!=""){
						form.action="almacenacartapostulacion.php";
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

function  validarsolicitudpermiso(form) {
	
	var error="Por favor, complete los campos\n\n";
	var a="";
	if(form.fecha_actual.value==""){
		a +="Fecha_actual\n";
	}	
	if(form.nombre_centro.value==""){
		a +="Nombre_centro\n";
	}	
	if(form.cargo_asignado.value==""){
		a +="Cargo_asignado\n";
	}	
	if(form.carta_dirigida.value==""){
		a +="Carta_dirigida\n";
	}
	if(form.telefono_lapso.value==""){
		a +="Lapso_pasantias\n";
	}		
	else{
		if(form.fecha_actual.value!=""){
			if(form.nombre_centro.value!=""){
				if(form.cargo_asignado.value!=""){
					if(form.carta_dirigida.value!=""){
						if(form.telefono_lapso.value!=""){						
							form.action="almacenapermiso.php";						
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

function  validarconstanciapasantia(form) {

	var error="Por favor, complete los campos\n\n";
	var a="";
	
	if(form.fecha_actual.value==""){
		a +="Fecha_actual\n";
	}	
	if(form.nombre_centro.value==""){
		a +="Nombre_centro\n";
	}	
	if(form.cargo_asignado.value==""){
		a +="Cargo_asignado\n";
	}	
	if(form.carta_dirigida.value==""){
		a +="Carta_dirigida\n";
	}
	if(form.telefono_lapso.value==""){
		a +="Lapso_pasantias\n";
	}	
	else{
		if(form.fecha_actual.value!=""){
			if(form.nombre_centro.value!=""){
				if(form.cargo_asignado.value!=""){
					if(form.carta_dirigida.value!=""){
						if(form.telefono_lapso.value!=""){
							form.action="almacenaconstancia.php";						
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