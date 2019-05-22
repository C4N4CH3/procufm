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
<!--<script language="javascript" src="../validarsesiones.js"></script>-->
</head>

<body>


<?php include_once '../navbar.php';?>
 <div class="sidebar1"> 
    <?php include_once("menu_admin.php")?>
  <!-- end .sidebar1 --></div>

 
  
<div class="well col-md-9 col-lg-9 col-sm-9 col-xs-9" style="margin-left:20px">
  <?php
  if (isset($_GET['senna']))
	{
		$senna=$_GET['senna'];
		//echo $senna;
		
	}
else
	$senna=0;

	switch ($senna)
	{	
	case 0:
	//$ruta= "busca_alumnos.php";
	$titulo = 'Buscar Alumno';
	break;
	}
	switch ($senna)
	{	
	case 1:
	$ruta= "busca_alumnos.php";
	$titulo = 'Editar datos de Alumno';
	break;
	}
	switch ($senna)
	{	
	case 2:
	$ruta= "edit_preinscripcion.php";
	$titulo = 'Editar datos de Prinscripci&oacute;n de Alumno';
	$switch = 1;
	$newpre= '&nbsp;&nbsp;&nbsp;<a href="nueva_preinscripcion_admin.php">Nueva Preinscripción</a>';
	break;
	}

  //echo $ruta;
  ?>
  <div class="content">
  
    <h2 align="center"><?Php echo $titulo; ?></h2>

<p align="center"> Consulta la informaci&oacute;n sobre los alumnos, seg&uacute;n su c&eacute;dula, su carnet.</p>
<br/>
<?Php
	if ($switch==1)
	{
		echo $newpre;
	}
?>

<p> 
  <?php
  /******/
	
	?>
    <form action="<?Php echo $ruta; ?>" method="post" />
    <table align="center" width="100%" border="0" >
  <tr>
    <td width="49%" align="right">
    	Buscar:
    </td>
    <td width="51%">
    	<input name="buscar" type="text" size="40" placeholder="Número de Cédula o de Carnet" />
    </td>
  </tr>
  <tr>
  	<td colspan="2">&nbsp;
    	
    </td>
  </tr>
  <tr>
  	<td colspan="2" align="center">
    	<input type="submit" name="enviar" value="Buscar" />
    </td>
  </tr>
	</table><br>
		
</form> <br>
<?php 
//nombre_estatus
/*if ($_GET['buscare'])
	{
		$buscarAl=$_GET['buscare'];
		echo $buscarAl.'<br>';
	}
	else
	{*/
	
	
		if(isset($_POST['buscar']))
		{
			include "../conexionbd.php";
	
			$buscarAl = $_POST['buscar'];
		//echo $buscarAl;
		   /*$nulos="SELECT * FROM alumno a 
		   WHERE a.cedula_alumno='$buscarAl' or a.carnet ='$buscarAl'";
						$consulta = mysql_query($nulos) or die (mysql_error());	
						$num = mysql_num_rows($consulta);
						echo $num.'ffffffffffffffffffff<br/>';
						echo $nulos;
						if ($num>=1)
						{
							$alumno_mencion_null="SELECT  a.*
							FROM alumno as a 
							WHERE a.cedula_alumno='$buscarAl' or a.carnet ='$buscarAl'";
						  	echo $alumno_mencion_null;
						}
						else*/
						
						
	$consultaTablAlum="SELECT a.*, c.*, m.*, s.*, e.* 
				FROM alumno AS a
				LEFT JOIN  carreras  AS c ON c.id_carrera = a.id_carrera
				LEFT JOIN  estatus  AS e ON e.id_estatus = a.id_estatus
				LEFT JOIN  menciones AS m ON m.id_mencion = a.id_mencion
				LEFT JOIN  sexo 	 AS s ON s.id_sexo = a.sexo
		   WHERE a.cedula_alumno='$buscarAl' or a.carnet ='$buscarAl'
		   ";
	/*$consultaTablAlum = "SELECT  a.*, s.*, m.*,c.*, e.*
		FROM alumno as a 
		INNER JOIN sexo as s ON s.id_sexo= a.sexo
		INNER JOIN menciones as m ON m.id_mencion = a.id_mencion)
		INNER JOIN carreras as c ON c.id_carrera = a.id_carrera
		INNER JOIN estatus as e ON e.id_estatus = a.id_estatus
		WHERE a.cedula_alumno='$buscarAl' or a.carnet ='$buscarAl'";*/
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
		$sexo = $filAlum["sexo"];
		$desc_sexo = $filAlum["descripcion_sexo"];
		$direccionHabitacion = $filAlum["direccion_habitacion"];
		$telefonoHabitacion = $filAlum["telefono_habitacion"];
		$telefonoCelular = $filAlum["telefono_celular"];
		$email = $filAlum["email"];
		$creditosAprobados = $filAlum["creditos_aprobados"];		
		$semestre = $filAlum["semestre"];
		$indiceAcademico = $filAlum["indice_academico"];		
		$cedulaAl = $filAlum["cedula_alumno"];
		
		
		/*$consultaEstatus = "select * from estatus_alumno where id_estatus='$idEstatus'";
		echo $consultaEstatus;
		$resulEstatus= mysql_query($consultaEstatus) or die (mysql_error());
		if ($filaEstatus = mysql_fetch_array($resulEstatus)){
			$estatusAl = $filaEstatus["tipo_estatus"];
		}		
		
		$consulta2 = "select * from tipo_carrera where id_carrera='$carrera'";
		$nombre_carrera = mysql_query($consulta2) or die (mysql_error());
		if ($filacar = mysql_fetch_array($nombre_carrera)){
			$nombre_car = $filacar["nombre"];
		}
	
		$consulta3 = "select * from tipo_mencion where id_mencion='$mencion'";;
		$nombre_mencion = mysql_query($consulta3) or die (mysql_error());
		if ($filamen = mysql_fetch_array($nombre_mencion)){
    		$nombre_men = $filamen["nombre"];
		}*/
		?>

    
    
		<table border="1" class="busca_alumnosm">
        <form method="get" action="edita_alumno.php" name="edita_alumno" id="edita_alumno">
			<input type="hidden" value="<?Php echo $id_alum;  ?>"  name="id_alum" id="id_alum"/>
    		<input type="hidden" value="<?Php echo $cedulaAl;  ?>"  name="cedulaAl" id="cedulaAl"/>
        	<caption>Datos Personales del Alumno encontrado</caption>
        	<tr>
            	<td>
                	Nombre:
                </td>
                <td>
                	<input type="text" value="<?Php echo $nombre;  ?>"  size="80" name="nombre" id="nombre"/>
                </td>
            </tr>
            <tr>
            	<td>
                	Apellido:
                </td>
                <td>
                	<input type="text" value="<?Php echo $apellido;  ?>"  size="80" name="apellido" id="apellido"/> 
                </td>
            </tr>
            <tr>
            	<td>
                	N&uacute;mero de Carnet:
                </td>
                <td>
                <?Php 
			 			if (empty($carnet) )
							{
								$carnet_s = 'No est&aacute; preinscrito.';
							}
							else
							{
								$carnet_s = $carnet;
							}
			
			 	?>
                	<input type="text" value="<?Php echo $carnet_s;  ?>" size="80"  name="carnet" id="carnet" readonly/> 
                	
                </td>
            </tr>
            <?Php if (empty($nombre_estatus) or ($idEstatus == 0))
			{
				$name_estatus = 'No esta&acute; preinscrito.';
			}
			else
			{
				$name_estatus = $nombre_estatus;
			}
			
			 ?>
            <tr>
            	<td>
                	Estatus:
                </td>
                <td>
                	<input type="text" value="<?Php echo utf8_encode($name_estatus);  ?>" size="80"  name="estatusAl" id="estatusAl" readonly/> 
                    
                	
                </td>
            </tr>
             <tr>
                    <td >Carrera:</td>
                    <td>
                     <?Php if (empty($carrera) or ($carrera == 0))
							{
								$carrera_s = 'No est&aacute; preinscrito.';
							}
							else
							{
								$carrera_s = $nombre_carrera;
							}
			
			 			?>
                    
                   		<input type="hidden" value="<?Php echo $carrera; ?>" name="carrera" id="carrera" />
                    	
                    	<input type="text" value="<?Php echo utf8_encode($carrera_s);  ?>" size="80"  name="nombre_carrera" id="nombre_carrera" readonly/> 
                    </td>        
      </tr>
    <tr>
        <td >Menci&oacute;n:</td>
        <td>
        	 <?Php 
			 	if (empty($nombre_mencion) or ($mencion == 0))
							{
								$mencion_s = 'No est&aacute; preinscrito.';
							}
							else
							{
								$mencion_s = $nombre_mencion;
							}
			
			 	?>
        	<input type="hidden" value="<?Php echo $mencion; ?>" name="mencion" id="mencion" />
        	<input type="text" value="<?Php echo utf8_encode($mencion_s);  ?>" size="80"  name="nombre_mencion" id="nombre_mencion" readonly/> 
       
      
        </td>
        </tr>
            <tr>
            	<td>
                	G&eacute;nero:
                </td>
                <td>
                <?Php 
			 	if (empty($desc_sexo) or ($sexo == 0))
							{
								$sexo_s = 'No est&aacute; preinscrito.';
							}
							else
							{
								$sexo_s = $desc_sexo;
							}
			
			 	?>
                	 <input type="hidden" value="<?Php echo $sexo; ?>" name="id_sexo" id="id_sexo" />
                     <input type="text" value="<?Php echo utf8_encode($sexo_s);  ?>" size="80"  name="genero" id="genero" readonly/> 
                	 
                </td>
            </tr>
            <tr>
            	<td>
                	Direcci&oacute;n:
                </td>
                <td>
                <?Php 
			 	if (empty($direccionHabitacion) )
							{
								$direccionHabitacion_s = 'No est&aacute; preinscrito.';
							}
							else
							{
								$direccionHabitacion_s = $direccionHabitacion;
							}
			
			 	?>
                	 <input type="text" value="<?Php echo $direccionHabitacion_s;  ?>"  size="80" name="direccionHabitacion" id="direccionHabitacion"/>
                </td>
            </tr>
            <tr>
            	<td>
                	Tel&eacute;fono Habitaci&oacute;n:
                </td>
                <td>
                 <?Php 
			 			if (empty($telefonoHabitacion) )
							{
								$telefonoHabitacion_s = 'No est&aacute; preinscrito.';
							}
							else
							{
								$telefonoHabitacion_s = $telefonoHabitacion;
							}
			
			 	?>
                	 <input type="text" value="<?Php echo $telefonoHabitacion_s;  ?>"  size="80" name="telefonoHabitacion" id="telefonoHabitacion"/>
                </td>
            </tr>
            <tr>
            	<td>
                	Tel&eacute;fono Celular:
                </td>
                <td>
                <?Php 
			 			if (empty($telefonoCelular) )
							{
								$telefonoCelular_s = 'No est&aacute; preinscrito.';
							}
							else
							{
								$telefonoCelular_s = $telefonoCelular;
							}
			
			 	?>
                	 <input type="text" value="<?Php echo $telefonoCelular_s;  ?>"  size="80" name="telefonoCelular" id="telefonoCelular"/>
                </td>
            </tr>
            <tr>
            	<td>
                	Correo electr&oacute;nico:
                </td>
                <td>
                	 <input type="text" value="<?Php echo $email;  ?>"  size="80" name="email" id="email"/>
                </td>
            </tr>
            <tr>
            	<td>
                	Cr&eacute;ditos aprobados:
                </td>
                <td>
                 <?Php 
			 			if (empty($creditosAprobados) )
							{
								$creditosAprobados_s = 'No est&aacute; preinscrito.';
							}
							else
							{
								$creditosAprobados_s = $creditosAprobados;
							}
			
			 	?>
                	 <input type="text" value="<?Php echo $creditosAprobados_s;  ?>"  size="80" name="creditosAprobados" id="creditosAprobados" readonly/>
                </td>
            </tr>
            <tr>
            	<td>
                	Semestre:
                </td>
                <td>
                 <?Php 
			 			if (empty($semestre) )
							{
								$semestre_s = 'No est&aacute; preinscrito.';
							}
							else
							{
								$semestre_s = $semestre;
							}
			
			 	?>
                
                	<input type="text" value="<?Php echo $semestre_s;  ?>"  size="80" name="semestre" id="semestre" readonly/>

                </td>
            </tr>
            <tr>
            	<td>
                	&Iacute;ndice acad&eacute;mico:
                </td>
                <td>
                 <?Php 
			 			if (empty($indiceAcademico) )
							{
								$indiceAcademico_s = 'No est&aacute; preinscrito.';
							}
							else
							{
								$indiceAcademico_s = $indiceAcademico;
							}
			
			 	?>
                	<input type="text" value="<?Php echo $indiceAcademico_s;  ?>"  size="80" name="indiceAcademico" id="indiceAcademico" readonly/>
                </td>
            </tr>
            <tr>
					<td  align="center">
						<input type="submit" value="Editar Datos del Alumno"  />
                   </td>
		  
           </form>
           
					<td  align="center">
                    
                     <form method="GET" name="destroy_alum" id="destroy_alum">
						<input type="button" value="Eliminar Este  Alumno" onclick="eliminar_alumno('<?php echo $id_alum ?>')">
						<input name='id_alum' id='id_alum' type=hidden  value="<?Php  echo $id_alum; ?>" </td>
                    </form>
                    
						
                   </td>
		   </tr>
           
        </table>

<br /><br />
<!--<form method="GET" action="edita_proceso.php" name="edit_proc" id="edit_proc">-->
        <?Php
				
		
		if($idEstatus>0)
		{
			$consultaPre = "select * from preinscripcion where cedula_alumno='$cedulaAl'";
			
			$resulPre= mysql_query($consultaPre) or die (mysql_error());
			
			echo 	'<table border="4" class="busca_alumnosm">
					<caption>Datos de Procesos<caption>
					<tr>
                 	<td>
                    	&nbsp;
                    <td>
                 </tr>';
			//echo //"<p align=center>Datos de Procesos</p>";
			$i=0;
			while($filaPre = mysql_fetch_array($resulPre))
			{
				$idLapso = $filaPre["codigo_lapso"];
				$idTutor = $filaPre["id_tutor"];
			
				$consultaLapso = "select * from lapso where id_lapso='$idLapso'";
				$resulLapso= mysql_query($consultaLapso) or die (mysql_error());
				if($filLap = mysql_fetch_array($resulLapso))
				{
					$codLapso = $filLap["codigo_lapso"];
					$lapsoHabilitado = $filLap["lapso_habilitado"];			
				}
							
				$consultaTutor = "select * from tutor_academico where id_tutor ='$idTutor'";
				$resulTutor= mysql_query($consultaTutor) or die (mysql_error());
				if($filTutor = mysql_fetch_array($resulTutor))
				{
					$nomTutor = $filTutor["nombre"];
					$apeTutor = $filTutor["apellido"];
					$habiliTutor = $filTutor["habilitado"];							
				}
				$i++;
				 ?>
                 
				 <tr>
					<td>
						Proceso Número:
					</td>
					<td>
                    <label >
                    	<?Php echo $i; ?>
                    </label>
						<!--<input type= value="<?Php echo $i; ?>" name="num_proc" id="num_proc" readonly="readonly" />-->
					</td>
				</tr>
                <tr>
					<td>
						C&oacute;digo de Lapso participado:
					</td>
					<td>
                    <label >
                    	<?Php echo $codLapso; ?>
                    </label>
                    <!--<input type="text" value="<?Php echo $codLapso; ?>" name="codLapso" id="codLapso" readonly="readonly" />-->
						
					</td>
				</tr>
                <tr>
					<td>
						Este Lapso se encuentra habilitado:
					</td>
					<td>
                     <label >
                    	<?Php echo $lapsoHabilitado; ?>
                    </label>
						 <!--<input type="text" value="<?Php echo $lapsoHabilitado; ?>" name="lapsoHabilitado" id="lapsoHabilitado" readonly="readonly" />-->
						
					</td>
				</tr>
                <tr>
					<td>
						Tutor Acad&eacute;mico Asignado:
					</td>
					<td>
                    <label >
                    	<?Php echo $habiliTutor; ?>
                    </label>
                   <!-- <input type="text" value="<?Php echo $habiliTutor; ?>" name="habiliTutor" id="habiliTutor" readonly="readonly"/>-->
						
					</td>
				</tr>
               <!-- <tr>
					<td colspan="2" align="center">
						<input type="submit" value="Editar Datos de Proceso" />
                   </td>
				</tr>-->
                <?Php
		/*		echo "Proceso #:".$i."<br>";
				echo "C&oacute;digo de Lapso participado: ".$codLapso."<br>";
				echo "Este Lapso se encuentra habilitado: ".$lapsoHabilitado."<br>";
				echo "Tutor Acad&eacute;mico Asignado: ".$nomTutor." ".$apeTutor."<br>";
				echo "El Tutor se encuentra activo: ".$habiliTutor."<br><br>";*/
				echo '</table>';	
			}			
		}
		else
		{
			echo "<br>El alumno no se ha Preinscrito hasta los momentos";
		}
			
	}
	else 
	{
		echo "Este Alumno no est&aacute; registro en el sistema";
	}
	mysql_close($link);	
		}
	
	
?>
</div>
</div>
<?php include_once '../footer.php';?>
  <!-- end .container --></div> 

<script type="text/javascript" src="../js/1.11.1/jquery.min.js"></script>
<script src="../js/bootstrap/3.3.0/bootstrap.min.js"></script>
<script src="../js/material/material.min.js"></script>
<script src="../js/material/ripples.min.js"></script>
<script>
      $.material.init();
</script>
<script type="text/javascript" src="../popcalendar.js"></script>
<script type="text/javascript" src="../validarsesiones.js"></script>
<script type="text/javascript">
	function eliminar_alumno(id_alumno)
	{
		if(confirm("Esta seguro que desea eliminar?"))
		{
			open("destroy_alumno_admin_conex.php?id_alum=" + id_alumno);
			return false;	
		}
		else
		{
			return false;	
		}
		
	}
</script>


</body>
</html>


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
				alert(" Alumno Editado Correctamente.");
			</script>
<?php

		break;	
	}
	switch ($error)
	{	case 2:
?>
	<script language="javascript" type="text/javascript">
				alert(" Alumno Eliminado.");
			</script>
<?php

		break;	
	}switch ($error)
	{	case 3:
?>
	<script language="javascript" type="text/javascript">
				alert("Preinscripción Editada Correctamente.");
			</script>
<?php

		break;	
	}