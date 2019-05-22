<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Recuperación de Datos</title>
<link href="css/bootstrap/3.3.0/bootstrap.min.css" rel="stylesheet">
<link href="css/material/roboto.min.css" rel="stylesheet">
<link href="css/material/material.min.css" rel="stylesheet">
<link href="css/material/ripples.min.css" rel="stylesheet">
<link href="css/material/materialmodif.css" rel="stylesheet">
<link href="css/jquery-ui.css" rel="stylesheet" type="text/css">
</head>

<body>
  <!--<div class="header">
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
  </div>-->
  <?php include 'navbar.php' ?>
  <div class="content">
      <div align="center">
        <form action="recuperacionpregunta.php" method="post" name="form1" id="form1" autocomplete="off">
        	<fieldset>
        <legend>Recuperacion de Cuenta</legend>   
        <div class="form-group-material-blue-900">     
            <input class="form-control floating-label" placeholder="Ingrese su correo" type="text" name="email" id="email">
         </div>
          <br>
         <div class="form-group-material-blue-900">  
            <input class="form-control floating-label" placeholder="Ingrese su cedula" type="text" name="ci" id="ci">
            </div>
            <br>
            <input name="recuperar" type="submit" value="Recuperar">
            </p>
            </fieldset>           
        </form>
      </div>
      <div id="form_pregunta"></div>      
      
</div>
<?php include 'footer.php' ?>
 <script type="text/javascript" src="js/1.11.1/jquery.min.js"></script>
    <script src="js/bootstrap/3.3.0/bootstrap.min.js"></script>
    <script src="js/material/material.min.js"></script>
    <script src="js/material/ripples.min.js"></script>
    <script>
      $.material.init();
    </script>
<script language="javascript" type="text/javascript" src="js/jquery-ui-1.10.3.custom.min.js"></script>
<script language="javascript" type="text/javascript" src="js/jquery.validate.js"></script>
<script language="javascript" src="js/func_rec_datos.js"></script>
</body>
</html>