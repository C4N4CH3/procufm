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
<title>Documentos solicitados</title>
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
  <!-- end .sidebar1 --></div>
  <div class="well col-md-9 col-lg-9 col-sm-9 col-xs-9" style="margin-left:20px">
  <blockquote>
    <h2>Informes generados</h2>
  </blockquote>
      
<p align="justify"> Listado de cantidad de informes generados por los estudiantes:</p>
<p>
  <?php

include "../conexionbd.php"; 
$consultaLapso = "select * from lapso where lapso_habilitado='si'";
$resultadoLapso = mysql_query($consultaLapso) or die (mysql_error());
if ($filalapso = mysql_fetch_array($resultadoLapso)){	
	$codigoLapso = $filalapso["codigo_lapso"];
	$idLapso = $filalapso["id_lapso"];
	echo "<p>C&oacute;digo de lapso habilitado: ".$codigoLapso."</p>";
	$consultaPre = "select * from preinscripcion where codigo_lapso='$idLapso'";
	$resultadoPre = mysql_query($consultaPre) or die (mysql_error());		
	$cantidad_asignados = mysql_num_rows($resultadoPre);
	echo "<table width='100%' border='1' id='mi_tabla'>";
        echo "<thead>";
        echo "<tr>";
        echo "<th colspan='6' align='right'><input type='text' id='filtrar' /></th>";
        echo "</tr>";
	echo "<tr>";
	echo "<th>#</th>";
	echo "<th>Nombre</th>";
        echo "<th>Cantidad Informes</th>";
        echo "<th colspan='2'>Acciones</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
	$i=1;
	while($filaPre = mysql_fetch_array($resultadoPre)){
		$idPreinscripcion = $filaPre["id_preinscripcion"];
		$cedulaAlum = $filaPre["cedula_alumno"];		
		
		$consultaAlumno = "select * from alumno where cedula_alumno='$cedulaAlum'";
		$resultadoAlumno = mysql_query($consultaAlumno) or die (mysql_error());		
		if($filaAl = mysql_fetch_array($resultadoAlumno)){
			$nombreAlumno = $filaAl["nombre"];
			$apellidoAlumno = $filaAl["apellido"];
		}
				
		$consultaDoc = "select * from inscripcion where id_preinscripcion=$idPreinscripcion";
		$resultadoDoc = mysql_query($consultaDoc) or die (mysql_error());
		if($filaDoc = mysql_fetch_array($resultadoDoc)){
                    $id_inscrito = $filaDoc["id_inscrito"];
			echo "<tr>";						
			echo "<td>".$i++."</td>"; 							
			echo "<td>".$nombreAlumno." ".$apellidoAlumno."</td>";					
    		echo "<td>".$filaDoc["cantidad_informes"]."</td>";
                echo "<td><a href='verinformepasantia.php?ins=".$id_inscrito."' class='iredit'>Ver</a></td>";
		echo "<td><a href='editarinformepasantia.php?id_ins=".$id_inscrito."' class='iredit'>Nuevo</a></td>";	
                echo "</tr>";						
		}			
	}
        echo "</tbody>";
	echo "</table><br>";	
}
?>
<?php
mysql_close($link);
?>
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
  <script language="javascript" type="text/javascript" src="../js/jquery-ui-1.10.3.custom.min.js"></script>
<script language="javascript" type="text/javascript">
function tablefilter(table_selector, input_selector, search_level, colspan) {

        var table = $(table_selector);
        if(table.length == 0)
                return;

        var input = $(input_selector);
        if(input.length == 0)
                return;

        if(search_level == "undefined" || search_level < 1)
                search_level = 3;

        if(colspan == "undefined" || colspan < 0)
                colspan = 2;

        $(input).val("Filtrar…");

        $(input).focus(function() {
                if($(this).val() == "Filtrar…") {
                        $(this).val("");
                }
                $(this).select();
        });

        $(input).blur(function() {
                if($(this).val() == "") {
                        $(this).val("Filtrar…");
                }
        });

        $(input).keyup(function() {
			if($(this).val().length >= search_level) {
				// Ocultamos las filas que no contienen el contenido del edit.
				var existe = $(table).find("tbody tr").not(":contains(\"" + $(this).val() + "\")").hide("slow");
				
				//if(existe.length==0)
									
				// Si no hay resultados, lo indicamos.
				if($(table).find("tbody tr:visible").length <= 0) {			
					$("tbody tr.botonGuar").hide();
					$(table).find("tbody:first").append('<tr id="noresults" class="aligncenter"><td colspan="' + colspan + '">Lo siento pero no hay resultados para la búsqueda indicada.</td></tr>');
				}
			} else{
					// Borramos la fila de que no hay resultados.
					$(table).find("tbody tr#noresults").remove();
					
					// Mostramos todas las filas.
					$(table).find("tbody tr").show();
					/*$("tbody tr.botonGuar").show();*/
			}			
        });
}

jQuery.expr[':'].contains = function(a, i, m) {
        return jQuery(a).text().toUpperCase().indexOf(m[3].toUpperCase()) >= 0; 
};

$(function() {
    tablefilter("table#mi_tabla", "table thead tr input#filtrar", 2, 2);
});
</script>
</body>
</html>