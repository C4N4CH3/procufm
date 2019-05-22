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
<title>Inscripción</title>
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
  <!-- end .sidebar1 -->
 </div>
  <div class="well col-md-9 col-lg-9 col-sm-9 col-xs-9" style="margin-left:20px">
  
        <h2>Inscripci&oacute;n</h2>

<?php 

require_once '../Connections/consultas.php';
$consulta = new Consulta();
$sql="select * from lapso where lapso_habilitado='si'";
$cs = $consulta->consultas_bd($sql);
if($cs>0){
    if($fila = mysql_fetch_array($cs)){
        $idLapso = $fila["id_lapso"];
        $codlap = $fila["codigo_lapso"];
        echo "<b>El código de lapso es:".$codlap."</b><br><br>";           
        ?>
        
        <?php
    }
    else{	
        echo "No hay LAPSO habilitado o registrado en el sistema.";    
        //header ("Location: sesionestudiante.php?nolapso=si");
    }
}
?>      
    <fieldset style="border: 1px solid;width: 400px; margin:auto;">
        <legend>MENU</legend>
        <form action="" method="post">
            Ver todos los Registros:<input type="submit" name="btn1" value="Listar" id="vertodos" /><br>
            
        </form>
    </fieldset>


<?php
if (isset($_POST["btn1"])) {
    $btn = $_POST["btn1"];

    if ($btn == "Listar") {
        require_once '../Connections/consultas.php';
        $consulta = new Consulta();   
        $sql = "select * from alumno where id_estatus>=1 AND id_estatus<=2";
        
        $cs = $consulta->consultas_bd($sql);
        
        echo"<div id='todosreg'><center>
            <br>REGISTROS<br>            
<table border='1' width='100%' id='mi_tabla'>
<thead>
<tr>
    <th colspan='8' align='right'><input type='text' id='filtrar' /></th>
</tr>
<tr>
<th>Nombre</th>
<th>Apellido</th>
<th>Cedula</th>
<th>Crear</th>
<th>Editar</th>
<th>Eliminar</th>
</tr>
</thead>";
        echo "<tbody>";        
        while ($resul = mysql_fetch_array($cs)) {
            $id_al = $resul["id_alumnos"];
            $ira = $resul["indice_academico"];
            echo "<tr>";
            echo "<td>".$resul["nombre"]."</td>";
            echo "<td>".$resul["apellido"]."</td>";
            echo "<td>".$resul["cedula_alumno"]."</td>";
            
            $ides=$resul["id_estatus"];
            
            
            if($ides==1){
            echo "<td><a href='#nuevo' class='iredit' onClick='nuevo(".$id_al.",".$ira.")'>Nuevo</a></td>";
            }else{
                echo "<td>Ya se Inscribió</td>";
            }
                
            if($ides==2){
            echo "<td><a href='#editar' class='iredit' onClick='editar(".$id_al.",".$ira.")'>Editar</a></td>";
            echo "<td><a href='#eliminar' class='eli iredit' onClick='eliminar(".$id_al.")'>Eliminar</a></td>";
            }else{
                echo "<td>-</td>";
                echo "<td>-</td>";
            }
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>
</center></div>";
    }
}
?>   
      
      
<?php
if (isset($_POST["Guargar"])) {
    if (!empty($_POST['nombre']) && !empty($_POST['direccion'])             
            && !empty($_POST['telefono']) && !empty($_POST['responsable']) 
            && !empty($_POST['cargo']) && !empty($_POST['telresponsable'])
            && !empty($_POST['emailresponsable']) && !empty($_POST['area'])
            && !empty($_POST['horario']) && !empty($_POST['obtenercentro'])
            && !empty($_POST['nombretutor']) && !empty($_POST['cargotutor']) 
            && !empty($_POST['emailtutor']) && !empty($_POST['teletutor'])
            && !empty($_POST['seleccionfecha'])){  
    
    
        $id = $_POST['id_al_hidden'];
        $id_ins=$_POST['id_ins'];        
        $nombre_em = $_POST['nombre'];
        $direccion_em = $_POST['direccion'];
        $tel_em = $_POST['telefono'];
        $nom_responsable = $_POST['responsable'];
        $cargo_responsable = $_POST['cargo'];
        $tel_responsable = $_POST['telresponsable'];
        $email_responsable = $_POST['emailresponsable'];
        $area = $_POST['area'];
        $horario = $_POST['horario'];
        $obtenercentro = $_POST['obtenercentro'];
        $nombretutor = $_POST['nombretutor'];
        $cargotutor = $_POST['cargotutor'];
        $emailtutor = $_POST['emailtutor'];
        $teletutor = $_POST['teletutor'];
        $seleccionfecha = $_POST["seleccionfecha"];

        
        //PARA NUEVO REGISTRO
        if(empty($_POST['id_ins'])){        
            $consultaTablaPre1 = "select * from preinscripcion where id_alumno=$id";
            $resultadoTablaPre1 = mysql_query($consultaTablaPre1) or die(mysql_error());        
            if ($fil = mysql_fetch_array($resultadoTablaPre1)) {
                $idpreins = $fil["id_preinscripcion"];

                $insertaDatos = "INSERT INTO inscripcion 
                                        (id_preinscripcion, nombre_empresa, telefono_empresa, 
                                        direccion_empresa, jefe_responsable, cargo_jefe, 
                                        telefono_jefe, email_jefe, area_pasantia, 
                                        horario, tutor_empresarial, cargo_tutor, email, 
                                        telefono_tutor, obtencion_centro, id_fecha, cantidad_informes)
                                VALUES ('$idpreins','$nombre_em', '$tel_em', '$direccion_em', '$nom_responsable',
                                        '$cargo_responsable', '$tel_responsable', '$email_responsable', '$area', 
                                        '$horario', '$nombretutor', '$cargotutor', '$emailtutor', '$teletutor', 
                                        '$obtenercentro','$seleccionfecha','0')";

                $cs1=mysql_query($insertaDatos) or die(mysql_error());

                $actulizaestatus = "update alumno set id_estatus=2 where id_alumnos=$id";
                $cs2=mysql_query($actulizaestatus) or die(mysql_error());

                if($cs1 && $cs2){
                    echo "<h2>Hemos recibido sus datos exitosamente </h2>";
                }
            }
        }else{
            //PARA ACTUALIZAR
            $insertaDatos = "UPDATE inscripcion 
                                SET nombre_empresa='$nombre_em', telefono_empresa='$tel_em', 
                                        direccion_empresa='$direccion_em', jefe_responsable='$nom_responsable', 
                                        cargo_jefe='$cargo_responsable', telefono_jefe='$tel_responsable', 
                                        email_jefe='$email_responsable', area_pasantia='$area', 
                                        horario='$horario', tutor_empresarial='$nombretutor', cargo_tutor='$cargotutor', 
                                        email='$emailtutor', telefono_tutor='$teletutor', 
                                        obtencion_centro='$obtenercentro', id_fecha=$seleccionfecha
                                WHERE id_inscrito=$id_ins";
                
            $cs1=mysql_query($insertaDatos) or die(mysql_error());

            $actulizaestatus = "update alumno set id_estatus=2 where id_alumnos=$id";
            $cs2=mysql_query($actulizaestatus) or die(mysql_error());

            if($cs1 && $cs2){
                echo "<h2>Hemos recibido sus datos exitosamente </h2>";
            }
        }
    }else{
        echo "<p>Disculpe Existen campos en blancos. Por favor intente de nuevo</p>";
    } 
}
?>
         
 <div class="oculto"> 
 <form action="" method="post" id="form1" name="form1">  
    <div id="mi_tabla2"></div>    
    <input type="hidden" name="id_al_hidden" id="id_al_hidden" value="" /> 
    <input type="hidden" name="id_ins" id="id_ins" value="" /> 
    <br>
        <p>Nota: Complete los siguientes datos con la carta de aceptación emitida por
        la Empresa o Institución donde realizará las proximas pasantías</p> 
        <p><font color="red">*</font> Campo requerido</p>
    <table width="100%" border="1">
      <tr>
        <th colspan="2"><em>Datos del centro de pasant&iacute;a</em></th>
      </tr>
      <tr>
        <td align="right"><font color="red">*</font>Nombre de la empresa:</td>
        <td><input type="text" name="nombre" id="nombre" class="mayuscula"
                   onkeypress="return validarTextoNumero(event)" size="40"></td>
        </tr>
      <tr>
        <td align="right"><font color="red">*</font>Direcci&oacute;n de la empresa:</td>
        <td><input type="text" name="direccion" id="direccion" class="mayuscula" 
                   onkeypress="return validarTextoNumero(event)" size="40" ></td>
        </tr>
      <tr>
        <td align="right"><font color="red">*</font>Tel&eacute;fono de la empresa:</td>
        <td><input type="text" name="telefono" id="telefono" onkeypress="return validarNumero(event)" size="40"></td>
      </tr>
      <tr>
        <td align="center" colspan="2"><em>Jefe responsable del &aacute;rea de Pasant&iacute;a:</em></td>
      </tr>
      <tr>
        <td align="right"><font color="red">*</font>Nombre:</td>
        <td><input type="text" name="responsable" id="responsable" class="mayuscula" 
                   onkeypress="return validarTexto(event)" size="40" /></td>
      </tr>
      <tr>
        <td align="right"><font color="red">*</font>Cargo:</td>
        <td><input type="text" name="cargo" id="cargo" class="mayuscula"
                   onkeypress="return validarTextoNumero(event)" size="40" /></td>
      </tr>
      <tr>
        <td align="right"><font color="red">*</font>Tel&eacute;fono:</td>
        <td><input type="text" name="telresponsable" id="telresponsable" class="mayuscula" 
                   onkeypress="return validarNumero(event)" size="40" /></td>
      </tr>
      <tr>
        <td align="right"><font color="red">*</font>Email:</td>
        <td><input type="text" name="emailresponsable" id="emailresponsable" class="mayuscula" 
                   onkeypress="return validarEmail(event)" size="40" /></td>
      </tr>
      <tr>
        <td align="center" colspan="2"><em>Lugar donde realizar&aacute; las pasant&iacute;as</em></td>
      </tr>
      <tr>
        <td align="right"><font color="red">*</font>&Aacute;rea o departamento:</td>
        <td><input type="text" name="area" id="area" class="mayuscula" 
                   onkeypress="return validarNumeroTexto(event)" size="40" /></td>
      </tr>
      <tr>
        <td align="right"><font color="red">*</font>Horario:</td>
        <td><input type="text" name="horario" class="mayuscula" id="horario" size="40" /></td>
      </tr>      
      <tr>
        <td align="right" valign="top"><font color="red">*</font>¿C&oacute;mo obtuvo el centro?</td>
        <td align="left"><input type="radio" name="obtenercentro" id="obtener1" value="trabaja alli"/>Trabaja all&iacute;<br>
        <input type="radio" name="obtenercentro" id="obtener2" value="gestion propia"/>Gesti&oacute;n propia<br>
        <input type="radio" name="obtenercentro" id="obtener3" value="dpto pasantia"/>Dpto. Pasant&iacute;a<br>
        <input type="radio" name="obtenercentro" id="obtener4" value="otro"/>Otro        
        </td>
      </tr>
      <tr>
        <td align="center" colspan="2"><em>Datos del tutor empresarial</em></td>
      </tr>
      <tr>
        <td align="right"><font color="red">*</font>Nombre(s) y apellido(s):</td>
        <td><input type="text" name="nombretutor" id="nombretutor" class="mayuscula" 
                   onkeypress="return validarTexto(event)" size="40" /></td>
      </tr>
      <tr>
        <td align="right"><font color="red">*</font>Cargo:</td>
        <td><input type="text" name="cargotutor" id="cargotutor" class="mayuscula" 
                   onkeypress="return validarTextoNumero(event)" size="40" /></td>
      </tr>
      <tr>
        <td align="right"><font color="red">*</font>Email:</td>
        <td><input type="text" name="emailtutor" id="emailtutor" class="mayuscula" 
                   onkeypress="return validarEmail(event)" value="<?php if(isset($_POST['emailtutor'])) echo $_POST['emailtutor']?>" size="40" /></td>
      </tr>
      <tr>
        <td align="right"><font color="red">*</font>Tel&eacute;fono:</td>
        <td><input type="text" name="teletutor" id="teletutor"
                   onkeypress="return validarNumero(event)" value="<?php if(isset($_POST['teletutor'])) echo $_POST['teletutor']?>" size="40" /></td>
      </tr>
  </table> 
  <p align=center><input type="submit" name="Guargar" value="Guargar" id="btnagregar"></p> 
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
<script language="javascript" type="text/javascript" src="../js/func_ins.js"></script>
<script language="javascript" type="text/javascript" src="../js/comun.js"></script>
<script language="javascript" type="text/javascript" src="../js/jquery.validate.js"></script> 
</body>
</html>