<?php
include ("../sesiones.php");
if($_SESSION['nivel']!=$_SESSION['id']){
session_destroy();
echo "FALLA GRAVE AL SISTEMA, PERDISTE LA SESION, PARA REGRESAR AL INICIO REINICIA EL NAVEGADOR";exit();
}
?>  
<?php

 include ("../conexionbd.php");
    
	$num_proc = $_GET['num_proc'];
	$codLapso = $_GET['codLapso'];
   	$lapsoHabilitado = $_GET['lapsoHabilitado'];
	$habiliTutor = $_GET['habiliTutor'];
	
	


/*	echo $num_proc.'<br>';
	echo $codLapso.'&nbsp;cedula<br>';
	echo $lapsoHabilitado.'&nbsp;nombre<br>';
	echo $habiliTutor.'&nbsp;apellido<br>';*/
	
	
	
	
	/*$upd_alum="UPDATE alumno 
			SET nombre = '$nombre', apellido = '$apellido', 
			carnet= '$carnet', email= '$email', id_estatus = $estatusAl,
			id_carrera = $carrera, id_mencion= $mencion, sexo = $sexo,
			direccion_habitacion = '$direccionHabitacion', telefono_habitacion = '$telefonoHabitacion',
			telefono_celular = '$telefonoCelular', creditos_aprobados = $creditosAprobados,
			semestre = $semestre, indice_academico = $indiceAcademico
	 		WHERE id_alumnos= $id_alum
			AND	cedula_alumno = $cedulaAl";
			//echo  $upd_alum;
			
			$consulta=mysql_query($upd_alum);
			if($consulta)
			{
				header( 'Location: busca_alumnos.php?error=1&buscare=' .$cedulaAl.'') ;
				//echo $numero_de_filas.'PPPDDD';
			}
	
	//$edit_alumn="select * from alumno where id_alum=$id_alumnos";
			//echo $del_alumn;
			
			/*$consulta = mysql_query($del_alumn) or die (mysql_error());		
				if ($consulta)	
					{
						header('Location: tutoralumnosasignados.php?err=1');
					}*/
	?>