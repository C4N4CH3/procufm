<?php
	include ("../sesiones.php");
	if($_SESSION['nivel']!=$_SESSION['id']){
	session_destroy();
	echo "FALLA GRAVE AL SISTEMA, PERDISTE LA SESION, PARA REGRESAR AL INICIO REINICIA EL NAVEGADOR";exit();
	}	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Principal</title>
<link href="../css/bootstrap/3.3.0/bootstrap.min.css" rel="stylesheet">
<link href="../css/material/roboto.min.css" rel="stylesheet">
<link href="../css/material/material.min.css" rel="stylesheet">
<link href="../css/material/ripples.min.css" rel="stylesheet">
<link href="../css/material/materialmodif.css" rel="stylesheet">
</head>

<body>
<?php include_once '../navbar.php';?>
  <div class="sidebar1"> 
     <?php include_once("menu_al.php")?>
  <!-- end .sidebar1 --></div>
  <div class="well col-md-9 col-lg-9 col-sm-9 col-xs-9" style="margin-left:20px">
    
    <p>
    <?php	
	$carnet = 					$_POST['carnet'];
	$direccion = 				$_POST['direccion'];
	$fechaNacimiento= 			$_POST['fechaNacimiento'];
	$sexo = 					$_POST['sexo'];
	$carrera = 					$_POST['carrera'];
	$mencion = 					$_POST['mencion'];
	$creditosaprobados = 		$_POST['creditosaprobados'];
	$ira = 						$_POST['ira'];
	$turno = 					$_POST['turno'];
	$semestre = 				$_POST['semestre'];
	$telefonohab = 				$_POST['telefonohab'];
	$telefonocel= 				$_POST['telefonocel'];
	$trabajo= 					$_POST['trabajo'];
	
	
	/*echo $carnet.'&nbsp;carnet<br/>';
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
	echo $emailempleo.'&nbsp;emailempleo<br/>';*/
	
	
	//id tabla lapso
	$idLapso = $_POST['idLapso'];
	
	//condicion para que no queden los campos vacios en la tabla si el preinscrito NO TRABAJA
	if($trabajo=="no"){
		$nombrempresa='';
		$cargo='';
		$telefonoempleo='';
		$emailempleo='';
        }else{
            $nombrempresa = $_POST['nombrempresa'];
            $cargo = $_POST['cargo'];
            $telefonoempleo = $_POST['telefonoempleo'];
            $emailempleo = $_POST['emailempleo'];
        }
	
	include "../conexionbd.php";	
	
	
	$ci = $_SESSION['cedula'];
	
	$consultaPre = "select * from preinscripcion where codigo_lapso='$idLapso' and cedula_alumno='$ci'";
	$resultadoPre = mysql_query($consultaPre) or die (mysql_error());
	$numCiEncontrado = mysql_num_rows($resultadoPre);
	
	if ($numCiEncontrado>0){//No hace el proceso de preinscripcion debido a que ya esta en preinscrito en este mismo lapso	
		echo "<p>Ud ya se preinscribi&oacute; en este lapso. <br> Debe esperar un lapso nuevo</p>";					
	}
	else{//cumple el proceso de preinscipcion
		$consultaTutor = "select * from tutor_academico where id_carrera='$carrera' and id_mencion='$mencion' and habilitado='si'";
		//echo $consultaTutor;
		$resultadoTutor = mysql_query($consultaTutor) or die (mysql_error());
		$numTutor = mysql_num_rows($resultadoTutor);
		
		if ($numTutor > 0)
		{
			$consulta="select * from alumno where cedula_alumno='$ci'";
			$resultado=mysql_query($consulta) or die (mysql_error());
                        
                        if($fil = mysql_fetch_array($resultado)){
                            $id_alumno = $fil["id_alumnos"];
                        		
                            $sql1 = "UPDATE alumno 
                                        SET carnet='$carnet', direccion_habitacion='$direccion', 
                                        fecha_nacimiento='$fechaNacimiento', sexo='$sexo', id_carrera='$carrera', 
                                        id_mencion='$mencion', creditos_aprobados='$creditosaprobados', 
                                        indice_academico='$ira', turno='$turno', semestre='$semestre', 
                                        telefono_habitacion='$telefonohab', telefono_celular='$telefonocel', 
                                        empleo='$trabajo', nombre_empleo='$nombrempresa', cargo_empleo='$cargo', 
                                        telefono_empleo='$telefonoempleo', email_empleo='$emailempleo', id_estatus=1 
                                    WHERE cedula_alumno='$ci'";		

                            mysql_query($sql1);
			}
                        
			$consulta_1="SELECT * FROM tutor_academico 
                                        WHERE id_carrera='$carrera' AND id_mencion='$mencion' AND habilitado='si'";
			$resultado_1 = mysql_query($consulta_1) or die (mysql_error());
			$i=0;
			if (mysql_num_rows($resultado_1)>0)
			{
				while($row = mysql_fetch_array($resultado_1))
				{
					$arrayId[$i] = $row["id_tutor"];
					$arrayCantidadAlumno[$i] = $row["cantidad_asignacion_alum"];	
					$i++;
				}
				arsort($arrayCantidadAlumno);
				foreach ($arrayCantidadAlumno as $key => $val) 
				{
					$indice=$key;	
					$valor=$val;			
				}
				$indicetutor = $arrayId[$indice];
				$valor++;
				$cons = "update tutor_academico set cantidad_asignacion_alum='$valor' where id_tutor='$indicetutor'";
				mysql_query($cons);	                                
                                                                
                                		
				$consulta_1="INSERT INTO preinscripcion 
                                            (cedula_alumno, id_tutor, codigo_lapso, cant_centros_temporales, 
                                            cantidad_documentos_postulacion, cantidad_documentos_permiso, 
                                            cantidad_documentos_constancia, id_alumno)
                                            VALUES ('$ci','$indicetutor', '$idLapso', '0', '0', '0', '0',$id_alumno)";
				mysql_query($consulta_1) or die (mysql_error());
				echo "<h2>Hemos recibido sus datos exitosamente</h2>";	
			}
	
		}
		else 
		{
			echo "<h2>Disculpe!</h2>";
			echo "<p align=center>No Hay tutor para esa carrera.</p>";
		}		
	}
	
	
	?>
    </p>
    <p><?php
		mysql_close($link);
	?></p>
  </div>
<?php include_once '../footer.php';?>

<script type="text/javascript" src="../js/1.11.1/jquery.min.js"></script>
<script src="../js/bootstrap/3.3.0/bootstrap.min.js"></script>
<script src="../js/material/material.min.js"></script>
<script src="../js/material/ripples.min.js"></script>
<script>
      $.material.init();
</script>
</body>
</html>
