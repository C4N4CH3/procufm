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
<title>Cronograma</title>
<script language='javascript' src="popcalendar.js"></script>
<link href="efecto.css" rel="stylesheet" type="text/css">
<script language="javascript" src="validarsesiones.js"></script>
</head>

<body>
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
    <h2 align="center">Cronograma</h2>
<h3 align="center">Fechas disponibles</h3>
<p>
  <?php
include "conexionbd.php";
$consultaLapso = "select * from lapso where lapso_habilitado='si'";
$resultadoLapso = mysql_query($consultaLapso) or die (mysql_error());
$cantidadLapso = mysql_num_rows($resultadoLapso);
if($cantidadLapso>0){	
	if($filaLapso = mysql_fetch_array($resultadoLapso)){
		$codigoLapso = $filaLapso["codigo_lapso"];
		$idFechaEvento = $filaLapso["id_fecha_evento"];
		$idLapso = $filaLapso["id_lapso"];
		$fecha = $filaLapso["fecha_registro"];	
		echo "<p align=justify><br><strong>Importante:</strong> para ingresar un nuevo c&oacute;digo de Lapso se debe deshabilitar el Vigente sino el sistema no permitir&aacute Habilitar establecer uno nuevo.</p><br>";
		echo "<table width=100%>";
		echo "<tr>";
		echo "<td align=right width=50%>Cantidad habilitado: </td>";
    	echo "<td align=left width=50%>".$cantidadLapso."</td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td align=right width=50%>C&oacute;digo:</td>";
    	echo "<td align=left width=50%>".$codigoLapso."</td>";
  		echo "</tr>";
  		echo "<tr>";
    	echo "<td align=right width=50%>Fecha de registro:</td>";
		echo "<td align=left width=50%>".$fecha."</td>";
  		echo "</tr>";
		echo "<tr>";
		echo "<td align=center width=50%><a href=cronogramapasantia.php?editar=si>Editar</a></td>";
		echo "<td align=center width=50%><a href=cronogramapasantia.php?deshabilitar=si>Deshabilitar</a></td>";
		echo "</tr>";						
	}
	echo "</table>";			
}
else{
	echo "<p align=center>No hay Codigo de Lapso <strong>Habilitado</strong></p>";
	echo "<p><font color=#FF0000>1.</font> Puedes gestionar este un nuevo Cronograma de Actividades en este enlace: <a href=formulariocronogramapasantia.php>Nuevo Cronograma</a></p>";
	echo "<p><font color=#FF0000>2.</font> Puedes ver los Historiales de Lapso en este enlace: <a href=historialcronogramapasantia.php>Historial Cronograma</a></p>";
}
?> 
</p>
<p>
<?php
if (isset($_GET["editar"]) && $_GET["editar"]=="si"){
		
	$codigoLapsoAnterior = $codigoLapso;	
	$consultaFechaEven = "select * from fecha_eventos where id_fecha_evento='$idFechaEvento'";
	$resultadoFechaEven = mysql_query($consultaFechaEven) or die (mysql_error());
	if($filaEven = mysql_fetch_array($resultadoFechaEven)){
		$fechaDiurna = $filaEven["fecha_diurna"];
		$fechaVespertino  = $filaEven["fecha_vespertino"];
		$fechaNocturno = $filaEven["fecha_nocturno"];
		$fechaPreins = $filaEven["fecha_preins"];
	}
	
	$consultaActividades1 = "select * from fecha_actividades where codigo_lapso='$codigoLapso' and tipo_pasantias='tiempo completo'";
	$resultadoActividades1 = mysql_query($consultaActividades1) or die (mysql_error());
	$i=0;
	while($filaAct1 = mysql_fetch_array($resultadoActividades1)){
		$fechaIniciotc[$i] = $filaAct1["fecha_inicio"];
		$fechaCulminaciontc[$i] = $filaAct1["fecha_culminacion"];
		$fechaInfinaltc[$i] = $filaAct1["fecha_infinal"];
		$i++;		
	}	
	
	$consultaActividades2 = "select * from fecha_actividades where codigo_lapso='$codigoLapso' and tipo_pasantias='medio tiempo'";
	$resultadoActividades2 = mysql_query($consultaActividades2) or die (mysql_error());
	$i=0;
	while($filaAct2 = mysql_fetch_array($resultadoActividades2)){
		$fechaIniciomt[$i] = $filaAct2["fecha_inicio"];
		$fechaCulminacionmt[$i] = $filaAct2["fecha_culminacion"];
		$fechaInfinalmt[$i] = $filaAct2["fecha_infinal"];
		$i++;		
	}	
	
	$consultaActividades3 = "select * from fecha_actividades where codigo_lapso='$codigoLapso' and tipo_pasantias='pasantia larga'";
	$resultadoActividades3 = mysql_query($consultaActividades3) or die (mysql_error());
	$i=0;
	while($filaAct3 = mysql_fetch_array($resultadoActividades3)){
		$fechaIniciopl[$i] = $filaAct3["fecha_inicio"];
		$fechaCulminacionpl[$i] = $filaAct3["fecha_culminacion"];
		$fechaInfinalpl[$i] = $filaAct3["fecha_infinal"];
		$i++;		
	}
	
?>
<form action="" method="post" name="form1">
<table width="100%" align="center">
  <tr>
      <td align="center" colspan="3"><strong>C&oacute;digo del Nuevo Lapso</strong></td>      
    </tr>
    <tr>
      <td align="right">Codigo de Lapso:</td>
      <td><input name="cod_lapso" type="text" value="<?php echo $codigoLapso;?>" size="10" maxlength="10"/></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td align="right" colspan="3">&nbsp;</td>
      </tr>
  <tr>
      <td align="center" colspan="3"><strong>Fecha de Charla Inducci&oacute;n</strong></td>
      </tr>
    <tr>
      <td width="31%" align="right">Diurno:</td>
      <td width="34%" align="left"><input name="reunion_diurno" id="dateArrival" type="text" value="<?php echo $fechaDiurna; ?>" size="10" maxlength="10" onClick="popUpCalendar(this, form1.dateArrival, 'yyyy-mm-dd');"/></td>
      <td width="35%" align="left">&nbsp;</td>
      </tr>
    <tr>
      <td width="31%" align="right">Vespertino:</td>
      <td width="34%" align="left"><input name="reunion_vesper" type="text" value="<?php echo $fechaVespertino; ?>" size="10" maxlength="10" id="dateArrival1" onClick="popUpCalendar(this, form1.dateArrival1, 'yyyy-mm-dd');"/></td>
      <td width="35%" align="left">&nbsp;</td>
      </tr>
    <tr>
      <td width="31%" align="right">Nocturno:</td>
      <td width="34%" align="left"><input name="reunion_nocturno" type="text" value="<?php echo $fechaNocturno; ?>" size="10" maxlength="10" id="dateArrival2" onClick="popUpCalendar(this, form1.dateArrival2, 'yyyy-mm-dd');"/></td>
      <td width="35%" align="left">&nbsp;</td>
      </tr>
    <tr>
      <td align="center" colspan="3">&nbsp;</td>
      </tr>
    <tr>
      <td align="center" colspan="3"><strong>Fecha Preinscripci&oacute;n</strong></td>
      </tr>
    <tr>
      <td width="31%" align="right">Todos los turnos:</td>
      <td width="34%" align="left"><input name="fecha_preinscripcion" type="text" value="<?php echo $fechaPreins; ?>" size="10" maxlength="10" id="dateArrival3" onClick="popUpCalendar(this, form1.dateArrival3, 'yyyy-mm-dd');"/></td>
      <td width="35%" align="left">&nbsp;</td>
      </tr>
    <tr>
      <td align="right" colspan="3">&nbsp;</td>
    </tr>    
    <tr>
      <td align="center" colspan="3"><strong>Fecha de Lapso de Pasant&iacute;a (tiempo completo)</strong></td>
      </tr>
      <td width="31%" align="center"> Inicio:
        <input name="fecha_tci1" type="text" value="<?php echo $fechaIniciotc[0]?>" size="10" maxlength="10" id="dateArrival4" onClick="popUpCalendar(this, form1.dateArrival4, 'yyyy-mm-dd');"/></td>
      <td width="34%" align="center">Culminacion:<input name="fecha_tcc1" type="text" value="<?php echo $fechaCulminaciontc[0]; ?>" size="10" maxlength="10" id="dateArrival5" onClick="popUpCalendar(this, form1.dateArrival5, 'yyyy-mm-dd');"/></td>
      <td width="35%" align="center">Informe:
        <input name="fecha_if1" type="text" value="<?php echo $fechaInfinaltc[0]; ?>" size="10" maxlength="10" id="dateArrival20" onClick="popUpCalendar(this, form1.dateArrival20, 'yyyy-mm-dd');"/></td>
      </tr>
    <tr>
      <td align="center" width="31%"> Inicio:
        <input name="fecha_tci2" type="text" value="<?php echo $fechaIniciotc[1]; ?>" size="10" maxlength="10" id="dateArrival6" onClick="popUpCalendar(this, form1.dateArrival6, 'yyyy-mm-dd');"/></td>
      <td align="center" width="34%">Culminacion:<input name="fecha_tcc2" type="text" value="<?php echo $fechaCulminaciontc[1]; ?>" size="10" maxlength="10" id="dateArrival7" onClick="popUpCalendar(this, form1.dateArrival7, 'yyyy-mm-dd');"/></td>
      <td align="center" width="35%">Informe:
        <input name="fecha_if2" type="text" value="<?php echo $fechaInfinaltc[1]; ?>" size="10" maxlength="10" id="dateArrival21" onClick="popUpCalendar(this, form1.dateArrival21, 'yyyy-mm-dd');"/></td>
    </tr>
    <tr>
      <td align="center" width="31%"> Inicio:
        <input name="fecha_tci3" type="text" value="<?php echo $fechaIniciotc[2]; ?>" size="10" maxlength="10" id="dateArrival8" onClick="popUpCalendar(this, form1.dateArrival8, 'yyyy-mm-dd');"/></td>
      <td align="center" width="34%">Culminacion:
        <input name="fecha_tcc3" type="text" value="<?php echo $fechaCulminaciontc[2]; ?>" size="10" maxlength="10" id="dateArrival9" onClick="popUpCalendar(this, form1.dateArrival9, 'yyyy-mm-dd');"/></td>
      <td align="center" width="35%">Informe:
        <input name="fecha_if3" type="text" value="<?php echo $fechaInfinaltc[2];?>" size="10" maxlength="10" id="dateArrival22" onClick="popUpCalendar(this, form1.dateArrival22, 'yyyy-mm-dd');"/></td>
    </tr>
    <tr>
      <td align="center" width="31%"> Inicio:
        <input name="fecha_tci4" type="text" value="<?php echo $fechaIniciotc[3]; ?>" size="10" maxlength="10" id="dateArrival10" onClick="popUpCalendar(this, form1.dateArrival10, 'yyyy-mm-dd');"/></td>
      <td align="center" width="34%">Culminacion:
        <input name="fecha_tcc4" type="text" value="<?php echo $fechaCulminaciontc[3]; ?>" size="10" maxlength="10" id="dateArrival11" onClick="popUpCalendar(this, form1.dateArrival11, 'yyyy-mm-dd');"/></td>
      <td align="center" width="35%">Informe:
        <input name="fecha_if4" type="text" value="<?php echo $fechaInfinaltc[3]?>" size="10" maxlength="10" id="dateArrival23" onClick="popUpCalendar(this, form1.dateArrival23, 'yyyy-mm-dd');"/></td>
    </tr>   
    <tr>
      <td align="center" colspan="3"><strong>Fecha de Lapso de Pasant&iacute;a (medio tiempo)</strong></td>
    </tr>
    <tr>
      <td align="center" width="31%"> Inicio:
        <input name="fecha_mti1" type="text" value="<?php echo $fechaIniciomt[0];?>" size="10" maxlength="10" id="dateArrival12" onClick="popUpCalendar(this, form1.dateArrival12, 'yyyy-mm-dd');"/></td>
      <td align="center" width="34%">Culminacion:
        <input name="fecha_mtc1" type="text" value="<?php echo $fechaCulminacionmt[0];?>" size="10" maxlength="10" id="dateArrival13" onClick="popUpCalendar(this, form1.dateArrival13, 'yyyy-mm-dd');"/></td>
      <td align="center" width="35%">Informe:
        <input name="fecha_mtif" type="text" value="<?php echo $fechaInfinalmt[0];?>" size="10" maxlength="10" id="dateArrival24" onClick="popUpCalendar(this, form1.dateArrival24, 'yyyy-mm-dd');"/></td>
    </tr>
    <tr>
      <td align="center" colspan="3">&nbsp;</td>
    </tr>  
    <tr>
      <td align="center" colspan="3"><strong>Fecha de Lapso de Pasantía (Largas)</strong></td>
    </tr>
    <tr>
      <td align="center" width="31%"> Inicio:
        <input name="fecha_li1" type="text" value="<?php echo $fechaIniciopl[0];?>" size="10" maxlength="10" id="dateArrival14" onClick="popUpCalendar(this, form1.dateArrival14, 'yyyy-mm-dd');"/></td>
      <td align="center" width="34%">Culminacion:
        <input name="fecha_lc1" type="text" value="<?php echo $fechaCulminacionpl[0];?>" size="10" maxlength="10" id="dateArrival15" onClick="popUpCalendar(this, form1.dateArrival15, 'yyyy-mm-dd');"/></td>
      <td align="center" width="35%">Informe:
        <input name="fecha_lif1" type="text" value="<?php echo $fechaInfinalpl[0];?>" size="10" maxlength="10" id="dateArrival25" onClick="popUpCalendar(this, form1.dateArrival25, 'yyyy-mm-dd');"/></td>
    </tr>
    <tr>
      <td align="center" width="31%"> Inicio:
        <input name="fecha_li2" type="text" value="<?php echo $fechaIniciopl[1];?>" size="10" maxlength="10" id="dateArrival16" onClick="popUpCalendar(this, form1.dateArrival16, 'yyyy-mm-dd');"/></td>
      <td align="center" width="34%">Culminacion:
        <input name="fecha_lc2" type="text" value="<?php echo $fechaCulminacionpl[1];?>" size="10" maxlength="10" id="dateArrival17" onClick="popUpCalendar(this, form1.dateArrival17, 'yyyy-mm-dd');"/></td>
      <td align="center" width="35%">Informe:
        <input name="fecha_lif2" type="text" value="<?php echo $fechaInfinalpl[1];?>" size="10" maxlength="10" id="dateArrival26" onClick="popUpCalendar(this, form1.dateArrival26, 'yyyy-mm-dd');"/></td>
    </tr>
    <tr>
      <td align="center" width="31%"> Inicio:
        <input name="fecha_li3" type="text" value="<?php echo $fechaIniciopl[2];?>" size="10" maxlength="10" id="dateArrival18" onClick="popUpCalendar(this, form1.dateArrival18, 'yyyy-mm-dd');"/></td>
      <td align="center" width="34%">Culminacion:
        <input name="fecha_lc3" type="text" value="<?php echo $fechaCulminacionpl[2];?>" size="10" maxlength="10" id="dateArrival19" onClick="popUpCalendar(this, form1.dateArrival19, 'yyyy-mm-dd');"/></td>
      <td align="center" width="35%">Informe:
        <input name="fecha_lif3" type="text" value="<?php echo $fechaInfinalpl[2];?>" size="10" maxlength="10" id="dateArrival27" onClick="popUpCalendar(this, form1.dateArrival27, 'yyyy-mm-dd');"/></td>
    </tr>
    <tr>
      <td align="center" colspan="3">&nbsp;</td>
    </tr>
    <tr>
    	<input type="hidden" name="idLapso" value="<?php echo $idLapso; ?>" />
        <input type="hidden" name="idFechaEvento" value="<?php echo $idFechaEvento; ?>" />
        <input type="hidden" name="codigoLapsoAnterior" value="<?php echo $codigoLapsoAnterior; ?>" />              
      <td align="center" width="35%"colspan="3"><input name="enviar" type="submit" value="Guardar" onclick="editarcronogram(this.form)"/></td>
      
    </tr>
</table>
</form>
<?php 
	}//cierra intruccion if (isset($_GET["editar"]) && $_GET["editar"]=="si")
?>

<?php
if (isset($_GET["deshabilitar"]) && $_GET["deshabilitar"]=="si"){
	
	$consuldeshabilitarLapso = "update lapso set lapso_habilitado='no' where codigo_lapso='$codigoLapso' and lapso_habilitado='si'";
	$deshabilitarLapso = mysql_query($consuldeshabilitarLapso) or die (mysql_error());
	
	$modu_aud='CRONOGRAMAS';
    $tabl_aud='lapso';
    $acci_aud='ACTUALIZAR';
    $fech_aud=date('Y/m/d');
    $hora_aud=date('G:i:s');
    $usua_aud=$_SESSION['id'];
    $consulta = "insert into auditoria (modulo,tabla,accion,fecha,hora,user_id)".                         //.
    "values ('$modu_aud','$tabl_aud','$acci_aud','$fech_aud','$hora_aud','$usua_aud')";
    mysql_query($consulta) or die (mysql_error());
	
	
	$consuldeshabilitarFechaAct = "update fecha_actividades set fecha_habilitado='no' where codigo_lapso='$codigoLapso' and fecha_habilitado='si'";
	$deshabilitarFechaAct = mysql_query($consuldeshabilitarFechaAct) or die (mysql_error());
	
	$modu_aud='CRONOGRAMAS';
    $tabl_aud='fecha_actividades';
    $acci_aud='ACTUALIZAR';
    $fech_aud=date('Y/m/d');
    $hora_aud=date('G:i:s');
    $usua_aud=$_SESSION['id'];
    $consulta = "insert into auditoria (modulo,tabla,accion,fecha,hora,user_id)".                         //.
    "values ('$modu_aud','$tabl_aud','$acci_aud','$fech_aud','$hora_aud','$usua_aud')";
    mysql_query($consulta) or die (mysql_error());
	
	//header("Location: cronogramapasantia.php");
	echo "<p align=center>Lapso Deshabilitado exitosamente."; 			
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
 
</body>
</html>
