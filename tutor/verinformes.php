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
<link href="../css/jquery-ui.css" rel="stylesheet" type="text/css">
</head>
    
<body>
<?php include_once '../navbar.php';?>
  <?php require_once 'menu.php';?>
<div class="well col-md-9 col-lg-9 col-sm-9 col-xs-9" style="margin-left:20px">
    <blockquote>
      <h2>Informe: </h2>
    </blockquote>
    <p align="justify">    
    <?php
	$idInforme = $_GET['enviarId'];
	include_once '../conexionbd.php';		
	$consultaInfor = "select * from informes where id_informes='$idInforme'";
	$resultadoInfor = mysql_query($consultaInfor) or die (mysql_error());
	if($fila = mysql_fetch_array($resultadoInfor)){
		$unidad = $fila["unidad_pasantias"];
		$actividades = $fila["informe_actividades"];
		$limitaciones = $fila["limitaciones_pasantia"];
		$entrevista_academico = $fila["entrevista_academico"];
		$entrevista_tutor_academico = $fila["entrevista_tutor_academico"];
		$entrevista_empresarial = $fila["entrevista_empresarial"];	
		$entrevista_tutor_empresarial = $fila["entrevista_tutor_empresarial"];				
		$estado_informe = $fila["estado_informe"];		
		$fecha_informe = $fila["fecha_informe"];		
		$calificacion_informe = $fila["calificacion_informe"];		
		echo "Estado del informe: ".$estado_informe."<br>";
		echo "Calificaci&oacute;n: ".$calificacion_informe."<br>";
		$actualizarEstado = "update informes set estado_informe='leido' where id_informes='$idInforme'";			
		mysql_query($actualizarEstado);                
	}	
	?>    
        <form action="" method="post" name="form">
            <table width="100%" border="0">
                <input type="hidden" name="id" id="id" value="<?php echo $idInforme?>">
                
                <tr>
                    <td height="112"colspan="2" align="left" valign="top">
                        Unidad (es) Administrativa (s) donde realiz&oacute; la pasant&iacute;a durante <br> 
                        este lapso:<br/> 
                    <textarea readonly="readonly" name="unidad" rows="2" cols="70"><?php echo $unidad; ?></textarea></td>
                </tr>
                <tr>
                    <td height="164" colspan="2" align="left">
                        Actividades que realizad&oacute; en este lapso: <br>
                        <textarea readonly="readonly" name="actividades" rows="7" cols="70"><?php echo $actividades; ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td height="160" colspan="2" align="left">
                        Limitaciones que se presentaron en el centro de pasant&iacute;as: <br>
                        <textarea readonly="readonly" name="limitaciones" rows="7" cols="70"><?php echo $limitaciones; ?></textarea></td>
                </tr>
                <tr>
                    <td height="95" colspan="2" align="left">
                        <p>Se entrevist&oacute; con su Tutor Acad&eacute;mico: 
                            <?php echo $entrevista_tutor_academico; ?><br>
                        <textarea readonly="readonly" name="academico" rows="3" cols="70" ><?php echo $entrevista_academico; ?></textarea>
                    </p></td>
                </tr>
                <tr>
                    <td height="89" colspan="2" align="left">
                        Se entrevist&oacute; con su Tutor Empresarial: 
                        <?php echo $entrevista_tutor_empresarial; ?><br>
                    <textarea readonly="readonly" name="empresarial" rows="3" cols="70"><?php echo $entrevista_empresarial; ?></textarea></td>
                </tr>
                <tr>
                    <td width="51%" align="center"><input type="button" name="reprobado" id="reprobado" value="Reprobar" /></td>
                    <td width="48%" align="center"><input type="button" name="aprobado" id="aprobado" value="Aprobar" /> 
                    </td>
                </tr>
            </table>
        </form> 
                
    </p>     
    <?php
	if(isset ($_POST['aprobado'])){		
		$actualizarCalificacion = "update informes set calificacion_informe='aprobado' where id_informes='$idInforme'";			
		mysql_query($actualizarCalificacion);		
		header ("Location: tutorInformesPasantias.php");
	} 
	if(isset ($_POST['reprobado'])){
		$actualizarCalificacion = "update informes set calificacion_informe='reprobado' where id_informes='$idInforme'";			
		mysql_query($actualizarCalificacion);		
		header ("Location: tutorInformesPasantias.php");
	}
	?>   
       
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
<script language="javascript" type="text/javascript" src="js/informes.js"></script>
</body>
</html>