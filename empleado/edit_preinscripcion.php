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
  <!-- end .sidebar1 --></div>  


 

  <div class="well col-md-9 col-lg-9 col-sm-9 col-xs-9" style="margin-left:20px">

    <h2>Editar Preinscripción</h2>

<p align="justify"> Consulta la informaci&oacute;n sobre los alumnos, seg&uacute;n su c&eacute;dula, su carnet.</p>
<p>


<?Php
/*****************MÓDULO PREINSCRIPCION*******************************/
include "../conexionbd.php";
	$uno= $_POST['buscar'];
		//echo $uno;
		$consultaTablAlum = "SELECT  a.*, s.*, m.*,c.*, e.*, t.*
		FROM alumno 			AS a 
		LEFT JOIN sexo 		AS s ON s.id_sexo= a.sexo
		LEFT JOIN menciones 	AS m ON m.id_mencion = a.id_mencion
		LEFT JOIN carreras 	AS c ON c.id_carrera = a.id_carrera
		LEFT JOIN estatus 		AS e ON e.id_estatus = a.id_estatus
		LEFT JOIN turnos 		AS t ON a.turno = t.id_turno
		WHERE a.cedula_alumno='$uno' or a.carnet ='$uno'";
		
		
				//echo $consultaTablAlum;
			$resultadoTablAlum = mysql_query($consultaTablAlum) or die (mysql_error());			
			$num = mysql_num_rows($resultadoTablAlum);	
			
			if($filAlum = mysql_fetch_array($resultadoTablAlum))
			{	
				$id_alum = $filAlum["id_alumnos"];	
				$carrera = $filAlum["id_carrera"];
				$nombre_carrera = $filAlum["nombre_carrera"];
				$mencion = $filAlum["id_mencion"];
				$nombre_mencion = $filAlum["nombre_mencion"];		
				$nombre = $filAlum["nombre"];
				$apellido = $filAlum["apellido"];
				$carnet = $filAlum["carnet"];
				$idEstatus = $filAlum["id_estatus"];
				$nombre_estatus = $filAlum["nombre_estatus"];
				$id_sexo = $filAlum["sexo"];
				$descripcion_sexo = $filAlum["descripcion_sexo"];
				$direccionHabitacion = $filAlum["direccion_habitacion"];
				$telefonoHabitacion = $filAlum["telefono_habitacion"];
				$telefonoCelular = $filAlum["telefono_celular"];
				$email = $filAlum["email"];
				$creditosAprobados = $filAlum["creditos_aprobados"];		
				$semestre = $filAlum["semestre"];
				$indiceAcademico = $filAlum["indice_academico"];		
				$cedulaAl = $filAlum["cedula_alumno"];
				$fecha_nacimiento = $filAlum["fecha_nacimiento"];
				$id_turno = $filAlum["id_turno"];
				$nombre_turno = $filAlum["nombre_turno"];
				
				$trabajo 	  =	$filAlum["empleo"];
				$nombrempresa = $filAlum["nombre_empleo"];
				$cargo 		  = $filAlum["cargo_empleo"];
				$telefonoempleo = $filAlum["telefono_empleo"];
				$emailempleo   = $filAlum["email_empleo"];
				
				
				
				/*echo $creditosAprobados.'creditos<br/>';
				echo $indiceAcademico.'ira<br/>';*/
			}
			 ?>
     <form method="POST" action="edita_preinscripcion_conex.php">
     
			 <table width="100%" border="1"><!-- asiganr clase a la tabla-->
            
      <tr>
        <td width="35%" align="right">Nombres:
        </td>
        <td width="65%">
        <input type="hidden" name="id_al" id="id_al" value="<?Php echo $id_alum; ?>" />
        	<input type="text" value="<?php echo $nombre;?>" size="80" name="nombre" />
		</td>
    </tr>
    <tr>
        <td width="35%" align="right"> Apellidos:
        </td>
        <td width="65%">
       	  <input type="text" value="<?php echo $apellido; ?>" size="80" name="apellido" />
		</td>
    </tr>
	<tr>
        <td align="right">
        	C&eacute;dula:
       </td>
       <td>
        	<input type="text" value="<?php echo $cedulaAl;?>" size="80" name="cedulaAl"  />
        </td>
	</tr>
	<tr>
        <td align="right">
        	Email:
        </td>
        <td>
			<input type="text" value="<?php echo $email;?>" size="80" name="email"  />
		</td>
	</tr>
	<tr>
        <td align="right">
        	Carnet:
        </td>
        <td>
        	<input name="carnet" onkeypress="return validarNumero(event)" type="text" value="<?php echo $carnet; ?>" size="80" readonly="readonly">
        </td>
    </tr>
    <tr>
        <td align="right">
        	Direcci&oacute;n de Hab:
        </td>
        <td>
        	<input name="direccion" onkeypress="return validarTextoNumero(event)" type="text" value="<?php  echo $direccionHabitacion; ?>" size="80" maxlength="100">
        </td>
    </tr>
    <tr>
        <td align="right" >
        	Fecha de Nacimiento:
        </td>
        <td>
        		<?Php $fechanac=date("d-m-Y",strtotime($fecha_nacimiento)); ?>
        	<input name="fechaNacimiento" type="text" id="dateArrival" value="<?php echo $fechanac;?>" size="80" maxlength="10" onClick="popUpCalendar(this, form.dateArrival, 'dd-mm-yyyy');">
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
        <td ><input name="creditosaprobados" onkeypress="return validarNumero(event)" type="text" value="<?php  echo $creditosAprobados;?>" size="80"  readonly="readonly"></td>
        </tr>
      <tr>
        <td align="right" >IRA:</td>
        <td><input name="ira" type="text" onkeypress="return validarIra(event)" value="<?php  echo $indiceAcademico;?>" size="80" readonly="readonly"></td>
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
        <td><input type="text" name="semestre" onkeypress="return validarNumero(event)" value="<?php  echo $semestre; ?>"></td>
        </tr>
      <tr>
        <td align="right" >Tel&eacute;fono Habitación:</td>
        <td ><input type="text" name="telefonohab" onkeypress="return validarNumero(event)" value="<?php  echo $telefonoHabitacion; ?>" ></td>
        </tr>
      <tr>
        <td align="right">Tel&eacute;fono Celular:</td>
        <td><input type="text" name="telefonocel" onkeypress="return validarNumero(event)" value="<?php  echo $telefonoCelular; ?>"></td>
        </tr>
      <tr>
        <td align="center" colspan="2"><em>Situaci&oacute;n Laboral</em></td>
        </tr>
      <tr>
        <td align="right">¿Trabajas?:</td> 
        <td >
		<?Php   
		if  ($trabajo==1)
		{
			$t='checked';
			//$t2='';
			?>
			<input type="radio" name="trabajo" value="1" checked="<?Php echo $t; ?>">Si &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          	<input type="radio" name="trabajo" value="0" >No</td>
                <?Php
			//echo $trabajo.'si';
		} 
		elseif ($trabajo==0)
		{
			//$t='';
			$t2='checked';
			//echo $trabajo.'no';
			?>
			<input type="radio" name="trabajo" value="1" >Si &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          	<input type="radio" name="trabajo" value="0" checked="<?Php echo $t2; ?>">No</td>
		<?Php 
        }
		?>
        	 	
        </tr>
      <tr>
        <td align="right" >Nombre de la Empresa:</td>
        <td ><input name="nombrempresa" onkeypress="return validarTextoNumero(event)" type="text" value="<?php echo $nombrempresa;?>" size="40" /></td>
        </tr>
      <tr>
        <td align="right" >Cargo que ocupa:</td>
        <td ><input name="cargo" type="text" onkeypress="return validarTextoNumero(event)" value="<?php  echo $cargo; ?>" size="40" /></td>
        </tr>
      <tr>
        <td align="right" >Tel&eacute;fono empleo:</td>
        <td ><input type="text" name="telefonoempleo" onkeypress="return validarNumero(event)" value="<?php echo $telefonoempleo; ?>" /></td>
        </tr>
      <tr>
        <td align="right" >E-mail:</td>
        <td ><input type="text" name="emailempleo" onkeypress="return validarEmail(event)" value="<?php  echo $emailempleo; ?>" /></td>
        </tr>
      <tr>
  
				 
        <td align="right"><input type="reset" name="limpiar" value="Limpiar"/></td>
        <td align="center"><input type="submit" name="enviar" value="Aceptar" /></td>
        </tr>
    </table>
	<input type="hidden" name="idLapso" value="<?php echo $idLapso; ?>" />
    </div>
    <?php include_once '../footer.php';?>

<script type="text/javascript" src="../js/1.11.1/jquery.min.js"></script>
    <script src="../js/bootstrap/3.3.0/bootstrap.min.js"></script>
    <script src="../js/material/material.min.js"></script>
    <script src="../js/material/ripples.min.js"></script>
    <script>
      $.material.init();
    </script>
    
	<script type="text/javascript" src="../popcalendar.js"></script>

<!--<script language="javascript" src="../validarsesiones.js"></script>-->
<script type="text/javascript" src="../validarsesiones.js"></script>
<script type="text/javascript" src="FUNCIONES_JS.js"></script>

    </body>
    </html>