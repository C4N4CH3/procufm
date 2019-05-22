<?php
include ("../sesiones.php");
if($_SESSION['nivel']!=$_SESSION['id']){
session_destroy();
echo "FALLA GRAVE AL SISTEMA, PERDISTE LA SESION, PARA REGRESAR AL INICIO REINICIA EL NAVEGADOR";exit();
}
//sesion con la fecha de ultima vez que se registro
$ultima_visita = date("Y-n-j H:i:s");
$nombreusuario = $_SESSION['usuario'];
include "../conexionbd.php";
$consulta="select * from usuario where login='$nombreusuario'";
$resultado=mysql_query($consulta) or die (mysql_error());
$sql = "update usuario set ultima_visita='$ultima_visita' where login='$nombreusuario'";
$result = mysql_query($sql);		
mysql_close($link);
?>

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
</head>

<body>
<?php include_once '../navbar.php';?>
  <div class="sidebar1"> 
    <?php require_once 'menu_al.php';?>
  <!-- end .sidebar1 --></div>
 <div class="well col-md-9 col-lg-9 col-sm-9 col-xs-9" style="margin-left:20px">

      <h2>Pasos</h2>

    <p align="justify">Bienvenidos a  la Sección de Ayuda: submenu pasos, aquí explicaremos brevemente  mediante una serie de instrucciones  los pasos y requerimientos que debes  completar para crear y gestionar tu cuenta,  generar tu preinscripción, inscripción e  informes correspondientes a tus actividades con el fin de automatizar todos los  procesos y brindarte una satisfactoria experiencia en el período  correspondiente a tus pasantías, comencemos:</p>
    <p align="justify">1.- Una  vez creada la nueva cuenta de usuario debes acceder al perfil mediante el panel  de entrada colocando tu login y contraseña, una vez introducidos tendrás  acceso a hacia tu sesión. </p>
    <p align="justify">2.- Ya  dentro de tu sesión debes  preinscribirte  para almacenar tus datos  personales y  académicos  en el registro del sistema.  (esta opción solo estará disponible cuando se habilite un nuevo periodo o lapso  de pasantías)</p>
<p align="justify">3.- Después  de gestionar tu preinscripci&oacute;n puedes presionar el botón del  menú llamado &ldquo;Centro Pasantía&rdquo; para ver que  empresas están disponibles para recibir nuevos pasantes por Carrera y Área,  también puedes empezar a generar los documentos pertinentes que necesites para  concretar tu sitio de pasantías como por ejemplo cartas de postulación,  permiso, etc.</p>
    <p align="justify">4.- Para  que estés informado de las actividades que se llevan a cabo mediante el proceso  de pasantías hemos habilitado para ti la opción de &ldquo;Cronograma&rdquo;, al entrar  podrás ver de forma detallada las fechas en las que se llevara a cabo la  programación establecida del proceso de pasantías.</p>
    <p align="justify">5.- Una  vez Preinscrito y con todos los datos necesarios  sobre el centro de pasantías a la mano debes  pasar a la inscripción de las mismas, para ello entra en la opción  &ldquo;Inscripción&rdquo;  y rellena los campos que  se muestran a continuación con información valida (Por favor sea cuidadoso y  revise que la información este correcta antes de seleccionar el botón pues una  vez que sea enviado el formulario no podrá ser modificado por usted y  necesitara dirigirse a las instalaciones del departamento para realizar  cualquier cambio). </p>
    <p align="justify">6.- Cuando  ya has iniciado tus pasantías debes empezar a gestionar tus informes  quincenales y a la culminación de las mismas debes entregar un informe final,  para esto hemos creado para ti una sección de informes para que puedas  gestionar los mismos, descargar los formatos y enviarlos directamente.</p>


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
