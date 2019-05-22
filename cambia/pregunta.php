<?php
session_start();
//include_once '../sesiones.php';
//if($_SESSION['nivel']!=$_SESSION['id']){
//session_destroy();
//echo "FALLA GRAVE AL SISTEMA, PERDISTE LA SESION, PARA REGRESAR AL INICIO REINICIA EL NAVEGADOR";exit();
//}
$clave = $_SESSION['clave'];
$id = $_SESSION['id'];

 //var_dump($_SESSION);
 //die();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Principal</title>
<link href="../css/bootstrap/3.3.0/bootstrap.min.css" rel="stylesheet">
<link href="../css/material/roboto.min.css" rel="stylesheet">
<link href="../css/material/material.min.css" rel="stylesheet">
<link href="../css/material/ripples.min.css" rel="stylesheet">
<link href="../css/material/materialmodif.css" rel="stylesheet">
<link href="../css/jquery-ui.css" rel="stylesheet" type="text/css"> 
</head>

<body>
<?php include_once '../navbar.php';?>
  <div class="sidebar1"> 
  <!-- end .sidebar1 --></div>
  <div class="well col-md-9 col-lg-9 col-sm-9 col-xs-9" style="margin-left:20px">
    <h2>Bienvenido al sistema</h2>
    <p align="justify"> 
        Por medida de seguridad debe cambia su <em>CONTRASEÑA</em>
        recuerde que las claves son personales e intransferibles.</p><br>

      
<form name="neoclave" id="neoclave" action="miclave.php" method="post">  
<fieldset>   
<legend>Nueva Clave</legend>
<p><font color="red">*</font> Campo requerido</p>
<table width="100%" border="1">
    <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
    <tr>
         <td align="right">Contraseña:</td>
         <td><input type="password" name="clave" id="clave" onkeypress="return validarTextoNumero(event)"></td>
    </tr>
    <tr>
        <td align="right">Confirmar contraseña:</td>
        <td><input type="password" name="reclave" id="reclave" onkeypress="return validarTextoNumero(event)"></td>
    </tr>
    <tr align="center">
        <td colspan="2"><input type="submit" name="Guardar" value="Guardar" /></td>
    </tr>
</table>
</form>           
                 
<?php //mysql_close($link);?>
  </div>
<?php include_once '../footer.php';?>

<script type="text/javascript" src="../js/1.11.1/jquery.min.js"></script>
<script src="../js/bootstrap/3.3.0/bootstrap.min.js"></script>
<script src="../js/material/material.min.js"></script>
<script src="../js/material/ripples.min.js"></script>
<script>
      $.material.init();
</script>
<script language="javascript" type="text/javascript" src="../js/jquery-ui-1.10.3.custom.js"></script>
<script language="javascript" type="text/javascript" src="../js/jquery.validate.js"></script>
<script language="javascript" type="text/javascript" src="../js/func_pregunta.js"></script>
</body>
</html>
