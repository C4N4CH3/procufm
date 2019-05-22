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
<title>Documentos solicitados</title>
<link href="../css/bootstrap/3.3.0/bootstrap.min.css" rel="stylesheet">
<link href="../css/material/roboto.min.css" rel="stylesheet">
<link href="../css/material/material.min.css" rel="stylesheet">
<link href="../css/material/ripples.min.css" rel="stylesheet">
<link href="../css/material/materialmodif.css" rel="stylesheet">
</head>

<body>
<?php include_once '../navbar.php';?>
  
  <div class="sidebar1"> 
    <?php include_once("menu_admin.php")?>
  <!-- end .sidebar1 --></div>
 <div class="well col-md-9 col-lg-9 col-sm-9 col-xs-9" style="margin-left:20px">

  
    <h2>Editar Informes estudiante</h2>


<?php	
if (isset($_POST["btn"])) {
	$unidad = $_POST['unidad'];
	$actividades = $_POST['actividades'];
	$limitaciones = $_POST['limitaciones'];
	$academico = $_POST['academico'];
	$empresarial = $_POST['empresarial'];	
	$radioacademico = $_POST['radioacademico'];
	$radioempresarial = $_POST['radioempresarial'];
	$hoy= date("Y-n-j");
        
	if ($_POST["id"]>0) {
            $id_inf = $_POST['id'];
            $id_ins = $_POST['id_ins'];

            include_once "../conexionbd.php";	
            $insertaInformes = "UPDATE informes 
                                    SET unidad_pasantias='$unidad', 
                                    informe_actividades='$actividades', 
                                    limitaciones_pasantia='$limitaciones', 
                                    entrevista_academico='$academico', 
                                    entrevista_empresarial='$empresarial', 
                                    entrevista_tutor_academico='$radioacademico', 
                                    entrevista_tutor_empresarial='$radioempresarial', 
                                    fecha_informe='$hoy'
                                    WHERE id_informes=".$id_inf;	
            $res=mysql_query($insertaInformes) or die (mysql_error());
            if($res){
                ?>
                <fieldset style="border: 1px solid;width: 400px; margin:auto;">
                    <legend>MENU</legend>
                    <form action="" method="post">
                        Ver todos los Registros:<a href='verinformepasantia.php?ins=<?php echo $id_ins?>' class='iredit'>Volver</a><br>
                    </form>
                </fieldset>
                <?php
                echo '<br><p>Registro actualizado con exito.</p>';            
                unset($_GET["id_ins"]);            
            }            
        }
        //
        if ($_POST["id"]==0) {    
            $id_ins = $_POST['id_ins'];
            include_once "../conexionbd.php";
            $TablaIns = "select * from inscripcion where id_inscrito=$id_ins";
		$resulTablaIns = mysql_query($TablaIns) or die (mysql_error());	
		if($filaid = mysql_fetch_array($resulTablaIns)){
                    $cantidadInformes = $filaid["cantidad_informes"]; 					
			
                    if ($cantidadInformes < 3){
			$cantidadInformes++;			
			$insertaInformes = "INSERT INTO informes 
                                                (unidad_pasantias, informe_actividades, 
                                                limitaciones_pasantia, entrevista_academico, 
                                                entrevista_empresarial, entrevista_tutor_academico, 
                                                entrevista_tutor_empresarial, estado_informe, 
                                                fecha_informe, calificacion_informe)
                                                VALUE ('$unidad', '$actividades', '$limitaciones',
                                                '$academico', '$empresarial', '$radioacademico', 
                                                '$radioempresarial', 'noleido', '$hoy', 'en espera')";	
			$res1=mysql_query($insertaInformes) or die (mysql_error());
			$idInformes = mysql_insert_id();
			
			$cargaControl = "INSERT INTO control_informes (id_inscrito, id_informes)
                                            VALUES ($id_ins, $idInformes)";
			
			$res2=mysql_query($cargaControl) or die (mysql_error());
			
			$actulizaCantinformes = "UPDATE inscripcion SET 
                                                    cantidad_informes=$cantidadInformes 
                                                    WHERE id_inscrito=$id_ins";
			$res3=mysql_query($actulizaCantinformes);
			
                        if($res1 && $res2 && $res3){
                            echo '<script>alert("Registro guardado con exito");</script>';
                            echo '<script type="text/javascript">window.location="formularioinformespasantias_admin.php"</script>';
                            //header('location: formularioinformespasantias_admin.php');
                            unset($_GET["id_ins"]);        
                        }
                        
                    }else{
			echo "<br>Ud. ya tiene los tres(3) informes cargados en el sistema<br>";
                    }				
                }else {
			echo "<br>Ud no esta Inscrito<br>";
		}
        }        
        mysql_close($link);
}
	?>    
    
<?php
if(isset($_GET["id_ins"])){
    //SI ES UN NUEVO INFORME
    $id_ins = $_GET["id_ins"];    
    if(isset($_GET["id_ins"])){
        $id = 0;        
        $unidad_pasantias='';
        $informe_actividades='';
        $limitaciones_pasantia='';
        $entrevista_tutor_academico='';
        $entrevista_tutor_empresarial='';
        $entrevista_academico='';
        $entrevista_empresarial='';
    }    
    
    //CARGAR INFORME REGISTRADO
    if(isset($_GET["id"])){        
        $id = $_GET["id"];
        include "../conexionbd.php";
        $sql = "SELECT *,inf.id_informes as id_inf 
                    FROM informes as inf
                    INNER JOIN control_informes as ct
                    ON inf.id_informes=ct.id_informes
                    INNER JOIN inscripcion as ins
                    ON ct.id_inscrito=ins.id_inscrito
                    WHERE inf.id_informes=".$id;
        $res = mysql_query($sql) or die(mysql_error());
        if ($f = mysql_fetch_array($res)) {
            $unidad_pasantias=$f["unidad_pasantias"];
            $informe_actividades=$f["informe_actividades"];
            $limitaciones_pasantia=$f["limitaciones_pasantia"];
            $entrevista_tutor_academico=$f["entrevista_tutor_academico"];
            $entrevista_tutor_empresarial=$f["entrevista_tutor_empresarial"];
            $entrevista_academico=$f["entrevista_academico"];
            $entrevista_empresarial=$f["entrevista_empresarial"];
        }
        mysql_close($link);
    } 
    ?>
    <form action="" id="form1" name="form1" method="post">
    <table width="100%" border="0">
        <input type="hidden" name="id" id="id" value="<?php echo $id?>">
        <input type="hidden" name="id_ins" id="id_ins" value="<?php echo $id_ins?>">    
      <tr>
    <td height="112"colspan="2" align="left" valign="top">
        Unidad (es) Administrativa (s) donde ha realizado su pasant&iacute;a durante 
            este lapso:<br/> <textarea name="unidad" rows="2" cols="70"><?php echo $unidad_pasantias?></textarea></td>
    </tr>
    <tr>
          <td height="198" colspan="2" align="left" valign="top">
              Describa ordenadamente las actividades que ha realizado 
              en este lapso: <br>
          <textarea name="actividades" rows="7" cols="70"><?php echo $informe_actividades?></textarea>
            </td>
        </tr>
        <tr>
            <td height="189" colspan="2" align="left" valign="top">
              Señale las limitaciones que se le han presentado en 
              su centro de pasant&iacute;as: <br>
                  <textarea name="limitaciones" rows="7" cols="70"><?php echo $limitaciones_pasantia?></textarea>
            </td>
        </tr>
        <tr>
            <td height="112" colspan="2" align="left" valign="top">
              Se entrevist&oacute; con su Tutor Acad&eacute;mico 
              <input type="radio" name="radioacademico" 
                     value="si" <?php if($entrevista_tutor_academico=='si'){echo "checked";} ?>>Si 
                  <input type="radio" name="radioacademico" 
                         value="no" <?php if($entrevista_tutor_academico=='no'){echo "checked";}?>>No ¿Por qu&eacute; no? <br>
              <textarea name="academico" rows="3" cols="70"><?php echo $entrevista_academico?></textarea>
            </td>
        </tr>
        <tr>
            <td height="98" colspan="2" align="left" valign="top">
                Se entrevist&oacute; con su Tutor Empresarial 
                <input type="radio" name="radioempresarial" 
                       value="si" <?php if($entrevista_tutor_empresarial=='si'){echo "checked";}?>>Si 
                    <input type="radio" name="radioempresarial" 
                           value="no" <?php if($entrevista_tutor_empresarial=='no'){echo "checked";}?>>No ¿Por qu&eacute; no? <br>
                <textarea name="empresarial" rows="3" cols="70"><?php echo $entrevista_empresarial?></textarea>
            </td>
        </tr>
        <tr>
            <td height="56" colspan="2" align="left" valign="top" >
              <em>Estos datos son estrictamente proporcionados por 
                  usted por lo que le solicitamos que la informaci&oacute;n 
                  sea pertinente</em>
            </td>
        </tr>
        <tr>
            <td align="center" colspan="2">
                <input type="submit" name="btn" value="Aceptar" /> 
          </td>
        </tr>
    </table>  
    </form>
<?php
}
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
  <script language='javascript' src="../popcalendar.js"></script>
<script language="javascript" src="../validarsesiones.js"></script>
</body>
</html>
