<?php
include ("../sesiones.php");
if($_SESSION['nivel']!=$_SESSION['id']){
session_destroy();
echo "FALLA GRAVE AL SISTEMA, PERDISTE LA SESION, PARA REGRESAR AL INICIO REINICIA EL NAVEGADOR";exit();
}

// procesar registro estudiante
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$cedula = $_POST['cedula'];
$nombreusuario = $_POST['nombreusuario'];
$clave = $_POST['clave'];
$reclave = $_POST['reclave'];
$email = $_POST['email'];

if($clave!=$reclave){
	echo "<script language=JavaScript>alert('la contraseña y la confirmacion no coinciden\\nIntentelo nuevamente');window.location='formularioestudiante.php';</script>";
}else{
	include_once("../conexionbd.php");
	$consulta="select * from usuario where login='$nombreusuario'";
	$resultado=mysql_query($consulta) or die (mysql_error());
	if (mysql_num_rows($resultado)>0)
	{
		echo "<script language=JavaScript>alert('El nombre usuario ya esta en uso\\nPor favor elija otro');window.location='formularioestudiante.php';</script>";	
	} 
	if(mysql_num_rows($resultado)==0){	
		$consulta="select * from alumno where cedula_alumno='$cedula'";
		$resultado1=mysql_query($consulta) or die (mysql_error());
		if(mysql_num_rows($resultado1)>0){		
			echo "<script language=JavaScript>alert('La cedula ya esta registrada en el sistema');window.location='formularioestudiante.php';</script>";
		}
		if(mysql_num_rows($resultado1)==0){		
			//tabla usuario
			$fecha = date("Y-n-j H:i:s");
			$sql = "INSERT INTO usuario(id_grupo,login,password,fecha_registro)"."VALUES (1,'$nombreusuario','$clave','$fecha')";
			$result = mysql_query($sql);		
			$ultimo_id = mysql_insert_id();			
			
			//tabla alumno
			$sql = "INSERT INTO alumno(id_usuario,cedula_alumno,nombre,apellido,email)"."VALUES ('$ultimo_id','$cedula','$nombre','$apellido','$email')";
			$result = mysql_query($sql);		
			mysql_close($link);
		}
	}	
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Registro Estudiante</title>
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
   <?php include_once("menu_admin.php")?>
  <!-- end .sidebar1 --></div>
  <div class="content">
   
      <h3 align="center"><strong>¡Gracias! Hemos recibido sus datos</strong></h3>
     
  <!-- end .content --></div>
</form>
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