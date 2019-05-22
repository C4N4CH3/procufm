<?php
include ("sesiones.php");
if($_SESSION['nivel']!=$_SESSION['id']){
session_destroy();
echo "FALLA GRAVE AL SISTEMA, PERDISTE LA SESION, PARA REGRESAR AL INICIO REINICIA EL NAVEGADOR";exit();
}
$id_alum=$_POST['edit_alum'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link href="efecto.css" rel="stylesheet" type="text/css">

</head>

<body>
<form action="" method="post">
<div class="container">
  <div class="header">
    <table width="1081" height="213" cellpadding="0" celspacing="0" border="0">
      <tr>
        <td height="50" colspan="3"><img src="logos/gobierno.JPG" width="853" height="50" /><img src="logos/logo_bicentenario.JPG" width="222" height="50" /></td>        
      </tr>
      <tr>
        <td width="178" height="130"><a href="cerrarsesion.php"><img src="logos/logo_cufm.JPG" width="176" height="130" /></a></td>
        <td width="672" height="130" align="center" valign="middle" background="imagenes/header.JPG" bgcolor="#D6D6D6" class="tituloPrici"><strong>DEPARTAMENTO DE PASANTIA DEL COLEGIO UNIVERSITARIO FRANCISCO DE MIRANDA</strong></td>
        <td width="223" height="130"><img src="logos/independencia.JPG" width="222" height="130" /></td>        
      </tr>
      <tr>
        <td height="25" colspan="3" class="cintacentral">&nbsp;</td>
      </tr>
      </table>
  </div>
  <div class="sidebar1"> 
    <p>Principal</p>
    <ul class="nav">
      <li><a href="sesiontutoracademico.php"><img src="imagenes/blockcontentbullets.JPG" width="6" height="13" /><img src="imagenes/spacer.JPG" width="5" height="1" />Inicio</a></li>
      
   
    </ul>
    <p>Gesti&oacute;n</p>
    <ul class="nav">
      <li><a href="tutoralumnosasignados.php"><img src="imagenes/blockcontentbullets.JPG" width="6" height="13" /><img src="imagenes/spacer.JPG" width="5" height="1" />Alum asignados</a></li>
      <li><a href="tutorinformes.php"><img src="imagenes/blockcontentbullets.JPG" width="6" height="13" /><img src="imagenes/spacer.JPG" width="5" height="1" />Informes</a></li>
      <li><a href="tutorveredicto.php"><img src="imagenes/blockcontentbullets.JPG" width="6" height="13" /><img src="imagenes/spacer.JPG" width="5" height="1" />Veredicto</a></li>
      
    </ul>
    <p>Fechas</p>
    <ul class="nav">
      <li><a href="cronogramatutoracademico.php"><img src="imagenes/blockcontentbullets.JPG" width="6" height="13" /><img src="imagenes/spacer.JPG" width="5" height="1" />Cronograma</a></li>
    </ul>
  <!-- end .sidebar1 --></div>
  <div class="content">
    <blockquote>
      <h2>Alumnos Asignados</h2>
    </blockquote>
    <p align="justify"> &nbsp; En esta secci&oacute;n podras verificar los alumnos que tienes asignados para este proceso.</p>
    <p>
    <?php
   	$ci = $_SESSION['cedula'];
	include "conexionbd.php";
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
			echo "<th scope=col>Editar</th>";
			echo "<th scope=col>Eliminar</th>";
    		echo "</tr>";
						
			
			$consultaPre = "select * from preinscripcion where id_tutor='$idtutor'";
			$resultadoPre = mysql_query($consultaPre) or die (mysql_error());		
			$cantidad_asignados = mysql_num_rows($resultadoPre);
			$i=0;		
			while ($fila2 = mysql_fetch_array($resultadoPre)){
				$idestudiante = $fila2["cedula_alumno"];
							
				
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
					/*crear form para enviar a editar*/
					?>
                    <form method="post" action="" name="edit_alum" id="edit_alum">
					<?php
					echo "<td><input type=submit value=Editar>
						<input type=hidden value=".$i."</td>";
					?>
                    </form>
                    
                   <!-- crear form para enviar a borrar-->
                     <form method="post" action="" name="destroy_alum" id="destroy_alum">
					<?php
					echo "<td><input type=submit value=Eliminar>
						<input type=hidden value=".$i."</td>";
					?>
                    </form>
                    <?Php				
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
<div class="sidebar2">
  <h4 align="center">Bienvenido: <?php echo $_SESSION['usuario']?></h4>
  <p align="center"><a href="cerrarsesion.php">Cerrar Sesi&oacute;n</a></p>
    <!-- end .sidebar2 --></div>
  <div class="footer">
    <p><strong>Colegio Universitario &quot;Francisco de Miranda&quot;</strong><br />
Dirección: Av. Urdaneta. Esquina de Mijares. Parroquia Altagracia. Teléfonos: (58)(0212) 8620422 / 8646880<br />
Sistema de Gesti&oacute;n Administrativa de Pasant&iacute;a 2011 - Caracas, Venezuela.</p>
    <!-- end .footer --></div>
  <!-- end .container --></div> 
</form> 
</body>
</html>
