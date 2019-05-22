<?php
include_once "../conexionbd.php";
$sql = "SELECT * FROM carreras";
$res = mysql_query($sql) or die(mysql_error());
echo "<select name='carrera' id='carrera' class='carrera'>";
echo "<option value=''>Seleccione</option>";
while ($f = mysql_fetch_array($res)) {    
    echo "<option value='" . $f["id_carrera"] . "'>" . $f["nombre_carrera"] . "</option>";
}
echo '</select>';
?>