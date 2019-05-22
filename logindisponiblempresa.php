<?php
$nombreusuario = $_POST['nombreusuario'];
include "conexionbd.php";
$consulta="select * from usuario where login='$nombreusuario'";
$resultado=mysql_query($consulta) or die (mysql_error());
if (mysql_num_rows($resultado)>0)
{
	header("Location: formularioempresa.php?disponible=no");		
}
else{
	header("Location: formularioempresa.php?disponible=si");
}
mysql_close($link);
?>
