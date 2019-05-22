<?php
include ("../sesiones.php");
if($_SESSION['nivel']!=$_SESSION['id']){
session_destroy();
echo "FALLA GRAVE AL SISTEMA, PERDISTE LA SESION, PARA REGRESAR AL INICIO REINICIA EL NAVEGADOR";exit();
}
?>

<div class="well col-md-2">
<div>
  <p align="center"><a class="btn btn-danger btn-fab btn-raised mdi-action-settings-power" href="../cerrarsesion.php" data-toggle="tooltip" data-placement="right" title="Cerrar Sesión"></a></p>
 </div>
 <div>
  <p align="center"> 
  <?php 
  	if (isset($_GET["preinscrito"]) && $_GET["preinscrito"]=="si"){
		echo "<font color=red>Ud ya esta Preinscrito</font>";
		echo "<script language=JavaScript>alert('Ud ya esta Preinscrito');</script>";
	}
	if (isset($_GET["centropasan"]) && $_GET["centropasan"]=="si"){
		echo "<font color=red>Ud debe Preinscribirse antes de <br>poder acceder a esta secci&oacute;n</font>";
		echo "<script language=JavaScript>alert('Ud debe Preinscribirse antes de poder acceder a esta seccion');</script>";
	}
	if (isset($_GET["nolapso"]) && $_GET["nolapso"]=="si"){
		echo "<font color=red>Lapso del proceso no ha sido definido</font>";
		echo "<script language=JavaScript>alert('Disculpe pero el Lapso del proceso no ha sido definido');</script>";
	}
	if (isset($_GET["inscrito"]) && $_GET["inscrito"]=="si"){
		echo "<font color=red>Ud ya esta Inscrito</font>";
		echo "<script language=JavaScript>alert('Ud ya esta Inscrito');</script>";
	}
	if (isset($_GET["gestionarinscripcion"]) && $_GET["gestionarinscripcion"]=="si"){
		echo "<font color=red>Ud debe realizar una inscripcion</font>";
		echo "<script language=JavaScript>alert('Ud debe realizar una inscripcion');</script>";
	}
	if (isset($_GET["notutor"]) && $_GET["notutor"]=="si"){
		echo "<font color=red>Disculpe todavia no se ha registrado un tutor para su carrera</font>";
		echo "<script language=JavaScript>alert('Disculpe todavia no se ha registrado un tutor para su carrera');</script>";
	}
  ?></p>
  	
    <!-- end .sidebar2 --></div>
<p class="submenu" align="center">Principal</p>
    <ul class="nav nav-pills nav-stacked">
      <li><a class="btn btn-flat btn-info" href="sesionestudiante.php" style="margin-top:5px; margin-bottom:5px">Inicio</a></li>   
    </ul>
    <p class="submenu" align="center">Datos</p>
    <ul class="nav nav-pills nav-stacked">
      <li><a class="btn btn-flat btn-info" href="cambioclave.php" style="margin-top:5px; margin-bottom:5px">Contraseña</a></li>   
    </ul>
    <p class="submenu" align="center">Gesti&oacute;n</p>
    <ul class="nav nav-pills nav-stacked">
      <li><a class="btn btn-flat btn-info" href="formulariopreincripcion.php" style="margin-top:5px; margin-bottom:5px">Preinscripci&oacute;n</a></li>
      <li><a class="btn btn-flat btn-info" href="formulariocentroestudiante.php" style="margin-top:5px; margin-bottom:5px">Centro pasant&iacute;a</a></li>      
      <li><a class="btn btn-flat btn-info" href="documentodepartamento_admin.php" style="margin-top:5px; margin-bottom:5px">Documento</a></li>
      <li><a class="btn btn-flat btn-info" href="formularioinscripcionestudiante.php" style="margin-top:5px; margin-bottom:5px">Inscripci&oacute;n</a></li>
      <li><a class="btn btn-flat btn-info" href="formularioinformestudiante.php" style="margin-top:5px; margin-bottom:5px">Informes</a></li>
    </ul>
    <p class="submenu" align="center">Fechas</p>
    <ul class="nav nav-pills nav-stacked">
      <li><a class="btn btn-flat btn-info" href="cronograma.php" style="margin-top:5px; margin-bottom:5px">Cronograma</a></li>
    </ul>
    <p class="submenu" align="center">Ayuda</p>
    <ul class="nav nav-pills nav-stacked">
      <li><a class="btn btn-flat btn-info" href="ayuda.php" style="margin-top:5px; margin-bottom:5px">Pasos</a></li>
    </ul>
    </div>