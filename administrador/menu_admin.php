<?php
include ("../sesiones.php");
if($_SESSION['nivel']!=$_SESSION['id']){
session_destroy();
echo "FALLA GRAVE AL SISTEMA, PERDISTE LA SESION, PARA REGRESAR AL INICIO REINICIA EL NAVEGADOR";exit();
}
?>

<div class="well col-md-2">
<!--LO QUE ESTABA EN LA 2da BARRA A LA DERECHA COMO POR EJEMPLO CERRAR SESION-->
<div>
  <h4 align="center">Bienvenido: <?php echo $_SESSION['usuario']?></h4>
  <p align="center"><a class="btn btn-danger btn-fab btn-raised mdi-action-settings-power" data-toggle="tooltip" data-placement="right" title="Cerrar Sesión" href="../cerrarsesion.php"></a></p>
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
      <li><a class="btn btn-flat btn-info" href="sesionadministrador.php" style="margin-top:5px; margin-bottom:5px">Inicio</a></li>   
    </ul>
<p class="submenu" align="center">Datos</p>
    <ul class="nav nav-pills nav-stacked">
      <li><a class="btn btn-flat btn-info" href="cambioclave.php" style="margin-top:5px; margin-bottom:5px">Contraseña</a></li>   
    </ul>
    
 <p class="submenu" align="center">Procesos</p>
    <ul class="nav nav-pills nav-stacked">
      <li>
      <a class="btn btn-flat btn-info" href="formularioestudiante.php" style="margin-top:5px; margin-bottom:5px">Alumnos</a>		
      </li>
      <li>
      <a class="btn btn-flat btn-info" href="formulariopersonal.php" style="margin-top:5px; margin-bottom:5px">Personal</a>
      </li>      
      <li>
      <a class="btn btn-flat btn-info" href="formulariotutoracademico.php" style="margin-top:5px; margin-bottom:5px">Tutor Academico</a>
      </li>
      <li>
      <a class="btn btn-flat btn-info" href="formulariopreinscripcion.php" style="margin-top:5px; margin-bottom:5px">Preinscripci&oacute;n</a>
      </li>
      <li>
      <a class="btn btn-flat btn-info" href="formularioinscripcion.php" style="margin-top:5px; margin-bottom:5px">Inscripci&oacute;n</a>
      </li>
      <li>
      <a class="btn btn-flat btn-info" href="formulariocentropasantia.php" style="margin-top:5px; margin-bottom:5px">Centro de Pasant&iacute;as</a>
      </li>
      <li>
      <a class="btn btn-flat btn-info" href="documentodepartamento_admin.php" style="margin-top:5px; margin-bottom:5px">Documentos</a>
      </li>
      <li>
      <a class="btn btn-flat btn-info" href="formularioinformespasantias_admin.php" style="margin-top:5px; margin-bottom:5px">Informes</a>
      </li>
      <li>
      <a class="btn btn-flat btn-info" href="formulariocronograma.php" style="margin-top:5px; margin-bottom:5px">Cronograma</a>
      </li>
    </ul>   
    <p class="submenu" align="center">Reportes</p>
    <ul class="nav nav-pills nav-stacked">
    <li>
    <a class="btn btn-flat btn-info" href="estadisticaprobados.php" style="margin-top:5px; margin-bottom:5px">Aprobados</a>
    </li>
    <li>
    <a class="btn btn-flat btn-info" href="estadisticareprobados.php" style="margin-top:5px; margin-bottom:5px">Reprobados</a>
    </li>
    <li>
    <a class="btn btn-flat btn-info" href="estadisticapreinscritos.php" style="margin-top:5px; margin-bottom:5px">Preinscritos</a>
    </li>
    <li>
    <a class="btn btn-flat btn-info" href="estadisticainscritos.php" style="margin-top:5px; margin-bottom:5px">Inscritos</a>
    </li>
	</ul>
	</div>
    