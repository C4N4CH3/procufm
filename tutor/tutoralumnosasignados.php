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
<title></title>
<link href="../css/bootstrap/3.3.0/bootstrap.min.css" rel="stylesheet">
<link href="../css/material/roboto.min.css" rel="stylesheet">
<link href="../css/material/material.min.css" rel="stylesheet">
<link href="../css/material/ripples.min.css" rel="stylesheet">
<link href="../css/material/materialmodif.css" rel="stylesheet">
</head>

<body>
<!--<form action="" method="post">-->
<?php include_once '../navbar.php';?>
    <?php require_once 'menu.php';?>
<div class="well col-md-9 col-lg-9 col-sm-9 col-xs-9" style="margin-left:20px">

      <h2>Alumnos Asignados</h2>

    <p align="justify"> &nbsp; En esta secci&oacute;n podras verificar los alumnos que tienes asignados para este proceso.</p>
    <p>
    <?php
   	$ci = $_SESSION['cedula'];
	include "../conexionbd.php";
	$consultaTutor = "select * from tutor_academico where cedula='$ci'";
	
	$resultadoTutor = mysql_query($consultaTutor) or die (mysql_error());
	if($fila1 = mysql_fetch_array($resultadoTutor)){		
		$idtutor = $fila1["id_tutor"];
		
		$consultaLapso = "select * from lapso where lapso_habilitado='si'";
		$resultadoLapso = mysql_query($consultaLapso) or die (mysql_error());		
		if ($filalapso = mysql_fetch_array($resultadoLapso)){	
			$codigoLapso = $filalapso["codigo_lapso"];
			echo "<p>C&oacute;digo de lapso habilitado: ".$codigoLapso;
			
			echo "<table width=100% border=1>";
			echo "<tr>";
			echo "<th scope=col>#</th>";
			echo "<th scope=col>Nombre</th>";
    		echo "<th scope=col>Apellido</th>";
			echo "<th scope=col>Carnet</th>";
			echo "<th scope=col>Email</th>";
			echo "<th scope=col>Tel&eacute;fono</th>";
			/*desde aquí May editó el código*/
			echo "<th scope=col>&nbsp;</th>";
    		echo "</tr>";
						
			
			$consultaPre = "select * from preinscripcion where id_tutor='$idtutor'";
			$resultadoPre = mysql_query($consultaPre) or die (mysql_error());		
			$cantidad_asignados = mysql_num_rows($resultadoPre);
			$i=0;		
			while ($fila2 = mysql_fetch_array($resultadoPre)){
				$idestudiante = $fila2["cedula_alumno"];
				$id_al = $fila2["id_alumno"];			
				
				$consultaTablAlum = "select * from alumno where cedula_alumno='$idestudiante'";
				$resultadoTablAlum = mysql_query($consultaTablAlum) or die (mysql_error());			
				if($filAlum = mysql_fetch_array($resultadoTablAlum)){				
					$i++;
					echo "<tr>";
    				echo "<td>".$i."</td>";
    				echo "<td>".$filAlum["nombre"]."</td>";
    				echo "<td>".$filAlum["apellido"]."</td>";
					echo "<td>".$filAlum["carnet"]."</td>";
					echo "<td>".$filAlum["email"]."</td>";
					echo "<td>".$filAlum["telefono_celular"]."</td>";
					echo "<td><a href='detallealumnopreinscrito.php?id_al=".$id_al."' 
                                                    class='iredit'>Ver</a></td>";				
				}
							
			}
			echo "</table>";
			echo "<br><p align=right>Total de Alumnos asignados: ".$cantidad_asignados."</p>";			
			echo "</p>";				
		}
		else{
			echo "<br>No hay C&oacute;digo de Lapso habilitado.";
		}			
	}
			
?>  
<?php
	mysql_close($link);
?>
    
    </p>
  </div>
<?php include_once '../footer.php';?>

<script type="text/javascript" src="../js/1.11.1/jquery.min.js"></script>
<script src="../js/bootstrap/3.3.0/bootstrap.min.js"></script>
<script src="../js/material/material.min.js"></script>
<script src="../js/material/ripples.min.js"></script>
<script>
      $.material.init();
</script>
<!--</form>--> 
</body>
</html>