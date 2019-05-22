<?php
include ("../sesiones.php");
if($_SESSION['nivel']!=$_SESSION['id']){
session_destroy();
echo "FALLA GRAVE AL SISTEMA, PERDISTE LA SESION, PARA REGRESAR AL INICIO REINICIA EL NAVEGADOR";exit();
}
include ("funciones.php");

?>  
  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title> Alumnos Inscritos </title>
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
  <!-- end .sidebar1 -->
 </div>
 <div class="well col-md-9 col-lg-9 col-sm-9 col-xs-9" style="margin-left:20px">
  <blockquote>
    <h2>Nueva Preinscripción</h2>
  </blockquote>
<p align="justify"> ingrese todos los datos de la nueva preincripcion.</p>
<p>


<?Php
/*****************MÓDULO PREINSCRIPCION*******************************/

	?>
    <form action="nueva_preinscripcion_admin_conex.php" method="post" >
	<table width="100%" border="1"><!-- asiganr clase a la tabla-->
      <tr>
        <td width="35%" align="right">Nombres:
        </td>
        <td width="65%">
        	<input type="text"  size="80" name="nombre"  />
		</td>
    </tr>
    <tr>
        <td width="35%" align="right">Apellidos:
        </td>
        <td width="65%">
        	<input type="text"size="80" name="apellido" />
		</td>
    </tr>
	<tr>
        <td align="right">
        	C&eacute;dula:
       </td>
       <td>
        	<input type="text" size="80" name="cedulaAl"  />
        </td>
	</tr>
	<tr>
        <td align="right">
        	Email:
        </td>
        <td>
			<input type="text"  size="80" name="email"  />
		</td>
	</tr>
	<tr>
        <td align="right">
        	Carnet:
        </td>
        <td>
        	<input name="carnet" onkeypress="return validarNumero(event)" type="text"  size="80">
        </td>
    </tr>
    <tr>
        <td align="right">
        	Direcci&oacute;n de Hab:
        </td>
        <td>
        	<input name="direccion" onkeypress="return validarTextoNumero(event)" type="text" size="80" maxlength="100">
        </td>
    </tr>
    <tr>
        <td align="right" >
        	Fecha de Nacimiento:
        </td>
        <td>
        	<input name="fechaNacimiento" type="text" id="dateArrival"  size="80" maxlength="10" onClick="popUpCalendar(this, form.dateArrival, 'yyyy-mm-dd');">
       </td>
   </tr>
   <tr>
        <td align="right" >Sexo:</td>
        <td >
        	<select size="1" style="width:500px; height:20px;" name="sexo" id="sexo"  >
                    	<option value="<?php echo $id_sexo; ?>"><?Php echo $descripcion_sexo; ?></option>
						<?Php
                            echo _listar_sexos();
                        ?>
		</select>
         </td>
    </tr>
    <tr>
        <td align="right">Carrera:</td>
        <td>
        
        <select size="1" style="width:500px; height:20px;" name="carreras" id="carreras"  >
                    	<option value="<?php echo $carrera; ?>"><?php echo utf8_encode($nombre_carrera); ?></option>
<?Php
	echo _listar_carreras();
?>
		</select>
          

          </td>        
        </tr>
      <tr>
        <td align="right">Menci&oacute;n:</td>
        <td>
        <select size="1" style="width:500px; height:20px;" name="menciones" id="menciones"  >
                    	<option value="<?php echo $mencion; ?>"><?php echo utf8_encode($nombre_mencion); ?></option>
<?Php
	echo _listar_menciones();
?>
		</select>
      
        </td>
        </tr>
      
      <tr>
        <td align="right" >Cr&eacute;ditos aprobados:</td>
        <td ><input name="creditosaprobados" onkeypress="return validarNumero(event)" type="text" size="80"></td>
        </tr>
      <tr>
        <td align="right" >IRA:</td>
        <td><input name="ira" type="text" onkeypress="return validarIra(event)" size="80"></td>
        </tr>
      <tr> <td align="right">Turnos:</td>
        <td>
        <select size="1" style="width:500px; height:20px;" name="turnos" id="turnos"  >
                    	<option value="<?php  echo $id_turno;?>"><?php  echo $nombre_turno;?></option>
<?Php
	echo _listar_turnos();
?>
		</select>
      
        </td>
        </tr>      
      <tr>
        <td align="right">Trimestre:</td>
        <td><input type="text" name="semestre" onkeypress="return validarNumero(event)" /></td>
        </tr>
      <tr>
        <td align="right" >Tel&eacute;fono Habitación:</td>
        <td ><input type="text" name="telefonohab" onkeypress="return validarNumero(event)" /></td>
        </tr>
      <tr>
        <td align="right">Tel&eacute;fono Celular:</td>
        <td><input type="text" name="telefonocel" onkeypress="return validarNumero(event)" /></td>
        </tr>
      <tr>
        <td align="center" colspan="2"><em>Situaci&oacute;n Laboral</em></td>
        </tr>
      <tr>
        <td align="right">¿Trabajas?:</td>
        <td ><input type="radio" name="trabajo" value="1">Si &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <input type="radio" name="trabajo" value="0">No</td>
        </tr>
      <tr>
        <td align="right" >Nombre de la Empresa:</td>
        <td ><input name="nombrempresa" onkeypress="return validarTextoNumero(event)" type="text"  size="40" /></td>
        </tr>
      <tr>
        <td align="right" >Cargo que ocupa:</td>
        <td ><input name="cargo" type="text" onkeypress="return validarTextoNumero(event)" size="40" /></td>
        </tr>
      <tr>
        <td align="right" >Tel&eacute;fono empleo:</td>
        <td ><input type="text" name="telefonoempleo" onkeypress="return validarNumero(event)"  /></td>
        </tr>
      <tr>
        <td align="right" >E-mail:</td>
        <td ><input type="text" name="emailempleo" onkeypress="return validarEmail(event)"  /></td>
        </tr>
      <tr>
        <td align="right"><input type="reset" name="limpiar" value="Limpiar"/></td>
        <td align="center"><input type="submit" name="enviar" value="Aceptar" /></td>
        </tr>
    </table>
  </form>
	<input type="hidden" name="idLapso" value="<?php echo $idLapso; ?>" />
				
<?Php
if (isset($_GET['error']))
	{
		$error=$_GET['error'];
		
	}
else
	$error=0;

	switch ($error)
	{	case 1:
?>
	<script language="javascript" type="text/javascript">
				alert(" Preinscripción realizada Correctamente.");
			</script>
<?php

		break;	
	}?>
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
<script type="text/javascript" src="../validarsesiones.js"></script>
<script type="text/javascript" src="../popcalendar.js"></script>
<script type="text/javascript" src="FUNCIONES_JS.js"></script>
	</body>
   </html>
 