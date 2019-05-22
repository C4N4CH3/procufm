<?php
include ("../sesiones.php");
if($_SESSION['nivel']!=$_SESSION['id'])
{
session_destroy();
echo "FALLA GRAVE AL SISTEMA, PERDISTE LA SESION, PARA REGRESAR AL INICIO REINICIA EL NAVEGADOR";exit();
 
}

include ("../conexionbd.php");
$id_documento = $_GET['doc'];
$cedula_alum = $_GET['cedula'];

$fecha_actual='';
$cedula_alumno ='';
$nombre_centro='';
$carta_dirigida='';
$cargo_asignado='';
$telefono_lapso='';

/*echo $id_documento.'holaaaaaaaaaa';
echo $cedula_alumno;*/
$dat_alum="SELECT a.nombre, a.apellido, a.cedula_alumno, a.carnet, c.nombre_carrera, m.nombre_mencion 
			FROM alumno AS a
			INNER JOIN carreras AS c ON c.id_carrera = a.id_carrera
			INNER JOIN menciones AS m ON m.id_mencion = a.id_mencion 
			WHERE cedula_alumno = '$cedula_alum'";
			//echo $dat_alum;
			$consulta=mysql_query($dat_alum);
			while ($result = mysql_fetch_array($consulta, MYSQL_NUM))				 		 
			{
				list($nombre, $apellido,  $cedula_alumno, $carnet, $carrera, $mencion)=$result;
			}	

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
<link href="../css/jquery-ui.css" rel="stylesheet" type="text/css">

</head>
<body>



<?php include_once '../navbar.php';?>
<div class="sidebar1"> 
    <?php include_once("menu_admin.php")?>
  <!-- end .sidebar1 -->
</div>
  <div class="well col-md-9 col-lg-9 col-sm-9 col-xs-9" style="margin-left:20px">
 <h2 align="center">Carta de Postulaci&oacute;n </h2>
 <!--<h4><p align="center">Antes de continuar por favor verifica que tus datos esten correctos:</p></h4>-->
<p>

<?Php /*
echo $nombre.'<br/>';
echo $apellido.'<br/>';
echo $cedula_alumno.'<br/>';
echo $carnet.'<br/>';
echo $carrera.'<br/>';
echo $mencion.'<br/>';*/
?>

 <table width="100%"% border="0" align="center">
   <tr>
       <td align="center" colspan="2"><strong><h3>DATOS PERSONALES</h3></strong></td>
   </tr>
   <tr>
     <td width="309" align="right"><em>Nombre:</em></td>
     <td ><?php echo $nombre; ?></td>
   </tr>
    <tr>
     <td width="309" align="right"><em>Apellido:</em></td>
     <td ><?php echo $apellido;?></td>
   </tr>
   <tr>
     <td align="right"><em>C&eacute;dula:</em></td>
     <td><?php echo $cedula_alumno?></td>
   </tr>
   <tr>
     <td align="right"><em>Carnet:</em></td>
     <td><?php echo $carnet?></td>
   </tr>
   <tr>
     <td align="right"><em>Carrera:</em></td>
     <td><?php echo utf8_encode($carrera);?></td>
   </tr>
   <tr>
     <td height="29" align="right"><em>Menci&oacute;n:</em></td>
     <td width="281"><?php echo utf8_encode($mencion);?></td>
   </tr>   
   </table>
   </p>
   <p>
   	<?php
   
   	$consulta_pre ="select id_preinscripcion from preinscripcion where cedula_alumno='$cedula_alumno'";	
	$consulta=mysql_query($consulta_pre);
	while ($result = mysql_fetch_array($consulta, MYSQL_NUM))				 		 
		{
			list($id_preinscripcion)=$result;
		}
	$consulta_doc ="select  fecha_actual, nombre_centro, carta_dirigida, cargo_asignado,telefono_lapso 
					from documento where id_preinscripcion='$id_preinscripcion'";	
					//echo $consulta_doc;
	$consulta=mysql_query($consulta_doc);
	while ($result = mysql_fetch_array($consulta, MYSQL_NUM))				 		 
		{
			list($fecha_actual, $nombre_centro, $carta_dirigida, $cargo_asignado, $telefono_lapso )=$result;
		
		}
		
		//echo $fecha_actual;
        mysql_close($link);
		
?>  
<form name="form1" id="form1" action="almacenacartapostulacion_admin.php" method="post">
        
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
         <input type="text" name="fecha_actual"  id="fecha_actual" class="datepicker" value="<?php 
         $trozo = explode("-", $fecha_actual);
         echo $trozo[2]."-".$trozo[1]."-".$trozo[0];
         ?>" size="10" maxlength="10">

     </td>
   </tr>
   <tr>
     <td width="309" align="right">Nombre del Centro de Pasant&iacute;as:</td>
     <input type="hidden" value="<?Php echo $cedula_alumno; ?>" name="cedula" id="cedula" />
     <td width="281"><input type="text" name="nombre_centro" id="nombre_centro" 
                            value="<?php  echo $nombre_centro; ?>" size="15"></td>
   </tr>
   <tr>
     <td align="right">Dirigido a:</td>
     <td><input type="text" name="carta_dirigida" id="carta_dirigida" onkeypress="return validarTexto(event)" 
                value="<?php echo $carta_dirigida; ?>" size="15"></td>
   </tr>
   <tr>
     <td align="right">Cargo que desempe&ntilde;a:</td>
     <td><input type="text" name="cargo_asignado" id="cargo_asignado" onkeypress="return validarTextoNumero(event)" 
                value="<?php  echo $cargo_asignado; ?>" size="15"></td>
   </tr>
   <tr>
     <td height="27" align="right">Tel&eacute;fono:</td>
     <td><input type="text" name="telefono" id="telefono" onkeypress="return validarNumero(event)" 
                value="<?php  echo $telefono_lapso; ?>" size="15"></td>
   </tr>
   <p>&nbsp; </p>
   <tr>
     <td align="right"><input type="reset" name="limpiar" value="Limpiar"/></td>
     <td align="left"><input type="submit" name="enviar" value="Aceptar" /></td>
   </tr>
 </table>
 </form>

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
<script language="javascript" type="text/javascript" src="../js/jquery-ui-1.10.3.custom.min.js"></script>
<script language="javascript" type="text/javascript" src="../js/jquery.validate.js"></script>
<script language="javascript" type="text/javascript" src="../js/func_carta.js"></script>   
<script type="text/javascript">

<?Php 
?>


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