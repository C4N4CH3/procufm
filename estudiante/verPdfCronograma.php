<?php
include_once "../conexionbd.php";

function formatear_fecha($fe){
    $trozo = explode("-", $fe);
    $fecha = $trozo[2]."-".$trozo[1]."-".$trozo[0];
    return $fecha;
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
        
        
require_once '../class.ezpdf.php';
        
$pdf =& new Cezpdf('a4');

/*Helvetica.afm
 * Courier.afm
*/
$pdf->selectFont('../fonts/Helvetica.afm');
$pdf->ezSetCmMargins(2,2,2,2);
//$pdf->addJpegFromFile('../logos/logo_republica.JPG',55,790,300,30,'left');//modificado por dorian
//$pdf->addJpegFromFile('../logos/logo_bicentenario.JPG',100,790,300,30,'left');//modificado por dorian
$pdf->addJpegFromFile('../imagenespdf/logocufm.jpg',55,750,150,40,'left');//modificado por dorian


$pdf->ezText("                                             <b>REPÚBLICA BOLIVARIANA DE VENEZUELA \n"
        . "                                             COLEGIO UNIVERSITARIO FRANCISCO DE MIRANDA \n"
        . "                                             DEPARTAMENTO DE PASANTIAS</b>",11,array('justification'=>'rigth') );  

//$pdf->ezText("\nDetalle de Alumno Asignado",10,array('justification'=>'center'));
$pdf->ezText("\n\n\nCódigo de  Lapso Vigente\n",10,array('justification'=>'center'));
$pdf->ezText("\nCodigo de Lapso: ".$codigoLapso,10,array('justification'=>'center'));
$pdf->ezText("\nFecha de Charla Inducción\n",10,array('justification'=>'center'));
//Definimos los encabezados de la tabla
$titles = array('Diurno'=>'Diurno', 'Vespertino'=>'Vespertino', 'Nocturno'=>'Nocturno'); 
//Arreglo de datos llave=>valor para este ejemplo
$data = array(array('Diurno'=>formatear_fecha($fechaDiurna), 'Vespertino'=>formatear_fecha($fechaVespertino), 'Nocturno'=>formatear_fecha($fechaNocturno)));
//Aqui definimos las opciones de la tabla
$options = array('shadeCol'=>array(0.9,0.9,0.9), 'xOrientation'=>'center', 'width'=>350);
$pdf->ezTable($data, $titles, '', $options);//aquí se construye la tabla
$pdf->ezText("\nFecha Preinscripcion ",10,array('justification'=>'center'));
$pdf->ezText("\nTodos los turnos: ".formatear_fecha($fechaPreins),10,array('justification'=>'center'));
$pdf->ezText("\nFecha de Lapso de Pasantía (tiempo completo)\n",10,array('justification'=>'center'));
//Definimos los encabezados de la tabla
$titles = array('Inicio'=>'Inicio', 'Culminacion'=>'Culminacion', 'Informe'=>'Informe'); 
//Arreglo de datos llave=>valor para este ejemplo
$data = array();
for($i=0; $i<4; $i++){
    $data[] = array('Inicio'=>formatear_fecha($fechaIniciotc[$i]), 'Culminacion'=>formatear_fecha($fechaCulminaciontc[$i]), 'Informe'=>formatear_fecha($fechaInfinaltc[$i]));
}
//Aqui definimos las opciones de la tabla
$options = array('shadeCol'=>array(0.9,0.9,0.9), 'xOrientation'=>'center', 'width'=>350);
$pdf->ezTable($data, $titles, '', $options);//aquí se construye la tabla
$pdf->ezText("\nFecha de Lapso de Pasantía (medio tiempo)\n",10,array('justification'=>'center'));
//Definimos los encabezados de la tabla
$titles = array('Inicio'=>'Inicio', 'Culminacion'=>'Culminacion', 'Informe'=>'Informe'); 
//Arreglo de datos llave=>valor para este ejemplo
$data = array();
for($i=0; $i<1; $i++){
    $data[] = array('Inicio'=>formatear_fecha($fechaIniciomt[$i]), 'Culminacion'=>formatear_fecha($fechaCulminacionmt[$i]), 'Informe'=>formatear_fecha($fechaInfinalmt[$i]));
}
//Aqui definimos las opciones de la tabla
$options = array('shadeCol'=>array(0.9,0.9,0.9), 'xOrientation'=>'center', 'width'=>350);
$pdf->ezTable($data, $titles, '', $options);//aquí se construye la tabla
$pdf->ezText("\nFecha de Lapso de Pasantía (Largas)\n",10,array('justification'=>'center'));   
//Definimos los encabezados de la tabla
$titles = array('Inicio'=>'Inicio', 'Culminacion'=>'Culminacion', 'Informe'=>'Informe'); 
//Arreglo de datos llave=>valor para este ejemplo
$data = array();
for($i=0; $i<3; $i++){
    $data[] = array('Inicio'=>formatear_fecha($fechaIniciopl[$i]), 'Culminacion'=>formatear_fecha($fechaCulminacionpl[$i]), 'Informe'=>formatear_fecha($fechaInfinalpl[$i]));
}
//Aqui definimos las opciones de la tabla
$options = array('shadeCol'=>array(0.9,0.9,0.9), 'xOrientation'=>'center', 'width'=>350);
$pdf->ezTable($data, $titles, '', $options);//aquí se construye la tabla
ob_end_clean();
$pdf->ezStream();
mysql_close($link);
?>