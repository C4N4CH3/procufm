	<?php
    include "../conexionbd.php";
	//$ci = $_GET['destroy_alum'];
	$id_centro = $_POST['id_centro'];
   
	
	//echo $id_centro.'<br>';
	/*echo $apellido.'<br>';*/
	//echo $ci.'<br>';
	/*echo $carnet.'<br>';
	echo $email.'<br>';
	echo $telef_celular.'<br>';*/
	$del_centro="DELETE FROM vacante_departamento
			WHERE id_vacante_departamento ='".$id_centro."'";
			//echo $del_alumn;
			
			$consulta = mysql_query($del_centro) or die (mysql_error());		
				if ($consulta)	
					{
					$modu_aud='DEPARTAMENTOS';
                    $tabl_aud='vacante_departamento';
                    $acci_aud='ELIMINAR ID:'.$id_centro;
                    $fech_aud=date('Y/m/d');
                    $hora_aud=date('G:i:s');
                    $usua_aud=$_SESSION['id'];
                    $consulta = "insert into auditoria (modulo,tabla,accion,fecha,hora,user_id)".                         //.
                    "values ('$modu_aud','$tabl_aud','$acci_aud','$fech_aud','$hora_aud','$usua_aud')";
        	         mysql_query($consulta) or die (mysql_error());
					
						header('Location: formulariocentropasantia.php?error=2');
					}
	?>