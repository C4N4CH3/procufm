<?php
	
	 include ("../conexionbd.php");
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
	
	//echo $trabajo.'&nbsp;trabajo<br/>';
	
	/*echo $nombre.'&nbsp;nombre<br/>';
	echo $apellido.'&nbsp;apellido<br/>';
	echo $cedulaAl.'&nbsp;cedulaAlp<br/>';
	echo $email.'&nbsp;email<br/>';
	echo $carnet.'&nbsp;carnet<br/>';
	echo $direccion.'&nbsp;direccion<br/>';
	echo $fechaNacimiento.'&nbsp;fechaNacimiento<br/>';
	echo $sexo.'&nbsp;sexo<br/>';
	echo $carrera.'&nbsp;carrera<br/>';
	echo $mencion.'&nbsp;mencion<br/>';
	echo $creditosaprobados.'&nbsp;creditosaprobados<br/>';
	echo $ira.'&nbsp;ira<br/>';///
	echo $turno.'&nbsp;turno<br/>';////
	echo $semestre.'&nbsp;semestre<br/>';///
	echo $telefonohab.'&nbsp;telefonohab<br/>';
	echo $telefonocel.'&nbsp;telefonocel<br/>';
	echo $trabajo.'&nbsp;trabajo<br/>';
	echo $nombrempresa.'&nbsp;nombrempresa<br/>';
	echo $cargo.'&nbsp;cargo<br/>';
	echo $telefonoempleo.'&nbsp;telefonoempleo<br/>';
	echo $emailempleo.'&nbsp;emailempleo<br/>';*/
	
	$upd_preins="UPDATE alumno 
			SET 
			nombre = '$nombre', 
			apellido = '$apellido',
			cedula_alumno ='$cedulaAl',
			carnet= '$carnet', 
			email= '$email', 
			direccion_habitacion = '$direccion',
			fecha_nacimiento= '$fechaNacimiento',
			sexo = $sexo, 
			id_carrera = $carrera,
			id_mencion= $mencion,
			creditos_aprobados = '$creditosaprobados',
			indice_academico = '$ira',
			turno= '$turno', 
			semestre = $semestre, 
			telefono_habitacion = '$telefonohab', 
			telefono_celular = '$telefonocel', 
			empleo = $trabajo, 
			nombre_empleo='$nombrempresa',
			cargo_empleo= '$cargo', 
			telefono_empleo= '$telefonoempleo', 
			email_empleo='$emailempleo' 
	 		WHERE id_alumnos= $id_al";
		//echo  $upd_preins;
			
			$consulta=mysql_query($upd_preins);
			if($consulta)
			{
				header( 'Location: busca_alumnos.php?error=3&senna=2&buscare='.$cedulaAl.'') ;
				//echo $numero_de_filas.'PPPDDD';
			}
			
	?>
	
	