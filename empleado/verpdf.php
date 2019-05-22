<?php

if (isset($_GET["enviarDocumento"])){
	$idDoc = $_GET["id_inscripcion"];	
}

if (isset($_GET["enviarIdAl"])){
	$idAlum=$_GET["enviarIdAl"];	
}

if (isset($_GET["enviarTipoDoc"])){
	$TipoDoc=$_GET["enviarTipoDoc"];	
}
include "conexionbd.php";

$consultaDoc = "select * from documento where id_documento=$idDoc";
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
	
	
	$consulta2 = "select nombre_carrera from carreras where id_carrera='$carrera'";
	$nombre_carrera = mysql_query($consulta2) or die (mysql_error());
	if ($filacar = mysql_fetch_array($nombre_carrera)){
    	$nombreCa = $filacar["nombre_carrera"];
		$nombreCarrera = utf8_encode($nombreCa);
	}
	$consulta3 = "select nombre_mencion from menciones  where id_mencion='$mencion'";;
	$nombre_mencion = mysql_query($consulta3) or die (mysql_error());
	if ($filamen = mysql_fetch_array($nombre_mencion)){
		$nombreM = $filamen["nombre_mencion"];
		$nombreMencion = utf8_encode($nombreM);
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
		$consultaFechaEven = "select * from fecha_eventos where id_fecha_evento=$idFechaEvento";
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
			$i++;		
		}		
	
		$consultaActividades2 = "select * from fecha_actividades where codigo_lapso='$codigoLapso' and tipo_pasantias='medio tiempo'";
		$resultadoActividades2 = mysql_query($consultaActividades2) or die (mysql_error());
		$i=0;
		while($filaAct2 = mysql_fetch_array($resultadoActividades2)){
			$fechaIniciomt[$i] = $filaAct2["fecha_inicio"];
			$fechaCulminacionmt[$i] = $filaAct2["fecha_culminacion"];
			$i++;		
		}	
	
		$consultaActividades3 = "select * from fecha_actividades where codigo_lapso='$codigoLapso' and tipo_pasantias='pasantia larga'";
		$resultadoActividades3 = mysql_query($consultaActividades3) or die (mysql_error());
		$i=0;
		while($filaAct3 = mysql_fetch_array($resultadoActividades3)){
			$fechaIniciopl[$i] = $filaAct3["fecha_inicio"];
			$fechaCulminacionpl[$i] = $filaAct3["fecha_culminacion"];
			$i++;		
		}	
	}
}

$hoy = date("Y-n-j");



?>


<?php

if($TipoDoc==1){//CARTA DE POSTULACION

include('class.ezpdf.php');
$pdf =& new Cezpdf(a4);
$pdf->ezSetCmMargins(2,2,2,2);
$pdf->addJpegFromFile('./imagenespdf/gobierno.jpg',55,790,300,30,'left');//modificado por dorian
$pdf->addJpegFromFile('./imagenespdf/logo_bicentenario.jpg',500,790,60,30,'right');//modificado por dorian
$pdf->addJpegFromFile('./imagenespdf/logocufm.jpg',55,750,150,40,'left');//modificado por dorian
$pdf->selectFont('./fonts/arial.afm');

$pdf->ezText("                  <b>REPÚBLICA BOLIVARIANA DE VENEZUELA \n   COLEGIO UNIVERSITARIO \n    FRANCISCO DE MIRANDA </b>  ",12,array('justification'=>'center') );  

$pdf->ezText("\nCaracas 2014 ",12,array('justification'=>'right'));
$pdf->ezText("\nCiudadano(a)",12,array('justification'=>'left'));
$pdf->ezText($cartaDirigida,12,array('justification'=>'left'));
$pdf->ezText($cargoAsignado,12,array('justification'=>'left'));
$pdf->ezText($nombreCentro,12,array('justification'=>'left'));
$pdf->ezText("Presente.-",12,array('justification'=>'left'));


$pdf->ezText(" \nMe es grato Dirigirme a usted en la oportunidad de presentarle al portador de la presente, Bachiller: ".$nombreAlumno." ".$apellidoAlumno.", Carnet N-: ".$carnet.", portador(a) de la Cédula de Identidad Nº: ".$idAlum.", alumno (a) de la Carrera:".$nombreCarrera." mención: ".$nombreMencion.", quien aspira que esa institución le  ofrezca la oportunidad de realizar la Pasantía Ocupacional que se le exige para optar al Titulo de Técnico Superior Universitario.",12,array('justification'=>'full'));

$pdf->ezText("\nLa pasantia tiene una duración de cuarenta (40) dias hábiles,ocho (8) semanas a tiempo completo, ochenta (80) días hábiles, dieciséis, (16) semanas a Medio Tiempo Y Pasantías Largas Cincuenta(50) días hábiles,diez(10) semanas.",12,array('justification'=>'full'));


$pdf->ezText("\nTiempo Completo",8,array('justification'=>'center'));
$pdf->ezText("Cuarenta (40) días hábiles ocho (8) semanas\n",8,array('justification'=>'center'));
$titles = array('Inicio'=>'<b>inicio</b>', 'Culminacion'=>'<b>culminacion</b>');
for($i=0; $i<4;$i++){
	$datatc[$i] = array('Inicio'=>$fechaIniciotc[$i],'Culminacion'=>$fechaCulminaciontc[$i]);	
}
$pdf->ezTable($datatc,0,$titles,array('justification'=>'center','width'=>16));


$pdf->ezText("\nMedio Completo",8,array('justification'=>'center'));
$pdf->ezText("Ochenta (80) días hábiles diecisèis (16) semanas\n",8,array('justification'=>'center'));
$titles = array('Inicio'=>'<b>inicio</b>', 'Culminacion'=>'<b>culminacion</b>');
for($i=0; $i<1;$i++){
	$datamt[$i] = array('Inicio'=>$fechaIniciomt[$i],'Culminacion'=>$fechaCulminacionmt[$i]);	
}
$pdf->ezTable($datamt,0,$titles,array('justification'=>'center'));


$pdf->ezText("\nPasantías Largas",8,array('justification'=>'center'));
$pdf->ezText("Cincuenta (50) días hábiles diez (10) semanas\n",8,array('justification'=>'center'));
$titles = array('Inicio'=>'<b>inicio</b>', 'Culminacion'=>'<b>culminacion</b>');
for($i=0; $i<3;$i++){
	$datapl[$i] = array('Inicio'=>$fechaIniciopl[$i],'Culminacion'=>$fechaCulminacionpl[$i]);	
}
$pdf->ezTable($datapl,0,$titles,array('justification'=>'center'));


$pdf->ezText("\nPárrafo Primero (Art.39): El alumno que al momento de la inscripción de las pasantías,<b> no haya alcanzado de un indice de Rendimiento de doce (12) puntos, se le incrementará el tiempo de pasantías en un cuarenta por ciento (40%), (Reglamento de Evaluación del Rendimiento Estudiantil del CUFM).",10,array('justification'=>'full'));


$pdf->ezText("\nAgradecemos la atención que se sirvan prestar al referido alumno (a).",10,array('justification'=>'center'));


$pdf->ezText("<b>\n LIC. ANA DURÁN</b>",09,array('justification'=>'center'));
$pdf->ezText("Coordinador de Pasantias",10,array('justification'=>'center'));


$pdf->ezText("<b>Construimos la Patria Socialista. Hacia la Universidad Politécnica)</b>",8,array('justification'=>'center'));
$pdf->ezText("_______________________________________________________________________",8,array('justification'=>'center'));
$pdf->ezText(" \n Esquina de Mijares., direccion@cufm.tec.ve, pasantias@cufm.tec.ve Tlf./Fax 862-5678 /860-5181 Ext. 115, Caracas -Venezuela 1010-A",7,array('justification'=>'center'));

ob_end_clean();
$pdf->ezStream();
}

if($TipoDoc==2){ //SOLICITUD DE PERMISO

include('class.ezpdf.php');
$pdf =& new Cezpdf(a4);
$pdf->ezSetCmMargins(2,2,2,2);
$pdf->addJpegFromFile('./imagenespdf/gobierno.jpg',55,790,300,30,'left');//modificado por dorian
$pdf->addJpegFromFile('./imagenespdf/logo_bicentenario.jpg',500,790,60,30,'right');//modificado por dorian
$pdf->addJpegFromFile('./imagenespdf/logocufm.jpg',55,750,150,40,'left');//modificado por dorian
$pdf->selectFont('./fonts/arial.afm');

$pdf->ezText("                  <b>REPÚBLICA BOLIVARIANA DE VENEZUELA \n   COLEGIO UNIVERSITARIO \n    FRANCISCO DE MIRANDA </b>  ",12,array('justification'=>'center') );  

$pdf->ezText("\n\n\nCaracas,Fecha de 2014 ",12,array('justification'=>'right'));
$pdf->ezText("\n\nCiudadano(a)",12,array('justification'=>'left'));
$pdf->ezText($cartaDirigida,12,array('justification'=>'left'));
$pdf->ezText($cargoAsignado,12,array('justification'=>'left'));
$pdf->ezText($nombreCentro,12,array('justification'=>'left'));
$pdf->ezText("Presente.-",12,array('justification'=>'left'));


$pdf->ezText("\n\n\n\nLa presente solicitud es para notificar que el Bachiller: ".$nombreAlumno." ".$apellidoAlumno.", Carnet N-: ".$carnet.", portador(a) de la Cédula de Identidad Nº: ".$idAlum.", alumno (a) de la Carrera:".$nombreCarrera." mención: ".$nombreMencion.", quien aspira a optar al Titulo de Técnico Superior Universitario, requiere que se le exonere de sus actividades diarias por el período que se defina para el comienzo de las actividades de Pasantías Ocupacionales, hagase constar que la pasantia tiene una duración de cuarenta (40) dias hábiles,ocho (8) semanas a tiempo completo, ochenta (80) días hábiles, dieciséis, (16) semanas a Medio Tiempo Y Pasantías Largas Cincuenta(50) días hábiles,diez(10) semanas, por lo que agradecemos su cooperación total para que la actividad del estudiante pueda realizarse de manera correctay fluida",12,array('justification'=>'full'));


$pdf->ezText("\n\nReiteradamente agradecemos toda la ayuda que pueda prestar al referido alumno (a).",12,array('justification'=>'center'));


$pdf->ezText("\n\n\n\n\n\n\n<b>LIC. ANA DURÁN</b>",12,array('justification'=>'center'));
$pdf->ezText(" \n Coordinador de Pasantias",8,array('justification'=>'center'));


$pdf->ezText(" \n <b>Construimos la Patria Socialista. Hacia la Universidad Politécnica)</b>",10,array('justification'=>'center'));

$pdf->ezText(" \n _______________________________________________________________________",10,array('justification'=>'center'));

$pdf->ezText(" \n Esquina de Mijares, direccion@cufm.tec.ve, pasantias@cufm.tec.ve",8,array('justification'=>'center'));

$pdf->ezText("Tlf./Fax 862-5678 /860-5181 Ext. 115, Caracas -Venezuela 1010-A",8,array('justification'=>'center'));
ob_end_clean();

$pdf->ezStream();

}
if($TipoDoc==3){ // CONSTANCIA DE PASANTIA

include('class.ezpdf.php');
$pdf =& new Cezpdf(a4);
$pdf->ezSetCmMargins(2,2,2,2);
$pdf->addJpegFromFile('./imagenespdf/gobierno.jpg',55,790,300,30,'left');//modificado por dorian
$pdf->addJpegFromFile('./imagenespdf/logo_bicentenario.jpg',500,790,60,30,'right');//modificado por dorian
$pdf->addJpegFromFile('./imagenespdf/logocufm.jpg',55,750,150,40,'left');//modificado por dorian
$pdf->selectFont('./fonts/arial.afm');

$pdf->ezText("                  <b>REPÚBLICA BOLIVARIANA DE VENEZUELA \n   COLEGIO UNIVERSITARIO \n    FRANCISCO DE MIRANDA </b>  ",8,array('justification'=>'center') );  

$pdf->ezText("\n\n\nCaracas,Fecha de 2014 ",8,array('justification'=>'right'));
$pdf->ezText("\n\nCiudadano(a)",8,array('justification'=>'left'));
$pdf->ezText($cartaDirigida,8,array('justification'=>'left'));
$pdf->ezText($cargoAsignado,8,array('justification'=>'left'));
$pdf->ezText($nombreCentro,8,array('justification'=>'left'));
$pdf->ezText("Presente.-",8,array('justification'=>'left'));


$pdf->ezText("\n\nLa presente hace constar que el  Bachiller: ".$nombreAlumno." ".$apellidoAlumno.", Carnet N-: ".$carnet.", portador(a) de la Cédula de Identidad Nº: ".$idAlum.", alumno (a) de la Carrera:".$nombreCarrera." mención: ".$nombreMencion.", Realizó su Pasantía Ocupacional que se le exige para optar al Titulo de Técnico Superior Universitario de manera normal y satisfactoria, cumpliendo con lo establecido en el Reglamento del Programa de Pasantías del Colegio Universitario Francisco de Miranda y en conformancia con el Decreto No.1242 de la Reforma Parcial del Reglamento sobre el Programa Nacional de Pasantias.",12,array('justification'=>'full'));

$pdf->ezText("\nLa pasantia tiene una duración de cuarenta (40) dias hábiles,ocho (8) semanas a tiempo completo, ochenta (80) días hábiles, dieciséis, (16) semanas a Medio Tiempo Y Pasantías Largas Cincuenta(50) días hábiles,diez(10) semanas.",12,array('justification'=>'full'));


$pdf->ezText(" \n \n  Constancia que se expide por el Departamento de Pasantías y Seguimiento de Egresados del Colegio Universitario Francisco de Miranda(a).",10,array('justification'=>'center'));


$pdf->ezText(" \n \n \n \n <b> LIC. ANA DURÁN</b>",8,array('justification'=>'center'));
$pdf->ezText(" \n Coordinador de Pasantias",8,array('justification'=>'center'));


$pdf->ezText(" \n <b>Construimos la Patria Socialista.)</b>",7,array('justification'=>'center'));

$pdf->ezText(" \n _______________________________________________________________________",8,array('justification'=>'center'));

$pdf->ezText(" \n Esquina de Mijares., direccion@cufm.tec.ve, pasantias@cufm.tec.ve",7,array('justification'=>'center'));

$pdf->ezText("Tlf./Fax 862-5678 /860-5181 Ext. 115, Caracas -Venezuela 1010-A",7,array('justification'=>'center'));
ob_end_clean();

$pdf->ezStream();
}
?>
<?php	
	if($TipoDoc>=1 && $TipoDoc<=3 ){
		$actualizarDocumento = "update documento set documento_estatus='leido' where id_documento='$idDoc'";
		mysql_query($actualizarDocumento) or die (mysql_error());
	}
?>

<?php
mysql_close($link);
?>
