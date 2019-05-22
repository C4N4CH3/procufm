<?php
include_once '../sesiones.php';
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
    <?php include_once("menu.php")?>
  <!-- end .sidebar1 --></div>
<div class="well col-md-9 col-lg-9 col-sm-9 col-xs-9" style="margin-left:20px">

    <h2>Informes generados</h2>

      
<p align="justify"> Listado de cantidad de informes generados por los estudiantes:</p>
<p>
    
<?php
    /*
    $ci = $_SESSION['cedula'];    
    $sql = "SELECT * FROM tutor_academico WHERE cedula='$ci'";
    $res = mysql_query($sql) or die(mysql_error());
    if ($fila = mysql_fetch_array($res)) {
        $idtutor = $fila["id_tutor"];
        $sql="SELECT * FROM (((control_informes as ci
                INNER JOIN informes as inf ON ci.id_informes=inf.id_informes)
                INNER JOIN inscripcion as ins ON ci.id_inscrito=ins.id_inscrito)
                INNER JOIN preinscripcion as pre ON pre.id_preinscripcion=ins.id_preinscripcion)
                INNER JOIN alumno as al ON al.id_alumnos=pre.id_alumno
                WHERE pre.id=tutor=".$idtutor;
        $res1 = mysql_query($sql) or die(mysql_error());
        
        while ($fila2 = mysql_fetch_array($res1)) {
            echo $idpreins = $fila2["id_preinscripcion"]; 
        }
    }
    */
    
?>
    
<?php
    include_once '../conexionbd.php';
    $ci = $_SESSION['cedula'];    
    
    $consultaTutor = "SELECT * FROM tutor_academico WHERE cedula='$ci'";
    $resultadoTutor = mysql_query($consultaTutor) or die(mysql_error());
    if ($fila1 = mysql_fetch_array($resultadoTutor)) {
        $idtutor = $fila1["id_tutor"];
        
        $i = 1;
        $consultaPre = "SELECT * FROM preinscripcion WHERE id_tutor=".$idtutor;
        $resultadoPre = mysql_query($consultaPre) or die(mysql_error());
        if (mysql_num_rows($resultadoPre) > 0) {

            echo "<table width='100%' border='1' id='mi_tabla'>";
            echo "<thead>";
            echo "<tr>";
            echo "<th colspan='6' align='right'><input type='text' id='filtrar' /></th>";
            echo "</tr>";
            echo "<tr>";
            echo "<th scope=col>#</th>";
            echo "<th scope=col>Fecha</th>";
            echo "<th scope=col>Nombre</th>";
            echo "<th scope=col>Calificaci&oacute;n</th>";
            echo "<th scope=col>&nbsp;</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
            while ($fila2 = mysql_fetch_array($resultadoPre)) {
                $idpreins = $fila2["id_preinscripcion"];                
                $idalumno = $fila2["id_alumno"];
                $cedulaAlum = $fila2["cedula_alumno"];
                
                //nuevo				
                $consultaAlumno = "SELECT * FROM alumno "
                        . 'WHERE cedula_alumno='.$cedulaAlum
                        .' AND id_estatus=2';
                $resultadoAlumno = mysql_query($consultaAlumno) or die(mysql_error());
                if ($filaAl = mysql_fetch_array($resultadoAlumno)) {
                    $nombreAlumno = $filaAl["nombre"];
                    $apellidoAlumno = $filaAl["apellido"];               
                                   				
                    $consultaIns = "select * from inscripcion where id_preinscripcion=$idpreins";
                    $resultadoIns = mysql_query($consultaIns) or die(mysql_error());
                    if ($fila3 = mysql_fetch_array($resultadoIns)) {
                        $idins = $fila3["id_inscrito"];
                        $cont=0;                    
                        $bandera = array();
                        $consultaControlInf = "select * from control_informes where id_inscrito=$idins";
                        $resultadoControlInf = mysql_query($consultaControlInf) or die(mysql_error());
                        while ($fila4 = mysql_fetch_array($resultadoControlInf)) {
                            $idInformes = $fila4["id_informes"];

                            $consultaInf = "SELECT * FROM informes "
                            . "WHERE id_informes=$idInformes";
                            $resultadoInf = mysql_query($consultaInf) or die(mysql_error());
                            if ($fila5 = mysql_fetch_array($resultadoInf)) {
                                $estadoInforme = $fila5["estado_informe"];
                                $calificacion = $fila5["calificacion_informe"];

                                echo "<tr>";
                                echo "<td>" . $i++ . "</td>";
                                echo "<td>" . $fila5["fecha_informe"] . "</td>";
                                echo "<td>" . $nombreAlumno . " " . $apellidoAlumno . "</td>";
                                echo "<td>" . $calificacion . "</td>";
                                echo "<td><a href=verinformes.php?enviarId=".$idInformes." class='iredit'>Ver</a></td>";
                                echo "</tr>";
                                if($calificacion == 'aprobado'){
                                    $bandera[$cont] = TRUE;
                                }else{
                                    $bandera[$cont] = FALSE;
                                }
                            }
                            $cont++;
                        }
                        //echo "<br>".$cont;
                        /*foreach($bandera as $i => $val){
                            echo "<br>".$val;
                        }*/
                        if (in_array(FALSE, $bandera)) {
                            //echo "Existe Irix";
                            $sql = "update alumno set id_estatus=2 where id_alumnos=".$idalumno;
                            mysql_query($sql) or die(mysql_error());
                        }else{
                            if($cont==3){
                                $sql = "update alumno set id_estatus=3 where id_alumnos=".$idalumno;
                                mysql_query($sql) or die(mysql_error());                            
                            }else{

                            }
                        }
                        //echo "<br>------".$nombreAlumno."".$apellidoAlumno."---------<br>";
                    }
                //hasta aki                    
                }
            }
            echo "</tbody>";
        } else {
            echo "<p>No hay alumnos Preinscritos</p>";
        }
        echo "</table>";
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
<script language="javascript" type="text/javascript" src="../js/jquery-ui-1.10.3.custom.js"></script>
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