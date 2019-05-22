<?php
include_once'../sesiones.php';
if($_SESSION['nivel']!=$_SESSION['id']){
session_destroy();
echo "FALLA GRAVE AL SISTEMA, PERDISTE LA SESION, PARA REGRESAR AL INICIO REINICIA EL NAVEGADOR";exit();
}
?>

<?php
if (isset($_POST["btn1"])) {
    $hoy = date("Y-n-j");
    //va para el tabla fecha de eventos
    $reunion_diurno = $_POST['reunion_diurno'];
    $trozo = explode("-", $reunion_diurno);
    $reunion_diurno = $trozo[2].$trozo[1].$trozo[0];
    
    
    
    $reunion_vesper = $_POST['reunion_vesper'];
    
    $trozo = explode("-", $reunion_vesper);
    $reunion_vesper = $trozo[2].$trozo[1].$trozo[0];
    
    $reunion_nocturno = $_POST['reunion_nocturno'];
    $trozo = explode("-", $reunion_nocturno);
    $reunion_nocturno = $trozo[2].$trozo[1].$trozo[0];
    
    
    $fecha_preinscripcion = $_POST['fecha_preinscripcion'];
    $trozo = explode("-", $fecha_preinscripcion);
    $fecha_preinscripcion = $trozo[2].$trozo[1].$trozo[0];
    
    
    //tabla codigo de lapso
    $cod_lap = $_POST['cod_lapso'];

    //tabla fecha_actividades tiempo completo 1
    $fecha_tci1 = $_POST['fecha_tci1'];
    $trozo = explode("-", $fecha_tci1);
    $fecha_tci1 = $trozo[2].$trozo[1].$trozo[0];
    $fecha_tcc1 = $_POST['fecha_tcc1'];
    $trozo = explode("-", $fecha_tcc1);
    $fecha_tcc1 = $trozo[2].$trozo[1].$trozo[0];
    $fecha_if1 = $_POST['fecha_if1'];
    $trozo = explode("-", $fecha_if1);
    $fecha_if1 = $trozo[2].$trozo[1].$trozo[0];

    //tabla fecha_actividades tiempo completo 2
    $fecha_tci2 = $_POST['fecha_tci2'];
    $trozo = explode("-", $fecha_tci2);
    $fecha_tci2 = $trozo[2].$trozo[1].$trozo[0];
    $fecha_tcc2 = $_POST['fecha_tcc2'];
    $trozo = explode("-", $fecha_tcc2);
    $fecha_tcc2 = $trozo[2].$trozo[1].$trozo[0];
    $fecha_if2 = $_POST['fecha_if2'];
    $trozo = explode("-", $fecha_if2);
    $fecha_if2 = $trozo[2].$trozo[1].$trozo[0];

    //tabla fecha_actividades tiempo completo 3
    $fecha_tci3 = $_POST['fecha_tci3'];
    $trozo = explode("-", $fecha_tci3);
    $fecha_tci3 = $trozo[2].$trozo[1].$trozo[0];
    $fecha_tcc3 = $_POST['fecha_tcc3'];
    $trozo = explode("-", $fecha_tcc3);
    $fecha_tcc3 = $trozo[2].$trozo[1].$trozo[0];
    $fecha_if3 = $_POST['fecha_if3'];
    $trozo = explode("-", $fecha_if3);
    $fecha_if3 = $trozo[2].$trozo[1].$trozo[0];

    //tabla fecha_actividades tiempo completo 4
    $fecha_tci4 = $_POST['fecha_tci4'];
    $trozo = explode("-", $fecha_tci4);
    $fecha_tci4 = $trozo[2].$trozo[1].$trozo[0];
    $fecha_tcc4 = $_POST['fecha_tcc4'];
    $trozo = explode("-", $fecha_tcc4);
    $fecha_tcc4 = $trozo[2].$trozo[1].$trozo[0];
    $fecha_if4 = $_POST['fecha_if4'];
    $trozo = explode("-", $fecha_if4);
    $fecha_if4 = $trozo[2].$trozo[1].$trozo[0];

    //tabla fecha_actividades medio tiempo 1
    $fecha_mti1 = $_POST['fecha_mti1'];
    $trozo = explode("-", $fecha_mti1);
    $fecha_mti1 = $trozo[2].$trozo[1].$trozo[0];
    $fecha_mtc1 = $_POST['fecha_mtc1'];
    $trozo = explode("-", $fecha_mtc1);
    $fecha_mtc1 = $trozo[2].$trozo[1].$trozo[0];
    $fecha_mtif = $_POST['fecha_mtif'];
    $trozo = explode("-", $fecha_mtif);
    $fecha_mtif = $trozo[2].$trozo[1].$trozo[0];

    //tabla fecha_actividades pasantias largas 1
    $fecha_li1 = $_POST['fecha_li1'];
    $trozo = explode("-", $fecha_li1);
    $fecha_li1 = $trozo[2].$trozo[1].$trozo[0];
    $fecha_lc1 = $_POST['fecha_lc1'];
    $trozo = explode("-", $fecha_lc1);
    $fecha_lc1 = $trozo[2].$trozo[1].$trozo[0];
    $fecha_lif1 = $_POST['fecha_lif1'];
    $trozo = explode("-", $fecha_lif1);
    $fecha_lif1 = $trozo[2].$trozo[1].$trozo[0];

    //tabla fecha_actividades pasantias largas 2
    $fecha_li2 = $_POST['fecha_li2'];
    $trozo = explode("-", $fecha_li2);
    $fecha_li2 = $trozo[2].$trozo[1].$trozo[0];
    $fecha_lc2 = $_POST['fecha_lc2'];
    $trozo = explode("-", $fecha_lc2);
    $fecha_lc2 = $trozo[2].$trozo[1].$trozo[0];
    $fecha_lif2 = $_POST['fecha_lif2'];
    $trozo = explode("-", $fecha_lif2);
    $fecha_lif2 = $trozo[2].$trozo[1].$trozo[0];

    //tabla fecha_actividades pasantias largas 3
    $fecha_li3 = $_POST['fecha_li3'];
    $trozo = explode("-", $fecha_li3);
    $fecha_li3 = $trozo[2].$trozo[1].$trozo[0];
    $fecha_lc3 = $_POST['fecha_lc3'];
    $trozo = explode("-", $fecha_lc3);
    $fecha_lc3 = $trozo[2].$trozo[1].$trozo[0];
    $fecha_lif3 = $_POST['fecha_lif3'];
    $trozo = explode("-", $fecha_lif3);
    $fecha_lif3 = $trozo[2].$trozo[1].$trozo[0];

    //include "conexionbd.php";
    $consulta = "select * from lapso where codigo_lapso='$cod_lap'";
    $resultado = mysql_query($consulta) or die (mysql_error());

    if (mysql_num_rows($resultado)>0){
            header("Location: formulariocronogramapasantia.php?codexistente=si");
    }
    else{	
            $consulta1 = "select * from fecha_eventos";
            $resultado1 = mysql_query($consulta1) or die (mysql_error());	
            $sql = "insert into fecha_eventos (fecha_diurna, fecha_vespertino, fecha_nocturno, fecha_preins)"."values ('$reunion_diurno','$reunion_vesper','$reunion_nocturno','$fecha_preinscripcion')";	
            mysql_query($sql);
            $fecha_even_id = mysql_insert_id(); //realiza despues de un INSERT para capturar el id de una tabla

            $insertarEstad = "insert into estadistica(alumnos_aprobados,alumnos_reprobados)"."values ('0','0')";	
            mysql_query($insertarEstad) or die(mysql_error());
            $idEstad = mysql_insert_id();	

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
            mysql_query($sql2);
            mysql_query($sql3);
            mysql_query($sql4);
            mysql_query($sql5);
            mysql_query($sql6);
            mysql_query($sql7);
            mysql_query($sql8);	
            mysql_query($sql9);

    }
    mysql_close($link);
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Cronograma</title>

</head>

<body>
<?php include_once '../navbar.php';?>
  <div class="sidebar1"> 
    <?php include_once("menu_admin.php")?>
  <!-- end .sidebar1 --></div>
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
                $trozo = explode("-", $fechaDiurna);
                $fechaDiurna = $trozo[2].$trozo[1].$trozo[0];                
		$fechaVespertino  = $filaEven["fecha_vespertino"];
                $trozo = explode("-", $fechaVespertino);
                $fechaVespertino = $trozo[2].$trozo[1].$trozo[0];
		$fechaNocturno = $filaEven["fecha_nocturno"];
                $trozo = explode("-", $fechaNocturno);
                $fechaNocturno = $trozo[2].$trozo[1].$trozo[0];
		$fechaPreins = $filaEven["fecha_preins"];
                $trozo = explode("-", $fechaPreins);
                $fechaPreins = $trozo[2].$trozo[1].$trozo[0];
	}
	
	$consultaActividades1 = "select * from fecha_actividades where codigo_lapso='$codigoLapso' and tipo_pasantias='tiempo completo'";
	$resultadoActividades1 = mysql_query($consultaActividades1) or die (mysql_error());
	$i=0;
	while($filaAct1 = mysql_fetch_array($resultadoActividades1)){
		$fechaIniciotc[$i] = $filaAct1["fecha_inicio"];
                $trozo = explode("-", $fechaIniciotc[$i]);
                $fechaIniciotc[$i] = $trozo[2].$trozo[1].$trozo[0];
		$fechaCulminaciontc[$i] = $filaAct1["fecha_culminacion"];
                $trozo = explode("-", $fechaCulminaciontc[$i]);
                $fechaCulminaciontc[$i] = $trozo[2].$trozo[1].$trozo[0];
		$fechaInfinaltc[$i] = $filaAct1["fecha_infinal"];
                $trozo = explode("-", $fechaInfinaltc[$i]);
                $fechaInfinaltc[$i] = $trozo[2].$trozo[1].$trozo[0];
		$i++;		
	}	
	
	$consultaActividades2 = "select * from fecha_actividades where codigo_lapso='$codigoLapso' and tipo_pasantias='medio tiempo'";
	$resultadoActividades2 = mysql_query($consultaActividades2) or die (mysql_error());
	$i=0;
	while($filaAct2 = mysql_fetch_array($resultadoActividades2)){
		$fechaIniciomt[$i] = $filaAct2["fecha_inicio"];
                $trozo = explode("-", $fechaIniciomt[$i]);
                $fechaIniciomt[$i] = $trozo[2].$trozo[1].$trozo[0];
		$fechaCulminacionmt[$i] = $filaAct2["fecha_culminacion"];
                $trozo = explode("-", $fechaCulminacionmt[$i]);
                $fechaCulminacionmt[$i] = $trozo[2].$trozo[1].$trozo[0];
		$fechaInfinalmt[$i] = $filaAct2["fecha_infinal"];
                $trozo = explode("-", $fechaInfinalmt[$i]);
                $fechaInfinalmt[$i] = $trozo[2].$trozo[1].$trozo[0];
		$i++;		
	}	
	
	$consultaActividades3 = "select * from fecha_actividades where codigo_lapso='$codigoLapso' and tipo_pasantias='pasantia larga'";
	$resultadoActividades3 = mysql_query($consultaActividades3) or die (mysql_error());
	$i=0;
	while($filaAct3 = mysql_fetch_array($resultadoActividades3)){
		$fechaIniciopl[$i] = $filaAct3["fecha_inicio"];
                $trozo = explode("-", $fechaIniciopl[$i]);
                $fechaIniciopl[$i] = $trozo[2].$trozo[1].$trozo[0];
		$fechaCulminacionpl[$i] = $filaAct3["fecha_culminacion"];
                $trozo = explode("-", $fechaCulminacionpl[$i]);
                $fechaCulminacionpl[$i] = $trozo[2].$trozo[1].$trozo[0];
		$fechaInfinalpl[$i] = $filaAct3["fecha_infinal"];
                $trozo = explode("-", $fechaInfinalpl[$i]);
                $fechaInfinalpl[$i] = $trozo[2].$trozo[1].$trozo[0];
		$i++;		
	}

        
    $fechaDiurna='';   
    $fechaVespertino='';
    $fechaNocturno='';
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
      <td align="center" width="35%"colspan="3"><input name="btn1" type="submit" value="Guardar" /></td>
      
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
	
	$consuldeshabilitarFechaAct = "update fecha_actividades set fecha_habilitado='no' where codigo_lapso='$codigoLapso' and fecha_habilitado='si'";
	$deshabilitarFechaAct = mysql_query($consuldeshabilitarFechaAct) or die (mysql_error());
	
	//header("Location: cronogramapasantia.php");
	echo "<p align=center>Lapso Deshabilitado exitosamente."; 			
}
?>
</p>
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
 <script language='javascript' src="../popcalendar.js"></script>
<script language="javascript" src="../validarsesiones.js"></script>
</body>
</html>
