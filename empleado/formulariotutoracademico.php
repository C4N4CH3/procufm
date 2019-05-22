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
<title>Tutor Academico</title>
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

    <blockquote>
        <h2>Gesti&oacute;n Tutor Acad&eacute;mico</h2>
    </blockquote> 
    
<?php


            require_once '../Connections/consultas.php';
            $consulta = new Consulta();
            //$sql = "select * from tutor_academico";
            //$resul = $consulta->consultas_bd($sql);

$var="";
$var1="";
$var2="";
$var3="";
$var4="";
$var5="";
$var6="";
$var7="";
$var8="";
$var_id="";

if (isset($_POST["btn1"])) {
    $btn = $_POST["btn1"];
    
    if ($btn == "Buscar") {
        $bus = $_POST["txtbus"];
        //$sql = "select * from tutor_academico where cedula_tutor_academico='$bus'";
        $sql = "SELECT * 
                FROM tutor_academico AS al 
                INNER JOIN usuario AS us 
                ON al.id_usuario=us.id_usuario
                WHERE cedula='".$bus."'";                
        $cs = $consulta->consultas_bd($sql);        
        if($cs>0){
            //$cs=mysql_query($sql,$cn);
            while ($resul = mysql_fetch_array($cs)) {
                $var = $resul["nombre"];
                $var1 = $resul["apellido"];
                $var2 = $resul["cedula"];
                $var3 = $resul["login"];
                $var4 = $resul["id_carrera"];
                $var5 = $resul["id_mencion"];
                $var6 = $resul["area_trabajo"];
                $var7 = $resul["telefono"];
                $var8 = $resul["email"];
                $var_id = $resul["id_tutor"];
            }
        }else{            
            echo "no hay registros";
        }       
    }    
     
    if ($btn == "Agregar") {
        /*$cod = $_POST["nombre"];
        $nom = $_POST["apellido"];
        $ape = $_POST["cedula"];
        $tel = $_POST["nombreusuario"];
        $sex = $_POST["cbosex"];
        $sql = "insert into tutor_academicos values ('$cod','$nom','$ape','$tel','$sex')";
        $cs = mysql_query($sql, $cn);
        echo "<script> alert('Se insert&oacute; correctamente');</script>";*/        
        
       if (!empty($_POST['nombre']) && !empty($_POST['apellido']) 
            && !empty($_POST['cedula']) && !empty($_POST['nombreusuario']) 
            && !empty($_POST['clave']) && !empty($_POST['reclave']) 
            && !empty($_POST['carrera']) && !empty($_POST['mencion'])
            && !empty($_POST['area_trabajo']) && !empty($_POST['telefono'])
            && !empty($_POST['email'])){
        
             // procesar registro estudiante
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $cedula = $_POST['cedula'];
            $nombreusuario = $_POST['nombreusuario'];            
            $carrera = $_POST['carrera'];
            $mencion = $_POST['mencion'];            
            $area_trabajo = $_POST['area_trabajo'];
            $telefono = $_POST['telefono'];            
            $clave = $_POST['clave'];
            $reclave = $_POST['reclave'];
            $email = $_POST['email'];
            $id_tutor = $_POST['id_tutor'];       

            if($clave!=$reclave){
                    echo "<script language=JavaScript>alert('la contraseña y la confirmacion no coinciden\\nIntentelo nuevamente');window.location='formularioestudiante.php';</script>";
            }else{
                    include_once("../conexionbd.php");
                    $consulta="select * from usuario where login='$nombreusuario'";
                    $resultado=mysql_query($consulta) or die (mysql_error());
                    if (mysql_num_rows($resultado)>0)
                    {
                            echo "<script language=JavaScript>alert('El nombre usuario ya esta en uso\\nPor favor elija otro');window.location='formularioestudiante.php';</script>";	
                    } 
                    if(mysql_num_rows($resultado)==0){	
                            $consulta="select * from tutor_academico where cedula='$cedula'";
                            $resultado1=mysql_query($consulta) or die (mysql_error());
                            if(mysql_num_rows($resultado1)>0){		
                                    echo "<script language=JavaScript>alert('La cedula ya esta registrada en el sistema');window.location='formularioestudiante.php';</script>";
                            }
                            if(mysql_num_rows($resultado1)==0){		
                                    //tabla usuario
                                    $clave = md5($clave);
                                    $fecha = date("Y-n-j H:i:s");
                                    $sql = "INSERT INTO usuario(id_grupo,login,password,fecha_registro)"."VALUES (5,'$nombreusuario','$clave','$fecha')";
                                    $result = mysql_query($sql);		
                                    $ultimo_id = mysql_insert_id();			

                                    //tabla tutor_academico
                                    $sql = "INSERT INTO tutor_academico
                                                (id_usuario,cedula,nombre,apellido,
                                                email, area_trabajo, telefono, id_carrera,
                                                id_mencion, cantidad_asignacion_alum, habilitado)
                                            VALUES ('$ultimo_id','$cedula','$nombre',
                                                '$apellido','$email','$area_trabajo','$telefono',
                                                $carrera, $mencion,0,'si')";
                                    $result = mysql_query($sql);		
                                    mysql_close($link);
                                    echo "<script> alert('¡Gracias! Hemos recibido sus datos');</script>";                                
                            }
                    }	
            }
        }else{
            echo "<p>Disculpe Existen campos en blancos. Por favor intente de nuevo</p>";
        }  
    }
    if ($btn == "Actualizar") {
        
        if (!empty($_POST['nombre']) && !empty($_POST['apellido']) 
            && !empty($_POST['cedula']) && !empty($_POST['nombreusuario']) 
            && !empty($_POST['clave']) && !empty($_POST['reclave']) 
            && !empty($_POST['carrera']) && !empty($_POST['mencion'])
            && !empty($_POST['area_trabajo']) && !empty($_POST['telefono'])
            && !empty($_POST['email']) && !empty($_POST['id_tutor'])){
                        
            // procesar registro estudiante
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $cedula = $_POST['cedula'];
            $nombreusuario = $_POST['nombreusuario'];            
            $carrera = $_POST['carrera'];
            $mencion = $_POST['mencion'];            
            $area_trabajo = $_POST['area_trabajo'];
            $telefono = $_POST['telefono'];            
            $clave = $_POST['clave'];
            $reclave = $_POST['reclave'];
            $email = $_POST['email'];
            $id_tutor = $_POST['id_tutor'];

            if($clave!=$reclave){
                    echo "<script language=JavaScript>alert('la contraseña y la confirmacion no coinciden\\nIntentelo nuevamente');window.location='formularioestudiante.php';</script>";
            } else {
                require_once '../Connections/consultas.php';
                $consulta = new Consulta();

                $sql = "SELECT * 
                                    FROM tutor_academico AS al 
                                    INNER JOIN usuario AS us 
                                    ON al.id_usuario=us.id_usuario
                                    WHERE id_tutor=$id_tutor";
                $cs = $consulta->consultas_bd($sql);
                if ($cs > 0) {
                    if ($resul = mysql_fetch_array($cs)) {
                        $id_usu = $resul["id_usuario"];
                    }                                                           
                    
                    $sql_al = "UPDATE tutor_academico 
                                        SET nombre = '$nombre', apellido = '$apellido', 
                                        cedula= '$cedula', id_carrera=$carrera, id_mencion=$mencion,
                                        area_trabajo='$area_trabajo', telefono='$telefono', email= '$email'
                                        WHERE id_tutor=$id_tutor";
                    $clave = md5($clave);
                    $result1 = mysql_query($sql_al) or die(mysql_error());
                    $sql_usu = "UPDATE usuario 
                                        SET login = '$nombreusuario', password = '$clave'
                                        WHERE id_usuario=$id_usu";

                    $result2 = mysql_query($sql_usu) or die(mysql_error());
                    echo "<script> alert('¡Gracias! Hemos recibido sus datos');</script>";                    
                }
            }
        }else{
            echo "<p>Disculpe Existen campos en blancos. Por favor intente de nuevo</p>";
        }        
        
    }//FIN if ($btn == "Actualizar")
}
?>

<form name="form2" action="" method="post">
<center>
<table>
<tr>
<td>Buscar</td>
<td><input type="text" name="txtbus" placeholder="Ingrese la Cedula" /></td>
<td><input type="submit" name="btn1"  value="Buscar" id="btnbus" /></td>
</tr></table>   
</center>
</form>
<form name="form1" action="" id="form1" method="post">    
<fieldset>   
<legend>Crear de Tutor Académico</legend>
<table width="100%" border="1">
    <input type="hidden" name="id_tutor" value="<?php echo $var_id ?>">
        <tr>
            <td align="right" width="40%"><font color="red">*</font>Nombre(s):</td>
            <td width="60%"><input type="text" name="nombre" id="nombre" class="mayuscula"
                                   onkeypress="return validarTexto(event)" value="<?php echo $var ?>"></td>
        </tr>
        <tr>
            <td align="right"><font color="red">*</font>Apellido(s):</td>
            <td><input type="text" name="apellido" id="apellido" class="mayuscula"
                       onkeypress="return validarTexto(event)" value="<?php echo $var1 ?>"></td>
        </tr>
        <tr>
            <td align="right"><font color="red">*</font>C&eacute;dula de identidad:</td>
            <td><input type="text" name="cedula" id="cedula" 
                       onkeypress="return validarNumero(event)" maxlength="8" value="<?php echo $var2 ?>"></td>
        </tr>
        <tr>
            <td align="right"><font color="red">*</font>Nombre de usuario:</td>
            <td><input type="text" name="nombreusuario" id="nombreusuario"
                       onkeypress="return validarTextoNumero(event)" value="<?php echo $var3 ?>">
                        <span id="info"></span>
            </td>
        </tr>

        <tr>
            <td align="right"><font color="red">*</font>Carrera:</td>
            <td>

                <select size="1" name="carrera" id="carrera" class="carrera">
                    <option value="">Seleccione</option>
                    <?Php
                    echo _listar_carreras($var4);
                    ?>
                </select>


            </td>        
        </tr>
        <tr>
            <td align="right"><font color="red">*</font>Menci&oacute;n:</td>
            <td>
                <select size="1" name="mencion" id="mencion" class="mencion">
                    <option value="">Seleccione</option>
                    <?Php
                    echo _listar_menciones($var5);
                    ?>
                </select>

            </td>
        </tr>

        <tr>
            <td align="right"><font color="red">*</font>Area de Trabajo:</td> 
            <td><input type="text" name="area_trabajo" id="area_trabajo" class="mayuscula"
                       onkeypress="return validarTexto(event)" value="<?php echo $var6 ?>"></td>
        </tr>
        
        <tr>
        <td align="right" ><font color="red">*</font>Tel&eacute;fono:</td>
        <td ><input type="text" name="telefono" id="telefono" 
                    onkeypress="return validarNumero(event)" value="<?php echo $var7 ?>"></td>
        </tr>
        
        <tr>
            <td align="right"><font color="red">*</font>Correo electr&oacute;nico:</td>
            <td><input type="text" name="email" id="email" class="mayuscula"
                       onkeypress="return validarEmail(event)" value="<?php echo $var8 ?>"></td>
        </tr>
        <tr>
            <td align="right"><font color="red">*</font>Contraseña:</td>
            <td><input type="password" name="clave" id="clave" 
                       onkeypress="return validarTextoNumero(event)"></td>
        </tr>	
        <tr>
            <td align="right"><font color="red">*</font>Confirmar contraseña:</td>
            <td><input type="password" name="reclave" id="reclave" 
                       onkeypress="return validarTextoNumero(event)"></td>
        </tr>

        <tr align="center"><td colspan="2">
                <input type="submit" name="btn1" value="Actualizar" id="ac" />
                <input type="submit" name="btn1"value="Agregar" id="ag" />
                <?php
                if (isset($_POST["btn1"])) {
                    $btn = $_POST["btn1"];
                    if ($btn == "Buscar") {
                        echo "<a href='#nuevo' class='iredit' onClick ='eliminar(" . $var_id . ")'>Eliminar</a>";
                    }
                }
                ?>  
            </td>
        </tr>
<p><font color="red">*</font> Campo requerido</p>
</table>
</form>
<br>
<form action="" method="post">
<center>
<table>
    <tr align="center">
        <td>Ver todos los Registros: <input type="submit" name="btn1" value="Listar"/></td>
    </tr>   
</table>
</center>
</fieldset>
</form>
<br />
<hr>
<br />


<?php
if (isset($_POST["btn1"])) {
    $btn = $_POST["btn1"];

    if ($btn == "Listar") {
        require_once '../Connections/consultas.php';
        $consulta = new Consulta();      
        $sql = "SELECT * 
                FROM ((tutor_academico AS al 
                INNER JOIN usuario AS us 
                ON al.id_usuario=us.id_usuario)
                INNER JOIN carreras as car
                ON al.id_carrera=car.id_carrera)
                INNER JOIN menciones as men
                ON al.id_mencion=men.id_mencion";       
        $cs = $consulta->consultas_bd($sql);
        //$cs = mysql_query($sql, $cn);
        echo"<center>
            <br>REGISTROS<br>
<table border='1' width='100%' id='mi_tabla'>
<thead>
<tr>
    <th colspan='6' align='right'><input type='text' id='filtrar' /></th>
</tr>
<tr>
<th>Nombre</th>
<th>Apellido</th>
<th>Cedula</th>
<th>Usuario</th>
<th>Carrera</th>
<th>Mencion</th>
</tr>
</thead>";
        echo "<tbody>";
        while ($resul = mysql_fetch_array($cs)) {
            echo "<tr>";
            echo "<td>".$resul["nombre"]."</td>";
            echo "<td>".$resul["apellido"]."</td>";
            echo "<td>".$resul["cedula"]."</td>";
            echo "<td>".$resul["login"]."</td>";
            echo "<td>".utf8_encode($resul["nombre_carrera"])."</td>";
            echo "<td>".utf8_encode($resul["nombre_mencion"])."</td>";
            echo "</tr>";
        }
         echo "</tbody>";
        echo "</table>
</center>";
    }
}
?>         
    <!-- end .content -->
</div>
<?php include_once '../footer.php';?>

<script type="text/javascript" src="../js/1.11.1/jquery.min.js"></script>
<script src="../js/bootstrap/3.3.0/bootstrap.min.js"></script>
<script src="../js/material/material.min.js"></script>
<script src="../js/material/ripples.min.js"></script>
<script>
      $.material.init();
</script>
<script language="javascript" src="../funciones.js"></script>
<script language="javascript" type="text/javascript" src="../js/jquery-ui-1.10.3.custom.min.js"></script>
<script language="javascript" type="text/javascript" src="../js/jquery.validate.js"></script>
<script language="javascript" type="text/javascript" src="../js/func_tu.js"></script>
<script language="javascript" type="text/javascript" src="js/func_gen_reg.js"></script>
<script type="text/javascript">
//valida solo texto
function validarTexto(e) { 
    tecla = (document.all) ? e.keyCode : e.which; 
    if ( (tecla==8) || (tecla==9) || (tecla==32))
	{
		return true;
	}
    patron = /(\W?[^\][\\}{\+\*\?\/\_\-\.\¨`´:;,çÇ¿¡'=()&%$·"!ªº|@#~½¬ 0-9])/;
    te = String.fromCharCode(tecla); 
    return patron.test(te);
}
//valida texto y numeros
function validarTextoNumero(e) { 	
	tecla = (document.all)?e.keyCode:e.which;
	if ( (tecla==8) || (tecla==9))
	{
		return true;
	}
	patron = /\d|(\W?[^\][\\}{\+\*\?\¨`´:;,çÇ¿¡'=()&%$·"!ªº|@#~½¬])/;
	te = String.fromCharCode(tecla);
	return patron.test(te);
}

function validarNumero(e) { 
    tecla = (document.all) ? e.keyCode : e.which; 
    if ( (tecla==8) || (tecla==9))
	{
		return true;
	} 
    patron = /\d|(\W?[^\.\][\\}{\+\*\?\/\_\-\¨`´:;,çÇ¿¡'=()&%$·"!ªº|@#~½¬a-zA-Z Ññ])/; 
    te = String.fromCharCode(tecla); 
    return patron.test(te);
}
function validarEmail(e) { 
    tecla = (document.all) ? e.keyCode : e.which; 
    if ( (tecla==8) || (tecla==9) )
	{
		return true;
	} 
    patron = /\d|(\W?[^\][\\}{\+\*\?\/\¨`´:;,çÇ¿¡'%=()&%$·"!ªº|#~½¬])/; 
    te = String.fromCharCode(tecla); 
    return patron.test(te);
}
</script> 
</body>
</html>
