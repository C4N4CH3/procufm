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
<title>Carta de Postulaci&oacute;n almacenada!</title>
<link href="../css/bootstrap/3.3.0/bootstrap.min.css" rel="stylesheet">
<link href="../css/material/roboto.min.css" rel="stylesheet">
<link href="../css/material/material.min.css" rel="stylesheet">
<link href="../css/material/ripples.min.css" rel="stylesheet">
<link href="../css/material/materialmodif.css" rel="stylesheet">
</head>

<body>
<?php include_once '../navbar.php';?>
  <div class="sidebar1"> 
    <?php require_once 'menu_al.php';?>
  <!-- end .sidebar1 --></div>
 <div class="well col-md-9 col-lg-9 col-sm-9 col-xs-9" style="margin-left:20px">
    <?php
	$fecha = $_POST['fecha_actual'];
	$fecha_actual=date("Y-m-d",strtotime($fecha)); 
    //$fecha_actual = $_POST['fecha_actual'];
	$nombre_centro = $_POST['nombre_centro'];
	$carta_dirigida = $_POST['carta_dirigida'];
	$cargo_asignado = $_POST['cargo_asignado'];
	$telefono = $_POST['telefono'];

	include "../conexionbd.php";
	$ci = $_SESSION['cedula'];
	$con ="select * from preinscripcion where cedula_alumno='$ci'";
	$resul =mysql_query($con) or die (mysql_error());
	if ($fila = mysql_fetch_array($resul)) {
  		$preinscrip = $fila["id_preinscripcion"];
		$cant_documentos = $fila["cantidad_documentos_postulacion"];		
		if($cant_documentos < 5){
			$cant_documentos++;
			$sql1 = "insert into documento (id_tipo_documento, id_preinscripcion, nombre_centro, carta_dirigida, cargo_asignado, fecha_actual, documento_estatus, telefono_lapso)"."values ('1','$preinscrip', '$nombre_centro', '$carta_dirigida', '$cargo_asignado', '$fecha_actual', 'noleido','$telefono')";
			
			mysql_query($sql1) or die (mysql_error());
			
			$sql2 ="update preinscripcion set cantidad_documentos_postulacion='$cant_documentos' where id_preinscripcion='$preinscrip'";
			
			mysql_query($sql2) or die (mysql_error());
						
		}
		else{
			header ("Location: cartapostulacion.php?errorcant_documento=si");
		}		
	}
	else{
		header ("Location: cartapostulacion.php?errorpreinscripcion=si");
	}	
	mysql_close($link);
	?>
    <h1>Gracias! </h1>
    <p>Su carta de postulaci&oacute;n ha sido almacenada exitosamente</p>
	<p> Sus datos registrados son los siguientes: </p>
	<table width="481" height="207" border="1" align="center">
	  <tr>
        <td width="241">Nombre del Centro de Pasant&iacute;as:</td>
        <td width="224"><?php echo $nombre_centro?></td>
      </tr>
      <tr>
        <td>Dirigido a:</td>
        <td><?php echo $carta_dirigida?></td>
      </tr>
      <tr>
        <td>Cargo que desempe&ntilde;a:</td>
        <td><?php echo $cargo_asignado?></td>
      </tr>
      <tr>
        <td>Tel&eacute;fono:</td>
        <td><?php echo $telefono?></td>
      </tr>
	  <tr>
        <td>Fecha de Solicitud de Carta:</td>
        <td><?php echo $fecha_actual?></td>
      </tr>
  </table>
	<p>&nbsp;</p>
  </div>
<?php include_once '../footer.php';?>

<script type="text/javascript" src="../js/1.11.1/jquery.min.js"></script>
<script src="../js/bootstrap/3.3.0/bootstrap.min.js"></script>
<script src="../js/material/material.min.js"></script>
<script src="../js/material/ripples.min.js"></script>
<script>
      $.material.init();
</script>
<script language="javascript" src="validarsesiones.js"></script>
</body>
</html>


