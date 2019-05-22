<?php
// procesar registro estudiante
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$cedula = $_POST['cedula'];
$nombreusuario = $_POST['nombreusuario'];
$clave = $_POST['clave'];
$reclave = $_POST['reclave'];
$carrera = $_POST['carrera'];
$mencion = $_POST['mencion'];
$area = $_POST['area_trabajo'];
$telefono = $_POST['telefono'];
$email = $_POST['email'];

if($clave!=$reclave){
	echo "<script language=JavaScript>alert('la contraseña y la confirmaci&oacute;n no coinciden\\nIntentelo nuevamente');window.location='formulariotutoracademico.php';</script>";
}else{
	include "conexionbd.php";
	$consulta="select * from usuario where login='$nombreusuario'";
	$resultado=mysql_query($consulta) or die (mysql_error());
	if (mysql_num_rows($resultado)>0)
	{
		echo "<script language=JavaScript>alert('El nombre usuario ya esta en uso\\nPor favor elija otro');window.location='formulariotutoracademico.php';</script>";	
	} 
	if(mysql_num_rows($resultado)==0){	
		$consulta="select * from tutor_academico where cedula='$cedula'";
		$resultado1=mysql_query($consulta) or die (mysql_error());
		if(mysql_num_rows($resultado1)>0){		
			echo "<script language=JavaScript>alert('La cedula ya esta registrada en el sistema');window.location='formulariotutoracademico.php';</script>";
		}
		if(mysql_num_rows($resultado1)==0){		
			//tabla usuario
			$fecha = date("Y-n-j H:i:s");
			$sql = "INSERT INTO usuario 
                                    (id_grupo,login,password,fecha_registro)
                                    VALUES (5,'$nombreusuario','$clave','$fecha')";
			$result = mysql_query($sql);		
			$ultimo_id = mysql_insert_id();	
			
			$modu_aud='REGISTRO TUTOR ACAD';
            $tabl_aud='usuario';
            $acci_aud='CREAR';
            $fech_aud=date('Y/m/d');
            $hora_aud=date('G:i:s');
            $usua_aud=$_SESSION['id'];
            $consulta = "insert into auditoria (modulo,tabla,accion,fecha,hora,user_id)".                         //.
            "values ('$modu_aud','$tabl_aud','$acci_aud','$fech_aud','$hora_aud','$usua_aud')";
        	mysql_query($consulta) or die (mysql_error());	


			
			
			//tabla tutor
			$sql1 = "INSERT INTO tutor_academico 
                                    (id_usuario, habilitado, id_carrera, id_mencion, 
                                    nombre, apellido, cedula, email, area_trabajo, 
                                    telefono, cantidad_asignacion_alum)
                                VALUES ($ultimo_id, 'si', $carrera, $mencion,
                                    '$nombre','$apellido','$cedula','$email', '$area', '$telefono',0)";
			$result = mysql_query($sql1);		
			
			$modu_aud='REGISTRO TUTOR ACAD';
            $tabl_aud='tutor_academico';
            $acci_aud='CREAR';
            $fech_aud=date('Y/m/d');
            $hora_aud=date('G:i:s');
            $usua_aud=$_SESSION['id'];
            $consulta = "insert into auditoria (modulo,tabla,accion,fecha,hora,user_id)".                         //.
            "values ('$modu_aud','$tabl_aud','$acci_aud','$fech_aud','$hora_aud','$usua_aud')";
        	mysql_query($consulta) or die (mysql_error());			
			
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
      <li><a href="index.php"><img src="imagenes/blockcontentbullets.JPG" width="6" height="13" /><img src="imagenes/spacer.JPG" width="5" height="1" />Inicio</a></li>
      
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
      <h3><strong>¡Gracias! Hemos recibido sus datos</strong></h3>
    </blockquote>  
  <!-- end .content --></div>
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