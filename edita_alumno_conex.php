	<?php
    include "conexionbd.php";
	$ci = $_POST['cedula'];
   	$nombre = $_POST['nombre'];
	$apellido = $_POST['apellido'];
	$carnet = $_POST['carnet'];
	$email = $_POST['email'];
	$telef_celular = $_POST['telefono_celular'];
	
	/*echo $nombre.'<br>';
	echo $apellido.'<br>';
	echo $ci.'<br>';
	echo $carnet.'<br>';
	echo $email.'<br>';
	echo $telef_celular.'<br>';
	*/$f=1;
while ($f==1)
{
    $actu_si=0;
	if  ($nombre)
	{
		$nam="UPDATE alumno
			SET nombre='$nombre'
			WHERE cedula_alumno='$ci'";
			//echo $nam;
			$consulta = mysql_query($nam) or die (mysql_error());		
				if ($consulta)
				{	
					
				$actu_si=1;
				  //echo 'consulta realizada con exito';
				}
	}
	if ($apellido)
	{
		$ape="UPDATE alumno
			SET apellido='$apellido'
			WHERE cedula_alumno='$ci'";
			//echo $ape;
				$consulta = mysql_query($ape) or die (mysql_error());		
				if ($consulta)
				{	
					$actu_si=1;
					//echo 'consulta realizada con exito';
				}
	}
	if ($carnet)
	{
		$car="UPDATE alumno
			SET carnet=$carnet
			WHERE cedula_alumno='$ci'";
				$consulta = mysql_query($car) or die (mysql_error());		
				if ($consulta)
				{	
				    $actu_si=1;					
					//echo 'consulta realizada con exito';
				}
	}
	if ($email)
	{
		$ema="UPDATE alumno
			SET email='$email'
			WHERE cedula_alumno='$ci'";
				$consulta = mysql_query($ema) or die (mysql_error());		
				if ($consulta)
				{	
					$actu_si=1;				
					//echo 'consulta realizada con exito';
				}
	}
	if ($email)
	{
		$tel="UPDATE alumno
			SET telefono_celular='$telef_celular'
			WHERE cedula_alumno='$ci'";
				$consulta = mysql_query($tel) or die (mysql_error());		
				if ($consulta)
				{	
					$actu_si=1;				
					//echo 'consulta realizada con exito';
				}
	}
	if ($actu_si > 0){
		$modu_aud='ALUMNOS';
		$tabl_aud='alumno';
		$acci_aud='ACTUALIZAR';
		$fech_aud=date('Y/m/d');
		$hora_aud=date('G:i:s');
		$usua_aud=$_SESSION['id'];
		$consulta = "insert into auditoria (modulo,tabla,accion,fecha,hora,user_id)".                         //.
		"values ('$modu_aud','$tabl_aud','$acci_aud','$fech_aud','$hora_aud','$usua_aud')";
		mysql_query($consulta) or die (mysql_error()); 
	}
	$f++;
}
/*header('Location: tutoralumnosasignados_edit.php?err=1&edit_alum='.$ci.'');*/
header('Location: tutoralumnosasignados.php?err=2');
	
	
	?>