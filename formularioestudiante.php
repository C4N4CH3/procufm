<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Registro Estudiante</title>
<link href="css/bootstrap/3.3.0/bootstrap.min.css" rel="stylesheet">
<link href="css/material/roboto.min.css" rel="stylesheet">
<link href="css/material/material.min.css" rel="stylesheet">
<link href="css/material/ripples.min.css" rel="stylesheet">
<link href="css/material/materialmodif.css" rel="stylesheet">
<link href="css/jquery-ui.css" rel="stylesheet" type="text/css">
</head>

<body>
<?php include 'navbar.php';?>
<!--Fin de la barra de navegacion-->
<div align="center" class="well col-md-6 col-md-offset-3">
<form class="form-horizontal" name="form1" id="form1" action="registroestudiante.php" method="post" autocomplete="off">
    <fieldset>
        <legend>Cuenta de alumno</legend>
     	<div class="col-md-9">
        <div class="form-group-material-blue-900">
    	<input class="form-control floating-label" name="nombre" id="nombre" onkeypress="return validarTexto(event)" maxlength="20"  type="text" placeholder="Ingrese su primer nombre" style="text-transform:uppercase">
		</div>
        <br>
        <div class="form-group-material-blue-900">
    	<input class="form-control floating-label" maxlength="20" name="apellido" id="apellido" onkeypress="return validarTexto(event)" type="text" placeholder="Ingrese su primer apellido" style="text-transform:uppercase">
		</div>
        <br>
        <div class="form-group-material-blue-900">
    	<input class="form-control floating-label" name="cedula" id="cedula" onkeypress="return validarNumero(event)" maxlength="8" type="text" placeholder="Ingrese su cedula de identidad">
		</div>
        <br>
        </div>
        <div>
        <div class="col-md-9">
        <div class="form-group-material-blue-900">
    	<input class="form-control floating-label" name="nombreusuario" id="nombreusuario" onkeypress="return validarTextoNumero(event)" maxlength="8" type="text" placeholder="Ingrese su nombre de usuario"> 
		</div>
        </div>
        <div class="col-md-3">
        <span id="info"></span>
        </div>
        </div>
        <div class="col-md-9">
        <br>
        <div class="form-group-material-blue-900">
    	<input class="form-control floating-label" name="email" id="email" type="text" placeholder="Ingrese su correo electronico" style="text-transform:uppercase">
		</div>
        <br>
        <div class="form-group-material-blue-900">
    	<input class="form-control floating-label" type="password" name="clave" id="clave" onkeypress="return validarTextoNumero(event)" placeholder="Ingrese su contraseña">
		</div>
        <br>
        <div class="form-group-material-blue-900">
    	<input class="form-control floating-label" type="password" name="reclave" id="reclave" onkeypress="return validarTextoNumero(event)" placeholder="confirme su contraseña">
		</div>
        </div>
 <div class="col-md-12">   
 <a href="index.php" class="btn btn-flat btn-info">Volver</a>  
<input class="btn btn-material-blue-900" name="btn1" type="submit" value="ACEPTAR">
  </div>	
    </fieldset>
</form>

</div>
<?php include 'footer.php';?>

<script type="text/javascript" src="js/1.11.1/jquery.min.js"></script>
    <script src="js/bootstrap/3.3.0/bootstrap.min.js"></script>
    <script src="js/material/material.min.js"></script>
    <script src="js/material/ripples.min.js"></script>
    <script>
      $.material.init();
    </script>
<script language="javascript" type="text/javascript" src="js/jquery-ui-1.10.3.custom.min.js"></script>
<script language="javascript" type="text/javascript" src="js/jquery.validate.js"></script>
<script language="javascript" type="text/javascript" src="js/func_al.js"></script> 
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
</body>
</html>