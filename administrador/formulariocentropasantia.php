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
<title>Centro Pasantías</title>
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
        <?php include_once 'menu_admin.php' ?>
        <?php include_once 'funciones.php'?>
  <!-- end .sidebar1 --></div>   
  <div class="well col-md-9 col-lg-9 col-sm-9 col-xs-9" style="margin-left:20px">

    
      <h2 align="center">Centros de Pasant&iacute;as</h2>
       
      
    <fieldset style="border: 1px solid;width: 500px; margin:auto;">
        <legend>MENU</legend>
        <form action="nuevo_centro.php" method="post">
            Nuevo centro de Pasantía: <input type="submit" value="Nuevo Centro" />
        </form> <br>               
    </fieldset> 
      
    <br />
    <p>Listado  de  Centros Disponibles para el proceso:
    
    <?php 
		include_once '../conexionbd.php';
		$consulta = "select * from lapso where lapso_habilitado='si'";
		$resultado = mysql_query($consulta) or die (mysql_error());
		if ($fila = mysql_fetch_array($resultado)){
			$cod_lapso = $fila["codigo_lapso"];
			echo $cod_lapso;
		}else{
			echo "no se ha definido codigo de lapso";
		}		
		
		?>
    </p>
    <br />
   
    <table width="100%" border="1">
        <tr>
        	 
             <th>Nombre del Centro</th>
             <th>Ubicaci&oacute;n del Centro</th>
             <th>Cantidad de pasantes</th>
             <th>Carrera</th>
             <th>Menci&oacute;n</th>
        </tr>
        <?php echo _listar_centros(); ?>         
      </table>
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
<script language="javascript" type="text/javascript" src="../js/jquery-ui-1.10.3.custom.min.js"></script>
<script type="text/javascript">
//valida solo texto
function validarTexto(e) { 
    tecla = (document.all) ? e.keyCode : e.which; 
    if ( (tecla==8) || (tecla==9) || (tecla==32))
	{
		return true;
	}
    patron = /(\W?[^\][\\}{\+\*\?\/\_\-\.\¨`´:;,çÇ¿¡'=()&%$·"!ªº|@#~½¬ 0-9])/;
    te = String.fromCharCode(tecla); 
    return patron.test(te);
}
//valida texto y numeros
function validarTextoNumero(e) { 	
	tecla = (document.all)?e.keyCode:e.which;
	if ( (tecla==8) || (tecla==9))
	{
		return true;
	}
	patron = /\d|(\W?[^\][\\}{\+\*\?\¨`´:;,çÇ¿¡'=()&%$·"!ªº|@#~½¬])/;
	te = String.fromCharCode(tecla);
	return patron.test(te);
}

function validarNumero(e) { 
    tecla = (document.all) ? e.keyCode : e.which; 
    if ( (tecla==8) || (tecla==9))
	{
		return true;
	} 
    patron = /\d|(\W?[^\.\][\\}{\+\*\?\/\_\-\¨`´:;,çÇ¿¡'=()&%$·"!ªº|@#~½¬a-zA-Z Ññ])/; 
    te = String.fromCharCode(tecla); 
    return patron.test(te);
}
</script>
</body>
</html>
<?Php
if (isset($_GET['error'])) {
    $error = $_GET['error'];
} else
    $error = 0;

switch ($error) {
    case 1:
        ?>
        <script language="javascript" type="text/javascript">
            alert(" Centro Editado Correctamente.");
        </script>
        <?php
        break;
}
switch ($error) {
    case 2:
        ?>
        <script language="javascript" type="text/javascript">
            alert(" Centro Eliminado.");
        </script>
        <?php
        break;
}
switch ($error) {
    case 3:
        ?>
        <script language="javascript" type="text/javascript">
            alert(" Nuevo Centro Guardado.");
        </script>
        <?php
        break;
}