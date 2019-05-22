<?php
include_once '../sesiones.php';
if($_SESSION['nivel']!=$_SESSION['id']){
session_destroy();
echo "FALLA GRAVE AL SISTEMA, PERDISTE LA SESION, PARA REGRESAR AL INICIO REINICIA EL NAVEGADOR";exit();
}

function formatear_fecha($fe){
    $trozo = explode("-", $fe);
    $fecha = $trozo[2]."-".$trozo[1]."-".$trozo[0];
    return $fecha;
}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Cronograma</title>
<link href="../css/bootstrap/3.3.0/bootstrap.min.css" rel="stylesheet">
<link href="../css/material/roboto.min.css" rel="stylesheet">
<link href="../css/material/material.min.css" rel="stylesheet">
<link href="../css/material/ripples.min.css" rel="stylesheet">
<link href="../css/material/materialmodif.css" rel="stylesheet">
</head>
<body>
<?php include_once '../navbar.php';?>
    <?php require_once 'menu.php';?>
 <div class="well col-md-9 col-lg-9 col-sm-9 col-xs-9" style="margin-left:20px">
    <h2 align="center">Cronograma</h2>
<h3 align="center">Fechas disponibles</h3>
<p>
<?php
include_once '../conexionbd.php'; 
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
    Para generar el detalle en PDF: 
        <a href="verPdfCronograma.php" target="_blank" class="iredit">Ver PDF</a><br>
<table width="47%" align="center" border="1">
  <tr>
      <td align="center" colspan="3" bgcolor="#FFFF00"><strong>C&oacute;digo de  Lapso Vigente</strong></td>      
    </tr>
    <tr>
      <td width="47%" align="right">Codigo de Lapso:</td>
      <td width="53%"><?php echo $codigoLapso;?></td>
    </tr>
    </table><br>
    <table width="47%" align="center" border="1">
  <tr>
      <td align="center" colspan="3" bgcolor="#FFFF00"><strong>Fecha de Charla Inducci&oacute;n</strong></td>
      </tr>
    <tr>
      <td width="47%" align="right">Diurno:</td>
      <td width="53%" align="left"><?php echo formatear_fecha($fechaDiurna); ?></td>
      </tr>
    <tr>
      <td width="47%" align="right">Vespertino:</td>
      <td width="53%" align="left"><?php echo formatear_fecha($fechaVespertino) ?></td>
      </tr>
    <tr>
      <td width="47%" align="right">Nocturno:</td>
      <td width="53%" align="left"><?php echo formatear_fecha($fechaNocturno) ?></td>
      </tr>
    </table><br>
    <table width="47%" align="center" border="1">
    <tr>
      <td align="center" colspan="3" bgcolor="#FFFF00"><strong>Fecha Preinscripci&oacute;n</strong></td>
      </tr>
    <tr>
      <td width="31%" align="right">Todos los turnos:</td>
      <td width="34%" align="left"><?php echo formatear_fecha($fechaPreins) ?></td>
      </tr>
    </table><br>
    <table width="100%" align="center" border="1">   
    <tr>
      <td align="center" colspan="3" bgcolor="#FFFF00"><strong>Fecha de Lapso de Pasant&iacute;a (tiempo completo)</strong></td>
      </tr>
      <td width="27%" align="center"> Inicio:
        <?php echo formatear_fecha($fechaIniciotc[0])?></td>
      <td width="42%" align="center">Culminacion:<?php echo formatear_fecha($fechaCulminaciontc[0]) ?></td>
      <td width="31%" align="center">Informe:
        <?php echo formatear_fecha($fechaInfinaltc[0]) ?></td>
      </tr>
    <tr>
      <td align="center" width="27%"> Inicio:
        <?php echo formatear_fecha($fechaIniciotc[1]) ?></td>
      <td align="center" width="42%">Culminacion:<?php echo formatear_fecha($fechaCulminaciontc[1]) ?></td>
      <td align="center" width="31%">Informe:
        <?php echo formatear_fecha($fechaInfinaltc[1]) ?></td>
    </tr>
    <tr>
      <td align="center" width="27%"> Inicio:
        <?php echo formatear_fecha($fechaIniciotc[2]) ?></td>
      <td align="center" width="42%">Culminacion:
        <?php echo formatear_fecha($fechaCulminaciontc[2]) ?></td>
      <td align="center" width="31%">Informe:
        <?php echo formatear_fecha($fechaInfinaltc[2]) ?></td>
    </tr>
    <tr>
      <td align="center" width="27%"> Inicio:
        <?php echo formatear_fecha($fechaIniciotc[3]) ?></td>
      <td align="center" width="42%">Culminacion:
        <?php echo formatear_fecha($fechaCulminaciontc[3]) ?></td>
      <td align="center" width="31%">Informe:
        <?php echo formatear_fecha($fechaInfinaltc[3]) ?></td>
    </tr>
    </table><br>
    <table width="100%" align="center" border="1">   
    <tr>
      <td align="center" colspan="3" bgcolor="#FFFF00"><strong>Fecha de Lapso de Pasant&iacute;a (medio tiempo)</strong></td>
    </tr>
    <tr>
      <td align="center" width="27%"> Inicio:
        <?php echo formatear_fecha($fechaIniciomt[0]) ?></td>
      <td align="center" width="42%">Culminacion:
        <?php echo formatear_fecha($fechaCulminacionmt[0]) ?></td>
      <td align="center" width="31%">Informe:
        <?php echo formatear_fecha($fechaInfinalmt[0]) ?></td>
    </tr>
    </table><br>
    <table width="100%" align="center" border="1"> 
    <tr>
      <td align="center" colspan="3" bgcolor="#FFFF00"><strong>Fecha de Lapso de Pasantía (Largas)</strong></td>
    </tr>
    <tr>
      <td align="center" width="27%"> Inicio:
        <?php echo formatear_fecha($fechaIniciopl[0])?></td>
      <td align="center" width="42%">Culminacion:
        <?php echo formatear_fecha($fechaCulminacionpl[0])?></td>
      <td align="center" width="31%">Informe:
        <?php echo formatear_fecha($fechaInfinalpl[0])?></td>
    </tr>
    <tr>
      <td align="center" width="27%"> Inicio:
        <?php echo formatear_fecha($fechaIniciopl[1])?></td>
      <td align="center" width="42%">Culminacion:
        <?php echo formatear_fecha($fechaCulminacionpl[1])?></td>
      <td align="center" width="31%">Informe:
        <?php echo formatear_fecha($fechaInfinalpl[1])?></td>
    </tr>
    <tr>
      <td align="center" width="27%"> Inicio:
        <?php echo formatear_fecha($fechaIniciopl[2])?></td>
      <td align="center" width="42%">Culminacion:
       <?php echo formatear_fecha($fechaCulminacionpl[2])?></td>
      <td align="center" width="31%">Informe:
        <?php echo formatear_fecha($fechaInfinalpl[2])?></td>
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
