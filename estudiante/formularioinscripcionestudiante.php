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
	$ira = $fila["indice_academico"];
}

if($estatus>2 || $estatus==2){
	mysql_close($link);
	header ("Location: sesionestudiante.php?inscrito=si");
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
<form action="" method="post" name="formulario1">

<?php include_once '../navbar.php';?>

  <div class="sidebar1"> 
    <?php require_once 'menu_al.php';?>
  <!-- end .sidebar1 --></div>
<div class="well col-md-9 col-lg-9 col-sm-9 col-xs-9" style="margin-left:20px">

      <h2>Inscripci&oacute;n Estudiante</h2>

    <p><?php
	if($ira >= 12){		
		echo "Su indice acad&eacute;mico es: ".$ira;
		$consulta_lapso = "select * from lapso where lapso_habilitado='si'";
		$resultado_lapso = mysql_query($consulta_lapso) or die (mysql_error());
		if ($fila1 = mysql_fetch_array($resultado_lapso)){
			$cod_lapso = $fila1["codigo_lapso"];
			echo "<br> C&oacute;digo del lapso es: ".$cod_lapso;
			
			//consulta tabla fecha_actividades (Tiempo Completo)			
			$consultaFechaAct = "select * from fecha_actividades where codigo_lapso='$cod_lapso' and tipo_pasantias='tiempo completo' and fecha_habilitado='si'";
			$resultadoFechaAct = mysql_query($consultaFechaAct) or die (mysql_error());
			$i=0;			
			if(mysql_num_rows($resultadoFechaAct)>0){				
				while($filaFecha = mysql_fetch_array($resultadoFechaAct)){
					$arreFecha[$i]["idfecha"] = $filaFecha["id_fecha"];
					$arreFecha[$i]["fechaInicio"] = $filaFecha["fecha_inicio"];
					$arreFecha[$i]["fechaCulminacion"] = $filaFecha["fecha_culminacion"];
					$arreFecha[$i]["fechaInforme"] = $filaFecha["fecha_infinal"];
					$i++;				
				}
				echo "<br><p align=center>Tienes la opci&oacute;n de elegir las siguientes Fechas: </p>";
				echo "<p align=center>Tiempo Completo: </p>";
				echo "<p align=center>Cuarenta(40) d&iacute;as h&aacute;biles (8 semanas)</p><br>";			
				echo "<table width=100% border=1>";
				echo "<tr>";
    			echo "<th width=12% scope=col>&nbsp;</th>";
				echo "<th width=29% scope=col>Inicio</th>";
    			echo "<th width=29% scope=col>Fin</th>";
    			echo "<th width=29% scope=col>Entrega Informe</th>";
  				echo "</tr>";
				for($j=0; $j<$i; $j++){
					echo "<tr>";
    				echo "<td align=center><input type=radio name=seleccionfecha value=".$arreFecha[$j]["idfecha"]."></td>";
    				echo "<td align=center>".$arreFecha[$j]["fechaInicio"]."</td>";
    				echo "<td align=center>".$arreFecha[$j]["fechaCulminacion"]."</td>";
    				echo "<td align=center>".$arreFecha[$j]["fechaInforme"]."</td>";
  					echo "</tr>";
				}
				echo "</table> <br><br>";
								
			}
			else{
				echo "<p align=center>Tiempo Completo: ";
				echo "<br>No hay Fechas para seleccionar.</p><br>";								
			}			
			
			//consulta tabla fecha_actividades (Medio Tiempo)
			$consultaFechaAct1 = "select * from fecha_actividades where codigo_lapso='$cod_lapso' and tipo_pasantias='medio tiempo' and fecha_habilitado='si'";
			$resultadoFechaAct1 = mysql_query($consultaFechaAct1) or die (mysql_error());
			if(mysql_num_rows($resultadoFechaAct1)>0){
				$iniciadorfor = $i; 
				while($filaFecha1 = mysql_fetch_array($resultadoFechaAct1)){
					$arreFecha[$i]["idfecha"] = $filaFecha1["id_fecha"];
					$arreFecha[$i]["fechaInicio"] = $filaFecha1["fecha_inicio"];
					$arreFecha[$i]["fechaCulminacion"] = $filaFecha1["fecha_culminacion"];
					$arreFecha[$i]["fechaInforme"] = $filaFecha1["fecha_infinal"];				
					$i++;
				}
				echo "<p align=center>Medio Tiempo: </p>";			
				echo "<p align=center>Ochenta(80) d&iacute;as h&aacute;biles (168 semanas)</p><br>";
				echo "<table width=100% border=1>";
				echo "<tr>";
    			echo "<th width=12% scope=col>&nbsp;</th>";
				echo "<th width=29% scope=col>Inicio</th>";
    			echo "<th width=29% scope=col>Fin</th>";
    			echo "<th width=29% scope=col>Entrega Informe</th>";
  				echo "</tr>";
				for($j=$iniciadorfor; $j<$i; $j++){
					echo "<tr>";
    				echo "<td align=center><input type=radio name=seleccionfecha value=".$arreFecha[$j]["idfecha"]."></td>";
    				echo "<td align=center>".$arreFecha[$j]["fechaInicio"]."</td>";
    				echo "<td align=center>".$arreFecha[$j]["fechaCulminacion"]."</td>";
    				echo "<td align=center>".$arreFecha[$j]["fechaInforme"]."</td>";
  					echo "</tr>";
				}
				echo "</table> <br><br>";							
			}
			else{
				echo "<p align=center>Medio Tiempo: ";
				echo "<br>No hay Fechas para seleccionar.</p><br>";	
			}			
			
		}else{
			echo "<br>El departamento no ha definido codigo de lapso";
		}		
	}
	else if($ira > 0 && $ira < 12){
		echo "Su indice acad&eacute;mico es: ".$ira;
		$consulta_lapso = "select * from lapso where lapso_habilitado='si'";
		$resultado_lapso = mysql_query($consulta_lapso) or die (mysql_error());
		if ($fila1 = mysql_fetch_array($resultado_lapso)){
			$cod_lapso = $fila1["codigo_lapso"];
			echo "<br> C&oacute;digo del lapso es: ".$cod_lapso;
			
			//consulta tabla fecha_actividades (Tiempo Completo)			
			$consultaFechaAct = "select * from fecha_actividades where codigo_lapso='$cod_lapso' and tipo_pasantias='pasantia larga' and fecha_habilitado='si'";
			$resultadoFechaAct = mysql_query($consultaFechaAct) or die (mysql_error());
			$i=0;			
			if(mysql_num_rows($resultadoFechaAct)>0){				
				while($filaFecha = mysql_fetch_array($resultadoFechaAct)){
					$arreFecha[$i]["idfecha"] = $filaFecha["id_fecha"];
					$arreFecha[$i]["fechaInicio"] = $filaFecha["fecha_inicio"];
					$arreFecha[$i]["fechaCulminacion"] = $filaFecha["fecha_culminacion"];
					$arreFecha[$i]["fechaInforme"] = $filaFecha["fecha_infinal"];
					$i++;				
				}
				echo "<br><p align=center>Tienes la opci&oacute;n de elegir las siguientes Fechas: </p>";
				echo "<p align=center>Pasantias Largas: </p>";
				echo "<p align=center>Cincuenta(50) d&iacute;as h&aacute;biles (10 semanas)</p><br>";			
				echo "<table width=100% border=1>";
				echo "<tr>";
    			echo "<th width=12% scope=col>&nbsp;</th>";
				echo "<th width=29% scope=col>Inicio</th>";
    			echo "<th width=29% scope=col>Fin</th>";
    			echo "<th width=29% scope=col>Entrega Informe</th>";
  				echo "</tr>";
				for($j=0; $j<$i; $j++){
					echo "<tr>";
    				echo "<td align=center><input type=radio name=seleccionfecha value=".$arreFecha[$j]["idfecha"]."></td>";
    				echo "<td align=center>".$arreFecha[$j]["fechaInicio"]."</td>";
    				echo "<td align=center>".$arreFecha[$j]["fechaCulminacion"]."</td>";
    				echo "<td align=center>".$arreFecha[$j]["fechaInforme"]."</td>";
  					echo "</tr>";
				}
				echo "</table> <br><br>";
								
			}
			else{
				echo "<p align=center>Pasantias Largas: ";
				echo "<br>No hay Fechas para seleccionar.</p><br>";								
			}		
		}
		else{
			echo "<br>El departamento no ha definido codigo de lapso";
		}		
	}else {
		echo "Ud. no se ha preincrito. <br>entre en el menu de Preinscripci&oacute;n.";
	}
	
	?>
    </p>
    
    
    
    <table width="100%">
      <tr>
        <td align="right"></td>
        <td></td>
      </tr>
      <tr>
        <td align="center" colspan="2"><em>Datos del centro de pasant&iacute;a</em></td>
      </tr>
      <tr>
        <td align="right">Nombre de la empresa:</td>
        <td><input name="nombre" type="text" onkeypress="return validarTextoNumero(event)" value="<?php if(isset($_POST['nombre'])) echo $_POST['nombre']?>" size="40"></td>
        </tr>
      <tr>
        <td align="right">Direcci&oacute;n de la empresa:</td>
        <td><input name="direccion" type="text" onkeypress="return validarTextoNumero(event)" value="<?php if(isset($_POST['direccion'])) echo $_POST['direccion']?>" size="40" ></td>
        </tr>
      <tr>
        <td align="right">Tel&eacute;fono de la empresa:</td>
        <td><input name="telefono" type="text" onkeypress="return validarNumero(event)" value="<?php if(isset($_POST['telefono'])) echo $_POST['telefono']?>" size="40"></td>
      </tr>
      <tr>
        <td align="center" colspan="2"><em>Jefe responsable del &aacute;rea de Pasant&iacute;a:</em></td>
      </tr>
      <tr>
        <td align="right">Nombre:</td>
        <td><input name="responsable" type="text" onkeypress="return validarTexto(event)" value="<?php if(isset($_POST['responsable'])) echo $_POST['responsable']?>" size="40" /></td>
      </tr>
      <tr>
        <td align="right">Cargo:</td>
        <td><input name="cargo" type="text" onkeypress="return validarTextoNumero(event)" value="<?php if(isset($_POST['cargo'])) echo $_POST['cargo']?>" size="40" /></td>
      </tr>
      <tr>
        <td align="right">Tel&eacute;fono:</td>
        <td><input name="telresponsable" type="text" onkeypress="return validarNumero(event)" value="<?php if(isset($_POST['telresponsable'])) echo $_POST['telresponsable']?>" size="40" /></td>
      </tr>
      <tr>
        <td align="right">Email:</td>
        <td><input name="emailresponsable" onkeypress="return validarEmail(event)" type="text" value="<?php if(isset($_POST['emailresponsable'])) echo $_POST['emailresponsable']?>" size="40" /></td>
      </tr>
      <tr>
        <td align="center" colspan="2"><em>Lugar donde realizar&aacute; las pasant&iacute;as</em></td>
      </tr>
      <tr>
        <td align="right">&Aacute;rea o departamento:</td>
        <td><input name="area" type="text" onkeypress="return validarTexto(event)" value="<?php if(isset($_POST['area'])) echo $_POST['area']?>" size="40" /></td>
      </tr>
      <tr>
        <td align="right">Horario:</td>
        <td><input name="horario" type="text" placeholder="Ejemplo de 8:00am a 4:00pm" value="<?php if(isset($_POST['horario'])) echo $_POST['horario']?>" size="40" /></td>
      </tr>      
      <tr>
        <td align="right" valign="top">¿C&oacute;mo obtuvo el centro?</td>
        <td align="left"><input type="radio" name="obtenercentro" value="trabaja alli"/>Trabaja all&iacute;<br>
        <input type="radio" name="obtenercentro" value="gestion propia"/>Gesti&oacute;n propia<br>
        <input type="radio" name="obtenercentro" value="dpto pasantia"/>Dpto. Pasant&iacute;a<br>
        <input type="radio" name="obtenercentro" value="otro"/>Otro        
        </td>
      </tr>
      <tr>
        <td align="center" colspan="2"><em>Datos del tutor empresarial</em></td>
      </tr>
      <tr>
        <td align="right">Nombre(s) y apellido(s):</td>
        <td><input name="nombretutor" onkeypress="return validarTexto(event)" type="text" value="<?php if(isset($_POST['nombretutor'])) echo $_POST['nombretutor']?>" size="40" /></td>
      </tr>
      <tr>
        <td align="right">Cargo:</td>
        <td><input name="cargotutor" type="text" onkeypress="return validarTextoNumero(event)" value="<?php if(isset($_POST['cargotutor'])) echo $_POST['cargotutor']?>" size="40" /></td>
      </tr>
      <tr>
        <td align="right">Email:</td>
        <td><input name="emailtutor" type="text" onkeypress="return validarEmail(event)" value="<?php if(isset($_POST['emailtutor'])) echo $_POST['emailtutor']?>" size="40" /></td>
      </tr>
      <tr>
        <td align="right">Tel&eacute;fono:</td>
        <td><input name="teletutor" type="text" onkeypress="return validarNumero(event)" value="<?php if(isset($_POST['teletutor'])) echo $_POST['teletutor']?>" size="40" /></td>
      </tr>
  </table> 
  <p align=center><input type="submit" name="enviar" value="Enviar" onclick="validarinscripcion(this.form)"></p>  
    <?php
		mysql_close($link);
	?>
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
<script language="javascript" src="../validarsesiones.js"></script>
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
function validarEmail(e) { 
    tecla = (document.all) ? e.keyCode : e.which; 
    if ( (tecla==8) || (tecla==9) )
	{
		return true;
	} 
    patron = /\d|(\W?[^\][\\}{\+\*\?\/\¨`´:;,çÇ¿¡'%=()&%$·"!ªº|#~½¬])/; 
    te = String.fromCharCode(tecla); 
    return patron.test(te);
}
</script>
</body>
</html>
