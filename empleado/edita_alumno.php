<?php
include ("../sesiones.php");
if($_SESSION['nivel']!=$_SESSION['id']){
session_destroy();
echo "FALLA GRAVE AL SISTEMA, PERDISTE LA SESION, PARA REGRESAR AL INICIO REINICIA EL NAVEGADOR";exit();
}
?>  
<?php

 include ("../conexionbd.php");
    
	$id_alum = 		$_GET['id_alum'];
	$cedulaAl = 	$_GET['cedulaAl'];
   	$nombre = 		$_GET['nombre'];
	$apellido = 	$_GET['apellido'];
	$carnet = 		$_GET['carnet'];
	$email = 		$_GET['email'];
	
	$estatusAl = 	$_GET['estatusAl'];
	$carrera = 		$_GET['carrera'];
	$nombre_carrera = $_GET['nombre_carrera'];
	$nombre_mencion =		$_GET['nombre_mencion'];
	$mencion =		$_GET['mencion'];
	$id_sexo = 		$_GET['id_sexo'];
	$genero = 		$_GET['genero'];
	
	$direccionHabitacion = $_GET['direccionHabitacion'];
	$telefonoHabitacion = $_GET['telefonoHabitacion'];
	$telefonoCelular = $_GET['telefonoCelular'];
	
	$creditosAprobados = $_GET['creditosAprobados'];
	$semestre = $_GET['semestre'];
	$indiceAcademico = $_GET['indiceAcademico'];
	
	


	/*echo $id_alum.'<br>';
	echo $cedulaAl.'&nbsp;cedula<br>';
	echo $nombre.'&nbsp;nombre<br>';
	echo $apellido.'&nbsp;apellido<br>';
	echo $carnet.'&nbsp;carnet<br>';
	echo $email.'&nbsp;email<br>';
	echo $estatusAl.'&nbsp;estatusAl<br>';
	echo $carrera.'&nbsp;carrera<br>';
	echo $nombre_carrera.'&nbsp;nombre_carrera<br>';
	echo $mencion.'&nbsp;mencion<br>';
	echo $nombre_mencion.'&nbsp;nombre_mencion<br>';
	echo $id_sexo.'&nbsp;id_sexo<br>';
	echo $genero.'&nbsp;genero<br>';
	echo $direccionHabitacion.'&nbsp;dir_habit<br>';
	echo $telefonoHabitacion.'&nbsp;telef_habit<br>';
	echo $telefonoCelular.'&nbsp;telef_cel<br>';
	echo $creditosAprobados.'&nbsp;creditos<br>';
	echo $semestre.'&nbsp;semestre<br>';
	echo $indiceAcademico.'&nbsp;indice academico<br>';*/
	

	
	$upd_alum="UPDATE alumno 
			SET nombre = '$nombre', apellido = '$apellido', 
			carnet= '$carnet', email= '$email',
			direccion_habitacion = '$direccionHabitacion', telefono_habitacion = '$telefonoHabitacion',
			telefono_celular = '$telefonoCelular'
	 		WHERE id_alumnos= $id_alum";
			//echo  $upd_alum;
			
			$consulta=mysql_query($upd_alum);
			if($consulta)
			{
				header( 'Location: busca_alumnos.php?error=1&buscare=' .$cedulaAl.'') ;
				//echo $numero_de_filas.'PPPDDD';
			}
			/*else
			{
				//echo 'no s epudo ';
			}*/
	
	//$edit_alumn="select * from alumno where id_alum=$id_alumnos";
			//echo $del_alumn;
			
			/*$consulta = mysql_query($del_alumn) or die (mysql_error());		
				if ($consulta)	
					{
						header('Location: tutoralumnosasignados.php?err=1');
					}*/
	?>