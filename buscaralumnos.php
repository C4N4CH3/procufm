<?php
include ("sesiones.php");
if($_SESSION['nivel']!=$_SESSION['id']){
session_destroy();
echo "FALLA GRAVE AL SISTEMA, PERDISTE LA SESION, PARA REGRESAR AL INICIO REINICIA EL NAVEGADOR";exit();
}
?>  
  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title> Alumnos Inscritos </title>
<link href="css/bootstrap/3.3.0/bootstrap.min.css" rel="stylesheet">
<link href="css/material/roboto.min.css" rel="stylesheet">
<link href="css/material/material.min.css" rel="stylesheet">
<link href="css/material/ripples.min.css" rel="stylesheet">
<link href="css/material/materialmodif.css" rel="stylesheet">
</head>

<body>

<div class="container">
  <div class="header">
    <table width="1081" height="213" cellpadding="0" celspacing="0" border="0">
      <tr>
        <td height="50" colspan="3"><img src="logos/gobierno.JPG" width="853" height="50" /><img src="logos/logo_bicentenario.JPG" width="222" height="50" /></td>        
      </tr>
      <tr>
        <td width="178" height="130"><a href="cerrarsesion.php"><img src="logos/logo_cufm.JPG" width="176" height="130" /></a></td>
        <td width="672" height="130" align="center" valign="middle" background="imagenes/header.JPG" bgcolor="#D6D6D6" class="tituloPrici"><strong>DEPARTAMENTO DE PASANTIA DEL COLEGIO UNIVERSITARIO FRANCISCO DE MIRANDA</strong></td>
        <td width="223" height="130"><img src="logos/independencia.JPG" width="222" height="130" /></td>        
      </tr>
      <tr>
        <td height="25" colspan="3" class="cintacentral">&nbsp;</td>
      </tr>
      </table>
  </div>
  <div class="sidebar1"> 
   <p>Principal</p>
    <ul class="nav">
      <li><a href="sesiondepartamento.php"><img src="imagenes/blockcontentbullets.JPG" width="6" height="13" /><img src="imagenes/spacer.JPG" width="5" height="1" />Inicio</a></li>  
    </ul>
    <p>Gesti&oacute;n</p>
    <ul class="nav">
      <li><a href="cronogramapasantia.php"><img src="imagenes/blockcontentbullets.JPG" width="6" height="13" /><img src="imagenes/spacer.JPG" width="5" height="1" />Cronograma</a></li>
      <li><a href="formulariocentropasantiasss.php"><img src="imagenes/blockcontentbullets.JPG" width="6" height="13" /><img src="imagenes/spacer.JPG" width="5" height="1" />Centro pasant&iacute;a</a></li>
      <li><a href="documentodepartamento.php"><img src="imagenes/blockcontentbullets.JPG" width="6" height="13" /><img src="imagenes/spacer.JPG" width="5" height="1" />Documento</a></li>        
    <li><a href="documentotutor.php"><img src="imagenes/blockcontentbullets.JPG" width="6" height="13" /><img src="imagenes/spacer.JPG" width="5" height="1" />Tutores Acad.</a></li>    
    <li><a href="informedepartamento.php"><img src="imagenes/blockcontentbullets.JPG" width="6" height="13" /><img src="imagenes/spacer.JPG" width="5" height="1" />Informes</a></li>   
    </ul>
    <p>Estad&iacute;sticas</p>
    <ul class="nav">
      <li><a href="estadisticapreinscritos.php"><img src="imagenes/blockcontentbullets.JPG" width="6" height="13" /><img src="imagenes/spacer.JPG" width="5" height="1" />Preinscritos</a></li>
      <li><a href="estadisticainscritos.php"><img src="imagenes/blockcontentbullets.JPG" width="6" height="13" /><img src="imagenes/spacer.JPG" width="5" height="1" />Inscritos</a></li>
      <li><a href="estadisticaprobados.php"><img src="imagenes/blockcontentbullets.JPG" width="6" height="13" /><img src="imagenes/spacer.JPG" width="5" height="1" />Aprobados</a></li>
      <li><a href="estadisticareprobados.php"><img src="imagenes/blockcontentbullets.JPG" width="6" height="13" /><img src="imagenes/spacer.JPG" width="5" height="1" />Reprobados</a></li>
    </ul>
    <p>B&uacute;squeda</p>
    <ul class="nav">
      <li><a href="buscaralumnos.php"><img src="imagenes/blockcontentbullets.JPG" width="6" height="13" /><img src="imagenes/spacer.JPG" width="5" height="1" />Alumnos</a></li>
    </ul>
  <!-- end .sidebar1 --></div>
  <div class="content">
  <blockquote>
    <h2>Buscar Alumnos</h2>
  </blockquote>
<p align="justify"> Consulta la informaci&oacute;n sobre los alumnos, seg&uacute;n su c&eacute;dula, su carnet.</p>
<p>

  <?php /*

$consultaLapso = "select * from lapso where lapso_habilitado='si'";
$resultadoLapso = mysql_query($consultaLapso) or die (mysql_error());
if ($filalapso = mysql_fetch_array($resultadoLapso)){	
	$codigoLapso = $filalapso["codigo_lapso"];
	$idLapso = $filalapso["id_lapso"];
	$idEstadistica = $filalapso["id_estadistica"];
	
	echo "<p>C&oacute;digo de lapso habilitado: ".$codigoLapso."</p>";
	
	$consultLap = "select * from preinscripcion where codigo_lapso='$idLapso'";
	$resultadLap = mysql_query($consultLap) or die (mysql_error());		
	while($filLap = mysql_fetch_array($resultadLap)){		
		$cedI = $filLap["cedula_alumno"];
						
		$consultaEs = "select * from estadistica where id_estadistica='$idEstadistica'";
		$resultadoEs = mysql_query($consultaEs) or die (mysql_error());		
		if($filaEs = mysql_fetch_array($resultadoEs)){
			
			
		}
	}
}
	*/
	?>
    <form action="buscaralumnos.php" method="post" />
    <table width="100%">
  <tr>
    <td width="49%" align="right">Buscar:</td>
    <td width="51%"><input name="buscar" type="text" size="30" /></td>
  </tr>
	</table><br>
	<input type="submit" name="enviar" value="Buscar" />
</form> <br>
<?php 

if(isset($_POST['buscar'])){
	include "conexionbd.php";
	$buscarAl = $_POST['buscar'];
	
	$consultaTablAlum = "select * from alumno where cedula_alumno='$buscarAl' or carnet ='$buscarAl'";
	$resultadoTablAlum = mysql_query($consultaTablAlum) or die (mysql_error());			
	$num = mysql_num_rows($resultadoTablAlum);	
	
	if($filAlum = mysql_fetch_array($resultadoTablAlum)){			
		$carrera = $filAlum["id_carrera"];
		$mencion = $filAlum["id_mencion"];		
		$nombre = $filAlum["nombre"];
		$apellido = $filAlum["apellido"];
		$carnet = $filAlum["carnet"];
		$idEstatus = $filAlum["id_estatus"];
		$sexo = $filAlum["sexo"];
		$direccionHabitacion = $filAlum["direccion_habitacion"];
		$telefonoHabitacion = $filAlum["telefono_habitacion"];
		$telefonoCelular = $filAlum["telefono_celular"];
		$email = $filAlum["email"];
		$creditosAprobados = $filAlum["creditos_aprobados"];		
		$semestre = $filAlum["semestre"];
		$indiceAcademico = $filAlum["indice_academico"];		
		$cedulaAl = $filAlum["cedula_alumno"];
		
		
		$consultaEstatus = "select * from estatus_alumno where id_estatus='$idEstatus'";
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
		}
		echo "<p align=center>Datos Personales del Alumno encontrado</p>";	
		echo "Nombre(s): ".$nombre." ".$apellido."<br>";
		echo "Carnet: ".$carnet."<br>";
		echo "Estatus: ".$estatusAl."<br>";
		echo "Carrera: ".$nombre_car."<br>";	
		echo "Menci&oacute;n: ".$nombre_men."<br>";			
		echo "G&eacute;nero: ".$sexo."<br>";
		echo "Direcci&oacute;n: ".$direccionHabitacion."<br>";		
		echo "Tel&eacute;fono Habitaci&oacute;n: ".$telefonoHabitacion."<br>";
		echo "Tel&eacute;fono Celular: ".$telefonoCelular."<br>";
		echo "Correo electr&oacute;nico : ".$email."<br>";
		echo "Cr&eacute;ditos aprobados: ".$creditosAprobados."<br>";
		echo "Semestre: ".$semestre."<br>";
		echo "&Iacute;ndice acad&eacute;mico: ".$indiceAcademico."<br>";				
		
		if($idEstatus>0){
			$consultaPre = "select * from preinscripcion where cedula_alumno='$cedulaAl'";
			$resulPre= mysql_query($consultaPre) or die (mysql_error());
			echo "<p align=center>Datos de Procesos</p>";
			$i=0;
			while($filaPre = mysql_fetch_array($resulPre)){
				$idLapso = $filaPre["codigo_lapso"];
				$idTutor = $filaPre["id_tutor"];
			
				$consultaLapso = "select * from lapso where id_lapso='$idLapso'";
				$resulLapso= mysql_query($consultaLapso) or die (mysql_error());
				if($filLap = mysql_fetch_array($resulLapso)){
					$codLapso = $filLap["codigo_lapso"];
					$lapsoHabilitado = $filLap["lapso_habilitado"];			
				}
							
				$consultaTutor = "select * from tutor_academico where id_tutor ='$idTutor'";
				$resulTutor= mysql_query($consultaTutor) or die (mysql_error());
				if($filTutor = mysql_fetch_array($resulTutor)){
					$nomTutor = $filTutor["nombre"];
					$apeTutor = $filTutor["apellido"];
					$habiliTutor = $filTutor["habilitado"];							
				}
				$i++;
				echo "Proceso #:".$i."<br>";
				echo "C&oacute;digo de Lapso participado: ".$codLapso."<br>";
				echo "Este Lapso se encuentra habilitado: ".$lapsoHabilitado."<br>";
				echo "Tutor Acad&eacute;mico Asignado: ".$nomTutor." ".$apeTutor."<br>";
				echo "El Tutor se encuentra activo: ".$habiliTutor."<br><br>";
						
			}			
		}
		else{
			echo "<br>El alumno no se ha Preinscrito hasta los momentos";
		}
			
	}
	else {
		echo "Este Alumno no est&aacute; registro en el sistema";
	}
	mysql_close($link);	
}

?>
</div>
<div class="sidebar2">
  <h4 align="center">Bienvenido: <?php echo $_SESSION['usuario']?></h4>
  <p align="center"><a href="cerrarsesion.php">Cerrar Sesi&oacute;n</a></p>
</div>
<div class="footer">
    <p><strong>Colegio Universitario &quot;Francisco de Miranda&quot;</strong><br />
Dirección: Av. Urdaneta. Esquina de Mijares. Parroquia Altagracia. Teléfonos: (58)(0212) 8620422 / 8646880<br />
Sistema de Gesti&oacute;n Administrativa de Pasant&iacute;a 2011 - Caracas, Venezuela.</p>
    <!-- end .footer --></div>
  <!-- end .container --></div> 
<script type="text/javascript" src="js/1.11.1/jquery.min.js"></script>
<script src="js/bootstrap/3.3.0/bootstrap.min.js"></script>
<script src="js/material/material.min.js"></script>
<script src="js/material/ripples.min.js"></script>
<script>
      $.material.init();
</script>
<script language='javascript' src="popcalendar.js"></script>
<script language="javascript" src="validarsesiones.js"></script>
</body>
</html>