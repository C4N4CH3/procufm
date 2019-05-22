<?php
	$email = $_POST['email'];
	$opcion = $_POST['opcion'];
	include "conexionbd.php";	
	switch($opcion){
		case 1:
			$consulta="select * from alumno where email='$email'";
			$resultado=mysql_query($consulta) or die (mysql_error());
			if ($fila = mysql_fetch_array($resultado))
			{
				$id_usuario_encontrado = $fila["id_usuario"];
				$consulta2 = "select * from usuario where id_usuario = '$id_usuario_encontrado'";
				$resultado2 = mysql_query($consulta2) or die (mysql_error());
				if ($fila2 = mysql_fetch_array($resultado2)){
					$usuario = $fila2["login"];
					$password = $fila2["password"];
					$cuerpo = "";
					$cuerpo += "Su usuario es: ".$usuario."\n";
					$cuerpo += "Su clave es: ".$password."\n";
					mail($email,"Recuperación de Datos de Pasantia",$cuerpo);
					$mensaje = "Los datos fueron enviados a su Email";
				}
								
			}
			else{
				$mensaje = "No aparece el correo en el sitema";
			}
			break;
		case 2:
			$consulta="select * from departamento where email='$email'";
			$resultado=mysql_query($consulta) or die (mysql_error());
			if ($fila = mysql_fetch_array($resultado))
			{
				$id_usuario_encontrado = $fila["id_usuario"];
				$consulta2 = "select * from usuario where id_usuario = '$id_usuario_encontrado'";
				$resultado2 = mysql_query($consulta2) or die (mysql_error());
				if ($fila2 = mysql_fetch_array($resultado2)){
					$usuario = $fila2["login"];
					$password = $fila2["password"];
					$cuerpo = "";
					$cuerpo += "Su usuario es: ".$usuario."\n";
					$cuerpo += "Su clave es: ".$password."\n";
					mail($email,"Recuperación de Datos de Pasantia",$cuerpo);
					$mensaje = "Los datos fueron enviados a su Email";
				}
								
			}
			else{
				$mensaje = "No aparece el correo en el sitema";
			}
			break;
		case 3:
			$consulta="select * from empresa where email_empresa='$email'";
			$resultado=mysql_query($consulta) or die (mysql_error());
			if ($fila = mysql_fetch_array($resultado))
			{
				$id_usuario_encontrado = $fila["id_usuario"];
				$consulta2 = "select * from usuario where id_usuario = '$id_usuario_encontrado'";
				$resultado2 = mysql_query($consulta2) or die (mysql_error());
				if ($fila2 = mysql_fetch_array($resultado2)){
					$usuario = $fila2["login"];
					$password = $fila2["password"];
					$cuerpo = "";
					$cuerpo += "Su usuario es: ".$usuario."\n";
					$cuerpo += "Su clave es: ".$password."\n";
					mail($email,"Recuperación de Datos de Pasantia",$cuerpo);
					$mensaje = "Los datos fueron enviados a su Email";
				}
								
			}
			else{
				$mensaje = "No aparece el correo en el sitema";
			}
			break;
		default:
			break;
	}
mysql_close($link);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Registro Estudiante</title>
<link href="efecto.css" rel="stylesheet" type="text/css">
<script language="javascript" src="funciones.js"></script>
</head>

<body>
<form action="" method="post">
<div class="container">
  <div class="header">
    <table width="1081" height="213" cellpadding="0" celspacing="0" border="0">
      <tr>
        <td height="50" colspan="3"><img src="logos/gobierno.JPG" width="853" height="50" /><img src="logos/logo_bicentenario.JPG" width="222" height="50" /></td>        
      </tr>
      <tr>
        <td width="178" height="130"><a href="cerrarsesion.php"><img src="logos/logo_cufm.JPG" width="176" height="130" /></a></td>
        <td width="672" height="130" align="center" valign="middle" background="imagenes/header.JPG" bgcolor="#D6D6D6" class="tituloPrici"><strong>DEPARTAMENTO DE PASANTIA DEL COLEGIO UNIVERSITARIO FRANCISCO DE MIRANDA</strong></td>
        <td width="223" height="130"><img src="logos/independencia.JPG" width="222" height="130" /></td>        
      </tr>
      <tr>
        <td height="25" colspan="3" class="cintacentral">&nbsp;</td>
      </tr>
      </table>
  </div>
  <div class="sidebar1"> 
     <p>Principal 
    </p>
    <ul class="nav">
      <li><a href="index.php"><img src="imagenes/blockcontentbullets.JPG" width="6" height="13" /><img src="imagenes/spacer.JPG" width="5" height="1" />Inicio</a>
    </li>
      
  Registro 
    </ul>
    <ul class="nav">
      <li><a href="formularioestudiante.php"><img src="imagenes/blockcontentbullets.JPG" width="6" height="13" /><img src="imagenes/spacer.JPG" width="5" height="1" />Alumno</a></li>
      <!--<li><a href="formularioempresa.php"><img src="imagenes/blockcontentbullets.JPG" width="6" height="13" /><img src="imagenes/spacer.JPG" width="5" height="1" />Empresa</a></li>-->
      <li><a href="formulariotutoracademico.php"><img src="imagenes/blockcontentbullets.JPG" width="6" height="13" /><img src="imagenes/spacer.JPG" width="5" height="1" />Tutor acad&eacute;mico</a></li>
    </ul>
  <!-- end .sidebar1 --></div>
  <div class="content">
    <blockquote>
      <h2>Recuperacion de Cuenta</h2>
    </blockquote>     
    <p><?php echo $mensaje?></p>
    <p><!-- end .content --></p>
  </div>
<div class="sidebar2">
  <h4 align="center"><img src="logos/imagen_cufm.JPG" width="165" height="153" /></h4>
    <p>&nbsp;</p>
    <!-- end .sidebar2 --></div>
  <div class="footer">
    <p><strong>Colegio Universitario &quot;Francisco de Miranda&quot;</strong><br />
Dirección: Av. Urdaneta. Esquina de Mijares. Parroquia Altagracia. Teléfonos: (58)(0212) 8620422 / 8646880<br />
 Sistema de Gesti&oacute;n Administrativa de Pasant&iacute;a 2015 - Caracas, Venezuela.</p>
    <!-- end .footer --></div>
  <!-- end .container --></div> 
</form> 
</body>
</html>