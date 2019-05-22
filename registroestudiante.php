<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />}
<meta http-equiv="refresh" content="5; index.php">
<title>Registro Estudiante</title>
<link href="css/bootstrap/3.3.0/bootstrap.min.css" rel="stylesheet">
<link href="css/material/roboto.min.css" rel="stylesheet">
<link href="css/material/material.min.css" rel="stylesheet">
<link href="css/material/ripples.min.css" rel="stylesheet">
<link href="css/material/materialmodif.css" rel="stylesheet">
</head>

<body>

  <?php include_once 'navbar.php';?>

  <div class="well" style="margin-left:20px ; margin-right:20px;">
<?php
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
	include "conexionbd.php";
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
                    
                        $clave = md5($clave);
			$fecha = date("Y-n-j H:i:s");
                        $origen= $_SESSION['origen'];
			$sql = "INSERT INTO usuario 
                                    (id_grupo,login,password,fecha_registro,origen)
                                    VALUES (1,'$nombreusuario','$clave','$fecha','$origen')";
			$result = mysql_query($sql);		
			$ultimo_id = mysql_insert_id();	

			$modu_aud='REGISTRO ESTUDIANTE';
            $tabl_aud='usuario';
            $acci_aud='CREAR';
            $fech_aud=date('Y/m/d');
            $hora_aud=date('G:i:s');
            $usua_aud=$_SESSION['id'];
            $consulta = "insert into auditoria (modulo,tabla,accion,fecha,hora,user_id)".                         //.
            "values ('$modu_aud','$tabl_aud','$acci_aud','$fech_aud','$hora_aud','$usua_aud')";
        	mysql_query($consulta) or die (mysql_error());			
			
			
			//tabla alumno
			$sql = "INSERT INTO alumno
                                (id_usuario,cedula_alumno,nombre,apellido,email)
                                VALUES ('$ultimo_id','$cedula','$nombre','$apellido','$email')";
			$result = mysql_query($sql);

			$modu_aud='REGISTRO ESTUDIANTE';
            $tabl_aud='alumno';
            $acci_aud='CREAR';
            $fech_aud=date('Y/m/d');
            $hora_aud=date('G:i:s');
            $usua_aud=$_SESSION['id'];
            $consulta = "insert into auditoria (modulo,tabla,accion,fecha,hora,user_id)".                         //.
            "values ('$modu_aud','$tabl_aud','$acci_aud','$fech_aud','$hora_aud','$usua_aud')";
        	mysql_query($consulta) or die (mysql_error());			
			
			mysql_close($link);
		?>

<div align="center" style="margin:0 auto; width:600px;">
      <h3><b>¡Gracias! Hemos recibido sus datos</b></h3>
      
      <h4> <b>En 5 segundos seras redirigido a la pagina principal.</b> <br /> 
      Si esto no sucede puedes darle click al siguiente boton <br />
      <a class="btn btn-material-blue-900" href="index.php">Volver al Inicio</a></h4>
</div>
   
  <?php
            }
	}	
}
?>    
   <!-- end .content --></div>
<?php //include_once 'footer.php';?>

<script type="text/javascript" src="js/1.11.1/jquery.min.js"></script>
<script src="js/bootstrap/3.3.0/bootstrap.min.js"></script>
<script src="js/material/material.min.js"></script>
<script src="js/material/ripples.min.js"></script>
<script>
      $.material.init();
</script>
</body>
</html>
