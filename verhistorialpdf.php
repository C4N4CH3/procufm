<?php

if (isset($_GET["enviarDocumento"])){
	$idDoc = $_GET["enviarDocumento"];	
}

if (isset($_GET["enviarIdAl"])){
	$idAlum=$_GET["enviarIdAl"];	
}

if (isset($_GET["enviarTipoDoc"])){
	$TipoDoc=$_GET["enviarTipoDoc"];	
}
include "conexionbd.php";

$consultaDoc = "select * from documento where id_documento='$idDoc'";
$resultadoDoc = mysql_query($consultaDoc) or die (mysql_error());
if($filaDoc = mysql_fetch_array($resultadoDoc)){
	$idDocumento = $filaDoc["id_documento"];
	$idTipoDocumento = $filaDoc["id_tipo_documento"];
	$documentoEstatus = $filaDoc["documento_estatus"];	
	
	$nombreCentro = $filaDoc["nombre_centro"];
	$cartaDirigida = $filaDoc["carta_dirigida"];
	$cargoAsignado = $filaDoc["cargo_asignado"];
	
}



$consultaAlumno = "select * from alumno where cedula_alumno='$idAlum'";
$resultadoAlumno = mysql_query($consultaAlumno) or die (mysql_error());		
if($filaAl = mysql_fetch_array($resultadoAlumno)){
	$nombreAlumno = $filaAl["nombre"];
	$apellidoAlumno = $filaAl["apellido"];
	$carnet = $filaAl["carnet"];
	$carrera = $filaAl["id_carrera"];
	$mencion = $filaAl["id_mencion"];
	
	
	$consulta2 = "select * from tipo_carrera where id_carrera='$carrera'";
	$nombre_carrera = mysql_query($consulta2) or die (mysql_error());
	if ($filacar = mysql_fetch_array($nombre_carrera)){
    	$nombreCarrera = $filacar["nombre"];
	}
	$consulta3 = "select * from tipo_mencion where id_mencion='$mencion'";;
	$nombre_mencion = mysql_query($consulta3) or die (mysql_error());
	if ($filamen = mysql_fetch_array($nombre_mencion)){
		$nombreMencion = $filamen["nombre"];
	}	
}

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
}

$hoy = date("Y-n-j");



?>
<?php
mysql_close($link);
?>

<?php

if($TipoDoc==1){

include('class.ezpdf.php');
$pdf =& new Cezpdf(a4);
$pdf->ezSetCmMargins(2,2,4,3);
$pdf->addJpegFromFile('./imagenespdf/gobierno.jpg',110,790,300,30,'left');//modificado por dorian
$pdf->addJpegFromFile('./imagenespdf/logo_bicentenario.jpg',450,790,30,30,'right');//modificado por dorian
$pdf->addJpegFromFile('./imagenespdf/logocufm.jpg',110,750,150,40,'left');//modificado por dorian
$pdf->selectFont('./fonts/arial.afm');

$pdf->ezText("                  <b>REPÚBLICA BOLIVARIANA DE VENEZUELA \n   COLEGIO UNIVERSITARIO \n    FRANCISCO DE MIRANDA </b>  ",8,array('justification'=>'center') );  

$pdf->ezText("\n\n\nCaracas,Fecha de 2011 ",8,array('justification'=>'right'));
$pdf->ezText("\n\nCiudadano(a)",8,array('justification'=>'left'));
$pdf->ezText($cartaDirigida,8,array('justification'=>'left'));
$pdf->ezText($cargoAsignado,8,array('justification'=>'left'));
$pdf->ezText($nombreCentro,8,array('justification'=>'left'));
$pdf->ezText("Presente.-",8,array('justification'=>'left'));


$pdf->ezText("\n\nMe es grato Dirigirme a usted en la oportunidad de presentarle al portador de la presente,  Bachiller: ".$nombreAlumno." ".$apellidoAlumno.", Carnet N-: ".$carnet.", portador(a) de la Cédula de Identidad Nº: ".$idAlum.", alumno (a) de la Carrera:".$nombreCarrera." mención: ".$nombreMencion.", quien aspira que esa institución le  ofrezca la oportunidad de realizar la Pasantía Ocupacional que se le exige para optar al Titulo de Técnico Superior Universitario.",8,array('justification'=>'full'));

$pdf->ezText("\nLa pasantia tiene una duración de cuarenta (40) dias hábiles,ocho (8) semanas a tiempo completo, ochenta (80) días hábiles, dieciséis, (16) semanas a Medio Tiempo Y Pasantías Largas Cincuenta(50) días hábiles,diez(10) semanas.",8,array('justification'=>'full'));





$pdf->ezText(" \n  Aqui va el Arreglo de Fecha o tabla",8,array('justification'=>'center'));
$pdf->ezText(" \n  ",8,array('justification'=>'center'));


$titles = array('Inicio'=>'<b>inicio</b>', 'Culminacion'=>'<b>culminacion</b>');
$data[] = array('Inicio'=>$fechaIniciotc[0], 'Culminación'=>$fechaCulminaciontc[0]);






$pdf->ezTable($data,0,$titles,array('justification'=>'center'));


$pdf->ezText(" \n\n\n\n\n\n\n\n		 Párrafo Primero (Art.39): El alumno que al momento de la inscripción de las pasantías,<b> no haya alcanzado de un indice de Rendimiento de doce (12) puntos, se le incrementará el tiempo de pasantías en un cuarenta por ciento (40%), (Reglamento de Evaluación del Rendimiento Estudiantil del CUFM).",8,array('justification'=>'full'));



$pdf->ezText(" \n \n  Agradecemos la atención que se sirvan prestar al referido alumno (a).",8,array('justification'=>'center'));


$pdf->ezText(" \n \n \n \n <b> PROF. NELSON MURILLO</b>",8,array('justification'=>'center'));
$pdf->ezText(" \n Coordinador de Pasantias",8,array('justification'=>'center'));


$pdf->ezText(" \n <b>Construimos la Patria Socialista. Hacia la Universidad Politécnica)</b>",7,array('justification'=>'center'));

$pdf->ezText(" \n _______________________________________________________________________",8,array('justification'=>'center'));

$pdf->ezText(" \n Esquina de Mijares., direccion@cufm.tec.ve, pasantias@cufm.tec.ve",7,array('justification'=>'center'));

$pdf->ezText(" \n Tlf./Fax 862-5678 /860-5181 Ext. 115, Caracas -Venezuela 1010-A",7,array('justification'=>'center'));

/*
$pdf->ezText("<b>Fecha:</b> ".date("d/m/Y"),10);
$pdf->ezText("<b>Hora:</b> ".date("H:i:s"),10);
$pdf->ezText('<b>Fuente:</b> <c:alink:http://blog.unijimpe.net/>blog.unijimpe.net</c:alink>');*/
ob_end_clean();

$pdf->ezStream();
}
else{
	header ("Location: documentodepartamento.php");
}

?>


