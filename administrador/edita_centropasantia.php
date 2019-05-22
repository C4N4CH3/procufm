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

</head>

<body>
<!--<form action="" method="post">-->
<?php include_once '../navbar.php';?>
  <div class="sidebar1">
     <?php include_once 'menu_admin.php';?>
     <?php include_once ("funciones.php");?>
  <!-- end .sidebar1 --></div>
  <div class="well col-md-9 col-lg-9 col-sm-9 col-xs-9" style="margin-left:20px">
   
      <h2>Centros de Pasant&iacute;as</h2>    
    <br />
    <br />
    <p>Listado  de  Centros Disponibles para el proceso:</p>
     <?Php
	$id_centro = $_GET['nombre'];
	
	//echo $id_centro.'<br>';

	
	$edit_centro="SELECT v.id_vacante_departamento, v.nombre, v.ubicacion, v.numero_pasantes, c.id_carrera,  c.nombre_carrera, m.id_mencion, m.nombre_mencion
				FROM vacante_departamento AS v
				INNER JOIN carreras AS c ON v.vacante_carrera = c.id_carrera
				INNER JOIN menciones AS m ON v.vacante_mencion = m.id_mencion
				WHERE v.id_vacante_departamento = $id_centro";
				$consulta=mysql_query($edit_centro);
				
				
			while ($result = mysql_fetch_array($consulta, MYSQL_NUM))						 
			{
				list($id_centros, $nombre_centro, $ubicacion_centro, $cant_pasant, $id_carrera, $nombre_carrera, $id_mencion, $nombre_mencion )=$result;
				
			}
			/*echo $nombre_centro.'<br/>';
			echo $ubicacion_centro.'<br/>';*/
 ?>
 <form action="edita_centro.php" action="POST" name="edita_center" id="edita_center">
			<table  border="2">
            	<tr>
                	<td>
                    <input type="hidden" value="<?Php echo $id_centros; ?>" name="id_centro" id="id_centro" />
                    	Nombre del Centro
                    </td>
                    <td>
                    	<input type="text" name="nombre_centro" value="<?Php echo $nombre_centro; ?>" size="80">
                    </td>
                </tr>
                <tr>
                	<td>
                    	Ubicaci&oacute;n del Centro
                    </td>
                    <td>
                    	<input type="text" name="ubicacion_centro" value="<?Php echo $ubicacion_centro; ?>" size="80">
                    </td>
                </tr>
                 <tr>
                	<td>
                    	Cantidad de Pasantes
                    </td>
                    <td>
                    	<input type="text" name="cant_pas" value="<?Php echo $cant_pasant; ?>" size="80">
                    </td>
                </tr>
                 <tr>
                	<td>
                    	Carrera
                    </td>
                    <td>
                    	<!--<input type="hidden" name="id_carrera" id="id_carrera" value="<?Php echo $id_carrera; ?>" />
                    	<input type="text" name="nombre_carrera" value="<?Php echo utf8_encode($nombre_carrera); ?>" size="80">-->
                     
                        <select size="1" style="width:510px; height:20px;" name="carrera" id="carrera"  >
                    	<option value="<?php echo $id_carrera; ?>"><?Php echo utf8_encode($nombre_carrera); ?></option>
						<?Php
                            echo _listar_carreras();
                        ?>
		</select>
                        
                        
                    </td>
                </tr>
                <tr>
                	<td>
                    	Menci&oacute;n
                    </td>
                    <td>
                      <!-- <input type="hidden" name="id_mencion" id="id_mencion" value="<?Php echo $id_mencion; ?>" />
                    	<input type="text" name="nombre_carrera" value="<?Php echo utf8_encode($nombre_mencion); ?>" size="80">-->
                        
                        
                        <select size="1" style="width:510px; height:20px;" name="mencion" id="mencion"  >
                    	<option value="<?php echo $id_mencion; ?>"><?Php echo utf8_encode($nombre_mencion); ?></option>
						<?Php
                            echo _listar_menciones();
                        ?>
		</select>
                    </td>
                </tr> <tr>
                	<td  align="center">
                    	<input type="submit" value="Editar" />
                    </td>
                    </form><td  align="center">
                    <form action="destroy_centro_conex.php" method="post" name="destroy_center" id="destroy_center">   
						<input type="hidden" value="<?Php echo $id_centro; ?>" name="id_centro" />
                    	<input type="submit" value="Eliminar" />
                    </form>
                    </td>
                </tr>
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