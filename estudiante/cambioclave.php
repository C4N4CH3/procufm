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
    <?php require_once 'menu_al.php';?>
  <!-- end .sidebar1 --></div>
  <div class="well col-md-9 col-lg-9 col-sm-9 col-xs-9" style="margin-left:20px">

        <h2>Cambio de Contraseña</h2>

    
      <div id="resultado"></div>  
      
<center> 
<form action="" method="post" id="form1" name="form1">     
    <input type="hidden" name="usuario" id="usuario" value="<?php echo $_SESSION['usuario'] ?>" />         
    <table width="100%" border="0">    
        <tr>
            <td align="right" width="50%">Contraseña Actual:</td>
            <td><input type="password" name="con_actual" id="con_actual" size="15"></td>
        </tr>
        <tr>
            <td align="right" width="50%">Nueva contraseña:</td>
            <td><input type="password" name="con_nva" id="con_nva" size="15"></td>
        </tr>
        <tr>
            <td align="right" >Confirme Nueva Contraseña:</td>
            <td ><input type="password" name="re_con_nva" id="re_con_nva" size="15"></td>
        </tr>
        <tr>
            <td align="center" colspan="2">
                <input type="submit" name="btn1" value="Actualizar" id="btn1" /></td>
        </tr>
    </table>	
</form> 
</center> 
</div>      
 <?php include_once '../footer.php';?>

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
