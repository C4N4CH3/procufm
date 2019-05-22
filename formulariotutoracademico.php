<?php
require_once 'funciones.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Registro Tutor</title>
<link href="efecto.css" rel="stylesheet" type="text/css">
    <link href="css/jquery-ui.css" rel="stylesheet" type="text/css">
<script language="javascript" type="text/javascript" src="js/jquery-1.9.1.js"></script>
<script language="javascript" type="text/javascript" src="js/jquery-ui-1.10.3.custom.js"></script>
<script language="javascript" type="text/javascript" src="js/jquery-ui-1.10.3.custom.min.js"></script>
<script language="javascript" type="text/javascript" src="js/jquery.validate.js"></script>
<script language="javascript" type="text/javascript" src="js/func_tu_princi.js"></script>
<script language="javascript" type="text/javascript" src="js/func_gen_reg_princi.js"></script> 

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
      <li><a href="index.php"><img src="imagenes/blockcontentbullets.JPG" width="6" height="13" /><img src="imagenes/spacer.JPG" width="5" height="1" />Inicio</a></li>
      
  Registro 
    </ul>
    <ul class="nav">
      <li><a href="formularioestudiante.php"><img src="imagenes/blockcontentbullets.JPG" width="6" height="13" /><img src="imagenes/spacer.JPG" width="5" height="1" />Alumno</a></li>
      <!--<li><a href="formularioempresa.php"><img src="imagenes/blockcontentbullets.JPG" width="6" height="13" /><img src="imagenes/spacer.JPG" width="5" height="1" />Empresa</a></li>-->
      <li><a href="formulariotutoracademico.php"><img src="imagenes/blockcontentbullets.JPG" width="6" height="13" /><img src="imagenes/spacer.JPG" width="5" height="1" />Tutor acad&eacute;mico</a></li>
    </ul>
  <!-- end .sidebar1 --></div>
  <div class="content">
    <blockquote>
      <h2>Crear cuenta tutor acad&eacute;mico</h2>
    </blockquote>
      
<form action="registrotutoracademico.php" name="form1" id="form1" method="post">      
    <table width="100%" border="1">
    <input type="hidden" name="id_tutor" value="<?php echo $var_id ?>">
        <tr>
            <td align="right" width="40%">Nombre(s):</td>
            <td width="60%"><input type="text" name="nombre" id="nombre"
                                   onkeypress="return validarTexto(event)"></td>
        </tr>
        <tr>
            <td align="right">Apellido(s):</td>
            <td><input type="text" name="apellido" id="apellido"
                       onkeypress="return validarTexto(event)"></td>
        </tr>
        <tr>
            <td align="right">C&eacute;dula de identidad:</td>
            <td><input type="text" name="cedula" id="cedula" 
                       onkeypress="return validarNumero(event)" maxlength="8"></td>
        </tr>
        <tr>
            <td align="right">Nombre de usuario:</td>
            <td><input type="text" name="nombreusuario" id="nombreusuario"
                       onkeypress="return validarTextoNumero(event)">
                    <span id="info"></span>
            </td>
        </tr>

        <tr>
            <td align="right">Carrera:</td>
            <td>

                <select size="1" name="carrera" id="carrera" class="carrera">
                    <option value="">Seleccione Carrera</option>
                    <?Php
                    echo _listar_carreras();
                    ?>
                </select>


            </td>        
        </tr>
        <tr>
            <td align="right">Menci&oacute;n:</td>
            <td>
                <select size="1" name="mencion" id="mencion" class="mencion">
                    <option value="">Seleccione Mención</option>
                    <?Php
                    echo _listar_menciones();
                    ?>
                </select>

            </td>
        </tr>

        <tr>
            <td align="right">Area de Trabajo:</td>
            <td><input type="text" name="area_trabajo" id="area_trabajo" class="mayuscula"
                       onkeypress="return validarTexto(event)"></td>
        </tr>
        
        <tr>
        <td align="right" >Tel&eacute;fono:</td>
        <td ><input type="text" name="telefono" id="telefono" 
                    onkeypress="return validarNumero(event)"></td>
        </tr>
        
        <tr>
            <td align="right">Correo electr&oacute;nico:</td>
            <td><input type="text" name="email" id="email" class="mayuscula"
                       onkeypress="return validarEmail(event)"></td>
        </tr>
        <tr>
            <td align="right">Contraseña:</td>
            <td><input type="password" name="clave" id="clave" 
                       onkeypress="return validarTextoNumero(event)"></td>
        </tr>	
        <tr>
            <td align="right">Confirmar contraseña:</td>
            <td><input type="password" name="reclave" id="reclave" 
                       onkeypress="return validarTextoNumero(event)"></td>
        </tr>
</table> 
    <p align="center">
    <input type="reset" name="limpiar" value="Limpiar">&nbsp;&nbsp;&nbsp;
    <input type="submit" name="enviar" value="Aceptar">   
    </p>
</form> 
    <p><!-- end .content --></p>
  </div>
<div class="sidebar2">
  <h4 align="center"><img src="logos/imagen_cufm.JPG" width="165" height="153" /></h4>
    <p>&nbsp;</p>
    <!-- end .sidebar2 --></div>
  <div class="footer">
    <p><strong>Colegio Universitario &quot;Francisco de Miranda&quot;</strong><br />
Dirección: Av. Urdaneta. Esquina de Mijares. Parroquia Altagracia. Teléfonos: (58)(0212) 8620422 / 8646880<br />
 Sistema de Gesti&oacute;n Administrativa de Pasant&iacute;a 2015 - Caracas, Venezuela.</p>
    <!-- end .footer --></div>
  <!-- end .container --></div> 
</body>
</html>