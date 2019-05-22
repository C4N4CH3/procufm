<?php
include ("sesiones.php");
if($_SESSION['nivel']!=$_SESSION['id']){
session_destroy();
echo "FALLA GRAVE AL SISTEMA, PERDISTE LA SESION, PARA REGRESAR AL INICIO REINICIA EL NAVEGADOR";exit();
}
$hoy = date("Y-n-j");
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
$consulta = "select * from lapso where codigo_lapso='$cod_lap'";
$resultado = mysql_query($consulta) or die (mysql_error());

if (mysql_num_rows($resultado)>0){
	header("Location: formulariocronogramapasantia.php?codexistente=si");
}
else{

	$modu_aud='CRONOGRAMAS';
	
	$acci_aud='CREAR';
	$fech_aud=date('Y/m/d');
	$hora_aud=date('G:i:s');
	$usua_aud=$_SESSION['id'];

	
	$consulta1 = "select * from fecha_eventos";
	$resultado1 = mysql_query($consulta1) or die (mysql_error());	
	$sql = "insert into fecha_eventos (fecha_diurna, fecha_vespertino, fecha_nocturno, fecha_preins)"."values ('$reunion_diurno','$reunion_vesper','$reunion_nocturno','$fecha_preinscripcion')";	
	mysql_query($sql);
	
	$tabl_aud='fecha_eventos';
	$consulta = "insert into auditoria (modulo,tabla,accion,fecha,hora,user_id)".                         //.
	"values ('$modu_aud','$tabl_aud','$acci_aud','$fech_aud','$hora_aud','$usua_aud')";
	mysql_query($consulta) or die (mysql_error());
	
	$fecha_even_id = mysql_insert_id(); //realiza despues de un INSERT para capturar el id de una tabla
	
	$insertarEstad = "insert into estadistica(alumnos_aprobados,alumnos_reprobados)"."values ('0','0')";	
	mysql_query($insertarEstad) or die(mysql_error());
	$idEstad = mysql_insert_id();	

	$tabl_aud='estadistica';
	$consulta = "insert into auditoria (modulo,tabla,accion,fecha,hora,user_id)".                         //.
	"values ('$modu_aud','$tabl_aud','$acci_aud','$fech_aud','$hora_aud','$usua_aud')";
	mysql_query($consulta) or die (mysql_error());

	
	$sql1="insert into lapso (codigo_lapso,lapso_habilitado,id_fecha_evento,fecha_registro,id_estadistica)"."VALUES ('$cod_lap','si','$fecha_even_id','$hoy','$idEstad')";
			
	$consulta2 = "select * from fecha_actividades";
	$resultado2 = mysql_query($consulta2) or die (mysql_error());
	
	$sql2="insert into fecha_actividades (codigo_lapso,fecha_inicio,fecha_culminacion,fecha_infinal,fecha_habilitado,tipo_pasantias, tipo_periodo)"."values ('$cod_lap','$fecha_tci1','$fecha_tcc1','$fecha_if1','si','tiempo completo', 'tc1')";	
			
	$sql3="insert into fecha_actividades (codigo_lapso,fecha_inicio,fecha_culminacion,fecha_infinal,fecha_habilitado,tipo_pasantias, tipo_periodo)"."values ('$cod_lap','$fecha_tci2','$fecha_tcc2','$fecha_if2','si','tiempo completo', 'tc2')";	
		
	$sql4="insert into fecha_actividades (codigo_lapso,fecha_inicio,fecha_culminacion,fecha_infinal,fecha_habilitado,tipo_pasantias, tipo_periodo)"."values ('$cod_lap','$fecha_tci3','$fecha_tcc3','$fecha_if3','si','tiempo completo', 'tc3')";	
		
	$sql5="insert into fecha_actividades (codigo_lapso,fecha_inicio,fecha_culminacion,fecha_infinal,fecha_habilitado,tipo_pasantias, tipo_periodo)"."values ('$cod_lap','$fecha_tci4','$fecha_tcc4','$fecha_if4','si','tiempo completo', 'tc4')";	
		
	$sql6="insert into fecha_actividades (codigo_lapso,fecha_inicio,fecha_culminacion,fecha_infinal,fecha_habilitado,tipo_pasantias, tipo_periodo)"."values ('$cod_lap','$fecha_mti1','$fecha_mtc1','$fecha_mtif','si','medio tiempo', 'mt1')";	
		
	$sql7="insert into fecha_actividades (codigo_lapso,fecha_inicio,fecha_culminacion,fecha_infinal,fecha_habilitado,tipo_pasantias, tipo_periodo)"."values ('$cod_lap','$fecha_li1','$fecha_lc1','$fecha_lif1','si','pasantia larga', 'pl1')";		
	
	$sql8="insert into fecha_actividades (codigo_lapso,fecha_inicio,fecha_culminacion,fecha_infinal,fecha_habilitado,tipo_pasantias, tipo_periodo)"."values ('$cod_lap','$fecha_li2','$fecha_lc2','$fecha_lif2','si','pasantia larga', 'pl2')";	
	
	$sql9="insert into fecha_actividades (codigo_lapso,fecha_inicio,fecha_culminacion,fecha_infinal,fecha_habilitado,tipo_pasantias, tipo_periodo)"."values ('$cod_lap','$fecha_li3','$fecha_lc3','$fecha_lif3','si','pasantia larga', 'pl3')";
		
	mysql_query($sql1);
	$tabl_aud='fecha_actividades';
	$consulta = "insert into auditoria (modulo,tabla,accion,fecha,hora,user_id)".                         //.
	"values ('$modu_aud','$tabl_aud','$acci_aud','$fech_aud','$hora_aud','$usua_aud')";
	mysql_query($consulta) or die (mysql_error());
	
	
	mysql_query($sql2);

	$consulta = "insert into auditoria (modulo,tabla,accion,fecha,hora,user_id)".                         //.
	"values ('$modu_aud','$tabl_aud','$acci_aud','$fech_aud','$hora_aud','$usua_aud')";
	mysql_query($consulta) or die (mysql_error());
	
	mysql_query($sql3);

	$consulta = "insert into auditoria (modulo,tabla,accion,fecha,hora,user_id)".                         //.
	"values ('$modu_aud','$tabl_aud','$acci_aud','$fech_aud','$hora_aud','$usua_aud')";
	mysql_query($consulta) or die (mysql_error());
	
	mysql_query($sql4);

	$consulta = "insert into auditoria (modulo,tabla,accion,fecha,hora,user_id)".                         //.
	"values ('$modu_aud','$tabl_aud','$acci_aud','$fech_aud','$hora_aud','$usua_aud')";
	mysql_query($consulta) or die (mysql_error());
	
	mysql_query($sql5);

	$consulta = "insert into auditoria (modulo,tabla,accion,fecha,hora,user_id)".                         //.
	"values ('$modu_aud','$tabl_aud','$acci_aud','$fech_aud','$hora_aud','$usua_aud')";
	mysql_query($consulta) or die (mysql_error());
	
	mysql_query($sql6);

	$consulta = "insert into auditoria (modulo,tabla,accion,fecha,hora,user_id)".                         //.
	"values ('$modu_aud','$tabl_aud','$acci_aud','$fech_aud','$hora_aud','$usua_aud')";
	mysql_query($consulta) or die (mysql_error());

	mysql_query($sql7);

	$consulta = "insert into auditoria (modulo,tabla,accion,fecha,hora,user_id)".                         //.
	"values ('$modu_aud','$tabl_aud','$acci_aud','$fech_aud','$hora_aud','$usua_aud')";
	mysql_query($consulta) or die (mysql_error());	
	
	mysql_query($sql8);	

	$consulta = "insert into auditoria (modulo,tabla,accion,fecha,hora,user_id)".                         //.
	"values ('$modu_aud','$tabl_aud','$acci_aud','$fech_aud','$hora_aud','$usua_aud')";
	mysql_query($consulta) or die (mysql_error());	
	
	mysql_query($sql9);

	$consulta = "insert into auditoria (modulo,tabla,accion,fecha,hora,user_id)".                         //.
	"values ('$modu_aud','$tabl_aud','$acci_aud','$fech_aud','$hora_aud','$usua_aud')";
	mysql_query($consulta) or die (mysql_error());
	
			
}
mysql_close($link);
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
    <h2 align="center">Cronograma</h2>
    <h3 align="rigth">Carga de Fechas Completada.</h3>
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
