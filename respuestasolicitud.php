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
<title>Registro Empresa</title>
<link href="efecto.css" rel="stylesheet" type="text/css">
<script language="javascript" src="funciones.js"></script>
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
    <p>Principal 
    </p>
    <ul class="nav">
      <li><a href="#"><img src="imagenes/blockcontentbullets.JPG" width="6" height="13" /><img src="imagenes/spacer.JPG" width="5" height="1" />Inicio</a></li>
      
  Pasantes 
    </ul>
    <ul class="nav">
      <li><a href="solicitudpasante.php"><img src="imagenes/blockcontentbullets.JPG" width="6" height="13" /><img src="imagenes/spacer.JPG" width="5" height="1" />Solicitud </a></li>
      <li><a href="respuestasolicitud.php"><img src="imagenes/blockcontentbullets.JPG" width="6" height="13" /><img src="imagenes/spacer.JPG" width="5" height="1" />Respuesta</a></li>
      
  Fechas
    </ul>
    <ul class="nav">
      <li><a href="cronogramaempresa.php"><img src="imagenes/blockcontentbullets.JPG" width="6" height="13" /><img src="imagenes/spacer.JPG" width="5" height="1" />Cronograma</a></li>
    </ul>
  <!-- end .sidebar1 --></div>
  <div class="content">
    <blockquote>
      <h2>Respuesta de Solicitud </h2>
</blockquote> 
    
    <p><!-- end .content --></p>
    <p><?php
    include "conexionbd.php";
	$rif = $_SESSION['cedula'];
	
	$i=1;
	$consultaVacanteEmp = "select * from vacante_empresa where rif='$rif'";
	$resultadoVacanteEmp = mysql_query($consultaVacanteEmp) or die (mysql_error());
	echo "<p align=justify>A continuaci&oacute;n se presentan las solicitudes enviadas por Ud.";
	echo "<table width=100% border=1>";
	echo "<tr>";
	echo "<th scope=col>#</th>";
	echo "<th scope=col>Fecha</th>";
	echo "<th scope=col>Carrera</th>";
	echo "<th scope=col>Menci&oacute;n</th>";
	echo "<th scope=col>Cantidad</th>";
    echo "<th scope=col>Estado</th>";	
    echo "</tr>";	
	while($fila = mysql_fetch_array($resultadoVacanteEmp)){	
		$carrera = $fila["vacante_carrera"];
		$mencion = $fila["vacante_mencion"];
		
		
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
		
		
		echo "<tr>";						
		echo "<td>".$i++."</td>"; 							
		echo "<td>".$fila["fecha_registro"]."</td>";					
    	echo "<td>".$nombre_car."</td>";
		echo "<td>".$nombre_men."</td>";
		echo "<td>".$fila["num_pasantes"]."</td>";
		echo "<td>".$fila["estado_solicitud"]."</td>";
		echo "</tr>";
	}
	echo "</table>";
	
	?>
    
    
    
	</p>
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