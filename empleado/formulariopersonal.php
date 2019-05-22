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
<title>Personal</title>
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
    
        <h2>Gesti&oacute;n Personal</h2>
    
    
<?php

$var="";
$var1="";
$var2="";
$var3="";
$var4="";
$var5="";
$var_h="";

if (isset($_POST["btn1"])) {
    $btn = $_POST["btn1"];
    
    if ($btn == "Buscar") {
        $bus = $_POST["txtbus"];
        require_once '../Connections/consultas.php';
        $consulta = new Consulta();
        //$sql = "select * from departamento where cedula_departamento='$bus'";
        $sql = "SELECT * 
                FROM departamento AS dep 
                INNER JOIN usuario AS us 
                ON dep.id_usuario=us.id_usuario
                WHERE cedula_departamento='".$bus."'";
                
        $cs = $consulta->consultas_bd($sql);
        
        if($cs>0){
            while ($resul = mysql_fetch_array($cs)) {
                $var = $resul["nombre"];
                $var1 = $resul["apellido"];
                $var2 = $resul["cedula_departamento"];
                $var3 = $resul["login"];
                $var4 = $resul["email"];
                $var5 = $resul["cargo"];
                $var_h = $resul["id_departamento"];
            }
        }else{            
            echo "no hay registros";
        }       
    }    
     
    if ($btn == "Agregar") {
        if (isset($_POST['nombre'])!='' && isset($_POST['apellido'])!='' 
            && isset($_POST['cedula'])!='' && isset($_POST['nombreusuario'])!='' 
            && isset($_POST['clave'])!='' && isset($_POST['reclave'])!='' 
            && isset($_POST['email'])!='' && isset($_POST['id_p'])!=''){
        
            // procesar registro estudiante
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $cedula = $_POST['cedula'];
            $nombreusuario = $_POST['nombreusuario'];
            $clave = $_POST['clave'];
            $reclave = $_POST['reclave'];
            $email = $_POST['email'];  
            $cargo = $_POST['cargo'];

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
                            $consulta="select * from departamento where cedula_departamento='$cedula'";
                            $resultado1=mysql_query($consulta) or die (mysql_error());
                            if(mysql_num_rows($resultado1)>0){		
                                    echo "<script language=JavaScript>alert('La cedula ya esta registrada en el sistema');window.location='formularioestudiante.php';</script>";
                            }
                            if(mysql_num_rows($resultado1)==0){		
                                    //tabla usuario
                                    $clave = md5($clave);
                                    $fecha = date("Y-n-j H:i:s");
                                    $sql = "INSERT INTO usuario(id_grupo,login,password,fecha_registro)".
                                            "VALUES (2,'$nombreusuario','$clave','$fecha')";
                                    $result = mysql_query($sql);		
                                    $ultimo_id = mysql_insert_id();			

                                    //tabla departamento
                                    $sql = "INSERT INTO departamento(id_usuario,cedula_departamento,nombre,apellido,email,cargo)"."VALUES ('$ultimo_id','$cedula','$nombre','$apellido','$email','$cargo')";
                                    $result = mysql_query($sql);		
                                    mysql_close($link);
                                    echo "<script> alert('¡Gracias! Hemos recibido sus datos');</script>";                                
                            }
                    }	
            }
        }
    }
    if ($btn == "Actualizar") {
        
        if (isset($_POST['nombre'])!='' && isset($_POST['apellido'])!='' 
            && isset($_POST['cedula'])!='' && isset($_POST['nombreusuario'])!='' 
            && isset($_POST['clave'])!='' && isset($_POST['reclave'])!='' 
            && isset($_POST['email'])!='' && isset($_POST['id_p'])!=''){
                
            
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $cedula = $_POST['cedula'];
            $nombreusuario = $_POST['nombreusuario'];
            $clave = $_POST['clave'];
            $reclave = $_POST['reclave'];
            $email = $_POST['email'];
            $cargo = $_POST['cargo'];
            $id_p = $_POST['id_p'];

            if($clave!=$reclave){
                    echo "<script language=JavaScript>alert('la contraseña y la confirmacion no coinciden\\nIntentelo nuevamente');window.location='formularioestudiante.php';</script>";
            } else {
                require_once '../Connections/consultas.php';
                $consulta = new Consulta();

                $sql = "SELECT * 
                                    FROM departamento AS al 
                                    INNER JOIN usuario AS us 
                                    ON al.id_usuario=us.id_usuario
                                    WHERE id_departamento=$id_p";
                $cs = $consulta->consultas_bd($sql);
                if ($cs > 0) {
                    if ($resul = mysql_fetch_array($cs)) {
                        $id_usu = $resul["id_usuario"];
                    }                                                           
                    
                    $sql_al = "UPDATE departamento 
                                        SET nombre = '$nombre', apellido = '$apellido', 
                                        cedula_departamento= '$cedula', email= '$email',cargo='$cargo'
                                        WHERE id_departamento= $id_p";

                    $result1 = mysql_query($sql_al) or die(mysql_error());
                    $clave = md5($clave);
                    $sql_usu = "UPDATE usuario 
                                        SET login = '$nombreusuario', password = '$clave'
                                        WHERE id_usuario=$id_usu";

                    $result2 = mysql_query($sql_usu) or die(mysql_error());
                    if($result1 && $result2){
                        echo "<script> alert('¡Gracias! Hemos recibido sus datos');</script>";
                    }
                }
            }
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
<td><input type="submit" name="btn1"  value="Buscar" /></td>
</tr></table>   
</center>
</form>
      
<form name="form1" id="form1" action="" method="post">    
<fieldset>   
<legend>Crear de Personal</legend>
<table width="100%" border="1">
    <input type="hidden" name="id_p" value="<?php echo $var_h?>">
		<tr>
                    <td align="right" width="40%"><font color="red">*</font>Nombre(s):</td>
                    <td width="60%"><input type="text" name="nombre" id="nombre" class="mayuscula"
                                           onkeypress="return validarTexto(event)" value="<?php echo $var?>"></td>
		</tr>
		<tr>
			<td align="right"><font color="red">*</font>Apellido(s):</td>
			<td><input type="text" name="apellido" id="apellido" class="mayuscula"
                                   onkeypress="return validarTexto(event)" value="<?php echo $var1?>"></td>
		</tr>
		<tr>
			<td align="right"><font color="red">*</font>C&eacute;dula de identidad:</td>
			<td><input type="text" name="cedula" id="cedula"
                                   onkeypress="return validarNumero(event)" maxlength="8" value="<?php echo $var2?>"></td>
		</tr>
		<tr>
			<td align="right"><font color="red">*</font>Nombre de usuario:</td>
			<td><input type="text" name="nombreusuario" id="nombreusuario"
                                   onkeypress="return validarTextoNumero(event)" value="<?php echo $var3?>">
                                <span id="info"></span>
                </td>
		</tr>
                <tr>
			<td align="right"><font color="red">*</font>Correo electr&oacute;nico:</td>
			<td><input type="text" name="email" id="email" class="mayuscula"
                                   onkeypress="return validarEmail(event)" value="<?php echo $var4?>"></td>
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
                
                <tr>
			<td align="right"><font color="red">*</font>Cargo:</td>
			<td><input type="text" name="cargo" id="cargo"
                                   onkeypress="return validarTextoNumero(event)" value="<?php echo $var5?>"></td>
		</tr>
<p><font color="red">*</font> Campo requerido</p>
<tr align="center"><td colspan="2">
        <input type="submit" name="btn1" value="Actualizar"/>
        <input type="submit" name="btn1"value="Agregar"/>
        <?php
            if (isset($_POST["btn1"])) {
                $btn = $_POST["btn1"];
                if ($btn == "Buscar") {
                    echo "<a href='#nuevo' class='iredit' onClick ='eliminar(".$var_h.")'>Eliminar</a>";
                }
                
            }
        ?>          
    </td>
</tr>
</table>
</form>
<br>
<form name="form2" action="" method="post">
<center>
<table>
<tr align="center">
    <td>Ver todos los Registros:<input type="submit" name="btn1" value="Listar"/></td>
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
                FROM departamento AS dep 
                INNER JOIN usuario AS us 
                ON dep.id_usuario=us.id_usuario LIMIT 50";       
        $cs = $consulta->consultas_bd($sql);
        //$cs = mysql_query($sql, $cn);
        echo"<center>
            <br>REGISTROS<br>
<table border='1' width='100%' id='mi_tabla'>
<thead>
<tr>
    <th colspan='5' align='right'><input type='text' id='filtrar' /></th>
</tr>
<tr>
<th>Nombre</th>
<th>Apellido</th>
<th>Cedula</th>
<th>Usuario</th>
<th>Correo</th>
</tr>
</thead>";
        echo "<tbody>";
        while ($resul = mysql_fetch_array($cs)) {
            echo "<tr>";
            echo "<td>".$resul["nombre"]."</td>";
            echo "<td>".$resul["apellido"]."</td>";
            echo "<td>".$resul["cedula_departamento"]."</td>";
            echo "<td>".$resul["login"]."</td>";
            echo "<td>".$resul["email"]."</td>";
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
  <script language="javascript" src="../funciones.js"></script>
<script type="text/javascript" src="../js/1.11.1/jquery.min.js"></script>
    <script src="../js/bootstrap/3.3.0/bootstrap.min.js"></script>
    <script src="../js/material/material.min.js"></script>
    <script src="../js/material/ripples.min.js"></script>
    <script>
      $.material.init();
    </script>
<script language="javascript" type="text/javascript" src="../js/jquery-ui-1.10.3.custom.min.js"></script>
<script language="javascript" type="text/javascript" src="../js/jquery.validate.js"></script>
<script language="javascript" type="text/javascript" src="../js/func_pers.js"></script>
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
