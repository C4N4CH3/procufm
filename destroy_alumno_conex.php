	<?php
    include "conexionbd.php";
	$ci = $_GET['destroy_alum'];
   
	
	/*echo $nombre.'<br>';
	echo $apellido.'<br>';*/
	//echo $ci.'<br>';
	/*echo $carnet.'<br>';
	echo $email.'<br>';
	echo $telef_celular.'<br>';*/
	$del_alumn="DELETE FROM alumno
			WHERE cedula_alumno ='".$ci."'";
			//echo $del_alumn;
			
			$consulta = mysql_query($del_alumn) or die (mysql_error());		
				if ($consulta)	
					{
						$modu_aud='ALUMNOS C.I.:'.$ci;
                         $tabl_aud='alumno';
                         $acci_aud='ELIMINAR';
                         $fech_aud=date('Y/m/d');
                         $hora_aud=date('G:i:s');
                         $usua_aud=$_SESSION['id'];
                         $consulta = "insert into auditoria (modulo,tabla,accion,fecha,hora,user_id)".                         //.
                         "values ('$modu_aud','$tabl_aud','$acci_aud','$fech_aud','$hora_aud','$usua_aud')";
        	         mysql_query($consulta) or die (mysql_error());
						header('Location: tutoralumnosasignados.php?err=1');
					}
	?>