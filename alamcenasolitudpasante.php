<?php
include ("sesiones.php");
if($_SESSION['nivel']!=$_SESSION['id']){
session_destroy();
echo "FALLA GRAVE AL SISTEMA, PERDISTE LA SESION, PARA REGRESAR AL INICIO REINICIA EL NAVEGADOR";exit();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Centro Pasantía</title>
<link href="css/bootstrap/3.3.0/bootstrap.min.css" rel="stylesheet">
<link href="css/material/roboto.min.css" rel="stylesheet">
<link href="css/material/material.min.css" rel="stylesheet">
<link href="css/material/ripples.min.css" rel="stylesheet">
<link href="css/material/materialmodif.css" rel="stylesheet">
</head>

<body>
<form action="" method="post">
<?php include_once 'navbar.php';?>

<?php include_once 'menuprinci.php';?>

<div class="well col-md-9 col-lg-9 col-sm-9 col-xs-9" style="margin-left:20px">
  
      <h2>Solitud Pasante</h2>
   
    <p>
      <?php
    $hoy = date("Y-n-j");
	
	$rif = $_SESSION['cedula'];
	$numpasante = $_POST['numpasante'];
	$turno = $_POST['turno'];
	$carrera = $_POST['carrera'];
	$mencion = $_POST['mencion'];

	include "conexionbd.php";
	$consulta = "insert into vacante_empresa (rif,vacante_carrera,vacante_mencion, num_pasantes, turno, estado_solicitud, fecha_registro)"."values ('$rif','$carrera', '$mencion', '$numpasante', '$turno', 'Por revisar', '$hoy')";
	mysql_query($consulta) or die (mysql_error());	
    echo "Centro de pasantia cargado exitosamente.";
	mysql_close($link);
	?>
    </p>
</div>
</form>

<?php include_once 'footer.php';?>

<script type="text/javascript" src="js/1.11.1/jquery.min.js"></script>
<script src="js/bootstrap/3.3.0/bootstrap.min.js"></script>
<script src="js/material/material.min.js"></script>
<script src="js/material/ripples.min.js"></script>
<script>
      $.material.init();
</script>
<script language="javascript" src="validarsesiones.js"></script>
</body>
</html>
