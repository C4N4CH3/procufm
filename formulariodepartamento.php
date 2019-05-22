<?php
include ("sesiones.php");
if($_SESSION['nivel']!=$_SESSION['id']){
session_destroy();
echo "FALLA GRAVE AL SISTEMA, PERDISTE LA SESION, PARA REGRESAR AL INICIO REINICIA EL NAVEGADOR";exit();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Registro Departamento</title>
<link href="efecto.css" rel="stylesheet" type="text/css">
<script language="javascript" src="funciones.js"></script>
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
    <p>Principal 
    </p>
    <ul class="nav">
      <li><a href="sesionadministrador.php"><img src="imagenes/blockcontentbullets.JPG" width="6" height="13" /><img src="imagenes/spacer.JPG" width="5" height="1" />Inicio</a></li>
      
  Registro 
    </ul>
    <ul class="nav">
      <li><a href="formulariodepartamento.php"><img src="imagenes/blockcontentbullets.JPG" width="6" height="13" /><img src="imagenes/spacer.JPG" width="5" height="1" />Departamento</a></li>
    </ul>
  <!-- end .sidebar1 --></div>
  <div class="content">
    <blockquote>
      <h2>Crear Cuenta de Departamento</h2>
    </blockquote> 
    <table>
		<tr>
			<td width="182" align="right">Nombre(s):</td>
			<td width="289"><input type="text" onkeypress="return validarTexto(event)" name="nombre" value="<?php if(isset($_POST['nombre'])) echo $_POST['nombre']?>"></td>
			<td width="61">&nbsp;</td>
		</tr>
		<tr>
			<td align="right">Apellido(s):</td>
			<td><input type="text" name="apellido" onkeypress="return validarTexto(event)" value="<?php if(isset($_POST['apellido'])) echo $_POST['apellido']?>"></td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td align="right">C&eacute;dula de identidad:</td>
			<td><input type="text" name="cedula" onkeypress="return validarNumero(event)" value="<?php if(isset($_POST['cedula'])) echo $_POST['cedula']?>"></td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td align="right">Cargo:</td>
			<td><input type="text" name="cargo" onkeypress="return validarTextoNumero(event)" value="<?php if(isset($_POST['cargo'])) echo $_POST['cargo']?>"></td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td align="right">Nombre de usuario:</td>
			<td><input type="text" name="nombreusuario" onkeypress="return validarTextoNumero(event)" value="<?php if(isset($_POST['nombreusuario'])) echo $_POST['nombreusuario']?>">
			<input type="submit" name="disponible" value="Disponibilidad" onclick="validardisponibledepartamento(this.form)"></td>
			<td>
            <?php
            if(isset($_GET["disponible"]) && $_GET["disponible"]=="si"){
				echo "<img src=\"logos/bueno.JPG\" width=\"16\" height=\"16\" align=\"center\" />";
			}
			if(isset($_GET["disponible"]) && $_GET["disponible"]=="no"){
				echo "<img src=\"logos/malo.JPG\" width=\"16\" height=\"16\" align=\"center\"/>";
			}
            ?>
            </td>
		</tr>
		<tr>
			<td align="right">Contraseña:</td>
			<td><input type="password" name="clave" onkeypress="return validarTextoNumero(event)" value="<?php if(isset($_POST['clave'])) echo $_POST['clave']?>"></td>
			<td>&nbsp;</td>
		</tr>	
		<tr>
			<td align="right">Confirmar contraseña:</td>
			<td><input type="password" name="reclave" onkeypress="return validarTextoNumero(event)" value="<?php if(isset($_POST['reclave'])) echo $_POST['reclave']?>"></td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td align="right">Correo electr&oacute;nico:</td>
			<td><input type="text" name="email" onkeypress="return validarEmail(event)" value="<?php if(isset($_POST['email'])) echo $_POST['email']?>"></td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td align="right"><input type="reset" name="reset" value="Limpiar"></td>
			<td><input type="submit" name="enviar" value="Aceptar" onClick="validardep(this.form)"></td>
			<td>&nbsp;</td>		
		</tr>
		</table>
    <p>&nbsp;</p>
</div>
<div class="sidebar2">
  <h4 align="center"><img src="logos/imagen_cufm.JPG" width="165" height="153" /></h4>
    <p>&nbsp;</p>
    <!-- end .sidebar2 --></div>
  <div class="footer">
    <p><strong>Colegio Universitario &quot;Francisco de Miranda&quot;</strong><br />
Dirección: Av. Urdaneta. Esquina de Mijares. Parroquia Altagracia. Teléfonos: (58)(0212) 8620422 / 8646880<br />
 Sistema de Gesti&oacute;n Administrativa de Pasant&iacute;a 2011 - Caracas, Venezuela.</p>
    <!-- end .footer --></div>
  <!-- end .container --></div> 
</form> 
</body>
</html>