<?php
include ("../conexionbd.php");
$document = $_GET['document'];

$tipo_doc = "SELECT id_documento, id_tipo_documento, id_preinscripcion
	  				FROM documento
					WHERE id_documento=$document";
$consulta = mysql_query($tipo_doc);

//echo $tipo_doc;
while ($result = mysql_fetch_array($consulta, MYSQL_NUM)) {
    list($id_documento, $id_tipo_documento, $id_preinscripcion) = $result;

    $cedalum = "SELECT cedula_alumno
                    FROM preinscripcion
                    WHERE id_preinscripcion=$id_preinscripcion";
    //echo $cedalum;
    $consulta = mysql_query($cedalum);
    while ($result = mysql_fetch_array($consulta, MYSQL_NUM)) {
        list($cedula_alumno) = $result;
    }
    if ($id_tipo_documento == 1) {
        //$ruta= 'cartapostulacion_admin.php?doc='.$id_documento.'';
        header('Location: cartapostulacion_admin.php?doc=' . $id_documento . '&cedula=' . $cedula_alumno . '');
    } elseif ($id_tipo_documento == 2) {
        //$ruta='solicitudpermiso_admin.php?doc='.$id_documento.'';
        header('Location: solicitudpermiso_admin.php?doc=' . $id_documento . '&cedula=' . $cedula_alumno . '');
    } elseif ($id_tipo_documento == 3) {
        //$ruta= 'constanciapasantia_admin.php?doc='.$id_documento.'';
        header('Location: constanciapasantia_admin.php?doc=' . $id_documento . '&cedula=' . $cedula_alumno . '');
    }
}
//echo $ruta;			
?>