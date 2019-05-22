<?php
include_once '../sesiones.php';
if($_SESSION['nivel']!=$_SESSION['id']){
session_destroy();
echo "FALLA GRAVE AL SISTEMA, PERDISTE LA SESION, PARA REGRESAR AL INICIO REINICIA EL NAVEGADOR";exit();
}
?>    
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title> Alumnos Inscritos </title>
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
  <!-- end .sidebar1 --></div>
 <div class="well col-md-9 col-lg-9 col-sm-9 col-xs-9" style="margin-left:20px">

    <h2 align="center">Repotes Aprobados</h2>

<p align="justify"> Consulta la informaci&oacute;n sobre los alumnos APROBADOS 
    pertenecientes a cualquier Lapso.</p>
<div>      
<?php 
    echo '<div align="center"><input type="hidden" name="id_estatus" id="id_estatus" value="4">';
    echo '<font color="red">*</font>Seleccione el lapso: '; 
    include_once '../includes/incluir_lapso.php';
    echo "<br>Ingrese la carrera: ";
    include_once '../includes/incluir_carreras.php';
    echo "<br>Ingrese la mención: ";
    echo "<select name='mencion' id='mencion' class='mencion'>";
    echo '</select>';
    echo '</div>';
    //include_once '../includes/incluir_menciones.php';    
?>
    <br><div align="center"><input type="button" name="buscar" id="buscar" value="Buscar"></div>
</div><br><br>  
<div id="mostar_tabla"></div>	
<?php mysql_close($link); ?>
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
<script language="javascript" type="text/javascript" src="../js/reporte.js"></script>
</body>
</html>