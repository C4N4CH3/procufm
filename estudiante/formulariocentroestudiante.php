<?php
include ("../sesiones.php");
if($_SESSION['nivel']!=$_SESSION['id']){
session_destroy();
echo "FALLA GRAVE AL SISTEMA, PERDISTE LA SESION, PARA REGRESAR AL INICIO REINICIA EL NAVEGADOR";exit();
}
$ci = $_SESSION['cedula'];
	include "../conexionbd.php";
	$consulta = "select * from alumno where cedula_alumno='$ci'";
	$resultado = mysql_query($consulta) or die (mysql_error());
	if ($fila = mysql_fetch_array($resultado)){
		$estatus = $fila["id_estatus"];
		$carrera = $fila["id_carrera"];
		$mencion = $fila["id_mencion"];	
	}
	if($estatus<1){
		mysql_close($link);
		header ("Location: sesionestudiante.php?centropasan=si");
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Preinscripción</title>
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
 
      <h2>Centro de Pasant&iacute;as </h2>

    <p><?php
	$consultavacante="select * from vacante_departamento where vacante_carrera='$carrera' and vacante_mencion='$mencion' and numero_pasantes>0";
	$resultadovacante = mysql_query($consultavacante) or die (mysql_error());
	$inicio=0;
	
	//if(mysql_num_rows($resultadovacante)>0){
	/*}
else{
	echo "<br><p> No hay centros disponibles para esta carrera - menci&oacute;n.";
}*/
	
	?>	
	</p>
<form action="" method="post">
<table border=1 align='center' width="100%">
<tr>
<td width="4%" align="center">S</td>
<td width="6%" align="center">#</td>
<td width="30%" align="center">Nombre</td>
<td width="47%" align="center">Ubicacion</td>
<td width="13%" align="center">Vacante:</td>
</tr>
<?php 	
	while ($fila = mysql_fetch_assoc($resultadovacante)):
	//echo $acceso;
?>
<tr>
<td><input type="radio" name="opcion" value="<?php echo $fila["id_vacante_departamento"];?>"></td>
<td><?php echo $inicio++;?></td>
<td><?php echo $fila["nombre"];?></td>
<td><?php echo $fila["ubicacion"];?></td>
<td><?php echo $fila["numero_pasantes"];?></td>
</tr>    
<?php //cierra el while 
	endwhile;
?>

</table>
	<p align="center"><br><br>
	<input type="submit" name="enviar" value="Guardar" onclick="guardacentro(this.form)" /> 
    </p>
      </form>
	<?php
		mysql_close($link);
	?>
  </div>
  
<?php include_once '../footer.php';?>

<script type="text/javascript" src="../js/1.11.1/jquery.min.js"></script>
<script src="../js/bootstrap/3.3.0/bootstrap.min.js"></script>
<script src="../js/material/material.min.js"></script>
<script src="../js/material/ripples.min.js"></script>
<script src="validarsesiones.js"></script>
<script>
      $.material.init();
</script>


</body>
</html>
