<?php session_start();$_SESSION['origen'] = 0;
  /* if (!isset($_SESSION['intentos']))
   {//die('Petici?n no v?lida');
     $_SESSION['intentos'] = 0;
   }*/?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Principal</title>
<!--<link href="efecto.css" rel="stylesheet" type="text/css">
<link href="fancybox/jquery.fancybox-1.3.4.css" rel="stylesheet" type="text/css"/>-->
<link href="css/bootstrap/3.3.0/bootstrap.min.css" rel="stylesheet">
<link href="css/material/roboto.min.css" rel="stylesheet">
<link href="css/material/material.min.css" rel="stylesheet">
<link href="css/material/ripples.min.css" rel="stylesheet">
<link href="css/material/materialmodif.css" rel="stylesheet">
<link href="css/jquery-ui.css" rel="stylesheet" type="text/css">
<!--<script type="text/javascript" src="fancybox/jquery.fancybox-1.3.4.js"></script>-->
</head>

<body>
<!--<form action="" method="post">
<div class="container">
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
  </div>
  <div class="sidebar1"> 
    <p>Principal 
    </p>
    <ul class="nav">
      <li><a href="index.php">
              <img src="imagenes/blockcontentbullets.JPG" width="6" height="13" />
              <img src="imagenes/spacer.JPG" width="5" height="1" />Inicio</a>
      </li>
    </ul>
  Registro 
      <ul class="nav">
      <li><a href="formularioestudiante.php"><img src="imagenes/blockcontentbullets.JPG" width="6" height="13" /><img src="imagenes/spacer.JPG" width="5" height="1" />Alumno</a></li>      
      <!--<li><a href="formularioempresa.php"><img src="imagenes/blockcontentbullets.JPG" width="6" height="13" /><img src="imagenes/spacer.JPG" width="5" height="1" />Empresa</a></li>
      <li><a href="formulariotutoracademico.php"><img src="imagenes/blockcontentbullets.JPG" width="6" height="13" /><img src="imagenes/spacer.JPG" width="5" height="1" />Tutor acad&eacute;mico</a></li>
    </ul> 
  <!-- end .sidebar1 </div>
<div class="sidebar2">

  
 
        <input name="enviar" onClick="validar(this.form)"><br><br>
	<a href="recuperaciondatos.php">Olvido la contrase&ntilde;a</a>
		</td>
  </p>
        
    <!-- end .sidebar2 </div>
  <div class="footer">
    
    <p><strong>Colegio Universitario &quot;Francisco de Miranda&quot;</strong><br />
Direcci?n: Av. Urdaneta. Esquina de Mijares. Parroquia Altagracia. Tel?fonos: (58)(0212) 8620422 / 8646880<br />
 Sistema de Gesti&oacute;n Administrativa de Pasant&iacute;a 2015 - Caracas, Venezuela.</p>
    <!-- end .footer </div>
  <!-- end .container </div> 
</form> 
<!---------------------------------------------- MODIFICADO EL DIA 09 DE SEP DEL 2015 -------------------------------->
<?php include_once 'navbar.php';?>
<!--Fin de la barra de navegacion-->

<div align="center" class="container-fluid">
<div class="col-md-4 col-md-offset-4 col-lg-4 col-lg-offset-4 col-sm-7 col-sm-offset-2 col-xs-9 col-xs-offset-2">
Bienvenido(a) al Sistema de Gesti&oacute;n Administrativa del Departamento de Pasant&iacute;as
<div class="panel panel-blue-900 shadow-z-2">
    <div class="panel-heading">
        <h3 class="panel-title">Ingrese sus Datos</h3>
    </div>
    <div class="panel-body">
        <form action="control.php" method="POST" autocomplete="off" id="formprinci" name="formprinci"> 
<img class="shadow-z-2" src="images/semi_user.png" style="border-radius:50%; width:96px;">
<br>
<br>
<?php 
$intentos = 0 ;   
//Recibe las variables de la pag controlusuario.php y cerrarsesion.php
    	if (isset($_GET["errorusuario"]) && $_GET["errorusuario"]=="si"){
                        $_SESSION['intentos']=$_SESSION['intentos']+1;
	  		//echo "<font color=red>Usuario incorrecto</font>";
			echo "<font color=red>Datos incorrectos</font>";
	  	}
	  	if (isset($_GET["errorclave"]) && $_GET["errorclave"]=="si"){
                        $_SESSION['intentos']=$_SESSION['intentos']+1;
			//echo "<font color=red>Clave incorrecta</font>";
			echo "<font color=red>Datos incorrectos</font>";
		}
		if (isset($_GET["salirsesion"]) && $_GET["salirsesion"]=="si"){
			echo "<font color=orange>Ha salido de Sesi&oacute;n</font>";
		}
		if (isset($_GET["sesionabierta"]) && $_GET["sesionabierta"]=="si"){
			echo "<font color=red>Tu sesi&oacute;n ya esta abierta</font>";
		}
		
		
		  if (isset($_GET["bloqueado"]) && $_GET["bloqueado"]=="si"){
                        
			echo "<font color=red>Usuario Bloqueado, Contacte al administrador</font>";
	  	}
               /* if ($_SESSION['intentos'] > 3 )
                {
                  //$_SESSION['intentos'] = 0;
                  echo "</br><font color=red>, demasiados intentos, comuniquese con el administrador del sistema</font>"; 
				  die();
                  //die('Demasiados intentos, comuniquese con el administrador del sistema');
                }*/
   ?>
<div class="form-group-material-blue-900">
    <input class="form-control floating-label" name="nombreusuario" maxlength="20" id="nombreusuario" type="text" placeholder="Ingrese su usuario">
</div>
<br>
<div class="form-group-material-blue-900">
    <input class="form-control floating-label" name="clave" maxlength="20" maxlength="10" id="clave" type="password" placeholder="Ingrese su contrase&ntilde;a">
<?php
	if (isset($_GET["errorusuario"])){
		if ($_GET["errorusuario"]=="si"){ ?>
				<span style="color:red"><b>El usuario o la contrase&ntilde;a que ingreso son incorrectos</b></span> 
<?php 			}}
			else { ?>
				
<?php } ?>
</div>
<br>

	<input class="btn btn-material-blue-900" name="enviar" onClick="validar(this.form)" type="submit" value="INGRESAR">
</form> 		
<br>
		<button type="button" class="btn btn-flat btn-info btn-sm" onClick="document.location = 'formularioestudiante.php'">Reg&iacute;strarte</button>
<br>
		<!--BOTON PARA ACTIVAR EL MODAL FRAME (VENTANA EMERGENTE)-->
		<button type="button" class="btn btn-flat btn-info btn-sm" data-toggle="modal" data-target="#myModal">
  &iquest;Olvidaste tu contrase&ntilde;a?
</button>
<!--FIN DEL BOTON-->
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Recuperacion de Cuenta</h4>
      </div>
      <div class="modal-body">
      
        <div class="content">
        <div class="row">
        <div class="col-md-10 col-md-offset-1">
      <div align="center">
        <form action="recuperacionpregunta.php" method="post" name="form1" id="form1" autocomplete="off">
        <div class="form-group-material-blue-900">     
            <input class="form-control floating-label" placeholder="Ingrese su correo" type="text" name="email" id="email">
         </div>
          <br>
         <div class="form-group-material-blue-900">  
            <input class="form-control floating-label" placeholder="Ingrese su cedula" type="text" name="ci" id="ci">
            </div>
            <br>
              <!--  <input name="recuperar" type="submit" value="Recuperar">
        -->
        
      </div>
      <div id="form_pregunta"></div>  
      </div>    
      </div>
</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-flat btn-info" data-dismiss="modal">Cerrar</button>
        <button name="recuperar" type="submit" class="btn btn-material-blue-900">Recuperar</button>
        <!--
        <button name="recuperar" type="button" class="btn btn-material-blue-900">Aceptar</button>-->
      </div>
      </form>
    </div>
  </div>
</div>
<!--FIN DE LA VENTANA EMERGENTE-->
<!--		<a href="recuperaciondatos.php">&iquest;Olvidaste tu contrase&ntilde;a?</a> -->



    </div>
</div>
</div>
</div>
<?php include_once 'footer.php';?>
<script type="text/javascript" src="js/1.11.1/jquery.min.js"></script>
    <script src="js/bootstrap/3.3.0/bootstrap.min.js"></script>
    <script src="js/material/material.min.js"></script>
    <script src="js/material/ripples.min.js"></script>
    <script>
      $.material.init();
    </script>
<script language="javascript" src="funciones.js"></script>
<script language="javascript" type="text/javascript" src="js/jquery-ui-1.10.3.custom.min.js"></script>
<script language="javascript" type="text/javascript" src="js/jquery.validate.js"></script>
<script language="javascript" src="js/func_rec_datos.js"></script>
</body>
</html>