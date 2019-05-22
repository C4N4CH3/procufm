<?php
// procesar registro usuario
$id = $_POST['id'];
$clave = $_POST['clave'];
$reclave = $_POST['reclave'];

//var_dump($_POST);
//die();

if($clave!=$reclave){
	echo "<script language=JavaScript>alert('la contraseña y la confirmacion no coinciden\\nIntentelo nuevamente');window.location='/cambia/pregunta.php';</script>";
}else{
	include "../conexionbd.php";
	$consulta="select * from usuario where id_usuario='$id'";
	$resultado=mysql_query($consulta) or die (mysql_error());
	if (mysql_num_rows($resultado)==0)
	{
		echo "<script language=JavaScript>alert('El usuario no existe');window.location='window.location='/cambia/pregunta.php';</script>";	
	} 

	//tabla usuarios
        $clave = md5($clave);
	$sql = "UPDATE usuario set password='$clave',origen=0 where id_usuario='$id'";
        mysql_query($sql) or die (mysql_error());			
	//$result = mysql_query($sql);

        $modu_aud='REGISTRO USUARIO';
        $tabl_aud='usuario';
        $acci_aud='ACTUALIZAR CLAVE DE:'.$id;
        $fech_aud=date('Y/m/d');
        $hora_aud=date('G:i:s');
        $usua_aud=$_POST['id'];
        $consulta = "insert into auditoria (modulo,tabla,accion,fecha,hora,user_id)".                         //.
        "values ('$modu_aud','$tabl_aud','$acci_aud','$fech_aud','$hora_aud','$usua_aud')";
        mysql_query($consulta) or die (mysql_error());			
        //mysql_close($link);
	echo "<script language=JavaScript>alert('Cambio de clave exitoso!!!');window.location.href='../index.php';</script>";	
	} 
?>


  

