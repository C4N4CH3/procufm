<?php
include ("../sesiones.php");
if($_SESSION['nivel']!=$_SESSION['id']){
session_destroy();
echo "FALLA GRAVE AL SISTEMA, PERDISTE LA SESION, PARA REGRESAR AL INICIO REINICIA EL NAVEGADOR";exit();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Cambio de contraseña</title>

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
    <?php include_once("menu_admin.php")?>
  <!-- end .sidebar1 -->
 </div>
 <div class="well col-md-9 col-lg-9 col-sm-9 col-xs-9" style="margin-left:20px">
  <div class="content">
  
        <h2 align="center">Cambio de Contraseña</h2>
     
    
        
      
<div class="col-md-9 col-md-offset-2">
<div id="resultado"></div>
<form action="" method="post" id="form1" name="form1">     
    <input type="hidden" name="usuario" id="usuario" value="<?php echo $_SESSION['usuario'] ?>" />         

            <div class="form-group-material-blue-900">
    	<input class="form-control floating-label" maxlength="20" type="password" name="con_actual" id="con_actual" required size="15" placeholder="Ingrese su contraseña actual">
		<br>
        <input class="form-control floating-label" maxlength="20" type="password" name="con_nva" id="con_nva" required size="15" placeholder="Ingrese su nueva contraseña">
        <br>
        <input class="form-control floating-label" maxlength="20" type="password" name="re_con_nva" id="re_con_nva" required size="15" placeholder="Confirme Nueva Contraseña">
        </div>
		<br>	<div align="center">
                <input class="btn btn-material-blue-900" type="submit" name="btn1" value="Actualizar" id="btn1" />
				</div>
        <br>
</form> 
</div> 
</div>      
</div>
  <?php include_once '../footer.php';?>
  <!-- end .container --></div> 
 <script type="text/javascript" src="../js/1.11.1/jquery.min.js"></script>
    <script src="../js/bootstrap/3.3.0/bootstrap.min.js"></script>
    <script src="../js/material/material.min.js"></script>
    <script src="../js/material/ripples.min.js"></script>
    <script>
      $.material.init();
    </script> 
<script language="javascript" type="text/javascript" src="../js/jquery-ui-1.10.3.custom.min.js"></script>
<script language="javascript" type="text/javascript" src="../js/jquery.validate.js"></script>
<script language="javascript" type="text/javascript" src="../js/func_clav.js"></script>
</body>
</html>
