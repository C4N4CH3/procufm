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
    <?php include_once("menu_admin.php")?>
  <!-- end .sidebar1 --></div>
  <div class="content">
  <blockquote>
    <h2>Informes generados</h2>
  </blockquote>

    <?php
    //recibir x get
    ?>
      
      <table width="100%" border="0">
      <tr>
    <td height="112"colspan="2" align="left" valign="top">Unidad (es) Administrativa (s) donde ha realizado su pasant&iacute;a durante <br> este lapso:<br/> <textarea name="unidad" rows="2" cols="70"></textarea></td>
    </tr>
    <tr>
          <td height="198" colspan="2" align="left" valign="top">
              Describa ordenadamente las actividades que ha realizado 
              en este lapso: <br>
          <textarea name="actividades" rows="7" cols="70"></textarea>
            </td>
        </tr>
        <tr>
            <td height="189" colspan="2" align="left" valign="top">
              Señale las limitaciones que se le han presentado en 
              su centro de pasant&iacute;as: <br>
                  <textarea name="limitaciones" rows="7" cols="70"></textarea>
            </td>
        </tr>
        <tr>
            <td height="112" colspan="2" align="left" valign="top">
              Se entrevist&oacute; con su Tutor Acad&eacute;mico 
              <input type="radio" name="radioacademico" value="si">Si 
                  <input type="radio" name="radioacademico" value="no">No ¿Por qu&eacute; no? <br>
              <textarea name="academico" rows="3" cols="70"></textarea>
            </td>
        </tr>
        <tr>
            <td height="98" colspan="2" align="left" valign="top">
                Se entrevist&oacute; con su Tutor Empresarial 
                <input type="radio" name="radioempresarial" value="si">Si 
                    <input type="radio" name="radioempresarial" value="no">No ¿Por qu&eacute; no? <br>
                <textarea name="empresarial" rows="3" cols="70"></textarea>
            </td>
        </tr>
        <tr>
            <td height="56" colspan="2" align="left" valign="top" >
              <em>Estos datos son estrictamente proporcionados por 
                  usted por lo que le solicitamos que la informaci&oacute;n 
                  sea pertinente</em>
            </td>
        </tr>
        <tr>
          <td width="51%" align="center"><input type="reset" name="Imprimir" value="Imprimir"/></td>
          <td width="48%" align="center"><input type="submit" name="enviar" value="Aceptar" onclick="validarinf(this.form)" /> 
          </td>
        </tr>
    </table></td>
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
<script language='javascript' src="../popcalendar.js"></script>
<script language="javascript" type="text/javascript" src="../js/jquery-1.9.1.js"></script>
<script language="javascript" type="text/javascript" src="../js/jquery-ui-1.10.3.custom.js"></script>
<script language="javascript" type="text/javascript" src="../js/jquery-ui-1.10.3.custom.min.js"></script>
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