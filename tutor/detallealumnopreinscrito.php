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
<title></title>
<link href="../css/bootstrap/3.3.0/bootstrap.min.css" rel="stylesheet">
<link href="../css/material/roboto.min.css" rel="stylesheet">
<link href="../css/material/material.min.css" rel="stylesheet">
<link href="../css/material/ripples.min.css" rel="stylesheet">
<link href="../css/material/materialmodif.css" rel="stylesheet">
</head>

<body>
<!--<form action="" method="post">-->

<?php include_once '../navbar.php';?>
    <?php require_once 'menu.php';?>
<div class="well col-md-9 col-lg-9 col-sm-9 col-xs-9" style="margin-left:20px">
   
      <h2>Alumnos Detalle</h2>
   
    <p align="justify"> &nbsp; En esta secci&oacute;n podras verificar los alumnos que tienes asignados para este proceso.</p>
    
    <?php
   	$id_al = $_GET['id_al'];
               
        include_once '../conexionbd.php';
			
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
                                where al.id_alumnos=".$id_al;
	$res = mysql_query($sql) or die (mysql_error());	
        
        if(mysql_num_rows($res)>0){
            if ($fila = mysql_fetch_array($res)){
                
                $id_estatus = $fila["id_estatus"];
                
                if($id_estatus>=2){
                    $idestudiante = $fila["cedula_alumno"];
                    ?>
                    Para generar el detalle en PDF: 
                    <a href="verPdfAlumnosAsignados.php?id=<?php echo $id_al; ?>" 
                       target="_blank" class="iredit">Ver PDF</a><br>
                    
                    <fieldset style="border: 1px solid;width: 600px; margin:auto;">
                        <legend>ALUMNO</legend>
                    Nombre: <?php echo $fila["nombreal"]." ".$fila["apellidoal"];?><br>                   
                    Cédula: <?php echo $fila["ced_al"]; ?><br>
                    </fieldset><br>
                        
                    <fieldset style="border: 1px solid;width: 600px; margin:auto;">
                        <legend>DATOS DEL CENTRO DE PASANTIA</legend>
                    Nombre empresa: <?php echo $fila["nombre_empresa"]?> <br>
                    Teléfono: <?php echo $fila["telefono_empresa"]?> <br>
                    Dirección: <?php echo $fila["direccion_empresa"]?> <br>
                    Jefe Responsable: <?php echo $fila["jefe_responsable"]?> <br>
                    Cargo: <?php echo $fila["cargo_jefe"]?> <br>
                    Teléfono: <?php echo $fila["telefono_jefe"]?> <br>
                    Email: <?php echo $fila["email_jefe"]?> <br>
                    Área de pasantía: <?php echo $fila["area_pasantia"]?> <br>
                    Horario: <?php echo $fila["horario"]?> <br>
                    Nombre Tutor Empresarial: <?php echo $fila["tutor_empresarial"]?> <br>
                    Cargo: <?php echo $fila["cargo_tutor"]?> <br>
                    Teléfono: <?php echo $fila["telefono_tutor"]?> <br>
                    Email: <?php echo $fila["email"]?> <br>
                    </fieldset><br>
                    
                    <?php
                }else{
                    echo"<p>Hasta los momentos este alumno no ha gestionado un centro, "
                    . "o realizado su inscripcion.</p>";
                }
            }
        }else{
            echo"<p>Hasta los momentos este alumno no ha gestionado un centro, "
            . "o realizado su inscripcion.</p>";
        }
?>  
<?php
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
<!--</form>--> 
</body>
</html>