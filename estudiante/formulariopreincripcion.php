<?php
include_once ("../sesiones.php");
if($_SESSION['nivel']!=$_SESSION['id']){
session_destroy();
echo "FALLA GRAVE AL SISTEMA, PERDISTE LA SESION, PARA REGRESAR AL INICIO REINICIA EL NAVEGADOR";exit();
}

$ci = $_SESSION['cedula'];
$estatus=0;

include_once '../conexionbd.php';
include_once 'funciones.php';

$consulta = "select * from alumno where cedula_alumno='$ci'";
$resultado = mysql_query($consulta) or die (mysql_error());
if ($fila = mysql_fetch_array($resultado)){
	$estatus = $fila["id_estatus"];
	$nombre = $fila["nombre"];
	$apellido = $fila["apellido"];
	$email = $fila["email"];
	
}

if($estatus==1 || $estatus==2 || $estatus==3 || $estatus==4 || $estatus==5){
	header ("Location: sesionestudiante.php?preinscrito=si");
}

$consulta_cod_lapso="select * from lapso where lapso_habilitado='si'";
$resultado_cod_lapso = mysql_query($consulta_cod_lapso) or die (mysql_error());
if($fila = mysql_fetch_array($resultado_cod_lapso)){
	$idLapso = $fila["id_lapso"];
}
else{	
	header ("Location: sesionestudiante.php?nolapso=si");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Language" content="es"/> 
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
    <?php require_once 'menu_al.php';?>
  <!-- end .sidebar1 --></div>
<div class="well col-md-9 col-lg-9 col-sm-9 col-xs-9" style="margin-left:20px">

      <h2>Formulario de Preinscripci&oacute;n</h2>

      
<form action="almacenapreincripcion.php" method="post" name="form1" id="form1">      
    <table width="100%" border="0">
      <tr>
        <td width="35%" align="right">Nombres y Apellidos:</td>
        <td width="65%"><?php 
                        if(isset($nombre) && isset($apellido)){
                            echo $nombre." ".$apellido;
                        }else{
                            echo "-";
                        }
                        ?></td>
        </tr>
      <tr>
        <td align="right">C&eacute;dula:</td>
        <td><?php 
         if(isset($ci)){
                echo $ci;
            }else{
                echo "-";
            }
            ?></td>
        
        </tr>
      <tr>
        <td align="right">Email:</td>
        <td><?php 
        if(isset($ci)){
                echo $email;
            }else{
                echo "-";
            }
            ?></td>
      </tr>     
      <tr>
        <td align="right">Carnet:</td>
        <td><input type="text" name="carnet" id="carnet" onkeypress="return validarNumero(event)"  
                   value="<?php if(isset($_POST['carnet'])) echo $_POST['carnet']?>" size="15"></td>
        </tr>
      <tr>
        <td align="right">Direcci&oacute;n de Hab:</td>
        <td><input type="text" name="direccion" id="direccion" onkeypress="return validarTextoNumero(event)" 
                   value="<?php if(isset($_POST['direccion'])) echo $_POST['direccion']?>" size="40" maxlength="100"></td>
        </tr>
      <tr>
        <td align="right" >Fecha de Nacimiento:</td>
        <td ><input type="text" name="fechaNacimiento" id="fechaNacimiento" 
                    value="<?php if(isset($_POST['fechaNacimiento'])) echo $_POST['fechaNacimiento']?>" 
                    size="10" maxlength="10" class="datepicker"></td>
        </tr>
      <tr>
        <td align="right" >Sexo:</td>
        <td ><input type="radio" name="sexo" value="2" />
          Femenino &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
          <input type="radio" name="sexo" value="1" /> Masculino</td>
        </tr>
      <tr>
        <td align="right">Carrera:</td>
        <td>
        
            <select size="1" name="carrera" id="carrera" class="carrera" >
                    	<option value="">Seleccione</option>
<?Php
	echo _listar_carreras();
?>
		</select>
          

          </td>        
        </tr>
      <tr>
        <td align="right">Menci&oacute;n:</td>
        <td>
            <select size="1" name="mencion" id="mencion" class="mencion" >
                    	<option value="">Seleccione</option>
<?Php
	echo _listar_menciones();
?>
		</select>
      
        </td>
        </tr>
      
      <tr>
        <td align="right" >Cr&eacute;ditos aprobados:</td>
        <td ><input type="text" name="creditosaprobados" id="creditosaprobados" onkeypress="return validarNumero(event)" 
                    value="<?php if(isset($_POST['creditosaprobados'])) echo $_POST['creditosaprobados']?>" size="71" placeholder=" DESDE 90 HASTA 102"></td>
        </tr>
      <tr>
        <td align="right" >IRA:</td>
        <td><input type="text" name="ira" id="indice_academico" onkeypress="return validarIra(event)" 
                   value="<?php if(isset($_POST['ira'])) echo $_POST['ira']?>" size="71" 
                   placeholder=" Indice de Rendimiento Académico Debe ser MAyor a 14"></td>
        </tr>
      <tr> <td align="right">Turnos:</td>
        <td>
        <select size="1" style="width:450px; height:20px;" name="turno" id="turno"  >
                    	<option value="0">Seleccione Turno</option>
<?Php
	echo _listar_turnos();
?>
		</select>
      
        </td>
        </tr>      
      <tr>
        <!--<td align="right">Semestre:</td>-->
        <td align="right">Trimestre:</td>
        <td><input type="text" name="semestre" id="semestre" onkeypress="return validarNumero(event)" 
                   value="<?php if(isset($_POST['semestre'])) echo $_POST['semestre']?>"  placeholder="DEL 5 al 6"></td>
        </tr>
      <tr>
        <td align="right" >Tel&eacute;fono Habitación:</td>
        <td ><input type="text" name="telefonohab" id="telefono_habitacion" onkeypress="return validarNumero(event)" 
                    value="<?php if(isset($_POST['telefonohab'])) echo $_POST['telefonohab']?>"></td>
        </tr>
      <tr>
        <td align="right">Tel&eacute;fono Celular:</td>
        <td><input type="text" name="telefonocel" id="telefono_celular" onkeypress="return validarNumero(event)" 
                   value="<?php if(isset($_POST['telefonocel'])) echo $_POST['telefonocel']?>"></td>
        </tr>
      <tr>
        <td align="center" colspan="2"><em>Situaci&oacute;n Laboral</em></td>
        </tr>
      <tr>
        <td align="right">¿Trabajas?:</td>
        <td ><input type="radio" name="trabajo" id="empleos" value="si">Si &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="radio" name="trabajo" id="emplon" value="no">No</td>
        </tr>
      <tr>
        <td align="right" >Nombre de la Empresa:</td>
        <td ><input type="text" name="nombrempresa" id="nombre_empleo" onkeypress="return validarTextoNumero(event)" 
                    value="<?php if(isset($_POST['nombrempresa'])) echo $_POST['nombrempresa']?>" size="40" /></td>
        </tr>
      <tr>
        <td align="right" >Cargo que ocupa:</td>
        <td ><input type="text" name="cargo" id="cargo_empleo" onkeypress="return validarTextoNumero(event)" 
                    value="<?php if(isset($_POST['cargo'])) echo $_POST['cargo']?>" size="40" /></td>
        </tr>
      <tr>
        <td align="right" >Tel&eacute;fono empleo:</td>
        <td ><input type="text" name="telefonoempleo" id="telefono_empleo" onkeypress="return validarNumero(event)" 
                    value="<?php if(isset($_POST['telefonoempleo'])) echo $_POST['telefonoempleo']?>" /></td>
        </tr>
      <tr>
        <td align="right" >E-mail:</td>
        <td ><input type="text" name="emailempleo" id="email_empleo" onkeypress="return validarEmail(event)" 
                    value="<?php if(isset($_POST['emailempleo'])) echo $_POST['emailempleo']?>" /></td>
        </tr>
      <tr>
        <td align="right"><input type="reset" name="limpiar" value="Limpiar"/></td>
        <td align="center"><input type="submit" name="enviar" value="Aceptar" /><!--onclick="validarpreincrip(this.form)"--></td>
        </tr>
    </table>
	<input type="hidden" name="idLapso" value="<?php echo $idLapso; ?>" />
    </form>    
    <p>&nbsp;</p>
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
<script language="javascript" type="text/javascript" src="js/func_pre.js"></script>
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
function validarIra(e) { 
    tecla = (document.all) ? e.keyCode : e.which; 
    if (tecla==8) return true; 
    patron = /\d|(\W?[^\][\\}{\+\*\?\/\-\_\¨`´:;çÇ¿¡'=()&%$·"!ªº|@#~½¬ a-zA-Z])/; 
    te = String.fromCharCode(tecla); 
    return patron.test(te);
}
</script>
</body>
</html>
