<?php
include ("sesiones.php");
if($_SESSION['nivel']!=$_SESSION['id']){
session_destroy();
echo "FALLA GRAVE AL SISTEMA, PERDISTE LA SESION, PARA REGRESAR AL INICIO REINICIA EL NAVEGADOR";exit();
}
//include("../funciones.php");
include ("funciones.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Centro Pasantía</title>
<link href="efecto.css" rel="stylesheet" type="text/css">
<script language="javascript" src="validarsesiones.js"></script>
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
    <p>Principal</p>
    <ul class="nav">
      <li><a href="sesiondepartamento.php"><img src="imagenes/blockcontentbullets.JPG" width="6" height="13" /><img src="imagenes/spacer.JPG" width="5" height="1" />Inicio</a></li>  
    </ul>
    <p>Gesti&oacute;n</p>
    <ul class="nav">
      <li><a href="cronogramapasantia.php"><img src="imagenes/blockcontentbullets.JPG" width="6" height="13" /><img src="imagenes/spacer.JPG" width="5" height="1" />Cronograma</a></li>
      <li><a href="formulariocentropasantiasss.php"><img src="imagenes/blockcontentbullets.JPG" width="6" height="13" /><img src="imagenes/spacer.JPG" width="5" height="1" />Centro pasant&iacute;a</a></li>
      <li><a href="documentodepartamento.php"><img src="imagenes/blockcontentbullets.JPG" width="6" height="13" /><img src="imagenes/spacer.JPG" width="5" height="1" />Documento</a></li>        
    <li><a href="documentotutor.php"><img src="imagenes/blockcontentbullets.JPG" width="6" height="13" /><img src="imagenes/spacer.JPG" width="5" height="1" />Tutores Acad.</a></li>    
    <li><a href="informedepartamento.php"><img src="imagenes/blockcontentbullets.JPG" width="6" height="13" /><img src="imagenes/spacer.JPG" width="5" height="1" />Informes</a></li>   
    </ul>
    <p>Estad&iacute;sticas</p>
    <ul class="nav">
      <li><a href="estadisticapreinscritos.php"><img src="imagenes/blockcontentbullets.JPG" width="6" height="13" /><img src="imagenes/spacer.JPG" width="5" height="1" />Preinscritos</a></li>
      <li><a href="estadisticainscritos.php"><img src="imagenes/blockcontentbullets.JPG" width="6" height="13" /><img src="imagenes/spacer.JPG" width="5" height="1" />Inscritos</a></li>
      <li><a href="estadisticaprobados.php"><img src="imagenes/blockcontentbullets.JPG" width="6" height="13" /><img src="imagenes/spacer.JPG" width="5" height="1" />Aprobados</a></li>
      <li><a href="estadisticareprobados.php"><img src="imagenes/blockcontentbullets.JPG" width="6" height="13" /><img src="imagenes/spacer.JPG" width="5" height="1" />Reprobados</a></li>
    </ul>
    <p>B&uacute;squeda</p>
    <ul class="nav">
      <li><a href="buscaralumnos.php"><img src="imagenes/blockcontentbullets.JPG" width="6" height="13" /><img src="imagenes/spacer.JPG" width="5" height="1" />Alumnos</a></li>
    </ul>
  <!-- end .sidebar1 --></div>
  <div class="content">
    <blockquote>
      <h2>Centro de Pasant&iacute;a</h2>
    </blockquote>    
    <p>Cargue centro disponibles para el proceso:    </p>
    <table width="100%" border="2">
      <tr>
        <td align="right">Codigo de Lapso:</td>
        <td><?php 
		include "conexionbd.php";
		$consulta = "select * from lapso where lapso_habilitado='si'";
		$resultado = mysql_query($consulta) or die (mysql_error());
		if ($fila = mysql_fetch_array($resultado)){
			$cod_lapso = $fila["codigo_lapso"];
			echo $cod_lapso;
		}else{
			echo "no se ha definido codigo de lapso";
		}		
		?></td>
      </tr>
      <tr>
        <td align="right">Nombre del Centro:</td>
        <td><input name="nombre" type="text" onkeypress="return validarTextoNumero(event)" value="<?php if(isset($_POST['nombre'])) echo $_POST['nombre']?>" size="80" maxlength="50"></td>
        </tr>
      <tr>
        <td align="right">Ubicaci&oacute;n del Centro:</td>
        <td><input name="ubicacion" type="text" onkeypress="return validarTextoNumero(event)" value="<?php if(isset($_POST['ubicacion'])) echo $_POST['ubicacion']?>" size="80" maxlength="50"></td>
        </tr>
      <tr>
        <td align="right">Cantidad de pasantes:</td>
        <td><input name="num_pasante" type="text" onkeypress="return validarNumero(event)"  value="<?php if(isset($_POST['num_pasante'])) echo $_POST['num_pasante']?>" size="80"></td>
      </tr>
      <tr>
      	
        <td align="right">Carrera:</td>
        <td>
        	<select size="1" style="width:510px; height:20px;" name="carrera" id="carrera"  >
                    	<option value="<?php echo $id_carrera; ?>"><?Php echo $descripcion_carrera; ?></option>
						<?Php
                            echo _listar_carreras();
                        ?>
		</select>
         </td>

      </tr>
      <tr>
        <td align="right">Menci&oacute;n</td>
        <td><select name="mencion">
          <option value=""> </option>
          <option value="1">Recursos Humanos</option>
          <option value="2">Transporte y Dist. de Bienes</option>
          <option value="3">Contadur&iacute;a</option>
          <option value="4">Hidrocarburos</option> 
          <option value="5">Banca y Finanzas</option>
          <option value="6">Admin y Gesti&oacute;n de Indus. Energ&eacute;ticas</option>
          <option value="7">Inform&aacute;tica</option>
          </SELECT></td>
      </tr>
      </table>
    <p align="center">&nbsp;</p>
    <p align="center">
      <input type="reset" name="reset" value="Limpiar">
      &nbsp;&nbsp;&nbsp;<input type="submit" name="enviar" value="Aceptar" onClick="centropasan(this.form)">
    </p>
</div>
<div class="sidebar2">
  <h4 align="center">Bienvenido: <?php echo $_SESSION['usuario']?></h4>
  <p align="center"><a href="cerrarsesion.php">Cerrar Sesi&oacute;n</a>    <!-- end .sidebar2 --></p>
</div>
  <div class="footer">
    <p><strong>Colegio Universitario &quot;Francisco de Miranda&quot;</strong><br />
Dirección: Av. Urdaneta. Esquina de Mijares. Parroquia Altagracia. Teléfonos: (58)(0212) 8620422 / 8646880<br />
Sistema de Gesti&oacute;n Administrativa de Pasant&iacute;a 2011 - Caracas, Venezuela.</p>
    <!-- end .footer --></div>
  <!-- end .container --></div> 
</form>
</body>
</html>
