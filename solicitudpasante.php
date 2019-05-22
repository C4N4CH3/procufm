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
<title>Registro Empresa</title>
<link href="efecto.css" rel="stylesheet" type="text/css">
<script language="javascript" src="funciones.js"></script>
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
      <li><a href="sesionempresa.php"><img src="imagenes/blockcontentbullets.JPG" width="6" height="13" /><img src="imagenes/spacer.JPG" width="5" height="1" />Inicio</a></li>      
  Pasantes 
    </ul>
    <ul class="nav">
      <li><a href="solicitudpasante.php"><img src="imagenes/blockcontentbullets.JPG" width="6" height="13" /><img src="imagenes/spacer.JPG" width="5" height="1" />Solicitud </a></li>
      <li><a href="respuestasolicitud.php"><img src="imagenes/blockcontentbullets.JPG" width="6" height="13" /><img src="imagenes/spacer.JPG" width="5" height="1" />Respuesta</a></li>      
  Fechas
    </ul>
    <ul class="nav">
      <li><a href="cronogramaempresa.php"><img src="imagenes/blockcontentbullets.JPG" width="6" height="13" /><img src="imagenes/spacer.JPG" width="5" height="1" />Cronograma</a></li>
    </ul>
  <!-- end .sidebar1 --></div>
  <div class="content">
 
    <blockquote>
      <h2>Solicitud de Pasantes</h2>
      </blockquote>
    <p>Por favor indique los Datos Requeridos para la solicitud de pasantes:</p> 
     <form action="" method="post">
    <table align="center">
		<tr>
			<td width="182" align="right">Vacante/Carrera:</td>
			<td width="268"><select name="carrera">
			  <option value=""> </option>
			  <option value="1">Administraci&oacute;n</option>
			  <option value="2">Contadur&iacute;a</option>
			  <option value="3">Inform&aacute;tica</option>      
		  </select></td>
		</tr>
		<tr>
			<td align="right">Vacante/Menci&oacute;n:</td>
			<td><select name="mencion">
			  <option value=""> </option>
			  <option value="1">Recursos Humanos</option>
			  <option value="2">Transporte y Dist. de Bienes</option>
			  <option value="3">Contadur&iacute;a</option>
			  <option value="4">Hidrocarburos</option> 
			  <option value="5">Banca y Finanzas</option>
			  <option value="6">Admin y Gesti&oacute;n de Indus. Energ&eacute;ticas</option>
			  <option value="7">Inform&aacute;tica</option>
		  </select></td>
		</tr>
		<tr>
			<td align="right">Turno:</td>
			<td><select name="turno">
			  <option value=""> </option>
			  <option value="1">Mañana</option>
			  <option value="2">Tarde</option>    
		  </SELECT></td>
		</tr>
		<tr>
		  <td align="right">Cantidad de vacante:</td>
		  <td align="left"><input name="numpasante" type="text" size="17" /></td>
	    </tr>
		</table><br>
      <p align="center"><input type="submit" name="enviar" value="Enviar" onClick="validarsolitudpasan(this.form)"/></p>
      <p>Aqui se mostrara cada registro que se produzca cuando el usuario seleccione las vacantes y el turno y elija la opcion aceptar.</p>
      </form> 
  </div>
<div class="sidebar2">
  <h4 align="center">Bienvenido: <?php echo $_SESSION['usuario']?></h4>
  <p align="center"><a href="cerrarsesion.php">Cerrar Sesi&oacute;n</a></p>
</div>
  <div class="footer">
    <p><strong>Colegio Universitario &quot;Francisco de Miranda&quot;</strong><br />
Dirección: Av. Urdaneta. Esquina de Mijares. Parroquia Altagracia. Teléfonos: (58)(0212) 8620422 / 8646880<br />
 Sistema de Gesti&oacute;n Administrativa de Pasant&iacute;a 2011 - Caracas, Venezuela.</p>
    <!-- end .footer --></div>
  <!-- end .container --></div> 
</body>
</html>