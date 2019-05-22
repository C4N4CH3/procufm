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
<title>Sesion Empleado</title>
<link href="../css/bootstrap/3.3.0/bootstrap.min.css" rel="stylesheet">
<link href="../css/material/roboto.min.css" rel="stylesheet">
<link href="../css/material/material.min.css" rel="stylesheet">
<link href="../css/material/ripples.min.css" rel="stylesheet">
<link href="../css/material/materialmodif.css" rel="stylesheet">
</head>

<body>
<form action="" method="post">
<?php include_once '../navbar.php';?>
<!----------------------Incluye el menú en la página----------------------------------->

 <?php //include ("menus/menu_admin.php");?>
 <div class="sidebar1"> 
    <?php include_once("menu_admin.php")?>
  <!-- end .sidebar1 -->
 </div>
 
 <div class="well col-md-9 col-lg-9 col-sm-9 col-xs-9" style="margin-left:20px">
  <div class="content" align="center">
    <h1 align="center">Bienvenido: <?php echo $_SESSION['usuario']?></h1>
    <p> Bienvenido al Proceso de Pasantia. Debes ir al panel izquierdo para Navegación</p><br>
   
  </div>
    </div>
 <?php include_once '../footer.php';?>
</form> 
<script type="text/javascript" src="../js/1.11.1/jquery.min.js"></script>
    <script src="../js/bootstrap/3.3.0/bootstrap.min.js"></script>
    <script src="../js/material/material.min.js"></script>
    <script src="../js/material/ripples.min.js"></script>
    <script>
      $.material.init();
    </script>
<script language="javascript" src="../funciones.js"></script>
</body>
</html>
