    <?php	
include "../conexionbd.php";	
	 $id_al = 					$_POST['id_al'];
	 $nombre = 					$_POST['nombre'];
	 $apellido = 				$_POST['apellido'];
	 $cedulaAl = 				$_POST['cedulaAl'];
	 $email = 					$_POST['email'];
	 
	$carnet = 					$_POST['carnet'];
	$direccion = 				$_POST['direccion'];
	$fechaNacimiento= 			$_POST['fechaNacimiento'];
	$sexo = 					$_POST['sexo'];
	$carrera = 					$_POST['carreras'];
	$mencion = 					$_POST['menciones'];
	$creditosaprobados = 		$_POST['creditosaprobados'];
	$ira = 						$_POST['ira'];
	$turno = 					$_POST['turnos'];
	$semestre = 				$_POST['semestre'];
	$telefonohab = 				$_POST['telefonohab'];
	$telefonocel= 				$_POST['telefonocel'];
	$trabajo= 					$_POST['trabajo'];
	$nombrempresa = 			$_POST['nombrempresa'];
	$cargo = 					$_POST['cargo'];
	$telefonoempleo = 			$_POST['telefonoempleo'];
	$emailempleo = 				$_POST['emailempleo'];
	

	/*
	echo $carnet.'&nbsp;carnet<br/>';
	echo $direccion.'&nbsp;direccion<br/>';
	echo $fechaNacimiento.'&nbsp;fechaNacimiento<br/>';
	echo $sexo.'&nbsp;sexo<br/>';
	echo $carrera.'&nbsp;carrera<br/>';
	echo $mencion.'&nbsp;mencion<br/>';
	echo $creditosaprobados.'&nbsp;creditosaprobados<br/>';
	echo $ira.'&nbsp;ira<br/>';
	echo $turno.'&nbsp;turno<br/>';
	echo $semestre.'&nbsp;semestre<br/>';
	echo $telefonohab.'&nbsp;telefonohab<br/>';
	echo $telefonocel.'&nbsp;telefonocel<br/>';
	echo $trabajo.'&nbsp;trabajo<br/>';
	echo $nombrempresa.'&nbsp;nombrempresa<br/>';
	echo $cargo.'&nbsp;cargo<br/>';
	echo $telefonoempleo.'&nbsp;telefonoempleo<br/>';
	echo $emailempleo.'&nbsp;emailempleo<br/>';
	
*/
	$nuev_centro="INSERT INTO alumno (nombre, apellido, cedula_alumno, email, carnet, direccion_habitacion, fecha_nacimiento, sexo, 
	id_carrera, id_mencion, creditos_aprobados, indice_academico, turno, semestre, telefono_habitacion, telefono_celular, empleo, nombre_empleo, 
	cargo_empleo, telefono_empleo,email_empleo  )
						VALUES ('$nombre', '$apellido', $cedulaAl, $email, $carnet,$direccion,$fechaNacimiento,$sexo,$carrera,  $mencion, 
						$creditosaprobados, $ira, $turno,$semestre,$telefonohab, $telefonocel, $trabajo, $nombrempresa, $cargo, $telefonoempleo
						  $emailempleo ) ";
			//echo  $nuev_centro;
			$consulta=mysql_query($nuev_centro);
			if($consulta)
			{
				header( 'Location: nueva_preinscripcion_admin.php?error=1') ;
				//echo $numero_de_filas.'PPPDDD';
			}
			
 ?>
	