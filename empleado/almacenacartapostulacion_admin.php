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
<title>Carta de Postulaci&oacute;n almacenada</title>
<link href="../css/bootstrap/3.3.0/bootstrap.min.css" rel="stylesheet">
<link href="../css/material/roboto.min.css" rel="stylesheet">
<link href="../css/material/material.min.css" rel="stylesheet">
<link href="../css/material/ripples.min.css" rel="stylesheet">
<link href="../css/material/materialmodif.css" rel="stylesheet">

</head>

<body>
<?php include_once '../navbar.php';?>
  <div class="sidebar1"> 
      <?php include_once 'menu_admin.php' ?>
  <!-- end .sidebar1 --></div>
  <div class="content">
      
    <?php
	$fecha = $_POST['fecha_actual'];
	$fecha_actual=date("Y-m-d",strtotime($fecha)); 
	$fecha_actual2=date("d-m-Y",strtotime($fecha));
	
        $trozo = explode("-", $fecha);
        $fecha = $trozo[2]."-".$trozo[1]."-".$trozo[0];
        
        $nombre_centro = $_POST['nombre_centro'];
	$carta_dirigida = $_POST['carta_dirigida'];
	$cargo_asignado = $_POST['cargo_asignado'];
	$telefono = $_POST['telefono'];
        

        
        
	include "../conexionbd.php";
	//$ci = $_SESSION['cedula'];
	$ci = $_POST['cedula'];
	$con ="select * from preinscripcion where cedula_alumno='$ci'";
	$resul =mysql_query($con) or die (mysql_error());
	
        if ($fila = mysql_fetch_array($resul)) 
	{
  		$preinscrip = $fila["id_preinscripcion"];
		$cant_documentos = $fila["cantidad_documentos_postulacion"];		
		/*if($cant_documentos < 5)
		{*/
			$cant_documentos++;
			$sql1="UPDATE documento 
                            SET fecha_actual = '$fecha_actual',
                            nombre_centro = '$nombre_centro', 
                            carta_dirigida = '$carta_dirigida', 
                            cargo_asignado= '$cargo_asignado',
                            telefono_lapso= '$telefono'
                            WHERE id_preinscripcion= $preinscrip
                            AND id_tipo_documento = 1";
			
			/*$sql1 = "INSERT INTO documento 
                                (id_tipo_documento, id_preinscripcion, nombre_centro, 
                                carta_dirigida, cargo_asignado, fecha_actual, 
                                documento_estatus, telefono_lapso) 
                            VALUES (1,$preinscrip, '$nombre_centro', '$carta_dirigida', 
                                '$cargo_asignado', '$fecha_actual', 'noleido','$telefono')";
			*/
			mysql_query($sql1) or die (mysql_error());
			
			$sql2 ="UPDATE preinscripcion SET 
                                cantidad_documentos_postulacion=$cant_documentos 
                                WHERE id_preinscripcion=$preinscrip";
			
			mysql_query($sql2) or die (mysql_error());
						
		/*}
		else
		{   
                    echo "entra aquuiiiii";
			//echo $ci;
			header ("Location: cartapostulacion_admin.php?errorcant_documento=si");
		}*/		
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
        <td><?php
        $trozo = explode("-", $fecha_actual);
         echo $trozo[2]."-".$trozo[1]."-".$trozo[0];
        ?></td>
      </tr>
  </table>
	<p>&nbsp;</p>
  </div>
<div class="sidebar2">
  <h4 align="center">Bienvenido: <?php echo $_SESSION['usuario']?></h4>
  <p align="center"><a href="../cerrarsesion.php">Cerrar Sesi&oacute;n</a></p>
    <!-- end .sidebar2 --></div>
  <?php include_once '../footer.php';?>

  <script type="text/javascript" src="../js/1.11.1/jquery.min.js"></script>
    <script src="../js/bootstrap/3.3.0/bootstrap.min.js"></script>
    <script src="../js/material/material.min.js"></script>
    <script src="../js/material/ripples.min.js"></script>
    <script>
      $.material.init();
    </script>
  <script language="javascript" src="../validarsesiones.js"></script>
</body>
</html>


