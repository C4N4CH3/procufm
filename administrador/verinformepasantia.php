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
<title>Informes solicitados</title>
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
  <blockquote>
    <h2>Informes generados</h2>
  </blockquote>
<p align="justify"> Listado de cantidad de informes generados por los estudiantes:	</p>
<p>
<?php
$id_ins = $_GET["ins"];

include "../conexionbd.php";
$sql = "SELECT *,inf.id_informes as id_inf 
            FROM informes as inf
            INNER JOIN control_informes as ct
            ON inf.id_informes=ct.id_informes
            INNER JOIN inscripcion as ins
            ON ct.id_inscrito=ins.id_inscrito
            WHERE ins.id_inscrito=".$id_ins;
$res = mysql_query($sql) or die(mysql_error());
if(mysql_num_rows($res)>0){
    $i=1;
    ?>
    <center>
    <?php
    while ($f = mysql_fetch_array($res)) {
        $id_informes = $f["id_informes"];     
     ?>
    <table border="1">
        <thead>
            <th colspan="2">INFORME #<?php echo $i?>                
                <a href="editarinformepasantia.php?id=<?php echo $id_informes?>&&id_ins=<?php echo $id_ins?>" 
                   class="iredit">Modificar</a>
                <a href="#eliminar" class="iredit" onclick="eliminar(<?php echo $id_informes;?>,<?php echo $id_ins?>)">Eliminar</a>
            </th>
        </thead>
        <tbody>
    <?php   
        $i++;        
        $fecha_i = $f["fecha_informe"];
        
        $trozo = explode("-", $fecha_i);
        $fecha_informe = $trozo[2]."-".$trozo[1]."-".$trozo[0];
        
        
        $unidad_pasantias = $f["unidad_pasantias"];
        $informe_actividades = $f["informe_actividades"];
        $limitaciones_pasantia = $f["limitaciones_pasantia"];
        $entrevista_academico = $f["entrevista_academico"];
        $entrevista_empresarial = $f["entrevista_empresarial"];
        $entrevista_tutor_academico = $f["entrevista_tutor_academico"];
        $entrevista_tutor_empresarial = $f["entrevista_tutor_empresarial"];
        
        $estado_informe = $f["estado_informe"];
        $calificacion_informe = $f["calificacion_informe"];
        $jefe_responsable = $f["jefe_responsable"];
        $cargo_jefe = $f["cargo_jefe"];
        $telefono_jefe = $f["telefono_jefe"];
        $email_jefe = $f["email_jefe"];
        $area_pasantia = $f["area_pasantia"];
        $horario = $f["horario"];
        $tutor_empresarial = $f["tutor_empresarial"];
        $cargo_tutor = $f["cargo_tutor"];
        $email = $f["email"];
        $telefono_tutor = $f["telefono_tutor"];
        
        echo "<tr>";
        echo "<td>Fecha:</td>";
        echo "<td>".$fecha_informe."</td>";
        echo "</tr>";
        echo "<tr>";        
        echo "<td>Unidad Pasantía:</td>";
        echo "<td>".$unidad_pasantias."</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>Actividades:</td>";
        echo "<td>".$informe_actividades."</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>Limitaciones:</td>";
        echo "<td>".$limitaciones_pasantia."</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>Entrevista Tutor Académico:</td>";
        echo "<td>".$entrevista_tutor_academico."</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>Problemas Tutor Académico:</td>";
        echo "<td>".$entrevista_academico."</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>Entrevista Tutor Empresarial:</td>";
        echo "<td>".$entrevista_tutor_empresarial."</td>";
        echo "</tr>";        
        echo "<tr>";
        echo "<td>Problemas Tutor Empresarial:</td>";
        echo "<td>".$entrevista_empresarial."</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>Estatus:</td>";
        echo "<td>".$estado_informe."</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>Calificación:</td>";
        echo "<td>".$calificacion_informe."</td>";
        echo "</tr>";
       
    ?>
        </tbody>
    </table><br>
    <?php
    }//fin de while ($f = mysql_fetch_array($res))
    ?>
    <table border="1">
        <thead>
            <th colspan="2">Datos Pasante</th>
        </thead>
        <tbody>
    <?php              
        echo "<tr>";
        echo "<td>Área de pasantía:</td>";
        echo "<td>".$area_pasantia."</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>Horario:</td>";
        echo "<td>".$horario."</td>";
        echo "</tr>";
    ?>
        </tbody>
    </table><br>
    <table border="1">
        <thead>
            <th colspan="2">Tutor Empresarial</th>
        </thead>
        <tbody>
    <?php    
        echo "<tr>";
        echo "<td>Nombre y Apellido:</td>";
        echo "<td>".$tutor_empresarial."</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>Cargo:</td>";
        echo "<td>".$cargo_tutor."</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>Correo:</td>";
        echo "<td>".$email."</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>Teléfono:</td>";
        echo "<td>".$telefono_tutor."</td>";
        echo "</tr>";
    ?>
        </tbody>
    </table><br>
    <table border="1">
        <thead>
            <th colspan="2">Jefe Responsable</th>
        </thead>
        <tbody>
    <?php   
        echo "<tr>";
        echo "<td>Nombre y Apellido:</td>";
        echo "<td>".$jefe_responsable."</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>Cargo:</td>";
        echo "<td>".$cargo_jefe."</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>Teléfono:</td>";
        echo "<td>".$telefono_jefe."</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>Correo:</td>";
        echo "<td>".$email_jefe."</td>";
        echo "</tr>";
    ?>
    </table>
    </center>    
    <?php
}else{
    echo '<p>No hay datos para mostar</p>';
}
?>
<?php
mysql_close($link);
?>
</p>
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
<script language="javascript" type="text/javascript" src="../js/func_inf.js"></script>
</body>
</html>