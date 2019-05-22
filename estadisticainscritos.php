<?php
include ("sesiones.php");
if($_SESSION['nivel']!=$_SESSION['id']){
session_destroy();
echo "FALLA GRAVE AL SISTEMA, PERDISTE LA SESION, PARA REGRESAR AL INICIO REINICIA EL NAVEGADOR";exit();
}
?>  
  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title> Alumnos Inscritos </title>
<script language='javascript' src="popcalendar.js"></script>
<link href="efecto.css" rel="stylesheet" type="text/css">
<script language="javascript" src="validarsesiones.js"></script>
</head>

<body>
<form action="" method="post" name="form1">
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
      <li><a href="sesiondepartamento.php"><img src="imagenes/blockcontentbullets.JPG" width="6" height="13" /><img src="imagenes/spacer.JPG" width="5" height="1" />Inicio</a></li>  
    </ul>
    <p>Gesti&oacute;n</p>
    <ul class="nav">
      <li><a href="cronogramapasantia.php"><img src="imagenes/blockcontentbullets.JPG" width="6" height="13" /><img src="imagenes/spacer.JPG" width="5" height="1" />Cronograma</a></li>
      <li><a href="formulariocentropasantiasss.php"><img src="imagenes/blockcontentbullets.JPG" width="6" height="13" /><img src="imagenes/spacer.JPG" width="5" height="1" />Centro pasant&iacute;a</a></li>
      <li><a href="documentodepartamento.php"><img src="imagenes/blockcontentbullets.JPG" width="6" height="13" /><img src="imagenes/spacer.JPG" width="5" height="1" />Documento</a></li>        
    <li><a href="documentotutor.php"><img src="imagenes/blockcontentbullets.JPG" width="6" height="13" /><img src="imagenes/spacer.JPG" width="5" height="1" />Tutores Acad.</a></li>    
    <li><a href="informedepartamento.php"><img src="imagenes/blockcontentbullets.JPG" width="6" height="13" /><img src="imagenes/spacer.JPG" width="5" height="1" />Informes</a></li>   
    </ul>
    <p>Estad&iacute;sticas</p>
    <ul class="nav">
      <li><a href="estadisticapreinscritos.php"><img src="imagenes/blockcontentbullets.JPG" width="6" height="13" /><img src="imagenes/spacer.JPG" width="5" height="1" />Preinscritos</a></li>
      <li><a href="estadisticainscritos.php"><img src="imagenes/blockcontentbullets.JPG" width="6" height="13" /><img src="imagenes/spacer.JPG" width="5" height="1" />Inscritos</a></li>
      <li><a href="estadisticaprobados.php"><img src="imagenes/blockcontentbullets.JPG" width="6" height="13" /><img src="imagenes/spacer.JPG" width="5" height="1" />Aprobados</a></li>
      <li><a href="estadisticareprobados.php"><img src="imagenes/blockcontentbullets.JPG" width="6" height="13" /><img src="imagenes/spacer.JPG" width="5" height="1" />Reprobados</a></li>
    </ul>
    <p>B&uacute;squeda</p>
    <ul class="nav">
      <li><a href="buscaralumnos.php"><img src="imagenes/blockcontentbullets.JPG" width="6" height="13" /><img src="imagenes/spacer.JPG" width="5" height="1" />Alumnos</a></li>
    </ul>
  <!-- end .sidebar1 --></div>
  <div class="content">
  <blockquote>
    <h2>Alumnos Inscritos</h2>
  </blockquote>
<p align="justify"> Consulta la informaci&oacute;n sobre los alumnos que   han gestionado y poseen estatus de inscripci&oacute;n.  </font></p>
<p align="center"> Informaci&oacute;n detallada: </p>

<p>	
<?php 
include "conexionbd.php";
$consultaLapso = "select * from lapso where lapso_habilitado='si'";
$resultadoLapso = mysql_query($consultaLapso) or die (mysql_error());
if ($filalapso = mysql_fetch_array($resultadoLapso)){	
	$codigoLapso = $filalapso["codigo_lapso"];
	$idLapso = $filalapso["id_lapso"];
	echo "<p>C&oacute;digo de lapso habilitado: ".$codigoLapso."</p>";
		
	$consultaPre = "select * from preinscripcion where codigo_lapso='$idLapso'";
	$resultadoPre = mysql_query($consultaPre) or die (mysql_error());		
	$cantidad_asignados = mysql_num_rows($resultadoPre);
	$i=0;
	if($cantidad_asignados>0){
		echo "<table width=100% border=1>";
		echo "<tr>";
		echo "<th scope=col width=10%>#</th>";
		echo "<th scope=col width=20%>Nombre</th>";
    	echo "<th scope=col width=20%>C&eacute;dula</th>";
		echo "<th scope=col width=10%>Carnet</th>";
		echo "<th scope=col width=30%>Carrera</th>";
		echo "<th scope=col width=10%>Menci&oacute;n</th>";
    	echo "</tr>";
			
	
		while ($fila2 = mysql_fetch_array($resultadoPre)){
			$ciAlum = $fila2["cedula_alumno"];
		
			$consultaTablAlum = "select * from alumno where cedula_alumno='$ciAlum' and id_estatus='2'";
			$resultadoTablAlum = mysql_query($consultaTablAlum) or die (mysql_error());			
			if($filAlum = mysql_fetch_array($resultadoTablAlum)){			
				$carrera = $filAlum["id_carrera"];
				$mencion = $filAlum["id_mencion"];			
			
				$consulta2 = "select * from tipo_carrera where id_carrera='$carrera'";
				$nombre_carrera = mysql_query($consulta2) or die (mysql_error());

				if ($filacar = mysql_fetch_array($nombre_carrera)){
    				$nombre_car = $filacar["nombre"];
				}

				$consulta3 = "select * from tipo_mencion where id_mencion='$mencion'";;
				$nombre_mencion = mysql_query($consulta3) or die (mysql_error());
 
				if ($filamen = mysql_fetch_array($nombre_mencion)){
    				$nombre_men = $filamen["nombre"];
				}
						
				$i++;
				echo "<tr>";
    			echo "<td>".$i."</td>";
    			echo "<td>".$filAlum["nombre"]." ".$filAlum["apellido"]."</td>";
    			echo "<td>".$filAlum["cedula_alumno"]."</td>";
				echo "<td>".$filAlum["carnet"]."</td>";
				echo "<td>".$nombre_car."</td>";
				echo "<td>".$nombre_men."</td>";
    			echo "</tr>";			
			}
		}
		echo "</table>";
		echo "<p align=right><br>Total de Alumnos: ".$i."</p>";
	}
	else{
		echo "<br>No hay Alumnos Inscritos";
	}
}
?>
</p>

<?php 
	mysql_close($link);
?>
</div>
<div class="sidebar2">
  <h4 align="center">Bienvenido: <?php echo $_SESSION['usuario']?></h4>
  <p align="center"><a href="cerrarsesion.php">Cerrar Sesi&oacute;n</a></p>
</div>
<div class="footer">
    <p><strong>Colegio Universitario &quot;Francisco de Miranda&quot;</strong><br />
Dirección: Av. Urdaneta. Esquina de Mijares. Parroquia Altagracia. Teléfonos: (58)(0212) 8620422 / 8646880<br />
Sistema de Gesti&oacute;n Administrativa de Pasant&iacute;a 2011 - Caracas, Venezuela.</p>
    <!-- end .footer --></div>
  <!-- end .container --></div> 
</form> 
</body>
</html>