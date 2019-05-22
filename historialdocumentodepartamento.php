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
<title>Documentos solicitados</title>
<script language='javascript' src="popcalendar.js"></script>
<link href="efecto.css" rel="stylesheet" type="text/css">
<script language="javascript" src="validarsesiones.js"></script>
</head>

<body>
<form action="" method="post" name="form1">
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
    <p>Principal 
    </p>
    <ul class="nav">
      <li>
      	<a href="sesionadministrador.php">
        <img src="imagenes/blockcontentbullets.JPG" width="6" height="13" />
      	<img src="imagenes/spacer.JPG" width="5" height="1" />Inicio</a>
      </li>
      </ul>
  Alumnos 
    
    <ul class="nav">
      <li>
      	<!--<a href="../pasantia/administrador/busca_alumnos.php" >-->
       	
        <a href="administrador/busca_alumnos.php?senna=1">
        <img src="imagenes/blockcontentbullets.JPG" width="6" height="13" />
        <img src="imagenes/spacer.JPG" width="5" height="1" />Datos Personales</a>
       </li> 
       <li>
      	<a href="administrador/busca_alumnos.php?senna=2" >
        <img src="imagenes/blockcontentbullets.JPG" width="6" height="13" />
        <img src="imagenes/spacer.JPG" width="5" height="1" />Preinscripci&oacute;n</a>
       </li> 
       <li>
      	<a href="administrador/formulariocentropasantia.php">
        <img src="imagenes/blockcontentbullets.JPG" width="6" height="13" />
        <img src="imagenes/spacer.JPG" width="5" height="1" />Centro de Pasant&iacute;as</a>
       </li> 
       <li>
      	<a href="documentodepartamento.php">
        <img src="imagenes/blockcontentbullets.JPG" width="6" height="13" />
        <img src="imagenes/spacer.JPG" width="5" height="1" />Documentos</a>
       </li>
        <li>
      	<a href="informedepartamento.php">
        <img src="imagenes/blockcontentbullets.JPG" width="6" height="13" />
        <img src="imagenes/spacer.JPG" width="5" height="1" />Informes</a>
       </li> 
       <li>
      	<a href="cronograma.php">
        <img src="imagenes/blockcontentbullets.JPG" width="6" height="13" />
        <img src="imagenes/spacer.JPG" width="5" height="1" />Cronograma</a>
       </li>       
   <!-- </ul> Departamento
    </ul>
    <ul class="nav">
      <li>
      	<a href="../formulariodepartamento.php">
        <img src="../imagenes/blockcontentbullets.JPG" width="6" height="13" />
        <img src="../imagenes/spacer.JPG" width="5" height="1" />Centros de Pasant&iacute;as</a>
       </li> 
       <li>
      	<a href="../formulariodepartamento.php">
        <img src="../imagenes/blockcontentbullets.JPG" width="6" height="13" />
        <img src="../imagenes/spacer.JPG" width="5" height="1" />Documentos</a>
       </li> 
       <li>
      	<a href="../formulariodepartamento.php">
        <img src="../imagenes/blockcontentbullets.JPG" width="6" height="13" />
        <img src="../imagenes/spacer.JPG" width="5" height="1" />Tutores Acad&eacute;micos</a>
       </li> 
        <li>
      	<a href="../informedepartamento.php">
        <img src="../imagenes/blockcontentbullets.JPG" width="6" height="13" />
        <img src="../imagenes/spacer.JPG" width="5" height="1" />Informes</a>
       </li>
       <!--<li>
      	<a href="../formulariodepartamento.php">
        <img src="../imagenes/blockcontentbullets.JPG" width="6" height="13" />
        <img src="../imagenes/spacer.JPG" width="5" height="1" />Alumnos</a>
       </li>-->    
    </ul>
  <!-- end .sidebar1 --></div>
  <!--<div class="sidebar1"> 
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
      <li><a href="buscarempresas.php"><img src="imagenes/blockcontentbullets.JPG" width="6" height="13" /><img src="imagenes/spacer.JPG" width="5" height="1" />Empresas</a></li>
    </ul>
  <!-- end .sidebar1 --></div>
  <div class="content">
  <blockquote>
    <h2>Historial Documentos</h2>
  </blockquote>
<p align="justify">Documentos solicitados por los alumnos:</p>
	<p>
	  <?php

include "conexionbd.php"; 
$consultaLapso = "select * from lapso where lapso_habilitado='si'";
$resultadoLapso = mysql_query($consultaLapso) or die (mysql_error());
if ($filalapso = mysql_fetch_array($resultadoLapso)){	
	$codigoLapso = $filalapso["codigo_lapso"];
	$idLapso = $filalapso["id_lapso"];
	echo "<p>C&oacute;digo de lapso habilitado: ".$codigoLapso."</p>";
	$cantPostulacion=0;
	$cantPermiso = 0;
	$cantConstancia = 0;
	$i=1;	
	
	$consultaPre = "select * from preinscripcion where codigo_lapso='$idLapso'";
	$resultadoPre = mysql_query($consultaPre) or die (mysql_error());		
	$cantidad_asignados = mysql_num_rows($resultadoPre);
	echo "<table width=100% border=1>";
	echo "<tr>";
	echo "<th scope=col>#</th>";
	echo "<th scope=col>Nombre</th>";
    echo "<th scope=col>Tipo Documento</th>";
	echo "<th scope=col>Fecha</th>";
	echo "<th scope=col>&nbsp;</th>";
    echo "</tr>";
	while ($filaPre = mysql_fetch_array($resultadoPre)){
		$idPreinscripcion = $filaPre["id_preinscripcion"];
		$cedulaAlum = $filaPre["cedula_alumno"];
									
		
		
		$consultaAlumno = "select * from alumno where cedula_alumno='$cedulaAlum'";
		$resultadoAlumno = mysql_query($consultaAlumno) or die (mysql_error());		
		if($filaAl = mysql_fetch_array($resultadoAlumno)){
			$idCedulAlumno = $filaAl["cedula_alumno"];
			$nombreAlumno = $filaAl["nombre"];
			$apellidoAlumno = $filaAl["apellido"];
		}
		
		
		$consultaDoc = "select * from documento where id_preinscripcion='$idPreinscripcion'";
		$resultadoDoc = mysql_query($consultaDoc) or die (mysql_error());
		while($filaDoc = mysql_fetch_array($resultadoDoc)){
			$idDocumento = $filaDoc["id_documento"];
			$idTipoDocumento = $filaDoc["id_tipo_documento"];
			$fechaRegistro = $filaDoc["fecha_actual"];
			$documentoEstatus = $filaDoc["documento_estatus"];
				
			$consultaAlumno = "select * from tipo_documento where id_tipo_documento='$idTipoDocumento'";
			$resultadoAlumno = mysql_query($consultaAlumno) or die (mysql_error());		
			if($filaTipoDoc = mysql_fetch_array($resultadoAlumno)){
				$nombreDoc = $filaTipoDoc["nombre"];				
			}		
			
			switch($idTipoDocumento){
				case 1:
					$cantPostulacion++;
					break;
				case 2:
					$cantPermiso++;
					break;
				case 3:
					$cantConstancia++;
					break;
				default;
			}			
			
			echo "<tr>";						
			echo "<td>".$i++."</td>"; 							
			echo "<td>".$nombreAlumno." ".$apellidoAlumno."</td>";					
    		echo "<td>".$nombreDoc."</td>";							
			echo "<td>".$fechaRegistro."</td>";
			echo "<td><a href=verhistorialpdf.php?enviarDocumento=".$idDocumento."&&enviarIdAl=".$idCedulAlumno."&&enviarTipoDoc=".$idTipoDocumento." target=_blank>Ver</a></td>";
			echo "</tr>";
						
		}			
	}
	echo "</table><br>";
	echo "<p>Cartas de Postulaciones: ".$cantPostulacion."<br>Solicitudes de Permisos: ".$cantPermiso."<br>Constancias de Pasant&iacute;as: ".$cantConstancia."</p>";	
}	  
?>
<?php
mysql_close($link);
?>
</p>
  </div>
<div class="sidebar2">
  <h4 align="center">Bienvenido: <?php echo $_SESSION['usuario']?></h4>
  <p align="center"><a href="cerrarsesion.php">Cerrar Sesi&oacute;n</a></p>
  <p align="center">
  <!-- end .sidebar2 --></p>
</div>
  <div class="footer">
    <p><strong>Colegio Universitario &quot;Francisco de Miranda&quot;</strong><br />
Dirección: Av. Urdaneta. Esquina de Mijares. Parroquia Altagracia. Teléfonos: (58)(0212) 8620422 / 8646880<br />
Sistema de Gesti&oacute;n Administrativa de Pasant&iacute;a 2011 - Caracas, Venezuela.</p>
    <!-- end .footer --></div>
  <!-- end .container --></div> 
</form> 
</body>
</html>