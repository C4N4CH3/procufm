<?php
include ("../sesiones.php");
if($_SESSION['nivel']!=$_SESSION['id']){
session_destroy();
echo "FALLA GRAVE AL SISTEMA, PERDISTE LA SESION, PARA REGRESAR AL INICIO REINICIA EL NAVEGADOR";exit();
}
?>  
<?php

 include ("../conexionbd.php");
    
	//$id_centro = $_GET['id_centro'];
	$nombre_centro = $_GET['nombre_centro'];
	$ubicacion_centro = $_GET['ubicacion_centro'];
	$cant_pas = $_GET['cant_pas'];
	$id_carrera = $_GET['carrera'];
	$id_mencion = $_GET['mencion'];
	
	//echo $id_centro.'<br>';
	/*echo $nombre_centro.'<br>';
	echo $ubicacion_centro.'<br>';
	echo $cant_pas.'<br>';
	echo $id_carrera.'<br>';
	echo $id_mencion.'<br>';*/

$nuev_centro="INSERT INTO vacante_departamento (nombre, ubicacion, numero_pasantes, vacante_carrera, vacante_mencion)
						VALUES ('$nombre_centro', '$ubicacion_centro', $cant_pas, $id_carrera, $id_mencion) ";
			//echo  $nuev_centro;
			
			$consulta=mysql_query($nuev_centro);
			if($consulta)
			{
                         
                         $modu_aud='CENTROS DE PASANTIA';
                         $tabl_aud='vacante_departamento';
                         $acci_aud='CREAR';
                         $fech_aud=date('Y/m/d');
                         $hora_aud=date('G:i:s');
                         $usua_aud=$_SESSION['id'];
                         $consulta = "insert into auditoria (modulo,tabla,accion,fecha,hora,user_id)".                         //.
                         "values ('$modu_aud','$tabl_aud','$acci_aud','$fech_aud','$hora_aud','$usua_aud')";
        	         mysql_query($consulta) or die (mysql_error());

			 header( 'Location: formulariocentropasantia.php?error=3') ;
			 //echo $numero_de_filas.'PPPDDD';
			}
			
 ?>
 
