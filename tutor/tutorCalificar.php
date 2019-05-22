<?php
include_once '../sesiones.php';
if($_SESSION['nivel']!=$_SESSION['id']){
session_destroy();
echo "FALLA GRAVE AL SISTEMA, PERDISTE LA SESION, PARA REGRESAR AL INICIO REINICIA EL NAVEGADOR";exit();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link href="../css/bootstrap/3.3.0/bootstrap.min.css" rel="stylesheet">
<link href="../css/material/roboto.min.css" rel="stylesheet">
<link href="../css/material/material.min.css" rel="stylesheet">
<link href="../css/material/ripples.min.css" rel="stylesheet">
<link href="../css/material/materialmodif.css" rel="stylesheet">
<link href="../css/jquery-ui.css" rel="stylesheet" type="text/css">
</head>

<body>

<?php include_once '../navbar.php';?>
    <?php require_once 'menu.php';?>
  <div class="well col-md-9 col-lg-9 col-sm-9 col-xs-9" style="margin-left:20px">

      <h2>Aprobaci&oacute;n de alumnos</h2>
   
    </p>
    <?php include_once '../conexionbd.php'; ?>
    
    <p align="justify">
    <?php	
	$consultaLapso = "select * from lapso where lapso_habilitado='si'";
	$resultadoLapso = mysql_query($consultaLapso) or die (mysql_error());
	if ($filalapso = mysql_fetch_array($resultadoLapso)){	
		$codigoLapso = $filalapso["codigo_lapso"];
		$idEstad = $filalapso["id_estadistica"];
		echo "<p>C&oacute;digo de lapso habilitado: ".$codigoLapso."</p>";
		echo "<p>Recuerde que no puede aprobar al alumno si no ha aprobado anteriormente los informes </p>";
	}
	else{
		echo "<p>No hay c&oacute;digo de lapso habilitado.</p>";
	}	
	?>    
    </p>
    <form action="" method="post">
    <p align="justify">
        <?php
        $ci = $_SESSION['cedula'];
        $consultaTutor = "select * from tutor_academico where cedula='$ci'";
        $resultadoTutor = mysql_query($consultaTutor) or die(mysql_error());
        if ($fila1 = mysql_fetch_array($resultadoTutor)) {
            $idtutor = $fila1["id_tutor"];
            $i = 1;
            $consultaPre = "select * from preinscripcion where id_tutor=$idtutor";
            $resultadoPre = mysql_query($consultaPre) or die(mysql_error());
            if (mysql_num_rows($resultadoPre) > 0) {

                echo "<table width=100% border=1>";
                echo "<tr>";
                echo "<th scope=col bgcolor=#F7F5EE>#</th>";
                echo "<th scope=col bgcolor=#F7F5EE>Informes</th>";
                echo "<th scope=col bgcolor=#F7F5EE>Nombre</th>";
                echo "<th scope=col colspan=2 bgcolor=#F7F5EE>Acción</th>";
                echo "</tr>";
                while ($fila2 = mysql_fetch_array($resultadoPre)) {
                    $idpreins = $fila2["id_preinscripcion"];
                    $idAlum = $fila2["id_alumno"];

                    $consultaAlumno = "select * from alumno where id_alumnos=".$idAlum;
                    $resultadoAlumno = mysql_query($consultaAlumno) or die(mysql_error());
                    if ($filaAl = mysql_fetch_array($resultadoAlumno)) {
                        $nombreAlumno = $filaAl["nombre"];
                        $apellidoAlumno = $filaAl["apellido"];
                        $idEstatus = $filaAl["id_estatus"];

                        $consultaIns = "select * from inscripcion where id_preinscripcion=$idpreins";
                        $resultadoIns = mysql_query($consultaIns) or die(mysql_error());
                        if ($fila3 = mysql_fetch_array($resultadoIns)) {
                            $idins = $fila3["id_inscrito"];
                            $cantidadInformes = $fila3["cantidad_informes"];
                            
                            
                            echo "<tr>";
                            echo "<td>" . $i++ . "</td>";
                            echo "<td>" . $cantidadInformes . "</td>";
                            echo "<td>" . $nombreAlumno . " " . $apellidoAlumno . "</td>";
                            
                            if($idEstatus == 3){
                                echo "<td align='center'><a href='#aprobar_alumno' id='aprobado' "
                                    . "onClick='aprobar(".$idAlum.")'>"
                                    . "<font color='blue'>Aprobar</font></a></td>";
                                
                                echo "<td align='center'>"
                                    . "<a href='#reprobar_alumno' id='reprobado' onClick='reprobar(".$idAlum.")'>"
                                    . "<font color='red'>Reprobar</font></a></td>";
                                    echo "</tr>";
                                                                
                            }                         
                            
                            if($idEstatus == 2 || $idEstatus == 1){
                                echo "<td align='center'> </td>";
                                echo "<td align='center'>"
                                . "<a href='#reprobar_alumno' id='reprobado' onClick='reprobar(".$idAlum.")'>"
                                . "<font color='red'>Reprobar</font></a></td>";
                                echo "</tr>";
                            }
                            
                            
                            if($idEstatus == 4){
                                echo "<td align='center' colspan='2'><font color='blue'>APROBADO</font></td>";
                            }
                            
                            if($idEstatus == 5){
                                echo "<td align='center' colspan='2'><font color='red'>REPROBADO</font></td>";
                            }
                            
                            /*
                              echo "<td align='center'>"
                              . "<a href='tutorveredicto.php?aprobar=".$cedulaAlum."&&idEstad=".$idEstad."' id='aprobado'>"
                              . "<font color='blue'>Aprobar</font></a></td>";
                              echo "<td align='center'>"
                              . "<a href='tutorveredicto.php?reprobar=".$cedulaAlum."&&idEstad=".$idEstad."' id='reprobado'>"
                              . "<font color='red'>Reprobar</font></a></td>";

                             * 
                             * */
                        }
                    }//aki el de arriba												
                }
            } else {
                echo "<p>No hay alumnos Preinscritos</p>";
            }
            echo "</table>";
        }
        ?>        
    </form>    
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
<script language="javascript" type="text/javascript" src="../js/jquery-ui-1.10.3.custom.js"></script>
<script language="javascript" type="text/javascript" src="js/calificar.js"></script>
</body>
</html>
