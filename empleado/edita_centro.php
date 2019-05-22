<?php
include ("../sesiones.php");
if($_SESSION['nivel']!=$_SESSION['id']){
session_destroy();
echo "FALLA GRAVE AL SISTEMA, PERDISTE LA SESION, PARA REGRESAR AL INICIO REINICIA EL NAVEGADOR";exit();
}
?>  
<?php

 include ("../conexionbd.php");
    
	$id_centro = $_GET['id_centro'];
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
	echo $id_mencion.'<br>';
*/
	$edit_centro="UPDATE vacante_departamento
					SET nombre = '$nombre_centro', 
					ubicacion = '$ubicacion_centro', 
					numero_pasantes= $cant_pas, 
					vacante_carrera=  $id_carrera,
					vacante_mencion=  $id_mencion
	 				WHERE id_vacante_departamento = $id_centro";
			//echo  $edit_centro;
			
			$consulta=mysql_query($edit_centro);
			if($consulta)
			{
				header( 'Location: formulariocentropasantia.php?error=1') ;
				//echo $numero_de_filas.'PPPDDD';
			}
 ?>
 