<?php
include_once "../conexionbd.php";
$sql = "SELECT * FROM preguntas_secretas";
$res = mysql_query($sql) or die(mysql_error());
echo "<select name='pregunta' id='pregunta'>";
echo "<option value=''>Seleccione</option>";
while ($f = mysql_fetch_array($res)) {    
    echo "<option value='" . $f["id"] . "'>" . $f["descripcion"] . "</option>";
}
echo '</select>';
?>