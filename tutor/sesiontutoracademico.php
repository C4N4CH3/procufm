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
</head>

<body>
<form action="" method="post">
<?php include_once '../navbar.php';?>   
     <?php require_once 'menu.php';?>  
<div class="well col-md-9 col-lg-9 col-sm-9 col-xs-9" style="margin-left:20px">
    <h1>Bienvenido al sistema</h1>
    <p align="justify"><em>Datos Personales</em><br>
    <?php
	$ci = $_SESSION['cedula'];

	include_once "../conexionbd.php";
	$consultaTutor = "select * from tutor_academico where cedula='$ci'";
	$resultadoTutor = mysql_query($consultaTutor) or die (mysql_error());
	if($fila1 = mysql_fetch_array($resultadoTutor)){		
		$nombre = $fila1["nombre"];		
		$apellido = $fila1["apellido"];
		$email = $fila1["email"];
		$area = $fila1["area_trabajo"];
		$telefono = $fila1["telefono"];
		$carrera = $fila1["id_carrera"];
		$mencion = $fila1["id_mencion"];
		
		$consulta2 = "select * from carreras where id_carrera=$carrera";
		$nombre_carrera = mysql_query($consulta2) or die (mysql_error());

		if ($fila2 = mysql_fetch_array($nombre_carrera)){
    		$nomCarrera = utf8_encode($fila2["nombre_carrera"]);
		}

		$consulta3 = "select * from menciones where id_mencion=$mencion";;
		$nombre_mencion = mysql_query($consulta3) or die (mysql_error());
 
		if ($fila3 = mysql_fetch_array($nombre_mencion)){
    		$nomMencion = utf8_encode($fila3["nombre_mencion"]);
		}
		
		echo "<table width=100% border=1>";
  		echo "<tr>";
    	echo "<td width=29% align=right>Nombre:</td>";
    	echo "<td width=71%>".$nombre." ".$apellido."</td>";
    	echo "</tr>";  		
  		echo "<tr>";
    	echo "<td align=right>Email:</td>";
    	echo "<td>".$email."</td>";
    	echo "</tr>";			
		echo "<tr>";
    	echo "<td align=right>Carrera:</td>";
    	echo "<td>".$nomCarrera."</td>";
    	echo "</tr>";
		echo "<tr>";
    	echo "<td align=right>Menci&oacute;n:</td>";
    	echo "<td>".$nomMencion."</td>";
    	echo "</tr>";
		echo "<tr>";
		echo "<td align=right>&Aacute;rea de trabajo:</td>";
    	echo "<td>".$area."</td>";
    	echo "</tr>";
		echo "<tr>";
		echo "<td align=right>Tel&eacute;fono:</td>";
    	echo "<td>".$telefono."</td>";
    	echo "</tr>";			
    	echo "</table>";
	}
	?>
    </p>
  </div>

<?php include_once '../footer.php';?>

<script type="text/javascript" src="../js/1.11.1/jquery.min.js"></script>
<script src="../js/bootstrap/3.3.0/bootstrap.min.js"></script>
<script src="../js/material/material.min.js"></script>
<script src="../js/material/ripples.min.js"></script>
<script>
      $.material.init();
</script>
</form> 
</body>
</html>
