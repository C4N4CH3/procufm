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
<title>Centro de Pasantía</title>
<link href="efecto.css" rel="stylesheet" type="text/css">
<script language="javascript" src="validarsesiones.js"></script>
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
    <h1>Centro de Pasant&iacute;a</h1>    
    <p>
    <?php
    $nombre = $_POST['nombre'];
	$ubicacion = $_POST['ubicacion'];
	$num_pasante = $_POST['num_pasante'];
	$carrera = $_POST['carrera'];
	$mencion = $_POST['mencion'];

	include "conexionbd.php";
	$consulta = "insert into vacante_departamento (nombre,ubicacion,numero_pasantes,vacante_carrera,vacante_mencion)"."values ('$nombre','$ubicacion','$num_pasante','$carrera','$mencion')";
	mysql_query($consulta) or die (mysql_error());

        $modu_aud='CENTROS DE PASANTIA';
        $tabl_aud='vacante_departamento';
        $acci_aud='CREAR';
        $fech_aud=date('Y/m/d');
        $hora_aud=date('G:i:s');
        $usua_aud=$_SESSION['id'];
        $consulta = "insert into auditoria (modulo,tabla,accion,fecha,hora,user_id)".                         //.
        "values ('$modu_aud','$tabl_aud','$acci_aud','$fech_aud','$hora_aud','$usua_aud')";
        mysql_query($consulta) or die (mysql_error());
	
    echo "Centro de pasantia cargado exitosamente.";
	mysql_close($link);
	?>
    </p>
</div>
<div class="sidebar2">
  <h4 align="center">Bienvenido: <?php echo $_SESSION['usuario']?></h4>
  <p align="center"><a href="cerrarsesion.php">Cerrar Sesi&oacute;n</a>    <!-- end .sidebar2 --></p>
</div>
  <div class="footer">
    <p><strong>Colegio Universitario &quot;Francisco de Miranda&quot;</strong><br />
Dirección: Av. Urdaneta. Esquina de Mijares. Parroquia Altagracia. Teléfonos: (58)(0212) 8620422 / 8646880<br />
Sistema de Gesti&oacute;n Administrativa de Pasant&iacute;a 2014 - Caracas, Venezuela.</p>
    <!-- end .footer --></div>
  <!-- end .container --></div> 
</form>
</body>
</html>
