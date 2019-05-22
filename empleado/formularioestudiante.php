<?php
include ("../sesiones.php");
if($_SESSION['nivel']!=$_SESSION['id']){
session_destroy();
echo "FALLA GRAVE AL SISTEMA, PERDISTE LA SESION, PARA REGRESAR AL INICIO REINICIA EL NAVEGADOR";exit();
}
$_SESSION['origen'] = 1;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Estudiante</title>
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
    
        <h2>Gesti&oacute;n Alumnos</h2>
   
    
<?php


            require_once '../Connections/consultas.php';
            $consulta = new Consulta();
            //$sql = "select * from alumno";
            //$resul = $consulta->consultas_bd($sql);

$var="";
$var1="";
$var2="";
$var3="";
$var4="";
$var_h="";
$id="";

if (isset($_POST["btn1"])) {
    $btn = $_POST["btn1"];
    
    if ($btn == "Buscar") {
        $bus = $_POST["txtbus"];
        //$sql = "select * from alumno where cedula_alumno='$bus'";
        $sql = "SELECT * 
                FROM alumno AS al 
                INNER JOIN usuario AS us 
                ON al.id_usuario=us.id_usuario
                WHERE cedula_alumno='".$bus."'";
                
        $cs = $consulta->consultas_bd($sql);
        
        if($cs>0){
            //$cs=mysql_query($sql,$cn);
            while ($resul = mysql_fetch_array($cs)) {
                $var = $resul[0];
                $var1 = $resul[6];
                $var2 = $resul[7];
                $var3 = $resul[26];
                $var4 = $resul[14];
                $var_h = $resul[5];
                $id=$resul["id_alumnos"];
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
        $sql = "insert into alumnos values ('$cod','$nom','$ape','$tel','$sex')";
        $cs = mysql_query($sql, $cn);
        echo "<script> alert('Se insert&oacute; correctamente');</script>";*/        
        
        if (isset($_POST['nombre'])!='' && isset($_POST['apellido'])!='' 
            && isset($_POST['cedula'])!='' && isset($_POST['nombreusuario'])!='' 
            && isset($_POST['clave'])!='' && isset($_POST['reclave'])!='' 
            && isset($_POST['email'])!='' && isset($_POST['id_al'])!=''){
        
            // procesar registro estudiante
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $cedula = $_POST['cedula'];
            $nombreusuario = $_POST['nombreusuario'];
            $clave = $_POST['clave'];
            $reclave = $_POST['reclave'];
            $email = $_POST['email'];        

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
                            $consulta="select * from alumno where cedula_alumno='$cedula'";
                            $resultado1=mysql_query($consulta) or die (mysql_error());
                            if(mysql_num_rows($resultado1)>0){		
                                    echo "<script language=JavaScript>alert('La cedula ya esta registrada en el sistema');window.location='formularioestudiante.php';</script>";
                            }
                            if(mysql_num_rows($resultado1)==0){		
                                    //tabla usuario
                                    $clave = md5($clave);
                                    $fecha = date("Y-n-j H:i:s");
                                    $origen= $_SESSION['origen'];
                                    $sql = "INSERT INTO usuario(id_grupo,login,password,fecha_registro,origen)".""
                                            . "VALUES (1,'$nombreusuario','$clave','$fecha','$origen')";
                                    $result = mysql_query($sql);		
                                    $ultimo_id = mysql_insert_id();	
				    $modu_aud='ALUMNOS';
				    $tabl_aud='usuario';
				    $acci_aud='CREAR';
				    $fech_aud=date('Y/m/d');
				    $hora_aud=date('G:i:s');
			            $usua_aud=$_SESSION['id'];
				    $consulta = "insert into auditoria (modulo,tabla,accion,fecha,hora,user_id)".                         //.
				    "values ('$modu_aud','$tabl_aud','$acci_aud','$fech_aud','$hora_aud','$usua_aud')";
				    mysql_query($consulta) or die (mysql_error());									

                                    //tabla alumno
                                    $sql = "INSERT INTO alumno(id_usuario,cedula_alumno,nombre,apellido,email)"."VALUES ('$ultimo_id','$cedula','$nombre','$apellido','$email')";
                                    $result = mysql_query($sql);

				    $modu_aud='ALUMNOS';
				    $tabl_aud='alumno';
				    $acci_aud='CREAR';
				    $fech_aud=date('Y/m/d');
				    $hora_aud=date('G:i:s');
				    $usua_aud=$_SESSION['id'];
				    $consulta = "insert into auditoria (modulo,tabla,accion,fecha,hora,user_id)".                         //.
				    "values ('$modu_aud','$tabl_aud','$acci_aud','$fech_aud','$hora_aud','$usua_aud')";
				    mysql_query($consulta) or die (mysql_error());									
									
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
            && isset($_POST['email'])!='' && isset($_POST['id_al'])!=''){
                
            // procesar registro estudiante
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $cedula = $_POST['cedula'];
            $nombreusuario = $_POST['nombreusuario'];
            $clave = $_POST['clave'];
            $reclave = $_POST['reclave'];
            $email = $_POST['email'];
            $id_al = $_POST['id_al'];

            if($clave!=$reclave){
                    echo "<script language=JavaScript>alert('la contraseña y la confirmacion no coinciden\\nIntentelo nuevamente');window.location='formularioestudiante.php';</script>";
            } else {
                require_once '../Connections/consultas.php';
                $consulta = new Consulta();

                $sql = "SELECT * 
                                    FROM alumno AS al 
                                    INNER JOIN usuario AS us 
                                    ON al.id_usuario=us.id_usuario
                                    WHERE id_alumnos=$id_al";
                $cs = $consulta->consultas_bd($sql);
                if ($cs > 0) {
                    if ($resul = mysql_fetch_array($cs)) {
                        $id_usu = $resul["id_usuario"];
                    }                                                           
                    
                    $sql_al = "UPDATE alumno 
                                        SET nombre = '$nombre', apellido = '$apellido', 
                                        cedula_alumno= '$cedula', email= '$email'
                                        WHERE id_alumnos=$id_al";
                    $clave = md5($clave);
                    $result1 = mysql_query($sql_al) or die(mysql_error());
                    $sql_usu = "UPDATE usuario 
                                        SET login = '$nombreusuario', password = '$clave'
                                        WHERE id_usuario= '$id_usu'";

                    $result2 = mysql_query($sql_usu) or die(mysql_error());
					
					$modu_aud='ALUMNOS';
					$tabl_aud='alumno';
					$acci_aud='ACTUALIZAR C.I:'.$cedula;
					$fech_aud=date('Y/m/d');
					$hora_aud=date('G:i:s');
					$usua_aud=$_SESSION['id'];
					$consulta = "insert into auditoria (modulo,tabla,accion,fecha,hora,user_id)".                         //.
					"values ('$modu_aud','$tabl_aud','$acci_aud','$fech_aud','$hora_aud','$usua_aud')";
					mysql_query($consulta) or die (mysql_error());													
					
					$modu_aud='ALUMNOS';
					$tabl_aud='usuario';
					$acci_aud='ACTUALIZAR USUARIO:'.$nombreusuario;
					$fech_aud=date('Y/m/d');
					$hora_aud=date('G:i:s');
					$usua_aud=$_SESSION['id'];
					$consulta = "insert into auditoria (modulo,tabla,accion,fecha,hora,user_id)".                         //.
					"values ('$modu_aud','$tabl_aud','$acci_aud','$fech_aud','$hora_aud','$usua_aud')";
					mysql_query($consulta) or die (mysql_error());													

					
                    echo "<script> alert('¡Gracias! Hemos recibido sus datos');</script>";                    
                }
            }
        }       
        
    }//FIN if ($btn == "Actualizar")
}
?>

<form action="" method="post">
<center>
<table>
<tr>
<td>Buscar</td>
<td><input type="text" name="txtbus" placeholder="Ingrese la Cedula" /></td>
<td><input type="submit" name="btn1"  value="Buscar"  /></td>
</tr></table>   
</center>
</form>
      
<form name="form1" id="form1" action="" method="post">  
<fieldset>   
<legend>Crear de Alumno</legend>
<table width="100%" border="1">
    <input type="hidden" name="id_al" value="<?php echo $var_h?>">
		<tr>
                    <td align="right" width="30%"><font color="red">*</font>Nombre(s):</td>
                    <td width="70%"><input type="text" name="nombre" id="nombre" class="mayuscula"
                                           onkeypress="return validarTexto(event)" value="<?php echo $var1?>"></td>
		</tr>
		<tr>
			<td align="right"><font color="red">*</font>Apellido(s):</td>
			<td><input type="text" name="apellido" id="apellido" class="mayuscula"
                                   onkeypress="return validarTexto(event)" value="<?php echo $var2?>"></td>
		</tr>
		<tr>
			<td align="right"><font color="red">*</font>C&eacute;dula de identidad:</td>
			<td><input type="text" name="cedula" id="cedula" 
                                   onkeypress="return validarNumero(event)"maxlength="8" value="<?php echo $var?>"></td>
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
        <p><font color="red">*</font> Campo requerido</p>	
        
<tr align="center"><td colspan="2">
        <input type="submit" name="btn1" value="Actualizar" />        
        <input type="submit" name="btn1" value="Agregar" />  
        <?php
            if (isset($_POST["btn1"])) {
                $btn = $_POST["btn1"];
                if ($btn == "Buscar") {
                    echo "<a href='#nuevo' class='iredit' onClick ='eliminar(".$id.")'>Eliminar</a>";
                }
                
            }
        ?>        
    </td>
</tr>

</table>
</form>
<br>
<center>
    <form action="" method="post" id="form2">
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
                FROM alumno AS al 
                INNER JOIN usuario AS us 
                ON al.id_usuario=us.id_usuario LIMIT 50";       
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
            echo "<td>".$resul["cedula_alumno"]."</td>";
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
<script language="javascript" type="text/javascript" src="../js/jquery-ui-1.10.3.custom.js"></script>
<script language="javascript" type="text/javascript" src="../js/jquery.validate.js"></script>
<script language="javascript" type="text/javascript" src="../js/func_al.js"></script>
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
