<?php
include ("../sesiones.php");
if($_SESSION['nivel']!=$_SESSION['id']){
session_destroy();
    echo "FALLA GRAVE AL SISTEMA, PERDISTE LA SESION, PARA REGRESAR AL INICIO REINICIA EL NAVEGADOR";
    exit();
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Nuevo Centro Pasantías</title>
<link href="../css/bootstrap/3.3.0/bootstrap.min.css" rel="stylesheet">
<link href="../css/material/roboto.min.css" rel="stylesheet">
<link href="../css/material/material.min.css" rel="stylesheet">
<link href="../css/material/ripples.min.css" rel="stylesheet">
<link href="../css/material/materialmodif.css" rel="stylesheet">
</head>

<body>
<?php include_once '../navbar.php';?>
     <div class="sidebar1"> 
    <?php include_once("menu_admin.php")?>
     <?php include_once ("funciones.php");?> 
    <!-- end .sidebar1 --></div>
 <div class="well col-md-9 col-lg-9 col-sm-9 col-xs-9" style="margin-left:20px">
    
      <h2 align="center">Agregar Centros de Pasant&iacute;as</h2>
        
    <br />
    <br />
    <p>Listado  de  Centros Disponibles para el proceso:</p>
    <form action="nuevo_centro_conex.php" action="GET" name="edita_center" id="edita_center">
        <table border="1">
            <tr>
                <td>

                    Nombre del Centro
                </td>
                <td>
                    <input type="text" name="nombre_centro" id="nombre_centro" 
                           placeholder="Nombre  del  Nuevo centro de Pasant&iacute;as" 
                           size="81" required="required">
                </td>
            </tr>
            <tr>
                <td>
                    Ubicaci&oacute;n del Centro
                </td>
                <td>
                    <input type="text" name="ubicacion_centro" id="ubicacion_centro" 
                           placeholder="Dirección  del  Nuevo centro de Pasant&iacute;as" 
                           size="81" required="required">
                </td>
            </tr>
            <tr>
                <td>
                    Cantidad de Pasantes
                </td>
                <td>
                    <input type="text" name="cant_pas" id="cant_pas" 
                           placeholder="Indique el N&uacute;mero de Vacantes que Acepta" 
                           size="81" required="required">
                </td>
            </tr>
            <tr>
                <td>
                    Carrera
                </td>
                <td>

                    <select size="1" style="width:510px; height:20px;" name="carrera" id="carrera"  >
                        <?php echo _listar_carreras(); ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    Menci&oacute;n
                </td>
                <td>

                    <select size="1" style="width:510px; height:20px;" name="mencion" id="mencion">
                        <?php echo _listar_menciones(); ?>
                    </select>
                </td>
            </tr> 
        </table>
        
        <p align="center">
            <input type="submit" value="Guardar" />
            <input type="reset" value="Limpiar" />
        </p>        
    </form>
 </div>
<?php include_once '../footer.php';?>

<script type="text/javascript" src="../js/1.11.1/jquery.min.js"></script>
<script src="../js/bootstrap/3.3.0/bootstrap.min.js"></script>
<script src="../js/material/material.min.js"></script>
<script src="../js/material/ripples.min.js"></script>
<script>
      $.material.init();
</script>
  <script type="text/javascript" src="../validarsesiones.js"></script>
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