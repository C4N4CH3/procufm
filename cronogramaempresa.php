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
   <p>Principal 
    </p>
    <ul class="nav">
      <li><a href="sesionempresa.php"><img src="imagenes/blockcontentbullets.JPG" width="6" height="13" /><img src="imagenes/spacer.JPG" width="5" height="1" />Inicio</a></li>
      
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
		$fecha = $filaLapso["fecha_registro"];	
		
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
	}


?>
<table width="60%" align="center" border="1">
  <tr>
      <td align="center" colspan="3" bgcolor="#FFFF00"><strong>C&oacute;digo de  Lapso Vigente</strong></td>      
    </tr>
    <tr>
      <td width="47%" align="right">Codigo de Lapso:</td>
      <td width="53%"><?php echo $codigoLapso;?></td>
    </tr>
    </table><br>
    <table width="60%" align="center" border="1">
  <tr>
      <td align="center" colspan="3" bgcolor="#FFFF00"><strong>Fecha de Charla Inducci&oacute;n</strong></td>
      </tr>
    <tr>
      <td width="47%" align="right">Diurno:</td>
      <td width="53%" align="left"><?php echo $fechaDiurna; ?></td>
      </tr>
    <tr>
      <td width="47%" align="right">Vespertino:</td>
      <td width="53%" align="left"><?php echo $fechaVespertino; ?></td>
      </tr>
    <tr>
      <td width="47%" align="right">Nocturno:</td>
      <td width="53%" align="left"><?php echo $fechaNocturno; ?></td>
      </tr>
    </table><br>
    <table width="60%" align="center" border="1">
    <tr>
      <td align="center" colspan="3" bgcolor="#FFFF00"><strong>Fecha Preinscripci&oacute;n</strong></td>
      </tr>
    <tr>
      <td width="31%" align="right">Todos los turnos:</td>
      <td width="34%" align="left"><?php echo $fechaPreins; ?></td>
      </tr>
    </table><br>
    <table width="100%" align="center" border="1">   
    <tr>
      <td align="center" colspan="3" bgcolor="#FFFF00"><strong>Fecha de Lapso de Pasant&iacute;a (tiempo completo)</strong></td>
      </tr>
      <td width="27%" align="center"> Inicio:
        <?php echo $fechaIniciotc[0]?></td>
      <td width="42%" align="center">Culminacion:<?php echo $fechaCulminaciontc[0]; ?></td>
      <td width="31%" align="center">Informe:
        <?php echo $fechaInfinaltc[0]; ?></td>
      </tr>
    <tr>
      <td align="center" width="27%"> Inicio:
        <?php echo $fechaIniciotc[1]; ?></td>
      <td align="center" width="42%">Culminacion:<?php echo $fechaCulminaciontc[1]; ?></td>
      <td align="center" width="31%">Informe:
        <?php echo $fechaInfinaltc[1]; ?></td>
    </tr>
    <tr>
      <td align="center" width="27%"> Inicio:
        <?php echo $fechaIniciotc[2]; ?></td>
      <td align="center" width="42%">Culminacion:
        <?php echo $fechaCulminaciontc[2]; ?></td>
      <td align="center" width="31%">Informe:
        <?php echo $fechaInfinaltc[2];?></td>
    </tr>
    <tr>
      <td align="center" width="27%"> Inicio:
        <?php echo $fechaIniciotc[3]; ?></td>
      <td align="center" width="42%">Culminacion:
        <?php echo $fechaCulminaciontc[3]; ?></td>
      <td align="center" width="31%">Informe:
        <?php echo $fechaInfinaltc[3]?></td>
    </tr>
    </table><br>
    <table width="100%" align="center" border="1">   
    <tr>
      <td align="center" colspan="3" bgcolor="#FFFF00"><strong>Fecha de Lapso de Pasant&iacute;a (medio tiempo)</strong></td>
    </tr>
    <tr>
      <td align="center" width="27%"> Inicio:
        <?php echo $fechaIniciomt[0];?></td>
      <td align="center" width="42%">Culminacion:
        <?php echo $fechaCulminacionmt[0];?></td>
      <td align="center" width="31%">Informe:
        <?php echo $fechaInfinalmt[0];?></td>
    </tr>
    </table><br>
    <table width="100%" align="center" border="1"> 
    <tr>
      <td align="center" colspan="3" bgcolor="#FFFF00"><strong>Fecha de Lapso de Pasantía (Largas)</strong></td>
    </tr>
    <tr>
      <td align="center" width="27%"> Inicio:
        <?php echo $fechaIniciopl[0];?></td>
      <td align="center" width="42%">Culminacion:
        <?php echo $fechaCulminacionpl[0];?></td>
      <td align="center" width="31%">Informe:
        <?php echo $fechaInfinalpl[0];?></td>
    </tr>
    <tr>
      <td align="center" width="27%"> Inicio:
        <?php echo $fechaIniciopl[1];?></td>
      <td align="center" width="42%">Culminacion:
        <?php echo $fechaCulminacionpl[1];?></td>
      <td align="center" width="31%">Informe:
        <?php echo $fechaInfinalpl[1];?></td>
    </tr>
    <tr>
      <td align="center" width="27%"> Inicio:
        <?php echo $fechaIniciopl[2];?></td>
      <td align="center" width="42%">Culminacion:
       <?php echo $fechaCulminacionpl[2];?></td>
      <td align="center" width="31%">Informe:
        <?php echo $fechaInfinalpl[2];?></td>
    </tr>
</table>
</p>
<?php
	}
	else {
		echo "<br>No hay C&oacute;digo de Lapso Vigente";
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
</div>
  <div class="footer">
    <p><strong>Colegio Universitario &quot;Francisco de Miranda&quot;</strong><br />
Dirección: Av. Urdaneta. Esquina de Mijares. Parroquia Altagracia. Teléfonos: (58)(0212) 8620422 / 8646880<br />
Sistema de Gesti&oacute;n Administrativa de Pasant&iacute;a 2011 - Caracas, Venezuela.</p>
    <!-- end .footer --></div>
  <!-- end .container --></div> 
 
</body>
</html>
