<?php
include "conexionbd.php";
$consultaLapso = "select * from lapso where lapso_habilitado='si'";
$resultadoLapso = mysql_query($consultaLapso) or die (mysql_error());
if ($filalapso = mysql_fetch_array($resultadoLapso)){	
	$codigoLapso = $filalapso["codigo_lapso"];
	$idLapso = $filalapso["id_lapso"];
	$idEstadistica = $filalapso["id_estadistica"];
	$i=0;
	$consultaEs = "select * from estadistica where id_estadistica='$idEstadistica'";
	$resultadoEs = mysql_query($consultaEs) or die (mysql_error());		
	if($filaEs = mysql_fetch_array($resultadoEs)){
		
		$alumnos_aprobados = $filaEs["alumnos_aprobados"];
		
		$consultaTablAlum = "select * from alumno where id_estatus='3'";
		$resultadoTablAlum = mysql_query($consultaTablAlum) or die (mysql_error());			
		
		while($filAlum = mysql_fetch_array($resultadoTablAlum)){			
			$nombreAl[$i] = $filAlum["nombre"];
			$apellidoAl[$i] = $filAlum["apellido"];
			$carnetAl[$i] = $filAlum["carnet"];			
			$carrera = $filAlum["id_carrera"];
			$mencion = $filAlum["id_mencion"];					
					
			$consulta2 = "select * from tipo_carrera where id_carrera='$carrera'";
			$nombre_carrera = mysql_query($consulta2) or die (mysql_error());
			if ($filacar = mysql_fetch_array($nombre_carrera)){
    			$nombre_car[$i] = $filacar["nombre"];
			}

			$consulta3 = "select * from tipo_mencion where id_mencion='$mencion'";;
			$nombre_mencion = mysql_query($consulta3) or die (mysql_error());
			if ($filamen = mysql_fetch_array($nombre_mencion)){
    			$nombre_men[$i] = $filamen["nombre"];
			}
			
			$i++;	
		}
	}	
}

?>

<?php
include('class.ezpdf.php');
$pdf =& new Cezpdf(a4);
$pdf->ezSetCmMargins(2,2,2,2);
$pdf->addJpegFromFile('./imagenespdf/gobierno.jpg',55,790,300,30,'left');//modificado por dorian
$pdf->addJpegFromFile('./imagenespdf/logo_bicentenario.jpg',500,790,60,30,'right');//modificado por dorian
$pdf->addJpegFromFile('./imagenespdf/logocufm.jpg',55,750,150,40,'left');//modificado por dorian
$pdf->selectFont('./fonts/arial.afm');

$pdf->ezText("                  <b>REPÚBLICA BOLIVARIANA DE VENEZUELA \n   COLEGIO UNIVERSITARIO \n    FRANCISCO DE MIRANDA </b>  ",12,array('justification'=>'center') );  

/*
$pdf->ezText("\nCaracas 2011 ",12,array('justification'=>'right'));
$pdf->ezText("\nCiudadano(a)",12,array('justification'=>'left'));
$pdf->ezText($cartaDirigida,12,array('justification'=>'left'));
$pdf->ezText($cargoAsignado,12,array('justification'=>'left'));
$pdf->ezText($nombreCentro,12,array('justification'=>'left'));
$pdf->ezText("Presente.-",12,array('justification'=>'left'));
*/

$pdf->ezText(" \nListado de Alumnos Aprobados generado por el Departamento de Pasantias y Seguimiento de Egresados.",12,array('justification'=>'full'));

$pdf->ezText("\n A continuación se muestra el listado de Alumos Inscritos que Aprobaron satisfactoriameente su Proceso de Pasantías en el lapso establecido cumpliendo a cabalidad con los lineamientos dictados por el Departamento :\n ",12,array('justification'=>'full'));

$titles = array('Numero'=>'<b>Numero</b>', 'Nombre'=>'<b>Nombre</b>','Apellido'=>'<b>Apellido</b>','Carnet'=>'<b>Carnet</b>', 'Carrera'=>'<b>Carrera</b>', 'Mencion'=>'<b>Mencion</b>');
for($i=0; $i<$alumnos_aprobados;$i++){
	$data[$i] = array('Numero'=>$i+1,'Nombre'=>$nombreAl[$i],'Apellido'=>$apellidoAl[$i],'Carnet'=>$carnetAl[$i], 'Carrera'=>$nombre_car[$i],'Mencion'=>$nombre_men[$i]);	
}
$pdf->ezTable($data,0,$titles,array('justification'=>'center'));

$pdf->ezText("\nSe hace constar que este listado se genera a petición de la unidad solicitante en conformidad con lo establecido en el Reglamento del Programa de Pasantías del Colegio Universitario Francisco de Miranda",10,array('justification'=>'full'));

$pdf->ezText("<b>\n\n\n\n PROF. NELSON MURILLO</b>",09,array('justification'=>'center'));
$pdf->ezText("Coordinador de Pasantias",10,array('justification'=>'center'));

$pdf->ezText("<b>Construimos la Patria Socialista. Hacia la Universidad Politécnica)</b>",8,array('justification'=>'center'));
$pdf->ezText("_______________________________________________________________________",8,array('justification'=>'center'));
$pdf->ezText(" \n Esquina de Mijares., direccion@cufm.tec.ve, pasantias@cufm.tec.ve Tlf./Fax 862-5678 /860-5181 Ext. 115, Caracas -Venezuela 1010-A",7,array('justification'=>'center'));

ob_end_clean();
$pdf->ezStream();
?>
<?php
mysql_close($link);
?>
