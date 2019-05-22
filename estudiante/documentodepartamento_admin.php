<?php
include ("../sesiones.php");
if($_SESSION['nivel']!=$_SESSION['id']){
session_destroy();
echo "FALLA GRAVE AL SISTEMA, PERDISTE LA SESION, PARA REGRESAR AL INICIO REINICIA EL NAVEGADOR";exit();
}

$ci = $_SESSION['cedula'];
include "../conexionbd.php";
$consulta = "select * from alumno where cedula_alumno='$ci'";
$resultado = mysql_query($consulta) or die (mysql_error());
if ($fila = mysql_fetch_array($resultado)){
	$estatus = $fila["id_estatus"];	
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documentos</title>
<link href="../css/bootstrap/3.3.0/bootstrap.min.css" rel="stylesheet">
<link href="../css/material/roboto.min.css" rel="stylesheet">
<link href="../css/material/material.min.css" rel="stylesheet">
<link href="../css/material/ripples.min.css" rel="stylesheet">
<link href="../css/material/materialmodif.css" rel="stylesheet">
</head>

<body>

  <?php include_once '../navbar.php';?>
  <div class="sidebar1"> 
   <?php require_once 'menu_al.php';?>
  <!-- end .sidebar1 --></div>
 <div class="well col-md-9 col-lg-9 col-sm-9 col-xs-9" style="margin-left:20px">
    <h2 align="center">Emisi&oacute;n de Documentos</h2><br><br>
  <h4> <p align="center">Bienvenido! En esta secci&oacute;n encontrar&aacute;s informaci&oacute;n 
          correspondiente a los documentos que necesitas para llevar a cabo el proceso de pasant&iacute;a 
          de manera exitosa:</p></h4>
            <br><br><p>Para Nuevas solicitudes de Pasantía:</p>
	<?php
	if($estatus==1){
		echo "<p align='center'><a href=cartapostulacion.php>Carta de Postulaci&oacute;n</a></p>";
	}else if($estatus==2){
                echo "<p align='center'><a href=solicitudpermiso_constancia.php>Permiso y Constancia</a></p>"; 
	}else if($estatus==3 || $estatus==4){
		echo "<br><br>Ud. no puede solicitar m&aacute;s documentos<br> ";
	}else{
	echo "<br><br>Ud. hasta los momentos no ha gestionado su Preinscripci&oacute;n<br> ";
	}
	?>
  

            
            
            
<?php

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
	
	echo "<form action='' method='post' name='form1'>";
	//echo  $cantidad_asignados;
	echo "<table width='100%' border='1'>";
	echo "<tr>";
	echo "<th scope='col'>#</th>";
	echo "<th scope='col'>Nombre</th>";
    echo "<th scope='col'>Tipo Documento</th>";
	echo "<th scope='col'>Fecha</th>";
	echo "<th align='center'>Acciones</th>";
    echo "</tr>";
    
                  
                        
                        
        $consultaPre = "select * from preinscripcion where cedula_alumno='$ci'";
	$resultadoPre = mysql_query($consultaPre) or die (mysql_error());		
	$cantidad_asignados = mysql_num_rows($resultadoPre);
	if ($filaPre = mysql_fetch_array($resultadoPre))
	{
		$idpreinscripcion = $filaPre["id_preinscripcion"];
		$cedulaAlum = $filaPre["cedula_alumno"];
		
		$consultaAlumno = "SELECT *
                                    FROM alumno
                                    WHERE cedula_alumno='$ci'";
		$resultadoAlumno = mysql_query($consultaAlumno) or die (mysql_error());	
			
		if($filaAl = mysql_fetch_array($resultadoAlumno)){
			$idCedulAlumno = $filaAl["cedula_alumno"];
			$nombreAlumno = $filaAl["nombre"];
			$apellidoAlumno = $filaAl["apellido"];
			
		}
                
                
                $consultaDoc = "SELECT * FROM documento 
                        WHERE id_preinscripcion=".$idpreinscripcion;
		//echo $consultaDoc;
		$resultadoDoc = mysql_query($consultaDoc) or die (mysql_error());
                while($filaDoc = mysql_fetch_array($resultadoDoc)){

                    $idDocumento = $filaDoc["id_documento"];
                    $idTipoDocumento = $filaDoc["id_tipo_documento"];
                    $fechaRegistro = $filaDoc["fecha_actual"];
                    $documentoEstatus = $filaDoc["documento_estatus"];
                    $idPre = $filaDoc["id_preinscripcion"];
                
                
                
			$consultaAlumno = "select * from tipo_documento where id_tipo_documento=$idTipoDocumento";
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
                        
                        /*if($idTipoDocumento==1){
                            echo "<td> <a href=\"edita_documentodepartamento_admin_conex.php?document=".$idDocumento."\">".$nombreAlumno." ".$apellidoAlumno."<a></td>";					
                        }else{*/
                            echo "<td>".$nombreAlumno." ".$apellidoAlumno."</td>";
                        //}
                        
                        echo "<td>".utf8_encode($nombreDoc)."</td>";
			$fechaRegistro=date("d-m-Y",strtotime($fechaRegistro));						
			echo "<td>".$fechaRegistro."</td>";
			echo "<td><a href=\"../verpdf.php?enviarDocumento=".$idDocumento."&&enviarIdAl=".$idCedulAlumno."&&enviarTipoDoc=".$idTipoDocumento."\" target=\"_blank\" class='iredit'>Ver</a></td>";
                        //echo "<td><a href='#eliminar' class='iredit' onClick='eliminar(".$idDocumento.")'>Eliminar</a></td>";
			echo "</tr>";						
		}			
	}
	echo "</table><br>";
	echo "<p>Cartas de Postulaciones: ".$cantPostulacion."<br>Solicitudes de Permisos: ".$cantPermiso."<br>Constancias de Pasant&iacute;as: ".$cantConstancia."</p>";	
        echo "</form>";
}	  
?>
<?php
mysql_close($link);
?>                     
    </div>

<?php include_once '../footer.php';?>

<script type="text/javascript" src="../js/1.11.1/jquery.min.js"></script>
<script src="../js/bootstrap/3.3.0/bootstrap.min.js"></script>
<script src="../js/material/material.min.js"></script>
<script src="../js/material/ripples.min.js"></script>
<script>
      $.material.init();
</script>
</body>
</html>