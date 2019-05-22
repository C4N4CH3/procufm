<?php
include ("../sesiones.php");
if($_SESSION['nivel']!=$_SESSION['id']){
session_destroy();
echo "FALLA GRAVE AL SISTEMA, PERDISTE LA SESION, PARA REGRESAR AL INICIO REINICIA EL NAVEGADOR";exit();
}
require_once 'funciones.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Preinscripción</title>
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
  
        <h2 align="center">Preinscripci&oacute;n</h2>
    

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
        /*$sql = "SELECT al.cedula_alumno as ced_al,al.id_alumnos as id_al,al.*,us.*,pre.* 
                    FROM alumno AS al 
                    INNER JOIN usuario AS us 
                    ON al.id_usuario=us.id_usuario
                    LEFT JOIN preinscripcion AS pre
                    ON al.id_alumnos=pre.id_alumno";*/
       
        $sql = "SELECT al.cedula_alumno as ced_al,al.id_alumnos as id_al,al.*,us.*,pre.*,
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
                        tu.habilitado as habtutor
                FROM ((alumno AS al 
                INNER JOIN usuario AS us 
                    ON al.id_usuario=us.id_usuario)
                LEFT JOIN preinscripcion AS pre
                    ON al.id_alumnos=pre.id_alumno)
                LEFT JOIN tutor_academico as tu
                    ON pre.id_tutor=tu.id_tutor";
       
        $cs = $consulta->consultas_bd($sql);
        //$cs = mysql_query($sql, $cn);
        echo"<div id='todosreg'><center>
            <br>REGISTROS<br>            
<table border='1' width='100%' id='mi_tabla'>
<thead>
<tr>
    <th colspan='8' align='right'><input type='text' id='filtrar' /></th>
</tr>
<tr>
<th>Nombre y Apellido</th>
<th>Cedula</th>
<th>Usuario</th>
<th>Tutor</th>
<th>Crear</th>
<th>Editar</th>
<th>Eliminar</th>
</tr>
</thead>";
        echo "<tbody>";
        while ($resul = mysql_fetch_array($cs)) {
            $id_al = $resul["id_al"];            
            echo "<tr>";
            echo "<td>".$resul["nombre"].' '.$resul["apellido"]."</td>";
            echo "<td align='center'>".number_format($resul["ced_al"], 0, '', '.')."</td>";
            echo "<td>".$resul["login"]."</td>";
            echo "<td>".$resul["nombretutor"].' '.$resul["apellidotutor"]."</td>";
            
            $ides=$resul["id_estatus"];            
            
            if($ides==0){
            echo "<td><a href='#nuevo' class='iredit' onClick ='nuevopreinscipcion(".$id_al.")'>Nuevo</a></td>";
            }else if($ides==2){
                echo "<td>Inscrito</td>";
            }else{
                echo "<td>Preinscrito</td>";
            }
                
            if($ides==1){
            echo "<td><a href='#editar' class='iredit' onClick ='editarpreinscipcion(".$id_al.")'>Editar</a></td>";
            echo "<td><a href='#eliminar' class='eli iredit' onClick ='eliminarpreinscripcion(".$id_al.")'>Eliminar</a></td>";
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
if (isset($_POST["btn1"])) {
    $btn = $_POST["btn1"];     
    if ($btn == "Agregar") {        
        if (!empty($_POST['carnet']) && !empty($_POST['direccion'])             
            && !empty($_POST['fechaNacimiento']) && !empty($_POST['sexo']) 
            && !empty($_POST['carrera']) && !empty($_POST['mencion'])
            && !empty($_POST['creditosaprobados']) && !empty($_POST['semestre'])
            && !empty($_POST['telefonohab']) && !empty($_POST['telefonocel'])
            && !empty($_POST['trabajo']) && !empty($_POST['idLapso']) 
            && !empty($_POST['id_al']) && !empty($_POST['ira'])
            && !empty($_POST['ced_al'])){  
            
            include_once '../conexionbd.php';
            $carnet = $_POST['carnet'];
            $direccion = $_POST['direccion'];
            $fechaNacimiento = $_POST['fechaNacimiento'];
            
            $trozo = explode("-", $fechaNacimiento);
            $fechaNacimiento = $trozo[2]."-".$trozo[1]."-".$trozo[0];
            
            $sexo = $_POST['sexo'];
            $carrera = $_POST['carrera'];
            $mencion = $_POST['mencion'];
            $creditosaprobados = $_POST['creditosaprobados'];
            $ira = $_POST['ira'];
            $turno = $_POST['turno'];
            $semestre = $_POST['semestre'];
            $telefonohab = $_POST['telefonohab'];
            $telefonocel = $_POST['telefonocel'];
            $trabajo = $_POST['trabajo'];
            
            
            if($trabajo=='si'){
                $nombrempresa = $_POST['nombrempresa'];
                $cargo = $_POST['cargo'];
                $telefonoempleo = $_POST['telefonoempleo'];
                $emailempleo = $_POST['emailempleo']; 
            }else{
                $nombrempresa = '';
                $cargo = '';
                $telefonoempleo = '';
                $emailempleo = ''; 
            }
            
            $idLapso = $_POST['idLapso'];
            $id_al = $_POST['id_al']; 
            $ci = $_POST['ced_al'];
            
            $res1 = $res2 = $cons = FALSE;
            
            $sql1 = "UPDATE alumno 
                        SET carnet='$carnet', direccion_habitacion='$direccion', fecha_nacimiento='$fechaNacimiento',
                            sexo='$sexo', id_carrera='$carrera', id_mencion='$mencion', creditos_aprobados='$creditosaprobados',
                            indice_academico='$ira', turno='$turno', semestre='$semestre', telefono_habitacion='$telefonohab',
                            telefono_celular='$telefonocel', empleo='$trabajo', nombre_empleo='$nombrempresa',
                            cargo_empleo='$cargo', telefono_empleo='$telefonoempleo', email_empleo='$emailempleo',
                            id_estatus=1 
                        WHERE id_alumnos=$id_al";
            $res1 = mysql_query($sql1) or die (mysql_error());

            if($res1==TRUE){
                //gestionar asignacion de tutor                                
                $consulta_1 = "SELECT * FROM tutor_academico
                                    WHERE id_carrera=$carrera AND id_mencion=$mencion AND habilitado='si'";
                $resultado_1 = mysql_query($consulta_1) or die(mysql_error());
                $i = 0;
                
                if (mysql_num_rows($resultado_1) > 0) {                    
                    while ($row = mysql_fetch_array($resultado_1)) {
                        $arrayId[$i] = $row["id_tutor"];
                        $arrayCantidadAlumno[$i] = $row["cantidad_asignacion_alum"];
                        $i++;
                    }                    
                    arsort($arrayCantidadAlumno);
                    foreach ($arrayCantidadAlumno as $key => $val) {
                        $indice = $key;
                        $valor = $val;
                    }
                    $indicetutor = $arrayId[$indice];
                    $valor++;
                    $cons = "update tutor_academico set cantidad_asignacion_alum=$valor where id_tutor=$indicetutor";
                    mysql_query($cons) or die(mysql_error());

                    /*$consulta_1 = "insert into preinscripcion (cedula_alumno, id_tutor, codigo_lapso, cant_centros_temporales, cantidad_documentos_postulacion, cantidad_documentos_permiso, cantidad_documentos_constancia, id_alumno)" . "values ('$ci','$indicetutor', '$idLapso', '0', '0', '0', '0',$id_alumno)";
                    mysql_query($consulta_1) or die(mysql_error());
                    echo "<h2>Hemos recibido sus datos exitosamente</h2>";*/
                    $sql2="INSERT INTO preinscripcion
                            (cedula_alumno, id_tutor, codigo_lapso, cant_centros_temporales, 
                            cantidad_documentos_postulacion, cantidad_documentos_permiso, 
                            cantidad_documentos_constancia, id_alumno)
                            VALUES ('$ci',$indicetutor, $idLapso, 0, 0, 0, 0,$id_al)";                              
                    $res2 = mysql_query($sql2) or die (mysql_error());
                }else{
                    echo "Disculpe no se puede seguir con el proceso.
                            No existe tutor academico disponible";
                    $sql = "UPDATE alumno 
                            SET id_estatus=0 
                            WHERE id_alumnos=$id_al";
                    mysql_query($sql) or die (mysql_error());                
                } 
            }           
            if($res1==TRUE && $res2==TRUE && $cons==TRUE){
                echo "<script> alert('¡Gracias! Hemos recibido sus datos');</script>";                
            }else{
                echo "<br>Ocurrió un problema.";
            }
            mysql_close($link);
        }else{
            echo "<p>Disculpe Existen campos en blancos. Por favor intente de nuevo</p>";
        } 
               
    }
    if ($btn == "Actualizar") {
        
        if (!empty($_POST['carnet']) && !empty($_POST['direccion'])             
            && !empty($_POST['fechaNacimiento']) && !empty($_POST['sexo']) 
            && !empty($_POST['carrera']) && !empty($_POST['mencion'])
            && !empty($_POST['creditosaprobados']) && !empty($_POST['semestre'])
            && !empty($_POST['telefonohab']) && !empty($_POST['telefonocel'])
            && !empty($_POST['trabajo']) && !empty($_POST['idLapso']) 
            && !empty($_POST['id_al']) && !empty($_POST['ira'])){            
            
            include_once '../conexionbd.php';
            $carnet = $_POST['carnet'];
            $direccion = $_POST['direccion'];
            $fechaNacimiento= $_POST['fechaNacimiento'];
            
            $trozo = explode("-", $fechaNacimiento);
            $fechaNacimiento = $trozo[2]."-".$trozo[1]."-".$trozo[0];
            
            $sexo = $_POST['sexo'];
            $carrera = $_POST['carrera'];
            $mencion = $_POST['mencion'];
            $creditosaprobados = $_POST['creditosaprobados'];
            $ira = $_POST['ira'];
            $turno = $_POST['turno'];
            $semestre = $_POST['semestre'];
            $telefonohab = $_POST['telefonohab'];
            $telefonocel= $_POST['telefonocel'];
            $trabajo= $_POST['trabajo'];
            
            if($trabajo=='si'){
                $nombrempresa = $_POST['nombrempresa'];
                $cargo = $_POST['cargo'];
                $telefonoempleo = $_POST['telefonoempleo'];
                $emailempleo = $_POST['emailempleo']; 
            }else{
                $nombrempresa = '';
                $cargo = '';
                $telefonoempleo = '';
                $emailempleo = ''; 
            }
            $idLapso = $_POST['idLapso'];
            $id_al = $_POST['id_al'];
            
            $sql1 = "UPDATE alumno 
                    SET carnet='$carnet', direccion_habitacion='$direccion', fecha_nacimiento='$fechaNacimiento',
                        sexo='$sexo', id_carrera='$carrera', id_mencion='$mencion', creditos_aprobados='$creditosaprobados',
                        indice_academico='$ira', turno='$turno', semestre='$semestre', telefono_habitacion='$telefonohab',
                        telefono_celular='$telefonocel', empleo='$trabajo', nombre_empleo='$nombrempresa',
                        cargo_empleo='$cargo', telefono_empleo='$telefonoempleo', email_empleo='$emailempleo',
                        id_estatus=1 
                    WHERE id_alumnos=$id_al";
            $res1 = mysql_query($sql1) or die (mysql_error());
            
            if($res1==TRUE){
                $sql2=" UPDATE preinscripcion
                        SET codigo_lapso=$idLapso 
                        WHERE id_alumno=$id_al";
                $res2 = mysql_query($sql2) or die (mysql_error());
            }

            if($res1==TRUE && $res2==TRUE){
                echo "<script> alert('¡Gracias! Hemos recibido sus datos');</script>";                
            }
            mysql_close($link);
        }else{
            echo "<p>Disculpe Existen campos en blancos. Por favor intente de nuevo</p>";
        }   
        
    }//FIN if ($btn == "Actualizar")
}
?>
      
      
<div id="form_reg" class="oculto">   

    <p>Nota: el sistema asignará automaticamente los tutores de las diferentes carreras a 
        cursar.</p>
    <p><font color="red">*</font> Campo requerido</p>
    <form action="" method="post" id="form1" name="form1">
     
     <input type="hidden" name="idLapso" value="<?php echo $idLapso; ?>" />
     <input type="hidden" name="id_al" id="id_al" value="">
     <input type="hidden" name="ced_al" id="ced_al" value="">
         
      <table width="100%" border="1">
      <tr>
        <td width="35%" align="right"><font color="red">*</font>Nombres y Apellidos:</td>
        <td width="65%"><div id="nom_al"></div></td>
        </tr>
      <tr>
        <td align="right"><font color="red">*</font>C&eacute;dula:</td>
        <td><div id="cedula"></div></td>
        
        </tr>
      <tr>
        <td align="right"><font color="red">*</font>Email:</td>
        <td><div id="email"></div></td>
      </tr>     
      <tr>
        <td align="right"><font color="red">*</font>Carnet:</td>
        <td><input type="text" name="carnet" id="carnet" onkeypress="return validarNumero(event)" size="15"></td>
        </tr>
      <tr>
        <td align="right"><font color="red">*</font>Direcci&oacute;n de Hab:</td>
        <td><input type="text" name="direccion" id="direccion" onkeypress="return validarTextoNumero(event)" 
                   size="60" maxlength="100"></td>
        </tr>
      <tr>
        <td align="right" ><font color="red">*</font>Fecha de Nacimiento:</td>
        <td ><input type="text" name="fechaNacimiento" id="fechaNacimiento" class="datepicker" 
                    size="10" maxlength="10" ></td>
        </tr>
      <tr>
        <td align="right" ><font color="red">*</font>Sexo:</td>
        <td ><input type="radio" name="sexo" value="2" id="sexof" />
          Femenino &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
          <input type="radio" name="sexo" value="1" id="sexom" />  Masculino</td>
        </tr>
      <tr>
        <td align="right"><font color="red">*</font>Carrera:</td>
        <td>
        
            <select size="1" style="width:450px; height:20px;" name="carrera" id="carrera" class="carrera">
                    	<option value="">Seleccione</option>
<?Php
	echo _listar_carreras();
?>
		</select>
          

          </td>        
        </tr>
      <tr>
        <td align="right"><font color="red">*</font>Menci&oacute;n:</td>
        <td>
            <select size="1" style="width:450px; height:20px;" name="mencion" id="mencion" class="mencion" >
                <option value="">Seleccione</option>
<?Php
	echo _listar_menciones();
?>
		</select>
      
        </td>
        </tr>
      
      <tr>
        <td align="right" ><font color="red">*</font>Cr&eacute;ditos aprobados:</td>
        <td ><input type="text" name="creditosaprobados" id="creditos_aprobados" 
                    onkeypress="return validarNumero(event)" size="71" placeholder=" DESDE 90 HASTA 102"></td>
        </tr>
      <tr>
        <td align="right" ><font color="red">*</font>IRA:</td>
        <td><input type="text" name="ira" id="indice_academico" onkeypress="return validarIra(event)" 
                   size="71" placeholder=" Indice de Rendimiento Académico"></td>
        </tr>
      <tr> <td align="right"><font color="red">*</font>Turnos:</td>
        <td>
        <select size="1" style="width:450px; height:20px;" name="turno" id="turno"  >
              	<option value="0">Seleccione...</option>
                <?Php echo _listar_turnos(); ?>
	</select>
      
        </td>
        </tr>      
      <tr>
        <td align="right"><font color="red">*</font>Semestre:</td>
        <td><input type="text" name="semestre" id="semestre" onkeypress="return validarNumero(event)"
                   placeholder="Si cursa 5-6"></td>
        </tr>
      <tr>
        <td align="right" ><font color="red">*</font>Tel&eacute;fono Habitación:</td>
        <td ><input type="text" name="telefonohab" id="telefono_habitacion" 
                    onkeypress="return validarNumero(event)"></td>
        </tr>
      <tr>
        <td align="right"><font color="red">*</font>Tel&eacute;fono Celular:</td>
        <td><input type="text" name="telefonocel" id="telefono_celular" 
                   onkeypress="return validarNumero(event)"></td>
        </tr>
      <tr>
        <td align="center" colspan="2"><em>Situaci&oacute;n Laboral</em></td>
        </tr>
      <tr>
        <td align="right"><font color="red">*</font>¿Trabajas?:</td>
        <td ><input type="radio" name="trabajo" value="si" id="empleos" >Si &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="radio" name="trabajo" value="no" id="empleon">No</td>
        </tr>
      <tr>
        <td align="right" >Nombre de la Empresa:</td>
        <td ><input type="text"  name="nombrempresa" id="nombre_empleo"
                    onkeypress="return validarTextoNumero(event)" size="40" /></td>
        </tr>
      <tr>
        <td align="right" >Cargo que ocupa:</td>
        <td ><input type="text" name="cargo" id="cargo_empleo" type="text" 
                    onkeypress="return validarTextoNumero(event)" size="40" /></td>
        </tr>
      <tr>
        <td align="right" >Tel&eacute;fono empleo:</td>
        <td ><input type="text" name="telefonoempleo" id="telefono_empleo" 
                    onkeypress="return validarNumero(event)"></td>
        </tr>
      <tr>
        <td align="right" >E-mail:</td>
        <td ><input type="text" name="emailempleo" id="email_empleo" size="60" 
                    onkeypress="return validarEmail(event)"></td>
        </tr>
      
    </table>
         <br>
        <p align="center">
            <input type="submit" name="btn1" value="Actualizar" id="btnactualizar" />
            <input type="submit" name="btn1"value="Agregar" id="btnagregar" />
        </p>
    	
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
<script language="javascript" type="text/javascript" src="../js/jquery.validate.js"></script>
<script language="javascript" type="text/javascript" src="../js/func_pre.js"></script>
</body>
</html>

