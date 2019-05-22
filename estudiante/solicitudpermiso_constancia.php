<?php
include ("../sesiones.php");
if($_SESSION['nivel']!=$_SESSION['id']){
session_destroy();
echo "FALLA GRAVE AL SISTEMA, PERDISTE LA SESION, PARA REGRESAR AL INICIO REINICIA EL NAVEGADOR";exit();
}


$ci = $_SESSION['cedula'];
/*include "../conexionbd.php";
$consulta = "select * from alumno where cedula_alumno='$ci'";
$resultado = mysql_query($consulta) or die (mysql_error());
if ($fila = mysql_fetch_array($resultado)){
    $mencion = $fila["id_mencion"];
	$nombre = $fila["nombre"];
	$apellido = $fila["apellido"];
	$carnet = $fila["carnet"];
	$carrera = $fila["id_carrera"];
}

$consulta2 = "select * from carreras where id_carrera=$carrera";
//echo $consulta2; 
$nombre_carrera = mysql_query($consulta2) or die (mysql_error());

if ($fila = mysql_fetch_array($nombre_carrera)){
    $nombre_car = $fila["nombre_carrera"];
}

$consulta3 = "select * from menciones where id_mencion=$mencion";
$nombre_mencion = mysql_query($consulta3) or die (mysql_error());
 
if ($fila = mysql_fetch_array($nombre_mencion)){
    $nombre_men = $fila["nombre_mencion"];
}*/

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Solicitud de Permiso</title>
<link href="../css/bootstrap/3.3.0/bootstrap.min.css" rel="stylesheet">
<link href="../css/material/roboto.min.css" rel="stylesheet">
<link href="../css/material/material.min.css" rel="stylesheet">
<link href="../css/material/ripples.min.css" rel="stylesheet">
<link href="../css/material/materialmodif.css" rel="stylesheet">
</head>
<body>
<?php include_once '../navbar.php';?>
  <div class="sidebar1"> 
    <?php require_once 'menu_al.php';?>  
  <!-- end .sidebar1 --></div>
 <div class="well col-md-9 col-lg-9 col-sm-9 col-xs-9" style="margin-left:20px">
      
      Seleccione el estudiante:
            <?php
        require_once '../conexionbd.php';        
        
        $sql = "SELECT *,al.cedula_alumno as ced_al,al.id_alumnos as id_al,
                        al.nombre as nombreal, al.apellido as apellidoal,
                        pre.id_preinscripcion as id_pre,
                        tu.id_tutor as idtututor,
                        tu.id_usuario as idusututor,
                        tu.id_carrera as idcarrertutor,
                        tu.id_mencion as idmentutor,
                        tu.nombre as nombretutor,
                        tu.apellido as apellidotutor,
                        tu.cedula as cedulatutor,
                        tu.email as emailtutor,
                        tu.area_trabajo as areatutor,
                        tu.telefono as telefonotutor,
                        tu.cantidad_asignacion_alum as cantalumtutor,
                        tu.habilitado as habtutor, 
                        ins.*
                FROM ((alumno AS al 
                INNER JOIN usuario AS us 
                    ON al.id_usuario=us.id_usuario)
                LEFT JOIN preinscripcion AS pre
                    ON al.id_alumnos=pre.id_alumno)
                LEFT JOIN tutor_academico as tu
                    ON pre.id_tutor=tu.id_tutor
                LEFT JOIN inscripcion AS ins
                	ON ins.id_preinscripcion=pre.id_preinscripcion
                        WHERE id_estatus=2 AND al.cedula_alumno=".$ci;
       
        $cs = mysql_query($sql) or die (mysql_error());
        //$cs = mysql_query($sql, $cn);
        echo"<div id='todosreg'><center>
            <br>REGISTROS<br>  
        <form action='' method='post' name='form1'>
        <table border='1' width='100%' id='mi_tabla'>
        <thead>
        <tr>
            <th colspan='8' align='right'><input type='text' id='filtrar' /></th>
        </tr>
        <tr>
        <th>Nombre y Apellido</th>
        <th>Cedula</th>
        <th>Tutor</th>
        <th>Permiso</th>
        <th>Constancia</th>
        </tr>
        </thead>";
        echo "<tbody>";
        while ($resul = mysql_fetch_array($cs)) {
            $id_al = $resul["id_al"]; 
            $id_pre = $resul["id_pre"];
            $cedula=$resul["ced_al"];
            
            
            $ids_permisos=array();
            $con ="SELECT * FROM documento WHERE id_preinscripcion=$id_pre AND id_tipo_documento=2";
            $res =mysql_query($con) or die (mysql_error());
            while ($f = mysql_fetch_array($res)){
                $ids_permisos[] = $f["id_documento"]; 
            }
            
            
            $ids_constancia=array();
            $con ="SELECT * FROM documento WHERE id_preinscripcion=$id_pre AND id_tipo_documento=3";
            $res =mysql_query($con) or die (mysql_error());
            while ($f = mysql_fetch_array($res)){
                $ids_constancia[] = $f["id_documento"]; 
            }
            
            
            
            echo "<tr>";
            echo "<td>".$resul["nombreal"].' '.$resul["apellidoal"]."</td>";
            echo "<td align='center'>".number_format($cedula, 0, '', '.')."</td>";
            if($resul["nombretutor"]){
                echo "<td>".$resul["nombretutor"].' '.$resul["apellidotutor"]."</td>";
            }else{
                echo "<td>-</td>";
            }
            $ides=$resul["id_estatus"];            
            
            
            if(count($ids_permisos)>5){
                echo "<td>Ya generó más de 5</td>";
            }elseif($ides==2) {
                echo "<td><a href='#solicitud_permiso' onclick='permiso(".$id_pre.")' "
                        . "class='iredit'>Permiso</a>(".count($ids_permisos).")</td>";
            }else{
                echo "<td>-</td>";
            }            
            
            
            if(count($ids_constancia)>5){
                 echo "<td>Ya generó más de 5</td>";
            }elseif($ides==2){
                echo "<td><a href='#constancia_pasantia' onclick='constancia(".$id_pre.")' "
                        . "class='iredit'>Constancia</a>(".count($ids_constancia).")</td>";
            }else{
                echo "<td>-</td>";
            }           
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>
            </form>
        </center></div>";        
    mysql_close($link);
            ?> 
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
<script language="javascript" type="text/javascript" src="../js/func_doc.js"></script>
</body>
</html>