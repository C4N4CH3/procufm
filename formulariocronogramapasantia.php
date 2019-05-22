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
<title>Cronograma</title>
<script language='javascript' src="popcalendar.js"></script>
<link href="efecto.css" rel="stylesheet" type="text/css">
<script language="javascript" src="validarsesiones.js"></script>
</head>

<body>
<form action="" method="post" name="form1">
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
    <p> Principal</p>
    <ul class="nav">
      <li><a href="sesiondepartamento.php"><img src="imagenes/blockcontentbullets.JPG" width="6" height="13" /><img src="imagenes/spacer.JPG" width="5" height="1" />Inicio</a></li>
      
   
    </ul>
    <p>Gesti&oacute;n</p>
    <ul class="nav">
      <li><a href="cronogramapasantia.php"><img src="imagenes/blockcontentbullets.JPG" width="6" height="13" /><img src="imagenes/spacer.JPG" width="5" height="1" />Cronograma</a></li>
      <li><a href="formulariocentropasantiasss.php"><img src="imagenes/blockcontentbullets.JPG" width="6" height="13" /><img src="imagenes/spacer.JPG" width="5" height="1" />Centro pasant&iacute;a</a></li>
      <li><a href="documentodepartamento.php"><img src="imagenes/blockcontentbullets.JPG" width="6" height="13" /><img src="imagenes/spacer.JPG" width="5" height="1" />Documento</a></li>       
    <li><a href="#"><img src="imagenes/blockcontentbullets.JPG" width="6" height="13" /><img src="imagenes/spacer.JPG" width="5" height="1" />Tutores Acad.</a></li>    
    <li><a href="#"><img src="imagenes/blockcontentbullets.JPG" width="6" height="13" /><img src="imagenes/spacer.JPG" width="5" height="1" />Informes</a></li> 
    <li><a href="#"><img src="imagenes/blockcontentbullets.JPG" width="6" height="13" /><img src="imagenes/spacer.JPG" width="5" height="1" />Registros</a></li>   
    </ul>
    <p>Estad&iacute;sticas</p>
    <ul class="nav">
      <li><a href="#"><img src="imagenes/blockcontentbullets.JPG" width="6" height="13" /><img src="imagenes/spacer.JPG" width="5" height="1" />Preinscritos</a></li>
      <li><a href="#"><img src="imagenes/blockcontentbullets.JPG" width="6" height="13" /><img src="imagenes/spacer.JPG" width="5" height="1" />Inscritos</a></li>
      <li><a href="#"><img src="imagenes/blockcontentbullets.JPG" width="6" height="13" /><img src="imagenes/spacer.JPG" width="5" height="1" />Aprobados</a></li>
      <li><a href="#"><img src="imagenes/blockcontentbullets.JPG" width="6" height="13" /><img src="imagenes/spacer.JPG" width="5" height="1" />Reprobados</a></li>
    </ul>
    <p>B&uacute;squeda</p>
    <ul class="nav">
      <li><a href="#"><img src="imagenes/blockcontentbullets.JPG" width="6" height="13" /><img src="imagenes/spacer.JPG" width="5" height="1" />Alumnos</a></li>
    </ul>
  <!-- end .sidebar1 --></div>
  <div class="content">
    <h2 align="center">Cronograma</h2>
    <h3 align="center">Ingrese nuevo lapso</h3>
    <p>Recuerde que el formato es: yyyy-mm-dd (año-mes-dia)<br>ejemplo: 2011-04-21</p>
<table width="100%" align="center">
  <tr>
      <td align="center" colspan="3"><strong>C&oacute;digo del Nuevo Lapso</strong></td>      
    </tr>
    <tr>
      <td align="right">Codigo de Lapso:</td>
      <td><input name="cod_lapso" type="text" value="<?php if(isset($_POST['cod_lapso'])) echo $_POST['cod_lapso']?>" size="10" maxlength="10"/></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td align="right" colspan="3">&nbsp;</td>
      </tr>
  <tr>
      <td align="center" colspan="3"><strong>Fecha de Charla Inducci&oacute;n</strong></td>
      </tr>
    <tr>
      <td width="31%" align="right">Diurno:</td>
      <td width="34%" align="left"><input name="reunion_diurno" id="dateArrival" type="text" value="<?php if(isset($_POST['reunion_diurno'])) echo $_POST['reunion_diurno']?>" size="10" maxlength="10" onClick="popUpCalendar(this, form1.dateArrival, 'yyyy-mm-dd');"/></td>
      <td width="35%" align="left">&nbsp;</td>
      </tr>
    <tr>
      <td width="31%" align="right">Vespertino:</td>
      <td width="34%" align="left"><input name="reunion_vesper" type="text" value="<?php if(isset($_POST['reunion_vesper'])) echo $_POST['reunion_vesper']?>" size="10" maxlength="10" id="dateArrival1" onClick="popUpCalendar(this, form1.dateArrival1, 'yyyy-mm-dd');"/></td>
      <td width="35%" align="left">&nbsp;</td>
      </tr>
    <tr>
      <td width="31%" align="right">Nocturno:</td>
      <td width="34%" align="left"><input name="reunion_nocturno" type="text" value="<?php if(isset($_POST['reunion_nocturno'])) echo $_POST['reunion_nocturno']?>" size="10" maxlength="10" id="dateArrival2" onClick="popUpCalendar(this, form1.dateArrival2, 'yyyy-mm-dd');"/></td>
      <td width="35%" align="left">&nbsp;</td>
      </tr>
    <tr>
      <td align="center" colspan="3">&nbsp;</td>
      </tr>
    <tr>
      <td align="center" colspan="3"><strong>Fecha Preinscripci&oacute;n</strong></td>
      </tr>
    <tr>
      <td width="31%" align="right">Todos los turnos:</td>
      <td width="34%" align="left"><input name="fecha_preinscripcion" type="text" value="<?php if(isset($_POST['fecha_preinscripcion'])) echo $_POST['fecha_preinscripcion']?>" size="10" maxlength="10" id="dateArrival3" onClick="popUpCalendar(this, form1.dateArrival3, 'yyyy-mm-dd');"/></td>
      <td width="35%" align="left">&nbsp;</td>
      </tr>
    <tr>
      <td align="right" colspan="3">&nbsp;</td>
    </tr>    
    <tr>
      <td align="center" colspan="3"><strong>Fecha de Lapso de Pasant&iacute;a (tiempo completo)</strong></td>
      </tr>
    <tr>
      <td width="31%" align="center"> Inicio:
        <input name="fecha_tci1" type="text" value="<?php if(isset($_POST['fecha_tci1'])) echo $_POST['fecha_tci1']?>" size="10" maxlength="10" id="dateArrival4" onClick="popUpCalendar(this, form1.dateArrival4, 'yyyy-mm-dd');"/></td>
      <td width="34%" align="center">Culminacion:        <input name="fecha_tcc1" type="text" value="<?php if(isset($_POST['fecha_tcc1'])) echo $_POST['fecha_tcc1']?>" size="10" maxlength="10" id="dateArrival5" onClick="popUpCalendar(this, form1.dateArrival5, 'yyyy-mm-dd');"/></td>
      <td width="35%" align="center">Informe:
        <input name="fecha_if1" type="text" value="<?php if(isset($_POST['fecha_if1'])) echo $_POST['fecha_if1']?>" size="10" maxlength="10" id="dateArrival20" onClick="popUpCalendar(this, form1.dateArrival20, 'yyyy-mm-dd');"/></td>
      </tr>
    <tr>
      <td align="center" width="31%"> Inicio:
        <input name="fecha_tci2" type="text" value="<?php if(isset($_POST['fecha_tci2'])) echo $_POST['fecha_tci2']?>" size="10" maxlength="10" id="dateArrival6" onClick="popUpCalendar(this, form1.dateArrival6, 'yyyy-mm-dd');"/></td>
      <td align="center" width="34%">Culminacion:
        <input name="fecha_tcc2" type="text" value="<?php if(isset($_POST['fecha_tcc2'])) echo $_POST['fecha_tcc2']?>" size="10" maxlength="10" id="dateArrival7" onClick="popUpCalendar(this, form1.dateArrival7, 'yyyy-mm-dd');"/></td>
      <td align="center" width="35%">Informe:
        <input name="fecha_if2" type="text" value="<?php if(isset($_POST['fecha_if2'])) echo $_POST['fecha_if2']?>" size="10" maxlength="10" id="dateArrival21" onClick="popUpCalendar(this, form1.dateArrival21, 'yyyy-mm-dd');"/></td>
    </tr>
    <tr>
      <td align="center" width="31%"> Inicio:
        <input name="fecha_tci3" type="text" value="<?php if(isset($_POST['fecha_tci3'])) echo $_POST['fecha_tci3']?>" size="10" maxlength="10" id="dateArrival8" onClick="popUpCalendar(this, form1.dateArrival8, 'yyyy-mm-dd');"/></td>
      <td align="center" width="34%">Culminacion:
        <input name="fecha_tcc3" type="text" value="<?php if(isset($_POST['fecha_tcc3'])) echo $_POST['fecha_tcc3']?>" size="10" maxlength="10" id="dateArrival9" onClick="popUpCalendar(this, form1.dateArrival9, 'yyyy-mm-dd');"/></td>
      <td align="center" width="35%">Informe:
        <input name="fecha_if3" type="text" value="<?php if(isset($_POST['fecha_if3'])) echo $_POST['fecha_if3']?>" size="10" maxlength="10" id="dateArrival22" onClick="popUpCalendar(this, form1.dateArrival22, 'yyyy-mm-dd');"/></td>
    </tr>
    <tr>
      <td align="center" width="31%"> Inicio:
        <input name="fecha_tci4" type="text" value="<?php if(isset($_POST['fecha_tci4'])) echo $_POST['fecha_tci4']?>" size="10" maxlength="10" id="dateArrival10" onClick="popUpCalendar(this, form1.dateArrival10, 'yyyy-mm-dd');"/></td>
      <td align="center" width="34%">Culminacion:
        <input name="fecha_tcc4" type="text" value="<?php if(isset($_POST['fecha_tcc4'])) echo $_POST['fecha_tcc4']?>" size="10" maxlength="10" id="dateArrival11" onClick="popUpCalendar(this, form1.dateArrival11, 'yyyy-mm-dd');"/></td>
      <td align="center" width="35%">Informe:
        <input name="fecha_if4" type="text" value="<?php if(isset($_POST['fecha_if4'])) echo $_POST['fecha_if4']?>" size="10" maxlength="10" id="dateArrival23" onClick="popUpCalendar(this, form1.dateArrival23, 'yyyy-mm-dd');"/></td>
    </tr>
    <tr>
      <td align="right" colspan="3">&nbsp;</td>
    </tr>
    <tr>
      <td align="center" colspan="3"><strong>Fecha de Lapso de Pasant&iacute;a (medio tiempo)</strong></td>
    </tr>
    <tr>
      <td align="center" width="31%"> Inicio:
        <input name="fecha_mti1" type="text" value="<?php if(isset($_POST['fecha_mti1'])) echo $_POST['fecha_mti1']?>" size="10" maxlength="10" id="dateArrival12" onClick="popUpCalendar(this, form1.dateArrival12, 'yyyy-mm-dd');"/></td>
      <td align="center" width="34%">Culminacion:
        <input name="fecha_mtc1" type="text" value="<?php if(isset($_POST['fecha_mtc1'])) echo $_POST['fecha_mtc1']?>" size="10" maxlength="10" id="dateArrival13" onClick="popUpCalendar(this, form1.dateArrival13, 'yyyy-mm-dd');"/></td>
      <td align="center" width="35%">Informe:
        <input name="fecha_mtif" type="text" value="<?php if(isset($_POST['fecha_mtif'])) echo $_POST['fecha_mtif']?>" size="10" maxlength="10" id="dateArrival24" onClick="popUpCalendar(this, form1.dateArrival24, 'yyyy-mm-dd');"/></td>
    </tr>
    <tr>
      <td align="center" colspan="3">&nbsp;</td>
    </tr>
    <tr>
      <td align="center" colspan="3"><strong>Fecha de Lapso de Pasantía (Largas)</strong></td>
    </tr>
    <tr>
      <td align="center" width="31%"> Inicio:
        <input name="fecha_li1" type="text" value="<?php if(isset($_POST['fecha_li1'])) echo $_POST['fecha_li1']?>" size="10" maxlength="10" id="dateArrival14" onClick="popUpCalendar(this, form1.dateArrival14, 'yyyy-mm-dd');"/></td>
      <td align="center" width="34%">Culminacion:
        <input name="fecha_lc1" type="text" value="<?php if(isset($_POST['fecha_lc1'])) echo $_POST['fecha_lc1']?>" size="10" maxlength="10" id="dateArrival15" onClick="popUpCalendar(this, form1.dateArrival15, 'yyyy-mm-dd');"/></td>
      <td align="center" width="35%">Informe:
        <input name="fecha_lif1" type="text" value="<?php if(isset($_POST['fecha_lif1'])) echo $_POST['fecha_lif1']?>" size="10" maxlength="10" id="dateArrival25" onClick="popUpCalendar(this, form1.dateArrival25, 'yyyy-mm-dd');"/></td>
    </tr>
    <tr>
      <td align="center" width="31%"> Inicio:
        <input name="fecha_li2" type="text" value="<?php if(isset($_POST['fecha_li2'])) echo $_POST['fecha_li2']?>" size="10" maxlength="10" id="dateArrival16" onClick="popUpCalendar(this, form1.dateArrival16, 'yyyy-mm-dd');"/></td>
      <td align="center" width="34%">Culminacion:
        <input name="fecha_lc2" type="text" value="<?php if(isset($_POST['fecha_lc2'])) echo $_POST['fecha_lc2']?>" size="10" maxlength="10" id="dateArrival17" onClick="popUpCalendar(this, form1.dateArrival17, 'yyyy-mm-dd');"/></td>
      <td align="center" width="35%">Informe:
        <input name="fecha_lif2" type="text" value="<?php if(isset($_POST['fecha_lif2'])) echo $_POST['fecha_lif2']?>" size="10" maxlength="10" id="dateArrival26" onClick="popUpCalendar(this, form1.dateArrival26, 'yyyy-mm-dd');"/></td>
    </tr>
    <tr>
      <td align="center" width="31%"> Inicio:
        <input name="fecha_li3" type="text" value="<?php if(isset($_POST['fecha_li3'])) echo $_POST['fecha_li3']?>" size="10" maxlength="10" id="dateArrival18" onClick="popUpCalendar(this, form1.dateArrival18, 'yyyy-mm-dd');"/></td>
      <td align="center" width="34%">Culminacion:
        <input name="fecha_lc3" type="text" value="<?php if(isset($_POST['fecha_lc3'])) echo $_POST['fecha_lc3']?>" size="10" maxlength="10" id="dateArrival19" onClick="popUpCalendar(this, form1.dateArrival19, 'yyyy-mm-dd');"/></td>
      <td align="center" width="35%">Informe:
        <input name="fecha_lif3" type="text" value="<?php if(isset($_POST['fecha_lif3'])) echo $_POST['fecha_lif3']?>" size="10" maxlength="10" id="dateArrival27" onClick="popUpCalendar(this, form1.dateArrival27, 'yyyy-mm-dd');"/></td>
    </tr>
    <tr>
      <td align="center" colspan="3">&nbsp;</td>
    </tr>
    <tr>
      <td align="center" width="31%"><input name="limpiar" type="reset" value="Limpiar"/></td>
      <td align="center" width="34%"><input name="enviar" type="submit" value="Guardar" onclick="valcronogram(this.form)"/></td>
      <td align="center" width="35%">&nbsp;</td>
    </tr>
</table>
<p>&nbsp;</p>
</div>
<div class="sidebar2">
  <h4 align="center">Bienvenido: <?php echo $_SESSION['usuario']?></h4>
  <p align="center"><a href="cerrarsesion.php">Cerrar Sesi&oacute;n</a></p>
  <p align="center">
  <?php 
  if (isset($_GET["codexistente"]) && $_GET["codexistente"]=="si"){
	  echo "<font color=red>Codigo de Lapso<br>ya existe</font>";
  }
  ?>
  <!-- end .sidebar2 --></p>
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
