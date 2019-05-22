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
  <p align="center"><a class="btn btn-danger btn-fab btn-raised mdi-action-settings-power" href="../cerrarsesion.php" data-toggle="tooltip" data-placement="right" title="Cerrar Sesión"></a></p>  
 </div>
  <!--FIN DE LO QUE ESTABA EN LA 2da BARRA A LA DERECHA COMO POR EJEMPLO CERRAR SESION--> 
<p class="submenu" align="center">Principal</p>
    <ul class="nav nav-pills nav-stacked">
      <li><a class="btn btn-flat btn-info" href="sesiontutoracademico.php"style="margin-top:5px; margin-bottom:5px">Inicio</a></li>   
    </ul>
    <p class="submenu" align="center">Datos</p>
    <ul class="nav nav-pills nav-stacked">
      <li><a class="btn btn-flat btn-info" href="cambioclave.php" style="margin-top:5px; margin-bottom:5px">Contraseña</a></li>   
    </ul>
    <p class="submenu" align="center">Procesos</p>
    <ul class="nav nav-pills nav-stacked">
      <li>
      <a class="btn btn-flat btn-info" href="tutoralumnosasignados.php" style="margin-top:5px; margin-bottom:5px">Alum asignados</a>
      </li>
      <li>
      <a class="btn btn-flat btn-info" href="tutorInformesPasantias.php">Informes</a>
      </li>
      <li>
      <a class="btn btn-flat btn-info" href="tutorCalificar.php">Calificar</a>
      </li>
    </ul>    
     <p class="submenu" align="center">Fechas</p>
    <ul class="nav nav-pills nav-stacked">
      <li>
      <a class="btn btn-flat btn-info" href="cronogramatutoracademico.php">Cronograma</a>
      </li>
    </ul>
    <p class="submenu" align="center">Consultas</p>
    <ul class="nav nav-pills nav-stacked">
        <li>
        <a class="btn btn-flat btn-info" href="estadisticapreinscritos.php">Preinscritos</a>
        </li>
        <li>
        <a class="btn btn-flat btn-info" href="estadisticainscritos.php">Inscritos</a>
        </li>
        <li>
        <a class="btn btn-flat btn-info" href="estadisticaprobados.php">Aprobados</a>
        </li>
        <li>
        <a class="btn btn-flat btn-info" href="estadisticareprobados.php">Reprobados</a>
        </li>
    </ul>
  <!-- end .sidebar1 --></div>