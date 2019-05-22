<?php
include ("../sesiones.php");
if($_SESSION['nivel']!=$_SESSION['id'])
{
session_destroy();
echo "FALLA GRAVE AL SISTEMA, PERDISTE LA SESION, PARA REGRESAR AL INICIO REINICIA EL NAVEGADOR";exit();

}
$ci = $_SESSION['cedula'];
include "../conexionbd.php";
$consulta = "SELECT  a.nombre, a.apellido, a.carnet, c.nombre_carrera, m.nombre_mencion
			from alumno AS a
			INNER JOIN carreras AS c ON a.id_carrera = c.id_carrera
			INNER JOIN menciones AS m ON a.id_mencion = m.id_mencion
 			where cedula_alumno='$ci'";
$resultado = mysql_query($consulta) or die (mysql_error());
if ($fila = mysql_fetch_array($resultado)){
    $nombre_men = $fila["nombre_mencion"];
	$nombre = $fila["nombre"];
	$apellido = $fila["apellido"];
	$carnet = $fila["carnet"];
	$nombre_car = $fila["nombre_carrera"];
	
	/*echo $mencion.'<br/>';
	echo $nombre.'<br/>';
	echo $apellido.'<br/>';
	echo $carnet.'<br/>';
	echo $carrera.'<br/>';	*/
}

/*$consulta2 = "select * from carrera where id_carrera='$carrera'";
$nombre_carrera = mysql_query($consulta2) or die (mysql_error());

if ($fila = mysql_fetch_array($nombre_carrera)){
    $nombre_car = $fila["nombre"];
}

$consulta3 = "select * from mencion where id_mencion='$mencion'";;
$nombre_mencion = mysql_query($consulta3) or die (mysql_error());
 
if ($fila = mysql_fetch_array($nombre_mencion)){
    $nombre_men = $fila["nombre"];
}
*/
$hoy= date("Y-n-j");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Carta de Postulaci&oacute;n</title>
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
 <h2 align="center">Carta de Postulaci&oacute;n </h2>
 <h4><p align="center">Antes de continuar por favor verifica que tus datos esten correctos:</p></h4>
<p>
 <table width="100%"% border="0" align="center">
   <tr>
     <td width="309" align="right"><em>Nombres y Apellidos:</em></td>
     <td ><?php echo $nombre." ".$apellido?></td>
   </tr>
   <tr>
     <td align="right"><em>C&eacute;dula:</em></td>
     <td><?php echo $ci?></td>
   </tr>
   <tr>
     <td align="right"><em>Carnet:</em></td>
     <td><?php echo $carnet?></td>
   </tr>
   <tr>
     <td align="right"><em>Carrera:</em></td>
     <td><?php echo utf8_encode($nombre_car);?></td>
   </tr>
   <tr>
     <td height="29" align="right"><em>Menci&oacute;n:</em></td>
     <td width="281"><?php echo utf8_encode($nombre_men);?></td>
   </tr>   
   </table>
   </p>
   <p>
   	<?php
   
   	$consulta_pre ="select * from preinscripcion where cedula_alumno='$ci'";
   	$resultado_pre =mysql_query($consulta_pre) or die (mysql_error());	
	if($fila_pre = mysql_fetch_array($resultado_pre)) {
  		$idpre = $fila_pre["id_preinscripcion"];	
	}	
	$consulta_centro_temp = "select * from centros_temporales where id_preinscripcion='$idpre'";
	$resultado_centro_temp = mysql_query($consulta_centro_temp) or die (mysql_error());	
	
	if (mysql_num_rows($resultado_centro_temp)>0){
		$i=0;
		echo "<table width=100% border=1>";
		echo "<tr>";
		echo "<th width=5% scope=col>#</th>";
		echo "<th width=40% scope=col>Nombre</th>";
    	echo "<th width=55% scope=col>Ubicaci&oacute;n</th>";
    	echo "</tr>";
		while($filaCentro = mysql_fetch_array($resultado_centro_temp)) {
  			$idvacantedeparta = $filaCentro["id_vacante_departamento"];		
		
			$consulta_vacante = "select * from vacante_departamento where id_vacante_departamento='$idvacantedeparta'";
			$resultado_vacante = mysql_query($consulta_vacante) or die (mysql_error());		
			if($fila_vacante = mysql_fetch_array($resultado_vacante)) {
  				$i++;
				$arreglo["nombre"] = $fila_vacante["nombre"];
				$arreglo["ubicacion"] = $fila_vacante["ubicacion"];			
  				echo "<tr>";
    			echo "<td>".$i."</td>";
    			echo "<td>".$arreglo["nombre"]."</td>";
    			echo "<td>".$arreglo["ubicacion"]."</td>";
    			echo "</tr>";		
			}		
		}
		echo "</table>";
	}
	else{
		echo "<p align=center><em>No ha gestionado centros</em></p>";
	}
			
?> 
<form name="formulario" id="formulario" action="" method="post">
   <table width="100%"% border="0" align="center">
   <tr>
     <td align="center" colspan="2"><b> De poseer sitio de Pasant&iacute;as indiquelos en los campos correspondientes: </b></td>
   </tr>
   <tr>
     <td align="center" colspan="2">&nbsp;</td>
   </tr>
   <tr>
     <td align="right">Fecha de Solicitud:</td>
     <td width="281" align="left">
     <!--<input name="fecha_actual" onkeypress="return validarTextoNumero(event)" type="text" value="<?php echo $hoy;?>" size="15">-->
     <input name="fecha_actual" type="text" id="dateArrival"  value="<?php echo $hoy;?>" size="10" maxlength="10" onClick="popUpCalendar(this, form.dateArrival, 'dd-mm-yyyy');">

     </td>
   </tr>
   <tr>
     <td width="309" align="right">Nombre del Centro de Pasant&iacute;as:</td>
     <td width="281"><input name="nombre_centro" onkeypress="return validarTextoNumero(event)" type="text" value="<?php if(isset($_POST['nombre_centro'])) echo $_POST['nombre_centro']?>" size="15"></td>
   </tr>
   <tr>
     <td align="right">Dirigido a:</td>
     <td><input name="carta_dirigida" type="text" onkeypress="return validarTexto(event)" value="<?php if(isset($_POST['carta_dirigida'])) echo $_POST['carta_dirigida']?>" size="15"></td>
   </tr>
   <tr>
     <td align="right">Cargo que desempe&ntilde;a:</td>
     <td><input name="cargo_asignado" type="text" onkeypress="return validarTextoNumero(event)" value="<?php if(isset($_POST['cargo_asignado'])) echo $_POST['cargo_asignado']?>" size="15"></td>
   </tr>
   <tr>
     <td height="27" align="right">Tel&eacute;fono:</td>
     <td><input name="telefono" type="text" onkeypress="return validarNumero(event)" value="<?php if(isset($_POST['telefono'])) echo $_POST['telefono']?>" size="15"></td>
   </tr>
   <p>&nbsp; </p>
   <tr>
     <td align="right"><input type="reset" name="limpiar" value="Limpiar"/></td>
     <td align="left"><input type="submit" name="enviar" value="Aceptar" onClick="validarcartapostulacion(this.form)"/></td>
   </tr>
 </table>
</form>
 </p>
  <p>
  <?php 
  if (isset($_GET["errorpreinscripcion"]) && $_GET["errorpreinscripcion"]=="si"){
	echo "<font color=red>Ud. no esta preinscrito</font>";
	echo "<script language=JavaScript>alert('Ud. no esta preinscrito');</script>";
	}
	?>
    <?php 
  if (isset($_GET["errorcant_documento"]) && $_GET["errorcant_documento"]=="si"){
	echo "<font color=red>Ud. alcanzo el limite de documento</font>";
	echo "<script language=JavaScript>alert('Ud. alcanzo el limite de documento');</script>";
	}
	?> 
    <?php 
	mysql_close($link);
	?>  
</p>
 </div>  
 <?php include_once '../footer.php';?>

<script type="text/javascript" src="../js/1.11.1/jquery.min.js"></script>
<script src="../js/bootstrap/3.3.0/bootstrap.min.js"></script>
<script src="../js/material/material.min.js"></script>
<script src="../js/material/ripples.min.js"></script>
<script>
      $.material.init();
</script>
  <script language="javascript" src="js/validardocumento.js"></script>
<script type="text/javascript">



//valida solo texto
function validarTexto(e) { 
    tecla = (document.all) ? e.keyCode : e.which; 
    if ( (tecla==8) || (tecla==9) || (tecla==32))
	{
		return true;
	}
    patron = /(\W?[^\][\\}{\+\*\?\/\_\-\.\¨`´:;,çÇ¿¡'=()&%$·"!ªº|@#~½¬ 0-9])/;
    te = String.fromCharCode(tecla); 
    return patron.test(te);
}
//valida texto y numeros
function validarTextoNumero(e) { 	
	tecla = (document.all)?e.keyCode:e.which;
	if ( (tecla==8) || (tecla==9))
	{
		return true;
	}
	patron = /\d|(\W?[^\][\\}{\+\*\?\¨`´:;,çÇ¿¡'=()&%$·"!ªº|@#~½¬])/;
	te = String.fromCharCode(tecla);
	return patron.test(te);
}

function validarNumero(e) { 
    tecla = (document.all) ? e.keyCode : e.which; 
    if ( (tecla==8) || (tecla==9))
	{
		return true;
	} 
    patron = /\d|(\W?[^\.\][\\}{\+\*\?\/\_\-\¨`´:;,çÇ¿¡'=()&%$·"!ªº|@#~½¬a-zA-Z Ññ])/; 
    te = String.fromCharCode(tecla); 
    return patron.test(te);
}
</script>
</body>
</html>