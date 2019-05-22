<?php // procesar centro estudiante
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
<title>Principal</title>
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
    
      <p>
        <?php
  $opcion = $_POST['opcion'];
  $ci = $_SESSION['cedula'];
	include "../conexionbd.php";

	$consulta_preinscripcion = "select * from preinscripcion where cedula_alumno='$ci'";
	$resultado_preinscripcion = mysql_query($consulta_preinscripcion) or die (mysql_error());
	if($fila1 = mysql_fetch_array($resultado_preinscripcion)){
		$idpreins = $fila1["id_preinscripcion"];
		$cant_temporales = $fila1["cant_centros_temporales"];		
	
		if($cant_temporales < 2){
			$consulta_vacante = "select * from vacante_departamento where id_vacante_departamento='$opcion'";
			$resultado_vacante = mysql_query($consulta_vacante) or die (mysql_error());
			if ($fila = mysql_fetch_array($resultado_vacante)){
				$cantpasante = $fila["numero_pasantes"];		
			
				if($cantpasante>0){
					$cantpasante--;
					$consulta_vacante2 = "update vacante_departamento set numero_pasantes='$cantpasante' where 		id_vacante_departamento='$opcion'";
					mysql_query($consulta_vacante2) or die (mysql_error());
				
					$cant_temporales++;				
					$consulta_pre2 = "update preinscripcion set cant_centros_temporales='$cant_temporales' where cedula_alumno='$ci'";
					mysql_query($consulta_pre2) or die (mysql_error());
				
				
					$consulta_centros_temporales = "insert into centros_temporales (id_preinscripcion, id_vacante_departamento)"."values ('$idpreins','$opcion')";
					mysql_query($consulta_centros_temporales) or die (mysql_error());
					
					echo "<blockquote><h2>Hemos recibido su centro exitosamente</h2></blockquote>";						
				}				
			}	
		}
		else{
			echo "<blockquote><h2>No se puede gestionar su centro </h2></blockquote>";
			echo "Ud. ya excedi&oacute; la cantidada m&aacute;xima de centros disponibles";
		}	
	}
	mysql_close($link);
?>
</p>
    
  </div>
 <?php include_once '../footer.php';?>

</form>
<script type="text/javascript" src="../js/1.11.1/jquery.min.js"></script>
<script src="../js/bootstrap/3.3.0/bootstrap.min.js"></script>
<script src="../js/material/material.min.js"></script>
<script src="../js/material/ripples.min.js"></script>
<script>
      $.material.init();
</script>
</body>
</html>