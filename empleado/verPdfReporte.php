<?php
include_once '../conexionbd.php';

//Se reciciben por GET 2 variables:
// ----- id_lapso y id_estatus  ------

$lap= $_GET['lap'];
$est= $_GET['est'];
$car= $_GET['car'];
$men= $_GET['men'];

//condiciones
$where='';        
if($lap){
    $where.=' WHERE lap.id_lapso='.$lap;
    
    if($est){
        $where.=' AND al.id_estatus='.$est;
    }
    
    if($car>0){
        $where.=' AND al.id_carrera='.$car;
    }
    if($men>0){
        $where.=' AND al.id_mencion='.$men;
    }
    

    $sql = "SELECT 
                        al.nombre as nombreAl, al.apellido as apellidoAl, 
                        al.cedula_alumno as cedulaAl, al.carnet as carnet,
                        est.nombre_estatus, lap.codigo_lapso as codigoLapso, 
                        car.nombre_carrera, men.nombre_mencion
                        FROM (((((preinscripcion AS pre
                                INNER JOIN alumno as al 
                                ON pre.id_alumno=al.id_alumnos)
                                INNER JOIN tutor_academico as tu
                                ON pre.id_tutor=tu.id_tutor)
                                INNER JOIN estatus as est
                                ON est.id_estatus=al.id_estatus)
                                INNER JOIN lapso as lap
                                ON lap.id_lapso=pre.codigo_lapso)
                                INNER JOIN carreras as car 
                                ON al.id_carrera=car.id_carrera)
                                INNER JOIN menciones as men
                                ON al.id_mencion=men.id_mencion".$where;
    $res = mysql_query($sql) or die (mysql_error());
    $total=mysql_num_rows($res);
    $i=0;
    while ($fila = mysql_fetch_array($res)){	
            $codigoLapso = $fila["codigoLapso"];
            $idLapso = $fila["id_lapso"];

            $nombreAl[$i] = $fila["nombreAl"];
            $apellidoAl[$i] = $fila["apellidoAl"];
            $carnetAl[$i] = $fila["carnet"];			
            $nombre_car[$i] = $fila["nombre_carrera"];
            $nombre_men[$i] = $fila["nombre_mencion"];
            $estatus[$i] = $fila["nombre_estatus"];
            $i++;		

    }
}
?>

<?php
include_once '../class.ezpdf.php';
$pdf =& new Cezpdf(a4);
$pdf->ezSetCmMargins(2,2,2,2);
$pdf->addJpegFromFile('../imagenespdf/gobierno.jpg',55,790,300,30,'left');//modificado por dorian
$pdf->addJpegFromFile('../imagenespdf/logo_bicentenario.jpg',500,790,60,30,'right');//modificado por dorian
$pdf->addJpegFromFile('../imagenespdf/logocufm.jpg',55,750,150,40,'left');//modificado por dorian
$pdf->selectFont('../fonts/Courier.afm');

$pdf->ezText("                  <b>REPÚBLICA BOLIVARIANA DE VENEZUELA \n   COLEGIO UNIVERSITARIO \n    FRANCISCO DE MIRANDA </b>  ",12,array('justification'=>'center') );  

/*
$pdf->ezText("\nCaracas 2011 ",12,array('justification'=>'right'));
$pdf->ezText("\nCiudadano(a)",12,array('justification'=>'left'));
$pdf->ezText($cartaDirigida,12,array('justification'=>'left'));
$pdf->ezText($cargoAsignado,12,array('justification'=>'left'));
$pdf->ezText($nombreCentro,12,array('justification'=>'left'));
$pdf->ezText("Presente.-",12,array('justification'=>'left'));
*/

$pdf->ezText(" \nListado de Alumnos generado por el Departamento de Pasantias y Seguimiento de Egresados.",12,array('justification'=>'full'));

$pdf->ezText("\nA continuación se muestra el listado de Alumos en sus diferentes procesos en el Departamento de Sguimiento y control de Pasantías en el lapso establecido cumpliendo a cabalidad con los lineamientos dictados por el Colegio Universitario Francisco de Miranda :\n ",12,array('justification'=>'full'));

$titles = array('Numero'=>'<b>Numero</b>', 'Nombre'=>'<b>Nombre</b>','Apellido'=>'<b>Apellido</b>','Carnet'=>'<b>Carnet</b>', 'Carrera'=>'<b>Carrera</b>', 'Mencion'=>'<b>Mencion</b>', 'Estatus'=>'<b>Estatus</b>');
for($i=0; $i<$total;$i++){
	$data[$i] = array('Numero'=>$i+1,'Nombre'=>$nombreAl[$i],'Apellido'=>$apellidoAl[$i],'Carnet'=>$carnetAl[$i], 'Carrera'=>$nombre_car[$i],'Mencion'=>$nombre_men[$i], 'Estatus'=>$estatus[$i]);	
}
$pdf->ezTable($data,0,$titles,array('justification'=>'center'));

$pdf->ezText("\n\nSe hace constar que este listado se genera a petición de la unidad solicitante en conformidad con lo establecido en el Reglamento del Programa de Pasantías del Colegio Universitario Francisco de Miranda",10,array('justification'=>'full'));

$pdf->ezText("<b>\n\n\n\n PROF. ANA DURAN</b>",09,array('justification'=>'center'));
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
