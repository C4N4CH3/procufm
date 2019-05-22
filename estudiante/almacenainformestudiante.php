<?php
	include ("../sesiones.php");
	if($_SESSION['nivel']!=$_SESSION['id']){
	session_destroy();
	echo "FALLA GRAVE AL SISTEMA, PERDISTE LA SESION, PARA REGRESAR AL INICIO REINICIA EL NAVEGADOR";exit();
	}	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Principal</title>
<link href="../css/bootstrap/3.3.0/bootstrap.min.css" rel="stylesheet">
<link href="../css/material/roboto.min.css" rel="stylesheet">
<link href="../css/material/material.min.css" rel="stylesheet">
<link href="../css/material/ripples.min.css" rel="stylesheet">
<link href="../css/material/materialmodif.css" rel="stylesheet">
</head>

<body>
<div class="container">
<?php include_once '../navbar.php';?>
  <div class="sidebar1"> 
    <?php require_once 'menu_al.php';?>
  <!-- end .sidebar1 --></div>
 <div class="well col-md-9 col-lg-9 col-sm-9 col-xs-9" style="margin-left:20px">
    <h2>Hemos recibido sus datos exitosamente </h2>
    <p>
    <?php	
	$unidad = $_POST['unidad'];
	$actividades = $_POST['actividades'];
	$limitaciones = $_POST['limitaciones'];
	$academico = $_POST['academico'];
	$empresarial = $_POST['empresarial'];	
	
	$radioacademico = $_POST['radioacademico'];
	$radioempresarial = $_POST['radioempresarial'];
	$hoy= date("Y-n-j");
		
	include "../conexionbd.php";		
	$ci = $_SESSION['cedula'];	
	
	$consultaTablaPre1 = "select * from preinscripcion where cedula_alumno='$ci'";
	$resultadoTablaPre1 = mysql_query($consultaTablaPre1) or die (mysql_error());	
	if($fil = mysql_fetch_array($resultadoTablaPre1)){
		$idpreins = $fil["id_preinscripcion"];	
		
		$TablaIns = "select * from inscripcion where id_preinscripcion='$idpreins'";
		$resulTablaIns = mysql_query($TablaIns) or die (mysql_error());	
		if($filaid = mysql_fetch_array($resulTablaIns)){
			$idinscrito =$filaid["id_inscrito"];
			$cantidadInformes = $filaid["cantidad_informes"]; 					
			
			if ($cantidadInformes < 3){
			$cantidadInformes++;			
			$insertaInformes = "insert into informes (unidad_pasantias, informe_actividades, limitaciones_pasantia, entrevista_academico, entrevista_empresarial, entrevista_tutor_academico, entrevista_tutor_empresarial, estado_informe, fecha_informe, calificacion_informe)"."values ('$unidad', '$actividades', '$limitaciones', '$academico', '$empresarial', '$radioacademico', '$radioempresarial', 'noleido', '$hoy', 'en espera')";	
			mysql_query($insertaInformes) or die (mysql_error());
			$idInformes = mysql_insert_id();
			
			$cargaControl = "insert into control_informes (id_inscrito, id_informes)"."values ('$idinscrito', '$idInformes')";
			
			mysql_query($cargaControl) or die (mysql_error());
			
			$actulizaCantinformes = "update inscripcion set cantidad_informes='$cantidadInformes' where id_inscrito='$idinscrito'";
			mysql_query($actulizaCantinformes);
			}
			else{
				echo "<br>Ud. ya tiene los tres(3) informes cargados en el sistema<br>";
			}				
		}
		else {
			echo "<br>Ud no esta Inscrito<br>";
		}			
	}	
	?>
    </p>
    <p>
	<?php
		mysql_close($link);
	?></p>
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
