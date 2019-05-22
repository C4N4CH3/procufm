<?php
include ("../sesiones.php");
if($_SESSION['nivel']!=$_SESSION['id']){
session_destroy();
echo "FALLA GRAVE AL SISTEMA, PERDISTE LA SESION, PARA REGRESAR AL INICIO REINICIA EL NAVEGADOR";exit();
}



/*$consulta = "select * from usuario where login='$nombreusuario';";
$resultado = mysql_query($consulta) or die (mysql_error());

if ($fila = mysql_fetch_array($resultado)) {
    $id_preg = $fila["id_pregunta_secreta"];

    if ($id_preg <= 0 || $id_preg == NULL) {
        mysql_close($link);
        header("Location: pregunta_secreta/pregunta.php");
        exit();
    }
}    */



function formatear_fecha($fe){
    $trozo = explode("-", $fe);
    $fecha = $trozo[2]."-".$trozo[1]."-".$trozo[0];
    return $fecha;
}?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Principal</title>
<link href="../css/bootstrap/3.3.0/bootstrap.min.css" rel="stylesheet">
<link href="../css/material/roboto.min.css" rel="stylesheet">
<link href="../css/material/material.min.css" rel="stylesheet">
<link href="../css/material/ripples.min.css" rel="stylesheet">
<link href="../css/material/materialmodif.css" rel="stylesheet">
<link href="../css/jquery-ui.css" rel="stylesheet" type="text/css"> 
</head>

<body>
<form action="" method="post">
  <?php include_once '../navbar.php';?>
    <?php require_once 'menu_al.php';?>
  
  <div class="well col-md-9 col-lg-9 col-sm-9 col-xs-9" style="margin-left:20px">
    <h4 align="center">Bienvenido <b><?php echo $_SESSION['usuario']?></b> al Proceso de Pasantia. <br> En esta p&aacute;gina podras visualizar el estado actual de tus pasant&iacute;as: consultar tu informaci&oacute;n personal, tu tutor academico asignado, tu inscripci&oacute;n e informes quincenales.</h4>
    <br>
    
    
            
        <?php
	$ci = $_SESSION['cedula'];
        $id_alumno = $_SESSION['identificador'];
        include_once "../conexionbd.php";
        
        
        $sql="SELECT * FROM (alumno as al 
                        INNER JOIN estatus as es
                            ON al.id_estatus=es.id_estatus)
                        INNER JOIN preinscripcion as pre
                            ON al.id_alumnos=pre.id_alumno
                        WHERE id_alumnos=".$id_alumno;
        
        $res = mysql_query($sql) or die (mysql_error());
        if($f = mysql_fetch_array($res)){
            $id_es = $f["id_estatus"];
            $nom_es = $f["nombre_estatus"];	
        }
        ?>
            
        <fieldset>
            <legend>Estatus Actual</legend>
        
        
        <table border="0" width="100%" class="tabla">            
            <tr>
                <td width="16%" align="center">Registrado</td>
                <td width="16%" align="center">Preinscrito</td>
                <td width="16%" align="center">Inscrito</td>
                <td width="16%" align="center">Informes</td>
                <td width="16%" align="center">Calificacion</td>
            </tr>
            <tr>
                <td align="center">
                    <?php
                        if($id_es>=0){
                            echo '<img alt="registrado" src="../imagenes/bueno.png">';
                        }else{
                            echo '<img alt="registrado" src="../imagenes/malo.png">';
                        }
                    ?>                    
                </td>
                <td align="center">
                    <?php
                        if($id_es>=1){
                            echo '<img alt="registrado" src="../imagenes/bueno.png">';
                        }else{
                            echo '<img alt="registrado" src="../imagenes/malo.png">';
                        }
                    ?>
                </td>
                <td align="center">
                    <?php
                        if($id_es>=2){
                            echo '<img alt="registrado" src="../imagenes/bueno.png">';
                        }else{
                            echo '<img alt="registrado" src="../imagenes/malo.png">';
                        }
                    ?>
                </td>
                <td align="center">
                    <?php
                        if($id_es>=3){
                            echo '<img alt="registrado" src="../imagenes/bueno.png">';
                        }else{
                            echo '<img alt="registrado" src="../imagenes/malo.png">';
                        }
                    ?>
                </td>
                <td align="center">
                    <?php
                        if($id_es==4){
                            echo '<img alt="registrado" src="../imagenes/bueno.png"><font color="blue">Aprobado</font>';
                        }else if($id_es==5){
                            echo '<img alt="registrado" src="../imagenes/malo.png"><font color="red">Reprobado</font>';
                        }else{
                            echo '<img alt="registrado" src="../imagenes/malo.png">';
                        }
                    ?>
                </td>
            </tr>
        </table>
        </fieldset><br><br>
            
        <p align="center"><em><font color="#0033FF">Datos Personales</font></em></p>    
	<?php
	$consultaTablaPrein = "select * from preinscripcion where cedula_alumno='$ci'";
	$resultadoTablaPrein = mysql_query($consultaTablaPrein) or die (mysql_error());	
	if($fila1 = mysql_fetch_array($resultadoTablaPrein)){		
		$idalum = $fila1["cedula_alumno"];		
		
		$consultaTablAlum = "select * from alumno where cedula_alumno='$idalum'";
		$resultadoTablAlum = mysql_query($consultaTablAlum) or die (mysql_error());		
		if($fila = mysql_fetch_array($resultadoTablAlum)){			
			$nombreAlum = $fila["nombre"];
			$apellidoAlum = $fila["apellido"];
			$carnetAlum = $fila["carnet"];
			$email = $fila["email"];
			$idcarrera = $fila["id_carrera"];
			$idmencion = $fila["id_mencion"];
			
			$consulTablaCarrera = "select * from carreras where id_carrera=$idcarrera";
			$resultTablaCarrera = mysql_query($consulTablaCarrera) or die (mysql_error());
			if($filaCarrera = mysql_fetch_array($resultTablaCarrera)){
				$nomCarrera = utf8_encode($filaCarrera["nombre_carrera"]);			
			}else{
				$nomCarrera = "No hay carrera";
			}			
			$consulTablaMencion = "select * from menciones where id_mencion=$idmencion";
			$resultTablaMencion = mysql_query($consulTablaMencion) or die (mysql_error());
			if($filaMencion = mysql_fetch_array($resultTablaMencion)){
				$nomMencion = utf8_encode($filaMencion["nombre_mencion"]);			
			}else{
				$nomMencion = "No hay menci&oacute;n";
			}
			
			echo "<table width=100% border=1>";
  			echo "<tr>";
    		echo "<td width=29% align=right>Nombre:</td>";
    		echo "<td width=71%>".$nombreAlum." ".$apellidoAlum."</td>";
    		echo "</tr>";
  			echo "<tr>";
    		echo "<td align=right>Carnet:</td>";
    		echo "<td>".$carnetAlum."</td>";
    		echo "</tr>";
                        echo "<tr>";
    		echo "<td align=right>Fecha de Nacimiento:</td>";
    		echo "<td>".formatear_fecha($fila["fecha_nacimiento"])."</td>";
    		echo "</tr>";
  			echo "<tr>";
    		echo "<td align=right>Email:</td>";
    		echo "<td>".$email."</td>";
    		echo "</tr>";			
			echo "<tr>";
    		echo "<td align=right>Carrera:</td>";
    		echo "<td>".$nomCarrera."</td>";
    		echo "</tr>";
			echo "<tr>";
    		echo "<td align=right>Menci&oacute;n:</td>";
    		echo "<td>".$nomMencion."</td>";
    		echo "</tr>";
                        echo "<tr>";
    		echo "<td align=right>Teléfono Celular:</td>";
    		echo "<td>".$fila["telefono_celular"]."</td>";
    		echo "</tr>";
                        echo "<tr>";
    		echo "<td align=right>Teléfono Habitación:</td>";
    		echo "<td>".$fila["telefono_habitacion"]."</td>";
    		echo "</tr>";
                echo "</table>";
		}
	}else{		
		echo "<br> No hay datos acad&eacute;micos asignados debido a que no has realizado tu preinscripci&oacute;n.<br>";
		echo "Se te recomienda hacer el proceso a trav&eacute;s del menu <a href='formulariopreincripcion.php'>Preinscripci&oacute;n</a>";					
	}
	?> 
    <br><br>
    <p align="center"><em><font color="#0033FF">Datos Tutor Acad&eacute;mico</font></em><br>         
	<?php	
	$ci = $_SESSION['cedula'];
	$consultaTablaPre = "select * from preinscripcion where cedula_alumno='$ci'";
	$resultadoTablaPre = mysql_query($consultaTablaPre) or die (mysql_error());	
	if($fila1 = mysql_fetch_array($resultadoTablaPre)){
		$idtutor = $fila1["id_tutor"];		
		$consultaTablaTutor = "select * from tutor_academico where id_tutor='$idtutor'";
		$resultadoTablaTutor = mysql_query($consultaTablaTutor) or die (mysql_error());
		
		if($fila = mysql_fetch_array($resultadoTablaTutor)){
			$nombre_tutor = $fila["nombre"];
			$apellido_tutor = $fila["apellido"];
			$tel_tutor = $fila["telefono"];
			$email = $fila["email"];
			
			echo "<table width=100% border=1>";
  			echo "<tr>";
    		echo "<td width=29% align=right>Nombre del tutor:</td>";
    		echo "<td width=71%>".$nombre_tutor." ".$apellido_tutor."</td>";
    		echo "</tr>";
  			echo "<tr>";
    		echo "<td align=right>Tel&eacute;fono:</td>";
    		echo "<td>".$tel_tutor."</td>";
    		echo "</tr>";
  			echo "<tr>";
    		echo "<td align=right>Email:</td>";
    		echo "<td>".$email."</td>";
    		echo "</tr>";
    		echo "</table>";							
		}	
	}
	else{
		echo "<br> No hay tutor acad&eacute;mico asignado debido a que no has realizado tu preinscripci&oacute;n.<br>";
		echo "Se te recomienda hacer el proceso a trav&eacute;s del menu <a href='formulariopreincripcion.php'>Preinscripci&oacute;n</a>";
	}	
			
	?>
    <br><br>   
    </p>
    <p align="center"><em><font color="#0033FF">Centro de Pasant&iacute;a</font></em><br>          
	<?php
	$ci = $_SESSION['cedula'];
	$consultaTablaPre1 = "select * from preinscripcion where cedula_alumno='$ci'";
	$resultadoTablaPre1 = mysql_query($consultaTablaPre1) or die (mysql_error());	
	if($fil = mysql_fetch_array($resultadoTablaPre1)){
		$idpreins = $fil["id_preinscripcion"];		
		
		$TablaPre = "select * from inscripcion where id_preinscripcion='$idpreins'";
		$resulTablaPre = mysql_query($TablaPre) or die (mysql_error());	
		if($filacen = mysql_fetch_array($resulTablaPre)){
			$nom_empresa = $filacen["nombre_empresa"];		
			$direccion_empresa = $filacen["direccion_empresa"];
			$telefono_empresa = $filacen["telefono_empresa"];
			
			
			echo "<table width=100% border=1>";
  			echo "<tr>";
    		echo "<td width=29% align=right>Nombre:</td>";
    		echo "<td width=71%>".$nom_empresa."</td>";
    		echo "</tr>";
  			echo "<tr>";
    		echo "<td align=right>Tel&eacute;fono:</td>";
    		echo "<td>".$telefono_empresa."</td>";
    		echo "</tr>";
  			echo "<tr>";
    		echo "<td align=right>Direcci&oacute;n:</td>";
    		echo "<td>".$direccion_empresa."</td>";
    		echo "</tr>";
    		echo "</table>";							
		}
		else{
			echo "<br> No hay centros disponibles.<br>";
			echo "Se te recomienda hacer el proceso a trav&eacute;s del menu <a href='formularioinscripcionestudiante.php'>Inscripci&oacute;n</a>";
		}
	}
	else{
			echo "<br> No hay centros disponibles.<br>";
			echo "Se te recomienda hacer el proceso a trav&eacute;s del menu <a href='formularioinscripcionestudiante.php'>Inscripci&oacute;n</a>";
	}
	?>
    </p>
    <?php
		mysql_close($link);
   	?>
  </div>
  
  <?php include '../footer.php';?>
</form> 
<script type="text/javascript" src="../js/1.11.1/jquery.min.js"></script>
    <script src="../js/bootstrap/3.3.0/bootstrap.min.js"></script>
    <script src="../js/material/material.min.js"></script>
    <script src="../js/material/ripples.min.js"></script>
    <script>
      $.material.init();
    </script>
<script language="javascript" type="text/javascript" src="../js/jquery-ui-1.10.3.custom.js"></script>    
<script language="javascript" type="text/javascript" src="../js/func_cons_estatus_al.js"></script>
</body>
</html>
