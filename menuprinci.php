<?php 
include ("sesiones.php");
if($_SESSION['nivel']!=$_SESSION['id']){
session_destroy();
echo "FALLA GRAVE AL SISTEMA, PERDISTE LA SESION, PARA REGRESAR AL INICIO REINICIA EL NAVEGADOR";exit();
}
?>

<div class="well col-md-2">
<!--LO QUE ESTABA EN LA 2da BARRA A LA DERECHA COMO POR EJEMPLO CERRAR SESION-->
<div>
  <h4 align="center">Bienvenido: <?php echo $_SESSION['usuario']?></h4>
  <p align="center"><a class="btn btn-danger btn-fab btn-raised mdi-action-settings-power" href="../cerrarsesion.php"></a></p>
  <p align="center"> 
  <?php 
  	if (isset($_GET["preinscrito"]) && $_GET["preinscrito"]=="si"){
		echo "<font color=red>Ud ya esta Preinscrito</font>";
		echo "<script language=JavaScript>alert('Ud ya esta Preinscrito');</script>";
	}
	if (isset($_GET["centropasan"]) && $_GET["centropasan"]=="si"){
		echo "<font color=red>Ud ya tiene centro de Pasantia</font>";
		echo "<script language=JavaScript>alert('Ud ya tiene centro de Pasantia');</script>";
	}
  ?></p>
</div>
 <!--FIN DE LO QUE ESTABA EN LA 2da BARRA A LA DERECHA COMO POR EJEMPLO CERRAR SESION--> 
   <p class="submenu" align="center">Principal</p>
    <ul class="nav nav-pills nav-stacked">
      <li>
      <a class="btn btn-flat btn-info" href="sesiondepartamento.php" style="margin-top:5px; margin-bottom:5px">Inicio</a>
      </li>   
    </ul>
<p class="submenu" align="center">Gesti&oacute;n</p>
    <ul class="nav nav-pills nav-stacked">
      <li>
      <a class="btn btn-flat btn-info" href="cronogramapasantia.php" style="margin-top:5px; margin-bottom:5px">
      Cronograma</a>
      </li>
      <li>
      <a class="btn btn-flat btn-info" href="formulariocentropasantiasss.php">Centro pasant&iacute;a</a>
      </li>
      <li>
      <a class="btn btn-flat btn-info" href="documentodepartamento.php">Documento</a>
      </li>        
    <li><a class="btn btn-flat btn-info" href="documentotutor.php">Tutores Acad.</a></li>    
    <li><a class="btn btn-flat btn-info" href="informedepartamento.php">Informes</a></li>   
    </ul>
    <p class="submenu" align="center">Estad&iacute;sticas</p>
    <ul class="nav nav-pills nav-stacked">
      <li><a class="btn btn-flat btn-info" href="estadisticapreinscritos.php">Preinscritos</a></li>
      <li><a class="btn btn-flat btn-info" href="estadisticainscritos.php">Inscritos</a></li>
      <li><a class="btn btn-flat btn-info" href="estadisticaprobados.php">Aprobados</a></li>
      <li><a class="btn btn-flat btn-info" href="estadisticareprobados.php">Reprobados</a></li>
    </ul>
    <p  class="submenu" align="center">B&uacute;squeda</p>
    <ul class="nav nav-pills nav-stacked">
      <li><a class="btn btn-flat btn-info" href="buscaralumnos.php">Alumnos</a></li>
    </ul>
  <!-- end .sidebar1 --></div>
<!---->
