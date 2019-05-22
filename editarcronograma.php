<?php
include ("sesiones.php");
if($_SESSION['nivel']!=$_SESSION['id']){
session_destroy();
echo "FALLA GRAVE AL SISTEMA, PERDISTE LA SESION, PARA REGRESAR AL INICIO REINICIA EL NAVEGADOR";exit();
}
$hoy = date("Y-n-j");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Cronograma</title>
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
    <p> Principal</p>
    <ul class="nav">
      <li><a href="sesiondepartamento.php"><img src="imagenes/blockcontentbullets.JPG" width="6" height="13" /><img src="imagenes/spacer.JPG" width="5" height="1" />Inicio</a></li>
    </ul>
    <p>Gesti&oacute;n</p>
    <ul class="nav">
      <li><a href="cronogramapasantia.php"><img src="imagenes/blockcontentbullets.JPG" width="6" height="13" /><img src="imagenes/spacer.JPG" width="5" height="1" />Cronograma</a></li>
      <li><a href="formulariocentropasantiasss.php"><img src="imagenes/blockcontentbullets.JPG" width="6" height="13" /><img src="imagenes/spacer.JPG" width="5" height="1" />Centro pasant&iacute;a</a></li>
      <li><a href="#"><img src="imagenes/blockcontentbullets.JPG" width="6" height="13" /><img src="imagenes/spacer.JPG" width="5" height="1" />Documento</a></li>        
    <li><a href="#"><img src="imagenes/blockcontentbullets.JPG" width="6" height="13" /><img src="imagenes/spacer.JPG" width="5" height="1" />Tutores Acad.</a></li>    
    <li><a href="#"><img src="imagenes/blockcontentbullets.JPG" width="6" height="13" /><img src="imagenes/spacer.JPG" width="5" height="1" />Informes</a></li> 
    <li><a href="#"><img src="imagenes/blockcontentbullets.JPG" width="6" height="13" /><img src="imagenes/spacer.JPG" width="5" height="1" />Registros</a></li>   
    </ul>
    <p>Estad&iacute;sticas</p>
    <ul class="nav">
      <li><a href="#"><img src="imagenes/blockcontentbullets.JPG" width="6" height="13" /><img src="imagenes/spacer.JPG" width="5" height="1" />Preinscritos</a></li>
      <li><a href="#"><img src="imagenes/blockcontentbullets.JPG" width="6" height="13" /><img src="imagenes/spacer.JPG" width="5" height="1" />Inscritos</a></li>
      <li><a href="#"><img src="imagenes/blockcontentbullets.JPG" width="6" height="13" /><img src="imagenes/spacer.JPG" width="5" height="1" />Aprobados</a></li>
      <li><a href="#"><img src="imagenes/blockcontentbullets.JPG" width="6" height="13" /><img src="imagenes/spacer.JPG" width="5" height="1" />Reprobados</a></li>
    </ul>
    <p>B&uacute;squeda</p>
    <ul class="nav">
      <li><a href="#"><img src="imagenes/blockcontentbullets.JPG" width="6" height="13" /><img src="imagenes/spacer.JPG" width="5" height="1" />Alumnos</a></li>
      <li><a href="#"><img src="imagenes/blockcontentbullets.JPG" width="6" height="13" /><img src="imagenes/spacer.JPG" width="5" height="1" />Empresas</a></li>
    </ul>
  <p>Ayuda</p>
    </ul>
    <ul class="nav">
      <li><a href="#">Pasos</a></li>
    </ul>
  <!-- end .sidebar1 --></div>
  <div class="content">    
    <p>
	<?php
	$idLapso = $_POST["idLapso"];
	$idFechaEvento = $_POST["idFechaEvento"];
	$codigoLapsoAnterior = $_POST["codigoLapsoAnterior"];

	//va para el tabla fecha de eventos
	$reunion_diurno = $_POST['reunion_diurno']; 
	$reunion_vesper = $_POST['reunion_vesper'];
	$reunion_nocturno = $_POST['reunion_nocturno'];
	$fecha_preinscripcion = $_POST['fecha_preinscripcion'];

	//tabla codigo de lapso
	$cod_lap = $_POST['cod_lapso'];

	//tabla fecha_actividades tiempo completo 1
	$fecha_tci1 = $_POST['fecha_tci1'];
	$fecha_tcc1 = $_POST['fecha_tcc1'];
	$fecha_if1 = $_POST['fecha_if1'];

	//tabla fecha_actividades tiempo completo 2
	$fecha_tci2 = $_POST['fecha_tci2'];
	$fecha_tcc2 = $_POST['fecha_tcc2'];
	$fecha_if2 = $_POST['fecha_if2'];

	//tabla fecha_actividades tiempo completo 3
	$fecha_tci3 = $_POST['fecha_tci3'];
	$fecha_tcc3 = $_POST['fecha_tcc3'];
	$fecha_if3 = $_POST['fecha_if3'];

	//tabla fecha_actividades tiempo completo 4
	$fecha_tci4 = $_POST['fecha_tci4'];
	$fecha_tcc4 = $_POST['fecha_tcc4'];
	$fecha_if4 = $_POST['fecha_if4'];

	//tabla fecha_actividades medio tiempo 1
	$fecha_mti1 = $_POST['fecha_mti1'];
	$fecha_mtc1 = $_POST['fecha_mtc1'];
	$fecha_mtif = $_POST['fecha_mtif'];

	//tabla fecha_actividades pasantias largas 1
	$fecha_li1 = $_POST['fecha_li1'];
	$fecha_lc1 = $_POST['fecha_lc1'];
	$fecha_lif1 = $_POST['fecha_lif1'];

	//tabla fecha_actividades pasantias largas 2
	$fecha_li2 = $_POST['fecha_li2'];
	$fecha_lc2 = $_POST['fecha_lc2'];
	$fecha_lif2 = $_POST['fecha_lif2'];

	//tabla fecha_actividades pasantias largas 3
	$fecha_li3 = $_POST['fecha_li3'];
	$fecha_lc3 = $_POST['fecha_lc3'];
	$fecha_lif3 = $_POST['fecha_lif3'];

	include "conexionbd.php";
	$consulta = "select * from lapso where id_lapso='$idLapso'";
	$resultado = mysql_query($consulta) or die (mysql_error());
	$cantidadFila = mysql_num_rows($resultado);
	if ($cantidadFila>0){	
		$actualizaLapso="update lapso set codigo_lapso='$cod_lap',lapso_habilitado='si', id_fecha_evento='$idFechaEvento', fecha_registro='$hoy' where id_lapso='$idLapso'";	
		mysql_query($actualizaLapso) or die (mysql_error());
	
		$actualizaFechaEven = "update fecha_eventos set fecha_diurna='$reunion_diurno', fecha_vespertino='$reunion_vesper', fecha_nocturno='$reunion_nocturno', fecha_preins='$fecha_preinscripcion' where id_fecha_evento='$idFechaEvento'";	
		mysql_query($actualizaFechaEven) or die (mysql_error());	
	
		$sql1="update fecha_actividades set codigo_lapso='$cod_lap', fecha_inicio='$fecha_tci1', fecha_culminacion='$fecha_tcc1', fecha_infinal='$fecha_if1' where tipo_periodo='tc1' and codigo_lapso='$codigoLapsoAnterior' and fecha_habilitado='si'";
		
		$sql2="update fecha_actividades set codigo_lapso='$cod_lap', fecha_inicio='$fecha_tci2', fecha_culminacion='$fecha_tcc2', fecha_infinal='$fecha_if2' where tipo_periodo='tc2' and codigo_lapso='$codigoLapsoAnterior' and fecha_habilitado='si'";	

		$sql3="update fecha_actividades set codigo_lapso='$cod_lap', fecha_inicio='$fecha_tci3', fecha_culminacion='$fecha_tcc3', fecha_infinal='$fecha_if3' where tipo_periodo='tc3' and codigo_lapso='$codigoLapsoAnterior' and fecha_habilitado='si'"; 

		$sql4="update fecha_actividades set codigo_lapso='$cod_lap', fecha_inicio='$fecha_tci4', fecha_culminacion='$fecha_tcc4', fecha_infinal='$fecha_if4' where tipo_periodo='tc4' and codigo_lapso='$codigoLapsoAnterior' and fecha_habilitado='si'";	

		$sql5="update fecha_actividades set codigo_lapso='$cod_lap', fecha_inicio='$fecha_mti1', fecha_culminacion='$fecha_mtc1', fecha_infinal='$fecha_mtif' where tipo_periodo='mt1' and codigo_lapso='$codigoLapsoAnterior' and fecha_habilitado='si'";
		
		$sql6="update fecha_actividades set codigo_lapso='$cod_lap', fecha_inicio='$fecha_li1', fecha_culminacion='$fecha_lc1', fecha_infinal='$fecha_lif1'	where tipo_periodo='pl1' and codigo_lapso='$codigoLapsoAnterior' and fecha_habilitado='si'";	
	
		$sql7="update fecha_actividades set codigo_lapso='$cod_lap', fecha_inicio='$fecha_li2', fecha_culminacion='$fecha_lc2', fecha_infinal='$fecha_lif2' where tipo_periodo='pl2' and codigo_lapso='$codigoLapsoAnterior' and fecha_habilitado='si'";	
	
		$sql8="update fecha_actividades set codigo_lapso='$cod_lap', fecha_inicio='$fecha_li3', fecha_culminacion='$fecha_lc3', fecha_infinal= '$fecha_lif3' where tipo_periodo='pl3' and codigo_lapso='$codigoLapsoAnterior' and fecha_habilitado='si'";		
	
		mysql_query($sql1);
		$modu_aud='CRONOGRAMAS';
		$tabl_aud='fecha_actividades';
		$acci_aud='ACTUALIZAR';
		$fech_aud=date('Y/m/d');
		$hora_aud=date('G:i:s');
		$usua_aud=$_SESSION['id'];
		$consulta = "insert into auditoria (modulo,tabla,accion,fecha,hora,user_id)".                         //.
		"values ('$modu_aud','$tabl_aud','$acci_aud','$fech_aud','$hora_aud','$usua_aud')";
		mysql_query($consulta) or die (mysql_error());
		
		mysql_query($sql2);
		$modu_aud='CRONOGRAMAS';
		$tabl_aud='fecha_actividades';
		$acci_aud='ACTUALIZAR';
		$fech_aud=date('Y/m/d');
		$hora_aud=date('G:i:s');
		$usua_aud=$_SESSION['id'];
		$consulta = "insert into auditoria (modulo,tabla,accion,fecha,hora,user_id)".                         //.
		"values ('$modu_aud','$tabl_aud','$acci_aud','$fech_aud','$hora_aud','$usua_aud')";
		mysql_query($consulta) or die (mysql_error());
		
		mysql_query($sql3);
		$modu_aud='CRONOGRAMAS';
		$tabl_aud='fecha_actividades';
		$acci_aud='ACTUALIZAR';
		$fech_aud=date('Y/m/d');
		$hora_aud=date('G:i:s');
		$usua_aud=$_SESSION['id'];
		$consulta = "insert into auditoria (modulo,tabla,accion,fecha,hora,user_id)".                         //.
		"values ('$modu_aud','$tabl_aud','$acci_aud','$fech_aud','$hora_aud','$usua_aud')";
		mysql_query($consulta) or die (mysql_error());		
		
		mysql_query($sql4);
		$modu_aud='CRONOGRAMAS';
		$tabl_aud='fecha_actividades';
		$acci_aud='ACTUALIZAR';
		$fech_aud=date('Y/m/d');
		$hora_aud=date('G:i:s');
		$usua_aud=$_SESSION['id'];
		$consulta = "insert into auditoria (modulo,tabla,accion,fecha,hora,user_id)".                         //.
		"values ('$modu_aud','$tabl_aud','$acci_aud','$fech_aud','$hora_aud','$usua_aud')";
		mysql_query($consulta) or die (mysql_error());		
		
		mysql_query($sql5);
		$modu_aud='CRONOGRAMAS';
		$tabl_aud='fecha_actividades';
		$acci_aud='ACTUALIZAR';
		$fech_aud=date('Y/m/d');
		$hora_aud=date('G:i:s');
		$usua_aud=$_SESSION['id'];
		$consulta = "insert into auditoria (modulo,tabla,accion,fecha,hora,user_id)".                         //.
		"values ('$modu_aud','$tabl_aud','$acci_aud','$fech_aud','$hora_aud','$usua_aud')";
		mysql_query($consulta) or die (mysql_error());
		
		mysql_query($sql6);
		$modu_aud='CRONOGRAMAS';
		$tabl_aud='fecha_actividades';
		$acci_aud='ACTUALIZAR';
		$fech_aud=date('Y/m/d');
		$hora_aud=date('G:i:s');
		$usua_aud=$_SESSION['id'];
		$consulta = "insert into auditoria (modulo,tabla,accion,fecha,hora,user_id)".                         //.
		"values ('$modu_aud','$tabl_aud','$acci_aud','$fech_aud','$hora_aud','$usua_aud')";
		mysql_query($consulta) or die (mysql_error());
		
		mysql_query($sql7);	
		$modu_aud='CRONOGRAMAS';
		$tabl_aud='fecha_actividades';
		$acci_aud='ACTUALIZAR';
		$fech_aud=date('Y/m/d');
		$hora_aud=date('G:i:s');
		$usua_aud=$_SESSION['id'];
		$consulta = "insert into auditoria (modulo,tabla,accion,fecha,hora,user_id)".                         //.
		"values ('$modu_aud','$tabl_aud','$acci_aud','$fech_aud','$hora_aud','$usua_aud')";
		mysql_query($consulta) or die (mysql_error());
		
		mysql_query($sql8);
		$modu_aud='CRONOGRAMAS';
		$tabl_aud='fecha_actividades';
		$acci_aud='ACTUALIZAR';
		$fech_aud=date('Y/m/d');
		$hora_aud=date('G:i:s');
		$usua_aud=$_SESSION['id'];
		$consulta = "insert into auditoria (modulo,tabla,accion,fecha,hora,user_id)".                         //.
		"values ('$modu_aud','$tabl_aud','$acci_aud','$fech_aud','$hora_aud','$usua_aud')";
		mysql_query($consulta) or die (mysql_error());		
		
		echo "<h2 align=center>Cronograma</h2>";
    	echo "<h3 align=rigth>Fechas Guardadas exitosamente.</h3>";
}
else{
	echo "<br>No se encontr&oacute; el Lapso respectivo.";		
}
mysql_close($link);
  
  ?>
    
    </p>    
  </div>
<div class="sidebar2">
  <h4 align="center">Bienvenido: <?php echo $_SESSION['usuario']?></h4>
  <p align="center"><a href="cerrarsesion.php">Cerrar Sesi&oacute;n</a></p>
  <p align="center">
  <!-- end .sidebar2 --></p>
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
