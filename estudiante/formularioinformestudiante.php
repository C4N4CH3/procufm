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
	$nombre = $fila["nombre"];
	$apellido = $fila["apellido"];
	$email = $fila["email"];
	$carnet = $fila["carnet"];	
}
//ojo con este arreglar
if($estatus<2 ){
	header ("Location: sesionestudiante.php?gestionarinscripcion=si");
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
<form action="" method="post">

  <?php include_once '../navbar.php';?>
  <div class="sidebar1"> 
    <?php require_once 'menu_al.php';?>
  <!-- end .sidebar1 --></div>
<div class="well col-md-9 col-lg-9 col-sm-9 col-xs-9" style="margin-left:20px">
  
      <h2 align="center">Reporte en Linea <br>Informe quincenal de Pasantias</h2>
 
 
    Nombre y Apellido:<?php echo $nombre." ".$apellido?><br /> 
    Carnet:<?php echo $carnet?><br />
    Email:<?php echo $email?>

    <p>
      <?php 
	
	$consultaPre = "select * from preinscripcion where cedula_alumno='$ci'";
	$resultadoPre = mysql_query($consultaPre) or die (mysql_error());
	if($filapre = mysql_fetch_array($resultadoPre)){
		$idpreins = $filapre["id_preinscripcion"];
		
		$consultaIns = "select * from inscripcion where id_preinscripcion='$idpreins'";
		$resultadoIns = mysql_query($consultaIns) or die (mysql_error());
		if($filains = mysql_fetch_array($resultadoIns)){
			$idincrito = $filains["id_inscrito"];
			
			$consultaControlInf = "select * from control_informes where id_inscrito='$idincrito'";
			$resultadoControlInf = mysql_query($consultaControlInf) or die (mysql_error());
			$num_informes = mysql_num_rows($resultadoControlInf);
			
			if ($num_informes>0){
				$i=0;
				echo "<table width=100% border=1>";
				echo "<tr>";
				echo "<th scope=col>#</th>";
				echo "<th scope=col>Fecha</th>";
    			echo "<th scope=col>Calificaci&oacute;n</th>";
				echo "<th scope=col>Estado</th>";
    			echo "</tr>";
				while($filaControlinf = mysql_fetch_array($resultadoControlInf)){
					$idinformes = $filaControlinf["id_informes"];					
					$consultaInf = "select * from informes where id_informes='$idinformes'";
					$resultadoInf = mysql_query($consultaInf) or die (mysql_error());
					if($filaInf = mysql_fetch_array($resultadoInf)){						
						$i++;
						$arreglo["id"] = $filaInf["id_informes"];
						$arreglo["calificacionInforme"] = $filaInf["calificacion_informe"];
						$arreglo["estadoInforme"] = $filaInf["estado_informe"];
						$arreglo["fechaInforme"] = $filaInf["fecha_informe"];						
						
						echo "<tr>";
    					echo "<td>".$i."</td>";
    					echo "<td>".$arreglo["fechaInforme"]."</td>";
    					echo "<td>".$arreglo["calificacionInforme"]."</td>";
						echo "<td>".$arreglo["estadoInforme"]."</td>";
    					echo "</tr>";					
					}
				}
				
				echo "</table><br>";
			}
			else{
				echo "<br>No tienes informes cargados<br>";
			}
		}
		else{
			echo "<br>Ud no esta inscrito. Por Favor inscribirse<br>";
		}
}	
	?>    
      </p>
    
    <table width="100%" border="0">
      <tr>
    <td height="112"colspan="2" align="left" valign="top">Unidad (es) Administrativa (s) donde ha realizado su pasant&iacute;a durante <br> este lapso:<br/> <textarea name="unidad" rows="2" cols="70"></textarea></td>
    </tr>
    <tr>
          <td height="198" colspan="2" align="left" valign="top">
              Describa ordenadamente las actividades que ha realizado 
              en este lapso: <br>
          <textarea name="actividades" rows="7" cols="70"></textarea>
            </td>
        </tr>
        <tr>
            <td height="189" colspan="2" align="left" valign="top">
              Señale las limitaciones que se le han presentado en 
              su centro de pasant&iacute;as: <br>
                  <textarea name="limitaciones" rows="7" cols="70"></textarea>
            </td>
        </tr>
        <tr>
            <td height="112" colspan="2" align="left" valign="top">
              Se entrevist&oacute; con su Tutor Acad&eacute;mico 
              <input type="radio" name="radioacademico" value="si">Si 
                  <input type="radio" name="radioacademico" value="no">No ¿Por qu&eacute; no? <br>
              <textarea name="academico" rows="3" cols="70"></textarea>
            </td>
        </tr>
        <tr>
            <td height="98" colspan="2" align="left" valign="top">
                Se entrevist&oacute; con su Tutor Empresarial 
                <input type="radio" name="radioempresarial" value="si">Si 
                    <input type="radio" name="radioempresarial" value="no">No ¿Por qu&eacute; no? <br>
                <textarea name="empresarial" rows="3" cols="70"></textarea>
            </td>
        </tr>
        <tr>
            <td height="56" colspan="2" align="left" valign="top" >
              <em>Estos datos son estrictamente proporcionados por 
                  usted por lo que le solicitamos que la informaci&oacute;n 
                  sea pertinente</em>
            </td>
        </tr>
        <tr>
          <td width="48%" align="center"><input type="submit" name="enviar" value="Aceptar" onclick="validarinf(this.form)" /> 
          </td>
        </tr>
    </table></td>
    </tr>
    </table>   
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
<script language="javascript" src="validarsesiones.js"></script>
</body>
</html>
