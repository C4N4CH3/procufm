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
<form action="" method="post">

 <?php include_once '../navbar.php';?>
  <div class="sidebar1"> 
    <?php require_once 'menu_al.php';?>  
  <!-- end .sidebar1 --></div>
  <div class="well col-md-9 col-lg-9 col-sm-9 col-xs-9" style="margin-left:20px">
    
    <p>
    <?php	
	$nombre_em = $_POST['nombre'];
	$direccion_em = $_POST['direccion'];
	$tel_em = $_POST['telefono'];
	$nom_responsable = $_POST['responsable'];
	$cargo_responsable = $_POST['cargo'];	
	$tel_responsable = $_POST['telresponsable'];
	//$sexo = $_POST['sexo'];	
	$email_responsable = $_POST['emailresponsable'];	
	$area = $_POST['area'];
	$horario = $_POST['horario'];
	$obtenercentro = $_POST['obtenercentro'];	
	$nombretutor = $_POST['nombretutor'];
	$cargotutor = $_POST['cargotutor'];
	$emailtutor = $_POST['emailtutor'];	
	$teletutor = $_POST['teletutor'];	
	$seleccionfecha = $_POST["seleccionfecha"];
			
	
	include "../conexionbd.php";		
	$ci = $_SESSION['cedula'];	
	
	
	$consulta_lapso = "select * from lapso where lapso_habilitado='si'";
	$resultado_lapso = mysql_query($consulta_lapso) or die (mysql_error());
	if ($fila1 = mysql_fetch_array($resultado_lapso)){
		$idLapso = $fila1["id_lapso"];
		
		$consultaTablaPre1 = "select * from preinscripcion where cedula_alumno='$ci' and codigo_lapso='$idLapso'";
		$resultadoTablaPre1 = mysql_query($consultaTablaPre1) or die (mysql_error());
				
		if($fil = mysql_fetch_array($resultadoTablaPre1)){
			$idpreins = $fil["id_preinscripcion"];	
		
			$insertaDatos = "insert into inscripcion (id_preinscripcion, nombre_empresa, telefono_empresa, direccion_empresa, jefe_responsable, cargo_jefe, telefono_jefe, email_jefe, area_pasantia, horario, tutor_empresarial, cargo_tutor, email, telefono_tutor, obtencion_centro, id_fecha, cantidad_informes)"."values ('$idpreins','$nombre_em', '$tel_em', '$direccion_em', '$nom_responsable', '$cargo_responsable', '$tel_responsable', '$email_responsable', '$area', '$horario', '$nombretutor', '$cargotutor', '$emailtutor', '$teletutor', '$obtenercentro','$seleccionfecha','0')";	
			mysql_query($insertaDatos) or die (mysql_error());	
		
			$actulizaestatus = "update alumno set id_estatus=2 where cedula_alumno='$ci'";
			mysql_query($actulizaestatus);	
			echo "<h2>Hemos recibido sus datos exitosamente </h2>";		
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

</form>

<script type="text/javascript" src="../js/1.11.1/jquery.min.js"></script>
<script src="../js/bootstrap/3.3.0/bootstrap.min.js"></script>
<script src="../js/material/material.min.js"></script>
<script src="../js/material/ripples.min.js"></script>
<script>
      $.material.init();
</script>
</body>
</html>
