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
</head>

<body>
<?php include_once 'navbar.php';?>
<div class="well col-md-2">
   <p class="submenu" align="center">Principal</p>
    <ul class="nav nav-pills nav-stacked">
      <li>
      <a class="btn btn-flat btn-info" href="index.php" style="margin-top:5px; margin-bottom:5px">Inicio</a>
      </li>   
    </ul>
    </div>
 <div class="well col-md-9 col-lg-9 col-sm-9 col-xs-9" style="margin-left:20px">

      <h2>Ingrese la Pregunta Secreta</h2>

      <div id="resultado_pregunta"></div>
      <?php
        if (isset($_POST["email"]) && isset($_POST["ci"])) {
            include_once 'conexionbd.php';
            $email = $_POST['email'];
            $ci = $_POST['ci'];

            $sql= "SELECT *,us.id_usuario as id_usu, ps.descripcion as pregunta_secreta  
                            FROM (alumno AS al 
                            INNER JOIN usuario AS us 
                            ON al.id_usuario=us.id_usuario)
                            LEFT JOIN preguntas_secretas AS ps
                            ON ps.id=us.id_pregunta_secreta
                            WHERE email='".$email."' AND cedula_alumno='".$ci."'";
            
            $res = mysql_query($sql) or die (mysql_error());
            if ($fila = mysql_fetch_array($res)){
                $id_usu=$fila["id_usu"];
                ?>                
                <div align="center">
                    <form action="" method="post" name="form1" id="form1">        
                        <input type="hidden" name="id_usuario" id="id_usuario" value="<?php echo $id_usu; ?>">
                        <p>Pregunta:<?php echo $fila["pregunta_secreta"]; ?><br>
                            Respuesta:<input type="text" name="respuesta" id="respuesta"><br>
                          <input name="recuperar" type="submit" value="Recuperar">
                        </p>           
                    </form>
                </div>
                
                <?php        
            }
        }
      ?>
</div>
 <?php include_once 'footer.php';?>

<script type="text/javascript" src="js/1.11.1/jquery.min.js"></script>
<script src="js/bootstrap/3.3.0/bootstrap.min.js"></script>
<script src="js/material/material.min.js"></script>
<script src="js/material/ripples.min.js"></script>
<script>
      $.material.init();
</script>
<script language="javascript" type="text/javascript" src="js/jquery-ui-1.10.3.custom.min.js"></script>
<script language="javascript" type="text/javascript" src="js/jquery.validate.js"></script>
<script language="javascript" src="js/func_rec_preg.js"></script> 
</body>
</html>