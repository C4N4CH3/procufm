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
<title>Constancia de Pasant&iacute;as almacenada!</title>
<link href="../css/bootstrap/3.3.0/bootstrap.min.css" rel="stylesheet">
<link href="../css/material/roboto.min.css" rel="stylesheet">
<link href="../css/material/material.min.css" rel="stylesheet">
<link href="../css/material/ripples.min.css" rel="stylesheet">
<link href="../css/material/materialmodif.css" rel="stylesheet">

</head>

<body onload="actualizaReloj()">
<form action="" method="post">
<div class="container">
<?php include_once '../navbar.php';?>
  <div class="sidebar1"> 
    <?php include_once 'menu_admin.php' ?>
  <!-- end .sidebar1 --></div>

  <div class="content">

<?php	
$fecha_actual = $_POST['fecha_actual'];
$nombre_centro = $_POST['nombre_centro'];
$carta_dirigida = $_POST['carta_dirigida'];
$cargo_asignado = $_POST['cargo_asignado'];
$telefono_lapso = $_POST['telefono_lapso'];

include "../conexionbd.php";
$ci = $_SESSION['cedula'];
$con ="select * from preinscripcion where cedula_alumno='$ci'";
$resul = mysql_query($con) or die (mysql_error());
if ($fila = mysql_fetch_array($resul)) {
  $preinscrip = $fila["id_preinscripcion"];
  $cant_documentos = $fila["cantidad_documentos_constancia"];
  
  	if ($cant_documentos<=5) 
	{
	  	$cant_documentos++;
		$sql1="UPDATE documento 
			SET fecha_actual = '$fecha_actual',
			nombre_centro = '$nombre_centro', 
			carta_dirigida = '$carta_dirigida', 
			cargo_asignado= '$cargo_asignado',
			telefono_lapso= '$telefono_lapso'
	 		WHERE id_preinscripcion= $preinscrip
			AND id_tipo_documento = 3";
		
		//echo $sql1;
		
	  	//$sql1 = "insert into documento (id_preinscripcion, fecha_actual, nombre_centro, carta_dirigida, cargo_asignado, telefono_lapso, id_tipo_documento, documento_estatus) values ('$preinscrip', '$fecha_actual', '$nombre_centro', '$carta_dirigida', '$cargo_asignado', '$telefono_lapso', '3', 'noleido')";
 		mysql_query($sql1) or die (mysql_error());
  		
		$sql2 = "update preinscripcion set cantidad_documentos_constancia='$cant_documentos' where id_preinscripcion=$preinscrip";
 		mysql_query($sql2) or die (mysql_error());
	}
 	else 
	{
  	header("location: constanciapasantia_admin.php?errorcant_documentos=si");
	}
}
else {
  header("location: constanciapasantia_admin.php?errorpreinscripcion=si");
}


mysql_close($link);
	
?>	
    <h1>Gracias! </h1>
    <p>Su constancia de pasant&iacute;as ha sido completada de manera exitosa!</p>
	<p> Sus datos registrados son los siguientes: </p>
	<table width="481" height="207" border="1" align="center">
      <tr>
        <td width="241">Nombre de la Empresa:</td>
        <td width="224"><?php echo $nombre_centro;?></td>
      </tr>
      <tr>
        <td>Jefe Inmediato:</td>
        <td><?php echo $carta_dirigida;?></td>
      </tr>
      <tr>
        <td>Cargo que desempe&ntilde;a:</td>
        <td><?php echo $cargo_asignado;?></td>
      </tr>
	  <tr>
        <td>Fecha de Solicitud de permiso:</td>
        <td><?php echo $fecha_actual;?></td>
      </tr>
	  <tr>
        <td>Teléfono Pasant&iacute;as:</td>
        <td><?php echo $telefono_lapso;?></td>
      </tr>
    </table>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
  </div>
<div class="sidebar2">
  <h4 align="center">Bienvenido: <?php echo $_SESSION['usuario']?></h4>
  <p align="center"><a href="../cerrarsesion.php">Cerrar Sesi&oacute;n</a></p>
  <p>&nbsp;  </p>
   <p> <table align="center" border=0 cellpadding=0 cellspacing=0>
        <tr>
        <td align="center" id="Fecha_Reloj"></td>
        </tr>
        </table>
		</p>
    <!-- end .sidebar2 --></div>
<?php include_once '../footer.php';?>
  <!-- end .container --></div> 
  <script type="text/javascript" src="../js/1.11.1/jquery.min.js"></script>
    <script src="../js/bootstrap/3.3.0/bootstrap.min.js"></script>
    <script src="../js/material/material.min.js"></script>
    <script src="../js/material/ripples.min.js"></script>
    <script>
      $.material.init();
    </script>
  <script language="javascript" src="../validarsesiones.js"></script>
</form>
</body>
</html>

