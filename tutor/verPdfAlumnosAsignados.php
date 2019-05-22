<?php
include_once "../conexionbd.php";
$id_al = $_GET['id'];
$sql = "SELECT *,al.cedula_alumno as ced_al,al.id_alumnos as id_al,
                        al.nombre as nombreal, al.apellido as apellidoal,
                        pre.id_preinscripcion as id_pre,
                        tu.id_tutor as idtututor,
                        tu.id_usuario as idusututor,
                        tu.id_carrera as idcarrertutor,
                        tu.id_mencion as idmentutor,
                        tu.nombre as nombretutor,
                        tu.apellido as apellidotutor,
                        tu.cedula as cedulatutor,
                        tu.email as emailtutor,
                        tu.area_trabajo as areatutor,
                        tu.telefono as telefonotutor,
                        tu.cantidad_asignacion_alum as cantalumtutor,
                        tu.habilitado as habtutor, 
                        ins.*
                FROM ((alumno AS al 
                INNER JOIN usuario AS us 
                    ON al.id_usuario=us.id_usuario)
                LEFT JOIN preinscripcion AS pre
                    ON al.id_alumnos=pre.id_alumno)
                LEFT JOIN tutor_academico as tu
                    ON pre.id_tutor=tu.id_tutor
                LEFT JOIN inscripcion AS ins
                	ON ins.id_preinscripcion=pre.id_preinscripcion
                                where al.id_alumnos=".$id_al;
	$res = mysql_query($sql) or die (mysql_error());
        $fila = mysql_fetch_array($res);

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


$pdf->ezText("                                      <b>REPÚBLICA BOLIVARIANA DE VENEZUELA \n"
        . "                                      COLEGIO UNIVERSITARIO FRANCISCO DE MIRANDA \n"
        . "                                      DEPARTAMENTO DE PASANTIAS</b>",12,array('justification'=>'rigth') );  

//$pdf->ezText("\nDetalle de Alumno Asignado",10,array('justification'=>'center'));
$pdf->ezText("\n\n\n\nDATOS DEL ALUMNO\n",10,array('justification'=>'center'));

$titles = array('Nombre'=>'<b>Nombre</b>','Apellido'=>'<b>Apellido</b>','Cedula'=>'<b>Cédula</b>');
$data[0] = array('Nombre'=>$fila["nombreal"],
                    'Apellido'=>$fila["apellidoal"],
                    'Cedula'=>$fila["ced_al"]);	
//Aqui definimos las opciones de la tabla
$options = array('shadeCol'=>array(0.9,0.9,0.9), 'xOrientation'=>'center', 'width'=>350);
$pdf->ezTable($data, $titles, '', $options);//aquí se construye la tabla



$pdf->ezText("\n\nDATOS DEL CENTRO DE PASANTIA\n",10,array('justification'=>'center'));

//Definimos los encabezados de la tabla
$titles = array('id'=>'', 'Lenguaje'=>'Descripción'); 
//Arreglo de datos llave=>valor para este ejemplo
$data = array(array('id'=>'Nombre empresa', 'Lenguaje'=>$fila["nombre_empresa"]),
    array('id'=>'Telefono Empresa', 'Lenguaje'=>$fila["telefono_empresa"]),
    array('id'=>'Dirección', 'Lenguaje'=>$fila["direccion_empresa"]),
    array('id'=>'Jefe Responsable', 'Lenguaje'=>$fila["jefe_responsable"]),
    array('id'=>'Cargo', 'Lenguaje'=>$fila["cargo_jefe"]),
    array('id'=>'Telefono Jefe', 'Lenguaje'=>$fila["telefono_jefe"]),
    array('id'=>'Email', 'Lenguaje'=>$fila["email_jefe"]),
    array('id'=>'Área de pasantía', 'Lenguaje'=>$fila["area_pasantia"]),
    array('id'=>'Horario', 'Lenguaje'=>$fila["horario"]),
    array('id'=>'Nombre Tutor Empresarial', 'Lenguaje'=>$fila["tutor_empresarial"]),
    array('id'=>'Cargo', 'Lenguaje'=>$fila["cargo_tutor"]),
    array('id'=>'Teléfono', 'Lenguaje'=>$fila["telefono_tutor"]),
    array('id'=>'Email', 'Lenguaje'=>$fila["email"]));

//Aqui definimos las opciones de la tabla
$options = array('shadeCol'=>array(0.9,0.9,0.9), 'xOrientation'=>'center', 'width'=>350);
$pdf->ezTable($data, $titles, '', $options);//aquí se construye la tabla

/*
$pdf->ezText("<b>\n\n\n\n PROF. NELSON MURILLO</b>",09,array('justification'=>'center'));
$pdf->ezText("Coordinador de Pasantias",10,array('justification'=>'center'));
$pdf->ezText("<b>Construimos la Patria Socialista. Hacia la Universidad Politécnica)</b>",8,array('justification'=>'center'));
$pdf->ezText("_______________________________________________________________________",8,array('justification'=>'center'));
$pdf->ezText(" \n Esquina de Mijares., direccion@cufm.tec.ve, pasantias@cufm.tec.ve Tlf./Fax 862-5678 /860-5181 Ext. 115, Caracas -Venezuela 1010-A",7,array('justification'=>'center'));
*/
ob_end_clean();
$pdf->ezStream();
?>
<?php
mysql_close($link);
?>