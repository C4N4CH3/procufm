<?php
include ("../sesiones.php");
if($_SESSION['nivel']!=$_SESSION['id']){
session_destroy();
echo "FALLA GRAVE AL SISTEMA, PERDISTE LA SESION, PARA REGRESAR AL INICIO REINICIA EL NAVEGADOR";exit();
}
/*
$ci = $_SESSION['cedula'];
include "../conexionbd.php";
$consulta = "select * from alumno where cedula_alumno='$ci'";
$resultado = mysql_query($consulta) or die (mysql_error());
if ($fila = mysql_fetch_array($resultado)){
	$estatus = $fila["id_estatus"];	
}*/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documentos solicitados</title>
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
    <h2>Documentos Solicitados</h2>
  </blockquote>
      
        Seleccione el estudiante:
            <?php
        require_once '../Connections/consultas.php';
        $consulta = new Consulta();           
        
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
                        WHERE id_estatus>=1";
       
        $cs = $consulta->consultas_bd($sql);
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
        <th>Postulación</th>
        <th>Permiso</th>
        <th>Constancia</th>
        </tr>
        </thead>";
        echo "<tbody>";
        while ($resul = mysql_fetch_array($cs)) {
            $id_al = $resul["id_al"]; 
            $id_pre = $resul["id_pre"];
            $cedula=$resul["ced_al"];
            //$id_doc=$resul["id_documento"];
            
            $ids_postulacion=array();
            $con ="SELECT * FROM documento WHERE id_preinscripcion=$id_pre AND id_tipo_documento=1";
            $res =mysql_query($con) or die (mysql_error());
            while ($f = mysql_fetch_array($res)){
                $ids_postulacion[] = $f["id_documento"]; 
            }
            
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
            
            if(count($ids_postulacion)>5){
                echo "<td>Ya generó más de 5</td>";
            }elseif($ides==1){                
                echo "<td><a href='#carta_postulacion' onclick='postulacion(".$id_pre.",0)' "
                        . "class='iredit'>Postulacion</a>(".count($ids_postulacion).")</td>";
            }else{
                echo "<td>-</td>";
            }
            
            
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
        
            ?>  
        
    
    
    <?php
    if(isset($_POST["btn"])){
        
	$fecha = $_POST['fecha_actual'];
	$fecha_actual=date("Y-m-d",strtotime($fecha)); 
	$fecha_actual2=date("d-m-Y",strtotime($fecha));
	$nombre_centro = $_POST['nombre_centro'];
	$carta_dirigida = $_POST['carta_dirigida'];
	$cargo_asignado = $_POST['cargo_asignado'];
	$telefono = $_POST['telefono'];
        $id_doc = $_POST['id_doc'];
        $id_pre = $_POST['id_pre'];
        
        
        if($id_doc>0){
            include "../conexionbd.php";
            if(!empty($nombre_centro) && !empty($carta_dirigida) &&
            !empty($cargo_asignado) && !empty($telefono)){
                $sql1 = "UPDATE documento 
                                    SET fecha_actual = '$fecha_actual',
                                    nombre_centro = '$nombre_centro', 
                                    carta_dirigida = '$carta_dirigida', 
                                    cargo_asignado= '$cargo_asignado',
                                    telefono_lapso= '$telefono'
                                    WHERE id_documento=" . $id_doc;

                $cs = mysql_query($sql1) or die(mysql_error());

                if ($cs) {
                    echo "Registro actualizado con exito.";
                }
                mysql_close($link);
            }else{
                echo "<script>alert('Disculpe existen campos en blanco');</script>";
            }
        }else{
            
            if(!empty($nombre_centro) && !empty($carta_dirigida) &&
            !empty($cargo_asignado) && !empty($telefono)){
            
                include "../conexionbd.php";
                $con = "SELECT * FROM preinscripcion 
                            WHERE id_preinscripcion=".$id_pre;
                $resul=mysql_query($con) or die (mysql_error());


                if ($fila = mysql_fetch_array($resul)){
                        $cant_documentos = $fila["cantidad_documentos_postulacion"];
                }

                $total_doc = $cant_documentos + 1;

                $sql1 = "INSERT INTO documento 
                          (id_tipo_documento, id_preinscripcion, nombre_centro,
                          carta_dirigida, cargo_asignado, fecha_actual,
                          documento_estatus, telefono_lapso)
                          VALUES (1,$id_pre, '$nombre_centro', '$carta_dirigida',
                          '$cargo_asignado', '$fecha_actual', 'noleido','$telefono')";

                $cs = mysql_query($sql1) or die(mysql_error());

                $sql2 = "UPDATE preinscripcion SET 
                                            cantidad_documentos_postulacion=$total_doc 
                                            WHERE id_preinscripcion=".$id_pre;
                $cs1 = mysql_query($sql2) or die(mysql_error());

                if($cs && $cs1){ 
                    echo "<script>alert('Registro guardado con exito');</script>";                 
                    echo'<script>window.location="documentodepartamento_admin.php"</script>';
                }           
                mysql_close($link);
            }else{
                echo "<script>alert('Disculpe existen campos en blanco');</script>";
            }
        }
    }
    ?>
    
    
    
<div class="oculto">
    <form name="form1" id="form1" action="" method="post">
    
    <input type="hidden" name="id_doc" id="id_doc" value="">
    <input type="hidden" name="id_pre" id="id_pre" value="">   
    
   <table width="100%" border="0" align="center">
   <tr>
     <td align="center" colspan="2"><b> De poseer sitio de Pasant&iacute;as indiquelos en los campos correspondientes: </b></td>
   </tr>
   <tr>
     <td align="center" colspan="2">&nbsp;</td>
   </tr>
   <tr>
     <td align="right">Fecha de Solicitud:</td>
     <td width="281" align="left">
         <input type="text" name="fecha_actual" id="fecha_actual" size="10" class="datepicker" maxlength="10">

     </td>
   </tr>
   <tr>
     <td width="309" align="right">Nombre del Centro de Pasant&iacute;as:</td>
     <td width="281"><input type="text" name="nombre_centro" id="nombre_centro" 
                            onkeypress="return validarTextoNumero(event)" size="15"></td>
   </tr>
   <tr>
     <td align="right">Dirigido a:</td>
     <td><input type="text" name="carta_dirigida" id="carta_dirigida" 
                onkeypress="return validarTexto(event)" size="15"></td>
   </tr>
   <tr>
     <td align="right">Cargo que desempe&ntilde;a:</td>
     <td><input type="text" name="cargo_asignado" id="cargo_asignado" 
                onkeypress="return validarTextoNumero(event)" size="15"></td>
   </tr>
   <tr>
     <td height="27" align="right">Tel&eacute;fono:</td>
     <td><input type="text" name="telefono" id="telefono" 
                onkeypress="return validarNumero(event)" size="15"></td>
   </tr>
 </table>
        <br>
        <p align="center"><input type="submit" name="btn" id="btn" value="Guardar" /></p>
 </form>
</div>
       
    
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